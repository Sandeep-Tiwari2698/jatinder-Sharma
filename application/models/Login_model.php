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
    $this->db->get('tbl_products',$insert);
  }
 
}