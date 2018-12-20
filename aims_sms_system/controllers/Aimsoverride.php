<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Aimsoverride extends CI_Controller {

	/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
    
     public function __construct() {
        parent::__construct();
        
    }
    
        public function index()
	{
            $data['title']="AIMS Institute System";
            $this->load->view('system_path/admin/common/header_link');
            $this->load->view('errors/error-404',$data);
            $this->load->view('system_path/admin/common/footer');
	}
      
        
        
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */