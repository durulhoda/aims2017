<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */

class Classroutine extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->my_admin();
          $this->load->model('admin/classroutine/ClassroutineModleAdmin', 'ClassroutineModleAdmin');
          $this->load->model('admin/period/PeriodModleAdmin', 'PeriodModleAdmin');
          $this->load->model('admin/course/CourseModleAdmin', 'CourseModleAdmin');
          $this->load->model('admin/result/Result_model_admin', 'rma');
       
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
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/classroutine/viewclass_routine',$data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link

        
    }
    
    // public function showclassroutine($id) {
            
    //         $id=(int)$id;
    //         $data['programOfferId'] = $id; 
       
    //         $data['classroutineinfo']= $this->ClassroutineModleAdmin->select_new_routine($data);
    //         $data['Saturday']= $this->ClassroutineModleAdmin->select_Saturday($data);
    //         $data['Sunday']= $this->ClassroutineModleAdmin->select_Sunday($data);
    //         $data['Monday']= $this->ClassroutineModleAdmin->select_Monday($data);
    //         $data['Tuesday']= $this->ClassroutineModleAdmin->select_Tuesday($data);
    //         $data['Wednessday']= $this->ClassroutineModleAdmin->select_Wednessday($data);
    //         $data['Thursday']= $this->ClassroutineModleAdmin->select_Thursday($data);
    //         $data['Friday']= $this->ClassroutineModleAdmin->select_Friday($data);
    //  //  print_r($data['bracktime']); die();
    //         if(!empty($data['classroutineinfo']))
    //         {
    //             $data['classroutine'] = 'active';
    //             $this->load->view('system_path/admin/common/header_link'); // header Css link
    //             $this->load->view('system_path/admin/common/header'); // body header
    //             $this->load->view('system_path/admin/common/side_menu'); // side bar menu
    //             $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
    //             $this->load->view('system_path/admin/classroutine/viewroutine', $data); // ...........body content page...........
    //             $this->load->view('system_path/admin/common/footer'); // footer & script link
    //             $this->load->view('system_path/jsquery'); // footer & script link
                
    //          //   $this->load->view('system_path/admin/classroutine/viewroutine',$data);
    //         }
    //         else{            
    //             $sdata = array();
    //             $sdata['message'] = "No Classroutine Found";
    //             $this->session->set_userdata($sdata);
               
              
    //         }
       
    // }   

    public function showclassroutine($id) {
            
            $id=(int)$id;
            $data['programOfferId'] = $id; 
            $pog_info = $this->getProgramInfo($id);
            $data['periodlist'] = $this->PeriodModleAdmin->getlistPeriod($pog_info->sessionId, $pog_info->shiftId);

//        echo '<pre>';
//        print_r($data['periodlist']);exit;
          
       
            //$data['classroutineinfo']= $this->ClassroutineModleAdmin->select_new_routine($data);
            $data['class_routine_info'] = $this->ClassroutineModleAdmin->getClassRoutineInfo($id);

//            echo '<pre>';
//            echo '<pre>'; print_r($data);exit;

            $data['Saturday']= $this->ClassroutineModleAdmin->select_Saturday($data);
            $data['Sunday']= $this->ClassroutineModleAdmin->select_Sunday($data);
            $data['Monday']= $this->ClassroutineModleAdmin->select_Monday($data);
            $data['Tuesday']= $this->ClassroutineModleAdmin->select_Tuesday($data);
            $data['Wednessday']= $this->ClassroutineModleAdmin->select_Wednessday($data);
            $data['Thursday']= $this->ClassroutineModleAdmin->select_Thursday($data);
            $data['Friday']= $this->ClassroutineModleAdmin->select_Friday($data);
     //  print_r($data['bracktime']); die();
            if(!empty($data['class_routine_info']))
            {
                $data['classroutine'] = 'active';
                $this->load->view('system_path/admin/common/header_link'); // header Css link
                $this->load->view('system_path/admin/common/header'); // body header
                $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                $this->load->view('system_path/admin/classroutine/viewroutine', $data); // ...........body content page...........
                $this->load->view('system_path/admin/common/footer'); // footer & script link
                $this->load->view('system_path/jsquery'); // footer & script link
                
             //   $this->load->view('system_path/admin/classroutine/viewroutine',$data);
            }
            else{            
                $sdata = array();
                $sdata['message'] = "No Classroutine Found";
                $this->session->set_userdata($sdata);
               
              
            }
    } 

    public function class_routine_print($id) {
            
            $id=(int)$id;
            $data['programOfferId'] = $id; 
            $pog_info = $this->getProgramInfo($id);
            $data['periodlist'] = $this->PeriodModleAdmin->getlistPeriod($pog_info->sessionId, $pog_info->shiftId);
            $data['programofferInfo'] = $pog_info;
            //$data['classroutineinfo']= $this->ClassroutineModleAdmin->select_new_routine($data);
            $data['class_routine_info'] = $this->ClassroutineModleAdmin->getClassRoutineInfo($id);
            // echo '<pre>'; print_r($data);exit;
            $data['Saturday']= $this->ClassroutineModleAdmin->select_Saturday($data);
            $data['Sunday']= $this->ClassroutineModleAdmin->select_Sunday($data);
            $data['Monday']= $this->ClassroutineModleAdmin->select_Monday($data);
            $data['Tuesday']= $this->ClassroutineModleAdmin->select_Tuesday($data);
            $data['Wednessday']= $this->ClassroutineModleAdmin->select_Wednessday($data);
            $data['Thursday']= $this->ClassroutineModleAdmin->select_Thursday($data);
            $data['Friday']= $this->ClassroutineModleAdmin->select_Friday($data);
            $data['institute_info'] = $this->rma->getInstituteInfo();
     //  print_r($data['bracktime']); die();
            if(!empty($data['class_routine_info']))
            {
                $data['classroutine'] = 'active';
                $this->load->view('system_path/admin/common/header_link'); // header Css link
                $this->load->view('system_path/admin/common/header'); // body header
                $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                $this->load->view('system_path/admin/classroutine/class_routine_print', $data); // ...........body content page...........
                $this->load->view('system_path/admin/common/footer'); // footer & script link
                $this->load->view('system_path/jsquery'); // footer & script link
                
             //   $this->load->view('system_path/admin/classroutine/viewroutine',$data);
            }
            else{            
                $sdata = array();
                $sdata['message'] = "No Classroutine Found";
                $this->session->set_userdata($sdata);
               
              
            }
    } 

    private function getProgramInfo($programOfferId = 0) {
      $record = $this->db
                  ->where('programOfferId', $programOfferId)
                  ->get('programoffer')
                  ->row();
      return $record;
    }
    
    public function editroutine($id) {

           $data['programOfferId']=$id;
           $data['classroutinelist'] = $this->ClassroutineModleAdmin->select_new_routine($data);
           $data['programInfo'] = $this->getProgramInfo($id);
           if (!$data['programInfo']) {
              $sdata['errormessage'] = "Enrollment information is not offer yet";
              $this->session->set_userdata($sdata);
              redirect(admin_Url() . "/classroutine/viewclassroutine", 'refresh');
           }
          $data['classroutinelist'] = $this->ClassroutineModleAdmin->getClassRoutineLists($data['programOfferId']);
        //  print_r($data['classroutinelist1']); die();
            if (!empty($data['classroutinelist'])) {
                 $data['classroutine'] = 'active';
               
                $this->load->view('system_path/admin/common/header_link'); // header Css link
                $this->load->view('system_path/admin/common/header'); // body header
                $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                $this->load->view('system_path/admin/classroutine/editroutine1', $data); // ...........body content page...........
                $this->load->view('system_path/admin/common/footer'); // footer & script link
                $this->load->view('system_path/jsquery'); // footer & script link
            } else {
                $sdata = array();
                $sdata['message'] = "No Classroutine Found";
                $this->session->set_userdata($sdata);
                redirect(admin_Url() . "/classroutine");
            }
    }

    
    public function editclassroutine($id){    
        $data['editclassroutine'] = $this->ClassroutineModleAdmin->editClassroutineInfo($id);
        $data['programOfferId']=getofferProgramInfoById($data['editclassroutine']['programOfferId']);
       
         $data['periodlist'] = $this->PeriodModleAdmin->getlistPeriod($data['programOfferId']['sessionId'], $data['programOfferId']['shiftId']);
        // echo '<pre>';print_r($data);exit;
                $data['classroutine'] = 'active';
                $this->load->view('system_path/admin/common/header_link'); // header Css link
                $this->load->view('system_path/admin/common/header'); // body header
                $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                $this->load->view('system_path/admin/classroutine/editclassroutine', $data); // ...........body content page...........
                $this->load->view('system_path/admin/common/footer'); // footer & script link
                $this->load->view('system_path/jsquery'); // footer & script link
    }

    public function updateclassroutine($id) {
      $this->validationCheck();
      if ($this->form_validation->run() == FALSE) {
        redirect(admin_Url() . "/classroutine/editclassroutine/".$id);
        } else {
           $data = $this->input->post('data', TRUE);
           $data['programOfferId'] = getProgramOfferId($data);
           if (!$data['programOfferId']){
            $sdata['errormessage'] = "Inserted enrollment information is not offer yet";
            $this->session->set_userdata($sdata);
           }
           $check = $this->checkClassRoutine($data);
           if ($check) {
            //echo 'check';exit;
            $sdata['errormessage'] = "No Update routine!";
           } else {
           // echo '<pre>';print_r($data);
              $datax = [
                'dayName' => $data['dayName'],
                'programOfferId' => $data['programOfferId']['programOfferId'],
                'courseId' => $data['courseId'],
                'periodId' => $data['periodId']
              ];
            $record = $this->ClassroutineModleAdmin->updateClassroutineInfo($datax, $id);
            if ($record) {
              $sdata['message'] = "Update routine Successfully!";
            } else {
              $sdata['errormessage'] = "Update routine Unsuccessfully!";
            }
           }
           $this->session->set_userdata($sdata);
          redirect(admin_Url() . "/classroutine/editroutine/".$data['programOfferId']['programOfferId']);
          //echo '<pre>';print_r($data);exit;
        }
    }

    private function checkClassRoutine($data = [])
    {
      $programOfferId = ($data['programOfferId']['programOfferId']) ? $data['programOfferId']['programOfferId'] : 0;
      $courseId = ($data['courseId']) ? $data['courseId'] : 0;
      $periodId = ($data['periodId']) ? $data['periodId'] : 0;
      $record = $this->db
                ->where('TRIM(dayName)', trim($data['dayName']))
                ->where('programOfferId', $programOfferId)
                ->where('courseId', $courseId)
                ->where('periodId', $periodId)
                ->get('classroutine')
                ->row();
      return $record;
    }

    public function updateclassroutine1($id){
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
                'label' => 'period',
                'rules' => 'required'
            )
            
          );


        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
//                    redirect(base_url('admin/campus'));
        redirect(admin_Url() . "/classroutine");
            
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
                $sdata['errormessage'] = "Duplicate found for All field value..";
                $this->session->set_userdata($sdata);

                $data['editclassroutine'] = $this->ClassroutineModleAdmin->editClassroutineInfo($id);
                $data['programOfferId']=getofferProgramInfoById($data['editclassroutine']['programOfferId']);
                    $data['classroutine'] = 'active';
                $this->load->view('system_path/admin/common/header_link'); // header Css link
                $this->load->view('system_path/admin/common/header'); // body header
                $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                $this->load->view('system_path/admin/classroutine/editclassroutine', $data); // ...........body content page...........
                $this->load->view('system_path/admin/common/footer'); // footer & script link
                $this->load->view('system_path/jsquery'); // footer & script link
            } 
            elseif ($validation2)
                {
                    $sdata = array();
                    $sdata['errormessage'] = "Duplicate found for the Value of Day, Subject, Period..";
                    $this->session->set_userdata($sdata);

                     $data['editclassroutine'] = $this->ClassroutineModleAdmin->editClassroutineInfo($id);
                     $data['programOfferId']=getofferProgramInfoById($data['editclassroutine']['programOfferId']);
                    $data['classroutine'] = 'active';
                $this->load->view('system_path/admin/common/header_link'); // header Css link
                $this->load->view('system_path/admin/common/header'); // body header
                $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                $this->load->view('system_path/admin/classroutine/editclassroutine', $data); // ...........body content page...........
                $this->load->view('system_path/admin/common/footer'); // footer & script link
                $this->load->view('system_path/jsquery'); // footer & script link
                }
            elseif ($validation3)
                {
                    $sdata = array();
                    $sdata['errormessage'] = "Duplicate found for the Value of Class, Medium, Group, Shift, Day, Subject, Period..";
                    $this->session->set_userdata($sdata);

                     $data['editclassroutine'] = $this->ClassroutineModleAdmin->editClassroutineInfo($id);
                     $data['programOfferId']=getofferProgramInfoById($data['editclassroutine']['programOfferId']);
                    $data['classroutine'] = 'active';
                $this->load->view('system_path/admin/common/header_link'); // header Css link
                $this->load->view('system_path/admin/common/header'); // body header
                $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                $this->load->view('system_path/admin/classroutine/editclassroutine', $data); // ...........body content page...........
                $this->load->view('system_path/admin/common/footer'); // footer & script link
                $this->load->view('system_path/jsquery'); // footer & script link
                }   
            elseif ($validation4)
                {
                
                    $this->ClassroutineModleAdmin->deleteClassroutineInfo($id);
                     $this->ClassroutineModleAdmin->addClassroutineInfo($datax);
                
                    $sdata = array();
                    $sdata['message'] = "Update routine Successfully!";
                    $this->session->set_userdata($sdata);

                  redirect(admin_Url() . "/classroutine");
                }
            elseif ($validation5)
                {
                    $sdata = array();
                    $sdata['errormessage'] = "Duplicate found for the Value of Class, Medium, Group, Shift, Day, Subject..";
                    $this->session->set_userdata($sdata);

                     $data['editclassroutine'] = $this->ClassroutineModleAdmin->editClassroutineInfo($id);
                     $data['programOfferId']=getofferProgramInfoById($data['editclassroutine']['programOfferId']);
                     $data['classroutine'] = 'active';
                    $this->load->view('system_path/admin/common/header_link'); // header Css link
                    $this->load->view('system_path/admin/common/header'); // body header
                    $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                    $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                    $this->load->view('system_path/admin/classroutine/editclassroutine', $data); // ...........body content page...........
                    $this->load->view('system_path/admin/common/footer'); // footer & script link
                    $this->load->view('system_path/jsquery'); // footer & script link
                }     
            else {
                $this->ClassroutineModleAdmin->deleteClassroutineInfo($id);
                $this->ClassroutineModleAdmin->addClassroutineInfo($datax);
                
                $sdata = array();
                $sdata['message'] = "Update routine Successfully!";
                $this->session->set_userdata($sdata);
                 redirect(admin_Url() . "/classroutine");
            }
             
         }
                else{
                      $sdata = array();
                      $sdata['errormessage'] = "Inserted enrollment information is not offer yet";
                      $this->session->set_userdata($sdata);

                      $data['editclassroutine'] = $this->ClassroutineModleAdmin->editClassroutineInfo($id);
                        $data['programOfferId']=getofferProgramInfoById($data['editclassroutine']['programOfferId']);
                $data['classroutine'] = 'active';
                $this->load->view('system_path/admin/common/header_link'); // header Css link
                $this->load->view('system_path/admin/common/header'); // body header
                $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                $this->load->view('system_path/admin/classroutine/editclassroutine', $data); // ...........body content page...........
                $this->load->view('system_path/admin/common/footer'); // footer & script link
                $this->load->view('system_path/jsquery'); // footer & script link
                  } 
             } 
             else{
                      $sdata = array();
                      $sdata['errormessage'] = "Period Time is not set for inserted period";
                      $this->session->set_userdata($sdata);

                       $data['editclassroutine'] = $this->ClassroutineModleAdmin->editClassroutineInfo($id);
                       $data['programOfferId']=getofferProgramInfoById($data['editclassroutine']['programOfferId']);
                      $data['classroutine'] = 'active';
                $this->load->view('system_path/admin/common/header_link'); // header Css link
                $this->load->view('system_path/admin/common/header'); // body header
                $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                $this->load->view('system_path/admin/classroutine/editclassroutine', $data); // ...........body content page...........
                $this->load->view('system_path/admin/common/footer'); // footer & script link
                $this->load->view('system_path/jsquery'); // footer & script link
                  } 
    }

    
            
       
        
    }
    public function validationCheck()
    {
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
                'label' => 'period',
                'rules' => 'required'
            )
            
          );


        $this->form_validation->set_rules($config);
    }
     public function deleteclassroutine($id) {

        $id = (int)$id;
        
         $this->ClassroutineModleAdmin->deleteClassroutineInfo($id);
           redirect(admin_Url() . "/classroutine/viewclassroutine");
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
     
      public function create_multipleRoutine() {

     $data['classroutine'] = 'active';
     $this->load->view('system_path/admin/common/header_link'); // header Css link
     $this->load->view('system_path/admin/common/header'); // body header
     $this->load->view('system_path/admin/common/side_menu'); // side bar menu
     $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
     $this->load->view('system_path/admin/classroutine/findvalue'); // ...........body content page...........
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
            $this->load->view('system_path/admin/classroutine/findvalue'); // ...........body content page...........
            $this->load->view('system_path/admin/common/footer'); // footer & script link
            $this->load->view('system_path/jsquery'); // footer & script link
        } else
        {
          $data = $this->input->post('data', TRUE);
          if (!$data) {
              redirect(admin_Url() . "/classroutine/create_multipleRoutine", 'refresh');
            }
        //echo '<pre>';print_r($data);die();
        $data['programOfferId'] = getProgramOfferId($data);
       // $dataa=$data['programOfferId'];
      //  echo '<pre>';print_r($data);die();
        if (!empty($data['programOfferId'])) {
          $programOfferId = $data['programOfferId']['programOfferId'];
          $check = $this->checkProgramOfferId($programOfferId, $data['dayName']);
          if ($check) {
            $data['check'] = true;
          }
       $id = $data['programLevel'];
            //print_r($id); die();
           // $data['courselist'] = $this->CourseModleAdmin->getCourseListBYPrglevelId($id);
            $data['courselist'] = $this->CourseModleAdmin->getCourseOfferList($programOfferId, $id);
            $data['periodlist'] = $this->PeriodModleAdmin->getlistPeriod($data['sessionId'], $data['shiftId']);

            $this->load->view('system_path/admin/common/header_link'); // header Css link
            $this->load->view('system_path/admin/common/header'); // body header
            $this->load->view('system_path/admin/common/side_menu'); // side bar menu
            $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
            $this->load->view('system_path/admin/classroutine/multipleroutine1',$data); // ...........body content page...........
            $this->load->view('system_path/admin/common/footer'); // footer & script link
            $this->load->view('system_path/jsquery'); // footer & script link
            
        } else {

            $sdata['errormessage'] = "Under this enrollment information class not offered yet";
            $this->session->set_userdata($sdata);
            redirect(admin_Url() . "/classroutine/create_multipleRoutine", 'refresh');
        }
      }
    }

    private function checkProgramOfferId($programOfferId = 0, $day = '') {
      $row = $this->db
              ->where('programOfferId', $programOfferId)
              ->where('TRIM(dayName)', trim($day))
              ->get('classroutine')
              ->row();
      if ($row) {
        return TRUE;
      } else {
        return FALSE;
      }
    }

      public function class_routine_add()
      {
       // echo '<pre>';print_r($_POST);exit;
        $serial = $this->input->post('serial');
        $programOfferId = $this->input->post('programOfferId', true);
        $day = trim($this->input->post('dayName', true));
        if (!$programOfferId) {
          $sdata['errormessage'] = "Enrollment information is not offer yet";
          $this->session->set_userdata($sdata);
          redirect(admin_Url() . "/classroutine/create_multipleRoutine", 'refresh');
        }
        $check = $this->checkProgramOfferId($programOfferId, $day);
        // if ($check) {
        //   $sdata['errormessage'] = "Already, Enrollment information done!";
        //   $this->session->set_userdata($sdata);
        //   redirect(admin_Url() . "/classroutine/create_multipleRoutine", 'refresh');
        // }
        $count = count($serial);

        $this->db->trans_begin();
        if ($check) {
          $this->ClassRoutineDelete($programOfferId, $day);
        }
        for ($i = 0; $i < $count; $i++) {
           $find_value=$serial[$i]-1;
           $courseId = $this->input->post('courseId', true);
           if (isset($courseId[$find_value])) {
            $c_length = count($courseId[$find_value]);
          } else  {
             $c_length = 1;
          }
            if (isset($courseId[$find_value])) {
                for ($j = 0; $j<$c_length; $j++) {
                  $insertData = [
                  'dayName' => $day,
                  'programOfferId' => $programOfferId,
                  'courseId' => isset($courseId[$find_value][$j]) ? $courseId[$find_value][$j] : 0,
                  'periodId' => $this->input->post('periodId', true)[$find_value]
                ];
                  $this->db->insert('classroutine', $insertData);
                }
            }
        }

        //echo '<pre>';print_r($insertData);exit;
        if ($this->db->trans_status() === FALSE)
          {
            $this->db->trans_rollback();
            $sdata['errormessage'] = "Already, Enrollment information done!";
          }
          else
          {
            $this->db->trans_commit();
            $sdata['message'] = 'New Class Routine Successfull inserted';
          }
          $this->session->set_userdata($sdata);
          redirect(admin_Url() . "/classroutine/create_multipleRoutine", 'refresh');
      }

      private function ClassRoutineDelete($programOfferId = 0, $day = '') {
        $this->db
            ->where('programOfferId', $programOfferId)
            ->where('TRIM(dayName)', trim($day))
            ->delete('classroutine');
      }
    
    
        public function insertroutine(){
            echo '<pre>';print_r($_POST);exit;
            $serial = $this->input->post('serial');

            $courseId = $this->input->post('courseId');
            $periodId = $this->input->post('periodId');
          
            // print_r($courseId); die();
           
                $chksrl = $serial;
               // print_r($chksrl); die();
                for ($i = 0; $i < count($chksrl); $i++) {
                 
                    $find_value=$chksrl[$i]-1;

                   $data['periodId'] = $periodId[$find_value];
                    $data['courseId'] = $courseId[$find_value];
                 
                    //  $data['employeeId'] = $employeeId[$find_value];

                    $data['dayName'] = $this->input->post('dayName', true);
                    $data['programOfferId'] = $this->input->post('programOfferId', true);
                    $data['shiftId'] = $this->input->post('shiftId', true);
                  // print_r($data); die();
                   // $results = $this->CourseofferModleAdmin->duplicateCourseofferInfo($data['programOfferId'],$data['courseId']);

                
                    
               //      $data = $this->input->post('data', TRUE);
             
             $data['periodTime']=getPeriodTime($data['shiftId'],$data['periodId']);
            // print_r($data); die();
          
                $datax['programOfferId'] = $this->input->post('programOfferId', true);
                 $datax['bracktime'] = $this->input->post('bracktime', true);
                $datax['courseId']=$data['courseId'];
                $datax['dayName']=$data['dayName'];
                $datax['periodId']=$data['periodId'];
              //  $this->ClassroutineModleAdmin->addClassroutineInfo($datax);
             
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
                      $data['classroutine'] = 'active';
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
                     $data['classroutine'] = 'active';
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
                       $data['classroutine'] = 'active';
                            $this->load->view('system_path/admin/common/header_link'); // header Css link
                            $this->load->view('system_path/admin/common/header'); // body header
                            $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                            $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                            $this->load->view('system_path/admin/classroutine/findvalue'); // ...........body content page...........
                            $this->load->view('system_path/admin/common/footer'); // footer & script link
                            $this->load->view('system_path/jsquery'); // footer & script link
                        }  
                  elseif ($validation4)
                      {
                    $sdata = array();
                    $sdata['errormessage'] = "Duplicate found for the Value of Class,Section, Medium, Group, Shift, Day, Period..";
                    $this->session->set_userdata($sdata);

                       $this->load->helper(array('form', 'url'));
                        $data['classroutine'] = 'active';
                            $this->load->view('system_path/admin/common/header_link'); // header Css link
                            $this->load->view('system_path/admin/common/header'); // body header
                            $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                            $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                            $this->load->view('system_path/admin/classroutine/findvalue'); // ...........body content page...........
                            $this->load->view('system_path/admin/common/footer'); // footer & script link
                            $this->load->view('system_path/jsquery'); // footer & script link
                        }
                  elseif($validation5)
                      {

                          $sdata = array();
                          $sdata['errormessage'] = "Duplicate found for the Value of Class,Section, Medium, Group, Shift, Day, Subject..";
                          $this->session->set_userdata($sdata);

                          $this->load->helper(array('form', 'url'));
                        $data['classroutine'] = 'active';
                            $this->load->view('system_path/admin/common/header_link'); // header Css link
                            $this->load->view('system_path/admin/common/header'); // body header
                            $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                            $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                            $this->load->view('system_path/admin/classroutine/findvalue'); // ...........body content page...........
                            $this->load->view('system_path/admin/common/footer'); // footer & script link
                            $this->load->view('system_path/jsquery'); // footer & script link
                        }    
                  elseif(!$validation6)
                      {
                           $sdata = array();
                          $sdata['errormessage'] = "This Subject is not Offered for yet for this class ";

                       $this->session->set_userdata($sdata);
                       $this->load->helper(array('form', 'url'));
                       $data['classroutine'] = 'active';
                            $this->load->view('system_path/admin/common/header_link'); // header Css link
                            $this->load->view('system_path/admin/common/header'); // body header
                            $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                            $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                            $this->load->view('system_path/admin/classroutine/findvalue'); // ...........body content page...........
                            $this->load->view('system_path/admin/common/footer'); // footer & script link
                            $this->load->view('system_path/jsquery'); // footer & script link
                        }    

          $this->ClassroutineModleAdmin->addClassroutineInfo($datax);   
     
             } 
           
                 //    $this->ClassroutineModleAdmin->addClassroutineInfo($datax);   
                  
                
             // die();
                $sdata['message'] = 'New Class Routine Successfull inserted';
                $this->session->set_userdata($sdata);

               redirect(admin_Url() . "/classroutine/create_multipleRoutine", 'refresh');
    
    }

}



