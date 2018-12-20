<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */

class Studentcomment extends MY_Controller {

    public function __construct() {
        parent::__construct();
      //  $this->teacher_logged_auth();
        $this->load->model('admin/studentcomment/StudentcommentModleAdmin', 'StudentcommentModleAdmin');
        $this->load->model('admin/student/StudentModleAdmin', 'StudentModleAdmin');
        $this->load->model('admin/program/ProgramModleAdmin', 'ProgramModleAdmin');
    }

    public function index() {
        $data['studentcmt']='active';
        $data['addstudentcmt']='active';
        //$data['periodlist'] = $this->StudentcommentModleAdmin->getlistPeriod();
        $this->load->view('system_path/teacher/common/header_link'); // header Css link
        $this->load->view('system_path/teacher/common/header'); // body header
        $this->load->view('system_path/teacher/common/side_menu',$data); // side bar menu
        $this->load->view('system_path/teacher/studentcomment/index', $data); // ...........body content page...........
        $this->load->view('system_path/teacher/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
    }
    
    
        public function searchRegisteredStudent() {
      /**  ini_set('memory_limit', '-1');

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
            array(
                'field' => 'data[programId]',
                'label' => 'Program',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[mediumId]',
                'label' => 'Medium',
                'rules' => 'required'
            ),            
            array(
                'field' => 'data[sectionId]',
                'label' => 'Section',
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
                'field' => 'data[sessionId]',
                'label' => 'Session',
                'rules' => 'required'
            )
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            $data['student'] = 'active';
            $this->load->view('system_path/teacher/common/header_link'); // header Css link
            $this->load->view('system_path/teacher/common/header'); // body header
            $this->load->view('system_path/teacher/common/side_menu'); // side bar menu
            
            $this->load->view('system_path/admin/student/studentsearch'); // ...........body content page...........
            $this->load->view('system_path/teacher/common/footer'); // footer & script link
            $this->load->view('system_path/jsquery'); // footer & script link
        } else {**/
            $data = $this->input->post('data', TRUE); 


            if (!empty($data)) {
              
                $data['studentlist'] = $this->StudentModleAdmin->searchlist($data);
             // print_r($data['studentlist']); die();
                 
                if (!empty($data['studentlist'])) {
                    if (isset($_POST['search'])) {
                           $data['studentcmt']='active';
        $data['addstudentcmt']='active'; 
                        $this->load->view('system_path/teacher/common/header_link'); // header Css link
                        $this->load->view('system_path/teacher/common/header'); // body header
                        $this->load->view('system_path/teacher/common/side_menu'); // side bar menu
                        
                        $this->load->view('system_path/teacher/studentcomment/student_list',$data); // ...........body content page...........
                        $this->load->view('system_path/teacher/common/footer'); // footer & script link
                        $this->load->view('system_path/jsquery'); // footer & script link
                    } elseif (isset($_POST['print'])) {
                        $this->load->view('system_path/teacher/common/header_link'); // header Css link
                        $this->load->view('system_path/admin/student/printstudentlist', $data); // ...........body content page...........
                        $this->load->view('system_path/teacher/common/footer'); // footer & script link  
                        
                    } else {
                        $sdata['errormessage'] = 'Student Not Found';
                        $this->session->set_userdata($sdata);
                          $data['studentcmt']='active';
        $data['addstudentcmt']='active';
        $this->load->view('system_path/teacher/common/header_link'); // header Css link
        $this->load->view('system_path/teacher/common/header'); // body header
        $this->load->view('system_path/teacher/common/side_menu'); // side bar menu
        
        $this->load->view('system_path/admin/student/studentsearch'); // ...........body content page...........
        $this->load->view('system_path/teacher/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
                     
                    }
                } else {
                    $sdata['errormessage'] = 'No student found inserted enrollment information';
                    $this->session->set_userdata($sdata);
                     $data['student'] = 'active';
        $this->load->view('system_path/teacher/common/header_link'); // header Css link
        $this->load->view('system_path/teacher/common/header'); // body header
        $this->load->view('system_path/teacher/common/side_menu'); // side bar menu
        
        $this->load->view('system_path/admin/student/studentsearch'); // ...........body content page...........
        $this->load->view('system_path/teacher/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
                }
            } 
    }
    
    
      public function searchindividualStudent() {     
            $data = $this->input->post('data', TRUE); 
            if (!empty($data)) {
              
                $data['studentlist'] = $this->StudentModleAdmin->searchRegisteredStudentbyindv($data);
              // print_r($data['studentlist']); die();                
                if (!empty($data['studentlist'])) {
                    if (isset($_POST['search'])) {
                          $data['studentcmt']='active';
        $data['addstudentcmt']='active';
                        $this->load->view('system_path/teacher/common/header_link'); // header Css link
                        $this->load->view('system_path/teacher/common/header'); // body header
                        $this->load->view('system_path/teacher/common/side_menu'); // side bar menu
                        
                        $this->load->view('system_path/teacher/studentcomment/studentlist_byindividual',$data); // ...........body content page...........
                        $this->load->view('system_path/teacher/common/footer'); // footer & script link
                        $this->load->view('system_path/jsquery'); // footer & script link
                    } elseif (isset($_POST['print'])) {
                        $this->load->view('system_path/teacher/common/header_link'); // header Css link
                        $this->load->view('system_path/admin/student/printstudentlist', $data); // ...........body content page...........
                        $this->load->view('system_path/teacher/common/footer'); // footer & script link  
                        
                    } else {
                        $sdata['errormessage'] = 'Student Not Found';
                        $this->session->set_userdata($sdata);
                        redirect(admin_Url() . "/studentcomment");
                     
                    }
                } else {
                    $sdata['errormessage'] = 'No student found inserted information';
                    $this->session->set_userdata($sdata);
                    redirect(admin_Url() . "/studentcomment");
                }
            } else {
                $sdata['errormessage'] = 'Student Not Found! Please Search Again with Right Information';
                $this->session->set_userdata($sdata);
                redirect(admin_Url() . "/studentcomment");
            }
        }
    
    
    
        
     public function commentbox($id){ 
         
            $data['studentId'] =(int)$id;
        $data['editData'] = $this->StudentModleAdmin->getstudentNameInfo($id);  
    //    print_r($data); die();
                        $data['studentcmt']='active';
                        $data['addstudentcmt']='active';
                        $this->load->view('system_path/teacher/common/header_link'); // header Css link
                        $this->load->view('system_path/teacher/common/header'); // body header
                        $this->load->view('system_path/teacher/common/side_menu'); // side bar menu                       
                        $this->load->view('system_path/teacher/studentcomment/commentbox',$data); // ...........body content page...........
                        $this->load->view('system_path/teacher/common/footer'); // footer & script link
                        $this->load->view('system_path/jsquery'); // footer & script link
                    }  
        
    
    public function insertcomment() {
        // print_r($_POST);
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');


        $config = array(
            array(
                'field' => 'data[comment]',
                'label' => 'Comment',
                'rules' => 'required'
            )
            
        );
        $this->form_validation->set_rules($config);


        if ($this->form_validation->run() == FALSE) {
//                    redirect(base_url('teacher/campus'));
                        $data['studentcmt']='active';
                        $data['addstudentcmt']='active';
                        $this->load->view('system_path/teacher/common/header_link'); // header Css link
                        $this->load->view('system_path/teacher/common/header'); // body header
                        $this->load->view('system_path/teacher/common/side_menu'); // side bar menu                       
                        $this->load->view('system_path/teacher/studentcomment/commentbox',$data); // ...........body content page...........
                        $this->load->view('system_path/teacher/common/footer'); // footer & script link
                        $this->load->view('system_path/jsquery'); // footer & script link
        } else {
            $data = $this->input->post('data', TRUE);
            $data['date']= date('d-m-Y');
           // print_r($data); die();
            $result = $this->StudentcommentModleAdmin->duplicatecommentInfo($data);

            if (!$result) {
                $this->StudentcommentModleAdmin->addcommentInfo($data);

                $sdata['message'] = 'Successfull!';
                $this->session->set_userdata($sdata);

             redirect(teacher_Url() . "/studentcomment");
            } else {
                $sdata['errormessage'] = 'Duplicate Entry Found!';
                $this->session->set_userdata($sdata);

               redirect(teacher_Url() . "/studentcomment");
            }
        }
    }

   
    

         public function studentComment(){
      //  $username=$this->session->userdata('studentId');
          $data['stucmt']='active'; 
          $data['commentData'] = $this->StudentModleAdmin->allcommentforteacher();
       //   print_r($data); die();
        $this->load->view('system_path/student/common/header_link'); // header Css link
        $this->load->view('system_path/student/common/header'); // body header
        $this->load->view('system_path/student/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/student/student/commentlist', $data); // ...........body content page...........
        $this->load->view('system_path/student/common/footer'); // footer & script link                
    }
    
    public function studentallComment(){
      //  $username=$this->session->userdata('studentId');
          $data['studentcmt']='active'; 
            $data['stucmtt']='active'; 
          $data['commentData'] = $this->StudentModleAdmin->allcommentforteacher();
       //   print_r($data); die();
        $this->load->view('system_path/teacher/common/header_link'); // header Css link
        $this->load->view('system_path/teacher/common/header'); // body header
        $this->load->view('system_path/teacher/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/teacher/student/commentlist', $data); // ...........body content page...........
        $this->load->view('system_path/teacher/common/footer'); // footer & script link                
    }  
    
    
    
    
    
    public function editdperiod($id) {
       
        $data['periodlist'] = $this->StudentcommentModleAdmin->getlistPeriod();
        $data['editData'] = $this->StudentcommentModleAdmin->editPeriodInfo($id);
        if (!empty($data['editData'])){
        $this->load->view('system_path/teacher/common/header_link'); // header Css link
        $this->load->view('system_path/teacher/common/header'); // body header
        $this->load->view('system_path/teacher/common/side_menu',$data); // side bar menu
        $this->load->view('system_path/teacher/common/top_menu'); // top bar menu
        $this->load->view('system_path/admin/period/editperiod', $data);
        $this->load->view('system_path/teacher/common/footer'); // footer & script link
    }
    }

    public function updateperiod($id) {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

//        print_r($_POST);
        $config = array(
             array(
                'field' => 'data[shiftId]',
                'label' => 'Shift',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[periodName]',
                'label' => 'Period Name',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[periodTime]',
                'label' => 'Period Time',
                'rules' => 'required'
            )
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
//                    redirect(base_url('admin/group'));
            $data['editData'] = $this->StudentcommentModleAdmin->editPeriodInfo($id);
            $data['periodlist'] = $this->StudentcommentModleAdmin->getlistPeriod();
              $this->load->view('system_path/teacher/common/header_link'); // header Css link
        $this->load->view('system_path/teacher/common/header'); // body header
        $this->load->view('system_path/teacher/common/side_menu',$data); // side bar menu
        $this->load->view('system_path/teacher/common/top_menu'); // top bar menu
        $this->load->view('system_path/admin/period/editperiod', $data);
        $this->load->view('system_path/teacher/common/footer'); // footer & script link
        } else {
            $data = $this->input->post('data', TRUE);
            $result = $this->StudentcommentModleAdmin->duplicatePeriodInfo($data);

            if (!$result) {
                $this->StudentcommentModleAdmin->updatePeriodInfo($data, $id);
                $sdata['message'] = 'Successfull!';
                $this->session->set_userdata($sdata);
                redirect(admin_Url() . "/period/index", "refresh");
            } else {
                $sdata['message'] = 'Duplicate Entry Found!';
                $this->session->set_userdata($sdata);

               redirect(admin_Url() . "/period/index", "refresh");
            }
        }
    }

    public function deleteperiod($id) {

        
        $this->StudentcommentModleAdmin->deletePeriodInfo($id);
        redirect(admin_Url() . "/period/index", "refresh");
    }

    //put your code here
}

