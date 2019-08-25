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

  public function getSomeData($table, $whereVar, $whereVal)
  {
    return $this->db->get_where($table, $where = array($whereVar => $whereVal))->result();
  }

  public function deleteData($table, $whereVar, $whereVal)
  {
    return $this->db->delete($table, $where = array($whereVar => $whereVal ));
  }

  public function getNumRow2($table, $whereVar1, $whereVal1, $whereVar2, $whereVal2)
  {
    return $this->db->get_where($table, $where = array($whereVar1 => $whereVal1,$whereVar2 => $whereVal2))->num_rows();
  }

  public function getSomeData2($table, $whereVar1, $whereVal1, $whereVar2, $whereVal2)
  {
    return $this->db->get_where($table, $where = array($whereVar1 => $whereVal1,$whereVar2 => $whereVal2))->result();
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

  public function createLog($status, $code, $actor, $info = array())
  {
    if ($status==3 && $code=='a') {
      $data = array(
      'id_order' => $info['id_order'],
      'id_detail_order' => $info['id_detail_order'],
      'log' => $this->session->userdata['merchant'].' sebagai admin telah melakukan mengkonfirmasi pemesanan'
      );
    }
    $this->db->insert('log', $data);
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
    $data['deleted'] = $this->getSomeData2('view_product', 'id_merchant', $this->session->userdata['id'], 'status', 0);
    $data['view_name'] = 'product';
    $data['webconf'] = $this->getDataRow('webconf', 'id', 1);
    return $data;
  }

  public function recoverProduct()
  {
    $this->updateData('product', 'id', $this->input->post('id'), 'status', 1);
    notify('Sukses', 'Proses pengembalian produk yang terhapus berhasil dilakukan', 'success', 'fas fa-check', null);
  }

  public function deleteProduct()
  {
    if (md5($this->input->post('password'))==$this->session->userdata['password']) {$this->updateData('product', 'id', $this->input->post('id'), 'status', 0);notify('Sukses', 'Proses pengembalian produk yang terhapus berhasil dilakukan', 'success', 'fas fa-check', null);}
    else {notify('Gagal', 'Proses penghapusan produk gagal, password yang anda masukan tidak cocok', 'danger', 'fas fa-user-times', null);}
  }

  public function cDetailMyProduct($id)
  {
    if ($this->getNumRow('attachment', 'id_product', $id)==0) {
      $data['attachment'] = $this->getSomeData('attachment', 'id', 0);
    } else {
      $data['attachment'] = $this->getSomeData('attachment', 'id_product', $id);
    }
    $data['shipment'] = $this->db->query('select shipment_province, count(id) from view_detail_order where id_merchant= '.$this->session->userdata['id'].' group by shipment_province')->result();
    $data['category'] = $this->getAllData('view_category');
    $data['product'] = $this->getDataRow('view_product', 'id', $id);
    $data['merchant'] = $this->getDataRow('view_merchant', 'id', $data['product']->id_merchant);
    $data['view_name'] = 'detailMyProduct';
    $data['webconf'] = $this->getDataRow('webconf', 'id', 1);
    return $data;
  }

  public function cAddProduct()
  {
    $data['category'] = $this->getAllData('view_category');
    $data['view_name'] = 'addProduct';
    $data['webconf'] = $this->getDataRow('webconf', 'id', 1);
    return $data;
  }

  public function addProduct()
  {
    $data = array(
    'name' => $this->input->post('name'),
    'id_category' => $this->input->post('id_category'),
    'price' => $this->input->post('price'),
    'description' => $this->input->post('description'),
    'weight' => $this->input->post('weight'),
    'size_length' => $this->input->post('size_length'),
    'size_width' => $this->input->post('size_width'),
    'size_height' => $this->input->post('size_height'),
    'id_merchant' => $this->session->userdata['id'],
    'status' => 1,
    'id_attachment' => 'no.jpg'
    );
    $this->db->insert('product', $data);
    notify('Sukses', 'Proses penambahan berhasil dilakukan, silahkan tambahkan gambar pada kolom gambar', 'success', 'fas fa-plus', 'detailMyProduct/'.$this->db->insert_id());
  }

  public function addImage($id)
  {
    $this->db->insert('attachment', $data = array('id_product' => $id, 'id_account' => $this->session->userdata['id'] ));
    $this->updateData('attachment', 'id', $this->db->insert_id(), 'image', 'image_'.$this->db->insert_id().$this->uploadFile('image_'.$this->db->insert_id(),'jpg|png')['ext']);
    $this->updateData('product', 'id', $id, 'id_attachment', $this->db->insert_id());
    notify('Sukses', 'Proses penambahan gambar berhasil dilakukan', 'success', 'fas fa-plus', 'detailMyProduct/'.$id);
  }

  public function deleteAttachment($id)
  {
    if (md5($this->input->post('password'))==$this->session->userdata['password']) {
      unlink(base_url('./assets/upload/'.$this->getDataRow('attachment', 'id', $this->input->post('id'))->image));
      $this->deleteData('attachment', 'id', $this->input->post('id'));
      if ($this->getNumRow2('product', 'id', $id, 'id_attachment', $this->input->post('id')) && ($this->getNumRow('attachment', 'id_product', $id)>0)) {
        $this->updateData('product', 'id', $id, 'id_attachment', $this->getSomeData('attachment', 'id_product', $id)[0]->id);
      } elseif ($this->getNumRow2('product', 'id', $id, 'id_attachment', $this->input->post('id')) && ($this->getNumRow('attachment', 'id_product', $id)==0)) {
        $this->updateData('product', 'id', $id, 'id_attachment', 0);
      }
      notify('Sukses', 'Proses penghapusan gambar berhasil dilakukan', 'success', 'fas fa-plus', 'detailMyProduct/'.$id);
    } else {
      notify('Gagal', 'Proses penghapusan produk gagal, password yang anda masukan tidak cocok', 'danger', 'fas fa-user-times', 'detailMyProduct/'.$id);
    }
  }

  public function setDefaultImage($id_product,$id_attachment)
  {
    $this->updateData('product', 'id', $id_product, 'id_attachment', $id_attachment);
    notify('Sukses', 'Proses pemilihan gambar berhasil dilakukan', 'success', 'fas fa-plus', 'detailMyProduct/'.$id_product);
  }

  public function updateProduct($id)
  {
    $data = array(
    'name' => $this->input->post('name'),
    'id_category' => $this->input->post('id_category'),
    'price' => $this->input->post('price'),
    'description' => $this->input->post('description'),
    'weight' => $this->input->post('weight'),
    'size_length' => $this->input->post('size_length'),
    'size_width' => $this->input->post('size_width'),
    'size_height' => $this->input->post('size_height'),
    );
    $this->db->where($where = array('id' => $id ));
    $this->db->update('product', $data);
  }

  public function cOrder()
  {
    $data['order'] = $this->getSomeData('view_detail_order', 'id_merchant', $this->session->userdata['id']);
    $data['view_name'] = 'order';
    $data['webconf'] = $this->getDataRow('webconf', 'id', 1);
    return $data;
  }

  public function acceptOrder()
  {
    $this->updateData('detail_order', 'id', $this->input->post('id'), 'status', 3);
    $order = $this->getDataRow('view_detail_order', 'id', $this->input->post('id'));
    $content = 'Bersamaan dengan email ini kami sampaikan bahwa terkait pesananan '.$this->input->post('product').', pihak toko telah mengkonfirmasi pesanan anda ';
    $this->sentEmail($order->email, $order->fullname, 'Pesanan anda sudah dikonfirmasi toko', $content);
    $data['id_detail_order'] = $this->input->post('id');
    $data['id_order'] = $order->id_order;
    $this->createLog(3,'a', $this->session->userdata['merchant'], $data);
    notify('Sukses', 'Pesanan sudah dikonfirmasi', 'success', 'fas fa-plus', 'order');
  }
}

?>
