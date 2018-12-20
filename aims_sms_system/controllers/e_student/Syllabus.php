<?php

/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class Syllabus extends MY_Controller{
    public function __construct() {
        parent::__construct();
        $this->student_logged_auth();
        
        $this->load->helper('text');
        $this->load->model('admin/syllabus/SyllabusModleAdmin', 'SyllabusModleAdmin');
        $this->load->model('admin/student/StudentModleAdmin', 'StudentModleAdmin');
        $this->load->model('admin/homework/HomeworkModleAdmin', 'HomeworkModleAdmin');
    }

    public function index() {

        $username = $this->session->userdata('studentId');
        $info = getstudentNameInfo($username);
        
        if(!empty($info))
        {
            $valuess = getCourseIdByStudent($info);
          //  print_r($info); die();
            $data['syllabus']='active';
            $data['programOfferId']= $valuess['programOfferId'];
            $data['syllabuslist'] = $this->SyllabusModleAdmin->searchsyllabuslistByStudent($data);
             $data['Teacher'] = $this->HomeworkModleAdmin->getteacherinfo();
            //print_r($data);            die();
            if (!empty($data['syllabuslist'])) {
               $this->load->view('system_path/student/common/header_link'); // header Css link
                $this->load->view('system_path/student/common/header'); // body header
                $this->load->view('system_path/student/common/side_menu', $data); // side bar menu
                $this->load->view('system_path/student/syllabus/index'); // ...........body content page...........
                $this->load->view('system_path/student/common/footer'); // footer & script link
            }
            else {
                    $sdata['errormessage'] = 'No Syllabus Found';
                $this->session->set_userdata($sdata);
                $this->load->view('system_path/student/common/header_link'); // header Css link
                $this->load->view('system_path/student/common/header'); // body header
                $this->load->view('system_path/student/common/side_menu', $data); // side bar menu
                $this->load->view('system_path/student/syllabus/index'); // ...........body content page...........
                $this->load->view('system_path/student/common/footer'); // footer & script link;
            }
        }
        else {
                redirect(student_Url() . "/home");
              }    
    }

    public function searchsyllabuslist($programOfferId,$courseId) {

        $username = $this->session->userdata('username');
        $info = getstudentNameInfo($username);
        
        if(!empty($info))
        {
            $valuess = getCourseIdByStudent($info);
            $explodeCourse = explode(',', trim($valuess['courseId'])); // explode courseId
            
            // loop courseId  & match selected  programOfferId & courseId  with sha1 encryyption
            for ($i = 1; $i < count($explodeCourse) - 1; $i++) {
                if($programOfferId == sha1($valuess['programOfferId']) && $courseId == sha1($explodeCourse[$i]))
                {
                    $data['courseId']= $explodeCourse[$i];
                    $data['programOfferId']= $valuess['programOfferId'];
                }
            }
                        
                if (empty($data)) {
                    $sdata['errormessage'] = 'No Syllabus Found';
                    $this->session->set_userdata($sdata);

                    redirect('student/syllabus','refresh');
                } else {
                    $data['syllabuslist'] = $this->SyllabusModleAdmin->searchsyllabuslistByStudent($data);

                    if (!empty($data['syllabuslist'])) {
                        $this->load->view('templates/student/common/header');
                        $this->load->view('templates/student/syllabus/syllabuslist', $data);
                        $this->load->view('templates/student/common/footer');
                    } else {
                        $sdata['errormessage'] = 'No Syllabus Found...!';
                        $this->session->set_userdata($sdata);

                        $this->load->view('templates/student/common/header');
                        $this->load->view('templates/student/syllabus/syllabussearch');
                        $this->load->view('templates/student/common/footer');
                    }
                } 
                
        }else {
                    redirect(base_url('student/login'));
                }
    }
    public function viewsyllabus($id){ 
    $username=$this->session->userdata('studentId');     
        if ($id != Null) {
            $data['editData'] = $this->SyllabusModleAdmin->editSyllabusInfo($id);
            $data['Studentinfo'] = $this->StudentModleAdmin->getstudentNameInfo($username);
            if (!empty($data['editData'])) {
                $data['syllabus']='active';
                $this->load->view('system_path/student/common/header_link'); // header Css link
                $this->load->view('system_path/student/common/header'); // body header
                $this->load->view('system_path/student/common/side_menu', $data); // side bar menu
                $this->load->view('system_path/student/syllabus/viewsyllabus'); // ...........body content page...........
                $this->load->view('system_path/student/common/footer'); // footer & script link;
            }
            else{
                $sdata['errormessage'] = 'No Syllabus Found';
                $this->session->set_userdata($sdata);
                redirect('student/syllabus','refresh');
            }
        }
        else{
            $sdata['errormessage'] = 'No Syllabus Found';
            $this->session->set_userdata($sdata);
            redirect('student/syllabus','refresh');
        }
    }

}