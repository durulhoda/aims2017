<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */


class Result_search  extends MY_Controller{
    
     public function __construct() {
        parent::__construct();
        $this->my_admin();
        $this->load->model('admin/result_search/Result_searchModleAdmin', 'Result_searchModleAdmin');
    //put your code here
}
    public function index(){
         $this->load->library('form_validation');
         $this->load->view('templates/admin/common/header');
         $this->load->view('templates/admin/result_search/index');
         $this->load->view('templates/admin/common/footer');

         }
    
    public function insertExpensesadd(){
       $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
         $config = array(
             array(
                'field' => 'data[SemesterName]',
                'label' => 'Semester Name',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[Session]',
                'label' => 'Session',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[expenseDate]',
                'label' => 'Expense Date',
                'rules' => 'required'
            ),
             array(
                'field' => 'data[amount]',
                'label' => 'Email Address',
                'rules' => 'required'
            )
       );
          $this->form_validation->set_rules($config);
        
        if ($this->form_validation->run() == FALSE){
//                    redirect(base_url('admin/campus'));
            $this->load->view('templates/admin/result_search/index');
		}
		else
		{
                    $data = $this->input->post('data', TRUE); 
                    $this->Result_searchModleAdmin->addResult_searchInfo($data);
//			$this->load->view('formsuccess');
		}
        
    
    }
    
    //put your code here
}

