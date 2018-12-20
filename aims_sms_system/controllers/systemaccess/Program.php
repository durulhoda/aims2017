<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class Program extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->my_admin();
        $this->load->model('admin/program/ProgramModleAdmin', 'ProgramModleAdmin');

    }

     public function index() {
         
        $data['programlist'] = $this->ProgramModleAdmin->getlistProgram(); 
        $data['setting']='active';
        $data['class']='active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu',$data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu'); // top bar menu
        $this->load->view('system_path/admin/program/index',$data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
    }

    public function insertProgram() {
//        print_r($_POST);
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $config = array(
               array(
                'field' => 'data[classId]',
                'label' => 'Class Name',
                'rules' => 'required|xss_clean'
            ),
            array(
                'field' => 'data[programName]',
                'label' => 'Class Name',
                'rules' => 'required|xss_clean'
            ),
            array(
                'field' => 'data[programLevel]',
                'label' => 'Class Level',
                'rules' => 'required'
            )
        );



        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {

           $this->index();
        } else {

            $data = $this->input->post('data', TRUE);
            $result = $this->ProgramModleAdmin->duplicateProgramInfo($data);

            if (!$result) {
                $this->ProgramModleAdmin->addProgramInfo($data);

                $sdata['message'] = 'New Class information saved';
                $this->session->set_userdata($sdata);

                redirect(admin_Url()."/program");
            } else {
                $sdata['errormessage'] = 'Duplicate Class information  found';
                $this->session->set_userdata($sdata);
                $this->index();
            }
        }
    }

    
    public function editdprogram($id) {
        $id=(int)$id;
        $data['editData'] = $this->ProgramModleAdmin->editProgramInfo($id);
        if(!empty($data['editData']))
        {
            $data['setting'] = 'active';
            $data['class'] = 'active';
            $this->load->view('system_path/admin/common/header_link'); // header Css link
            $this->load->view('system_path/admin/common/header'); // body header
            $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
            $this->load->view('system_path/admin/common/top_menu'); // top bar menu
            $this->load->view('system_path/admin/program/editprogram', $data); // ...........body content page...........
            $this->load->view('system_path/admin/common/footer'); // footer & script link
            $this->load->view('system_path/jsquery'); // footer & script link
        }
        else{
            $sdata['errormessage'] = 'Class information not found';
            $this->session->set_userdata($sdata);
             redirect(admin_Url()."/program");
        }
    }

    public function updateprogram($id) {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $config = array(
            array(
                'field' => 'data[programName]',
                'label' => 'Class Name',
                'rules' => 'required|xss_clean'
            ),
            array(
                'field' => 'data[programLevel]',
                'label' => 'Class Level',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {

           redirect(admin_Url()."/program/editdprogram/".$id);
        } else {
            $id=(int)$id;
           $data = $this->input->post('data', TRUE);
           $result = $this->ProgramModleAdmin->duplicateProgramInfo($data);

           if (!$result) {
               $this->ProgramModleAdmin->updateProgramInfo($data, $id);
               $sdata['message'] = 'Class information Updated';
               $this->session->set_userdata($sdata);
               redirect(admin_Url()."/program");
           } else {
               $sdata['errormessage'] = 'Duplicate Class information Found!';
               $this->session->set_userdata($sdata);

               redirect(admin_Url()."/program/editdprogram/".$id);
           }
        }
    }

    public function deleteprogram($id) { 
            $id = (int) $id;
            $data['delete_config'] = $this->ProgramModleAdmin->checkProgramInfo($id);
           // print_r($data); die();
            if(!empty($data['delete_config'])){
            $sdata['errormessage'] = 'Class Information Not Deleted..! Because Already Use This Anothor Portion..! So Please Contact your Software Administrator..';
            $this->session->set_userdata($sdata);
          redirect(admin_Url()."/program"); 
            }
            else
                {
            $this->ProgramModleAdmin->deleteProgramInfo($id);
            $sdata['message'] = 'Class information deleted';
            $this->session->set_userdata($sdata);
           redirect(admin_Url()."/program");      
       }
    
   }

    public function programoffer() {
        $data['classoffer']='active';
        $data['cloffer'] = 'active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu',$data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu'); // top bar menu
        $this->load->view('system_path/admin/programoffer/index'); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
    }

    public function insertOfferProgram() {
//        print_r($_POST);
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $config = array(
            array(
                'field' => 'data[programLevel]',
                'label' => 'Class Level',
                'rules' => 'required|xss_clean'
            ),
            array(
                'field' => 'data[mediumId]',
                'label' => 'Medium',
                'rules' => 'required|xss_clean'
            ),
            array(
                'field' => 'data[programId]',
                'label' => 'Program',
                'rules' => 'required|xss_clean'
            ),
            array(
                'field' => 'data[groupId]',
                'label' => 'Group',
                'rules' => 'required|xss_clean'
            ),
            array(
                'field' => 'data[shiftId]',
                'label' => 'Shift',
                'rules' => 'required|xss_clean'
            ),
            array(
                'field' => 'data[sectionId]',
                'label' => 'Section',
                'rules' => 'required|xss_clean'
            ),
            array(
                'field' => 'data[employeeId]',
                'label' => 'Form Master',
                'rules' => 'required|xss_clean'
            ),
            array(
                'field' => 'data[sessionId]',
                'label' => 'Session',
                'rules' => 'required|xss_clean'
            ),
            array(
                'field' => 'data[applicantSeat]',
                'label' => 'Total Seat',
                'rules' => 'required|xss_clean'
            )
        );

        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
            $data['cloffer'] = 'active';
            $data['classoffer'] = 'active';
            $this->load->view('system_path/admin/common/header_link'); // header Css link
            $this->load->view('system_path/admin/common/header'); // body header
            $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
            $this->load->view('system_path/admin/common/top_menu'); // top bar menu
            $this->load->view('system_path/admin/programoffer/index', $data); // ...........body content page...........
            $this->load->view('system_path/admin/common/footer'); // footer & script link
        } 
        else {

            $data = $this->input->post('data', TRUE);
           // echo '<pre>';print_r($data);exit;
            $result = $this->ProgramModleAdmin->duplicateProgramOffer($data);

            if (!$result) {
                $this->ProgramModleAdmin->addProgramOffer($data);

                $sdata['message'] = 'Class Offer information successfully added';
                $this->session->set_userdata($sdata);

                redirect(admin_Url()."/program/programoffer", 'refresh');
            } 
            else {
                $sdata['errormessage'] = 'Duplicate Class Offer value found';
                $this->session->set_userdata($sdata);

                redirect(admin_Url()."/program/programoffer", 'refresh');
            }
        }
    }

  // search program offer information............  
    public function SearchProgramOffer() {
        $data['cloffer'] = 'active';
        $data['classofferlist'] = 'active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu'); // top bar menu
        $this->load->view('system_path/admin/programoffer/searchprogramoffer', $data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // dependent script
    }
  
   // get program offer information by searched value............ 
    public function programOfferList() {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $config = array(
            array(
                'field' => 'data[sessionId]',
                'label' => 'Session',
                'rules' => 'required|xss_clean'
            )
      
            
        );

        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
            $data['cloffer'] = 'active';
            $data['classoffer'] = 'active';
            $this->load->view('system_path/admin/common/header_link'); // header Css link
            $this->load->view('system_path/admin/common/header'); // body header
            $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
            $this->load->view('system_path/admin/common/top_menu'); // top bar menu
            $this->load->view('system_path/admin/programoffer/index', $data); // ...........body content page...........
            $this->load->view('system_path/admin/common/footer'); // footer & script link
            $this->load->view('system_path/jsquery'); // dependent script
        } 
        else {
            
            $data = $this->input->post('data', TRUE);
            $data['offeprogramlist'] = $this->ProgramModleAdmin->getOfferedProgramList_bySession($data); //// get program offer information by data value..
            if(!empty($data['offeprogramlist']))
            {
                $data['cloffer'] = 'active';
                $data['classofferlist'] = 'active';
                $this->load->view('system_path/admin/common/header_link'); // header Css link
                $this->load->view('system_path/admin/common/header'); // body header
                $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
                $this->load->view('system_path/admin/common/top_menu'); // top bar menu
                $this->load->view('system_path/admin/programoffer/programofferlist', $data); // ...........body content page...........
                $this->load->view('system_path/admin/common/footer'); // footer & script link
                $this->load->view('system_path/jsquery'); // dependent script
            }
            else
            {
                $sdata['errormessage'] = 'Class offer information not found';
                $this->session->set_userdata($sdata);

                redirect(admin_Url() . "/program/SearchProgramOffer", 'refresh');
            }
            
        }
       
    }
    
    public function editdprogramOffer($id) {
        $id=(int)$id;
        $data['editData'] = $this->ProgramModleAdmin->getofferProgramInfoById($id);
        if(!empty($data['editData']))
        {
            $data['setting'] = 'active';
            $data['class'] = 'active';
            $this->load->view('system_path/admin/common/header_link'); // header Css link
            $this->load->view('system_path/admin/common/header'); // body header
            $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
            $this->load->view('system_path/admin/common/top_menu'); // top bar menu
            $this->load->view('system_path/admin/programoffer/editdofferprogram', $data); // ...........body content page...........
            $this->load->view('system_path/admin/common/footer'); // footer & script link
            $this->load->view('system_path/jsquery'); // footer & script link
        }
        else{
            $sdata['errormessage'] = 'Class offer information not found';
            $this->session->set_userdata($sdata);
             redirect(admin_Url()."/program/SearchProgramOffer");
        }
    }
    
    public function updateofferprogram($id) {


        $data = $this->input->post('data', TRUE);
        $result = $this->ProgramModleAdmin->duplicateProgramOffer($data, $id);

        if (!$result) {
            $this->ProgramModleAdmin->updateOfferProgramInfo($data, $id);

            $sdata['message'] = 'Class offer information updated';
            $this->session->set_userdata($sdata);
            redirect(admin_Url()."/program/SearchProgramOffer");
        } else {
            $sdata['message'] = 'Duplicate Class offer information Found!';
            $this->session->set_userdata($sdata);

           $this->editdprogramOffer($id);
        }
    }

    
    public function deleteprogramOffer($id) {

        $this->ProgramModleAdmin->deleteOfferProgram($id);
        $sdata['message'] = 'Class offer information deleted';
        $this->session->set_userdata($sdata);
        redirect(admin_Url()."/program/SearchProgramOffer");
    }
    
    public function ReOfferProgramlist() {

        $data['offeprogramlist'] = $this->ProgramModleAdmin->getlistofferprogram();

        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/program/reofferprogramlist', $data);
        $this->load->view('templates/admin/common/footer');
    }

    public function getofferProgramInfoById($id) {

        $this->load->view('templates/admin/common/header');
        $data['editData'] = $this->ProgramModleAdmin->getofferProgramInfoById($id);

        $this->load->view('templates/admin/program/editdofferprogram', $data);
        $this->load->view('templates/admin/common/footer');
    }

    
    
    
    public function ReOfferProgram() {
        
        
        
        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/program/programreoffer');
        $this->load->view('templates/admin/common/footer');
    }
    
    public function searchOfferProgram() {

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
                'label' => 'Class',
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
                'field' => 'data[sectionId]',
                'label' => 'Section',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[employeeId]',
                'label' => 'Teacher ',
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
//                    redirect(base_url('admin/campus'));
            $this->load->view('templates/admin/common/header');
            $this->load->view('templates/admin/program/programreoffer');
            $this->load->view('templates/admin/common/footer');
        }
        else{
            $data = $this->input->post('data', TRUE);
            if(empty($data['campusId']) || empty($data['programId']) || empty($data['sessionId']) || empty($data['sectionId']) || empty($data['shiftId']) || empty($data['groupId']) || empty($data['mediumId']) || empty($data['employeeId'])) {

            $sdata['message'] = "Select All Searching Value";
            $this->session->set_userdata($sdata);
            $this->load->view('templates/admin/common/header');
            $this->load->view('templates/admin/program/programreoffer');
            $this->load->view('templates/admin/common/footer');
        } else {
            $data['programofferlist'] = $this->ProgramModleAdmin->searchlistofferprogram($data);
                if($data['programofferlist']){
                $this->load->view('templates/admin/common/header');
                $this->load->view('templates/admin/program/programreoffer',$data);
                $this->load->view('templates/admin/common/footer');
             }
             else{
                 $sdata['message'] = "Searching Value is not match";
                    $this->session->set_userdata($sdata);
                    $this->load->view('templates/admin/common/header');
                    $this->load->view('templates/admin/program/programreoffer');
                    $this->load->view('templates/admin/common/footer');
             }
        }
    }
    }
    
    public function insertreofferedprograme() {

        $id = $this->input->post('id', TRUE);
        $employeeId = $this->input->post('employeeId', TRUE);
        $campusId = $this->input->post('campusId', TRUE);
        $mediumId = $this->input->post('mediumId', TRUE);
        $programId = $this->input->post('programId', TRUE);
        $groupId = $this->input->post('groupId', TRUE);
        $sectionId = $this->input->post('sectionId', TRUE);
        $shiftId = $this->input->post('shiftId', TRUE);
        $sessionId = $this->input->post('sessionId', TRUE);
        $applicantseat = $this->input->post('applicantSeat', TRUE);
        
        if (!empty($id)) {

         
           $count = count($id);
                
     //      print_r($count);           die();

                for ($i =0; $i < $count; $i++) {

                    $data = array(
                        'id' => $id[$i],
                        'employeeId' => $employeeId[$i],
                        'campusId' => $campusId[$i],
                        'mediumId' => $mediumId[$i],
                        'programId' => $programId[$i],
                        'groupId' => $groupId[$i],
                        'sectionId' => $sectionId[$i],
                        'shiftId' => $shiftId[$i],
                        'sessionId' => $sessionId,
                        'applicantSeat' => $applicantseat[$i]
                        
                    );
                    
              //      print_r($data);
                      
                    if ($data['sessionId'] == 'select') 
                    {

                        $sdata['message'] = 'Select Session for re-offer!';
                        $this->session->set_userdata($sdata);

                        $this->load->view('templates/admin/common/header');
                        $this->load->view('templates/admin/program/programreoffer');
                        $this->load->view('templates/admin/common/footer');
                    }
                     else {
                         
                 
                        $this->ProgramModleAdmin->deleteofferedPrograme($data); 
                        
                        $result = $this->ProgramModleAdmin->duplicateProgramOffer2($data);

                        if (!$result) {
                            $data['classStatus'] = "1";
                            
                       //     print_r($data); die();
                            $this->ProgramModleAdmin->addProgramOffer($data);
                            $sdata['message'] = 'This Class is Re-offered Successfully...';
                            $this->session->set_userdata($sdata);
                            $this->load->view('templates/admin/common/header');
                        $this->load->view('templates/admin/program/programreoffer');
                        $this->load->view('templates/admin/common/footer');
                            
                        } 
                        else {
                            $sdata['message'] = 'This Class is already offered!';
                            $this->session->set_userdata($sdata);

                            $this->load->view('templates/admin/common/header');
                            $this->load->view('templates/admin/program/programreoffer');
                            $this->load->view('templates/admin/common/footer');
                        }
                     }
                }
                            
                        $this->load->view('templates/admin/common/header');
                        $this->load->view('templates/admin/program/programreoffer');
                        $this->load->view('templates/admin/common/footer');
            
        } else {
            $sdata['message'] = 'Select CheckBox for re-offer!';
            $this->session->set_userdata($sdata);

            $this->load->view('templates/admin/common/header');
            $this->load->view('templates/admin/program/programreoffer');
            $this->load->view('templates/admin/common/footer');
        }
    }
    
    
    
    
    
}

