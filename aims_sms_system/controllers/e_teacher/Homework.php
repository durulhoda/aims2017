<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
 
class Homework extends MY_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->teacher_logged_auth();
        $this->load->helper('text');
        $this->load->model('admin/homework/HomeworkModleAdmin', 'HomeworkModleAdmin');
        $this->load->model('admin/program/ProgramModleAdmin', 'ProgramModleAdmin');
           $this->load->model('admin/courseassign/CourseAssignModleAdmin', 'CourseAssignModleAdmin');
    }

    public function index() {
        $data['homework'] = 'active';
        $data['homeworkadd'] = 'active';
        $this->load->view('system_path/teacher/common/header_link'); // header Css link
        $this->load->view('system_path/teacher/common/header'); // body header
        $this->load->view('system_path/teacher/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/teacher/homework/index'); // ...........body content page...........
        $this->load->view('system_path/teacher/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
    }

    public function inserthomework() {
        // print_r($_POST);
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
                'field' => 'data[employeeId]',
                'label' => 'Teacher ',
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
                'field' => 'data[homework]',
                'label' => 'Marks',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            
                redirect(teacher_Url() . "/homework/index");
                
        } else {
            $data = $this->input->post('data', TRUE);

            // Database field Value...
            $datas['programOfferId'] = getProgramOfferId($data);
            $datas['courseId'] = $data['courseId'];
            $datas['homework'] = $data['homework'];
            $datas['employeeId'] = $data['employeeId'];

            if ($datas['programOfferId'] != 0) {
                $offerlist = getValidateOfferedCourses($datas);
                if (!empty($offerlist)) {


                    $this->HomeworkModleAdmin->addhomeworkInfo($datas);
                    //			$this->load->view('formsuccess');
                    $sdata['message'] = 'Successfull!';
                    $this->session->set_userdata($sdata);

                           redirect(teacher_Url() . "/homework/index");
                } else {
                    $sdata['errormessage'] = 'There are no Subject offered for this Teacher yet..!!';
                    $this->session->set_userdata($sdata);
                             redirect(teacher_Url() . "/homework/index");
                }
            } else {
                $sdata['errormessage'] = 'Inserted Enrollment information is not offered yet!';
                $this->session->set_userdata($sdata);
                             redirect(teacher_Url() . "/homework/index");
            }
        }
    }

    public function homeworklist() {

        $data['homework'] = 'active';
        $data['homeworklistdata'] = 'active';
        $this->load->view('system_path/teacher/common/header_link'); // header Css link
        $this->load->view('system_path/teacher/common/header'); // body header
        $this->load->view('system_path/teacher/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/teacher/homework/homeworklist'); // ...........body content page...........
        $this->load->view('system_path/teacher/common/footer'); // footer & script link
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
            array(
                'field' => 'data[employeeId]',
                'label' => 'Teacher ',
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
            )
        );
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            redirect(teacher_Url() . "/homework/homeworklist");
        } else {

             $data = $this->input->post('data', TRUE);
             
            $data['programOfferId'] = getProgramOfferId($data);
            if (!empty($data['programOfferId'])) {
                 $data['homeworklist'] = $this->HomeworkModleAdmin->searchhomeworklist($data);
                
                if (!empty($data['homeworklist'])) { 
                    $data['homework'] = 'active';
                    $data['homeworklistdata'] = 'active';
                    $this->load->view('system_path/teacher/common/header_link'); // header Css link
                    $this->load->view('system_path/teacher/common/header'); // body header
                    $this->load->view('system_path/teacher/common/side_menu', $data); // side bar menu
                    $this->load->view('system_path/teacher/homework/homeworkview'); // ...........body content page...........
                    $this->load->view('system_path/teacher/common/footer'); // footer & script link
                } else {
                    $sdata['errormessage'] = 'No Result Found';
                    $this->session->set_userdata($sdata);
                       redirect(teacher_Url() . "/homework/homeworklist");
                }
            } else {
                $sdata['errormessage'] = 'Enrollment information not offer yet';
                $this->session->set_userdata($sdata);
                 redirect(teacher_Url() . "/homework/homeworklist");
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
                $this->load->view('system_path/teacher/common/header_link'); // header Css link
                $this->load->view('system_path/teacher/common/header'); // body header
                $this->load->view('system_path/teacher/common/side_menu', $data); // side bar menu
                $this->load->view('system_path/teacher/homework/viewdetails'); // ...........body content page...........
                $this->load->view('system_path/teacher/common/footer'); // footer & script link
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
        $this->load->view('system_path/teacher/common/header_link'); // header Css link
        $this->load->view('system_path/teacher/common/header'); // body header
        $this->load->view('system_path/teacher/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/teacher/homework/edithomework'); // ...........body content page...........
        $this->load->view('system_path/teacher/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
    }

   
   function updatehomework($id) {
          //  $id = $this->input->post('id'); 
            $data = array('homework' => $this->input->post('updatehomework'), );
            $this->HomeworkModleAdmin->update($data, $id);
            $sdata['message'] = 'Successfull!';
            $this->session->set_userdata($sdata);
                redirect(teacher_Url() . "/homework/homeworklist");
        }



//        
//            $data = $this->input->post('homework', TRUE);
//            $result = $this->HomeworkModleAdmin->duplicatehomeworkname($data);
//
//            if (!$result) {
//            $this->HomeworkModleAdmin->updatehomework($data, $id);
//            $sdata['message'] = 'Successfull!';
//                $this->session->set_userdata($sdata);
//
//              redirect(teacher_Url() . "/homework/homeworklist");
//            } else {
//                $sdata['errormessage'] = 'Duplicate Entry Found!';
//                $this->session->set_userdata($sdata);
//
//               redirect(teacher_Url() . "/homework/homeworklist");
//            }
        
    
    
    public function deletehomework($id)
    {
        $this->HomeworkModleAdmin->deleteinformation($id);
        $sdata['massege']='Deleted';
        $this->session->set_userdata($sdata);
        redirect(teacher_Url() . "/homework/homeworklist");
        
    }

    //put your code here
}




  