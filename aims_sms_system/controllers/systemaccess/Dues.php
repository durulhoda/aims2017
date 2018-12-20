<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */

class Dues extends MY_Controller{
    
    
     public function __construct() {
        parent::__construct();
        $this->my_admin();
        $this->load->model('admin/dues/DuesModleAdmin', 'DuesModleAdmin');
    }
    
    public function index(){
           $this->load->helper(array('form', 'url'));
            $this->load->view('templates/admin/common/header');
            $this->load->view('templates/admin/dues/index');            
            $this->load->view('templates/admin/common/footer');

    }
    
    public function insertDues(){
      //  print_r($_POST);
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
            array(
                'field' => 'data[session]',
                'label' => 'Session',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[semester]',
                'label' => 'Semester',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[rollnumber]',
                'label' => 'Roll Number',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[payment]',
                'label' => 'Phonpaymente',
                'rules' => 'required'
            )
            );
         $this->form_validation->set_rules($config);
        
        if ($this->form_validation->run() == FALSE){
//                    redirect(base_url('admin/campus'));
         $this->load->view('templates/admin/common/header');
         $this->load->view('templates/admin/dues/index');         
         $this->load->view('templates/admin/common/footer');
		}
		else
		{
                    $data = $this->input->post('data', TRUE); 
                    $this->DuesModleAdmin->addDuesInfo($data);
//			$this->load->view('formsuccess');
		}

       
        
    }

    //put your code here
}

?>
