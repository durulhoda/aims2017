<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */

class Classroom extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->my_admin();
        $this->load->model('admin/classroom/ClassroomModleAdmin', 'ClassroomModleAdmin');
    }

    public function index() {

        $this->load->library('form_validation');

        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/classroom/index');
        $this->load->view('templates/admin/common/footer');
    }

    public function insertClassroom() {
//        print_r($_POST);
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
            array(
                'field' => 'data[roomName]',
                'label' => 'classroom Name',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[buildingId]',
                'label' => ' Builing',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[campusId]',
                'label' => ' campus',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
//                    redirect(base_url('admin/campus'));
            $this->load->view('templates/admin/common/header');
            $this->load->view('templates/admin/classroom/index');
            $this->load->view('templates/admin/common/footer');
        } else {
            $data = $this->input->post('data', TRUE);
            $result = $this->ClassroomModleAdmin->duplicateClassroomInfo($data);

            if (!$result) {
                $this->ClassroomModleAdmin->addClassroomInfo($data);
                $sdata['message'] = 'Successfull!';
                $this->session->set_userdata($sdata);

                redirect('admin/classroom', 'refresh');
            } else {
                $sdata['message'] = 'Duplicate Entry Found!';
                $this->session->set_userdata($sdata);

                redirect('admin/classroom', 'refresh');
            }
        }
    }

    public function Classroomlist() {

        $data['classRoomlist'] = $this->ClassroomModleAdmin->getClassroomInfo();

        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/classroom/classroomlist', $data);
        $this->load->view('templates/admin/common/footer');
    }

    public function editdclassroom($id) {

        $this->load->view('templates/admin/common/header');
        $data['editData'] = $this->ClassroomModleAdmin->editClassroomInfo($id);

        $this->load->view('templates/admin/classroom/editclassroom', $data);
        $this->load->view('templates/admin/common/footer');
    }

    public function updateclassroom($id) {

        $id = (int) $id;

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
            array(
                'field' => 'data[roomName]',
                'label' => 'classroom Name',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[buildingId]',
                'label' => ' Builing',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[campusId]',
                'label' => ' campus',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
//                    redirect(base_url('admin/campus'));
            $this->load->view('templates/admin/common/header');
            $data['editData'] = $this->ClassroomModleAdmin->editClassroomInfo($id);
            $this->load->view('templates/admin/classroom/editclassroom', $data);
            $this->load->view('templates/admin/common/footer');
        } else {
            $data = $this->input->post('data', TRUE);
            $result = $this->ClassroomModleAdmin->duplicateClassroomInfo($data);

            if (!$result) {
                $this->ClassroomModleAdmin->updateClassroomInfo($data, $id);
                redirect('admin/classroom', 'refresh');
            } else {
                $sdata['message'] = 'Duplicate Entry Found!';
                $this->session->set_userdata($sdata);

                redirect('admin/classroom', 'refresh');
            }
//			 
        }
    }

    public function deleteclassroom($id) {
        
        $this->ClassroomModleAdmin->deleteClassroomInfo($id);
        redirect('admin/Classroomlist', 'refresh');
    }

}
