<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        $this->load->model('teacher/user/Usermodellogin', 'Mod_login');
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
        

            $this->load->view('system_path/teacher/login/index');
            
 
        } else {
            
            $teacher_data = $this->Mod_login->login_info();

//        print_r($admin_data); exit;
            if ($teacher_data['login_validation'] == FALSE) {
                 $sdata['errormessage'] = 'Username & Password invalid!';
                $this->session->set_userdata($sdata);
                redirect(base_url('e_teacher/login'));
            } else {
                $session_data = array(
                    't_loginId' => $teacher_data['t_loginId'],
                    'emp_userName' => $teacher_data['emp_userName'],
                    'hr' => $teacher_data['hr'],
                    'hrAdmin' => $teacher_data['hrAdmin'],
                    'academic' => $teacher_data['academic'],
                    'academicAdmin' => $teacher_data['academicAdmin'],
                    'finance' => $teacher_data['finance'],
                    'financeAdmin' => $teacher_data['financeAdmin'],
                    'admissionAndResult' => $teacher_data['admissionAndResult'],
                    'admissionAndResultAdmin' => $teacher_data['admissionAndResultAdmin'],
                    'et_logged_info' => TRUE
                );

                $this->session->set_userdata($session_data);
                redirect(base_url('e_teacher'));
            }
        }
    }
}
