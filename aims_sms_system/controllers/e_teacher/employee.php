<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */

class Employee extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->teacher_logged_auth();
        $this->load->model('admin/employee/EmployeeModleAdmin', 'EmployeeModleAdmin');
    }

    public function index() {
        $data['employee'] = 'active';
       // $data['institute'] = 'active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/employee/index'); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
    }

    public function insertemployee() {
    //  echo $_POST['userfile']; exit;
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
            array(
                'field' => 'data[firstName]',
                'label' => 'First Name',
                'rules' => 'required|xss_clean'
            ),
            array(
                'field' => 'data[lastName]',
                'label' => 'Last Name',
                'rules' => 'required|xss_clean'
            ),
            array(
                'field' => 'data[phone]',
                'label' => 'Phone',
                'rules' => 'required|xss_clean|max_length[11]|min_length[0]'
            ),
             array(
                'field' => 'data[dateOfBirth]',
                'label' => 'Birth Date',
                'rules' => 'required|xss_clean'
            ),
             array(
                'field' => 'data[embreg]',
                'label' => 'Birth Registration Number',
                'rules' => 'required|xss_clean'
            ),
            array(
                'field' => 'data[joiningdate]',
                'label' => 'Joining Date',
                'rules' => 'required|xss_clean'
            ),
            array(
                'field' => 'data[departmentId]',
                'label' => 'Department',
                'rules' => 'required|xss_clean'
            )
            
        );

        $config['upload_path'] = './uploads/Employee/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '100';
        $config['max_width'] = '250';
        $config['max_height'] = '250';

        $this->upload->initialize($config);

        $yes_upload = $this->upload->do_upload('photo');

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            $data['employee'] = 'active';
            // $data['institute'] = 'active';
             $this->load->view('system_path/admin/common/header_link'); // header Css link
             $this->load->view('system_path/admin/common/header'); // body header
             $this->load->view('system_path/admin/common/side_menu'); // side bar menu
             $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
             $this->load->view('system_path/admin/employee/index'); // ...........body content page...........
             $this->load->view('system_path/admin/common/footer'); // footer & script link
            
        } elseif (!$yes_upload) {
         //   $error = array('error' => $this->upload->display_errors());
        //    print_r($error);die();
            $data['employee'] = 'active';
            $sdata['errormessage'] = 'Image not upload';
            $this->session->set_userdata($sdata);
            
             $this->load->view('system_path/admin/common/header_link'); // header Css link
             $this->load->view('system_path/admin/common/header'); // body header
             $this->load->view('system_path/admin/common/side_menu'); // side bar menu
             $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
             $this->load->view('system_path/admin/employee/index'); // ...........body content page...........
             $this->load->view('system_path/admin/common/footer'); // footer & script link
            
        } else { 
            
            $data = $this->input->post('data', TRUE);
           $data_acx = $this->input->post('data_acx', TRUE);
             
            $data['degree'] = ',' . implode(',', $data['degree']) . ',';
   
            $img_data =  $this->upload->data();
               
            $data['photo'] = $img_data['file_name'];
         
            $this->EmployeeModleAdmin->addEmployeeInfo($data,$data_acx);
            $id=$this->db->insert_id();
            
            if(!empty($id) || $id!=0){           

                $sdata['message'] = 'Employee Information Saved';
                $this->session->set_userdata($sdata);

                redirect(admin_Url()."/employee");

            }
            else{
                $sdata['errormessage'] = 'Sorry...Employee Information not Saved';
                $this->session->set_userdata($sdata);
                
                $data['employee'] = 'active';
                // $data['institute'] = 'active';
                 $this->load->view('system_path/admin/common/header_link'); // header Css link
                 $this->load->view('system_path/admin/common/header'); // body header
                 $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                 $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                 $this->load->view('system_path/admin/employee/index'); // ...........body content page...........
                 $this->load->view('system_path/admin/common/footer'); // footer & script link
            }
        }
    
    }
    
     public function searchemployee() {
        $data['employee'] = 'active';
       
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/employee/searchemployee'); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
    }
    public function employeesearch(){
        
        $data = $this->input->post('data', TRUE);
        $data['employeelist'] = $this->EmployeeModleAdmin->getemployee($data);
        if(!empty($data['employeelist']))
        {
            if (isset($_POST['search'])) 
            {  

                $data['employee'] = 'active';     
               //  print_r($data['employeelist']);die();
                $this->load->view('system_path/admin/common/header_link'); // header Css link
                $this->load->view('system_path/admin/common/header'); // body header
                $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                $this->load->view('system_path/admin/employee/employeelist',$data); // ...........body content page...........
                $this->load->view('system_path/admin/common/footer'); // footer & script link

            }
            elseif (isset($_POST['print'])) 
            {
                $data['employee'] = 'active';

                $this->load->view('system_path/admin/common/header_link'); // header Css link
                $this->load->view('system_path/admin/common/header'); // body header
                $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                $this->load->view('system_path/admin/employee/printemployeelist',$data); // ...........body content page...........
                $this->load->view('system_path/admin/common/footer'); // footer & script link

            }
            else{
                $sdata['errormessage'] = 'No Employee Information Found';
                $this->session->set_userdata($sdata);
                redirect(admin_Url()."/employee/searchemployee");
            }
        }
        else{
                $sdata['errormessage'] = 'No Employee Information Found';
                $this->session->set_userdata($sdata);
                redirect(admin_Url()."/employee/searchemployee");
            }
    
    }
    
    public function printEmpoyeeList($programofferid) {
        $programofferid=(int)$programofferid;
        $datax=$this->ProgramModleAdmin->getofferProgramInfoById($programofferid);
        if(!empty($datax))
        {
            $data=array(
                'sessionId'=>$datax['sessionId'],
                'programLevel'=>$datax['programLevel'],
                'programId'=>$datax['programId'],
                'mediumId'=>$datax['mediumId'],
                'shiftId'=>$datax['shiftId'],
                'groupId'=>$datax['groupId']                
            );
            $data['applicantlist'] =$this->StudentModleAdmin->getApplicationIdByprogramofferId($programofferid);
            $this->load->view('system_path/admin/common/header_link'); // header Css link
            $this->load->view('system_path/admin/applicant/printapplicant_list',$data); // ...........body content page...........
            $this->load->view('system_path/admin/common/footer'); // footer & script link        
        }
        else{
            $sdata['errormessage'] = 'No Applicant Found';
            $this->session->set_userdata($sdata);
            redirect(admin_Url()."/employee/searchemployee");
        }
    }

    public function editEmployee($id) {
        $id = (int) $id;
        
            $data['editData'] = $this->EmployeeModleAdmin->editEmployeeInfo($id);
            if(!empty($data['editData']))
            {
                $data['employee'] = 'active';
                // $data['institute'] = 'active';
                 $this->load->view('system_path/admin/common/header_link'); // header Css link
                 $this->load->view('system_path/admin/common/header'); // body header
                 $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                 $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                 $this->load->view('system_path/admin/employee/editemployee',$data); // ...........body content page...........
                 $this->load->view('system_path/admin/common/footer'); // footer & script link
                 
            }
            else{
                $sdata['message'] = 'Employee information not found';
                $this->session->set_userdata($sdata);
                redirect(admin_Url()."/employee/editdemployee/".$id);
             
            }
       
         
    } 
    public function Deleteemployee($id) {
        
        $dlt=$this->EmployeeModleAdmin->deleteEmployee($id);
        if($dlt)
        {
            $sdata['message'] = 'Employee information Deleted';
            $this->session->set_userdata($sdata);
            redirect(admin_Url()."/employee/searchemployee");
        }
        else{
            $sdata['message'] = 'Employee information Not Deleted';
            $this->session->set_userdata($sdata);
            redirect(admin_Url()."/employee/searchemployee");
        }
    
    }
    
    public function updateEmp_data($id) {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

       $config = array(
            array(
                'field' => 'data[firstName]',
                'label' => 'First Name',
                'rules' => 'required|xss_clean'
            ),
            array(
                'field' => 'data[lastName]',
                'label' => 'Last Name',
                'rules' => 'required|xss_clean'
            ),
            array(
                'field' => 'data[phone]',
                'label' => 'Phone',
                'rules' => 'required|xss_clean|max_length[11]|min_length[0]'
            ),
             array(
                'field' => 'data[dateOfBirth]',
                'label' => 'Birth Date',
                'rules' => 'required|xss_clean'
            ),
             array(
                'field' => 'data[embreg]',
                'label' => 'Birth Registration Number',
                'rules' => 'required|xss_clean'
            ),
            array(
                'field' => 'data[joiningdate]',
                'label' => 'Joining Date',
                'rules' => 'required|xss_clean'
            )
            
        );

        $this->form_validation->set_rules($config);
            if ($this->form_validation->run() == FALSE) {
            $data['editData'] = $this->EmployeeModleAdmin->editEmployeeInfo($id);
            if(!empty($data['editData']))
            {
                $data['employee'] = 'active';
                // $data['institute'] = 'active';
                 $this->load->view('system_path/admin/common/header_link'); // header Css link
                 $this->load->view('system_path/admin/common/header'); // body header
                 $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                 $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                 $this->load->view('system_path/admin/employee/editemployee',$data); // ...........body content page...........
                 $this->load->view('system_path/admin/common/footer'); // footer & script link
                 
            }
            else{
                $sdata['message'] = 'Employee information not found';
                $this->session->set_userdata($sdata);
                redirect(admin_Url()."/employee/editdemployee/".$id);
             
            }
        } else {
            $data = $this->input->post('data', TRUE);
          //  print_r($data); die();
               $upd= $this->EmployeeModleAdmin->updateEmployeeInfo($data,$id);
                
                if(!empty($upd)) 
                    {                        
                        $sdata['message'] = 'Updated Successfully !';
                        $this->session->set_userdata($sdata);
                        redirect(admin_Url()."/employee/searchemployee");
                    }
                    else{
                        $sdata['errormessage'] = 'Applicant information not updated ';
                        $this->session->set_userdata($sdata);

                       redirect(admin_Url()."/employee/searchemployee");
                        
              
            }
        }
    }
        
    

//      public function updateEmp_data($id) {
//                
//       $config['upload_path'] = './uploads/Employee/';
//       $config['allowed_types'] = 'gif|jpg|png';
//       $config['max_size'] = '1000';
//        $config['max_width'] = '1024';
//       $config['max_height'] = '768';
//
//      $this->load->library('upload', $config);
//
//       $yes_upload = $this->upload->do_upload('userfile');
//
//        if (!$yes_upload) {
//           
//           $this->load->view('templates/admin/common/header');
//            $this->load->view('templates/admin/employee/index');
//           $this->load->view('templates/admin/common/footer');
//           
//        } else {
//            
//           $data = $this->input->post('data', TRUE);
//           
//            $data['degree1'] = ',' . implode(',', $data['degree1']) . ',';
//           $data['degree2'] = ',' . implode(',', $data['degree2']) . ',';
//            $data['degree3'] = ',' . implode(',', $data['degree3']) . ',';
//           $data['degree4'] = ',' . implode(',', $data['degree4']) . ',';
//           $data['degree5'] = ',' . implode(',', $data['degree5']) . ',';
//           $data['degree6'] = ',' . implode(',', $data['degree6']) . ',';
//            
//            $img_data =  $this->upload->data();
//            
//            if(empty($img_data['file_name'])){
//                       echo "asdf"; exit();
//                    unset($img_data['file_name']);                     
//                    
//                    }else{
//                       
//                        $data['photo'] = $img_data['file_name'];                
//                   }
//
//            $this->EmployeeModleAdmin->updateEmployeeInfo($data,$id);
//			$this->load->view('formsuccess');
//           $sdata['message'] = 'Successfull!';
//            $this->session->set_userdata($sdata);
//                   
//           redirect(base_url('admin/empsearch'));
//      }
//        
//  }     
        
     public function viewemployeeInfo($id){
       
        $this->load->view('templates/admin/common/header');
        $data['editData'] = $this->EmployeeModleAdmin->viewemployeeinfo($id);
        $this->load->view('templates/admin/employee/viewemployeeinfo', $data);
        $this->load->view('templates/admin/common/footer');
         
    } 
    
    
    public function searchAllemployee(){       
        
            $data['employeelist'] = $this->EmployeeModleAdmin->getRegularEmployee();
            if (!empty($data['employeelist'])) {
                $data['Attendance'] = 'active';
                $this->load->view('system_path/admin/common/header_link'); // header Css link
                $this->load->view('system_path/admin/common/header'); // body header
                $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                $this->load->view('system_path/admin/employee_attendance/index', $data); // ...........body content page...........
                $this->load->view('system_path/admin/common/footer'); // footer & script link     
                $this->load->view('system_path/jsquery'); // footer & script link
            } else {
                $sdata['errormessage'] = 'No Employee Information Found';
                $this->session->set_userdata($sdata);
                redirect(admin_Url() . "/employee/searchAllemployee");
            }
        
    
    }
    
    public function confirmattendance(){
        
        $data['employeeId'] = $this->input->post('id', TRUE);
        $data['attendDate'] = date('d-m-Y');
        $data['attendaceStatus'] = 1;
        $data['employeelist'] = $this->EmployeeModleAdmin->confirmAttendance($data);
        $sdata['message'] = 'Attendance Done';
        $this->session->set_userdata($sdata);
        redirect(admin_Url() . "/employee/searchAllemployee");
    }
    
      public function attendanceinsert($id,$status) {
       
         if($status=="Present"){
             $data['attendaceStatus']=1;
             
         }
         elseif($status=="Absent"){
             $data['attendaceStatus']=2;
         }
         else
         {
             redirect(admin_Url() . "/employee/searchAllemployee");
         }
         
            $data['employeeId'] = $id;
            $data['attendDate'] = date('Y-m-d');
            $checkattd=$this->EmployeeModleAdmin->checkattendance($data);
            if(empty($checkattd)){
                $result= $this->EmployeeModleAdmin->confirmAttendance($data);
        
                if ($result) {
                $sdata['message'] = 'Attendance Complete';
                $this->session->set_userdata($sdata);

                 redirect(admin_Url() . "/employee/searchAllemployee");
            } else {
                $sdata['errormessage'] = 'Attendance Not Done!';
                $this->session->set_userdata($sdata);

                redirect(admin_Url() . "/employee/searchAllemployee");
            }
            }
            else {
                $sdata['errormessage'] = 'Attendance Already Done';
                $this->session->set_userdata($sdata);

                redirect(admin_Url() . "/employee/searchAllemployee");
            }
    }
    
//    public function searchattendance(){       
//        $data['Attendance'] = 'active';
//        $this->load->view('system_path/admin/common/header_link'); // header Css link
//        $this->load->view('system_path/admin/common/header'); // body header
//        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
//        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
//        $this->load->view('system_path/admin/employee_attendance/searchattendance', $data); // ...........body content page...........
//        $this->load->view('system_path/admin/common/footer'); // footer & script link     
//        $this->load->view('system_path/jsquery'); // footer & script link            
//    }
      public function employeeattendancesearch() {
        $data['Attendance'] = 'active';
       // $data['attendancelist'] = $this->EmployeeModleAdmin->getemployeeattendance($data);
        $this->load->view('system_path/teacher/common/header_link'); // header Css link
        $this->load->view('system_path/teacher/common/header'); // body header
        $this->load->view('system_path/teacher/common/side_menu'); // side bar menu

        $this->load->view('system_path/teacher/employee_attendance/searchemployee'); // ...........body content page...........
        $this->load->view('system_path/teacher/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
    }
    
       public function searchattendance() {

        $datax = $this->input->post('data', TRUE);

        if (!empty($datax)) {

            $datax['attendancelist'] = $this->EmployeeModleAdmin->getEmployeeattendanceByDate($datax['fromDate'], $datax['toDate']);
            if (!empty($datax['attendancelist'])) {
                $data['Attendance'] = 'active';
                $this->load->view('system_path/teacher/common/header_link'); // header Css link
                $this->load->view('system_path/teacher/common/header'); // body header
                $this->load->view('system_path/teacher/common/side_menu'); // side bar menu
              
                $this->load->view('system_path/teacher/employee_attendance/searchemployee', $datax); // ...........body content page...........
                $this->load->view('system_path/teacher/common/footer'); // footer & script link
                $this->load->view('system_path/jsquery'); // footer & script link
            } else {
                $sdata['errormessage'] = 'Attendance Information Not Found';
                $this->session->set_userdata($sdata);
                redirect(teacher_Url() . "/employee/employeeattendancesearch");
            }
        } else {
            $sdata['errormessage'] = 'Attendance Information Not Found';
            $this->session->set_userdata($sdata);
            redirect(teacher_Url() . "/employee/employeeattendancesearch");
        }
    }
    
      public function getemployeeid() {
          $data['employee'] = 'active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/employee/getemployeeid'); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link  
    }
    
     public function employeeidcard(){
        
        $data = $this->input->post('data', TRUE);
        $data['employeelist'] = $this->EmployeeModleAdmin->getemployee($data);
        if(!empty($data['employeelist']))
        {
            if (isset($_POST['search'])) 
            {  

                $data['employee'] = 'active';     
               //  print_r($data['employeelist']);die();
                $this->load->view('system_path/admin/common/header_link'); // header Css link
                $this->load->view('system_path/admin/common/header'); // body header
                $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                $this->load->view('system_path/admin/employee/employeelistidcard',$data); // ...........body content page...........
                $this->load->view('system_path/admin/common/footer'); // footer & script link

            }
            else{
                $sdata['errormessage'] = 'No Employee Information Found';
                $this->session->set_userdata($sdata);
                redirect(admin_Url()."/employee/searchemployee");
            }
        }
        else{
                $sdata['errormessage'] = 'No Employee Information Found';
                $this->session->set_userdata($sdata);
                redirect(admin_Url()."/employee/searchemployee");
            }
    
    }

    public function generateId() {

        if (!empty($_POST['employeeId'])) {
        	ini_set('memory_limit','-1');

            $data['employeeId'] = $this->input->post('employeeId');
            
            $employeeId = $data['employeeId'];
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

            for ($i = 0; $i < count($employeeId); $i++) {
                $countempId = $employeeId[$i];
                $empinfo = getEmployeeInfoById($countempId);
              $logo=  getInstituteLogo();
                
                // Get Student Logo is valid or not  
              
                 
                if (file_exists($empinfo['photo'])) {
                    $images = base_url() . $empinfo['photo'];
                } else {
                    $images = base_url() . "uploads/default/default.png";
                    ;
                }
               
                if (!empty($images)) {
                    $pdf->ImageEps($file = base_url() . 'images/empidcard.ai', $x = 0, $y = 0, $w = 0, $h = 0, $link = '', $useBoundingBox = true, $align = 'center', $palign = '', $border = 0, $fitonpage = false);

                    $pdf->Image($images, 15, 26, 23, 25);
                                
                    $tbl = "

            <table style=\"text-align:center; top:50px; \" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" >

            <br><br><br><br>
           
              <div style=\"color:#FF3300; top:-5px;\">" . getInstituteName()."</div>
                 <tr>
                    <td style=\"height:60px;\">
                         <br><br><br><br>
                         <br>
                         </td>

                </tr>
                
                
                
                 <tr>
                   <td style=\"color:#2F3192 \">ID: " . $empinfo['employeeId'] . "</td>
                </tr>
                
                
                <tr>
                   <td style=\"color:#E22B27;font-family:Arial; font-size:15px bold;\">" . $empinfo['firstName'] . " " . $empinfo['lastName'] . " </td>
                </tr>
                    <tr>
                   <td style=\"font-family:Arial; font-size:12px\">Designation:
                   " 
                            . element($empinfo['designation'], getdesignation(),NULL) . " 
               
</td> 
                </tr>
                    <tr>

                   <td style=\"font-family:Arial; font-size:12px\">Department: " .getDepartmentName($empinfo['departmentId']). "</td>
                </tr>
                
                 
            </table> ";

                    $pdf->writeHTML( $tbl, true, false, false, false, '');

                    $pdf->AddPage();
                }
            }

            $pdf->Output('getProgramName($empinfo[programId]).pdf', 'I');
        } else {
            $sdata = array();
            $sdata['errormessage'] = 'Select any Employee!';
            $this->session->set_userdata($sdata);
            redirect(admin_Url() . "/employee/getemployeeid");
        }
    }
    
}
