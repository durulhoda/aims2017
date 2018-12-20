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
        $this->my_admin();
        $this->load->model('admin/examroutine/ExamroutineModleAdmin', 'ExamroutineModleAdmin');
        $this->load->model('admin/program/ProgramModleAdmin', 'ProgramModleAdmin');
        $this->load->model('admin/courseoffer/CourseofferModleAdmin', 'CourseofferModleAdmin');
        $this->load->model('admin/course/CourseModleAdmin', 'CourseModleAdmin');
    }

    public function index() {
        $this->load->helper(array('form', 'url'));

        $data['classroutine'] = 'active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/examroutine/index'); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
    }

    public function insertexamroutine() {

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
          
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
                'field' => 'datax[shiftId]',
                'label' => 'shift',
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
                'field' => 'data[semester_id]',
                'label' => 'Semester Name',
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
       $data['classroutine'] = 'active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/examroutine/index'); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
        } else {

           $data = $this->input->post('data', TRUE);
          
           $datax = $this->input->post('datax', TRUE);
           $enroll=  $this->ProgramModleAdmin->getValidateofferedprogram($datax);
           
            if(!empty($enroll))
            {
                $data['programOfferId']=$enroll['programOfferId'];
                
                $validation1 = $this->ExamroutineModleAdmin->routinevalidation1($data);
                $validation2 = $this->ExamroutineModleAdmin->routinevalidation2($data);
                $validation3 = $this->ExamroutineModleAdmin->routinevalidation3($data);

                if ($validation1) {
                    $sdata = array();
                    $sdata['errormessage'] = "Duplicate found for All field value..";
                    $this->session->set_userdata($sdata);

                     $data['classroutine'] = 'active';
                $this->load->view('system_path/admin/common/header_link'); // header Css link
                $this->load->view('system_path/admin/common/header'); // body header
                $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                $this->load->view('system_path/admin/examroutine/index'); // ...........body content page...........
                $this->load->view('system_path/admin/common/footer'); // footer & script link
                $this->load->view('system_path/jsquery'); // footer & script link
                } 
                elseif ($validation2)
                    {
                        $sdata = array();
                        $sdata['errormessage'] = "Duplicate found for the Value of Campus, Class, Medium, Group, Shift, Session, Subject, Exam Name..";
                        $this->session->set_userdata($sdata);

                       $data['classroutine'] = 'active';
                    $this->load->view('system_path/admin/common/header_link'); // header Css link
                    $this->load->view('system_path/admin/common/header'); // body header
                    $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                    $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                    $this->load->view('system_path/admin/examroutine/index'); // ...........body content page...........
                    $this->load->view('system_path/admin/common/footer'); // footer & script link
                    $this->load->view('system_path/jsquery'); // footer & script link
                    }
                elseif ($validation3)
                    {
                        $sdata = array();
                        $sdata['errormessage'] = "Duplicate found for the Value of Campus, Class, Medium, Group, Shift, Session, Date, Exam Name, Exam Time..";
                        $this->session->set_userdata($sdata);

                     $data['classroutine'] = 'active';
                    $this->load->view('system_path/admin/common/header_link'); // header Css link
                    $this->load->view('system_path/admin/common/header'); // body header
                    $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                    $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                    $this->load->view('system_path/admin/examroutine/index'); // ...........body content page...........
                    $this->load->view('system_path/admin/common/footer'); // footer & script link
                    $this->load->view('system_path/jsquery'); // footer & script link
                    }

                else {

                    $this->ExamroutineModleAdmin->addExamroutineInfo($data);

                    $sdata = array();
                    $sdata['message'] = "Insert New routine Successfully!";
                    $this->session->set_userdata($sdata);

                    redirect(admin_Url() . "/examroutine");
                }
            }
            else{
                $sdata['errormessage'] = "Enrollment Information is not offered yet";
                $this->session->set_userdata($sdata);
               redirect(admin_Url() . "/examroutine");
                
            }
        }
    }

    public function viewexamroutine() {

        $data['examroutinelist'] = $this->ExamroutineModleAdmin->getExamroutineList();

        $data['classroutine'] = 'active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/examroutine/view_examroutine'); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
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
            
                   $data['classroutine'] = 'active';
                    $this->load->view('system_path/admin/common/header_link'); // header Css link
                    $this->load->view('system_path/admin/common/header'); // body header
                    $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                    $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                    $this->load->view('system_path/admin/examroutine/viewroutine', $data); // ...........body content page...........
                    $this->load->view('system_path/admin/common/footer'); // footer & script link
                    $this->load->view('system_path/jsquery'); // footer & script link
            }    
            else{
                $sdata['message'] = "Routine not found";
                $this->session->set_userdata($sdata);
                      redirect(admin_Url() . "/examroutine");
            }
       
    }
    
       public function printexamroutine($programofferid) {
        $datax['programOfferId'] = (int)$programofferid;
        $datax = $this->ProgramModleAdmin->getofferProgramInfoById($datax['programOfferId']);
        if (!empty($datax)) {
            $data = array(
                'sessionId' => $datax['sessionId'],
                'programLevel' => $datax['programLevel'],
                'programId' => $datax['programId'],
                'mediumId' => $datax['mediumId'],
                'shiftId' => $datax['shiftId'],
                'groupId' => $datax['groupId'],
                'programOfferId'=>$datax['programOfferId']
            );
             $data['examroutine']= $this->ExamroutineModleAdmin->getExamroutineList($data);
            if(!empty($data['examroutine']))
            {
                $data['programinfo']=  getofferProgramInfoById($data['programOfferId']);
                $this->load->view('system_path/admin/common/header_link'); // header Css link
                $this->load->view('system_path/admin/examroutine/printexamroutine', $data); // ...........body content page...........
                $this->load->view('system_path/admin/common/footer'); // footer & script link  
            }
            else
            {
                $sdata['errormessage'] = 'No Routine Found';
                $this->session->set_userdata($sdata);
                redirect(admin_Url() . "/viewexamroutine");
            }      
        } else {
            $sdata['errormessage'] = 'No Routine Found';
            $this->session->set_userdata($sdata);
            redirect(admin_Url() . "/examroutine/viewexamroutine");
        }
    }
    
 
    public function editexamroutine($id) {
        $data['programOfferId']=$id;
       $data['examroutine']= $this->ExamroutineModleAdmin->select_new_routine($data);
            if(!empty($data['examroutine']))
            {
             $data['programinfo']=  getofferProgramInfoById($data['programOfferId']);
            $data['classroutine'] = 'active';
            $this->load->view('system_path/admin/common/header_link'); // header Css link
            $this->load->view('system_path/admin/common/header'); // body header
            $this->load->view('system_path/admin/common/side_menu'); // side bar menu
            $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
            $this->load->view('system_path/admin/examroutine/editexamroutine', $data); // ...........body content page...........
            $this->load->view('system_path/admin/common/footer'); // footer & script link
          //  $this->load->view('system_path/jsquery'); // footer & script link
        }
        else{
                $sdata['message'] = "Routine not found";
                $this->session->set_userdata($sdata);
                 redirect(admin_Url() . "/examroutine/viewexamroutine");
            }
    }

       public function editexamroutinedata($id) {
        
         $data['editexamroutine'] = $this->ExamroutineModleAdmin->editExamroutineInfo($id);
        $data['programinfo']=  getofferProgramInfoById($data['editexamroutine']['programOfferId']);
        if(!empty($data['programinfo']))
        {
             $data['classroutine'] = 'active';
            $this->load->view('system_path/admin/common/header_link'); // header Css link
            $this->load->view('system_path/admin/common/header'); // body header
            $this->load->view('system_path/admin/common/side_menu'); // side bar menu
            $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
            $this->load->view('system_path/admin/examroutine/editexamroutinedata', $data); // ...........body content page...........
            $this->load->view('system_path/admin/common/footer'); // footer & script link
          //  $this->load->view('system_path/jsquery'); // footer & script link
        }
        else{
                $sdata['message'] = "Routine not found";
                $this->session->set_userdata($sdata);
                redirect(admin_Url() . "/examroutine/viewexamroutine");
            }
    }
   public function updateexamroutine($id,$prg_id) {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
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
                'field' => 'data[semester_id]',
                'label' => 'Date',
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
         $this->editexamroutinedata($id);
        } else {

            $data = $this->input->post('data', TRUE);
        
            $validation1 = $this->ExamroutineModleAdmin->routinevalidation($data, $prg_id);
                

                if ($validation1) {
                    $sdata = array();
                    $sdata['errormessage'] = "Duplicate found for All field value..";
                    $this->session->set_userdata($sdata);
                    $data['editexamroutine'] = $this->ExamroutineModleAdmin->editExamroutineInfo($id);
           $data['programinfo']=  getofferProgramInfoById($data['editexamroutine']['programOfferId']);
                        $data['classroutine'] = 'active';
                        $this->load->view('system_path/admin/common/header_link'); // header Css link
                        $this->load->view('system_path/admin/common/header'); // body header
                        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                        $this->load->view('system_path/admin/examroutine/editexamroutinedata', $data); // ...........body content page...........
                        $this->load->view('system_path/admin/common/footer'); // footer & script link
                } 
                        else {

                            $this->ExamroutineModleAdmin->updateExamroutineInfo($data, $id);

                            $sdata = array();
                            $sdata['message'] = "Update New routine Successfully!";
                            $this->session->set_userdata($sdata);

                           redirect(admin_Url() ."/examroutine");
                        }
            
        }
           
    }

    public function deleteExamroutine($id) {

        $id = (int) $id;

        $result=$this->ExamroutineModleAdmin->deleteExamroutineInfo($id);
        if ($result){
            
               $sdata['message'] = "Succesfully Deleted";
                $this->session->set_userdata($sdata);
                redirect(admin_Url() . "/examroutine");
        }
        else {
            $sdata['message'] = "Not Deleted";
            $this->session->set_userdata($sdata);
            redirect(admin_Url() . "/examroutine");
        }
        
    }
    
    
     public function create_multipleEXRoutine() {
     $data['classroutine'] = 'active';
     $data['group_list'] = $this->db->get('group')->result();
      $data['semestertype'] = $this->CourseModleAdmin->get_semester_type();
     $this->load->view('system_path/admin/common/header_link'); // header Css link
     $this->load->view('system_path/admin/common/header'); // body header
     $this->load->view('system_path/admin/common/side_menu'); // side bar menu
     $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
     $this->load->view('system_path/admin/examroutine/searchroutineinfo'); // ...........body content page...........
     $this->load->view('system_path/admin/common/footer'); // footer & script link
     $this->load->view('system_path/jsquery'); // footer & script link
 } 

 
  public function searchlist() {

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
            array(
                'field' => 'data[sessionId]',
                'label' => 'Category Name',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[mediumId]',
                'label' => 'Category Name',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {

            $data['classroutine'] = 'active';
     $this->load->view('system_path/admin/common/header_link'); // header Css link
     $this->load->view('system_path/admin/common/header'); // body header
     $this->load->view('system_path/admin/common/side_menu'); // side bar menu
     $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
     $this->load->view('system_path/admin/examroutine/searchroutineinfo'); // ...........body content page...........
     $this->load->view('system_path/admin/common/footer'); // footer & script link
     $this->load->view('system_path/jsquery'); // footer & script link
        } else
       // $data = $this->input->post('data', TRUE);
        $session = $this->input->post('data[sessionId]'); //4
        $class_level = $this->input->post('data[programLevel]');//4
        $class = $this->input->post('data[programId]');//5
        $medium = $this->input->post('data[mediumId]');//1
        $groupid = $this->input->post('data[groupIdd]');//2
        $shiftid = $this->input->post('data[shiftId]');//1
        $sectionid = $this->input->post('data[sectionId]');//1
        $semester_type = $this->input->post('data[semestertype]');//4

       $data_programOfferId = $this->ProgramModleAdmin->getProgramOfferId_for_student_second_one($session,$class_level,$class,$medium,$groupid,$shiftid,$sectionid,0); //22
        
        if (!empty($data_programOfferId)) {
            $id = $class_level;
            $data['enrolment_info'] = $this->CourseModleAdmin->get_student_enrollment_info($data_programOfferId);
//            echo "<pre>";
//            print_r($data['enrolment_info']);die();
            $data['courselist'] = $this->CourseModleAdmin->getCourseListBYPrglevelId($id);
            $data['courseofferlist'] = $this->ProgramModleAdmin->getOfferedProgramListt($data_programOfferId);
            $data['allcourseofferlist'] = $this->CourseModleAdmin->getOfferedProgramallList($data_programOfferId);
//            echo "<pre>";
//            print_r($data['allcourseofferlist']);die();
//             print_r($data['courseofferlist']); die();
            //  echo '<pre>';print_r($data['courseofferlist']);die();
            $data['semester_id'] = $semester_type;
            $this->load->view('system_path/admin/common/header_link'); // header Css link
            $this->load->view('system_path/admin/common/header'); // body header
            $this->load->view('system_path/admin/common/side_menu'); // side bar menu
            $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
            $this->load->view('system_path/admin/examroutine/addmultipleexamroutine', $data); // ...........body content page...........
            $this->load->view('system_path/admin/common/footer'); // footer & script link
            $this->load->view('system_path/jsquery'); // footer & script link
        } else {

            $sdata['errormessage'] = "Under this enrollment information class not offered yet";
            $this->session->set_userdata($sdata);
            redirect(admin_Url() . "/examroutine/create_multipleEXRoutine", 'refresh');
        }
    }
    
    
     public function insertroutinee(){
//echo '<pre>';print_r($_POST);exit;
           $serial = $this->input->post('serial');
            $date = $this->input->post('date');
            $examtime = $this->input->post('examtime');
            $room = $this->input->post('room');
             $courseId = $this->input->post('courseId');
           //  print_r($courseId); die();
           //  print_r($courseId); die();
            if (!empty($serial)) {
                $chksrl = $serial;
               
                for ($i = 0; $i < count($chksrl); $i++) {
                 
                    $find_value=$serial[$i]-1;

                  
                   
                    $data['date'] = $date[$find_value];
                    $data['examtime'] = $examtime[$find_value];
                    $data['room'] = $room[$find_value];
                     $data['courseId'] = $courseId[$find_value];
                 
                   

                    
                      $data['programOfferId'] = $this->input->post('programOfferId', true);
                      $data['semester_id'] = $this->input->post('semester_id', true);
                
              
                if (!empty($data['programOfferId']))
                {
             
                $datax['programOfferId'] = $this->input->post('programOfferId', true);
                $datax['semester_id']=$data['semester_id'];
               
                $datax['examtime']=$data['examtime'];                
                $datax['courseId']=$data['courseId'];
                $datax['date']=$data['date'];
                $datax['room']=$data['room'];
              
              
                   
                 //   $data['programOfferId']=$enroll['programOfferId'];
                
                $validation1 = $this->ExamroutineModleAdmin->routinevalidation1($datax);
                $validation2 = $this->ExamroutineModleAdmin->routinevalidation2($datax);
                $validation3 = $this->ExamroutineModleAdmin->routinevalidation3($datax);
            
                   if ($validation1) {
                      $sdata = array();
                      $sdata['errormessage'] = "Duplicate found for All field value..";
                      $this->session->set_userdata($sdata);

                      $this->load->helper(array('form', 'url'));
                     
                            $this->load->view('system_path/admin/common/header_link'); // header Css link
                            $this->load->view('system_path/admin/common/header'); // body header
                            $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                            $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                            $this->load->view('system_path/admin/classroutine/findvalue'); // ...........body content page...........
                            $this->load->view('system_path/admin/common/footer'); // footer & script link
                            $this->load->view('system_path/jsquery'); // footer & script link
                        } 
                  elseif ($validation2)
                      {
                          $sdata = array();
                          $sdata['errormessage'] = "Duplicate found for the Value of Day, Subject, Period..";
                          $this->session->set_userdata($sdata);

                          $this->load->helper(array('form', 'url'));
                     
                            $this->load->view('system_path/admin/common/header_link'); // header Css link
                            $this->load->view('system_path/admin/common/header'); // body header
                            $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                            $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                            $this->load->view('system_path/admin/classroutine/findvalue'); // ...........body content page...........
                            $this->load->view('system_path/admin/common/footer'); // footer & script link
                            $this->load->view('system_path/jsquery'); // footer & script link
                        }
                  elseif ($validation3)
                      {
                    $sdata = array();
                    $sdata['errormessage'] = "Duplicate found for the Value of Class,Section, Medium, Group, Shift, Day, Subject, Period..";
                    $this->session->set_userdata($sdata);

                       $this->load->helper(array('form', 'url'));
                      
                            $this->load->view('system_path/admin/common/header_link'); // header Css link
                            $this->load->view('system_path/admin/common/header'); // body header
                            $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                            $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                            $this->load->view('system_path/admin/classroutine/findvalue'); // ...........body content page...........
                            $this->load->view('system_path/admin/common/footer'); // footer & script link
                            $this->load->view('system_path/jsquery'); // footer & script link
                        }else{
                            $this->ExamroutineModleAdmin->addExamroutineInfo($datax);

                $sdata = array();
                $sdata['message'] = "Insert New routine Successfully!";
                $this->session->set_userdata($sdata);
                redirect(admin_Url() . "/examroutine/create_multipleEXRoutine");
                        }  
                      //print_r($data['courseId']); die();
                
                }   
            } 
       
                     //   print_r($data);
                  // $this->ClassroutineModleAdmin->addClassroutineInfo($data);
                  
                }
                    else{
                $sdata['errormessage'] = "Enrollment Information is not offered yet";
                $this->session->set_userdata($sdata);
               redirect(admin_Url() . "/examroutine");
                
            }
             
        
      
        
}







   public function insertroutine() {
    //echo '<pre>';print_r($_POST);exit;
        $serial = $this->input->post('serial');
    //    print_r($serial); die();
            $date = $this->input->post('date');
            $examtime = $this->input->post('examtime');
            $room = $this->input->post('room');
            $courseId = $this->input->post('courseId');

        // print_r($courseId); die();
        
            $chksrl = $serial;

            for ($i = 0; $i < count($chksrl); $i++) {

                $find_value = $serial[$i] - 1;

                $data['date'] = $date[$find_value];
                $data['examtime'] = $examtime[$find_value];
                $data['room'] = $room[$find_value];
                $data['courseId'] = $courseId[$find_value];
       
                $data['programOfferId'] = $this->input->post('programOfferId', true);
                $data['semester_id'] = $this->input->post('semester_id', true);
               
         
                  $datax['programOfferId'] = $this->input->post('programOfferId', true);
                  $datax['semester_id'] = $this->input->post('semester_id', true);
               
                $datax['examtime']=$data['examtime'];                
                $datax['courseId']=$data['courseId'];
                $datax['date']=$data['date'];
                $datax['room']=$data['room'];
              
                
               /* $validation1 = $this->ExamroutineModleAdmin->routinevalidation1($datax);
                $validation2 = $this->ExamroutineModleAdmin->routinevalidation2($datax);
                $validation3 = $this->ExamroutineModleAdmin->routinevalidation3($datax);

                        if ($validation1) {
                            $sdata = array();
                            $sdata['errormessage'] = "Duplicate found for All field value..";
                            $this->session->set_userdata($sdata);

                             redirect(admin_Url() . "/examroutine/create_multipleEXRoutine");
                        } elseif ($validation2) {
                            $sdata = array();
                            $sdata['errormessage'] = "Duplicate found for the Value of Day, Subject, Period..";
                            $this->session->set_userdata($sdata);

                            redirect(admin_Url() . "/examroutine/create_multipleEXRoutine");
                        } elseif ($validation3) {
                            $sdata = array();
                            $sdata['errormessage'] = "Duplicate found for the Value of Class,Section, Medium, Group, Shift, Day, Subject, Period..";
                            $this->session->set_userdata($sdata);

                              redirect(admin_Url() . "/examroutine/create_multipleEXRoutine");
                        }*/  
                   $this->ExamroutineModleAdmin->addExamroutineInfo($datax);
               
              
            }
            // die();
            $sdata['message'] = 'New Exam Routine Successfully Inserted';
            $this->session->set_userdata($sdata);

           redirect(admin_Url() . "/examroutine/create_multipleEXRoutine");
       
    }

}