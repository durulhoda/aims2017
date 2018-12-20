<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */

class TransportFuel extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->my_admin();
        $this->load->model('admin/transportfuel/TransportFuelModleAdmin', 'TransportFuelModleAdmin');
    }

    public function index() {
        $data['transportfuellist'] = $this->TransportFuelModleAdmin->getTransportFuellist();
        $data['transport']='active';
        $data['transportfuel']='active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/transport/transportfuel'); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
    }

    public function insertTransportfuel() {
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
                'field' => 'data[fuelCost]',
                'label' => 'Fuel Cost',
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

            redirect(admin_Url() . "/transportfuel/index");
            
        } else {
            $data = $this->input->post('data', TRUE);
            $result = $this->TransportFuelModleAdmin->duplicateTransportfuel($data);

            if (!$result) {
                $this->TransportFuelModleAdmin->addTransportfuel($data);
                $sdata['message'] = 'Successfull!';
                $this->session->set_userdata($sdata);

                redirect(admin_Url() . "/transportfuel/index");
            } else {
                $sdata['errormessage'] = 'Duplicate Entry Found!';
                $this->session->set_userdata($sdata);

                redirect(admin_Url() . "/transportfuel/index");
            }
        }
    }

    public function transportFuellist() {

        $data['transportfuellist'] = $this->TransportFuelModleAdmin->getTransportFuellist();

        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/transportfuel/viewtransportfuellist', $data);
        $this->load->view('templates/admin/common/footer');
    }

    public function editTransportFuel($id) {


        $data['editData'] = $this->TransportFuelModleAdmin->editTransportFuel($id);
        $data['transport'] = 'active';
        $data['transportfuel'] = 'active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/transport/edittransportfuel'); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
    }

    public function updateTransportFuel($id) {


        $data = $this->input->post('data', TRUE);
        $result = $this->TransportFuelModleAdmin->duplicateTransportfuel($data);

        if (!$result) {
            $this->TransportFuelModleAdmin->updateTransportFuel($data, $id);
            $sdata['message'] = 'Successfull!';
            $this->session->set_userdata($sdata);
            redirect(admin_Url() . "/transportfuel/index");
        } else {
            $sdata['errormessage'] = 'Duplicate Entry Found!';
            $this->session->set_userdata($sdata);

           

            $data['editData'] = $this->TransportFuelModleAdmin->editTransportFuel($id);
            redirect(admin_Url() . "/transportfuel/index");
        }
    }

    public function deleteTransportFuel($id) {


        $this->TransportFuelModleAdmin->deleteTransportFuel($id);
        $sdata['message'] = 'Successfully Deleted';
        $this->session->set_userdata($sdata);
        redirect(admin_Url() . "/transportfuel/index");
    }

    //put your code here
}

