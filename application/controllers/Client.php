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
    $this->load->model('CLient_model');
  }


  public function myCart()
  {
    $this->load->view('template', $this->CLient_model->cMyCart());
  }
}


 ?>
