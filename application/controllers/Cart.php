<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller{
    
    function  __construct(){
        parent::__construct();
        $this->load->library('cart');
         $this->load->model('product');
    }
    
    function index(){
        $data = array();

        $var = $this->cart->contents();//$this->session->userdata('cart'); 
        
        $data['cartItems'] = array();

        $exchange_rate = 1;
        $data['cur'] = 'EUR';

        if($this->input->post('cur')){
        
        $data['cur'] = $this->input->post('cur');
        $convert_to = $this->input->post('cur');

        $endpoint = 'latest';
        $access_key = '92c05c6deea28c99e532cfb424bd1c6b';

        $api_url= 'http://api.exchangeratesapi.io/v1/'.$endpoint.'?access_key='.$access_key.'&base=EUR&symbols='.$convert_to;


        $ch = curl_init($api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $json = curl_exec($ch);
        curl_close($ch);
        $exchangeRates = json_decode($json, true);
        
        if(isset($exchangeRates['rates'][$convert_to])){

            $exchange_rate = $exchangeRates['rates'][$convert_to];
         }
       }

       //echo $exchange_rate;

        foreach($var as $key => $prod){

            
            $prod_info = $this->product->getActiveProduct($prod['id']);

            
            if($prod_info == 1){

                $data['cartItems'][$key] = array('id'=>$prod['id'],
                     'qty'=>$prod['qty'],
                     'price'=>$prod['price'] * $exchange_rate,
                     'name'=>$prod['name'],
                     'image'=>$prod['image'],                                                
                     'rowid'=>$prod['rowid'],
                     'subtotal'=>$prod['subtotal'] * $exchange_rate
              ); 


            }



        }
        $data['exchan'] = $exchange_rate;

        $this->load->view('cart/index', $data);
    }
    
    
    function updateItemQty(){
        $update = 0;
        
        // Get cart item info
        $rowid = $this->input->get('rowid');
        $qty = $this->input->get('qty');
        
        // Update item in the cart
        if(!empty($rowid) && !empty($qty)){
            $data = array(
                'rowid' => $rowid,
                'qty'   => $qty
            );
            $update = $this->cart->update($data);
            $items = $this->cart->contents();
            $this->session->set_userdata('cart', $items);
        }
        
        // Return response
        echo $update?'ok':'err';
    }
    
    function removeItem($rowid){
        $remove = $this->cart->remove($rowid);
        redirect('cart/');
    }
    public function currency(){

               $data[] = '';

               $convert_to = $this->input->post('cur');

                $endpoint = 'latest';
                $access_key = '92c05c6deea28c99e532cfb424bd1c6b';

                $api_url= 'http://api.exchangeratesapi.io/v1/'.$endpoint.'?access_key='.$access_key.'&base=EUR&symbols='.$convert_to;


                $ch = curl_init($api_url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $json = curl_exec($ch);
                curl_close($ch);
                $exchangeRates = json_decode($json, true);
                echo '<pre>';
                print_r($exchangeRates);
                echo '</pre>';
                
                // echo $result = $exchangeRates['rates'][$cur];
                


                $this->load->view('Cart/index',$data);
        
    }
    
}