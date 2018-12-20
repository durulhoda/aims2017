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
        $this->my_admin();
        $this->load->model('admin/result_view/Result_viewModleAdmin', 'Result_viewModleAdmin');
        $this->load->model('admin/student/StudentModleAdmin', 'StudentModleAdmin');
        $this->load->model('admin/grading/GradingModleAdmin', 'GradingModleAdmin');
        $this->load->model('admin/studentmarks/StudentmarksModleAdmin', 'StudentmarksModleAdmin');
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
            ),
            array(
                'field' => 'data[semesterId]',
                'label' => 'Semester',
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
         
             $data['markslist'] = $this->StudentmarksModleAdmin->getPositionByClasstabulation($data);
       //      print_r($data['markslist']); die();
          //  print_r($data['programOfferId']); die();
            if (!empty($data['programOfferId'])) {
               
              // print_r($data['markslist']); die();
                $data['listdata'] = $this->Result_viewModleAdmin->tabulationsheetformet($data);
             // print_r($data['listdata']);die();
              //  echo "<pre>"; 
                $ar_data['programOfferId']=$data['programOfferId'];
                $ar_data['semesterId']=$data['semesterId'];
                $data['studentlistdata'] = $this->Result_viewModleAdmin->getStudentMarksList_withSemester($ar_data);
            //  print_r($data['studentlistdata']);
            //    die();
            //  print_r($data['studentlistdata']); die();
              
                if (!empty($data['listdata']) && !empty($data['studentlistdata'])) {
                   ini_set('max_execution_time', '-1');
                $data['result'] = 'active';
               $this->load->view('system_path/admin/common/header_link'); // header Css link
               $this->load->view('system_path/admin/common/header'); // body header
                $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                $this->load->view('system_path/admin/common/top_menu', $data);
                $this->load->view('system_path/admin/result_view/viewtabulationsheet',$data); // ...........body content page...........
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
    
       public function searchresults() {
        
        $data = $this->input->post('data', TRUE);
        $data['studentId'] = $this->session->userdata('studentId');
    //  print_r($data); die();
        if (empty($data['studentId']) || empty($data['semesterId']) || empty($data['programOfferId'])) {
            $sdata = array();
            $sdata['message'] = "Select All Value";
            $this->session->set_userdata($sdata);
            $data['resultview']='active';
            $this->load->view('system_path/admin/common/header_link'); // header Css link
            $this->load->view('system_path/admin/common/header'); // body header
            $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
            $this->load->view('system_path/admin/common/top_menu', $data);
            $this->load->view('system_path/admin/student/studentprofile', $data); // ...........body content page...........
            $this->load->view('system_path/admin/common/footer'); // footer & script link
        } else {
   
            if (!empty($data['programOfferId'])) {
                
                $checkresult = $this->Result_viewModleAdmin->checkstudentresultstatus($data);
  //print_r($checkresult); die();
                if (!empty($checkresult)) { 
                    $data['markslist'] = $this->Result_viewModleAdmin->getResultMarks_BYclass_student_semester($data);

                    if (!empty($data['markslist'])) {

                    $this->load->view('system_path/admin/common/header_link'); // header Css link
                    $this->load->view('system_path/admin/common/header'); // body header
                    $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
                    $this->load->view('system_path/admin/common/top_menu', $data);
                    $this->load->view('system_path/admin/student/studentprofile', $data); // ...........body content page...........
                    $this->load->view('system_path/admin/common/footer'); // footer & script link

                    } 
                    else {
                        $sdata['errormessage'] = "Result not found";
                        $this->session->set_userdata($sdata);
                        
                        redirect(student_Url() . "/result_view");
                    }
                } 
                else {
                    $sdata['errormessage'] = "Result not Published";
                        $this->session->set_userdata($sdata);
                    redirect(student_Url() . "/result_view");
                }
            } else {
                 $sdata['errormessage'] = "Result not found";
                        $this->session->set_userdata($sdata);
                redirect(student_Url() . "/result_view");
            }
        }
    }

}
