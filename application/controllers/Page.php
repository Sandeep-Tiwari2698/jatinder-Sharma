<?php
class Page extends CI_Controller{
  function __construct(){
    parent::__construct();
     $this->load->model('Login_model');
    $this->load->model('Product');
    if($this->session->userdata('logged_in') !== TRUE){
      redirect('login');
    }
  }
 
  function index(){
    //Allowing akses to admin only
      if($this->session->userdata('level') =='admin'){
          $data['fetch'] = $this->Login_model->getActiveUser();
          $data['gets'] = $this->Login_model->getActiveUserProducts();
          $data['activeProducts'] = $this->Product->getActiveProducts();
          $data['nullProducts'] =  $this->Login_model->getNullProducts();

          $product['show'] = $this->Login_model->getUserAttachedProducts();
          $user['userget'] = $this->Login_model->getUserProducts();

          $a = $user['userget'];
          $pids= array();
          $sum =0;
          $add =0;
           foreach($a as $aa){
            if(!empty($aa->cart_data)){

             
            $prods = unserialize($aa->cart_data);
           
            //echo count($prods);

            if(is_array($prods)){
              foreach($prods as $ky=>$pval){
                $sum+= $pval['subtotal'];
                $pids[] = $pval['id'];
              }

                 $add+= $sum;
                  //print_r($sum);   
            }
           }

          }
          
         $result=  $this->Login_model->getActiveusrProducts(array_unique($pids));
         $data['user'] = $sum;
         $data['name'] = $result;
         $data['total'] = $add;
         
          $this->load->view('layout/header');
          $this->load->view('index',$data);
          $this->load->view('layout/footer');
      }else{
          echo "Access Denied";
      }
 
  }
 
  function staff(){
    //Allowing akses to staff only
    if($this->session->userdata('level') == 'user'){
      
           // $this->load->view('layout/header');
          $this->load->view('products/index');
          // $this->load->view('layout/footer');
          
    }else{
        echo "Access Denied";
    }
  }


}


 