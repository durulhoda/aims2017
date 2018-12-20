<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */

class CourseAssign extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->teacher_logged_auth();
        $this->load->model('admin/courseassign/CourseAssignModleAdmin', 'CourseAssignModleAdmin');
    }

    public function index() {
        $this->load->library('form_validation');

        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/courseassign/index');
        $this->load->view('templates/admin/common/footer');
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
            )
        );
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
//                    redirect(base_url('admin/campus'));
            $this->load->view('templates/admin/common/header');
            $this->load->view('templates/admin/courseassign/index');
            $this->load->view('templates/admin/common/footer');
        } else {
            $data = $this->input->post('data', TRUE);
            $result = $this->CourseAssignModleAdmin->duplicateCourseInfo($data);

            if (!$result) {
                $this->CourseAssignModleAdmin->addCourseInfo($data);
                $sdata['message'] = 'Successfull!';
                $this->session->set_userdata($sdata);

                redirect('admin/course/listcourse', 'refresh');
            } else {
                $sdata['message'] = 'Duplicate Entry Found!';
                $this->session->set_userdata($sdata);

                redirect('admin/course/listcourse', 'refresh');
            }
        }
    }

    public function courseassignlist() {



        $data['courselist'] = $this->CourseAssignModleAdmin->getlistCourse();
//        print_r($sectionlist);
        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/course/courselist', $data);
        $this->load->view('templates/admin/common/footer');
    }

    public function editdcourse($id) {

//        echo $id; exit;
        $this->load->view('templates/admin/common/header');

        $data['editData'] = $this->CourseAssignModleAdmin->editCourseInfo($id);
//        print_r($data);
        $this->load->view('templates/admin/course/editcourse', $data);
        $this->load->view('templates/admin/common/footer');
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
            )
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
//                    redirect(base_url('admin/section'));
            $this->load->view('templates/admin/common/header');
            $this->load->view('templates/admin/course/editcourse');
            $this->load->view('templates/admin/common/footer');
        } else {
            $data = $this->input->post('data', TRUE);
            $result = $this->CourseAssignModleAdmin->duplicateCourseInfo($data);

            if (!$result) {
                $this->CourseAssignModleAdmin->updateCourseInfo($data, $id);
                $sdata['message'] = 'Successfull!';
                $this->session->set_userdata($sdata);

                redirect('admin/course/listcourse', 'refresh');
            } else {
                $sdata['message'] = 'Duplicate Entry Found!';
                $this->session->set_userdata($sdata);

                redirect('admin/course/listcourse', 'refresh');
            }
        }
    }

    public function deletecourse($id) {


        $this->CourseAssignModleAdmin->deleteCourseInfo($id);
        redirect('admin/course/listcourse', 'refresh');
    }

    //put your code here
}

