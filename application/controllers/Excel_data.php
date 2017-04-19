<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Excel_Data extends CI_Controller
{
    
 
public function __construct() {
        parent::__construct();
                $this->load->library('excel');//load PHPExcel library 
		//$this->load->model('upload_model');//To Upload file in a directory
                $this->load->model('Excel_data_insert_model','excelModel');
                $this->load->model('Mark_Model','mark');
                $this->load->library('upload');
                $this->load->library('user_agent');
                $this->load->helper(array('form', 'url'));
}

public function index(){
    $error='';
   $this->load->view('home', array('error' => ' ' ));
}


 


	
public	function ExcelDataAdd()	{  
    
    $config = array(
'upload_path' =>'./uploads/excel/',
'allowed_types' => "xls|xlsx|csv",
'overwrite' => TRUE,
'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
//'max_height' => "768",
//'max_width' => "1024"
);
   $result;
   $this->upload->initialize($config);
$this->load->library('upload', $config);

        
         if($this->upload->do_upload())
         {
         $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
         $file_name = $upload_data['file_name']; //uploded file name
		 $extension=$upload_data['file_ext'];    // uploded file extension
		
        $objReader =PHPExcel_IOFactory::createReader('Excel5');     //For excel 2003 
        $objReader= PHPExcel_IOFactory::createReader('Excel2007');	// For excel 2007 	  
          //Set to read only
          $objReader->setReadDataOnly(true); 		  
        //Load excel file
		 $objPHPExcel=$objReader->load('./uploads/excel/'.$file_name);		 
         $totalrows=$objPHPExcel->setActiveSheetIndex(0)->getHighestRow();   //Count Numbe of rows avalable in excel      	 
         $objWorksheet=$objPHPExcel->setActiveSheetIndex(0);                
          //loop from first data untill last data
          for($i=2;$i<=$totalrows;$i++)
          {
          $name= $objWorksheet->getCellByColumnAndRow(0,$i)->getValue();			
          $reg_number= $objWorksheet->getCellByColumnAndRow(1,$i)->getValue(); //Excel Column 1
          $course_code= $objWorksheet->getCellByColumnAndRow(2,$i)->getValue(); //Excel Column 2
	  
	  $data_user=array('name'=>$name, 'reg_number'=>$reg_number ,'course_code'=>$course_code);
	  $this->excelModel->Add_User($data_user);
              
						  
          }
          $result= array(
              'status' =>'success',
              'message' =>'File is uploaded successfully');
           $this->session->set_flashdata('message', 'File is uploaded successfully');
          
             unlink('./uploads/excel/'.$file_name); //File Deleted After uploading in database .			 
             //redirect(base_url() . "put link were you want to redirect");
             
         }
         else {
             $result= array(
              'status' =>'error',
              'message' =>'Error uploading file');
               $this->session->set_flashdata('message', 'Error uploading file');   
             }
	     //$this->load->view('/user/user_view', $result); 
             redirect( $this->agent->referrer());
       
     }
     
     
     	
public	function excelUpload_addSubjects($course_id)	
        {  
    
    $config = array(
'upload_path' =>'./uploads/excel/',
'allowed_types' => "xls|xlsx|csv",
'overwrite' => TRUE,
'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
//'max_height' => "768",
//'max_width' => "1024"
);
   $result;
   $this->upload->initialize($config);
$this->load->library('upload', $config);

        
         if($this->upload->do_upload())
         {
         $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
         $file_name = $upload_data['file_name']; //uploded file name
		 $extension=$upload_data['file_ext'];    // uploded file extension
		
        $objReader =PHPExcel_IOFactory::createReader('Excel5');     //For excel 2003 
        $objReader= PHPExcel_IOFactory::createReader('Excel2007');	// For excel 2007 	  
          //Set to read only
          $objReader->setReadDataOnly(true); 		  
        //Load excel file
		 $objPHPExcel=$objReader->load('./uploads/excel/'.$file_name);		 
         $totalrows=$objPHPExcel->setActiveSheetIndex(0)->getHighestRow();   //Count Numbe of rows avalable in excel      	 
         $objWorksheet=$objPHPExcel->setActiveSheetIndex(0);                
          //loop from first data untill last data
          for($i=2;$i<=$totalrows;$i++)
          {
          $name= $objWorksheet->getCellByColumnAndRow(0,$i)->getValue();			
          $course_code= $objWorksheet->getCellByColumnAndRow(1,$i)->getValue(); //Excel Column 1
          $credits= $objWorksheet->getCellByColumnAndRow(2,$i)->getValue(); //Excel Column 2
          $semester= $objWorksheet->getCellByColumnAndRow(3,$i)->getValue(); //Excel Column 2
          $core= $objWorksheet->getCellByColumnAndRow(4,$i)->getValue(); //Excel Column 2
          $course_id= $objWorksheet->getCellByColumnAndRow(5,$i)->getValue(); //Excel Column 2
	  
	  $data_subjects=array(
              'name'=>$name, 
              'course_code'=>$course_code,
              'credits'=>$credits ,
              'semester'=>$semester,
              'core'=>$core,
              'course_id'=>$course_id,
              );
          
	  $this->excelModel->Add_Subjects($data_subjects);
              
						  
          }
          $result= array(
              'status' =>'success',
              'message' =>'File is uploaded successfully');
           $this->session->set_flashdata('message', 'File is uploaded successfully');
          
             unlink('./uploads/excel/'.$file_name); //File Deleted After uploading in database .			 
             //redirect(base_url() . "put link were you want to redirect");
             
         }
         else {
             $result= array(
              'status' =>'error',
              'message' =>'Error uploading file');
               $this->session->set_flashdata('message', 'Error uploading file');   
             }
             
       //$this->load->view('/member/home', $result);     
             redirect( $this->agent->referrer());
       
     }
     
     public function excelUpload_addStudnet($course_id)	
        {  
    
    $config = array(
'upload_path' =>'./uploads/excel/',
'allowed_types' => "xls|xlsx|csv",
'overwrite' => TRUE,
'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
//'max_height' => "768",
//'max_width' => "1024"
);
   $result;
   $this->upload->initialize($config);
$this->load->library('upload', $config);

        
         if($this->upload->do_upload())
         {
         $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
         $file_name = $upload_data['file_name']; //uploded file name
		 $extension=$upload_data['file_ext'];    // uploded file extension
		
        $objReader =PHPExcel_IOFactory::createReader('Excel5');     //For excel 2003 
        $objReader= PHPExcel_IOFactory::createReader('Excel2007');	// For excel 2007 	  
          //Set to read only
          $objReader->setReadDataOnly(true); 		  
        //Load excel file
		 $objPHPExcel=$objReader->load('./uploads/excel/'.$file_name);		 
         $totalrows=$objPHPExcel->setActiveSheetIndex(0)->getHighestRow();   //Count Numbe of rows avalable in excel      	 
         $objWorksheet=$objPHPExcel->setActiveSheetIndex(0);                
          //loop from first data untill last data
          for($i=2;$i<=$totalrows;$i++)
          {
          $name= $objWorksheet->getCellByColumnAndRow(0,$i)->getValue();			
          $reg_number= $objWorksheet->getCellByColumnAndRow(1,$i)->getValue(); //Excel Column 1
          
	  
	  $data_students=array('name'=>$name, 'reg_number'=>$reg_number ,'course_id'=>$course_id);
	  $this->excelModel->add_students($data_students);
          //$data_initialize=array('reg_number'=>$reg_number ,'course_id'=>$course_id);
          //$this->mark->initialize_marks_onupload($data_initialize);
              
						  
          }
          $result= array(
              'status' =>'success',
              'message' =>'File is uploaded successfully');
           $this->session->set_flashdata('message', 'File is uploaded successfully');
          
             unlink('./uploads/excel/'.$file_name); //File Deleted After uploading in database .			 
             //redirect(base_url() . "put link were you want to redirect");
             
         }
         else {
             $result= array(
              'status' =>'error',
              'message' =>'Error uploading file');
               $this->session->set_flashdata('message', 'Error uploading file');   
             }
             
           //$this->load->view('/member/home', $result);      
           redirect( $this->agent->referrer());
       
     }
     
      public function excelUpload_addStudnet_general()	
        {  
    
    $config = array(
'upload_path' =>'./uploads/excel/',
'allowed_types' => "xls|xlsx|csv",
'overwrite' => TRUE,
'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
//'max_height' => "768",
//'max_width' => "1024"
);
   $result;
   $this->upload->initialize($config);
$this->load->library('upload', $config);

        
         if($this->upload->do_upload())
         {
         $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
         $file_name = $upload_data['file_name']; //uploded file name
		 $extension=$upload_data['file_ext'];    // uploded file extension
		
        $objReader =PHPExcel_IOFactory::createReader('Excel5');     //For excel 2003 
        $objReader= PHPExcel_IOFactory::createReader('Excel2007');	// For excel 2007 	  
          //Set to read only
          $objReader->setReadDataOnly(true); 		  
        //Load excel file
		 $objPHPExcel=$objReader->load('./uploads/excel/'.$file_name);		 
         $totalrows=$objPHPExcel->setActiveSheetIndex(0)->getHighestRow();   //Count Numbe of rows avalable in excel      	 
         $objWorksheet=$objPHPExcel->setActiveSheetIndex(0);                
          //loop from first data untill last data
          for($i=2;$i<=$totalrows;$i++)
          {
          $name= $objWorksheet->getCellByColumnAndRow(0,$i)->getValue();			
          $reg_number= $objWorksheet->getCellByColumnAndRow(1,$i)->getValue(); //Excel Column 1
          $year_joined= $objWorksheet->getCellByColumnAndRow(2,$i)->getValue();
          $course_id= $objWorksheet->getCellByColumnAndRow(3,$i)->getValue();
          $dept_id= $objWorksheet->getCellByColumnAndRow(4,$i)->getValue();
          
	  
	  $data_students=array('name'=>$name, 'reg_number'=>$reg_number ,'year_joined'=>$year_joined,'course_id'=>$course_id,'dept_id'=>$dept_id);
	  $this->excelModel->add_students($data_students);
          //$data_initialize=array('reg_number'=>$reg_number ,'course_id'=>$course_id);
          //$this->mark->initialize_marks_onupload($data_initialize);
              
						  
          }
          $result= array(
              'status' =>'success',
              'message' =>'File is uploaded successfully');
           $this->session->set_flashdata('message', 'File is uploaded successfully');
          
             unlink('./uploads/excel/'.$file_name); //File Deleted After uploading in database .			 
             //redirect(base_url() . "put link were you want to redirect");
             
         }
         else {
             $result= array(
              'status' =>'error',
              'message' =>'Error uploading file');
               $this->session->set_flashdata('message', 'Error uploading file');   
             }
             
           //$this->load->view('/member/home', $result);      
           redirect( $this->agent->referrer());
       
     }
     
     

     
     
     /*
      * 
      * 
      * 
      * 
      */
     
     
     
      public function excelUpload_importMarks($subject_id)	
        {  
    
    $config = array(
'upload_path' =>'./uploads/excel/',
'allowed_types' => "xls|xlsx|csv",
'overwrite' => TRUE,
'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
//'max_height' => "768",
//'max_width' => "1024"
);
   $result;
   $this->upload->initialize($config);
$this->load->library('upload', $config);

        
         if($this->upload->do_upload())
         {
         $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
         $file_name = $upload_data['file_name']; //uploded file name
		 $extension=$upload_data['file_ext'];    // uploded file extension
		
        $objReader =PHPExcel_IOFactory::createReader('Excel5');     //For excel 2003 
        $objReader= PHPExcel_IOFactory::createReader('Excel2007');	// For excel 2007 	  
          //Set to read only
          $objReader->setReadDataOnly(true); 		  
        //Load excel file
		 $objPHPExcel=$objReader->load('./uploads/excel/'.$file_name);		 
         $totalrows=$objPHPExcel->setActiveSheetIndex(0)->getHighestRow();   //Count Numbe of rows avalable in excel      	 
         $objWorksheet=$objPHPExcel->setActiveSheetIndex(0);                
          //loop from first data untill last data
         
         $markFor=$objWorksheet->getCellByColumnAndRow(1,1)->getValue();
         //Below condition to restric user only to affect limited fields permistted below
         if ($markFor != 'internal1' || $markFor != 'internal2' || $markFor != 'other' || $markFor != 'external1' ||$markFor != 'external2')
             return;
         
          for($i=2;$i<=$totalrows;$i++)
          {
          $reg_number= $objWorksheet->getCellByColumnAndRow(0,$i)->getValue();			
          $internal_mark= $objWorksheet->getCellByColumnAndRow(1,$i)->getValue(); //Excel Column 1
          
	  
	  $data_marks=array( $markFor=>$internal_mark);
          $where=array('reg_number'=>$reg_number,'subject_id'=>$subject_id);
          
	  $this->excelModel->add_internal_marks($data_marks,$where);
					  
          }
          
          
          
          
          $result= array(
              'status' =>'success',
              'message' =>'File is uploaded successfully');
           $this->session->set_flashdata('message', 'File is uploaded successfully');
          
             unlink('./uploads/excel/'.$file_name); //File Deleted After uploading in database .			 
             //redirect(base_url() . "put link were you want to redirect");
             
         }
         else {
             $result= array(
              'status' =>'error',
              'message' =>'Error uploading file');
               $this->session->set_flashdata('message', 'Error uploading file');   
             }
             
           //$this->load->view('/member/home', $result);      
           redirect( $this->agent->referrer());
       
     }
     
     
     
     
	
}
?>