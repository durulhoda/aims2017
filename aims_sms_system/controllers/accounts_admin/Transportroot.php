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
        $this->account_access();
        $this->load->model('admin/transportroot/TransportRootModleAdmin', 'TransportRootModleAdmin');
    }

    public function index() {
        
        $data['transport'] = 'active';
        $data['transportroot'] = 'active';
        $data['transportrootlist'] = $this->TransportRootModleAdmin->getTransportRootlist();
        $this->load->view('system_path/accounts/common/header_link'); // header Css link
        $this->load->view('system_path/accounts/common/header'); // body header
        $this->load->view('system_path/accounts/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/accounts/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/accounts/transport/transportroot', $data); // ...........body content page...........
        $this->load->view('system_path/accounts/common/footer'); // footer & script link
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
            
            redirect(acc_Url() . "/transportroot/index");
            
        } else {
            $data = $this->input->post('data', TRUE);
            $result = $this->TransportRootModleAdmin->duplicateTransportRoot($data);

            if (!$result) {
                $this->TransportRootModleAdmin->addTransportroot($data);
                $sdata['message'] = 'Successfull!';
                $this->session->set_userdata($sdata);

             redirect(acc_Url() . "/transportroot/index");
            } else {
                $sdata['errormessage'] = 'Duplicate Entry Found!';
                $this->session->set_userdata($sdata);

                redirect(acc_Url() . "/transportroot/index");
            }
        }
    }

    public function transportRootlist() {

        $data['transportrootlist'] = $this->TransportRootModleAdmin->getTransportRootlist();

        $this->load->view('templates/accounts/common/header');
        $this->load->view('templates/accounts/transportroot/viewtransportrootlist', $data);
        $this->load->view('templates/accounts/common/footer');
    }

    public function editTransportRoot($id) {  

        $data['editData'] = $this->TransportRootModleAdmin->editTransportRoot($id);
        
        $this->load->view('system_path/accounts/common/header_link'); // header Css link
        $this->load->view('system_path/accounts/common/header'); // body header
        $this->load->view('system_path/accounts/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/accounts/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/accounts/transport/edittransportroot', $data); // ...........body content page...........
        $this->load->view('system_path/accounts/common/footer'); // footer & script link
    }
public function updateTransportRoot($id) {
      
        
            $data = $this->input->post('data', TRUE);
            $result = $this->TransportRootModleAdmin->duplicateTransportRoot($data);

            if (!$result) {
            $this->TransportRootModleAdmin->updateTransportRoot($data, $id);
            $sdata['message'] = 'Successfull!';
                $this->session->set_userdata($sdata);

                  redirect(acc_Url() . "/transportroot/index");
            } else {
                $sdata['errormessage'] = 'Duplicate Entry Found!';
                $this->session->set_userdata($sdata);

                  redirect(acc_Url() . "/transportroot/index");
            }
        
    }

    public function deleteTransportRoot($id) {


        $this->TransportRootModleAdmin->deleteTransportRoot($id);
        $sdata['message'] = 'Successfully Deleted';
                $this->session->set_userdata($sdata);
          redirect(acc_Url() . "/transportroot/index");
    }

    

    //put your code here
}

