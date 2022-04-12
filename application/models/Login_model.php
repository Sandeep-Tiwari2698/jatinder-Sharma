<?php
class Login_model extends CI_Model{
 
  function validate($email,$password){
    $this->db->where('user_email',$email);
    $this->db->where('user_password',$password);
    $result = $this->db->get('tbl_users',1);
    return $result;
  }
  function saverecords($data)
	{
        $this->db->insert('tbl_users',$data);
        return true;
	}

  function updateUser($id, $data)
  {

      //print_r($id);

      //die;
       $this->db->where('user_id',$id);
        $this->db->update('tbl_users',$data);

        //$this->db->last_query();
       
  }
  public function displayuser(){
    $query=$this->db->query("select * from tbl_users");
    return $query->result();
  }
  public function delete($id){
    $this->db->where('user_id',$id);
    $this->db->delete('tbl_users');
  }
  public function displayproduct(){
    $query=$this->db->query("select * from tbl_products");
    return $query->result();
  }
  public function addpd($insert){
    $this->db->insert('tbl_products',$insert);
  }
   public function delete_pd($id){
    $this->db->where('id',$id);
    $this->db->delete('tbl_products');
  }
  public function pd_id($id){
    $this->db->where('id',$id);
    return $user = $this->db->get('tbl_products')->row_array();
  }
  public function upd_prod($insert,$id){
    $this->db->where('id',$id);
    $this->db->update('tbl_products',$insert);
  }
  //count all active user 
   public function getActiveUser(){
    $this->db->select('status');
    $this->db->from('tbl_users');
    $this->db->where('status',1);
    $this->db->like('user_level','user');
    return $this->db->count_all_results();
  }
  // count who user belongs product: 
   public function getActiveUserProducts(){
     $this->db->select('cart_data');
     $this->db->from("tbl_users");
     $this->db->where('cart_data != ""');
     $this->db->like('user_level','user');
     return $this->db->count_all_results();
    
  }
   // count  who user not belongs to product: 
   public function getNullProducts(){
     $this->db->select('cart_data');
     $this->db->from("tbl_users");
     $this->db->where('cart_data',0);
     $this->db->like('user_level','user');
     return $this->db->count_all_results();
    
  }
   // count  who user  belongs to cart products: 
   public function getUserAttachedProducts(){
      $this->db->where('status', '1');
      $query = $this->db->get('tbl_products');
      return $query->result();
  }
   public function getUserProducts(){
      $query = $this->db->get('tbl_users');

      return $query->result();
  }
  public function getActiveusrProducts($pids){

    //echo '<pre>';

    //print_r($pids);


     $this->db->select('COUNT(*) as total_result');
     $this->db->from("tbl_products");
     $this->db->where_in('id', $pids);
     $this->db->where('status', '1');
     // $this->db->like('user_level','user');
      $result = $this->db->get()->row_array();
      //echo $this->db->last_query();
        //return $query->result();

      return $result;
      
      
     // die();
  }

}