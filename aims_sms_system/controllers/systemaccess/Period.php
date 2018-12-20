<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */

class Period extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->my_admin();
        $this->load->model('admin/period/PeriodModleAdmin', 'PeriodModleAdmin');
    }

    public function index() {
        $data['setting']='active';
        $data['period']='active';
        $data['periodlist'] = $this->PeriodModleAdmin->getlistPeriod();
        $data['sessions'] = $this->db->get('session')->result();
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu',$data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu'); // top bar menu
        $this->load->view('system_path/admin/period/index', $data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
    }
    
    public function insertperiod() {
      //  echo '<pre>'; print_r($_POST);exit;
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');


        $config = array(
            array(
                'field' => 'data[shiftId]',
                'label' => 'Shift',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[periodName]',
                'label' => 'Period Name',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[periodTime]',
                'label' => 'Period Time',
                'rules' => 'required'
            )
            ,
            array(
                'field' => 'data[sessionId]',
                'label' => 'Session Name',
                'rules' => 'required'
            )
            ,
            array(
                'field' => 'data[ordering]',
                'label' => 'Ordering',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);


        if ($this->form_validation->run() == FALSE) {
//                    redirect(base_url('admin/campus'));
        $data['setting']='active';
        $data['period']='active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu',$data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu'); // top bar menu
        $this->load->view('system_path/admin/period/index'); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        } else {
            $data = $this->input->post('data', TRUE);
            $result = $this->PeriodModleAdmin->duplicatePeriodInfo($data);

            if (!$result) {
                $this->PeriodModleAdmin->addPeriodInfo($data);

                $sdata['message'] = 'Successfull!';
                $this->session->set_userdata($sdata);

                redirect(admin_Url() . "/period/index", "refresh");
            } else {
                $sdata['message'] = 'Duplicate Entry Found!';
                $this->session->set_userdata($sdata);

               redirect(admin_Url() . "/period/index", "refresh");
            }
        }
    }

   
    public function editdperiod($id) {
       
        $data['periodlist'] = $this->PeriodModleAdmin->getlistPeriod();
        $data['editData'] = $this->PeriodModleAdmin->editPeriodInfo($id);
        $data['sessions'] = $this->db->get('session')->result();
        if (!empty($data['editData'])){
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu',$data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu'); // top bar menu
        $this->load->view('system_path/admin/period/editperiod', $data);
        $this->load->view('system_path/admin/common/footer'); // footer & script link
    }
    }

    public function updateperiod($id) {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

//        print_r($_POST);
        $config = array(
             array(
                'field' => 'data[shiftId]',
                'label' => 'Shift',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[periodName]',
                'label' => 'Period Name',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[periodTime]',
                'label' => 'Period Time',
                'rules' => 'required'
            )
            ,
            array(
                'field' => 'data[ordering]',
                'label' => 'Ordering',
                'rules' => 'required'
            )
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
//                    redirect(base_url('admin/group'));
            $data['editData'] = $this->PeriodModleAdmin->editPeriodInfo($id);
            $data['periodlist'] = $this->PeriodModleAdmin->getlistPeriod();
              $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu',$data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu'); // top bar menu
        $this->load->view('system_path/admin/period/editperiod', $data);
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        } else {
            $data = $this->input->post('data', TRUE);
            $result = $this->PeriodModleAdmin->duplicatePeriodInfo($data);

            if (!$result) {
                $this->PeriodModleAdmin->updatePeriodInfo($data, $id);
                $sdata['message'] = 'Successfull!';
                $this->session->set_userdata($sdata);
                redirect(admin_Url() . "/period/index", "refresh");
            } else {
                $sdata['message'] = 'Duplicate Entry Found!';
                $this->session->set_userdata($sdata);

               redirect(admin_Url() . "/period/index", "refresh");
            }
        }
    }
    
        public function deleteperiod($id) { 
            $id = (int) $id;
            $data['delete_config'] = $this->PeriodModleAdmin->checkPeriodInfo($id);
           // print_r($data); die();
            if(!empty($data['delete_config'])){
            $sdata['errormessage'] = 'Time Period Information Not Deleted..! Because Already Use This Anothor Portion..! So Please Contact your Software Administrator..';
            $this->session->set_userdata($sdata);
          
          redirect(admin_Url()."/period"); 
            }
            else
                {
            $this->PeriodModleAdmin->deletePeriodInfo($id);
            $sdata['message'] = 'Time Period information deleted';
            $this->session->set_userdata($sdata);
           redirect(admin_Url()."/period");   
       }
    
   }

    //put your code here
}

