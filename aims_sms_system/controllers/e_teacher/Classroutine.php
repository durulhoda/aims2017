<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */

class Classroutine extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->teacher_logged_auth();
      $this->load->model('admin/classroutine/ClassroutineModleAdmin', 'ClassroutineModleAdmin');
       
   //   $this->load->model('admin/courseoffer/CourseofferModleAdmin', 'CourseofferModleAdmin');
    }
    
      public function index() {

       $data['classroutine'] = 'active';

        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/classroutine/index'); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
    }


public function saveclassroutine() {
    
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
           
            array(
                'field' => 'data[programId]',
                'label' => 'class',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[sectionId]',
                'label' => 'Section',
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
                'label' => 'Session',
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
                'field' => 'data[dayName]',
                'label' => 'Day',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[periodId]',
                'label' => 'Period',
                'rules' => 'required'
            ),
             array(
                'field' => 'data[courseId]',
                'label' => 'subject',
                'rules' => 'required'
            )
            
          );


        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
//                    redirect(base_url('admin/campus'));
                       $this->load->view('system_path/admin/common/header_link'); // header Css link
                       $this->load->view('system_path/admin/common/header'); // body header
                       $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                       $this->load->view('system_path/admin/common/top_menu'); // top bar menu
                       $this->load->view('system_path/admin/classroutine/index'); // ...........body content page...........
                       $this->load->view('system_path/admin/common/footer'); // footer & script link
                       $this->load->view('system_path/jsquery'); // footer & script link
            
        } 

        else {
            
             $data = $this->input->post('data', TRUE);
             
             $data['periodTime']=getPeriodTime($data['shiftId'],$data['periodId']);
             if(!empty($data['periodTime']))
             {
                $datax['programOfferId'] = getProgramOfferId($data);
                $datax['courseId']=$data['courseId'];
                $datax['dayName']=$data['dayName'];
                $datax['periodId']=$data['periodId'];

                if (!empty($datax['programOfferId']))
                {
                   $validation1 = $this->ClassroutineModleAdmin->routinevalidation1($datax);
                   $validation2 = $this->ClassroutineModleAdmin->routinevalidation2($datax);
                   $validation3 = $this->ClassroutineModleAdmin->routinevalidation3($datax);
                   $validation4 = $this->ClassroutineModleAdmin->routinevalidation4($datax);
                   $validation5 = $this->ClassroutineModleAdmin->routinevalidation5($datax);
                   $validation6 = $this->ClassroutineModleAdmin->routinevalidation6($datax);

                   if ($validation1) {
                      $sdata = array();
                      $sdata['errormessage'] = "Duplicate found for All field value..";
                      $this->session->set_userdata($sdata);

                      $this->load->helper(array('form', 'url'));
                     $this->load->view('system_path/admin/common/header_link'); // header Css link
                       $this->load->view('system_path/admin/common/header'); // body header
                       $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                       $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                       $this->load->view('system_path/admin/classroutine/index'); // ...........body content page...........
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
                       $this->load->view('system_path/admin/classroutine/index'); // ...........body content page...........
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
                       $this->load->view('system_path/admin/classroutine/index'); // ...........body content page...........
                       $this->load->view('system_path/admin/common/footer'); // footer & script link
                       $this->load->view('system_path/jsquery'); // footer & script link
                      }  
                  elseif ($validation4)
                      {

                          $sdata = array();
                          $sdata['errormessage'] = "Duplicate found for the Value of Class,Section, Medium, Group, Shift, Day, Period..";
                          $this->session->set_userdata($sdata);

                       $this->load->helper(array('form', 'url'));
                       $this->load->view('system_path/admin/common/header_link'); // header Css link
                       $this->load->view('system_path/admin/common/header'); // body header
                       $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                       $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                       $this->load->view('system_path/admin/classroutine/index'); // ...........body content page...........
                       $this->load->view('system_path/admin/common/footer'); // footer & script link
                       $this->load->view('system_path/jsquery'); // footer & script link
                      }
                  elseif($validation5)
                      {

                          $sdata = array();
                          $sdata['errormessage'] = "Duplicate found for the Value of Class,Section, Medium, Group, Shift, Day, Subject..";
                          $this->session->set_userdata($sdata);

                          $this->load->helper(array('form', 'url'));
                         $this->load->view('system_path/admin/common/header_link'); // header Css link
                       $this->load->view('system_path/admin/common/header'); // body header
                       $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                       $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                       $this->load->view('system_path/admin/classroutine/index'); // ...........body content page...........
                       $this->load->view('system_path/admin/common/footer'); // footer & script link
                       $this->load->view('system_path/jsquery'); // footer & script link
                      }    
                  elseif(!$validation6)
                      {
                           $sdata = array();
                          $sdata['errormessage'] = "This Subject is not Offered for yet for this class ";

                       $this->session->set_userdata($sdata);
                       $this->load->helper(array('form', 'url'));
                       $this->load->view('system_path/admin/common/header_link'); // header Css link
                       $this->load->view('system_path/admin/common/header'); // body header
                       $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                       $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                       $this->load->view('system_path/admin/classroutine/index'); // ...........body content page...........
                       $this->load->view('system_path/admin/common/footer'); // footer & script link
                       $this->load->view('system_path/jsquery'); // footer & script link
                      }    

                  else {

                      $this->ClassroutineModleAdmin->addClassroutineInfo($datax);

                      $sdata = array();
                      $sdata['message'] = "Insert New routine Successfully!";
                      $this->session->set_userdata($sdata);
                      redirect(admin_Url() . "/classroutine");
                  }
                }
                else{
                      $sdata = array();
                      $sdata['errormessage'] = "Inserted enrollment information is not offer yet";
                      $this->session->set_userdata($sdata);

                      $this->load->helper(array('form', 'url'));
                       $this->load->view('system_path/admin/common/header_link'); // header Css link
                       $this->load->view('system_path/admin/common/header'); // body header
                       $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                       $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                       $this->load->view('system_path/admin/classroutine/index'); // ...........body content page...........
                       $this->load->view('system_path/admin/common/footer'); // footer & script link
                       $this->load->view('system_path/jsquery'); // footer & script link
                  } 
             } 
             else{
                      $sdata = array();
                      $sdata['errormessage'] = "Period Time is not set for inserted period";
                      $this->session->set_userdata($sdata);

                      redirect(admin_Url() . "/classroutine");
                  } 
    }
}

    public function viewclassroutine() {
        
        $data['classroutinelist']  = $this->ClassroutineModleAdmin->getClassroutineList();
         
        $data['classroutine'] = 'active';       
        $data['timetable'] = 'active';
        $this->load->view('system_path/teacher/common/header_link'); // header Css link
        $this->load->view('system_path/teacher/common/header'); // body header
        $this->load->view('system_path/teacher/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/teacher/classroutine/viewclass_routine', $data); // ...........body content page...........
        $this->load->view('system_path/teacher/common/footer'); // footer & script link
    }
    
    public function showclassroutine($id) {
            
            $id=(int)$id;
            $data['programOfferId'] = $id; 
       
            $data['classroutineinfo']= $this->ClassroutineModleAdmin->select_new_routine($data);
            if(!empty($data['classroutineinfo']))
            {
                $data['timetable'] = 'active';
                $data['classroutine'] = 'active';
                $this->load->view('system_path/teacher/common/header_link'); // header Css link
                $this->load->view('system_path/teacher/common/header'); // body header
                $this->load->view('system_path/teacher/common/side_menu', $data); // side bar menu
                $this->load->view('system_path/teacher/classroutine/viewroutine', $data); // ...........body content page...........
                $this->load->view('system_path/teacher/common/footer'); // footer & script link

            }
            else{            
                $sdata = array();
                $sdata['message'] = "No Classroutine Found";
                $this->session->set_userdata($sdata);
               
              
            }
       
    }


    
    public function editclassroutine($id){
       
        $this->load->view('templates/admin/common/header');
        
        $data['editclassroutine'] = $this->ClassroutineModleAdmin->editClassroutineInfo($id);
        $data['programOfferId']=getofferProgramInfoById($data['editclassroutine']['programOfferId']);
        $this->load->view('templates/admin/classroutine/editclassroutine', $data); 
        $this->load->view('templates/admin/common/footer');
    }

    public function updateclassroutine($id){
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
                'field' => 'data[sectionId]',
                'label' => 'Section',
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
                'label' => 'Session',
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
                'field' => 'data[dayName]',
                'label' => 'Day',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[periodId]',
                'label' => 'period',
                'rules' => 'required'
            )
            
          );


        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
//                    redirect(base_url('admin/campus'));
            $this->load->view('templates/admin/common/header');
            $this->load->view('templates/admin/classroutine/index');
            $this->load->view('templates/admin/common/footer');
            
        } 

        else {
            
             $data = $this->input->post('data', TRUE);
             
             $data['periodTime']=getPeriodTime($data['shiftId'],$data['periodId']);
             if(!empty($data['periodTime']))
             {
                $datax['programOfferId'] = getProgramOfferId($data);
                $datax['courseId']=$data['courseId'];
                $datax['dayName']=$data['dayName'];
                $datax['periodId']=$data['periodId'];

                if ($datax['programOfferId'] != 0)
                {
                   $validation1 = $this->ClassroutineModleAdmin->routinevalidation1($datax);
                   $validation2 = $this->ClassroutineModleAdmin->routinevalidation2($datax);
                   $validation3 = $this->ClassroutineModleAdmin->routinevalidation3($datax);
                   $validation4 = $this->ClassroutineModleAdmin->routinevalidation4($datax);
                   $validation5 = $this->ClassroutineModleAdmin->routinevalidation5($datax);
             
             if ($validation1) {
                $sdata = array();
                $sdata['message'] = "Duplicate found for All field value..";
                $this->session->set_userdata($sdata);

                $data['editclassroutine'] = $this->ClassroutineModleAdmin->editClassroutineInfo($id);
                $data['programOfferId']=getofferProgramInfoById($data['editclassroutine']['programOfferId']);
                    $this->load->view('templates/admin/common/header');
                    $this->load->view('templates/admin/classroutine/editclassroutine', $data); 
                    $this->load->view('templates/admin/common/footer');
            } 
            elseif ($validation2)
                {
                    $sdata = array();
                    $sdata['message'] = "Duplicate found for the Value of Day, Subject, Period..";
                    $this->session->set_userdata($sdata);

                     $data['editclassroutine'] = $this->ClassroutineModleAdmin->editClassroutineInfo($id);
                     $data['programOfferId']=getofferProgramInfoById($data['editclassroutine']['programOfferId']);
                    $this->load->view('templates/admin/common/header');
                    $this->load->view('templates/admin/classroutine/editclassroutine', $data); 
                    $this->load->view('templates/admin/common/footer');
                }
            elseif ($validation3)
                {
                    $sdata = array();
                    $sdata['message'] = "Duplicate found for the Value of Class, Medium, Group, Shift, Day, Subject, Period..";
                    $this->session->set_userdata($sdata);

                     $data['editclassroutine'] = $this->ClassroutineModleAdmin->editClassroutineInfo($id);
                     $data['programOfferId']=getofferProgramInfoById($data['editclassroutine']['programOfferId']);
                    $this->load->view('templates/admin/common/header');
                    $this->load->view('templates/admin/classroutine/editclassroutine', $data); 
                    $this->load->view('templates/admin/common/footer');
                }   
            elseif ($validation4)
                {
                
                    $this->ClassroutineModleAdmin->deleteClassroutineInfo($id);
                     $this->ClassroutineModleAdmin->addClassroutineInfo($datax);
                
                    $sdata = array();
                    $sdata['message'] = "Update routine Successfully!";
                    $this->session->set_userdata($sdata);

                    redirect('admin/classroutine/viewclassroutine', 'refresh');
                }
            elseif ($validation5)
                {
                    $sdata = array();
                    $sdata['message'] = "Duplicate found for the Value of Class, Medium, Group, Shift, Day, Subject..";
                    $this->session->set_userdata($sdata);

                     $data['editclassroutine'] = $this->ClassroutineModleAdmin->editClassroutineInfo($id);
                     $data['programOfferId']=getofferProgramInfoById($data['editclassroutine']['programOfferId']);
                    $this->load->view('templates/admin/common/header');
                    $this->load->view('templates/admin/classroutine/editclassroutine', $data); 
                    $this->load->view('templates/admin/common/footer');
                }     
            else {
                $this->ClassroutineModleAdmin->deleteClassroutineInfo($id);
                $this->ClassroutineModleAdmin->addClassroutineInfo($datax);
                
                $sdata = array();
                $sdata['message'] = "Update routine Successfully!";
                $this->session->set_userdata($sdata);
                
                 redirect('admin/classroutine/viewclassroutine', 'refresh');
            }
             
         }
                else{
                      $sdata = array();
                      $sdata['message'] = "Inserted enrollment information is not offer yet";
                      $this->session->set_userdata($sdata);

                      $data['editclassroutine'] = $this->ClassroutineModleAdmin->editClassroutineInfo($id);
                        $data['programOfferId']=getofferProgramInfoById($data['editclassroutine']['programOfferId']);
                       $this->load->view('templates/admin/common/header');
                       $this->load->view('templates/admin/classroutine/editclassroutine', $data); 
                       $this->load->view('templates/admin/common/footer');
                  } 
             } 
             else{
                      $sdata = array();
                      $sdata['message'] = "Period Time is not set for inserted period";
                      $this->session->set_userdata($sdata);

                       $data['editclassroutine'] = $this->ClassroutineModleAdmin->editClassroutineInfo($id);
                       $data['programOfferId']=getofferProgramInfoById($data['editclassroutine']['programOfferId']);
                        $this->load->view('templates/admin/common/header');
                        $this->load->view('templates/admin/classroutine/editclassroutine', $data); 
                        $this->load->view('templates/admin/common/footer');
                  } 
    }
            
       
        
    }
     public function deleteclassroutine($id) {

        $id = (int)$id;
        
         $this->ClassroutineModleAdmin->deleteClassroutineInfo($id);
         redirect('admin/classroutine/viewclassroutine', 'refresh');
    }

     public function acad_calender() {

    $data['classroutine'] = 'active';

     $this->load->view('system_path/admin/common/header_link'); // header Css link
     $this->load->view('system_path/admin/common/header'); // body header
     $this->load->view('system_path/admin/common/side_menu'); // side bar menu
     $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
     $this->load->view('system_path/admin/classroutine/academic_calender'); // ...........body content page...........
     $this->load->view('system_path/admin/common/footer'); // footer & script link
 }    
     


}