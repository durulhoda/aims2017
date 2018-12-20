<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */


class Financehead  extends MY_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->teacher_logged_auth();
        $this->load->model('admin/financehead/FinanceHeadModleAdmin', 'FinanceHeadModleAdmin');
        $this->load->model('admin/payments/PaymentsModleAdmin', 'PaymentsModleAdmin');
    }
    
    public function index(){
        
        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/financehead/headcategory');
        $this->load->view('templates/admin/common/footer');
        
    }
    
   
    public function insertHeadcategory() {
        // print_r($_POST);
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');


        $config = array(
            array(
                'field' => 'data[headcategory]',
                'label' => 'Head category',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);


        if ($this->form_validation->run() == FALSE) {
//                    redirect(base_url('admin/campus'));
            $this->load->view('templates/admin/common/header');
            $this->load->view('templates/admin/financehead/headcategory');
            $this->load->view('templates/admin/common/footer');
        } else {
            $data = $this->input->post('data', TRUE);
            $result = $this->FinanceHeadModleAdmin->duplicateInfo($data);

            if (!$result) {
                $this->FinanceHeadModleAdmin->addHeadsetupInfo($data);

                $sdata['message'] = 'Successfull!';
                $this->session->set_userdata($sdata);

                redirect('admin/financehead/listfinancehead', 'refresh');
            } else {
                $sdata['message'] = 'Duplicate Entry Found!';
                $this->session->set_userdata($sdata);

                 $this->load->view('templates/admin/common/header');
            $this->load->view('templates/admin/financehead/headcategory');
            $this->load->view('templates/admin/common/footer');
            }
        }
    }

    public function listfinancehead() {

        $data['headlist'] = $this->FinanceHeadModleAdmin->getlistfinancehead();
//                        print_r($grouplist);
        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/financehead/listfinancehead', $data);
        $this->load->view('templates/admin/common/footer');
    }

    public function editfinancehead($id) {

//        echo $id; exit;
        $this->load->view('templates/admin/common/header');

        $data['editData'] = $this->FinanceHeadModleAdmin->editfinancehead($id);
//        print_r($data);
        $this->load->view('templates/admin/financehead/editfinancehead', $data);
        $this->load->view('templates/admin/common/footer');
    }

    public function updatefinancehead($id) {
       
            $data = $this->input->post('data', TRUE);
            $result = $this->FinanceHeadModleAdmin->duplicateInfo($data);

            if (!$result) {
                $this->FinanceHeadModleAdmin->updatefinancehead($data, $id);
                $sdata['message'] = 'Successfull!';
                $this->session->set_userdata($sdata);

                redirect('admin/financehead/listfinancehead', 'refresh');
            } else {
                $sdata['message'] = 'Duplicate Entry Found!';
                $this->session->set_userdata($sdata);

                $this->load->view('templates/admin/common/header');
                $data['editData'] = $this->FinanceHeadModleAdmin->editfinancehead($id);
                $this->load->view('templates/admin/financehead/editfinancehead', $data);
                $this->load->view('templates/admin/common/footer');
            }
        
    }

    public function deletefinancehead($id) {


        $this->FinanceHeadModleAdmin->deletefinancehead($id);
        $sdata['message'] = 'Delete Succesfully...';
        $this->session->set_userdata($sdata);
        redirect('admin/financehead/listfinancehead', 'refresh');
    }
    
    
    
    public function finance(){
        
        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/financehead/finance');
        $this->load->view('templates/admin/common/footer');
        
    }

    public function insertfinance(){
       $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
         $config = array(
            array(
                'field' => 'data[financecategory]',
                'label' => 'Finance Category',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[financeHead]',
                'label' => 'Finance Head',
                'rules' => 'required'
            )
          
        );

        $this->form_validation->set_rules($config);
        
        if ($this->form_validation->run() == FALSE){
//                    redirect(base_url('admin/campus'));
            $this->load->view('templates/admin/common/header');
            $this->load->view('templates/admin/financehead/finance');
            $this->load->view('templates/admin/common/footer');

		}
		else
		{
                    $data = $this->input->post('data', TRUE); 
                    if($data['financecategory']== "check" && empty($data['financeHead']) )
                    {
                        $sdata['message'] = 'Insert Finance Category & Finance Head';
                        $this->session->set_userdata($sdata);    
                            $this->load->view('templates/admin/common/header');
                            $this->load->view('templates/admin/financehead/finance');
                            $this->load->view('templates/admin/common/footer');
                    }
                    else{
                        $data['addDate']=date("d-m-Y");
                    
                        $this->FinanceHeadModleAdmin->addFinanceInfo($data);

                        $sdata['message'] = 'Successfull!';
                        $this->session->set_userdata($sdata);

                        redirect(base_url('admin/financehead/finance'));
                    }
                }
        
    }
    
    public function financeReport(){
        
        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/financehead/financereport');
        $this->load->view('templates/admin/common/footer');
        
    }
    public function journalReport(){
        
        if(!empty($_POST['searchmonth'])){
            $data['mnth'] = $this->input->post('mnth', TRUE); 
            
            if(!empty($data['mnth'])){
                $data['getdata'] = $this->FinanceHeadModleAdmin->getAllfinanceinfo();
                $data['getpaymentdata'] = $this->PaymentsModleAdmin->getpaymentlist();
                
                $this->load->view('templates/admin/common/header');
                $this->load->view('templates/admin/financereport/journalreportmonthly',$data);
                $this->load->view('templates/admin/common/footer');
            }
            else{
                 redirect(base_url('admin/financehead/financeReport'));
            }
        }
        elseif(!empty($_POST['searchdate'])){
            $data['addDate'] = $this->input->post('date', TRUE); 
            
            if(!empty($data['addDate'])){
                $data['getdata'] = $this->FinanceHeadModleAdmin->getAllfinanceinfo();
                $data['getpaymentdata'] = $this->PaymentsModleAdmin->getpaymentlist();
                
                $this->load->view('templates/admin/common/header');
                $this->load->view('templates/admin/financereport/journalreportdaily',$data);
                $this->load->view('templates/admin/common/footer');
            }
            else{
                 redirect(base_url('admin/financehead/financeReport'));
            }
        }
    
    }
    public function financeStatement(){
        
        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/financehead/financestatement');
        $this->load->view('templates/admin/common/footer');
        
    }
    
    public function ProfitLossReport(){
        
        if(!empty($_POST['searchyear'])){
            $data['year'] = $this->input->post('year', TRUE); 
            
            if(!empty($data['year'])){
                $data['getdata'] = $this->FinanceHeadModleAdmin->getAllfinanceinfo();
                $data['getpaymentdata'] = $this->PaymentsModleAdmin->getpaymentlist();
                
                $this->load->view('templates/admin/common/header');
                $this->load->view('templates/admin/financereport/profitlossreportyearly',$data);
                $this->load->view('templates/admin/common/footer');
            }
            else{
                 redirect(base_url('admin/financehead/financeStatement'));
            }
        }
        elseif(!empty($_POST['searchmonth'])){
            $data['mnth'] = $this->input->post('mnth', TRUE); 
            
            if(!empty($data['mnth'])){
                $data['getdata'] = $this->FinanceHeadModleAdmin->getAllfinanceinfo();
                $data['getpaymentdata'] = $this->PaymentsModleAdmin->getpaymentlist();
                
                $this->load->view('templates/admin/common/header');
                $this->load->view('templates/admin/financereport/profitlossreportmonthly',$data);
                $this->load->view('templates/admin/common/footer');
            }
            else{
                 redirect(base_url('admin/financehead/financeStatement'));
            }
        }
    
    }
    
    
    
    public function financeSheet(){
        
        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/financehead/financesheet');
        $this->load->view('templates/admin/common/footer');
        
    }
    
    public function balanceReport(){
        
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
    //put your code here
}


?>
