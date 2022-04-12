<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller{
    
    function  __construct(){
        parent::__construct();
        $this->load->library('cart');
        $this->load->model('product');
    }
    
    function index(){
        $data = array();
        $data['products'] = $this->product->getRows();
        $this->load->view('products/index', $data);
    }
    
    function addToCart($proID){
        
        
        $product = $this->product->getRows($proID);
        // print_r($product);
        // die();
        
        $data = array(
            'id'    => $product['id'],
            'qty'    => 1,
            'price'    => $product['price'],
            'name'    => $product['name'],
            'image' => $product['image'],
            'status' => $product['status']

        );
         

         $query = $this->cart->insert($data);


         $items = $this->cart->contents();
         // print_r($items);
     
     /*       
        foreach($items as $item){
            $add_cart[$item['id']] = array(
            'id'    => $product['id'],
            'qty'    => $item['qty'],
            'price'    => $product['price'],
            'name'    => $product['name'],
            'image' => $product['image']
        );
            
    }

    */
        $this->session->set_userdata('cart', $items);

        redirect('cart/');
    }



        public function currency(){
               $data[] = '';
                $endpoint = 'latest';
                $access_key = '92c05c6deea28c99e532cfb424bd1c6b';

                // Initialize CURL:
                $ch = curl_init('http://api.exchangeratesapi.io/v1/'.$endpoint.'?access_key='.$access_key.'&base=EUR&symbols=USD,RON');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                // Store the data:
                $json = curl_exec($ch);
                curl_close($ch);
                // Decode JSON response:
                $exchangeRates = json_decode($json, true);
                // echo '<pre>';
                // print_r($exchangeRates);
                // echo '</pre>';
      

                //echo $result = $exchangeRates['rates'][$cur];
               //die();


                $this->load->view('newcur/currency',$data);
        
    }

    
}