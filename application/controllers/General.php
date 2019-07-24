<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class General extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('general_model');
    $this->load->model('admin_model');
    error_reporting(0);
  }

  public function index()
  {
    $this->shopPage();
  }

  public function shopPage()
  {
    $content = $this->general_model->cShopPage();
    $this->load->view('template', $content);
  }

  public function login()
  {
    if ($this->session->userdata['login']) {redirect(base_url('shopPage'));}
    elseif ($this->input->post('loginValidation')) {$login = $this->general_model->loginValidation();if ($login['status']) {$this->session->set_userdata($login['session']); redirect(base_url('shopPage'));}}
    $this->load->view('login', $this->general_model->cLogin());
  }

  public function profile()
  {
    if ($this->input->post('updateAccount')) {$this->session->set_userdata($this->general_model->updateAccount());}
    elseif ($this->input->post('uploadDP')) {$this->session->set_userdata($this->general_model->uploadDP());}
    $this->load->view('template',$this->general_model->cProfile());
  }

  public function detailPromo($id)
  {
//    if ($this->input->post('createPromo')) {$this->admin_model->createPromo();}
//    elseif ($this->input->post('uploadDP')) {$this->session->set_userdata($this->general_model->uploadDP());}
    $this->load->view('template',$this->general_model->cDetailPromo($id));
  }

  public function logout()
  {
    $this->session->sess_destroy();
    redirect(base_url(''));
  }

  public function forgotPassword()
  {
    if($this->input->post('resetPassword')){$this->general_model->resetPassword();}
    $data['content'] = $this->general_model->cForgotPassword();
    $this->session->set_userdata($content['captcha']);
    $this->load->view('forgotPassword', $data);
  }

  public function dashboard()
  {
    $this->load->view('template', $this->general_model->cDashboard());
  }
}

?>
