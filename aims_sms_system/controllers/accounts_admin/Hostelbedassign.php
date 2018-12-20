<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */

class HostelBedAssign extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->account_access();
        $this->load->model('admin/hostelbedassign/HostelBedAssignModleAdmin', 'HostelBedAssignModleAdmin');
    }

    public function index() {
        $data['hostel'] = 'active';
        $data['hostelbedassign'] = 'active';
       $data['hostelbedassignlist'] = $this->HostelBedAssignModleAdmin->gethostelBedAssignlist();
       
        $this->load->view('system_path/accounts/common/header_link'); // header Css link
        $this->load->view('system_path/accounts/common/header'); // body header
        $this->load->view('system_path/accounts/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/accounts/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/accounts/hostelbedassign/index', $data); // ...........body content page...........
        $this->load->view('system_path/accounts/common/footer'); // footer & script link
    }

   
   
    public function inserthostelbedassign() {
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
                'field' => 'data[studentId]',
                'label' => 'Student Id',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[bedNo]',
                'label' => 'Hostel Bed Number',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            redirect(acc_Url() . "/hostelbedassign/index");
        } else {
            $data = $this->input->post('data', TRUE);
            
            $validation1 = $this->HostelBedAssignModleAdmin->Datavalidation1($data);
             $validation2 = $this->HostelBedAssignModleAdmin->Datavalidation2($data);
             $validation3 = $this->HostelBedAssignModleAdmin->Datavalidation3($data);
            $validation4= $this->HostelBedAssignModleAdmin->Datavalidation4($data);
            $validation5= $this->HostelBedAssignModleAdmin->Datavalidation5($data);
            $validation6= $this->HostelBedAssignModleAdmin->Datavalidation6($data);
           
            
             
             if ($validation1) {
                $sdata = array();
                $sdata['message'] = "Duplicate found for All field value..";
                $this->session->set_userdata($sdata);

                $this->load->helper(array('form', 'url'));
                redirect(acc_Url() . "/hostelbedassign/index");
            } 
            elseif (!$validation2)
                {
                    $sdata = array();
                    $sdata['errormessage'] = "This bed is not found in your Inserted Hostel Room ";
                    $this->session->set_userdata($sdata);
                    redirect(acc_Url() . "/hostelbedassign/index");
            }
            elseif (!$validation3)
                {
                    $sdata = array();
                    $sdata['errormessage'] = "This Student Id is not Regsitered";
                    $this->session->set_userdata($sdata);

                    $this->load->helper(array('form', 'url'));
                    redirect(acc_Url() . "/hostelbedassign/index");
            } 
             elseif ($validation4)
                {
                    $sdata = array();
                    $sdata['errormessage'] = "This Student Id is already assigned";
                    $this->session->set_userdata($sdata);
                    redirect(acc_Url() . "/hostelbedassign/index");
            }   
             elseif ($validation5)
                {
                    $sdata = array();
                    $sdata['errormessage'] = "This Bed Number is already assigned";
                    $this->session->set_userdata($sdata);
                    redirect(acc_Url() . "/hostelbedassign/index");
            }   
                elseif (count($validation6)==2)
                {
                    $sdata = array();
                    $sdata['errormessage'] = "This Room is already fill-up by 2 students";
                    $this->session->set_userdata($sdata);
                    redirect(acc_Url() . "/hostelbedassign/index");
            }   
            else
             {
                $data['rent']=$this->HostelBedAssignModleAdmin->getBedRent($data);
              //  print_r($data); die();
                 $this->HostelBedAssignModleAdmin->addhostelBedAssign($data);
                $sdata['message'] = 'Successfull!';
                $this->session->set_userdata($sdata);

                redirect(acc_Url() . "/hostelbedassign/index");
             }    
            
        }
    }

    public function hostelBedAssignlist() {

        $data['hostelbedassignlist'] = $this->HostelBedAssignModleAdmin->gethostelBedAssignlist();

        $this->load->view('templates/accounts/common/header');
        $this->load->view('templates/accounts/hostelbedassign/viewhostelbedassignlist', $data);
        $this->load->view('templates/accounts/common/footer');
    }

    public function edithostelBedAssign($id) {

        $data['editData'] = $this->HostelBedAssignModleAdmin->edithostelBedAssign($id);
        $data['hostel'] = 'active';
        $data['hostelbedassign'] = 'active';
       
        $this->load->view('system_path/accounts/common/header_link'); // header Css link
        $this->load->view('system_path/accounts/common/header'); // body header
        $this->load->view('system_path/accounts/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/accounts/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/accounts/hostelbedassign/editbedassaign', $data); // ...........body content page...........
        $this->load->view('system_path/accounts/common/footer'); // footer & script link
    }

    public function updatehostelBedAssign($id) {
      
        
            $data = $this->input->post('data', TRUE);
            $validation1 = $this->HostelBedAssignModleAdmin->Datavalidation1($data);
             $validation2 = $this->HostelBedAssignModleAdmin->Datavalidation2($data);
             
             
             if ($validation1) {
                $sdata = array();
                $sdata['message'] = "Duplicate found for All field value..";
                $this->session->set_userdata($sdata);
                                redirect(acc_Url() . "/hostelbedassign/index");
            } 
            elseif (!$validation2)
                {
                    $sdata = array();
                    $sdata['message'] = "This bed is not found in your Inserted Hostel Room ";
                    $this->session->set_userdata($sdata);
                                redirect(acc_Url() . "/hostelbedassign/index");
                }
            else
             {
                $data['rent']=$this->HostelBedAssignModleAdmin->getBedRent($data);
                $this->HostelBedAssignModleAdmin->updatehostelBedAssign($data, $id);
                $sdata['message'] = 'Successfull!';
                $this->session->set_userdata($sdata);
                redirect(acc_Url() . "/hostelbedassign/index");
        }    

           
        
    }

    public function deletehostelBedAssign($id) {


        $this->HostelBedAssignModleAdmin->deletehostelBedAssign($id);
        $sdata['message'] = 'Successfully Deleted';
                $this->session->set_userdata($sdata);
        redirect(acc_Url() . "/hostelbedassign/index");
    }

    

    //put your code here
}

