<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */

class HostelRent extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->account_access();
        $this->load->model('admin/hostelrent/HostelRentModleAdmin', 'HostelRentModleAdmin');
    }

    public function index() {
        $data['hostel'] = 'active';
        $data['hostelrent'] = 'active';
        $data['hostelrentlist'] = $this->HostelRentModleAdmin->gethostelRentlist();
        $this->load->view('system_path/accounts/common/header_link'); // header Css link
        $this->load->view('system_path/accounts/common/header'); // body header
        $this->load->view('system_path/accounts/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/accounts/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/accounts/hostelbedrent/index', $data); // ...........body content page...........
        $this->load->view('system_path/accounts/common/footer'); // footer & script link
    }

   
   
    public function inserthostelrent() {
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
                'label' => 'Room Name',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[rent]',
                'label' => 'Hostel Rent',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
                redirect(acc_Url() . "/hostelrent/index");
        } else {
            $data = $this->input->post('data', TRUE);
            
            $validation1 = $this->HostelRentModleAdmin->Datavalidation1($data);
            $validation2 = $this->HostelRentModleAdmin->Datavalidation2($data);  
             
             if ($validation1) {
                $sdata = array();
                $sdata['message'] = "Duplicate data found..";
                $this->session->set_userdata($sdata);

                $this->load->helper(array('form', 'url'));
              redirect(acc_Url() . "/hostelrent/index");
            } 
           elseif (!$validation2)
                {
                    $sdata = array();
                    $sdata['errormessage'] = "There are no bed found in this room ";
                    $this->session->set_userdata($sdata);

                    $this->load->helper(array('form', 'url'));
                    redirect(acc_Url() . "/hostelrent/index");
            }
            else
             {
                 $this->HostelRentModleAdmin->addhostelRent($data);
                $sdata['message'] = 'Successfull!';
                $this->session->set_userdata($sdata);

               redirect(acc_Url() . "/hostelrent/index");
             }    
            
        }
    }

    public function hostelRentlist() {

        $data['hostelrentlist'] = $this->HostelRentModleAdmin->gethostelRentlist();

        $this->load->view('templates/accounts/common/header');
        $this->load->view('templates/accounts/hostelrent/viewhostelrentlist', $data);
        $this->load->view('templates/accounts/common/footer');
    }

    public function edithostelRent($id) {

    

        $data['editData'] = $this->HostelRentModleAdmin->edithostelRent($id);
        $data['hostel'] = 'active';
        $data['hostelrent'] = 'active';
        $this->load->view('system_path/accounts/common/header_link'); // header Css link
        $this->load->view('system_path/accounts/common/header'); // body header
        $this->load->view('system_path/accounts/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/accounts/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/accounts/hostelbedrent/edithostelrent', $data); // ...........body content page...........
        $this->load->view('system_path/accounts/common/footer'); // footer & script link
    }

    public function updatehostelRent($id) {
      
        
            $data = $this->input->post('data', TRUE);
            $validation1 = $this->HostelRentModleAdmin->Datavalidation1($data);
            $validation2 = $this->HostelRentModleAdmin->Datavalidation2($data);    
             
             if ($validation1) {
                $sdata = array();
                $sdata['errormessage'] = "Duplicate data found ..";
                $this->session->set_userdata($sdata);
                        redirect(acc_Url() . "/hostelrent/index");
            } 
           elseif (!$validation2)
                {
                    $sdata = array();
                    $sdata['errormessage'] = "This room is not found in your Inserted Hostel ";
                    $this->session->set_userdata($sdata);
                            redirect(acc_Url() . "/hostelrent/index");
                }
            else
             {
                 $this->HostelRentModleAdmin->updatehostelRent($data, $id);
                $sdata['message'] = 'Update Successfull!';
                $this->session->set_userdata($sdata);

                redirect(acc_Url() . "/hostelrent/index");
             }    
            
        
    }

    public function deletehostelRent($id) {


        $this->HostelRentModleAdmin->deletehostelRent($id);
        $sdata['message'] = 'Successfully Deleted';
                $this->session->set_userdata($sdata);
   redirect(acc_Url() . "/hostelrent/index");
    }

    

    //put your code here
}

