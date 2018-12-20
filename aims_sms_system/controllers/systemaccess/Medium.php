<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */

class Medium extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->my_admin();
        $this->load->model('admin/medium/MediumModleAdmin', 'MediumModleAdmin');
    }

    public function index() {
        $data['listdata'] = $this->MediumModleAdmin->getlistMedium();
        $data['setting']='active';
        $data['medium']='active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu',$data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu'); // top bar menu
        $this->load->view('system_path/admin/medium/index',$data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
    }

    public function insertMedium() {
        // print_r($_POST);
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
            array(
                'field' => 'data[mediumName]',
                'label' => 'Medium Name',
                'rules' => 'required|xss_clean'
            )
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $data = $this->input->post('data', TRUE);
            $result = $this->MediumModleAdmin->duplicateMediumInfo($data);

            if (!$result) {
                $this->MediumModleAdmin->addMediumInfo($data);
                
                $sdata['message'] = 'Medium information saved';
                $this->session->set_userdata($sdata);

                redirect(admin_Url()."/medium");
            } else {
                $sdata['errormessage'] = 'Duplicate Medium information Found!';
                $this->session->set_userdata($sdata);

                redirect(admin_Url()."/medium");
            }
        }
    }

    
    public function editdmedium($id) {
        $id=(int)$id;
        $data['editData'] = $this->MediumModleAdmin->editMediumInfo($id);
        if(!empty($data['editData']))
        {
            $data['setting'] = 'active';
            $data['medium'] = 'active';
            $this->load->view('system_path/admin/common/header_link'); // header Css link
            $this->load->view('system_path/admin/common/header'); // body header
            $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
            $this->load->view('system_path/admin/common/top_menu'); // top bar menu
            $this->load->view('system_path/admin/medium/editmedium', $data); // ...........body content page...........
            $this->load->view('system_path/admin/common/footer'); // footer & script link
        }
        else{
            $sdata['errormessage'] = 'Medium information not found';
            $this->session->set_userdata($sdata);
             redirect(admin_Url()."/medium");
        }
    }

    public function updatemedium($id) {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
            array(
                'field' => 'data[mediumName]',
                'label' => 'Medium Name',
                'rules' => 'required|xss_clean'
            )
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            $sdata['errormessage'] = 'Invalid information';
            $this->session->set_userdata($sdata);
            redirect(admin_Url()."/medium/editdmedium/".$id);
        } else {
            $id=(int)$id;
            $data = $this->input->post('data', TRUE);
            $result = $this->MediumModleAdmin->duplicateMediumInfo($data);

            if (!$result) {
                $this->MediumModleAdmin->updateMediumInfo($data, $id);
                $sdata['message'] = ' Medium information updated';
                $this->session->set_userdata($sdata);
                redirect(admin_Url()."/medium");
            } else {
                $sdata['errormessage'] = 'Duplicate Medium information Found!';
                $this->session->set_userdata($sdata);

                redirect(admin_Url()."/medium/editdmedium/".$id);
            }
        }
    }

      public function deletemedium($id) { 
        $id = (int) $id;
        $data['delete_config'] = $this->MediumModleAdmin->checkProgramInfo($id);
       // print_r($data); die();
        if(!empty($data['delete_config'])){
        $sdata['errormessage'] = 'Medium Information Not Deleted..! Because Already Use This Anothor Portion..! So Please Contact your Software Administrator..';
        $this->session->set_userdata($sdata);
       redirect(admin_Url() . "/medium");
        }
        else
            {
        $this->MediumModleAdmin->deleteMediumInfo($id);
        $sdata['message'] = 'Medium information deleted';
        $this->session->set_userdata($sdata);
        redirect(admin_Url() . "/medium");      
    }
    
    }

}
