<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Report extends MY_Controller
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
     
      /*
      * Processing subject allocated list view 
      * 
      */
     
     public function list_subjects_internal_mark_report($course_id){
             
          if ($this->_chk_user()&& $this->userDetails['role']==3){
              //$last = $this->uri->total_segments();
                //$course_id = $this->uri->segment($last);
              $this->get_subject_details_fn($course_id,'internal');
               
            $this->middle=('report/list_subjects_internal_mark_report'); 
           $this->layout();
         }
         else
             $this->_base ();
     }
     
     public function list_subjects_endsemester_mark_report($course_id){
             
          if ($this->_chk_user()&& $this->userDetails['role']==3){
              //$last = $this->uri->total_segments();
                //$course_id = $this->uri->segment($last);
              $this->get_subject_details_fn($course_id,'endsemester');
               
            $this->middle=('report/list_subjects_endsemester_mark_report'); 
           $this->layout();
         }
         else
             $this->_base ();
     }
     
     public function list_subjects_overall_mark_report($course_id){
             
          if ($this->_chk_user()&& $this->userDetails['role']==3){
              //$last = $this->uri->total_segments();
                //$course_id = $this->uri->segment($last);
              $this->get_subject_details_fn($course_id,'overall');
               
            $this->middle=('report/list_subjects_overall_mark_report'); 
           $this->layout();
         }
         else
             $this->_base ();
     }
     
     
      public function list_subjects_gradesheet_report($course_id){
             
          if ($this->_chk_user()&& $this->userDetails['role']==3){
              //$last = $this->uri->total_segments();
                //$course_id = $this->uri->segment($last);
              $this->get_subject_details_fn($course_id,'gradesheet');
               
            $this->middle=('report/list_subjects_gradesheet_report'); 
           $this->layout();
         }
         else
             $this->_base ();
     }
     
     public function consolidated_reports($course_id){
             
          if ($this->_chk_user()&& $this->userDetails['role']==4){
              //$last = $this->uri->total_segments();
                //$course_id = $this->uri->segment($last);
              $this->get_subject_details_fn($course_id,'consolidated');
              
              $reports=array();
              $row=array();
              $row[]=1;
              $row[]='<a href="'.base_url().'report/consolidated_grade_report/'.$course_id.'">Consolidated Overall Results - All Subjects and Students of the Program</a>';
              $reports[]=$row;
              unset($row);
              $row[]=2;
              $row[]='<a href="'.base_url().'report/consolidated_grade_report_students/'.$course_id.'">Consolidated Overall Results - Student Wise</a>';
              $reports[]=$row;
              
              
             $this->data['reports']=$reports;  
            $this->middle=('report/consolidated_reports'); 
           $this->layout();
         }
         else
             $this->_base ();
     }
     
     
     
     /*
      * Processing student list and mark table view 
      * 
      */
     
     
     public function get_subject_details_fn($course_id,$type)
	{
            // For getting course list

               if ($this->_chk_user()&& ($this->userDetails['role']==3 || $this->userDetails['role']==4)){

                 
                   $faculty_id=$this->userDetails['id'];
                   //$this->data['subjects']=$this->subject->get_allocated_subjects($faculty_id,$course_id);
                   $data=$this->subject->get_allocated_subjects($faculty_id,$course_id);
                   $result = array();
                   foreach ($data as $item){
                       $row=array();
                       if($type=='internal'){
                       $row[]='<a href="'.base_url().'report/internal_mark_report/'.$item->subject_id.'">'.$item->name.'</a>';
                       }
                       elseif($type=='endsemester'){
                           $row[]='<a href="'.base_url().'report/endsemester_mark_report/'.$item->subject_id.'">'.$item->name.'</a>';
                       }
                       elseif($type=='overall'){
                           $row[]='<a href="'.base_url().'report/overall_mark_report/'.$item->subject_id.'">'.$item->name.'</a>';
                       }
                       elseif($type=='gradesheet'){
                            $row[]='<a href="'.base_url().'report/grade_sheet_report/'.$item->subject_id.'">'.$item->name.'</a>';
                       }
                   
                       $row[]=$item->course_code;
                       $row[]=$item->credits;
                       //$row[]=$item->subject_id;
                       $result[]=$row;
                       
                        }
                        $this->data['subjects']=$result;
                    
             
                 }
         else
             $this->_base ();
     
        }  
     
     /*
      * 
      * 
      * 
      * 
      */
     
     public function internal_mark_report($subject_id){
             
          if ($this->_chk_user()&& $this->userDetails['role']==3){
              //$last = $this->uri->total_segments();
                //$course_id = $this->uri->segment($last);
              $this->get_student_list_internal_fn($subject_id);
              
               
            $this->middle=('report/internal_mark_report'); 
           $this->layout();
           /*
           $html = $this->output->get_output();
		//$html = file_get_contents('report/internal_mark_report/42');
		// Load library
            
                //$html= $this->internal_mark_report_pdf($subject_id);
		$this->load->library('dompdf_gen');
                
		
		// Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream('test.pdf');
            * 
            */
         }
         else
             $this->_base ();
     }
     
     public function endsemester_mark_report($subject_id){
             
          if ($this->_chk_user()&& $this->userDetails['role']==3){
              //$last = $this->uri->total_segments();
                //$course_id = $this->uri->segment($last);
              $this->get_student_list_endsemester_fn($subject_id);
              
               
            $this->middle=('report/endsemester_mark_report'); 
           $this->layout();
         }
         else
             $this->_base ();
     }
          public function overall_mark_report($subject_id){
             
          if ($this->_chk_user()&& $this->userDetails['role']==3){
              //$last = $this->uri->total_segments();
                //$course_id = $this->uri->segment($last);
              $this->get_student_list_fn($subject_id);
              
              $this->grade_sheet_report($subject_id);
              
               
            $this->middle=('report/overall_mark_report'); 
           $this->layout();
         }
         else
             $this->_base ();
     }
     
     
     
     //used for generating subject wise all student result
     public function consolidated_grade_report($course_id){
             
          if ($this->_chk_user()&& $this->userDetails['role']==4){
              //$last = $this->uri->total_segments();
                //$course_id = $this->uri->segment($last);
              $subjects=$this->subject->get_allocated_subjects_by_courseid($course_id);
              //foreach($subjects as $subject){
              $this->get_consolidated_student_list_fn($subjects);
              
             // $this->consolidated_grade_report_fn($subjects);
              //}
              
               
            $this->middle=('report/consolidated_grade_report'); 
           $this->layout();
         }
         else
             $this->_base ();
     }
     
     
        public function consolidated_grade_report_students($course_id){
             
          if ($this->_chk_user()&& $this->userDetails['role']==4){
              //$last = $this->uri->total_segments();
                //$course_id = $this->uri->segment($last);
              $subjects=$this->subject->get_allocated_subjects_by_courseid($course_id);
              //foreach($subjects as $subject){
              $this->get_consolidated_report_student_fn($subjects);
              
             // $this->consolidated_grade_report_fn($subjects);
              //}
              
               
            $this->middle=('report/consolidated_grade_report_students'); 
           $this->layout();
         }
         else
             $this->_base ();
     }
      
      
     // Functions for the Controller
 
      
        
        //Populating student list and marks for Internal marks addition
        
         public function get_student_list_internal_fn($subject_id)
	{
            // For getting course list

               if ($this->_chk_user()&& $this->userDetails['role']==3){
                 
                   $this->data['subject_title']=$this->subject->get_by_id($subject_id)->name;
                   $this->data['subject_code']=$this->subject->get_by_id($subject_id)->course_code;
                   $this->data['program_title']=$this->course->get_by_id($this->subject->get_by_id($subject_id)->course_id)->name;
                   //$this->data['period']=date("M-Y", time());
                   $this->data['period']='May '.date("Y", time());
                   $this->data['faculty_name']=$this->userDetails['name'];
                   $this->data['hod_name']=$this->user->get_hod_name($this->userDetails['dept'])->first_name;
                    $data=$this->subject->get_student_list($subject_id);
                    
                    //$total_marks=array();
                    $result = array();
                    $no=0;
                   foreach ($data as $item){
                       $row=array();
                       
                       //passing below two items as identifier
                       
                       //$row[]=$item->reg_number;
                      
                       //----
                       $row[]=++$no;
                       $row[]=$item->reg_number;
                       $row[]=$item->name;
                       $row[]=$item->internal1;
                       $row[]=$item->internal2;
                       $row[]=$item->other;
                       //$row[]=$item->total_internal;
                       $total_internal=$item->internal1 + $item->internal2 +$item->other;

                       $row[]=$item->total_internal;
                       
          
                       
                       //$row[]=$item->subject_id;
                       $result[]=$row;   
                   }
         
                   
                   $this->data['students']=$result;
                   return $result;

                 }
         else
             $this->_base ();

        }   
        
        
        //Populating student list and marks for end semester mark processing
        
         public function get_student_list_endsemester_fn($subject_id)
	{
            // For getting course list

               if ($this->_chk_user()&& $this->userDetails['role']==3){
                   
                    $this->data['subject_title']=$this->subject->get_by_id($subject_id)->name;
                   $this->data['subject_code']=$this->subject->get_by_id($subject_id)->course_code;
                   $this->data['program_title']=$this->course->get_by_id($this->subject->get_by_id($subject_id)->course_id)->name;
                   //$this->data['period']=date("M-Y", time());
                   $this->data['period']='May '.date("Y", time());

                    $this->data['faculty_name']=$this->userDetails['name'];
                   $this->data['hod_name']=$this->user->get_hod_name($this->userDetails['dept'])->first_name;
                    $data=$this->subject->get_student_list($subject_id);
                    
                    //$total_marks=array();
                    $result = array();
                    $no=0;
                   foreach ($data as $item){
                       $row=array();
                       
                       //passing below two items as identifier
                      
                       //$row[]=$item->reg_number;
                      
                       //----
                       $row[]=++$no;
                       $row[]=$item->reg_number;
                       $row[]=$item->name;
                       
                       $row[]=$item->external1;
                       $row[]=$item->external2;
                       //$row[]=$item->total_external;
                       $total_external=($item->external1+$item->external2)/2;

                       $row[]=$total_external;

                       
                       //$row[]=$item->subject_id;
                       $result[]=$row;   
                   }
         
                   
                   $this->data['students']=$result;

                 }
         else
             $this->_base ();
     
       
        }   
        
        
        
        //Populating student and mark list for over all mark adding
        
      public function get_student_list_fn($subject_id)
	{
            // For getting course list

               if ($this->_chk_user()&& ($this->userDetails['role']==3 || $this->userDetails['role']==4)){
                 
                    $this->data['subject_title']=$this->subject->get_by_id($subject_id)->name;
                   $this->data['subject_code']=$this->subject->get_by_id($subject_id)->course_code;
                   $this->data['program_title']=$this->course->get_by_id($this->subject->get_by_id($subject_id)->course_id)->name;
                   //$this->data['period']=date("M-Y", time());
                   $this->data['period']='May '.date("Y", time());
                    $this->data['faculty_name']=$this->userDetails['name'];
                   $this->data['hod_name']=$this->user->get_hod_name($this->userDetails['dept'])->first_name;
                    $data=$this->subject->get_student_list($subject_id);
                    
                    //$total_marks=array();
                    $result = array();
                    $no=0;
                   foreach ($data as $item){
                       $row=array();
                       
                       //passing below two items as identifier
                      
                       //$row[]=$item->reg_number;
                      
                       //----
                       $row[]=++$no;
                       $row[]=$item->reg_number;
                       $row[]=$item->name;
                       
                       $row[]=$item->total_internal;

                       $row[]=$item->total_external;

                       $row[]=$item->total_mark;
                       
                       $row[]=$item->grade;
                       $row[]=$item->result;
                       
                       //$row[]=$item->subject_id;
                       $result[]=$row;   
                   }
         
                   
                   $this->data['students']=$result;

                 }
         else
             $this->_base ();
     
       
        }   
        
       
        
        
        public function grade_sheet_report($subject_id){
            $mark_details=$this->mark->get_by_subject_id($subject_id);
            
            /*Checking if external mark is processed properly. If difference in external ,more 15%
             * then the total_external would be marked as '-'.
             * Based on which all grades as processed with '-'
             * This mean no grade generation
            */
            
            $stop_generate_grade='no';
            foreach($mark_details as $mark){
                 if($mark->total_mark == '-'){
                     $stop_generate_grade='yes';
                     break;
                 }
            }
            if($stop_generate_grade=='yes'){
            foreach($mark_details as $mark){
            
            }
            return;
            }
            
            /*
             * If above condition fails
             * Carrying Grade generation process
             */
            
            //processing K value and grade range
            $total_mark_array=array();
            $pass_mark=50;
            $no_grades=6;
            $count_total_pass=0;
            $fail_count=0;
            $grades=array();
            $gr=array('A+','A','A-','B+','B','C','F','FA');
            $K_val=0;
            $max_mark=0;
            $message='';
            
            foreach ($mark_details as $mark){
                $total_mark_array[]=$mark->total_mark;
                if($mark->total_mark > $pass_mark)
                    $count_total_pass++;
            }
            
            // As per CBCS rule total number of pass marks in less than 10 then absolute grading should be followed else k value concept.
            if( ! ($count_total_pass < 10))
            {
            //Applying K value relative grading here
            $max_mark=max($total_mark_array);
            
            //finding K value, 6 is the constant since there are 6 grades
            
            $K_val=($max_mark-$pass_mark)/$no_grades;
            $K_val=round($K_val, 2, PHP_ROUND_HALF_DOWN);

            // calculating grades
            for($i=0;$i<5;$i++){
                $range=array();
                $range['max']= round($max_mark-($i*$K_val));
                $range['min']= round($max_mark-(($i+1)*$K_val)+1);
                $range['grade']=$gr[$i];
                $range['count']=0;
                $grades[]=$range;
            }
            //adding last C Grade
                $range=array();
                $range['max']= round($max_mark-($i*$K_val));
                $range['min']= $pass_mark;
                $range['grade']=$gr[$i++];
                $range['count']=0;
                $grades[]=$range;
            //adding Fail Grade
                $range=array();
                $range['max']= 49;
                $range['min']= 0;
                $range['grade']=$gr[$i++];
                $range['count']=0;
                $grades[]=$range;
            //adding Fail Attendance Grade
                $range=array();
                $range['max']= null;
                $range['min']= 'Failed due to lack of Attendance';
                $range['grade']=$gr[$i++];
                $range['count']=0;
                $grades[]=$range;
            }
            else{
                //Applying Absolute grading here
                $message='Absolute Grade is processed as per CBCS Clause 9.1<br/> In courses where the number of students who have secured 50 marks and above
                is less than 10 then grading may be given based on the Table III.';
                //For Grade A+ with 20 as range
                $range=array();
                $range['max']= 100;
                $range['min']= 81;
                $range['grade']=$gr[0];
                $range['count']=0;
                $grades[]=$range;
                
                //For Grade A with 10 as range
                $range=array();
                $range['max']= 80;
                $range['min']= 71;
                $range['grade']=$gr[1];
                $range['count']=0;
                $grades[]=$range;
                
                //For Grade A- with 5 as range
                $range=array();
                $range['max']= 70;
                $range['min']= 66;
                $range['grade']=$gr[2];
                $range['count']=0;
                $grades[]=$range;
                
                //For Grade B+ with 5 as range
                $range=array();
                $range['max']= 65;
                $range['min']= 61;
                $range['grade']=$gr[3];
                $range['count']=0;
                $grades[]=$range;
                
                 //For Grade B with 5 as range
                $range=array();
                $range['max']= 60;
                $range['min']= 56;
                $range['grade']=$gr[4];
                $range['count']=0;
                $grades[]=$range;

                //For Grade C with 6 as range
                $range=array();
                $range['max']= 55;
                $range['min']= $pass_mark;
                $range['grade']=$gr[5];
                $range['count']=0;
                $grades[]=$range;
                
                //For Grade F with 6 as range
                $range=array();
                $range['max']= 49;
                $range['min']= 0;
                $range['grade']=$gr[6];
                $range['count']=0;
                $grades[]=$range;
                
                //For Grade FA
                //adding Fail Attendance Grade
                $range=array();
                $range['max']= null;
                $range['min']= 'Failed due to lack of Attendance';
                $range['grade']=$gr[7];
                $range['count']=0;
                $grades[]=$range;
            }
            // Grade calculation and assigment ends    

                $new_data=array();
            //Storing Grades to the student   
                $reg_number='';
            foreach ($mark_details as $mark){
                $flag=0;
                 foreach ($grades as $key=>$range){

                     //Checking max and minimum marks
                     if($mark->total_mark <= $range['max'] && $mark->total_mark >= $range['min']){
                         
                         if($mark->total_external < 24 ){
                             $grades[6]['count']=$grades[6]['count']+1;
                                 
                            }                        
                         else{
                         $grades[$key]['count']=$range['count']+1;
                         
                         } 

                        }// Checking max and minimum mark ends
                    if($mark->total_external == 'FA'){ 
                        if($reg_number != $mark->reg_number){
                            $reg_number = $mark->reg_number;
                        //echo $mark->reg_number;
                             $grades[7]['count']=$grades[7]['count']+1;
                                 
                            }   
                    }
                }
                 $reg_number='';

            }// Marks foreach loop ends here
            
             $this->data['grades']=$grades;
            
            $this->data['marks']=$total_mark_array;
            
            if($K_val!=0){
            $this->data['max']=$max_mark;
            $this->data['K_val']=$K_val;
            }
            else{
                $this->data['message']=$message;
            }
            //$this->middle=('subject/grades_view'); 
           //$this->layout();

    }
    
    
    
     public function get_consolidated_student_list_fn($subjects)
	{
            // For getting course list

               if ($this->_chk_user()&& ($this->userDetails['role']==3 || $this->userDetails['role']==4)){
                   
                   $this->data['program_title']=$this->course->get_by_id($this->subject->get_by_id($subjects[0]->subject_id)->course_id)->name;
                   $this->data['period']=date("M-Y", time());
                   //$this->data['faculty_name']=$this->userDetails['name'];
                   $this->data['hod_name']=$this->user->get_hod_name($this->userDetails['dept'])->first_name;
                   
                   $allresult=array();
                   
                   //foreach($subjects as $subject){
                 
                    //$this->data['subject_title']=$this->subject->get_by_id($subject->subject_id)->name;
                   //$this->data['subject_code']=$this->subject->get_by_id($subject->subject_id)->course_code;
                   $year=date("Y", time());
                   $last = $this->uri->total_segments();
                    $course_id = $this->uri->segment($last);
                   $where =array(
                       'year_joined'=>$year-1,
                       'course_id'=>$course_id,
                       'dept_id'=>$this->userDetails['dept'],
                   );
                   $students_list=$this->student->get_students_by_where($where);
                   $slno=1;
                   $allresult=array();
                     foreach($students_list as $studnet){
                         $result = array();
                         $result[]=$slno++;
                         $result[]=$studnet->reg_number;
                         $result[]=$studnet->name;
                         
                         foreach($subjects as $subject){
                             $where =array(
                                 'subject_id'=>$subject->subject_id,
                                 'course_id'=>$course_id,
                                 'reg_number'=>$studnet->reg_number,
                                 'year'=>$year-1, 
                             );
                           $marks_data=$this->mark->get_mark_details($where);
                           //echo print_r($marks_data);
                           //echo print_r($subjects);
                           $mark=array();
                            //$mark['course_code']=$subject->course_code;
                            //$mark['course_title']=$subject->name;
                            if(count($marks_data)>0){
                            $mark['total']=$marks_data->total_mark;
                            $mark['grade']=$marks_data->grade;
                            }
                            $result[]=$mark;
                         }
                         $allresult[]=$result;
                       }
                    
                   $this->data['subjects']=$subjects;
                   $this->data['consolidated_data']=$allresult;
                   
                 }// User validation ends
         else
             $this->_base ();
     
       
        }
        
         public function get_consolidated_report_student_fn($subjects)
	{
            // For getting course list

               if ($this->_chk_user()&& ($this->userDetails['role']==3 || $this->userDetails['role']==4)){
                   
                   $this->data['program_title']=$this->course->get_by_id($this->subject->get_by_id($subjects[0]->subject_id)->course_id)->name;
                   $this->data['period']=date("M-Y", time());
                   //$this->data['faculty_name']=$this->userDetails['name'];
                   $this->data['hod_name']=$this->user->get_hod_name($this->userDetails['dept'])->first_name;
                   
                   $allresult=array();
                   
                   //foreach($subjects as $subject){
                 
                    //$this->data['subject_title']=$this->subject->get_by_id($subject->subject_id)->name;
                   //$this->data['subject_code']=$this->subject->get_by_id($subject->subject_id)->course_code;
                   $year=date("Y", time());
                   $last = $this->uri->total_segments();
                    $course_id = $this->uri->segment($last);
                   $where =array(
                       'year_joined'=>$year-1,
                       'course_id'=>$course_id,
                       'dept_id'=>$this->userDetails['dept'],
                   );
                   $students_list=$this->student->get_students_by_where($where);
                   $slno=1;
                   $allresult=array();
                     foreach($students_list as $studnet){
                         $result = array();
                         $result[]=$slno++;
                         $result[]=$studnet->reg_number;
                         $result[]=$studnet->name;
                         
                         foreach($subjects as $subject){
                             $where =array(
                                 'subject_id'=>$subject->subject_id,
                                 'course_id'=>$course_id,
                                 'reg_number'=>$studnet->reg_number,
                                 'year'=>$year-1, 
                             );
                           $marks_data=$this->mark->get_mark_details($where);
                           //echo print_r($marks_data);
                           //echo print_r($subjects);
                           $mark=array();
                            $mark['course_code']=$subject->course_code;
                            $mark['course_title']=$subject->name;
                            //$mark['semester']=$subject->semester;
                            $mark['semester']=2;
                            $mark['credits']=$subject->credits;
                            $mark['points']=8;
                            
                            if(!empty($marks_data)){
                            $mark['total']=$marks_data->total_mark;
                            $mark['grade']=$marks_data->grade;
                            }
                            $result[]=$mark;
                         }
                         $allresult[]=$result;
                       }
                    
                   $this->data['subjects']=$subjects;
                   $this->data['consolidated_data']=$allresult;
                   
                 }// User validation ends
         else
             $this->_base ();
     
       
        }


        public function printPdf($subject_id) {	
                   $data=array();
                   $data['subject_title']=$this->subject->get_by_id($subject_id)->name;
                   $data['subject_code']=$this->subject->get_by_id($subject_id)->course_code;
                   $data['faculty_name']=$this->userDetails['name'];
                   $data['hod_name']=$this->user->get_hod_name($this->userDetails['dept'])->first_name;
                   
            
            $data['students']=$this->get_student_list_internal_fn($subject_id);
            
            /*

            //$this->middle=('report/internal_mark_report'); 
            //$this->print_layout();
          
            $html = $this->load->view('report/internal_mark_report',$data, true);
            //$html = $this->output->get_output();
		// Load library
     
		$this->load->library('dompdf_gen');
                
		
		// Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream('test.pdf');
             */   
                
            $this->middle=('report/internal_mark_report'); 
            $this->print_layout();
          
           
            $html = $this->output->get_output();
		// Load library
     
		$this->load->library('dompdf_gen');
                
		
		// Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream('test.pdf');
                
                
	}
        
        public function internal_mark_report_pdf($subject_id){
             
          if ($this->_chk_user()&& $this->userDetails['role']==3){
              //$last = $this->uri->total_segments();
                //$course_id = $this->uri->segment($last);
              $this->get_student_list_internal_fn($subject_id);
              
               
           $this->middle=('report/internal_mark_report'); 
           $html=$this->layout();
           return $html;
         }
         else
             $this->_base ();
     }
        
       
        

        public function finalize_student_details_fn($course_id){
            $this->student->update_all($course_id);
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