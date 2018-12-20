<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */

class Hostel extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->my_admin();
        $this->load->model('admin/hostel/HostelModleAdmin', 'HostelModleAdmin');
    }

    public function index() {
        $data['hostel']='active';
        $data['hostelcategory']='active';
         $data['hostelcategorylist'] = $this->HostelModleAdmin->getHostelcategoryList();
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu',$data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/hostel/index', $data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
    }


    public function insertcategory() {
        // print_r($_POST);
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
            array(
                'field' => 'data[categoryName]',
                'label' => 'Category Name',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            
             redirect(admin_Url() . "/hostel/index");
             
        } else {
            $data = $this->input->post('data', TRUE);
            $result = $this->HostelModleAdmin->duplicateHostelcategoryInfo($data);

            if (!$result) {
                $this->HostelModleAdmin->addHostelcategoryInfo($data);
                $sdata['message'] = 'Successfull!';
                $this->session->set_userdata($sdata);

                 redirect(admin_Url() . "/hostel/index");
            } 
            else {
                $sdata=array();
                $sdata['errormessage'] = 'Duplicate Entry Found!';
                $this->session->set_userdata($sdata);

                 redirect(admin_Url() . "/hostel/index");
            }
        }
    }



    public function inserthostelName() {
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
                'field' => 'data[hostelName]',
                'label' => 'Hostel Name',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            redirect(admin_Url() . "/hostel/hostelNamelist");
        } else {
            $data = $this->input->post('data', TRUE);
            $result = $this->HostelModleAdmin->duplicateHostelname($data);

            if (!$result) {
                $this->HostelModleAdmin->addHostelname($data);
                $sdata['message'] = 'Successfull!';
                $this->session->set_userdata($sdata);

               redirect(admin_Url() . "/hostel/hostelNamelist");
            } else {
                $sdata['errormessage'] = 'Duplicate Entry Found!';
                $this->session->set_userdata($sdata);

                redirect(admin_Url() . "/hostel/hostelNamelist");
            }
        }
    }

    public function hostelNamelist() {

        $data['hostellist'] = $this->HostelModleAdmin->getHostelNamelist();

        $data['hostel'] = 'active';
        $data['hostelname'] = 'active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/hostel/hostelname', $data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
    }

    public function edithostelName($id) {

        $data['editData'] = $this->HostelModleAdmin->editHostelName($id);

        $data['hostel'] = 'active';
        $data['hostelname'] = 'active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/hostel/edithostelname', $data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
    }

    public function updatehostelName($id) {
      
        
            $data = $this->input->post('data', TRUE);
            $result = $this->HostelModleAdmin->duplicateHostelname($data);

            if (!$result) {
            $this->HostelModleAdmin->updateHostelInfo($data, $id);
            $sdata['message'] = 'Successfull!';
                $this->session->set_userdata($sdata);

                 redirect(admin_Url() . "/hostel/hostelNamelist");
            } else {
                $sdata['errormessage'] = 'Duplicate Entry Found!';
                $this->session->set_userdata($sdata);

                 redirect(admin_Url() . "/hostel/hostelNamelist");
            }
        
    }

    public function deletehostelName($id) {


        $this->HostelModleAdmin->deleteHostelName($id);
        $sdata['message'] = 'Successfully Deleted';
                $this->session->set_userdata($sdata);
         redirect(admin_Url() . "/hostel/hostelNamelist");
    }

    public function edithostelcategory($id) {

        $data['editData'] = $this->HostelModleAdmin->editHostelcategory($id);
        
        $data['hostel']='active';
        $data['hostelcategory']='active';

        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu',$data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/hostel/edithostelcategory', $data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
    }

    public function updateHostelcategory($id) {

        
            $data = $this->input->post('data', TRUE);
            $result = $this->HostelModleAdmin->duplicateHostelcategoryInfo($data);

            if (!$result) {
            $this->HostelModleAdmin->updateHostelcategory($data, $id);
            $sdata['message'] = 'Successfull!';
                $this->session->set_userdata($sdata);

                 redirect(admin_Url() . "/hostel/index");
            } else {
                $sdata['errormessage'] = 'Duplicate Entry Found!';
                $this->session->set_userdata($sdata);

                 redirect(admin_Url() . "/hostel/index");
            }
        }
    

    public function deletehostelcategory($id) {


        $this->HostelModleAdmin->deleteHostelcategory($id);
        $sdata['message'] = 'Successfully Deleted';
                $this->session->set_userdata($sdata);
         redirect(admin_Url() . "/hostel/index");
    }

    //put your code here
}

