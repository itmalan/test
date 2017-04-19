
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subject_Model extends CI_Model
{
    
        var $table = 'subjects';
	var $column_order = array('name','course_code','credits',null); //set column field database for datatable orderable
	var $column_search = array('name','course_code','credits'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('id' => 'desc'); // default order 
        
     function __construct()
     {
         $this->tableName = $this->table;
        $this->primaryKey = 'id';
        
          // Call the Model constructor
          parent::__construct();
        
     }
     
     public function get_subjects($course_id){
                $this->db->from($this->table);
		$this->db->where('course_id',$course_id);
                
		$query = $this->db->get();

		return $query->result();   
     }
      public function get_subjects_all($course_id,$semester){

                $this->db->from($this->table);
		$this->db->where('course_id',$course_id);
                $this->db->where('semester',$semester);
		$query = $this->db->get();
                //echo $this->db->last_query();
		return $query->result();   
     }
     
     public function get_all_hardcore_subjects($course_id,$semester){

                $this->db->from($this->table);
		$this->db->where('course_id',$course_id);
                $this->db->where('semester',$semester);
                 $this->db->where('core','H');
		$query = $this->db->get();
                //echo $this->db->last_query();
		return $query->result();   
     }
      public function get_all_softcore_subjects($course_id){

                $this->db->from($this->table);
		//$this->db->where('course_id',$course_id);
                //$this->db->where('semester',$semester);
                 $this->db->where('core','S');
		$query = $this->db->get();
                //echo $this->db->last_query();
		return $query->result();   
     }
     
      public function get_subjects_array($id){
                $this->db->from($this->table);
                $this->db->select(array('name', 'credits','course_code'));
		$this->db->where('course_id',$id);
                
		$query = $this->db->get();
                return $query->result_array();
		//return $query->result_array();
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

	function get_datatables($course_id)
	{
             $this->db->where('course_id',$course_id);
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}
        
        
        function subject_allocation($data)
	{
           $this->table='subject_allocation';
           //check for already added
           $wheredata=array('subject_id'=>$data['subject_id'],'course_id'=>$data['course_id']);
           $this->db->from( $this->table);
           $this->db->where($wheredata);
           $query = $this->db->get();
           if($query->num_rows()<1){
           $this->db->insert($this->table, $data);
		return $this->db->insert_id();
           }
           else{
               return $this->update($wheredata,array('user_id'=>$data['user_id']));
           }
	}
        
        function get_subject_allocated_details($subject_id)
        {
             $this->table='subject_allocation';
           //check for already added
           $wheredata=array('subject_id'=>$subject_id);
           $this->db->from( $this->table);
           //$this->db->select('user_id');
           $this->db->where($wheredata);
           $query = $this->db->get();

		return $query->row();
        }
        
        
        /*
         * 
         * 
         * Join Models
         * 
         */
       
        function get_allocated_subjects($faculty_id,$course_id){
            
            $this->db->from('subjects');
            $this->db->select(array('name','course_code','credits','subject_id'));
            $this->db->join('subject_allocation', 'subject_allocation.subject_id = subjects.id');
            $this->db->where(array('subject_allocation.user_id'=>$faculty_id));
            $this->db->where(array('subject_allocation.course_id'=>$course_id));
            //$this->db->where(array('category.id' => 10));
 
            $query = $this->db->get();
            return $query->result();
        }
        
        function get_allocated_subjects_by_courseid($course_id){
            
            $this->db->from('subjects');
            $this->db->select(array('name','course_code','credits','subject_id'));
            $this->db->join('subject_allocation', 'subject_allocation.subject_id = subjects.id');
            $this->db->where(array('subject_allocation.course_id'=>$course_id));
            //$this->db->where(array('category.id' => 10));
 
            $query = $this->db->get();
            return $query->result();
        }
        
        
        function get_student_list($subject_id){
            $this->db->select('*');
            $this->db->from('students');
      
            $this->db->where(array('marks.subject_id'=>$subject_id));
            $this->db->join('marks', 'marks.reg_number = students.reg_number','inner');

            $query = $this->db->get();
            return $query->result();  
        }
       
        
        
        /*
         * 
         * Regular Functions
         * 
         */

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
		//$this->db->from($this->table);
                $this->db->from('subjects');
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
        
         public function update_all($course_id)
	{
            $this->table='subject_allocation';
           //check for already added
           $data=array('finalized'=>TRUE);
           $where=array('course_id'=>$course_id);
           $this->db->from( $this->table);
            
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}


	public function delete_by_id($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->table);
	}
       

             public function delete_by_subjectid($subject_id)
	{
             $this->table='subject_allocation';
		$this->db->where('subject_id', $subject_id);
		$this->db->delete($this->table);
	}
}?>