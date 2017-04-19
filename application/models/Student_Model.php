
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Student_Model extends CI_Model
{
    
        var $table = 'students';
	var $column_order = array('name','reg_number','year_joined',null); //set column field database for datatable orderable
	var $column_search = array('name','reg_number','year_joined'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('name' => 'asc'); // default order 
        
     function __construct()
     {
         $this->tableName = $this->table;
        $this->primaryKey = 'id';
        $this->load->model('Mark_Model','mark');
        
          // Call the Model constructor
          parent::__construct();
        
     }
     
     public function get_students($course_id){
                $this->db->from($this->table);
		$this->db->where('course_id',$course_id);
                
		$query = $this->db->get();

		return $query->result_array();   
     }
     public function get_students_by_where($where){
                $this->db->from($this->table);
		$this->db->where($where);
                
		$query = $this->db->get();

		return $query->result();   
     }
     
      public function get_students_fields($course_id, $fields){
                $this->db->from($this->table);
                $this->db->select($fields);
		$this->db->where('course_id',$course_id);
                
		$query = $this->db->get();

		return $query->result_array();   
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
        
        
        function get_datatables_enrolled($data)
	{
            $this->db->from($this->table);
            $this->db->select(array('students.id','students.name','students.reg_number','students.year_joined','marks.subject_id'));
             $this->db->where('students.course_id',$data['course_id']); 
             $this->db->where('students.dept_id',$data['dept_id']);
             $this->db->where('marks.semester',$data['semester']);
             $this->db->join('marks', 'marks.reg_number = students.reg_number','LEFT');
		$query = $this->db->get();
		return $query->result();
	}
        
       
       function get_students_list($dept_id)
	{
           $this->db->where(array('dept_id'=>$dept_id));
            $this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
                
		$query = $this->db->get();
		return $query->result();
	}
        
        function check_subject_allocated_status($data){
            //$year=date('Y',time());
            $year=$data['year'];
            $this->db->from('marks');
            $this->db->where('year',$year);
            $this->db->where('semester',$data['semester']);
            $this->db->where('course_id',$data['course_id']);
            return $this->db->get()->num_rows();
        }
        
        function allocate_hardcore_subjects($data){
            //$year=date('Y',time());
            $year=$data['year'];
            
            
            
            $this->db->from('subjects');
            $this->db->select('id');
            $this->db->where('course_id',$data['course_id']);
            $this->db->where('core','H');
            $this->db->where('semester',$data['semester']);

            //Getting all subjetcs
            $subjects=$this->db->get()->result();
            //echo '<pre>'.print_r($subjects).'</pre>';
            
            //Getting all students
            $this->db->from('students');
            $this->db->select('reg_number');
            $this->db->where('course_id',$data['course_id']);
            $this->db->where('dept_id',$data['dept_id']);
            $this->db->where('year_joined',$year );
            $students=$this->db->get()->result();
            
            //$combined_data=array();
            //$i=0;
            foreach($students as $student){
                foreach($subjects as $subject){
                    $data=array(
                        'subject_id'=>$subject->id,
                        'reg_number'=>$student->reg_number,
                        'year'=>$year,
                        'semester'=>$data['semester'],
                        'course_id'=>$data['course_id'],
                        
                            );
                    $this->mark->save($data);
                    //echo print_r($data);
                }
            } 
            
            //$this->mark->initialize_marks($combined_data);
           
        }
        
        function allocate_softcore_subjects($data){

            $student=$this->get_by_id($data['student_id']);
            
             $data=array(
                        'subject_id'=>$data['subject_id'],
                        'reg_number'=>$student->reg_number,
                        'year'=>$student->year_joined,
                        'semester'=>$data['semester'],
                        'course_id'=>$student->course_id,
                        
                 );
             $this->mark->save($data);
             
        }
        
        
        /*
         * 
         * 
         * 
         * 
         */

        function isFinalized($course_id){
            $this->db->from($this->table);
            $this->db->select('finalized');
            $this->db->where(array('course_id'=>$course_id));
            $query = $this->db->get();
            return $query->row();
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
        
        public function update_all($course_id)
	{
            $this->table='students';
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


}?>