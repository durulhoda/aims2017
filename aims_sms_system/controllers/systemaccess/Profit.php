<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */


class Profit extends MY_Controller{
    
    
     public function __construct() {
        parent::__construct();
        $this->my_admin();
         $this->load->model('admin/profit/ProfitModleAdmin', 'ProfitModleAdmin');
    }
    
    public function index(){
       $this->load->library('form_validation');
        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/profit/index');        
        $this->load->view('templates/admin/common/footer'); 
    }
    
    public function insertProfit(){
       $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
         $config = array(
             array(
                'field' => 'data[SemesterName]',
                'label' => 'Semester',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[Session]',
                'label' => 'Session',
                'rules' => 'required'
            )  
        );
        
          $this->form_validation->set_rules($config);
         if ($this->form_validation->run() == FALSE){
//                    redirect(base_url('admin/campus'));
            $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/profit/index');
        $this->load->view('templates/admin/common/footer');
            
		}
		else
		{
                    $data = $this->input->post('data', TRUE); 
                    $this->ProfitModleAdmin->addProfitInfo($data);
//			$this->load->view('formsuccess');
		}

        
    } 
        
   
    //put your code here
}

?>
