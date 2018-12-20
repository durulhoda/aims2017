<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */

class Applicant extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->my_admin();
        date_default_timezone_set('Asia/Dhaka');

        $this->load->model('admin/admissiontest/AdmissiontestModleAdmin', 'AdmissiontestModleAdmin');
        $this->load->model('admin/studentregistration/StudentregistrationModleAdmin', 'StudentregistrationModleAdmin');
        $this->load->model('admin/student/StudentModleAdmin', 'StudentModleAdmin');
        $this->load->model('admin/program/ProgramModleAdmin', 'ProgramModleAdmin');
        $this->load->model('admin/courseoffer/CourseofferModleAdmin', 'CourseofferModleAdmin');
        $this->load->model('admin/institute/InstituteModleAdmin', 'InstituteModleAdmin');
        $this->load->model('admin/result/Result_model_admin', 'rma');
         $this->load->model('admin/assigncourse/AssignCourseModleAdmin', 'AssignCourseModleAdmin');
    }

    public function RegistrationForm() {
        $data['registration'] = 'active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/applicant/registration_form'); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
    }

    public function insertapplicant() {

        if (isset($_POST['btnSubmit'])) {
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');

            $config = array(
                array(
                    'field' => 'data[firstName]',
                    'label' => 'First Name',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'data[dateOfBirth]',
                    'label' => 'Date of Birth',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'data[sbreg]',
                    'label' => 'Birth Registration Number',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'data[gender]',
                    'label' => 'Gender',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'data[fatherName]',
                    'label' => 'father\'s Name',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'data[motherName]',
                    'label' => 'Mother\'s Name',
                    'rules' => 'required'
                ),
                // array(
                //     'field' => 'data[email]',
                //     'label' => 'Email Address',
                //     'rules' => 'required'
                // ),
                //array(
                //'field' => 'data[fatherPhone]',
                //'label' => 'father\'s Mobile Number',
                // 'rules' => 'required'
                //),
                array(
                    'field' => 'datax[programId]',
                    'label' => 'Class',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'datax[programLevel]',
                    'label' => 'Class Level',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'datax[mediumId]',
                    'label' => 'Medium',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'datax[shiftId]',
                    'label' => 'Shift',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'datax[groupId]',
                    'label' => 'Group',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'datax[sessionId]',
                    'label' => 'Session',
                    'rules' => 'required'
                )
            );

            $this->form_validation->set_rules($config);
            //When form validation run will be false
            if ($this->form_validation->run() == FALSE) {
                $data['registration'] = 'active';
                $this->load->view('system_path/admin/common/header_link'); // header Css link
                $this->load->view('system_path/admin/common/header'); // body header
                $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                $this->load->view('system_path/admin/applicant/registration_form'); // ...........body content page...........
                $this->load->view('system_path/admin/common/footer'); // footer & script link
                $this->load->view('system_path/jsquery'); // footer & script link
            // When form validation will run correctly.
            } else {
                //                    print_r($_POST); exit;
                $data = $this->input->post('data', TRUE);
                $datax = $this->input->post('datax', TRUE);

                $enrol = $this->ProgramModleAdmin->getValidateofferedprogram($datax);

                // echo '<pre>';print_r($_POST);
                // exit;


                if (!empty($enrol)) {
                    if (!empty($data) && !empty($enrol)) {
                        $config['upload_path'] = './uploads/Students/';
                        $config['allowed_types'] = 'jpg|gif|JPEG|png';
                        $config['max_size'] = '1024';
                        $config['max_width'] = '300';
                        $config['max_height'] = '300';

                        $this->upload->initialize($config);

                        $yes_upload = $this->upload->do_upload('photo');
                        if (!$yes_upload) {

                            $sdata = array();
                            $sdata['errormessage'] = 'Image not uploaded';
                            $this->session->set_userdata($sdata);

                            $data['registration'] = 'active';
                            $this->load->view('system_path/admin/common/header_link'); // header Css link
                            $this->load->view('system_path/admin/common/header'); // body header
                            $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                            $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                            $this->load->view('system_path/admin/applicant/registration_form'); // ...........body content page...........
                            $this->load->view('system_path/admin/common/footer'); // footer & script link
                            $this->load->view('system_path/jsquery'); // footer & script link
                        } 
                        /*         start       */
                        else 
                        {
                            $incId = $this->getLastId($enrol['programOfferId']);
                            $new_stt = sprintf('%02d', $datax['programId']);
                            $new_medium = sprintf('%02d', $datax['mediumId']); 
                            $datae = date('Y');
                            //$data['applicationId'] = $datae . "" . strval($new_stt) . "" . counter();
                            $data['applicationId'] = $datae . "" . strval($new_stt) . "" . strval($new_medium) . "" . $incId;

                            $check = $this->StudentModleAdmin->editapplicantInfo($data['applicationId']);
                            if ($check) {
                                $sdata = array();
                                $sdata['errormessage'] = 'System Found some problem with new applicationId...Please create again !!';
                                $this->session->set_userdata($sdata);

                                $data['registration'] = 'active';
                                $this->load->view('system_path/admin/common/header_link'); // header Css link
                                $this->load->view('system_path/admin/common/header'); // body header
                                $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                                $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                                $this->load->view('system_path/admin/applicant/registration_form'); // ...........body content page...........
                                $this->load->view('system_path/admin/common/footer'); // footer & script link
                                $this->load->view('system_path/jsquery'); // footer & script link
                            } else {
                                /*     insert info */
                                $img_data = $this->upload->data();
                                $data['photo'] = "uploads/Students/" . $img_data['file_name'];

                                $category = $this->input->post('category');
                                $roll = $this->input->post('roll');
                                $thana_registration = $this->input->post('thana_registration');
                                $board = $this->input->post('board');
                                $gpa = $this->input->post('gpa');
                                $passing_year = $this->input->post('passing_year');

                                $count_clr = count($category);
                                for ($i = 0; $i < $count_clr; $i++) {



                                    $datay['category'] = $category[$i];
                                    $datay['roll'] = $roll[$i];
                                    $datay['thana_registration'] = $thana_registration[$i];
                                    $datay['board'] = $board[$i];
                                    $datay['gpa'] = $gpa[$i];
                                    $datay['passing_year'] = $passing_year[$i];
                                    $datay['applicationId'] = $data['applicationId'];
                                    // print_r($data); 
                                    $this->StudentModleAdmin->previusStudentInfo($datay);
                                }

                                $this->StudentModleAdmin->addStudentInfo($data, $enrol);

                                $insert_id = $this->db->insert_id();


                                if (!empty($insert_id)) {

                                    $datass['editData'] = $this->StudentModleAdmin->getApplicantInfoById($insert_id);

                                    $datass['enrollData'] = $this->ProgramModleAdmin->getofferProgramInfoById(getprogramOfferIdByApplicant($datass['editData']['applicationId']));

                                    if (!empty($datass['editData']) && !empty($datass['enrollData'])) {

                                        $data['registration'] = 'active';
                                        $this->load->view('system_path/admin/common/header_link'); // header Css link
                                        $this->load->view('system_path/admin/common/header'); // body header
                                        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                                        $this->load->view('system_path/admin/common/top_menu', $datass); // top bar menu
                                        $this->load->view('system_path/admin/applicant/printapplicantinfo'); // ...........body content page...........
                                        $this->load->view('system_path/admin/common/footer'); // footer & script link
                                    }
                                } else {
                                    $sdata = array();
                                    $sdata['errormessage'] = 'System Found some problem with this application information...Please create again !!';
                                    $this->session->set_userdata($sdata);

                                    $data['registration'] = 'active';
                                    $this->load->view('system_path/admin/common/header_link'); // header Css link
                                    $this->load->view('system_path/admin/common/header'); // body header
                                    $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                                    $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                                    $this->load->view('system_path/admin/applicant/registration_form'); // ...........body content page...........
                                    $this->load->view('system_path/admin/common/footer'); // footer & script link
                                    $this->load->view('system_path/jsquery'); // footer & script link
                                }
                            }
                        }
                    } else {
                        $sdata = array();
                        $sdata['errormessage'] = 'Look like Some value missing here';
                        $this->session->set_userdata($sdata);

                        $data['registration'] = 'active';
                        $this->load->view('system_path/admin/common/header_link'); // header Css link
                        $this->load->view('system_path/admin/common/header'); // body header
                        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                        $this->load->view('system_path/admin/applicant/registration_form'); // ...........body content page...........
                        $this->load->view('system_path/admin/common/footer'); // footer & script link
                        $this->load->view('system_path/jsquery'); // footer & script link        
                    }
                } else {
                    $sdata['errormessage'] = 'Inserted Enrolment Information is not offered yet';
                    $this->session->set_userdata($sdata);

                    $data['registration'] = 'active';
                    $this->load->view('system_path/admin/common/header_link'); // header Css link
                    $this->load->view('system_path/admin/common/header'); // body header
                    $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                    $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                    $this->load->view('system_path/admin/applicant/registration_form'); // ...........body content page...........
                    $this->load->view('system_path/admin/common/footer'); // footer & script link
                    $this->load->view('system_path/jsquery'); // footer & script link    
                }
            }
        } else {
            $sdata['errormessage'] = 'Insert Applicant information';
            $this->session->set_userdata($sdata);

            redirect(admin_Url() . "/applicant/RegistrationForm");
        }
    }

    public function searchapplicant() {
        $data['registration'] = 'active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/applicant/searchapplicant'); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
    }

    public function applicantregistration() {
        $data['registration'] = 'active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/applicant/searchapplicantreg'); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
    }

    public function applicantlist() {

        if (isset($_POST['search'])) {
            /**   $this->load->helper(array('form', 'url'));
              $this->load->library('form_validation');

              $config = array(

              array(
              'field' => 'datax[programId]',
              'label' => 'Class',
              'rules' => 'required'
              ),
              array(
              'field' => 'datax[mediumId]',
              'label' => 'Medium',
              'rules' => 'required'
              ),
              array(
              'field' => 'datax[shiftId]',
              'label' => 'Shift',
              'rules' => 'required'
              ),
              array(
              'field' => 'datax[groupId]',
              'label' => 'Group',
              'rules' => 'required'
              ),
              array(
              'field' => 'datax[sessionId]',
              'label' => 'Session',
              'rules' => 'required'
              )
              );

              $this->form_validation->set_rules($config);

              if ($this->form_validation->run() == FALSE) {

              $data['registration'] = 'active';
              $this->load->view('system_path/admin/common/header_link'); // header Css link
              $this->load->view('system_path/admin/common/header'); // body header
              $this->load->view('system_path/admin/common/side_menu'); // side bar menu
              $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
              $this->load->view('system_path/admin/applicant/searchapplicant'); // ...........body content page...........
              $this->load->view('system_path/admin/common/footer'); // footer & script link
              $this->load->view('system_path/jsquery'); // footer & script link
              } else {* */
            $data = $this->input->post('datax', TRUE);
            //      print_r($data); die();
            $data['enrollData'] = $this->ProgramModleAdmin->getValidateofferedprogramold($data);
            //print_r($data['enrollData']); die();
            if (!empty($data['enrollData'])) {
                    //print_r($data);  die();

                $data['applicantlist'] = $this->StudentModleAdmin->getApplicationIdByprogramofferId($data['enrollData']['programOfferId']);
              // echo '<pre>'; print_r($data);exit;

                if (!empty($data['applicantlist'])) {
                    if (isset($_POST['search'])) {
                        $datas['programOfferId'] = getProgramOfferIdforcourse($data);
                        $data['courseassignlist'] = $this->CourseofferModleAdmin->CheckOfferedCourseAssign($datas['programOfferId']);

                        $data['registration'] = 'active';
                        $this->load->view('system_path/admin/common/header_link'); // header Css link
                        $this->load->view('system_path/admin/common/header'); // body header
                        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                        $this->load->view('system_path/admin/applicant/applicant_list', $data); // ...........body content page...........
                        $this->load->view('system_path/admin/common/footer'); // footer & script link
                        $this->load->view('system_path/jsquery'); // footer & script link
                    } elseif (isset($_POST['print'])) {
                        $this->load->view('system_path/admin/common/header_link'); // header Css link
                        $this->load->view('system_path/admin/applicant/printapplicant_list', $data); // ...........body content page...........
                        $this->load->view('system_path/admin/common/footer'); // footer & script link 
                    } else {
                        $sdata['errormessage'] = 'No Applicant Found';
                        $this->session->set_userdata($sdata);
                        redirect(admin_Url() . "/applicant/searchapplicant");
                    }
                } else {

                    $sdata['errormessage'] = 'Applicant information not found for this enrollment information!';
                    $this->session->set_userdata($sdata);
                    redirect(admin_Url() . "/applicant/searchapplicant");
                }
            } else {

                $sdata['errormessage'] = 'Given Enrollment information is not offered yet !';
                $this->session->set_userdata($sdata);
                redirect(admin_Url() . "/applicant/searchapplicant");
            }
        }
    }

    public function applicantReglist() {

        if (isset($_POST['search'])) {
            /**   $this->load->helper(array('form', 'url'));
              $this->load->library('form_validation');

              $config = array(

              array(
              'field' => 'datax[programId]',
              'label' => 'Class',
              'rules' => 'required'
              ),
              array(
              'field' => 'datax[mediumId]',
              'label' => 'Medium',
              'rules' => 'required'
              ),
              array(
              'field' => 'datax[shiftId]',
              'label' => 'Shift',
              'rules' => 'required'
              ),
              array(
              'field' => 'datax[groupId]',
              'label' => 'Group',
              'rules' => 'required'
              ),
              array(
              'field' => 'datax[sessionId]',
              'label' => 'Session',
              'rules' => 'required'
              )
              );

              $this->form_validation->set_rules($config);

              if ($this->form_validation->run() == FALSE) {

              $data['registration'] = 'active';
              $this->load->view('system_path/admin/common/header_link'); // header Css link
              $this->load->view('system_path/admin/common/header'); // body header
              $this->load->view('system_path/admin/common/side_menu'); // side bar menu
              $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
              $this->load->view('system_path/admin/applicant/searchapplicant'); // ...........body content page...........
              $this->load->view('system_path/admin/common/footer'); // footer & script link
              $this->load->view('system_path/jsquery'); // footer & script link
              } else {* */
            $data = $this->input->post('datax', TRUE);
            //      print_r($data); die();
            $program_offer_ids=array();
            $data['enrollData_old'] = $this->ProgramModleAdmin->get_pro_offer_ids($data);
            //$data['enrollData']['programOfferId'] = 6;
            foreach ($data['enrollData_old'] as $enroll)
            {
                $program_offer_ids[]=$enroll['programOfferId'];
                $data['enrollData']=$enroll;
            }

//            echo '<pre>';
//            print_r($program_offer_ids); die();
            if (!empty($data['enrollData'])) {
                //    print_r($datas);  die();

                $data['applicantlist'] = $this->StudentModleAdmin->getApplicationIdByprogramofferId($program_offer_ids);
//                echo '<pre>';
//                print_r($data['applicantlist']); die();

                if (!empty($data['applicantlist'])) {
                    if (isset($_POST['search'])) {
                        $datas['programOfferId'] = getProgramOfferIdforcourse($data);
                        $data['courseassignlist'] = $this->CourseofferModleAdmin->CheckOfferedCourseAssign($datas['programOfferId']);
                       // $data['roll_no'] = $this->AssignCourseModleAdmin->getStudentRollNo($datas['programOfferId']);
                        // echo "<pre>";
                        // print_r($data['courseassignlist']);die();
                        if (!$data['courseassignlist']) {
                            $sdata['errormessage'] = 'Previous No Assign Course!';
                            $this->session->set_userdata($sdata);
                            redirect(admin_Url() . "/applicant/searchapplicant");
                        }
                        $data['registration'] = 'active';
                        $this->load->view('system_path/admin/common/header_link'); // header Css link
                        $this->load->view('system_path/admin/common/header'); // body header
                        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                        $this->load->view('system_path/admin/common/top_menu',$data); // top bar menu
                        $this->load->view('system_path/admin/applicant/applicantreg',$data); // ...........body content page...........
                        $this->load->view('system_path/admin/common/footer'); // footer & script link
                        $this->load->view('system_path/jsquery'); // footer & script link
                        
                    } elseif (isset($_POST['print'])) {
                        $this->load->view('system_path/admin/common/header_link'); // header Css link
                        $this->load->view('system_path/admin/applicant/printapplicant_list',$data); // ...........body content page...........
                        $this->load->view('system_path/admin/common/footer'); // footer & script link 
                    } else {
                        $sdata['errormessage'] = 'No Applicant Found';
                        $this->session->set_userdata($sdata);
                        redirect(admin_Url() . "/applicant/searchapplicant");
                    }
                } else {

                    $sdata['errormessage'] = 'Applicant information not found for this enrollment information!';
                    $this->session->set_userdata($sdata);
                    redirect(admin_Url() . "/applicant/searchapplicant");
                }
            } else {

                $sdata['errormessage'] = 'Given Enrollment information is not offered yet !';
                $this->session->set_userdata($sdata);
                redirect(admin_Url() . "/applicant/searchapplicant");
            }
        }
    }

    public function printAppliacnrList($programofferid) {
        $programofferid = (int) $programofferid;
        $datax = $this->ProgramModleAdmin->getofferProgramInfoById($programofferid);
        if (!empty($datax)) {
            $data = array(
                'sessionId' => $datax['sessionId'],
                'programLevel' => $datax['programLevel'],
                'programId' => $datax['programId'],
                'mediumId' => $datax['mediumId'],
                'shiftId' => $datax['shiftId'],
                'groupId' => $datax['groupId']
            );
            $data['applicantlist'] = $this->StudentModleAdmin->getApplicationIdByprogramofferId($programofferid);
            if (!empty($data['applicantlist'])) {
                $this->load->view('system_path/admin/common/header_link'); // header Css link
                $this->load->view('system_path/admin/applicant/printapplicant_list', $data); // ...........body content page...........
                $this->load->view('system_path/admin/common/footer'); // footer & script link    
            } else {
                $sdata['errormessage'] = 'No Applicant Found';
                $this->session->set_userdata($sdata);
                redirect(admin_Url() . "/applicant/searchapplicant");
            }
        } else {
            $sdata['errormessage'] = 'No Applicant Found';
            $this->session->set_userdata($sdata);
            redirect(admin_Url() . "/applicant/searchapplicant");
        }
    }

    // Applicant Registration Confirm Function

    public function apply_registration($applicationId) {

       // $applicationId = (int) $applicationId;
        //  print_r($data); die();
        $datacheck = $this->StudentModleAdmin->getappInfo($applicationId); // get applicant some information
        //print_r( $applicationId);
        // print_r($datacheck); die();
        if (!empty($datacheck)) {
            // echo '<pre>';               print_r( $datacheck);
            $applicantpromotioninfo = $this->StudentModleAdmin->getstudentsInfoArrayByApplicationId($applicationId);
            //  print_r($applicantpromotioninfo); die();
            if (!empty($applicantpromotioninfo['applicationId']) == $applicationId) {
                $sdata = array();
                $sdata['errormessage'] = "This Applicant is already registered";
                $this->session->set_userdata($sdata);
                redirect(admin_Url() . "/applicant/searchapplicant");
            } else {
                $data['studentlist'] = $this->StudentModleAdmin->getApplicantShortInfo($applicationId); // get applicant some information
                //Get ProgramOffer information as array by application id using join    
                $data['programofferinfo'] = $this->ProgramModleAdmin->getPrOfferArraybyApplicantionId($applicationId);

                $data['courseassignlist'] = $this->CourseofferModleAdmin->CheckOfferedCourseAssign($data['programofferinfo']['programOfferId']);
                //  print_r($data['courseassignlist']); die(); 
                if (!empty($data['courseassignlist'])) {

                    // If Admission Procedure Continue with Admission Mark & Merit List then enable next line        
                    //  $data['studentlist'] = $this->AdmissiontestModleAdmin->getPromotedApplicantinfo($datas);
                    // If Admission Procedure Continue with Direct Admission then enable next line    

                    $data['registration'] = 'active';
                    $this->load->view('system_path/admin/common/header_link'); // header Css link
                    $this->load->view('system_path/admin/common/header'); // body header
                    $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                    $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                    $this->load->view('system_path/admin/applicant/confirmregistration', $data); // ...........body content page...........
                    $this->load->view('system_path/admin/common/footer'); // footer & script link
                } else {
                    $sdata['errormessage'] = "For your inserted Applicant Id there are no Subject offered yet..";
                    $this->session->set_userdata($sdata);

                    redirect(admin_Url() . "/applicant/searchapplicant");
                }
            }
        } else {
            $sdata['errormessage'] = "Information Not Found Please Try Again......! Thanks";
            $this->session->set_userdata($sdata);

            redirect(admin_Url() . "/applicant/searchapplicant");
        }
    }

    public function test() {


        $data1 = array(
            'invoice_type' => $this->input->post('type'),
            'reference_no' => $this->input->post('ref'),
            'des_title' => $this->input->post('title'),
        );
        /*
          Considering description ,voucher_no,price compulsary if user add discription
         */
        $description = $this->input->post("description");
        $voucher_no = $this->input->post("voucher_no");
        $price = $this->input->post("price");
        $data2 = '';
        if (isset($description) && !empty($description)) {
            $i = 0;
            foreach ($description as $row) {
                $data2[] = array(
                    'description' => $description[$i],
                    'voucher_no' => $voucher_no[$i],
                    'price' => $price[$i],
                );
                $i++;
            }
        }

        $this->sample_model->insert_entry($data1, $data2);
    }

    public function registrationConfarmlreg() {

//        echo '<pre>';
//        print_r($this->input->post());exit;

        //ini_set('max_input_vars','20000' );
        $checkAll = $this->input->post('checkAll');
        //  print_r($checkAll); die();
        $applicationId = $this->input->post('applicationId');

        $employeeId = $this->input->post('employeeId', TRUE);
        $courseId = $this->input->post('courseId', TRUE);
        $courseStatus = $this->input->post('courseStatus', TRUE);
        $datacls['programId'] = $this->input->post('programId', TRUE);
        $cls = $this->ProgramModleAdmin->getClassId($datacls);
        $dataa = $this->input->post('data');
        $rollNo = $this->input->post('roll_no', TRUE);
        //$programofferId = $this->input->post('programOfferId', TRUE);
         // echo '<pre>';print_r($_POST); die();
        // $data['programOfferId'] = getProgramOfferId($dataa);

        if (!empty($checkAll)) {
            $cuntCrl = $checkAll;
            // $i="";
            //   print_r($datas['programOfferId']); die();
            $setDate = date('Y');
            $clsId = $this->ProgramModleAdmin->getClassiiId($datacls);
            $class = sprintf('%02d', $clsId);
            // print_r($class); die();
            $this->db->trans_begin();
            for ($i = 0; $i < count($cuntCrl); $i++) {
                $data['applicationId'] = $applicationId[$i];
                //  print_r($data['applicationId']); die();
                $data['programOfferId'] = getProgramOfferIdforcourse($dataa);
                $data['programOfferId'] = $this->ProgramModleAdmin->getPorgramOfferId($dataa);
                $roll_no = $rollNo[$i];
                //$data['programOfferId'] = $programofferId;
               // print_r($dataa);exit;
                if (!empty($data['programOfferId'])) {
//                        print_r($data['programOfferId']); die();
                    //Course Assign
                    $datacorse['employeeId'] = ',' . implode(',', $employeeId) . ',';
                    $datacorse['courseId'] = ',' . implode(',', $courseId) . ',';
                    $datacorse['courseStatus'] = ',' . implode(',', $courseStatus) . ',';

//                    echo '<pre>';print_r($datacorse);exit;

                    $counter = $this->ProgramModleAdmin->GetLastStudentSerialNo($setDate, $clsId);
                    // if ($i == 0) {
                    //     print_r($counter);
                    // }
                    if ($counter > 0) {
                        $regNo = $counter + 1;
                        $this->ProgramModleAdmin->UpdateCounter($regNo, $setDate, $clsId);
                    } else {
                        $regNo = 1;
                        $this->ProgramModleAdmin->InsertCounter($regNo, $setDate, $clsId);
                    }

                    $dataid = $setDate . $class . sprintf('%03d', $regNo);

                    $this->StudentregistrationModleAdmin->addstufferInfo($data, $datacorse, $dataid, $roll_no);
                } else {
                    $sdata['errormessage'] = 'No Class offered yet for this enrollment information!';
                    $this->session->set_userdata($sdata);
                    redirect(admin_Url() . "/applicant/searchapplicant");
                }
            }

            if ($this->db->trans_status() === FALSE)
                {
                        $this->db->trans_rollback();
                        $sdata['errormessage'] = 'Server Error!';
                }
                else
                {
                        $this->db->trans_commit();
                        $sdata['message'] = 'Registration Complete Successfully!';
                }

            
            $this->session->set_userdata($sdata);
            redirect(admin_Url() . "/applicant/applicantregistration", 'refresh');
        } else {
            $sdata['errormessage'] = 'Registration not completed... Please try again';
            $this->session->set_userdata($sdata);

            redirect(admin_Url() . "/applicant/applicantregistration", 'refresh');
        }
    }

    public function registrationConfirm() {

//        echo '<pre>';
//        print_r($_POST);exit;
        if (isset($_POST['confirmReg'])) {

            $roll_no = $this->input->post('roll_no');
            $data = $this->input->post('data', TRUE);
            $datacls['programId'] = $data['programId'];
            // print_r($data); die();   
            $result = $this->StudentModleAdmin->getstudentsInfoArrayByApplicationId($data['applicationId']);

            if (!empty($result)) {
                $sdata['errormessage'] = 'This Applicant is already Registered!';
                $this->session->set_userdata($sdata);
                redirect(admin_Url() . "/applicant/searchapplicant");
            } else {

                $datas['programOfferId'] = getProgramOfferId($data);
                if (!empty($datas['programOfferId'])) {
                    $datas['courseassignlist'] = $this->CourseofferModleAdmin->CheckOfferedCourseAssign($datas['programOfferId']['programOfferId']);

                    if (!empty($datas['courseassignlist'])) {
                        $data['programOfferId'] = $datas['programOfferId'];
                        $data_info = $this->InstituteModleAdmin->getInstituteInfo();
                        $cls = $this->ProgramModleAdmin->getClassId($data);



                        $setDate = date('Y');
                        $clsId = $this->ProgramModleAdmin->getClassiiId($datacls);
                        $class = sprintf('%02d', $clsId);

                        $counter = $this->ProgramModleAdmin->GetLastStudentSerialNo($setDate, $clsId);
                        if ($counter > 0) {
                            $regNo = $counter + 1;
                            $this->ProgramModleAdmin->UpdateCounter($regNo, $setDate, $clsId);
                        } else {
                            $regNo = 1;
                            $this->ProgramModleAdmin->InsertCounter($regNo, $setDate, $clsId);
                        }

                        $dataid = $setDate . $class . sprintf('%03d', $regNo);

                        //   print_r( $dataid ); die();

                        $insert = $this->StudentregistrationModleAdmin->addstufferInfobyId($data, $dataid);





                        //   print_r($cls); die();
                        //  $insert=$this->StudentregistrationModleAdmin->insertregistrationconfirm($data,$data_info,$cls);
                        if (!empty($insert)) {
                            //   $insert=$this->StudentModleAdmin->deleteadmissionapplicant($data['applicationId']);
                            $datas['applicatntProgram'] = $this->StudentModleAdmin->getstudentInfoByApplicationId($data['applicationId']);

                            $sdata['message'] = 'Registration Complete Successfully!';
                            $this->session->set_userdata($sdata);

                            $data['registration'] = 'active';
                            $this->load->view('system_path/admin/common/header_link'); // header Css link
                            $this->load->view('system_path/admin/common/header'); // body header
                            $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                            $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                            $this->load->view('system_path/admin/courseoffer/courseassign', $datas); // ...........body content page...........
                            $this->load->view('system_path/admin/common/footer'); // footer & script link
                        } else {
                            $sdata['errormessage'] = 'Registration not completed... Please try again!';
                            $this->session->set_userdata($sdata);
                            redirect(admin_Url() . "/applicant/searchapplicant");
                        }
                    } else {
                        $sdata['errormessage'] = 'No Subject offered yet for this enrollment information!';
                        $this->session->set_userdata($sdata);
                        redirect(admin_Url() . "/applicant/searchapplicant");
                    }
                } else {
                    $sdata['errormessage'] = 'No Class offered yet for this enrollment information!';
                    $this->session->set_userdata($sdata);
                    redirect(admin_Url() . "/applicant/searchapplicant");
                }
            }
        } else {
            $sdata['errormessage'] = 'Registration not completed... Please try again';
            $this->session->set_userdata($sdata);
            redirect(admin_Url() . "/applicant/searchapplicant");
        }
    }


    public function Edit_RegistrationForm($applicantid) {
        $data['editData'] = $this->StudentModleAdmin->editapplicantInfo($applicantid);
        $data['prev_info'] = $this->StudentModleAdmin->getPreviousAcademicInfo($applicantid);

       // echo '<pre>';     print_r($data); die();
        if (!empty($data['editData'])) {
            $data['registration'] = 'active';
            $this->load->view('system_path/admin/common/header_link'); // header Css link
            $this->load->view('system_path/admin/common/header'); // body header
            $this->load->view('system_path/admin/common/side_menu'); // side bar menu
            $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
            $this->load->view('system_path/admin/applicant/edit_registration_form'); // ...........body content page...........
            $this->load->view('system_path/admin/common/footer'); // footer & script link
        } else {
            //     echo "DIEEEE"; die();
            $sdata['errormessage'] = 'Invalid Applicantion Id...Please try again';
            $this->session->set_userdata($sdata);
            // $this->searchapplicant();
            redirect(admin_Url() . "/applicant/searchapplicant");
        }
    }

    public function updateapplicant($id) {
        //echo '<pre>';print_r($_POST);exit;
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');


        $config = array(
            array(
                'field' => 'data[firstName]',
                'label' => 'First Name',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[dateOfBirth]',
                'label' => 'Date of Birth',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[sbreg]',
                'label' => 'Birth Registration Number',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[gender]',
                'label' => 'Gender',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[fatherName]',
                'label' => 'father\'s Name',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[motherName]',
                'label' => 'Mother\'s Name',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[fatherPhone]',
                'label' => 'father\'s Mobile Number',
                'rules' => 'required'
            ),
            array(
                'field' => 'datax[programLevel]',
                'label' => 'Class Level',
                'rules' => 'required'
            ),
            array(
                'field' => 'datax[programId]',
                'label' => 'Class',
                'rules' => 'required'
            ),
            array(
                'field' => 'datax[mediumId]',
                'label' => 'Medium',
                'rules' => 'required'
            ),
            array(
                'field' => 'datax[shiftId]',
                'label' => 'Shift',
                'rules' => 'required'
            ),
            array(
                'field' => 'datax[groupId]',
                'label' => 'Group',
                'rules' => 'required'
            ),
            array(
                'field' => 'datax[sessionId]',
                'label' => 'Session',
                'rules' => 'required'
            )
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            redirect(admin_Url() . "/applicant/Edit_RegistrationForm/" . $id);
        } else {
            $data = $this->input->post('data', TRUE);
            //   print_r($data); die();
            $datax = $this->input->post('datax', TRUE);

            $enrol = $this->ProgramModleAdmin->getValidateofferedprogram($datax);

            if (empty($enrol)) {
                $sdata = array();
                $sdata['message'] = 'Inserted Enrollment information is not offered yet !';
                $this->session->set_userdata($sdata);
                redirect(admin_Url() . "/applicant/Edit_RegistrationForm/" . $id);
            } else {

                $yes_upload = $this->upload->do_upload('photo');
                $img_data = $this->upload->data();

                if (empty($img_data['file_name'])) {
                    // echo "asdf"; exit();
                    unset($img_data['file_name']);
                } else {

                    $data['photo'] = "uploads/Students/" . $img_data['file_name'];
                }

                $programOfferId = $enrol['programOfferId'];
                //     print_r($enrol['validate']);    print_r($id);                  print_r($datax); die();
                $this->StudentModleAdmin->updateprogramOfferId($programOfferId, $id);
                $this->StudentModleAdmin->updatePreveousAcademicInfo($id);
               // $upd = false;
                $upd = $this->StudentModleAdmin->updateapplicantInfo($data, $id);
                if ($upd) {
                    $sdata['message'] = 'Updated Successfully !';
                    $this->session->set_userdata($sdata);

                    redirect(admin_Url() . "/applicant/searchapplicant");
                } else {
                    $sdata['errormessage'] = 'Applicant information not updated ';
                    $this->session->set_userdata($sdata);

                    redirect(admin_Url() . "/applicant/Edit_RegistrationForm/" . $id);
                }
            }
        }
    }

// Delete registration form Data
    public function DeleteApplicant($id) {
        $delete = $this->StudentModleAdmin->deleteadmissionapplicant($id);
        if ($delete) {
            $sdata['message'] = 'Applicant Information Successfully Deleted';
            $this->session->set_userdata($sdata);
            // $this->searchapplicant();
            redirect(admin_Url() . "/applicant/searchapplicant");
        } else {
            //     echo "DIEEEE"; die();
            $sdata['errormessage'] = 'Applicant Information not Deleted';
            $this->session->set_userdata($sdata);
            // $this->searchapplicant();
            redirect(admin_Url() . "/applicant/searchapplicant/");
        }
    }

    public function updatestudent_photo() {

        if (isset($_POST['btnSubmit'])) {
            $data_value['applicationId'] = $this->input->post('applicationId', TRUE);

            if (!empty($data_value['applicationId'])) {
                $dlt_file = $this->input->post('photo', TRUE);

                if (file_exists($dlt_file)) {
                    // unlink($dlt_file);
                    unlink($dlt_file);
                }


                $config['upload_path'] = './uploads/Students/';
                $config['allowed_types'] = 'jpg|gif|JPEG|png';
                $config['max_size'] = '1000';
                $config['max_width'] = '1024';
                $config['max_height'] = '768';

                $this->upload->initialize($config);

                $yes_upload = $this->upload->do_upload('photo');
                if (!$yes_upload) {
                    $sdata['errormessage'] = 'Image upload failed...Please maintain image size';
                    $this->session->set_userdata($sdata);
                    redirect(admin_Url() . "/student");
                    // $this->index();
                } else {
                    $img_data = $this->upload->data();
                    $data_value['photo'] = "uploads/Students/" . $img_data['file_name'];
                    $insert = $this->StudentModleAdmin->updatestudentphoto($data_value);

                    if (!empty($insert)) {
                        $sdata['message'] = 'Image Updated';
                        $this->session->set_userdata($sdata);
                        redirect(admin_Url() . "/applicant/searchapplicant/");
                    } else {
                        $sdata['errormessage'] = 'Image Upload failed';
                        $this->session->set_userdata($sdata);
                        $this->index();
                    }
                }
            }
        } else {
            redirect(admin_Url() . "/student/editstudent");
        }
    }

    public function viewappliantInfo($id) {
        $id = (int) $id;
        $data['editData'] = $this->StudentModleAdmin->viewapplicantInfo($id);
        $data['prevaccInfo'] = $this->StudentModleAdmin->prevaccinfo($id);
        // print_r($data['prevaccInfo']); die();
        //  print_r($data);die();
        if (!empty($data['editData'])) {
            $data['student'] = 'active';
            $this->load->view('system_path/admin/common/header_link'); // header Css link
            $this->load->view('system_path/admin/common/header'); // body header
            $this->load->view('system_path/admin/common/side_menu'); // side bar menu
            $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
            $this->load->view('system_path/admin/applicant/applicantprofile', $data); // ...........body content page...........
            $this->load->view('system_path/admin/common/footer'); // footer & script link
        } else {

            echo 'Student Id is Invailed';
        }
    }

    public function insertAdmissiontest($id) {
//          print_r($_POST);
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
            array(
                'field' => 'data[bng]',
                'label' => 'Bangla',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[eng]',
                'label' => ' English',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[math]',
                'label' => 'Math',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[gk]',
                'label' => ' General Knowledge',
                'rules' => 'required'
            )
//            array(
//                'filed' => 'data[studetnId]',
//                'label' => 'Student ID',
//                'rules' => 'exist[]'
//            )
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
//                     
            $this->load->view('templates/admin/common/header');
            $data['id'] = (int) $id;
            $this->load->view('templates/admin/admissiontest/index', $data);
            $this->load->view('templates/admin/common/footer');
        } else {


            $data = $this->input->post('data', TRUE);
//            print_r($data); exit;
            $data['studetnId'] = (int) $id;
            $this->AdmissiontestModleAdmin->addAdmissiontestInfo($data, $id);
            redirect('admin/admissiontest/viewadmissionnresult');
        }
    }

    public function viewadmissionnresult() {


        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/admissiontest/viewadmissionntestresult');
        $this->load->view('templates/admin/common/footer');
    }

    public function searchstudentinfo() {


        $data = $this->input->post('data', TRUE);

        if (empty($data['campusId']) || empty($data['classId']) || empty($data['mediumId']) || empty($data['shiftId']) || empty($data['groupId']) || empty($data['sectionId']) || empty($data['sessionId']) || empty($data['marks'])) {
            $sdata = array();
            $sdata['message'] = "Select All Searching Information Value";
            $this->session->set_userdata($sdata);
            redirect('admin/admissiontest/viewadmissionnresult');
        } else {


            $data['allresult'] = $this->AdmissiontestModleAdmin->getApplicantsearchbySession($data);
            $data['applicantresult'] = $this->AdmissiontestModleAdmin->getResultByMarks($data);
            //  print_r($data); die();
            if ($data['applicantresult'] && $data['allresult']) {
                $this->load->view('templates/admin/common/header');
                $this->load->view('templates/admin/admissiontest/viewadmissionntestresult', $data);
                $this->load->view('templates/admin/common/footer');
            } else {
                $sdata = array();
                $sdata['message'] = "No Applicant find of your searching range";
                $this->session->set_userdata($sdata);
                $this->load->view('templates/admin/common/header');
                $this->load->view('templates/admin/admissiontest/viewadmissionntestresult');
                $this->load->view('templates/admin/common/footer');
            }
        }
    }

    public function admissionstatus() {


        if (!empty($_POST['applicationId'])) {

            $applicationId = $this->input->post('applicationId', TRUE);
            $status = $this->input->post('status', TRUE);

            if ($status == "select") {
                $sdata = array();
                $sdata['message'] = "Select Status";
                $this->session->set_userdata($sdata);
                redirect('admin/admissiontest/viewadmissionnresult');
            } else {
                $count = count($this->input->post('applicationId', TRUE));


                for ($i = 0; $i < $count; $i++) {


                    $data = array(
                        'applicationId' => $applicationId[$i],
                        'status' => $status
                    );

                    $data['marks'] = getTotalMarks($data['applicationId']);

                    $this->AdmissiontestModleAdmin->insertadmissionapplicantstatus($data);
                }

                $sdata['message'] = 'Applicant Status Update Successfull ';
                $this->session->set_userdata($sdata);

                redirect('admin/admissiontest/viewadmissionnresult');
            }
        } else {
            $sdata['message'] = 'Select Applicant';
            $this->session->set_userdata($sdata);

            redirect('admin/admissiontest/viewadmissionnresult');
        }
    }

    public function admissionmeritlist() {

        $this->load->view('templates/admin/common/header');

        $this->load->view('templates/admin/admissiontest/admissionallowlist');
        $this->load->view('templates/admin/common/footer');
    }

    public function admissionallowlist() {


        $data = $this->input->post('data', TRUE);
        //    print_r($data); die();
        $data['applicantmeritstatus'] = $this->AdmissiontestModleAdmin->getApplicantMeritstatus();
        $data['allresult'] = $this->AdmissiontestModleAdmin->getApplicantbySession($data);


        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/admissiontest/admissionallowlist', $data);
        $this->load->view('templates/admin/common/footer');
    }

    public function admissionpromotedapplicant() {


        if (!empty($_POST['applicationId'])) {

            $applicationId = $this->input->post('applicationId', TRUE);

            $count = count($this->input->post('applicationId', TRUE));

            for ($i = 0; $i < $count; $i++) {

                $data = array(
                    'applicationId' => $applicationId[$i]
                );

                $data['marks'] = getTotalMarks($data['applicationId']);
                $datas = $this->StudentModleAdmin->viewapplicantInfo($data['applicationId']);

                $data['campusId'] = $datas['campusId'];
                $data['classId'] = $datas['classId'];
                $data['mediumId'] = $datas['mediumId'];
                $data['groupId'] = $datas['groupId'];
                $data['shiftId'] = $datas['shiftId'];
                $data['sectionId'] = $datas['sectionId'];
                $data['sessionId'] = $datas['sessionId'];
                //        print_r($data);   
                $result = $this->AdmissiontestModleAdmin->checkDuplicatePromotedapplicant($data);
                //      print_r($result); die();
                if ($result) {
                    $sdata['message'] = 'This Applicant is already Promoted!';
                    $this->session->set_userdata($sdata);
                    redirect(base_url('admin/admissiontest/admissionmeritlist'));
                } else {
                    $this->AdmissiontestModleAdmin->insertAdmissionPromotedApplicant($data);
                }
            }


            $sdata['message'] = 'Allowed Applicant Successfully Promoted for Registration ';
            $this->session->set_userdata($sdata);

            redirect('admin/admissiontest/admissionmeritlist');
        }
    }

    public function admissionwaitinglist() {

        $this->load->view('templates/admin/common/header');

        $this->load->view('templates/admin/admissiontest/admissionwaitinglist');
        $this->load->view('templates/admin/common/footer');
    }

    public function waitinglist() {


        $data = $this->input->post('data', TRUE);
        //    print_r($data); die();
        $data['allresult'] = $this->AdmissiontestModleAdmin->getApplicantbySession($data);

        $data['applicantmeritstatus'] = $this->AdmissiontestModleAdmin->getApplicantMeritstatus();
        // print_r($data);exit;
        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/admissiontest/admissionwaitinglist', $data);
        $this->load->view('templates/admin/common/footer');
    }

    public function admissiondisallowlist() {

        $this->load->view('templates/admin/common/header');

        $this->load->view('templates/admin/admissiontest/admissiondisallowlist');
        $this->load->view('templates/admin/common/footer');
    }

    public function disallowlist() {


        $data = $this->input->post('data', TRUE);
        //    print_r($data); die();
        $data['allresult'] = $this->AdmissiontestModleAdmin->getApplicantbySession($data);

        $data['applicantmeritstatus'] = $this->AdmissiontestModleAdmin->getApplicantMeritstatus();
        // print_r($data);exit;
        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/admissiontest/admissiondisallowlist', $data);
        $this->load->view('templates/admin/common/footer');
    }

    public function reqforapprove($studentId) {

        $studentId = (int) $studentId;
        $reqdata = 1;
        $this->AdmissiontestModleAdmin->req_forapprove($reqdata, $studentId);
        $this->viewadmissionnresult();
    }

    public function reqfordisapprove($studentId) {

        $studentId = (int) $studentId;
        $reqdata = 0;
        $this->AdmissiontestModleAdmin->req_fordisapprove($reqdata, $studentId);
        $this->viewadmissionnresult();
    }

    public function waintingList($studentId) {

        $studentId = (int) $studentId;
        $reqdata = 2;
        $this->AdmissiontestModleAdmin->waintingListstatus($reqdata, $studentId);
        $this->viewadmissionnresult();
    }

    public function editadminresult($id) {

        $this->load->view('templates/admin/common/header');
        $data['editData'] = $this->AdmissiontestModleAdmin->editadmissionlInfo($id);

        $data['studetnId'] = (int) $id;

        $this->load->view('templates/admin/admissiontest/editadminresult', $data);
        $this->load->view('templates/admin/common/footer');
    }

    public function updateadmissiontest($id) {
//        print_r($_POST); 
        $id = (int) $id;
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
            array(
                'field' => 'data[bng]',
                'label' => 'Bangla',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[eng]',
                'label' => ' English',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[math]',
                'label' => 'Math',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[gk]',
                'label' => ' General Knowledge',
                'rules' => 'required'
            ),
//            array(
//                'filed' => 'data[studetnId]',
//                'label' => 'Student ID',
//                'rules' => 'exist[]'
//            )
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
//                     
            $this->load->view('templates/admin/common/header');
            $data['id'] = (int) $id;
            $this->load->view('templates/admin/admissiontest/index', $data);
            $this->load->view('templates/admin/common/footer');
        } else {


            $data = $this->input->post('data', TRUE);
//            print_r($data); exit;
            $data['studetnId'] = (int) $id;
            $this->AdmissiontestModleAdmin->updateadmissionlInfo($data, $id);
//			$this->load->view('formsuccess');
            redirect('admin/admissiontest/viewadmissionnresult');
        }
    }

    public function studentawaitinglist() {

        $waitinglist = $this->AdmissiontestModleAdmin->studentawaitinglist();
        ?>

        <table style="width: 50%; border: 1px solid #ccc;">
            <tr>
                <th style="border: 1px solid #ccc;">Registration ID</th>
                <th style="border: 1px solid #ccc;">Name of the Student</th>

                <th style="border: 1px solid #ccc;">Status</th>
            </tr>
        <?php foreach ($waitinglist as $allowlists) { ?>
                <tr>
                    <td style="border: 1px solid #ccc;"><?php echo $allowlists['studetnId']; ?></td>
                    <td style="border: 1px solid #ccc;">
            <?php
            foreach (getstudentsName($allowlists['studetnId']) as $aspppps) {
                echo $aspppps['firstName'] . " " . $aspppps['lastName'];
            }
            ?>
                        </a>
                    </td>
                    <td style="border: 1px solid #ccc;"><?php echo ($allowlists['allowlist'] == 2) ? "Promotted" : "Not Promotted"; ?></td>
                </tr> <?php } ?>
        </table>

        <?php
//        print print_r($waitinglist);
    }

    public function applicant_marks(){
        $this->validation_check();

        if ($this->form_validation->run() == FALSE) {
            $data['registration'] = 'active';
        } else {
            $data['program_offer_id'] = 0;
            $data = $this->input->post('datax', TRUE);
            $data['enrollData'] = $this->ProgramModleAdmin->getValidateofferedprogramold($data);
            if ($data['enrollData']) {
                $data['program_offer_id'] = ($data['enrollData']['programOfferId']) ? $data['enrollData']['programOfferId'] : 0;
            }
           //echo '<pre>'; print_r($data);exit;
             if (!$data['program_offer_id']) {
                $sdata['message'] = 'Program Offer Not Found!';
                $this->session->set_userdata($sdata);
                redirect(base_url('/systemaccess/applicant/applicant_marks'));
            }
                $data['edit_info'] = $this->programmOfferIdCheck($data['program_offer_id']);
              // echo '<pre>'; print_r($data['edit_info']);exit;
                $data['applicantlist'] = $this->StudentModleAdmin->getApplicationIdByprogramofferId($data['program_offer_id']);
                $data['exam_info'] = $this->db->where('programOfferId', $data['program_offer_id'])->get('admidcardinfo')->row();

            if (!$data['applicantlist']) {
                 $sdata['message'] = 'Not Found!';
                 $this->session->set_userdata($sdata);
                 redirect(base_url('/systemaccess/applicant/applicant_marks'));
            }
            if (!$data['exam_info']) {
                 $sdata['message'] = 'Please, Admission Exam Test Setup!';
                 $this->session->set_userdata($sdata);
                 redirect(base_url('/systemaccess/applicant/applicant_marks'));
            }
           // echo '<pre>'; print_r($data);exit;
           // print_r($data);
            
        }

           $this->load->view('system_path/admin/common/header_link'); // header Css link
            $this->load->view('system_path/admin/common/header'); // body header
            $this->load->view('system_path/admin/common/side_menu'); // side bar menu
            $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
            $this->load->view('system_path/admin/applicant/applicant_marks'); // ...........body content page...........
            $this->load->view('system_path/admin/common/footer'); // footer & script link
            $this->load->view('system_path/jsquery'); // footer & script link
    }

    private function programmOfferIdCheck($p_offer_id = 0) {
        $data = [];
        $records = $this->db->where('program_offer_id', $p_offer_id)->get('applicant_results')->result();
        if (!$records) {
            return false;
        }

        if ($records) {
            foreach ($records as $key => $val) {
                $data[$val->applicant_id]['id'] = $val->id;
                $data[$val->applicant_id]['bangla'] = $val->bangla_mark;
                $data[$val->applicant_id]['english'] = $val->english_mark;
                $data[$val->applicant_id]['math'] = $val->math_mark;
                $data[$val->applicant_id]['gen'] = $val->general_mark;
                $data[$val->applicant_id]['total'] = ($val->bangla_mark + $val->general_mark + $val->english_mark + $val->math_mark);
            }
        }
        return $data;
    }

    public function applicant_marks_add()
    {
       // echo '<pre>';print_r($_POST);exit;
        if (!$this->input->post('program_offer_id', TRUE)) {
            $sdata['message'] = 'Program Offer Not Found!';
        }
        $count = count($this->input->post('applicant_id', TRUE));
        //echo '<pre>';print_r($_POST);
        for ($i = 0; $i < $count; $i++) {
            if ($this->input->post('sub_total', TRUE)[$i] != NULL) {
                if (!$this->input->post('edit_id', TRUE)[$i]) {
                        $data[] = [
                        'program_offer_id' => $this->input->post('program_offer_id', TRUE),
                        'applicant_id' => $this->input->post('applicant_id', TRUE)[$i],
                        'bangla_mark' => ($this->input->post('bangla', TRUE)[$i]) ? $this->input->post('bangla', TRUE)[$i] : 0,
                        'english_mark' => ($this->input->post('english', TRUE)[$i]) ? $this->input->post('english', TRUE)[$i] : 0,
                        'math_mark' => ($this->input->post('math', TRUE)[$i]) ? $this->input->post('math', TRUE)[$i] : 0,
                        'general_mark' => ($this->input->post('general_knowledge', TRUE)[$i]) ? $this->input->post('general_knowledge', TRUE)[$i] : 0,
                        'created_by' => 1
                    ];
                } else {
                    $edit_data[] = [
                        'id' => $this->input->post('edit_id', TRUE)[$i],
                        'program_offer_id' => $this->input->post('program_offer_id', TRUE),
                        'applicant_id' => $this->input->post('applicant_id', TRUE)[$i],
                        'bangla_mark' => ($this->input->post('bangla', TRUE)[$i]) ? $this->input->post('bangla', TRUE)[$i] : 0,
                        'english_mark' => ($this->input->post('english', TRUE)[$i]) ? $this->input->post('english', TRUE)[$i] : 0,
                        'math_mark' => ($this->input->post('math', TRUE)[$i]) ? $this->input->post('math', TRUE)[$i] : 0,
                        'general_mark' => ($this->input->post('general_knowledge', TRUE)[$i]) ? $this->input->post('general_knowledge', TRUE)[$i] : 0,
                        'created_by' => 1
                    ];
                }
            }
        }
        if ($count == 0 || (!$data && !$edit_data)) {
             $sdata['message'] = 'Not Submitted Data!';
        } else {
           // echo '<pre>';print_r($data);
           // print_r($edit_data);exit;
            $this->db->trans_begin();
            if ($data) {
                $this->db->insert_batch('applicant_results', $data);
            }
            if ($edit_data) {
                $this->db->update_batch('applicant_results', $edit_data, 'id');
            }
            if ($this->db->trans_status() === FALSE)
            {
                $this->db->trans_rollback();
                $sdata['message'] = 'Server Error!';
            }
            else
            {
                $m = "";
                if ($data && $edit_data) {
                    $m = "Inserted and Updated!";
                } elseif ($data) {
                    $m = "Inserted!";
                } elseif ($edit_data) {
                    $m = "Updated!";
                }
                $this->db->trans_commit();
                $sdata['message'] = 'Successfully '.$m;
            }
        }
        $this->session->set_userdata($sdata);
        redirect(base_url('/systemaccess/applicant/applicant_marks'));
        
        //print_r($data);
        //print_r($count);exit;
    }

    private function validation_check()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
          array(
            'field' => 'datax[mediumId]',
            'label' => 'Medium',
            'rules' => 'required'
        ),
          array(
            'field' => 'datax[programLevel]',
            'label' => 'Class Level',
            'rules' => 'required'
        ),
          array(
            'field' => 'datax[programId]',
            'label' => 'Class',
            'rules' => 'required'
        ),
          array(
            'field' => 'datax[groupId]',
            'label' => 'Group',
            'rules' => 'required'
        ),
          array(
            'field' => 'datax[shiftId]',
            'label' => 'Shift',
            'rules' => 'required'
        ),
          array(
            'field' => 'datax[sessionId]',
            'label' => 'Session',
            'rules' => 'required'
        )
      );
        $this->form_validation->set_rules($config);
    }

    public function admission_result_assign()
    {
        $data = [];
        $status = 0;
        $po_id = 0;
        $this->validation_check();
        if ($this->form_validation->run() == FALSE) {
        }
        if ($_POST) {
            $data = $this->input->post('datax', TRUE);
            $data['enrollData'] = $this->ProgramModleAdmin->getValidateofferedprogramold($data);
            $po_id = ($data['enrollData']['programOfferId']) ? $data['enrollData']['programOfferId'] : 0;
            $data['institute_info'] = $this->rma->getInstituteInfo();
            $data['records'] = $this->getAdmissionResultList($po_id, $status);
        }
        //echo '<pre>';print_r($data);
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/applicant/admission_result_assign'); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
    }

    private function getAdmissionResultList($po_id = 0, $status = 0)
    {
        //print_r($status);exit;
        $where = [];
        $or_where = [];
        if ($po_id) {
            $where['ar.program_offer_id'] = $po_id;
        }
        if ($status) {
            if ($status == 1) {
                $where['ar.status'] = 1;
            }
            if ($status == 2) {
                $where['ar.status'] = 2;
            }
            if ($status == 3) {
                $where['ar.status'] = 3;
            }
            if ($status == 4) {
                $where['ar.status'] = 1;
                $or_where['ar.status'] = 2;
            }
            if ($status == 5) {
                $where['ar.status'] = 1;
                $or_where['ar.status'] = 3;
            }
            if ($status == 6) {
                $where['ar.status'] = 2;
                $or_where['ar.status'] = 3;
            }
        }
       // print_r($po_id);exit;
        $records = $this->db
                    ->select('
                        ar.id,
                        ar.applicant_id,
                        ar.status,
                        si.firstName AS applicant_name,
                        ROUND(ar.bangla_mark) AS bangla_mark,
                        ROUND(ar.english_mark) AS english_mark,
                        ROUND(ar.math_mark) AS math_mark,
                        ROUND(ar.general_mark) AS general_mark,
                        ROUND(ar.bangla_mark + ar.english_mark + ar.math_mark + ar.general_mark) AS total_mark,
                        ac.ExamDate AS exam_date,
                        ac.ExamTime AS exam_time
                        ')
                    ->from('applicant_results AS ar')
                    ->join('admidcardinfo AS ac', 'ar.program_offer_id = ac.programOfferId')
                    //->join('programoffer AS po', 'ac.programofferId = po.programofferId')
                    ->join('studentinfo AS si', 'si.applicationId = ar.applicant_id', 'left')
                    ->where($where)
                    ->or_where($or_where)
                    ->order_by('total_mark','desc')
                    ->get()
                    ->result();
            //print_r($this->db->last_query($records));
        return $records;
    }

    public function admission_result_list()
    {
        $data = [];
        $po_id = 0;
        $status = 0;
        $this->validation_check();
        if ($this->form_validation->run() == FALSE) {
        } else {
            if ($_POST) {
            $data = $this->input->post('datax', TRUE);
            $data['enrollData'] = $this->ProgramModleAdmin->getValidateofferedprogramold($data);
            $po_id = ($data['enrollData']['programOfferId']) ? $data['enrollData']['programOfferId'] : 0;
            $data['institute_info'] = $this->rma->getInstituteInfo();
            $data['records'] = $this->getAdmissionResultList($po_id, $data['status']);
        }
        }
        //echo '<pre>';print_r($data);
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/applicant/admission_result_list'); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
    }

    public function admission_result_assign_status()
    {
       // echo '<pre>';print_r($_POST);exit;
        $update = [];
        $count = count($this->input->post('result_id', TRUE));
        $this->db->trans_begin();
        for ($i=0; $i < $count; $i++) { 
            $this->db
                ->where('id', $this->input->post('result_id', TRUE)[$i])
                ->update('applicant_results',['status'=> $this->input->post('status', TRUE)[$i]]);
        }
       // echo '<pre>';print_r($update);exit;

        if ($this->db->trans_status() === FALSE)
            {
                $this->db->trans_rollback();
                $sdata['message'] = 'Server Error!';
            } else {
                $this->db->trans_commit();
                $sdata['message'] = 'Successfully Updated!';
            }
        $this->session->set_userdata($sdata);
        redirect(base_url('/systemaccess/applicant/admission_result_assign'));
    }

}
