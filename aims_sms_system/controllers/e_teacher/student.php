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
        $this->student_logged_auth();

        $this->load->model('admin/student/StudentModleAdmin', 'StudentModleAdmin');
        $this->load->model('admin/program/ProgramModleAdmin', 'ProgramModleAdmin');

        $this->load->model('admin/assigncourse/AssignCourseModleAdmin', 'AssignCourseModleAdmin');
        $this->load->model('admin/studentattendance/StudentattendanceModleAdmin', 'StudentattendanceModleAdmin');
        $this->load->model('admin/studentmarks/StudentmarksModleAdmin', 'StudentmarksModleAdmin');
        $this->load->model('admin/payments/PaymentsModleAdmin', 'PaymentsModleAdmin');
    }

    public function index() {
        $data['student'] = 'active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/student/studentsearch'); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
    }
    
    public function searchRegisteredStudent() {
        ini_set('memory_limit', '-1');

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

            $this->load->view('templates/admin/common/header');
            $this->load->view('templates/admin/student/studentsearch');
            $this->load->view('templates/admin/common/footer');
        } else {
            $data = $this->input->post('data', TRUE);

            $data['enrollData'] = getValidateofferedprogram($data);
      
            if (!empty($data['enrollData'])) {

                $data['studentlist'] =$this->StudentModleAdmin->getApplicationIdByprogramofferId($data['enrollData']['programOfferId']);
          //     print_r($data['studentlist']); die();
                
                if (!empty($data['studentlist'])) {
                    if (isset($_POST['search'])) {
                        $this->load->view('templates/admin/common/header');
                        $this->load->view('templates/admin/student/studentinfosearch', $data);
                        $this->load->view('templates/admin/common/footer');
                    } elseif (isset($_POST['print'])) {
                        $this->load->view('templates/admin/common/header');
                        $this->load->view('templates/admin/student/printapplicantlist', $data);
                        $this->load->view('templates/admin/common/footer');
                    } else {
                        $sdata['message'] = 'Data Not Found';
                        $this->session->set_userdata($sdata);
                        redirect(base_url('admin/student', $data));
                    }
                } else {

                    $sdata['message'] = 'Student information not found for this enrollment information!';
                    $this->session->set_userdata($sdata);
                    redirect(base_url('admin/student', $data));
                }
            } else {

                $sdata['message'] = 'Inserted Enrollment information is not offered yet !';
                $this->session->set_userdata($sdata);
                redirect(base_url('admin/student', $data));
            }
        }
    }

    public function editstudent($studentId) {
        $data['editData'] = $this->StudentModleAdmin->getstudentNameInfo($studentId);
     
        //     print_r($data); die();
        if (!empty($data['editData'])) {
             $data['student'] = 'active';
            $this->load->view('system_path/admin/common/header_link'); // header Css link
            $this->load->view('system_path/admin/common/header'); // body header
            $this->load->view('system_path/admin/common/side_menu'); // side bar menu
            $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
            $this->load->view('system_path/admin/student/editstudent', $data); // ...........body content page...........
            $this->load->view('system_path/admin/common/footer'); // footer & script link
        } else {
       //     echo "DIEEEE"; die();
             $sdata['errormessage'] = 'Invalid Student Id...Please try again';
             $this->session->set_userdata($sdata);
           // $this->searchapplicant();
            redirect(admin_Url() . "/student/searchRegisteredStudent");
        }
    } 

    public function viewstudentInfo($id) {

        $data['editData'] = getstudentNameInfo($id);
        //  print_r($data);die();
        if (!empty($data['editData'])) {
            $data['student'] = 'active';
            $this->load->view('system_path/admin/common/header_link'); // header Css link
            $this->load->view('system_path/admin/common/header'); // body header
            $this->load->view('system_path/admin/common/side_menu'); // side bar menu
            $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
            $this->load->view('system_path/admin/student/studentprofile', $data); // ...........body content page...........
            $this->load->view('system_path/admin/common/footer'); // footer & script link
        } else {

            echo 'Student Id is Invailed';
        }
    }

    public function viewapplicantInfo($id) {

        $this->load->view('templates/admin/common/header');
        $data['editData'] = $this->StudentModleAdmin->viewapplicantInfo($id);
        $data['enrollData'] = $this->ProgramModleAdmin->getofferProgramInfoById(getprogramOfferIdByApplicant($id));
        $this->load->view('templates/admin/student/viewapplicantinfo', $data);
        $this->load->view('templates/admin/common/footer');
    }

    public function updateStudent($id) {

        $data = $this->input->post('data', TRUE);

        $data['editData']=$this->StudentModleAdmin->updateapplicantInfo($data, $id);
        if( $data['editData'])
        {
        $sdata = array();
        $sdata['message'] = 'Updated Successfully !';
        $this->session->set_userdata($sdata);
        }else
        {
            $sdata['message'] = 'Not Updated !';
        $this->session->set_userdata($sdata);
        }
       
        redirect(admin_Url() . "/student");
    }

    public function deleteStudentData($id) {
        
        $info=  getstudentNameInfo($id);
        $programOfferId=$info['programOfferId']; 
       // print_r($programOfferId); echo "--";print_r($id);die();
        $this->StudentModleAdmin->deletestudent($id,$programOfferId);
        //     $this->StudentModleAdmin->deletePhotoRequest($id);
        $this->AssignCourseModleAdmin->deletestudent($id,$programOfferId);
        $this->StudentattendanceModleAdmin->deletestudentattandance($id,$programOfferId);
        $this->StudentmarksModleAdmin->deletestudentmarks($id,$programOfferId);
        $this->PaymentsModleAdmin->deletestudentdiscount($id,$programOfferId);
        $this->PaymentsModleAdmin->deletestudentfine($id,$programOfferId);
        
        $sdata['message'] = $id.' Student all information is Successfully deleted!';
        $this->session->set_userdata($sdata);
       redirect(admin_Url() . "/student/searchRegisteredStudent");
    }

    public function uploadphoto($id) {

        $data['editData'] = $this->StudentModleAdmin->editapplicantInfo($id);
        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/student/uploadstudentphoto', $data);
        $this->load->view('templates/admin/common/footer');
    }

    public function updateStudentphoto($id) {


        $config['upload_path'] = './uploads/Students/';
        $config['allowed_types'] = '*';
        $config['max_size'] = '200';
        $config['max_width'] = '200';
        $config['max_height'] = '200';
        $udata = '';
        $udata1 = '';
        $udata2 = '';
        $udata3 = '';

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('photo')) {
            $data['photo'] = $data['photo'];
            $error = array('error' => $this->upload->display_errors());
        } else {

            $udata = array('upload_data' => $this->upload->data());
            $data['photo'] = "uploads/Students/" . $udata['upload_data']['file_name'];
        }
        if (!$this->upload->do_upload('fatherPhoto')) {
            $error = array('error' => $this->upload->display_errors());
        } else {

            $udata1 = array('upload_data1' => $this->upload->data());
            $data['fatherPhoto'] = "uploads/Students/" . $udata1['upload_data1']['file_name'];
        }

        if (!$this->upload->do_upload('motherPhoto')) {
            $error = array('error' => $this->upload->display_errors());
        } else {

            $udata2 = array('upload_data2' => $this->upload->data());
            $data['motherPhoto'] = "uploads/Students/" . $udata2['upload_data2']['file_name'];
        }
        if (!$this->upload->do_upload('motherPhoto')) {
            $error = array('error' => $this->upload->display_errors());
        } else {

            $udata3 = array('upload_data3' => $this->upload->data());
            $data['guardianPhoto'] = "uploads/Students/" . $udata3['upload_data3']['file_name'];
        }
        $this->StudentModleAdmin->updateapplicantInfo($data, $id);
        $sdata['message'] = 'Photo Upload';
        $this->session->set_userdata($sdata);
        redirect('admin/student/uploadphoto/' . $id . '');
    }

    public function GetStudentlist() {

//        $data['title'] = "student";
//        $studentlist = $this->StudentModleAdmin->getStudentInfo();
        $data['listdata'] = $this->StudentModleAdmin->getStudentInfo();
//        print_r($data); exit;
        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/student/getstudentlist', $data);
        $this->load->view('templates/admin/common/footer');
    }

    public function studentsearch() {

        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/student/studentsearch');
        $this->load->view('templates/admin/common/footer');
    }

    public function bachinsert() {

        if (!empty($_POST['applicationId'])) {

            $this->load->view('templates/admin/common/header');
            $this->load->view('templates/admin/student/bachinsert');
            $this->load->view('templates/admin/common/footer');
        } else {
            $sdata = array();
            $sdata['message'] = 'Select any Appicant!';
            $this->session->set_userdata($sdata);
            redirect('admin/student/searchstudentinfo');
        }
    }

    public function batchinfoinsert() {

        $this->StudentModleAdmin->insertbatch();
        $sdata = array();
        $sdata['message'] = 'Marks Added Successfully!';
        $this->session->set_userdata($sdata);

        redirect('admin/student/addadmissionmark');
    }

    public function getstudentidcard() {
        $data['student'] = 'active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/student/studentidcard'); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
    }

    public function getstudentid() {
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
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/student/studentidcard'); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
        } else {
        
        ini_set('memory_limit','-1');
        
            $data = $this->input->post('data', TRUE);
            $data['programOfferId'] = getProgramOfferId($data);

            if ($data['programOfferId'] != 0) {
            
                $data['studentlist'] = $this->StudentModleAdmin->searchRegisteredStudent($data);
                //  print_r($data);die();
                if (!empty($data['studentlist'])) {
        $data['student'] = 'active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/student/getstudentid', $data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
                } else {
                    $sdata['errormessage'] = 'No student found inserted enrollment information';
                    $this->session->set_userdata($sdata);
                    redirect(admin_Url() . "/student/getstudentidcard");
                }
            } else {
                $sdata['errormessage'] = 'Inserted Enrollment information is not offered yet!';
                $this->session->set_userdata($sdata);
                redirect(admin_Url() . "/student/getstudentidcard");
            }
        }
    }

    public function generateId() {

        if (!empty($_POST['studentId'])) {
        	ini_set('memory_limit','-1');

            $data['studentId'] = $this->input->post('studentId');
            $StudentId = $data['studentId'];
            $this->load->library('pdf');

            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('Nicola Asuni');
            $pdf->SetTitle('TCPDF Example 028');

            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(false);

// set default monospaced font
            $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
            $pdf->SetMargins(0, 0, 0, 0);

// set auto page breaks
            $pdf->SetAutoPageBreak(TRUE, '1');

// set image scale factor
            $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
            if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
                require_once(dirname(__FILE__) . '/lang/eng.php');
                $pdf->setLanguageArray($l);
            }

// ---------------------------------------------------------
            $pdf->SetDisplayMode('fullpage', 'SinglePage', 'UseNone');
// set font
            $pdf->SetFont('helvetica', 'B', 11);

            $pdf->AddPage('P', 'A7');

            for ($i = 0; $i < count($StudentId); $i++) {
                $countStudentId = $StudentId[$i];
                $stuinfo = getstudentNameInfo($countStudentId);


                // Get Student Logo is valid or not  
                if (file_exists($stuinfo['photo'])) {
                    $images = base_url() . $stuinfo['photo'];
                } else {
                    $images = base_url() . "uploads/default/default.png";
                    ;
                }

                if (!empty($images)) {
                    $pdf->ImageEps($file = base_url() . 'images/idcard.ai', $x = 0, $y = 0, $w = 0, $h = 0, $link = '', $useBoundingBox = true, $align = 'center', $palign = '', $border = 0, $fitonpage = false);

                    $pdf->Image($images, 15, 26, 23, 25);


                    $tbl = "

            <table style=\"text-align:center; top:50px; \" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" >
            
               
                 <tr>
                    <td style=\"height:60px;\">
                         <br><br><br><br><br><br><br>
                         <br><br><br><br>
                         </td>

                </tr>
                 <tr>
                   <td style=\"color:#2F3192 \">ID: " . $stuinfo['studentId'] . "</td>
                </tr>
                
                <tr>
                   <td style=\"color:#E22B27;font-family:Arial; font-size:15px bold;\">" . $stuinfo['firstName'] . " " . $stuinfo['lastName'] . " </td>
                </tr>
                    <tr>
                   <td style=\"font-family:Arial; font-size:12px\">Class: " . getProgramName($stuinfo['programId']) . "</td>
                </tr>
                    <tr>

                   <td style=\"font-family:Arial; font-size:12px\">Session: " . $stuinfo['sessionId'] . "</td>
                </tr>
                
                 
            </table> ";

                    $pdf->writeHTML($tbl, true, false, false, false, '');

                    $pdf->AddPage();
                }
            }

            $pdf->Output('getProgramName($stuinfo[programId]).pdf', 'I');
        } else {
            $sdata = array();
            $sdata['errormessage'] = 'Select any Student!';
            $this->session->set_userdata($sdata);
            redirect(admin_Url() . "/student/getstudentidcard");
        }
    }
    
    
      public function photoValidation() {

        $data['request'] = $this->StudentModleAdmin->getStudentPhotoRequest();
        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/student/photoValidation', $data);
        $this->load->view('templates/admin/common/footer');
    }

    public function photoconfirmation($studentId) {

        $this->load->view('templates/admin/common/header');
        $data['request'] = $this->StudentModleAdmin->photoconfirmation($studentId);
        $this->load->view('templates/admin/student/photoconfirmation', $data);
        $this->load->view('templates/admin/common/footer');
    }

    public function photoAccept($id) {

        $datas = $this->input->post('data', TRUE);
        $editData = getstudentNameInfo($id);
        $this->StudentModleAdmin->updateapplicantInfo($datas, $editData['applicationId']);

        $data['publicationstatus'] = '1';
        $this->StudentModleAdmin->updatePhotoRequest($data, $id);
        $this->StudentModleAdmin->deletePhotoRequest($id);
        $sdata['message'] = 'Update Successfull!';
        $this->session->set_userdata($sdata);
        redirect('admin/student/photoValidation');
    }

    public function photoDenied($id) {

        $this->StudentModleAdmin->deletePhotoRequest($id);
        $sdata['message'] = 'Request Deleted';
        $this->session->set_userdata($sdata);
        redirect('admin/student/photoValidation');
    }

    
    
    
    
    
    
    
    
    
    
    
    
    

    public function stdudentPagination() {

        $this->load->library('pagination');
        $this->load->library('table');
        $config = array();
        $config["base_url"] = base_url("admin/student/stdudentPagination/");
        $config["total_rows"] = $this->db->count_all('student');
        $config["per_page"] = 4;

        //pagination customization using bootstrap styles
        $config['full_tag_open'] = '<div class="pagination pagination-centered"><ul class="page_test">'; // I added class name 'page_test' to used later for jQuery
        $config['full_tag_close'] = '</ul></div><!--pagination-->';
        $config['first_link'] = '&laquo; First';
        $config['first_tag_open'] = '<li class="prev page">';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'Last &raquo;';
        $config['last_tag_open'] = '<li class="next page">';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = 'Next &rarr;';
        $config['next_tag_open'] = '<li class="next page">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '&larr; Previous';
        $config['prev_tag_open'] = '<li class="prev page">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="active"><a href="">';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li class="page">';
        $config['num_tag_close'] = '</li>';
        $config['uri_segment'] = 4;

        $this->pagination->initialize($config);

        $page = (end($this->uri->segments)) ? end($this->uri->segments) : 0;

        $data['page'] = $page;

//        $this->StudentModleAdmin->getStudentInfo();

        $data['records'] = $this->StudentModleAdmin->getStudentInfo($config["per_page"], $page);

//        print_r($data); exit;
        $this->load->view('templates/admin/student/stdudentPagination', $data);
//        $this->load->view('templates/admin/common/footer');
    }

  
    public function PrintCopy($value, $id) {

        if ($value == "Applicant") {
            $data['valx'] = "Applicant";
            $data['editData'] = $this->StudentModleAdmin->viewapplicantInfo($id);
            $data['enrollData'] = $this->ProgramModleAdmin->getofferProgramInfoById(getprogramOfferIdByApplicant($id));
            $this->load->view('templates/admin/common/header');
            $this->load->view('templates/admin/student/printsingleStudent', $data);
            $this->load->view('templates/admin/common/footer');
        } elseif ($value == "Student") {
            $data['valx'] = "Student";
            $data['editData'] = getstudentNameInfo($id);
            $this->load->view('templates/admin/common/header');
            $this->load->view('templates/admin/student/printsingleStudent', $data);
            $this->load->view('templates/admin/common/footer');
        } else {
            $sdata['message'] = 'Invaild Formet';
            $this->session->set_userdata($sdata);
            redirect(base_url('admin'));
        }
    }

}