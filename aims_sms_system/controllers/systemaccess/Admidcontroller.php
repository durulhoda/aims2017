<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */

class Admidcontroller extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->my_admin();
        $this->load->model('admin/admid/AdmidModleAdmin', 'AdmidModleAdmin');
        $this->load->model('admin/program/ProgramModleAdmin', 'ProgramModleAdmin');
    }

    public function index() {
        $data['listdata'] = $this->AdmidModleAdmin->getadmidlist();
        
        $data['setting']='active';
        $data['admid']='active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu',$data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu'); // top bar menu
        $this->load->view('system_path/admin/admid/index',$data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
         $this->load->view('system_path/jsquery'); // footer & script link
    }

    public function insertadmidinfo() {

            $data = $this->input->post('data', TRUE);     
             $datax = $this->input->post('datax', TRUE);
            $enrol = $this->ProgramModleAdmin->getValidateofferedprogram($datax);
             //print_r($enrol); die();
                if (!empty($enrol)) {
                $data['programOfferId'] = $enrol['programOfferId'];       
               // print_r($data); die();
            if (!empty($data['programOfferId'])) {          
                  $this->AdmidModleAdmin->addadmidInfo($data);                                           
                  $sdata['message'] = 'Successfull!';
                  $this->session->set_userdata($sdata);
                  redirect(admin_Url()."/admidcontroller");
              //  die();
         
    
        }
        else{
                 
      $sdata = array();
                $sdata['errormessage'] = 'Inserted Enrolment Information is not offered yet';
                $this->session->set_userdata($sdata);
                
              $this->session->set_userdata($sdata);
                  redirect(admin_Url()."/admidcontroller");
            }
}else{
  $sdata = array();
                $sdata['errormessage'] = 'Inserted Enrolment Information is not offered yet';
                $this->session->set_userdata($sdata);
                
                $this->session->set_userdata($sdata);
                  redirect(admin_Url()."/admidcontroller");
        }
     }


    
     public function editinfo($id){
    
        $id=(int)$id; 
        $data['editData'] = $this->AdmidModleAdmin->editinfo($id);
        if(!empty($data['editData']))
        {
            $data['setting'] = 'active';
            $data['quata'] = 'active';
            $this->load->view('system_path/admin/common/header_link'); // header Css link
            $this->load->view('system_path/admin/common/header'); // body header
            $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
            $this->load->view('system_path/admin/common/top_menu'); // top bar menu
            $this->load->view('system_path/admin/admid/editAdmid', $data); // ...........body content page...........
            $this->load->view('system_path/admin/common/footer'); // footer & script link
        }
        else{
            $sdata['errormessage'] = 'No quata information found';
            $this->session->set_userdata($sdata);
           redirect(admin_Url()."/admidcontroller");
            
        }
                
    }
    public function updatequata($id){
    
            $data = $this->input->post('data', TRUE);
           // print_r($id);
            //echo '<pre>';print_r($data);exit;
          //  $result = $this->AdmidModleAdmin->duplicateadmidInfo($data);

            if ($data) {
                $this->AdmidModleAdmin->updateadmidInfo($data, $id);
            	   $sdata['message'] = 'Successfully Updated!';
            } else {
                $sdata['errormessage'] = 'Information Not Updated!';
            }     
            $this->session->set_userdata($sdata);   
            redirect(admin_Url()."/admidcontroller");          
    }
    
        public function deleteinfo($id) { 
            $id = (int) $id;
            
           // print_r($data); die();
            if(!empty($id)){
         
            $this->AdmidModleAdmin->deleteadmidInfo($id);
            $sdata['message'] = 'Information Deleted';
            $this->session->set_userdata($sdata);
            redirect(admin_Url()."/admidcontroller");   
       }else{
            
            $sdata['message'] = 'Information Not Deleted';
            $this->session->set_userdata($sdata);
            redirect(admin_Url()."/admidcontroller");   
       }
    
   }

    //put your code here
}
