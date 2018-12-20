<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */

class student_payment extends MY_Controller {

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
        $this->load->view('system_path/admin/payment/student_payment/index', $data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
    }

    private function getStudentInfo($data = [])
    {
        $records = $this->db
                    ->select('
                        ps.studentId,
                        ps.roll_no,
                        po.*,
                        sinfo.firstName
                        ')
                    ->from('promotedstudent AS ps')
                    ->join('programoffer AS po', 'ps.programOfferId = po.programOfferId')
                    ->join('student AS s', 'ps.promotionId = s.promotionId')
                    ->join('studentinfo AS sinfo', 's.applicationId = sinfo.applicationId')
                    ->where('ps.studentId', $data['studentId'])
                    ->where('po.sessionId', $data['sessionId'])
                    ->order_by('ps.promotionId', 'desc')
                    ->get()
                    ->row();
        return $records;
    }

    public function getDiscountInfo()
    {
        $amount = 0;
        $id = $this->input->post('id', TRUE);
        $total_amount = $this->input->post('total_amount', TRUE);

        $record = $this->db->where('id', $id)->get('student_discounts')->row();
        if ($record) {
            $amount = $record->amount;
            if ($record->type == 1) {
                $amount = (($total_amount * $record->amount)/100);
            }
        }
        echo round($amount);
        exit;
    }

    private function getHeadList($programOfferId = 0)
    {
        $records = $this->db
                    ->select('
                        ph.headId,
                        ph.headName,
                        f.amount
                        ')
                    ->from('paymenthead AS ph')
                    ->join('fees AS f', 'f.headId = ph.headId')
                    ->where('ph.is_deleted', 0)
                    ->where('f.is_deleted', 0)
                    ->where('f.programOfferId', $programOfferId)
                    ->get()
                    ->result();
        return $records;
    }

    public function checkHeadInfo()
    {
        $is_month = false;
        $id = $this->input->post('id', TRUE);
        if ($id) {
            $record = $this->db->where('headId', $id)->get('paymenthead')->row();
            if ($record) {
                $is_month = ($record->is_month == 1) ? true : false;
            }
        }
        echo $is_month;
        exit;
    }

    public function searchpaymentinfo() {

        $data = $this->input->post('data', TRUE);
       // print_r($data);exit;
   
        if (!empty($data['studentId']) && $data['sessionId']) {
            $data['student_info'] = $this->getStudentInfo($data);
           //echo '<pre>';print_r($data);exit;
            if ($data['student_info']) {   
                $programOfferId = ($data['student_info']->programOfferId) ? $data['student_info']->programOfferId : 0;
                $data['headlist'] = $this->getHeadList($programOfferId);  
                $data['discountlist'] = $this->getDiscountList();
                $data['programOfferId'] = $programOfferId;
      
                $this->load->view('system_path/admin/common/header_link'); // header Css link
                $this->load->view('system_path/admin/common/header'); // body header
                $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                $this->load->view('system_path/admin/payment/student_payment/paymentinfo', $data); // ...........body content page...........
                $this->load->view('system_path/admin/common/footer'); // footer & script link
            } else {

                $sdata['errormessage'] = 'No Result Found';
                $this->session->set_userdata($sdata);
                redirect(admin_Url()."/student_payment");
            }
        } else {

            $sdata['errormessage'] = 'You have to insert Student Id & Session..';
            $this->session->set_userdata($sdata);

            redirect(admin_Url()."/student_payment");
        }
    }

    private function getDiscountList()
    {
        $records = $this->db->where('is_deleted', 0)->get('student_discounts')->result();
        return $records;
    }

    public function add()
    {
       // echo '<pre>';print_r($_POST);exit;
        $count = count($this->input->post('headId'));

        $mst_data = [
            'mr_no' => date('his'),
            'studentId' => $this->input->post('studentId'),
            'programOfferId' => $this->input->post('programOfferId'),
            'total_amount' => $this->input->post('total_amount'),
            'discount_id' => $this->input->post('discount_id'),
            'net_discount' => $this->input->post('net_discount'),
            'fine_id' => $this->input->post('fine_id'),
            'fine_amount' => $this->input->post('fine_amount'),
            'net_amount' => $this->input->post('net_amount')
        ];

        $this->db->insert('student_payment_mst',$mst_data);
        $id = $this->db->insert_id();

        $tran_data = [
            'mst_id' => $id,
            'payment_status' => 1,
            'paid_amount' => $this->input->post('paid_amount'),
            'payment_type' => $this->input->post('payment_type'),
            'mb_name' => $this->input->post('mb_name'),
            'at_no' => $this->input->post('at_no'),
            'created_by' => 1
        ];
        $this->db->insert('student_payment_transaction',$tran_data);

        for ($i = 0; $i < $count; $i++) {
            $dals_data = [
                'mst_id' => $id,
                'head_id' => $this->input->post('headId')[$i],
                'month_id' => $this->input->post('month_id')[$i],
                'amount' => $this->input->post('amount')[$i]
            ];
            $this->db->insert('student_payment_dtls',$dals_data);
        }

    }

    public function insertpaymentadd() {
   
     //


        
        
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

    //put your code here
}

