<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */

class Paymentadd extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->my_admin();
        $this->load->model('admin/fees/FeesModleAdmin', 'FeesModleAdmin');
        $this->load->model('admin/payments/PaymentsModleAdmin', 'PaymentsModleAdmin');
        $this->load->model('admin/hostelbedassign/HostelBedAssignModleAdmin', 'HostelBedAssignModleAdmin');
        $this->load->model('admin/program/ProgramModleAdmin', 'ProgramModleAdmin');
        $this->load->model('admin/student/StudentModleAdmin', 'StudentModleAdmin');
    }

    public function index() {
        $data['stupayment']='active';              
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/payment/addpayment/index', $data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
    }

    public function searchpaymentinfo() {

        $data = $this->input->post('data', TRUE);
       // print_r($data);exit;
   
        if (!empty($data['studentId']) && $data['sessionId']) {
            
            $data['test']=$this->PaymentsModleAdmin->getstus($data['studentId']);
            $countdata=count($data['test']);
                   //    echo ($countdata); die();
        
            $data['info'] = $this->StudentModleAdmin->getstudentBasicInfo($data['studentId'], $data['sessionId']);
            if (!empty($data['info'])) {                
                $progofferInfo=$this->ProgramModleAdmin->getofferProgramInfoById($data['info']['programOfferId']);
                $data['programOfferId'] = ($data['info']['programOfferId']) ? $data['info']['programOfferId'] : 0;
                $datas=array(
                   // 'campusId'=>$progofferInfo['campusId'],
                    'mediumId'=>$progofferInfo['mediumId'],
                    'programId'=>$progofferInfo['programId'],
                    'sessionId'=>$progofferInfo['sessionId'],
                    'groupId'=>$progofferInfo['groupId'],
                    'shiftId'=>$progofferInfo['shiftId']                    
                );
                
                $enrol = $this->ProgramModleAdmin->getValidateofferedprogram($datas);
                $enrol['quata_id']=$data['info']['quata_id'];
                $enrol['studentId'] = $data['studentId'];
               

                $data['finelist'] = $this->PaymentsModleAdmin->searchfinelist($data['info'], $data['programOfferId']);
                $data['finecauselist'] = $this->getFineCauseList();
               // echo '<pre>';print_r($data);exit;
                if ($countdata==1) {
                      $enrol['studentStatus']=$countdata;
             //   print_r($enrol); die();                
                $data['feeslist'] = $this->FeesModleAdmin->searchfeeslist_byquata($enrol);                
             //echo '<pre>'; print_r($data['feeslist']); die();
                    $data['stupayment']='active';       
                    $this->load->view('system_path/admin/common/header_link'); // header Css link
                    $this->load->view('system_path/admin/common/header'); // body header
                    $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                    $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                    $this->load->view('system_path/admin/payment/addpayment/paymentinfo', $data); // ...........body content page...........
                    $this->load->view('system_path/admin/common/footer'); // footer & script link
                } else {
                      $enrol['studentStatus']=$countdata;
             //   print_r($enrol); die();                
                $data['feeslist'] = $this->FeesModleAdmin->searchfeeslist_byquataa($enrol);                
           //   print_r($data['feeslist']); die();
                  $data['stupayment']='active';       
                    $this->load->view('system_path/admin/common/header_link'); // header Css link
                    $this->load->view('system_path/admin/common/header'); // body header
                    $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                    $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                    $this->load->view('system_path/admin/payment/addpayment/paymentinfo', $data); // ...........body content page...........
                    $this->load->view('system_path/admin/common/footer'); // footer & script link
                }
            } else {

                $sdata['errormessage'] = 'No Result Found';
                $this->session->set_userdata($sdata);
                redirect(admin_Url()."/paymentadd");
            }
        } else {

            $sdata['errormessage'] = 'You have to insert Student Id & Session..';
            $this->session->set_userdata($sdata);

            redirect(admin_Url()."/paymentadd");
        }
    }

     private function getFineCauseList()
    {
        $records = $this->db->get('fine_causes')->result();
        $arr = [];
        if ($records) {
            foreach ($records as $key => $val) {
                $arr[$val->id] = $val->name;
            }
        }
        return $arr;
    }

    public function insertpaymentadd() {
   
       
        //echo '<pre>';print_r($_POST);exit;
        
        if (!empty($_POST['headId'])) {

            $headId = $this->input->post('headId');
            $studentId = $this->input->post('studentId', TRUE);
            $programOfferId = $this->input->post('programOfferId', true);
            $sessionId = $this->input->post('sessionId', true);
            $paymentMethod = $this->input->post('paymentMethod', true);
            $bankName = $this->input->post('bankName', true);
            $chequeNumber = $this->input->post('chequeNumber', true);
            //$instituteCode = $this->input->post('instituteCode', true);
            $amount = $this->input->post('amount', true);
            $payment_status = $this->input->post('payment_status', true);
            $discount_id = $this->input->post('discount_id', true);

            for ($i = 0; $i < count($headId); $i++) {
                $data = array(
                    'headId' => $headId[$i],
                    'sessionId' => $sessionId[$i],
                    'studentId' => $studentId,
                    'programOfferId' => $programOfferId,
                    'paymentMethod' => $paymentMethod,
                    'bankName' => $bankName,
                    'chequeNumber' => $chequeNumber,
                    //'instituteCode' => $instituteCode,
                    'amount' => $amount[$i],
                    'payment_status' => $payment_status[$i],
                    'discount_id' => $discount_id[$i]
                    
                );
                
                $result = $this->PaymentsModleAdmin->duplicatePaymentInfo($data);
                if ($result) {
                    $sdata['errormessage'] = 'This Student Payment Already Confiremed.. ';
                    $this->session->set_userdata($sdata);

                   redirect(admin_Url() . "/paymentadd");
                } else {
               // $data['time'] = date('h:i:s', time());
                   // print_r($data); die();
                    $this->PaymentsModleAdmin->addpaymentInfo($data);
                }
            }
               // $dataa = $this->input->post('data', TRUE);
      //  print_r($data); die();
            $datas['headId'] = $headId;
            $datas['studentId'] = $studentId;
            $datas['programOfferId'] = $programOfferId;
            $datas['sessionId'] = $sessionId;
            $datas['amount'] = $amount; 

             //  print_r($datas); die();
          // $datas['paymentDate'] = date('Y-m-d');
         //   print_r($datas); die();

            $data['info'] = $this->StudentModleAdmin->getstudentNameInfo($studentId);  
            $data['programOfferId'] = $programOfferId;
             $data['finecauselist'] = $this->getFineCauseList();
          //  print_r($data); die();
            
            
             $data['feeslist'] = $this->FeesModleAdmin->searchfeeslist_byprintlist($data);
             $data['totalsum'] = $this->FeesModleAdmin->getsumvalue($data);
                   // print_r($data['feeslist']); die();
             $data['paymentlist'] = $this->PaymentsModleAdmin->searchpaymentlist($data['info']);
             $data['finelist'] = $this->PaymentsModleAdmin->searchfinelist($data);        
             $data['totalfees'] = $this->FeesModleAdmin->totalamount($data['info']);
             $data['totalamount'] = $this->PaymentsModleAdmin->totalpaidamount($data['info']);

              //echo '<pre>';print_r($data);exit;
             
            $data['stupayment']='active';       
            $this->load->view('system_path/admin/common/header_link'); // header Css link
            $this->load->view('system_path/admin/common/header'); // body header
            $this->load->view('system_path/admin/common/side_menu'); // side bar menu
            $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
            $this->load->view('system_path/admin/payment/addpayment/printpaymentlist', $data);  // ...........body content page...........
            $this->load->view('system_path/admin/common/footer'); // footer & script link 
//            $sdata['message'] = 'Your Payment Successfully Added.. ';
//                    $this->session->set_userdata($sdata);
//                     redirect(admin_Url() . "/paymentadd");
        }
        elseif (isset($_POST['print'])) {
            $this->load->view('system_path/admin/common/header_link'); // header Css link
            $this->load->view('system_path/admin/payment/addpayment/paymentlist', $data); // ...........body content page...........
            $this->load->view('system_path/admin/common/footer'); // footer & script link            
        }
        
        else {
            $sdata = array();
            $sdata['errormessage'] = 'Select Payment Category!';
            $this->session->set_userdata($sdata);
            redirect(admin_Url() . "/paymentadd");
        }
    }
    
    
    public function paymentaddsmallsize() {
 
        if (!empty($_POST['headId'])) {

            $headId = $this->input->post('headId');
            $studentId = $this->input->post('studentId', TRUE);
            $programOfferId = $this->input->post('programOfferId', true);
            $sessionId = $this->input->post('sessionId', true);
            $paymentMethod = $this->input->post('paymentMethod', true);
            $bankName = $this->input->post('bankName', true);
            $chequeNumber = $this->input->post('chequeNumber', true);
            //$instituteCode = $this->input->post('instituteCode', true);
            $amount = $this->input->post('amount', true);
            $date = date("d-m-Y");


            for ($i = 0; $i < count($headId); $i++) {
                $data = array(
                    'headId' => $headId[$i],
                    'sessionId' => $sessionId[$i],
                    'studentId' => $studentId,
                    'programOfferId' => $programOfferId,
                    'paymentMethod' => $paymentMethod,
                    'bankName' => $bankName,
                    'chequeNumber' => $chequeNumber,
                    //'instituteCode' => $instituteCode,
                    'amount' => $amount[$i],
                    'paymentDate' => $date
                    
                );
                
                $result = $this->PaymentsModleAdmin->duplicatePaymentInfo($data);
                if ($result) {
                    $sdata['errormessage'] = 'This Student Payment Already Confiremed.. ';
                    $this->session->set_userdata($sdata);

                   redirect(admin_Url() . "/paymentadd");
                } else {
                $data['time'] = date('h:i:s', time());
                   // print_r($data); die();
                    $this->PaymentsModleAdmin->addpaymentInfo($data);
                }
            }
               // $dataa = $this->input->post('data', TRUE);
      //  print_r($data); die();
            $datas['headId'] = $headId;
            $datas['studentId'] = $studentId;
            $datas['programOfferId'] = $programOfferId;
            $datas['sessionId'] = $sessionId;
            $datas['amount'] = $amount; 
             //  print_r($datas); die();
            $datas['paymentDate'] = $date;
         //   print_r($datas); die();

            $data['info'] = $this->StudentModleAdmin->getstudentNameInfo($studentId);  
          //  print_r($data); die();
            
            
             $data['feeslist'] = $this->FeesModleAdmin->searchfeeslist_byprintlist($data);
             $data['totalsum'] = $this->FeesModleAdmin->getsumvalue($data);
                   // print_r($data['feeslist']); die();
             $data['paymentlist'] = $this->PaymentsModleAdmin->searchpaymentlist($data['info']);
             $data['finelist'] = $this->PaymentsModleAdmin->searchfinelist($data);        
             $data['totalfees'] = $this->FeesModleAdmin->totalamount($data['info']);
             $data['totalamount'] = $this->PaymentsModleAdmin->totalpaidamount($data['info']);
             
            $data['stupayment']='active';       
            $this->load->view('system_path/admin/common/header_link'); // header Css link
            $this->load->view('system_path/admin/common/header'); // body header
            $this->load->view('system_path/admin/common/side_menu'); // side bar menu
            $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
            $this->load->view('system_path/admin/payment/addpayment/printpaymentlist', $data,$headId,$studentId,$programOfferId,$sessionId,$paymentMethod,$bankName,$chequeNumber,$amount,$date);  // ...........body content page...........
            $this->load->view('system_path/admin/common/footer'); // footer & script link 
//            $sdata['message'] = 'Your Payment Successfully Added.. ';
//                    $this->session->set_userdata($sdata);
//                     redirect(admin_Url() . "/paymentadd");
        }
        elseif (isset($_POST['print'])) {
            $this->load->view('system_path/admin/common/header_link'); // header Css link
            $this->load->view('system_path/admin/payment/addpayment/paymentlist', $data); // ...........body content page...........
            $this->load->view('system_path/admin/common/footer'); // footer & script link            
        }
        
        else {
            $sdata = array();
            $sdata['errormessage'] = 'Select Payment Category!';
            $this->session->set_userdata($sdata);
            redirect(admin_Url() . "/paymentadd");
        }
    }
    
    
        public function paymentlistprint() {

        $data = $this->input->post('data', TRUE);
        if (!empty($data['studentId'])) {

            $data['info'] = $this->StudentModleAdmin->getstudentBasicInfo($data['studentId']);
           
                if (!empty($data['info'])) {
                    $data['feeslist'] = $this->FeesModleAdmin->searchfeeslist_byquata($data['info']);
                   // print_r($data['feeslist']); die();
                    $data['paymentlist'] = $this->PaymentsModleAdmin->searchpaymentlist($data['info']);
                    $data['finelist'] = $this->PaymentsModleAdmin->searchfinelist($data);
                    $data['studentlist'] = $this->StudentModleAdmin->getstudentNameInfo($data['studentId']);
                $data['totalfees'] = $this->FeesModleAdmin->totalamount($data['info']);

                    $data['totalamount'] = $this->PaymentsModleAdmin->totalpaidamount($data['info']);
                    //     print_r($data['feeslist']); die();
                  
                        $data['stupayment']='active';       
                        $this->load->view('system_path/admin/common/header_link'); // header Css link
                        $this->load->view('system_path/admin/common/header'); // body header
                        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                        $this->load->view('system_path/admin/payment/paymenthistory/paymentlist', $data); // ...........body content page...........
                        $this->load->view('system_path/admin/common/footer'); // footer & script link
                } else {
                    $sdata['message'] = 'Payment Details is not avaiable for this Student..';
                    $this->session->set_userdata($sdata);

                    redirect(admin_Url() . "/paymentadd/paymentlist");
            }
            
        } else {

            $sdata['message'] = 'You have to insert Student Id..';
            $this->session->set_userdata($sdata);

            redirect('admin/paymentadd/paymentlist', 'refresh');
        }
    }
    
    
    
    
    
    
    
    
    
    
    

    public function paymentlist() {

        $data['stupayment']='active';       
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/payment/paymenthistory/index', $data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
    }

    public function searchpaymentlist() {

        $data = $this->input->post('data', TRUE);
        if (!empty($data['studentId'] && $data['sessionId'])) {

            $data['info'] = $this->StudentModleAdmin->getstudentBasicInfo($data['studentId'], $data['sessionId']);
           
                if (!empty($data['info'])) {
                    $data['feeslist'] = $this->FeesModleAdmin->searchfeeslist_byquata($data['info']);
                   // print_r($data['feeslist']); die();
                    $data['finecauselist'] = $this->getFineCauseList();
                    $data['programOfferId'] = isset($data['info']['programOfferId']) ? $data['info']['programOfferId'] : 0;
                    $data['paymentlist'] = $this->PaymentsModleAdmin->searchpaymentlist($data['info']);
                    $data['finelist'] = $this->PaymentsModleAdmin->searchfinelist($data, $data['programOfferId']);
                    $data['studentlist'] = $this->StudentModleAdmin->getstudentNameInfo($data['studentId']);
                    $data['totalfees'] = $this->FeesModleAdmin->totalamount($data['info']);
                
                    $data['tot_discount'] = $this->getStudentDiscount($data['studentId'], $data['programOfferId']);
                    $data['totalamount'] = $this->PaymentsModleAdmin->totalpaidamount($data['info']);
                   
                    
                   //echo '<pre>';    print_r($data); die();
                        $data['stupayment']='active';       
                        $this->load->view('system_path/admin/common/header_link'); // header Css link
                        $this->load->view('system_path/admin/common/header'); // body header
                        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                        $this->load->view('system_path/admin/payment/paymenthistory/paymentlist', $data); // ...........body content page...........
                        $this->load->view('system_path/admin/common/footer'); // footer & script link
                } else {
                    $sdata['message'] = 'Payment Details is not avaiable for this Student..';
                    $this->session->set_userdata($sdata);

                    redirect(admin_Url() . "/paymentadd/paymentlist");
            }
            
        } else {

            $sdata['message'] = 'You have to insert Student Id..';
            $this->session->set_userdata($sdata);

            redirect('admin/paymentadd/paymentlist', 'refresh');
        }
    }

    private function getStudentDiscount($studentId = 0, $programOfferId = 0)
    {
        $total_discount = 0;
        $records = $this->db
                        ->select('
                                (SUM(headAmount) - SUM(amount)) AS discount_amount
                            ')
                        ->where('studentId', $studentId)
                        ->where('programOfferId', $programOfferId)
                        ->get('studentdiscount')
                        ->row();
        if ($records) {
            $total_discount = $records->discount_amount;
        }
        return $total_discount;
    }

    //put your code here
}

