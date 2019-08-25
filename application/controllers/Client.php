<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Client extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('client_model');
  }


  public function myCart()
  {
    if ($this->input->post('deleteFromCart')) {$this->client_model->deleteFromCart();}
    elseif ($this->input->post('updateDetailOrder')) {$this->client_model->updateDetailOrder();}
    $this->load->view('template', $this->client_model->cMyCart());
  }

  public function payment($id)
  {
    if ($this->input->post('setDestination')) {$this->client_model->setDestination($id);}
    elseif ($this->input->post('addPromo')) {$this->client_model->addPromo($id);}
    elseif ($this->input->post('deletePromo')) {$this->client_model->deletePromo($id);}
    elseif ($this->input->post('uploadPayment')) {$this->client_model->uploadPayment($id);}
    $this->load->view('template', $this->client_model->cPayment($id));
  }
}


 ?>
