<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Course extends MY_Controller
{

     var $userDetails;
     
     
     public function __construct()
     {
          parent::__construct();
    
          $this->load->library('session');
          $this->load->helper('form');
          $this->load->helper('url');
          $this->load->helper('html');
          $this->load->database();
          $this->load->library('form_validation');
          $this->load->library('table');
          //load the login model
          $this->load->model('Member_Model','user');
          $this->load->model('Course_Model','course');
          $this->load->model('Subject_Model','subject');
          $this->load->model('Subject_Allocation_Model','subject_allocation');
          
           if ($this->session->has_userdata('mms')){
                $this->userDetails=$this->session->userdata('mms');
                  $this->data['user']=$this->userDetails;
          }
          //$this->load->model('person_model','person');      
     }

     //View Functions
     public function home(){
         
         if ($this->_chk_user()&& $this->userDetails['role']==2){
         $this->index();
         }
         else
             $this->_base ();
     }
     //default view to load
     public function index(){
         if ($this->_chk_user()&& $this->userDetails['role']==2){
            $this->middle=('course/courses_view'); 
           $this->layout();
         }
         else
             $this->_base ();    
     }
     public function show_courses_view()
     {
          if ($this->_chk_user()&& $this->userDetails['role']==2){
            $this->middle=('course/courses_view'); 
           $this->layout();
         }
         else
             $this->_base ();
     }
     
          public function show_subjects_view($course_id)
     {
              //$course_id=$this->input->post('course_id');
              //$this->data['course_id']=$course_id;
              if ($this->_chk_user()&& ($this->userDetails['role']==2 || $this->userDetails['role']==4 )){
                    $this->data['course_id'] =$course_id;
                $this->data['course_title']=$this->course->get_by_id($course_id)->name;
            $this->middle=('course/show_subjects_view'); // passing middle to function. change this for different views.
           $this->layout();
             }
         else
             $this->_base();
     }
     
     public function subjects_allocation_view($course_id)
        {
            if($this->_chk_user() && ($this->userDetails['role']==2 || $this->userDetails['role']==4 )){
                 //$last = $this->uri->total_segments();
                //$course_id = $this->uri->segment($last);
                 $this->data['course_id'] =$course_id;
                $this->data['course_title']=$this->course->get_by_id($course_id)->name;
                
                
                $curMonth = date("m", time());
                $curHalf = ceil($curMonth/6);
                
                $subject_data1=array();
                $subject_data2=array();
                if($curHalf==1){

                    $this->data['data_set1'] = $this->_getSubjects_allocation($course_id,2);
                    $this->data['data_set1_sem']='II';

                    $this->data['data_set2']=$this->_getSubjects_allocation($course_id,4);
                    $this->data['data_set2_sem']='IV';
                       
                }
                else{
                    $this->data['data_set1'] = $this->_getSubjects_allocation($course_id,1);
                    $this->data['data_set1_sem']='I';

                    $this->data['data_set2']=$this->_getSubjects_allocation($course_id,3);
                    $this->data['data_set2_sem']='III';

                }
                    //$this->data['subjects']=$this->_getSubjects_allocation($course_id,1);
                    //$this->data['subjects']=$this->_getSubjects_allocation($course_id,3);
                $this->data['subjects_data1']=$subject_data1;
                 $this->data['subjects_data2']=$subject_data2;
                
                $this->middle=('course/subjects_allocation_view'); // passing middle to function. change this for different views.
                $this->layout();
            }
            else
                $this->_base();
         }
     
     
     // Functions for the Controller
 
     
     
        public function get_courses_fn()
	{
         
             if ($this->_chk_user()&& ($this->userDetails['role']==2 || $this->userDetails['role']==4 )){
            // For getting course list
            
		$list = $this->course->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $course) {
                   
			$no++;
			$row = array();
			$row[] = $course->name;
			$row[] = $course->course_code;

			//add html for action
			//$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_user('."'".$course->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
			//	  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="delete_user('."'".$course->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
		
			$data[] = $row;
                    
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->course->count_all(),
						"recordsFiltered" => $this->course->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
             }
           else
             $this->_base ();
	}  
     
        
        
        public function get_subjects_fn($course_id)
	{
            /*
            // For getting subject list
         $subjects=$this->subject->get_subjects($id);
         
         $this->data=$subjects;
         $this->middle=('course/subjects_view'); // passing middle to function. change this for different views.
         $this->layout();
             * */
             

            
            // For getting course list
            
            
            if ($this->_chk_user()&& ($this->userDetails['role']==2 || $this->userDetails['role']==4 )){
		$list = $this->subject->get_datatables($course_id);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $subject) {
                   
			$no++;
			$row = array();
			$row[] = $subject->name;
			$row[] = $subject->course_code;
                        $row[] = $subject->credits;
                        $row[] = $subject->semester;
                        $row[] = $subject->core;

			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_subjectForm('."'".$subject->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="delete_subjectForm('."'".$subject->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
		
			$data[] = $row;
                    
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->subject->count_all(),
						"recordsFiltered" => $this->subject->count_filtered(),
						"data" => $data,
                                                "course_title"=>$this->course->get_by_id($course_id)->name
                                                
				);
		//output to json format
               
                
		echo json_encode($output);
                //$course_id='test';
               
            }
            else
             $this->_base ();
           
	}  
        
        public function add_subject_fn($course_id)
	{
            if ($this->_chk_user()&& ($this->userDetails['role']==2 || $this->userDetails['role']==4 )){
            $this->_validate();
           
            
		//$this->_validate();
		$data = array(
				'name' => $this->input->post('subject_title'),
				'course_code' => $this->input->post('course_code'),
				'credits' => $this->input->post('credits'),
                                'semester' => $this->input->post('semester'),
                                'core' => $this->input->post('core'),
                                'course_id'=>$course_id,
                                
			);
		$insert = $this->subject->save($data);
		echo json_encode(array("status" => TRUE));
                }
        }
        
       public function edit_subject_fn($id)
	{
              if($this->_chk_user() && ($this->userDetails['role']==2 || $this->userDetails['role']==4 ) ){
		$data = $this->subject->get_by_id($id);
		//$data->created = ($data->created == '0000-00-00') ? '' : $data->created; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
                    }
                    else{
                        echo 'Invalid access';
                    }
	}
        
        public function update_subject_fn()
	{
            if($this->_chk_user() && $this->userDetails['role']==2 && !empty($this->input->post())){
		$this->_validate();
		$data = array(
				'name' => $this->input->post('subject_title'),
				'course_code' => $this->input->post('course_code'),
                                'credits' => $this->input->post('credits'),
                                'semester' => $this->input->post('semester'),
                                'core' => $this->input->post('core'),
			);
		$this->subject->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
                }
            else
             $this->_base();
	}
        
        public function delete_subject_fn($subject_id){
            $this->subject->delete_by_id($subject_id);
		echo json_encode(array("status" => TRUE));
        }
        
          
        
  
         public function _getSubjects_allocation($course_id,$semester)
	{
            // For getting course list
		
		$data = array();
                
                 $dept=$this->session->userdata['mms']['dept'];
                 $list = $this->subject->get_subjects_all($course_id,$semester);
                 //$list = $this->subject->get_all_hardcore_subjects($course_id,$semester);
                 $facultyNames=$this->user->get_FacultyNames($dept);
                 $no=0;
		foreach ($list as $subject) {
                   
			$no++;
			$row = array();
                        
			$row[] = $subject->name;
			$row[] = $subject->course_code;
                        $row[] = $subject->credits;
                        $row[] = $subject->core;
                        

                        /*
                         * Adding Faculty details
                         */
                        
                        //$userid=$this->subject->get_allocated_userID($subject->id);
                        $allocated_subjects=$this->subject_allocation->get_subject_allocated_details($subject->id);
                        
                        //Making selection option for selecting faculty for courses
                        if(!empty($allocated_subjects->finalized) && $allocated_subjects->finalized){
                            
                            $row[]=$this->user->get_by_id($allocated_subjects->user_id)->first_name;
                        }
                        else{
                        $selectElement='<select name="subject_'.$subject->id."_".$semester.'"><option value="Select">';
                        foreach ($facultyNames as $faculty){
                            if(!empty($allocated_subjects->user_id) && $allocated_subjects->user_id==$faculty['id']){
                            $selectElement.='<option selected="true" value="'.$faculty['id'].'">'.$faculty['first_name'].'</option>';
                            }
                            else
                                $selectElement.='<option value="'.$faculty['id'].'">'.$faculty['first_name'].'</option>';
                        }
                         $selectElement.='<select>';
                        $row[]=$selectElement;
                        }
                        
                        
                       
                        //$row[] = $subject->id;
			$data[] = $row;
                        
		}
                return $data;
	}  
        
        
        public function allocate_subject_fn()
        {
            $subject_id=$this->input->post('subject_id');
            $user_id=$this->input->post('user_id');
            $course_id=$this->input->post('course_id');
            $semester=$this->input->post('semester');
            if($user_id=='Select'){
                $this->subject_allocation->delete_by_subjectid($subject_id);
                echo '1';
            }
            else{
                $year= date('Y', time());
            $data =array('subject_id'=>$subject_id, 'user_id'=>$user_id,'course_id'=>$course_id,'semester'=>$semester,'year'=>$year);
            $result =$this->subject_allocation->subject_allocation($data);
            //$this->temp=$result;
            if ($result >0)
                echo '1';
            else
                echo '0';
            }
        }
        
        public function finalize_subject_allocation_fn($course_id){
            $this->subject_allocation->update_all($course_id);
            echo TRUE;
            
        }
    
        
        
        /*
         * 
         * 
         * 
         * 
         */
        
        private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('subject_title') == '')
		{
			$data['inputerror'][] = 'subject_title';
			$data['error_string'][] = 'Subject Title is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('course_code') == '')
		{
			$data['inputerror'][] = 'course_code';
			$data['error_string'][] = 'Course Code is required';
			$data['status'] = FALSE;
		}

               
		if($this->input->post('credits') == '')
		{
			$data['inputerror'][] = 'credits';
			$data['error_string'][] = 'Course Credit is required';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
        
        public function _chk_user()
        {
            
           if ($this->userDetails['logged_in'])
                return true;
            else 
                return false;
            
            
        }
        public function _base(){
            $this->middle=('home'); 
           $this->layout();
        }
        
          /*
        public function subjects_allocation()
        {
            $course_id= $this->uri->segment(3);
            $subjectsData=$this->subject->get_subjects_array($course_id);
             
            $dept=$this->session->userdata['mms']['dept'];
            //echo "<script>alert(".$dept.");</script>";
            $facultyNames=$this->user->get_FacultyNames($dept);
            
            $subject_result=array();
            foreach($subjectsData as $subject){
                $cell=array();
                foreach ($subject as $data){
                    $cell[]=$data;
                }
                $selectElement='<select name="facultyName">';
                foreach ($facultyNames as $faculty){
                    $selectElement.='<option value="'.$faculty['first_name'].'">'.$faculty['first_name'].'</option>';
                }
                $selectElement.='<select>';
                $cell[]=$selectElement;
            //$this->table->add_row($cell);
            $subject_result[]=$cell;
            }
            
   
            
            $this->data['all_subjects']=$subject_result;
            //$this->data['all_subjects']=$subjectsData;
            $this->data['faculty']=$facultyNames;
           $this->middle=('course/subjects_allocation_view'); // passing middle to function. change this for different views.
           $this->layout();
        }
          */   
        
        
}?>