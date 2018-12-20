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
        $this->teacher_logged_auth();

        $this->load->model('admin/admissiontest/AdmissiontestModleAdmin', 'AdmissiontestModleAdmin');
        $this->load->model('admin/studentregistration/StudentregistrationModleAdmin', 'StudentregistrationModleAdmin');
        $this->load->model('admin/student/StudentModleAdmin', 'StudentModleAdmin');
        $this->load->model('admin/program/ProgramModleAdmin', 'ProgramModleAdmin');
        $this->load->model('admin/courseoffer/CourseofferModleAdmin', 'CourseofferModleAdmin');
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
                array(
                    'field' => 'data[fatherPhone]',
                    'label' => 'father\'s Mobile Number',
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
                $data['registration'] = 'active';
                $this->load->view('system_path/admin/common/header_link'); // header Css link
                $this->load->view('system_path/admin/common/header'); // body header
                $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                $this->load->view('system_path/admin/applicant/registration_form'); // ...........body content page...........
                $this->load->view('system_path/admin/common/footer'); // footer & script link
                $this->load->view('system_path/jsquery'); // footer & script link
            } else {
                //   print_r($_POST); exit;
                $data = $this->input->post('data', TRUE);
                $datax = $this->input->post('datax', TRUE);

                $enrol = $this->ProgramModleAdmin->getValidateofferedprogram($datax);


                if (!empty($enrol)) {
                    if (!empty($data) && !empty($enrol)) {
                        $config['upload_path'] = './uploads/Students/';
                        $config['allowed_types'] = 'jpg|gif|JPEG|png';
                        $config['max_size'] = '';
                        $config['max_width'] = '';
                        $config['max_height'] = '';

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
                        } else {
                            $new_stt = sprintf('%02d', $datax['programId']);
                            $datae = date('Y');
                            $data['applicationId'] = $datae . "" . strval($new_stt) . "" . counter();

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
                                $img_data = $this->upload->data();
                                $data['photo'] = "uploads/Students/" . $img_data['file_name'];

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

    public function applicantlist() {

        if (isset($_POST['search'])) {
            $this->load->helper(array('form', 'url'));
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
            } else {
                $data = $this->input->post('datax', TRUE);

                $data['enrollData'] = $this->ProgramModleAdmin->getValidateofferedprogram($data);

                if (!empty($data['enrollData'])) {

                    $data['applicantlist'] = $this->StudentModleAdmin->getApplicationIdByprogramofferId($data['enrollData']['programOfferId']);
                    //     print_r($data['studentlist']); die();

                    if (!empty($data['applicantlist'])) {
                        if (isset($_POST['search'])) {
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
        } else {

            redirect(admin_Url() . "/applicant/searchapplicant");
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
            if(!empty($data['applicantlist']))
            {
                $this->load->view('system_path/admin/common/header_link'); // header Css link
                $this->load->view('system_path/admin/applicant/printapplicant_list', $data); // ...........body content page...........
                $this->load->view('system_path/admin/common/footer'); // footer & script link    
            }
            else
            {
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

        $data['applicationId'] = (int) $applicationId;

        $applicantpromotioninfo = $this->StudentModleAdmin->getstudentsInfoArrayByApplicationId($data['applicationId']);

        if (!empty($applicantpromotioninfo['applicationId']) == $data['applicationId']) {
            $sdata = array();
            $sdata['errormessage'] = "This Applicant is already registered";
            $this->session->set_userdata($sdata);
            redirect(admin_Url() . "/applicant/searchapplicant");
        } else {
            $data['studentlist'] = $this->StudentModleAdmin->getApplicantShortInfo($data['applicationId']); // get applicant some information
            //Get ProgramOffer information as array by application id using join    
            $data['programofferinfo'] = $this->ProgramModleAdmin->getPrOfferArraybyApplicantionId($data['applicationId']);

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
    }

    public function registrationConfirm() {

        if (isset($_POST['confirmReg'])) {

            $data = $this->input->post('data', TRUE);
            
            $result = $this->StudentModleAdmin->getstudentsInfoArrayByApplicationId($data['applicationId']);
          
            if (!empty($result)) {

                $sdata['errormessage'] = 'This Applicant is already Registered!';
                $this->session->set_userdata($sdata);
                redirect(admin_Url() . "/applicant/searchapplicant");
            } else {

                $datas['programOfferId'] = getProgramOfferId($data);

                if (!empty($datas['programOfferId'])) {
                    $datas['courseassignlist'] = $this->CourseofferModleAdmin->CheckOfferedCourseAssign($datas['programOfferId']);

                    if (!empty($datas['courseassignlist'])) {
                        $data['programOfferId'] = $datas['programOfferId'];
                        $insert=$this->StudentregistrationModleAdmin->insertregistrationconfirm($data);
                        if(!empty($insert))
                        {
                            $insert=$this->StudentModleAdmin->deleteadmissionapplicant($data['applicationId']);
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
                        }
                        else {
                                $sdata['errormessage'] = 'Registration not completed... Please try again!';
                                $this->session->set_userdata($sdata);
                                redirect(admin_Url()."/applicant/searchapplicant");
                            }
                    } else {
                        $sdata['errormessage'] = 'No Subject offered yet for this enrollment information!';
                        $this->session->set_userdata($sdata);
                        redirect(admin_Url()."/applicant/searchapplicant");
                    }
                } else {
                    $sdata['errormessage'] = 'No Class offered yet for this enrollment information!';
                    $this->session->set_userdata($sdata);
                    redirect(admin_Url()."/applicant/searchapplicant");
                }
            }
        } else {
           $sdata['errormessage'] = 'Registration not completed... Please try again';
           $this->session->set_userdata($sdata); 
           redirect(admin_Url()."/applicant/searchapplicant");
        }
    }
    
     public function Edit_RegistrationForm($applicantid) {
        $data['editData'] = $this->StudentModleAdmin->editapplicantInfo($applicantid);
     
        //     print_r($data); die();
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
            } 
            else {
                $config['upload_path'] = './uploads/Students/';
                $config['allowed_types'] = 'jpg|gif|JPEG|png';
                $config['max_size'] = '200';
                $config['max_width'] = '200';
                $config['max_height'] = '200';

                $this->upload->initialize($config);        

                $data = $this->input->post('data', TRUE);
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
                    $upd=$this->StudentModleAdmin->updateapplicantInfo($data, $id);
                    if(!empty($upd)) 
                    {                        
                        $sdata['message'] = 'Updated Successfully !';
                        $this->session->set_userdata($sdata);

                        redirect(admin_Url() . "/applicant/searchapplicant");
                    }
                    else{
                        $sdata['errormessage'] = 'Applicant information not updated ';
                        $this->session->set_userdata($sdata);

                        redirect(admin_Url() . "/applicant/Edit_RegistrationForm/" . $id);
                    }
                }
            }
    }
    
// Delete registration form Data
      public function DeleteApplicant($id) {
        $delete=$this->StudentModleAdmin->deleteadmissionapplicant($id);
        if($delete)
        {
              $sdata['message'] = 'Applicant Information Successfully Deleted';
             $this->session->set_userdata($sdata);
           // $this->searchapplicant();
            redirect(admin_Url() . "/applicant/searchapplicant");

        }

       else {
       //     echo "DIEEEE"; die();
             $sdata['errormessage'] = 'Applicant Information not Deleted';
             $this->session->set_userdata($sdata);
           // $this->searchapplicant();
            redirect(admin_Url() . "/applicant/searchapplicant/");
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

            }

            