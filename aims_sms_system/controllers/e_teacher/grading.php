<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */


class Grading extends MY_Controller {
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->teacher_logged_auth();
         $this->load->model('admin/grading/GradingModleAdmin', 'GradingModleAdmin');
    }
    
    public function index(){
        $this->load->library('form_validation');
         
        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/grading/index');        
        $this->load->view('templates/admin/common/footer');
 
    }  
    public function insertgrading() {
       // print_r($_POST);
         $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
         $config = array(
            array(
                'field' => 'data[grade]',
                'label' => 'Grade ',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[gradePoint]',
                'label' => 'Grade Point',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[fromPercentage]',
                'label' => 'From Percentage',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[toPercentage]',
                'label' => 'To Percentage',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[outOf]',
                'label' => 'Phone Number',
                'rules' => 'required'
            )
           );
         
           $this->form_validation->set_rules($config);
        
        if ($this->form_validation->run() == FALSE){
//                    redirect(base_url('admin/campus'));
            $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/grading/index');        
        $this->load->view('templates/admin/common/footer');
            
		}
		else
		{
                    $data = $this->input->post('data', TRUE); 
                    $result = $this->GradingModleAdmin->duplicateGradingInfo($data);

            if (!$result) {
                    $this->GradingModleAdmin->addGradingInfo($data);
                     
                     $sdata['message'] = 'Successfull!';
                $this->session->set_userdata($sdata);

               redirect('admin/grading/gradinglist', 'refresh');
            } else {
                $sdata['message'] = 'Duplicate Entry Found!';
                $this->session->set_userdata($sdata);

                redirect('admin/grading/gradinglist', 'refresh');
            }
//			$this->load->view('formsuccess');
		}

        
    }
    public function gradinglist(){
        
        $data = array();
        $data['gradinglist']=$this->GradingModleAdmin->gradinglist();
      //  print_r($data['gradinglist']); die();
        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/grading/gradinglist', $data );
        $this->load->view('templates/admin/common/footer');
    }
    
    public function editgrading($id) {
       
//        echo $id; exit;
        $this->load->view('templates/admin/common/header');

        $data['editData'] = $this->GradingModleAdmin->editGradingInfo($id);
//        print_r($data); exit;
        $this->load->view('templates/admin/grading/editgrading', $data);
        $this->load->view('templates/admin/common/footer');
    }

    public function updategrading($id) {

  
       
            $data = $this->input->post('data', TRUE);
            $result = $this->GradingModleAdmin->duplicateGradingInfo($data);

            if (!$result) {
                $this->GradingModleAdmin->updateGradingInfo($data, $id);
                 $sdata['message'] = 'Successfull!';
                $this->session->set_userdata($sdata);

               redirect('admin/grading/gradinglist', 'refresh');
            } else {
                $sdata['message'] = 'Duplicate Entry Found!';
                $this->session->set_userdata($sdata);

                redirect('admin/grading/gradinglist', 'refresh');
            }
        
    }

    public function deletegrading($id) {

        $this->GradingModleAdmin->deleteGradingInfo($id);
        redirect('admin/grading/gradinglist', 'refresh');
    }
}


