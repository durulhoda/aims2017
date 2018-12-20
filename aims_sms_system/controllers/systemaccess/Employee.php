<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*

 * Project Name: Aims

 * Author: Adventure Soft

 * Author url: http://www.adventure-soft.com

 */

class Employee extends MY_Controller {
    public function __construct() {

        parent::__construct();

        $this->my_admin();

      //  date_default_timezone_get("Asia/Dhaka");

date_default_timezone_set('Asia/Dhaka');

        $this->load->model('admin/employee/EmployeeModleAdmin', 'EmployeeModleAdmin');

          $this->load->model('admin/institute/InstituteModleAdmin', 'InstituteModleAdmin');

    }



    public function index() {

        $data['employee'] = 'active';

        $data['all_degree']=Array(
            '1'=>'SSC',
            '2'=>'HSC',
            '3'=>'BA/BA(Hons.)/BBA/BSS/BSC',
            //'3'=>'BA(Pass)',
            '4'=>'BA(Hons.)BBA',
            '5'=>'BA(Hons.)BSS',
            '6'=>'BA(Hons.)BSC',
            '7'=>'BA(Hons.)CSE',
            '8'=>'MA',
            '9'=>'Msc',
            '10'=>'MBA',
            '11'=>'B.ed',
            '12'=>'M.ed'
        );

       // $data['institute'] = 'active';

        $this->load->view('system_path/admin/common/header_link'); // header Css link

        $this->load->view('system_path/admin/common/header'); // body header

        $this->load->view('system_path/admin/common/side_menu'); // side bar menu

        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu

        $this->load->view('system_path/admin/employee/index'); // ...........body content page...........

        $this->load->view('system_path/admin/common/footer'); // footer & script link

         $this->load->view('system_path/jsquery'); // footer & script link

    }



    public function test()

    {

        exit;

        $records = $this->db

                  ->select('emp_Id, employeeId')

                  ->get('employee')

                  ->result();

        if ($records) {

            foreach ($records as $key => $val) {

                $data[] = [

                    'emp_Id' => $val->emp_Id,

                    'employeeId' => substr($val->employeeId, 2)

                ];

            }

            $this->db->update_batch('employee', $data, 'emp_Id'); 

        }

       // print_r($arr);

        echo '<pre>';print_r($records);

        echo '<pre>';print_r($data);

        exit;

    }



    public function insertemployee() {

    //  echo $_POST['userfile']; exit;

//        echo '<pre>';
//        print_r($_FILES);
//
//        echo '<pre>';
//        print_r($_POST);exit;

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

                'rules' => 'required|xss_clean|max_length[13]|min_length[11]'

            ),

             array(

                'field' => 'data[dateOfBirth]',

                'label' => 'Birth Date',

                'rules' => 'required|xss_clean'

            ),

            array(

                'field' => 'data[joiningdate]',

                'label' => 'Joining Date',

                'rules' => 'required|xss_clean'

            ),

            array(

                'field' => 'data[employeeType]',

                'label' => 'Employee Type',

                'rules' => 'required|xss_clean'

            )

            

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

            $data['employee'] = 'active';

            // $data['institute'] = 'active';

             $this->load->view('system_path/admin/common/header_link'); // header Css link

             $this->load->view('system_path/admin/common/header'); // body header

             $this->load->view('system_path/admin/common/side_menu'); // side bar menu

             $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu

             $this->load->view('system_path/admin/employee/index'); // ...........body content page...........

             $this->load->view('system_path/admin/common/footer'); // footer & script link

            

        } elseif (!$yes_upload) {

//            $error = array('error' => $this->upload->display_errors());
//
//            print_r($error);die();

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

            $items=array();
            if($this->input->post('items'))
            {
                $items = $this->input->post('items', TRUE);
            }

          //  print_r($data);            die();

           $data_acx = $this->input->post('data_acx', TRUE);

             

            //$data['degree'] = ',' . implode(',', $data['degree']) . ',';

   

            $img_data =  $this->upload->data();

               

            $data['photo'] = $img_data['file_name'];

         

            $this->EmployeeModleAdmin->addEmployeeInfo($data,$data_acx,$items);

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

        //print_r($id); die();

        

            $data['editData'] = $this->EmployeeModleAdmin->editEmployeeInfo($id);
            $data['edu_info'] = $this->EmployeeModleAdmin->editEmployeeEduInfo($id);

            $data['all_degree']=Array(
                '1'=>'SSC',
                '2'=>'HSC',
                '3'=>'BA/BA(Hons.)/BBA/BSS/BSC',
                //'3'=>'BA(Pass)',
                '4'=>'BA(Hons.)BBA',
                '5'=>'BA(Hons.)BSS',
                '6'=>'BA(Hons.)BSC',
                '7'=>'BA(Hons.)CSE',
                '8'=>'MA',
                '9'=>'Msc',
                '10'=>'MBA',
                '11'=>'B.ed',
                '12'=>'M.ed'
            );

//            echo '<pre>';
//            print_r($data); die();

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
            $data['edu_info'] = $this->EmployeeModleAdmin->get_employee_education_info($id);

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


            $data['edu_info'] = $this->EmployeeModleAdmin->editEmployeeEduInfo($id);
            $data['all_degree']=Array(
                '1'=>'SSC',
                '2'=>'HSC',
                '3'=>'BA/BA(Hons.)/BBA/BSS/BSC',
                //'3'=>'BA(Pass)',
                '4'=>'BA(Hons.)BBA',
                '5'=>'BA(Hons.)BSS',
                '6'=>'BA(Hons.)BSC',
                '7'=>'BA(Hons.)CSE',
                '8'=>'MA',
                '9'=>'Msc',
                '10'=>'MBA',
                '11'=>'B.ed',
                '12'=>'M.ed'
            );
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
            else {

            $data = $this->input->post('data', TRUE);
            $existing_data = $this->input->post('existing_data', TRUE);
            $items = $this->input->post('items', TRUE);


            $upd = $this->EmployeeModleAdmin->updateEmployeeInfo($data,$id);

            if($existing_data)
            {
                foreach($existing_data as $index=>$value)
                {
                    if($value['program_type'] && $value['discipline'] && $value['grade'])
                    {
                        $ex_up=1;
                        $this->EmployeeModleAdmin->updateEmployeeEduInfo($value,$index);
                    }
                }
            }

            $present_ids=array();
            $existed_data = $this->EmployeeModleAdmin->getEmployeeEduInfo($id);
            if($existed_data)
            {
                $all_ids = array_column($existed_data, 'id');
                if($existing_data)
                {
                    $present_ids = array_keys($existing_data);
                }
                $ids=array_diff_assoc($all_ids,$present_ids);
                if($ids)
                {
                    $dlt = 1;
                    $this->EmployeeModleAdmin->deleteEmployeeEduInfo($ids);
                }
            }

            if(isset($items['program_type']))
            {
                foreach($items['program_type'] as $index=>$value)
                {
                    if($value && $items['discipline'][$index] && $items['grade'][$index])
                    {
                        $temp_array=array();
                        $ins = 1;
                        $temp_array['emp_id']=$id;
                        $temp_array['program_type']=$items['program_type'][$index];
                        $temp_array['discipline']=$items['discipline'][$index];
                        $temp_array['grade']=$items['grade'][$index];
                        $temp_array['passing_year']=$items['passing_year'][$index];
                        $temp_array['board_or_institution']=$items['board_or_institution'][$index];
                        $this->db->insert('employee_educational_information', $temp_array,true);
                    }
                }
            }



            if(!empty($upd) || !empty($ins) || !empty($dlt) || !empty($ex_up))
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

            $upd= $this->EmployeeModleAdmin->updateEmployeeInfo($id);



                if(!empty($upd))
                {

                    $sdata['message'] = 'Updated Successfully !';

                    $this->session->set_userdata($sdata);

                    redirect(admin_Url()."/employee/searchemployee");

                }

                else
                {

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

                    $data['attendance_date'] = date("Y-m-d", strtotime(trim($this->input->post('attendance_date', true)))); 

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

    public function employee_attendance()
    {
        $data['Attendance'] = 'active';
        $data['records'] = [];
        $data['emp_name'] = $this->getEmpName();
        if ($_POST) {
             $data['records'] = $this->getEmployeeAttendance();
             $data['formDate'] = $this->input->post('fromDate', true);
             $data['toDate'] = $this->input->post('toDate', true);
        }
        //echo '<pre>';print_r($data['records']);exit;
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/employee_attendance/emp_attendance'); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
    }

    private function getEmpName(){
        $emp = [];
        $records = $this->db->get('employee')->result();
        if($records) {
            foreach ($records as $key => $val) {
                $emp[$val->employeeId] = trim($val->firstName." ".$val->middleName." ".$val->lastName);
            }
        }
        return $emp;
    }

    private function getEmployeeAttendance()
    {
        //echo '<pre>';print_r($_POST);
        $con = '';
        $fromDate = $this->input->post('fromDate', true);
        $toDate = $this->input->post('toDate', true);
        if ($fromDate && $toDate) {
            $fromDate = "'".date("Y-m-d", strtotime($fromDate))."'";
            $toDate = "'".date("Y-m-d", strtotime($toDate))."'";

            $con .= ' AND DATE(FROM_UNIXTIME(el.date_time)) >= '.$fromDate.'';
            $con .= ' AND DATE(FROM_UNIXTIME(el.date_time)) <= '.$toDate.'';
        }
        $employeeId = trim($this->input->post('employeeId', true));
        if ($employeeId) {
             $con .= ' AND el.emp_id = '.$employeeId.'';
        }
        // $fromDate = "'2018-03-28'";
        // $toDate = "'2018-03-31'";
        // $con .= ' AND DATE(FROM_UNIXTIME(el.date_time)) >= '.$fromDate.'';
        // $con .= ' AND DATE(FROM_UNIXTIME(el.date_time)) <= '.$toDate.'';
       // echo '<pre>';print_r($_POST);exit;
        $sql = "
            SELECT 
                el.emp_id,
                DATE(FROM_UNIXTIME(el.date_time)) AS a_date,
                TIME(MIN(FROM_UNIXTIME(el.date_time))) AS in_time,
                TIME(MAX(FROM_UNIXTIME(el.date_time))) AS out_time,
                IF(TIME(MIN(FROM_UNIXTIME(el.date_time))) >= '09:00:00', 'Late', 'Present') AS in_time_status,
                IF(TIME(MIN(FROM_UNIXTIME(el.date_time))) >= '04:00:00', 'Early', 'Present') AS out_time_status
            FROM 
                emp_event_log AS el
                JOIN 
                    (
                        SELECT 
                            distinct FROM_UNIXTIME(emp_event_log.date_time)  AS date_time
                        FROM 
                            emp_event_log
                    ) e2
                    WHERE 
                        FROM_UNIXTIME(el.date_time) = e2.date_time
                        {$con}
                    GROUP BY 
                        el.emp_id,
                        DATE(e2.date_time)
                    ORDER BY
                        e2.date_time
                ";
            $records = $this->db->query($sql)->result();
            return $records;
           // echo '<pre>';print_r($this->db->last_query($records));
           //echo '<pre>';print_r($records);exit;
    }



    public function searchattendance() {

        $datax=array();
        $datax['attendancelist']=array();
        $datax['attendance_list']=array();

        $items = $this->input->post('data', TRUE);
        $datax=array();


        if(!empty($items))
        {
            $datax['employeeId']=null;
            if($items['employeeId'])
            {
                $datax['employeeId'] = $items['employeeId'];
            }

            if ($items['fromDate'])
            {
                $datax['fromDate'] = date("Y-m-d", strtotime(trim($items['fromDate'])));
            }
            else
            {
                $sdata['errormessage'] = 'Please Select a From Date';
                $this->session->set_userdata($sdata);
                redirect(admin_Url()."/employee/employeeattendancesearch");
            }

            if ($items['toDate'])
            {
                $datax['toDate'] = date("Y-m-d", strtotime(trim($items['toDate'])));
            }
            else
            {
                $datax['toDate'] = date("Y-m-d", time());
            }

            $period = new DatePeriod(
                new DateTime($datax['fromDate']),
                new DateInterval('P1D'),
                new DateTime($datax['toDate'].' 23:59:59')
            );

            foreach ($period as $date) {
                $dates[] = $date->format("Y-m-d");
            }



            $employee_list = $this->EmployeeModleAdmin->getEmployeeInfo();
            $manual_attendance_list = $this->EmployeeModleAdmin->getEmployeeattendanceByDate($datax['fromDate'],$datax['toDate'],$datax['employeeId']);
            $finger_attendance_list = $this->EmployeeModleAdmin->getEmployeefingerattendanceByDate($datax['fromDate'],$datax['toDate'],$datax['employeeId']);



            foreach ($finger_attendance_list as $key => $value)
            {
                $finger_attendance_list[$key]['in_time'] = date('h:i:s A', (($finger_attendance_list[$key]['in_time'])-21600));
                $finger_attendance_list[$key]['out_time'] = date('h:i:s A', (($finger_attendance_list[$key]['out_time'])-21600));
            }

            foreach($dates as $dt)
            {
                foreach($employee_list as $employee)
                {
                    if($manual_attendance_list)
                    {
                        foreach($manual_attendance_list as $index=>$m_a_l)
                        {
                            if($manual_attendance_list[$index]['emp_id'] == $employee['employeeId'] && $manual_attendance_list[$index]['attendance_date'] == $dt)
                            {
                                $datax['attendancelist'][] = $manual_attendance_list[$index];
                            }
                        }
                    }

                    if($finger_attendance_list)
                    {
                        foreach($finger_attendance_list as $key=>$f_a_l)
                        {
                            if($finger_attendance_list[$key]['emp_id'] == $employee['employeeId'] && $finger_attendance_list[$key]['attendance_date'] == $dt)
                            {
                                $datax['attendancelist'][] = $finger_attendance_list[$key];
                            }
                        }
                    }
                }
            }

//            echo '<pre>';
//            print_r($datax);exit;

            $datax['institute_details'] = $this->InstituteModleAdmin->getInstituteDetailedInfo();

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

             $data_info = $this->InstituteModleAdmin->getInstituteInfo();

                

                // Get Student Logo is valid or not  

                             if (file_exists($data_info['logo'])) {

      $logo =   base_url() . $data_info['logo'];

    } else {

      $logo =  base_url() . "all_upload/default/aims.png";

    }



                 

                if (file_exists("uploads/Employee/".$empinfo['photo'])) {

                    $images = base_url() . "uploads/Employee/".$empinfo['photo'];

                } else {

                    $images = base_url() . "uploads/default/default.png";

                    ;

                }

               

                if (!empty($images)) {

                    $pdf->ImageEps($file = base_url() . 'images/empidcard.ai', $x = 0, $y = 0, $w = 0, $h = 0, $link = '', $useBoundingBox = true, $align = 'center', $palign = '', $border = 0, $fitonpage = false);

                    $pdf->Image($logo, 16, 5.5, 22, 14);

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

