<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        $this->load->model('accounts/Accountsmodleadmin', 'Accountsmodleadmin');
    }

    public function index() {
        
        $this->load->helper(array('form', 'html', 'url'));
        $this->load->library('form_validation');
		
		$config = array(
		'username' => array(
			''
		) );
		
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
        

            $this->load->view('system_path/accounts/login/index');
            
 
        } else {
            
            $crs_data = $this->Accountsmodleadmin->login_info();
          // print_r($crs_data); die();
//        print_r($admin_data); exit;
            if ($crs_data['login_validation'] == FALSE) {
                 $sdata['errormessage'] = 'Username & Password invalid!';
                $this->session->set_userdata($sdata);
                redirect(base_url('accounts_admin/login'));
            } else {
                $session_data = array(
                    'aims_id' => $crs_data['aims_id'],
                    'access_userName' => $crs_data['access_userName'],
                   
                    'et_logged_info' => TRUE
                );

                $this->session->set_userdata($session_data);
              
                redirect(base_url('accounts_admin'));
            }
        }
    }
}
