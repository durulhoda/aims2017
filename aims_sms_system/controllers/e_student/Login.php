<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();        
        $this->load->model('student/user/Usermodellogin', 'Mod_login');
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
            $this->load->view('system_path/student/login/index');           

        } else {            
            $student_data = $this->Mod_login->login_info();
          
            if ($student_data['login_validation'] == FALSE) {
                 $sdata['errormessage'] = 'Username & Password invalid!';
                 $this->session->set_userdata($sdata);
                 redirect(base_url('e_student/login'));
            } else {
                 $session_data = array(
                    'stu_access_id' => $student_data['stu_access_id'],
                    'studentId' => $student_data['studentId'],
                    'access_power' => $student_data['access_power'],
                    'es_logged_info' => TRUE
                );

                $this->session->set_userdata($session_data);
                redirect(base_url('e_student/home'));
            }
        }
    }
}
