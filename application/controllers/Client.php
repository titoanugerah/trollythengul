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

  public function goToPayment($id)
  {
    $this->load->view('template', $this->client_model->cGoToPayment($id));
  }
}


 ?>
