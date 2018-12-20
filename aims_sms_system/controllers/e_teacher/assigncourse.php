<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */

class AssignCourse extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->teacher_logged_auth();
        $this->load->model('admin/assigncourse/AssignCourseModleAdmin', 'AssignCourseModleAdmin');
    }

    public function insertassigncourse() {

        if (!empty($_POST['courseId'])) {

            $studentId = $this->input->post('studentId', TRUE);
            $employeeId = $this->input->post('employeeId', TRUE);
            $programOfferId = $this->input->post('programOfferId', TRUE);

            $courseId = $this->input->post('courseId', TRUE);
            $courseStatus = $this->input->post('courseStatus', TRUE);

            $data = array(
                'studentId' => $studentId,
                'programOfferId' => $programOfferId
            );
            $data['employeeId'] = ',' . implode(',', $employeeId) . ',';
            $data['courseId'] = ',' . implode(',', $courseId) . ',';
            $data['courseStatus'] = ',' . implode(',', $courseStatus) . ',';

            $this->AssignCourseModleAdmin->insertassigncourse($data);

            $sdata['message'] = 'Registration Complete & Subject assign Successfully!';
            $this->session->set_userdata($sdata);

            redirect(admin_Url() . "/applicant/searchapplicant", 'refresh');
            
        } else {
            $sdata['errormessage'] = 'Subject not selected for this student';
            $this->session->set_userdata($sdata);
            redirect(admin_Url() . "/applicant/searchapplicant", 'refresh');
        }
    }
    
    public function insertReassigncourse() {

        //    if(!empty($_POST['commoncourseId']) || !empty($_POST['optionalcourseId'])){
        if (!empty($_POST['courseId'])) {

            $studentId = $this->input->post('studentId', TRUE);
            $employeeId = $this->input->post('employeeId', TRUE);
            $programOfferId = $this->input->post('programOfferId', TRUE);

            $courseId = $this->input->post('courseId', TRUE);
            $courseStatus = $this->input->post('courseStatus', TRUE);

            $data = array(
                'studentId' => $studentId,
                'programOfferId' => $programOfferId
            );
            $data['employeeId'] = ',' . implode(',', $employeeId) . ',';
            $data['courseId'] = ',' . implode(',', $courseId) . ',';
            $data['courseStatus'] = ',' . implode(',', $courseStatus) . ',';

            $this->AssignCourseModleAdmin->insertassigncourse($data);

            $sdata['message'] = 'Re-Registration Confirm & Subject assign Successfully!';
            $this->session->set_userdata($sdata);

             redirect(admin_Url() . "/promotestudent");
            //  }   
        } else {
            $sdata['errormessage'] = 'Subject not selected for this student';
            $this->session->set_userdata($sdata);
             redirect(admin_Url() . "/promotestudent");
        }
    }

    //put your code here
}

