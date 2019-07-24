<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Merchant_model extends CI_Model
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

  public function getAllData($table)
  {
    return $this->db->get($table)->result();
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
  public function cProduct()
  {
    $data['product'] = $this->getAllData('view_product');
    $data['view_name'] = 'product';
    $data['webconf'] = $this->getDataRow('webconf', 'id', 1);
    return $data;
  }

}

 ?>
