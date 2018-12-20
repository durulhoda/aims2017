<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */


class Incomes extends MY_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->my_admin();
        $this->load->model('admin/incomes/IncomesModleAdmin', 'IncomesModleAdmin');
    }
    
     public function index(){
         $this->load->library('form_validation');
         
        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/incomes/index');        
        $this->load->view('templates/admin/common/footer');

    }
    
    public function insertincomes(){
       $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
         $config = array(
           
           array(
                'field' => 'data[headcategory]',
                'label' => 'Income Head Category',
                'rules' => 'required'
            ),
             array(
                'field' => 'data[incomeHead]',
                'label' => 'Income Head',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[voucherNo]',
                'label' => 'Voucher No',
                'rules' => 'required'
            ), 
            array(
                'field' => 'data[amount]',
                'label' => 'Amount',
                'rules' => 'required'
            )
          
        );

        $this->form_validation->set_rules($config);
        
        if ($this->form_validation->run() == FALSE){
//                    redirect(base_url('admin/campus'));
        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/incomes/index');        
        $this->load->view('templates/admin/common/footer');
            
		}
		else
		{
                    $data = $this->input->post('data', TRUE); 
                    if($data['incomeMethod']== "check" && empty($data['chequeNumber']) && empty($data['bankName']) )
                    {
                        $sdata['message'] = 'Insert Bank Name & Check Number ';
                        $this->session->set_userdata($sdata);    
                        $this->load->view('templates/admin/common/header');
                            $this->load->view('templates/admin/incomes/index');        
                            $this->load->view('templates/admin/common/footer');
                    }
                    else{
                       $this->IncomesModleAdmin->addIncomesInfo($data);

                        $sdata['message'] = 'Successfull!';
                        $this->session->set_userdata($sdata);

                        redirect(base_url('admin/incomes'));
                    }
		}

        
    }
    
    public function incomeslist(){
        
       $data['incomeslist'] = $this->IncomesModleAdmin->incomeslist();

        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/incomes/incomeslist', $data );  
        
        $this->load->view('templates/admin/common/footer');
        
    
    }
}