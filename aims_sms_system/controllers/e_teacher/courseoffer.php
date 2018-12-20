<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class Courseoffer extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->teacher_logged_auth();
        $this->load->model('admin/courseoffer/CourseofferModleAdmin', 'CourseofferModleAdmin');
    }

    public function index() {
        $data['subffer'] = 'active';
        $data['subjectoffer'] = 'active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu'); // top bar menu
        $this->load->view('system_path/admin/courseoffer/index', $data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
    }

    public function insertCourseoffer() {
        // print_r($_POST);
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
            array(
                'field' => 'data[programLevel]',
                'label' => 'Class Level',
                'rules' => 'required|xss_clean'
            ),
            array(
                'field' => 'data[mediumId]',
                'label' => 'Medium',
                'rules' => 'required|xss_clean'
            ),
            array(
                'field' => 'data[programId]',
                'label' => 'Program',
                'rules' => 'required|xss_clean'
            ),
            array(
                'field' => 'data[groupId]',
                'label' => 'Group',
                'rules' => 'required|xss_clean'
            ),
            array(
                'field' => 'data[shiftId]',
                'label' => 'Shift',
                'rules' => 'required|xss_clean'
            ),
            array(
                'field' => 'data[sectionId]',
                'label' => 'Section',
                'rules' => 'required|xss_clean'
            ),
            array(
                'field' => 'data[employeeId]',
                'label' => 'Form Master',
                'rules' => 'required|xss_clean'
            ),
            array(
                'field' => 'data[sessionId]',
                'label' => 'Session',
                'rules' => 'required|xss_clean'
            ),
            array(
                'field' => 'data[courseId]',
                'label' => 'Subject',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[categoryName]',
                'label' => 'Category',
                'rules' => 'required'
            ),           
            array(
                'field' => 'data[marks]',
                'label' => 'Marks',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            $data['subffer'] = 'active';
            $data['subjectoffer'] = 'active';
            $this->load->view('system_path/admin/common/header_link'); // header Css link
            $this->load->view('system_path/admin/common/header'); // body header
            $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
            $this->load->view('system_path/admin/common/top_menu'); // top bar menu
            $this->load->view('system_path/admin/courseoffer/index', $data); // ...........body content page...........
            $this->load->view('system_path/admin/common/footer'); // footer & script link
            $this->load->view('system_path/jsquery'); // footer & script link
        } else {
            $datax = $this->input->post('data', TRUE);
            //$datax = $this->input->post('datax', TRUE);
            $datax['programOfferId'] = getProgramOfferId($datax);
           // print_r($data); die();
            if (!empty($datax['programOfferId'])) {
                $data = array(
                    'programOfferId' => $datax['programOfferId'],  
                    'employeeId' => $datax['employeeId'],                   
                    'courseId' => $datax['courseId'],
                    'categoryName' => $datax['categoryName'],
                    'marks' => $datax['marks'],
                    'status' => $datax['status']
                );
                
                $validation = $this->CourseofferModleAdmin->duplicateCourseofferInfo($data);

                if ($validation) {
                    $sdata['errormessage'] = 'Inserted subject offer information is already offered..';
                    $this->session->set_userdata($sdata);

                    $data['subffer'] = 'active';
                    $data['subjectoffer'] = 'active';
                    $this->load->view('system_path/admin/common/header_link'); // header Css link
                    $this->load->view('system_path/admin/common/header'); // body header
                    $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
                    $this->load->view('system_path/admin/common/top_menu'); // top bar menu
                    $this->load->view('system_path/admin/courseoffer/index', $data); // ...........body content page...........
                    $this->load->view('system_path/admin/common/footer'); // footer & script link
                    $this->load->view('system_path/jsquery'); // footer & script link
                }
               else {
             //      print_r($data); die();
                    $this->CourseofferModleAdmin->addCourseofferInfo($data);
                   
                    $sdata['message'] = 'Subject Offered Successfully';
                    $this->session->set_userdata($sdata);

                    redirect(admin_Url()."/courseoffer", 'refresh');
                }
            } else {
                $sdata = array();
                $sdata['errormessage'] = "Under this enrollment information class not offered yet";
                $this->session->set_userdata($sdata);
                redirect(admin_Url()."/courseoffer", 'refresh');
            }
        }
    }

    public function courseOfferlist() {

        $data['subffer'] = 'active';
        $data['subjectofferlist'] = 'active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu'); // top bar menu
        $this->load->view('system_path/admin/courseoffer/courseoffersearch', $data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
    }

    public function searchcourseofferlist() {

        $data = $this->input->post('data', TRUE);
        $data['programOfferId'] = getProgramOfferId($data);
        if (!empty($data['programOfferId'])) {
            $data['courseofferlist'] = $this->CourseofferModleAdmin->searchcourseofferlist($data);
            if(!empty($data['courseofferlist']))
            {
                $data['subffer'] = 'active';
                $data['subjectofferlist'] = 'active';
                $this->load->view('system_path/admin/common/header_link'); // header Css link
                $this->load->view('system_path/admin/common/header'); // body header
                $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
                $this->load->view('system_path/admin/common/top_menu'); // top bar menu
                $this->load->view('system_path/admin/courseoffer/courseofferlist', $data); // ...........body content page...........
                $this->load->view('system_path/admin/common/footer'); // footer & script link
                $this->load->view('system_path/jsquery'); // footer & script link
              
            }
            else {
                $sdata = array();
                $sdata['message'] = "No Result Found";
                $this->session->set_userdata($sdata);
                redirect(admin_Url()."/courseoffer/courseOfferlist", 'refresh');
             
            }   
         } else {
            $sdata = array();
            $sdata['message'] = "Under this enrollment information Subject not offered yet";
            $this->session->set_userdata($sdata);
            redirect(admin_Url()."/courseoffer/courseOfferlist", 'refresh');
        }   
    }
    
    public function editcourseoffer($id) {
        
        $id=(int)$id;
        $data['editData'] = $this->CourseofferModleAdmin->editCourseofferInfo($id);
        if (!empty($data['editData'])) {
            $data['subffer'] = 'active';
            $data['subjectofferlist'] = 'active';
            $this->load->view('system_path/admin/common/header_link'); // header Css link
            $this->load->view('system_path/admin/common/header'); // body header
            $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
            $this->load->view('system_path/admin/common/top_menu'); // top bar menu
            $this->load->view('system_path/admin/courseoffer/editcourseoffer', $data); // ...........body content page...........
            $this->load->view('system_path/admin/common/footer'); // footer & script link
            $this->load->view('system_path/jsquery'); // footer & script link
          
        } else {
            $sdata = array();
            $sdata['errormessage'] = "No Result Found";
            $this->session->set_userdata($sdata);
            redirect(admin_Url()."/courseoffer/courseOfferlist", 'refresh');
        }
    }
    
    public function updatecourseoffer($id) {

        $data = $this->input->post('data', TRUE);
        
        $data['programOfferId'] = getProgramOfferId($data);
        if (!empty($data['programOfferId'])) {
            $validation1 = $this->CourseofferModleAdmin->duplicateCourseofferInfo($data);
    
            if (!empty($validation1)) {
                $sdata = array();
                $sdata['message'] = "Duplicate value found";
                $this->session->set_userdata($sdata);

                $data['editData'] = $this->CourseofferModleAdmin->editCourseofferInfo($id);
                if (!empty($data['editData'])) {
                    $data['subffer'] = 'active';
                    $data['subjectofferlist'] = 'active';
                    $this->load->view('system_path/admin/common/header_link'); // header Css link
                    $this->load->view('system_path/admin/common/header'); // body header
                    $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
                    $this->load->view('system_path/admin/common/top_menu'); // top bar menu
                    $this->load->view('system_path/admin/courseoffer/editcourseoffer', $data); // ...........body content page...........
                    $this->load->view('system_path/admin/common/footer'); // footer & script link
                    $this->load->view('system_path/jsquery'); // footer & script link

                } else {
                    $sdata = array();
                    $sdata['errormessage'] = "No Result Found";
                    $this->session->set_userdata($sdata);
                    redirect(admin_Url()."/courseoffer/courseOfferlist", 'refresh');
                }
            }
            else {
                $datax = array(
                    'programOfferId' => $data['programOfferId'],  
                    'employeeId' => $data['employeeId'],                   
                    'courseId' => $data['courseId'],
                    'categoryName' => $data['categoryName'],
                    'marks' => $data['marks'],
                    'status' => $data['status']
                );
                $this->CourseofferModleAdmin->updateCourseofferInfo($datax, $id);
                $sdata['message'] = 'Updated Subject Offered';
                $this->session->set_userdata($sdata);

                redirect(admin_Url()."/courseoffer/courseOfferlist", 'refresh');
            }
        } else {
            $sdata = array();
            $sdata['message'] = "Under this enrollment information class not offered yet";
            $this->session->set_userdata($sdata);
            redirect(admin_Url()."/courseoffer/courseOfferlist", 'refresh');
        }
    }

    public function deletecourseoffer($id) {


        $this->CourseofferModleAdmin->deleteCourseofferInfo($id);
        $sdata['message'] = 'Subject Offered Deleted';
        $this->session->set_userdata($sdata);

        redirect(admin_Url() . "/courseoffer/courseOfferlist", 'refresh');
    }
    
    public function courseassignlist() {
        $data['courseassignlist'] = $this->CourseofferModleAdmin->searchcourseassignlist();
        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/courseoffer/courseassign', $data);
        $this->load->view('templates/admin/common/footer');
    }

    //put your code here
}

