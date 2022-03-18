<?php
class Page extends CI_Controller{
  function __construct(){
    parent::__construct();
    if($this->session->userdata('logged_in') !== TRUE){
      redirect('login');
    }
  }
 
  function index(){
    //Allowing akses to admin only
      if($this->session->userdata('level')==='admin'){
        $this->load->view('layout/header.php');
          $this->load->view('index');
          $this->load->view('layout/footer.php');
      }else{
          echo "Access Denied";
      }
 
  }
 
  function staff(){
    //Allowing akses to staff only
    if($this->session->userdata('level')==='user'){
      $this->load->view('layout/header.php');
          $this->load->view('index');
          $this->load->view('layout/footer.php');
    }else{
        echo "Access Denied";
    }
  }
 
}