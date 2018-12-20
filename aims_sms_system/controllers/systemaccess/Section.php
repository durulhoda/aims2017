<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */

class Section extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->my_admin();
        $this->load->model('admin/section/SectionModleAdmin', 'SectionModleAdmin');
    }

    public function index() {
        $data['listdata'] = $this->SectionModleAdmin->getlistSection();
        $data['setting']='active';
        $data['section']='active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu',$data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu'); // top bar menu
        $this->load->view('system_path/admin/section/index',$data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
    }

    public function insertSection() {
        //  print_r($_POST);
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
            array(
                'field' => 'data[sectionName]',
                'label' => 'Section Name',
                'rules' => 'required|xss_clean'
            )
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $data = $this->input->post('data', TRUE);
            $result = $this->SectionModleAdmin->duplicateSectionInfo($data);

            if (!$result) {
                $this->SectionModleAdmin->addSectionInfo($data);

                $sdata['message'] = ' Section information updated';
                $this->session->set_userdata($sdata);
                redirect(admin_Url()."/section");
            } else {
                $sdata['errormessage'] = 'Duplicate Section information Found!';
                $this->session->set_userdata($sdata);

                 redirect(admin_Url()."/section");
            }
        }
    }

    public function editdsection($id) {
       
        $id=(int)$id;
        $data['editData'] = $this->SectionModleAdmin->editSectionInfo($id);
        if(!empty($data['editData']))
        {
            $data['setting'] = 'active';
            $data['medium'] = 'active';
            $this->load->view('system_path/admin/common/header_link'); // header Css link
            $this->load->view('system_path/admin/common/header'); // body header
            $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
            $this->load->view('system_path/admin/common/top_menu'); // top bar menu
            $this->load->view('system_path/admin/section/editsection', $data); // ...........body content page...........
            $this->load->view('system_path/admin/common/footer'); // footer & script link
        }
        else{
            $sdata['errormessage'] = 'Section information not found';
            $this->session->set_userdata($sdata);
             redirect(admin_Url()."/section");
        }

    }

    public function updatesection($id) {
       
       $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
            array(
                'field' => 'data[sectionName]',
                'label' => 'Section Name',
                'rules' => 'required|xss_clean'
            )
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } 
        else 
        {
            $data = $this->input->post('data', TRUE);
            $result = $this->SectionModleAdmin->duplicateSectionInfo($data);

            if (!$result) {
                $this->SectionModleAdmin->updateSectionInfo($data, $id);
                $sdata['message'] = ' Section information updated';
                $this->session->set_userdata($sdata);
                redirect(admin_Url()."/section");
            } else {
                $sdata['errormessage'] = 'Duplicate Section information Found!';
                $this->session->set_userdata($sdata);

                redirect(admin_Url()."/section/editdsection/".$id);
            }
        }
    }
    
    public function deletesection($id) { 
            $id = (int) $id;
            $data['delete_config'] = $this->SectionModleAdmin->checkSectionInfo($id);
           // print_r($data); die();
            if(!empty($data['delete_config'])){
            $sdata['errormessage'] = 'Section Information Not Deleted..! Because Already Use This Anothor Portion..! So Please Contact your Software Administrator..';
            $this->session->set_userdata($sdata);
            redirect(admin_Url() . "/section");
        }
            else
                {
            $this->SectionModleAdmin->deleteSectionInfo($id);
            $sdata['message'] = 'Section information deleted';
            $this->session->set_userdata($sdata);
             redirect(admin_Url() . "/section");
        }
    
   }

}

