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
  public function cShopPage()
  {
    $data['view_name'] = 'no';
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
      $this->session->set_flashdata('notify', 'Kombinasi tidak cocok');
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
      $this->session->set_flashdata('notify', 'Password berhasil direset silahkan cek email anda');
    } else {
      $this->session->set_flashdata('notify', 'username yang anda berikan tidak tersedia, silahkan periksa kembali');
    }
  }

  public function cDashboard()
  {
    if ($this->session->userdata['role']=='merchant') {}
    $data['view_name'] = 'no';
    $data['webconf'] = $this->getDataRow('webconf', 'id', 1);
    return $data;

  }
}

?>
