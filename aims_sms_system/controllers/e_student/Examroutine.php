<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */

class Examroutine extends MY_Controller{
    public function __construct() {
        parent::__construct();
        $this->student_logged_auth();
        $this->load->model('admin/examroutine/ExamroutineModleAdmin', 'ExamroutineModleAdmin');

        $this->load->model('admin/program/ProgramModleAdmin', 'ProgramModleAdmin');
    }

   
    public function showexamroutine() {

        $username = $this->session->userdata('studentId');
        $info = getstudentNameInfo($username);
       $data['programOfferId']=$info['programOfferId'];
            $data['examroutine']= $this->ExamroutineModleAdmin->select_new_routine($data);
          // print_r($data); die();
            if(!empty($data['examroutine']))
            {
                $data['programinfo']=  getofferProgramInfoById($data['programOfferId']);           
                if(!empty($data['programinfo']))
                {
                    $data['eroutine'] = 'active';       
                    $data['timetable'] = 'active';
                    $this->load->view('system_path/student/common/header_link'); // header Css link
                    $this->load->view('system_path/student/common/header'); // body header
                    $this->load->view('system_path/student/common/side_menu', $data); // side bar menu
                    $this->load->view('system_path/student/examroutine/index', $data); // ...........body content page...........
                    $this->load->view('system_path/student/common/footer'); // footer & script link
                }
                else{
                    $sdata['errormessage'] = "No Routine Found";
                    $this->session->set_userdata($sdata);
                    redirect(student_Url() . "/home");
                }
            }       
            else{
                    $sdata['errormessage'] = "No Routine Found";
                    $this->session->set_userdata($sdata);
                    redirect(student_Url() . "/home");
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
                $this->load->view('system_path/student/common/header_link'); // header Css link
                $this->load->view('system_path/student/examroutine/printexamroutine', $data); // ...........body content page...........
                $this->load->view('system_path/student/common/footer'); // footer & script link  
            }
            else
            {
                $sdata['errormessage'] = 'No Routine Found';
                $this->session->set_userdata($sdata);
                redirect(student_Url() . "/home");
            }      
        } else {
            $sdata['errormessage'] = 'No Routine Found';
            $this->session->set_userdata($sdata);
            redirect(student_Url() . "/home");
        }
    }

    

}