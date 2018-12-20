<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */

class Group extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->my_admin();
        $this->load->model('admin/group/GroupModleAdmin', 'GroupModleAdmin');
    }

    public function index() {
        $data['listdata'] = $this->GroupModleAdmin->getlistGroup();
        $data['setting']='active';
        $data['group']='active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu',$data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu'); // top bar menu
        $this->load->view('system_path/admin/group/index',$data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
    }

    public function insertGroup() {
        // print_r($_POST);
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $config = array(
            array(
                'field' => 'data[groupName]',
                'label' => 'Group Name',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $data = $this->input->post('data', TRUE);
            $result = $this->GroupModleAdmin->duplicateGroupInfo($data);

            if (!$result) {
                $this->GroupModleAdmin->addGroupInfo($data);

                $sdata['message'] = 'Group information saved';
                $this->session->set_userdata($sdata);

                redirect(admin_Url()."/group");
            } else {
                $sdata['errormessage'] = 'Duplicate Group information Found!';
                $this->session->set_userdata($sdata);

                 redirect(admin_Url()."/group");
            }
        }
    }

    
    public function editdgroup($id) {
        $id=(int)$id;
        $data['editData'] = $this->GroupModleAdmin->editGroupInfo($id);
        if(!empty($data['editData']))
        {
            $data['setting'] = 'active';
            $data['medium'] = 'active';
            $this->load->view('system_path/admin/common/header_link'); // header Css link
            $this->load->view('system_path/admin/common/header'); // body header
            $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
            $this->load->view('system_path/admin/common/top_menu'); // top bar menu
            $this->load->view('system_path/admin/group/editgroup', $data); // ...........body content page...........
            $this->load->view('system_path/admin/common/footer'); // footer & script link
        }
        else{
            $sdata['errormessage'] = 'Group information not found';
            $this->session->set_userdata($sdata);
             redirect(admin_Url()."/group");
        }

    }

    public function updategroup($id) {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $config = array(
            array(
                'field' => 'data[groupName]',
                'label' => 'Group Name',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $data = $this->input->post('data', TRUE);
            $result = $this->GroupModleAdmin->duplicateGroupInfo($data);

            if (!$result) {
                $this->GroupModleAdmin->updateGroupInfo($data, $id);
                $sdata['message'] = ' Group information updated';
                $this->session->set_userdata($sdata);
                redirect(admin_Url()."/group");
            } else {
                $sdata['errormessage'] = 'Duplicate Group information Found!';
                $this->session->set_userdata($sdata);

                redirect(admin_Url()."/group/editdgroup/".$id);
            }
        }
    }
    
    public function deletegroup($id) { 
        $id = (int) $id;
        $data['delete_config'] = $this->GroupModleAdmin->checkGroupInfo($id);
       // print_r($data); die();
        if(!empty($data['delete_config'])){
        $sdata['errormessage'] = 'Group Information Not Deleted..! Because Already Use This Anothor Portion..! So Please Contact your Software Administrator..';
        $this->session->set_userdata($sdata);
        redirect(admin_Url() . "/group");
        }
        else
            {
        $this->GroupModleAdmin->deleteGroupInfo($id);
        $sdata['message'] = 'Group information deleted';
        $this->session->set_userdata($sdata);
       redirect(admin_Url() . "/group");     
     }
    
   }

    //put your code here
}

