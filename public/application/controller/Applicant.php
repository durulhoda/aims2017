<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Project Name: Student Management System
 * Author: Pollux Technology Solutions
 * Author url: http://www.polluxtech.com
 * 
 */

class Applicant extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->my_admin();
        date_default_timezone_set('Asia/Dhaka');
$this->load->helper(array('form', 'url'));
        $this->load->library('image_moo') ;
        $this->load->model('admin/admissiontest/AdmissiontestModleAdmin', 'AdmissiontestModleAdmin');
        $this->load->model('admin/studentregistration/StudentregistrationModleAdmin', 'StudentregistrationModleAdmin');
        $this->load->model('admin/student/StudentModleAdmin', 'StudentModleAdmin');
        $this->load->model('admin/program/ProgramModleAdmin', 'ProgramModleAdmin');
        $this->load->model('admin/courseoffer/CourseofferModleAdmin', 'CourseofferModleAdmin');
        $this->load->model('admin/institute/InstituteModleAdmin', 'InstituteModleAdmin');
    }

        public function RegistrationForm() {
        $data['registration'] = 'active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/applicant/registration_form'); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
    }
    public function cropRegistrationForm() {
        
        $data['upload_path']        = $upload_path          = "./public/upload/real/" ;
        $data['destination_thumbs'] = $destination_thumbs   = "./public/upload/thumbs/" ;
  
        $data['large_photo_exists'] = $data['thumb_photo_exists'] = $data['error'] = NULL ;
        $data['thumb_width']        = "100";
        $data['thumb_height']       = "100";
      //    print_r($data); die();
        if (!empty($_POST['upload'])) {
            $this->load->library('upload');
            $config['upload_path']  = $upload_path ;
            $config['allowed_types']= 'gif|jpg|png|jpeg';
            $config['max_size']     = '2000';
            $config['max_width']    = '2000';
            $config['max_height']   = '2000';

           
           
              $this->upload->initialize($config);
         // print_r($test); die();
            if ($this->upload->do_upload("image")) {
                $data['img']	 = $this->upload->data();
                $data['large_photo_exists']  = "<img src=\"".base_url() . $upload_path.$data['img']['file_name']."\" alt=\"Large Image\"/>";
           $upload_path.$data['img']['file_name'];
                }
        }
        elseif (!empty($_POST['upload_thumbnail'])) {
            $x1 = $this->input->post('x1',TRUE) ;
            $y1 = $this->input->post('y1',TRUE) ;
            $x2 = $this->input->post('x2',TRUE) ;
            $y2 = $this->input->post('y2',TRUE) ;
            $w  = $this->input->post('w',TRUE) ;
            $h  = $this->input->post('h',TRUE) ;

            $file_name                  = $this->input->post('file_name',TRUE) ;
          //  print_r($file_name); die();
            if ($file_name) {
                $this->image_moo
                    ->load($upload_path . $file_name)
                    ->crop($x1,$y1,$x2,$y2)
                    ->save($destination_thumbs . $file_name) ;

    //    <!--------------Code Start-------------->
                   
                //print_r($data); die();
                  $data = $this->input->post('data', TRUE);
                $datax = $this->input->post('datax', TRUE);
              $data['photo'] = "public/upload/thumbs/" . $file_name;
                $enrol = $this->ProgramModleAdmin->getValidateofferedprogram($datax);
        //===================================End image processing==================================
                            $new_stt = sprintf('%02d', $datax['programId']);
                            $datae = date('Y');
                            $data['applicationId'] = $datae . "" . strval($new_stt) . "" . counter();
      //print_r($data); die();
                            $check = $this->StudentModleAdmin->editapplicantInfo($data['applicationId']);
                            if ($check) {
                                $sdata = array();
                                $sdata['errormessage'] = 'System Found some problem with new applicationId...Please create again !!';
                                $this->session->set_userdata($sdata);

                                $data['registration'] = 'active';
                                $this->load->view('system_path/admin/common/header_link'); // header Css link
                                $this->load->view('system_path/admin/common/header'); // body header
                                $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                                $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                                $this->load->view('system_path/admin/applicant/registration_form'); // ...........body content page...........
                                $this->load->view('system_path/admin/common/footer'); // footer & script link
                                $this->load->view('system_path/jsquery'); // footer & script link
                            } else {
                              //  $img_data = $this->upload->data();
                               // $data['photo'] = "uploads/Students/" . $img_data['file_name'];
             
                 $category= $this->input->post('category');
                 $roll = $this->input->post('roll');
                 $thana_registration= $this->input->post('thana_registration');
                 $board= $this->input->post('board');
                 $gpa= $this->input->post('gpa');
                 $passing_year= $this->input->post('passing_year');
        
      $count_clr = count($category);
        for ($i = 0; $i < $count_clr; $i++)
        {
            
        

                    $datay['category'] = $category[$i];
                    $datay['roll'] = $roll[$i];
                    $datay['thana_registration'] = $thana_registration[$i];
                    $datay['board'] = $board[$i];
                    $datay['gpa'] = $gpa[$i];
                    $datay['passing_year'] = $passing_year[$i];
                    $datay['applicationId']=$data['applicationId'];
                   // print_r($data); 
         $this->StudentModleAdmin->previusStudentInfo($datay);
        }
        
                                $this->StudentModleAdmin->addStudentInfo($data, $enrol);

                                $insert_id = $this->db->insert_id();
                                
                                
                                if (!empty($insert_id)) {

                                    $datass['editData'] = $this->StudentModleAdmin->getApplicantInfoById($insert_id);

                                    $datass['enrollData'] = $this->ProgramModleAdmin->getofferProgramInfoById(getprogramOfferIdByApplicant($datass['editData']['applicationId']));

                                    if (!empty($datass['editData']) && !empty($datass['enrollData'])) {

                                        $data['registration'] = 'active';
                                        $this->load->view('system_path/admin/common/header_link'); // header Css link
                                        $this->load->view('system_path/admin/common/header'); // body header
                                        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                                        $this->load->view('system_path/admin/common/top_menu', $datass); // top bar menu
                                        $this->load->view('system_path/admin/applicant/printapplicantinfo'); // ...........body content page...........
                                        $this->load->view('system_path/admin/common/footer'); // footer & script link
                                        return 0;
                                        }
                                } else {
                                    $sdata = array();
                                    $sdata['errormessage'] = 'System Found some problem with this application information...Please create again !!';
                                    $this->session->set_userdata($sdata);

                                    $data['registration'] = 'active';
                                    $this->load->view('system_path/admin/common/header_link'); // header Css link
                                    $this->load->view('system_path/admin/common/header'); // body header
                                    $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                                    $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                                    $this->load->view('system_path/admin/applicant/registration_form'); // ...........body content page...........
                                    $this->load->view('system_path/admin/common/footer'); // footer & script link
                                    $this->load->view('system_path/jsquery'); // footer & script link
                                }
                            }
                         //////////////   Insert Code End    ///////////////
                
                if ($this->image_moo->errors) {
                    $data['error'] = $this->image_moo->display_errors() ;
                }
                else {
                    $data['thumb_photo_exists'] = "<img src=\"".base_url() . $destination_thumbs . $file_name."\" alt=\"Thumbnail Image\"/>";
                    $data['large_photo_exists'] = "<img src=\"".base_url() . $upload_path.$file_name."\" alt=\"Large Image\"/>";
                }
            }

        }
        
       // $this->load->view('crop_form',$data) ;
        $data['registration'] = 'active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/applicant/registration_form',$data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
    }

    public function insertapplicant() {
 
        if (isset($_POST['btnSubmit'])) {
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
                    'field' => 'data[sbreg]',
                    'label' => 'Birth Registration Number',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'data[gender]',
                    'label' => 'Gender',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'data[fatherName]',
                    'label' => 'father\'s Name',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'data[motherName]',
                    'label' => 'Mother\'s Name',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'data[fatherPhone]',
                    'label' => 'father\'s Mobile Number',
                    'rules' => 'required'
                ),
                
                array(
                    'field' => 'datax[programId]',
                    'label' => 'Class',
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
                )
            );

            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() == FALSE) {
                $data['registration'] = 'active';
                $this->load->view('system_path/admin/common/header_link'); // header Css link
                $this->load->view('system_path/admin/common/header'); // body header
                $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                $this->load->view('system_path/admin/applicant/registration_form'); // ...........body content page...........
                $this->load->view('system_path/admin/common/footer'); // footer & script link
                $this->load->view('system_path/jsquery'); // footer & script link
            } else {
                //                    print_r($_POST); exit;
                $data = $this->input->post('data', TRUE);
                $datax = $this->input->post('datax', TRUE);

                $enrol = $this->ProgramModleAdmin->getValidateofferedprogram($datax);


                if (!empty($enrol)) {
                    if (!empty($data) && !empty($enrol)) {
                      //================================ image upload and resizing===========================
        //$imgData=array();
        $this->load->library('upload');
        $config['upload_path'] = './uploads/Students/';
        $config['allowed_types'] = 'png|jpeg|jpg|JPG|JPEG';
        $config['max_size'] = '1024';
        $config['max_width'] = '';
        $config['max_height'] = '';
        $this->upload->initialize($config);
        if ($this->upload->do_upload('photo')) {
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
        $resize_height = ($size[1] * 200) / $size[0];
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
                            $new_stt = sprintf('%02d', $datax['programId']);
                            $datae = date('Y');
                            $data['applicationId'] = $datae . "" . strval($new_stt) . "" . counter();

                            $check = $this->StudentModleAdmin->editapplicantInfo($data['applicationId']);
                            if ($check) {
                                $sdata = array();
                                $sdata['errormessage'] = 'System Found some problem with new applicationId...Please create again !!';
                                $this->session->set_userdata($sdata);

                                $data['registration'] = 'active';
                                $this->load->view('system_path/admin/common/header_link'); // header Css link
                                $this->load->view('system_path/admin/common/header'); // body header
                                $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                                $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                                $this->load->view('system_path/admin/applicant/registration_form'); // ...........body content page...........
                                $this->load->view('system_path/admin/common/footer'); // footer & script link
                                $this->load->view('system_path/jsquery'); // footer & script link
                            } else {
                              //  $img_data = $this->upload->data();
                               // $data['photo'] = "uploads/Students/" . $img_data['file_name'];
             
                 $category= $this->input->post('category');
                 $roll = $this->input->post('roll');
                 $thana_registration= $this->input->post('thana_registration');
                 $board= $this->input->post('board');
                 $gpa= $this->input->post('gpa');
                 $passing_year= $this->input->post('passing_year');
        
      $count_clr = count($category);
        for ($i = 0; $i < $count_clr; $i++)
        {
            
        

                    $datay['category'] = $category[$i];
                    $datay['roll'] = $roll[$i];
                    $datay['thana_registration'] = $thana_registration[$i];
                    $datay['board'] = $board[$i];
                    $datay['gpa'] = $gpa[$i];
                    $datay['passing_year'] = $passing_year[$i];
                    $datay['applicationId']=$data['applicationId'];
                   // print_r($data); 
         $this->StudentModleAdmin->previusStudentInfo($datay);
        }

                                $this->StudentModleAdmin->addStudentInfo($data, $enrol);

                                $insert_id = $this->db->insert_id();
                                
                                
                                if (!empty($insert_id)) {

                                    $datass['editData'] = $this->StudentModleAdmin->getApplicantInfoById($insert_id);

                                    $datass['enrollData'] = $this->ProgramModleAdmin->getofferProgramInfoById(getprogramOfferIdByApplicant($datass['editData']['applicationId']));

                                    if (!empty($datass['editData']) && !empty($datass['enrollData'])) {

                                        $data['registration'] = 'active';
                                        $this->load->view('system_path/admin/common/header_link'); // header Css link
                                        $this->load->view('system_path/admin/common/header'); // body header
                                        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                                        $this->load->view('system_path/admin/common/top_menu', $datass); // top bar menu
                                        $this->load->view('system_path/admin/applicant/printapplicantinfo'); // ...........body content page...........
                                        $this->load->view('system_path/admin/common/footer'); // footer & script link
                                    }
                                } else {
                                    $sdata = array();
                                    $sdata['errormessage'] = 'System Found some problem with this application information...Please create again !!';
                                    $this->session->set_userdata($sdata);

                                    $data['registration'] = 'active';
                                    $this->load->view('system_path/admin/common/header_link'); // header Css link
                                    $this->load->view('system_path/admin/common/header'); // body header
                                    $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                                    $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                                    $this->load->view('system_path/admin/applicant/registration_form'); // ...........body content page...........
                                    $this->load->view('system_path/admin/common/footer'); // footer & script link
                                    $this->load->view('system_path/jsquery'); // footer & script link
                                }
                            }
                        }
                   
                } else {
                    $sdata['errormessage'] = 'Inserted Enrolment Information is not offered yet';
                    $this->session->set_userdata($sdata);

                    $data['registration'] = 'active';
                    $this->load->view('system_path/admin/common/header_link'); // header Css link
                    $this->load->view('system_path/admin/common/header'); // body header
                    $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                    $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                    $this->load->view('system_path/admin/applicant/registration_form'); // ...........body content page...........
                    $this->load->view('system_path/admin/common/footer'); // footer & script link
                    $this->load->view('system_path/jsquery'); // footer & script link    
                }
            }
        } else {
            $sdata['errormessage'] = 'Insert Applicant information';
            $this->session->set_userdata($sdata);

            redirect(admin_Url() . "/applicant/RegistrationForm");
        }
    }

    public function searchapplicant() {
        $data['registration'] = 'active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/applicant/searchapplicant'); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
    }

       public function applicantregistration() {
        $data['registration'] = 'active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/applicant/searchapplicantreg'); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
    }

    public function applicantlist() {

        if (isset($_POST['search'])) {
          /**   $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');

           $config = array(
               
                array(
                    'field' => 'datax[programId]',
                    'label' => 'Class',
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
                )
            );

            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() == FALSE) {

                $data['registration'] = 'active';
                $this->load->view('system_path/admin/common/header_link'); // header Css link
                $this->load->view('system_path/admin/common/header'); // body header
                $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                $this->load->view('system_path/admin/applicant/searchapplicant'); // ...........body content page...........
                $this->load->view('system_path/admin/common/footer'); // footer & script link
                $this->load->view('system_path/jsquery'); // footer & script link
            } else {**/
            
                $data = $this->input->post('datax', TRUE);
          //      print_r($data); die();
                $data['enrollData'] = $this->ProgramModleAdmin->getValidateofferedprogramold($data);
                            //print_r($data['enrollData']); die();
                if (!empty($data['enrollData'])) {
                                    //    print_r($datas);  die();

                $data['applicantlist'] = $this->StudentModleAdmin->getApplicationIdByprogramofferId($data['enrollData']['programOfferId']);
                   // print_r($data['applicantlist']); die();

                    if (!empty($data['applicantlist'])) {
                        if (isset($_POST['search'])) {
                            $datas['programOfferId'] = getProgramOfferIdforcourse($data);
                    $data['courseassignlist'] = $this->CourseofferModleAdmin->CheckOfferedCourseAssign($datas['programOfferId']);

                            $data['registration'] = 'active';
                            $this->load->view('system_path/admin/common/header_link'); // header Css link
                            $this->load->view('system_path/admin/common/header'); // body header
                            $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                            $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                            $this->load->view('system_path/admin/applicant/applicant_list', $data); // ...........body content page...........
                            $this->load->view('system_path/admin/common/footer'); // footer & script link
                            $this->load->view('system_path/jsquery'); // footer & script link
                            
                        } elseif (isset($_POST['print'])) {
                            $this->load->view('system_path/admin/common/header_link'); // header Css link
                            $this->load->view('system_path/admin/applicant/printapplicant_list', $data); // ...........body content page...........
                            $this->load->view('system_path/admin/common/footer'); // footer & script link 
                        } else {
                            $sdata['errormessage'] = 'No Applicant Found';
                            $this->session->set_userdata($sdata);
                            redirect(admin_Url() . "/applicant/searchapplicant");
                        }
                    } else {

                        $sdata['errormessage'] = 'Applicant information not found for this enrollment information!';
                        $this->session->set_userdata($sdata);
                        redirect(admin_Url() . "/applicant/searchapplicant");
                    }
                } else {

                    $sdata['errormessage'] = 'Given Enrollment information is not offered yet !';
                    $this->session->set_userdata($sdata);
                    redirect(admin_Url() . "/applicant/searchapplicant");
                }
            }
        
    }
    
    
    public function applicantReglist() {

        if (isset($_POST['search'])) {
          /**   $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');

           $config = array(
               
                array(
                    'field' => 'datax[programId]',
                    'label' => 'Class',
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
                )
            );

            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() == FALSE) {

                $data['registration'] = 'active';
                $this->load->view('system_path/admin/common/header_link'); // header Css link
                $this->load->view('system_path/admin/common/header'); // body header
                $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                $this->load->view('system_path/admin/applicant/searchapplicant'); // ...........body content page...........
                $this->load->view('system_path/admin/common/footer'); // footer & script link
                $this->load->view('system_path/jsquery'); // footer & script link
            } else {**/
            
                $data = $this->input->post('datax', TRUE);
          //      print_r($data); die();
                $data['enrollData'] = $this->ProgramModleAdmin->getValidateofferedprogramold($data);
                            //print_r($data['enrollData']); die();
                if (!empty($data['enrollData'])) {
                                    //    print_r($datas);  die();

                $data['applicantlist'] = $this->StudentModleAdmin->getApplicationIdByprogramofferId($data['enrollData']['programOfferId']);
                   // print_r($data['applicantlist']); die();

                    if (!empty($data['applicantlist'])) {
                        if (isset($_POST['search'])) {
                            $datas['programOfferId'] = getProgramOfferIdforcourse($data);
                    $data['courseassignlist'] = $this->CourseofferModleAdmin->CheckOfferedCourseAssign($datas['programOfferId']);

                            $data['registration'] = 'active';
                            $this->load->view('system_path/admin/common/header_link'); // header Css link
                            $this->load->view('system_path/admin/common/header'); // body header
                            $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                            $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                            $this->load->view('system_path/admin/applicant/applicantreg', $data); // ...........body content page...........
                            $this->load->view('system_path/admin/common/footer'); // footer & script link
                            $this->load->view('system_path/jsquery'); // footer & script link
                            
                        } elseif (isset($_POST['print'])) {
                            $this->load->view('system_path/admin/common/header_link'); // header Css link
                            $this->load->view('system_path/admin/applicant/printapplicant_list', $data); // ...........body content page...........
                            $this->load->view('system_path/admin/common/footer'); // footer & script link 
                        } else {
                            $sdata['errormessage'] = 'No Applicant Found';
                            $this->session->set_userdata($sdata);
                            redirect(admin_Url() . "/applicant/searchapplicant");
                        }
                    } else {

                        $sdata['errormessage'] = 'Applicant information not found for this enrollment information!';
                        $this->session->set_userdata($sdata);
                        redirect(admin_Url() . "/applicant/searchapplicant");
                    }
                } else {

                    $sdata['errormessage'] = 'Given Enrollment information is not offered yet !';
                    $this->session->set_userdata($sdata);
                    redirect(admin_Url() . "/applicant/searchapplicant");
                }
            }
        
    }

    public function printAppliacnrList($programofferid) {
        $programofferid = (int) $programofferid;
        $datax = $this->ProgramModleAdmin->getofferProgramInfoById($programofferid);
        if (!empty($datax)) {
            $data = array(
                'sessionId' => $datax['sessionId'],
                'programLevel' => $datax['programLevel'],
                'programId' => $datax['programId'],
                'mediumId' => $datax['mediumId'],
                'shiftId' => $datax['shiftId'],
                'groupId' => $datax['groupId']
            );
            $data['applicantlist'] = $this->StudentModleAdmin->getApplicationIdByprogramofferId($programofferid);
            if(!empty($data['applicantlist']))
            {
                $this->load->view('system_path/admin/common/header_link'); // header Css link
                $this->load->view('system_path/admin/applicant/printapplicant_list', $data); // ...........body content page...........
                $this->load->view('system_path/admin/common/footer'); // footer & script link    
            }
            else
            {
                $sdata['errormessage'] = 'No Applicant Found';
                $this->session->set_userdata($sdata);
                redirect(admin_Url() . "/applicant/searchapplicant");
            }    
                
        } else {
            $sdata['errormessage'] = 'No Applicant Found';
            $this->session->set_userdata($sdata);
            redirect(admin_Url() . "/applicant/searchapplicant");
        }
    }

    // Applicant Registration Confirm Function
 
    public function apply_registration($applicationId) {

        $data['applicationId'] = (int) $applicationId;
      //  print_r($data); die();
          $datacheck = $this->StudentModleAdmin->getappInfo($data['applicationId']); // get applicant some information
       // print_r($datacheck); die();
           if(!empty($datacheck)){
              // echo '<pre>';               print_r( $datacheck);
        $applicantpromotioninfo = $this->StudentModleAdmin->getstudentsInfoArrayByApplicationId($data['applicationId']);
      //  print_r($applicantpromotioninfo); die();
        if (!empty($applicantpromotioninfo['applicationId']) == $data['applicationId']) {
            $sdata = array();
            $sdata['errormessage'] = "This Applicant is already registered";
            $this->session->set_userdata($sdata);
            redirect(admin_Url() . "/applicant/searchapplicant");
        } else {
            $data['studentlist'] = $this->StudentModleAdmin->getApplicantShortInfo($data['applicationId']); // get applicant some information
            //Get ProgramOffer information as array by application id using join    
            $data['programofferinfo'] = $this->ProgramModleAdmin->getPrOfferArraybyApplicantionId($data['applicationId']);

            $data['courseassignlist'] = $this->CourseofferModleAdmin->CheckOfferedCourseAssign($data['programofferinfo']['programOfferId']);
            //  print_r($data['courseassignlist']); die(); 
            if (!empty($data['courseassignlist'])) {

                // If Admission Procedure Continue with Admission Mark & Merit List then enable next line        
                //  $data['studentlist'] = $this->AdmissiontestModleAdmin->getPromotedApplicantinfo($datas);
                // If Admission Procedure Continue with Direct Admission then enable next line    

                $data['registration'] = 'active';
                $this->load->view('system_path/admin/common/header_link'); // header Css link
                $this->load->view('system_path/admin/common/header'); // body header
                $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                $this->load->view('system_path/admin/applicant/confirmregistration', $data); // ...........body content page...........
                $this->load->view('system_path/admin/common/footer'); // footer & script link
            } else {
                $sdata['errormessage'] = "For your inserted Applicant Id there are no Subject offered yet..";
                $this->session->set_userdata($sdata);

                redirect(admin_Url() . "/applicant/searchapplicant");
            }
        }
          }else {
                $sdata['errormessage'] = "Information Not Found Please Try Again......! Thanks";
                $this->session->set_userdata($sdata);

                redirect(admin_Url() . "/applicant/searchapplicant");
            }
        

    }

    public function test(){
        

$data1 = array(
                  'invoice_type' => $this->input->post('type'),
                  'reference_no' => $this->input->post('ref'),
                  'des_title' => $this->input->post('title'),
                  );
    /*
        Considering description ,voucher_no,price compulsary if user add discription
    */  
    $description = $this->input->post("description");
    $voucher_no = $this->input->post("voucher_no");
    $price = $this->input->post("price");
    $data2 ='';
    if(isset($description) && !empty($description)){
        $i = 0;
        foreach($description as $row){
            $data2[] =array(
                'description'=>$description[$i],
                'voucher_no' => $voucher_no[$i],
                'price'=>$price[$i],        
            );
            $i++;
        }
    }

    $this->sample_model->insert_entry($data1, $data2);
    }
    

      public function registrationConfarmlreg() {
            $checkAll = $this->input->post('checkAll');
          //  print_r($checkAll); die();
            $applicationId = $this->input->post('applicationId');
            
            $employeeId = $this->input->post('employeeId', TRUE);
            $courseId = $this->input->post('courseId', TRUE);
            $courseStatus = $this->input->post('courseStatus', TRUE);
             $datacls['programId'] = $this->input->post('programId', TRUE);
             $cls = $this->ProgramModleAdmin->getClassId($datacls);
            $dataa=$this->input->post('data');
         //   print_r($dataa); die();
             
             // $data['programOfferId'] = getProgramOfferId($dataa);
        
            if(!empty($checkAll)){
                $cuntCrl= $checkAll;
               // $i="";
                
              //   print_r($datas['programOfferId']); die();
              $setDate = date('Y');
              $clsId=$this->ProgramModleAdmin->getClassiiId($datacls);
             $class = sprintf('%02d', $clsId);
          // print_r($class); die();
                for ($i = 0; $i < count($cuntCrl); $i++)
                {
                     $test=$checkAll[$i]-1;
                    
                     
                    $data['applicationId']=$applicationId[$test];
                    
                  //  print_r($data['applicationId']); die();
                    $data['programOfferId'] = getProgramOfferIdforcourse($dataa);
                    if(!empty($data['programOfferId'])){
              //    print_r($data['programOfferId']); die();
                //Course Assign 
                        $datacorse['employeeId'] = ',' . implode(',', $employeeId) . ',';
                        $datacorse['courseId'] = ',' . implode(',', $courseId) . ',';
                        $datacorse['courseStatus'] = ',' . implode(',', $courseStatus) . ',';
                     
                    
                     
                        
                        
                        $counter = $this->ProgramModleAdmin->GetLastStudentSerialNo($setDate,$clsId);
                    if($counter > 0)
                    {
                        $regNo = $counter +1;
                        $this->ProgramModleAdmin->UpdateCounter($regNo,$setDate,$clsId);
                    }
                    else
                    {
                        $regNo =1;
                        $this->ProgramModleAdmin->InsertCounter($regNo,$setDate,$clsId);
                    }

                    $dataid = $setDate.$class.sprintf('%04d', $regNo);   
                        
               //     print_r( $dataid ); die();
                        
                    $this->StudentregistrationModleAdmin->addstufferInfo($data,$datacorse,$dataid);
                  
                }
                
                else {
                    $sdata['errormessage'] = 'No Class offered yet for this enrollment information!';
                    $this->session->set_userdata($sdata);
                    redirect(admin_Url()."/applicant/searchapplicant");
                }
                    }
               
                
                  
                 $sdata['message'] = 'Registration Complete Successfully!';
                $this->session->set_userdata($sdata);

               redirect(admin_Url() . "/applicant/applicantregistration", 'refresh');
            }
            else{
                 $sdata['errormessage'] = 'Registration not completed... Please try again';
                $this->session->set_userdata($sdata);

               redirect(admin_Url() . "/applicant/applicantregistration", 'refresh');
              }
              
            
            
      }  
    
    
        public function registrationConfirm() {

        if (isset($_POST['confirmReg'])) {


            $data = $this->input->post('data', TRUE);
            $datacls['programId'] = $data['programId'];
         // print_r($data); die();   
            $result = $this->StudentModleAdmin->getstudentsInfoArrayByApplicationId($data['applicationId']);
          
            if (!empty($result)) {

                $sdata['errormessage'] = 'This Applicant is already Registered!';
                $this->session->set_userdata($sdata);
                redirect(admin_Url() . "/applicant/searchapplicant");
            } else {

                $datas['programOfferId'] = getProgramOfferId($data);

                if (!empty($datas['programOfferId'])) {
                    $datas['courseassignlist'] = $this->CourseofferModleAdmin->CheckOfferedCourseAssign($datas['programOfferId']);

                    if (!empty($datas['courseassignlist'])) {
                        $data['programOfferId'] = $datas['programOfferId'];
                       $data_info=$this->InstituteModleAdmin->getInstituteInfo();
                       $cls = $this->ProgramModleAdmin->getClassId($data); 
                       
                       
                       
                       $setDate = date('Y');
              $clsId=$this->ProgramModleAdmin->getClassiiId($datacls);
             $class = sprintf('%02d', $clsId);
                       
                                $counter = $this->ProgramModleAdmin->GetLastStudentSerialNo($setDate,$clsId);
                    if($counter > 0)
                    {
                        $regNo = $counter +1;
                        $this->ProgramModleAdmin->UpdateCounter($regNo,$setDate,$clsId);
                    }
                    else
                    {
                        $regNo =1;
                        $this->ProgramModleAdmin->InsertCounter($regNo,$setDate,$clsId);
                    }

                    $dataid = $setDate.$class.sprintf('%04d', $regNo);   
                        
               //   print_r( $dataid ); die();
                        
                     $insert=$this->StudentregistrationModleAdmin->addstufferInfobyId($data,$dataid);
                  
                
                
                
                       
                     //   print_r($cls); die();
                      //  $insert=$this->StudentregistrationModleAdmin->insertregistrationconfirm($data,$data_info,$cls);
                        if(!empty($insert))
                        {
                         //   $insert=$this->StudentModleAdmin->deleteadmissionapplicant($data['applicationId']);
                            $datas['applicatntProgram'] = $this->StudentModleAdmin->getstudentInfoByApplicationId($data['applicationId']);

                            $sdata['message'] = 'Registration Complete Successfully!';
                            $this->session->set_userdata($sdata);

                            $data['registration'] = 'active';
                            $this->load->view('system_path/admin/common/header_link'); // header Css link
                            $this->load->view('system_path/admin/common/header'); // body header
                            $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                            $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                            $this->load->view('system_path/admin/courseoffer/courseassign', $datas); // ...........body content page...........
                            $this->load->view('system_path/admin/common/footer'); // footer & script link
                        }
                        else {
                                $sdata['errormessage'] = 'Registration not completed... Please try again!';
                                $this->session->set_userdata($sdata);
                                redirect(admin_Url()."/applicant/searchapplicant");
                            }
                    } else {
                        $sdata['errormessage'] = 'No Subject offered yet for this enrollment information!';
                        $this->session->set_userdata($sdata);
                        redirect(admin_Url()."/applicant/searchapplicant");
                    }
                } else {
                    $sdata['errormessage'] = 'No Class offered yet for this enrollment information!';
                    $this->session->set_userdata($sdata);
                    redirect(admin_Url()."/applicant/searchapplicant");
                }
            }
        } else {
           $sdata['errormessage'] = 'Registration not completed... Please try again';
           $this->session->set_userdata($sdata); 
           redirect(admin_Url()."/applicant/searchapplicant");
        }
    }
    
    
     public function Edit_RegistrationForm($applicantid) {
        $data['editData'] = $this->StudentModleAdmin->editapplicantInfo($applicantid);
     
        //     print_r($data); die();
        if (!empty($data['editData'])) {
             $data['registration'] = 'active';
            $this->load->view('system_path/admin/common/header_link'); // header Css link
            $this->load->view('system_path/admin/common/header'); // body header
            $this->load->view('system_path/admin/common/side_menu'); // side bar menu
            $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
            $this->load->view('system_path/admin/applicant/edit_registration_form'); // ...........body content page...........
            $this->load->view('system_path/admin/common/footer'); // footer & script link
        } else {
       //     echo "DIEEEE"; die();
             $sdata['errormessage'] = 'Invalid Applicantion Id...Please try again';
             $this->session->set_userdata($sdata);
           // $this->searchapplicant();
            redirect(admin_Url() . "/applicant/searchapplicant");
        }
    }
    
    public function updateapplicant($id) {
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
                    'field' => 'data[sbreg]',
                    'label' => 'Birth Registration Number',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'data[gender]',
                    'label' => 'Gender',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'data[fatherName]',
                    'label' => 'father\'s Name',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'data[motherName]',
                    'label' => 'Mother\'s Name',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'data[fatherPhone]',
                    'label' => 'father\'s Mobile Number',
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
                )
            );

            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() == FALSE) {
                redirect(admin_Url() . "/applicant/Edit_RegistrationForm/" . $id);
            } 
            else {
                $data = $this->input->post('data', TRUE);
             //   print_r($data); die();
                $datax = $this->input->post('datax', TRUE);

                $enrol = $this->ProgramModleAdmin->getValidateofferedprogram($datax);

                if (empty($enrol)) {
                    $sdata = array();
                    $sdata['message'] = 'Inserted Enrollment information is not offered yet !';
                    $this->session->set_userdata($sdata);
                    redirect(admin_Url() . "/applicant/Edit_RegistrationForm/" . $id);
                } else {

                    $yes_upload = $this->upload->do_upload('photo');
                    $img_data = $this->upload->data();

                    if (empty($img_data['file_name'])) {
                        // echo "asdf"; exit();
                        unset($img_data['file_name']);
                    } else {

                        $data['photo'] = "uploads/Students/" . $img_data['file_name'];
                    }

                    $programOfferId = $enrol['programOfferId'];
                    //     print_r($enrol['validate']);    print_r($id);                  print_r($datax); die();
                    $this->StudentModleAdmin->updateprogramOfferId($programOfferId, $id);
                    $upd=$this->StudentModleAdmin->updateapplicantInfo($data, $id);
                    if(!empty($upd)) 
                    {                        
                        $sdata['message'] = 'Updated Successfully !';
                        $this->session->set_userdata($sdata);

                        redirect(admin_Url() . "/applicant/searchapplicant");
                    }
                    else{
                        $sdata['errormessage'] = 'Applicant information not updated ';
                        $this->session->set_userdata($sdata);

                        redirect(admin_Url() . "/applicant/Edit_RegistrationForm/" . $id);
                    }
                }
            }
    }
    
// Delete registration form Data
      public function DeleteApplicant($id) {
        $delete=$this->StudentModleAdmin->deleteadmissionapplicant($id);
        if($delete)
        {
              $sdata['message'] = 'Applicant Information Successfully Deleted';
             $this->session->set_userdata($sdata);
           // $this->searchapplicant();
            redirect(admin_Url() . "/applicant/searchapplicant");

        }

       else {
       //     echo "DIEEEE"; die();
             $sdata['errormessage'] = 'Applicant Information not Deleted';
             $this->session->set_userdata($sdata);
           // $this->searchapplicant();
            redirect(admin_Url() . "/applicant/searchapplicant/");
        } 
       
       
    }
    
         public function updatestudent_photo() {
        
        if(isset($_POST['btnSubmit']))
       {
            $data_value['applicationId'] = $this->input->post('applicationId', TRUE);

            if(!empty($data_value['applicationId']))
            {
                $dlt_file=$this->input->post('photo', TRUE);
        
                if(file_exists($dlt_file))
                {
                  // unlink($dlt_file);
                    unlink($dlt_file);
                 }
               
               
                $config['upload_path'] = './uploads/Students/';
                $config['allowed_types'] = 'jpg|gif|JPEG|png';
                $config['max_size'] = '1000';
                $config['max_width'] = '1024';
                $config['max_height'] = '768';

                $this->upload->initialize($config);

                $yes_upload = $this->upload->do_upload('photo');
                if (!$yes_upload) {
                    $sdata['errormessage'] = 'Image upload failed...Please maintain image size';
                    $this->session->set_userdata($sdata);
                redirect(admin_Url() . "/student");
                 // $this->index();
                } else {
                    $img_data = $this->upload->data();
                    $data_value['photo'] = "uploads/Students/".$img_data['file_name'];
                    $insert = $this->StudentModleAdmin->updatestudentphoto($data_value);
                    
                    if (!empty($insert)) {
                        $sdata['message'] = 'Image Updated';
                        $this->session->set_userdata($sdata);
                                redirect(admin_Url() . "/applicant/searchapplicant/");
                    } else {
                        $sdata['errormessage'] = 'Image Upload failed';
                        $this->session->set_userdata($sdata);
                        $this->index();
                    }
                }
            }
           
       }
       else{
              redirect(admin_Url() . "/student/editstudent");
       }
    }
    
    
    public function viewappliantInfo($id) {
        $id=(int)$id;
        $data['editData'] = $this->StudentModleAdmin->viewapplicantInfo($id);
        $data['prevaccInfo'] = $this->StudentModleAdmin->prevaccinfo($id);
       // print_r($data['prevaccInfo']); die();
        //  print_r($data);die();
        if (!empty($data['editData'])) {
            $data['student'] = 'active';
            $this->load->view('system_path/admin/common/header_link'); // header Css link
            $this->load->view('system_path/admin/common/header'); // body header
            $this->load->view('system_path/admin/common/side_menu'); // side bar menu
            $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
            $this->load->view('system_path/admin/applicant/applicantprofile', $data); // ...........body content page...........
            $this->load->view('system_path/admin/common/footer'); // footer & script link
        } else {

            echo 'Student Id is Invailed';
        }
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    

    public function insertAdmissiontest($id) {
//          print_r($_POST);
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
            array(
                'field' => 'data[bng]',
                'label' => 'Bangla',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[eng]',
                'label' => ' English',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[math]',
                'label' => 'Math',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[gk]',
                'label' => ' General Knowledge',
                'rules' => 'required'
            )
//            array(
//                'filed' => 'data[studetnId]',
//                'label' => 'Student ID',
//                'rules' => 'exist[]'
//            )
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
//                     
            $this->load->view('templates/admin/common/header');
            $data['id'] = (int) $id;
            $this->load->view('templates/admin/admissiontest/index', $data);
            $this->load->view('templates/admin/common/footer');
        } else {


            $data = $this->input->post('data', TRUE);
//            print_r($data); exit;
            $data['studetnId'] = (int) $id;
            $this->AdmissiontestModleAdmin->addAdmissiontestInfo($data, $id);
            redirect('admin/admissiontest/viewadmissionnresult');
        }
    }

    public function viewadmissionnresult() {


        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/admissiontest/viewadmissionntestresult');
        $this->load->view('templates/admin/common/footer');
    }

    public function searchstudentinfo() {


        $data = $this->input->post('data', TRUE);

        if (empty($data['campusId']) || empty($data['classId']) || empty($data['mediumId']) || empty($data['shiftId']) || empty($data['groupId']) || empty($data['sectionId']) || empty($data['sessionId']) || empty($data['marks'])) {
            $sdata = array();
            $sdata['message'] = "Select All Searching Information Value";
            $this->session->set_userdata($sdata);
            redirect('admin/admissiontest/viewadmissionnresult');
        } else {


            $data['allresult'] = $this->AdmissiontestModleAdmin->getApplicantsearchbySession($data);
            $data['applicantresult'] = $this->AdmissiontestModleAdmin->getResultByMarks($data);
            //  print_r($data); die();
            if ($data['applicantresult'] && $data['allresult']) {
                $this->load->view('templates/admin/common/header');
                $this->load->view('templates/admin/admissiontest/viewadmissionntestresult', $data);
                $this->load->view('templates/admin/common/footer');
            } else {
                $sdata = array();
                $sdata['message'] = "No Applicant find of your searching range";
                $this->session->set_userdata($sdata);
                $this->load->view('templates/admin/common/header');
                $this->load->view('templates/admin/admissiontest/viewadmissionntestresult');
                $this->load->view('templates/admin/common/footer');
            }
        }
    }

    public function admissionstatus() {


        if (!empty($_POST['applicationId'])) {

            $applicationId = $this->input->post('applicationId', TRUE);
            $status = $this->input->post('status', TRUE);

            if ($status == "select") {
                $sdata = array();
                $sdata['message'] = "Select Status";
                $this->session->set_userdata($sdata);
                redirect('admin/admissiontest/viewadmissionnresult');
            } else {
                $count = count($this->input->post('applicationId', TRUE));


                for ($i = 0; $i < $count; $i++) {


                    $data = array(
                        'applicationId' => $applicationId[$i],
                        'status' => $status
                    );

                    $data['marks'] = getTotalMarks($data['applicationId']);

                    $this->AdmissiontestModleAdmin->insertadmissionapplicantstatus($data);
                }

                $sdata['message'] = 'Applicant Status Update Successfull ';
                $this->session->set_userdata($sdata);

                redirect('admin/admissiontest/viewadmissionnresult');
            }
        } else {
            $sdata['message'] = 'Select Applicant';
            $this->session->set_userdata($sdata);

            redirect('admin/admissiontest/viewadmissionnresult');
        }
    }

    public function admissionmeritlist() {

        $this->load->view('templates/admin/common/header');

        $this->load->view('templates/admin/admissiontest/admissionallowlist');
        $this->load->view('templates/admin/common/footer');
    }

    public function admissionallowlist() {


        $data = $this->input->post('data', TRUE);
        //    print_r($data); die();
        $data['applicantmeritstatus'] = $this->AdmissiontestModleAdmin->getApplicantMeritstatus();
        $data['allresult'] = $this->AdmissiontestModleAdmin->getApplicantbySession($data);


        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/admissiontest/admissionallowlist', $data);
        $this->load->view('templates/admin/common/footer');
    }

    public function admissionpromotedapplicant() {


        if (!empty($_POST['applicationId'])) {

            $applicationId = $this->input->post('applicationId', TRUE);

            $count = count($this->input->post('applicationId', TRUE));

            for ($i = 0; $i < $count; $i++) {

                $data = array(
                    'applicationId' => $applicationId[$i]
                );

                $data['marks'] = getTotalMarks($data['applicationId']);
                $datas = $this->StudentModleAdmin->viewapplicantInfo($data['applicationId']);

                $data['campusId'] = $datas['campusId'];
                $data['classId'] = $datas['classId'];
                $data['mediumId'] = $datas['mediumId'];
                $data['groupId'] = $datas['groupId'];
                $data['shiftId'] = $datas['shiftId'];
                $data['sectionId'] = $datas['sectionId'];
                $data['sessionId'] = $datas['sessionId'];
                //        print_r($data);   
                $result = $this->AdmissiontestModleAdmin->checkDuplicatePromotedapplicant($data);
                //      print_r($result); die();
                if ($result) {
                    $sdata['message'] = 'This Applicant is already Promoted!';
                    $this->session->set_userdata($sdata);
                    redirect(base_url('admin/admissiontest/admissionmeritlist'));
                } else {
                    $this->AdmissiontestModleAdmin->insertAdmissionPromotedApplicant($data);
                }
            }


            $sdata['message'] = 'Allowed Applicant Successfully Promoted for Registration ';
            $this->session->set_userdata($sdata);

            redirect('admin/admissiontest/admissionmeritlist');
        }
    }

    public function admissionwaitinglist() {

        $this->load->view('templates/admin/common/header');

        $this->load->view('templates/admin/admissiontest/admissionwaitinglist');
        $this->load->view('templates/admin/common/footer');
    }

    public function waitinglist() {


        $data = $this->input->post('data', TRUE);
        //    print_r($data); die();
        $data['allresult'] = $this->AdmissiontestModleAdmin->getApplicantbySession($data);

        $data['applicantmeritstatus'] = $this->AdmissiontestModleAdmin->getApplicantMeritstatus();
        // print_r($data);exit;
        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/admissiontest/admissionwaitinglist', $data);
        $this->load->view('templates/admin/common/footer');
    }

    public function admissiondisallowlist() {

        $this->load->view('templates/admin/common/header');

        $this->load->view('templates/admin/admissiontest/admissiondisallowlist');
        $this->load->view('templates/admin/common/footer');
    }

    public function disallowlist() {


        $data = $this->input->post('data', TRUE);
        //    print_r($data); die();
        $data['allresult'] = $this->AdmissiontestModleAdmin->getApplicantbySession($data);

        $data['applicantmeritstatus'] = $this->AdmissiontestModleAdmin->getApplicantMeritstatus();
        // print_r($data);exit;
        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/admissiontest/admissiondisallowlist', $data);
        $this->load->view('templates/admin/common/footer');
    }

    public function reqforapprove($studentId) {

        $studentId = (int) $studentId;
        $reqdata = 1;
        $this->AdmissiontestModleAdmin->req_forapprove($reqdata, $studentId);
        $this->viewadmissionnresult();
    }

    public function reqfordisapprove($studentId) {

        $studentId = (int) $studentId;
        $reqdata = 0;
        $this->AdmissiontestModleAdmin->req_fordisapprove($reqdata, $studentId);
        $this->viewadmissionnresult();
    }

    public function waintingList($studentId) {

        $studentId = (int) $studentId;
        $reqdata = 2;
        $this->AdmissiontestModleAdmin->waintingListstatus($reqdata, $studentId);
        $this->viewadmissionnresult();
    }

    public function editadminresult($id) {

        $this->load->view('templates/admin/common/header');
        $data['editData'] = $this->AdmissiontestModleAdmin->editadmissionlInfo($id);

        $data['studetnId'] = (int) $id;

        $this->load->view('templates/admin/admissiontest/editadminresult', $data);
        $this->load->view('templates/admin/common/footer');
    }

    public function updateadmissiontest($id) {
//        print_r($_POST); 
        $id = (int) $id;
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
            array(
                'field' => 'data[bng]',
                'label' => 'Bangla',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[eng]',
                'label' => ' English',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[math]',
                'label' => 'Math',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[gk]',
                'label' => ' General Knowledge',
                'rules' => 'required'
            ),
//            array(
//                'filed' => 'data[studetnId]',
//                'label' => 'Student ID',
//                'rules' => 'exist[]'
//            )
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
//                     
            $this->load->view('templates/admin/common/header');
            $data['id'] = (int) $id;
            $this->load->view('templates/admin/admissiontest/index', $data);
            $this->load->view('templates/admin/common/footer');
        } else {


            $data = $this->input->post('data', TRUE);
//            print_r($data); exit;
            $data['studetnId'] = (int) $id;
            $this->AdmissiontestModleAdmin->updateadmissionlInfo($data, $id);
//			$this->load->view('formsuccess');
            redirect('admin/admissiontest/viewadmissionnresult');
        }
    }

    public function studentawaitinglist() {

        $waitinglist = $this->AdmissiontestModleAdmin->studentawaitinglist();
        ?>

        <table style="width: 50%; border: 1px solid #ccc;">
            <tr>
                <th style="border: 1px solid #ccc;">Registration ID</th>
                <th style="border: 1px solid #ccc;">Name of the Student</th>

                <th style="border: 1px solid #ccc;">Status</th>
            </tr>
        <?php foreach ($waitinglist as $allowlists) { ?>
                <tr>
                    <td style="border: 1px solid #ccc;"><?php echo $allowlists['studetnId']; ?></td>
                    <td style="border: 1px solid #ccc;">
            <?php
            foreach (getstudentsName($allowlists['studetnId']) as $aspppps) {
                echo $aspppps['firstName'] . " " . $aspppps['lastName'];
            }
            ?>
                        </a>
                    </td>
                    <td style="border: 1px solid #ccc;"><?php echo ($allowlists['allowlist'] == 2) ? "Promotted" : "Not Promotted"; ?></td>
                </tr> <?php } ?>
        </table>

                    <?php
//        print print_r($waitinglist);
                }

            }

            