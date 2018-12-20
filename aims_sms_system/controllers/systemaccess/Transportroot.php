<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */

class TransportRoot extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->my_admin();
        $this->load->model('admin/transportroot/TransportRootModleAdmin', 'TransportRootModleAdmin');
    }

    public function index() {
        
        $data['transport'] = 'active';
        $data['transportroot'] = 'active';
        $data['transportrootlist'] = $this->TransportRootModleAdmin->getTransportRootlist();
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/transport/transportroot', $data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
    }

   
   
    public function inserttransportroot() {
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
                'field' => 'data[transportRoot]',
                'label' => 'Transport Root',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            
            redirect(admin_Url() . "/transportroot/index");
            
        } else {
            $data = $this->input->post('data', TRUE);
            $result = $this->TransportRootModleAdmin->duplicateTransportRoot($data);

            if (!$result) {
                $this->TransportRootModleAdmin->addTransportroot($data);
                $sdata['message'] = 'Successfull!';
                $this->session->set_userdata($sdata);

             redirect(admin_Url() . "/transportroot/index");
            } else {
                $sdata['errormessage'] = 'Duplicate Entry Found!';
                $this->session->set_userdata($sdata);

                redirect(admin_Url() . "/transportroot/index");
            }
        }
    }

    public function transportRootlist() {

        $data['transportrootlist'] = $this->TransportRootModleAdmin->getTransportRootlist();

        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/transportroot/viewtransportrootlist', $data);
        $this->load->view('templates/admin/common/footer');
    }

    public function editTransportRoot($id) {  

        $data['editData'] = $this->TransportRootModleAdmin->editTransportRoot($id);
        
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/transport/edittransportroot', $data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
    }
public function updateTransportRoot($id) {
      
        
            $data = $this->input->post('data', TRUE);
            $result = $this->TransportRootModleAdmin->duplicateTransportRoot($data);

            if (!$result) {
            $this->TransportRootModleAdmin->updateTransportRoot($data, $id);
            $sdata['message'] = 'Successfull!';
                $this->session->set_userdata($sdata);

                  redirect(admin_Url() . "/transportroot/index");
            } else {
                $sdata['errormessage'] = 'Duplicate Entry Found!';
                $this->session->set_userdata($sdata);

                  redirect(admin_Url() . "/transportroot/index");
            }
        
    }

    public function deleteTransportRoot($id) {


        $this->TransportRootModleAdmin->deleteTransportRoot($id);
        $sdata['message'] = 'Successfully Deleted';
                $this->session->set_userdata($sdata);
          redirect(admin_Url() . "/transportroot/index");
    }

    

    //put your code here
}

