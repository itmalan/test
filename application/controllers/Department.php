<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Department extends MY_Controller
{

     public function __construct()
     {
          parent::__construct();
    
          $this->load->library('session');
          $this->load->helper('url');
          $this->load->helper('html');
          $this->load->database();
          //load the login model
          $this->load->model('Department_Model','department');
          
          //$this->load->model('person_model','person');      
     }
     public function index(){
         $this->middle=('member/departments_view'); 
           $this->layout();
     }

          
     // Functions for the Controller
 
        public function getDepartments(){
            $list = $this->department->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $person) {
			$no++;
			$row = array();
			$row[] = $person->firstName;
			$row[] = $person->lastName;
			$row[] = $person->gender;
			$row[] = $person->address;
			$row[] = $person->dob;

			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$person->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$person->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->person->count_all(),
						"recordsFiltered" => $this->person->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
        }
     
     
        public function getDepartment_byId($id)
	{
            
            // For getting subject list
         $subjects=$this->subject->get_subjects($id);
         
         $this->data=$subjects;
         $this->middle=('course/subjects_view'); // passing middle to function. change this for different views.
         $this->layout();
		
           
	}  
        

}?>