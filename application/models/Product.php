<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends CI_Model{
    
    function __construct() {
        $this->proTable = 'tbl_products';
    }
    
    
    public function getRows($id = ''){
        $this->db->select('*');
        $this->db->from('tbl_products');
        $this->db->where('status', '1');
        if($id){
            $this->db->where('id', $id);
            $query = $this->db->get();
            $result = $query->row_array();
        }else{
            $this->db->order_by('name', 'asc');
            $query = $this->db->get();
            $result = $query->result_array();
        }
       
        return !empty($result)?$result:false;
    }
    public function getActiveProducts(){
        $this->db->select('*');
        $this->db->from("tbl_products");
        $this->db->where('status',1);
        return $this->db->count_all_results();

    }

    public function getActiveProduct($prodid){
        $this->db->select('COUNT(*) as total_row');
        $this->db->from("tbl_products");
        $this->db->where('status',1);
        $this->db->where('id',$prodid);
        $query = $this->db->get();

         //echo $this->db->last_query();

        $result = $query->row_array();
        return (int)$result['total_row']; 
    }
   

    
    
}