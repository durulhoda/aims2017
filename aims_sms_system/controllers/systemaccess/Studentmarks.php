<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */

class Studentmarks extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->my_admin();
        $this->load->model('admin/studentmarks/StudentmarksModleAdmin', 'StudentmarksModleAdmin');
        $this->load->model('admin/courseassign/CourseAssignModleAdmin', 'CourseAssignModleAdmin');
        $this->load->model('admin/courseoffer/CourseOfferModleAdmin', 'CourseOfferModleAdmin');
        $this->load->model('admin/program/ProgramModleAdmin', 'ProgramModleAdmin');
        $this->load->model('admin/institute/InstituteModleAdmin', 'InstituteModleAdmin');
        $this->load->model('admin/student/StudentModleAdmin', 'StudentModleAdmin');
        // $this->load->model('admin/ResultModelAdmin', 'rma');
        $this->load->model('admin/result/Result_model_admin', 'rma');
    }

    public function generate_transcript()
    {
        $data = [];
        $this->validation_check();
        if ($this->form_validation->run() == FALSE) {

        } else {
            if ($_POST) {
                $data = $this->input->post('data', TRUE);
                $data['programOfferId'] = getProgramOfferId($data);
                // var_dump($data['programOfferId']);exit();
                if ($data['programOfferId']) {
                    $data['po_id'] = ($data['programOfferId']['programOfferId']) ? $data['programOfferId']['programOfferId']: 0;
                    $semester_id = ($data['semesterId']) ? $data['semesterId']: 0;
                     // var_dump($semester_id);exit();
                    if (!$this->CheckMarkResult($data['po_id'], $semester_id)) {
                        $sdata['errormessage'] = "Result Marks Not Inserted!";
                        $this->session->set_userdata($sdata);
                        redirect(admin_Url() . "/studentmarks/generate_transcript", "refresh");
                    }
                    $this->db->trans_begin();
                    $records = $this->rma->generate_transcript($data['po_id'], $semester_id);
                    if ($this->db->trans_status() === FALSE){
                        $this->db->trans_rollback();
                        $sdata['errormessage'] = 'Server Error!';
                    } else {
                        $this->db->trans_commit();
                        $sdata['message'] = 'Transcript Generate Successfully!';
                    }
                } else {
                    $sdata['errormessage'] = "Enrolment program is not offer yet";

                }
                $this->session->set_userdata($sdata);
                redirect(admin_Url() . "/studentmarks/generate_transcript", "refresh");
            }

        }
        $data['result'] = 'active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/studentmarks/marks/generate_transcript'); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
    }

    private function CheckMarkResult($programOfferId = 0, $semesterId = 0)
    {
        $record = $this->db
            ->where('programOfferId', $programOfferId)
            ->where('semesterId', $semesterId)
            ->get('studentmarks')
            ->result();
        if ($record) {
            return TRUE;
        }
        return FALSE;
    }


    public function transcriptView3() {

        $student_id = $this->input->get('stuent_id');
        $program_offer_id = $this->input->get('program_offer_id');;
        $semester_id = $this->input->get('semester_id');;
        $data = [];

        $data['institute_info'] = $this->rma->getInstituteInfo();
        $data['student_info'] = $this->rma->getStudentInfo($student_id);
        $data['roll_no'] = $this->rma->get_roll_no($student_id,$program_offer_id);
        $data['program_info'] = $this->rma->getProgramInfo($program_offer_id);
        $data['semester_id'] = $semester_id;
        $data['records'] = $this->rma->getStudentMarkSheet($program_offer_id, $semester_id, $student_id);
        // echo '<pre>';
        // print_r($data['records']);
        // exit;

        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/studentmarks/transcriptView3', $data);// ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link

    }

    public function search_all_transcripts()
    {
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
        $this->load->view('system_path/admin/common/top_menu'); // top bar menu
        $this->load->view('system_path/admin/studentmarks/transcript_search'); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery');
    }

    public function class_transcripts()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
            array(
                'field' => 'data[mediumId]',
                'label' => 'Medium',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[programId]',
                'label' => 'Class',
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
                'field' => 'data[sectionId]',
                'label' => 'Section',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[sessionId]',
                'label' => 'Session',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[semesterId]',
                'label' => 'Semester',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            $sdata = array();
            $sdata['errormessage'] = "Provide all information before search.. !!";
            $this->session->set_userdata($sdata);
            redirect(admin_Url() . "/studentmarks/search_all_transcripts", "refresh");
        }
        else
        {
            $data = $this->input->post('data', TRUE);
            $data['programOfferId'] = getProgramOfferId($data);
            if($data['programOfferId'])
            {
                $semester_id = $data['semesterId'];
                $programOfferId = $data['programOfferId']['programOfferId'];
                $data['students'] = $this->ProgramModleAdmin->getStudentInfo($programOfferId);
                $data['institute_info'] = $this->rma->getInstituteInfo();
                $data['program_info'] = $this->rma->getProgramInfo($programOfferId);
                $data['records']=array();
                foreach($data['students'] as $key=>$student)
                {
                    $data['student_info'][$key] = $this->rma->getStudentInfo($key);
                    $data['roll_no'][$key] = $this->rma->get_roll_no($key,$programOfferId);
                    $result = $this->rma->getStudentMarkSheet($programOfferId, $semester_id, $key);

                    if($result)
                    {
                        $data['records'][$key] = $result;
                    }
                }
                if($data['records'])
                {
                    $this->load->view('system_path/admin/common/header_link'); // header Css link
                    $this->load->view('system_path/admin/common/header'); // body header
                    $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                    $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                    $this->load->view('system_path/admin/studentmarks/transcriptView_for_all', $data);// ...........body content page...........
                    $this->load->view('system_path/admin/common/footer'); // footer & script link
                    $this->load->view('system_path/jsquery'); // footer & script link
                }
                else
                {
                    $sdata = array();
                    $sdata['message'] = "Result Not Found";
                    $this->session->set_userdata($sdata);
                    redirect(admin_Url() . "/studentmarks/search_all_transcripts", "refresh");
                }
            }
            else
            {
                $sdata = array();
                $sdata['message'] = "Enrollment Information is not offer yet";
                $this->session->set_userdata($sdata);
                redirect(admin_Url() . "/studentmarks/search_all_transcripts", "refresh");
            }
        }

    }

    public function index() {
        $data['result'] = 'active';
        //$data['offered_subject'] 
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/studentmarks/index'); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
    }

    public function search_student()
    {
        $data['result'] = 'active';
        //$data['offered_subject']
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/studentmarks/search_student'); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
    }

    public function search_student_marks()
    {
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
            ),
            array(
                'field' => 'data[courseId]',
                'label' => 'Subject',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[semesterId]',
                'label' => 'Semester',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            $sdata['errormessage'] = "Required Field Missing";
            $this->session->set_userdata($sdata);
            $data['result'] = 'active';
            $this->load->view('system_path/admin/common/header_link'); // header Css link
            $this->load->view('system_path/admin/common/header'); // body header
            $this->load->view('system_path/admin/common/side_menu'); // side bar menu
            $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
            $this->load->view('system_path/admin/studentmarks/search_student'); // ...........body content page...........
            $this->load->view('system_path/admin/common/footer'); // footer & script link
            $this->load->view('system_path/jsquery'); // footer & script link
        }
        else
        {
            $data = $this->input->post('data', TRUE);
            //print_r($data); die();
            $data['programOfferId'] = $this->ProgramModleAdmin->getProgramOfferId($data);
            if (!empty($data['programOfferId']))
            {
                $check = $this->ProgramModleAdmin->check_student_marks($data);
                //print_r($data['programOfferId']);exit;
                //print_r($check);exit;
                $programOfferId = $data['programOfferId']['programOfferId'];
                $data['student_roll'] = $this->StudentModleAdmin->getStudentRoll($programOfferId);
                if ($check)
                {
                    $data['courseofferlist'] = $this->CourseOfferModleAdmin->getcourseOfferId($data);

                    //   print_r($data['courseofferlist']);                 die();
                    if (!empty($data['courseofferlist'])) {
                        $offerid=$data['courseofferlist']['offerId'];
                        $data['dividemark'] = $this->CourseOfferModleAdmin->getcoursedvdmark($offerid);
                        $data['employeeId']=$data['courseofferlist']['employeeId'];
                        $result = $this->StudentmarksModleAdmin->searchsubject($data);
                        ini_set('max_execution_time', 0);
                        $data['studentlist'] = $this->CourseAssignModleAdmin->AssignedCourseStudents($data);

                        if (!$result)
                        {
                            $sdata['errormessage'] = "This Teacher is not Assinged for this Subject in this Class";
                            $this->session->set_userdata($sdata);
                            redirect(admin_Url() . "/studentmarks/search_student", "refresh");
                        }
                        elseif (!$data['studentlist']) {
                            $sdata['errormessage'] = "There are no Student found for this searching value ";
                            $this->session->set_userdata($sdata);
                            redirect(admin_Url() . "/studentmarks/search_student", "refresh");
                        }
                        else {
                            foreach($check as $item)
                            {
                                $data['students_marks'][$item['studentId']]=$item;
                            }

                            if (isset($_POST['search'])) {  // if entry mark for a subject then this will be working ..this occure when search button press
                                // echo '<pre>'; print_r($data['student_roll'] );exit;
                                //echo 'hi';exit;
                                $data['institute_info'] = $this->rma->getInstituteInfo();
                                //echo '<pre>';print_r($data);exit;
                                $data['result'] = 'active';
                                $this->load->view('system_path/admin/common/header_link'); // header Css link
                                $this->load->view('system_path/admin/common/header'); // body header
                                $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                                $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                                $this->load->view('system_path/admin/studentmarks/student_mark_list', $data); // ...........body content page...........
                                $this->load->view('system_path/admin/common/footer'); // footer & script link
                            }
                            elseif (isset($_POST['print'])) {  // if print mark shhet list with student for a class then this will be working..this occure when print button press
                                //     print_r($data['studentlist']); die();
                                $this->load->view('system_path/admin/common/header_link'); // header Css link
                                $this->load->view('system_path/admin/studentmarks/printsheet', $data); // ...........body content page...........
                                $this->load->view('system_path/admin/common/footer'); // footer & script link
                            }
                            else
                            {
                                $sdata['errormessage'] = "No Result Found";
                                $this->session->set_userdata($sdata);
                                redirect(admin_Url() . "/studentmarks/search_student", "refresh");
                            }
                        }
                    }
                    else {
                        $sdata['errormessage'] = "Teacher Not Found for this Subject";
                        $this->session->set_userdata($sdata);
                        redirect(admin_Url() . "/studentmarks/search_student", "refresh");
                    }
                }
                else
                {
                    $sdata['errormessage'] = "Subject marks not added yet";
                    $this->session->set_userdata($sdata);
                    redirect(admin_Url() . "/studentmarks/search_student", "refresh");
                }
            }
            else
            {
                $sdata['errormessage'] = "Enrolment program is not offer yet";
                $this->session->set_userdata($sdata);
                redirect(admin_Url() . "/studentmarks/search_student", "refresh");
            }
        }
    }

    public function update_inserted_marks()
    {
        $chk_serials = $this->input->post('chk_serial');
        $studentIds = $this->input->post('studentId');
        $other_marks = $this->input->post('other_marks');
        $count_input = $this->input->post('count_input');
        $semesterId = $this->input->post('semesterId');
        $courseId = $this->input->post('courseId');
        $programOfferId = $this->input->post('programOfferId');
        $employeeId = $this->input->post('employeeId');
        //echo $employeeId;exit;


        foreach($other_marks as $index=>$item)
        {
            $total_marks[$index] =  array_sum($item);
            $marks[$index]=",".implode(',', $item)."," ;
        }

        $this->db->from('studentmarks');
        $this->db->select('studentId');
        $this->db->where('programOfferId', $programOfferId);
        $this->db->where('courseId', $courseId);
        $this->db->where('semesterId', $semesterId);
        $student_array=$this->db->get()->result_array();
        foreach($student_array as $st_arr)
        {
            $stu_array[]=$st_arr['studentId'];
        }

        foreach($studentIds as $item)
        {
            if(in_array($item,$stu_array))
            {
                $final['divide_mark'] = $marks[$item];
                $final['marks'] = $total_marks[$item];
                $final['entryDate'] = date('d-m-Y');
                $this->db->where('studentId', $item);
                $this->db->where('programOfferId', $programOfferId);
                $this->db->where('courseId', $courseId);
                $this->db->where('semesterId', $semesterId);
                $this->db->update('studentmarks',$final);
            }
            else
            {
                $new=array();
                $new['studentId']=$item;
                $new['divide_mark']=$marks[$item];
                $new['marks']=$total_marks[$item];
                $new['entryDate']=date('d-m-Y');
                $new['programOfferId']=$programOfferId;
                $new['employeeId']=$employeeId;
                $new['courseId']=$courseId;
                $new['semesterId']=$semesterId;
                $this->db->insert('studentmarks',$new);
            }
        }

        $sdata['message'] = "Student marks updated successfully";
        $this->session->set_userdata($sdata);
        redirect(admin_Url() . "/studentmarks/search_student", "refresh");
    }

    public function searchstudentlist() {

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
            ),
            array(
                'field' => 'data[courseId]',
                'label' => 'Subject',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[semesterId]',
                'label' => 'Semester',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            $sdata['errormessage'] = "Required Field Missing";
            $this->session->set_userdata($sdata);
            $data['result'] = 'active';
            $this->load->view('system_path/admin/common/header_link'); // header Css link
            $this->load->view('system_path/admin/common/header'); // body header
            $this->load->view('system_path/admin/common/side_menu'); // side bar menu
            $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
            $this->load->view('system_path/admin/studentmarks/index'); // ...........body content page...........
            $this->load->view('system_path/admin/common/footer'); // footer & script link
            $this->load->view('system_path/jsquery'); // footer & script link
        }
        else {
            $data = $this->input->post('data', TRUE);
            //print_r($data); die();
            $data['programOfferId'] = $this->ProgramModleAdmin->getProgramOfferId($data);
            if (!empty($data['programOfferId'])) {
                $check = $this->ProgramModleAdmin->checkProgramOfferAndSemester($data);
                //print_r($data['programOfferId']);exit;
                //print_r($check);exit;
                $programOfferId = $data['programOfferId']['programOfferId'];
                $data['student_roll'] = $this->StudentModleAdmin->getStudentRoll($programOfferId);

                if ($check) {
                    // $data['employeeId'] = getEmployeeIdByProgramAndSubject($data['programOfferId'], $data['courseId']); // get EmployeeId Fromcourse offer table by courseId

                    $data['courseofferlist'] = $this->CourseOfferModleAdmin->getcourseOfferId($data);

                    //   print_r($data['courseofferlist']);                 die();
                    if (!empty($data['courseofferlist'])) {
                        $offerid=$data['courseofferlist']['offerId'];
                        $data['dividemark'] = $this->CourseOfferModleAdmin->getcoursedvdmark($offerid);
                        $data['employeeId']=$data['courseofferlist']['employeeId'];
                        $result = $this->StudentmarksModleAdmin->searchsubject($data);
                        ini_set('max_execution_time', 0);
                        $data['studentlist'] = $this->CourseAssignModleAdmin->AssignedCourseStudents($data);

                        //echo '<pre>';
                        //print_r($data['studentlist']);die();

                        //  print_r($data['listbytype']); die();

                        if (!$result) {
                            $sdata['errormessage'] = "This Teacher is not Assinged for this Subject in this Class";
                            $this->session->set_userdata($sdata);
                            redirect(admin_Url() . "/studentmarks", "refresh");
                        } elseif (!$data['studentlist']) {
                            $sdata['errormessage'] = "There are no Student found for this searching value ";
                            $this->session->set_userdata($sdata);
                            redirect(admin_Url() . "/studentmarks", "refresh");
                        } else {

                            if (isset($_POST['search'])) {  // if entry mark for a subject then this will be working ..this occure when search button press
                                // echo '<pre>'; print_r($data['student_roll'] );exit;
                                //echo 'hi';exit;
                                $data['institute_info'] = $this->rma->getInstituteInfo();
                                //echo '<pre>';print_r($data);exit;
                                $data['result'] = 'active';
                                $this->load->view('system_path/admin/common/header_link'); // header Css link
                                $this->load->view('system_path/admin/common/header'); // body header
                                $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                                $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                                $this->load->view('system_path/admin/studentmarks/searchstudentlist', $data); // ...........body content page...........
                                $this->load->view('system_path/admin/common/footer'); // footer & script link
                            } elseif (isset($_POST['print'])) {  // if print mark shhet list with student for a class then this will be working..this occure when print button press
                                //     print_r($data['studentlist']); die();
                                $this->load->view('system_path/admin/common/header_link'); // header Css link
                                $this->load->view('system_path/admin/studentmarks/printsheet', $data); // ...........body content page...........
                                $this->load->view('system_path/admin/common/footer'); // footer & script link
                            } else {
                                $sdata['errormessage'] = "No Result Found";
                                $this->session->set_userdata($sdata);

                                redirect(admin_Url() . "/studentmarks", "refresh");
                            }
                        }
                    } else {
                        $sdata['errormessage'] = "Teacher Not Found for this Subject";
                        $this->session->set_userdata($sdata);
                        redirect(admin_Url() . "/studentmarks", "refresh");
                    }
                } else {
                    $sdata['errormessage'] = "Already Submitted!";
                    $this->session->set_userdata($sdata);
                    redirect(admin_Url() . "/studentmarks", "refresh");
                } }else {
                $sdata['errormessage'] = "Enrolment program is not offer yet";
                $this->session->set_userdata($sdata);
                redirect(admin_Url() . "/studentmarks", "refresh");
            }
        }
    }

    private function checkAssignId($assign_id = 0)
    {
        $record = $this->db
            ->where('markId', $assign_id)
            ->get('studentmarks')
            ->row();
        if ($record) {
            return TRUE;
        }
        return FALSE;
    }

    public function insert_mark_save()
    {
        $other_marks = $this->input->post('other_marks', TRUE);
        $divide_mark = ",".implode(',', $other_marks)."," ;
        $marks =  array_sum($other_marks);
        $assign_id = $this->input->post('assign_id', TRUE);
        //echo '<pre>';print_r($_POST);
        if ($assign_id) {
            if ($this->checkAssignId($assign_id)) {
                $update = [
                    'divide_mark' => $divide_mark,
                    'marks' => $marks
                ];
                //echo '<pre>';print_r($update);exit;
                $this->db
                    ->where('markId', $assign_id)
                    ->update('studentmarks', $update);
                if ($this->db->affected_rows()) {
                    $sdata['message'] = 'Marks Updated!';
                } else {
                    $sdata['message'] = 'Marks No Updated!';
                }
            } else {
                $sdata['message'] = 'No Found Insert Marks Id!';
            }
        } else {
            $studentId = $this->input->post('studentId', TRUE);
            $programOfferId = $this->input->post('programOfferId', TRUE);
            $employeeId = $this->input->post('employeeId', TRUE);
            $courseId = $this->input->post('courseId', TRUE);
            $semesterId = $this->input->post('semesterId', TRUE);
            if ($studentId && $programOfferId && $employeeId && $courseId && $semesterId) {
                $insert = [
                    'studentId' => $studentId,
                    'programOfferId' => $programOfferId,
                    'employeeId' => $employeeId,
                    'courseId' => $courseId,
                    'semesterId' => $semesterId,
                    'divide_mark' => $divide_mark,
                    'marks' => $marks,
                    'entryDate' => date('d-m-Y')
                ];
                $this->db->insert('studentmarks', $insert);
                if ($this->db->insert_id()) {
                    $sdata['message'] = 'Marks Inserted!';
                } else {
                    $sdata['message'] = 'Marks No Inserted!';
                }
            } else {
                $sdata['message'] = 'Any Value Not Found!';
            }
        }
        $this->session->set_userdata($sdata);
        redirect(admin_Url() . "/studentmarks/insert_mark_list", "refresh");

    }

    public function insert_mark_list()
    {
        $data = [];
        $this->insert_marks_validation_check();
        if ($this->form_validation->run() == FALSE) {
        } else {
            if ($_POST) {

                $data = $this->input->post('data', TRUE);
                $data['programOfferId'] = $this->ProgramModleAdmin->getProgramOfferId($data);
                if($data['programOfferId'] && $data['programOfferId']['programOfferId']) {
                    $data['courseofferlist'] = $this->CourseOfferModleAdmin->getcourseOfferId($data);
//                    echo '<pre>';
//                    print_r($data);exit;
                    if ($data['courseofferlist']) {
                        $offerId = $data['courseofferlist']['offerId'];
                        $data['dividemark'] = $this->CourseOfferModleAdmin->getcoursedvdmark($offerId);
                        $data['employeeId']=$data['courseofferlist']['employeeId'];
                        $programOfferId = ($data['programOfferId']['programOfferId']) ? $data['programOfferId']['programOfferId'] : 0;
                        $check = $this->check_student_subject($data, $programOfferId);
                        //$data['student_list'] = $this->ProgramModleAdmin->getStudentAssignList($data['programOfferId']['programOfferId'],$data['courseId']);
                        $data['student_list'] = $this->getStudentMark($data, $programOfferId);
                        $data['studentInfo'] = $this->ProgramModleAdmin->getStudentInfo($data['programOfferId']['programOfferId']);
                        $data['student_roll'] = $this->StudentModleAdmin->getStudentRoll($data['programOfferId']['programOfferId']);
//                        echo '<pre>';
//                        print_r($data['student_list']);exit;

                    } else {
                        $sdata['errormessage'] = "Teacher Not Found for this Subject";
                        $this->session->set_userdata($sdata);
                        redirect(admin_Url() . "/insert_mark_list", "refresh");
                    }

                } else {
                    $sdata['errormessage'] = "Enrolment program is not offer yet";
                    $this->session->set_userdata($sdata);
                    redirect(admin_Url() . "/insert_mark_list", "refresh");
                }
            }
        }
        $data['result'] = 'active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/studentmarks/marks/mark_list'); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
    }

    private function check_student_subject($data,$programOfferId)
    {
        $semesterId = $data['semesterId'];
        $courseId = $data['courseofferlist']['courseId'];
        $employeeId = $data['courseofferlist']['employeeId'];

        //get all student subjects
        $this->db->select('*');
        $this->db->from('studentassigncourse');
        $this->db->where('programOfferId',$programOfferId);
        $student_assign_subjects=$this->db->get()->result_array();

        //get existing student subjects and marks
        $this->db->select('*');
        $this->db->from('studentmarks');
        $this->db->where('programOfferId',$programOfferId);
        $this->db->where('courseId',$courseId);
        $this->db->where('semesterId',$semesterId);
        $result=$this->db->get()->result_array();

        $student_marks=array();
        foreach($result as $marks)
        {
            $student_marks[$marks['studentId']] = $marks;
        }

        if($student_assign_subjects && $student_marks)
        {
            $all_student=array();
            $new_student=array();
            foreach($student_assign_subjects as $item)
            {
                $check[$item['studentId']] = explode(',',$item['courseId']);
                if (in_array($courseId,$check[$item['studentId']]))
                {
                    $all_student[$item['studentId']]=$item;
                }
            }
            foreach($all_student as $index=>$item)
            {
                if (!array_key_exists($index,$student_marks))
                {
                    $new_student[]=$item;
                }
            }

            if($new_student)
            {
                if($data['dividemark']['divide_mark'])
                {
                    $divide_mark='';
                    $number = count(explode(',',$data['dividemark']['divide_mark']));
                    for($i=1;$i<$number;$i++)
                    {
                        $divide_mark .= ',';
                    }
                }
                foreach($new_student as $value)
                {
                    $final_data=array();
                    $final_data['studentId'] = $value['studentId'];
                    $final_data['programOfferId'] = $programOfferId;
                    $final_data['employeeId'] = $employeeId;
                    $final_data['courseId'] = $courseId;
                    $final_data['semesterId'] = $semesterId;
                    $final_data['examtypeId'] = null;
                    $final_data['divide_mark'] = $divide_mark;
                    $final_data['marks'] = 0;
                    $final_data['entryDate'] = date("d-m-Y",time());
                    $this->db->insert('studentmarks',$final_data);
                }
            }
        }
        else
        {
            return true;
        }
    }

    private function getStudentMark($data = [], $programOfferId = 0)
    {

        $employeeId = $this->session->userdata('emp_userName');
        $where = [];
        if($programOfferId) {
            $where['sm.programOfferId'] = trim($programOfferId);
        }
        if(isset($data['studentId']) && $data['studentId']) {
            $where['sm.studentId'] = trim($data['studentId']);
        }

        if(isset($data['courseId']) && $data['courseId']) {
            $where['sm.courseId'] = trim($data['courseId']);
        }

        if($data['semesterId']) {
            $where['sm.semesterId'] = trim($data['semesterId']);
        }

        if ($employeeId) {
            $where['sm.employeeId'] = trim($employeeId);
        }

        if ($data['sessionId']) {
            $where['po.sessionId'] = trim($data['sessionId']);
        }

        $records = $this->db
            ->select('
                        md.mark_cat_id,
                        sm.studentId,
                        sm.divide_mark,
                        sm.marks,
                        sm.markId,
                        sm.courseId,
                        c.courseName,
                        c.courseCode,
                        c.totalMark As courseMark,
                        sinfo.firstName AS student_name
                        ')
            ->from('studentmarks AS sm')
            ->join('programoffer AS po', 'sm.programOfferId = po.programOfferId')
            ->join('course AS c', 'c.courseId = sm.courseId')
            ->join('courseoffer AS co', 'co.courseId = sm.courseId AND co.programOfferId = '.$programOfferId.'')
            ->join('mark_divide AS md', 'md.course_offerId = co.offerId')
            ->join('student AS s','sm.studentId = s.studentId')
            ->join('studentinfo AS sinfo','sinfo.applicationId = s.applicationId')
            ->where($where)
            ->get()
            ->result();
        // echo '<pre>';print_r($records);exit;
//        echo '<pre>';
//        print_r($records);exit;
        return $records;
    }


    public function mark_add($assign_id = 0) {
        $data = [];
        if ($assign_id) {
            $data = $this->getSudentMarksInfo($assign_id);
            $data['title'] = "Update";
            $data['assign_id'] = $assign_id;
            $data['data'] = $this->getProgramOfferInfo($data['programOfferId']);
        } else {
            $data['programOfferId'] = $this->input->get('programOfferId');
            $data['studentId'] = $this->input->get('studentId');
            $data['courseId'] = $this->input->get('courseId');
            $data['semesterId'] = $this->input->get('semesterId');
            $data['employeeId'] = $this->input->get('employeeId');
            $data['title'] = "Insert";
            $data['data'] = $this->getProgramOfferInfo($data['programOfferId']);
        }

        if ($data['programOfferId']) {
            $data['courseList'] = $this->CourseOfferModleAdmin->getcourseOfferId1($data['courseId'], $data['programOfferId']);
            if ($data['courseList']) {
                $offerId = $data['courseList']['offerId'];
                $data['dividemark'] = $this->CourseOfferModleAdmin->getcoursedvdmark($offerId);
            } else {
                $sdata['errormessage'] = "Teacher Not Found for this Subject";
                $this->session->set_userdata($sdata);
                redirect(admin_Url() . "/insert_mark_list", "refresh");
            }
        } else {
            $sdata['errormessage'] = "Enrolment program is not offer yet";
            $this->session->set_userdata($sdata);
            redirect(admin_Url() . "/insert_mark_list", "refresh");
        }

        //echo '<pre>';print_r($data);exit;
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/studentmarks/marks/add'); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
    }

    private function getSudentMarksInfo($assign_id = 0)
    {
        $record = $this->db
            ->select('')
            ->where('markId', $assign_id)
            ->get('studentmarks')
            ->row_array();
        return $record;
    }

    private function getProgramOfferInfo($programOfferId = 0)
    {
        $record = $this->db->where('programOfferId', $programOfferId)->get('programoffer')->row_array();
        return $record;
    }
    private function insert_marks_validation_check()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
            array(
                'field' => 'data[mediumId]',
                'label' => 'Medium',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[programId]',
                'label' => 'Class',
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
                'field' => 'data[sectionId]',
                'label' => 'Section',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[sessionId]',
                'label' => 'Session',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[semesterId]',
                'label' => 'Semester',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[courseId]',
                'label' => 'Course',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);
    }

    public function savemarks() {
//        echo '<pre>';print_r($_POST);exit;

        $chk_serial     = $this->input->post('chk_serial', TRUE);
        $studentId      = $this->input->post('studentId', TRUE);
        $other_marks    = $this->input->post('other_marks', TRUE);
        $semesterId     = $this->input->post('semesterId', TRUE);
        $examtypeId     = $this->input->post('examtypeId', TRUE);
        $employeeId     = $this->input->post('employeeId', TRUE);
        $courseId       = $this->input->post('courseId', TRUE);
        $programOfferId = $this->input->post('programOfferId', TRUE);
        $count_input     = $this->input->post('count_input', TRUE);

        $count = count($chk_serial);

        $flag = array_chunk($other_marks, $count_input);
        $values=0;
        $coustu=0;

        for ($i=0; $i < $count ; $i++) {

            $stu_serial=$chk_serial[$i]-1;

            foreach($flag  as $key=>$value){
                if($key==$stu_serial)
                {
                    $abc[] = ",".implode(',', $value)."," ;
                    $total_marks= array_sum($value);
                    break;
                }
            }


            $studentId[$stu_serial];
            # code...
            $abc[$i];

            $data = array(
                'studentId' => $studentId[$stu_serial],
                'divide_mark' => $abc[$i],
                'marks' => $total_marks,
                'semesterId' => $semesterId,
                'examtypeId' => $examtypeId,
                'courseId' => $courseId,
                'programOfferId' => $programOfferId,
                'employeeId' => $employeeId
            );

            // echo "<pre>";
            // print_r($data);exit;

            $result = $this->StudentmarksModleAdmin->duplicateExamMarks($data);

            if ($result) {
                $cou = count($result['studentId']);
                $coustu = $cou + $coustu;
            } else {
                $this->StudentmarksModleAdmin->savemarks($data);
                $insertid = $this->db->insert_id();
            }

        }
//        die();

        if ($coustu > 0 || empty($insertid)) {
            $sdata['errormessage'] = 'Duplicate entry found for ' . $coustu . ' Student...';
            $this->session->set_userdata($sdata);
            redirect(admin_Url() . "/studentmarks", "refresh");
        } else {
            $sdata['message'] = 'Marks Added!';
            $this->session->set_userdata($sdata);
            redirect(admin_Url() . "/studentmarks", "refresh");
        }
    }

    public function markslist() {
        $data['result'] = 'active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/studentmarks/marks_list'); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
    }

    public function edit_studentmarks($studentId,$markId) {

        $data['editData']= $this->StudentmarksModleAdmin->getstudentmarkinfo($studentId,$markId);

        if (!empty($data['editData'])) {
            $daata['programOfferId']=$data['editData']['programOfferId'];
            $daata['courseId']=$data['editData']['courseId'];
            $data['dividemark'] = $this->CourseOfferModleAdmin->getcoursedvdmark_byPrgid_Subject($daata);
//        print_r($data);
//        die();
            $data['result'] = 'active';
            $this->load->view('system_path/admin/common/header_link'); // header Css link
            $this->load->view('system_path/admin/common/header'); // body header
            $this->load->view('system_path/admin/common/side_menu'); // side bar menu
            $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
            $this->load->view('system_path/admin/studentmarks/edit_marks_list',$data); // ...........body content page...........
            $this->load->view('system_path/admin/common/footer'); // footer & script link
            $this->load->view('system_path/jsquery'); // footer & script link

        }
        else {
            $sdata['errormessage'] = 'Marks not found!';
            $this->session->set_userdata($sdata);
            redirect(admin_Url() . "/studentmarks", "refresh");
        }
    }


    public function updateStudentmarks($markId) {
        $markId=(int)$markId;
        if(!empty($markId))
        {
            $daata = $this->input->post('data', TRUE);
            $other_marks    = $this->input->post('other_marks', TRUE);
            $count_input     = $this->input->post('count_input', TRUE);

            $flag = array_chunk($other_marks, $count_input); //array_marks_value as per input box
            foreach($flag  as $key=>$value){
                $abc = ",".implode(',', $value)."," ;
                $total_marks= array_sum($value);
            }

            $daata['divide_mark']=$abc;
            $daata['marks']=$total_marks;

            //  print_r($daata); die();
            $updt=$this->StudentmarksModleAdmin->updatestudentmarks($daata, $markId);
            if($updt)
            {
                $sdata = array();
                $sdata['message'] = 'Updated Successfully !';
                $this->session->set_userdata($sdata);

                redirect(admin_Url() . "/studentmarks/markslist", "refresh");
            }
            else
            {
                $sdata = array();
                $sdata['message'] = 'Result not updated...try again';
                $this->session->set_userdata($sdata);

                redirect(admin_Url() . "/studentmarks/markslist", "refresh");
            }
        }

    }

    public function deleteStudentmarks($studentId, $markId) {

        $dlt=$this->StudentmarksModleAdmin->deletestudentmarks($studentId, $markId);

        //    echo $studentId."-".$markId; die();
        if($dlt){
            $sdata['message'] = 'Marks deleted';
            $this->session->set_userdata($sdata);
            redirect(admin_Url() . "/studentmarks/searchresultsByClass", "refresh");
        }
        else{
            $sdata['errormessage'] = 'Marks not found!';
            $this->session->set_userdata($sdata);
            redirect(admin_Url() . "/studentmarks/markslistd", "refresh");
        }

    }

    public function searchresultsByStudent() {
        $data = $this->input->post('data', TRUE);
        if (!empty($data)) {
            $data['programOfferId'] = $this->ProgramModleAdmin->getProgramOfferIdBySessionStudent($data);
            // print_r($data); die();
            if (!empty($data['programOfferId'])) {
                $data['markslist'] = $this->StudentmarksModleAdmin->getmarksByStudent($data);
                //echo "<pre>";print_r($data['markslist']);die();
                if (!empty($data['markslist']) && !empty($data['studentId']) && !empty($data['semesterId'])) {
                    $data['studentinfo'] = $this->StudentModleAdmin->getstudentPersonal_Info($data['studentId']);
                    $data['result'] = 'active';
                    $this->load->view('system_path/admin/common/header_link'); // header Css link
                    $this->load->view('system_path/admin/common/header'); // body header
                    $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                    $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                    $this->load->view('system_path/admin/studentmarks/marks_list', $data); // ...........body content page...........
                    $this->load->view('system_path/admin/common/footer'); // footer & script link
                    $this->load->view('system_path/jsquery'); // footer & script link
                } elseif (empty($data['markslist'])) {
                    $sdata['errormessage'] = "No Result Found";
                    $this->session->set_userdata($sdata);
                    redirect(admin_Url() . "/studentmarks/markslist", "refresh");
                } else {
                    $sdata = array();
                    $sdata['errormessage'] = "Select both StudentId & Semester";
                    $this->session->set_userdata($sdata);
                    redirect(admin_Url() . "/studentmarks/markslist", "refresh");
                }
            } else {
                $sdata['errormessage'] = "No Result Found";
                $this->session->set_userdata($sdata);
                redirect(admin_Url() . "/studentmarks/markslist", "refresh");
            }
        } else {
            $sdata['errormessage'] = "Fill Up all field";
            $this->session->set_userdata($sdata);
            redirect(admin_Url() . "/studentmarks/markslist", "refresh");
        }
    }

    public function searchresultsByClass() {

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
            ),
            array(
                'field' => 'data[courseId]',
                'label' => 'Subject',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[semesterId]',
                'label' => 'Semester',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            $sdata['errormessage'] = "Please Fill Up all field";
            $this->session->set_userdata($sdata);
            redirect(admin_Url() . "/studentmarks/markslist", "refresh");
        } else {
            $data = $this->input->post('data', TRUE);
            //   print_r($data); die();
            $data['programOfferId'] = $this->ProgramModleAdmin->getProgramOfferId($data);

            if (!empty($data['programOfferId'])) {
                $data['markslist'] = $this->StudentmarksModleAdmin->getmarksByClass($data);
//                echo '<pre>';print_r($data);
//                exit;
                if (!empty($data['markslist'])) {
                    $data['result'] = 'active';
                    $this->load->view('system_path/admin/common/header_link'); // header Css link
                    $this->load->view('system_path/admin/common/header'); // body header
                    $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                    $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                    $this->load->view('system_path/admin/studentmarks/marks_list_class', $data); // ...........body content page...........
                    $this->load->view('system_path/admin/common/footer'); // footer & script link
                    $this->load->view('system_path/jsquery'); // footer & script link
                } else {
                    $sdata['errormessage'] = "No Result Found";
                    $this->session->set_userdata($sdata);
                    redirect(admin_Url() . "/studentmarks/markslist", "refresh");
                }
            } else {
                $sdata['errormessage'] = "Classoffer Information is not offer yet";
                $this->session->set_userdata($sdata);
                redirect(admin_Url() . "/studentmarks/markslist", "refresh");
            }
        }
    }

    public function transcriptView2() {
        //if (isset($_POST['generate'])) {
        //$student_id = 201710429;
        // $student_id = 201706212;
        // $program_offer_id = 1;
        // $semester_id = 3;
        $student_id = $this->input->get('stuent_id');
        $program_offer_id = $this->input->get('program_offer_id');;
        $semester_id = $this->input->get('semester_id');;
        $data = [];
        // $data = $this->input->post('data', TRUE);
        // if (!empty($data)) {
        //     $program_offer_id = $data['programOfferId'];
        //     $student_id = $data['studentId'];
        //     $semester_id = $data['semesterId'];
        $data['institute_info'] = $this->rma->getInstituteInfo();
        $data['student_info'] = $this->rma->getStudentInfo($student_id);
        $data['program_info'] = $this->rma->getProgramInfo($program_offer_id);
        $data['semester_id'] = $semester_id;
        $data['records'] = $this->rma->getStudentResult($student_id, $program_offer_id, $semester_id);
        //$position = $this->rma->getStudentPosition($program_offer_id, $semester_id);
        $position = $this->rma->getStudentResultInfo($program_offer_id, $semester_id);
        $data['student_position'] = isset($position[$student_id]) ? $position[$student_id] : 0;
        // echo '<pre>';print_r($semester_id);
        // exit;
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/studentmarks/transcriptView1', $data);// ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
        //     } else {
        //         $sdata['errormessage'] = "Result Not Found";
        //         $this->session->set_userdata($sdata);
        //         redirect(admin_Url() . "/studentmarks/markslist", "refresh");
        //     } 
        // } else {
        //     $sdata['errormessage'] = "Result Not Found";
        //     $this->session->set_userdata($sdata);
        //     redirect(admin_Url() . "/studentmarks/markslist", "refresh");
        // }

    }

    public function transcriptView1() {
        if (isset($_POST['generate'])) {
            // $student_id = 201710429;
            // $student_id = 201710186;
            // $program_offer_id = 34;
            // $semester_id = 4;
            $data = [];
            $data = $this->input->post('data', TRUE);
            // print_r($data);exit;
            if (!empty($data)) {
                $program_offer_id = $data['programOfferId'];
                $student_id = $data['studentId'];
                $semester_id = $data['semesterId'];
                $data['institute_info'] = $this->rma->getInstituteInfo();
                $data['student_info'] = $this->rma->getStudentInfo($student_id);
                $data['program_info'] = $this->rma->getProgramInfo($program_offer_id);
                $data['semester_id'] = $semester_id;
                $data['records'] = $this->rma->getStudentResult($student_id, $program_offer_id, $semester_id);
                //echo "<pre>";print_r($data['records']);die();
                // $position = $this->rma->getStudentPosition($program_offer_id, $semester_id);
                $position = $this->rma->getStudentResultInfo($program_offer_id, $semester_id);
                $data['student_position'] = isset($position[$student_id]) ? $position[$student_id] : 0;
                //  echo '<pre>';print_r($data);
                // exit;
                $this->load->view('system_path/admin/common/header_link'); // header Css link
                $this->load->view('system_path/admin/common/header'); // body header
                $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                $this->load->view('system_path/admin/studentmarks/transcriptView1', $data);// ...........body content page...........
                $this->load->view('system_path/admin/common/footer'); // footer & script link
                $this->load->view('system_path/jsquery'); // footer & script link
            } else {
                $sdata['errormessage'] = "Result Not Found";
                $this->session->set_userdata($sdata);
                redirect(admin_Url() . "/studentmarks/markslist", "refresh");
            }
        } else {
            $sdata['errormessage'] = "Result Not Found";
            $this->session->set_userdata($sdata);
            redirect(admin_Url() . "/studentmarks/markslist", "refresh");
        }

    }

    public function transcriptView() {

        if (isset($_POST['generate'])) {
            $data = $this->input->post('data', TRUE);
            //print_r($data);exit;

            if (!empty($data)) {

                $assigncourselist = getAssignCourseListByPrg_stuid($data['programOfferId'], $data['studentId']);
                $explodeCourse = array_filter(explode(',', trim($assigncourselist['courseId'])));

                $explodeCourseStatus = array_filter(explode(',', trim($assigncourselist['courseStatus'])));

                // print_r($data); die();
                if (!empty($assigncourselist)) {
                    $markslist = $this->StudentmarksModleAdmin->getmarksByStudentTranscriptView($data);
                    // echo "<pre>";
                    // print_r($markslist);die();


                    $count=count($markslist);

                    $newMark=array();
                    for($i=0;$i<$count;$i++){
                        $newMark[]=array(
                            'markId' =>$markslist[$i]['markId'],
                            'studentId' =>$markslist[$i]['studentId'],
                            'programOfferId' =>$markslist[$i]['programOfferId'],
                            'employeeId' =>$markslist[$i]['employeeId'],
                            'courseId' =>$markslist[$i]['courseId'],
                            'semesterId' =>$markslist[$i]['semesterId'],
                            'examtypeId' =>$markslist[$i]['examtypeId'],
                            'divide_mark' =>$markslist[$i]['divide_mark'],
                            'marks' =>$markslist[$i]['marks'],
                            'entryDate' =>$markslist[$i]['entryDate'],
                            'courseName' =>$markslist[$i]['courseName'],
                            'courseCode' =>$markslist[$i]['courseCode'],
                            'totalMark' =>$markslist[$i]['totalMark'],
                            'marge' =>$markslist[$i]['marge'],
                            'programLevel' =>$markslist[$i]['programLevel'],
                            'semester' =>$markslist[$i]['semester'],
                            'quata' => isset($markslist[$i]['quata']),
                            'status'=> !empty($explodeCourseStatus[$i+1])? $explodeCourseStatus[$i+1] : 1
                        );
                    }

                    foreach($newMark as $value){
                        if($value['status']==1){
                            $shortestMark[]=array(
                                'markId' =>$value['markId'],
                                'studentId' =>$value['studentId'],
                                'programOfferId' =>$value['programOfferId'],
                                'employeeId' =>$value['employeeId'],
                                'courseId' =>$value['courseId'],
                                'semesterId' =>$value['semesterId'],
                                'examtypeId' =>$value['examtypeId'],
                                'divide_mark' =>$value['divide_mark'],
                                'marks' =>$value['marks'],
                                'entryDate' =>$value['entryDate'],
                                'courseName' =>$value['courseName'],
                                'courseCode' =>$value['courseCode'],
                                'totalMark' =>$value['totalMark'],
                                'marge' =>$value['marge'],
                                'programLevel' =>$value['programLevel'],
                                'semester' =>$value['semester'],
                                'quata' => isset($value['quata']),
                                'status'=> $value['status']
                            );
                        }
                    }

                    foreach($newMark as $value){
                        if($value['status']==2){
                            $shortestMark[]=array(
                                'markId' =>$value['markId'],
                                'studentId' =>$value['studentId'],
                                'programOfferId' =>$value['programOfferId'],
                                'employeeId' =>$value['employeeId'],
                                'courseId' =>$value['courseId'],
                                'semesterId' =>$value['semesterId'],
                                'examtypeId' =>$value['examtypeId'],
                                'divide_mark' =>$value['divide_mark'],
                                'marks' =>$value['marks'],
                                'entryDate' =>$value['entryDate'],
                                'courseName' =>$value['courseName'],
                                'courseCode' =>$value['courseCode'],
                                'totalMark' =>$value['totalMark'],
                                'marge' =>$value['marge'],
                                'programLevel' =>$value['programLevel'],
                                'semester' =>$value['semester'],
                                'quata' => isset($value['quata']),
                                'status'=> $value['status']
                            );
                        }
                    }

                    $data['markslist']=$shortestMark;
                    $data['studentlist'] = $this->StudentModleAdmin->getstudentNameInfo($data['studentId']);
                    $data['programinfo'] = $this->ProgramModleAdmin->getofferProgramInfoById($data['programOfferId']);


                    $data['result'] = 'active';
                    $this->load->view('system_path/admin/common/header_link'); // header Css link
                    $this->load->view('system_path/admin/common/header'); // body header
                    $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                    $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                    $this->load->view('system_path/admin/studentmarks/transcriptView', $data);// ...........body content page...........
                    $this->load->view('system_path/admin/common/footer'); // footer & script link
                    $this->load->view('system_path/jsquery'); // footer & script link

                } else {
                    $sdata['errormessage'] = "Transcript is not ready yet for this Student...";
                    $this->session->set_userdata($sdata);
                    redirect(admin_Url() . "/studentmarks/markslist", "refresh");
                }
            } else {
                $sdata['errormessage'] = "Result Not Found";
                $this->session->set_userdata($sdata);
                redirect(admin_Url() . "/studentmarks/markslist", "refresh");
            }
        }
        else {
            $sdata['errormessage'] = "Result Not Found";
            $this->session->set_userdata($sdata);
            redirect(admin_Url() . "/studentmarks/markslist", "refresh");
        }
    }

    public function Classposition() {
        $data['result'] = 'active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/studentmarks/class_position', $data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link        
    }

    public function search_position(){
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
            array(
                'field' => 'data[mediumId]',
                'label' => 'Medium',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[programId]',
                'label' => 'Class',
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
                'field' => 'data[sectionId]',
                'label' => 'Section',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[sessionId]',
                'label' => 'Session',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[semesterId]',
                'label' => 'Semester',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            $data['result'] = 'active';
            $this->load->view('system_path/admin/common/header_link'); // header Css link
            $this->load->view('system_path/admin/common/header'); // body header
            $this->load->view('system_path/admin/common/side_menu'); // side bar menu
            $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
            $this->load->view('system_path/admin/studentmarks/class_position', $data); // ...........body content page...........
            $this->load->view('system_path/admin/common/footer'); // footer & script link
            $this->load->view('system_path/jsquery'); // footer & script link
        } else {
            $data = $this->input->post('data', TRUE);

            $data['programOfferId'] = getProgramOfferId($data);

            if (!empty($data['programOfferId'])) {
                $data['data_info']=$this->InstituteModleAdmin->getInstituteInfo();
                //$data['markslist'] = $this->StudentmarksModleAdmin->getPositionByClass($data);
                $markslist = $this->StudentmarksModleAdmin->getPositionByClass($data);
                foreach($markslist as $value){
                    $where=array(
                        'studentId'=>$value['studentId'],
                        'programOfferId'=>$value['programOfferId'],
                        'semesterId'=>$value['semesterId']
                    );
                    $join=array(
                        'course'=>'course.courseId=studentmarks.courseId'
                    );
                    $info=$this->StudentmarksModleAdmin->get_data('studentmarks',$where,false,$join);

                    foreach($info as $value2){
                        // all chaeck any subject failed
                        $status=1;
                        if(isset($value2['marge'])!=0){ //
                            $course_id=$value2['marge'];

                            // get marge course mark
                            $where=array(
                                'studentId'=>$value['studentId'],
                                'programOfferId'=>$value['programOfferId'],
                                'semesterId'=>$value['semesterId'],
                                'studentmarks.courseId'=>$course_id
                            );
                            $join=array(
                                'course'=>'course.courseId=studentmarks.courseId'
                            );
                            $info2=$this->StudentmarksModleAdmin->get_data('studentmarks',$where,false,$join);
                            //    echo "<pre>";  print_r($info2);
                            if(!empty($info2))
                            {
                                // find mark course pecent of first subject
                                $where1=array(
                                    'course_offerId'=>$info2[0]['courseId']
                                );
                                $firstSubject=$this->StudentmarksModleAdmin->get_data('mark_divide',$where1);
                                // find marks of second subject
                                $where2=array(
                                    'course_offerId'=>$value2['courseId']
                                );
                                $secondSubject=$this->StudentmarksModleAdmin->get_data('mark_divide',$where2);

                                $subject1divi=array_filter(explode(',', trim($value2['divide_mark'])));
                                $subject2divi=array_filter(explode(',', trim($info2[0]['divide_mark'])));
                                $individulMark=array_filter(explode(',', trim(!empty($secondSubject[0]['divide_mark']))));
                                $pass_mark=array();

                                for($k=1;$k<=count($individulMark);$k++){
                                    $pass_mark[$k]=floor((isset($individulMark[$k])*33)/100);
                                } // TANAY



                                for($m=1;$m<=count($pass_mark);$m++){
                                    if(isset($subject1divi[$m]) && isset($subject2divi[$m])){
                                        $aver_mark=($subject1divi[$m]+$subject2divi[$m])/2;
                                        if($aver_mark<$pass_mark[$m]){
                                            $status=0;
                                            break;
                                        }
                                    }
                                    else{
                                        $status=0;
                                        break;

                                    }
                                }
                            }

                        }

                        $marks=$value['marks'];
                        if($status==0){
                            $marks=0;
                            break;
                        }
                    }



                    $withStatus[]=array(
                        'semesterId'=>$value['semesterId'],
                        'examtypeId'=>$value['examtypeId'],
                        'programOfferId'=>$value['programOfferId'],
                        'studentId'=>$value['studentId'],
                        'programLevel'=>$value['programLevel'],
                        'marks'=>$marks,
                        'status'=>$status
                    );

                }

                // die();    // echo '<pre>';
                // print_r($withStatus); die();
                // exit;
                $program_offer_id = $data['programOfferId']['programOfferId'];
                $semester_id = $data['semesterId'];
                //print_r($data);
                //$data['markslist'] =$markslist;

                $data['markslist'] =isset($withStatus) ? $withStatus : [];
                $data['records'] = $this->rma->getStudentResultInfo($program_offer_id, $semester_id);
                $data['institute_info'] = $this->rma->getInstituteInfo();
                if (!empty($data['markslist'])) {
                    $data['result'] = 'active';
                    $data['program_offer_id'] = $program_offer_id;
                    $data['semester_id'] = $semester_id;
                    $this->load->view('system_path/admin/common/header_link'); // header Css link
                    $this->load->view('system_path/admin/common/header'); // body header
                    $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                    $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                    $this->load->view('system_path/admin/studentmarks/positionlist1', $data); // ...........body content page...........
                    $this->load->view('system_path/admin/common/footer'); // footer & script link
                    $this->load->view('system_path/jsquery'); // footer & script link                    
                } else {
                    $sdata = array();
                    $sdata['message'] = "No Result Found";
                    $this->session->set_userdata($sdata);
                    redirect(admin_Url() . "/studentmarks/Classposition", "refresh");
                }
            } else {
                $sdata = array();
                $sdata['message'] = "Enrollment Information is not offer yet";
                $this->session->set_userdata($sdata);
                redirect(admin_Url() . "/studentmarks/Classposition", "refresh");
            }
        }
    }

    public function student_list()
    {
        $data = [];
        $this->validation_check();
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('system_path/admin/common/header_link'); // header Css link
            $this->load->view('system_path/admin/common/header'); // body header
            $this->load->view('system_path/admin/common/side_menu'); // side bar menu
            $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
            $this->load->view('system_path/admin/studentmarks/student_search', $data); // ...........body content page...........
            $this->load->view('system_path/admin/common/footer'); // footer & script link
            $this->load->view('system_path/jsquery'); // footer & script link
        }
        else {
            //  echo '<pre>';print_r($data);
            // echo '<pre>'; print_r($_POST);exit;
            $data = $this->input->post('data', TRUE);
            //print_r($data);exit;
            $data['programOfferId'] = getProgramOfferId($data);
            $data['institute_info'] = $this->rma->getInstituteInfo();
            if ($data['programOfferId']) {
                $data['po_id'] = ($data['programOfferId']) ? $data['programOfferId']['programOfferId']: 0;
                $semester_id = ($data['semesterId']) ? $data['semesterId'] : 0;
                // $data['students'] = $this->getStudentList($data['po_id']);
                //$data['records'] = $this->rma->getStudentResultInfo($data['po_id'], $semester_id);
                $data['students'] = $this->getStudentResultPositionList($data['po_id'], $semester_id, 0);
                $data['studentInfo'] = $this->ProgramModleAdmin->getStudentInfo($data['po_id']);
                $data['student_roll'] = $this->StudentModleAdmin->getStudentRoll($data['po_id']);
                // print_r($data['records']['201706143']['student_name']);
                // echo '<pre>';print_r($data);exit;
                if ($data['students']) {
                    $this->load->view('system_path/admin/common/header_link'); // header Css link
                    $this->load->view('system_path/admin/common/header'); // body header
                    $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                    $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                    $this->load->view('system_path/admin/studentmarks/student_list1', $data); // ...........body content page...........
                    $this->load->view('system_path/admin/common/footer'); // footer & script link
                    $this->load->view('system_path/jsquery'); // footer & script link
                } else {
                    $sdata = array();
                    $sdata['message'] = "No Result Found";
                    $this->session->set_userdata($sdata);
                    redirect(admin_Url() . "/studentmarks/student_list", "refresh");
                }
            } else {
                $sdata = array();
                $sdata['message'] = "Enrollment Information is not offer yet";
                $this->session->set_userdata($sdata);
                redirect(admin_Url() . "/studentmarks/student_list", "refresh");
            }
        }
    }

    public function student_position_list()
    {
        $data = [];
        $this->validation_check_for_position();
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('system_path/admin/common/header_link'); // header Css link
            $this->load->view('system_path/admin/common/header'); // body header
            $this->load->view('system_path/admin/common/side_menu'); // side bar menu
            $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
            $this->load->view('system_path/admin/studentmarks/position/student_search', $data); // ...........body content page...........
            $this->load->view('system_path/admin/common/footer'); // footer & script link
            $this->load->view('system_path/jsquery'); // footer & script link
        }
        else
        {
            $data = $this->input->post('data', TRUE);
            $data['programOfferId'] = get_Program_offer_Id($data);
            $programoffer_ids=array();
            foreach($data['programOfferId'] as $items)
            {
                $programoffer_ids[]=$items['programOfferId'];
            }
            $data['institute_info'] = $this->rma->getInstituteInfo();
            if ($data['programOfferId']) {
                //$data['po_id'] = ($data['programOfferId']) ? $data['programOfferId']['programOfferId']: 0;
                $semester_id = ($data['semesterId']) ? $data['semesterId'] : 0;
                $data['student_roll'] = $this->StudentModleAdmin->getStudentRoll_for_position($programoffer_ids);
                $data['students'] = $this->getStudentResultPositionList($programoffer_ids, $semester_id, 0);
                $data['studentInfo'] = $this->ProgramModleAdmin->getStudentInfo_for_position($programoffer_ids);
//                echo '<pre>';print_r($data['students']);exit;
//                echo '<pre>';print_r($data['studentInfo']);exit;
                if ($data['students']) {
                    $this->load->view('system_path/admin/common/header_link'); // header Css link
                    $this->load->view('system_path/admin/common/header'); // body header
                    $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                    $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                    $this->load->view('system_path/admin/studentmarks/position/student_position_list', $data); // ...........body content page...........
                    $this->load->view('system_path/admin/common/footer'); // footer & script link
                    $this->load->view('system_path/jsquery'); // footer & script link
                } else {
                    $sdata = array();
                    $sdata['message'] = "No Result Found";
                    $this->session->set_userdata($sdata);
                    redirect(admin_Url() . "/studentmarks/student_position_list", "refresh");
                }
            } else {
                $sdata = array();
                $sdata['message'] = "Enrollment Information is not offer yet";
                $this->session->set_userdata($sdata);
                redirect(admin_Url() . "/studentmarks/student_position_list", "refresh");
            }
        }
    }

    public function student_position_list_all_section()
    {
        $data = [];
        $this->validation_check_for_position();
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('system_path/admin/common/header_link'); // header Css link
            $this->load->view('system_path/admin/common/header'); // body header
            $this->load->view('system_path/admin/common/side_menu'); // side bar menu
            $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
            $this->load->view('system_path/admin/studentmarks/position/student_search_for_all_section', $data); // ...........body content page...........
            $this->load->view('system_path/admin/common/footer'); // footer & script link
            $this->load->view('system_path/jsquery'); // footer & script link
        }
        else
        {
            $data = $this->input->post('data', TRUE);
            $data['programOfferId'] = get_Program_offer_Id($data);
            $programoffer_ids=array();
            foreach($data['programOfferId'] as $items)
            {
                $programoffer_ids[]=$items['programOfferId'];
            }
            $data['institute_info'] = $this->rma->getInstituteInfo();
            if ($data['programOfferId']) {
                $semester_id = ($data['semesterId']) ? $data['semesterId'] : 0;
                $data['student_roll'] = $this->StudentModleAdmin->getStudentRoll_for_position($programoffer_ids);
                $data['students'] = $this->getStudentResultPositionList_all_section($programoffer_ids, $semester_id, 0);
                $data['studentInfo'] = $this->ProgramModleAdmin->getStudentInfo_for_position($programoffer_ids);
                if ($data['students']) {
                    $this->load->view('system_path/admin/common/header_link'); // header Css link
                    $this->load->view('system_path/admin/common/header'); // body header
                    $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                    $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                    $this->load->view('system_path/admin/studentmarks/position/student_position_list_all_section', $data); // ...........body content page...........
                    $this->load->view('system_path/admin/common/footer'); // footer & script link
                    $this->load->view('system_path/jsquery'); // footer & script link
                } else {
                    $sdata = array();
                    $sdata['message'] = "No Result Found";
                    $this->session->set_userdata($sdata);
                    redirect(admin_Url() . "/studentmarks/student_position_list", "refresh");
                }
            } else {
                $sdata = array();
                $sdata['message'] = "Enrollment Information is not offer yet";
                $this->session->set_userdata($sdata);
                redirect(admin_Url() . "/studentmarks/student_position_list", "refresh");
            }
        }
    }
    

    public function getStudentResultPositionList($programOfferId=array(), $semesterId = 0,$type = 0)//WHERE user_id IN (1,2,3,4)
    {
//        $order_by = '';
//        if ($type){
//            $order_by = 'mks.position asc';
//        }
        $records = $this->db
            ->select('
                    sac.studentId,
                    sac.programOfferId,
                    mks.total_marks,
                    mks.total_obtain_marks,
                    mks.gpa_point,
                    mks.gpa_letter,
                    mks.position
                ')
            ->from('studentassigncourse AS sac')
            ->join('marksheet_mst AS mks','sac.studentId = mks.student_id and mks.semester_id = '.$semesterId.'', 'LEFT')
            ->where_in('sac.programOfferId', $programOfferId)
            ->order_by('mks.position','ASC')
            ->get()
            ->result();

            // echo '<pre>';
            // print_r($records);
            // exit;


//        echo '<pre>';
//        print_r($records);exit;
//        print_r($this->db->last_query());exit;

        $this->db->select('md.*');
        $this->db->select('ms.student_id');
        $this->db->from('marksheet_dtls md');
        $this->db->join('marksheet_mst ms','ms.id=md.master_id','INNER');
        $this->db->where_in('md.program_offer_id',$programOfferId);
        $this->db->where('md.semester_id',$semesterId);
        $this->db->order_by('md.id');
        $results=$this->db->get()->result_array();
        foreach($results as $item)
        {
            $new_result[$item['student_id']][]=$item;
        }

        // echo '<pre>';
        // print_r($new_result);
        // exit;

        $common_full_marks=array();
        $common_marks=array();
        foreach($new_result as $index=>$item)
        {
            $common_marks[$index]=0;
            $common_full_marks[$index]=0;
            foreach($item as $i)
            {
                if($i['course_status']==1)
                {
                    $common_marks[$index] = $common_marks[$index] + $i['total_mark'];
                    $common_full_marks[$index] = $common_full_marks[$index] + $i['full_mark'];
                }
                if($i['course_status']==2)
                {
                    if($i['total_mark']>40)
                    {
                        $common_marks[$index] = $common_marks[$index] + ($i['total_mark']-40);
                    }
                }
            }
        }
        foreach($records as $item)
        {
            $item->total_common_marks=$common_marks[$item->studentId];
            $item->total_common_full_marks=$common_full_marks[$item->studentId];
        }
//        echo '<pre>';
//        print_r($records);exit;
        // echo '<pre>';
        // print_r($records);
        // exit;
        return $records;

    }

    public function getStudentResultPositionList_all_section($programOfferId=array(), $semesterId = 0,$type = 0)//WHERE user_id IN (1,2,3,4)
    {
        // echo '<pre>';
        // print_r($programOfferId);
        // exit;
        $records_pass = $this->db
            ->select('
                    sac.studentId,
                    sac.programOfferId,
                    section.sectionName,
                    mks.total_marks,
                    mks.total_obtain_marks,
                    mks.gpa_point,
                    mks.gpa_letter,
                    mks.position
                ')
            ->from('studentassigncourse AS sac')
            ->join('programoffer','programoffer.programOfferId=sac.programOfferId')
            ->join('section','programoffer.sectionId=section.sectionId')
            ->join('marksheet_mst AS mks','sac.studentId = mks.student_id and mks.semester_id = '.$semesterId.'', 'LEFT')
            ->where_in('sac.programOfferId', $programOfferId)
            ->where_not_in('mks.gpa_letter', 'F')
            //->order_by('mks.position','ASC')
            ->order_by('mks.total_obtain_marks', 'DESC')
            ->order_by('mks.gpa_point', 'DESC')
            ->get()
            ->result();
            $records_fail = $this->db
            ->select('
                    sac.studentId,
                    sac.programOfferId,
                    section.sectionName,
                    mks.total_marks,
                    mks.total_obtain_marks,
                    mks.gpa_point,
                    mks.gpa_letter,
                    mks.position
                ')
            ->from('studentassigncourse AS sac')
             ->join('programoffer','programoffer.programOfferId=sac.programOfferId')
            ->join('section','programoffer.sectionId=section.sectionId')
            ->join('marksheet_mst AS mks','sac.studentId = mks.student_id and mks.semester_id = '.$semesterId.'', 'LEFT')
            ->where_in('sac.programOfferId', $programOfferId)
            ->where('mks.gpa_letter', 'F')
            //->order_by('mks.position','ASC')
            ->order_by('mks.total_obtain_marks', 'DESC')
            ->get()
            ->result();

            $records = array_merge($records_pass,$records_fail);

            // echo '<pre>';
            // print_r($records);
            // exit;

        $this->db->select('md.*');
        $this->db->select('ms.student_id');
        $this->db->from('marksheet_dtls md');
        $this->db->join('marksheet_mst ms','ms.id=md.master_id','INNER');
        $this->db->where_in('md.program_offer_id',$programOfferId);
        $this->db->where('md.semester_id',$semesterId);
        $this->db->order_by('md.id');
        $results=$this->db->get()->result_array();
        foreach($results as $item)
        {
            $new_result[$item['student_id']][]=$item;
        }

        $common_full_marks=array();
        $common_marks=array();
        foreach($new_result as $index=>$item)
        {
            $common_marks[$index]=0;
            $common_full_marks[$index]=0;
            foreach($item as $i)
            {
                if($i['course_status']==1)
                {
                    $common_marks[$index] = $common_marks[$index] + $i['total_mark'];
                    $common_full_marks[$index] = $common_full_marks[$index] + $i['full_mark'];
                }
                if($i['course_status']==2)
                {
                    if($i['total_mark']>40)
                    {
                        $common_marks[$index] = $common_marks[$index] + ($i['total_mark']-40);
                    }
                }
            }
        }
        foreach($records as $item)
        {
            $item->total_common_marks=$common_marks[$item->studentId];
            $item->total_common_full_marks=$common_full_marks[$item->studentId];
        }

        return $records;

    }
    

    private function getStudentList($po_id = 0)
    {
        $records = $this->db
            ->select('s.studentId AS student_id, si.firstName AS student_name')
            ->from('student AS s')
            ->join('studentinfo AS si','si.applicationId = s.applicationId')
            ->where('s.programOfferId', $po_id)
            ->group_by('s.studentId')
            ->order_by('s.promotionId', 'asc')
            ->get('promotedstudent')
            ->result();
        return $records;
    }

    private function validation_check()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
            array(
                'field' => 'data[mediumId]',
                'label' => 'Medium',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[programId]',
                'label' => 'Class',
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
                'field' => 'data[sectionId]',
                'label' => 'Section',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[sessionId]',
                'label' => 'Session',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[semesterId]',
                'label' => 'Semester',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);
    }

    private function validation_check_for_position()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
            array(
                'field' => 'data[mediumId]',
                'label' => 'Medium',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[programId]',
                'label' => 'Class',
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
            ),
            array(
                'field' => 'data[semesterId]',
                'label' => 'Semester',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);
    }


}