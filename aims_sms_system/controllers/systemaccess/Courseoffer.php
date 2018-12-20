<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */

class Courseoffer extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->my_admin();
        $this->load->model('admin/courseoffer/CourseofferModleAdmin', 'CourseofferModleAdmin');
        $this->load->model('admin/course/CourseModleAdmin', 'CourseModleAdmin');
        $this->load->model('admin/program/ProgramModleAdmin', 'ProgramModleAdmin');
        $this->load->model('admin/institute/InstituteModleAdmin', 'InstituteModleAdmin');
        $this->load->model('admin/student/StudentModleAdmin', 'StudentModleAdmin');
        $this->load->model('admin/examroutine/ExamroutineModleAdmin', 'ExamroutineModleAdmin');

    }

    public function index() {
        $data['subffer'] = 'active';
        $data['subjectoffer'] = 'active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu'); // top bar menu
        $this->load->view('system_path/admin/courseoffer/index', $data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
    }

    public function selectcourseofferlist() {

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
            array(
                'field' => 'data[sessionId]',
                'label' => 'Category Name',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[programLevel]',
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

            $data['subffer'] = 'active';
            $data['subjectofferlist'] = 'active';
            $this->load->view('system_path/admin/common/header_link'); // header Css link
            $this->load->view('system_path/admin/common/header'); // body header
            $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
            $this->load->view('system_path/admin/common/top_menu'); // top bar menu
            $this->load->view('system_path/admin/courseoffer/corseoffersercetest', $data); // ...........body content page...........
            $this->load->view('system_path/admin/common/footer'); // footer & script link
            $this->load->view('system_path/jsquery'); // footer & script link
        } else{
            // $data = $this->input->post('data', TRUE);
            $session = $this->input->post('data[sessionId]'); //4
            $class_level = $this->input->post('data[programLevel]'); //4
            $class = $this->input->post('data[programId]'); //5
            $medium = $this->input->post('data[mediumId]'); //1
            $groupid = $this->input->post('data[groupIdd]'); //2
            $shiftid = $this->input->post('data[shiftId]');//1
            $sectionid = $this->input->post('data[sectionId]');//1

            $data_programOfferId = $this->ProgramModleAdmin->getProgramOfferIdStudent($session,$class_level,$class,$medium,$groupid,$shiftid,$sectionid);

            if (!empty($data_programOfferId)) {
                $id = $class_level;
                $data['student_programOfferId'] = $data_programOfferId;
                $data['enrolment_info'] = $this->CourseModleAdmin->get_student_enrollment_info($data_programOfferId);
                $data['courselist'] = $this->CourseModleAdmin->getCourseListBYPrglevelId($id);
                //echo "<pre>";
                // print_r($data['courselist']);die();

                $data['courseofferlist'] = $this->ProgramModleAdmin->getOfferedProgramListt($data_programOfferId);
                $data['allcourseofferlist'] = $this->CourseModleAdmin->getOfferedProgramallList($data_programOfferId);
                $data['teacher_nd_marks'] = $this->CourseofferModleAdmin->search_specific_course_details($data_programOfferId);
                $data['all_teacher_list'] = $this->CourseofferModleAdmin->search_all_teacher_list();
                // echo "<pre>";
                //  print_r($data['all_teacher_list']);die();

                $data['subffer'] = 'active';
                $data['subjectofferlist'] = 'active';
                $this->load->view('system_path/admin/common/header_link'); // header Css link
                $this->load->view('system_path/admin/common/header'); // body header
                $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
                $this->load->view('system_path/admin/common/top_menu'); // top bar menu
                $this->load->view('system_path/admin/courseoffer/corseoffersercetest', $data); // ...........body content page...........
                $this->load->view('system_path/admin/common/footer'); // footer & script link
                $this->load->view('system_path/jsquery'); // footer & script link
            } else {

                $sdata['errormessage'] = "Under this enrollment information class not offered yet";
                $this->session->set_userdata($sdata);
                redirect(admin_Url() . "/courseoffer", 'refresh');
            }
        }
    }


    public function insertCourseoffer() {
        $sdata = [];
        $serial = $this->input->post('serial');
        $employeeId = $this->input->post('employeeId');
        $courseId = $this->input->post('courseId');
        $marks = $this->input->post('marks');
        if (!empty($serial)) {
            $count = count($serial);
            for ($i = 0; $i < $count; $i++) {

                $data = [
                    'employeeId' => (int)$employeeId[$i],
                    'courseId' => $courseId[$i],
                    'marks' => $marks[$i],
                    'status' => $this->input->post('status', true),
                    'programOfferId' => $this->input->post('programOfferId', true)
                ];

                $results = $this->CourseofferModleAdmin->duplicateCourseofferInfo($data);

                if (!$results) {
                    $this->CourseofferModleAdmin->addCourseofferInfo($data);
                }
            }
            $sdata['message'] = 'Subject Offer Successfull inserted';
            $this->session->set_userdata($sdata);
            redirect(admin_Url() . "/courseoffer", 'refresh');
        } else {
            $sdata['errormessage'] = 'Course Information not found';
            $this->session->set_userdata($sdata);

            redirect(admin_Url() . "/courseoffer", 'refresh');
        }
    }

    public function oldinsertCourseoffer() {

        $programOfferId = $this->input->post('programOfferId');
        // print_r($data); die();
        if (!empty($programOfferId)) {

            $serial = $this->input->post('serial');
            $employeeId = $this->input->post('employeeId');
            $courseId = $this->input->post('courseId');
            $marks = $this->input->post('marks');
            //  print_r($serial); die();
            if (!empty($serial)) {
                $ab = $serial;

                for ($i = 0; $i < count($ab); $i++) {

                    $find_value = $serial[$i] - 1;

                    $data['employeeId'] = $employeeId[$find_value];
                    $data['courseId'] = $courseId[$find_value];
                    $data['marks'] = $marks[$find_value];
                    //  $data['employeeId'] = $employeeId[$find_value];

                    $data['status'] = $this->input->post('status', true);
                    $data['programOfferId'] = $this->input->post('programOfferId', true);
                    //  $data['attendanceDate'] = $this->input->post('attendanceDate', true);  


                    $sdata = array();
                    $validation = $this->CourseofferModleAdmin->duplicateCourseofferInfo($data);

                    if ($validation) {
                        $sdata['errormessage'] = 'Inserted subject offer information is already offered..';
                        $this->session->set_userdata($sdata);
                        redirect(admin_Url() . "/courseoffer", 'refresh');
                    } elseif ($results == FALSE) {
                        //   print_r($data);
                        $this->CourseofferModleAdmin->addCourseofferInfo($data);

                        $sdata['message'] = 'Subject Offered Successfully';
                        $this->session->set_userdata($sdata);
                        redirect(admin_Url() . "/courseoffer", 'refresh');
                    }
                }
            }
        } else {

            $sdata['errormessage'] = "Under this enrollment information class not offered yet";
            $this->session->set_userdata($sdata);
            redirect(admin_Url() . "/courseoffer", 'refresh');
        }
    }

    public function courseOfferlist() {

        $data['subffer'] = 'active';
        $data['subjectofferlist'] = 'active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu'); // top bar menu
        $this->load->view('system_path/admin/courseoffer/courseoffersearch', $data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
    }

    public function merge_subjects(){

        $data['merge_subjects'] = $this->ProgramModleAdmin->get_merge_subjects();
        //echo "<pre>";print_r($data);die();
        $data['subffer'] = 'active';
        $data['mergesubjects'] = 'active';
        //$data['course_name'] = $this->CourseofferModleAdmin->get_courses();
        //$data['courseName'] = $this->CourseofferModleAdmin->get_courses();
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu'); // top bar menu
        $this->load->view('system_path/admin/courseoffer/merge_subjects', $data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
    }

    public function getsubjectNames(){
        $session = $this->input->post('session_val');//4
        $classlvl = $this->input->post('classlvl_val');//4
        $class = $this->input->post('class_student_val');//5
        $medium = $this->input->post("medium_val"); //1
        $group = $this->input->post('group_val'); //2
        $shift = $this->input->post('shift_val'); //1
        $section = $this->input->post('section_val');//1

        $data_programOfferId = $this->ProgramModleAdmin->getProgramOfferId_For_Subject($session,$classlvl,$class,$medium,$group,$shift,$section); //28
        if(!empty($data_programOfferId)){
            $data['assigned_courses'] = $this->ProgramModleAdmin->get_assigned_subjects($data_programOfferId);
            //log_message('error','tanay syed '.print_r($data['assigned_courses'],true));exit();
            $course = " ";
            foreach ($data['assigned_courses'] as $list) {
                $course.=  "<option value=\"".$list['courseId']."\">".$list['courseName']."</option>";
            }
            echo "<option value=\"\">Select</option>".$course;
        }else{
            echo "No Subjects Offered";
        }
    }

    public function save_merge_info(){
        $this->load->library('form_validation');
        $this->load->helper(array('url','form'));
        $config = array(
            array(
                'field'=>'data[sessionId]',
                'label'=>'Session',
                'rules'=>'required'
            ),
            array(
                'field'=>'data[programLevel]',
                'label'=>'Program Level',
                'rules'=>'required'
            ),
            array(
                'field'=>'data[programId]',
                'label'=>'Program Id',
                'rules'=>'required'
            ),
            array(
                'field'=>'data[mediumId]',
                'label'=>'Medium',
                'rules'=>'required'
            ),
            array(
                'field'=>'data[groupIdd]',
                'label'=>'Group',
                'rules'=>'required'
            ),
            array(
                'field'=>'data[shiftId]',
                'label'=>'Shift',
                'rules'=>'required'
            ),
            array(
                'field'=>'data[sectionId]',
                'label'=>'Section',
                'rules'=>'required'
            ),
            array(
                'field'=>'data[getnewsubName]',
                'label'=>'New Subject',
                'rules'=>'required'
            ),
            array(
                'field'=>'data[getfirstSubject]',
                'label'=>'First Subject',
                'rules'=>'required'
            ),
            array(
                'field'=>'data[getsecondSubject]',
                'label'=>'Second Subject',
                'rules'=>'required'
            )
        );

        $this->form_validation->set_rules($config);
        if($this->form_validation->run() == FALSE){
            $data['mergesubjects'] = 'active';
            $this->load->view('system_path/admin/common/header_link'); // header Css link
            $this->load->view('system_path/admin/common/header'); // body header
            $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
            $this->load->view('system_path/admin/common/top_menu'); // top bar menu
            $this->load->view('system_path/admin/courseoffer/merge_subjects', $data); // ...........body content page...........
            $this->load->view('system_path/admin/common/footer'); // footer & script link
            $this->load->view('system_path/jsquery'); // footer & script link
        }else{

            $data = $this->input->post('data',TRUE);
            $data_programOfferId = $this->ProgramModleAdmin->getProgramOfferedIdForMerge($data);//36
            $data['merged_course_info'] = $this->ProgramModleAdmin->insert_merged_course_info($data,$data_programOfferId);
            $data['mergesubjects'] = 'active';
            $sdata['success_message'] = "Data Inserted Successfully";
            $data['merge_subjects'] = $this->ProgramModleAdmin->get_merge_subjects();
            $this->load->view('system_path/admin/common/header_link'); // header Css link
            $this->load->view('system_path/admin/common/header'); // body header
            $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
            $this->load->view('system_path/admin/common/top_menu'); // top bar menu
            $this->load->view('system_path/admin/courseoffer/merge_subjects', $data); // ...........body content page...........
            $this->load->view('system_path/admin/common/footer'); // footer & script link
            $this->load->view('system_path/jsquery'); // footer & script link
        }
    }

    public function admitcard(){

        // $data['examtype'] = $this->CourseModleAdmin->get_exam_type();
        $data['semestertype'] = $this->CourseModleAdmin->get_semester_type();
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
        $this->load->view('system_path/admin/common/top_menu'); // top bar menu
        $this->load->view('system_path/admin/courseoffer/admit_card',$data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
    }

    public function searchadmitcard(){
        $this->load->library('form_validation');
        $this->load->helper(array('url','form'));

        $session = $this->input->post('data[sessionId]'); //4
        $class_level = $this->input->post('data[programLevel]'); //4
        $class = $this->input->post('data[programId]'); //5
        $medium = $this->input->post('data[mediumId]'); //1
        $groupid = $this->input->post('data[groupIdd]'); //2
        $shiftid = $this->input->post('data[shiftId]');//1
        $sectionid = $this->input->post('data[sectionId]');//1
        $semestertype = $this->input->post('data[semestertype]');//4
        // $examtype = $this->input->post('data[examtype]');//4

        $config = array(
            array(
                'field'=>'data[sessionId]',
                'label'=>'Session',
                'rules'=>'required'
            ),
            array(
                'field'=>'data[programLevel]',
                'label'=>'ClassLevel',
                'rules'=>'required'
            ),
            array(
                'field'=>'data[programId]',
                'label'=>'Class',
                'rules'=>'required'
            ),
            array(
                'field'=>'data[mediumId]',
                'label'=>'Medium',
                'rules'=>'required'
            ),
            array(
                'field'=>'data[shiftId]',
                'label'=>'Shift',
                'rules'=>'required'
            ),
            array(
                'field'=>'data[groupIdd]',
                'label'=>'Group',
                'rules'=>'required'
            ),
            array(
                'field'=>'data[sectionId]',
                'label'=>'Section',
                'rules'=>'required'
            ),
            array(
                'field'=>'data[semestertype]',
                'label'=>'Semester Type',
                'rules'=>'required'
            )
        );
        $this->form_validation->set_rules($config);
        if($this->form_validation->run() == FALSE){
            $data['result'] = 'active';
            $this->load->view('system_path/admin/common/header_link'); // header Css link
            $this->load->view('system_path/admin/common/header'); // body header
            $this->load->view('system_path/admin/common/side_menu',$data); // side bar menu
            $this->load->view('system_path/admin/common/top_menu'); // top bar menu
            $this->load->view('system_path/admin/courseoffer/admit_card', $data); // ...........body content page...........
            $this->load->view('system_path/admin/common/footer'); // footer & script link
            $this->load->view('system_path/jsquery'); // footer & script link
        }else{

            $data_programOfferId = $this->ProgramModleAdmin->getProgramOfferId_for_student($session,$class_level,$class,$medium,$groupid,$shiftid,$sectionid,$semestertype); //22


            if(!empty($data_programOfferId)){
                $data['studentinfo'] = $this->CourseModleAdmin->get_student_information($data_programOfferId);
                //echo "<pre>";print_r( $data['studentinfo']);die();
                $data['other_basic_info'] = $this->CourseModleAdmin->get_student_other_informations($data_programOfferId);

                $data['institute_details'] = $this->InstituteModleAdmin->getInstituteDetailedInfo();
                $data['exam_routine'] = $this->ExamroutineModleAdmin->get_exam_routine_in_admit_card($data_programOfferId,$semestertype);

                $data['semester_type'] = $semestertype;

                //echo $data['semester_type'];exit;


                $this->load->view('system_path/admin/common/header_link'); // header Css link
                $this->load->view('system_path/admin/common/header'); // body header
                $this->load->view('system_path/admin/common/side_menu',$data); // side bar menu
                $this->load->view('system_path/admin/common/top_menu'); // top bar menu
                $this->load->view('system_path/admin/courseoffer/admitcard_details',$data); // ...........body content page...........
                $this->load->view('system_path/admin/common/footer'); // footer & script link
                $this->load->view('system_path/jsquery'); // footer & script link
            }else{
                echo "Nothing Found";
            }

        }
    }

    public function seatplan(){
        //$data['examtype'] = $this->CourseModleAdmin->get_exam_type();
        $data['semestertype'] = $this->CourseModleAdmin->get_semester_type();
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
        $this->load->view('system_path/admin/common/top_menu'); // top bar menu
        $this->load->view('system_path/admin/courseoffer/seat_plan',$data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
    }

    public function searchseatplan(){
        $this->load->library('form_validation');
        $this->load->helper(array('url','form'));

        $session = $this->input->post('data[sessionId]'); //4
        $class_level = $this->input->post('data[programLevel]'); //4
        $class = $this->input->post('data[programId]'); //5
        $medium = $this->input->post('data[mediumId]'); //1
        $groupid = $this->input->post('data[groupIdd]'); //2
        $shiftid = $this->input->post('data[shiftId]');//1
        $sectionid = $this->input->post('data[sectionId]');//1
        $semestertype = $this->input->post('data[semestertype]');//4
        // $examtype = $this->input->post('data[examtype]');//4

        $config = array(
            array(
                'field'=>'data[sessionId]',
                'label'=>'Session',
                'rules'=>'required'
            ),
            array(
                'field'=>'data[programLevel]',
                'label'=>'ClassLevel',
                'rules'=>'required'
            ),
            array(
                'field'=>'data[programId]',
                'label'=>'Class',
                'rules'=>'required'
            ),
            array(
                'field'=>'data[mediumId]',
                'label'=>'Medium',
                'rules'=>'required'
            ),
            array(
                'field'=>'data[groupIdd]',
                'label'=>'Group',
                'rules'=>'required'
            ),
            array(
                'field'=>'data[shiftId]',
                'label'=>'Shift',
                'rules'=>'required'
            ),
            array(
                'field'=>'data[sectionId]',
                'label'=>'Section',
                'rules'=>'required'
            ),
            array(
                'field'=>'data[semestertype]',
                'label'=>'Semester Type',
                'rules'=>'required'
            )

        );
        $this->form_validation->set_rules($config);
        if($this->form_validation->run() == FALSE){
            $data['result'] = 'active';
            $this->load->view('system_path/admin/common/header_link'); // header Css link
            $this->load->view('system_path/admin/common/header'); // body header
            $this->load->view('system_path/admin/common/side_menu',$data); // side bar menu
            $this->load->view('system_path/admin/common/top_menu'); // top bar menu
            $this->load->view('system_path/admin/courseoffer/seat_plan', $data); // ...........body content page...........
            $this->load->view('system_path/admin/common/footer'); // footer & script link
            $this->load->view('system_path/jsquery'); // footer & script link
        }else{
            $data_programOfferId = $this->ProgramModleAdmin->getProgramOfferId_for_student($session,$class_level,$class,$medium,$groupid,$shiftid,$sectionid,$semestertype); //22

            if(!empty($data_programOfferId)){
                $data['studentinfo'] = $this->CourseModleAdmin->get_student_information($data_programOfferId);
                $data['other_basic_info'] = $this->CourseModleAdmin->get_student_other_informations($data_programOfferId);
                $data['institute_details'] = $this->InstituteModleAdmin->getInstituteDetailedInfo();
                $data['semester_type'] = $semestertype;
                $this->load->view('system_path/admin/common/header_link'); // header Css link
                $this->load->view('system_path/admin/common/header'); // body header
                $this->load->view('system_path/admin/common/side_menu',$data); // side bar menu
                $this->load->view('system_path/admin/common/top_menu'); // top bar menu
                $this->load->view('system_path/admin/courseoffer/seat_plan_detail',$data); // ...........body content page...........
                $this->load->view('system_path/admin/common/footer'); // footer & script link
                $this->load->view('system_path/jsquery'); // footer & script link
            }else{
                echo "Nothing Found";
            }

        }
    }

    public function student_idcard(){
        $data['semestertype'] = $this->CourseModleAdmin->get_semester_type();
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
        $this->load->view('system_path/admin/common/top_menu'); // top bar menu
        $this->load->view('system_path/admin/courseoffer/id_card',$data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
    }

    public function search_idcard(){
        $this->load->library('form_validation');
        $this->load->helper(array('url','form'));

        $session = $this->input->post('data[sessionId]'); //4
        $class_level = $this->input->post('data[programLevel]'); //4
        $class = $this->input->post('data[programId]'); //5
        $medium = $this->input->post('data[mediumId]'); //1
        $groupid = $this->input->post('data[groupIdd]'); //2
        $shiftid = $this->input->post('data[shiftId]');//1
        $sectionid = $this->input->post('data[sectionId]');//1
        $semestertype = $this->input->post('data[semestertype]');//4

        $config = array(
            array(
                'field'=>'data[sessionId]',
                'label'=>'Session',
                'rules'=>'required'
            ),
            array(
                'field'=>'data[programLevel]',
                'label'=>'ClassLevel',
                'rules'=>'required'
            ),
            array(
                'field'=>'data[programId]',
                'label'=>'Class',
                'rules'=>'required'
            ),
            array(
                'field'=>'data[mediumId]',
                'label'=>'Medium',
                'rules'=>'required'
            ),
            array(
                'field'=>'data[groupIdd]',
                'label'=>'Group',
                'rules'=>'required'
            ),
            array(
                'field'=>'data[shiftId]',
                'label'=>'Shift',
                'rules'=>'required'
            ),
            array(
                'field'=>'data[sectionId]',
                'label'=>'Section',
                'rules'=>'required'
            )
        );
        $this->form_validation->set_rules($config);
        if($this->form_validation->run() == FALSE){
            $data['result'] = 'active';
            $this->load->view('system_path/admin/common/header_link'); // header Css link
            $this->load->view('system_path/admin/common/header'); // body header
            $this->load->view('system_path/admin/common/side_menu',$data); // side bar menu
            $this->load->view('system_path/admin/common/top_menu'); // top bar menu
            $this->load->view('system_path/admin/courseoffer/id_card', $data); // ...........body content page...........
            $this->load->view('system_path/admin/common/footer'); // footer & script link
            $this->load->view('system_path/jsquery'); // footer & script link
        }else{
            $data_programOfferId = $this->ProgramModleAdmin->getProgramOfferId_for_student($session,$class_level,$class,$medium,$groupid,$shiftid,$sectionid); //22

            if(!empty($data_programOfferId)){
                $data['studentinfo'] = $this->CourseModleAdmin->get_student_information($data_programOfferId);
                $data['other_basic_info'] = $this->CourseModleAdmin->get_student_other_informations($data_programOfferId);
                $data['institute_details'] = $this->InstituteModleAdmin->getInstituteDetailedInfo();

                $this->load->view('system_path/admin/common/header_link'); // header Css link
                $this->load->view('system_path/admin/common/header'); // body header
                $this->load->view('system_path/admin/common/side_menu',$data); // side bar menu
                $this->load->view('system_path/admin/common/top_menu'); // top bar menu
                $this->load->view('system_path/admin/courseoffer/idcard_details',$data); // ...........body content page...........
                $this->load->view('system_path/admin/common/footer'); // footer & script link
                $this->load->view('system_path/jsquery'); // footer & script link
            }else{
                echo "Nothing Found";
            }

        }
    }


    public function searchcourseofferlist() {
        // $data = $this->input->post('data', TRUE);
        $session = $this->input->post('data[sessionId]'); //4
        $class_level = $this->input->post('data[programLevel]');//4
        $class = $this->input->post('data[programId]');//5
        $medium = $this->input->post('data[mediumId]');//1
        $groupid = $this->input->post('data[groupIdd]');//2
        $shiftid = $this->input->post('data[shiftId]');//1
        $sectionid = $this->input->post('data[sectionId]');//1
        $examtype = "hlw"; //not needed ...Just To Maintain The Structure Of The Model.......
        $data_programOfferId = $this->ProgramModleAdmin->getProgramOfferId_for_student_second_one($session,$class_level,$class,$medium,$groupid,$shiftid,$sectionid,$examtype); //22

        if (!empty($data_programOfferId)) {
            $data['courseofferlist'] = $this->CourseofferModleAdmin->searchcourseofferlist($data_programOfferId);
            $data['class_information'] = $this->ProgramModleAdmin->search_class_information($data_programOfferId);
            if (!empty($data['courseofferlist'])) {
                $data['subffer'] = 'active';
                $data['subjectofferlist'] = 'active';
                $this->load->view('system_path/admin/common/header_link'); // header Css link
                $this->load->view('system_path/admin/common/header'); // body header
                $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
                $this->load->view('system_path/admin/common/top_menu'); // top bar menu
                $this->load->view('system_path/admin/courseoffer/courseofferlist', $data); // ...........body content page...........
                $this->load->view('system_path/admin/common/footer'); // footer & script link
                $this->load->view('system_path/jsquery'); // footer & script link
            } else {
                $sdata = array();
                $sdata['message'] = "No Result Found";
                $this->session->set_userdata($sdata);
                redirect(admin_Url() . "/courseoffer/courseOfferlist", 'refresh');
            }
        } else {
            $sdata = array();
            $sdata['message'] = "Under this enrollment information Subject not offered yet";
            $this->session->set_userdata($sdata);
            redirect(admin_Url() . "/courseoffer/courseOfferlist", 'refresh');
        }
    }

    public function editcourseoffer($id) {

        $id = (int) $id;
        $data['editData'] = $this->CourseofferModleAdmin->editCourseofferInfo($id);
        //    print_r($data);die();
        if (!empty($data['editData'])) {
            $data['subffer'] = 'active';
            $data['subjectofferlist'] = 'active';
            $this->load->view('system_path/admin/common/header_link'); // header Css link
            $this->load->view('system_path/admin/common/header'); // body header
            $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
            $this->load->view('system_path/admin/common/top_menu'); // top bar menu
            $this->load->view('system_path/admin/courseoffer/editcourseoffer', $data); // ...........body content page...........
            $this->load->view('system_path/admin/common/footer'); // footer & script link
            $this->load->view('system_path/jsquery'); // footer & script link
        } else {
            $sdata = array();
            $sdata['errormessage'] = "No Result Found";
            $this->session->set_userdata($sdata);
            redirect(admin_Url() . "/courseoffer/courseOfferlist", 'refresh');
        }
    }

    public function updatecourseoffer($id) {

        $data = $this->input->post('data', TRUE);

        $data['programOfferId'] = getProgramOfferId($data);

        //print_r($data); die();
        if (!empty($data['programOfferId'])) {

            $datax = array(
                'programOfferId' => $data['programOfferId']['programOfferId'],
                'employeeId' => $data['employeeId'],
                'courseId' => $data['courseId'],
                'marks' => $data['marks'],
                'status' => $data['status']
            );
            $this->CourseofferModleAdmin->updateCourseofferInfo($datax, $id);
            $sdata['message'] = 'Updated Subject Offered';
            $this->session->set_userdata($sdata);

            redirect(admin_Url() . "/courseoffer/courseOfferlist", 'refresh');
            // }
        } else {
            $sdata['errormessage'] = "Under this enrollment information class not offered yet";
            $this->session->set_userdata($sdata);
            redirect(admin_Url() . "/courseoffer/courseOfferlist", 'refresh');
        }
    }

    public function deletecourseoffer($id) {


        $this->CourseofferModleAdmin->deleteCourseofferInfo($id);
        $sdata['message'] = 'Subject Offered Deleted';
        $this->session->set_userdata($sdata);

        redirect(admin_Url() . "/courseoffer/courseOfferlist", 'refresh');
    }

    public function delete_merge_course($id) {

        $this->ProgramModleAdmin->delete_merge_course($id);
        $sdata['message'] = 'Merge Subject Deleted';
        $this->session->set_userdata($sdata);

        redirect(admin_Url() . "/courseoffer/merge_subjects", 'refresh');
    }

    public function markcatagory() {
        $data['subffer'] = 'active';
        $data['markcatagory'] = 'active';
        $data['markcategorylist'] = $this->CourseofferModleAdmin->getmarkcategoryList();
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/mark/index', $data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
    }

    public function insertcategory() {
        // print_r($_POST);
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
            array(
                'field' => 'data[category_title]',
                'label' => 'Category Name',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {

            redirect(admin_Url() . "/courseoffer/markcatagory");
        } else {
            $data = $this->input->post('data', TRUE);
            $result = $this->CourseofferModleAdmin->duplicatemarkcategoryInfo($data);

            if (!$result) {
                $this->CourseofferModleAdmin->addmarkcategoryInfo($data);
                $sdata['message'] = 'Successfull!';
                $this->session->set_userdata($sdata);

                redirect(admin_Url() . "/courseoffer/markcatagory");
            } else {
                $sdata = array();
                $sdata['errormessage'] = 'Duplicate Entry Found!';
                $this->session->set_userdata($sdata);

                redirect(admin_Url() . "/courseoffer/markcatagory");
            }
        }
    }

    public function editmarkcategory($id) {

        $data['editData'] = $this->CourseofferModleAdmin->editMarkcatagory($id);

        $data['subffer'] = 'active';
        $data['markcatagory'] = 'active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/mark/editmarkname', $data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
    }

    public function updatemarkcatagory($id) {

        $data = $this->input->post('data', TRUE);
        $result = $this->CourseofferModleAdmin->duplicatemarkcat($data, $id);

        if (!$result) {
            $this->CourseofferModleAdmin->updateMarkInfo($data, $id);
            $sdata['message'] = 'Successfull!';
            $this->session->set_userdata($sdata);

            redirect(admin_Url() . "/courseoffer/markcatagory");
        } else {
            $sdata['errormessage'] = 'Duplicate Entry Found!';
            $this->session->set_userdata($sdata);

            redirect(admin_Url() . "/courseoffer/markcatagory");
        }
    }

    public function deletemarkcatagory($id) {


        $this->CourseofferModleAdmin->deleteMarkName($id);
        $sdata['message'] = 'Successfully Deleted';
        $this->session->set_userdata($sdata);
        redirect(admin_Url() . "/courseoffer/markcatagory");
    }

    public function markdistribute($id) {

        // $data['MarkData'] = $this->CourseofferModleAdmin->Markdistribute($id);

        $data['courseofferlist'] = $this->CourseofferModleAdmin->getCourseInfo($id);

        $data['markcategorylist'] = $this->CourseofferModleAdmin->getmarkcategoryList();
        // print_r($data); die();
        $data['subffer'] = 'active';
        $data['markcatagory'] = 'active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/mark/markdistribute', $data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
    }


    public function editmarkdistribute($id) {

        // $data['MarkData'] = $this->CourseofferModleAdmin->Markdistribute($id);

        $data['courseofferlist'] = $this->CourseofferModleAdmin->getCourseInfo($id);

        $data['markcategorylist'] = $this->CourseofferModleAdmin->getmarkcategoryList();
        //print_r($data['markcategorylist']); die();
        $data['editData'] = $this->CourseofferModleAdmin->editMarkdistribute($id);

        $data['distribute_mark'] = $this->getArrayHashing($data['editData']);
        //echo '<pre>';  print_r($data); die();
        $data['subffer'] = 'active';
        $data['markcatagory'] = 'active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/mark/editmarkdistribute', $data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
    }

    private function getArrayHashing($arr = [])
    {
        $result_arr = [];
        $PercentMarks = explode(",", trim($arr['mark_percent'],','));
        $ex_pld_dvd = explode(",", trim($arr['divide_mark'],','));
        $m_cat_id = explode(',', trim($arr['mark_cat_id'],','));
        $len = count($m_cat_id);
        if ($len) {
            for ($i=0; $i < $len ; $i++) {
                $result_arr[$m_cat_id[$i]]['mark'] = $ex_pld_dvd[$i];
                $result_arr[$m_cat_id[$i]]['percent'] = $PercentMarks[$i];
            }
        }
        return $result_arr;
    }

    public function insertdvdmark() {
        // echo '<pre>';print_r($_POST);exit;

        $full_mark = $this->input->post('full_mark', TRUE);
        $cal_full_mark = $this->input->post('full_obmarks', TRUE);
        $offerId = $this->input->post('offerId', TRUE);

        $dvd_mark_id = $this->input->post('dvd_mark_id', TRUE);
        $dvd_mark = $this->input->post('dvd_mark', TRUE);
        $mark_percent = $this->input->post('mark_percent', TRUE);

        //   print_r($dvd_mark_id); echo "<pre>"; print_r($dvd_mark); echo "<pre>"; print_r($offerId); 
        $count_mark = count($dvd_mark);

        $mark_impld = ",";
        $ttl_impld = ",";
        $per_impld = ",";
        for ($m = 0; $m < $count_mark; $m++) {
            if (!empty($dvd_mark[$m]) || $dvd_mark[$m] != 0) {
                $ttl_impld = $ttl_impld . $dvd_mark_id[$m] . ",";
                $mark_impld = $mark_impld . $dvd_mark[$m] . ",";
                $per_impld = $per_impld . $mark_percent[$m] . ",";
            }
        }

        $data = array(
            "course_offerId" => $offerId,
            "mark_cat_id" => $ttl_impld,
            "divide_mark" => $mark_impld,
            "mark_percent" => $per_impld
        );

        // echo "<pre>"; print_r($data); die();

        $dulicat = $this->CourseofferModleAdmin->duplicate_divide_mark($data['course_offerId']);
        if ($full_mark != $cal_full_mark) {
            $sdata['message'] = 'Full Mark Overloaded!';
            $this->session->set_userdata($sdata);
            if (!$dulicat) {
                redirect(admin_Url() . "/courseoffer/markdistribute/".$offerId);
            } else {
                redirect(admin_Url() . "/courseoffer/editmarkdistribute/".$offerId);
            }
        }
        if (!empty($dulicat)) {
            $dividemark_id = $dulicat['dividemark_id'];
            $updt = $this->CourseofferModleAdmin->update_mark_dvd($data, $dividemark_id);

            if ($updt) {
                $sdata['message'] = 'Mark divided updated';
                $this->session->set_userdata($sdata);
                redirect(admin_Url() . "/courseoffer/courseOfferlist");
            } else {
                $sdata['errormessage'] = 'Mark divided not updated';
                $this->session->set_userdata($sdata);

                redirect(admin_Url() . "/courseoffer/markdistribute/" . $data['course_offerId']);
            }
        } else {
            $insert = $this->CourseofferModleAdmin->addmark_dvd($data);

            if ($insert) {
                $sdata['message'] = 'Mark divided Successfully';
                $this->session->set_userdata($sdata);
                redirect(admin_Url() . "/courseoffer/courseOfferlist");
            } else {
                $sdata['errormessage'] = 'Mark not divided';
                $this->session->set_userdata($sdata);

                redirect(admin_Url() . "/courseoffer/markdistribute/" . $data['course_offerId']);
            }
        }
    }

    public function testcourseOfferlist() {

        $data['subffer'] = 'active';
        $data['subjectofferlist'] = 'active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu'); // top bar menu
        $this->load->view('system_path/admin/courseoffer/corseoffersercetest', $data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
    }

    public function testsearchcourseofferlist() {

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
            array(
                'field' => 'data[sessionId]',
                'label' => 'Category Name',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[programLevel]',
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

            $data['subffer'] = 'active';
            $data['subjectofferlist'] = 'active';
            $this->load->view('system_path/admin/common/header_link'); // header Css link
            $this->load->view('system_path/admin/common/header'); // body header
            $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
            $this->load->view('system_path/admin/common/top_menu'); // top bar menu
            $this->load->view('system_path/admin/courseoffer/corseoffersercetest', $data); // ...........body content page...........
            $this->load->view('system_path/admin/common/footer'); // footer & script link
            $this->load->view('system_path/jsquery'); // footer & script link
        } else
            $data = $this->input->post('data', TRUE);
        // echo '<pre>';print_r($data);die();
        $data['programOfferId'] = getProgramOfferId($data);
        // echo '<pre>';print_r($data);die();
        if (!empty($data['programOfferId'])) {
            $data['courseofferlist'] = $this->ProgramModleAdmin->getOfferedProgramList($data);
            //  print_r($data['courseofferlist']); die();

            if (!empty($data['courseofferlist']) && $data['courseofferlist'] != null) {
                $total = 0;
                foreach ($data['courseofferlist'] as $value) {
                    $sl = 1;
                    echo '<tr>
                   
                    <td>' . $sl++ . '</td>
                        <td><span class=\'label label-sm label-success\'>' . $value['firstName'] . '</span></td>                       
                        <td>
                        
                       ' . $options = NULL;
                    // $d=  getCourseList();
                    foreach (getCourseList() as $result) {
                        $options[$result['courseId']] = $result['courseName'];
                        //   echo $result['courseName'];
                    }


                    echo form_dropdown($result['courseName'], $options) . '


</td>
<td> <input name="data" id="mark" type="text"></td>
                      
                      
            </tr>';
                }
            } else {
                echo "1";
            }
        }
    }

    public function getPaymentinfo() {
        $id = $this->input->post('customerId', true);
        $Payable = $this->CREGModel->getToatalcost($id);
        $data['paymentinfo'] = $this->incomesetupmodel->getincomeByCustomerId($id);
        //echo json_encode($data['paymentinfo']);
        //print_r($Payable);die();
        if (!empty($data['paymentinfo']) && $data['paymentinfo'] != null) {
            $total = 0;
            foreach ($data['paymentinfo'] as $value) {
                $total = $total + $value['amount'];
                echo '<tr>
                    <td>' . $value['date'] . '</td>
                    <td>' . element($value['paymentProcess'], getPaymentProcess(), null) . '</td>
                    <td>' . $value['pay_order_ddNo'] . '</td>
                    <td><span class=\'label label-sm label-success\'>' . $value['amount'] . '</span></td>
                    <td>' . element($value['payment_type'], getPaymentType(), null) . '</td>
                    
            </tr>';
            }
            $dues = $Payable['total_cost'] - $total;
            echo '<tr>
                    <td style=border:none;></td>
                    <td style=border:none;></td>
                    <td style=border:none;></td>
                    <td style=border:none;> 
                        <h5 style=color:red;><i>Total Paid &nbsp; &nbsp;' . $total . '<i></h5>
                        <h5 style=color:red;><i>Payable &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;' . $Payable['total_cost'] . '<i></h5>
                        <h5 style=color:red;><i>Dues &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $dues . '<i></h5>
                    </td>
                    <td style=border:none;></td>
                    
            </tr>';
        } else {
            echo "1";
        }
    }

}