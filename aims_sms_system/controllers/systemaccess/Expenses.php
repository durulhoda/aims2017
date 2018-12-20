<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */


class Expenses  extends MY_Controller{
    
     public function __construct() {
        parent::__construct();
        $this->my_admin();
         $this->load->model('admin/expenses/ExpensesModleAdmin', 'ExpensesModleAdmin');
    }
    
    public function index(){
        $this->load->library('form_validation');
        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/expenses/index');
        $this->load->view('templates/admin/common/footer');

    }
    
    public function insertExpenses(){
       $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
         $config = array(
            array(
                'field' => 'data[headcategory]',
                'label' => 'Expense Head Category',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[expenseHead]',
                'label' => 'Expense Head',
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
            ),
          
        );

        $this->form_validation->set_rules($config);
        
        if ($this->form_validation->run() == FALSE){
//                    redirect(base_url('admin/campus'));
            $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/expenses/index');        
        $this->load->view('templates/admin/common/footer');
            
		}
		else
		{
                    $data = $this->input->post('data', TRUE); 
                    if($data['expenseMethod']== "check" && empty($data['bankName']) && empty($data['chequeNumber']) )
                    {
                        $sdata['message'] = 'Insert Bank Name & Check Number';
                        $this->session->set_userdata($sdata);    
                        $this->load->view('templates/admin/common/header');
                            $this->load->view('templates/admin/expenses/index');        
                            $this->load->view('templates/admin/common/footer');
                    }
                    else{
                        $this->ExpensesModleAdmin->addExpensesInfo($data);
    //			$this->load->view('formsuccess');
                        $sdata['message'] = 'Successfull!';
                        $this->session->set_userdata($sdata);

                        redirect(base_url('admin/expenses'));
                    }
                }
        
    }
    
    
     public function expenseslist(){
        
       $data['expenseslist'] = $this->ExpensesModleAdmin->expenseslist();

        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/expenses/expenseslist', $data );  
        
        $this->load->view('templates/admin/common/footer');
        
    
    }
    //put your code here
}

?>
