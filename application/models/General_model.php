<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class General_model extends CI_Model
{
  function __construct()
  {

  }

  //CORE
  public function getDataRow($table, $whereVar, $whereVal)
  {
    return $this->db->get_where($table, $where = array($whereVar => $whereVal))->row();
  }

  public function getSomeData($table, $whereVar, $whereVal)
  {
    return $this->db->get_where($table, $where = array($whereVar => $whereVal))->result();
  }


  public function getAllData($table)
  {
    return $this->db->get($table)->result();
  }

  public function getNumRow($table, $whereVar, $whereVal)
  {
    return $this->db->get_where($table, $where = array($whereVar => $whereVal))->num_rows();
  }

  public function getNumRow2($table, $whereVar1, $whereVal1, $whereVar2, $whereVal2)
  {
    return $this->db->get_where($table, $where = array($whereVar1 => $whereVal1,$whereVar2 => $whereVal2))->num_rows();
  }

  public function updateData($table, $whereVar, $whereVal, $setVar, $setVal)
  {
    $this->db->where($where = array($whereVar => $whereVal));
    return $this->db->update($table, $data = array($setVar=> $setVal));
  }

  public function uploadFile($filename,$allowedFile)
  {
    $config['upload_path'] = APPPATH.'../assets/upload/';
    $config['overwrite'] = TRUE;
    $config['file_name']     =  str_replace(' ','_',$filename);
    $config['allowed_types'] = $allowedFile;
    $this->load->library('upload', $config);
    if (!$this->upload->do_upload('fileUpload')) {
      $upload['status']=0;
      $upload['message']= "Mohon maaf terjadi error saat proses upload : ".$this->upload->display_errors();
    } else {
      $upload['status']=1;
      $upload['message'] = "File berhasil di upload";
      $upload['ext'] = $this->upload->data('file_ext');
    }
    $this->session->set_flashdata('message', $upload['message']);
    return $upload;
  }


  public function createCaptcha()
  {
    $data['A'] = rand(0,10);
    $data['B'] = rand(0,10);
    $data['result'] = $data['A'] + $data['B'];
    return $data;
  }
  //FUNCTIONAL
  public function getSession($id)
  {
    $account = $this->getDataRow('view_'.$this->getDataRow('account', 'id', $id)->role, 'id', $id);
//    var_dump($account);die;
    if ($account->role=='admin') {
      $session = array(
        'login' => true,
        'id' => $account->id,
        'username' => $account->username,
        'password' => $account->password,
        'fullname' => $account->fullname,
        'email' => $account->email,
        'role' => $account->role,
        'status' => $account->status,
        'join_date' => $account->join_date,
        'phone_number' => $account->phone_number,
        'idc_number' => $account->idc_number,
        'idc_picture' => $account->idc_picture,
        'display_picture' => $account->display_picture,
       );
    } elseif ($account->role=='merchant') {
      $session = array(
        'login' => true,
        'id' => $account->id,
        'username' => $account->username,
        'password' => $account->password,
        'fullname' => $account->fullname,
        'email' => $account->email,
        'role' => $account->role,
        'status' => $account->status,
        'join_date' => $account->join_date,
        'phone_number' => $account->phone_number,
        'idc_number' => $account->idc_number,
        'idc_picture' => $account->idc_picture,
        'display_picture' => $account->display_picture,
        'merchant' => $account->merchant,
        'address_street' => $account->address_street,
        'address_city' => $account->address_city,
        'address_province' => $account->address_province,
        'address_postal' => $account->address_postal,
       );
    }

    return $session;
  }

  public function sentEmail($to, $fullname, $subject, $content)
  {
    $account = $this->getDataRow('webconf', 'id', 1);
    $config = [
      'protocol' => 'sentmail',
      'smtp_host' => $account->host,
      'smtp_user' => $account->email,
      'smtp_pass' => $account->password,
      'smtp_crypto' => $account->crypto,
      'charset' => 'utf-8',
      'crlf' => 'rn',
      'newline' => "\r\n",
      'smtp_port' => $account->port
    ];
    $this->load->library('email', $config);
    $this->email->from($account->email);
    $this->email->to($to);
    $this->email->subject($subject);
    $this->email->message('
    Yth. '.$fullname.'
    Di tempat.

    '.$content.'

    Atas perhatiannya kami ucapkan terima kasih.

    Admin
    ');
    $sent = $this->email->send();
    error_reporting(0);
  }

  //APPLICATION
  public function cShopPage($keyword, $page)
  {
    $data['product'] = $this->db->query('select * from view_product where fullname LIKE "%'.$keyword.'%" or merchant LIKE "%'.$keyword.'%" or product LIKE "%'.$keyword.'%" or description LIKE "%'.$keyword.'%" or category LIKE "%'.$keyword.'%" order by rating desc limit '.($page*50).','.(($page*50)+50))->result();
    $data['category'] = $this->getAllData('category');
    $data['view_name'] = 'shopPage';
    $data['webconf'] = $this->getDataRow('webconf', 'id', 1);
    return $data;
  }

  public function loginValidation()
  {
    if ($this->getNumRow2('account', 'username', $this->input->post('username'), 'password', md5($this->input->post('password')))==1) {
      $login['session'] = $this->getSession($this->getDataRow('account','username', $this->input->post('username'))->id);
      $login['status'] = true;
      notify('Berhasil Masuk', 'Selamat datang kembali '.$login['session']['fullname'],'success','fas fa-smile-wink',null);
    } else {
      $login['status'] = false;
      notify('Gagal Masuk', 'Mohon maaf kombinasi username dan password anda salah, silahkan periksa kembali','danger','fas fa-bullhorn',null);

    }
    return $login;
  }

  public function cProfile()
  {
    $data['view_name'] = 'profile';
    $data['webconf'] = $this->getDataRow('webconf', 'id', 1);
    return $data;
  }

  public function updateAccount()
  {
    if ($this->input->post('password')=='') {$data = array('username' => $this->input->post('username'),'fullname' => $this->input->post('fullname'),'email' => $this->input->post('email'));}
    else { $data = array('username' => $this->input->post('username'),'fullname' => $this->input->post('fullname'),'email' => $this->input->post('email'),'password' => md5($this->input->post('password')));}
    $this->db->where($where = array('id' => $this->session->userdata['id']));
    $this->db->update('account', $data);
    if ($this->session->userdata['role']=='admin') {$this->updateData('admin', 'id', $this->session->userdata['id'],'phone_number',$this->input->post('phone_number'));}
    notify('Update Berhasil', 'Proses pembaharuan akun '.$this->session->userdata['fullname'].' berhasil','success','fas fa-smile-wink',null);
    return $this->getSession($this->session->userdata['id']);
  }

  public function uploadDP()
  {
    if($this->updateData('account','id', $this->session->userdata['id'],'display_picture','display_picture_'.$this->session->userdata['id'].$this->uploadFile('display_picture_'.$this->session->userdata['id'], 'jpg|jpeg|png')['ext']))
    {$data=$this->getSession($this->session->userdata['id']);notify('Update DP Berhasil', 'Proses pembaharuan DP '.$this->session->userdata['fullname'].' berhasil','success','fas fa-smile-wink',null);}
    else{notify('Update DP Gagal', 'Proses pembaharuan DP '.$this->session->userdata['fullname'].' gagal, '.$this->session->userdata['message'],'danger','fas fa-smile-wink',null);}
    return $data;
  }

  public function cLogin()
  {
    $data['webconf'] = $this->getDataRow('webconf', 'id', 1);
    return $data;
  }

  public function cForgotPassword()
  {
    $data['captcha'] = $this->createCaptcha();
    $data['webconf'] = $this->getDataRow('webconf', 'id', 1);
    return $data;
  }

  public function resetPassword()
  {
    if($this->getNumRow('account', 'username', $this->input->post('username'))==1)
    {
      $newPassword = rand(1000000,9999999);
      $this->updateData('account', 'username', $this->input->post('username'), 'password', md5($newPassword));
      $content = 'kami informasikan bahwa akun anda berhasil di reset dengan password baru '.$newPassword;
      $this->sentEmail($this->getDataRow('account', 'username', $this->input->post('username'))->email, $this->getDataRow('account', 'username', $this->input->post('username'))->fullname, 'Password baru akun anda', $content);
      //$this->session->set_flashdata('notify', 'Password berhasil direset silahkan cek email anda');
      notify('Berhasil Direset', 'Password, anda berhasil direset, silahkan cek email anda untuk mendapatkan password terbaru','success','fas fa-smile-wink','login');
    } else {
      $this->session->set_flashdata('notify', 'username yang anda berikan tidak tersedia, silahkan periksa kembali');
      notify('Gagal ', 'Mohon maaf kombinasi username anda salah, silahkan periksa kembali','danger','fas fa-bullhorn',null);
    }
  }

  public function register()
  {
    if($this->getNumRow('account', 'username', $this->input->post('username'))==1 || $this->getNumRow('account', 'email', $this->input->post('email'))==1){
      notify('Gagal ', 'Mohon maaf kombinasi username dan email anda sudah terdaftar, silahkan login','warning','fas fa-bullhorn','login');
    } else {
      $newPassword = rand(1000000,9999999);
      $data = array(
        'username' => $this->input->post('username'),
        'password' => md5($newPassword),
        'email' => $this->input->post('email'),
        'fullname' => $this->input->post('username'),
        'role' => $this->input->post('role'),
        'status' => 1,
        'display_picture' => 'no.jpg'
       );
       $this->db->insert('account', $data);
       if ($this->input->post('role')=='merchant') {
         $this->db->insert('merchant', $data = array('id' => $this->db->insert_id()));
       }
       $content = 'Akun anda berhasil dibuat silahkan login menggunakan password '.$newPassword;
       $this->sentEmail($this->input->post('email'), $this->input->post('username'), 'Selamat Datang Pengguna Baru', $content);
       notify('Berhasil', 'Akun anda berhasil dibuat, silahkan cek email anda untuk mendapatkan password','success','fas fa-smile-wink','login');
    }

  }

  public function cDashboard()
  {
//    if ($this->session->userdata['role']=='merchant') {}
    $data['view_name'] = 'no';
    $data['webconf'] = $this->getDataRow('webconf', 'id', 1);
    return $data;
  }

  public function cDetailProduct($id)
  {
    $data['shipment'] = $this->db->query('select shipment_province, count(id) from view_detail_order where id_merchant= '.$this->session->userdata['id'].' group by shipment_province')->result();
    $data['attachment'] = $this->getSomeData('attachment', 'id_product', $id);
    $data['attachment1'] = $this->getSomeData('attachment', 'id_product', $id);
    $data['category'] = $this->getAllData('view_category');
    $data['product'] = $this->getDataRow('view_product', 'id', $id);
    $data['merchant'] = $this->getDataRow('merchant', 'id', $data['product']->id_merchant);
    $data['view_name'] = 'detailProduct';
    $data['webconf'] = $this->getDataRow('webconf', 'id', 1);
    return $data;
  }
}

?>
