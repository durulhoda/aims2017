<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */

class Course extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->my_admin();
        $this->load->model('admin/course/CourseModleAdmin', 'CourseModleAdmin');
    }

    public function index() {

        $data['courselist'] = $this->CourseModleAdmin->getlistCourse();
        $data['setting'] = 'active';
        $data['subsetting'] = 'active';
        $data['subject'] = 'active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu'); // top bar menu
        $this->load->view('system_path/admin/course/index', $data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
    }

    public function insertcourse() {
        // print_r($_POST);
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
            array(
                'field' => 'data[courseName]',
                'label' => 'subjectname',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[courseCode]',
                'label' => 'Subject Code',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[programLevel]',
                'label' => 'Class/Program Level',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $data = $this->input->post('data', TRUE);
            $result = $this->CourseModleAdmin->duplicateCourseInfo($data);

            if (!$result) {
                $this->CourseModleAdmin->addCourseInfo($data);
                $sdata['message'] = 'Successfull!';
                $this->session->set_userdata($sdata);

                redirect(base_url('systemaccess/course'));
            } else {
                $sdata['message'] = 'Duplicate subject information found';
                $this->session->set_userdata($sdata);

                redirect(base_url('systemaccess/course'));
            }
        }
    }

    public function editdcourse($id) {

        $data['editData'] = $this->CourseModleAdmin->editCourseInfo($id);
        $data['courselist'] = $this->CourseModleAdmin->getlistCourse();
        if (!empty($data['editData'])) {
            $data['setting'] = 'active';
            $data['subsetting'] = 'active';
            $data['subject'] = 'active';
            $this->load->view('system_path/admin/common/header_link'); // header Css link
            $this->load->view('system_path/admin/common/header'); // body header
            $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
            $this->load->view('system_path/admin/common/top_menu'); // top bar menu
            $this->load->view('system_path/admin/course/edit_course', $data); // ...........body content page...........
            $this->load->view('system_path/admin/common/footer'); // footer & script link
        } else {
            $sdata['errormessage'] = 'Subject Information not found!';
            $this->session->set_userdata($sdata);
            redirect(base_url('systemaccess/course'));
        }
    }

    public function updatecourse($id) {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

//        print_r($_POST);
        $config = array(
            array(
                'field' => 'data[courseName]',
                'label' => 'subject',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[courseCode]',
                'label' => 'Subject Code',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[programLevel]',
                'label' => 'Class/Program Level',
                'rules' => 'required'
            )
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $data = $this->input->post('data', TRUE);
            $result = $this->CourseModleAdmin->duplicateCourseInfo($data);

            if (!$result) {
                $this->CourseModleAdmin->updateCourseInfo($data, $id);
                $sdata['message'] = 'Subject Information updated';
                $this->session->set_userdata($sdata);

                redirect(base_url('systemaccess/course/searchSubjectByLv'));
            } else {
                $sdata['message'] = 'Duplicate Subject Information Found!';
                $this->session->set_userdata($sdata);

                redirect(base_url('systemaccess/course/searchSubjectByLv'));
            }
        }
    }

    public function deletecourse($id) {
        $id = (int) $id;

        $data['course'] = $this->CourseModleAdmin->checkCourseInfo($id);
        // print_r($data); die();
        if (!empty($data['course'])) {
            $sdata['errormessage'] = 'Course Information Not Delete..! Because Already Use This Anothor Portion..! So Please Contact your Software Administrator..';
            $this->session->set_userdata($sdata);
            redirect(base_url('systemaccess/course'));
        } else {
            $this->CourseModleAdmin->deleteCourseInfo($id);
            $sdata['message'] = 'Course Type information deleted';
            $this->session->set_userdata($sdata);
            redirect(base_url('systemaccess/course/searchSubjectByLv'));
        }
    }

    public function searchSubjectByLv() {

        $data['courselist'] = $this->CourseModleAdmin->getlistCourse();
        $data['setting'] = 'active';
        $data['subsetting'] = 'active';
        $data['subjectlist'] = 'active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu'); // top bar menu
        $this->load->view('system_path/admin/course/courselistByProgammLevel', $data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
    }

    public function searchSubjectList() {
        $data = $this->input->post('data', TRUE);
        //  print_r($data); die();
        $data['courselistby_PL'] = $this->CourseModleAdmin->getlistbyprogramLevel($data);
        
        if (!empty($data['courselistby_PL'])) {
            $data['setting'] = 'active';
            $data['subsetting'] = 'active';
            $data['subjectlist'] = 'active';
            $this->load->view('system_path/admin/common/header_link'); // header Css link
            $this->load->view('system_path/admin/common/header'); // body header
            $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
            $this->load->view('system_path/admin/common/top_menu'); // top bar menu
            $this->load->view('system_path/admin/course/courselistByProgammLevel', $data); // ...........body content page...........
            $this->load->view('system_path/admin/common/footer'); // footer & script link
        } else {
            $sdata['errormessage'] = 'Subject Information Not Found';
            $this->session->set_userdata($sdata);
            redirect(base_url('systemaccess/course/searchSubjectByLv'));
        }
    }

    //put your code here
}
