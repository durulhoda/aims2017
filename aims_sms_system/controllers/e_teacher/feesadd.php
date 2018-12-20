<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */

class FeesAdd extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->teacher_logged_auth();
        $this->load->model('admin/fees/FeesModleAdmin', 'FeesModleAdmin');
        $this->load->model('admin/program/ProgramModleAdmin', 'ProgramModleAdmin');
    }

    public function index() {
        $data['stupayment']='active';
        $data['feeslist'] = $this->FeesModleAdmin->getlistfees();
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/payment/feesadd/index', $data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
    }

    public function insertfeesadd() {
//        print_r($_POST);
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $config = array(
            array(
                'field' => 'data[mediumId]',
                'label' => 'Medium',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[programId]',
                'label' => 'Program',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[sessionId]',
                'label' => 'Session',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[groupId]',
                'label' => 'Group',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[shiftId]',
                'label' => 'Shift',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[headId]',
                'label' => 'Head',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[amount]',
                'label' => 'Amount',
                'rules' => 'required'
            )
        );


        
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
          redirect(admin_Url()."/feesadd");
        
       
        } else {

            $data = $this->input->post('data', TRUE);

            $enrol = $this->ProgramModleAdmin->getValidateofferedprogram($data);
            if (!empty($enrol)) {

                $data['programOfferId'] = $enrol['programOfferId'];

                $result = $this->FeesModleAdmin->duplicateFeesaddInfo($data);

                if (!$result) {

                    $this->FeesModleAdmin->addfees($data);
                    $data['stupayment']='active';
                    $sdata['message'] = 'Successfull!';
                    $this->session->set_userdata($sdata);
                    $data['feeslist'] = $this->FeesModleAdmin->getlistfees();
                    $this->load->view('system_path/admin/common/header_link'); // header Css link
                    $this->load->view('system_path/admin/common/header'); // body header
                    $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                    $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                    $this->load->view('system_path/admin/payment/feesadd/index', $data); // ...........body content page...........
                    $this->load->view('system_path/admin/common/footer'); // footer & script link
                   
                } else {
                    $sdata['errormessage'] = 'Duplicate Entry Found!';
                    $this->session->set_userdata($sdata);
                    $data['feeslist'] = $this->FeesModleAdmin->getlistfees();
                    $data['stupayment']='active';
                    $this->load->view('system_path/admin/common/header_link'); // header Css link
                    $this->load->view('system_path/admin/common/header'); // body header
                    $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                    $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                    $this->load->view('system_path/admin/payment/feesadd/index', $data); // ...........body content page...........
                    $this->load->view('system_path/admin/common/footer'); // footer & script link
                    $this->load->view('system_path/jsquery'); // footer & script link
                }
            } else {
                $sdata = array();
                $sdata['errormessage'] = 'Inserted Enrolment Information is not offered yet';
                $this->session->set_userdata($sdata);
                
                $data['stupayment']='active';
                $data['feeslist'] = $this->FeesModleAdmin->getlistfees();
                $this->load->view('system_path/admin/common/header_link'); // header Css link
                $this->load->view('system_path/admin/common/header'); // body header
                $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                $this->load->view('system_path/admin/payment/feesadd/index', $data); // ...........body content page...........
                $this->load->view('system_path/admin/common/footer'); // footer & script link
                $this->load->view('system_path/jsquery'); // footer & script link
            }
        }
    }

    public function feeslist() {

        if (isset($_POST['search'])) {
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');

            $config = array(
                array(
                    'field' => 'data[campusId]',
                    'label' => 'Campus',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'data[mediumId]',
                    'label' => 'Medium',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'data[programId]',
                    'label' => 'Program',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'data[groupId]',
                    'label' => 'Group',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'data[shiftId]',
                    'label' => 'Shift',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'data[sessionId]',
                    'label' => 'Session',
                    'rules' => 'required'
                )
            );

            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() == FALSE) {

                $this->load->view('templates/admin/common/header');
                $this->load->view('templates/admin/feesadd/feeslist');
                $this->load->view('templates/admin/common/footer');
            } else {
                $data = $this->input->post('data', TRUE);

                $enrollData = getValidateofferedprogram($data);
                //   print_r($data['enrollData']); die();
                if (!empty($enrollData)) {
                    $datax['programOfferId'] = $enrollData['programOfferId'];
                    $data['feeslist'] = $this->FeesModleAdmin->getlistfeesBydata($datax);
                    if (!empty($data['feeslist'])) {
                        $this->load->view('templates/admin/common/header');
                        $this->load->view('templates/admin/feesadd/feeslist', $data);
                        $this->load->view('templates/admin/common/footer');
                    } else {
                        $sdata['message'] = 'No Result Found!';
                        $this->session->set_userdata($sdata);
                        $this->load->view('templates/admin/common/header');
                        $this->load->view('templates/admin/feesadd/feeslist');
                        $this->load->view('templates/admin/common/footer');
                    }
                } else {
                    $sdata['message'] = 'Enrollment Information is not offer yet';
                    $this->session->set_userdata($sdata);
                    $this->load->view('templates/admin/common/header');
                    $this->load->view('templates/admin/feesadd/feeslist');
                    $this->load->view('templates/admin/common/footer');
                }
            }
        } else {
            $data['feeslist'] = $this->FeesModleAdmin->getlistfees();
            $this->load->view('templates/admin/common/header');
            $this->load->view('templates/admin/feesadd/feeslist', $data);
            $this->load->view('templates/admin/common/footer');
        }
    }

    public function editfees($id) {
        
        $id=(int)$id;
        $data['editData'] = $this->FeesModleAdmin->editfees($id);
    //    print_r($data); die();
        if (!empty($data['editData'])) {
           // $data['programlist'] = getofferProgramInfoById($data['editData']['programOfferId']);
            $data['stupayment']='active';
            $this->load->view('system_path/admin/common/header_link'); // header Css link
            $this->load->view('system_path/admin/common/header'); // body header
            $this->load->view('system_path/admin/common/side_menu'); // side bar menu
            $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
            $this->load->view('system_path/admin/payment/feesadd/editfees', $data); // ...........body content page...........
            $this->load->view('system_path/admin/common/footer'); // footer & script link
            $this->load->view('system_path/jsquery'); // footer & script link
        } else {
            $sdata['errormessage'] = 'No Data Found';
            $this->session->set_userdata($sdata);
            redirect(admin_Url()."/feesadd");
        }
    }

    public function updatefees($id) {

        $data = $this->input->post('data', TRUE);
        $enrol = $this->ProgramModleAdmin->getValidateofferedprogram($data);
              
        if (!empty($enrol)) {

            $data['programOfferId'] = $enrol['programOfferId'];
            
            $result = $this->FeesModleAdmin->duplicateFeesaddInfo($data);

            if (!$result) {
                
                $datax['headId'] = $data['headId'];
                $datax['date'] = date('d/m/Y');
                $datax['amount'] = $data['amount'];
                $datax['programOfferId']=$data['programOfferId'];
                
                $this->FeesModleAdmin->updatefees($datax, $id);

                $sdata = array();
                $sdata['message'] = 'Updated Successfully !';
                $this->session->set_userdata($sdata);
                $data['feeslist'] = $this->FeesModleAdmin->getlistfees();
                redirect(admin_Url()."/feesadd");
            } else {
                $sdata['errormessage'] = 'Duplicate Entry Found!';
                $this->session->set_userdata($sdata);

                $data['feeslist'] = $this->FeesModleAdmin->getlistfees();
                redirect(admin_Url()."/feesadd/editfees/".$id);
            }
        } else {

            $data['editData'] = $this->FeesModleAdmin->editfees($id);
            if (!empty($data['editData'])) {
                $sdata = array();
                $sdata['errormessage'] = 'Inserted Enrolment Information is not offered yet';
                $this->session->set_userdata($sdata);
                $data['programlist'] = getofferProgramInfoById($data['editData']['programOfferId']);
                redirect(admin_Url()."/feesadd/editfees/".$id);
            } else {
                $sdata['errormessage'] = 'Fees Not Found';
                $this->session->set_userdata($sdata);
                $data['feeslist'] = $this->FeesModleAdmin->getlistfees();
                redirect(admin_Url()."/feesadd");
            }
        }
    }

    public function deletefees($id) {

        $this->FeesModleAdmin->deletefees($id);
        redirect(admin_Url()."/feesadd");
    }

}

