<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */


class Gradesheet extends MY_Controller{
    
      public function __construct() {
        parent::__construct();
        $this->teacher_logged_auth();
         $this->load->model('admin/gradesheet/GradesheetModleAdmin', 'GradesheetModleAdmin');
    //put your code here
}
    public function index(){
         $this->load->library('form_validation');
         $this->load->view('templates/admin/common/header');
         $this->load->view('templates/admin/gradesheet/index');
         $this->load->view('templates/admin/common/footer');

         }
    
    public function insertExpensesadd(){
       $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
         $config = array(
             array(
                'field' => 'data[semesterId]',
                'label' => 'Semester Name',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[programId]',
                'label' => 'program',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[Subject]',
                'label' => 'Subject',
                'rules' => 'required'
            ),
              array(
                'field' => 'data[level]',
                'label' => 'level',
                'rules' => 'required'
            ),
             array(
                'field' => 'data[studentid]',
                'label' => 'studentid ',
                'rules' => 'required'
            )
       );
          $this->form_validation->set_rules($config);
        
        if ($this->form_validation->run() == FALSE){
//                    redirect(base_url('admin/campus'));
            $this->load->view('templates/admin/gradesheet/index');
		}
		else
		{
                    $data = $this->input->post('data', TRUE); 
                    $this->GradesheetModleAdmin->addGradesheetInfo($data);
//			$this->load->view('formsuccess');
		}
        
    
    }

}
