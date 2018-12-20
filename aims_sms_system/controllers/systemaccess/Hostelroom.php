<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */

class HostelRoom extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->my_admin();
        $this->load->model('admin/hostelroom/HostelRoomModleAdmin', 'HostelRoomModleAdmin');
    }

    public function index() {
        $data['hostel'] = 'active';
        $data['hostelroom'] = 'active';
        $data['hostelroomlist'] = $this->HostelRoomModleAdmin->gethostelRoomlist();
     
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/hostelroom/index', $data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        
    }

   
   
    public function inserthostelroom() {
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
                'field' => 'data[hostelId]',
                'label' => 'Hostel Name',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[hostelRoom]',
                'label' => 'Hostel Room',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            redirect(admin_Url() . "/hostelroom/index");
        } else {
            $data = $this->input->post('data', TRUE);
            $result = $this->HostelRoomModleAdmin->duplicatehostelRoom($data);
            $result2 = $this->HostelRoomModleAdmin->duplicatehostelRoom2($data);

            if (!$result && !$result2) {
                $this->HostelRoomModleAdmin->addhostelRoom($data);
                $sdata['message'] = 'Successfull!';
                $this->session->set_userdata($sdata);

                redirect(admin_Url() . "/hostelroom/index");
            } else {
                $sdata['errormessage'] = 'Duplicate Entry Found!';
                $this->session->set_userdata($sdata);
                redirect(admin_Url() . "/hostelroom/index");
            }
        }
    }

    public function hostelRoomlist() {

        $data['hostelroomlist'] = $this->HostelRoomModleAdmin->gethostelRoomlist();

        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/hostelroom/viewhostelroomlist', $data);
        $this->load->view('templates/admin/common/footer');
    }

    public function edithostelRoom($id) {

        $data['editData'] = $this->HostelRoomModleAdmin->edithostelRoom($id);
        $data['hostel'] = 'active';
        $data['hostelroom'] = 'active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/hostelroom/edithostelroom', $data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link

    }
    
    public function updatehostelRoom($id) {
      
        
            $data = $this->input->post('data', TRUE);
            $result = $this->HostelRoomModleAdmin->duplicatehostelRoom($data);

            if (!$result) {
            $this->HostelRoomModleAdmin->updatehostelRoom($data, $id);
            $sdata['message'] = 'Successfull!';
                $this->session->set_userdata($sdata);

                redirect(admin_Url() . "/hostelroom/index");
            } else {
                $sdata['errormessage'] = 'Duplicate Entry Found!';
                $this->session->set_userdata($sdata);

             redirect(admin_Url() . "/hostelroom/index");
            }
        
    }

    public function deletehostelRoom($id) {


        $this->HostelRoomModleAdmin->deletehostelRoom($id);
        $sdata['message'] = 'Successfully Deleted';
                $this->session->set_userdata($sdata);
        redirect(admin_Url() . "/hostelroom/index");
    }

    

    //put your code here
}

