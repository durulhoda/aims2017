<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */

class FinanceReport  extends MY_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->my_admin();
        $this->load->model('admin/financehead/FinanceHeadModleAdmin', 'FinanceHeadModleAdmin');
        $this->load->model('admin/payments/PaymentsModleAdmin', 'PaymentsModleAdmin');
        $this->load->model('admin/institute/InstituteModleAdmin', 'InstituteModleAdmin');
        $this->load->model('admin/program/ProgramModleAdmin', 'ProgramModleAdmin');
        $this->load->model('admin/student/StudentModleAdmin', 'StudentModleAdmin');
        $this->load->model('admin/quata/QuataModleAdmin', 'QuataModleAdmin');
    }
    
    public function index(){
        $data['finanace'] = 'active';
        $data['finance_summery'] = 'active';
        $data['journal'] = 'active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/financereport/index'); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
       
    }
    public function journalReport(){
        
    //    if(!empty($_POST['search'])){
            $data = $this->input->post('data', TRUE); 
         //  print_r($data); die();
            $data['getdata'] = $this->FinanceHeadModleAdmin->getAllfinancelist($data);
            if(!empty($data)){
                $data['data_info']=$this->InstituteModleAdmin->getInstituteInfo();
                
                //print_r($data['getdata']); die();
               // $data['getpaymentdata'] = $this->PaymentsModleAdmin->getpaymentlist();
                $data['getpaymentdata'] = $this->PaymentsModleAdmin->getpaymentlistprofitloss($data);
//                echo '<pre>';
//                 print_r($data); die();
                $data['finanace'] = 'active';
                $data['finance_summery'] = 'active';
                $data['journal'] = 'active';
                $this->load->view('system_path/admin/common/header_link'); // header Css link
                $this->load->view('system_path/admin/common/header'); // body header
                $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
                $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                $this->load->view('system_path/admin/financereport/journalreport', $data); // ...........body content page...........
                $this->load->view('system_path/admin/common/footer'); // footer & script link
            }
            else{
                 
                 
                        $sdata['errormessage'] = 'Report Not Found';
                        $this->session->set_userdata($sdata);
                        redirect(admin_Url() . "/financeReport");
            }
     //   }

    
    }
    public function financeStatement(){
        $data['finanace'] = 'active';
        $data['finance_summery'] = 'active';
        $data['profitloss'] = 'active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/financereport/profitloss'); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        
    }
    
    public function profitlossreport(){
        
       
            $data = $this->input->post('data', TRUE); 
         //  print_r($data); die();
            if(!empty($data)){
                $data['getdata'] = $this->FinanceHeadModleAdmin->getAll_income_financelist($data);
               // print_r($data); die();
                $data['getdata_expences'] = $this->FinanceHeadModleAdmin->getAll_expences_financelist($data);
               //print_r($data['getdata']); die();
                $data['getpaymentdata'] = $this->PaymentsModleAdmin->getpaymentlistprofitloss($data);
             //   print_r($data['getpaymentdata']); die();
         
             
                $data_value['data_info']=$this->InstituteModleAdmin->getInstituteInfo();
             // print_r($data['getpaymentdata']); die();
                $data['finanace'] = 'active';
                $data['finance_summery'] = 'active';
                $data['profitloss'] = 'active';
                $this->load->view('system_path/admin/common/header_link'); // header Css link
                $this->load->view('system_path/admin/common/header'); // body header
                $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
                $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                $this->load->view('system_path/admin/financereport/profitlossreport', $data_value); // ...........body content page...........
                $this->load->view('system_path/admin/common/footer'); // footer & script link
            }
            else{
                 
                 
                        $sdata['errormessage'] = 'Report Not Found';
                        $this->session->set_userdata($sdata);
                        redirect(admin_Url() . "/financeReport/financeStatement");
            }
    
    }
    
    
    
    public function financeSheet(){
        
        $data['finanace'] = 'active';
        $data['finance_summery'] = 'active';
        $data['balancesheet'] = 'active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/financereport/balancesheet'); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        
    }
    
    
        public function balanceReport() {


        $data = $this->input->post('data', TRUE);
        //  print_r($data); die();
// if (!empty($data)) {
//            $data['getdata'] = $this->FinanceHeadModleAdmin->getAllfinancelist($data);
//        //print_r($data['getdata']); die();
//        $data['getpaymentdata'] = $this->PaymentsModleAdmin->getpaymentlistprofitloss($data);
//
//
//
//            $data_value['data_info'] = $this->InstituteModleAdmin->getInstituteInfo();
//            // print_r($data['getpaymentdata']); die();
//            $data['finanace'] = 'active';
//            $data['finance_summery'] = 'active';
//            $data['balancesheet'] = 'active';
//            $this->load->view('system_path/admin/common/header_link'); // header Css link
//            $this->load->view('system_path/admin/common/header'); // body header
//            $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
//            $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
//            $this->load->view('system_path/admin/financereport/balancesheetreport', $data_value); // ...........body content page...........
//            $this->load->view('system_path/admin/common/footer'); // footer & script link
//        } else {
//            $sdata['errormessage'] = 'Report Not Found';
//            $this->session->set_userdata($sdata);
//            redirect(admin_Url() . "/financeReport/financeSheet");
//        }

            $data['getdata'] = $this->FinanceHeadModleAdmin->getAllfinancelist($data);
            if(!empty($data)){
                $data['data_info']=$this->InstituteModleAdmin->getInstituteInfo();

                //print_r($data['getdata']); die();
                // $data['getpaymentdata'] = $this->PaymentsModleAdmin->getpaymentlist();
                $data['getpaymentdata'] = $this->PaymentsModleAdmin->getpaymentlistprofitloss($data);
//                echo '<pre>';
//                 print_r($data); die();
                $data['finanace'] = 'active';
                $data['finance_summery'] = 'active';
                $data['journal'] = 'active';
                $this->load->view('system_path/admin/common/header_link'); // header Css link
                $this->load->view('system_path/admin/common/header'); // body header
                $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
                $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                $this->load->view('system_path/admin/financereport/balancesheetreport', $data); // ...........body content page...........
                $this->load->view('system_path/admin/common/footer'); // footer & script link
            }
            else{


                $sdata['errormessage'] = 'Report Not Found';
                $this->session->set_userdata($sdata);
                redirect(admin_Url() . "/financeSheet");
            }


    }
    
    
    public function oldbalanceReport(){
        
        if(!empty($_POST['searchyear'])){
            $data['year'] = $this->input->post('year', TRUE); 
            
            if(!empty($data['year'])){
                $data['getdata'] = $this->FinanceHeadModleAdmin->getAllfinanceinfo();
                $data['getpaymentdata'] = $this->PaymentsModleAdmin->getpaymentlist();
              //print_r($data['getdata']); die();
                $this->load->view('templates/admin/common/header');
                $this->load->view('templates/admin/financereport/balancereportyearly',$data);
                $this->load->view('templates/admin/common/footer');
            }
            else{
                 redirect(base_url('admin/financehead/financeSheet'));
            }
        }
        elseif(!empty($_POST['searchmonth'])){
            $data['mnth'] = $this->input->post('mnth', TRUE); 
            
            if(!empty($data['mnth'])){
                $data['getdata'] = $this->FinanceHeadModleAdmin->getAllfinanceinfo();
                $data['getpaymentdata'] = $this->PaymentsModleAdmin->getpaymentlist();
                
                $this->load->view('templates/admin/common/header');
                $this->load->view('templates/admin/financereport/balancereportmonthly',$data);
                $this->load->view('templates/admin/common/footer');
            }
            else{
                 redirect(base_url('admin/financehead/financeSheet'));
            }
        }
    
    }
    
    public function getFinancereport(){
         $data['finanace'] = 'active';
        $data['finance_summery'] = 'active';
        $data['fin_report'] = 'active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/financereport/transaction_report'); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
    }
    
    public function searchreport() {

            $data= $this->input->post('data', TRUE);
            $data['from_date_time']= date("d-m-Y", strtotime($data['from_date']));
            $data['to_date_time']= date("d-m-Y", strtotime($data['to_date']));
            
            if (!empty($data)) {
                $data['data_info'] = $this->InstituteModleAdmin->getInstituteInfo();
                $data['report_list'] = $this->FinanceHeadModleAdmin->getAllfinanceinfo($data);
                if (!empty($data['report_list'])) 
                {                
                    $datax['fromDate']=$data['from_date_time'];
                    $datax['toDate']=$data['from_date_time'];
                    $data['getpaymentdata'] = $this->PaymentsModleAdmin->getpaymentlistprofitloss($datax);
                    $data['finanace'] = 'active';
                    $data['finance_summery'] = 'active';
                    $data['fin_report'] = 'active';
                    $this->load->view('system_path/admin/common/header_link'); // header Css link
                    $this->load->view('system_path/admin/common/header'); // body header
                    $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
                    $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                    $this->load->view('system_path/admin/financereport/transaction_report_view',$data); // ...........body content page...........
                    $this->load->view('system_path/admin/common/footer'); // footer & script link
                }
                else {
                        $sdata['errormessage'] = 'Not Found';
                        $this->session->set_userdata($sdata);  
                        redirect(admin_Url(). "/financeReport/getFinancereport");
                   }
                
            } else {
                 $sdata['errormessage'] = 'Not Found';
                 $this->session->set_userdata($sdata);  
                 redirect(admin_Url(). "/financeReport/getFinancereport");
            }
      
    }
    
    public function class_paymentreport() {

            $time=time();
            $data= $this->input->post('data', TRUE);
            $data['from_date_time']= date("Y-m-d", strtotime($data['from_date']));
            $data['to_date_time']= date("Y-m-d", $time);

//            echo '<pre>';
//            print_r($data);exit;
            
            if (!empty($data)) {
                $data['data_info'] = $this->InstituteModleAdmin->getInstituteInfo();
                if ($data['info_type']==1)
                {
                    $data['payment_count'] = $this->PaymentsModleAdmin->getCountByPaymentHead_date($data);
                    $data['class_payment'] = $this->PaymentsModleAdmin->getPayment_Head_Class_date($data);
                    $data['finanace'] = 'active';
                    $data['finance_summery'] = 'active';
                    $data['fin_report'] = 'active';
                    $this->load->view('system_path/admin/common/header_link'); // header Css link
                    $this->load->view('system_path/admin/common/header'); // body header
                    $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
                    $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                    $this->load->view('system_path/admin/financereport/transaction_report_headview', $data); // ...........body content page...........
                    $this->load->view('system_path/admin/common/footer'); // footer & script link        
                }   
                elseif($data['info_type']==2)
                {
                    $all_quata=$this->QuataModleAdmin->getQuatalist();
                    $head=array();
                    if($data['headId'])
                    {
                        $head[0]['headId']=$data['headId'];
                    }
                    else
                    {
                        $head=$this->StudentModleAdmin->get_head_ids();
                    }

                    $total_sum_fees=0;
                    foreach($head as $hd)
                    {
                    foreach($all_quata as $quata)
                    {
                        $data['count_student'] = $this->StudentModleAdmin->count_studentBy_class_quata($quata['quata_id']);
//                        echo '<pre>';
//                        print_r($data['count_student']);exit;
                        $total_fees=0;
                        if(is_array($data['count_student']))
                        {
                            foreach($data['count_student'] as $stu_quata)
                            {
                                $stu_quata['headId']=$hd['headId'];
                                //     echo "<pre>".$stu_quata['programOfferId']."==".$stu_quata['quata_id'];
                                $data['count_fees'] = $this->StudentModleAdmin->count_all_fees_Byquata_head($stu_quata);
                                //   echo $data['count_fees']['tu_fees']."<pre>";

                                if(!empty($data['count_fees']['tu_fees']))
                                {
                                    $get_fees=$data['count_fees']['tu_fees']*$stu_quata['total_stu'];
                                    $total_fees=$get_fees+$total_fees;
                                }
                                else
                                {
                                    $get_fees=0;
                                    $total_fees=$get_fees+$total_fees;
                                }

                            }
                        }
                        $total_sum_fees= $total_fees+$total_sum_fees;

                    }
                    }

                    $data['total_payable_fees']=$total_sum_fees;
                    $data['class_payment'] = $this->PaymentsModleAdmin->getPayment_Head_Class_date($data);
//                    echo '<pre>';
//                    print_r($data);exit;
                    $cl_payment=0;
                    foreach($data['class_payment'] as $cl_pay)
                    {
                        $cl_payment=$cl_payment+$cl_pay['stu_amount'];
                    }
                    $data['calaulate_dues']= $total_sum_fees-$cl_payment;
                     $data['finanace'] = 'active';
                    $data['finance_summery'] = 'active';
                    $data['fin_report'] = 'active';

//                    echo '<pre>';
//                    print_r($data);exit;

                    $this->load->view('system_path/admin/common/header_link'); // header Css link
                    $this->load->view('system_path/admin/common/header'); // body header
                    $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
                    $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                    $this->load->view('system_path/admin/financereport/transaction_report_duesview', $data); // ...........body content page...........
                    $this->load->view('system_path/admin/common/footer'); // footer & script link   
                }
                else {
                    $sdata['errormessage'] = 'Not Found';
                    $this->session->set_userdata($sdata);  
                    redirect(admin_Url(). "/financeReport/getFinancereport");
                }
            } else {
                 $sdata['errormessage'] = 'Not Found';
                 $this->session->set_userdata($sdata);  
                 redirect(admin_Url(). "/financeReport/getFinancereport");
            }
      
    }
    //put your code here
}


?>
