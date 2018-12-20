<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */

class Syllabus extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->teacher_logged_auth();
        $this->load->helper('text');
        $this->load->model('admin/syllabus/SyllabusModleAdmin', 'SyllabusModleAdmin');
    }

    public function index() {
       
        $data['syllabus'] = 'active';
        $data['addsyllabus'] = 'active';

        $this->load->view('system_path/teacher/common/header_link'); // header Css link
        $this->load->view('system_path/teacher/common/header'); // body header
        $this->load->view('system_path/teacher/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/teacher/syllabus/index'); // ...........body content page...........
        $this->load->view('system_path/teacher/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
    }

    public function insertsyllabus() {
//        print_r($_POST); exit;
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
            
            array(
                'field' => 'datax[mediumId]',
                'label' => 'Medium Name',
                'rules' => 'required'
            ),
            array(
                'field' => 'datax[programId]',
                'label' => 'Class Name',
                'rules' => 'required'
            ),
            array(
                'field' => 'datax[groupId]',
                'label' => 'Group Name',
                'rules' => 'required'
            ),
            array(
                'field' => 'datax[shiftId]',
                'label' => 'Shift Name',
                'rules' => 'required'
            ),
            array(
                'field' => 'datax[sectionId]',
                'label' => 'Section',
                'rules' => 'required'
            ),
            array(
                'field' => 'datax[sessionId]',
                'label' => 'Session',
                'rules' => 'required'
            ),
            array(
                'field' => 'datax[courseId]',
                'label' => 'Subject',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[syllabus]',
                'label' => 'syllabus details',
                'rules' => 'required'
            )
        );


//        print_r($yes_upload);exit;
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {


            $data = $this->input->post('data', TRUE);
            $datax = $this->input->post('datax', TRUE);
            $data['programOfferId'] = getProgramOfferId($datax);
            if (!empty($data['programOfferId'])) {
                $result = $this->SyllabusModleAdmin->duplicateSyllabusInfo($data);

                if (!$result) {
                    $data['addDate'] = date('d-m-Y');

                    $this->SyllabusModleAdmin->addSyllabusInfo($data);
                    $sdata['message'] = 'Successfull!';
                    $this->session->set_userdata($sdata);
                   redirect(teacher_Url() . "/syllabus");
                } else {
                    $sdata['errormessage'] = 'Duplicate Entry Found!';
                    $this->session->set_userdata($sdata);

                    redirect(teacher_Url() . "/syllabus");
                }
            } else {
                $sdata['errormessage'] = 'Inserted Enrollment Information is not offer yet';
                $this->session->set_userdata($sdata);

                redirect(teacher_Url() . "/syllabus");
            }
        }
    }

    public function syllabussearch() {

       $data['syllabus'] = 'active';
        $data['syllabuslist'] = 'active';

       $this->load->view('system_path/teacher/common/header_link'); // header Css link
        $this->load->view('system_path/teacher/common/header'); // body header
        $this->load->view('system_path/teacher/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/teacher/syllabus/syllabussearch'); // ...........body content page...........
        $this->load->view('system_path/teacher/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
    }

    public function searchsyllabuslist() {

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
         
            array(
                'field' => 'datax[mediumId]',
                'label' => 'Medium Name',
                'rules' => 'required'
            ),
            array(
                'field' => 'datax[programId]',
                'label' => 'Class Name',
                'rules' => 'required'
            ),
            array(
                'field' => 'datax[groupId]',
                'label' => 'Group Name',
                'rules' => 'required'
            ),
            array(
                'field' => 'datax[shiftId]',
                'label' => 'Shift Name',
                'rules' => 'required'
            ),
            array(
                'field' => 'datax[sectionId]',
                'label' => 'Section',
                'rules' => 'required'
            ),
            array(
                'field' => 'datax[sessionId]',
                'label' => 'Session',
                'rules' => 'required'
            ),
            array(
                'field' => 'datax[courseId]',
                'label' => 'Subject',
                'rules' => 'required'
            )
        );


//        print_r($yes_upload);exit;
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {

          $data = $this->input->post('data', TRUE);
         

            $data['programOfferId'] = getProgramOfferId($data);
            if (!empty($data['programOfferId'])) {
                $data['allsyllabuslist'] = $this->SyllabusModleAdmin->searchsyllabuslist($data);
                if (!empty($data['allsyllabuslist'])) {
                    
                        $data['syllabus'] = 'active';
                        $data['syllabuslist'] = 'active';

                    $this->load->view('system_path/teacher/common/header_link'); // header Css link
                    $this->load->view('system_path/teacher/common/header'); // body header
                    $this->load->view('system_path/teacher/common/side_menu', $data); // side bar menu
                    $this->load->view('system_path/teacher/syllabus/syllabuslist'); // ...........body content page...........
                    $this->load->view('system_path/teacher/common/footer'); // footer & script link
                    $this->load->view('system_path/jsquery'); // footer & script link
                    
                } else {
                    $sdata['errormessage'] = 'No Result Found';
                    $this->session->set_userdata($sdata);

                    redirect(teacher_Url() . "/syllabus/syllabussearch");
                }
            } else {
                $sdata['errormessage'] = 'Inserted Enrollment Information is not offer yet';
                $this->session->set_userdata($sdata);

                redirect(teacher_Url() . "/syllabus/syllabussearch");
            }
        }
    }

    public function viewsyllabus($id) {
        if ($id != Null) {
            $data['editData'] = $this->SyllabusModleAdmin->editSyllabusInfo($id);
            if (!empty($data['editData'])) {
             
                $data['syllabus'] = 'active';
                $data['syllabuslist'] = 'active';
                $this->load->view('system_path/teacher/common/header_link'); // header Css link
                $this->load->view('system_path/teacher/common/header'); // body header
                $this->load->view('system_path/teacher/common/side_menu', $data); // side bar menu
                $this->load->view('system_path/teacher/syllabus/viewsyllabus'); // ...........body content page...........
                $this->load->view('system_path/teacher/common/footer'); // footer & script link
                $this->load->view('system_path/jsquery'); // footer & script link
                
              
            } else {
                $sdata['errormessage'] = 'Data Not Found';
                $this->session->set_userdata($sdata);

                 redirect(teacher_Url() . "/syllabus/syllabussearch");
            }
        } else {
            $sdata['errormessage'] = 'Data Not Found';
            $this->session->set_userdata($sdata);

            redirect(teacher_Url() . "/syllabus/syllabussearch");
        }
    }

    public function editsyllebus($id) {
        if ($id != Null) {
            $data['editData'] = $this->SyllabusModleAdmin->editSyllabusInfo($id);
            if (!empty($data['editData'])) {
                $data['programinfo'] = getofferProgramInfoById($data['editData']["programOfferId"]);
                if (!empty($data['programinfo'])) {
                    
                $data['syllabus'] = 'active';
                $data['syllabuslist'] = 'active';
                 $this->load->view('system_path/teacher/common/header_link'); // header Css link
                $this->load->view('system_path/teacher/common/header'); // body header
                $this->load->view('system_path/teacher/common/side_menu', $data); // side bar menu
                $this->load->view('system_path/teacher/syllabus/editsyllabus'); // ...........body content page...........
                $this->load->view('system_path/teacher/common/footer'); // footer & script link
               
              
                    
                } else {
                    $sdata['errormessage'] = 'Enrollment Information is not offer yet';
                    $this->session->set_userdata($sdata);

                     redirect(teacher_Url() . "/syllabus/syllabussearch");
                }
            } else {
                $sdata['errormessage'] = 'Data Not Found';
                $this->session->set_userdata($sdata);

                 redirect(teacher_Url() . "/syllabus/syllabussearch");
            }
        } else {
            $sdata['errormessage'] = 'Data Not Found';
            $this->session->set_userdata($sdata);

             redirect(teacher_Url() . "/syllabus/syllabussearch");
        }
    }

    public function updatesyllabus($id) {

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
            
            array(
                'field' => 'datax[mediumId]',
                'label' => 'Medium Name',
                'rules' => 'required'
            ),
            array(
                'field' => 'datax[programId]',
                'label' => 'Class Name',
                'rules' => 'required'
            ),
            array(
                'field' => 'datax[groupId]',
                'label' => 'Group Name',
                'rules' => 'required'
            ),
            array(
                'field' => 'datax[shiftId]',
                'label' => 'Shift Name',
                'rules' => 'required'
            ),
            array(
                'field' => 'datax[sectionId]',
                'label' => 'Section',
                'rules' => 'required'
            ),
            array(
                'field' => 'datax[sessionId]',
                'label' => 'Session',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[courseId]',
                'label' => 'Subject',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[syllabus]',
                'label' => 'syllabus details',
                'rules' => 'required'
            )
        );


//        print_r($yes_upload);exit;
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            $data['editData'] = $this->SyllabusModleAdmin->editSyllabusInfo($id);
            if (!empty($data['editData'])) {
                $data['programinfo'] = getofferProgramInfoById($data['editData']["programOfferId"]);
                if (!empty($data['programinfo'])) {
              redirect(teacher_Url() . "/syllabus/syllabussearch");
                } else {
                    $sdata['errormessage'] = 'Enrollment Information is not offer yet';
                    $this->session->set_userdata($sdata);

                     redirect(teacher_Url() . "/syllabus/syllabussearch");
                }
            } else {
                $sdata['errormessage'] = 'Data Not Found';
                $this->session->set_userdata($sdata);

                 redirect(teacher_Url() . "/syllabus/syllabussearch");
            }
        } else {
            $data = $this->input->post('data', TRUE);
            $datax = $this->input->post('datax', TRUE);
            $data['programOfferId'] = getProgramOfferId($datax);
            if (!empty($data['programOfferId'])) {

                $this->SyllabusModleAdmin->updateSyllabusInfo($data, $id);
                $sdata['message'] = 'Update...';
                $this->session->set_userdata($sdata);
                 redirect(teacher_Url() . "/syllabus/syllabussearch");
            } else {
                $sdata['errormessage'] = 'Inserted Enrollment Information is not offer yet';
                $this->session->set_userdata($sdata);

                $data['editData'] = $this->SyllabusModleAdmin->editSyllabusInfo($id);
                if (!empty($data['editData'])) {
                    $data['programinfo'] = getofferProgramInfoById($data['editData']["programOfferId"]);
                    if (!empty($data['programinfo'])) {

                    $this->load->view('system_path/teacher/common/header_link'); // header Css link
                    $this->load->view('system_path/teacher/common/header'); // body header
                    $this->load->view('system_path/teacher/common/side_menu', $data); // side bar menu
                    $this->load->view('system_path/teacher/syllabus/editsyllabus'); // ...........body content page...........
                    $this->load->view('system_path/teacher/common/footer'); // footer & script link
                    } else {
                        $sdata['errormessage'] = 'Enrollment Information is not offer yet';
                        $this->session->set_userdata($sdata);

                         redirect(teacher_Url() . "/syllabus/syllabussearch");
                    }
                } else {
                    $sdata['errormessage'] = 'Data Not Found';
                    $this->session->set_userdata($sdata);

                      redirect(teacher_Url() . "/syllabus/syllabussearch");
                }
            }
        }
    }

    public function deletesyllabus($id) {


        $this->SyllabusModleAdmin->deleteSyllabusInfo($id);
        $this->index();
    }

}