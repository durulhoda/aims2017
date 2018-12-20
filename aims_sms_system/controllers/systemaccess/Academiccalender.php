<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */

class AcademicCalender extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->my_admin();
        $this->load->helper('text');
        $this->load->model('admin/academiccalender/AcademicCalenderModleAdmin', 'AcademicCalenderModleAdmin');
    }

    public function index() {
        $data['classroutine'] = 'active';
   
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/calender/index'); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
    }

    public function insertacademiccalender() {
//      echo $_POST; exit;
//         print_r($_POST);
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
            
            
            array(
                'field' => 'data[startdate]',
                'label' => 'Start Date',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[enddate]',
                'label' => 'End Date',
                'rules' => 'required'
            ),
             array(
                'field' => 'data[title]',
                'label' => 'End Date',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[description]',
                'label' => 'Event Name',
                'rules' => 'required'
            )
        );


        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
//                    redirect(base_url('admin/campus'));
            $data['classroutine'] = 'active';
           
                $this->load->view('system_path/admin/common/header_link'); // header Css link
                $this->load->view('system_path/admin/common/header'); // body header
                $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                $this->load->view('system_path/admin/calender/index'); // ...........body content page...........
                $this->load->view('system_path/admin/common/footer'); // footer & script link
                $this->load->view('system_path/jsquery'); // footer & script link
        } else {

            $data = $this->input->post('data', TRUE);

            $validation = $this->AcademicCalenderModleAdmin->academiccalendervalidation($data);
            
            if ($validation) {
                $sdata = array();
                $sdata['message'] = "Duplicate entry found..!";
                $this->session->set_userdata($sdata);
                $data['classroutine'] = 'active';
             
                    $this->load->view('system_path/admin/common/header_link'); // header Css link
                    $this->load->view('system_path/admin/common/header'); // body header
                    $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                    $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                    $this->load->view('system_path/admin/calender/index'); // ...........body content page...........
                    $this->load->view('system_path/admin/common/footer'); // footer & script link
                    $this->load->view('system_path/jsquery'); // footer & script link
            } else {

                $this->AcademicCalenderModleAdmin->addAcademiccalender($data);

                $sdata = array();
                $sdata['message'] = "Insert New routine Successfully!";
                $this->session->set_userdata($sdata);

                 redirect(admin_Url() . "/academiccalender");
            }
        }
    }
    
    
    
    
    ///////// NEW VERSION CREATE BY SUJON /////////////////////
    
    
     public function insertEvent() {

        $sl=$this->input->post('sl');
        $stardate=$this->input->post('startdate');
        $title=$this->input->post('title');
        $description=$this->input->post('description');
        $color=$this->input->post('color');
  
        
          if (!empty($sl)) {
                $chksrl = $sl;
               
                for ($i = 0; $i < count($chksrl); $i++) {
                 
                    $find_value=$sl[$i]-1;

                   $data['startdate'] = $stardate[$find_value];
                    $data['title'] = $title[$find_value];
                    $data['description'] = $description[$find_value];
                     $data['color'] = $color[$find_value];
                   
                    $results = $this->AcademicCalenderModleAdmin->duplicateeventInfo($data['startdate']);

                    if ($results == TRUE) {
                        $sdata = array();
                        $sdata['errormessage'] = "Event Already done";
                        $this->session->set_userdata($sdata);
                   redirect(admin_Url() . "/academiccalender/searchevent");
                    } elseif ($results == FALSE) {
                     //   print_r($data);
                     $this->AcademicCalenderModleAdmin->addAcademiccalender($data);
                  }
                }
             // die();
                $sdata['message'] = 'Event Successfull inserted';
                $this->session->set_userdata($sdata);

           redirect(admin_Url() . "/academiccalender/searchevent");
        } else {
            $sdata['errormessage'] = 'Information not found';
            $this->session->set_userdata($sdata);

           redirect(admin_Url() . "/academiccalender/searchevent");
        }
            
      
        
}
    
        public function searchevent() {
        $data['classroutine'] = 'active';
       
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/calender/fullcalender'); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
    }
    
      public function showmonthlyevent($date) {

       
        $data['eventlist']= $this->AcademicCalenderModleAdmin->showmonthlyevent();
        
        $data['date']=$date;
        $data['classroutine'] = 'active';

        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/calender/fullcalender'); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
    }
    
          public function addshowmonthlyevent($date) {

       
        $data['eventlist']= $this->AcademicCalenderModleAdmin->showmonthlyevent();
        
        $data['date']=$date;
        $data['classroutine'] = 'active';

        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/calender/index'); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
    }
    ///////// OLD VERSION /////////////////////
    
//        public function searchevent() {
//        $data['classroutine'] = 'active';
//       
//        $this->load->view('system_path/admin/common/header_link'); // header Css link
//        $this->load->view('system_path/admin/common/header'); // body header
//        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
//        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
//        $this->load->view('system_path/admin/calender/searchevent'); // ...........body content page...........
//        $this->load->view('system_path/admin/common/footer'); // footer & script link
//        $this->load->view('system_path/jsquery'); // footer & script link
//    }
    
        public function searcheventlist() {
            
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
            array(
                'field' => 'data[tomonth]',
                'label' => 'Month',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[toyear]',
                'label' => 'Year',
                'rules' => 'required'
            ),
             array(
                'field' => 'data[frmmonth]',
                'label' => 'Month',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[frmyear]',
                'label' => 'Year',
                'rules' => 'required'
            )
            );
            $this->form_validation->set_rules($config);
            
           if ($this->form_validation->run() == FALSE) {
//                    redirect(base_url('admin/campus'));
            $data['classroutine'] = 'active';
           
                $this->load->view('system_path/admin/common/header_link'); // header Css link
                $this->load->view('system_path/admin/common/header'); // body header
                $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                $this->load->view('system_path/admin/calender/searchevent'); // ...........body content page...........
                $this->load->view('system_path/admin/common/footer'); // footer & script link
                $this->load->view('system_path/jsquery'); // footer & script link
        } else {
            
            $data = $this->input->post('data', TRUE);
            $month= $data['tomonth'];
            $year= $data['toyear'];
            
            $frmmonth= $data['frmmonth'];
            $frmyear= $data['frmyear'];
            
            $startdate= "01"."-"."$month"."-"."$year";
            
            $enddate= "31"."-"."$frmmonth"."-"."$frmyear";
            
          //  print_r($data); die();
        //  print_r($enddate); die();
            $data['eventlist'] = $this->AcademicCalenderModleAdmin->getevent($startdate, $enddate);
           
            //print_r($data['eventlist']); die();
            if (!empty($data['eventlist']) && !empty($startdate) && !empty($enddate)) {
                
                $data['classroutine'] = 'active';
                $this->load->view('system_path/admin/common/header_link'); // header Css link
                $this->load->view('system_path/admin/common/header'); // body header
                $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                $this->load->view('system_path/admin/calender/viewevent'); // ...........body content page...........
                $this->load->view('system_path/admin/common/footer'); // footer & script link
                $this->load->view('system_path/jsquery'); // footer & script link
            }
            else{
                
                 $sdata['message'] = 'Data Not Found';
                        $this->session->set_userdata($sdata);
                        redirect(admin_Url() . "/academiccalender/searchevent");
            }
            
            } 
            
            
               
    }
    
        public function viewevent($id) {
        if ($id != Null) {
            $data['editData'] = $this->AcademicCalenderModleAdmin->editeventinformation($id);
            if (!empty($data['editData'])) {
             
                $data['classroutine'] = 'active';
                $this->load->view('system_path/admin/common/header_link'); // header Css link
                $this->load->view('system_path/admin/common/header'); // body header
                $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
                $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                $this->load->view('system_path/admin/calender/viewcalender'); // ...........body content page...........
                $this->load->view('system_path/admin/common/footer'); // footer & script link
            } else {
                $sdata['errormessage'] = 'Data Not Found';
                $this->session->set_userdata($sdata);

              redirect(admin_Url() . "/academiccalender/searchevent");
            }
        } else {
            $sdata['errormessage'] = 'Data Not Found';
            $this->session->set_userdata($sdata);

           redirect(admin_Url() . "/academiccalender/searchevent");
        }
    }


    public function editevent($Id) {
        $data['editData'] = $this->AcademicCalenderModleAdmin->editeventinformation($Id);
     
        //     print_r($data); die();
        if (!empty($data['editData'])) {
             $data['classroutine'] = 'active';
            $this->load->view('system_path/admin/common/header_link'); // header Css link
            $this->load->view('system_path/admin/common/header'); // body header
            $this->load->view('system_path/admin/common/side_menu'); // side bar menu
            $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
            $this->load->view('system_path/admin/calender/editcalender', $data); // ...........body content page...........
            $this->load->view('system_path/admin/common/footer'); // footer & script link
        } else {
       //     echo "DIEEEE"; die();
             $sdata['errormessage'] = 'Invalid Student Id...Please try again';
             $this->session->set_userdata($sdata);
           // $this->searchapplicant();
    redirect(admin_Url() . "/academiccalender/searchevent");
        }
    } 

        public function updateevent($Id) {

        $data = $this->input->post('data', TRUE);

        $data['editData'] = $this->AcademicCalenderModleAdmin->updateevent($data, $Id);
        if ($data['editData']) {
            $sdata = array();
            $sdata['message'] = 'Updated Successfully !';
            $this->session->set_userdata($sdata);
        } else {
            $sdata['message'] = 'Not Updated !';
            $this->session->set_userdata($sdata);
        }

        redirect(admin_Url() . "/academiccalender/searchevent");
    }
    
        public function deleteevent($id) {
        $id = (int) $id;
        $this->AcademicCalenderModleAdmin->deleteevent($id);
        $sdata['message'] = 'Event Deleted';
        $this->session->set_userdata($sdata);
         redirect(admin_Url() . "/academiccalender/searchevent");
       
    }

}