<?php
class Login extends CI_Controller{
  function __construct(){
    parent::__construct();
    $this->load->model('Login_model');
  }
 
  function index(){
    $this->load->view('login');
  }
 
  function auth(){
    $email    = $this->input->post('email',TRUE);
    $password = md5($this->input->post('password',TRUE));
    $validate = $this->Login_model->validate($email,$password);
    if($validate->num_rows() > 0){
        $data  = $validate->row_array();
        $name  = $data['user_name'];
        $email = $data['user_email'];
        $level = $data['user_level'];
        $sesdata = array(
            'username'  => $name,
            'email'     => $email,
            'level'     => $level,
            'logged_in' => TRUE
        );
        $this->session->set_userdata($sesdata);
        // access login for admin
        if($level === 'admin'){
            redirect('page');
 
        // access login for staff
        }elseif($level === 'user'){
            redirect('page/staff');
 
        // access login for author
        }else{
            redirect('page/author');
        }
    }else{
        echo $this->session->set_flashdata('msg','Username or Password is Wrong');
        redirect('login');
    }
  }
 
  function logout(){
      $this->session->sess_destroy();
      redirect('login');
  }

  public function register(){
    $this->load->view('register');
  }
  public function user_register(){
    $this->form_validation->set_rules('user_name', 'Name', 'required|trim');
  $this->form_validation->set_rules('user_email', 'Email Address', 'required|trim|valid_email|is_unique[tbl_users.user_email]');
  $this->form_validation->set_rules('user_password', 'Password', 'required');
  if($this->form_validation->run())
  {
   $data = array(
    'user_name'  => $this->input->post('user_name'),
    'user_email'  => $this->input->post('user_email'),
    'user_password' =>md5($this->input->post('user_password')),
    'user_level' => $this->input->post('user_level'),
   );
   $this->Login_model->saverecords($data);
   redirect('login');
    }
    else
     {
   $this->register();
      }
    }


  }
 
