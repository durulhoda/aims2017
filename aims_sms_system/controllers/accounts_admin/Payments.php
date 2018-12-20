<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */


class Payments extends MY_Controller {
    
    
     public function __construct() {
        parent::__construct();
       $this->account_access();
       $this->load->model('admin/fees/FeesModleAdmin', 'FeesModleAdmin');
        $this->load->model('admin/payments/PaymentsModleAdmin', 'PaymentsModleAdmin');

        $this->load->model('admin/student/StudentModleAdmin', 'StudentModleAdmin');
    }
    
    public function index(){
                        $data['stupayment']='active';       
                        $this->load->view('system_path/accounts/common/header_link'); // header Css link
                        $this->load->view('system_path/accounts/common/header'); // body header
                        $this->load->view('system_path/accounts/common/side_menu'); // side bar menu
                        $this->load->view('system_path/accounts/common/top_menu', $data); // top bar menu
                        $this->load->view('system_path/accounts/payment/due/duelist', $data); // ...........body content page...........
                        $this->load->view('system_path/accounts/common/footer'); // footer & script link
    }
    
   public function duesearch() {

        $data = $this->input->post('data', TRUE);
        if (!empty($data['studentId'])) {
            
            $data['info'] = $this->StudentModleAdmin->getstudentBasicInfo($data['studentId']);
            if (!empty($data['info'])) {
                $data['feeslist'] = $this->FeesModleAdmin->searchfeeslist_byquata($data['info']);
                $data['finelist'] = $this->PaymentsModleAdmin->searchfinelist($data['info']);
                $data['totalfees'] = $this->FeesModleAdmin->totalamount($data['info']);
                $data['totalamount'] = $this->PaymentsModleAdmin->totalpaidamount($data['info']);
              //  $data['studentlist'] = $this->StudentModleAdmin->getstudentNameInfo($data['studentId']);
                $data['stupayment']='active';       
                $this->load->view('system_path/accounts/common/header_link'); // header Css link
                $this->load->view('system_path/accounts/common/header'); // body header
                $this->load->view('system_path/accounts/common/side_menu'); // side bar menu
                $this->load->view('system_path/accounts/common/top_menu', $data); // top bar menu
                $this->load->view('system_path/accounts/payment/due/duelist', $data); // ...........body content page...........
                $this->load->view('system_path/accounts/common/footer'); // footer & script link
            }
            else{
                 $sdata['message'] = 'No Result Found..!!';
                $this->session->set_userdata($sdata);

                redirect(acc_Url() . "/payments");
            }
        } else {

            $sdata['message'] = 'You have to insert Student Id..';
            $this->session->set_userdata($sdata);

            redirect('admin/payments', 'refresh');
        }
    }
    
    public function studentfine(){
        $this->load->library('form_validation');
        $data['stupayment']='active';       
        $this->load->view('system_path/accounts/common/header_link'); // header Css link
        $this->load->view('system_path/accounts/common/header'); // body header
        $this->load->view('system_path/accounts/common/side_menu'); // side bar menu
        $this->load->view('system_path/accounts/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/accounts/payment/fineadd/index', $data); // ...........body content page...........
        $this->load->view('system_path/accounts/common/footer'); // footer & script link
 
    }
    
     public function insertfine() {
        // print_r($_POST);

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

//        FORM VALIDADION

        $config = array(
            array(
                'field' => 'data[studentId]',
                'label' => 'Student Id',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[finehead]',
                'label' => 'Fine Cause',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[amount]',
                'label' => 'Amount',
                'rules' => 'required'
            )
        );

        $this->form_validation->set_rules($config);


        if ($this->form_validation->run() == FALSE) {
                 redirect(acc_Url() . "/payments/studentfine");
          
        } else {
            $data = $this->input->post('data', TRUE);
            $data['date']=date('d-m-Y');
            
            $result= $this->PaymentsModleAdmin->duplicateStudentFine($data);
            $result2= $this->StudentModleAdmin->CheckStudentId($data);
            
            if($result){
                
               $sdata['errormessage'] = 'Duplicate Entry Found..';
                $this->session->set_userdata($sdata);

                 redirect(acc_Url() . "/payments/studentfine");   
            }
            elseif(!$result2){
                $sdata['errormessage'] = 'Student ID invalid..';
                $this->session->set_userdata($sdata);
                redirect(acc_Url() . "/payments/studentfine"); 
                
            }
            else{
                $this->PaymentsModleAdmin->addStudentFine($data);

                $sdata['message'] = 'Fine added..';
                $this->session->set_userdata($sdata);

                  redirect(acc_Url() . "/payments/studentfine");
            }
        }
    }
    
    public function searchfine() {

        $data = $this->input->post('data', TRUE);
        if (!empty($data['studentId'])) {
                      
            $data['finelist'] = $this->PaymentsModleAdmin->searchfinelist($data);
            
            $data['totalamount'] = $this->PaymentsModleAdmin->totalfineamount($data);          
                        $data['stupayment']='active';       
                        $this->load->view('system_path/accounts/common/header_link'); // header Css link
                        $this->load->view('system_path/accounts/common/header'); // body header
                        $this->load->view('system_path/accounts/common/side_menu'); // side bar menu
                        $this->load->view('system_path/accounts/common/top_menu', $data); // top bar menu
                        $this->load->view('system_path/accounts/payment/fineadd/finelist', $data); // ...........body content page...........
                        $this->load->view('system_path/accounts/common/footer'); // footer & script link
           
        } else {

            $sdata['message'] = 'You have to insert Student Id..';
            $this->session->set_userdata($sdata);

            redirect(acc_Url() . "/payments/studentfine");
        }
    }

    public function studentdiscount(){
                        $data['stupayment']='active';       
                        $this->load->view('system_path/accounts/common/header_link'); // header Css link
                        $this->load->view('system_path/accounts/common/header'); // body header
                        $this->load->view('system_path/accounts/common/side_menu'); // side bar menu
                        $this->load->view('system_path/accounts/common/top_menu', $data); // top bar menu
                        $this->load->view('system_path/accounts/payment/studentdicount/index', $data); // ...........body content page...........
                        $this->load->view('system_path/accounts/common/footer'); // footer & script link
    }
    
     public function searchpaymentinfo() {

        $data = $this->input->post('data', TRUE);
        if (!empty($data['studentId'])) {

           $data['info'] = $this->StudentModleAdmin->getstudentBasicInfo($data['studentId']);
            if (!empty($data['info'])) {
            
                $data['feeslist'] = $this->FeesModleAdmin->searchfeeslist_byquata($data['info']);
                $data['discountlist'] = $this->PaymentsModleAdmin->searchdiscountlist($data['info']);
               // $data['studentlist'] = $this->StudentModleAdmin->getstudentNameInfo($data['studentId']);
                if ($data['feeslist']) {
                 
                  //  redirect(acc_Url() . "/payments/studentdiscount");
                    
                $data['stupayment']='active';       
                $this->load->view('system_path/accounts/common/header_link'); // header Css link
                $this->load->view('system_path/accounts/common/header'); // body header
                $this->load->view('system_path/accounts/common/side_menu'); // side bar menu
                $this->load->view('system_path/accounts/common/top_menu', $data); // top bar menu
                $this->load->view('system_path/accounts/payment/studentdicount/index', $data); // ...........body content page...........
                $this->load->view('system_path/accounts/common/footer'); // footer & script link
                } else {

                    $sdata['errormessage'] = 'Payment Details is not avaiable for this Student yet..';
                    $this->session->set_userdata($sdata);
                    redirect(acc_Url() . "/payments/studentdiscount");
                }
            }
            else{
                $sdata['errormessage'] = 'Invalid Student ID..!!';
                $this->session->set_userdata($sdata);
                redirect(acc_Url() . "/payments/studentdiscount");
            }
           
        }
         else {

                $sdata['errormessage'] = 'You have to insert Student Id..';
                $this->session->set_userdata($sdata);

                redirect('admin/payments/studentdiscount', 'refresh');
            }
    }
    
    public function insertDiscount() {

        if (!empty($_POST['headId'])) {
            $headId= $this->input->post('headId');
            $studentId = $this->input->post('studentId', TRUE);
            $headAmount = $this->input->post('headAmount', true);
            $discount = $this->input->post('discount', true);
            $amount= $this->input->post('amount', true);
            $date=date('d-m-Y');
            
         //   echo count($headId);die();
            for ($i = 0; $i < count($headId); $i++) {
                $data = array(
                    'headId' => $headId[$i],
                    'studentId' => $studentId,
                    'headAmount' => $headAmount[$i],
                    'discount' => $discount[$i],
                    'amount' => $amount[$i],
                    'date' => $date
                    
                    );
              $this->PaymentsModleAdmin->addDiscount($data);           
        }
                $sdata['message'] = 'Discount Added';
                $this->session->set_userdata($sdata);

                redirect(acc_Url() . "/payments/studentdiscount");
    }
    else{
        $sdata['errormessage'] = 'Discount Value Missing';
        $this->session->set_userdata($sdata);
        redirect(acc_Url() . "/payments/studentdiscount");
    }
    
  }
    
    //put your code here
}


