<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */

class Examroutine extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->teacher_logged_auth();
        $this->load->model('admin/examroutine/ExamroutineModleAdmin', 'ExamroutineModleAdmin');
    }

    public function index() {
        $this->load->helper(array('form', 'url'));
        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/examroutine/index');
        $this->load->view('templates/admin/common/footer');
    }

    public function insertexamroutine() {

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
            array(
                'field' => 'datax[campusId]',
                'label' => 'campus',
                'rules' => 'required'
            ),
            array(
                'field' => 'datax[programId]',
                'label' => 'class',
                'rules' => 'required'
            ),
            array(
                'field' => 'datax[mediumId]',
                'label' => 'medium',
                'rules' => 'required'
            ),
            array(
                'field' => 'datax[groupId]',
                'label' => 'group',
                'rules' => 'required'
            ),
            array(
                'field' => 'datax[sessionId]',
                'label' => 'session',
                'rules' => 'required'
            ),
            array(
                'field' => 'datax[shiftId]',
                'label' => 'shift',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[courseId]',
                'label' => 'subject',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[date]',
                'label' => 'Date',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[examname]',
                'label' => 'Exam Name',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[examtime]',
                'label' => 'Exam Time',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[room]',
                'label' => 'Room',
                'rules' => 'required'
            )
        );


        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
//                    redirect(base_url('admin/campus'));
            $this->load->view('templates/admin/common/header');
            $this->load->view('templates/admin/examroutine/index');
            $this->load->view('templates/admin/common/footer');
        } else {

            $data = $this->input->post('data', TRUE);
            $datax = $this->input->post('datax', TRUE);
            $enroll=  getValidateofferedprogram($datax);
            
            if(!empty($enroll))
            {
                $data['programOfferId']=$enroll['programOfferId'];
                
                $validation1 = $this->ExamroutineModleAdmin->routinevalidation1($data);
                $validation2 = $this->ExamroutineModleAdmin->routinevalidation2($data);
                $validation3 = $this->ExamroutineModleAdmin->routinevalidation3($data);

                if ($validation1) {
                    $sdata = array();
                    $sdata['message'] = "Duplicate found for All field value..";
                    $this->session->set_userdata($sdata);

                     $this->load->view('templates/admin/common/header');
                    $this->load->view('templates/admin/examroutine/index');
                    $this->load->view('templates/admin/common/footer');
                } 
                elseif ($validation2)
                    {
                        $sdata = array();
                        $sdata['message'] = "Duplicate found for the Value of Campus, Class, Medium, Group, Shift, Session, Subject, Exam Name..";
                        $this->session->set_userdata($sdata);

                         $this->load->view('templates/admin/common/header');
                        $this->load->view('templates/admin/examroutine/index');
                        $this->load->view('templates/admin/common/footer');
                    }
                elseif ($validation3)
                    {
                        $sdata = array();
                        $sdata['message'] = "Duplicate found for the Value of Campus, Class, Medium, Group, Shift, Session, Date, Exam Name, Exam Time..";
                        $this->session->set_userdata($sdata);

                         $this->load->view('templates/admin/common/header');
                        $this->load->view('templates/admin/examroutine/index');
                        $this->load->view('templates/admin/common/footer');
                    }

                else {

                    $this->ExamroutineModleAdmin->addExamroutineInfo($data);

                    $sdata = array();
                    $sdata['message'] = "Insert New routine Successfully!";
                    $this->session->set_userdata($sdata);

                    $this->load->view('templates/admin/common/header');
                    $this->load->view('templates/admin/examroutine/index');
                    $this->load->view('templates/admin/common/footer');
                }
            }
            else{
                $sdata['message'] = "Enrollment Information is not offered yet";
                $this->session->set_userdata($sdata);
                reedirect(base_url('admin/examroutine'));
            }
        }
    }

    public function viewexamroutine() {

        $data['examroutinelist'] = $this->ExamroutineModleAdmin->getExamroutineList();
       // print_r($data); die();
        $data['timetable'] = 'active';
        $data['exroutine'] = 'active';
        $this->load->view('system_path/teacher/common/header_link'); // header Css link
        $this->load->view('system_path/teacher/common/header'); // body header
        $this->load->view('system_path/teacher/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/teacher/examroutine/view_examroutine', $data); // ...........body content page...........
        $this->load->view('system_path/teacher/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
    }
    
     public function showexamroutine($id) {

       // $id = (int) $id;
        $data['programOfferId'] = $id;
        //print_r($data); die();
        $data['examroutine']= $this->ExamroutineModleAdmin->exam_routine($data);
            if(!empty($data['examroutine']))
            {
                $data['programinfo']=  getofferProgramInfoById($data['programOfferId']);
            
                    $data['timetable'] = 'active';
                    $data['exroutine'] = 'active';
                    $this->load->view('system_path/teacher/common/header_link'); // header Css link
                    $this->load->view('system_path/teacher/common/header'); // body header
                    $this->load->view('system_path/teacher/common/side_menu', $data); // side bar menu
                    $this->load->view('system_path/teacher/examroutine/viewroutine', $data); // ...........body content page...........
                    $this->load->view('system_path/teacher/common/footer'); // footer & script link
                    $this->load->view('system_path/jsquery'); // footer & script link
            }    
            else{
                $sdata['message'] = "Routine not found";
                $this->session->set_userdata($sdata);
                      redirect(admin_Url() . "/examroutine");
            }
       
    }
    
    
    
    
    public function editexamroutine($id) {
        $data['programOfferId']=$id;
       $data['examroutine']= $this->ExamroutineModleAdmin->select_new_routine($data);
            if(!empty($data['examroutine']))
            {
             $data['programinfo']=  getofferProgramInfoById($data['programOfferId']);
            $data['classroutine'] = 'active';
            $this->load->view('system_path/teacher/common/header_link'); // header Css link
            $this->load->view('system_path/teacher/common/header'); // body header
            $this->load->view('system_path/teacher/common/side_menu'); // side bar menu
          
            $this->load->view('system_path/teacher/examroutine/editexamroutine', $data); // ...........body content page...........
            $this->load->view('system_path/teacher/common/footer'); // footer & script link
          //  $this->load->view('system_path/jsquery'); // footer & script link
        }
        else{
                $sdata['message'] = "Routine not found";
                $this->session->set_userdata($sdata);
                 redirect(admin_Url() . "/examroutine/viewexamroutine");
            }
    }


    public function updateexamroutine($id) {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
            array(
                'field' => 'data[campusId]',
                'label' => 'campus',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[programId]',
                'label' => 'class',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[mediumId]',
                'label' => 'medium',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[groupId]',
                'label' => 'group',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[sessionId]',
                'label' => 'session',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[shiftId]',
                'label' => 'shift',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[courseId]',
                'label' => 'subject',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[date]',
                'label' => 'Date',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[examname]',
                'label' => 'Exam Name',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[examtime]',
                'label' => 'Exam Time',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[room]',
                'label' => 'Room',
                'rules' => 'required'
            )
        );


        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
//                    redirect(base_url('admin/campus'));
            $this->load->view('templates/admin/common/header');
            $this->load->view('templates/admin/examroutine/index');
            $this->load->view('templates/admin/common/footer');
        } else {

            $data = $this->input->post('data', TRUE);
            $datax = $this->input->post('datax', TRUE);
            $enroll=  getValidateofferedprogram($datax);
            
            if(!empty($enroll))
            {
                $data['programOfferId']=$enroll['programOfferId'];
                
                $validation1 = $this->ExamroutineModleAdmin->routinevalidation1($data);
                $validation2 = $this->ExamroutineModleAdmin->routinevalidation2($data);
                $validation3 = $this->ExamroutineModleAdmin->routinevalidation3($data);

                if ($validation1) {
                    $sdata = array();
                    $sdata['message'] = "Duplicate found for All field value..";
                    $this->session->set_userdata($sdata);

                    $this->load->view('templates/admin/common/header');

                    $data['editexamroutine'] = $this->ExamroutineModleAdmin->editExamroutineInfo($id);
            //        print_r($data);
                    $this->load->view('templates/admin/examroutine/editexamroutine', $data);
                    $this->load->view('templates/admin/common/footer');
                } 
                elseif ($validation2)
                    {
                        $sdata = array();
                        $sdata['message'] = "Duplicate found for the Value of Campus, Class, Medium, Group, Shift, Session, Subject, Exam Name..";
                        $this->session->set_userdata($sdata);

                        $this->load->view('templates/admin/common/header');

                        $data['editexamroutine'] = $this->ExamroutineModleAdmin->editExamroutineInfo($id);
                //        print_r($data);
                        $this->load->view('templates/admin/examroutine/editexamroutine', $data);
                        $this->load->view('templates/admin/common/footer');
                    }
                    elseif ($validation3)
                       {
                           $sdata = array();
                           $sdata['message'] = "Duplicate found for the Value of Campus, Class, Medium, Group, Shift, Session, Date, Exam Name, Exam Time..";
                           $this->session->set_userdata($sdata);

                           $this->load->view('templates/admin/common/header');

                           $data['editexamroutine'] = $this->ExamroutineModleAdmin->editExamroutineInfo($id);
                   //        print_r($data);
                           $this->load->view('templates/admin/examroutine/editexamroutine', $data);
                           $this->load->view('templates/admin/common/footer');
                       }
                
                        else {

                            $this->ExamroutineModleAdmin->updateExamroutineInfo($data, $id);

                            $sdata = array();
                            $sdata['message'] = "Update New routine Successfully!";
                            $this->session->set_userdata($sdata);

                            $this->load->view('templates/admin/common/header');
                            $this->load->view('templates/admin/examroutine/index');
                            $this->load->view('templates/admin/common/footer');
                        }
            }
            else{
                $sdata['message'] = "Enrollment Information is not offered yet";
                $this->session->set_userdata($sdata);
                reedirect(base_url('admin/examroutine'));
            }
        }
           
    }

    public function deleteExamroutine($id) {

        $id = (int) $id;

        $this->ExamroutineModleAdmin->deleteExamroutineInfo($id);
        redirect('admin/examroutine/viewexamroutine', 'refresh');
    }

}