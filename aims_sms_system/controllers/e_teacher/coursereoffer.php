<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */

class Coursereoffer extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->teacher_logged_auth();
        $this->load->model('admin/coursereoffer/CoursereofferModleAdmin', 'CoursereofferModleAdmin');
        $this->load->model('admin/courseoffer/CourseofferModleAdmin', 'CourseofferModleAdmin');
    }

    public function courseOfferlist() {

        $this->load->library('form_validation');
        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/coursereoffer/courseoffersearch');
        $this->load->view('templates/admin/common/footer');
    }

    public function searchcourseofferlist() {

        $data = $this->input->post('data', TRUE);
     //   print_r($data); die();
        if (empty($data['campusId']) || empty($data['programId']) || empty($data['sessionId']) || empty($data['sectionId']) || empty($data['shiftId']) || empty($data['groupId']) || empty($data['mediumId'])) {

            $sdata = array();
            $sdata['message'] = "Select All Searching Value";
            $this->session->set_userdata($sdata);
            $this->load->view('templates/admin/common/header');
            $this->load->view('templates/admin/coursereoffer/courseoffersearch',$data);
            $this->load->view('templates/admin/common/footer');
        } else {
            $data['programOfferId']= getProgramOfferId($data);
            $data['courseofferlist'] = $this->CoursereofferModleAdmin->searchcourseofferlist($data);
            if(!empty($data['courseofferlist']))
            {
                $this->load->view('templates/admin/common/header');
                $this->load->view('templates/admin/coursereoffer/courseofferlist', $data);
                $this->load->view('templates/admin/common/footer');
            }
            else{
                $sdata = array();
                $sdata['message'] = "No data found";
                $this->session->set_userdata($sdata);
                $this->load->view('templates/admin/common/header');
                $this->load->view('templates/admin/coursereoffer/courseoffersearch',$data);
                $this->load->view('templates/admin/common/footer');
            }
            
        }
    }

    public function insertreofferedcourse() {

        $offerId = $this->input->post('offerId', TRUE);
        $courseId = $this->input->post('courseId', TRUE);
        $categoryName = $this->input->post('categoryName', TRUE);
        $curriculumId = $this->input->post('curriculumId', TRUE);
        $employeeId = $this->input->post('employeeId', TRUE);
        
        
        $datax['campusId'] = $this->input->post('campusId', TRUE);
        $datax['mediumId'] = $this->input->post('mediumId', TRUE);
        $datax['programId'] = $this->input->post('programId', TRUE);
        $datax['groupId'] = $this->input->post('groupId', TRUE);
        $datax['sectionId'] = $this->input->post('sectionId', TRUE);
        $datax['shiftId'] = $this->input->post('shiftId', TRUE);        
        $datax['sessionId'] = $this->input->post('sessionId', TRUE);
        
        $marks = $this->input->post('marks', TRUE);
        $instituteCode = $this->input->post('instituteCode', TRUE);

        
        
        if (!empty($offerId)) {
            
           if ($datax['sessionId'] == '') 
           { 
                $sdata['message'] = 'Select Session for re-offer!';
                $this->session->set_userdata($sdata);

                redirect('admin/coursereoffer/courseOfferlist', 'refresh');
           }
           else {
                $programOfferId= getProgramOfferId($datax); 
               // echo $programOfferId; die();
                if($programOfferId != 0){
                     $count = count($offerId);

                          for ($i =0; $i < $count; $i++) {

                              $data = array(

                                  'courseId' => $courseId[$i],
                                  'categoryName' => $categoryName[$i],
                                  'curriculumId' => $curriculumId[$i],
                                  'employeeId' => $employeeId[$i],
                                  'programOfferId'=>$programOfferId,
                                  'instituteCode' => $instituteCode[$i],
                                  'marks' => $marks[$i]

                              );




                            
                              //    $this->CoursereofferModleAdmin->deleteCourseoffer($data); 

                                  $result = $this->CourseofferModleAdmin->duplicateCourseofferInfo1($data);

                                  if (!$result) {

                                      $data['status'] = "Subject Offered for " . $datax['sessionId'];

                                      $this->CoursereofferModleAdmin->insertCourseofferInfo($data);


                                  } 
                                  else {
                                      $sdata['message'] = 'This Subject is already offered for this class!';
                                      $this->session->set_userdata($sdata);

                                      $this->load->library('form_validation');
                                      $this->load->view('templates/admin/common/header');
                                      $this->load->view('templates/admin/coursereoffer/courseoffersearch');
                                      $this->load->view('templates/admin/common/footer');
                                  }
                              
                          }
                          $sdata['message'] = 'Course Re-Offered Successfully!';
                          $this->session->set_userdata($sdata);

                        //  $data['coursereofferlist'] = $this->CoursereofferModleAdmin->searchcourseofferlist($data);

                          $this->load->view('templates/admin/common/header');
                          $this->load->view('templates/admin/coursereoffer/courseoffersearch', $datax);
                          $this->load->view('templates/admin/common/footer');

                  } 
                  
                  else {
                      $sdata['message'] = 'Enrollment information is not offer yet in this session';
                      $this->session->set_userdata($sdata);
                      redirect('admin/coursereoffer/courseOfferlist', 'refresh');
                  }
           }
        }
        else {
            $sdata['message'] = 'Select CheckBox for re-offer!';
            $this->session->set_userdata($sdata);

            redirect('admin/coursereoffer/courseOfferlist', 'refresh');
        }
    }

    //put your code here
}

