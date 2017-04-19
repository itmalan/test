
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu_Model extends CI_Model
{
    
        var $table = 'menu';
	var $column_order = array('name',null); //set column field database for datatable orderable
	var $column_search = array('name','course_code'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('id' => 'desc'); // default order 
        
     function __construct()
     {
         $this->tableName = $this->table;
        $this->primaryKey = 'id';
        
          // Call the Model constructor
          parent::__construct();
        
     }
     
     public function get_MenuList($role){
                $this->db->from($this->table);
		$this->db->where('access',$role);
		$query = $this->db->get();
		return $query->result();
         
     }
     


     

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('id',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->table);
	}

}?>