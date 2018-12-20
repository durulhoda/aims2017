<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Dhaka');
        $this->load->model('content_model', 'co_model', TRUE);
        $this->load->model('admin/student/StudentModleAdmin', 'StudentModleAdmin');
        $this->load->model('admin/employee/EmployeeModleAdmin', 'EmployeeModleAdmin');
        $this->load->model('admin/program/ProgramModleAdmin', 'ProgramModleAdmin');
        $this->load->model('admin/classroutine/ClassroutineModleAdmin', 'ClassroutineModleAdmin');
        $this->load->model('admin/examroutine/ExamroutineModleAdmin', 'ExamroutineModleAdmin');
        $this->load->model('admin/admid/AdmidModleAdmin', 'AdmidModleAdmin');
        $this->load->model('admin/result/Result_model_admin', 'rma');

        $this->load->helper('text');
        $this->load->library('email');
        $this->load->helper("url");
    }

    public function data()
    {
        $text = '
                {
                 "payload":[
                         {
                           "sync_time": "2017-07-17 03:14:56",
                           "logged_time": "2017-07-16 14:07:03",
                           "type": "fingerprint",
                           "uid": "41cb234bca0c46feeb3c4601b858f597",
                           "device_identifier": "0003",
                           "location": "Katabon",
                           "person_identifier": "2",
                           "rfid": "0002188386",
                           "primary_display_text": "Akash",
                           "secondary_display_text": "021123085"
                         },
                         {
                           "sync_time": "2017-07-17 03:14:56",
                           "logged_time": "2017-07-16 14:07:05",
                           "type": "fingerprint",
                           "uid": "e38ac95a5d67028683688c277accd98b",
                           "device_identifier": "0003",
                           "location": "Katabon",
                           "person_identifier": "2",
                           "rfid": "0002188386",
                           "primary_display_text": "Akash",
                           "secondary_display_text": "021123085"
                         }
                 ]
                }
            ';
        $data = json_decode($text,true);
        echo '<pre>';print_r($data['payload']);exit;
        $payload = json_decode(file_get_contents("php://input"), true);

        //  if ($payload['payload']) {
        //       //$data = json_decode($payload,true);
        //      foreach($payload['payload'] as $key => $val) {
        //          $arr = [
        //              'sync_time' => $val['sync_time'], // device to server
        //              'logged_time' => $val['logged_time'], // attendance time
        //              'type' => $val['type'], // card or fingerprint
        //              'uid' => 'uid', // unique id
        //              'device_identifier' => 'device_identifier', // device id
        //              'location' => 'location', // location
        //              'person_identifier' => 'person_identifier', // student id or employee id
        //              'rfid' => 'rfid', // card id
        //              'primary_display_text' => 'primary_display_text', // first name
        //              'secondary_display_text' => 'secondary_display_text' // last name
        //              ];
        //              $this->db->insert('data', $arr);
        //      }

        //      $this->MessageSend();
        //  }
        // // log_message('info', json_encode($payload,true));

        //      // attendance data is in this variable
        //      return $this->output
        //       ->set_content_type('application/json')
        //       ->set_status_header(200)
        //       ->set_output(json_encode(array(
        //       'code' => 200
        //       )));

    }

    public function MessageSend($to="8801921821909", $message="Error")
    {
        //$message = "hi";
        $to = substr($to, strpos($to, '0'));
        $server = "https://api.mobireach.com.bd/SendTextMultiMessage?";
        $param = "Username=advsoft&Password=Fima@302124&From=8801847050122&To=88".$to."&Message=".$message."";
        $param = str_replace(" ","%20",$param);
        $url = $server.$param;
        // print_r($url);exit;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, false);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        curl_close($ch);
        if(!$output){
            $output =  file_get_contents($url);
        }
        //$sql = "update lastsms set lastsms_student_id=" . $emp_stu_id;
        // $sql = "UPDATE  lastsms SET lastsms_student_id = ".$emp_stu_id." WHERE type = ".$type."";

        // $resultsm = mysqli_query($conn, $sql);
    }

    public function allStudent($link) {
        $url['url'] = $link . 'results.json';
        $this->load->view("student_view", $url);
    }

    public function report() {
        $response['studentlist'] = $this->StudentModleAdmin->searchCurrentStudent_testRun();
        // echo "<pre>";
        // print_r($response);
        $fp = fopen('results.json', 'w');
        fwrite($fp, json_encode($response));
        fclose($fp);

        //$this->load->view('welcome_message', $response);
    }

    public function index() {
        $msg['category'] = 3;
        $data['rowdata'] = $this->co_model->select_aboutInfoByCategory($msg); // headmaster message

        $pmsg['category'] = 10;
        $data['president'] = $this->co_model->pselect_aboutInfoByCategory($pmsg); // headmaster message
        $histry['category'] = 6;
        $data['historydata'] = $this->co_model->select_aboutInfoByCategory($histry); // Institute History message

        $hdata['category'] = 2;
        $data['hrowdata'] = $this->co_model->select_abouthInfoByCategory($hdata); // Institute Building message

        $rulesdata['category'] = 8;
        $data['rulesrowdata'] = $this->co_model->rulesselect_abouthInfoByCategory($rulesdata);

        $missiondata['category'] = 5;
        $data['missionrowdata'] = $this->co_model->missionselect_abouthInfoByCategory($missiondata);



        $photogaldata['category'] = 2;
        $data['getphotodata'] = $this->co_model->select_gallery_photo($photogaldata);


        $data['title'] = "AIMS";
        $data['maritphotodata'] = $this->co_model->select_meritlist();

        $data['sliderphoto'] = $this->co_model->select_sliderphoto();
        $data['getdata'] = $this->co_model->select_NoticeBoard();
        $upnotice = "14";
        $data['getupnoticedata'] = $this->co_model->select_UpcomingNotice($upnotice);
        $data['main_content'] = $this->load->view('home/body_content', $data, TRUE);
        $this->load->view('home/default', $data);
    }

    public function OnlineAdmission() {
        $data['title'] = "AIMS";
        $data['main_content'] = $this->load->view('home/admissionform', $data, TRUE);
        $this->load->view('home/default', $data);
        $this->load->view('system_path/jsquery');
    }

    public function admissionTestResult() {
        $data['title'] = "AIMS";
        if ($_POST) {
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $config = array(
                array(
                    'field' => 'application_id',
                    'label' => 'Application Id',
                    'rules' => 'required'
                )
            );
            $this->form_validation->set_rules($config);
            if ($this->form_validation->run() == FALSE) {
            } else {
                $application_id = $this->input->post('application_id', TRUE);
                $data['record'] = $this->db
                    ->select('
                        ar.*,
                        si.firstName AS applicant_name,
                        aci.total,
                        IF(si.gender = 1, "Boy", "Girl") AS gender,
                        si.dateOfBirth,
                        si.photo,
                        po.programLevel,
                        po.programId,
                        po.mediumId,
                        po.groupId,
                        po.shiftId,
                        po.sectionId,
                        po.sessionId
                        ')
                    ->from('applicant_results AS ar')
                    ->join('programoffer AS po', 'ar.program_offer_id = po.programofferId')
                    ->join('studentinfo AS si', 'si.applicationId = ar.applicant_id', 'left')
                    ->join('admidcardinfo AS aci','ar.program_offer_id = aci.programofferId', 'left')
                    ->where('ar.applicant_id', $application_id)
                    ->get()
                    ->row();
                $data['institute_info'] = $this->getInstituteInfo();
                //print_r($data);
            }

        }
        $data['main_content'] = $this->load->view('home/admission_test_result', $data, TRUE);
        $this->load->view('home/default', $data);
    }

    public function result_view()
    {
        $data['title'] = "AIMS";
        $data['main_content'] = $this->load->view('home/result_view', $data, TRUE);
        $this->load->view('home/default', $data);
        //$this->load->view('system_path/jsquery');
    }

    public function search_result()
    {
        $student_id = $this->input->post('studentId');
        $session_id = $this->input->post('sessionId');
        $semester_id = $this->input->post('semesterId');
        if(!$student_id || !$session_id || !$semester_id)
        {
            $sdata['errormessage'] = 'Please fill out all the fields';
            $this->session->set_userdata($sdata);
            $data['title'] = "AIMS";
            $data['main_content'] = $this->load->view('home/result_view', $data, TRUE);
            $this->load->view('home/default', $data);
            //$this->load->view('system_path/jsquery');
        }
        else
        {
            $p_o_id = $this->rma->get_Program_offer_Id($student_id);
            $program_offer_id=$p_o_id['programOfferId'];
            $status = $this->rma->get_publish_status($student_id,$semester_id,$program_offer_id);
            if($status)
            {
                $data = [];
                $data['institute_info'] = $this->rma->getInstituteInfo();
                $data['student_info'] = $this->rma->getStudentInfo($student_id);
                $data['roll_no'] = $this->rma->get_roll_no($student_id);
                $data['program_info'] = $this->rma->getProgramInfo($program_offer_id);
                $data['semester_id'] = $semester_id;
                $data['records'] = $this->rma->getStudentMarkSheet($program_offer_id, $semester_id, $student_id);
                if($data['records'])
                {
                    $data['main_content'] = $this->load->view('home/transcript_view', $data, TRUE);
                    $this->load->view('home/default', $data);
                }
                else
                {
                    $sdata['errormessage'] = 'No result found... please provide a valid student Id';
                    $this->session->set_userdata($sdata);
                    $data['title'] = "AIMS";
                    $data['main_content'] = $this->load->view('home/result_view', $data, TRUE);
                    $this->load->view('home/default', $data);
                    //$this->load->view('system_path/jsquery');
                }
            }
            else
            {
                $sdata['errormessage'] = 'Result Not Published';
                $this->session->set_userdata($sdata);
                $data['title'] = "AIMS";
                $data['main_content'] = $this->load->view('home/result_view', $data, TRUE);
                $this->load->view('home/default', $data);
                //$this->load->view('system_path/jsquery');
            }
        }
    }

    public function getInstituteInfo()
    {
        $record = $this->db
            ->select('
                        TRIM(i.instituteName) AS institute_name,
                        CONCAT(TRIM(i.town),", ",TRIM(i.city),", ",TRIM(d.name_en)) AS address,
                        i.logo
                        ',false)
            ->from('institute AS i')
            ->join('districts AS d','i.district = d.id','left')
            ->get()
            ->row();
        return $record;
    }

    public function admisssion_result_list()
    {
        $data = [];
        $status = 0;
        $po_id = 0;
        $this->validation_check();
        $data['title'] = "AIMS";
        if ($this->form_validation->run() == FALSE) {
        } else {
            if ($_POST) {
                $data = $this->input->post('datax', TRUE);
                $data['enrollData'] = $this->ProgramModleAdmin->getValidateofferedprogramold($data);
                $po_id = ($data['enrollData']['programOfferId']) ? $data['enrollData']['programOfferId'] : 0;
                $data['institute_info'] = $this->getInstituteInfo();
                $data['records'] = $this->getAdmissionResultList($po_id, $status);
                // echo '<pre>'; print_r($data);exit;
            }
        }

        $data['main_content'] = $this->load->view('home/admission_test_result_list', $data, TRUE);
        $this->load->view('home/default', $data);
        $this->load->view('system_path/jsquery');
    }

    private function validation_check()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
            array(
                'field' => 'datax[mediumId]',
                'label' => 'Medium',
                'rules' => 'required'
            ),
            array(
                'field' => 'datax[programLevel]',
                'label' => 'Class Level',
                'rules' => 'required'
            ),
            array(
                'field' => 'datax[programId]',
                'label' => 'Class',
                'rules' => 'required'
            ),
            array(
                'field' => 'datax[groupId]',
                'label' => 'Group',
                'rules' => 'required'
            ),
            array(
                'field' => 'datax[shiftId]',
                'label' => 'Shift',
                'rules' => 'required'
            ),
            array(
                'field' => 'datax[sessionId]',
                'label' => 'Session',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);
    }

    //=========== Another Design Page of Aims System===================   

    public function AboutUs() {
        $data['category'] = 1;
        $data['title'] = "AIMS";
        $data['getnoticedata'] = $this->co_model->select_NoticeBoard();
        $data['rowdata'] = $this->co_model->select_aboutInfoByCategory($data);
        $data['main_content'] = $this->load->view('home/aboutus', $data, TRUE);
        $this->load->view('home/default', $data);
    }

    public function BuildingInfo() {
        $data['category'] = 2;

        $data['title'] = "AIMS";
        $data['getnoticedata'] = $this->co_model->select_NoticeBoard();
        $data['rowdata'] = $this->co_model->select_aboutInfoByCategory($data);
        $data['main_content'] = $this->load->view('home/ourmission', $data, TRUE);
        $this->load->view('home/default', $data);
    }

    public function principle_massege() {
        $data['category'] = 3;

        $data['title'] = "AIMS";
        $data['getnoticedata'] = $this->co_model->select_NoticeBoard();
        $data['rowdata'] = $this->co_model->select_aboutInfoByCategory($data);
        $data['main_content'] = $this->load->view('home/ourmission', $data, TRUE);
        $this->load->view('home/default', $data);
    }

    public function presi_massege() {
        $data['category'] = 10;

        $data['title'] = "AIMS";
        $data['getnoticedata'] = $this->co_model->select_NoticeBoard();
        $data['rowdata'] = $this->co_model->select_aboutInfoByCategory($data);
        $data['main_content'] = $this->load->view('home/ourmission', $data, TRUE);
        $this->load->view('home/default', $data);
    }

    public function About_us() {
        $data['category'] = 6;

        $data['title'] = "AIMS";
        $data['getnoticedata'] = $this->co_model->select_NoticeBoard();
        $data['rowdata'] = $this->co_model->select_aboutInfoByCategory($data);
        $data['main_content'] = $this->load->view('home/ourmission', $data, TRUE);
        $this->load->view('home/default', $data);
    }

    public function Career() {

        $data['title'] = "AIMS";
        $data['getnoticedata'] = $this->co_model->select_NoticeBoard();
        $data['rowdata'] = $this->co_model->select_publishedJobInfo();
        $data['main_content'] = $this->load->view('home/career', $data, TRUE);
        $this->load->view('home/default', $data);
    }

    public function PrincipalMessage() {
        $data['category'] = 3;

        $data['title'] = "AIMS";
        $data['getnoticedata'] = $this->co_model->select_NoticeBoard();
        $data['rowdata'] = $this->co_model->select_aboutInfoByCategory($data);
        $data['main_content'] = $this->load->view('home/ourmission', $data, TRUE);
        $this->load->view('home/default', $data);
    }

    public function LandInfo() {
        $data['category'] = 4;

        $data['title'] = "AIMS";
        $data['getnoticedata'] = $this->co_model->select_NoticeBoard();
        $data['rowdata'] = $this->co_model->select_aboutInfoByCategory($data);
        $data['main_content'] = $this->load->view('home/ourmission', $data, TRUE);
        $this->load->view('home/default', $data);
    }

    public function OurMission() {
        $data['category'] = 5;

        $data['title'] = "AIMS";
        $data['getnoticedata'] = $this->co_model->select_NoticeBoard();
        $data['rowdata'] = $this->co_model->select_aboutInfoByCategory($data);
        $data['main_content'] = $this->load->view('home/ourmission', $data, TRUE);
        $this->load->view('home/default', $data);
    }

    public function SchoolHistory() {
        $data['category'] = 6;

        $data['title'] = "AIMS";
        $data['getnoticedata'] = $this->co_model->select_NoticeBoard();
        $data['rowdata'] = $this->co_model->select_aboutInfoByCategory($data);
        $data['main_content'] = $this->load->view('home/ourmission', $data, TRUE);
        $this->load->view('home/default', $data);
    }

    public function RoomInfo() {
        $data['category'] = 7;

        $data['title'] = "AIMS";
        $data['getnoticedata'] = $this->co_model->select_NoticeBoard();
        $data['rowdata'] = $this->co_model->select_aboutInfoByCategory($data);
        $data['main_content'] = $this->load->view('home/ourmission', $data, TRUE);
        $this->load->view('home/default', $data);
    }

    public function RulesRegulation() {
        $data['category'] = 8;

        $data['title'] = "AIMS";
        $data['getnoticedata'] = $this->co_model->select_NoticeBoard();
        $data['rowdata'] = $this->co_model->select_aboutInfoByCategory($data);
        $data['main_content'] = $this->load->view('home/ourmission', $data, TRUE);
        $this->load->view('home/default', $data);
    }

    public function PostInfo() {
        $data['category'] = 9;

        $data['title'] = "AIMS";
        $data['getnoticedata'] = $this->co_model->select_NoticeBoard();
        $data['rowdata'] = $this->co_model->select_aboutInfoByCategory($data);
        $data['main_content'] = $this->load->view('home/ourmission', $data, TRUE);
        $this->load->view('home/default', $data);
    }

    public function AcademicCurriculum() {
        $data['category'] = 1;

        $data['title'] = "AIMS";
        $data['getnoticedata'] = $this->co_model->select_NoticeBoard();
        $data['rowdata'] = $this->co_model->selectArray_AcademicInfoByCategory($data);
        $data['main_content'] = $this->load->view('home/academicarea', $data, TRUE);
        $this->load->view('home/default', $data);
    }

    public function ourachievements() {
        $data['category'] = 2;

        $data['title'] = "AIMS";
        $data['getnoticedata'] = $this->co_model->select_NoticeBoard();
        $data['rowdata'] = $this->co_model->selectArray_AcademicInfoByCategory($data);
        $data['main_content'] = $this->load->view('home/academicarea', $data, TRUE);
        $this->load->view('home/default', $data);
    }

    public function awarnessprograms() {
        $data['category'] = 3;

        $data['title'] = "AIMS";
        $data['getnoticedata'] = $this->co_model->select_NoticeBoard();
        $data['rowdata'] = $this->co_model->selectArray_AcademicInfoByCategory($data);
        $data['main_content'] = $this->load->view('home/academicarea', $data, TRUE);
        $this->load->view('home/default', $data);
    }

    public function CoCurriculum() {
        $data['category'] = 4;

        $data['title'] = "AIMS";
        $data['getnoticedata'] = $this->co_model->select_NoticeBoard();
        $data['rowdata'] = $this->co_model->selectArray_AcademicInfoByCategory($data);
        $data['main_content'] = $this->load->view('home/academicarea', $data, TRUE);
        $this->load->view('home/default', $data);
    }

    public function functions() {
        $data['category'] = 5;

        $data['title'] = "AIMS";
        $data['getnoticedata'] = $this->co_model->select_NoticeBoard();
        $data['rowdata'] = $this->co_model->selectArray_AcademicInfoByCategory($data);
        $data['main_content'] = $this->load->view('home/academicarea', $data, TRUE);
        $this->load->view('home/default', $data);
    }

    public function HowtoApply() {
        $data['category'] = 6;

        $data['title'] = "AIMS";
        $data['getnoticedata'] = $this->co_model->select_NoticeBoard();
        $data['rowdata'] = $this->co_model->select_AcademicInfoByCategory($data);
        $data['main_content'] = $this->load->view('home/curriculum', $data, TRUE);
        $this->load->view('home/default', $data);
    }

    public function NoticeBoard() {
        $data['category'] = 7;

        $data['title'] = "AIMS";
        $data['getnoticedata'] = $this->co_model->select_NoticeBoard();
        $data['rowdata'] = $this->co_model->selectArray_AcademicInfoByCategory($data);
        $data['main_content'] = $this->load->view('home/academicarea', $data, TRUE);
        $this->load->view('home/default', $data);
    }

    public function ViewAcademicInformation($id) {
        $data['title'] = "AIMS";
        $data['getdata'] = $this->co_model->select_academicInfo_by_id($id);
        $data['getnoticedata'] = $this->co_model->select_NoticeBoard();
        $data['main_content'] = $this->load->view('home/noticedetails', $data, TRUE);
        $this->load->view('home/default', $data);
    }

    public function Digiclass() {
        $data['category'] = 13;

        $data['title'] = "AIMS";
        $data['getnoticedata'] = $this->co_model->select_NoticeBoard();
        $data['rowdata'] = $this->co_model->selectArray_AcademicInfoByCategory($data);
        $data['main_content'] = $this->load->view('home/academicarea', $data, TRUE);
        $this->load->view('home/default', $data);
    }

    public function Transport() {
        $data['category'] = 11;

        $data['title'] = "AIMS";
        $data['getnoticedata'] = $this->co_model->select_NoticeBoard();
        $data['rowdata'] = $this->co_model->select_AcademicInfoByCategory($data);
        $data['main_content'] = $this->load->view('home/curriculum', $data, TRUE);
        $this->load->view('home/default', $data);
    }

    public function Library() {
        $data['category'] = 8;

        $data['title'] = "AIMS";
        $data['getnoticedata'] = $this->co_model->select_NoticeBoard();
        $data['rowdata'] = $this->co_model->select_AcademicInfoByCategory($data);
        $data['main_content'] = $this->load->view('home/curriculum', $data, TRUE);
        $this->load->view('home/default', $data);
    }

    public function Science_Labs() {
        $data['category'] = 9;

        $data['title'] = "AIMS";
        $data['getnoticedata'] = $this->co_model->select_NoticeBoard();
        $data['rowdata'] = $this->co_model->select_AcademicInfoByCategory($data);
        $data['main_content'] = $this->load->view('home/curriculum', $data, TRUE);
        $this->load->view('home/default', $data);
    }

    public function IT_Labs() {
        $data['category'] = 10;

        $data['title'] = "AIMS";
        $data['getnoticedata'] = $this->co_model->select_NoticeBoard();
        $data['rowdata'] = $this->co_model->select_AcademicInfoByCategory($data);
        $data['main_content'] = $this->load->view('home/curriculum', $data, TRUE);
        $this->load->view('home/default', $data);
    }

    public function Cafeteria() {
        $data['category'] = 12;

        $data['title'] = "AIMS";
        $data['getnoticedata'] = $this->co_model->select_NoticeBoard();
        $data['rowdata'] = $this->co_model->select_AcademicInfoByCategory($data);
        $data['main_content'] = $this->load->view('home/curriculum', $data, TRUE);
        $this->load->view('home/default', $data);
    }

    public function BoardMember() {
        $data['bm_cat'] = 1;
        $data['title'] = "AIMS";
        $data['getnoticedata'] = $this->co_model->select_NoticeBoard();
        // $data['employeeType']=4; // get employee by type Teacher(1)
        $data['getdata'] = $this->co_model->select_allmemberlistBYCategory($data);

        $data['main_content'] = $this->load->view('home/management', $data, TRUE);
        $this->load->view('home/default', $data);
    }

    public function ThirdgradeStaff() {
        // $data['bm_cat']=2;
        $data['title'] = "AIMS";
        $data['getnoticedata'] = $this->co_model->select_NoticeBoard();
        $data['employeeType'] = 2; // get employee by type Teacher(1)
        $data['getdata'] = $this->EmployeeModleAdmin->getEmployeeInfo_byType($data['employeeType']);
        $data['main_content'] = $this->load->view('home/faculty', $data, TRUE);
        $this->load->view('home/default', $data);
    }

    public function FourthgradeStaff() {
        // $data['bm_cat']=3;
        $data['title'] = "AIMS";
        $data['getnoticedata'] = $this->co_model->select_NoticeBoard();

        $data['employeeType'] = 3; // get employee by type Teacher(1)
        $data['getdata'] = $this->EmployeeModleAdmin->getEmployeeInfo_byType($data['employeeType']);
        $data['main_content'] = $this->load->view('home/faculty', $data, TRUE);
        $this->load->view('home/default', $data);
    }

    public function ViewBoardMember($id) {
        $data['title'] = "AIMS";
        $data['getnoticedata'] = $this->co_model->select_NoticeBoard();
        $data['getdata'] = $this->co_model->select_memberinfo_by_id($id);
        $data['main_content'] = $this->load->view('home/managementinfo', $data, TRUE);
        $this->load->view('home/default', $data);
    }

    public function FacultyMember() {
        $data = array();

        $data['title'] = "AIMS";
        $data['getnoticedata'] = $this->co_model->select_NoticeBoard();

        $data['employeeType'] = 1; // get employee by type Teacher(1)
        $data['getdata'] = $this->EmployeeModleAdmin->getEmployeeInfo_byType($data['employeeType']);
        $data['main_content'] = $this->load->view('home/faculty', $data, TRUE);
        $this->load->view('home/default', $data);
    }

    public function ViewFacultyMember($id) {

        $data['title'] = "AIMS";
        $data['getdata'] = $this->EmployeeModleAdmin->viewemployeeinfo($id);

        if (!empty($data['getdata'])) {
            $data['getnoticedata'] = $this->co_model->select_NoticeBoard();
            $data['main_content'] = $this->load->view('home/facultyinfo', $data, TRUE);
            $this->load->view('home/default', $data);
        } else {
            $this->FacultyMember();
        }
    }

    public function Meritious_Student() {
        $data = array();

        $data['title'] = "AIMS";
        $data['getnoticedata'] = $this->co_model->select_NoticeBoard();
        $data['getdata'] = $this->co_model->select_meritlist();
        $data['main_content'] = $this->load->view('home/meritiousstudent', $data, TRUE);
        $this->load->view('home/default', $data);
    }

    public function ResultList($rs) {
        $data['title'] = "AIMS";
        $data['rsid'] = $rs;
        $data['getnoticedata'] = $this->co_model->select_NoticeBoard();
        $data['getdata'] = $this->co_model->select_allresultlist();
        $data['main_content'] = $this->load->view('home/result', $data, TRUE);
        $this->load->view('home/default', $data);
    }

    public function AdmissionResult() {
        $data['title'] = "AIMS";
        $data['getnoticedata'] = $this->co_model->select_NoticeBoard();
        $data['main_content'] = $this->load->view('home/admission_result', $data, TRUE);
        $this->load->view('home/default', $data);
    }

    public function ImageGallery($rs) {
        $data['title'] = "AIMS";
        $data['rsid'] = $rs;
        $data['getnoticedata'] = $this->co_model->select_NoticeBoard();
        $data['getdata'] = $this->co_model->select_limited_photo();
        $data['main_content'] = $this->load->view('home/galleryBox', $data, TRUE);
        $this->load->view('home/default', $data);
    }

    public function ClassRoutine() {
        $data['title'] = "AIMS";
        $data['getnoticedata'] = $this->co_model->select_NoticeBoard();
        $data['getdata'] = $this->ClassroutineModleAdmin->getClassroutineList();
        $data['main_content'] = $this->load->view('home/classroutinelist', $data, TRUE);
        $this->load->view('home/default', $data);
    }

    public function showclassroutine() {

        $data = $this->input->post('data', TRUE);

        if (isset($_POST['showroutine'])) {

            //$data['classroutine'] = $this->ClassroutineModleAdmin->select_new_routine($data);
            $data['class_routine_info'] = $this->ClassroutineModleAdmin->getClassRoutineInfo($data['programOfferId']);


            if (!empty($data['class_routine_info'])) {
                $data['main_content'] = $this->load->view('home/viewroutine', $data, TRUE);
                $this->load->view('home/default', $data);
            } else {
                $sdata = array();
                $sdata['redmessage'] = "No Classroutine Found";
                $this->session->set_userdata($sdata);
                redirect(base_url('home/ClassRoutine', 'refresh'));
            }
        } else {
            redirect(base_url('home/ClassRoutine', 'refresh'));
        }
    }

    public function Contact() {
        $data['title'] = "AIMS";
        $data['getnoticedata'] = $this->co_model->select_NoticeBoard();
        $data['getdata'] = $this->co_model->select_contact_details();
        $data['main_content'] = $this->load->view('home/contact', $data, TRUE);
        $this->load->view('home/default', $data);
    }

    public function sendEmail() {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $config = array(
            array(
                'field' => 'sender_name',
                'label' => 'Your Name',
                'rules' => 'required|xss_clean'
            ),
            array(
                'field' => 'sender_email',
                'label' => 'Your Email',
                'rules' => 'required|xss_clean|trim|required|valid_email'
            ),
            array(
                'field' => 'sender_phone',
                'label' => 'Your Phone Number',
                'rules' => 'required|xss_clean|numeric|callback__check_phone|max_length[11]|min_length[11]'
            ),
            array(
                'field' => 'sender_message',
                'label' => 'Your Message',
                'rules' => 'required|xss_clean|trim'
            ),
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            $errormessage['errormessage'] = "Please fill up all field with valid information";
            $this->session->set_userdata($errormessage);
            $this->index();
        } else {
            $school_email = "faizulrng@gmail.com";

            $sender_name = $this->input->post('sender_name', TRUE);
            $sender_email = $this->input->post('sender_email', TRUE);
            $sender_phone = $this->input->post('sender_phone', TRUE);
            $sender_message = $this->input->post('sender_message', TRUE);

            $email_text['mesg'] = "Guest Name: " . $sender_name . "\r\n\r\nMobile Number: " . $sender_phone . "\r\n\r\nEmail: " . $sender_email . "\r\n\r\nGuest Message: " . $sender_message . "\r\r\r\n\n\n.................................................\n\nNOTE: Please do not reply in this email. Please reply Guest email address.\r\r\r\n Thank You\r\r\nAIMS-Institute Management System";

            $this->email->from('noreply.aimssystem@gmail.com'); // change it to yours
            $this->email->to($school_email); // change it to yours
            $this->email->subject('Message From School Website');
            $this->email->message($email_text['mesg']);
            if ($this->email->send()) {
                $message['message'] = "Message Successfully Send";
                $this->session->set_userdata($message);
                redirect(base_url('home/Contact'));
            } else {

                $errormessage['errormessage'] = "Sorry Message Not Sent... Try Again";
                $this->session->set_userdata($errormessage);
                redirect(base_url('home/Contact'));
            }
        }
    }

    public function insertapplicant() {

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
            array(
                'field' => 'data[firstName]',
                'label' => 'First Name',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[dateOfBirth]',
                'label' => 'Date of Birth',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[gender]',
                'label' => 'gender',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[nationality]',
                'label' => 'Nationality',
                'rules' => 'required'
            ),
//                array(
//                'field' => 'data[telephone]',
//                'label' => 'telephone',
//                'rules' => 'required'
//            ),
            array(
                'field' => 'data[permanentAddress]',
                'label' => 'Permanent Address',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[presentAddress]',
                'label' => 'Present Address',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[fatherName]',
                'label' => 'father\'s Name',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[fatherMonthlyIncome]',
                'label' => 'father\'s Income',
                'rules' => 'trim'
            ),
            array(
                'field' => 'data[motherName]',
                'label' => 'Mother\'s Name',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[motherMonthlyIncome]',
                'label' => 'mother\'s Income',
                'rules' => 'trim'
            ),
            array(
                'field' => 'data[fatherPhone]',
                'label' => 'father\'s Mobile Number',
                'rules' => 'required'
            ),
            // array(
            //     'field' => 'data[motherPhone]',
            //     'label' => 'Mother\'s Mobile Number',
            //     'rules' => 'required'
            // ),
            array(
                'field' => 'datax[programId]',
                'label' => 'Class ',
                'rules' => 'required'
            ),
            array(
                'field' => 'datax[mediumId]',
                'label' => 'Medium',
                'rules' => 'required'
            ),
            array(
                'field' => 'datax[shiftId]',
                'label' => 'Shift',
                'rules' => 'required'
            ),
            array(
                'field' => 'datax[groupId]',
                'label' => 'Group',
                'rules' => 'required'
            ),
            array(
                'field' => 'datax[sessionId]',
                'label' => 'Session',
                'rules' => 'required'
            ),
            array(
                'field' => 'datax[programLevel]',
                'label' => 'Program Level',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[sclname]',
                'label' => 'School Name',
                'rules' => 'trim'
            ),
            array(
                'field' => 'data[clsname]',
                'label' => 'Class Name',
                'rules' => 'trim'
            ),
            array(
                'field' => 'data[prvresult]',
                'label' => 'Previous Result',
                'rules' => 'trim'
            ),
            array(
                'field' => 'data[prvpassingyr]',
                'label' => 'Passing Year',
                'rules' => 'trim'
            ),
            array(
                'field' => 'data[tcno]',
                'label' => 'Tc Number',
                'rules' => 'trim'
            ),
            array(
                'field' => 'data[tcdate]',
                'label' => 'Tc Date',
                'rules' => 'trim'
            )

        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = "AIMS Academic System";
            $sdata = array();
            $sdata['redmessage'] = 'Required field missing..please fill up all red star marked field!';
            $this->session->set_userdata($sdata);
            $data['main_content'] = $this->load->view('home/admissionform', $data, TRUE);
            $this->load->view('home/default', $data);
        } else {
            $data = $this->input->post('data', TRUE);
            //echo "<pre>";print_r($data);die();
            $datax = $this->input->post('datax', TRUE);
            // echo '<pre>';print_r($_POST);
            // echo '<pre>';print_r($data);
            // echo '<pre>';print_r($datax);
            // exit;
            $enrol = $this->ProgramModleAdmin->getValidateofferedprogram($datax);

            //   print_r($data['dataadmid']); die();
            //print_r($enrol); die();
            if (!empty($enrol)) {
                if (!empty($data) && !empty($enrol)) {
                    // echo 'hi';exit;
                    //================================ image upload and resizing===========================
                    //$imgData=array();
                    $this->load->library('upload');
                    $config['upload_path'] = './uploads/Students/';
                    $config['allowed_types'] = 'png|jpeg|jpg|JPG|JPEG';
                    $config['max_size'] = '1024';
                    $config['max_width'] = '';
                    $config['max_height'] = '';
                    $this->upload->initialize($config);
                    if ($this->upload->do_upload('userfile')){
                        $imgData = $this->upload->data();
                    } else {
                        print_r($this->upload->display_errors());
                        die();
                    }
                    $this->load->library('md_image');
                    $source = $this->upload->upload_path . $imgData['file_name'];
                    $width = 200;
                    $height = 340;
                    $size = getimagesize($source);
                    $resize_height = ($size[1] * 340) / $size[0];
                    $dest = FALSE;
                    $this->md_image->resize_image($source, $width, $height, $source);
                    $config['image_library'] = 'gd2'; //imagemagik
                    $config['source_image'] = $this->upload->upload_path . $imgData['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 200;
                    $config['height'] = $resize_height;
                    $config['quality'] = 75;
                    $config['encrypt_name'] = TRUE;
                    $config['remove_spaces'] = TRUE;
                    $img = $config['source_image'];

                    $this->load->library('image_lib', $config);

                    $this->image_lib->resize();
                    $data['photo'] = "uploads/Students/" . $this->upload->file_name;
                    //===================================End image processing==================================
                    //  $incId = $this->getLastId($enrol['programOfferId']);
                    //$new_stt = sprintf('%02d', $datax['programId']); //05
                    //$new_medium = sprintf('%02d', $datax['mediumId']); //05
                    //$datae = date('Y'); //2017
                    // $data['applicationId'] = $datae . "" . strval($new_stt) . "" . counter(); //counter ..number of count ....located at utility helper folder
                    //echo "<pre>";
                    //print_r($data['applicationId']);die();
                    //  $data['applicationId'] = $datae . "" . strval($new_stt) /*. "" . strval($new_medium)*/ . "" . $incId;
                    // echo '<pre>';print_r($enrol);
                    // echo '<pre>'; print_r($data);exit;
                    //$programId = $new_stt;
                    $data['applicationId'] = $this->getApplicantId($datax['programId'], $datax['sessionId']);

                    $check = $this->StudentModleAdmin->checkApplicantId($data['applicationId']);
                    if ($check) {
                        $sdata = array();
                        $sdata['redmessage'] = 'System Found some problem with new applicationId...Please create again !!';
                        $this->session->set_userdata($sdata);
                        $data['title'] = "AIMS Academic System";
                        $data['main_content'] = $this->load->view('home/admissionform', $data, TRUE);
                        $this->load->view('home/default', $data);
                    } else {

                        $img_data = $this->upload->data();
                        $data['photo'] = "uploads/Students/" . $img_data['file_name'];
                        //echo "<pre>"; print_r($data); die();

                        $this->StudentModleAdmin->addStudentInfo($data, $enrol); //insert Student
                        $id = $this->db->insert_id();
                        $programOfferId = $enrol['programOfferId'];
                        $data['dataadmid'] = $this->AdmidModleAdmin->getadmidinfo($programOfferId);
                        //   print_r($data['dataadmid'] ); die();
                        $data['applicantId'] = getApplicantInfoById($id);
                        $data['datax'] = $this->input->post('datax', TRUE);
                        $data['title'] = "AIMS Academic System";
                        $data['main_content'] = $this->load->view('home/confirmationprint', $data, TRUE);
                        $this->load->view('home/default', $data);
                    }
                } else {
                    $sdata = array();
                    $sdata['redmessage'] = 'look like Some value missing here';
                    $this->session->set_userdata($sdata);
                    $data['main_content'] = $this->load->view('home/admissionform', $sdata, TRUE);
                    $this->load->view('home/default', $data);
                }
            } else {
                $sdata = array();
                $sdata['redmessage'] = 'Inserted Enrolment Information is not offered yet';
                $this->session->set_userdata($sdata);
                $data['main_content'] = $this->load->view('home/admissionform', $sdata, TRUE);
                $this->load->view('home/default', $data);
            }
        }
    }

    private function getApplicantId($programId = 00, $sessionId = 0)
    {
        $program= sprintf('%02d', $programId);
        $sessionInfo = $this->db
            ->where('sessionId', $sessionId)
            ->get('session')
            ->row();
        if ($sessionInfo) {
            $year = substr($sessionInfo->session, -2);
            $year = ($year) ? $year : date('y');
        }
        $applicationId = $year.$program.'0001';
        $record = $this->db
            ->select('
                        ap.appinfo_id,
                        ap.applicationId
                    ')
            ->from('admissionapplicant AS ap')
            ->join('programoffer AS po', 'po.programOfferId = ap.programOfferId')
            ->where('po.programId', $programId)
            ->where('po.sessionId', $sessionId)
            ->where('ap.new_applicant_check', 1)
            ->order_by('ap.appinfo_id','desc')
            ->get()
            ->row();
        if ($record && $record->applicationId) {
            $last_id = (int)substr($record->applicationId, 4, 4);
            $last_id++;

            $increment = sprintf('%04d', $last_id);
            $applicationId = $year.$program.$increment;
        }
        // echo '<pre>';print_r($_POST);
        /// echo '<pre>';print_r($record);
        //print_r($applicationId);exit;
        return $applicationId;
    }

    // public function t(){
    //     $laid = $this->getApplicantId();
    //     $programId = sprintf('%02d', 15);
    //     $last_applicationId = '18050099';
    //     $last_year = substr($last_applicationId, 0, 2);
    //     $last_program = (int)substr($last_applicationId, 2, 2);
    //     $last_id = (int)substr($last_applicationId, 4, 4);
    //     $last_id++;
    //   // print_r($last_id)."<br>";
    //     //exit;
    //     $increment = sprintf('%04d', $last_id);
    //     $applicationId = date('y').$programId.$increment;
    //     print_r($applicationId);
    // }

    // public function data()
    // {
    //         $arr = ['1' =>2];

    //         print_r($arr);
    //         $payload = json_decode(file_get_contents("php://input"), true);
    //             // attendance data is in this variable
    //             return $this->output
    //              ->set_content_type('application/json')
    //              ->set_status_header(200)
    //              ->set_output(json_encode(array(
    //              'code' => 200
    //              )));
    //         print_r($payload);

    // }

    private function getLastId($programOfferId = 0) {
        $incId = 1;
        $record = $this->db
            ->select('applicationId')
            ->where('programOfferId', $programOfferId)
            ->order_by('appinfo_id', 'desc')
            ->get('admissionapplicant')
            ->row();
        if ($record) {
            $incId = (substr($record->applicationId, 6))+1;
        }
        return $incId;
    }

    private function getApplicantLastId()
    {

    }

    public function ViewCareerInfo($id) {
        $data['title'] = "AIMS";
        $data['getnoticedata'] = $this->co_model->select_NoticeBoard();
        $data['getdata'] = $this->co_model->select_JobInfo_by_id($id);
        if (!empty($data['getdata'])) {
            $data['main_content'] = $this->load->view('home/careerinfo', $data, TRUE);
            $this->load->view('home/default', $data);
        } else {
            redirect(base_url() . 'home/career');
        }
    }

    public function donormember() {

        $data['title'] = "AIMS";
        $data['getnoticedata'] = $this->co_model->select_NoticeBoard();
        $data['getdata'] = $this->co_model->alldonormember();
        // print_r ($data['getdata']); die();
        $data['main_content'] = $this->load->view('home/donormember', $data, TRUE);
        $this->load->view('home/default', $data);
    }

    public function phonorlist() {

        $data['title'] = "AIMS";
        $data['getnoticedata'] = $this->co_model->select_NoticeBoard();
        $data['getdata'] = $this->co_model->phonorlist();
        // print_r ($data['getdata']); die();
        $data['main_content'] = $this->load->view('home/principlelist', $data, TRUE);
        $this->load->view('home/default', $data);
    }

    public function prehonorlist() {
        $data['title'] = "AIMS";
        $data['getnoticedata'] = $this->co_model->select_NoticeBoard();
        $data['getdata'] = $this->co_model->prehonorlist();
        $data['main_content'] = $this->load->view('home/presidentlist', $data, TRUE);
        $this->load->view('home/default', $data);
    }

    public function viewexamroutine() {
        $data['getnoticedata'] = $this->co_model->select_NoticeBoard();
        $data['examroutinelist'] = $this->ExamroutineModleAdmin->getExamroutineList();
        //   print_r($data); die();
        $data['title'] = "AIMS - Admin Panel";

        $data['main_content'] = $this->load->view('home/examroutine', $data, TRUE);
        $this->load->view('home/default', $data);
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

    public function showexamroutine($id) {

        // $id = (int) $id;
        $data['programOfferId'] = $id;

        $data['examroutine'] = $this->ExamroutineModleAdmin->exam_routine($data);
        if (!empty($data['examroutine'])) {
            $data['programinfo'] = getofferProgramInfoById($data['programOfferId']);

            $data['main_content'] = $this->load->view('home/showexamroutine', $data, TRUE);
            $this->load->view('home/default', $data);
        }
    }

    public function honorview($id) {
        $data['title'] = "AIMS";
        $data['getnoticedata'] = $this->co_model->select_NoticeBoard();
        $data['getdata'] = $this->co_model->honor_info_byid($id);
        //  print_r($data['getdata']); die();
        $data['main_content'] = $this->load->view('home/viewprinciple', $data, TRUE);
        $this->load->view('home/default', $data);
    }

    public function principalvies($id) {
        $id = (int) $id;
        $data['title'] = "AIMS";
        $data['getnoticedata'] = $this->co_model->select_NoticeBoard();
        $data['getdata'] = $this->co_model->honor_info_byid($id);
        // print_r($data['getdata']); die();
        $data['main_content'] = $this->load->view('home/viewprinciple', $data, TRUE);
        $this->load->view('home/default', $data);
    }

    public function getRequirements($file) {
        $this->load->helper('download');
        $data = file_get_contents(base_url() . 'uploads/file/' . $file); // Read the file's contents
        $name = $file;

        force_download($name, $data);
    }

    public function searchexamroutine() {

        $data['getnoticedata'] = $this->co_model->select_NoticeBoard();
        $data['examroutinelist'] = $this->ExamroutineModleAdmin->getExamroutineList();
        // print_r($data['examroutinelist']); die();
        $data['title'] = "AIMS - Admin Panel";

        $data['main_content'] = $this->load->view('home/searchexamroutine', $data, TRUE);
        $this->load->view('home/default', $data);
    }

    public function searchexamroutinedata() {
        $data = $this->input->post('data', TRUE);

        //  print_r($data); die();
        $data['examroutine'] = $this->ExamroutineModleAdmin->select_exam_routine($data);
        //  print_r($data['examroutine']); die();

        if (!empty($data['examroutine'])) {

//            echo '<pre>';
//            print_r($data);exit;
            $data['getnoticedata'] = $this->co_model->select_NoticeBoard();

            //   print_r($data); die();
            $data['title'] = "AIMS - Admin Panel";

            $data['main_content'] = $this->load->view('home/examroutine', $data, TRUE);
            $this->load->view('home/default', $data);
        } else {
            $message['message'] = "Data Not Found * Please Search Again";
            $this->session->set_userdata($message);
            redirect(base_url('home/searchexamroutine'));
        }
    }
    public function searchexamroutinedata_new() {
        $data = $this->input->post('data', TRUE);
        $data['examroutine'] = $this->ExamroutineModleAdmin->select_new_exam_routine($data);

        if (!empty($data['examroutine'])) {

            $data['programOfferId'] = $data['examroutine'][0]['programOfferId'];

            $data['programinfo']=  getofferProgramInfoById($data['programOfferId']);

//            $data['classroutine'] = 'active';
//            $this->load->view('system_path/admin/common/header_link'); // header Css link
//            $this->load->view('system_path/admin/common/header'); // body header
//            $this->load->view('system_path/admin/common/side_menu'); // side bar menu
//            $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
//            $this->load->view('system_path/admin/examroutine/viewroutine', $data); // ...........body content page...........
//            $this->load->view('system_path/admin/common/footer'); // footer & script link
//            $this->load->view('system_path/jsquery'); // footer & script link


            $data['getnoticedata'] = $this->co_model->select_NoticeBoard();

//               print_r($data); die();
            $data['title'] = "AIMS - Admin Panel";

            $data['main_content'] = $this->load->view('home/showexamroutine_new', $data, TRUE);
            //$data['main_content'] = $this->load->view('home/examroutine', $data, TRUE);
            //$data['main_content'] = $this->load->view('system_path/admin/examroutine/viewroutine', $data);
            $this->load->view('home/default', $data);
        } else {
            $message['message'] = "Data Not Found * Please Search Again";
            $this->session->set_userdata($message);
            redirect(base_url('home/searchexamroutine'));
        }
    }

    public function searchclassroutine() {

        $data['getnoticedata'] = $this->co_model->select_NoticeBoard();
        $data['examroutinelist'] = $this->ClassroutineModleAdmin->getClassroutineList();
        // print_r($data['examroutinelist']); die();
        $data['title'] = "AIMS - Admin Panel";

        $data['main_content'] = $this->load->view('home/searchclassroutine', $data, TRUE);
        $this->load->view('home/default', $data);
    }

    public function searchclassroutinedata() {
        $data = $this->input->post('data', TRUE);

//        echo '<pre>';
//        print_r($data);exit;

        //  print_r($data); die();
        $data['classroutine'] = $this->ClassroutineModleAdmin->select_class_routine($data);

//        echo '<pre>';
//        print_r($data['classroutine']); die();

        if (!empty($data['classroutine'])) {
            $data['getnoticedata'] = $this->co_model->select_NoticeBoard();

            //   print_r($data); die();
            $data['title'] = "AIMS - Admin Panel";

            $data['main_content'] = $this->load->view('home/classroutinelist', $data, TRUE);
            $this->load->view('home/default', $data);
        } else {
            $message['message'] = "Data Not Found * Please Search Again";
            $this->session->set_userdata($message);
            redirect(base_url('home/searchclassroutine'));
        }
    }

    public function teacherattendance() {

        $data['title'] = "AIMS";
        $data['getnoticedata'] = $this->co_model->select_NoticeBoard();
        date_default_timezone_get("Asia/Dhaka");
        $data['today'] = date('d-m-Y');
        $data['getdata'] = $this->EmployeeModleAdmin->getDailyattendance($data['today']);
        $data['main_content'] = $this->load->view('home/emp_attendance', $data, TRUE);
        $this->load->view('home/default', $data);
    }

    public function searchattendance() {
        $this->load->helper(array('form', 'url'));
        $fromDate = $this->input->post('fromDate', TRUE);
        $toDate = $this->input->post('toDate', TRUE);
        $form_date = str_replace('/', '-', $fromDate);
        $to_date = str_replace('/', '-', $toDate);
        $data['fromDate'] = date('d-m-Y', strtotime($form_date));
        $data['toDate'] = date('d-m-Y', strtotime($to_date));
        //print_r($data); die();
        $data['title'] = "AIMS";
        $data['getnoticedata'] = $this->co_model->select_NoticeBoard();
        $data['getdata'] = $this->EmployeeModleAdmin->getEmployeeattendanceByDate($data['fromDate'], $data['toDate']);
//print_r($data['getdata']); die();
        $data['main_content'] = $this->load->view('home/emp_attendance', $data, TRUE);
        $this->load->view('home/default', $data);
    }


    private function getAdmissionResultList($po_id = 0, $status = 0)
    {
        //print_r($status);exit;
        $where = [];
        if ($po_id) {
            $where['ar.program_offer_id'] = $po_id;
        }
        // print_r($po_id);exit;
        $records = $this->db
            ->select('
                        ar.id,
                        ar.applicant_id,
                        ar.status,
                        si.firstName AS applicant_name,
                        ROUND(ar.bangla_mark) AS bangla_mark,
                        ROUND(ar.english_mark) AS english_mark,
                        ROUND(ar.math_mark) AS math_mark,
                        ROUND(ar.general_mark) AS general_mark,
                        ROUND(ar.bangla_mark + ar.english_mark + ar.math_mark + ar.general_mark) AS total_mark,
                        ac.ExamDate AS exam_date,
                        ac.ExamTime AS exam_time
                        ')
            ->from('applicant_results AS ar')
            ->join('admidcardinfo AS ac', 'ar.program_offer_id = ac.programOfferId')
            //->join('programoffer AS po', 'ac.programofferId = po.programofferId')
            ->join('studentinfo AS si', 'si.applicationId = ar.applicant_id', 'left')
            ->where($where)
            ->where_in('ar.status',[1,2])
            ->order_by('total_mark','desc')
            ->get()
            ->result();
        //print_r($this->db->last_query($records));
        return $records;
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */