<?php
class Excel_data_insert_model extends CI_Model {
 
    public function  __construct() {
        parent::__construct();
        
    }
	
public function Add_User($data_user){
$this->db->insert('students', $data_user);
   }
   
   public function Add_Subjects($data_subjects){
$this->db->insert('subjects', $data_subjects);
   }
   
    public function add_students($data_students){
$this->db->insert('students', $data_students);
   }
   function add_internal_marks($data,$where){
       $this->table='marks';
       $this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
       
   }
  
	
}
 
?>