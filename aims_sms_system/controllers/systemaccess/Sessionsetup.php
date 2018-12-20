<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */

class SessionSetup extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->my_admin();
        $this->load->model('admin/sessionsetup/SessionModleAdmin', 'SessionModleAdmin');
    }

     public function index() {
        $data['listdata'] = $this->SessionModleAdmin->getlistSession(); 
        $data['setting']='active';
        $data['sessionname']='active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu',$data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu'); // top bar menu
        $this->load->view('system_path/admin/sessionsetup/index',$data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
    }

    public function insertSession() {
        //  print_r($_POST);
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
            array(
                'field' => 'data[session]',
                'label' => 'Session',
                'rules' => 'required|xss_clean'
            )
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $data = $this->input->post('data', TRUE);
            $result = $this->SessionModleAdmin->duplicateSessionInfo($data);

            if (!$result) {
                $this->SessionModleAdmin->addSessionInfo($data);

                $sdata['message'] = 'Session information updated';
                $this->session->set_userdata($sdata);
                redirect(admin_Url()."/sessionsetup");
            } else {
                $sdata['errormessage'] = 'Duplicate Session information Found!';
                $this->session->set_userdata($sdata);

                 redirect(admin_Url()."/sessionsetup");
            }
        }
    }

    
    public function editdsession($id) {
       
        $id=(int)$id;
        $data['editData'] = $this->SessionModleAdmin->editSessionInfo($id);
        if(!empty($data['editData']))
        {
            $data['setting'] = 'active';
            $data['medium'] = 'active';
            $this->load->view('system_path/admin/common/header_link'); // header Css link
            $this->load->view('system_path/admin/common/header'); // body header
            $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
            $this->load->view('system_path/admin/common/top_menu'); // top bar menu
            $this->load->view('system_path/admin/sessionsetup/editsession', $data); // ...........body content page...........
            $this->load->view('system_path/admin/common/footer'); // footer & script link
        }
        else{
            $sdata['errormessage'] = 'Session information not found';
            $this->session->set_userdata($sdata);
            redirect(admin_Url()."/sessionsetup");
        }
        
    }

    public function updatesession($id) {
       
       $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
            array(
                'field' => 'data[session]',
                'label' => 'Session',
                'rules' => 'required|xss_clean'
            )
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $data = $this->input->post('data', TRUE);
            $result = $this->SessionModleAdmin->duplicateSessionInfo($data);

            if (!$result) {
                $this->SessionModleAdmin->updateSessionInfo($data, $id);
                $sdata['message'] = ' Session information updated';
                $this->session->set_userdata($sdata);
                redirect(admin_Url()."/sessionsetup");
            } else {
                $sdata['errormessage'] = 'Duplicate Session information Found!';
                $this->session->set_userdata($sdata);

                redirect(admin_Url()."/sessionsetup/editdsession/".$id);
            }
        }
    }

    public function deletesession($id) {
        $id = (int) $id;
        $data['delete_config'] = $this->SessionModleAdmin->checkSessionInfo($id);
        // print_r($data); die();
        if (!empty($data['delete_config'])) {
            $sdata['errormessage'] = 'Session Information Not Deleted..! Because Already Use This Anothor Portion..! So Please Contact your Software Administrator..';
            $this->session->set_userdata($sdata);
           redirect(admin_Url()."/sessionsetup");
        } else {
            $this->SessionModleAdmin->deleteSessionInfo($id);
            $sdata['message'] = 'Session information deleted';
            $this->session->set_userdata($sdata);
           redirect(admin_Url()."/sessionsetup");
        }
    }

}

