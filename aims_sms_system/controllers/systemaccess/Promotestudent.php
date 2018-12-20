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
            $this->my_admin();
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

        public function insertPromotionconfirm1() {
            $stuentId = $this->input->get('studentId');
            $sessionId = $this->input->get('sessionId');
            $programLevel = $this->input->get('programLevel');
            $programId = $this->input->get('programId');
            $mediumId = $this->input->get('mediumId');
            $groupId = $this->input->get('groupId');
            $shiftId = $this->input->get('shiftId');
            $sectionId = $this->input->get('sectionId');
            $roll_no = $this->input->get('roll_no');
            if (!$stuentId || !$sessionId || !$programLevel || !$programId || !$mediumId || !$groupId || !$shiftId || !$sectionId)
            {
                $sdata['errormessage'] = 'Any Information Error!';
                $this->session->set_userdata($sdata);
                redirect(admin_Url() . "/assigncourse");
            }
            $data = [
                'studentId' => $stuentId,
                'sessionId' => $sessionId,
                'programLevel' => $programLevel,
                'programId' => $programId,
                'mediumId' => $mediumId,
                'groupId' => $groupId,
                'shiftId' => $shiftId,
                'sectionId' => $sectionId,
                'roll_no' => $roll_no,
                'promotionStatus' =>1
            ];
            $this->insertPromotionconfirmPost($data);
           // echo '<pre>';print_r($data);
        }

        public function insertPromotionconfirmPost($data_post=[]) {

          // echo '<pre>';print_r($data_post);exit;

            if (isset($data_post) && $data_post) {
               $data = $data_post;


                $validprogram = $this->ProgramModleAdmin->getProgramOfferId($data);
               // print_r($validprogram);exit;
                if (!empty($validprogram)) {

                    $checkduplicatePromotion = $this->StudentModleAdmin->checkduplicatePromotion($data, $validprogram['programOfferId']);
                   // print_r($checkduplicatePromotion);exit;

                    if (!empty($checkduplicatePromotion)) {

                        $result = $this->StudentModleAdmin->viewStudentInfo($data['studentId']);


                        if (!empty($data['promotionStatus']) && $result['programOfferId'] != $validprogram) {
                            if ($result['programOfferId'] == $validprogram) {
                                $sdata['errormessage'] = 'This Student is already exist in this class for given session!';
                                $this->session->set_userdata($sdata);
                                redirect(base_url('admin/promotestudent/studentReregistration/' . $data['studentId']));
                            } else {

                                $datas['courseassignlist'] = $this->CourseofferModleAdmin->CheckOfferedCourseAssign($validprogram['programOfferId']); 
                                if (!empty($datas['courseassignlist'])) {
                                   // print_r($data);
                                    // print_r($datas['courseassignlist']); die();
                                    $check = $this->checkStudentPromostion($validprogram['programOfferId'], $data['studentId']);   
                                    if ($check) {
                                        $this->StudentModleAdmin->updateStudentPromotionconfirm($data, $result);
                                        $this->StudentModleAdmin->insertStudentPromotionconfirm($data, $result, $validprogram['programOfferId']);
                                    }
                                   
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
                        $sdata['errormessage'] = 'Already promotion status found for this Student';
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

        private function checkStudentPromostion($programOfferId = 0, $studentId = 0) {
            $record = $this->db
                            ->where('studentId', $studentId)
                            ->where('programOfferId', $programOfferId)
                            ->get('promotedstudent')
                            ->row();
            if ($record) {
                return false;
            }
            return true;
        }

        

        public function insertPromotionconfirm($check = 0, $data_post=[]) {

           // echo '<pre>';print_r($_POST);exit;

            if (isset($_POST['regConfirm'])) {
               $data = $this->input->post('data', TRUE);

                $validprogram = $this->ProgramModleAdmin->getProgramOfferId($data);

                if (!empty($validprogram)) {

                    $checkduplicatePromotion = $this->StudentModleAdmin->checkduplicatePromotion($data, $validprogram['programOfferId']);

                    if (empty($checkduplicatePromotion)) {

                        $result = $this->StudentModleAdmin->viewStudentInfo($data['studentId']);


                        if (!empty($data['promotionStatus']) && $result['programOfferId'] != $validprogram) {
                            if ($result['programOfferId'] == $validprogram) {
                                $sdata['errormessage'] = 'This Student is already exist in this class for given session!';
                                $this->session->set_userdata($sdata);
                                redirect(base_url('admin/promotestudent/studentReregistration/' . $data['studentId']));
                            } else {

                                $datas['courseassignlist'] = $this->CourseofferModleAdmin->CheckOfferedCourseAssign($validprogram['programOfferId']); 
                                if (!empty($datas['courseassignlist'])) {
                                   // print_r($data);
                                    // print_r($datas['courseassignlist']); die();   
                                    $check = $this->checkStudentPromostion($validprogram['programOfferId'], $data['studentId']);  
                                    if ($check) {
                                        $this->StudentModleAdmin->updateStudentPromotionconfirm($data, $result);
                                    $this->StudentModleAdmin->insertStudentPromotionconfirm($data, $result, $validprogram['programOfferId']);
                                    }
                                    

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
        
        public function searchbyclass(){
          $data['student'] = 'active';
            $this->load->view('system_path/admin/common/header_link'); // header Css link
            $this->load->view('system_path/admin/common/header'); // body header
            $this->load->view('system_path/admin/common/side_menu'); // side bar menu
            $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
            $this->load->view('system_path/admin/promotion/promotebyclass', $data); // ...........body content page...........
            $this->load->view('system_path/admin/common/footer'); // footer & script link 
            $this->load->view('system_path/jsquery'); // footer & script link
        }

        private function getProgramOfferId($data = [])
        {
            if ($data['sessionId']) {

            }
            if ($data['programId']) {

            }
            if ($data['mediumId']) {

            }
            if ($data['groupId']) {

            }
            if ($data['sessionId']) {

            }
            if ($data['sessionId']) {

            }

            $row = $this->db
            ->get('programoffer')
            ->row();
        }
        
        
        public function searchRegisteredStudent() {

            $data = $this->input->post('data', TRUE); 
                //echo '<pre>';print_r($data);exit;

            $programOfferId = $this->getProgramOfferId($data);


            if (empty($data)) {

               $sdata['errormessage'] = 'No student found inserted enrollment information';
               $this->session->set_userdata($sdata);
               redirect(admin_Url() . "/student");
           }  else {



            $data['studentlist'] = $this->StudentModleAdmin->searchlist($data);
                 // print_r($data['studentlist']); die();

            if (!empty($data['studentlist'])) {

                $data['student'] = 'active'; 
                            $this->load->view('system_path/admin/common/header_link'); // header Css link
                            $this->load->view('system_path/admin/common/header'); // body header
                            $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                            $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                            $this->load->view('system_path/admin/promotion/promotestudentbyclass',$data); // ...........body content page...........
                            $this->load->view('system_path/admin/common/footer'); // footer & script link     
                            $this->load->view('system_path/jsquery'); // footer & script link

                        } else {
                            $sdata['errormessage'] = 'Student information Not found';
                            $this->session->set_userdata($sdata);
                            redirect(admin_Url() . "/student");
                        }
                    }
                }

                public function reregistrationConfarm() {

                //echo '<pre>';print_r($_POST);exit;

               // print_r($validprogram); die();
                    $checkAll = $this->input->post('checkAll');
            // print_r($checkAll); die();
                    $studentId = $this->input->post('studentId', TRUE);
                    $rollNo = $this->input->post('roll_no', TRUE);

            //   print_r($studentId); die();
                    $courseId = $this->input->post('courseId', TRUE);


                    $data = $this->input->post('data', TRUE);

                    $validprogram = $this->ProgramModleAdmin->getProgramOfferId($data);

                 // $data['programOfferId'] = getProgramOfferId($dataa);

                    if(!empty($checkAll)){
                        $cuntCrl= $checkAll;

                        for ($i = 0; $i < count($cuntCrl); $i++)
                        {
                           $test=$checkAll[$i]-1;


                           $data['studentId']=$studentId[$test];
                           $data['roll_no'] = $rollNo[$test];
                           $student_id[] = $studentId[$test];
                           $result = $this->StudentModleAdmin->viewStudentInfo($data['studentId']);
                      //  print_r($data['applicationId']); die();
                           $data['programOfferId'] = getProgramOfferId($data);
                           if(!empty($data['programOfferId'])){
                            $check = $this->checkStudentPromostion($validprogram['programOfferId'], $data['studentId']);  
                            if ($check) {
                                 $this->StudentModleAdmin->updateStudentPromotionconfirm($data, $result);
                             $this->StudentModleAdmin->insertStudentPromotionconfirm($data, $result, $validprogram['programOfferId']);
                            }
                         }

                         else {
                            $sdata['errormessage'] = 'No Class offered yet for this enrollment information!';
                            $this->session->set_userdata($sdata);
                            redirect(admin_Url()."/applicant/searchapplicant");
                        }
                    }

                        //print_r($student_id);
                       // exit;
                        //print_r($data['studentId']);
                    $datas['courseassignlist'] = $this->CourseofferModleAdmin->CheckOfferedCourseAssign($validprogram['programOfferId']); 
                    if ($datas['courseassignlist']) :
                        $datas['studentId'] = $data['studentId'];
                    $datas['programOfferId'] = $validprogram;
                    $datas['studentinfo'] = $this->StudentModleAdmin->getmultistudentNameInfo($student_id);
                    $sdata['message'] = 'Registration Complete Successfully!';
                    $this->session->set_userdata($sdata);

                    $data['student'] = 'active';
                        $this->load->view('system_path/admin/common/header_link'); // header Css link
                        $this->load->view('system_path/admin/common/header'); // body header
                        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                        $this->load->view('system_path/admin/courseoffer/multi_course_reassign', $datas); // ...........body content page...........
                        $this->load->view('system_path/admin/common/footer'); // footer & script link
                        else :
                            $sdata['errormessage'] = 'No Subject offered yet for this enrollment information!';
                        $this->session->set_userdata($sdata);
                        redirect(admin_Url() . "/promotestudent");
                        endif;


                    //$sdata['message'] = 'Registration Complete Successfully!';
                   // $this->session->set_userdata($sdata);

                   //redirect(admin_Url() . "/applicant/applicantregistration", 'refresh');
                    }
                    else{
                       $sdata['errormessage'] = 'Registration not completed... Please try again';
                       $this->session->set_userdata($sdata);

                       redirect(admin_Url() . "/applicant/applicantregistration", 'refresh');
                   }



               } 

               public function admitcard(){

               }

               public function seatplan(){

               } 



           }

