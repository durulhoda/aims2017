<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */


class Paymentlist extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->my_admin();
        $this->load->model('admin/paymentlist/PaymentlistModleAdmin', 'PaymentlistModleAdmin');
    }
    
    public function index(){
         $this->load->library('form_validation');
         
        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/paymentlist/index');        
        $this->load->view('templates/admin/common/footer');

    }
    
    public function insertPaymentlist(){
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
         $config = array(
            array(
                'field' => 'data[studentid]',
                'label' => 'department Name',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[semester]',
                'label' => 'Group',
                'rules' => 'required'
            ),
           array(
                'field' => 'data[section]',
                'label' => 'Description',
                'rules' => 'required'
            )
        );
        
     $this->form_validation->set_rules($config);
         if ($this->form_validation->run() == FALSE){
//                    redirect(base_url('admin/campus'));
            $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/department/index');
        $this->load->view('templates/admin/common/footer');
            
		}
		else
		{
                    $data = $this->input->post('data', TRUE); 
                    $this->DepartmentModleAdmin->addDepartmentInfo($data);
//			$this->load->view('formsuccess');
		}

        
    }
    //put your code here
}


