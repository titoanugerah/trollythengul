<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model('admin_model');
  }

  public function category()
  {
    if ($this->input->post('createCategory')) {$this->admin_model->createCategory();}
    elseif ($this->input->post('updateCategory')) {$this->admin_model->updateCategory();}
    elseif ($this->input->post('deleteCategory')) {$this->admin_model->deleteCategory();}
    elseif ($this->input->post('recoverCategory')) {$this->admin_model->recoverCategory();}
    $this->load->view('template', $this->admin_model->cCategory());
  }

  public function promote()
  {
    if($this->input->post('addPromote')){$this->admin_model->addPromote();}
    elseif($this->input->post('deletePromote')){$this->admin_model->deletePromote();}
    elseif($this->input->post('updatePromote')){$this->admin_model->updatePromote();}
    $this->load->view('template', $this->admin_model->cPromote());
  }

  public function promo()
  {
    if ($this->input->post('createPromo')) {$this->admin_model->createPromo();}
    elseif ($this->input->post('updatePromo')) {$this->admin_model->updatePromo();}
    elseif ($this->input->post('activate')) {$this->admin_model->activatePromo();}
    elseif ($this->input->post('nonactivate')) {$this->admin_model->nonactivatePromo();}
    $this->load->view('template', $this->admin_model->cPromo());
  }

  public function webconf()
  {
    if ($this->input->post('updateInfo')) {$this->admin_model->updateInfo();}
    elseif ($this->input->post('updateEmail')) {$this->admin_model->updateEmail();}
    $this->load->view('template', $this->admin_model->cWebconf());
  }

  public function account($id)
  {
    $this->load->view('template', $this->admin_model->cAccount($id));
  }

  public function detailAccount($role, $id)
  {
    if ($this->input->post('deactivateAccount')) {$this->admin_model->deactivateAccount($id);}
    elseif ($this->input->post('activateAccount')) {$this->admin_model->activateAccount($id);}
    elseif ($this->input->post('resetPassword')) {$this->admin_model->resetPassword($id);}
    $this->load->view('template', $this->admin_model->cDetailAccount($role,$id));
  }

  public function paymentVerification()
  {
    if ($this->input->post('approvePayment')) {$this->admin_model->approvePayment();}
    elseif ($this->input->post('approvePayment')) {$this->admin_model->approvePayment();}
    $this->load->view('template', $this->admin_model->cPaymentVerification());
  }

  public function redeemMerchant()
  {
    $this->load->view('template', $this->admin_model->cRedeemMerchant());
  }

  public function redeem($id)
  {
    $this->admin_model->redeem($id);
  }

  public function downloadReport()
  {
    $this->admin_model->downloadReport();
  }

}


 ?>
