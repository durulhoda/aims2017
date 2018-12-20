<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */

class Studentmarks extends MY_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->teacher_logged_auth();
        $this->load->model('admin/studentmarks/StudentmarksModleAdmin', 'StudentmarksModleAdmin');
        $this->load->model('admin/courseassign/CourseAssignModleAdmin', 'CourseAssignModleAdmin');
   
         $this->load->model('admin/courseoffer/CourseOfferModleAdmin', 'CourseOfferModleAdmin');
        $this->load->model('admin/program/ProgramModleAdmin', 'ProgramModleAdmin');
        $this->load->model('admin/student/StudentModleAdmin', 'StudentModleAdmin');
        $this->load->model('admin/result/Result_model_admin', 'rma');
        //put your code here
    }

    public function index() {
        $data['result'] = 'active';
        $data['addresult'] = 'active';
        $this->load->view('system_path/teacher/common/header_link'); // header Css link
        $this->load->view('system_path/teacher/common/header'); // body header
        $this->load->view('system_path/teacher/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/teacher/studentmarks/index', $data); // ...........body content page...........
        $this->load->view('system_path/teacher/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link

        
    }

    public function searchstudentlist()
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
            $this->load->view('system_path/admin/studentmarks/index'); // ...........body content page...........
            $this->load->view('system_path/admin/common/footer'); // footer & script link
            $this->load->view('system_path/jsquery'); // footer & script link
        } else {
            $data = $this->input->post('data', TRUE);
            //print_r($data); die();
            $data['programOfferId'] = $this->ProgramModleAdmin->getProgramOfferId($data);
            if (!empty($data['programOfferId'])) {
                $check = $this->ProgramModleAdmin->checkProgramOfferAndSemester($data);
//                print_r($data['programOfferId']);exit;
//                 print_r($check);exit;
                $programOfferId = $data['programOfferId']['programOfferId'];
                $data['student_roll'] = $this->StudentModleAdmin->getStudentRoll($programOfferId);
//                echo '<pre>';
//                print_r($data);exit;
                if ($check) {
                    // $data['employeeId'] = getEmployeeIdByProgramAndSubject($data['programOfferId'], $data['courseId']); // get EmployeeId Fromcourse offer table by courseId

                    $data['courseofferlist'] = $this->CourseOfferModleAdmin->getcourseOfferId($data);

//                    echo '<pre>';
//                    print_r($data['courseofferlist']);die();

                    if (!empty($data['courseofferlist'])) {
                        $offerid=$data['courseofferlist']['offerId'];
                        $data['dividemark'] = $this->CourseOfferModleAdmin->getcoursedvdmark($offerid);
                        $data['employeeId']=$data['courseofferlist']['employeeId'];

//                        echo '<pre>';
//                        print_r($data);die();

                        $result = $this->StudentmarksModleAdmin->searchsubject($data);
                        ini_set('max_execution_time', 0);
                        $data['studentlist'] = $this->CourseAssignModleAdmin->AssignedCourseStudents($data);

//                        echo '<pre>';
//                        print_r($data['studentlist']);die();

                        //  print_r($data['listbytype']); die();

                        if (!$result) {
                            $sdata['errormessage'] = "This Teacher is not Assinged for this Subject in this Class";
                            $this->session->set_userdata($sdata);
                            redirect(teacher_Url() . "/studentmarks", "refresh");
                        } elseif (!$data['studentlist']) {
                            $sdata['errormessage'] = "There are no Student found for this searching value ";
                            $this->session->set_userdata($sdata);
                            redirect(teacher_Url() . "/studentmarks", "refresh");
                        } else {

                            if (isset($_POST['search'])) {  // if entry mark for a subject then this will be working ..this occure when search button press
                                $data['result'] = 'active';
                                $data['addresult'] = 'active';
                                $data['institute_info'] = $this->rma->getInstituteInfo();
                                $this->load->view('system_path/teacher/common/header_link'); // header Css link
                                $this->load->view('system_path/teacher/common/header'); // body header
                                $this->load->view('system_path/teacher/common/side_menu', $data); // side bar menu
                                $this->load->view('system_path/teacher/studentmarks/searchstudentlist', $data); // ...........body content page...........
                                $this->load->view('system_path/teacher/common/footer'); // footer & script link
                                $this->load->view('system_path/jsquery'); // footer & script link
                            } elseif (isset($_POST['print'])) {  // if print mark shhet list with student for a class then this will be working..this occure when print button press
                                //     print_r($data['studentlist']); die();
                                $this->load->view('system_path/admin/common/header_link'); // header Css link
                                $this->load->view('system_path/admin/studentmarks/printsheet', $data); // ...........body content page...........
                                $this->load->view('system_path/admin/common/footer'); // footer & script link
                            } else {
                                $sdata['errormessage'] = "No Result Found";
                                $this->session->set_userdata($sdata);

                                redirect(teacher_Url() . "/studentmarks", "refresh");
                            }
                        }
                    }
                     else
                     {
                        $sdata['errormessage'] = "Teacher Not Found for this Subject";
                        $this->session->set_userdata($sdata);
                        redirect(teacher_Url() . "/studentmarks", "refresh");
                     }
                } else {
                    $sdata['errormessage'] = "Already Submitted!";
                    $this->session->set_userdata($sdata);
                    redirect(teacher_Url() . "/studentmarks", "refresh");
                } }else {
                $sdata['errormessage'] = "Enrolment program is not offer yet";
                $this->session->set_userdata($sdata);
                redirect(teacher_Url() . "/studentmarks", "refresh");
            }
        }
    }

        public function savemarks() {
           //echo '<pre>';print_r($_POST);exit;
        
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
            foreach($flag  as $key=>$value){        
              if($key==$i)
              {
                $abc[] = ",".implode(',', $value)."," ; 
                $total_marks= array_sum($value);
                break;
              }
            }
            
            $studentId[$i] ." - " ;
               # code...
            $abc[$i];
           
            $data = array(
                'studentId' => $studentId[$i],
                'divide_mark' => $abc[$i],
                'marks' => $total_marks,
                'semesterId' => $semesterId,
                'examtypeId' => $examtypeId,
                'courseId' => $courseId,
                'programOfferId' => $programOfferId,
                'employeeId' => $employeeId
            );
            
                     
            $result = $this->StudentmarksModleAdmin->duplicateExamMarks($data);
         
          if ($result) {
                $cou = count($result['studentId']);
                $coustu = $cou + $coustu;
            } else {
                $this->StudentmarksModleAdmin->savemarks($data);
                $insertid = $this->db->insert_id();
            }
   
        }
             
        if ($coustu > 0 || empty($insertid)) {
            $sdata['errormessage'] = 'Duplicate entry found for ' . $coustu . ' Student...';
            $this->session->set_userdata($sdata);
            redirect(teacher_Url() . "/studentmarks", "refresh");
        } else {
            $sdata['message'] = 'Marks Added!';
            $this->session->set_userdata($sdata);
            redirect(teacher_Url() . "/studentmarks", "refresh");
        }
    }
    
     public function markslist() {
        $data['result'] = 'active';
        $data['resultview'] = 'active';
        $this->load->view('system_path/teacher/common/header_link'); // header Css link
        $this->load->view('system_path/teacher/common/header'); // body header
        $this->load->view('system_path/teacher/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/teacher/studentmarks/marks_list1', $data); // ...........body content page...........
        $this->load->view('system_path/teacher/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
    }
    
      public function edit_studentmarks($studentId,$markId) {

    $data['editData']= $this->StudentmarksModleAdmin->getstudentmarkinfo($studentId,$markId);
   // print_r($data);    die ();
    if (!empty($data['editData'])) {
        $daata['programOfferId']=$data['editData']['programOfferId'];
        $daata['courseId']=$data['editData']['courseId'];
        $data['dividemark'] = $this->CourseOfferModleAdmin->getcoursedvdmark_byPrgid_Subject($daata); 
//        print_r($data);
//        die();
            $data['result'] = 'active';
            $this->load->view('system_path/teacher/common/header_link'); // header Css link
            $this->load->view('system_path/teacher/common/header'); // body header
            $this->load->view('system_path/teacher/common/side_menu', $data); // side bar menu
            $this->load->view('system_path/teacher/studentmarks/edit_marks_list',$data); // ...........body content page...........
            $this->load->view('system_path/teacher/common/footer'); // footer & script link
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

                redirect(teacher_Url() . "/studentmarks/markslist", "refresh");
            }
            else
            {
                $sdata = array();
                $sdata['message'] = 'Result not updated...try again';
                $this->session->set_userdata($sdata);

                redirect(teacher_Url() . "/studentmarks/markslist", "refresh");
            }
        }    
       
    }

    public function deleteStudentmarks($studentId, $markId) {
      
        $dlt=$this->StudentmarksModleAdmin->deletestudentmarks($studentId, $markId);
        if($dlt){
            $sdata['errormessage'] = 'Marks deleted';
            $this->session->set_userdata($sdata);
               redirect(admin_Url() . "/studentmarks/markslist", "refresh");
        }
        else{
            $sdata['errormessage'] = 'Marks not found!';
            $this->session->set_userdata($sdata);
                redirect(admin_Url() . "/studentmarks/markslist", "refresh");
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
 
    public function searchresultsByStudent() {


        $data = $this->input->post('data', TRUE);
        if (!empty($data)) {
            // get programoofferid from programmoffer table by session & then match student programofferid from promotedstudent table 
            
            $data['programOfferId'] = $this->ProgramModleAdmin->getProgramOfferIdBySessionStudent($data);
            

            if (!empty($data['programOfferId'])) {
                $programOfferId = ($data['programOfferId']['programOfferId']) ? $data['programOfferId']['programOfferId'] : 0;
                $data['student_marks'] = $this->getStudentMark($data, $programOfferId);
               // print_r($data['programOfferId']);exit;
                // echo '<pre>';print_r($data['student_marks']);
                // exit;
               // $data['markslist'] = $this->StudentmarksModleAdmin->getmarksByStudent($data);

                if (!empty($data['student_marks']) && !empty($data['studentId']) && !empty($data['semesterId'])) {
                    $data['studentinfo'] = $this->StudentModleAdmin->getstudentNameInfo($data['studentId']);
                    $data['mark_category'] = $this->db->get('mark_category')->result();
                    $data['result'] = 'active';
                    $data['resultview'] = 'active';
                    $this->load->view('system_path/teacher/common/header_link'); // header Css link
                    $this->load->view('system_path/teacher/common/header'); // body header
                    $this->load->view('system_path/teacher/common/side_menu',$data); // side bar menu
                    $this->load->view('system_path/teacher/studentmarks/marks_list1', $data); // ...........body content page...........
                    $this->load->view('system_path/teacher/common/footer'); // footer & script link
                    $this->load->view('system_path/jsquery'); // footer & script link
                } elseif (empty($data['student_marks'])) {
                    $sdata['errormessage'] = "No Result Found";
                    $this->session->set_userdata($sdata);
                    redirect(teacher_Url() . "/studentmarks/markslist", "refresh");
                } else {
                    $sdata = array();
                    $sdata['errormessage'] = "Select both StudentId & Semester";
                    $this->session->set_userdata($sdata);
                    redirect(teacher_Url() . "/studentmarks/markslist", "refresh");
                }
            } else {
                $sdata['errormessage'] = "No Result Found";
                $this->session->set_userdata($sdata);
                redirect(teacher_Url() . "/studentmarks/markslist", "refresh");
            }
        } else {
            $sdata['errormessage'] = "Fill Up all field";
            $this->session->set_userdata($sdata);
            redirect(teacher_Url() . "/studentmarks/markslist", "refresh");
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
            redirect(teacher_Url() . "/studentmarks/markslist", "refresh");
        } else {
            $data = $this->input->post('data', TRUE);
            $data['programOfferId'] = $this->ProgramModleAdmin->getProgramOfferId($data);

//            echo '<pre>';
//            print_r($data['programOfferId']);exit;

            if (!empty($data['programOfferId'])) {
               // echo '<pre>';print_r($data);
                //echo '<pre>';print_r($data['programOfferId']);exit;
                $programOfferId = ($data['programOfferId']['programOfferId']) ? $data['programOfferId']['programOfferId'] : 0;

                // copy
                $data['courseofferlist'] = $this->CourseOfferModleAdmin->getcourseOfferId($data);
                if ($data['courseofferlist']) {
                    $offerId = $data['courseofferlist']['offerId'];
                    $data['dividemark'] = $this->CourseOfferModleAdmin->getcoursedvdmark($offerId);
                    } else {
                    $sdata['errormessage'] = "Teacher Not Found for this Subject";
                    $this->session->set_userdata($sdata);
                    redirect(admin_Url() . "/insert_mark_list", "refresh");
                }
                // copy


                $data['student_marks'] = $this->getStudentMark($data, $programOfferId);
//                 echo '<pre>';print_r($data);
//                 exit;
                $data['markslist'] = $this->StudentmarksModleAdmin->getmarksByClass($data);

                if (!empty($data['markslist'])) {
                    $data['result'] = 'active';
                    $this->load->view('system_path/teacher/common/header_link'); // header Css link
                    $this->load->view('system_path/teacher/common/header'); // body header
                    $this->load->view('system_path/teacher/common/side_menu', $data); // side bar menu
                    //$this->load->view('system_path/teacher/studentmarks/marks_list_class1', $data); // ...........body content page...........
                    $this->load->view('system_path/teacher/studentmarks/marks_list', $data); // ...........body content page...........
                    $this->load->view('system_path/teacher/common/footer'); // footer & script link
                    $this->load->view('system_path/jsquery'); // footer & script link
                } else {
                    $sdata['errormessage'] = "No Result Found";
                    $this->session->set_userdata($sdata);
                    redirect(teacher_Url() . "/studentmarks/markslist", "refresh");
                }
            } else {
                $sdata['errormessage'] = "Classoffer Information is not offer yet";
                $this->session->set_userdata($sdata);
                redirect(teacher_Url() . "/studentmarks/markslist", "refresh");
            }
        }
    }

    public function student_position()
    {
        $data = [];
        $this->validation_check();
        if ($this->form_validation->run() == FALSE) {

            $this->load->view('system_path/teacher/common/header_link'); // header Css link
            $this->load->view('system_path/teacher/common/header'); // body header
            $this->load->view('system_path/teacher/common/side_menu'); // side bar menu
            $this->load->view('system_path/teacher/result_view/position/student_search', $data); // ...........body content page...........
            $this->load->view('system_path/teacher/common/footer'); // footer & script link
            $this->load->view('system_path/jsquery'); // footer & script link
        } else {
            $data = $this->input->post('data', TRUE);
            $data['programOfferId'] = getProgramOfferId($data);
            $data['institute_info'] = $this->rma->getInstituteInfo();
            if ($data['programOfferId']) {
                $data['po_id'] = ($data['programOfferId']) ? $data['programOfferId']['programOfferId']: 0;
                $semester_id = ($data['semesterId']) ? $data['semesterId'] : 0;
            $data['student_roll'] = $this->StudentModleAdmin->getStudentRoll($data['po_id']);
            $data['studentInfo'] = $this->ProgramModleAdmin->getStudentInfo($data['po_id']);
            $data['students'] = $this->getStudentResultPositionList($data['po_id'], $semester_id, 1);

            if ($data['students']) {
                $this->load->view('system_path/teacher/common/header_link'); // header Css link
                $this->load->view('system_path/teacher/common/header'); // body header
                $this->load->view('system_path/teacher/common/side_menu'); // side bar menu
                //$this->load->view('system_path/teacher/common/top_menu', $data); // top bar menu
                $this->load->view('system_path/teacher/result_view/position/student_position_list', $data); // ...........body content page...........
                $this->load->view('system_path/teacher/common/footer'); // footer & script link
                $this->load->view('system_path/jsquery'); // footer & script link
            } else {
                $sdata = array();
                $sdata['message'] = "No Result Found";
                $this->session->set_userdata($sdata);
                redirect(teacher_Url() . "/studentmarks/student_position", "refresh");
            }

            } else {
            $sdata = array();
            $sdata['message'] = "Enrollment Information is not offer yet";
            $this->session->set_userdata($sdata);
            redirect(teacher_Url() . "/studentmarks/student_position", "refresh");
        }
           //echo '<pre>'; print_r($data);exit;
        }
    }

    public function transcriptView3() {
            $student_id = $this->input->get('stuent_id');
            $program_offer_id = $this->input->get('program_offer_id');;
            $semester_id = $this->input->get('semester_id');
            $data = [];
            $check = $this->checkPublishResult($student_id, $program_offer_id, $semester_id);
            if ($check) {
                $data['institute_info'] = $this->rma->getInstituteInfo();
                $data['student_info'] = $this->rma->getStudentInfo($student_id);
                $data['roll_no'] = $this->rma->get_roll_no($student_id);
                $data['program_info'] = $this->rma->getProgramInfo($program_offer_id);
                $data['semester_id'] = $semester_id;
                $data['records'] = $this->rma->getStudentMarkSheet($program_offer_id, $semester_id, $student_id);
                $this->load->view('system_path/teacher/common/header_link'); // header Css link
                $this->load->view('system_path/teacher/common/header'); // body header
                $this->load->view('system_path/teacher/common/side_menu'); // side bar menu
                //$this->load->view('system_path/teacher/common/top_menu', $data); // top bar menu
                $this->load->view('system_path/admin/studentmarks/transcriptView3', $data);// ...........body content page...........
                $this->load->view('system_path/teacher/common/footer'); // footer & script link
                $this->load->view('system_path/jsquery'); // footer & script link
            } else {
                $sdata = array();
                $sdata['message'] = "Result No Publish";
                $this->session->set_userdata($sdata);
                redirect(teacher_Url() . "/studentmarks/student_position", "refresh");
            }
            

            

    }

    private function checkPublishResult($studentId = 0, $programOfferId = 0, $semesterId = 0)
    {
        $check = false;
        $where = [];
        $where['studentId'] = $studentId;
        $where['programOfferId'] = $programOfferId;
        $where['semesterId'] = $semesterId;
        $where['result_status'] = 1;
        $record = $this->db
                ->where($where)
                ->get('publishedresult')
                ->result();
        if ($record) {
            $check = true;
        }
        return $check;
    }

    private function getStudentResultPositionList($programOfferId = 0, $semesterId = 0,$type = 0)
    {
        $order_by = '';
        if ($type){
            $order_by = 'mks.position asc';
        }
        $records = $this->db
                ->select('
                    sac.studentId,
                    mks.total_marks,
                    mks.total_obtain_marks,
                    mks.gpa_point,
                    mks.gpa_letter,
                    mks.position
                ')
                ->from('studentassigncourse AS sac')
                ->join('marksheet_mst AS mks','sac.studentId = mks.student_id and mks.semester_id = '.$semesterId.' and mks.program_offer_id = '.$programOfferId.'', 'left')
                ->join('publishedresult AS pr', 'pr.studentId = mks.student_id and pr.semesterId = '.$semesterId.' and pr.programOfferId = '.$programOfferId.' and pr.result_status = 1')
                ->where('sac.programOfferId', $programOfferId)
                ->order_by($order_by)
                ->get()
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
    
    public function transcriptView() {

        if (isset($_POST['generate'])) {
            $data = $this->input->post('data', TRUE);

            if (!empty($data)) {
                $data['markslist'] = $this->StudentmarksModleAdmin->getmarksByStudentTranscriptView($data);

                if (!empty($data['markslist'])) {
                    $data['studentlist'] = $this->StudentModleAdmin->getstudentNameInfo($data['studentId']);
                    $data['programinfo'] = $this->ProgramModleAdmin->getofferProgramInfoById($data['programOfferId']);
                    $data['result'] = 'active';
                    $this->load->view('system_path/admin/common/header_link'); // header Css link
                    $this->load->view('system_path/admin/common/header'); // body header
                    $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                    $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                    $this->load->view('system_path/admin/studentmarks/transcriptView', $data); // ...........body content page...........
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
                $data['markslist'] = $this->StudentmarksModleAdmin->getPositionByClass($data);
             //   print_r($data['markslist']); die();
                if (!empty($data['markslist'])) {
                    $data['result'] = 'active';
                    $this->load->view('system_path/admin/common/header_link'); // header Css link
                    $this->load->view('system_path/admin/common/header'); // body header
                    $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                    $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                    $this->load->view('system_path/admin/studentmarks/positionlist', $data); // ...........body content page...........
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



}

