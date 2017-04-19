<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Mark extends MY_Controller
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
          $this->load->library('excel');


        
          
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
              
              $this->data['post_data']=$this->input->post();
              
            $this->middle=('student/show_students_view'); 
           $this->layout();
         }
         else
             $this->_base ();
     }
     
     // Functions for the Controller
 
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
		echo json_encode(array("status" => TRUE));
            }
            else
             $this->_base();
     
       
        }  
        
        
        /*
         * 
         * 
         * Mark update functions called from Ajax inline edit of respective views
         * 
         * 
         */
        
        //Updating external marks called from ajax inline change

        //Updating marks chenged from view for overall mark view
        
        public function inline_update_mark_fn(){
            
           if($this->input->post('action')=='edit'){
               //processing identifier sent by ajax
               $identifier=$this->input->post('identifier');
               $temp=explode('_',$identifier);
               $subject_id=$temp[0];
               $reg_number=$temp[1];
               
               //processing internal mark1
               if($this->input->post('internal1')!= null){
                   $value=$this->input->post('internal1');
                   if($value<=40){
                        $data=array('internal1'=>$value);
                   }
                   else{
                        $data=array('internal1'=>null);
                   }
               $where=array(
                   'reg_number'=>$reg_number,
                   'subject_id'=>$subject_id,
                       );
                    $this->mark->update($data,$where);
               }
               
                //processing internal mark1
                
               else if($this->input->post('internal2')!= null){
                   $value=$this->input->post('internal2');
                   if($value<=15){
                        $data=array('internal2'=>$value);
                   }
                   else{
                        $data=array('internal2'=>null);
                   }
               $where=array(
                   'reg_number'=>$reg_number,
                   'subject_id'=>$subject_id,
                       );
                    $this->mark->update($data,$where);
               }
               //processing other internal mark
               else if($this->input->post('other')!= null){
                   $value=$this->input->post('other');
                   if($value<=10){
                        $data=array('other'=>$value);
                   }
                   else{
                        $data=array('other'=>null);
                   }
               $where=array(
                   'reg_number'=>$reg_number,
                   'subject_id'=>$subject_id,
                       );
                    $this->mark->update($data,$where);
               }
               
               //Processing endsemester mark1
               else if($this->input->post('external1') != null){
                   $value=$this->input->post('external1');
                   if($value=='FA'){   
                    $data=array('external1'=>$value,'external2'=>$value);
                   }
                   elseif($value=='A'){   
                    $data=array('external1'=>$value,'external2'=>$value);
                   }
                   elseif($value<=60){   
                    $data=array('external1'=>$value );
                   }
                   else{
                       $data=array('external1'=>null);
                   }
               $where=array(
                   'reg_number'=>$reg_number,
                   'subject_id'=>$subject_id,
                       );
                    $this->mark->update($data,$where);
               }
               
               //External2 mark changes
               else if($this->input->post('external2') != null){
                   $value=$this->input->post('external2');
                   if($value=='FA'){     //processing for attendance shortage  
                    $data=array('external1'=>$value,'external2'=>$value);
                   }
                   elseif($value=='A'){   //processing for absent
                    $data=array('external1'=>$value,'external2'=>$value);
                   }
                   elseif($value<=60){   
                    $data=array('external2'=>$value );
                   }
                   else{
                       $data=array('external2'=>null);
                   }
               $where=array(
                   'reg_number'=>$reg_number,
                   'subject_id'=>$subject_id,
                       );
                    $this->mark->update($data,$where);
               }
               //external2 changes

           }
 
        }
        
        
        public function generate_grade_fn($subject_id){
            $mark_details=$this->mark->get_by_subject_id($subject_id);
            
            //processing K value and grade range
            $total_mark_array=array();
            
            foreach ($mark_details as $mark){
                $total_mark_array[]=$mark->total_mark;
            }
            $pass_mark=50;
            $max_mark=max($total_mark_array);
            
            //finding K value, 6 is the constant since there are 6 grades
            $no_grades=6;
            $K_val=($max_mark-$pass_mark)/$no_grades;
            $K_val=round($K_val, 2, PHP_ROUND_HALF_DOWN);
            
            $grades=array();
            $gr=array('A+','A','A-','B+','B','C');
            
            for($i=0;$i<5;$i++){
                $range=array();
                $range['max']= round($max_mark-($i*$K_val));
                $range['min']= round($max_mark-(($i+1)*$K_val)+1);
                $range['grade']=$gr[$i];
                $range['count']=0;
                $grades[]=$range;
            }
                $range=array();
                $range['max']= round($max_mark-($i*$K_val));
                $range['min']= $pass_mark;
                 $range['grade']=$gr[$i];
                 $range['count']=0;
                $grades[]=$range;

                
                $new_data=array();
            //Storing Grades to the student   
            foreach ($mark_details as $mark){
                 foreach ($grades as $key=>$range){
                     
                     if($mark->total_mark <= $range['max'] && $mark->total_mark >= $range['min']){
                         $grades[$key]['count']=$range['count']+1;
                         
                          $this->mark->update(
                                            //adding data
                                            array(
                                        'grade'=>$range['grade'],
                                            ),
                                                // adding where data
                                           array(
                                         'reg_number'=>$mark->reg_number,
                                         'subject_id'=>$subject_id
                                           )
                               );
                     } 
                }
            }
           
                
                
             $this->data['grades']=$grades;
            
            $this->data['marks']=$total_mark_array;
            $this->data['max']=$max_mark;
            $this->data['K_val']=$K_val;
            //$this->middle=('subject/grades_view'); 
           //$this->layout();
            
        }
        

        public function finalize_student_details_fn($course_id){
            $this->student->update_all($course_id);
            echo TRUE;
            
        }
        
        
        
        //Excell export try
        /*
         * 
         * 
         * 
         * 
         * 
         * 
         * 
         * 
         * 
         * 
         */
        
    
        
      
    
        
      
       
    function _get_students_excel($subject_id){
        
         $data=$this->subject->get_student_list($subject_id);
                    
                    //$total_marks=array();
                    $result = array(); 
                   foreach ($data as $item){
                       $row=array();
                       $row[]=$item->reg_number;
                       $row[]=$item->name;

                       //$row[]=$item->subject_id;
                       $result[]=$row;   
                   }
                   
                  return $result; 
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
        
        
        
        
        
        
        /*
         * 
         * 
         * Function not used
         * 
         */
        
    
      
        
}?>