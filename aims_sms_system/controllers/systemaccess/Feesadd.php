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
        $this->my_admin();
        $this->load->model('admin/fees/FeesModleAdmin', 'FeesModleAdmin');
        $this->load->model('admin/program/ProgramModleAdmin', 'ProgramModleAdmin');
    }

    public function index() {
        $data['stupayment']='active';
        $data['feeslist'] = $this->FeesModleAdmin->getlistfees();
       // echo '<pre>';print_r($data);exit;
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/payment/feesadd/index', $data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
    }

    public function insert()
    {
        //echo '<pre>';print_r($_POST);exit;
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
        
            array(
                'field' => 'data[sessionId]',
                'label' => 'Session',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[programOfferId]',
                'label' => 'Program Offer',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[headId]',
                'label' => 'Head',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[studentStatus]',
                'label' => 'Add Fees For',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[DueDate]',
                'label' => 'Due Date',
                'rules' => 'required'
            )
       
        );

         $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
            redirect(admin_Url()."/feesadd");
        } else {
            $data = $this->input->post('data', TRUE);
            $check = $this->checkFee($data);
            if (!$check) {
                $sdata['errormessage'] = 'Already Exit..';
                $this->session->set_userdata($sdata);
                redirect(admin_Url()."/feesadd");
            }
            $serial = $this->input->post('serial'); 
            $count = count($serial);
            for ($i = 0; $i < $count; $i++) { 

              $s = $serial[$i]-1;
              $insert_data = [
                'programOfferId' => $data['programOfferId'],
                'quata_id' => $this->input->post('quata_id')[$s],
                'amount' => $this->input->post('amount')[$s],
                'headId' => $data['headId'],
                'DueDate' => date("Y-m-d", strtotime($data['DueDate'])),
                'studentStatus' => $data['studentStatus']
            ];
            $this->db->insert('fees', $insert_data);             
            }

            if ($this->db->insert_id()) {
                $sdata['message'] = 'Successfully Inserted';
            } else {
                $sdata['errormessage'] = 'Server Error';
            }

            $this->session->set_userdata($sdata);
            
            redirect(admin_Url()."/feesadd");
        }
    }

    private function checkFee($data = [],$id = 0)
    {
        $check = true;
        $this->db
        ->where('programOfferId', $data['programOfferId'])
        ->where('quata_id', 1)
        ->where('headId', $data['headId']);
        if ($id)
        {
            $this->db->where('feeId !=', $id);
        }
        $record = $this->db->get('fees')->result();

        if($record)
        {
            if($data['studentStatus']==3)
            {
                $check = false;
                return $check;
            }
            foreach($record as $rcd)
            {
                if($rcd->studentStatus==3)
                {
                    $check = false;
                    return $check;
                }
                else
                {
                    if ($rcd->studentStatus==$data['studentStatus'])
                    {
                        $check = false;
                        return $check;
                    }
                }
            }
        }

        return $check;
    }

        public function insertfeesadd() {
           // echo '<pre>';print_r($_POST);
            $data = $this->input->post('data', TRUE);         
            $enrol = $this->ProgramModleAdmin->getValidateofferedprogram($data);
           // echo '<pre>'; print_r($enrol); die();
                if (!empty($enrol)) {
                $enrol = $enrol[0];
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
                    $datax['studentStatus'] = $this->input->post('studentStatus', true);
                    $datax['programOfferId'] = $programOfferId;
                    
              //  print_r($datax); 
                  $this->FeesModleAdmin->addfees($datax);                
                 
                }
                          
                  $sdata['message'] = 'Successfull!';
                  $this->session->set_userdata($sdata);
                  redirect(admin_Url()."/feesadd");
              //  die();
         
    
        }
        else{
                 
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
}else{
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
          redirect(admin_Url()."/feesadd");
        
       
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
                    redirect(admin_Url()."/feesadd");
            }
            
   else {
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
                        $data['stupayment']='active';
                        $data['feeslist'] = $this->FeesModleAdmin->getlistfees();
                        $this->load->view('system_path/admin/common/header_link'); // header Css link
                        $this->load->view('system_path/admin/common/header'); // body header
                        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                        $this->load->view('system_path/admin/payment/feesadd/feeslist', $data); // ...........body content page...........
                        $this->load->view('system_path/admin/common/footer'); // footer & script link
                        $this->load->view('system_path/jsquery'); // footer & script link
                        
                    } else {
                        $sdata['message'] = 'No Result Found!';
                        $this->session->set_userdata($sdata);
                        $data['stupayment'] = 'active';
                        $data['feeslist'] = $this->FeesModleAdmin->getlistfees();
                        $this->load->view('system_path/admin/common/header_link'); // header Css link
                        $this->load->view('system_path/admin/common/header'); // body header
                        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                        $this->load->view('system_path/admin/payment/feesadd/feeslist', $data); // ...........body content page...........
                        $this->load->view('system_path/admin/common/footer'); // footer & script link
                        $this->load->view('system_path/jsquery'); // footer & script link
                    }
                } else {
                    $sdata['errormessage'] = 'Enrollment Information is not offer yet';
                    $this->session->set_userdata($sdata);
                    $data['stupayment'] = 'active';
                    $data['feeslist'] = $this->FeesModleAdmin->getlistfees();
                    $this->load->view('system_path/admin/common/header_link'); // header Css link
                    $this->load->view('system_path/admin/common/header'); // body header
                    $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                    $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                    $this->load->view('system_path/admin/payment/feesadd/feeslist', $data); // ...........body content page...........
                    $this->load->view('system_path/admin/common/footer'); // footer & script link
                    $this->load->view('system_path/jsquery'); // footer & script link
                }
            }
        } else {
            $data['stupayment'] = 'active';
            $data['feeslist'] = $this->FeesModleAdmin->getlistfees();
            $this->load->view('system_path/admin/common/header_link'); // header Css link
            $this->load->view('system_path/admin/common/header'); // body header
            $this->load->view('system_path/admin/common/side_menu'); // side bar menu
            $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
            $this->load->view('system_path/admin/payment/feesadd/feeslist', $data); // ...........body content page...........
            $this->load->view('system_path/admin/common/footer'); // footer & script link
            $this->load->view('system_path/jsquery'); // footer & script link
        }
    }

    private function getProgramOfferList($id = 0)
    {
        $records = $this->db
                ->select('
                    po.programOfferId AS id,
                    p.programName,
                    m.mediumName,
                    g.groupName,
                    s.shiftName,
                    se.sectionName
                    ')
                ->from('programoffer as po')
                ->join('program AS p', 'po.programId = p.programId')
                ->join('medium AS m', 'po.mediumId = m.mediumId')
                ->join('group AS g', 'po.groupId = g.groupId')
                ->join('shift AS s', 'po.shiftId = s.shiftId')
                ->join('section AS se', 'po.sectionId = se.sectionId')
                ->where('po.sessionId', $id)
                ->get()
                ->result();
               // print_r($records);
        return $records;
    }

    public function editfees($id) {
        
        $id=(int)$id;
        $data['editData'] = $this->FeesModleAdmin->editfees($id);
    //    print_r($data); die();
        if (!empty($data['editData'])) {
            $sessionId = isset($data['editData']['sessionId']) ? $data['editData']['sessionId'] : 0;
            $data['programOfferlist'] = $this->getProgramOfferList($sessionId);
            //echo '<pre>';print_r($data['programOfferlist']);exit;
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

    public function update($id)
    {
        //echo '<pre>';print_r($_POST);exit;
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
        
            array(
                'field' => 'data[sessionId]',
                'label' => 'Session',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[programOfferId]',
                'label' => 'Program Offer',
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
           // $check = $this->checkFee($data,$id);
            $result = $this->FeesModleAdmin->duplicateFeesaddInfo($data);
            if ($result) {
                $sdata['errormessage'] = 'Already Exit..';
                $this->session->set_userdata($sdata);
                redirect(admin_Url()."/feesadd");
            }

            $update_data['headId'] = $data['headId'];
            $update_data['quata_id'] = $data['quata_id'];
            $update_data['amount'] = $data['amount'];
            $update_data['DueDate'] = date("Y-m-d", strtotime($data['DueDate']));
            $update_data['programOfferId']=$data['programOfferId'];

            $this->db->where('feeId', $id);
            $q = $this->db->update('fees', $update_data);

            if ($q) {
                $sdata['message'] = 'Successfully Updated';
            } else {
                $sdata['errormessage'] = 'Server Error';
            }

            $this->session->set_userdata($sdata);
            
            redirect(admin_Url()."/feesadd");
        }
    }

    public function deletefees($id) {

        $this->FeesModleAdmin->deletefees($id);
        redirect(admin_Url()."/feesadd");
    }

}

