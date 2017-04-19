<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Controller extends CI_Controller 
 { 
   //set the class variable.
   var $template  = array();
   var $data      = array();
   //Load layout    
   public function layout() {
     // making temlate and send data to view.
     // making <head> html section for page to place css, title & script includes
     $this->template['head']   = $this->load->view('layout/head', $this->data, true);
     
     // This section is used for adding scripts
     $this->template['scripts'] = $this->load->view('layout/scripts', $this->data, true);
     
     //this section is for Header area to place items like menu and site name
     $this->template['header']   = $this->load->view('layout/header', $this->data, true);
     
     //This section can be used as left side panel
     $this->template['left']   = $this->load->view('layout/left', $this->data, true);
     
      //This section can be used as left side panel
     $this->template['retina_menu']   = $this->load->view('layout/retina_menu', $this->data, true);
     $this->template['basic_menu']   = $this->load->view('layout/basic_menu', $this->data, true);
     
     
     // This section is for the content area
     $this->template['middle'] = $this->load->view($this->middle, $this->data, true);
     
     // This section is used for the footer area
     $this->template['footer'] = $this->load->view('layout/footer', $this->data, true);
     
     // This section is used for the modal forms
     $this->template['modal_forms'] = $this->load->view('layout/modal_forms', $this->data, true);
     
     // Loading all above sections in index
     $this->load->view('layout/index', $this->template);
   }
   
   public function print_layout(){
       
       $this->template['head']   = $this->load->view('layout/head', $this->data, true);
       
       $this->template['middle'] = $this->load->view($this->middle, $this->data, true);
       $this->template['footer'] = $this->load->view('layout/footer', $this->data, true);
       $this->load->view('layout/pdf_print', $this->template);
       //return $data;
   }
}