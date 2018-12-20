<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */

class PromoteStudent extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->teacher_logged_auth();
        $this->load->model('admin/student/StudentModleAdmin', 'StudentModleAdmin');
        $this->load->model('admin/program/ProgramModleAdmin', 'ProgramModleAdmin');
        $this->load->model('admin/courseoffer/CourseofferModleAdmin', 'CourseofferModleAdmin');
    }

    public function index() {
        $data['student'] = 'active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/promotion/re_registration', $data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link         
        
    }
    
    public function studentReregistration() {

        $data['studentId'] = $this->input->post('studentid', TRUE);
       
        if (empty($data['studentId'])) {
            $sdata['errormessage'] = "Insert Student ID";
            $this->session->set_userdata($sdata);
            redirect(admin_Url() . "/promotestudent");
        } 
        else {
            $data['studentlist'] = $this->StudentModleAdmin->getstudentNameInfo($data['studentId']);
            if(!empty($data['studentlist']))
            {
                $data['student'] = 'active';
                $this->load->view('system_path/admin/common/header_link'); // header Css link
                $this->load->view('system_path/admin/common/header'); // body header
                $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                $this->load->view('system_path/admin/promotion/promotedstudent', $data); // ...........body content page...........
                $this->load->view('system_path/admin/common/footer'); // footer & script link     
                $this->load->view('system_path/jsquery'); // footer & script link
            }
            else 
            {
                $sdata['errormessage'] = "Invalid Student Id";
                $this->session->set_userdata($sdata);
                redirect(admin_Url() . "/promotestudent");
            }    
        }
    }
    
    
  
    public function searchApprovedStudent() {


        $data = $this->input->post('data', TRUE);
        $data['programOfferId'] = getProgramOfferId($data);
        if (!empty($data['programOfferId'])) {
            //  print_r($data['programOfferId']);die();
            $data['studentlist'] = $this->StudentModleAdmin->searchRegisteredStudent($data);
            if (!empty($data['studentlist'])) {
                $this->load->view('templates/admin/common/header');
                $this->load->view('templates/admin/promotion/studentlist', $data);

                $this->load->view('templates/admin/common/footer');
            } else {
                $sdata = array();
                $sdata['errormessage'] = "No Result Found";
                $this->session->set_userdata($sdata);

                $this->load->view('templates/admin/common/header');
                $this->load->view('templates/admin/promotion/index', $data);
                $this->load->view('templates/admin/common/footer');
            }
        } else {
            $sdata = array();
            $sdata['errormessage'] = "Following Enrollment information is not offered yet";
            $this->session->set_userdata($sdata);

            $this->load->view('templates/admin/common/header');
            $this->load->view('templates/admin/promotion/index', $data);
            $this->load->view('templates/admin/common/footer');
        }
    }

    

    public function insertPromotionconfirm() {


        if (isset($_POST['regConfirm'])) {

            $data = $this->input->post('data', TRUE);

            $validprogram = $this->ProgramModleAdmin->getProgramOfferId($data);

            if (!empty($validprogram)) {

                $checkduplicatePromotion = $this->StudentModleAdmin->checkduplicatePromotion($data, $validprogram);
                if (empty($checkduplicatePromotion)) {
                    
                    $result = $this->StudentModleAdmin->viewStudentInfo($data['studentId']);
             
                    if (!empty($data['promotionStatus']) && $result['programOfferId'] != $validprogram) {
                        if ($result['programOfferId'] == $validprogram) {
                            $sdata['errormessage'] = 'This Student is already exist in this class for given session!';
                            $this->session->set_userdata($sdata);
                            redirect(base_url('admin/promotestudent/studentReregistration/' . $data['studentId']));
                        } else {

                            $datas['courseassignlist'] = $this->CourseofferModleAdmin->CheckOfferedCourseAssign($validprogram);
                            // print_r($datas['courseassignlist']); die();    
                            if (!empty($datas['courseassignlist'])) {

                                $this->StudentModleAdmin->updateStudentPromotionconfirm($data, $result);
                                $this->StudentModleAdmin->insertStudentPromotionconfirm($data, $result, $validprogram);
                                $datas['studentId'] = $data['studentId'];
                                $datas['programOfferId'] = $validprogram;
                                $datas['studentinfo'] = $this->StudentModleAdmin->getstudentNameInfo($datas['studentId']);
                                
                                $sdata['message'] = 'Registration Complete Successfully!';
                                $this->session->set_userdata($sdata);
                                
                                $data['student'] = 'active';
                                $this->load->view('system_path/admin/common/header_link'); // header Css link
                                $this->load->view('system_path/admin/common/header'); // body header
                                $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                                $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                                $this->load->view('system_path/admin/courseoffer/course_reassign', $datas); // ...........body content page...........
                                $this->load->view('system_path/admin/common/footer'); // footer & script link
                                
                            } else {
                                $sdata['errormessage'] = 'No Subject offered yet for this enrollment information!';
                                $this->session->set_userdata($sdata);
                                redirect(admin_Url() . "/promotestudent");
                            }
                        }
                    } else {
                        $sdata['errormessage'] = 'Do not promote failed student into next class!';
                        $this->session->set_userdata($sdata);
                        redirect(admin_Url() . "/promotestudent");
                    }
                } else {
                    $sdata['errormessage'] = 'Duplicate promotion status found for this Student';
                    $this->session->set_userdata($sdata);
                   redirect(admin_Url() . "/promotestudent");
                }
            } else {
                $sdata['errormessage'] = 'No Class offered yet for this enrollment information!';
                $this->session->set_userdata($sdata);
               redirect(admin_Url() . "/promotestudent");
            }
        }
        else {
                $sdata['errormessage'] = 'No Class offered yet for this enrollment information!';
                $this->session->set_userdata($sdata);
               redirect(admin_Url() . "/promotestudent");
            }
    }
    

}

