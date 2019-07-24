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
    $this->load->view('template', $this->merchant_model->cProduct());
  }
}
?>
