<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class Result_view extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->teacher_logged_auth();
        $this->load->model('admin/result_view/Result_viewModleAdmin', 'Result_viewModleAdmin');
        $this->load->model('admin/student/StudentModleAdmin', 'StudentModleAdmin');
        $this->load->model('admin/grading/GradingModleAdmin', 'GradingModleAdmin');
        //put your code here
    }

    public function index() {
        $data['result'] = 'active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/result_view/index'); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
    }

    public function searchresultsByStudent() {


        $data = $this->input->post('data', TRUE);

        // get programoofferid from programmoffer table by session & then match student programofferid from promotedstudent table 
        $data['programOfferId'] = getProgramOfferIdBySessionStudent($data);

        if (!empty($data['programOfferId'])) {
            $data['markslist'] = $this->Result_viewModleAdmin->getmarksByStudent($data);

            if (!empty($data['markslist']) && !empty($data['studentId']) && !empty($data['semester'])) {
               
                $data['result'] = 'active';
                $this->load->view('system_path/admin/common/header_link'); // header Css link
                $this->load->view('system_path/admin/common/header'); // body header
                $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                $this->load->view('system_path/admin/result_view/marklist'); // ...........body content page...........
                $this->load->view('system_path/admin/common/footer'); // footer & script link
                $this->load->view('system_path/jsquery'); // footer & script link
                
                
            } elseif (empty($data['markslist'])) {
                $sdata = array();
                $sdata['errormessage'] = "No Result Found";
                $this->session->set_userdata($sdata);
                redirect(admin_Url() . "/result_view");
            } else {
                $sdata = array();
                $sdata['errormessage'] = "select both StudentId & Semester";
                $this->session->set_userdata($sdata);
                redirect(admin_Url() . "/result_view");
            }
        } else {
            $sdata = array();
            $sdata['errormessage'] = "Data not found";
            $this->session->set_userdata($sdata);
           redirect(admin_Url() . "/result_view");
        }
    }

    public function searchresultsByClass() {

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
            array(
                'field' => 'data[campusId]',
                'label' => 'Campus',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[mediumId]',
                'label' => 'Medium',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[programId]',
                'label' => 'Class',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[groupId]',
                'label' => 'Group',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[shiftId]',
                'label' => 'Shift',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[sectionId]',
                'label' => 'Section',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[sessionId]',
                'label' => 'Session',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[courseId]',
                'label' => 'Subject',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[semester]',
                'label' => 'Semester',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
//                    redirect(base_url('admin/campus'));
            $this->load->view('templates/admin/common/header');
            $this->load->view('templates/admin/result_view/index');
            $this->load->view('templates/admin/common/footer');
        } else {
            $data = $this->input->post('data', TRUE);
            
            $data['programOfferId'] = getProgramOfferId($data);
  //      print_r($data);            die();
            if (!empty($data['programOfferId'])) {
                $data['markslist'] = $this->Result_viewModleAdmin->getmarksByClass($data);
            //    print_r($data);die();
                if (!empty($data['markslist'])) {
                    $this->load->view('templates/admin/common/header');
                    $this->load->view('templates/admin/result_view/markslistbyClass', $data);
                    $this->load->view('templates/admin/common/footer');
                } else {
                    $sdata = array();
                    $sdata['message'] = "No Result Found";
                    $this->session->set_userdata($sdata);
                    $this->load->view('templates/admin/common/header');
                    $this->load->view('templates/admin/result_view/index', $data);
                    $this->load->view('templates/admin/common/footer');
                }
            } else {
                $sdata = array();
                $sdata['message'] = "Enrollment Information is not offer yet";
                $this->session->set_userdata($sdata);
                $this->load->view('templates/admin/common/header');
                $this->load->view('templates/admin/result_view/index');
                $this->load->view('templates/admin/common/footer');
            }
        }
    }

    public function transcriptView() {

        if (isset($_POST['save'])) {
            $data = $this->input->post('data', TRUE);
            
            if (!empty($data)) {
                    $data['markslist'] = $this->Result_viewModleAdmin->getmarksByStudentTranscriptView($data);
                    // print_r($data['markslist']) ;die();
                 //   $data['gradinglist'] = $this->GradingModleAdmin->gradinglist();
                    //  print_r($data); die();
                    if (!empty($data['markslist'])) {
                        $this->load->view('templates/admin/common/header');
                        $this->load->view('templates/admin/result_view/transcriptView', $data);
                        $this->load->view('templates/admin/common/footer');
                    } else {
                        $sdata = array();
                        $sdata['message'] = "Transcript is not ready yet for this Student...";
                        $this->session->set_userdata($sdata);
                        $this->load->view('templates/admin/common/header');
                        $this->load->view('templates/admin/result_view/index');
                        $this->load->view('templates/admin/common/footer');
                    }
            }
            else {
                        $sdata = array();
                        $sdata['message'] = "Result Not Found";
                        $this->session->set_userdata($sdata);
                        $this->load->view('templates/admin/common/header');
                        $this->load->view('templates/admin/result_view/index');
                        $this->load->view('templates/admin/common/footer');
                    }
        }
    }

    public function tabulationsheet() {
        $this->load->library('form_validation');
        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/result_view/tabulationsheet');
        $this->load->view('templates/admin/common/footer');
    }

    public function tabulationsheetformet() {

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
            array(
                'field' => 'data[mediumId]',
                'label' => 'Medium',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[programId]',
                'label' => 'Class',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[groupId]',
                'label' => 'Group',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[shiftId]',
                'label' => 'Shift',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[sectionId]',
                'label' => 'Section',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[sessionId]',
                'label' => 'Session',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            $data['result'] = 'active';
                $this->load->view('system_path/admin/common/header_link'); // header Css link
                $this->load->view('system_path/admin/common/header'); // body header
                $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                $this->load->view('system_path/admin/result_view/index'); // ...........body content page...........
                $this->load->view('system_path/admin/common/footer'); // footer & script link
                $this->load->view('system_path/jsquery'); // footer & script link
                
        } else {
            $data = $this->input->post('data', TRUE);
            $data['programOfferId'] = getProgramOfferId($data);
            if (!empty($data['programOfferId'])) {
                $data['listdata'] = $this->Result_viewModleAdmin->tabulationsheetformet($data);
                $data['studentlistdata'] = $this->Result_viewModleAdmin->getStudentMarksList($data);

            //  print_r($data['studentlistdata']); die();
                if (!empty($data['listdata']) && !empty($data['studentlistdata'])) {
                   
                $data['result'] = 'active';
                $this->load->view('system_path/admin/common/header_link'); // header Css link
                $this->load->view('system_path/admin/common/header'); // body header
                $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                $this->load->view('system_path/admin/common/top_menu', $data);
                $this->load->view('system_path/admin/result_view/viewtabulationsheet'); // ...........body content page...........
                $this->load->view('system_path/admin/common/footer'); // footer & script link
                $this->load->view('system_path/jsquery'); // footer & script link
                
                } else {
                    $sdata = array();
                    $sdata['errormessage'] = "No Result Found";
                    $this->session->set_userdata($sdata);
                    redirect(admin_Url() . "/result_view");
                }
            } else {
                $sdata = array();
                $sdata['message'] = "Enrollment Information is not offer yet";
                $this->session->set_userdata($sdata);
                redirect(admin_Url() . "/result_view");
            }
        }
    }

}
