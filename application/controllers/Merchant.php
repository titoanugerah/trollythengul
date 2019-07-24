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
}
?>
