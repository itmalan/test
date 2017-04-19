<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Student extends MY_Controller
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
          $this->load->model('Student_Model','student');
          $this->load->model('Mark_Model','mark');
          
           if ($this->session->has_userdata('mms')){
                $this->userDetails=$this->session->userdata('mms');
                  $this->data['user']=$this->userDetails;
          }
          //$this->load->model('person_model','person');      
     }

     //View Functions
     public function home(){
         
         if ($this->_chk_user()&& $this->userDetails['role']==4){
         $this->index();
         }
         else
             $this->_base();
     }
     //default view to load
     public function index(){
         if ($this->_chk_user()&& $this->userDetails['role']==4){
            $this->middle=('student/show_students_view'); 
           $this->layout();
         }
         else
             $this->_base ();    
     }
     public function show_students_view(){
             
          if ($this->_chk_user()&& $this->userDetails['role']==4){
              $last = $this->uri->total_segments();
                $course_id = $this->uri->segment($last);
              $this->get_student_details_fn($course_id);
              
              
            $this->middle=('student/show_students_view'); 
           $this->layout();
         }
         else
             $this->_base ();
     }
     
     
     public function enroll_students_view(){
         
         if ($this->_chk_user()&& $this->userDetails['role']==4){
              //$last = $this->uri->total_segments();
                //$course_id = $this->uri->segment($last);
              //$this->get_student_details_fn($course_id);
             $dept_id=$this->course->get_by_dept($this->userDetails['dept']);
             $this->data['courses']=$this->course->get_by_dept($this->userDetails['dept']);
          
             
              
            $this->middle=('student/enroll_students_view'); 
           $this->layout();
         }
         else
             $this->_base ();

         
     }
     
      public function enroll_semester_view($course_id){
         
         if ($this->_chk_user()&& $this->userDetails['role']==4){
        
              $dept_id=$this->userDetails['dept'];
             //$this->enroll_semester($course_id,$dept_id);
              
              $this->data['course_id'] =$course_id;
                $this->data['course_title']=$this->course->get_by_id($course_id)->name;
                
                $curMonth = date("m", time());
                $curHalf= ceil($curMonth/6);
                $semester=array();
                if($curHalf==1){
                    $semester[0]=2;
                    $semester[1]=4;
                 $this->data['semester_title1']  ='II';
                 $this->data['semester_title2']  ='IV';
                }
                else{
                    $semester[0]=1;
                    $semester[1]=3;
                    $this->data['semester_title1']  ='I';
                    $this->data['semester_title2']  ='III';
                }
                
                 //$semester=2;
            $data1=array(
                'course_id'=>$course_id,
                'dept_id'=>$dept_id,
                'semester'=>$semester[0],
            );
                
                //$this->student->get_datatables_enrolled($data);
               $this->data['dataset1']=$this->_populated_enrolled_student_semester($data1);
               $data2=array(
                'course_id'=>$course_id,
                'dept_id'=>$dept_id,
                'semester'=>$semester[1],
            );
               $this->data['dataset2']=$this->_populated_enrolled_student_semester($data2);;
              
            $this->middle=('student/enroll_semester_view'); 
           $this->layout();
         }
         else
             $this->_base ();

     }
     
     
     
     // Functions for the Controller
     //Getting data for all entrolled students in the dept (General View)

      public function get_enrolled_students_fn(){
         if ($this->_chk_user()&& $this->userDetails['role']==4){
             
             //for adding course list for forms add and edit
             $dept_id=$this->userDetails['dept'];
             
             
             $list = $this->student->get_students_list($dept_id);
		$data = array();
		$no = $_POST['start'];
                $no++;
		foreach ($list as $student) {
			$row = array();
                        $row[]= $no++;
			$row[] = $student->name;
			$row[] = $student->reg_number;
			$row[] = $student->year_joined;
			$row[] = $this->course->get_by_id($student->course_id)->name;
			

			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_studentForm('."'".$student->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="delete_Studentform('."'".$student->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
		
			$data[] = $row;
                    
		}
            //echo print_r($row);
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->student->count_all(),
						"recordsFiltered" => $this->student->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
             
             
                 }
         else
             $this->_base ();
     }
     
          //Getting data for students details who enrolled for semesters
     
     
 
      public function get_student_details_fn($course_id)
	{
            // For getting course list

               if ($this->_chk_user()&& $this->userDetails['role']==4){
                 //$facultyNames=$this->user->get_FacultyNames($dept); 
                 $data_fields=array('id','reg_number','name');
                $this->data['students']= $this->student->get_students_fields($course_id,$data_fields);
                
                $result=$this->student->isFinalized($course_id);
                if(!empty($result))
                $this->data['finalized']=$result->finalized;
                 }
         else
             $this->_base ();
     
       
        }  
        
        public function add_student_general_fn()
	{
            // For getting course list

               if ($this->_chk_user()&& $this->userDetails['role']==4){

		$this->_validate();
                //$userDetails=$this->session->userdata('mms');
                $dept_id= $this->userDetails['dept'];
                
		$data = array(
				'name' => $this->input->post('name'),
				'reg_number' => $this->input->post('reg_number'),
                                'year_joined'   =>$this->input->post('year'),
                                'course_id' =>$this->input->post('course_id'),
                                'dept_id'=>$dept_id,
			);
		$insert = $this->student->save($data);
                
                //initializing mark table
                $this->_initialize_marks($data);
                

                
		echo json_encode(array("status" => TRUE));
            }
            else
             $this->_base();
     
       
        }
        
        public function add_student_fn($course_id)
	{
            // For getting course list

               if ($this->_chk_user()&& $this->userDetails['role']==4){

		$this->_validate();
                //$userDetails=$this->session->userdata('mms');
                
                
		$data = array(
				'name' => $this->input->post('name'),
				'reg_number' => $this->input->post('reg_number'),
                                'course_id'   =>$course_id,        
			);
		$insert = $this->student->save($data);
                
                //initializing mark table
                $this->_initialize_marks($data);
                

                
		echo json_encode(array("status" => TRUE));
            }
            else
             $this->_base();
     
       
        }
        public function edit_student_fn($id)
	{
                if($this->_chk_user()){
		$data = $this->student->get_by_id($id);
                
		//$data->created = ($data->created == '0000-00-00') ? '' : $data->created; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
                    }
                    else{
                        echo 'Invalid access';
                    }
	}
        public function update_student_general_fn()
	{
            if($this->_chk_user() && $this->userDetails['role']==4 && !empty($this->input->post())){
		$this->_validate();
		$data = array(
				'name' => $this->input->post('name'),
				'reg_number' => $this->input->post('reg_number'),
                                'year_joined' => $this->input->post('year'),
                                'course_id' => $this->input->post('course_id'),
			);
		$this->student->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
                }
            else
             $this->_base();
	}

        public function update_student_fn(){
            
           if($this->input->post('action')=='edit'){
               $id=array('id'=>$this->input->post('id'));
               
              
               if(empty($this->input->post('reg_number')))
                    $this->student->update($id,array('name'=>$this->input->post('name')));
               else if(empty($this->input->post('name')))
                    $this->student->update($id,array('reg_number'=>$this->input->post('reg_number')));
                else 
                  $this->student->update($id,array(
                                            'reg_number'=>$this->input->post('reg_number'),
                                            'name'=>$this->input->post('name')
                                                    ));
           }
           else if($this->input->post('action')=='delete'){
               $id=$this->input->post('id');
               $this->student->delete_by_id($id);
           }
        
        }
        
        
        public function delete_student_fn($id)
	{
            if($this->_chk_user() && $this->userDetails['role']==4){
		$this->student->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
                }
            else
             $this->_base();
	}

        public function finalize_student_details_fn($course_id){
            $this->student->update_all($course_id);
            echo TRUE;
            
        }
        
        public function get_enrolled_subjects_fn($student_id)
	{
            // For getting course list

               if ($this->_chk_user()&& $this->userDetails['role']==4){
                   

		//$this->_validate();
                //$userDetails=$this->session->userdata('mms');
                $dept_id= $this->userDetails['dept'];
                
                $student_details=$this->student->get_by_id($student_id);
                $subjects=array();
                $subjects['id']=$student_details->id;
                $subjects['name']=$student_details->name;
                $subjects['reg_number']=$student_details->reg_number;
                $subjects_id=$this->mark->get_enrolled_subjects($student_details->reg_number);
                
                $table_data='<table class="table table-striped table-bordered ui">';
                $table_data.='<tr><th>Sl. No.</th><th>Name of the Course</th><th>Course Code</th><th>credits</th><th>Hardcore / Softcore</th></tr>';
                $no=1;
                $sem='';
                //echo print_r($subjects_id);
                foreach ($subjects_id as $id){
                    $sem=$id->semester;
                    $row='';
                    //$row=array();
                    $row='<tr>';
                    $subject=array();
                    $data=$this->subject->get_by_id($id->subject_id);
                    //$row.='<td>'.$data->id.'</td>';
                    $row.='<td>'.$no++.'</td>';
                    $row.='<td>'.$data->name.'</td>';
                    $row.='<td>'.$data->course_code.'</td>';
                    $row.='<td>'.$data->credits.'</td>';
                    $row.='<td>'.$data->core.'</td>';
                    $row.='</tr>';
                    //$subject['subject']=$row;
                    //$subjects[]=$subject;
                    $table_data.=$row;
                }
                $table_data.='</table>';
                $subjects['table_data']=$table_data;
                
                //Getting Softcore subjects to allocate
                $subjects['softcore']=$this->subject->get_all_softcore_subjects($student_details->course_id);
                $subjects['semester']=$sem;
               
		//$insert = $this->student->save($data);
                
                //initializing mark table
                //$this->_initialize_marks($data);
                

                
		echo json_encode($subjects);
            }
            else
             $this->_base();
     
       
        }
        
        
        /*
         * 
         * 
         * 
         * 
         */
        
        function _populated_enrolled_student_semester($data){
            
             $list = $this->student->get_datatables_enrolled($data);

		$sno=1;
                $no=1;
                $student_id='';
                
                $subject='';
                $result=array();
                $flag=0;
                $row=array();
                foreach($list as $student){
                    
                    if($student_id != $student->id){
                        if($flag !=0){
                        $result[]=$row;
                        }
                        $flag=1;
                        unset($row);
                        $sno=1;
                        $student_id=$student->id;
                        $row[]=$no++;
                        $row[] = $student->name;
			$row[] = $student->reg_number;
                        $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="add / remove subjects" onclick="add_remove_subjects('."'".$student->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Add / Remove Subjects</a>';
                    }
                }
                        $result[]=$row;

                //Processing Softcore Subjects
                 //$softcore=$this->subject->get_all_softcore_subjects($data['course_id'],$data['semester']);
               return $result;   
        }
        
        
        public function enroll_semester($sem){
            $dept_id=$this->userDetails['dept'];
            $course_id=$this->input->post('course_id');
            //$sem=$this->input->post('semester');
            $semester=0;
            $year=date('Y',time());
            if($sem=='I'){
                $semester=1;
                
            }
            elseif($sem=='II'){
                $semester=2;
                $year=$year-1;
            }
            elseif($sem=='III'){
                $semester=3;
                $year=$year-1;
            }
            elseif($sem=='IV'){
                $semester=4;
                $year=$year-2;
            }
            $data=array(
                'course_id'=>$course_id,
                'semester'=>$semester,
                'dept_id'=>$dept_id,
                    'year'=>$year,
            );
            //echo print_r($data);
            
            //Checking Already allocated or not
            if($this->student->check_subject_allocated_status($data)<1){
                $this->student->allocate_hardcore_subjects($data);
                echo json_encode(array("status" => TRUE));
            }
            else{
                echo json_encode(array("status" => FALSE,"message"=>'Its done already'));
            }
            
        }
        public function allocate_softcore_fn(){
            $student_id=$this->input->post('id');
            $semester=$this->input->post('semester');
            $subject_id=$this->input->post('softcore_subject_id');
            
            $data=array(
                'student_id'=>$student_id,
                'semester'=>$semester,
                'subject_id'=>$subject_id,
            );
            $this->student->allocate_softcore_subjects($data);
            echo json_encode(array("status" => TRUE));
            
        }
        
        private function _initialize_marks($data){
            $subjects=$this->subject->get_subjects($data['course_id']);
            
            
            foreach ($subjects as $subject){
                $row=array();
                $row['subject_id']=$subject->id;
                $row['reg_number']=$data['reg_number'];
                $this->mark->save($row);
            }
            
            
        }
        
        
        private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('name') == '')
		{
			$data['inputerror'][] = 'name';
			$data['error_string'][] = 'Student Name is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('reg_number') == '')
		{
			$data['inputerror'][] = 'reg_number';
			$data['error_string'][] = 'Register number is required';
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
        
          
        
        
}?>