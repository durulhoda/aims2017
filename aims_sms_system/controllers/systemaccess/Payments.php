<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */


class Payments extends MY_Controller {
    
    
     public function __construct() {
        parent::__construct();
        $this->my_admin();
       $this->load->model('admin/fees/FeesModleAdmin', 'FeesModleAdmin');
        $this->load->model('admin/payments/PaymentsModleAdmin', 'PaymentsModleAdmin');

        $this->load->model('admin/student/StudentModleAdmin', 'StudentModleAdmin');
    }
    
    public function index(){
                        $data['stupayment']='active';       
                        $this->load->view('system_path/admin/common/header_link'); // header Css link
                        $this->load->view('system_path/admin/common/header'); // body header
                        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                        $this->load->view('system_path/admin/payment/due/duelist', $data); // ...........body content page...........
                        $this->load->view('system_path/admin/common/footer'); // footer & script link
    }
    
   public function duesearch() {

        $data = $this->input->post('data', TRUE);
        if (!empty($data['studentId'] && $data['sessionId'])) {
            
            $data['info'] = $this->StudentModleAdmin->getstudentBasicInfo($data['studentId'], $data['sessionId']);
            if (!empty($data['info'])) {
                $data['feeslist'] = $this->FeesModleAdmin->searchfeeslist_byquata($data['info']);
                $data['programOfferId'] = ($data['info']['programOfferId']) ? $data['info']['programOfferId'] : 0;
                $data['finecauselist'] = $this->getFineCauseList();
               // echo '<pre>';print_r($data);exit;
                $data['finelist'] = $this->PaymentsModleAdmin->searchfinelist($data['info'], $data['programOfferId']);
                $data['totalfees'] = $this->FeesModleAdmin->totalamount($data['info']);
                $data['totalamount'] = $this->PaymentsModleAdmin->totalpaidamount($data['info']);
                $data['tot_discount'] = $this->getStudentDiscount($data['studentId'], $data['programOfferId']);
              //  $data['studentlist'] = $this->StudentModleAdmin->getstudentNameInfo($data['studentId']);
                $data['stupayment']='active';       
                $this->load->view('system_path/admin/common/header_link'); // header Css link
                $this->load->view('system_path/admin/common/header'); // body header
                $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                $this->load->view('system_path/admin/payment/due/duelist', $data); // ...........body content page...........
                $this->load->view('system_path/admin/common/footer'); // footer & script link
            }
            else{
                 $sdata['message'] = 'No Result Found..!!';
                $this->session->set_userdata($sdata);

                redirect(admin_Url() . "/payments");
            }
        } else {

            $sdata['message'] = 'You have to insert Student Id..';
            $this->session->set_userdata($sdata);

            redirect('admin/payments', 'refresh');
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
    
    public function studentfine(){
        //$this->load->library('form_validation');
        $data['studentidlist'] = $this->getStudentIdList();
        $data['studentfinelist'] = $this->getStudentFineList();
        $data['finecauselist'] = $this->getFineCauseList();
        //echo '<pre>';print_r($data);exit;
        $data['stupayment']='active';       
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/payment/fineadd/index', $data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
 
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
        // echo '<pre>';print_r($arr);exit;
        // $records = [
        //     '1' => 'Late Present',
        //     '2' => 'Absent',
        //     '3' => 'Others'
        // ];
        return $arr;
        //echo '<pre>';print_r($records);exit;
    }

    private function getStudentFineList()
    {
        $records = $this->db
                        ->select('
                            sf.*,
                            p.programName, 
                            s.session,
                            g.groupName
                            ')
                        ->from('studentfine AS sf')
                        ->join('programoffer AS po', 'sf.programOfferId = po.programOfferId')
                        ->join('program AS p', 'po.programId = p.programId')
                        ->join('session AS s', 'po.sessionId = s.sessionId')
                        ->join('group AS g', 'po.groupId = g.groupId')
                        ->get()
                        ->result();
        return $records;
    }

    private function getStudentIdList()
    {
        $records = $this->db
                ->select('studentId')
                ->group_by('studentId')
                ->get('student')->result();
        return $records;
    }
    
     public function insertfine() {
        // print_r($_POST);

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

//        FORM VALIDADION

        $config = array(
            array(
                'field' => 'data[sessionId]',
                'label' => 'Session Id',
                'rules' => 'required'
            ),
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
                 redirect(admin_Url() . "/payments/studentfine");
          
        } else {
            $data = $this->input->post('data', TRUE);
           // $data['proprogramOfferId']=1;
            $programOfferId = $this->getProgramOfferId($data);

            if(!$programOfferId){
               $sdata['errormessage'] = 'Enrollment not Found..';
                $this->session->set_userdata($sdata);
                 redirect(admin_Url() . "/payments/studentfine");   
            }
            $data['programOfferId'] = $programOfferId;

            $result= $this->PaymentsModleAdmin->duplicateStudentFine($data);
            //$result2= $this->StudentModleAdmin->CheckStudentId($data);
            
            if($result){
                
               $sdata['errormessage'] = 'Duplicate Entry Found..';
                $this->session->set_userdata($sdata);

                 redirect(admin_Url() . "/payments/studentfine");   
            }
            // elseif(!$result2){
            //     $sdata['errormessage'] = 'Student ID invalid..';
            //     $this->session->set_userdata($sdata);
            //     redirect(admin_Url() . "/payments/studentfine"); 
                
            // }
            else{
                unset($data['sessionId']);
                $this->PaymentsModleAdmin->addStudentFine($data);

                $sdata['message'] = 'Fine added..';
                $this->session->set_userdata($sdata);

                  redirect(admin_Url() . "/payments/studentfine");
            }
        }
    }

    private function getProgramOfferId($data)
    {
        $programOfferId = 0;
        $record = $this->db
                    ->select('
                        po.programOfferId
                        ')
                    ->from('promotedstudent AS ps')
                    ->join('programoffer AS po', 'ps.programOfferId = po.programOfferId')
                    ->where('ps.studentId', $data['studentId'])
                    ->where('po.sessionId', $data['sessionId'])
                    ->order_by('ps.promotionId', 'desc')
                    ->get()
                    ->row();
        if ($record) {
            $programOfferId = $record->programOfferId;
        }
        return $programOfferId;
    }
    
    public function searchfine() {

        $data = $this->input->post('data', TRUE);
        if (!empty($data['studentId'])) {
                      
            $data['finelist'] = $this->PaymentsModleAdmin->searchfinelist($data);
            
            $data['totalamount'] = $this->PaymentsModleAdmin->totalfineamount($data);          
                        $data['stupayment']='active';       
                        $this->load->view('system_path/admin/common/header_link'); // header Css link
                        $this->load->view('system_path/admin/common/header'); // body header
                        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                        $this->load->view('system_path/admin/payment/fineadd/finelist', $data); // ...........body content page...........
                        $this->load->view('system_path/admin/common/footer'); // footer & script link
           
        } else {

            $sdata['message'] = 'You have to insert Student Id..';
            $this->session->set_userdata($sdata);

            redirect(admin_Url() . "/payments/studentfine");
        }
    }

    public function studentdiscount(){
        $data['stupayment']='active';       
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/payment/studentdicount/index', $data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
    }
    
     public function searchpaymentinfo() {

        $data = $this->input->post('data', TRUE);
        //echo '<pre>';print_r($data);exit;
        if (!empty($data['studentId'] && $data['sessionId'])) {

           $data['info'] = $this->StudentModleAdmin->getstudentBasicInfo($data['studentId'], $data['sessionId']);
            if (!empty($data['info'])) {
            
                $data['feeslist'] = $this->FeesModleAdmin->searchfeeslist_byquata($data['info']);
                $data['discountlist'] = $this->PaymentsModleAdmin->searchdiscountlist($data['info']);
               // $data['studentlist'] = $this->StudentModleAdmin->getstudentNameInfo($data['studentId']);
              //  echo '<pre>';print_r($data['feeslist']);exit;
                if ($data['feeslist']) {
                 
                  //  redirect(admin_Url() . "/payments/studentdiscount");
                $data['programOfferId'] = ($data['info']['programOfferId']) ? $data['info']['programOfferId'] : 0;
                    
                $data['stupayment']='active';       
                $this->load->view('system_path/admin/common/header_link'); // header Css link
                $this->load->view('system_path/admin/common/header'); // body header
                $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                $this->load->view('system_path/admin/payment/studentdicount/index', $data); // ...........body content page...........
                $this->load->view('system_path/admin/common/footer'); // footer & script link
                } else {

                    $sdata['errormessage'] = 'Payment Details is not avaiable for this Student yet..';
                    $this->session->set_userdata($sdata);
                    redirect(admin_Url() . "/payments/studentdiscount");
                }
            }
            else{
                $sdata['errormessage'] = 'Invalid Student ID..!!';
                $this->session->set_userdata($sdata);
                redirect(admin_Url() . "/payments/studentdiscount");
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
            $serial= $this->input->post('serial');
            $studentId = $this->input->post('studentId', TRUE);
            $headAmount = $this->input->post('headAmount', true);
            $discount = $this->input->post('discount', true);
            $amount= $this->input->post('amount', true);
            $programOfferId= $this->input->post('programOfferId', true);

            //echo '<pre>';print_r($_POST);
            
         //   echo count($headId);die();
            for ($i = 0; $i < count($serial); $i++) {
                $s = $serial[$i];
                $data = array(
                    'headId' => $headId[$s],
                    'studentId' => $studentId,
                    'programOfferId' => $programOfferId,
                    'headAmount' => $headAmount[$s],
                    'discount' => $discount[$s],
                    'amount' => $amount[$s]
                    
                    );
                if ($discount[$s]) {
                    $this->PaymentsModleAdmin->addDiscount($data);   
                }
                      
        }
                $sdata['message'] = 'Discount Added';
                $this->session->set_userdata($sdata);

                redirect(admin_Url() . "/payments/studentdiscount");
    }
    else{
        $sdata['errormessage'] = 'Discount Value Missing';
        $this->session->set_userdata($sdata);
        redirect(admin_Url() . "/payments/studentdiscount");
    }
    
  }
    
    //put your code here
}


