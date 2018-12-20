<?php
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class Classroutine extends MY_Controller{
    public function __construct() {
        parent::__construct();
        $this->student_logged_auth();


        $this->load->model('admin/classroutine/ClassroutineModleAdmin', 'ClassroutineModleAdmin');
    }
      
    public function showclassroutine() {

        $username = $this->session->userdata('studentId');
      //  print_r($username); die();
        if(!empty($username))
        {
            $info = getstudentNameInfo($username);
            $data['programOfferId']=$info['programOfferId'];

            $data['classroutineinfo']= $this->ClassroutineModleAdmin->select_new_routine($data);
            //print_r($data['classroutineinfo']); die();
            if(!empty($data['classroutineinfo']))
            {
                $data['classroutine'] = 'active';       
                $data['timetable'] = 'active';
                
                $this->load->view('system_path/student/common/header_link'); // header Css link
                $this->load->view('system_path/student/common/header'); // body header
                $this->load->view('system_path/student/common/side_menu', $data); // side bar menu
                $this->load->view('system_path/student/classroutine/viewclass_routine', $data); // ...........body content page...........
                $this->load->view('system_path/student/common/footer'); // footer & script link
            }
            else{
                //echo "oiiiis"; die();
                $sdata = array();
                $sdata['errormessage'] = "No Classroutine Found";
                $this->session->set_userdata($sdata);
               redirect(student_Url() . "/home");
            }
        }
        else{
                $sdata['errormessage'] = "No Classroutine Found";
                $this->session->set_userdata($sdata);
               redirect(student_Url() . "/home");
            }
        
    }

}
