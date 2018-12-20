<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */


class Result_preview extends MY_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->teacher_logged_auth();
         $this->load->model('admin/result_preview/Result_previewModleAdmin', 'Result_previewModleAdmin');
    //put your code here
}
    public function index(){
         $this->load->library('form_validation');
         $this->load->view('templates/admin/common/header');
         $this->load->view('templates/admin/result_preview/index');
         $this->load->view('templates/admin/common/footer');

         }
    
    public function insertStudentmarksadd(){
       $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
         $config = array(
             array(
                'field' => 'data[session]',
                'label' => 'session',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[semesterId]',
                'label' => 'semester',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[programId]',
                'label' => 'program',
                'rules' => 'required'
            ),
             array(
                'field' => 'data[campusId]',
                'label' => 'campus',
                'rules' => 'required'
            ),
             array(
                'field' => 'data[sectionId]',
                'label' => 'section',
                'rules' => 'required'
            ),
             array(
                'field' => 'data[shiftId]',
                'label' => 'shift',
                'rules' => 'required'
            ),
             array(
                'field' => 'data[level]',
                'label' => 'level',
                'rules' => 'required'
            ) 
       );
          $this->form_validation->set_rules($config);
        
        if ($this->form_validation->run() == FALSE){
//                    redirect(base_url('admin/campus'));
            $this->load->view('templates/admin/result_preview/index');
		}
		else
		{
                    $data = $this->input->post('data', TRUE); 
                    $this->Result_previewModleAdmin->addResult_previewInfo($data);
//			$this->load->view('formsuccess');
		}
        
    
    }
    //put your code here
}