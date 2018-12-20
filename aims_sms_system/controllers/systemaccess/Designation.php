<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */

class Designation extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->my_admin();
        $this->load->model('admin/designation/DesignationModleAdmin', 'DesignationModleAdmin');
    }

    public function index() {
        $data['listdata'] = $this->DesignationModleAdmin->getlistDesignation();
        $data['setting']='active';
        $data['emp_dsg']='active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu',$data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu'); // top bar menu
        $this->load->view('system_path/admin/designation/index',$data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
    }

    public function insertDesignation() {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $config = array(
            array(
                'field' => 'data[designation]',
                'label' => 'Designation Name',
                'rules' => 'required'
            )
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            $data['listdata'] = $this->DesignationModleAdmin->getlistDesignation();
            $data['setting']='active';
            $data['emp_dprt']='active';
            $this->load->view('system_path/admin/common/header_link'); // header Css link
            $this->load->view('system_path/admin/common/header'); // body header
            $this->load->view('system_path/admin/common/side_menu',$data); // side bar menu
            $this->load->view('system_path/admin/common/top_menu'); // top bar menu
            $this->load->view('system_path/admin/designation/index',$data); // ...........body content page...........
            $this->load->view('system_path/admin/common/footer'); // footer & script link
            
        } else {
            
            $data = $this->input->post('data', TRUE);
            $result=$this->DesignationModleAdmin->duplicateDesignationInfo($data);
            
            if(!$result){
                $this->DesignationModleAdmin->addDesignationInfo($data);

                $sdata['message'] = 'New position added Successfully';
                $this->session->set_userdata($sdata);
                redirect(admin_Url() . "/designation/index", 'refresh');
               
            }
            else{
                $sdata['errormessage'] = 'Duplicate position name Found!';
                $this->session->set_userdata($sdata);

                redirect(admin_Url() . "/designation/index", 'refresh');
            }            
        }
    }

    
     public function editddesignation($id){
    
        $id=(int)$id; 
        $data['editData'] = $this->DesignationModleAdmin->editdesignation($id);
        if(!empty($data['editData']))
        {
            $data['setting'] = 'active';
            $data['emp_dprt'] = 'active';
            $this->load->view('system_path/admin/common/header_link'); // header Css link
            $this->load->view('system_path/admin/common/header'); // body header
            $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
            $this->load->view('system_path/admin/common/top_menu'); // top bar menu
            $this->load->view('system_path/admin/designation/editdesignation', $data); // ...........body content page...........
            $this->load->view('system_path/admin/common/footer'); // footer & script link
        }
        else{
            $sdata['message'] = 'No position information found';
            $this->session->set_userdata($sdata);
            redirect(admin_Url() . "/designation/index", 'refresh');
            
        }
                
    }
    public function updatedesignation($id){
               $id = (int) $id;
              $data = $this->input->post('data', TRUE);
            //  print_r($data); die();
            if (!empty($data)) {
                $this->DesignationModleAdmin->updateDesignationInfo($data, $id);
            	$sdata['message'] = 'Successfull!';
                $this->session->set_userdata($sdata);

                redirect(admin_Url() . "/designation/index", 'refresh');
            } else {
                $sdata['errormessage'] = 'Information Not Updated!';
                $this->session->set_userdata($sdata);

                redirect(admin_Url() . "/designation/index", 'refresh');
            }
            
       
        
    }
    
    public function deletedesignation($id) {
        $id = (int) $id;
        $data['delete_config'] = $this->DesignationModleAdmin->checkDesignationInfo($id);
        // print_r($data); die();
        if (!empty($data['delete_config'])) {
            $sdata['errormessage'] = 'Employee Position Not Deleted..! Because Already Use This Anothor Portion..! So Please Contact your Software Administrator..';
            $this->session->set_userdata($sdata);
             redirect(admin_Url() . "/designation/index", 'refresh');
        } else {
            $this->DesignationModleAdmin->deleteDesignationInfo($id);
            $sdata['message'] = 'Employee Position Deleted';
            $this->session->set_userdata($sdata);
             redirect(admin_Url() . "/designation/index", 'refresh');
        }
    }
    

    //put your code here
}
