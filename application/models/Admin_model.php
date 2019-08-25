<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin_model extends CI_Model
{

  function __construct()
  {
    error_reporting($this->db->get_where('webconf', $where = array('id' => 1))->row('developer_mode'));
  }

  //CORE
  public function getAllData($table)
  {
    return $this->db->get($table)->result();
  }

  public function getAllDataWR($table, $limit)
  {
    return $this->db->query('select * from '.$table.' order by id desc limit '.(($limit-1)*50).','.($limit*50))->result();
  }

  public function getSomeData($table, $whereVar, $whereVal)
  {
    return $this->db->get_where($table, $where = array($whereVar => $whereVal))->result();
  }

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
    return $upload;
  }

  //functional
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

  public function createLog($status, $code, $actor, $info = array())
  {
    if ($status==2 && $code=='a') {
      $data = array(
        'id_order' => $info['id_order'],
        'id_detail_order' => $info['id_detail_order'],
        'log' => $this->session->userdata['fullname'].' sebagai admin telah melakukan verifikasi pembayaran'
     );
    }
    $this->db->insert('log', $data);
  }

  //APPLICATION
  public function cCategory()
  {
    if ($this->input->post('keyword')) {$keyword = $this->input->post('keyword');$data['category'] = $this->db->query('select * from category where name LIKE "%'.$keyword.'%" or description LIKE "%'.$keyword.'%"')->result();}
    else{$data['category'] = $this->getAllData('category');}
    $data['product'] = $this->getAllData('view_product');
    $data['detailCategory'] = $this->getAllData('view_category');
    $data['view_name'] = 'category';
    $data['webconf'] = $this->getDataRow('webconf', 'id', 1);
    return $data;
  }

  public function createCategory()
  {
    if($this->db->insert('category',$data = array('name' => $this->input->post('name'), 'description' => $this->input->post('description'), 'id_admin' => $this->session->userdata['id'])))
    {notify('Sukses', 'Kategori '.$this->input->post('name').' berhasil disimpan','success','fas fa-check','category');}
  }

  public function updateCategory()
  {
    $this->updateData('category', 'id', $this->input->post('id'), 'name', $this->input->post('name'));
    $this->updateData('category', 'id', $this->input->post('id'), 'description', $this->input->post('description'));
    {notify('Sukses', 'Proses update kategori '.$this->input->post('name').' berhasil dilakukan','success','fas fa-check',null);}
  }

  public function deleteCategory()
  {
    if (md5($this->input->post('password'))==$this->session->userdata['password']){$this->updateData('category', 'id', $this->input->post('id'), 'status', 0); notify('Berhasil Terhapus', 'Kategori berhasil dihapus ', 'success', 'fas fa-trash', null);}
    else {notify('Gagal', 'Proses penghapusan kategori gagal, password yang anda masukan tidak cocok', 'danger', 'fas fa-user-times', null);}
  }

  public function recoverCategory()
  {
    $this->updateData('category', 'id', $this->input->post('id'), 'status', 1);
    notify('Restore Kategori Sukses', 'Proses pengembalian kategori terhapus sukses', 'success', 'far fa-laugh-beam',null);
  }

  public function cPromo()
  {
    if ($this->input->post('keyword')) {$keyword = $this->input->post('keyword');$data['promo'] = $this->db->query('select * from view_promo where promo LIKE "%'.$keyword.'%" or promo_code LIKE "%'.$keyword.'%" or description LIKE "%'.$keyword.'%"')->result();}
    else{$data['promo'] = $this->getAllData('view_promo');}
    $data['view_name'] = 'promo';
    $data['webconf'] = $this->getDataRow('webconf', 'id', 1);
    return $data;
  }

  public function createPromo()
  {
    if($this->getNumRow('promo','promo_code',$this->input->post('promo_code'))>0){notify('Gagal', 'Proses pembuatan promo gagal dikarenakan terdapat kode promo yang sama dengan database kami, silahkan ganti kode promo', 'danger', 'fas fa-search-minus', null);}
    elseif($this->getNumRow('promo','promo_code',$this->input->post('name'))>0){notify('Gagal', 'Proses pembuatan promo gagal dikarenakan terdapat nama promo yang sama dengan database kami, silahkan ganti nama promo', 'danger', 'fas fa-search-minus', null);}
    else{
      $this->db->insert('promo',$data = array('name' => $this->input->post('name'), 'promo_code' => $this->input->post('promo_code'), 'description' => $this->input->post('description'), 'discount' => $this->input->post('discount'), 'qty' => $this->input->post('qty'), 'id_admin' => $this->session->userdata['id'], 'date_expired' => $this->input->post('date_expired')));
      notify('Pembuatan Berhasil', 'Proses pembuatan promo '.$this->input->post('name').' berhasil dilakukan', 'success', 'fas fa-sign-language', null);
    }
  }

  public function updatePromo()
  {
    if ($this->input->post('qty')<$this->getDataRow('view_promo', 'id', $this->input->post('id'))->usage) {notify('Gagal', 'Proses update promo gagal dikarenakan jumlah ', 'danger', 'fas fa-search-minus', null);}
    elseif($this->getNumRow('promo','promo_code',$this->input->post('promo_code'))>1){notify('Gagal', 'Proses edit promo gagal dikarenakan terdapat kode promo yang sama dengan database kami, silahkan ganti kode promo', 'danger', 'fas fa-search-minus', null);}
    elseif($this->getNumRow('promo','promo_code',$this->input->post('name'))>1){notify('Gagal', 'Proses edit promo gagal dikarenakan terdapat nama promo yang sama dengan database kami, silahkan ganti nama promo', 'danger', 'fas fa-search-minus', null);}
    else {
      $data = array('name' => $this->input->post('name'), 'promo_code' => $this->input->post('promo_code'), 'description' => $this->input->post('description'), 'qty' => $this->input->post('qty'), 'discount' => $this->input->post('discount'), 'qty' => $this->input->post('qty'), 'date_expired' => $this->input->post('date_expired'));
      $this->db->where($where = array('id' => $this->input->post('id')));
      $this->db->update('promo', $data);
      notify('Update Berhasil', 'Proses edit promo '.$this->input->post('name').' berhasil dilakukan', 'success', 'fas fa-sign-language', null);
    }
  }

  public function activatePromo()
  {
    $this->updateData('promo', 'id', $this->input->post('id'), 'status', 1);
    notify('Update Berhasil', 'Proses pengaktifan promo '.$this->input->post('name').' berhasil dilakukan', 'success', 'fas fa-sign-language', null);
  }

  public function nonactivatePromo()
  {
    $this->updateData('promo', 'id', $this->input->post('id'), 'status', 0);
    notify('Update Berhasil', 'Proses penonaktifan promo '.$this->input->post('name').' berhasil dilakukan', 'success', 'fas fa-sign-language', null);
  }

  public function cWebconf()
  {
    $data['view_name'] = 'webconf';
    $data['webconf'] = $this->getDataRow('webconf', 'id', 1);
    return $data;
  }

  public function updateInfo()
  {
    $this->db->where($where = array('id' => 1));
    if($a = $this->db->update('webconf',$data = array('office_name' => $this->input->post('office_name'), 'office_address' => $this->input->post('office_address'), 'office_phone_number' => $this->input->post('office_phone_number'))))
    {notify('Update Berhasil', 'Proses perubahan informasi umum berhasil dilakukan', 'success', 'fas fa-sign-language', null);}
  }

  public function updateEmail()
  {
    $this->db->where($where = array('id' => 1));
    if($this->db->update('webconf',$data = array('host' => $this->input->post('host'), 'crypto' => $this->input->post('crypto'), 'port' => $this->input->post('port'), 'email' => $this->input->post('email'), 'password' => $this->input->post('password'))))
    {notify('Update Berhasil', 'Proses perubahan email berhasil dilakukan', 'success', 'fas fa-sign-language', null);}
  }

  public function cAccount($id)
  {
    $data['limit'] = $id;
    if ($this->input->post('keyword')) {$keyword = $this->input->post('keyword'); $data['account'] = $this->db->query('select * from account where username LIKE "%'.$keyword.'%" or fullname LIKE "%'.$keyword.'%" or email LIKE "%'.$keyword.'%" order by id desc limit '.(($id-1)*50).','.($id*50))->result();}
    else {$data['account'] = $this->getAllDataWR('account',($id));}
    $data['view_name'] = 'account';
    $data['webconf'] = $this->getDataRow('webconf', 'id', 1);
    return $data;
  }

  public function cDetailAccount($role,$id)
  {
    $data['detail'] = $this->getDataRow('view_'.$role, 'id', $id);
    if ($role=='customer') {$data['order'] = $this->getSomeData('view_detail_order', 'id_customer', $id);$data['shipment'] = $this->db->query('select *, count(id) as shipment_count from view_detail_order where id_customer ='.$id.' group by shipment_street')->result();}
    elseif ($role=='merchant') {$data['order'] = $this->getSomeData('view_detail_order', 'id_merchant', $id);$data['shipment'] = $this->db->query('select shipment_province, count(id) as shipment_count from view_detail_order where id_merchant='.$id.' group by shipment_province')->result();}
    $data['view_name'] = 'detailAccount'.ucfirst($role);
    $data['webconf'] = $this->getDataRow('webconf', 'id', 1);
    return $data;
  }

  public function deactivateAccount($id)
  {
    if ($this->session->userdata['password'] == md5($this->input->post('password'))) {$this->updateData('account', 'id', $id, 'status', 0); notify('Sukses', 'Proses penonaktifan akun berhasil dilakukan', 'success', 'fas fa-user-slash',null);}
    else{notify('Gagal', 'Proses penonaktifan akun gagal, periksa kembali password yang anda masukan', 'danger', 'fab fa-forumbee', null);}
  }

  public function activateAccount($id)
  {
    if ($this->session->userdata['password'] == md5($this->input->post('password'))) {$this->updateData('account', 'id', $id, 'status', 1); notify('Sukses', 'Proses aktivasi akun berhasil dilakukan', 'success', 'fas fa-user-check',null);}
    else{notify('Gagal', 'Proses aktivasi akun gagal, periksa kembali password yang anda masukan', 'danger', 'fab fa-forumbee', null);}
  }

  public function resetPassword($id)
  {
    $newPassword = rand(100000,999999);
    $account = $this->getDataRow('account', 'id', $id);
    $content = 'bersamaan dengan email ini kami sampaikan bahwa proses reset password berhasil dilakukan, password baru anda adalah '.$newPassword;
    if ($this->session->userdata['password'] == md5($this->input->post('password')))
    {$this->updateData('account', 'id', $id, 'password', md5($newPassword)); notify('Sukses', 'Proses Reset Password akun berhasil dilakukan', 'success', 'fas fa-spinner',null); $this->sentEmail($account->email, $account->fullname, 'Reset Password Berhasil', $content);}
  }

  public function cPaymentVerification()
  {
    $data['order'] = $this->db->query('select * from view_order where status=1 order by id desc')->result();
    $data['view_name'] = 'paymentVerification';
    $data['webconf'] = $this->getDataRow('webconf', 'id', 1);
    return $data;
  }

  public function approvePayment()
  {
    $order = $this->getDataRow('view_order', 'id', $this->input->post('id'));
    $this->updateData('order', 'id', $this->input->post('id'), 'status', 2);
    $content = "bersamaan dengan email ini kami informasikan bahwa pembayaran anda sudah diverifikasi oleh pihak admin, selanjutnya tunggulah konfirmasi dari penjual";
    $content2 = "bersamaan dengan ini kami sampaikan bahwa terdapat 1 pesanan yang perlu dikonfirmasi, silahkan kunjugi website kami";
    $this->sentEmail($order->email, $order->fullname, 'Pembayaran kamu telah diverifikasi', $content);
    foreach ($this->getSomeData('view_detail_order', 'id_order', $order->id) as $item) {
      $merchant = $this->getDataRow('view_merchant', 'id', $item->id_merchant);
      $this->sentEmail($merchant->email, $merchant->fullname, 'Terdapat 1 pesanan menunggu konfirmasi', $content2);
      $data['id_order'] = $order->id;
      $data['id_detail_order'] = $item->id;
      $this->createLog(2, a, 'admin', $data );
    }

  }

}

 ?>
