<?php

/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class Payment extends MY_Controller{
    public function __construct() {
        parent::__construct();
        $this->student_logged_auth();
         $this->load->model('admin/fees/FeesModleAdmin', 'FeesModleAdmin');
        $this->load->model('admin/payments/PaymentsModleAdmin', 'PaymentsModleAdmin');
         $this->load->model('admin/student/StudentModleAdmin', 'StudentModleAdmin');
    }

    
    public function iiindex(){
 $data['payment']='active';
           $this->load->view('system_path/student/common/header_link'); // header Css link
           $this->load->view('system_path/student/common/header'); // body header
           $this->load->view('system_path/student/common/side_menu', $data); // side bar menu
           $this->load->view('system_path/student/payment/index', $data); // ...........body content page...........
           $this->load->view('system_path/student/common/footer'); // footer & script link
        
    }
    
     public function index() {

       // $data = $this->input->post('data', TRUE);
        $data['studentId']=$this->session->userdata('studentId');
        if (!empty($data['studentId'])) {
             $data['info'] = $this->StudentModleAdmin->getstudentNameInfo($data['studentId']);
      
                if (!empty($data['info'])) {
                    $data['feeslist'] = $this->FeesModleAdmin->searchfeeslist($data['info']);
                   // print_r($data['feeslist']); die();
                    
                    $data['paymentlist'] = $this->PaymentsModleAdmin->searchpaymentlist($data['info']);
                    $data['finelist'] = $this->PaymentsModleAdmin->searchfinelist($data);
                    $data['totalfees'] = $this->FeesModleAdmin->totalamount($data['info']);
                    $data['totalamount'] = $this->PaymentsModleAdmin->totalpaidamount($data['info']);

           //    print_r($data); die();
                 $data['payment']='active';
                   $this->load->view('system_path/student/common/header_link'); // header Css link
                   $this->load->view('system_path/student/common/header'); // body header
                   $this->load->view('system_path/student/common/side_menu', $data); // side bar menu
                   $this->load->view('system_path/student/payment/index', $data); // ...........body content page...........
                   $this->load->view('system_path/student/common/footer'); // footer & script link
            }
            else{
        $sdata['errormessage'] = 'Payment Details is not avaiable for this Student..';
        $this->session->set_userdata($sdata);
           $data['payment']='active';
           $this->load->view('system_path/student/common/header_link'); // header Css link
           $this->load->view('system_path/student/common/header'); // body header
           $this->load->view('system_path/student/common/side_menu', $data); // side bar menu
           $this->load->view('system_path/student/payment/index', $data); // ...........body content page...........
           $this->load->view('system_path/student/common/footer'); // footer & script link
            }
            
        } else {
            redirect(base_url());
        }
    }
    //put your code here
}


