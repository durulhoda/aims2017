<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */

class Studentregistration extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->my_admin();
        $this->load->model('admin/studentregistration/StudentregistrationModleAdmin', 'StudentregistrationModleAdmin');

        $this->load->model('admin/student/StudentModleAdmin', 'StudentModleAdmin');
        $this->load->model('admin/admissiontest/AdmissionTestModleAdmin', 'AdmissiontestModleAdmin');
        $this->load->model('admin/courseoffer/CourseofferModleAdmin', 'CourseofferModleAdmin');
    }

    public function registration() {
       
        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/studentregistration/index');
        $this->load->view('templates/admin/common/footer');
    }

    public function registerStudent($id) {
        $this->load->library('form_validation');
        $data['studentid'] = (int) $id;
        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/studentregistration/index', $data);
        $this->load->view('templates/admin/common/footer');
    }

    public function insertregistredstudentinfo($id) {


        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $data['studentid'] = (int) $id;
        $config = array(
            array(
                'field' => 'data[programId]',
                'label' => 'class',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[rollnumber]',
                'label' => 'roll Number',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[campusId]',
                'label' => 'campus',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[mediumId]',
                'label' => 'medium',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[shiftId]',
                'label' => 'shift',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[sectionId]',
                'label' => 'section',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[courseId]',
                'label' => 'course',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[sessionId]',
                'label' => 'session',
                'rules' => 'required'
            )
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
//                    redirect(base_url('admin/campus'));
            $this->load->view('templates/admin/common/header');
            $this->load->view('templates/admin/studentregistration/index', $data);
            $this->load->view('templates/admin/common/footer');
        } else {

            $data = $this->input->post('data', TRUE);

            $data['courseId'] = ',' . implode(',', $data['courseId']) . ',';

            $data['studentid'] = (int) $id;
            $this->StudentregistrationModleAdmin->addStudentregistrationInfo($data);
//            redirect('admissiontest/allowlist');
            redirect(base_url('admin/admissiontest/allowlist'));
//			 
        }
    }

    // unused controller

    public function showregisterstudent() {
        $data['title'] = "List of Registered Students";
        $data['registerStudent'] = $this->StudentregistrationModleAdmin->get_showregisterstudent();
        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/studentregistration/showregisterstudentlist', $data);
        $this->load->view('templates/admin/common/footer');
    }

     public function searchregisterstudentinfo() {

        $data['applicationId'] = $this->input->post('applicationId', TRUE);
        $applicantpromotioninfo= $this->StudentModleAdmin-> getstudentsInfoArrayByApplicationId($data['applicationId']);
     
     //  print_r($applicantpromotioninfo); die();
        if (empty($data['applicationId'])){
            $sdata = array();
            $sdata['message'] = "Insert Applicant ID";
            $this->session->set_userdata($sdata);
            
            $this->load->view('templates/admin/common/header');
            $this->load->view('templates/admin/studentregistration/index');
            $this->load->view('templates/admin/common/footer');
        } 
       elseif (!empty($applicantpromotioninfo['applicationId'])==$data['applicationId']){
            $sdata = array();
            $sdata['message'] = "This Applicant is already registered";
            $this->session->set_userdata($sdata);
            
            $this->load->view('templates/admin/common/header');
            $this->load->view('templates/admin/studentregistration/index');
            $this->load->view('templates/admin/common/footer');
        } 
        else{
            $data['studentlist'] = $this->StudentModleAdmin->viewapplicantInfo($data['applicationId']);
          //  print_r($data['studentlist']); die();
            if(empty($data['studentlist'])){
                $sdata['message'] = "Invalid Application Id";
                $this->session->set_userdata($sdata);
            
                $this->load->view('templates/admin/common/header');
                $this->load->view('templates/admin/studentregistration/index',$data);
                $this->load->view('templates/admin/common/footer');
            }
            else{
                
            //Get ProgramOffer information as array by application id using join    
                 $data['programofferinfo']=getPrOfferArraybyApplicantionId($data['applicationId']);
                 
                $data['courseassignlist'] = $this->CourseofferModleAdmin->CheckOfferedCourseAssign($data['programofferinfo']['programOfferId']);
           //  print_r($data['courseassignlist']); die(); 
                    if(!empty($data['courseassignlist']))
                    {

         // If Admission Procedure Continue with Admission Mark & Merit List then enable next line        
                  
                //  $data['studentlist'] = $this->AdmissiontestModleAdmin->getPromotedApplicantinfo($datas);
                
         // If Admission Procedure Continue with Direct Admission then enable next line    
                        
                 //  print_r($data); die();
                        $this->load->view('templates/admin/common/header');
                        $this->load->view('templates/admin/studentregistration/searchregisterstudentinfo', $data);
                        $this->load->view('templates/admin/common/footer');

                    }
                    else
                    {
                        $sdata = array();
                        $sdata['message'] = "For your inserted Applicant Id there are no Subject offered yet..";
                        $this->session->set_userdata($sdata);

                        $this->load->view('templates/admin/common/header');
                        $this->load->view('templates/admin/studentregistration/index');
                        $this->load->view('templates/admin/common/footer');
                    }
            }
        
        }
    }

    
    

    public function studentregistrationtlist() {
        $data['title'] = "List of Registered Students";
        $data['registerStudentlist'] = $this->StudentModleAdmin->getregisterstudent();
        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/studentregistration/showregisterstudentlist', $data);
        $this->load->view('templates/admin/common/footer');
    }
    
    
    
    
    public function insertregistrationconfirm() {
        
        
        if (isset($_POST['regConfirm'])) {
       
          $data = $this->input->post('data', TRUE);

                    $result = $this->StudentModleAdmin->getstudentsInfoArrayByApplicationId($data['applicationId']);
            //        print_r($data['applicationId']); die();
                    if (!empty($result)) {
                        $sdata['message'] = 'This Applicant is already Registered!';
                        $this->session->set_userdata($sdata);
                        redirect(base_url('admin/studentregistration/registration'));
                    } 
                    else {       
                        
                        $datas['programOfferId']=  getProgramOfferId($data);
                
                        if($datas['programOfferId']!=0){
                                $datas['courseassignlist']= $this->CourseofferModleAdmin->CheckOfferedCourseAssign($datas['programOfferId']);
                             
                                if(!empty($datas['courseassignlist'])){
                                    $data['programOfferId']=$datas['programOfferId'];
                                $this->StudentregistrationModleAdmin->insertregistrationconfirm($data);
                           //    print_r($data['applicationId']);
                                    $datas['applicatntProgram']= $this->StudentModleAdmin->getstudentInfoByApplicationId($data['applicationId']);
                  
                                    $sdata['message'] = 'Registration Complete Successfully!';
                                    $this->session->set_userdata($sdata);

                                    $this->load->view('templates/admin/common/header');
                                    $this->load->view('templates/admin/courseoffer/courseassign', $datas);
                                    $this->load->view('templates/admin/common/footer');
                                }
                                else{
                                    $sdata['message'] = 'No Subject offered yet for this enrollment information!';
                                    $this->session->set_userdata($sdata);
                                    redirect(base_url('admin/studentregistration/registration'));
                                }
                        }
                        else{
                             $sdata['message'] = 'No Class offered yet for this enrollment information!';
                                    $this->session->set_userdata($sdata);
                                    redirect(base_url('admin/studentregistration/registration'));
                        }
                     }
                     
        }
        else {
            
            redirect(base_url('admin/studentregistration/registration'));
        }
        
        
        
    }
    
 
    

   /* 
     public function insertregistrationconfirm() {


        if (!empty($_POST['applicationId'])) {
            $datas['applicationId'] = $this->input->post('applicationId');

            $ab = array();
            $ab = $datas['applicationId'];
            for ($i = 0; $i < count($ab); $i++) {
                $cat = $ab[$i];
                $datas['applicationId'] = $cat;


                $result = $this->StudentregistrationModleAdmin->checkduplicateapplicant($datas['applicationId']);
                //      print_r($result); die();
                if ($result) {
                    $sdata['message'] = 'This Applicant is already Registered!';
                    $this->session->set_userdata($sdata);
                    redirect(base_url('admin/studentregistration/registration'));
                } else {

                    $data = $this->input->post('data', TRUE);
                    $this->StudentregistrationModleAdmin->insertregistrationconfirm($data, $datas['applicationId']);

                    $data['applicationId'] = $datas['applicationId'];
                }
            }
            //  print_r($data['applicationId']);                        die();
            $sdata['message'] = 'Registration Complete Successfully!';
            $this->session->set_userdata($sdata);
            //        
            //       redirect('admin/courseoffer/courseassignlist', 'refresh');        


            $data['courseassignlist'] = $this->CourseofferModleAdmin->searchcourseassignlist($data);
            //        print_r($data['courseassignlist']);               die();
            $this->load->view('templates/admin/common/header');
            $this->load->view('templates/admin/courseoffer/courseassign', $data);
            $this->load->view('templates/admin/common/footer');
        } else {
            $sdata['message'] = 'Select Applicant for registration confirm!';
            $this->session->set_userdata($sdata);
            redirect(base_url('admin/studentregistration/registration'));
        }
    }
*/
//put your code here
}
