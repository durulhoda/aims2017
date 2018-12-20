<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */

class TransportFees extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->my_admin();
        $this->load->model('admin/transportfees/TransportFeesModleAdmin', 'TransportFeesModleAdmin');
    }

    public function index() {
         
        $data['transport'] = 'active';
        $data['transportfees'] = 'active';
        $data['transportfeeslist'] = $this->TransportFeesModleAdmin->getTransportFeeslist();
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/transport/transportfees', $data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
    }

    public function insertTransportfees() {
        // print_r($_POST);
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
            array(
                'field' => 'data[categoryId]',
                'label' => 'Category',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[transportId]',
                'label' => 'Transport Name',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[rootId]',
                'label' => 'Transport Root',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[transportFees]',
                'label' => 'Transport Fees',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            redirect(admin_Url() . "/transportfees/index");
        } else {
            $data = $this->input->post('data', TRUE);
            $result = $this->TransportFeesModleAdmin->duplicateTransportfees($data);

            if (!$result) {
                $this->TransportFeesModleAdmin->addTransportfees($data);
                $sdata['message'] = 'Successfull!';
                $this->session->set_userdata($sdata);

                redirect(admin_Url() . "/transportfees/index");
            } else {
                $sdata['errormessage'] = 'Duplicate Entry Found!';
                $this->session->set_userdata($sdata);

                redirect(admin_Url() . "/transportfees/index");
            }
        }
    }

    public function transportFeeslist() {

        $data['transportfeeslist'] = $this->TransportFeesModleAdmin->getTransportFeeslist();

        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/transportfees/viewtransportfeeslist', $data);
        $this->load->view('templates/admin/common/footer');
    }

    public function editTransportFees($id) {

      

        $data['editData'] = $this->TransportFeesModleAdmin->editTransportFees($id);
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/transport/edittransportfees', $data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
    }



    public function updateTransportFees($id) {


        $data = $this->input->post('data', TRUE);
        $result = $this->TransportFeesModleAdmin->duplicateTransportFees($data);

        if (!$result) {
            $this->TransportFeesModleAdmin->updateTransportFees($data, $id);
            $sdata['message'] = 'Successfull!';
            $this->session->set_userdata($sdata);

            redirect(admin_Url() . "/transportfees/index");
        } else {
            $sdata['errormessage'] = 'Duplicate Entry Found!';
            $this->session->set_userdata($sdata);

            redirect(admin_Url() . "/transportfees/index");
        }
    }

    public function deleteTransportFees($id) {


        $this->TransportFeesModleAdmin->deleteTransportFees($id);
        $sdata['message'] = 'Successfully Deleted';
        $this->session->set_userdata($sdata);
       redirect(admin_Url() . "/transportfees/index");
    }

    //put your code here
}

