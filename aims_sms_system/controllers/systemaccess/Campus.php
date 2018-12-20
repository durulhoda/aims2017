<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */

class Campus extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->my_admin();

        $this->load->model('admin/campus/CampusModleAdmin', 'CampusModleAdmin');
    }

    public function index() {
        $this->load->helper(array('form', 'url'));
        
     //   $result = campusInfoArrayResult();
        
     //   print_r($result); die();
        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/campus/index');
        $this->load->view('templates/admin/common/footer');
    }

    public function insertcampus() {
//   //     print_r($_POST);
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

//        print_r($_POST);
        $config = array(
            array(
                'field' => 'data[campusName]',
                'label' => 'Campus Name',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[campusLocation]',
                'label' => 'Campus Location',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[campusAddress]',
                'label' => 'Campus Address',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[campusPhone]',
                'label' => 'Phone Number',
                'rules' => 'required|numeric'
            ),
            array(
                'field' => 'data[campusEmail]',
                'label' => 'Email Address',
                'rules' => 'required|valid_email'
            )
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            echo "ROY"; die();
            $this->load->view('templates/admin/common/header');
            $this->load->view('templates/admin/campus/index');
            $this->load->view('templates/admin/common/footer');
        } else {
            $data = $this->input->post('data', TRUE);
  //          print_r($data); die();
            $result = $this->CampusModleAdmin->duplicateCampusInfo($data);

            if (!$result) {
                $this->CampusModleAdmin->addCampusInfo($data);

                $sdata['message'] = 'Successfull!';
                $this->session->set_userdata($sdata);

                redirect('admin/campus', 'refresh');
            } else {
                $sdata['message'] = 'Duplicate Entry Found!';
                $this->session->set_userdata($sdata);

                redirect('admin/campus', 'refresh');
            }
        }
    }

    public function campuslist() {



        $data['campuslist'] = $this->CampusModleAdmin->getCampusInfo();
//        print_r($campuslist);
        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/campus/campuslist', $data);
        $this->load->view('templates/admin/common/footer');
    }

    public function editcampus($id) {

        $this->load->view('templates/admin/common/header');

        $data['editData'] = $this->CampusModleAdmin->editCampusInfo($id);

        $this->load->view('templates/admin/campus/editcampus', $data);
        $this->load->view('templates/admin/common/footer');
    }

    public function updatecampus($id) {

        $data = $this->input->post('data', TRUE);
        $result = $this->CampusModleAdmin->duplicateCampusInfo($data);

        if (!$result) {
            $this->CampusModleAdmin->updateCampusInfo($data, $id);
            $sdata = array();
            $sdata['message'] = 'Updated Successfully !';
            $this->session->set_userdata($sdata);

            redirect(base_url('admin/campus/campuslist'));
        } else {
            $sdata['message'] = 'Duplicate Entry Found!';
            $this->session->set_userdata($sdata);

            redirect('admin/campus/campuslist', 'refresh');
        }
    }

    public function deletecampus($id) {

        $this->CampusModleAdmin->deleteCampusInfo($id);
        redirect(base_url('admin/campus/campuslist'));
    }

}
