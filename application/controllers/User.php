<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class User extends CI_Controller
{

    
    
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
          $this->load->model('User_Model','user');
          //$this->load->model('person_model','person');
          
                  
             
     }

     //default view to load
     public function index(){
         //if($this->user->count_all()<1)
            $this->load->view('user/login_view'); //Navigate the request to Login
         //$this->load->view('user/user_view');
         //$this->load->view('user/user_view',array('error' => ' ' ));
          /*
            $result= array(
              'status' =>'',
              'message' =>'');
         $this->load->view('user/user_view',$result);
           * 
           */
         //else
           //  $this->load->view('user/login_view');
             //redirect('person');
     }
     
     //for ajax login
     public function user_login(){
           //get the posted values
          $username = $this->input->post("username");
          $password = $this->input->post("password");
          
          $usr_result = $this->user->get_user($username, $password);
                    if ($usr_result > 0)
                    {
                          //set the session variables
                         $sessiondata = array(
                              'username' => $username,
                              'loginuser' => TRUE
                         );
                         $this->session->set_userdata($sessiondata);
                        echo "1";
                        //redirect("person");
                    }
                    else {
                        echo "0";
                        //redirect("user");
                    }
                         
          //echo "<script>alert(".$username.$password.");</script>";
     }
     public function user_view()
     {
             $this->load->view('user/user_view');
     }
     
     public function user_register(){
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
		$insert = $this->user->save($data);
                echo "1";
            }
         else {
             echo "Password do not match";
                
            }
     }
     
     public function ajax_list()
	{
		$list = $this->user->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $person) {
                    if($person->role != 'Super'){
			$no++;
			$row = array();
			$row[] = $person->first_name;
			$row[] = $person->username;
			$row[] = $person->created;
			$row[] = $person->role;
			$row[] = $person->status;

			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_user('."'".$person->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_user('."'".$person->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
		
			$data[] = $row;
                    }
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->user->count_all(),
						"recordsFiltered" => $this->user->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

     
     
     // For adding User
     
        	public function ajax_edit($id)
	{
		$data = $this->user->get_by_id($id);
		$data->created = ($data->created == '0000-00-00') ? '' : $data->created; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		$data = array(
				'first_name' => $this->input->post('first_name'),
				'username' => $this->input->post('username'),
                                 'password' => md5($this->input->post('password')),
				//'created' => $this->input->post('created'),
                                'created' => date('Y-m-d H:i:s'),
				'role' => $this->input->post('role'),
				'status' => $this->input->post('status'),
			);
		$insert = $this->user->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
				'first_name' => $this->input->post('first_name'),
				'username' => $this->input->post('username'),
                                'password' => md5($this->input->post('password')),
				'modified' => date('Y-m-d H:i:s'),
				'role' => $this->input->post('role'),
				'status' => $this->input->post('status'),
			);
		$this->user->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$this->user->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}


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
     
}?>