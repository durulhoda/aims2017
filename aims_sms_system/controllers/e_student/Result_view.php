<?php

/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class Result_view extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->student_logged_auth();

        $this->load->model('admin/result_view/Result_viewModleAdmin', 'Result_viewModleAdmin');
        $this->load->model('admin/studentmarks/StudentmarksModleAdmin', 'StudentmarksModleAdmin');
        $this->load->model('admin/grading/GradingModleAdmin', 'GradingModleAdmin');
        $this->load->model('admin/program/ProgramModleAdmin', 'ProgramModleAdmin');
        $this->load->model('admin/student/StudentModleAdmin', 'StudentModleAdmin');
        //put your code here
        $this->load->model('admin/result/Result_model_admin', 'rma');
    }

    public function index() {
        $data['resultview'] = 'active';
        $this->load->view('system_path/student/common/header_link'); // header Css link
        $this->load->view('system_path/student/common/header'); // body header
        $this->load->view('system_path/student/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/student/result_view/index'); // ...........body content page...........
        $this->load->view('system_path/student/common/footer'); // footer & script link
    }

    public function searchresults() {

        $data = $this->input->post('data', TRUE);
        //print_r($data); die();
        $data['studentId'] = $this->session->userdata('studentId');
        //print_r($data); die();
        
        if (empty($data['studentId']) || empty($data['semesterId']) || empty($data['programOfferId'])) {
            $sdata = array();
            $sdata['message'] = "Select All Value";
            $this->session->set_userdata($sdata);
            $data['resultview'] = 'active';
            $this->load->view('system_path/student/common/header_link'); // header Css link
            $this->load->view('system_path/student/common/header'); // body header
            $this->load->view('system_path/student/common/side_menu', $data); // side bar menu
            $this->load->view('system_path/student/result_view/index', $data); // ...........body content page...........
            $this->load->view('system_path/student/common/footer'); // footer & script link
        } else {

            if (!empty($data['programOfferId'])) {

                $checkresult = $this->Result_viewModleAdmin->checkstudentresultstatus($data);
                //print_r($checkresult); die();
                if (!empty($checkresult)) {
                    $data['markslist'] = $this->Result_viewModleAdmin->getResultMarks_BYclass_student_semester($data);
                    //print_r($data['markslist']);
                    if (!empty($data['markslist'])) {

                        $this->load->view('system_path/student/common/header_link'); // header Css link
                        $this->load->view('system_path/student/common/header'); // body header
                        $this->load->view('system_path/student/common/side_menu', $data); // side bar menu
                        $this->load->view('system_path/student/result_view/index', $data); // ...........body content page...........
                        $this->load->view('system_path/student/common/footer'); // footer & script link
                    } else {
                        $sdata['errormessage'] = "Result not found";
                        $this->session->set_userdata($sdata);

                        $data['resultview'] = 'active';
                        $this->load->view('system_path/student/common/header_link'); // header Css link
                        $this->load->view('system_path/student/common/header'); // body header
                        $this->load->view('system_path/student/common/side_menu', $data); // side bar menu
                        $this->load->view('system_path/student/result_view/index'); // ...........body content page...........
                        $this->load->view('system_path/student/common/footer'); // footer & script link
                    }
                } else {
                    $sdata['errormessage'] = "Result not Published";
                    $this->session->set_userdata($sdata);
                    $data['resultview'] = 'active';
                    $this->load->view('system_path/student/common/header_link'); // header Css link
                    $this->load->view('system_path/student/common/header'); // body header
                    $this->load->view('system_path/student/common/side_menu', $data); // side bar menu
                    $this->load->view('system_path/student/result_view/index'); // ...........body content page...........
                    $this->load->view('system_path/student/common/footer'); // footer & script link
                }
            } else {
                $sdata['errormessage'] = "Result not found";
                $this->session->set_userdata($sdata);
                $data['resultview'] = 'active';
                $this->load->view('system_path/student/common/header_link'); // header Css link
                $this->load->view('system_path/student/common/header'); // body header
                $this->load->view('system_path/student/common/side_menu', $data); // side bar menu
                $this->load->view('system_path/student/result_view/index'); // ...........body content page...........
                
                $this->load->view('system_path/student/common/footer'); // footer & script link
            }
        }
    }

    public function transcriptView() {

        $data = $this->input->post('data');
        $student_id = $data['studentId'];
        $program_offer_id = $data['programOfferId'];
        $semester_id = $data['semesterId'];
        $data = [];
        $data['institute_info'] = $this->rma->getInstituteInfo();
        $data['student_info'] = $this->rma->getStudentInfo($student_id);
        $data['roll_no'] = $this->rma->get_roll_no($student_id);
        $data['program_info'] = $this->rma->getProgramInfo($program_offer_id);
        $data['semester_id'] = $semester_id;
        $data['records'] = $this->rma->getStudentMarkSheet($program_offer_id, $semester_id, $student_id);

//        echo '<pre>';
//        print_r($data);exit;

        $this->load->view('system_path/student/common/header_link'); // header Css link
        $this->load->view('system_path/student/common/header'); // body header
        $this->load->view('system_path/student/common/side_menu'); // side bar menu
        $this->load->view('system_path/student/result_view/transcriptView3', $data);// ...........body content page...........
        $this->load->view('system_path/student/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link




        //  if (isset($_POST['save'])) {

//        $data = $this->input->post('data', TRUE);
////            print_r($data); die();
//        if (!empty($data)) {
//
//            //$data['markslist'] = $this->StudentmarksModleAdmin->getmarksByStudentTranscriptView($data);
//            $results = $this->StudentmarksModleAdmin->getmarksByStudentTranscriptView_new($data);
//
//            foreach ($results as $index=>$result)
//            {
//                if($index==0)
//                {
//                    $courseStatus = explode(',',$result['courseStatus']);
//                    $courseId = explode(',',$result['courseId']);
//                    foreach ($courseId as $key=>$c_id)
//                    {
//                        if($c_id)
//                        {
//                            $data['courseIds_status'][$c_id] = $courseStatus[$key];
//                        }
//                    }
//                }
//            }
//
//            foreach ($results as $result)
//            {
//                $data['markslist'][$data['courseIds_status'][$result['course_id']]][]=$result;
//            }
//            $data['subject_category']=Array(
//                1=>'Common',
//                2=>'Optinal',
//                3=>'Group Main',
//                4=>'Extra'
//            );
//
//            if (!empty($data['markslist'])) {
//                $data['studentlist'] = $this->StudentModleAdmin->getstudentNameInfo($data['studentId']);
//                $data['programinfo'] = $this->ProgramModleAdmin->getofferProgramInfoById($data['programOfferId']);
//
//                $this->load->view('system_path/student/common/header_link'); // header Css link
//                $this->load->view('system_path/student/common/header'); // body header
//                $this->load->view('system_path/student/common/side_menu', $data); // side bar menu
//                //$this->load->view('system_path/student/result_view/transcriptView', $data); // ...........body content page...........
//                $this->load->view('system_path/student/result_view/new_transcript_sheet', $data);
//                $this->load->view('system_path/student/common/footer'); // footer & script link
//            } else {
//                $sdata = array();
//                $sdata['errormessage'] = "Transcript is not ready for View for this Student...";
//                $this->session->set_userdata($sdata);
//                $this->load->view('system_path/student/common/header_link'); // header Css link
//                $this->load->view('system_path/student/common/header'); // body header
//                $this->load->view('system_path/student/common/side_menu', $data); // side bar menu
//                $this->load->view('system_path/student/result_view/index', $data); // ...........body content page...........
//                $this->load->view('system_path/student/common/footer'); // footer & script link
//            }
//        } else {
//            $sdata = array();
//            $sdata['errormessage'] = "Data Not Found";
//            $this->session->set_userdata($sdata);
//            $this->load->view('system_path/student/common/header_link'); // header Css link
//            $this->load->view('system_path/student/common/header'); // body header
//            $this->load->view('system_path/student/common/side_menu', $data); // side bar menu
//            $this->load->view('system_path/student/result_view/index', $data); // ...........body content page...........
//            $this->load->view('system_path/student/common/footer'); // footer & script link
//        }
        //  }
    }

}
