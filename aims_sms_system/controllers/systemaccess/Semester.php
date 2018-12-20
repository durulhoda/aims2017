<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */

class Semester extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->my_admin();
        $this->load->model('admin/semester/SemesterModleAdmin', 'SemesterModleAdmin');
    }

   public function index() {
       
        $data['listdata'] = $this->SemesterModleAdmin->getSemesterInfo();
        $data['setting']='active';
        $data['examterm']='active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu',$data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu'); // top bar menu
        $this->load->view('system_path/admin/semester/index',$data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
    }

    public function insertSemester() {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
            array(
                'field' => 'data[semester]',
                'label' => 'Exam Term',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $data = $this->input->post('data', TRUE);
            $result = $this->SemesterModleAdmin->duplicateSemesterInfo($data);

            if (!$result) {
                $this->SemesterModleAdmin->addSemesterInfo($data);
                $sdata['message'] = 'Exam Term information updated';
                $this->session->set_userdata($sdata);
                redirect(admin_Url()."/semester");
            } else {
                $sdata['errormessage'] = 'Duplicate Exam Term information Found!';
                $this->session->set_userdata($sdata);

                 redirect(admin_Url()."/semester");
            }
        }    
    }

   
    public function editsemester($id) {
        $id=(int)$id;
        $data['editData'] = $this->SemesterModleAdmin->editSemesterInfo($id);
        if(!empty($data['editData']))
        {
            $data['setting'] = 'active';
            $data['medium'] = 'active';
            $this->load->view('system_path/admin/common/header_link'); // header Css link
            $this->load->view('system_path/admin/common/header'); // body header
            $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
            $this->load->view('system_path/admin/common/top_menu'); // top bar menu
            $this->load->view('system_path/admin/semester/editsemester', $data); // ...........body content page...........
            $this->load->view('system_path/admin/common/footer'); // footer & script link
        }
        else{
            $sdata['errormessage'] = 'Exam Term information not found';
            $this->session->set_userdata($sdata);
            redirect(admin_Url()."/semester");
        }
        
    }

    public function updatesemester($id) {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
            array(
                'field' => 'data[semester]',
                'label' => 'Exam Term',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $id = (int) $id;
            
            $data = $this->input->post('data', TRUE);
            $result = $this->SemesterModleAdmin->duplicateSemesterInfo($data);

            if (!$result) {
                $this->SemesterModleAdmin->updateSemesterInfo($data, $id);
                $sdata['message'] = ' Exam Term information updated';
                $this->session->set_userdata($sdata);
                redirect(admin_Url()."/semester");
            } else {
                $sdata['errormessage'] = 'Duplicate Exam Term information Found!';
                $this->session->set_userdata($sdata);

                redirect(admin_Url()."/semester/editsemester/".$id);
            }
            
        }
    }
    
        public function deletesemester($id) { 
            $id = (int) $id;
            $data['delete_config'] = $this->SemesterModleAdmin->checkSemesterInfo($id);
           // print_r($data); die();
            if(!empty($data['delete_config'])){
            $sdata['errormessage'] = 'Exam Term Information Not Deleted..! Because Already Use This Anothor Portion..! So Please Contact your Software Administrator..';
            $this->session->set_userdata($sdata);
          redirect(admin_Url()."/semester");
            }
            else
                {
            $this->SemesterModleAdmin->deleteSemesterInfo($id);
            $sdata['message'] = 'Exam Term information deleted';
            $this->session->set_userdata($sdata);
          redirect(admin_Url()."/semester");     
       }
    
   }

}

