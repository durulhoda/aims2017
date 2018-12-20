<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */

class Student extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->account_access();
      

        $this->load->model('admin/result_view/Result_viewModleAdmin', 'Result_viewModleAdmin');
      
        $this->load->model('admin/fees/FeesModleAdmin', 'FeesModleAdmin');
        $this->load->model('admin/payments/PaymentsModleAdmin', 'PaymentsModleAdmin');

        $this->load->model('admin/student/StudentModleAdmin', 'StudentModleAdmin');
        $this->load->model('admin/program/ProgramModleAdmin', 'ProgramModleAdmin');

        $this->load->model('admin/assigncourse/AssignCourseModleAdmin', 'AssignCourseModleAdmin');
        $this->load->model('admin/studentattendance/StudentattendanceModleAdmin', 'StudentattendanceModleAdmin');
        $this->load->model('admin/studentmarks/StudentmarksModleAdmin', 'StudentmarksModleAdmin');
        $this->load->model('admin/payments/PaymentsModleAdmin', 'PaymentsModleAdmin');
    }

    public function index() {
        $data['student'] = 'active';
        $this->load->view('system_path/accounts/common/header_link'); // header Css link
        $this->load->view('system_path/accounts/common/header'); // body header
        $this->load->view('system_path/accounts/common/side_menu'); // side bar menu
        $this->load->view('system_path/accounts/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/accounts/student/studentsearch'); // ...........body content page...........
        $this->load->view('system_path/accounts/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
    }
    
    public function searchRegisteredStudent() {
      /**  ini_set('memory_limit', '-1');

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
            $data['student'] = 'active';
            $this->load->view('system_path/accounts/common/header_link'); // header Css link
            $this->load->view('system_path/accounts/common/header'); // body header
            $this->load->view('system_path/accounts/common/side_menu'); // side bar menu
            $this->load->view('system_path/accounts/common/top_menu', $data); // top bar menu
            $this->load->view('system_path/accounts/student/studentsearch'); // ...........body content page...........
            $this->load->view('system_path/accounts/common/footer'); // footer & script link
            $this->load->view('system_path/jsquery'); // footer & script link
        } else {**/
            $data = $this->input->post('data', TRUE); 

         //   $dataa = $this->ProgramModleAdmin->getalllist($data);
            
        //  print_r($dataa); die();

            if (!empty($data)) {
              
                $data['studentlist'] = $this->StudentModleAdmin->searchlist($data);
             // print_r($data['studentlist']); die();
                 
                if (!empty($data['studentlist'])) {
                    if (isset($_POST['search'])) {
                        $data['student'] = 'active'; 
                        $this->load->view('system_path/accounts/common/header_link'); // header Css link
                        $this->load->view('system_path/accounts/common/header'); // body header
                        $this->load->view('system_path/accounts/common/side_menu'); // side bar menu
                        $this->load->view('system_path/accounts/common/top_menu', $data); // top bar menu
                        $this->load->view('system_path/accounts/student/student_list',$data); // ...........body content page...........
                        $this->load->view('system_path/accounts/common/footer'); // footer & script link
                        $this->load->view('system_path/jsquery'); // footer & script link
                    } elseif (isset($_POST['print'])) {
                        $this->load->view('system_path/accounts/common/header_link'); // header Css link
                        $this->load->view('system_path/accounts/student/printstudentlist', $data); // ...........body content page...........
                        $this->load->view('system_path/accounts/common/footer'); // footer & script link  
                        
                    } else {
                        $sdata['errormessage'] = 'Student Not Found';
                        $this->session->set_userdata($sdata);
                        redirect(acc_Url() . "/student");
                     
                    }
                } else {
                    $sdata['errormessage'] = 'No student found inserted enrollment information';
                    $this->session->set_userdata($sdata);
                    redirect(acc_Url() . "/student");
                }
            } 
    }
    
    
      public function searchindividualStudent() {     
            $data = $this->input->post('data', TRUE); 
            if (!empty($data)) {
              
                $data['studentlist'] = $this->StudentModleAdmin->searchRegisteredStudentbyindv($data);
              // print_r($data['studentlist']); die();                
                if (!empty($data['studentlist'])) {
                    if (isset($_POST['search'])) {
                        $data['student'] = 'active'; 
                        $this->load->view('system_path/accounts/common/header_link'); // header Css link
                        $this->load->view('system_path/accounts/common/header'); // body header
                        $this->load->view('system_path/accounts/common/side_menu'); // side bar menu
                        $this->load->view('system_path/accounts/common/top_menu', $data); // top bar menu
                        $this->load->view('system_path/accounts/student/studentlist_byindividual',$data); // ...........body content page...........
                        $this->load->view('system_path/accounts/common/footer'); // footer & script link
                        $this->load->view('system_path/jsquery'); // footer & script link
                    } elseif (isset($_POST['print'])) {
                        $this->load->view('system_path/accounts/common/header_link'); // header Css link
                        $this->load->view('system_path/accounts/student/printstudentlist', $data); // ...........body content page...........
                        $this->load->view('system_path/accounts/common/footer'); // footer & script link  
                        
                    } else {
                        $sdata['errormessage'] = 'Student Not Found';
                        $this->session->set_userdata($sdata);
                        redirect(acc_Url() . "/student");
                     
                    }
                } else {
                    $sdata['errormessage'] = 'No student found inserted information';
                    $this->session->set_userdata($sdata);
                    redirect(acc_Url() . "/student");
                }
            } else {
                $sdata['errormessage'] = 'Student Not Found! Please Search Again with Right Information';
                $this->session->set_userdata($sdata);
                redirect(acc_Url() . "/student");
            }
        }
    
           public function printStudentList($programId) {
                $data = $this->input->post('data', TRUE); 
             //   print_r($data); die();
        $datax['programId'] = (int)$programId;
        $data['studentlist'] = $this->ProgramModleAdmin->getofferProgramInfoByclass($datax['programId']);
        $data['studentlist'] = $this->StudentModleAdmin->searchlist($data);
         //   $data['studentlist'] = $this->StudentModleAdmin->searchRegisteredStudent($data);
            if(!empty($data['studentlist']))
            {
                $this->load->view('system_path/accounts/common/header_link'); // header Css link
                $this->load->view('system_path/accounts/student/printstudentlist', $data); // ...........body content page...........
                $this->load->view('system_path/accounts/common/footer'); // footer & script link  
            }
            else
            {
                $sdata['errormessage'] = 'No Student Found';
                $this->session->set_userdata($sdata);
                redirect(acc_Url() . "/student");
            }      
       
    }
    /*
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
                'sectionId' => $datax['sectionId'],
                'programOfferId'=>$datax['programOfferId']
            );
            $data['studentlist'] = $this->StudentModleAdmin->searchRegisteredStudent($data);
            if(!empty($data['studentlist']))
            {
                $this->load->view('system_path/accounts/common/header_link'); // header Css link
                $this->load->view('system_path/accounts/student/printstudentlist', $data); // ...........body content page...........
                $this->load->view('system_path/accounts/common/footer'); // footer & script link  
            }
            else
            {
                $sdata['errormessage'] = 'No Student Found';
                $this->session->set_userdata($sdata);
                redirect(acc_Url() . "/student");
            }      
        } else {
            $sdata['errormessage'] = 'No Student Found';
            $this->session->set_userdata($sdata);
            redirect(acc_Url() . "/student");
        }
    }
    */
    
    public function searchstudentinfo() {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
            array(
                'field' => 'data[campusId]',
                'label' => 'Campus',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[mediumId]',
                'label' => 'Medium',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[programId]',
                'label' => 'Program',
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
            $this->load->view('system_path/accounts/common/header_link'); // header Css link
            $this->load->view('system_path/accounts/common/header'); // body header
            $this->load->view('system_path/accounts/common/side_menu'); // side bar menu
            $this->load->view('system_path/accounts/common/top_menu', $data); // top bar menu
            $this->load->view('system_path/accounts/student/studentsearch'); // ...........body content page...........
            $this->load->view('system_path/accounts/common/footer'); // footer & script link
            $this->load->view('system_path/jsquery'); // footer & script link
            
        } else {
            $data = $this->input->post('data', TRUE);

            $data['enrollData'] = getValidateofferedprogram($data);
      
            if (!empty($data['enrollData'])) {

                $data['studentlist'] =$this->StudentModleAdmin->getApplicationIdByprogramofferId($data['enrollData']['programOfferId']);
          //     print_r($data['studentlist']); die();
                
                if (!empty($data['studentlist'])) {
                    if (isset($_POST['search'])) {
                        $data['student'] = 'active';
                        $this->load->view('system_path/accounts/common/header_link'); // header Css link
                        $this->load->view('system_path/accounts/common/header'); // body header
                        $this->load->view('system_path/accounts/common/side_menu'); // side bar menu
                        $this->load->view('system_path/accounts/common/top_menu', $data); // top bar menu
                        $this->load->view('system_path/accounts/student/studentinfosearch', $data); // ...........body content page...........
                        $this->load->view('system_path/accounts/common/footer'); // footer & script link
                        $this->load->view('system_path/jsquery'); // footer & script link
                        
                    } elseif (isset($_POST['print'])) {
                        $data['student'] = 'active';
                        $this->load->view('system_path/accounts/common/header_link'); // header Css link
                        $this->load->view('system_path/accounts/common/header'); // body header
                        $this->load->view('system_path/accounts/common/side_menu'); // side bar menu
                        $this->load->view('system_path/accounts/common/top_menu', $data); // top bar menu
                        $this->load->view('system_path/accounts/student/printapplicantlist', $data); // ...........body content page...........
                        $this->load->view('system_path/accounts/common/footer'); // footer & script link
                       
                    } else {
                        $sdata['errormessage'] = 'Data Not Found';
                        $this->session->set_userdata($sdata);
                        redirect(acc_Url() . "/student");
                    }
                } else {

                    $sdata['errormessage'] = 'Student information not found for this enrollment information!';
                    $this->session->set_userdata($sdata);
                    redirect(acc_Url() . "/student");
                }
            } else {

                $sdata['errormessage'] = 'Inserted Enrollment information is not offered yet !';
                $this->session->set_userdata($sdata);
                redirect(acc_Url() . "/student");
            }
        }
    }

  

    public function viewstudentInfo($id) {
        $data = $this->input->post('data', TRUE); 
       // $data['programOfferId'] =(int)$programofferid;
   //     print_r($data); die();
        $data['studentId'] =(int)$id;
        $data['editData'] = $this->StudentModleAdmin->getstudentNameInfo($id);  
        
                    $data['totalfees'] = $this->FeesModleAdmin->totalamount($data['editData']);
                    $data['totalamount'] = $this->PaymentsModleAdmin->totalpaidamount($data['editData']);   
                    
       //  print_r($data);die();
        if (!empty($data['editData'])) {
              $data['prevaccInfo'] = $this->StudentModleAdmin->prevaccinfo_stu($id);
            //  print_r($data['prevaccInfo']); die();
            $data['student'] = 'active';
            $this->load->view('system_path/accounts/common/header_link'); // header Css link
            $this->load->view('system_path/accounts/common/header'); // body header
            $this->load->view('system_path/accounts/common/side_menu'); // side bar menu
            $this->load->view('system_path/accounts/common/top_menu', $data); // top bar menu
            $this->load->view('system_path/accounts/student/studentprofile', $data); // ...........body content page...........
            $this->load->view('system_path/accounts/common/footer'); // footer & script link
        } else {
            $sdata['errormessage'] = 'Student Information not found';
            $this->session->set_userdata($sdata);
            redirect(acc_Url() . "/student");
        }
    }

    public function viewapplicantInfo($id) {

        $this->load->view('templates/accounts/common/header');
        $data['editData'] = $this->StudentModleAdmin->viewapplicantInfo($id);
        $data['enrollData'] = $this->ProgramModleAdmin->getofferProgramInfoById(getprogramOfferIdByApplicant($id));
        $this->load->view('templates/accounts/student/viewapplicantinfo', $data);
        $this->load->view('templates/accounts/common/footer');
    }

   
    
    
}