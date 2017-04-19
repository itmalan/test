<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member_Model extends CI_Model
{
    
        var $table = 'users';
	var $column_order = array('first_name','username','created','role','status',null); //set column field database for datatable orderable
	var $column_search = array('first_name','username','role'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('role' => 'asc'); // default order 
        
     function __construct()
     {
         $this->tableName = 'users';
        $this->primaryKey = 'id';
        
          // Call the Model constructor
          parent::__construct();
        
     }

     //get the username & password from tbl_usrs
     function get_user($usr, $pwd)
     {
         $sql = "select * from users where username = '" . $usr . "' and password = '" . md5($pwd) . "' and status = 'active'";
          $query = $this->db->query($sql);
          return $query->num_rows();
     } 
     
     
       function check($usr, $pwd){
         $condition = "username =" . "'" . $usr . "' AND " . "password =" . "'" . md5($pwd) . "' and status = 'active'";
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
     }
     
     function get_role($id){
                $this->db->select('name');
                $this->db->from('user_role');
		$this->db->where('role',$id);
		$query = $this->db->get();

		return $query->row();
         
     }
     
     function get_FacultyNames($dept){
                $this->db->select(array('first_name','id'));
                $this->db->from('users');
		$this->db->where(array('dept'=>$dept,'role'=>'3'));
		$query = $this->db->get();

		return $query->result_array();
         
     }
     
     function get_userDetails($username)
     {
         
                $this->db->from($this->table);
		$this->db->where('username',$username);
		$query = $this->db->get();

		return $query->row();
     } 
     function get_hod_name($dept){
                $this->db->from($this->table);
                $this->db->select('first_name');
		$this->db->where('dept',$dept);
                $this->db->where('role',2);
		$query = $this->db->get();

		return $query->row();
         
     }
     
     
     // For Ajax listing
     
	private function _get_datatables_query()
	{
		
		$this->db->from($this->table);

		$i = 0;
	
		foreach ($this->column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
                $dept = $this->session->userdata['mms']['dept'];
                $this->db->where('dept',$dept);
                
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
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