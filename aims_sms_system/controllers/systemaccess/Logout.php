<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */

class Logout extends MY_Controller {
    function __Construct(){
    parent::__construct();
    $this->my_admin();
    }
    
    public function index(){
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 		    					
		$this->session->unset_userdata('admin_id');
		$this->session->unset_userdata('fullname');
		$this->session->unset_userdata('group');
		$this->session->unset_userdata('email');
                $this->session->sess_destroy();
             
        redirect(base_url(),'refresh');
    }    
    
    
} 

