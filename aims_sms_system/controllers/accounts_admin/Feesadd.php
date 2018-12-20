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
        $this->account_access();
        $this->load->model('admin/fees/FeesModleAdmin', 'FeesModleAdmin');
        $this->load->model('admin/program/ProgramModleAdmin', 'ProgramModleAdmin');
    }

    public function index() {
        $data['stupayment']='active';
        $data['feeslist'] = $this->FeesModleAdmin->getlistfees();
        $this->load->view('system_path/accounts/common/header_link'); // header Css link
        $this->load->view('system_path/accounts/common/header'); // body header
        $this->load->view('system_path/accounts/common/side_menu'); // side bar menu
        $this->load->view('system_path/accounts/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/accounts/payment/feesadd/index', $data); // ...........body content page...........
        $this->load->view('system_path/accounts/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
    }

        public function insertfeesadd() {

            $data = $this->input->post('data', TRUE);         
            $enrol = $this->ProgramModleAdmin->getValidateofferedprogram($data);
             //print_r($enrol); die();
                if (!empty($enrol)) {
                $programOfferId = $enrol['programOfferId'];
                
                $serial = $this->input->post('serial');             
                $quata_id = $this->input->post('quata_id');
                $amount = $this->input->post('amount');
                //print_r($quata_id); DIE();

            if (!empty($programOfferId)) {
              //  $chksrl = $quata_id;
                $count_clr = count($serial);
                for ($i = 0; $i < $count_clr; $i++) {
                 
                    $addvalue=$serial[$i]-1;

                    $datax['quata_id'] = $quata_id[$addvalue];
                    $datax['amount'] = $amount[$addvalue];
                    $datax['headId'] = $this->input->post('headId', true);
                    $datax['DueDate'] = $this->input->post('DueDate', true);
                    $datax['programOfferId'] = $programOfferId;
                    
              //  print_r($datax); 
                  $this->FeesModleAdmin->addfees($datax);                
                 
                }
                          
                  $sdata['message'] = 'Successfull!';
                  $this->session->set_userdata($sdata);
                  redirect(acc_Url()."/feesadd");
              //  die();
         
    
        }
        else{
                 
      $sdata = array();
                $sdata['errormessage'] = 'Inserted Enrolment Information is not offered yet';
                $this->session->set_userdata($sdata);
                
                $data['stupayment']='active';
                $data['feeslist'] = $this->FeesModleAdmin->getlistfees();
                $this->load->view('system_path/accounts/common/header_link'); // header Css link
                $this->load->view('system_path/accounts/common/header'); // body header
                $this->load->view('system_path/accounts/common/side_menu'); // side bar menu
                $this->load->view('system_path/accounts/common/top_menu', $data); // top bar menu
                $this->load->view('system_path/accounts/payment/feesadd/index', $data); // ...........body content page...........
                $this->load->view('system_path/accounts/common/footer'); // footer & script link
                $this->load->view('system_path/jsquery'); // footer & script link
            }
}else{
  $sdata = array();
                $sdata['errormessage'] = 'Inserted Enrolment Information is not offered yet';
                $this->session->set_userdata($sdata);
                
                $data['stupayment']='active';
                $data['feeslist'] = $this->FeesModleAdmin->getlistfees();
                $this->load->view('system_path/accounts/common/header_link'); // header Css link
                $this->load->view('system_path/accounts/common/header'); // body header
                $this->load->view('system_path/accounts/common/side_menu'); // side bar menu
                $this->load->view('system_path/accounts/common/top_menu', $data); // top bar menu
                $this->load->view('system_path/accounts/payment/feesadd/index', $data); // ...........body content page...........
                $this->load->view('system_path/accounts/common/footer'); // footer & script link
                $this->load->view('system_path/jsquery'); // footer & script link
        }
     }

    
    
    
    public function oldinsertfeesadd() {
//        print_r($_POST);
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $config = array(
        
            array(
                'field' => 'sessionId',
                'label' => 'Session',
                'rules' => 'required'
            ),
            array(
                'field' => 'groupId',
                'label' => 'Group',
                'rules' => 'required'
            ),
            array(
                'field' => 'shiftId',
                'label' => 'Shift',
                'rules' => 'required'
            ),
            array(
                'field' => 'headId',
                'label' => 'Head',
                'rules' => 'required'
            )
       
        );


        
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
          redirect(acc_Url()."/feesadd");
        
       
        } else {
             $data = $this->input->post('data', TRUE);
                    
         $enrol = $this->ProgramModleAdmin->getValidateofferedprogram($data);
            if (!empty($enrol)) {
              $data['programOfferId'] = $enrol['programOfferId'];
            
               $quata_id = $this->input->post('quata_id');
               $amount = $this->input->post('amount');
                $headId = $this->input->post('headId');
              
          
            // print_r($courseId); die();
           
                $tid = $quata_id;
               
                for ($i = 0; $i < count($tid); $i++) {
                 
                    $add_value=$quata_id[$i]-1;

                   $data['quata_id'] = $quata_id[$add_value];
                    $data['amount'] = $amount[$add_value];
                     $data['headId'] = $this->input->post('headId');
                       $data['programOfferId'] = $this->input->post('programOfferId');
                
 
                }
                  
                      $data = array(
                         "quata_id" => $quata_id,
                         "amount" => $amount,
                         
                           "headId" => $headId
                           
            
        );
                       //   echo "<pre>"; print_r($data); die();
    
     $this->FeesModleAdmin->addfees($data);
                    $data['stupayment']='active';
                    $sdata['message'] = 'Successfull!';
                    $this->session->set_userdata($sdata);
                    redirect(acc_Url()."/feesadd");
            }
            
   else {
                $sdata = array();
                $sdata['errormessage'] = 'Inserted Enrolment Information is not offered yet';
                $this->session->set_userdata($sdata);
                
                $data['stupayment']='active';
                $data['feeslist'] = $this->FeesModleAdmin->getlistfees();
                $this->load->view('system_path/accounts/common/header_link'); // header Css link
                $this->load->view('system_path/accounts/common/header'); // body header
                $this->load->view('system_path/accounts/common/side_menu'); // side bar menu
                $this->load->view('system_path/accounts/common/top_menu', $data); // top bar menu
                $this->load->view('system_path/accounts/payment/feesadd/index', $data); // ...........body content page...........
                $this->load->view('system_path/accounts/common/footer'); // footer & script link
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

                $this->load->view('templates/accounts/common/header');
                $this->load->view('templates/accounts/feesadd/feeslist');
                $this->load->view('templates/accounts/common/footer');
            } else {
                $data = $this->input->post('data', TRUE);

                $enrollData = getValidateofferedprogram($data);
                //   print_r($data['enrollData']); die();
                if (!empty($enrollData)) {
                    $datax['programOfferId'] = $enrollData['programOfferId'];
                    $data['feeslist'] = $this->FeesModleAdmin->getlistfeesBydata($datax);
                    if (!empty($data['feeslist'])) {
                        $data['stupayment']='active';
                        $data['feeslist'] = $this->FeesModleAdmin->getlistfees();
                        $this->load->view('system_path/accounts/common/header_link'); // header Css link
                        $this->load->view('system_path/accounts/common/header'); // body header
                        $this->load->view('system_path/accounts/common/side_menu'); // side bar menu
                        $this->load->view('system_path/accounts/common/top_menu', $data); // top bar menu
                        $this->load->view('system_path/accounts/payment/feesadd/feeslist', $data); // ...........body content page...........
                        $this->load->view('system_path/accounts/common/footer'); // footer & script link
                        $this->load->view('system_path/jsquery'); // footer & script link
                        
                    } else {
                        $sdata['message'] = 'No Result Found!';
                        $this->session->set_userdata($sdata);
                        $data['stupayment'] = 'active';
                        $data['feeslist'] = $this->FeesModleAdmin->getlistfees();
                        $this->load->view('system_path/accounts/common/header_link'); // header Css link
                        $this->load->view('system_path/accounts/common/header'); // body header
                        $this->load->view('system_path/accounts/common/side_menu'); // side bar menu
                        $this->load->view('system_path/accounts/common/top_menu', $data); // top bar menu
                        $this->load->view('system_path/accounts/payment/feesadd/feeslist', $data); // ...........body content page...........
                        $this->load->view('system_path/accounts/common/footer'); // footer & script link
                        $this->load->view('system_path/jsquery'); // footer & script link
                    }
                } else {
                    $sdata['errormessage'] = 'Enrollment Information is not offer yet';
                    $this->session->set_userdata($sdata);
                    $data['stupayment'] = 'active';
                    $data['feeslist'] = $this->FeesModleAdmin->getlistfees();
                    $this->load->view('system_path/accounts/common/header_link'); // header Css link
                    $this->load->view('system_path/accounts/common/header'); // body header
                    $this->load->view('system_path/accounts/common/side_menu'); // side bar menu
                    $this->load->view('system_path/accounts/common/top_menu', $data); // top bar menu
                    $this->load->view('system_path/accounts/payment/feesadd/feeslist', $data); // ...........body content page...........
                    $this->load->view('system_path/accounts/common/footer'); // footer & script link
                    $this->load->view('system_path/jsquery'); // footer & script link
                }
            }
        } else {
            $data['stupayment'] = 'active';
            $data['feeslist'] = $this->FeesModleAdmin->getlistfees();
            $this->load->view('system_path/accounts/common/header_link'); // header Css link
            $this->load->view('system_path/accounts/common/header'); // body header
            $this->load->view('system_path/accounts/common/side_menu'); // side bar menu
            $this->load->view('system_path/accounts/common/top_menu', $data); // top bar menu
            $this->load->view('system_path/accounts/payment/feesadd/feeslist', $data); // ...........body content page...........
            $this->load->view('system_path/accounts/common/footer'); // footer & script link
            $this->load->view('system_path/jsquery'); // footer & script link
        }
    }

    public function editfees($id) {
        
        $id=(int)$id;
        $data['editData'] = $this->FeesModleAdmin->editfees($id);
    //    print_r($data); die();
        if (!empty($data['editData'])) {
           // $data['programlist'] = getofferProgramInfoById($data['editData']['programOfferId']);
            $data['stupayment']='active';
            $this->load->view('system_path/accounts/common/header_link'); // header Css link
            $this->load->view('system_path/accounts/common/header'); // body header
            $this->load->view('system_path/accounts/common/side_menu'); // side bar menu
            $this->load->view('system_path/accounts/common/top_menu', $data); // top bar menu
            $this->load->view('system_path/accounts/payment/feesadd/editfees', $data); // ...........body content page...........
            $this->load->view('system_path/accounts/common/footer'); // footer & script link
            $this->load->view('system_path/jsquery'); // footer & script link
        } else {
            $sdata['errormessage'] = 'No Data Found';
            $this->session->set_userdata($sdata);
            redirect(acc_Url()."/feesadd");
        }
    }

    public function updatefees($id) {

        $data = $this->input->post('data', TRUE);
       // print_r($data); die();
        $enrol = $this->ProgramModleAdmin->getValidateofferedprogram($data);
              
        if (!empty($enrol)) {

            $data['programOfferId'] = $enrol['programOfferId'];
            
            $result = $this->FeesModleAdmin->duplicateFeesaddInfo($data);

            if (!$result) {
                
                $datax['headId'] = $data['headId'];
                $datax['quata_id'] = $data['quata_id'];
                $datax['date'] = date('d/m/Y');
                $datax['amount'] = $data['amount'];
                $datax['DueDate'] = $data['DueDate'];
                $datax['programOfferId']=$data['programOfferId'];
                
                $this->FeesModleAdmin->updatefees($datax, $id);

                $sdata = array();
                $sdata['message'] = 'Updated Successfully !';
                $this->session->set_userdata($sdata);
                $data['feeslist'] = $this->FeesModleAdmin->getlistfees();
                redirect(acc_Url()."/feesadd");
            } else {
                $sdata['errormessage'] = 'Duplicate Entry Found!';
                $this->session->set_userdata($sdata);

                $data['feeslist'] = $this->FeesModleAdmin->getlistfees();
                redirect(acc_Url()."/feesadd/editfees/".$id);
            }
        } else {

            $data['editData'] = $this->FeesModleAdmin->editfees($id);
            if (!empty($data['editData'])) {
                $sdata = array();
                $sdata['errormessage'] = 'Inserted Enrolment Information is not offered yet';
                $this->session->set_userdata($sdata);
                $data['programlist'] = getofferProgramInfoById($data['editData']['programOfferId']);
                redirect(acc_Url()."/feesadd/editfees/".$id);
            } else {
                $sdata['errormessage'] = 'Fees Not Found';
                $this->session->set_userdata($sdata);
                $data['feeslist'] = $this->FeesModleAdmin->getlistfees();
                redirect(acc_Url()."/feesadd");
            }
        }
    }

    public function deletefees($id) {

        $this->FeesModleAdmin->deletefees($id);
        redirect(acc_Url()."/feesadd");
    }

}

