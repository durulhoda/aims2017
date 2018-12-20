<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */

class HostelBed extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->my_admin();
        $this->load->model('admin/hostelbed/HostelBedModleAdmin', 'HostelBedModleAdmin');
    }

    public function index() {
        $data['hostel'] = 'active';
        $data['hostelbed'] = 'active';
        $data['hostelbedlist'] = $this->HostelBedModleAdmin->gethostelBedlist();
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/hostelbed/index', $data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
    }

    public function inserthostelbed() {
        // print_r($_POST);
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
            
            array(
                'field' => 'data[hostelId]',
                'label' => 'Hostel Name',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[hostelRoom]',
                'label' => 'Hostel Room',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[bedNo]',
                'label' => 'Hostel Bed',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
                 redirect(admin_Url() . "/hostelbed/index");
        } else {
            $data = $this->input->post('data', TRUE);
            
            $validation1 = $this->HostelBedModleAdmin->Datavalidation1($data);
             $validation2 = $this->HostelBedModleAdmin->Datavalidation2($data);
             
             
             if ($validation1) {
                $sdata = array();
                $sdata['errormessage'] = "Duplicate found for All field value..";
                $this->session->set_userdata($sdata);

                $this->load->helper(array('form', 'url'));
           redirect(admin_Url() . "/hostelbed/index");
            } 
            elseif (!$validation2)
                {
                    $sdata = array();
                    $sdata['errormessage'] = "This room is not found in your Inserted Hostel ";
                    $this->session->set_userdata($sdata);

                    $this->load->helper(array('form', 'url'));
              redirect(admin_Url() . "/hostelbed/index");
                }
            else
             {
                 $this->HostelBedModleAdmin->addhostelBed($data);
                $sdata['message'] = 'Successfull!';
                $this->session->set_userdata($sdata);

               redirect(admin_Url() . "/hostelbed/index");
             }    
            
        }
    }



    public function edithostelBed($id) {



        $data['editData'] = $this->HostelBedModleAdmin->edithostelBed($id);
        $data['hostel'] = 'active';
        $data['hostelbed'] = 'active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/hostelbed/edithostelbed', $data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
    }

    public function updatehostelBed($id) {
      
        
            $data = $this->input->post('data', TRUE);
            $validation1 = $this->HostelBedModleAdmin->Datavalidation1($data);
             $validation2 = $this->HostelBedModleAdmin->Datavalidation2($data);
             
             
             if ($validation1) {
                $sdata = array();
                $sdata['errormessage'] = "Duplicate found for All field value..";
                $this->session->set_userdata($sdata);

                redirect(admin_Url() . "/hostelbed/index");
        } 
            elseif (!$validation2)
                {
                    $sdata = array();
                    $sdata['errormessage'] = "This room is not found in your Inserted Hostel ";
                    $this->session->set_userdata($sdata);
                      redirect(admin_Url() . "/hostelbed/index");
                }
            else
             {
                $this->HostelBedModleAdmin->updatehostelBed($data, $id);
                $sdata['message'] = 'Successfull!';
                $this->session->set_userdata($sdata);

               redirect(admin_Url() . "/hostelbed/index");
             }    

           
        
    }

    public function deletehostelBed($id) {


        $this->HostelBedModleAdmin->deletehostelBed($id);
        $sdata['message'] = 'Successfully Deleted';
                $this->session->set_userdata($sdata);
       redirect(admin_Url() . "/hostelbed/index");
    }

    

    //put your code here
}

