<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */

class Studentsattendance extends MY_Controller{
    public function __construct() {
        parent::__construct();
        $this->student_logged_auth();
        
        $this->load->model('admin/studentattendance/StudentattendanceModleAdmin', 'StudentattendanceModleAdmin');
        $this->load->model('admin/studentregistration/StudentregistrationModleAdmin', 'StudentregistrationModleAdmin');
    }

    public function index() {
      $data['attendance']='active';
                $this->load->view('system_path/student/common/header_link'); // header Css link
                $this->load->view('system_path/student/common/header'); // body header
                $this->load->view('system_path/student/common/side_menu', $data); // side bar menu
                $this->load->view('system_path/student/studentsattendance/index', $data); // ...........body content page...........
                $this->load->view('system_path/student/common/footer'); // footer & script link
    }

    
    // next function is for attendance insert by date when any one need attendance by date....     
    public function searchattendanceinfo() {

       
        $data = $this->input->post('data', TRUE);
       // print_r($data); die();
        if (empty($data['studentId']) || empty($data['fromDate'])) {
            $sdata['message'] = 'All field Required';
            $this->session->set_userdata($sdata);
             $data['attendance']='active';
                $this->load->view('system_path/student/common/header_link'); // header Css link
                $this->load->view('system_path/student/common/header'); // body header
                $this->load->view('system_path/student/common/side_menu', $data); // side bar menu
                $this->load->view('system_path/student/studentsattendance/index', $data); // ...........body content page...........
                $this->load->view('system_path/student/common/footer'); // footer & script link
        } else {
            $data['attendancelist'] = $this->StudentattendanceModleAdmin->getstudentattendance($data);
       //   echo "<pre>";  print_r($data); die();
            $data['attendance']='active';
                $this->load->view('system_path/student/common/header_link'); // header Css link
                $this->load->view('system_path/student/common/header'); // body header
                $this->load->view('system_path/student/common/side_menu', $data); // side bar menu
                $this->load->view('system_path/student/studentsattendance/index', $data); // ...........body content page...........
                $this->load->view('system_path/student/common/footer'); // footer & script link
        }
    }

    
}

