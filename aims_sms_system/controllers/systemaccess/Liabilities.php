<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */


class Liabilities extends MY_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->my_admin();
        $this->load->model('admin/liabilities/LiabilitiesModleAdmin', 'LiabilitiesModleAdmin');
    }
    
     public function index(){
         $this->load->library('form_validation');
         
        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/liabilities/index');        
        $this->load->view('templates/admin/common/footer');

    }
    
    public function insertliabilities(){
       $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
         $config = array(
           
           array(
                'field' => 'data[headcategory]',
                'label' => 'Liabilities Head Category',
                'rules' => 'required'
            ),
             array(
                'field' => 'data[liabilitiesHead]',
                'label' => 'Liabilities Head',
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
        $this->load->view('templates/admin/liabilities/index');        
        $this->load->view('templates/admin/common/footer');
            
		}
		else
		{
                    $data = $this->input->post('data', TRUE); 
                    if($data['paymentMethod']== "check" && empty($data['chequeNumber']) && empty($data['bankName']) )
                    {
                        $sdata['message'] = 'Insert Bank Name & Check Number ';
                        $this->session->set_userdata($sdata);    
                        $this->load->view('templates/admin/common/header');
                            $this->load->view('templates/admin/liabilities/index');        
                            $this->load->view('templates/admin/common/footer');
                    }
                    else{
                       $this->LiabilitiesModleAdmin->addLiabilitiesInfo($data);

                        $sdata['message'] = 'Successfull!';
                        $this->session->set_userdata($sdata);

                        redirect(base_url('admin/liabilities'));
                    }
		}

        
    }
    
    public function liabilitieslist(){
        
       $data['liabilitieslist'] = $this->LiabilitiesModleAdmin->liabilitieslist();

        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/liabilities/liabilitieslist', $data );  
        
        $this->load->view('templates/admin/common/footer');
        
    
    }
}