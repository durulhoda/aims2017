<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */

class Studentsattendance extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->my_admin();
        $this->load->model('admin/studentattendance/StudentattendanceModleAdmin', 'StudentattendanceModleAdmin');
        $this->load->model('admin/student/StudentModleAdmin', 'StudentModleAdmin');
        $this->load->model('admin/studentregistration/StudentregistrationModleAdmin', 'StudentregistrationModleAdmin');
         $this->load->model('admin/studentmarks/StudentmarksModleAdmin', 'StudentmarksModleAdmin');
        $this->load->model('admin/courseassign/CourseAssignModleAdmin', 'CourseAssignModleAdmin');
        $this->load->model('admin/program/ProgramModleAdmin', 'ProgramModleAdmin');
        
    }

    public function index() {
        $data['Attendance'] = 'active';
       
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/attendance/insertform'); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
    }


  public function searchstudent() {

      ini_set('memory_limit','-1');
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
              )
          );
          $this->form_validation->set_rules($config);

          if ($this->form_validation->run() == FALSE) {
              $sdata['errormessage'] = "Required Field Missing";
              $this->session->set_userdata($sdata);
              $data['Attendance'] = 'active';
              $this->load->view('system_path/admin/common/header_link'); // header Css link
              $this->load->view('system_path/admin/common/header'); // body header
              $this->load->view('system_path/admin/common/side_menu'); // side bar menu
              $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
              $this->load->view('system_path/admin/attendance/insertform'); // ...........body content page...........
              $this->load->view('system_path/admin/common/footer'); // footer & script link
              $this->load->view('system_path/jsquery'); // footer & script link
          } else {
              $data = $this->input->post('data', TRUE);

            $data['programOfferId'] = getProgramOfferId($data);
            if ($data['programOfferId'] != 0) {
                $data['studentlist'] = $this->StudentModleAdmin->searchCurrentStudent($data);
                if (!empty($data['studentlist'])) {
                    $data['Attendance'] = 'active';
                    $this->load->view('system_path/admin/common/header_link'); // header Css link
                    $this->load->view('system_path/admin/common/header'); // body header
                    $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                    $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                    $this->load->view('system_path/admin/attendance/studentlistbydate'); // ...........body content page...........
                    $this->load->view('system_path/admin/common/footer'); // footer & script link
                    $this->load->view('system_path/jsquery'); // footer & script link
                    
                } else {
                    $sdata['errormessage'] = 'No student found inserted enrollment information';
                    $this->session->set_userdata($sdata);
                     redirect(admin_Url()."/studentsattendance");
                }
            } else {
                $sdata['errormessage'] = 'Inserted Enrollment information is not offered yet!';
                $this->session->set_userdata($sdata);
                 redirect(admin_Url()."/studentsattendance");
            }
          }
      
      }

        // next function is for attendance insert by date when any one need attendance by date....   
    public function insertattendance() {

           $studentId = $this->input->post('studentId');
           $serial = $this->input->post('serial');
            $attendanceStatus = $this->input->post('attendanceStatus');
           // print_r($studentId); 
        //   print_r($serial);
        // print_r($attendanceStatus); die();
            
              if(!empty($serial))
                {
                    $count=count($serial);
                    //print_r($count);die();
                 //   $countstudent=0;
                   for($i=0;$i<$count;$i++)
                   {
                        $find_value=$serial[$i]-1;
                        
            
                  //  print_r($find_value); die();

                    $data['studentId'] = $studentId[$find_value];
                    $data['attendanceStatus'] = $attendanceStatus[$find_value];
                    $data['programOfferId'] = $this->input->post('programOfferId', true);
                    $data['attendanceDate'] = $this->input->post('attendanceDate', true);  
                   
                    $results = $this->StudentattendanceModleAdmin->checkattendance($data['studentId'], $data['attendanceDate']);

                    if ($results == TRUE) {
                        $sdata = array();
                        $sdata['message'] = "Attendence Already done";
                        $this->session->set_userdata($sdata);
                        redirect(admin_Url()."/studentsattendance");
                    } elseif ($results == FALSE) {
                     //   print_r($data);
                        $this->StudentattendanceModleAdmin->saveStudentattendancess($data);
                    }
                }
          //      die();
                $sdata['message'] = 'Attendance Successfull inserted';
                $this->session->set_userdata($sdata);

                redirect(admin_Url()."/studentsattendance");
        } else {
            $sdata['errormessage'] = 'Student Information not found';
            $this->session->set_userdata($sdata);

           redirect(admin_Url()."/studentsattendance");
        }
    }

       
     // next function is for attendance insert by date when any one need attendance by date....      
    public function studentattendancesearch() {
        $data['Attendance'] = 'active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/attendance/searchstudentattendance'); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
    } 

     // next function is for attendance insert by date when any one need attendance by date....     
    public function searchattendanceinfo() {

        $data = $this->input->post('data', TRUE);
        if (empty($data['studentId'])) {
            $sdata['errormessage'] = 'Enter Student Id';
            $this->session->set_userdata($sdata);
             redirect(admin_Url()."/studentsattendance/studentattendancesearch");
        } else {
            $data['attendancelist'] = $this->StudentattendanceModleAdmin->getstudentattendance($data);
            $data['studentinfo'] = $this->StudentModleAdmin->getstudentNameInfo($data['studentId']);
            if (!empty($data['attendancelist']))
            {
               $data['Attendance'] = 'active';
              $this->load->view('system_path/admin/common/header_link'); // header Css link
              $this->load->view('system_path/admin/common/header'); // body header
              $this->load->view('system_path/admin/common/side_menu'); // side bar menu
              $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
              $this->load->view('system_path/admin/attendance/searchstudentattendance', $data); // ...........body content page...........
              $this->load->view('system_path/admin/common/footer'); // footer & script link
              $this->load->view('system_path/jsquery'); // footer & script link
            }
            else {

              $sdata['errormessage'] = 'Attendance Information Not Found';
              $this->session->set_userdata($sdata);
               redirect(admin_Url()."/studentsattendance/studentattendancesearch");
            }
           
        }

    }


    public function searchattendancebyclass() {

      ini_set('memory_limit','-1');
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
                  'field' => 'data[fromDate]',
                  'label' => 'From Date',
                  'rules' => 'required'
              ),
              array(
                  'field' => 'data[toDate]',
                  'label' => 'To Date',
                  'rules' => 'required'
              )
          );
 $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            $sdata['errormessage'] = "Please Fill Up all field";
            $this->session->set_userdata($sdata);
            redirect(admin_Url() . "/studentsattendance/studentattendancesearch", "refresh");
        } else {
            $data = $this->input->post('data', TRUE);
            $data['programOfferId'] = $this->ProgramModleAdmin->getProgramOfferId($data);
           
            if (!empty($data['programOfferId'])) {
                 $data['attendancelist'] = $this->StudentattendanceModleAdmin->getstudentattendancebyclass($data);
                if (!empty($data['attendancelist']))
                {
                    $data['Attendance'] = 'active';
                    $this->load->view('system_path/admin/common/header_link'); // header Css link
                    $this->load->view('system_path/admin/common/header'); // body header
                    $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                    $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                    $this->load->view('system_path/admin/attendance/student_list_bydate', $data); // ...........body content page...........
                    $this->load->view('system_path/admin/common/footer'); // footer & script link
                    $this->load->view('system_path/jsquery'); // footer & script link
                } else {
                    $sdata['errormessage'] = "No Attendance Found";
                    $this->session->set_userdata($sdata);
                    redirect(admin_Url() . "/studentsattendance/studentattendancesearch", "refresh");
                }
            } else {
                $sdata['errormessage'] = "Classoffer Information is not offer yet";
                $this->session->set_userdata($sdata);
                redirect(admin_Url() . "/studentsattendance/studentattendancesearch", "refresh");
            }

         
          }
      
      }


     public function delete_attendance($id) {
        $id=(int)$id;
        $dlt=$this->StudentattendanceModleAdmin->delete_attendance($id);
        if($dlt)
        {
            $sdata['message'] = 'Attendance information Deleted';
            $this->session->set_userdata($sdata);
            redirect(admin_Url()."/studentsattendance/studentattendancesearch");
        }
        else{
            $sdata['message'] = 'Attendance information Not Deleted';
            $this->session->set_userdata($sdata);
            redirect(admin_Url()."/studentsattendance/studentattendancesearch");
        }
    
    }  

    public function studentattendancelist() {
        ini_set('memory_limit', '-1');

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
            array(
                'field' => 'data[programLevel]',
                'label' => 'Class Level',
                'rules' => 'required'
            ),
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
            )
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            $data['student'] = 'active';
            $this->load->view('system_path/admin/common/header_link'); // header Css link
            $this->load->view('system_path/admin/common/header'); // body header
            $this->load->view('system_path/admin/common/side_menu'); // side bar menu
            $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
            $this->load->view('system_path/admin/student/studentsearch'); // ...........body content page...........
            $this->load->view('system_path/admin/common/footer'); // footer & script link
            $this->load->view('system_path/jsquery'); // footer & script link
        } else {
            $data = $this->input->post('data', TRUE);
            $data['programOfferId'] = $this->ProgramModleAdmin->getProgramOfferId($data);

            if (!empty($data['programOfferId'])) {
              
                $data['studentlist'] = $this->StudentModleAdmin->searchRegisteredStudent($data);
              // print_r($data['studentlist']); die();
                
                if (!empty($data['studentlist'])) {
                    if (isset($_POST['search'])) {
                        $data['student'] = 'active'; 
                        $this->load->view('system_path/admin/common/header_link'); // header Css link
                        $this->load->view('system_path/admin/common/header'); // body header
                        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                        $this->load->view('system_path/admin/student/student_list',$data); // ...........body content page...........
                        $this->load->view('system_path/admin/common/footer'); // footer & script link
                        $this->load->view('system_path/jsquery'); // footer & script link
                    } elseif (isset($_POST['print'])) {
                        $this->load->view('system_path/admin/common/header_link'); // header Css link
                        $this->load->view('system_path/admin/student/printstudentlist', $data); // ...........body content page...........
                        $this->load->view('system_path/admin/common/footer'); // footer & script link  
                        
                    } else {
                        $sdata['errormessage'] = 'Student Not Found';
                        $this->session->set_userdata($sdata);
                        redirect(admin_Url() . "/student");
                     
                    }
                } else {
                    $sdata['errormessage'] = 'No student found inserted enrollment information';
                    $this->session->set_userdata($sdata);
                    redirect(admin_Url() . "/student");
                }
            } else {
                $sdata['errormessage'] = 'Inserted Enrollment information is not offered yet!';
                $this->session->set_userdata($sdata);
                redirect(admin_Url() . "/student");
            }
        }
    }

       public function printStudentList($programofferid) {
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
            $data['studentlist'] = $this->StudentModleAdmin->searchRegisteredStudent($data);
            if(!empty($data['studentlist']))
            {
                $this->load->view('system_path/admin/common/header_link'); // header Css link
                $this->load->view('system_path/admin/student/printstudentlist', $data); // ...........body content page...........
                $this->load->view('system_path/admin/common/footer'); // footer & script link  
            }
            else
            {
                $sdata['errormessage'] = 'No Student Found';
                $this->session->set_userdata($sdata);
                redirect(admin_Url() . "/student");
            }      
        } else {
            $sdata['errormessage'] = 'No Student Found';
            $this->session->set_userdata($sdata);
            redirect(admin_Url() . "/student");
        }
    }


    
    

  
  
      

    // next function is for attendance insert by subject when any one need attendance by subject....     
    public function searchattendanceview() {


        $data['title'] = "Applicant Search";
        $data = $this->input->post('data', TRUE);
        if (empty($data['studentId'])) {
            $sdata['message'] = 'Enter Student Id';
            $this->session->set_userdata($sdata);
            $this->load->view('templates/admin/common/header');
            $this->load->view('templates/admin/studentsattendance/studentattendancesearch', $data);
            $this->load->view('templates/admin/common/footer');
        } else {
            $data['attendancelist'] = $this->StudentattendanceModleAdmin->getstudentattendanceview($data);

            //      redirect('admin/studentsattendance/studentattendancesearch');
            $this->load->view('templates/admin/common/header');
            $this->load->view('templates/admin/studentsattendance/attendancelist', $data);

            $this->load->view('templates/admin/common/footer');
        }
    }

}

