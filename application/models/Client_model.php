<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Client_model extends CI_Model
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

  public function getDataRow2($table, $whereVar1, $whereVal1, $whereVar2, $whereVal2)
  {
    return $this->db->get_where($table, $where = array($whereVar1 => $whereVal1,$whereVar2 => $whereVal2))->row();
  }

  public function deleteData($table, $whereVar, $whereVal)
  {
    return $this->db->delete($table, $where = array($whereVar => $whereVal ));
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

  //APPLICATION
  public function cMyCart()
  {
    if ($this->getNumRow2('order', 'id_customer', $this->session->userdata['id'], 'status', 0)==0) {
      $this->db->insert('order',$content = array('id_customer' => $this->session->userdata['id'], 'status' => 0));
      $data['order'] = $this->getDataRow('view_order', 'id', $this->db->insert_id());
      $data['detailOrder'] = $this->getSomeData('view_detail_order', 'id_order', $this->db->insert_id());
      $data['statusDetailOrder'] = 0;
    } else {
      $data['order'] = $this->getDataRow2('view_order', 'id_customer', $this->session->userdata['id'], 'status', 0);
      $data['detailOrder'] = $this->getSomeData('view_detail_order', 'id_order', $data['order']->id);
      if ($this->getNumRow('view_detail_order', 'id_order', $data['order']->id)==0) {$data['statusDetailOrder'] = 0;}
      else{$data['statusDetailOrder'] = 1;}
    }
    $data['view_name'] = 'myCart';
    $data['webconf'] = $this->getDataRow('webconf', 'id', 1);
    return $data;
  }

  public function addToCart($id)
  {
    if ($this->getNumRow2('order', 'id_customer', $this->session->userdata['id'], 'status', 0)==0) {
      $this->db->insert('order',$content = array('id_customer' => $this->session->userdata['id'], 'status' => 0));
      $id_order = $this->db->insert_id();
    } else {
      $id_order = $this->getDataRow('order', 'id_customer', $this->session->userdata['id'], 'status', 0)->id;
    }
    $merchant = $this->getDataRow('product', 'id', $id);
    $this->db->insert('detail_order', $data = array('id_order' => $id_order, 'id_product' => $id, 'id_merchant' => $merchant->id_merchant, 'qty' => $this->input->post('qty'), 'price' => $merchant->price, 'special_request' => $this->input->post('special_request')));
    notify('Berhasil ditambahkan', 'Barang berhasil ditambahkan ke keranjang','success','fas fa-plus','myCart');
  }


  public function deleteFromCart()
  {
    $this->deleteData('detail_order', 'id', $this->input->post('id'));
    notify('Berhasil dihapus', 'Barang berhasil dihapus dari keranjang','success','fas fa-plus','myCart');
  }

  public function updateDetailOrder()
  {
    $this->updateData('detail_order', 'id', $this->input->post('id'), 'qty', $this->input->post('qty'));
    $this->updateData('detail_order', 'id', $this->input->post('id'), 'special_request', $this->input->post('special_request'));
    notify('Berhasil diupdate', 'Barang berhasil diupdate dari keranjang','success','fas fa-check','myCart');
  }

  public function cGoToPayment($id)
  {
    $data['order'] =$this->getDataRow('order', 'id', $id);
    $data['detailOrder'] = $this->getSomeData('view_detail_order', 'id_order', $id);
    $data['view_name'] = 'goToPayment';
    $data['webconf'] = $this->getDataRow('webconf', 'id', 1);
    return $data;

  }

}


 ?>
