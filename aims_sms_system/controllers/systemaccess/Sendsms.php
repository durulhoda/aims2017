<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */


class Sendsms extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->my_admin();
        $this->load->model('admin/student/StudentModleAdmin', 'StudentModleAdmin');
        $this->load->model('admin/employee/EmployeeModleAdmin', 'EmployeeModleAdmin');
        $this->load->model('admin/studentattendance/StudentattendanceModleAdmin', 'StudentattendanceModleAdmin');
    }
    
    
    public function index() {
        
        $data['sendsms']='active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu',$data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu'); // top bar menu
        $this->load->view('system_path/admin/sendsms/index',$data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
}
public function receivertype() {
         $data['sendsms']='active';
        $data = $this->input->post('receivertype', TRUE); 
   //     print_r($data);        die();
        if($data == "Employee")
        {
        $data=array();
        $data['sendsms'] = 'active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu',$data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu'); // top bar menu
        $this->load->view('system_path/admin/sendsms/employee',$data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
        }
        elseif ($data == 'Student') {
            
        $data=array();
        $data['sendsms']='active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu',$data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu'); // top bar menu
        $this->load->view('system_path/admin/sendsms/student',$data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
    }
    else{
                    $sdata['message'] = 'Select Receiver Type!';
                    $this->session->set_userdata($sdata);
                    
                    redirect(admin_Url(). "/sendsms");
                   
    }
}

public function searchstudentnumber(){        
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
                'label' => 'Program',
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
            $data['sendsms'] = 'active';
            $data['title2']="Send SMS to Student";
                       $this->load->view('system_path/admin/common/header_link'); // header Css link
                        $this->load->view('system_path/admin/common/header'); // body header
                        $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
                        $this->load->view('system_path/admin/common/top_menu'); // top bar menu
                        $this->load->view('system_path/admin/sendsms/student', $data); // ...........body content page...........
                        $this->load->view('system_path/admin/common/footer'); // footer & script link
                        $this->load->view('system_path/jsquery'); // footer & script link
        } else {
            $data = $this->input->post('data', TRUE);
          //  print_r($data); die();
            $data['sendsms']='active';
            $data['programOfferId'] = getProgramOfferId($data);
            if (!empty($data['programOfferId'])) {
                $data['studentlist'] = $this->StudentModleAdmin->searchRegisteredStudentId($data);
           //     print_r($data['studentlist']); die();
                if (!empty($data['studentlist'])) {
                    //echo '<pre>';print_r($data);exit;
                     $this->load->view('system_path/admin/common/header_link'); // header Css link
                    $this->load->view('system_path/admin/common/header'); // body header
                    $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
                    $this->load->view('system_path/admin/common/top_menu'); // top bar menu
                    $this->load->view('system_path/admin/sendsms/tostudent', $data); // ...........body content page...........
                    $this->load->view('system_path/admin/common/footer'); // footer & script link
                    $this->load->view('system_path/jsquery'); // footer & script link
                } else {
                    $sdata['message'] = 'No student found inserted enrollment information';
                    $this->session->set_userdata($sdata);
                    $data['title2']="Send SMS to Student";
                     $this->load->view('system_path/admin/common/header_link'); // header Css link
                    $this->load->view('system_path/admin/common/header'); // body header
                    $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
                    $this->load->view('system_path/admin/common/top_menu'); // top bar menu
                    $this->load->view('system_path/admin/sendsms/student', $data); // ...........body content page...........
                    $this->load->view('system_path/admin/common/footer'); // footer & script link
                    $this->load->view('system_path/jsquery'); // footer & script link
                }
            } 
            else {
                $sdata['message'] = 'Inserted Enrollment information is not offered yet!';
                $this->session->set_userdata($sdata);
                $data['title2']="Send SMS to Student";
                $this->load->view('system_path/admin/common/header_link'); // header Css link
                $this->load->view('system_path/admin/common/header'); // body header
                $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
                $this->load->view('system_path/admin/common/top_menu'); // top bar menu
                $this->load->view('system_path/admin/sendsms/student', $data); // ...........body content page...........
                $this->load->view('system_path/admin/common/footer'); // footer & script link
                $this->load->view('system_path/jsquery'); // footer & script link
            }     
       
       // $data['studentnumber'] = $this->StudentModleAdmin->getstudentnumber($data);
 
        }
            
    }
    public function searchstudentnumberbyid(){  
        
            $data = $this->input->post('data', TRUE);
            $data['studentinfo'] = getstudentNameInfo($data['studentId']);
                if (!empty($data['studentinfo'])) {
                    $this->load->view('templates/admin/common/header');
                    $this->load->view('templates/admin/sendsms/tostudent', $data);          
                    $this->load->view('templates/admin/common/footer');
                } else {
                    $sdata['message'] = 'Inserted Student ID is invalid';
                    $this->session->set_userdata($sdata);
                    $data['title2']="Send SMS to Student";
                    $this->load->view('templates/admin/common/header');
                    $this->load->view('templates/admin/sendsms/student', $data);
                    $this->load->view('templates/admin/common/footer');
                }
           
    }
    public function searchemployeenumber(){
        
        
        $data = $this->input->post('data', TRUE);
        //print_r($data); die();
       $data['employeenumber'] = $this->EmployeeModleAdmin->getemployeedatasms($data);
     //  $data['employeenumber'] = $this->EmployeeModleAdmin->getemployeenumber($data);
     if(!empty($data['employeenumber'])){
         
   
      //  print_r($data); die();
        $data['sendsms'] = 'active';
//       print_r($data);exit;
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu'); // top bar menu
        $this->load->view('system_path/admin/sendsms/toemployee', $data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
    }
    else{
         $sdata = array();
            $sdata['errormessage'] = 'Information Not Found!';
            $this->session->set_userdata($sdata);
           redirect(admin_Url()."/sendsms");
    }
    }
    
     public function toemployee(){
        if (!empty($_POST['employeeId'])) {
         
       //    $data['employeeId']=$_POST['employeeId'];
           $data['employeeId'] = $this->input->post('employeeId');
           // echo '<pre>';
           // print_r($data['employeeId']);
           // exit;
    //      $data['employeenumber'] = $this->EmployeeModleAdmin->selectemployeenumber($data);
    //  print_r($data['employeenumber']); die();
            $data['sendsms'] = 'active';
            $this->load->view('system_path/admin/common/header_link'); // header Css link
            $this->load->view('system_path/admin/common/header'); // body header
            $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
            $this->load->view('system_path/admin/common/top_menu'); // top bar menu
            $this->load->view('system_path/admin/sendsms/sendsmstoemployee', $data); // ...........body content page...........
            $this->load->view('system_path/admin/common/footer'); // footer & script link
            $this->load->view('system_path/jsquery'); // footer & script link
        } else {
            $sdata = array();
            $sdata['message'] = 'Select any employee!';
            $this->session->set_userdata($sdata);
           redirect(admin_Url()."/sendsms");
        }
    }
    public function tostudent(){
        
        if (!empty($_POST['studentId'])) {
             $data['sendsms'] = 'active';
             $data['sessionId'] = $_POST['sessionId'];
            // echo '<pre>';print_r($_POST);exit;
            $this->load->view('system_path/admin/common/header_link'); // header Css link
            $this->load->view('system_path/admin/common/header'); // body header
            $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
            $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
            $this->load->view('system_path/admin/sendsms/sendsmstostudent', $data); // ...........body content page...........
            $this->load->view('system_path/admin/common/footer'); // footer & script link
            $this->load->view('system_path/jsquery'); // footer & script link
        } else {
            $sdata = array();
            $sdata['errormessage'] = 'Select any Student!';
            $this->session->set_userdata($sdata);
            redirect(admin_Url()."/sendsms");
        }
    }

    public function send_sms_to_parents()
    {

        //old
        $username = '01612302124';
        $password = 'ABCDabcd1234';
        //$from = '+8801922626122';
         $from = 'Friend';
        $SMSText = 'Ok Its working great';
        //$SMSText=urlencode($SMSText);
        $GSM='8801820028799,8801999928721';
        $type='longSMS';
        //$url = "http://api.zaman-it.com/api/sendsms/plain?user=01612302124&password=ABCDabcd1234&sender=Friend&SMSText=$message&GSM=8801820028799";
        


        $aimsurl='';
        $urlL = "http://api.zaman-it.com/api/v3/sendsms/plain?";
        $aimsurl.= '&user='.$username;
        $aimsurl.= '&password='.$password;
        $aimsurl.= '&sender='.$from;
        $aimsurl.= '&SMSText='.urlencode($SMSText);
        $aimsurl.= '&GSM='.urlencode($GSM);
        $aimsurl.= '&type='.urlencode($type);
        $urlFinal =  $urlL.$aimsurl;

        $url=$urlFinal;

        // echo $url;
        // exit;





        //$url="http://api.zaman-it.com/api/v3/sendsms/plain?user=01612302124&password=ABCDabcd1234&sender=Friend&SMSText=longsms&GSM=$GSM&type=longSMS";

        // echo $url;
        // exit;

        $authorization = base64_encode("$username:$password");
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            //CURLOPT_POSTFIELDS => "{ 'messages':[ { 'from':'$from', 'to':[ '$from' ], 'text':'I Love You :* Call Me : 01734333992 Personal'] }",
            CURLOPT_HTTPHEADER => array(
                "accept: application/json",
                "authorization: Basic $authorization",
                "content-type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        // echo '<pre>';
        // print_r($response);
        // exit;
        $err = curl_error($curl);
        curl_close($curl);

        if ($err)
        {
            echo 'not ok';
            echo "cURL Error #:" . $err;
            exit;
        }
        else
        {
            echo 'ok response';
            echo $response;
            exit;
        }
    }
    
    
    //Send SMS to Finger Print 
    
    public function tofingerprintstudent(){
        
        if (empty($_POST['studentId'])) {
             $data['sendsms'] = 'active';

            $this->load->view('system_path/admin/common/header_link'); // header Css link
            $this->load->view('system_path/admin/common/header'); // body header
            $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
            $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
            $this->load->view('system_path/admin/sendsms/sendfingerprintstudent', $data); // ...........body content page...........
            $this->load->view('system_path/admin/common/footer'); // footer & script link
            $this->load->view('system_path/jsquery'); // footer & script link
        } else {
            $sdata = array();
            $sdata['errormessage'] = 'Select any Student!';
            $this->session->set_userdata($sdata);
            redirect(admin_Url()."/sendsms");
        }
    }
    
    
    
    
    public function sendmultiplesms(){

       echo "hello";
       
        redirect('https://api.mobireach.com.bd/SendTextMessage');

    }
    
    
    public function sendstudentsmsrequest(){

     //   echo "hello";
        $data['To'] = $this->input->post('To');
        

            $ar = array();
            $ar = $data['To'];
            for ($i = 0; $i < count($ar); $i++) {
                $cat = $ar[$i];
                $To = $cat;
                $data['Username'] = $this->input->post('Username', TRUE);
                $data['Password'] = $this->input->post('Password', true);
                $data['From'] = $this->input->post('From', true);
                
                
                redirect('https://api.mobireach.com.bd/SendTextMessage');
            }
            $sdata = array();
            $sdata['message'] = 'Sms Send Successfully';
            $this->session->set_userdata($sdata);
            redirect('admin/sendsms', 'refresh'); 
    }
    
    
    
    public function sendbyattendance(){
        
        
          $data = $this->input->post('data', TRUE);
     
             $data['studentlist'] = $this->StudentattendanceModleAdmin->getstudentattendancesms($data);
      //    print_r($dataa); die();
      // $id= $dataa['studentId'];
           // $data['studentinfo'] = $this->StudentModleAdmin->getstudentNameInfo($data['studentId']);
        //    $data['studentlist'] = $this->StudentModleAdmin->getstudentNameInfo($id);
        //    print_r($data['studentlist']); die();
            if (!empty($data['studentlist']))
            {
        
            
               $data['Attendance'] = 'active';
              $this->load->view('system_path/admin/common/header_link'); // header Css link
              $this->load->view('system_path/admin/common/header'); // body header
              $this->load->view('system_path/admin/common/side_menu'); // side bar menu
              $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
              $this->load->view('system_path/admin/sendsms/tostudent', $data); // ...........body content page...........
              $this->load->view('system_path/admin/common/footer'); // footer & script link
              $this->load->view('system_path/jsquery'); // footer & script link
            }
            else {

              $sdata['errormessage'] = 'Attendance Information Not Found';
              $this->session->set_userdata($sdata);
               redirect(admin_Url()."/sendsms");
            }
           
        
        
    }




    //put your code here
}
