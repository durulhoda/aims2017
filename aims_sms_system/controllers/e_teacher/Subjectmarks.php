<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */

class Subjectmarks extends MY_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->teacher_logged_auth();
         $this->load->model('admin/courseoffer/CourseofferModleAdmin', 'CourseofferModleAdmin');
        $this->load->model('admin/course/CourseModleAdmin', 'CourseModleAdmin');
        $this->load->model('admin/studentmarks/StudentmarksModleAdmin', 'StudentmarksModleAdmin');
        $this->load->model('admin/courseassign/CourseAssignModleAdmin', 'CourseAssignModleAdmin');
   
        $this->load->model('admin/program/ProgramModleAdmin', 'ProgramModleAdmin');
        $this->load->model('admin/student/StudentModleAdmin', 'StudentModleAdmin');
        //put your code here
    }

    public function index() {
        $data['subject'] = 'active';
        $data['subjectmark'] = 'active';
        $this->load->view('system_path/teacher/common/header_link'); // header Css link
        $this->load->view('system_path/teacher/common/header'); // body header
        $this->load->view('system_path/teacher/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/teacher/markdistribute/index', $data); // ...........body content page...........
        $this->load->view('system_path/teacher/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link

        
    }
    
     public function searchcourseofferlist() {

        $data = $this->input->post('data', TRUE);
        $employeeId=$this->session->userdata('emp_userName');
        $data['programOfferId'] = getProgramOfferId($data);
       // print_r($data); die();
        if (!empty($data['programOfferId'])) {
        //     $data['courseofferalllist'] = $this->CourseofferModleAdmin->searchcourseofferalllist($data);
            
            $data['courseofferlist'] = $this->CourseofferModleAdmin->searchcourseofferlistbyteacherid($data,$employeeId);
          //    print_r($data); die();
            if (!empty($data['courseofferlist'])) {
                $data['subject'] = 'active';
                $data['subjectmark'] = 'active';
                $this->load->view('system_path/teacher/common/header_link'); // header Css link
                $this->load->view('system_path/teacher/common/header'); // body header
                $this->load->view('system_path/teacher/common/side_menu', $data); // side bar menu
                $this->load->view('system_path/teacher/markdistribute/courseofferlist', $data); // ...........body content page...........
                $this->load->view('system_path/teacher/common/footer'); // footer & script link
                $this->load->view('system_path/jsquery'); // footer & script link
            } else {
                $sdata = array();
                $sdata['message'] = "No Result Found";
                $this->session->set_userdata($sdata);
                redirect(teacher_Url() . "/Subjectmarks/index", 'refresh');
            }
        } else {
            $sdata = array();
            $sdata['message'] = "Under this enrollment information Subject not offered yet";
            $this->session->set_userdata($sdata);
            redirect(teacher_Url() . "/Subjectmarks/index", 'refresh');
        }
    }  

    
    
      public function markdistribute($id) {

        //   $data['MarkData'] = $this->CourseofferModleAdmin->Markdistribute($id);

        $data['courseofferlist'] = $this->CourseofferModleAdmin->getCourseInfo($id);
        $data['markcategorylist'] = $this->CourseofferModleAdmin->getmarkcategoryList();
        // print_r($data); die();
        $data['subffer'] = 'active';
        $data['markcatagory'] = 'active';
        $this->load->view('system_path/teacher/common/header_link'); // header Css link
        $this->load->view('system_path/teacher/common/header'); // body header
        $this->load->view('system_path/teacher/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/teacher/markdistribute/stumarkdistribute', $data); // ...........body content page...........
        $this->load->view('system_path/teacher/common/footer'); // footer & script link
    }

    public function insertdvdmark() {
        // print_r($_POST);

        $dvd_mark_id = $this->input->post('dvd_mark_id', TRUE);
        $dvd_mark = $this->input->post('dvd_mark', TRUE);
        $mark_percent = $this->input->post('mark_percent', TRUE);
        $offerId = $this->input->post('offerId', TRUE);
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
        if (!empty($dulicat)) {
            $dividemark_id = $dulicat['dividemark_id'];
            $updt = $this->CourseofferModleAdmin->update_mark_dvd($data, $dividemark_id);

            if ($updt) {
                $sdata['message'] = 'Mark divided updated';
                $this->session->set_userdata($sdata);
                redirect(teacher_Url() . "/Subjectmarks");
            } else {
                $sdata['errormessage'] = 'Mark divided not updated';
                $this->session->set_userdata($sdata);

                redirect(teacher_Url() . "/Subjectmarks/markdistribute/" . $data['course_offerId']);
            }
        } else {
            $insert = $this->CourseofferModleAdmin->addmark_dvd($data);

            if ($insert) {
                $sdata['message'] = 'Mark divided Successfully';
                $this->session->set_userdata($sdata);
                redirect(teacher_Url() . "/Subjectmarks");
            } else {
                $sdata['errormessage'] = 'Mark not divided';
                $this->session->set_userdata($sdata);

                redirect(teacher_Url() . "/Subjectmarks/markdistribute/" . $data['course_offerId']);
            }
        }
    }

    
    
    
    
    
    
    

    public function searchstudentlist() {
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
                'field' => 'data[courseId]',
                'label' => 'Subject',
                'rules' => 'required'
            ),
                 array(
                'field' => 'data[employeeId]',
                'label' => 'Emoployee ID',
                'rules' => 'required'
            )
      );
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            $sdata['errormessage'] = "Required Field Missing";
            $this->session->set_userdata($sdata);
            $data['result'] = 'active';
        $data['addresult'] = 'active';
        $this->load->view('system_path/teacher/common/header_link'); // header Css link
        $this->load->view('system_path/teacher/common/header'); // body header
        $this->load->view('system_path/teacher/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/teacher/studentmarks/index', $data); // ...........body content page...........
        $this->load->view('system_path/teacher/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
        } else {
            $data = $this->input->post('data', TRUE);
            $data['programOfferId'] = $this->ProgramModleAdmin->getProgramOfferId($data);

            if (!empty($data['programOfferId'])) {
               // $data['employeeId'] = getEmployeeIdByProgramAndSubject($data['programOfferId'], $data['courseId']); // get EmployeeId Fromcourse offer table by courseId
                
                 $data['courseofferlist'] = $this->CourseOfferModleAdmin->getcourseOfferId($data);
                 
                 
                if (!empty($data['courseofferlist'])) {
                    $offerid=$data['courseofferlist']['offerId'];
                    $data['dividemark'] = $this->CourseOfferModleAdmin->getcoursedvdmark($offerid);        
                    $data['employeeId']=$data['courseofferlist']['employeeId'];
                
                    
                    $result = $this->StudentmarksModleAdmin->searchsubject($data);
                  ini_set('max_execution_time', 0);
                    $data['studentlist'] = $this->CourseAssignModleAdmin->AssignedCourseStudents($data);

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
                } else {
                    $sdata['errormessage'] = "Teacher Not Found for this Subject";
                    $this->session->set_userdata($sdata);
                    redirect(teacher_Url() . "/studentmarks", "refresh");
                }
            } else {
                $sdata['errormessage'] = "Enrolment program is not offer yet";
                $this->session->set_userdata($sdata);
                redirect(teacher_Url() . "/studentmarks", "refresh");
            }
        }
    }


        public function savemarks() {
        
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
        $this->load->view('system_path/teacher/studentmarks/marks_list', $data); // ...........body content page...........
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
 
    public function searchresultsByStudent() {


        $data = $this->input->post('data', TRUE);
        if (!empty($data)) {
            // get programoofferid from programmoffer table by session & then match student programofferid from promotedstudent table 
            $data['programOfferId'] = $this->ProgramModleAdmin->getProgramOfferIdBySessionStudent($data);

            if (!empty($data['programOfferId'])) {
                $data['markslist'] = $this->StudentmarksModleAdmin->getmarksByStudent($data);

                if (!empty($data['markslist']) && !empty($data['studentId']) && !empty($data['semesterId'])) {
                    $data['studentinfo'] = $this->StudentModleAdmin->getstudentNameInfo($data['studentId']);
                    $data['result'] = 'active';
                    $data['resultview'] = 'active';
                    $this->load->view('system_path/teacher/common/header_link'); // header Css link
                    $this->load->view('system_path/teacher/common/header'); // body header
                    $this->load->view('system_path/teacher/common/side_menu',$data); // side bar menu
                    $this->load->view('system_path/teacher/studentmarks/marks_list', $data); // ...........body content page...........
                    $this->load->view('system_path/teacher/common/footer'); // footer & script link
                    $this->load->view('system_path/jsquery'); // footer & script link
                } elseif (empty($data['markslist'])) {
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
           
            if (!empty($data['programOfferId'])) {
                $data['markslist'] = $this->StudentmarksModleAdmin->getmarksByClass($data);
               
                if (!empty($data['markslist'])) {
                    $data['result'] = 'active';
                    $this->load->view('system_path/teacher/common/header_link'); // header Css link
                    $this->load->view('system_path/teacher/common/header'); // body header
                    $this->load->view('system_path/teacher/common/side_menu', $data); // side bar menu
                    $this->load->view('system_path/teacher/studentmarks/marks_list_class', $data); // ...........body content page...........
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

