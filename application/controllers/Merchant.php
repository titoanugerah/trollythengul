<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Merchant extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('merchant_model');
  }

  public function product()
  {
    if ($this->input->post('recoverProduct')) {$this->merchant_model->recoverProduct();}
    $this->load->view('template', $this->merchant_model->cProduct());
  }

  public function detailMyProduct($id)
  {
    if($this->input->post('addImage')){$this->merchant_model->addImage($id);}
    elseif($this->input->post('deleteAttachment')){$this->merchant_model->deleteAttachment($id);}
    elseif($this->input->post('deleteProduct')){$this->merchant_model->deleteProduct($id);}
    elseif($this->input->post('updateProduct')){$this->merchant_model->updateProduct($id);}
    $this->load->view('template', $this->merchant_model->cDetailMyProduct($id));
  }

  public function addProduct()
  {
    if($this->input->post('addProduct')){$this->merchant_model->addProduct();}
    $this->load->view('template', $this->merchant_model->cAddProduct());
  }

  public function setDefaultImage($id_product, $id_attachment)
  {
    $this->merchant_model->setDefaultImage($id_product, $id_attachment);
  }

  public function order()
  {
    if($this->input->post('acceptOrder')){$this->merchant_model->acceptOrder();}
    if($this->input->post('declineOrder')){$this->merchant_model->acceptOrder();}
    if($this->input->post('confirmSent')){$this->merchant_model->confirmSent();}
    $this->load->view('template', $this->merchant_model->cOrder());
  }

  public function downloadRecap()
  {
    $this->merchant_model->downloadRecap();
  }

}
?>
