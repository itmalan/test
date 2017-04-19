<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Menu extends MY_Controller
{

     public function __construct()
     {
          parent::__construct();
    
          $this->load->library('session');
          $this->load->helper('url');
          $this->load->helper('html');
          $this->load->database();

          //load the login model
          $this->load->model('DB_Model','menu');
          //$this->load->model('person_model','person');      
     }

     
     public function getMenu($role)
     {
         $this->menu->get_MenuList($role);
                
     }
       public function getMenu1()
     {
         //$this->menu->table='menu';
         //$list = $this->menu->get_records();
         echo 'welcome to menu';
     }
     

     // Functions for the Controller
     
    
     
     
}?>