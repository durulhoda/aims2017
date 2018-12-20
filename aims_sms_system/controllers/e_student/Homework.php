<?php
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */

class Homework extends MY_Controller{
    public function __construct() {
        parent::__construct();
        $this->student_logged_auth();
       
        $this->load->helper('text');
        $this->load->model('admin/student/StudentModleAdmin', 'StudentModleAdmin');
        $this->load->model('admin/homework/HomeworkModleAdmin', 'HomeworkModleAdmin');

    }

    public function searchhomework() {
       $username=$this->session->userdata('studentId');
        $info = getstudentNameInfo($username);

        //    print_r($teacher); die();
        if (!empty($info)) {
            $valuess = getCourseIdByStudent($info);          
        
            $data['programOfferId'] = $valuess['programOfferId'];
            $data['homeworklist'] = $this->HomeworkModleAdmin->searchhomework($data);
            $data['Teacher'] = $this->HomeworkModleAdmin->getteacherinfo();
       //  print_r($data['Teacher']); die();
            
            if (!empty($data['homeworklist'])) {
              $this->load->view('system_path/student/common/header_link'); // header Css link
                $this->load->view('system_path/student/common/header'); // body header
                $this->load->view('system_path/student/common/side_menu', $data); // side bar menu
                $this->load->view('system_path/student/homework/index', $data); // ...........body content page...........
                $this->load->view('system_path/student/common/footer'); // footer & script link
            } else {
                $sdata['errormessage'] = 'No Homework Found';
                $this->session->set_userdata($sdata);
                 $this->load->view('system_path/student/common/header_link'); // header Css link
                $this->load->view('system_path/student/common/header'); // body header
                $this->load->view('system_path/student/common/side_menu', $data); // side bar menu
                $this->load->view('system_path/student/homework/index', $data); // ...........body content page...........
                $this->load->view('system_path/student/common/footer'); // footer & script link
            }
        } else {
            redirect(student_Url() . "/home");
        }
    }

    public function homeworklist($programOfferId, $courseId) {

        $username = $this->session->userdata('username');
        $info = getstudentNameInfo($username);

        if (!empty($info)) {
            $valuess = getCourseIdByStudent($info);
            $explodeCourse = explode(',', trim($valuess['courseId'])); // explode courseId
            // loop courseId  & match selected  programOfferId & courseId  with sha1 encryyption
            for ($i = 1; $i < count($explodeCourse) - 1; $i++) {
                if ($programOfferId == sha1($valuess['programOfferId']) && $courseId == sha1($explodeCourse[$i])) {
                    $data['courseId'] = $explodeCourse[$i];
                    $data['programOfferId'] = $valuess['programOfferId'];
                }
            }

            if (empty($data)) {
                $sdata['errormessage'] = 'No Homework Found';
                $this->session->set_userdata($sdata);             

                redirect('student/homework/searchhomework', 'refresh');
            } else {
                $data['homeworklist'] = $this->HomeworkModleAdmin->searchhomework($data);

                if (!empty($data['homeworklist'])) {
                        $this->load->view('system_path/student/common/header_link'); // header Css link
                $this->load->view('system_path/student/common/header'); // body header
                $this->load->view('system_path/student/common/side_menu', $data); // side bar menu
                $this->load->view('system_path/student/homework/homeworklist', $data); // ...........body content page...........
                $this->load->view('system_path/student/common/footer'); // footer & script link
                } else {
                    $sdata['errormessage'] = 'No Homework Found...!';
                    $this->session->set_userdata($sdata);                    
                    redirect(student_Url() . "/home");
                }
            }
        } else {
            $sdata['errormessage'] = 'No Subject Found...!';
            $this->session->set_userdata($sdata);

            redirect(student_Url() . "/home");
        }
    }

    public function viewhomework($id) {
        $username=$this->session->userdata('studentId');
        if ($id != Null) {
            $data['editData'] = $this->HomeworkModleAdmin->edithomeworkInfo($id);
            $data['Studentinfo'] = $this->StudentModleAdmin->getstudentNameInfo($username);
            if (!empty($data['editData'])) {    
                $this->load->view('system_path/student/common/header_link'); // header Css link
                $this->load->view('system_path/student/common/header'); // body header
                $this->load->view('system_path/student/common/side_menu', $data); // side bar menu
                $this->load->view('system_path/student/homework/viewdetails', $data); // ...........body content page...........
                $this->load->view('system_path/student/common/footer'); // footer & script link
            } else {
                $sdata['errormessage'] = 'No Data Found...!';
                $this->session->set_userdata($sdata);

                redirect('student/homework/searchhomework', 'refresh');
            }
        } else {
            $sdata['errormessage'] = 'No Data Found...!';
            $this->session->set_userdata($sdata);

            redirect('student/homework/searchhomework', 'refresh');
        }
    }

    //put your code here
}

