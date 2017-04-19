<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class Member extends MY_Controller
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
          //load the login model
          $this->load->model('Member_Model','member');
          $this->load->model('Course_Model','course');
          $this->load->model('Menu_Model','menu');
          
          //$this->load->model('person_model','person');
          
          if ($this->session->has_userdata('mms')){
                $this->userDetails=$this->session->userdata('mms');
                  $this->data['user']=$this->userDetails;
          }
     }

     //View Functions
     public function home(){
         if ($this->_chk_user()){
             
             $this->loadContent();
             $this->middle=('member/home'); 
           $this->layout();
         
         }
         else{
                $this->_base();
          }
             
     }
     //default view to load
     public function index(){
         
          if ($this->_chk_user()){
           $this->home();
          }
            else {
                $this->_base();
          }          
     }
     
     
     public function loadContent(){
         $courses=$this->course->get_by_dept($this->userDetails['dept']);
         $this->data['dataset1']=$courses;
     }
     

     //for ajax login
     public function user_login_fn(){
         if (!$this->_chk_user()){
           //get the posted values
          $username = $this->input->post("username");
          $password = $this->input->post("password");
          
          $usr_result = $this->member->check($username, $password);
                    if ($usr_result)
                    {
                        $user_data=$this->member->get_userDetails($username); 
                          //set the session variables
                         $sessiondata = array(
                             'id'=> $user_data->id,
                              'username' => $user_data->username,
                             'name'=>$user_data->first_name,
                              'logged_in' => TRUE,
                             'dept'=>$user_data->dept,
                             'role'=>$user_data->role, 
                         );
                         $this->session->set_userdata('mms',$sessiondata);
                        echo "1";
                        //redirect("person");
                    }
                    else {
                        echo "0";
                        //redirect("user");
                    }
                         
          //echo "<script>alert(".$username.$password.");</script>";
         }
     }
     
     
     // Logout from admin page
    public function user_logout_fn() {
        
        // Removing session data
        $sess_array = array(
                        'username' => '',
                        'logged_in'=>FALSE,
                        'role'=>'',
                         'id' =>''
                         );
        $this->session->unset_userdata('mms',$sess_array);
        $this->session->sess_destroy();
        $this->_base();
    }

     
     // Functions for the Controller
     public function show_users_view()
     {
         //checking user is logged in and 2 represent HOD role
         if($this->_chk_user() && $this->userDetails['role']==2 ){
         $this->middle=('member/users_view'); // passing middle to function. change this for different views.
           $this->layout();
         }
         else
             $this->_base();
     }

        public function get_users_fn()
	{
                if($this->_chk_user() && $this->userDetails['role']==2 && !empty($this->input->post())){
		$list = $this->member->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $person) {
                    if($person->role !='Super'){
			$no++;
			$row = array();
			$row[] = $person->first_name;
			$row[] = $person->username;
			$row[] = $person->created;
                        
                        $row[]=$this->member->get_role($person->role)->name;
			//$row[] = $person->role;
                        
			$row[] = $person->status;

			//add html for action
			//$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_user('."'".$person->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
			//	  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_user('."'".$person->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
                        $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_user('."'".$person->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="delete_form('."'".$person->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

			$data[] = $row;
                    }
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->member->count_all(),
						"recordsFiltered" => $this->member->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
                }
                else
             $this->_base();
	}  
     
        // For adding User

        public function edit_user_fn($id)
	{
                if($this->_chk_user()){
		$data = $this->member->get_by_id($id);
		//$data->created = ($data->created == '0000-00-00') ? '' : $data->created; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
                    }
                    else{
                        echo 'Invalid access';
                    }
	}

	public function add_user_fn()
	{
            if($this->_chk_user() && $this->userDetails['role']==2 && !empty($this->input->post())){
		$this->_validate();
                //$userDetails=$this->session->userdata('mms');
                
		$data = array(
				'first_name' => $this->input->post('first_name'),
				'username' => $this->input->post('username'),
                                 'password' => md5($this->input->post('password')),
				//'created' => $this->input->post('created'),
                                'created' => date('Y-m-d H:i:s'),
				'role' => $this->input->post('role'),
				'status' => $this->input->post('status'),
                                'dept'=>$this->userDetails['dept'],
			);
		$insert = $this->member->save($data);
		echo json_encode(array("status" => TRUE));
            }
            else
             $this->_base();
	}

	public function update_user_fn()
	{
            if($this->_chk_user() && $this->userDetails['role']==2 && !empty($this->input->post())){
		$this->_validate();
		$data = array(
				'first_name' => $this->input->post('first_name'),
				'username' => $this->input->post('username'),
                                'password' => md5($this->input->post('password')),
				'modified' => date('Y-m-d H:i:s'),
				'role' => $this->input->post('role'),
				'status' => $this->input->post('status'),
			);
		$this->member->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
                }
            else
             $this->_base();
	}

	public function delete_user_fn($id)
	{
            if($this->_chk_user() && $this->userDetails['role']==2){
		$this->member->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
                }
            else
             $this->_base();
	}

        
        
        
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

	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('first_name') == '')
		{
			$data['inputerror'][] = 'first_name';
			$data['error_string'][] = 'Name is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('username') == '')
		{
			$data['inputerror'][] = 'username';
			$data['error_string'][] = 'user name is required';
			$data['status'] = FALSE;
		}

                /*
		if($this->input->post('dob') == '')
		{
			$data['inputerror'][] = 'dob';
			$data['error_string'][] = 'Date of Birth is required';
			$data['status'] = FALSE;
		}
                */
		if($this->input->post('role') == '')
		{
			$data['inputerror'][] = 'role';
			$data['error_string'][] = 'Please select User Role';
			$data['status'] = FALSE;
		}

		if($this->input->post('status') == '')
		{
			$data['inputerror'][] = 'status';
			$data['error_string'][] = 'Status is required';
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
        
             public function listMenu()
     {
         $role=$this->session->userdata('role');
          echo "<script>alert(".$role.");</script>";
         $Menu_data=$this->menu->get_MenuList($role);
         return $Menu_data;
     }
     
          /*
      * This function is not used now
     public function user_register_fn(){
            //$this->_validate();
            $password=$this->input->post('password');
            $re_password=$this->input->post('re_password');
            if($password==$re_password){
            
		$data = array(
				'username' => $this->input->post('username'),
                                 'password' => md5($password),
				//'created' => $this->input->post('created'),
                                'created' => date('Y-m-d H:i:s'),
				'role' => 'Super',
				'status' => 'active',
			);
		$insert = $this->member->save($data);
                echo "1";
            }
         else {
             echo "Password do not match";
                
            }
     }
      * 
      */
     
     
}?>