<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('admin/user/Usermodellogin', 'Mod_login');
    }

    public function index() {

        // echo 'hello'; exit;

        $this->load->helper(array('form', 'html', 'url'));
        $this->load->library('form_validation');

        $config = array(
            'username' => array(
                ''
            ));

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {


            $this->load->view('system_path/admin/login/index');
        } else {

            $admin_data = $this->Mod_login->login_info();

//        print_r($admin_data); exit;
            if ($admin_data['login_validation'] == FALSE) {
                $sdata['errormessage'] = 'Username & Password invalid!';
                $this->session->set_userdata($sdata);
                redirect(base_url('systemaccess/login'));
            } else {
                $session_data = array(
                    'admin_id' => $admin_data['admin_id'],
                    'admin_name' => $admin_data['admin_name'],
                    'access_power' => $admin_data['access_power'],
                    'logged_info' => TRUE
                );
//        echo print_r($session_data); exit;
                $this->session->set_userdata($session_data);
                redirect(base_url('systemaccess'));
            }
        }
    }

}
