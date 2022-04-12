<?php
class Login extends CI_Controller{
  function __construct(){
    parent::__construct();
    $this->load->model('Login_model');
     $this->load->library('cart');
    $this->load->model('Product');
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
        $user_id  = $data['user_id'];
        $name  = $data['user_name'];
        $email = $data['user_email'];
        $level = $data['user_level'];

        $cart_data = array();

        //if(isset($data['cart_data']) && strlen($data['cart_data'])){

            $cart_data = unserialize($data['cart_data']);
        //}

        $sesdata = array(
            'user_id' =>$user_id,
            'username'  => $name,
            'email'     => $email,
            'level'     => $level,
            'logged_in' => TRUE,
            'cart' => $cart_data
        );

        $this->session->set_userdata($sesdata);
        $this->cart->insert($cart_data);
        // $this->cart->update($cart_data);
        /*echo '<pre>';
        print_r($this->session->userdata());
        echo '</pre>';

        die;*/

        // access login for admin
        if($level === 'admin'){
            redirect('page');
 
        // access login for staff
        }elseif($level === 'user'){
            redirect('Cart/index');
 
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

         $cart= $this->session->userdata('cart');

          $user_id = $this->session->userdata('user_id');

         
          if(isset($cart)){

           $this->Login_model->updateUser($user_id, array('cart_data' =>serialize($cart)));
            $this->cart->update($cart);
          }  

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

  ////User Table/////
    public function users(){
      $result['data'] = $this->Login_model->displayuser();
      $this->load->view('layout/header');
      $this->load->view('admin_pages/usertab',$result);
      $this->load->view('layout/footer');
    }
    public function deleteuser($id){
      $this->Login_model->delete($id);
      
      $this->users();
    }

    /////Products////
    public function products(){
      $result['data'] = $this->Login_model->displayproduct();
      $this->load->view('layout/header');
      $this->load->view('admin_pages/product_tab',$result);
      $this->load->view('layout/footer');
    }
    public function add_prod(){


      if($this->input->post('submit')){
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 2000;
        $config['max_width'] = 1500;
        $config['max_height'] = 1500;

        $this->load->helper('file');
         $this->load->library('upload');
         $this->upload->initialize($config);

            if(!$this->upload->do_upload('image')){
                echo $this->upload->display_errors();
            }else{
              $img = $this->upload->data('file_name');
           
            $insert = array(
                'name'=> $this->input->post('name'),
                'image'=> $img,
                'price'=> $this->input->post('price'),
                'description'=> $this->input->post('description'),

            );
              $this->Login_model->addpd($insert);
               redirect('products');
            }

          }
    
     $this->load->view('layout/header');
      $this->load->view('admin_pages/addproduct');
     $this->load->view('layout/footer');
    }
    public function deleteproduct($id){
      $this->Login_model->delete_pd($id);
      $this->products();
    }
    public function productid($id){
      $data['fetch']=$this->Login_model->pd_id($id);
      $this->load->view('layout/header');
      $this->load->view('admin_pages/editproduct',$data);
     $this->load->view('layout/footer');
    }
    public function upd_pd(){
       if($this->input->post('submit')){
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 2000;
        $config['max_width'] = 1500;
        $config['max_height'] = 1500;

        $this->load->helper('file');
         $this->load->library('upload');
         $this->upload->initialize($config);

            if(!$this->upload->do_upload('image')){
                echo $this->upload->display_errors();
            }else{
              $img = $this->upload->data('file_name');
           
            $insert = array(
                'name'=> $this->input->post('name'),
                'image'=> $img,
                'price'=> $this->input->post('price'),
                'description'=> $this->input->post('description'),

            );
           
            $id = $this->input->post('id');
            $this->db->where('id',$id);
            $this->db->update('tbl_products',$insert); 
            
             redirect('products');
            }

          }
    
    
    }
     public function product_status_changed()
        {
           
            $id = $this->input->post('id');
            $status = $this->input->post('status');

            //check condition
            if($status == '1'){
                $user_status = '0';
            }
            else{
                $user_status = '1';
            }

            $data = array('status' => $user_status );

            $this->db->where('id',$id);
            $this->db->update('tbl_products', $data); 

            //Create success measage
            $this->session->set_flashdata('msg',"User status has been changed successfully.");
            $this->session->set_flashdata('msg_class','alert-success');

            return redirect('products');
        }




        public function pd_tb(){
            $data= [];
            $data['show'] = $this->Product_model->pd_data();
            $this->load->view('frontend/productpage',$data);
        }

          // show active user 
         public function showActiveUsers(){
           
            $data['fetch'] = $this->Login_model->getActiveUser();
            $this->load->view('index',$data);
        }
        
        

  }