<?php if (!defined('BASEPATH'))  exit('No direct script access allowed');
/**
 * controller for auth
 */
class MY_Controller extends CI_Controller {

    function __construct() {
        parent::__construct();
        
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 	
      
    }   
    
    public function my_admin(){
         if ($this->session->userdata('logged_info') == FALSE) {
            redirect(base_url('systemaccess/login'));
        }
    }
    
    //teacher login auth
        public function account_access() {
        $crs_info = $this->session->userdata('et_logged_info');
        if($crs_info == FALSE){
           redirect(base_url('accounts_admin/login'));
        }
    } 
    
    public function teacher_logged_auth() {
        $teacher_info = $this->session->userdata('et_logged_info');
        if($teacher_info == FALSE){
           redirect(base_url('e_teacher/login'));
        }
    } 
    
    public function student_logged_auth(){
        $studentlogged_info = $this->session->userdata('es_logged_info');
        if ($studentlogged_info == FALSE){
            redirect(base_url('e_student/login'));
        }
    }
    
    //accountant login auth
    public function accountant_logged_auth() {
        //student logged_info
               
        $accountantlogged_info = $this->session->userdata('accountantlogged_info');
        if ($accountantlogged_info == FALSE) {
           redirect(base_url('accountant/login'));
        }
    }
    
  //adminaccountant login auth
    public function adminaccountant_logged_auth() {
        //student logged_info
              
        $adminaccountantlogged_info = $this->session->userdata('adminaccountantlogged_info');
        if ($adminaccountantlogged_info == FALSE) {
           redirect(base_url('adminaccountant/login'));
        }
    }  
        
    
    
 //adminteacher login auth
    public function adminteacher_logged_auth() {
        //student logged_info
                      
        $adminteacher_info = $this->session->userdata('adminteacherlogged_info');
        if ($adminteacher_info == FALSE) {
           redirect(base_url('adminteacher/login'));
        }
    } 
  //register login auth
    public function register_logged_auth() {
        //student logged_info
         	
                
        $register_info = $this->session->userdata('registerlogged_info');
        if ($register_info == FALSE) {
           redirect(base_url('register/login'));
        }
    }   
   
    
}