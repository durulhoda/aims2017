<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */

class Homework extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->my_admin();
        $this->load->helper('text');
        $this->load->model('admin/homework/HomeworkModleAdmin', 'HomeworkModleAdmin');
        $this->load->model('admin/studentmarks/StudentmarksModleAdmin', 'StudentmarksModleAdmin');
        $this->load->model('admin/courseassign/CourseAssignModleAdmin', 'CourseAssignModleAdmin');
        $this->load->model('admin/program/ProgramModleAdmin', 'ProgramModleAdmin');
    }

    public function index() {
        $data['homeworklistdata'] = 'active';
        $data['addhomework'] = 'active';
       
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/homework/index'); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
         $this->load->view('system_path/jsquery'); // footer & script link
    }

    public function homeworkinfo() {

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
                'field' => 'data[sectionId]',
                'label' => 'Section',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[shiftId]',
                'label' => 'Shift',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[sessionId]',
                'label' => 'Session',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[courseId]',
                'label' => 'Session',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
          redirect(admin_Url() . "/homework");
          
        } else {

            $data = $this->input->post('data', TRUE);
            $data['programOfferId'] = getProgramOfferId($data);

            if ($data['programOfferId'] != 0) {

                $new_data['employeeId'] = $data['programOfferId']['employeeId'];
                $new_data['programOfferId'] = $data['programOfferId']['programOfferId'];

                // Get Course List by employeeId & ProgramOfferId As Array
                $data['courselist'] = getCourseIdByTeacher($new_data);

                if (!empty($data['courselist'])) {   
                $data['homeworklistdata'] = 'active';
                $data['addhomework'] = 'active';
                //$data['programOfferId'] = $this->ProgramModleAdmin->getProgramOfferId($data);

                $value=array();
                $value['courseId']=$data['courseId'];
                $value['programOfferId']=$data['programOfferId']['programOfferId'];
                $value['employeeId']=$data['programOfferId']['employeeId'];
                $value['homework']=$data['homework'];

                $this->HomeworkModleAdmin->addhomeworkInfo($value);
              // $data['studentlist'] = $this->CourseAssignModleAdmin->AssignedCourseStudents($data);
                //print_r($data);                die();
                $sdata['message'] = 'Successfull!';
                $this->session->set_userdata($sdata);
                $this->load->view('system_path/admin/common/header_link'); // header Css link
                $this->load->view('system_path/admin/common/header'); // body header
                $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
                $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                $this->load->view('system_path/admin/homework/index'); // ...........body content page...........
                $this->load->view('system_path/admin/common/footer'); // footer & script link
                }
                else {
                    $sdata['errormessage'] = 'There are no Subject offered for this Teacher yet..!!';
                    $this->session->set_userdata($sdata);
                     redirect(admin_Url()."/homework");
                }
            } else {
                $sdata['errormessage'] = 'Inserted Enrollment information is not offered yet!';
                $this->session->set_userdata($sdata);
               redirect(admin_Url()."/homework");
            }
        }
    }

    public function inserthomework() {

        $data = $this->input->post('data', TRUE);
        if (!empty($data['courseId']) && !empty($data['homework'])) {

            if (!empty($data['programOfferId'])) {
                $this->HomeworkModleAdmin->addhomeworkInfo($data);
                $sdata['message'] = 'Successfull!';
                $this->session->set_userdata($sdata);

                redirect(admin_Url()."/homework");
            } else {

                $sdata['errormessage'] = 'Enrollment information is missing...please try again!';
                $this->session->set_userdata($sdata);
                 redirect(admin_Url()."/homework");
            }
        } else {
            //    echo "vcxxv";die();
            $sdata['errormessage'] = 'Value Missing..Insert Again';
            $this->session->set_userdata($sdata);
             redirect(admin_Url()."/homework/");
        }
    }

    public function homeworklist() {

       $data['homeworklistdata'] = 'active';
        $data['homework'] = 'active';

        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/homework/homeworksearch'); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
    }

    public function searchhomeworklist() {
        
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
                'field' => 'data[sectionId]',
                'label' => 'Section',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[shiftId]',
                'label' => 'Shift',
                'rules' => 'required'
            ),
//            array(
//                'field' => 'data[employeeId]',
//                'label' => 'Teacher ',
//                'rules' => 'required'
//            ),
            array(
                'field' => 'data[sessionId]',
                'label' => 'Session',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[courseId]',
                'label' => 'Subject',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
//                    redirect(base_url('admin/campus'));
            redirect(admin_Url()."/homework/homeworklist");
        } else {

            $data = $this->input->post('data', TRUE);
            $data['programOfferId'] = getProgramOfferId($data);

            if (!empty($data['programOfferId'])) {

                $new_data['programOfferId']=$data['programOfferId']['programOfferId'];
                $new_data['employeeId']=$data['programOfferId']['employeeId'];
                $new_data['courseId']=$data['courseId'];

                $data['homeworklist'] = $this->HomeworkModleAdmin->searchhomeworklist($new_data);

//                echo '<pre>';
//                print_r($data);exit;

                if (!empty($data['homeworklist'])) {
                    
                $data['homeworklistdata'] = 'active';
                $data['homework'] = 'active';
                $data['programOfferId'] = $this->ProgramModleAdmin->getProgramOfferId($data);
               // $data['studentlist'] = $this->CourseAssignModleAdmin->AssignedCourseStudents($data);
                $this->load->view('system_path/admin/common/header_link'); // header Css link
                $this->load->view('system_path/admin/common/header'); // body header
                $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
                $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                $this->load->view('system_path/admin/homework/homeworklist'); // ...........body content page...........
                $this->load->view('system_path/admin/common/footer'); // footer & script link
                } else {
                    $sdata['message'] = 'No Result Found';
                    $this->session->set_userdata($sdata);
                     redirect(admin_Url()."/homework/homeworklist");
                }
            } else {
                $sdata['message'] = 'Enrollment information not offer yet';
                $this->session->set_userdata($sdata);
                 redirect(admin_Url()."/homework/homeworklist");
            }
        }
    
    }

   public function viewhomework($id) {
        if(!empty($id))
        {
            $data['editData'] = $this->HomeworkModleAdmin->edithomeworkInfo($id);
            if(!empty($data['editData']))
            {
                $data['homework'] = 'active';
                $data['homeworklistdata'] = 'active';
                $this->load->view('system_path/admin/common/header_link'); // header Css link
                $this->load->view('system_path/admin/common/header'); // body header
                $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
                $this->load->view('system_path/admin/homework/viewdetails'); // ...........body content page...........
                $this->load->view('system_path/admin/common/footer'); // footer & script link
                $this->load->view('system_path/jsquery'); // footer & script link
            }
            else{
                $sdata['message'] = 'No Result Found';
                    $this->session->set_userdata($sdata);
                     redirect(teacher_Url() . "/homework/homeworklist");
            }     
        }
        else{
            $sdata['message'] = 'No Result Found';
                $this->session->set_userdata($sdata);
                 redirect(teacher_Url() . "/homework/homeworklist");
        }
    }
    
        public function edithomework($id)
    {
        $data['editData'] = $this->HomeworkModleAdmin->edithomeworkInfo($id);
        $data['homework'] = 'active';
        $data['homeworklistdata'] = 'active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/admin/homework/edithomework'); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
    }
     function updatehomework($id) {
        //  $id = $this->input->post('id'); 
        $data = array('homework' => $this->input->post('updatehomework'),);
        $this->HomeworkModleAdmin->update($data, $id);
        $sdata['message'] = 'Successfull!';
        $this->session->set_userdata($sdata);
        redirect(admin_Url() . "/homework/homeworklist");
    }



    public function deletehomework($id) {
        $this->HomeworkModleAdmin->deleteinformation($id);
        $sdata['message'] = 'Deleted';
        $this->session->set_userdata($sdata);
        redirect(admin_Url() . "/homework/homeworklist");
    }

    public function courseassignlist() {


        $data['courseassignlist'] = $this->CourseofferModleAdmin->searchcourseassignlist();
        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/courseoffer/courseassign', $data);
        $this->load->view('templates/admin/common/footer');
    }

    //put your code here
}

