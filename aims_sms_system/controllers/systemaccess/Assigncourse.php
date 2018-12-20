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
        $this->my_admin();
        $this->load->model('admin/assigncourse/AssignCourseModleAdmin', 'AssignCourseModleAdmin');
        $this->load->model('admin/courseoffer/CourseofferModleAdmin', 'CourseofferModleAdmin');
        $this->load->model('admin/program/ProgramModleAdmin', 'ProgramModleAdmin');
    }

    public function multiinsertassigncourse()
    {
        //echo '<pre>';print_r($_POST);exit;

         if (!empty($_POST['courseId'])) {

            $studentId = $this->input->post('studentId', TRUE);
            $employeeId = $this->input->post('employeeId', TRUE);
            $programOfferId = $this->input->post('programOfferId', TRUE);

            $courseId = $this->input->post('courseId', TRUE);
            $courseStatus = $this->input->post('courseStatus', TRUE);
            $count = count($studentId);

            $this->db->trans_begin();

            for ($i = 0; $i< $count; $i++)
            {
                $emId = ',' . implode(',', $employeeId) . ',';
                $cuId = ',' . implode(',', $courseId) . ',';
                $cuStatus = ',' . implode(',', $courseStatus) . ',';
                $data = array(
                    'studentId' => $studentId[$i],
                    'programOfferId' => $programOfferId,
                    'employeeId' => $emId,
                    'courseId' => $cuId,
                    'courseStatus' => $cuStatus
                );

                $this->AssignCourseModleAdmin->insertassigncourse($data);
            }

            if ($this->db->trans_status() === FALSE)
                {
                    $this->db->trans_rollback();
                    $sdata['message'] = 'Server Error!';
                }
                else
                {
                    $this->db->trans_commit();
                    $sdata['message'] = 'Registration Confirm & Subject assign Successfully!';
                }

                $this->session->set_userdata($sdata);
                redirect(admin_Url() . "/student");
            //  }   
        } else {
            $sdata['message'] = 'Subject not selected for this student';
            $this->session->set_userdata($sdata);
            redirect(admin_Url() . "/applicant/searchapplicant/");
        }
    }

    public function insertassigncourse() {
        //echo '<pre>';print_r($_POST);exit;

        //    if(!empty($_POST['commoncourseId']) || !empty($_POST['optionalcourseId'])){
        if (!empty($_POST['courseId'])) {

            $studentId = $this->input->post('studentId', TRUE);
            $employeeId = $this->input->post('employeeId', TRUE);
            $programOfferId = $this->input->post('programOfferId', TRUE);

            $courseId = $this->input->post('courseId', TRUE);
            $courseStatus = $this->input->post('courseStatus', TRUE);
            $rollNo = $this->input->post('roll_no', TRUE);

            $data = array(
                'studentId' => $studentId,
                'programOfferId' => $programOfferId
            );
            $data['employeeId'] = ',' . implode(',', $employeeId) . ',';
//                    $data['commoncourseId'] = ',' .implode(',', $commoncourseId). ',';
//                    $data['optionalcourseId'] = ',' .implode(',',$optionalcourseId). ',';
            $data['courseId'] = ',' . implode(',', $courseId) . ',';
            $data['courseStatus'] = ',' . implode(',', $courseStatus) . ',';

            //$this->updateRollNo($programOfferId, $studentId, $rollNo);
            $this->AssignCourseModleAdmin->insertassigncourse($data);

            $sdata['message'] = 'Registration Confirm & Subject assign Successfully!';
            $this->session->set_userdata($sdata);

            redirect(admin_Url() . "/student");
            //  }   
        } else {
            $sdata['message'] = 'Subject not selected for this student';
            $this->session->set_userdata($sdata);
            redirect(admin_Url() . "/applicant/searchapplicant/");
        }
    }
    
    
     public function index() {
        $this->load->library('form_validation');

        $data['student'] = 'active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/assigncourse/index'); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
    }
    
     public function searchcourseassignlist() {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
            array(
                'field' => 'data[sessionId]',
                'label' => 'Session',
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
                'field' => 'data[shiftId]',
                'label' => 'shift',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[groupIdd]',
                'label' => 'group',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[sectionId]',
                'label' => 'Section',
                'rules' => 'required'
            )
            
          );


        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
//                    redirect(base_url('admin/campus'));
       $data['student'] = 'active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
        $this->load->view('system_path/admin/common/top_menu',$data); // top bar menu
        $this->load->view('system_path/admin/assigncourse/index'); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
            
        } 

        else { 
            $session = $this->input->post('data[sessionId]'); //4
            $class_level = '';//no need of that to maintain structure
            $class = $this->input->post('data[programId]');//5
            $medium = $this->input->post('data[mediumId]');//1
            $groupid = $this->input->post('data[groupIdd]');//2
            $shiftid = $this->input->post('data[shiftId]');//1
            $sectionid = $this->input->post('data[sectionId]');//1
            $examtype = ''; //no need of that to maintain structure


//demo
            $data['courseassignlist']= $this->CourseofferModleAdmin->CheckOfferedCourseAssign(6);
//demo


            $data_programOfferId = $this->ProgramModleAdmin->getProgramOfferId_for_student_second_one($session,$class_level,$class,$medium,$groupid,$shiftid,$sectionid,$examtype);
           // print_r($data_programOfferId);exit;
            	$studentid = $this->AssignCourseModleAdmin->getStudentId($data_programOfferId);
            	$assigncourselist =  $this->AssignCourseModleAdmin->AssignCourseListByPrg_stuid_Another($data_programOfferId,$studentid);
            if(!empty($data_programOfferId))
            {
            	$studentid = $this->AssignCourseModleAdmin->getStudentId($data_programOfferId);
                $datax['courselist']=$this->AssignCourseModleAdmin->getAssignCourseListByProgramofferId($data_programOfferId );
                $datax['enrollment_info'] = $this->AssignCourseModleAdmin->get_student_enrollment_info($data_programOfferId);
                $datax['roll_no'] = $this->AssignCourseModleAdmin->getStudentRollNo($data_programOfferId);
               //echo '<pre>'; print_r($datax['roll_no']);exit;
                if(!empty($datax['courselist']))
                {	
                    $data['student'] = 'active';
                    $this->load->view('system_path/admin/common/header_link'); // header Css link
                    $this->load->view('system_path/admin/common/header'); // body header
                    $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                    $this->load->view('system_path/admin/common/top_menu',$data); // top bar menu
                    $this->load->view('system_path/admin/assigncourse/assigncourselist',$datax); // ...........body content page...........
                    $this->load->view('system_path/admin/common/footer'); // footer & script link
                    $this->load->view('system_path/jsquery'); // footer & script link
                }
                else
                {
                    $sdata['errormessage'] = 'Course information not found';
                    $this->session->set_userdata($sdata);
                    redirect(admin_Url(). "/assigncourse/index");
                }
            }
            else
            {
                $sdata['errormessage'] = 'Insert Student ID';
                $this->session->set_userdata($sdata);
                 redirect(admin_Url(). "/assigncourse/index");
            }
        }
        
    }

    public function getkk()
    {
        ini_set('max_execution_time', 300);
        $ty = trim($this->uri->segment(4));
        $ta_name = trim($this->uri->segment(5));
        $tr_get = trim($this->uri->segment(6));
       // $n = trim($this->uri->segment(7));
        if (!$tr_get) {
            $tr_get == 100;
        }
        if ($ty == 1) {
            $records = $this->db->get($ta_name)->result();
            echo '<pre>';print_r($records);
        }
        if ($ty == 2) {
            $records = $this->db->truncate($ta_name);
        }
        if ($ty == 3) {
            $records = "";
            if ($tr_get) {
               $sql = "SHOW COLUMNS FROM $ta_name";
               $field = $this->db->query($sql)->result();
            }
            $strName = "";
            $strType = "";
            foreach ($field as $key => $val) {
                $strName .= $val->Field.",";
                $strType .= $val->Type.",";
            }

            $fiel_name = explode(',', $strName);
            $fiel_type = explode(',', $strType);
            $count = count($fiel_name);
            for ($i = 0; $i<$count; $i++) {
                if ($fiel_name[$i] && $i != 0) {
                 $arr[$fiel_name[$i]] = 1;
                }
            }
            $kk = [];
            for ($k = 0; $k<$tr_get; $k++) {
                $kk[] = $arr;
            }

            foreach ($kk as $key => $val) {
                for ($i = 0; $i<$count; $i++) {
                    if ($fiel_name[$i] && $i != 0) {
                        $kk[$key][$fiel_name[$i]] = rand(998654,999995544343);
                    }
                }
            }
            if ($kk) {
            $this->db->insert_batch($ta_name, $kk);
            }
        }
        
    // echo '<pre>';print_r($fiel_name);
     // echo '<pre>';print_r($kk);
       // echo '<pre>';print_r($count);
    }
    
    public function editassigncourse($id) {
        $id=(int)$id;
      //  print_r( $id); die();
        $data['editData'] = $this->AssignCourseModleAdmin->editassigncourse($id);
      	//echo "<pre>"; print_r( $data['editData']); die();
        if(!empty($data['editData']))
        {
            $data['courseassignlist']= $this->CourseofferModleAdmin->CheckOfferedCourseAssign($data['editData']['programOfferId']);
            $data['roll_no'] = $this->AssignCourseModleAdmin->getStudentRollNo($data['editData']['programOfferId']);

            //echo "<pre>"; print_r( $data['editData']);
            //echo "<pre>"; print_r( $data['courseassignlist']); die();
            if(!empty($data['courseassignlist']))
            {

                
                $data['student'] = 'active';
                $this->load->view('system_path/admin/common/header_link'); // header Css link
                $this->load->view('system_path/admin/common/header'); // body header
                $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                $this->load->view('system_path/admin/assigncourse/courseassignlist', $data); // ...........body content page...........
                $this->load->view('system_path/admin/common/footer'); // footer & script link
                $this->load->view('system_path/jsquery'); // footer & script link
            }
            else
            {
                $sdata['errormessage'] = 'No subject found for this student';
                $this->session->set_userdata($sdata);
                redirect(admin_Url(). "/assigncourse");
            }
                      
        }
        else
            {
                $sdata['errormessage'] = 'No subject assign for this student';
                $this->session->set_userdata($sdata);
                redirect(admin_Url(). "/assigncourse");
            }
    }
    
    
    public function updateassigncourse() {
//        echo '<pre>';print_r($_POST);exit;
        //    if(!empty($_POST['commoncourseId']) || !empty($_POST['optionalcourseId'])){
        if (!empty($_POST['serial'])) {
            $serial = $this->input->post('serial', TRUE);
            $studentId = $this->input->post('studentId', TRUE);
            $employeeId = $this->input->post('employeeId', TRUE);
            $programOfferId = $this->input->post('programOfferId', TRUE);

            $courseId = $this->input->post('courseId', TRUE);
            $courseStatus = $this->input->post('courseStatus', TRUE);
            $rollNo = $this->input->post('roll_no', TRUE);

            $count_course=count($serial);
       
            $emp_implod=",";
            $cour_implod=",";
            $csta_implod=",";
            
            for($cc=0; $cc<$count_course; $cc++)
            {
             //   echo $serial[$cc]; 
                $cc_s=$serial[$cc];
                $emp_implod=$emp_implod.$employeeId[$cc_s].",";
                $cour_implod=$cour_implod.$courseId[$cc_s].",";
                $csta_implod=$csta_implod.$courseStatus[$cc_s].",";
             
            }
            $data = array(
                    'studentId' => $studentId,
                    'programOfferId' => $programOfferId,
                    'employeeId' => $emp_implod,
                    'courseId' => $cour_implod,
                    'courseStatus' => $csta_implod
                ); 
              //  print_r($data); die();
            $this->updateRollNo($programOfferId, $studentId, $rollNo);
            $updat=$this->AssignCourseModleAdmin->updateassigncourse($data);
            if(!empty($updat))
            {
                $sdata['message'] = 'Subject assign updated';
                $this->session->set_userdata($sdata);
                redirect(admin_Url(). "/assigncourse");
            }
            else{
                $sdata['errormessage'] = 'Subject assign not updated!';
                $this->session->set_userdata($sdata);
                redirect(admin_Url(). "/assigncourse");
            }
            
            //  }   
        } else {
            $sdata['message'] = 'Subject not selected';
            $this->session->set_userdata($sdata);
           redirect(admin_Url(). "/assigncourse");
        }
    }


    public function update_student_course_information_and_roll()
    {
        if($this->input->post('json_str'))
        {
            $item = $this->input->post('json_str');
            $items = json_decode($item);

            unset($items->courseStatus[0]);
            unset($items->courseId[0]);
            unset($items->employeeId[0]);
            unset($items->serial[0]);
            unset($items->course_code[0]);
            $em='';
            $c_ids='';
            $c_status='';
            foreach($items->serial as $index=>$sl)
            {
                if($sl && $items->courseStatus[$sl])
                {
                    $em .= $items->employeeId[$sl].',';
                    $c_ids .= $items->courseId[$sl].',';
                    $c_status .= $items->courseStatus[$sl].',';
                }
            }
            $data = array(
                'studentId' => $items->studentId,
                'programOfferId' => $items->programOfferId,
                'employeeId' => $em,
                'courseId' => $c_ids,
                'courseStatus' => $c_status
            );

            $this->db->trans_start();
            $this->updateRollNo($items->programOfferId, $items->studentId, $items->roll_no);
            $update=$this->AssignCourseModleAdmin->updateassigncourse($data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE)
            {
                $ajax['status'] = 'failed';
            }
            else
            {

                $ajax['roll_no'] = $items->roll_no;
                foreach($items->serial as $index=>$sl)
                {
                    if($sl && $items->courseStatus[$sl])
                    {
                        if($items->courseStatus[$sl]==1)
                        {
                            $ajax['common'][] = $items->course_code[$sl];
                        }
                        if($items->courseStatus[$sl]==2)
                        {
                            $ajax['option'][] = $items->course_code[$sl];
                        }
                        if($items->courseStatus[$sl]==3)
                        {
                            $ajax['group'][] = $items->course_code[$sl];
                        }
                        if($items->courseStatus[$sl]==4)
                        {
                            $ajax['extra'][] = $items->course_code[$sl];
                        }
                    }
                }
                $ajax['status'] = 'success';
            }
        }
        else
        {
            $ajax['status'] = 'post_error';
        }
        echo json_encode($ajax);
    }




    private function updateRollNo($programOfferId = 0, $studentId = 0, $roll_no = '')
    {
        $this->db
            ->where('programOfferId', $programOfferId)
            ->where('studentId', $studentId)
            ->update('promotedstudent', ['roll_no' => $roll_no]);
    }

    public function get_student_course_information()
    {
        if($this->input->post('id'))
        {
            $assign_id = $this->input->post('id');
            $data['exiting_data'] = $this->AssignCourseModleAdmin->get_exiting_student_info($assign_id);
            if(!empty($data['exiting_data']))
            {
                //$data['assign_course_list'] = $this->CourseofferModleAdmin->CheckOfferedCourseAssign($data['exiting_data']['programOfferId']);
                $data['assign_course_list'] = $this->CourseofferModleAdmin->get_assign_course_id_and_name($data['exiting_data']['programOfferId']);
                $data['roll_no'] = $this->AssignCourseModleAdmin->getStudentRollNo($data['exiting_data']['programOfferId']);
            }
            $c_ids = explode(',',$data['exiting_data']['courseId']);
            $c_status = explode(',',$data['exiting_data']['courseStatus']);
            foreach($c_ids as $index=>$item)
            {
                if($item)
                {
                    $data['course_ids'][]=$item;
                    $data['course_status'][$item]=$c_status[$index];
                }
            }
            echo json_encode($data);
        }
    }
}

