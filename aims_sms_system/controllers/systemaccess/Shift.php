<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */

class Shift extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->my_admin();
        $this->load->model('admin/shift/ShiftModleAdmin', 'ShiftModleAdmin');
    }

     public function index() {
        $data['listdata'] = $this->ShiftModleAdmin->getlistShift(); 
        $data['setting']='active';
        $data['shift']='active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu',$data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu'); // top bar menu
        $this->load->view('system_path/admin/shift/index',$data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
    }
    
    public function insertShift() {
       
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
            array(
                'field' => 'data[shiftName]',
                'label' => 'Shiht Name',
                'rules' => 'required'
            )
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $data = $this->input->post('data', TRUE);
            $result = $this->ShiftModleAdmin->duplicateshiftInfo($data);

            if (!$result) {

                $this->ShiftModleAdmin->addShiftInfo($data);

                $sdata['message'] = 'Shift information updated';
                $this->session->set_userdata($sdata);
                redirect(admin_Url()."/shift");
            } else {
                $sdata['errormessage'] = 'Duplicate Shift information Found!';
                $this->session->set_userdata($sdata);

                 redirect(admin_Url()."/shift");
            }
        }
    }

    public function editdshift($id) {
        $id=(int)$id;
        $data['editData'] = $this->ShiftModleAdmin->editShiftInfo($id);
        if(!empty($data['editData']))
        {
            $data['setting'] = 'active';
            $data['medium'] = 'active';
            $this->load->view('system_path/admin/common/header_link'); // header Css link
            $this->load->view('system_path/admin/common/header'); // body header
            $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
            $this->load->view('system_path/admin/common/top_menu'); // top bar menu
            $this->load->view('system_path/admin/shift/editshift', $data); // ...........body content page...........
            $this->load->view('system_path/admin/common/footer'); // footer & script link
        }
        else{
            $sdata['errormessage'] = 'Shift information not found';
            $this->session->set_userdata($sdata);
            redirect(admin_Url()."/shift");
        }

    }

    public function updateshift($id) {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
            array(
                'field' => 'data[shiftName]',
                'label' => 'Shiht Name',
                'rules' => 'required'
            )
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $data = $this->input->post('data', TRUE);
            $result = $this->ShiftModleAdmin->duplicateshiftInfo($data, $id);

            if (!$result) {
            $this->ShiftModleAdmin->updateShiftInfo($data, $id);
                $sdata['message'] = ' Shift information updated';
                $this->session->set_userdata($sdata);
                redirect(admin_Url()."/shift");
            } else {
                $sdata['errormessage'] = 'Duplicate Shift information Found!';
                $this->session->set_userdata($sdata);

                redirect(admin_Url()."/shift/editdshift/".$id);
            }
        }
    }
        public function deleteshift($id) { 
            $id = (int) $id;
            $data['delete_config'] = $this->ShiftModleAdmin->checkShiftInfo($id);
           // print_r($data); die();
            if(!empty($data['delete_config'])){
            $sdata['errormessage'] = 'Shift Information Not Deleted..! Because Already Use This Anothor Portion..! So Please Contact your Software Administrator..';
            $this->session->set_userdata($sdata);
            redirect(admin_Url() . "/shift");
        }
            else
                {
            $this->ShiftModleAdmin->deleteShiftInfo($id);
            $sdata['message'] = 'Shift information deleted';
            $this->session->set_userdata($sdata);
            redirect(admin_Url() . "/shift");
        }
    
   }

}
