<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */

class Transport extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->my_admin();
        $this->load->model('admin/transport/TransportModleAdmin', 'TransportModleAdmin');
    }

    public function index() {
          
        $data['transport'] = 'active';
        $data['transportcat'] = 'active';
         $data['transportcategorylist'] = $this->TransportModleAdmin->gettransportcategoryList();
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/transport/index', $data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
    }

    public function transportcategory() {
        $this->load->library('form_validation');

        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/transport/transportcategory');
        $this->load->view('templates/admin/common/footer');
    }

    public function insertcategory() {
        // print_r($_POST);
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
            array(
                'field' => 'data[categoryName]',
                'label' => 'categoryName',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {

            redirect(admin_Url()."/transport/index");
            
        } else {
            $data = $this->input->post('data', TRUE);
            $result = $this->TransportModleAdmin->duplicateTransportcategoryInfo($data);

            if (!$result) {
                $this->TransportModleAdmin->addtransportcategoryInfo($data);
                $sdata['message'] = 'Successfull!';
                $this->session->set_userdata($sdata);

                redirect(admin_Url(). "/transport/index");
            } 
            else {
                $sdata=array();
                $sdata['errormessage'] = 'Duplicate Entry Found!';
                $this->session->set_userdata($sdata);

                redirect(admin_Url(). "/transport/index");
            }
        }
    }

    public function transportcategorylist() {

        $data['transportcategorylist'] = $this->TransportModleAdmin->gettransportcategoryList();

        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/transport/viewtransportcategorylist', $data);
        $this->load->view('templates/admin/common/footer');
    }

    public function inserttransportName() {
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
                'field' => 'data[transportName]',
                'label' => 'Transport Name',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            
            redirect(admin_Url(). "/transport/transportNamelist");
            
        } else {
            $data = $this->input->post('data', TRUE);
            $result = $this->TransportModleAdmin->duplicateTransportname($data);

            if (!$result) {
                $this->TransportModleAdmin->addTransportname($data);
                $sdata['message'] = 'Successfull!';
                $this->session->set_userdata($sdata);

              redirect(admin_Url(). "/transport/transportNamelist");
            } else {
                $sdata['errormessage'] = 'Duplicate Entry Found!';
                $this->session->set_userdata($sdata);

                 redirect(admin_Url(). "/transport/transportNamelist");
            }
        }
    }

    public function transportNamelist() {
        $data['transport']='active';
        $data['transportname']='active';
        $data['transportlist'] = $this->TransportModleAdmin->getTransportNamelist();
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/transport/transportname', $data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
  
    }

    public function editTransportName($id) {

        $data['editData'] = $this->TransportModleAdmin->editTransportName($id);
        
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/transport/edittransportname', $data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
    }

    public function updatetransportName($id) {
      
        
            $data = $this->input->post('data', TRUE);
            $result = $this->TransportModleAdmin->duplicateTransportname($data);

            if (!$result) {
            $this->TransportModleAdmin->updatetransportInfo($data, $id);
            $sdata['message'] = 'Successfull!';
                $this->session->set_userdata($sdata);

               redirect(admin_Url(). "/transport/transportNamelist");
            } else {
                $sdata['errormessage'] = 'Duplicate Entry Found!';
                $this->session->set_userdata($sdata);

               redirect(admin_Url(). "/transport/transportNamelist");
            }
        
    }

    public function deleteTransportName($id) {


        $this->TransportModleAdmin->deleteTransportName($id);
        $sdata['message'] = 'Successfully Deleted';
                $this->session->set_userdata($sdata);
         redirect(admin_Url(). "/transport/transportNamelist");
    }

    public function edittransportcategory($id) {

        $this->load->view('templates/admin/common/header');

        $data['editData'] = $this->TransportModleAdmin->edittransportcategory($id);
//        print_r($data);
        $this->load->view('templates/admin/transport/edittransportcategory', $data);
        $this->load->view('templates/admin/common/footer');
    }

    public function updatetransportcategory($id) {

        
            $data = $this->input->post('data', TRUE);
            $result = $this->TransportModleAdmin->duplicateTransportcategoryInfo($data);

            if (!$result) {
            $this->TransportModleAdmin->updatetransportcategory($data, $id);
            $sdata['message'] = 'Successfull!';
                $this->session->set_userdata($sdata);

                redirect('admin/transport/transportcategorylist', 'refresh');
            } else {
                $sdata['message'] = 'Duplicate Entry Found!';
                $this->session->set_userdata($sdata);

                redirect('admin/transport/transportcategory', 'refresh');
            }
        }
    

    public function deletetransportcategory($id) {


        $this->TransportModleAdmin->deletetransportcategory($id);
        $sdata['message'] = 'Successfully Deleted';
                $this->session->set_userdata($sdata);
        redirect("admin/transport/transportcategorylist");
    }

    //put your code here
}

