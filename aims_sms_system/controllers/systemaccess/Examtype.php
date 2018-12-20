<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */

class ExamType extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->my_admin();
        $this->load->model('admin/examtype/ExamTypeModleAdmin', 'ExamTypeModleAdmin');
    }

    public function index() {
        $data['listdata'] = $this->ExamTypeModleAdmin->getExamTypeInfo();
        $data['setting']='active';
        $data['examtype']='active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu',$data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu'); // top bar menu
        $this->load->view('system_path/admin/examtype/index'); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
    }

    public function insertExamType() {
//        print_r($_POST);

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
            array(
                'field' => 'data[examtypeName]',
                'label' => 'ExamType Name',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $data = $this->input->post('data', TRUE);
            $result = $this->ExamTypeModleAdmin->duplicateExamTypeInfo($data);

            if (!$result) {
                $this->ExamTypeModleAdmin->addExamTypeInfo($data);
                $sdata['message'] = 'Exam Type information updated';
                $this->session->set_userdata($sdata);
                redirect(admin_Url()."/examtype");
            } else {
                $sdata['errormessage'] = 'Duplicate Exam Type information Found!';
                $this->session->set_userdata($sdata);
                 redirect(admin_Url()."/examtype");
            }
        }
    }

    public function editexamtype($id) {
        
        $id=(int)$id;
        $data['editData'] = $this->ExamTypeModleAdmin->editExamTypeInfo($id);
        if(!empty($data['editData']))
        {
            $data['setting'] = 'active';
            $data['medium'] = 'active';
            $this->load->view('system_path/admin/common/header_link'); // header Css link
            $this->load->view('system_path/admin/common/header'); // body header
            $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
            $this->load->view('system_path/admin/common/top_menu'); // top bar menu
            $this->load->view('system_path/admin/examtype/editexamtype', $data); // ...........body content page...........
            $this->load->view('system_path/admin/common/footer'); // footer & script link
        }
        else{
            $sdata['errormessage'] = 'Exam type information not found';
            $this->session->set_userdata($sdata);
            redirect(admin_Url()."/examtype");
        }
    }

    public function updateexamtype($id) {

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
            array(
                'field' => 'data[examtypeName]',
                'label' => 'Exam Type',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            $this->editexamtype($id);
        } 
        else {
            $data = $this->input->post('data', TRUE);
            $result = $this->ExamTypeModleAdmin->duplicateExamTypeInfo($data);

            if (!$result) {
                $this->ExamTypeModleAdmin->updateExamTypeInfo($data, $id);
                $sdata['message'] = ' Exam Type information updated';
                $this->session->set_userdata($sdata);
                redirect(admin_Url()."/examtype");
            }
            else
            {
                $sdata['errormessage'] = 'Duplicate Exam Type information Found!';
                $this->session->set_userdata($sdata);
                redirect(admin_Url()."/examtype/editexamtype/".$id);
            }		 
        }
    }
        public function deleteexamtype($id) { 
            $id = (int) $id;
            $data['delete_config'] = $this->ExamTypeModleAdmin->checkExamtypeInfo($id);
           // print_r($data); die();
            if(!empty($data['delete_config'])){
            $sdata['errormessage'] = 'Exam Type Information Not Deleted..! Because Already Use This Anothor Portion..! So Please Contact your Software Administrator..';
            $this->session->set_userdata($sdata);
          redirect(admin_Url()."/examtype"); 
            }
            else
                {
            $this->ExamTypeModleAdmin->deleteExamTypeInfo($id);
            $sdata['message'] = 'Exam Type information deleted';
            $this->session->set_userdata($sdata);
         redirect(admin_Url()."/examtype");     
       }
    
   }

}

