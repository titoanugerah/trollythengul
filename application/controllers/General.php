<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class General extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('general_model');
    $this->load->model('admin_model');
    $this->load->model('client_model');
    error_reporting(0);
  }

  public function index()
  {
    $this->shopPage();
  }

  public function shopPage()
  {
    $page = 0;$keyword = null;
    if ($this->input->post('nextPage')) {$page = $page+1;}
    elseif($this->input->post('prevPage') && $page!=0){$page=$page-1;}
    elseif ($this->input->post('keyword')) {$keyword = $this->input->post('keyword');}
    $this->load->view('template', $this->general_model->cShopPage($keyword, $page));
  }

  public function login()
  {
    if ($this->session->userdata['login']) {redirect(base_url('shopPage'));}
    elseif ($this->input->post('loginValidation')) {$login = $this->general_model->loginValidation();if ($login['status']) {$this->session->set_userdata($login['session']); redirect(base_url('shopPage'));}}
    elseif($this->input->post('register')){$this->general_model->register();}
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
    elseif($this->input->post('register')){$this->general_model->register();}
    //  $this->session->set_userdata($content['captcha']);
    $this->load->view('forgotPassword', $this->general_model->cForgotPassword());
  }

  public function dashboard()
  {
    $this->load->view('template', $this->general_model->cDashboard());
  }

  public function detailProduct($id)
  {
    if ($this->input->post('addToCart')) {$this->client_model->addToCart($id);}
    $this->load->view('template', $this->general_model->cDetailProduct($id));

  }

}

?>
