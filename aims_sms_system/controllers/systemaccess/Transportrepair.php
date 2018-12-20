<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */

class TransportRepair extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->my_admin();
        $this->load->model('admin/transportrepair/TransportRepairModleAdmin', 'TransportRepairModleAdmin');
    }

    public function index() {
        $data['transportrepairlist'] = $this->TransportRepairModleAdmin->getTransportRepairlist();
        $data['transport']='active';
        $data['transportrepair']='active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/transport/transportrepair'); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
    }

    public function insertTransportrepair() {
        // print_r($_POST);
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
            
            array(
                'field' => 'data[transportId]',
                'label' => 'Transport Name',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[repairCost]',
                'label' => 'Repair Cost',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[date]',
                'label' => 'Date of Buy',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            redirect(admin_Url() . "/transportrepair/index");
        } else {
            $data = $this->input->post('data', TRUE);
            $result = $this->TransportRepairModleAdmin->duplicateTransportrepair($data);

            if (!$result) {
                $this->TransportRepairModleAdmin->addTransportrepair($data);
                $sdata['message'] = 'Successfull!';
                $this->session->set_userdata($sdata);

            redirect(admin_Url() . "/transportrepair/index");
            } else {
                $sdata['errormessage'] = 'Duplicate Entry Found!';
                $this->session->set_userdata($sdata);

            redirect(admin_Url() . "/transportrepair/index");
            }
        }
    }

    public function transportRepairlist() {

        $data['transportrepairlist'] = $this->TransportRepairModleAdmin->getTransportRepairlist();

        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/transportrepair/viewtransportrepairlist', $data);
        $this->load->view('templates/admin/common/footer');
    }

    public function editTransportRepair($id) {



        $data['editData'] = $this->TransportRepairModleAdmin->editTransportRepair($id);
        $data['transport'] = 'active';
        $data['transportrepair'] = 'active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/transport/edittransportrepair'); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
    }

    public function updateTransportRepair($id) {


        $data = $this->input->post('data', TRUE);
        $result = $this->TransportRepairModleAdmin->duplicateTransportrepair($data);

        if (!$result) {
            $this->TransportRepairModleAdmin->updateTransportRepair($data, $id);
            $sdata['message'] = 'Successfull!';
            $this->session->set_userdata($sdata);

                 redirect(admin_Url() . "/transportrepair/index");
        } else {
            $sdata['errormessage'] = 'Duplicate Entry Found!';
            $this->session->set_userdata($sdata);



            $data['editData'] = $this->TransportRepairModleAdmin->editTransportRepair($id);
                 redirect(admin_Url() . "/transportrepair/index");
        }
    }

    public function deleteTransportRepair($id) {


        $this->TransportRepairModleAdmin->deleteTransportRepair($id);
        $sdata['message'] = 'Successfully Deleted';
        $this->session->set_userdata($sdata);
      redirect(admin_Url() . "/transportrepair/index");
    }

    //put your code here
}

