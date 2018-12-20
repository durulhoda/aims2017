<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */

class Building extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->my_admin();
        $this->load->model('admin/building/BuildingModleAdmin', 'BuildingModleAdmin');
    } 

    public function index() {
        $this->load->helper(array('form', 'url'));
        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/building/index');
        $this->load->view('templates/admin/common/footer');
    }

    public function insertbuilding() {
        //  print_r($_POST);

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
            array(
                'field' => 'data[buildingName]',
                'label' => 'Building Name',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[campusId]',
                'label' => 'Campus',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[buildingAddress]',
                'label' => 'Building Address ',
                'rules' => 'required'
            )
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
//                    redirect(base_url('admin/campus'));
            $this->load->view('templates/admin/common/header');
            $this->load->view('templates/admin/building/index');
            $this->load->view('templates/admin/common/footer');
        } else {
            $data = $this->input->post('data', TRUE);
            $result = $this->BuildingModleAdmin->duplicateBuildingInfo($data);

            if (!$result) {
                $this->BuildingModleAdmin->addBuildingInfo($data);

                $sdata['message'] = 'Successfull!';
                $this->session->set_userdata($sdata);

                redirect('admin/building', 'refresh');
            } else {
                $sdata['message'] = 'Duplicate Entry Found!';
                $this->session->set_userdata($sdata);

                redirect('admin/building', 'refresh');
            }
        }
    }

    public function buildinglist() {


        $data['buildinglist'] = $this->BuildingModleAdmin->getBuildingInfo();


        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/building/buildinglist', $data);
        $this->load->view('templates/admin/common/footer');
    }

    public function editdbuilding($id) {
       
//        echo $id; exit;
        $this->load->view('templates/admin/common/header');

        $data['editData'] = $this->BuildingModleAdmin->editBuildingInfo($id);
//        print_r($data); exit;
        $this->load->view('templates/admin/building/editbuilding', $data);
        $this->load->view('templates/admin/common/footer');
    }

    public function updatebuilding($id) {

  
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
            array(
                'field' => 'data[buildingName]',
                'label' => 'Building Name',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[campusId]',
                'label' => 'Campus',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[buildingAddress]',
                'label' => 'Building Address ',
                'rules' => 'required'
            )
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
//                    redirect(base_url('admin/campus'));
            $this->load->view('templates/admin/common/header');
            $this->load->view('templates/admin/building/editbuilding');
            $this->load->view('templates/admin/common/footer');
        } else {
            $data = $this->input->post('data', TRUE);
            $result = $this->BuildingModleAdmin->duplicateBuildingInfo($data);

            if (!$result) {
                $this->BuildingModleAdmin->updateBuildingInfo($data, $id);
                redirect('admin/building', 'refresh');
            } else {
                $sdata['message'] = 'Duplicate Entry Found!';
                $this->session->set_userdata($sdata);

                redirect('admin/building', 'refresh');
            }
        }
    }

    public function deletebuilding($id) {

        $this->BuildingModleAdmin->deleteBuildingInfo($id);
        $this->index();
    }

}
