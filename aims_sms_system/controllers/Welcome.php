<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Welcome extends CI_Controller {

    /*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
    
    public function __construct() {
        parent::__construct();

        $this->load->model('content_model', 'co_model', TRUE);
        $this->load->model('admin/student/StudentModleAdmin', 'StudentModleAdmin');
        $this->load->model('admin/employee/EmployeeModleAdmin', 'EmployeeModleAdmin');
        $this->load->model('admin/program/ProgramModleAdmin', 'ProgramModleAdmin');
        $this->load->model('admin/classroutine/ClassroutineModleAdmin', 'ClassroutineModleAdmin');
        
        $this->load->helper('text');
        $this->load->library('email');
        $this->load->helper("url");
    }

    public function index() {
       $msg['category']=3;
        $data['rowdata'] = $this->co_model->select_aboutInfoByCategory($msg); // headmaster message
        
         $pmsg['category']=10;
        $data['president'] = $this->co_model->pselect_aboutInfoByCategory($pmsg); // headmaster message
        
        //$data['title'] = "AIMS";
        //$data['maritphotodata'] = $this->co_model->select_meritlist();
        
        $histry['category']=6;
        $data['historydata'] = $this->co_model->select_aboutInfoByCategory($histry); // Institute History message
        
        $hdata['category'] = 2;
        $data['hrowdata'] = $this->co_model->select_abouthInfoByCategory($hdata); // Institute Building message
      
        $rulesdata['category'] = 8;
        $data['rulesrowdata'] = $this->co_model->rulesselect_abouthInfoByCategory($rulesdata);
        
        $missiondata['category'] = 5;
        $data['missionrowdata'] = $this->co_model->missionselect_abouthInfoByCategory($missiondata);
        
         $upnotice="14";
        $data['getupnoticedata'] = $this->co_model->select_UpcomingNoticedata($upnotice);
        
        $photogaldata['category'] = 2;    
        $data['getphotodata'] = $this->co_model->select_gallery_photo($photogaldata);
       // print_r($data['historydata']); die();
        $data['title'] = "AIMS";
 
        $data['sliderphoto'] = $this->co_model->select_sliderphoto();
        $data['getdata'] = $this->co_model->select_NoticeBoard();
        $data['main_content'] = $this->load->view('home_2015/home_content', $data, TRUE);
        $this->load->view('home_2015/home', $data);
    }

    public function OnlineAdmission() {
        $data['title'] = "AIMS Academic System";
        $data['main_content'] = $this->load->view('home_2015/admissionform', $data, TRUE);
        $this->load->view('home_2015/home', $data);
    }

    //=========== Another Design Page of Aims System===================   

    public function AboutUs() {
        $data['category'] = 1;
        $data['title'] = "AIMS";
        $data['rowdata'] = $this->co_model->select_aboutInfoByCategory($data);
        $data['main_content'] = $this->load->view('home_2015/aboutinfo', $data, TRUE);
        $this->load->view('home_2015/home', $data);
    }
    public function BuildingInfo() {
        $data['category'] = 2;

        $data['title'] = "AIMS";
        $data['rowdata'] = $this->co_model->select_aboutInfoByCategory($data);
        $data['main_content'] = $this->load->view('home_2015/aboutinfo', $data, TRUE);
        $this->load->view('home_2015/home', $data);
    }
    
    public function PrincipalMessage() {
        $data['category'] = 3;

        $data['title'] = "AIMS";
        $data['rowdata'] = $this->co_model->select_aboutInfoByCategory($data);
        $data['main_content'] = $this->load->view('home_2015/aboutinfo', $data, TRUE);
        $this->load->view('home_2015/home', $data);
    }
    public function LandInfo() {
        $data['category'] = 4;

        $data['title'] = "AIMS";
        $data['rowdata'] = $this->co_model->select_aboutInfoByCategory($data);
        $data['main_content'] = $this->load->view('home_2015/aboutinfo', $data, TRUE);
        $this->load->view('home_2015/home', $data);
    }
    
    public function OurMission() {
        $data['category'] = 5;

        $data['title'] = "AIMS";
        $data['rowdata'] = $this->co_model->select_aboutInfoByCategory($data);
        $data['main_content'] = $this->load->view('home_2015/aboutinfo', $data, TRUE);
        $this->load->view('home_2015/home', $data);
    }
    public function SchoolHistory() {
        $data['category'] = 6;

        $data['title'] = "AIMS";
        $data['rowdata'] = $this->co_model->select_aboutInfoByCategory($data);
        $data['main_content'] = $this->load->view('home_2015/aboutinfo', $data, TRUE);
        $this->load->view('home_2015/home', $data);
    }
    
    
    public function RoomInfo() {
        $data['category'] = 7;

        $data['title'] = "AIMS";
        $data['rowdata'] = $this->co_model->select_aboutInfoByCategory($data);
        $data['main_content'] = $this->load->view('home_2015/aboutinfo', $data, TRUE);
        $this->load->view('home_2015/home', $data);
    }
    public function RulesRegulation() {
        $data['category'] = 8;

        $data['title'] = "AIMS";
        $data['rowdata'] = $this->co_model->select_aboutInfoByCategory($data);
        $data['main_content'] = $this->load->view('home_2015/aboutinfo', $data, TRUE);
        $this->load->view('home_2015/home', $data);
    }
    public function PostInfo() {
        $data['category'] = 9;

        $data['title'] = "AIMS";
        $data['rowdata'] = $this->co_model->select_aboutInfoByCategory($data);
        $data['main_content'] = $this->load->view('home_2015/aboutinfo', $data, TRUE);
        $this->load->view('home_2015/home', $data);
    }

    public function AcademicCurriculum() {
        $data['category'] = 1;
        
        $data['title'] = "AIMS";
        $data['rowdata'] = $this->co_model->selectArray_AcademicInfoByCategory($data);
        $data['main_content'] = $this->load->view('home_2015/academicarea', $data, TRUE);
        $this->load->view('home_2015/home', $data);
    }
     public function ourachievements() {
        $data['category'] = 2;

        $data['title'] = "AIMS";
        $data['rowdata'] = $this->co_model->selectArray_AcademicInfoByCategory($data);
        $data['main_content'] = $this->load->view('home_2015/academicarea', $data, TRUE);
        $this->load->view('home_2015/home', $data);
    }
    public function awarnessprograms() {
        $data['category'] = 3;

        $data['title'] = "AIMS";
        $data['rowdata'] = $this->co_model->selectArray_AcademicInfoByCategory($data);
        $data['main_content'] = $this->load->view('home_2015/academicarea', $data, TRUE);
        $this->load->view('home_2015/home', $data);
    }
    public function CoCurriculum() {
        $data['category'] = 4;

        $data['title'] = "AIMS";
        $data['rowdata'] = $this->co_model->selectArray_AcademicInfoByCategory($data);
        $data['main_content'] = $this->load->view('home_2015/academicarea', $data, TRUE);
        $this->load->view('home_2015/home', $data);
    }
    public function functions() {
        $data['category'] = 5;

        $data['title'] = "AIMS";
        $data['rowdata'] = $this->co_model->selectArray_AcademicInfoByCategory($data);
        $data['main_content'] = $this->load->view('home_2015/academicarea', $data, TRUE);
        $this->load->view('home_2015/home', $data);
    }
     public function HowtoApply() {
        $data['category'] = 6;

        $data['title'] = "AIMS";
        $data['rowdata'] = $this->co_model->select_AcademicInfoByCategory($data);
        $data['main_content'] = $this->load->view('home_2015/curriculum', $data, TRUE);
        $this->load->view('home_2015/home', $data);
    }

    public function NoticeBoard() {
        $data['category'] = 7;

        $data['title'] = "AIMS";
        $data['rowdata'] = $this->co_model->selectArray_AcademicInfoByCategory($data);
        $data['main_content'] = $this->load->view('home_2015/academicarea', $data, TRUE);
        $this->load->view('home_2015/home', $data);
    }
    
    public function ViewAcademicInformation($id) {
        $data['title'] = "AIMS";
        $data['getdata'] = $this->co_model->select_academicInfo_by_id($id);        
        $data['main_content'] = $this->load->view('home_2015/noticedetails', $data, TRUE);
        $this->load->view('home_2015/home', $data);
    }
    
    public function Digiclass() {
        $data['category'] = 13;

        $data['title'] = "AIMS";
        $data['rowdata'] = $this->co_model->selectArray_AcademicInfoByCategory($data);
        $data['main_content'] = $this->load->view('home_2015/academicarea', $data, TRUE);
        $this->load->view('home_2015/home', $data);
    }
    
    public function Transport() {
        $data['category'] =11;

        $data['title'] = "AIMS";
        $data['rowdata'] = $this->co_model->select_AcademicInfoByCategory($data);
        $data['main_content'] = $this->load->view('home_2015/curriculum', $data, TRUE);
        $this->load->view('home_2015/home', $data);
    }
    
    public function Library() {
        $data['category'] =8;

        $data['title'] = "AIMS";
        $data['rowdata'] = $this->co_model->select_AcademicInfoByCategory($data);
        $data['main_content'] = $this->load->view('home_2015/curriculum', $data, TRUE);
        $this->load->view('home_2015/home', $data);
    }
    
    public function Science_Labs() {
        $data['category'] =9;

        $data['title'] = "AIMS";
        $data['rowdata'] = $this->co_model->select_AcademicInfoByCategory($data);
        $data['main_content'] = $this->load->view('home_2015/curriculum', $data, TRUE);
        $this->load->view('home_2015/home', $data);
    }
    
    public function IT_Labs() {
        $data['category'] =10;

        $data['title'] = "AIMS";
        $data['rowdata'] = $this->co_model->select_AcademicInfoByCategory($data);
        $data['main_content'] = $this->load->view('home_2015/curriculum', $data, TRUE);
        $this->load->view('home_2015/home', $data);
    }
    
    public function Cafeteria() {
        $data['category'] =12;

        $data['title'] = "AIMS";
        $data['rowdata'] = $this->co_model->select_AcademicInfoByCategory($data);
        $data['main_content'] = $this->load->view('home_2015/curriculum', $data, TRUE);
        $this->load->view('home_2015/home', $data);
    }

    
    public function BoardMember() {
        $data['bm_cat']=1;
        $data['title'] = "AIMS";
        $data['getdata'] = $this->co_model->select_allmemberlistBYCategory($data);        

        $data['main_content'] = $this->load->view('home_2015/management', $data, TRUE);
        $this->load->view('home_2015/home', $data);
    }
    
    public function ThirdgradeStaff() {
        $data['bm_cat']=2;
        $data['title'] = "AIMS";
        $data['getdata'] = $this->co_model->select_allmemberlistBYCategory($data);        
       
        $data['main_content'] = $this->load->view('home_2015/management', $data, TRUE);
        $this->load->view('home_2015/home', $data);
    }
    public function FourthgradeStaff() {
        $data['bm_cat']=3;
        $data['title'] = "AIMS";
        $data['getdata'] = $this->co_model->select_allmemberlistBYCategory($data);    
        $data['main_content'] = $this->load->view('home_2015/management', $data, TRUE);
        $this->load->view('home_2015/home', $data);
    }
    public function ViewBoardMember($id) {
        $data['title'] = "AIMS";
        $data['getdata'] = $this->co_model->select_memberinfo_by_id($id);
        $data['main_content'] = $this->load->view('home_2015/managementinfo', $data, TRUE);
        $this->load->view('home_2015/home', $data);
    }
    
    public function FacultyMember() {
        $data = array();
       
        $data['title'] = "AIMS";
        $data['getdata'] = $this->EmployeeModleAdmin->getEmployeeInfo();
        $data['main_content'] = $this->load->view('home_2015/faculty', $data, TRUE);
        $this->load->view('home_2015/home', $data);
    }

    public function ViewFacultyMember($id) {
        
        $data['title'] = "AIMS";
        $data['getdata'] = $this->EmployeeModleAdmin->viewemployeeinfo($id);
        if(!empty($data['getdata']))
        {
            $data['main_content'] = $this->load->view('home_2015/facultyinfo', $data, TRUE);
            $this->load->view('home_2015/home', $data);
        }
        else{
            $this->FacultyMember();
        }
        
    }
    
    public function Meritious_Student() {
        $data = array();

        $data['title'] = "AIMS";
        $data['getdata'] = $this->co_model->select_meritlist();
        $data['main_content'] = $this->load->view('home_2015/meritiousstudent', $data, TRUE);
        $this->load->view('home_2015/home', $data);
    }
    
    public function ResultList($rs) {
        $data['title'] = "AIMS";
        $data['rsid'] = $rs;
        $data['getdata'] = $this->co_model->select_allresultlist();
        $data['main_content'] = $this->load->view('home_2015/result', $data, TRUE);
        $this->load->view('home_2015/home', $data);
    }
    

    
    public function ImageGallery($rs) {
        $data['title'] = "AIMS";
        $data['rsid'] = $rs;
        $data['getdata'] = $this->co_model->select_limited_photo();
        $data['main_content'] = $this->load->view('home_2015/galleryBox', $data, TRUE);
        $this->load->view('home_2015/home', $data);
    }
    
    public function ClassRoutine() {
        $data['title'] = "AIMS";
        $data['getdata'] = $this->ClassroutineModleAdmin->getClassroutineList();
        $data['main_content'] = $this->load->view('home_2015/classroutinelist', $data, TRUE);
        $this->load->view('home_2015/home', $data);       
        
    }
    
    public function showclassroutine() {

            $data = $this->input->post('data', TRUE); 
        
        if(isset($_POST['showroutine'])){
        
            $data['classroutine']= $this->ClassroutineModleAdmin->select_new_routine($data);
            if(!empty($data['classroutine']))
            {
                $data['main_content'] = $this->load->view('home_2015/viewroutine', $data, TRUE);
                $this->load->view('home_2015/home', $data);                
            }
            else{            
                $sdata = array();
                $sdata['redmessage'] = "No Classroutine Found";
                $this->session->set_userdata($sdata);
                redirect(base_url('welcome/ClassRoutine','refresh'));
            }
        }
        else{            
            redirect(base_url('welcome/ClassRoutine','refresh'));
        }
        
        
    }

    public function Contact() {
        $data['title'] = "AIMS";
        $data['getdata'] = $this->co_model->select_contact_details();
        $data['main_content'] = $this->load->view('home_2015/contact', $data, TRUE);
        $this->load->view('home_2015/home', $data);
    }
    public function sendEmail()
    {
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
                
        if ($this->form_validation->run() == FALSE)
        {
            $errormessage['errormessage'] = "Please fill up all field with valid information"; 
             $this->session->set_userdata($errormessage); 
            $this->index();
        }
        else
        {

            $school_email="imran.molla@gmail.com";
        
            $sender_name = $this->input->post('sender_name', TRUE);
            $sender_email = $this->input->post('sender_email', TRUE);
            $sender_phone = $this->input->post('sender_phone', TRUE);
            $sender_message = $this->input->post('sender_message', TRUE);
            
            $email_text['mesg']="Guest Name: ".$sender_name."\r\n\r\nMobile Number: ".$sender_phone."\r\n\r\nEmail: ".$sender_email."\r\n\r\nGuest Message: ".$sender_message."\r\r\r\n\n\n.................................................\n\nNOTE: Please do not reply in this email. Please reply Guest email address.\r\r\r\n Thank You\r\r\nAIMS-Institute Management System";
           
            $this->email->from('noreply.aimssystem@gmail.com'); // change it to yours
            $this->email->to($school_email);// change it to yours
            $this->email->subject('Message From School Website');
            $this->email->message($email_text['mesg']);
             if($this->email->send())
            {
               $message['message'] ="Message Successfully Send"; 
               $this->session->set_userdata($message); 
               redirect(base_url('welcome/Contact','refresh'));
            }
            else{
            
               $errormessage['errormessage'] = "Sorry Message Not Sent... Try Again"; 
               $this->session->set_userdata($errormessage); 
               redirect(base_url('welcome/Contact','refresh'));
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
                'field' => 'data[motherPhone]',
                'label' => 'Mother\'s Mobile Number',
                'rules' => 'required'
            ),
           
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
            )
        );
        
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = "AIMS Academic System";
            $sdata = array();
            $sdata['redmessage'] = 'Required field missing..please fill up all red star marked field!';
            $this->session->set_userdata($sdata);
            $data['main_content'] = $this->load->view('home_2015/admissionform', $data, TRUE);
             $this->load->view('home_2015/default', $data);
        } 
        else {
            $data = $this->input->post('data', TRUE);
            $datax = $this->input->post('datax', TRUE);
            $enrol = $this->ProgramModleAdmin->getValidateofferedprogram($datax);
            if (!empty($enrol)) {
                if (!empty($data) && !empty($enrol)) {
                    $configx['upload_path'] = './uploads/Students/';
                    $configx['allowed_types'] = 'gif|jpg|png|JPEG|JPG';
                    $configx['max_size'] = '200';
                    $configx['max_width'] = '200';
                    $configx['max_height'] = '200';
                    
                    $this->upload->initialize($configx);
                    $yes_upload = $this->upload->do_upload('userfile');
                    
                    if (!$yes_upload) {
                      
                        $sdata = array();
                        $sdata['redmessage'] = 'Image is not upload..Maintain Image Size !';
                        $this->session->set_userdata($sdata);

                        $data['title'] = "AIMS Academic System";
                        $data['main_content'] = $this->load->view('home_2015/admissionform', $data, TRUE);
                         $this->load->view('home_2015/default', $data);
                    } else {
                        $new_stt = sprintf('%02d', $datax['programId']);
                        $datae = date('Y');
                        $data['applicationId'] = $datae . "" . strval($new_stt) . "" . counter();

                        $check = $this->StudentModleAdmin->editapplicantInfo($data['applicationId']);
                  
                    if ($check) {
                        $sdata = array();
                        $sdata['redmessage'] = 'System Found some problem with new applicationId...Please create again !!';
                        $this->session->set_userdata($sdata);
                        $data['title'] = "AIMS Academic System";
                        $data['main_content'] = $this->load->view('home_2015/admissionform', $data, TRUE);
                         $this->load->view('home_2015/default', $data);
                    } else {
                        $img_data = $this->upload->data();
                        $data['photo'] = "uploads/Students/" . $img_data['file_name'];
                        $this->StudentModleAdmin->addStudentInfo($data, $enrol);
                        $id = $this->db->insert_id();

                        $applicantId = getApplicantInfoById($id);

                        $asdfsafsdafdsafdf = $applicantId['applicationId'];
                        //   print_r($asdfsafsdafdsafdf);die();
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

                        $pdf->AddPage('P', 'A6');


                       $valuess=getInstituteInfo();

                            $images = base_url() . "/" . $data['photo'];



                            $tbl = "

                   <table style=\"text-align:left; font-size:14px;  top:100px; \">

                       <tr>
                          <td> </td>
                       </tr>
                       <tr>
                          <td> </td>
                       </tr>
                       <tr>
                          <td> </td>
                       </tr>

                        <tr>
                           <td style=\"text-align:center; font-family:Times; color: green; font-size:18px bold;\"> " . $valuess['instituteName'] . " </td>
                       </tr>
                       <tr>
                           <td style=\"text-align:center; font-family:Times; color: black;\"> " . $valuess['town'] . ", " . $valuess['city'] . " </td>
                       </tr>
                       
                       <tr>
                          <td> </td>
                       </tr>
                       

                       <tr>
                          <td style=\"text-align:center; color: red; font-family:Times; \">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Online Addmission Confirmation</td>
                       </tr>
                        <tr>
                          <td></td>
                       </tr>
                       <tr>
                          <td> </td>
                       </tr>
                       

                       <tr>
                          <td style=\"font-family:Times; \">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ID : " . $asdfsafsdafdsafdf . "</td>
                       </tr>
                       <tr>
                          <td style=\"font-family:Times; font-weight: bold;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Name : " . $data['firstName'] . " </td>
                       </tr>
                       <tr>
                          <td> </td>
                       </tr>
                      
                           <tr>
                          <td style=\"font-family:Times; font-weight:normal \">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Class : " . getProgramName($datax['programId']) . "</td>
                       </tr>
                          <tr>
                          <td style=\"font-family:Times; font-weight:normal \">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Group : " . getGroupName($datax['groupId']) . "</td>
                       </tr>

                       <tr>

                          <td style=\"font-family:Times; font-weight:normal\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Shift : " . getshiftName($datax['shiftId']) . "</td>
                       </tr>
                       
                       <tr>

                          <td style=\"font-family:Times; font-weight:normal\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Session : " . getSessionName($datax['sessionId']) . "</td>
                       </tr>
                        <tr>
                          <td> </td>
                       </tr>
                       <tr>
                           <td style=\"text-align:center; color: white; \">>
                               " . $pdf->Image($images, 60, 45, 32, 30) . "
                           </td>
                       </tr>
                       <tr>
                          <td> </td>
                       </tr>
                       <tr>
                          <td> </td>
                       </tr>
                       <tr>
                          <td> </td>
                       </tr>
                       <tr>
                          <td> </td>
                       </tr>

                        <tr>
                           <td style=\"text-align:center; font-family:Times; color: green; font-size:12px;\"> All Rights Reserved By " . $valuess['instituteName'] . " </td>
                       </tr>
                       
                       <tr>
                           <td style=\"text-align:center; font-family:Times;font-size:11px;\"> System Demonstration By adventure-Soft </td>
                       </tr>

                   </table> ";

                            $pdf->writeHTML($tbl, true, false, false, false);
                        

                        $pdf->Output('pdf');
                    }
                }
                } else {
                    $sdata = array();
                    $sdata['redmessage'] = 'look like Some value missing here';
                    $this->session->set_userdata($sdata);
                    $data['main_content'] = $this->load->view('home_2015/admissionform', $sdata, TRUE);
                    $this->load->view('home_2015/home', $data);
                }
            } else {
                $sdata = array();
                $sdata['redmessage'] = 'Inserted Enrolment Information is not offered yet';
                $this->session->set_userdata($sdata);
                $data['main_content'] = $this->load->view('home_2015/admissionform', $sdata, TRUE);
                $this->load->view('home_2015/home', $data);
            }
        }
    }
    
    
     public function Career() {
        
        $data['title'] = "AIMS";
        $data['rowdata'] = $this->co_model->select_publishedJobInfo();
        $data['main_content'] = $this->load->view('home_2015/career', $data, TRUE);
        $this->load->view('home_2015/home', $data);
    }
    
    public function ViewCareerInfo($id) {
        $data['title'] = "AIMS";
        $data['getdata'] = $this->co_model->select_JobInfo_by_id($id);
        if(!empty($data['getdata']))
        {
            $data['main_content'] = $this->load->view('home_2015/careerinfo', $data, TRUE);
            $this->load->view('home_2015/home', $data);
        }
        else{
            redirect(base_url().'welcome/career');
        }
    }
    
    public function getRequirements($file) {
	        $this->load->helper('download');
	        $data = file_get_contents(base_url().'uploads/file/'.$file); // Read the file's contents
	        $name = $file;
	  
	        force_download($name, $data);

    	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */