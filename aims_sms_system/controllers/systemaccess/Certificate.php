<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class Certificate extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->my_admin();
        $this->load->model('admin/program/ProgramModleAdmin', 'ProgramModleAdmin');
         $this->load->model('admin/student/StudentModleAdmin', 'StudentModleAdmin');
         $this->load->model('admin/studentmarks/StudentmarksModleAdmin', 'StudentmarksModleAdmin');

    }

     public function index() {

        $data['result']='active';

        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu',$data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu'); // top bar menu
        $this->load->view('system_path/admin/certificate/certificate',$data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
    }
    
     public function genrtStudentcertificate() {
        $data = $this->input->post('data', TRUE); 
       
    //    $data['programOfferId'] = $this->StudentModleAdmin->getprogrammoffer($data);
       $data['programoffer_info'] = $this->ProgramModleAdmin->getProgramOfferIdBySessionStudent($data);
        $data['programOfferId']=$data['programoffer_info']['programOfferId'];
       // print_r($data['programOfferId']); die();
        if (!empty($data)) {
            
             $data['markslist'] = $this->StudentmarksModleAdmin->getmarksByStudentTranscriptView($data);

            // get programoofferid from programmoffer table by session & then match student programofferid from promotedstudent table 
       //     $data['dataprogramOfferId'] = $this->ProgramModleAdmin->getProgramOfferIdBySessionStudent($data);
             
            if (!empty($data['programoffer_info'])) {
                $data['certificatedata'] = $this->StudentmarksModleAdmin->getmarksByStudent($data);
                $data['certificatedatebydate'] = $this->StudentmarksModleAdmin->getmarksByStudentt($data);
                
                    
                if (!empty($data['certificatedata']) && !empty($data['studentId']) && !empty($data['semesterId'])) {
                    $data['studentinfo'] = $this->StudentModleAdmin->getstudentPersonal_Info($data['studentId']);
                    
                   // print_r($data['markslist']); die();
                    
                      $data['studentlist'] = $this->StudentModleAdmin->getstudentNameInfo($data['studentId']);
                      $data['programinfo'] = $this->ProgramModleAdmin->getofferProgramInfoById($data['programOfferId']);
                   
                    $data['result'] = 'active';
                    $this->load->view('system_path/admin/common/header_link'); // header Css link
                    $this->load->view('system_path/admin/common/header'); // body header
                    $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                    $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                    $this->load->view('system_path/admin/certificate/generatecertificate', $data); // ...........body content page...........
                    $this->load->view('system_path/admin/common/footer'); // footer & script link
                    $this->load->view('system_path/jsquery'); // footer & script link
                } elseif (empty($data['markslist'])) {
                    $sdata['errormessage'] = "No Result Found";
                    $this->session->set_userdata($sdata);
                    redirect(admin_Url() . "/Certificate", "refresh");
                } else {
                    $sdata = array();
                    $sdata['errormessage'] = "Select both StudentId & Semester";
                    $this->session->set_userdata($sdata);
                    redirect(admin_Url() . "/Certificate", "refresh");
                }
            } else {
                $sdata['errormessage'] = "No Result Found";
                $this->session->set_userdata($sdata);
                redirect(admin_Url() . "/Certificate", "refresh");
            }
        } else {
            $sdata['errormessage'] = "Fill Up all field";
            $this->session->set_userdata($sdata);
            redirect(admin_Url() . "/Certificate", "refresh");
        }
    }
    
    
      public function transfercertificate() {

        $data['result']='active';

        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu',$data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu'); // top bar menu
        $this->load->view('system_path/admin/certificate/transfrcertificate',$data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
    }
    
    
         public function genrttransfercertificate() {
        $data = $this->input->post('data', TRUE); 
       
      //  print_r($data); die();
    //    $data['programOfferId'] = $this->StudentModleAdmin->getprogrammoffer($data);
       $data['programoffer_info'] = $this->ProgramModleAdmin->getProgramOfferIdBySessionStudent($data);
        $data['programOfferId']=$data['programoffer_info']['programOfferId'];
       // print_r($data['programOfferId']); die();
        if (!empty($data)) {
            
             $data['markslist'] = $this->StudentmarksModleAdmin->getmarksByStudentTranscriptView($data);

            // get programoofferid from programmoffer table by session & then match student programofferid from promotedstudent table 
       //     $data['dataprogramOfferId'] = $this->ProgramModleAdmin->getProgramOfferIdBySessionStudent($data);
             
            if (!empty($data['programoffer_info'])) {
                $data['certificatedata'] = $this->StudentmarksModleAdmin->getmarksByStudent($data);
                $data['certificatedatebydate'] = $this->StudentmarksModleAdmin->getmarksByStudentt($data);
                
                    
                if (!empty($data['certificatedata']) && !empty($data['studentId']) && !empty($data['semesterId'])) {
                    $data['studentinfo'] = $this->StudentModleAdmin->getstudentPersonal_Info($data['studentId']);
                    
                //  print_r($data['studentinfo']); die();
                    
                      $data['studentlist'] = $this->StudentModleAdmin->getstudentNameInfo($data['studentId']);
                      $data['programinfo'] = $this->ProgramModleAdmin->getofferProgramInfoById($data['programOfferId']);
                   
                    $data['result'] = 'active';
                    $this->load->view('system_path/admin/common/header_link'); // header Css link
                    $this->load->view('system_path/admin/common/header'); // body header
                    $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                    $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                    $this->load->view('system_path/admin/certificate/gen_transfrcertificate', $data); // ...........body content page...........
                    $this->load->view('system_path/admin/common/footer'); // footer & script link
                    $this->load->view('system_path/jsquery'); // footer & script link
                } elseif (empty($data['markslist'])) {
                    $sdata['errormessage'] = "No Result Found";
                    $this->session->set_userdata($sdata);
                    redirect(admin_Url() . "/Certificate/transfercertificate", "refresh");
                } else {
                    $sdata = array();
                    $sdata['errormessage'] = "Select both StudentId & Semester";
                    $this->session->set_userdata($sdata);
                    redirect(admin_Url() . "/Certificate/transfercertificate", "refresh");
                }
            } else {
                $sdata['errormessage'] = "No Result Found";
                $this->session->set_userdata($sdata);
                redirect(admin_Url() . "/Certificate/transfercertificate", "refresh");
            }
        } else {
            $sdata['errormessage'] = "Fill Up all field";
            $this->session->set_userdata($sdata);
            redirect(admin_Url() . "/Certificate/transfercertificate", "refresh");
        }
    }
    
    
    
}