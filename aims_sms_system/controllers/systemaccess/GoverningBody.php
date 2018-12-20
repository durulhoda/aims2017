<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class GoverningBody extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->my_admin();
      //  date_default_timezone_get("Asia/Dhaka");
date_default_timezone_set('Asia/Dhaka');
        $this->load->model('admin/employee/EmployeeModleAdmin', 'EmployeeModleAdmin');
    }

    public function index() {
         $data['governing'] = 'active';
          $data['home'] = 'active';
       // $data['institute'] = 'active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu',$data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/governingbody/index'); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
         $this->load->view('system_path/jsquery'); // footer & script link
    }

    public function insert() {
    //  echo $_POST['userfile']; exit;
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
               array(
                'field' => 'data[memberTypeId]',
                'label' => 'First Name',
                'rules' => 'required|xss_clean'
            ),
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
                'rules' => 'required|xss_clean|max_length[13]|min_length[11]'
            ),
             array(
                'field' => 'data[dateOfBirth]',
                'label' => 'Birth Date',
                'rules' => 'required|xss_clean'
            ),
            
         
            
        );

        $config['upload_path'] = './uploads/Employee/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '10000';
        $config['max_width'] = '250';
        $config['max_height'] = '250';

        $this->upload->initialize($config);

        $yes_upload = $this->upload->do_upload('photo');

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            $data['governing'] = 'active';
          $data['home'] = 'active';
       // $data['institute'] = 'active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu',$data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/governingbody/index'); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
         $this->load->view('system_path/jsquery'); // footer & script link
            
        } elseif (!$yes_upload) {
         //   $error = array('error' => $this->upload->display_errors());
        //    print_r($error);die();
            $data['employee'] = 'active';
            $sdata['errormessage'] = 'Image not upload';
            $this->session->set_userdata($sdata);
            
             $data['governing'] = 'active';
          $data['home'] = 'active';
       // $data['institute'] = 'active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu',$data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/governingbody/index'); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
         $this->load->view('system_path/jsquery'); // footer & script link
            
        } else { 
            
            $data = $this->input->post('data', TRUE);
          //  print_r($data);            die();
        
   
            $img_data =  $this->upload->data();
               
            $data['photo'] = "/uploads/Employee/" .$img_data['file_name'];
         
            $this->EmployeeModleAdmin->addGovernInfo($data);
            $id=$this->db->insert_id();
            
            if(!empty($id) || $id!=0){           

                $sdata['message'] = 'GovernBody Information Saved';
                $this->session->set_userdata($sdata);

                redirect(admin_Url()."/GoverningBody");

            }
            else{
                $sdata['errormessage'] = 'Sorry...Employee Information not Saved';
                $this->session->set_userdata($sdata);
                
                redirect(admin_Url()."/GoverningBody");
            }
        }
    
    }
    
     public function searchgovernbody() {
         $data['governing'] = 'active';
          $data['homee'] = 'active';
       
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu',$data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/governingbody/searchdata'); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
    }
    public function governsearch(){
        
        $data = $this->input->post('data', TRUE);
        $data['employeelist'] = $this->EmployeeModleAdmin->getgovern($data);
      //  print_r($data); die();
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
                $this->load->view('system_path/admin/governingbody/governlist',$data); // ...........body content page...........
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
                $sdata['errormessage'] = 'No Member Information Found';
                $this->session->set_userdata($sdata);
                redirect(admin_Url()."/GoverningBody/searchgovernbody");
            }
        }
        else{
                $sdata['errormessage'] = 'No Member Information Found';
                $this->session->set_userdata($sdata);
                redirect(admin_Url()."/GoverningBody/searchgovernbody");
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
     //   print_r($id); die();
        
            $data['editData'] = $this->EmployeeModleAdmin->editEmployeeInfo($id);
           // print_r($data); die();
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
                redirect(admin_Url()."/employee/searchemployee/");
             
            }
       
         
    } 
    
    public function showEmployeeProfile($id) {
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
                 $this->load->view('system_path/admin/employee/employee_profile',$data); // ...........body content page...........
                 $this->load->view('system_path/admin/common/footer'); // footer & script link
                 
            }
            else{
                $sdata['message'] = 'Employee information not found';
                $this->session->set_userdata($sdata);
                redirect(admin_Url()."/employee/searchemployee");
             
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
                'rules' => 'required|xss_clean|max_length[13]|min_length[0]'
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
                        $sdata['errormessage'] = 'Employee information not updated ';
                        $this->session->set_userdata($sdata);

                       $this->editEmployee($id);
                }
        }
    }
        
    

      public function update_emp_image($id) {
                
       $config['upload_path'] = './uploads/Employee/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '100';
        $config['max_width'] = '250';
        $config['max_height'] = '250';

        $this->upload->initialize($config);

        $yes_upload = $this->upload->do_upload('photo');
        if (!$yes_upload) {
            $sdata['errormessage'] = 'Image not uploaded.. maintain image size';
            $this->session->set_userdata($sdata);
           $this->editEmployee($id);
        } else {
            
           $img_data =  $this->upload->data();
            
            if(empty($img_data['file_name'])){
                unset($img_data['file_name']);                     
            }else{  
               $data['photo'] = $img_data['file_name'];                
            }

            $upd= $this->EmployeeModleAdmin->updateEmployeeInfo($data,$id);
                
                if(!empty($upd)) 
                    {                        
                        $sdata['message'] = 'Updated Successfully !';
                        $this->session->set_userdata($sdata);
                        redirect(admin_Url()."/employee/searchemployee");
                    }
                    else{
                        $sdata['errormessage'] = 'Employee information not updated ';
                        $this->session->set_userdata($sdata);

                       $this->editEmployee($id);
                }
      }
        
  }     
        
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
    
     public function insert_attendance() {

            $employeeId = $this->input->post('employeeId');
            $serial = $this->input->post('serial');
            $attendanceStatus = $this->input->post('attendance_status');
            $attendance_reason = $this->input->post('attendance_reason');
           // $attendance_date = $this->input->post('attendance_date');
            if (!empty($serial)) {
                $ab = $serial;
               
                for ($i = 0; $i < count($ab); $i++) {
                 
                    $find_value=$serial[$i]-1;

                    $data['employeeId'] = $employeeId[$find_value];
                    $data['attendance_status'] = $attendanceStatus[$find_value];
                    $data['attendance_reason'] = $attendance_reason[$find_value];
                   // $data['programOfferId'] = $this->input->post('programOfferId', true);
                    $data['attendance_date'] = $this->input->post('attendance_date', true);  
                    
                    /*/*$serial = $this->input->post('serial', TRUE);    
                $attendance_date = $this->input->post('attendance_date', TRUE); 
                $attendance_status = $this->input->post('attendance_status', TRUE); 
                $attendance_reason = $this->input->post('attendance_reason', TRUE); 
                $employeeId=$this->input->post('employeeId', TRUE); */
                   
                 //   $results = $this->StudentattendanceModleAdmin->checkattendance($data['employeeId'], $data['attendanceDate']);
                    $results= $this->EmployeeModleAdmin->empcheckattendance($data['employeeId'], $data['attendance_date']);

                    if ($results == TRUE) {
                        $sdata = array();
                        $sdata['errormessage'] = "Attendence Already done";
                        $this->session->set_userdata($sdata);
                        redirect(admin_Url()."/employee/employeeattendancesearch");
                    } elseif ($results == FALSE) {
                     //   print_r($data);
                       
                         $this->EmployeeModleAdmin->confirmAttendance($data);
                    }
                }
          //      die();
                $sdata['message'] = 'Attendance Successfull inserted';
                $this->session->set_userdata($sdata);

               redirect(admin_Url()."/employee/employeeattendancesearch");
        } else {
            $sdata['errormessage'] = 'Employee Information not found';
            $this->session->set_userdata($sdata);

           redirect(admin_Url()."/employee/employeeattendancesearch");
        }
    }
    

    public function oldinsert_attendance() {

        $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');   
        
            $config = array(
                array(
                    'field' => 'attendance_date',
                    'label' => 'Date',
                    'rules' => 'required|xss_clean'
                )
            );
            $this->form_validation->set_rules($config);
            if ($this->form_validation->run() == FALSE) 
            {
                //echo 'gorar dem';die();
                $errormessage['errormessage'] = "Attendance Date Missing";
                $this->session->set_userdata($errormessage);
               
                redirect(admin_Url()."/employee/searchAllemployee");
               
            } 
            else 
            {
                $serial = $this->input->post('serial', TRUE);    
                $attendance_date = $this->input->post('attendance_date', TRUE); 
                $attendance_status = $this->input->post('attendance_status', TRUE); 
                $attendance_reason = $this->input->post('attendance_reason', TRUE); 
                $employeeId=$this->input->post('employeeId', TRUE); 
                
                if(!empty($serial))
                {
                    $count=count($serial);
                    //print_r($count);die();
                    $countstudent=0;
                   for($i=0;$i<$count;$i++)
                   {
                        $find_value=$serial[$i]-1;
                        
                        $data['employeeId']=$employeeId[$find_value];
                        $data['attendance_status']=$attendance_status[$find_value];
                        $data['attendance_date']=date('d-m-Y');
                        $data['attendance_reason']=$attendance_reason[$find_value];                      
                     
                     // Check attendance by date with match (StudentId,ProgramOfferId,attendance_date, Status, EmployeeId)
                       $check['test']=$this->EmployeeModleAdmin->checkDuplicate_Attndn_date($data);
                        if(!empty($check['test'])) //$check)
                       {                            
                            $chk_stu=count($check['employeeId']);
                            $countstudent= $chk_stu+$countstudent;
                        }
                        else
                        {                           
                          $insert=$this->EmployeeModleAdmin->confirmAttendance($data);
                            
                        } 
                       
                        
                   }

              
                   if(empty($insert) || $countstudent<0)
                    {
                        $errormessage['errormessage'] = "Duplicate Attendance found for '.$countstudent.' Employee";
                        $this->session->set_userdata($errormessage);
                        redirect(admin_Url()."/employee/searchAllemployee");
                    }
                    else
                    {
                        $message['message']='Employee Attendance Updated successfully';
                        $this->session->set_userdata($message);
                        redirect(admin_Url()."/employee/searchAllemployee");
                        
                    } 
                   
                   
                } 
                else
                {
                    $errormessage['errormessage'] = "Attendance Information missing... Search again";
                    $this->session->set_userdata($errormessage);
                    redirect(admin_Url()."/employee/searchAllemployee");
                }           
            }
    }

    public function delete_attendance($id) {
        
        $dlt=$this->EmployeeModleAdmin->delete_attendance($id);
        if($dlt)
        {
            $sdata['message'] = 'Attendance information Deleted';
            $this->session->set_userdata($sdata);
            redirect(admin_Url()."/employee/employeeattendancesearch");
        }
        else{
            $sdata['message'] = 'Attendance information Not Deleted';
            $this->session->set_userdata($sdata);
            redirect(admin_Url()."/employee/employeeattendancesearch");
        }
    
    }


    public function confirmattendance(){
        
        $data['employeeId'] = $this->input->post('id', TRUE);
        $data['attendance_date'] = date('d-m-Y');
        $data['attendance_status'] = 1;
        $data['employeelist'] = $this->EmployeeModleAdmin->confirmAttendance($data);
        $sdata['message'] = 'Attendance Done';
        $this->session->set_userdata($sdata);
        redirect(admin_Url() . "/employee/searchAllemployee");
    }
    
      public function attendanceinsert($id,$status) {
       
         if($status=="Present"){
             $data['attendance_status']=1;
             
         }
         elseif($status=="Absent"){
             $data['attendance_status']=2;
         }
         else
         {
             redirect(admin_Url() . "/employee/searchAllemployee");
         }
         
            $data['employeeId'] = $id;
            $data['attendance_date'] = date('Y-m-d');
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
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/employee_attendance/searchemployee'); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
    }
    
      public function searchattendance() {

        $datax = $this->input->post('data', TRUE);
       
        if (!empty($datax)) {

            $datax['attendancelist'] = $this->EmployeeModleAdmin->getEmployeeattendanceByDate($datax['fromDate'],$datax['toDate']);
            if (!empty($datax['attendancelist']))
            {
              $data['Attendance'] = 'active';
              $this->load->view('system_path/admin/common/header_link'); // header Css link
              $this->load->view('system_path/admin/common/header'); // body header
              $this->load->view('system_path/admin/common/side_menu'); // side bar menu
              $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
              $this->load->view('system_path/admin/employee_attendance/searchemployee', $datax); // ...........body content page...........
              $this->load->view('system_path/admin/common/footer'); // footer & script link
              $this->load->view('system_path/jsquery'); // footer & script link
            }
            else {
              $sdata['errormessage'] = 'Attendance Information Not Found';
              $this->session->set_userdata($sdata);
              redirect(admin_Url()."/employee/employeeattendancesearch");
            }
           
        }
        else {
              $sdata['errormessage'] = 'Attendance Information Not Found';
              $this->session->set_userdata($sdata);
              redirect(admin_Url()."/employee/employeeattendancesearch");
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
              
                 
                if (file_exists("uploads/Employee/".$empinfo['photo'])) {
                    $images = base_url() . "uploads/Employee/".$empinfo['photo'];
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
           
                 <tr>
                    <td style=\"height:60px;\">
                         <br><br><br><br>
                         <br>
                         </td>

                </tr>
                
                <br><br><br>
                
                 <tr>
                   <td style=\"color:#2F3192 \">ID: " . $empinfo['employeeId'] . "</td>
                </tr>
                
                
                <tr>
                   <td style=\"color:#E22B27;font-family:Arial; font-size:15px bold;\">" . $empinfo['firstName'] . " " . $empinfo['lastName'] . " </td>
                </tr>
                    <tr>
                   <td style=\"font-family:Arial; font-size:12px\">
                   " 
                            . element($empinfo['designation'], getdesignation(),NULL) . " 
               
</td> 
                </tr>
                    <tr>

                   <td style=\"font-family:Arial; font-size:12px\">" .getDepartmentName($empinfo['departmentId']). "</td>
                </tr>
                
                 
            </table> ";

//             $tbl = "

//             <table style=\"text-align:center; top:50px; \" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" >

//             <br><br><br><br>
           
//               <div style=\"color:#FF3300; top:-5px;\">" . getInstituteName()."</div>
//                  <tr>
//                     <td style=\"height:60px;\">
//                          <br><br><br><br>
//                          <br>
//                          </td>

//                 </tr>
                
//                 <br>
                
//                  <tr>
//                    <td style=\"color:#2F3192 \">ID: " . $empinfo['employeeId'] . "</td>
//                 </tr>
                
                
//                 <tr>
//                    <td style=\"color:#E22B27;font-family:Arial; font-size:15px bold;\">" . $empinfo['firstName'] . " " . $empinfo['lastName'] . " </td>
//                 </tr>
//                     <tr>
//                    <td style=\"font-family:Arial; font-size:12px\">
//                    " 
//                             . element($empinfo['designation'], getdesignation(),NULL) . " 
               
// </td> 
//                 </tr>
//                     <tr>

//                    <td style=\"font-family:Arial; font-size:12px\">" .getDepartmentName($empinfo['departmentId']). "</td>
//                 </tr>
                
                 
//             </table> ";

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
