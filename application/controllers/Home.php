<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends MY_Controller {
    
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
 
  public function index() {
    $this->middle = 'home'; // passing middle to function. change this for different views.
    $this->layout();
  }
}