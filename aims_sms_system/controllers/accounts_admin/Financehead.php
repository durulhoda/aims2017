<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class Financehead  extends MY_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->account_access();
        $this->load->model('admin/financehead/FinanceHeadModleAdmin', 'FinanceHeadModleAdmin');
        $this->load->model('admin/payments/PaymentsModleAdmin', 'PaymentsModleAdmin');
    }
    
    public function index(){
        $data['finanace'] = 'active';
        $data['paymentcat'] = 'active';
        $data['headcat'] = 'active';
        $data['headlist'] = $this->FinanceHeadModleAdmin->getlistfinancehead();
        $this->load->view('system_path/accounts/common/header_link'); // header Css link
        $this->load->view('system_path/accounts/common/header'); // body header
        $this->load->view('system_path/accounts/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/accounts/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/accounts/finance/index', $data); // ...........body content page...........
        $this->load->view('system_path/accounts/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
        
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
            redirect(acc_Url()."/financehead");
        } else {
            $data = $this->input->post('data', TRUE);
            $result = $this->FinanceHeadModleAdmin->duplicateInfo($data);

            if (!$result) {
                $this->FinanceHeadModleAdmin->addHeadsetupInfo($data);

                $sdata['message'] = 'Successfull!';
                $this->session->set_userdata($sdata);

                redirect(acc_Url()."/financehead");
            } else {
                $sdata['errormessage'] = 'Duplicate Entry Found!';
                $this->session->set_userdata($sdata);

        redirect(acc_Url()."/financehead");
            }
        }
    }

    public function listfinancehead() {

        $data['headlist'] = $this->FinanceHeadModleAdmin->getlistfinancehead();
        $data['finanace'] = 'active';
        $data['paymentcat'] = 'active';
        $data['allheadcat'] = 'active';
        $this->load->view('system_path/accounts/common/header_link'); // header Css link
        $this->load->view('system_path/accounts/common/header'); // body header
        $this->load->view('system_path/accounts/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/accounts/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/accounts/finance/headcatlist'); // ...........body content page...........
        $this->load->view('system_path/accounts/common/footer'); // footer & script link
        //$this->load->view('system_path/jsquery'); // footer & script link
    }

    public function editfinancehead($id) {



        $data['editData'] = $this->FinanceHeadModleAdmin->editfinancehead($id);
        $data['finanace'] = 'active';
        $this->load->view('system_path/accounts/common/header_link'); // header Css link
        $this->load->view('system_path/accounts/common/header'); // body header
        $this->load->view('system_path/accounts/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/accounts/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/accounts/finance/editheadlist'); // ...........body content page...........
        $this->load->view('system_path/accounts/common/footer'); // footer & script link
    }

    public function updatefinancehead($id) {
       
            $data = $this->input->post('data', TRUE);
            $result = $this->FinanceHeadModleAdmin->duplicateInfo($data);

            if (!$result) {
                $this->FinanceHeadModleAdmin->updatefinancehead($data, $id);
                $sdata['message'] = 'Successfull!';
                $this->session->set_userdata($sdata);

               redirect(acc_Url(). "/financehead/listfinancehead");
            } else {
                $sdata['errormessage'] = 'Duplicate Entry Found!';
                $this->session->set_userdata($sdata);

                redirect(acc_Url(). "/financehead/listfinancehead");
            }
        
    }

    public function deletefinancehead($id) {


        $this->FinanceHeadModleAdmin->deletefinancehead($id);
        $sdata['message'] = 'Delete Succesfully...';
        $this->session->set_userdata($sdata);
        redirect(acc_Url(). "/financehead/listfinancehead");
    }
    
    
    
    public function finance(){
        
        $data['finanace'] = 'active';
        $data['add_transaction'] = 'active';
        $this->load->view('system_path/accounts/common/header_link'); // header Css link
        $this->load->view('system_path/accounts/common/header'); // body header
        $this->load->view('system_path/accounts/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/accounts/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/accounts/finance/add_transaction'); // ...........body content page...........
        $this->load->view('system_path/accounts/common/footer'); // footer & script link
        
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
                    $data['finanace'] = 'active';
                    $data['add_transaction'] = 'active';
                    $this->load->view('system_path/accounts/common/header_link'); // header Css link
                    $this->load->view('system_path/accounts/common/header'); // body header
                    $this->load->view('system_path/accounts/common/side_menu', $data); // side bar menu
                    $this->load->view('system_path/accounts/common/top_menu', $data); // top bar menu
                    $this->load->view('system_path/accounts/finance/add_transaction'); // ...........body content page...........
                    $this->load->view('system_path/accounts/common/footer'); // footer & script link

		}
		else
		{
                    $data = $this->input->post('data', TRUE); 
                   
                    if(empty($data['financeHead']) )
                    {
                        $sdata['message'] = 'Insert Finance Category & Finance Head';
                        $this->session->set_userdata($sdata);    
                        redirect(acc_Url(). "/financehead/finance");
                    }
                    else{
                        $data['addDate']=date("d-m-Y");                    
                        $this->FinanceHeadModleAdmin->addFinanceInfo($data);

                        $sdata['message'] = 'Successfull!';
                        $this->session->set_userdata($sdata);
                        redirect(acc_Url(). "/financehead/finance");
                    }
                }
        
    }
    
    public function financehistory(){
        
        $data['finanace'] = 'active';
        $data['add_transaction'] = 'active';
        $this->load->view('system_path/accounts/common/header_link'); // header Css link
        $this->load->view('system_path/accounts/common/header'); // body header
        $this->load->view('system_path/accounts/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/accounts/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/accounts/finance/transaction_list'); // ...........body content page...........
        $this->load->view('system_path/accounts/common/footer'); // footer & script link
        
    }
    
    
        public function financesearch() {

     
            $data= $this->input->post('data', TRUE);
           
//           print_r( $data['from_date']); die();
            $data['from_date_time']= date("d-m-Y", strtotime($data['from_date']));
            $data['to_date_time']= date("d-m-Y", strtotime($data['to_date']));
            
            if (!empty($data)) {
                $data['headlist'] = $this->FinanceHeadModleAdmin->getAllfinanceinfo($data);
            //   print_r( $data); die();
                
                $data['finanace'] = 'active';
                $data['add_transaction'] = 'active';
                $this->load->view('system_path/accounts/common/header_link'); // header Css link
                $this->load->view('system_path/accounts/common/header'); // body header
                $this->load->view('system_path/accounts/common/side_menu', $data); // side bar menu
                $this->load->view('system_path/accounts/common/top_menu', $data); // top bar menu
                $this->load->view('system_path/accounts/finance/transaction_list',$data); // ...........body content page...........
                $this->load->view('system_path/accounts/common/footer'); // footer & script link
            } else {
                 $sdata['errormessage'] = 'Not Found';
                 $this->session->set_userdata($sdata);  
                 redirect(acc_Url(). "/financehead/financehistory");
            }
      
    }
    
        public function editfinancedata($id) {



        $data['editData'] = $this->FinanceHeadModleAdmin->editfinance($id);
      //  print_r($data); die();
        $data['finanace'] = 'active';
        $this->load->view('system_path/accounts/common/header_link'); // header Css link
        $this->load->view('system_path/accounts/common/header'); // body header
        $this->load->view('system_path/accounts/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/accounts/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/accounts/finance/editfinance'); // ...........body content page...........
        $this->load->view('system_path/accounts/common/footer'); // footer & script link
    }
    
        public function updatefinance($id) {

        $data = $this->input->post('data', TRUE);
   //     print_r($data); die();
      

        if (!empty($data)) {
            $this->FinanceHeadModleAdmin->updatefinance($data, $id);
            $sdata['message'] = 'Successfull!';
            $this->session->set_userdata($sdata);

            redirect(acc_Url() . "/financehead/financehistory");
        } else {
            $sdata['errormessage'] = 'Not Found!';
            $this->session->set_userdata($sdata);

            redirect(acc_Url() . "/financehead/financehistory");
        }
    }
    
        public function deletefinancedata($id) {


        $this->FinanceHeadModleAdmin->deletefinance($id);
        $sdata['message'] = 'Delete Succesfully...';
        $this->session->set_userdata($sdata);
        redirect(acc_Url(). "/financehead/financehistory");
    }
    
    
    
    
     
}


?>
