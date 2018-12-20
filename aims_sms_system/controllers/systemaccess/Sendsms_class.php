<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */


class sendsms_class extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->my_admin();
        $this->load->model('admin/student/StudentModleAdmin', 'StudentModleAdmin');
        $this->load->model('admin/employee/EmployeeModleAdmin', 'EmployeeModleAdmin');
        $this->load->model('admin/studentattendance/StudentattendanceModleAdmin', 'StudentattendanceModleAdmin');
    }


    public function index() {

        $data=array();
        $data['sendsms_class']='active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu',$data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu'); // top bar menu
        $this->load->view('system_path/admin/sendsms_class/student',$data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
    }

    public function searchstudentnumber(){

        echo '<pre>';
        print_r($_POST);exit;

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
            $data['sendsms_class'] = 'active';
            $data['title2']="Send SMS to Student";
            $this->load->view('system_path/admin/common/header_link'); // header Css link
            $this->load->view('system_path/admin/common/header'); // body header
            $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
            $this->load->view('system_path/admin/common/top_menu'); // top bar menu
            $this->load->view('system_path/admin/sendsms_class/student', $data); // ...........body content page...........
            $this->load->view('system_path/admin/common/footer'); // footer & script link
            $this->load->view('system_path/jsquery'); // footer & script link
        } else {
            $data = $this->input->post('data', TRUE);
            //  print_r($data); die();
            $data['sendsms_class']='active';
            $data['programOfferId'] = getProgramOfferId($data);

//            echo '<pre>';
//            print_r($data);exit;

            if (!empty($data['programOfferId'])) {

            //$data['studentlist'] = $this->StudentModleAdmin->searchRegisteredStudentId($data);

            $data['studentlist'][0]['firstName']='Imtiaz';
            $data['studentlist'][0]['lastName']='Hasan';
            $data['studentlist'][0]['instituteName']='Khulna Zilla School';
            $data['studentlist'][0]['town']='Khulna';
            $data['studentlist'][0]['city']='Khulna';
            $data['studentlist'][0]['fatherPhone']='01922626199';
            $data['studentlist'][0]['studentId']='82938283';


//            print_r($data['studentlist']); die();
            if (!empty($data['studentlist'])) {



//                foreach($data['studentlist'] as $item)
//                {
//                    if($item['fatherPhone'])
//                    {
//                        $f_n='';
//                        $m_n='';
//                        $l_n='';
//                        $student_name='';
//                        if($item['firstName'])
//                        {
//                            $f_n=$item['firstName'];
//                        }
//                        if($item['middleName'])
//                        {
//                            $m_n=' '.$item['middleName'];
//                        }
//                        if($item['lastName'])
//                        {
//                            $l_n=' '.$item['lastName'];
//                        }
//                        $student_name = $f_n.$m_n.$l_n;
//                        $institute_name = $item['instituteName'].', '.$item['town'].', '.$item['city'];
//                        $user_name = $item['studentId'];
//                        $link = base_url().'e_student/login';
//
//
//                        $url = "https://api.mobireach.com.bd/SendTextMultiMessage";
//                        $parameter = array(
//                            'Username' => 'advsoft',
//                            'Password' => 'Fima@302124',
//                            'From' => '8801847050122',
//                            'Message' => "Link : $link, Student Name : $student_name, Username : $user_name, Password : 123456, Institute : $institute_name",
//                            'To' => $item['fatherPhone']
//                        );
//                        $context = stream_context_create(array(
//                            'http' => array(
//                                'method' => 'POST',
//                                'header' => 'Content-type: application/x-www-form-urlencoded\r\n',
//                                'header' => "Cache-Control: no-cache, no-store, must-revalidate",
//                                'header' => "Pragma: no-cache",
//                                'header' => "Expires: 0",
//                                'content' => http_build_query($parameter)
//                            )
//                        ));
//                        $resp = file_get_contents($url, FALSE, $context);
//                        if ($resp === FALSE)
//                        {
//                            var_dump($resp);
//                            exit;
//                        }
//                    }
//                }

                $sdata['message'] = 'Message Send Successfully';
                $this->session->set_userdata($sdata);
                $data['title2']="Send SMS to Student";
                $this->load->view('system_path/admin/common/header_link'); // header Css link
                $this->load->view('system_path/admin/common/header'); // body header
                $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
                $this->load->view('system_path/admin/common/top_menu'); // top bar menu
                $this->load->view('system_path/admin/sendsms_class/student', $data); // ...........body content page...........
                $this->load->view('system_path/admin/common/footer'); // footer & script link
                $this->load->view('system_path/jsquery'); // footer & script link


//                    $this->load->view('system_path/admin/common/header_link'); // header Css link
//                    $this->load->view('system_path/admin/common/header'); // body header
//                    $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
//                    $this->load->view('system_path/admin/common/top_menu'); // top bar menu
//                    $this->load->view('system_path/admin/sendsms_class/tostudent', $data); // ...........body content page...........
//                    $this->load->view('system_path/admin/common/footer'); // footer & script link
//                    $this->load->view('system_path/jsquery'); // footer & script link

                } else {
                    $sdata['message'] = 'No student found inserted enrollment information';
                    $this->session->set_userdata($sdata);
                    $data['title2']="Send SMS to Student";
                    $this->load->view('system_path/admin/common/header_link'); // header Css link
                    $this->load->view('system_path/admin/common/header'); // body header
                    $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
                    $this->load->view('system_path/admin/common/top_menu'); // top bar menu
                    $this->load->view('system_path/admin/sendsms_class/student', $data); // ...........body content page...........
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
                $this->load->view('system_path/admin/sendsms_class/student', $data); // ...........body content page...........
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
//             echo '<pre>';print_r($data);exit;
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

    public function kk()
    {
        if ($_POST){
            echo 'hi';
            echo '<pre>';print_r($_POST);exit;
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
        else
        {
            $sdata['errormessage'] = 'Attendance Information Not Found';
            $this->session->set_userdata($sdata);
            redirect(admin_Url()."/sendsms");
        }
    }

    public function get_student_info_for_sms()
    {
        $ajax=array();
        $data['programOfferId']['programOfferId']='';
        $data=$this->input->post('data');
        if(!$data['sessionId'])
        {
            $ajax['status']='Failed';
            $ajax['message']='Error in Post';
            echo json_encode($ajax);exit;
        }
        if(!$data['programId'])
        {
            $ajax['status']='Failed';
            $ajax['message']='Error in Post';
            echo json_encode($ajax);exit;
        }
        if(!$data['mediumId'])
        {
            $ajax['status']='Failed';
            $ajax['message']='Error in Post';
            echo json_encode($ajax);exit;
        }
        if(!$data['groupId'])
        {
            $ajax['status']='Failed';
            $ajax['message']='Error in Post';
            echo json_encode($ajax);exit;
        }
        if(!$data['shiftId'])
        {
            $ajax['status']='Failed';
            $ajax['message']='Error in Post';
            echo json_encode($ajax);exit;
        }
        if(!$data['sectionId'])
        {
            $ajax['status']='Failed';
            $ajax['message']='Error in Post';
            echo json_encode($ajax);exit;
        }
        $data['programOfferId'] = getProgramOfferId($data);

        if(!$data['programOfferId']['programOfferId'])
        {
            $ajax['status']='Failed';
            $ajax['message']='Inserted Enrollment information is not offered yet!';
            echo json_encode($ajax);exit;
        }
        $data['student_ids'] = $this->StudentModleAdmin->searchRegisteredStudentId($data);
        if(!$data['student_ids'])
        {
            $ajax['status']='Failed';
            $ajax['message']='No student found inserted enrollment information';
            echo json_encode($ajax);exit;
        }
        $ajax['student_ids']='';
        $institute='';
        $town='';
        $city='';
        foreach($data['student_ids'] as $item)
        {
            $ajax['student_ids'] .= $item['fatherPhone'].',';
            $institute = $item['instituteName'];
            $town = $item['town'];
            $city = $item['city'];
        }

        $link = base_url().'e_student/login';
        $ajax['msg'] = "Link : $link, Username : Student's ID(eg. 2018....), Password : 123456, Institute : $institute, $town, $city";
        $ajax['status']='Success';
        echo json_encode($ajax);

    }









    //put your code here
}
