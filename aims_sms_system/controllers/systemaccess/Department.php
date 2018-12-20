<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */

class Department extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->my_admin();
        $this->load->model('admin/department/DepartmentModleAdmin', 'DepartmentModleAdmin');
    }

    public function index() {
        $data['listdata'] = $this->DepartmentModleAdmin->getlistDepartment();
        $data['setting']='active';
        $data['emp_dprt']='active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu',$data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu'); // top bar menu
        $this->load->view('system_path/admin/department/index',$data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
    }

    public function insertDepartment() {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $config = array(
            array(
                'field' => 'data[departmentName]',
                'label' => 'Department Name',
                'rules' => 'required'
            )
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            $data['listdata'] = $this->DepartmentModleAdmin->getlistDepartment();
            $data['setting']='active';
            $data['emp_dprt']='active';
            $this->load->view('system_path/admin/common/header_link'); // header Css link
            $this->load->view('system_path/admin/common/header'); // body header
            $this->load->view('system_path/admin/common/side_menu',$data); // side bar menu
            $this->load->view('system_path/admin/common/top_menu'); // top bar menu
            $this->load->view('system_path/admin/department/index',$data); // ...........body content page...........
            $this->load->view('system_path/admin/common/footer'); // footer & script link
            
        } else {
            
            $data = $this->input->post('data', TRUE);
            $result=$this->DepartmentModleAdmin->duplicateDepartmentInfo($data);
            
            if(!$result){
                $this->DepartmentModleAdmin->addDepartmentInfo($data);

                $sdata['message'] = 'New Department added Successfully';
                $this->session->set_userdata($sdata);
                redirect(admin_Url()."/department");
               
            }
            else{
                $sdata['errormessage'] = 'Duplicate Department name Found!';
                $this->session->set_userdata($sdata);

                redirect(admin_Url()."/department");
            }            
        }
    }

    
     public function editdepartment($id){
    
        $id=(int)$id; 
     
        
        $data['editData'] = $this->DepartmentModleAdmin->editdepartment($id);
        $data['setting'] = 'active';
        $data['emp_dprt'] = 'active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu'); // top bar menu
        $this->load->view('system_path/admin/department/editdepartment', $data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
    }
    public function updatedepartment($id){
//         print_r($_POST);
    
            $data = $this->input->post('data', TRUE);
            $result = $this->DepartmentModleAdmin->duplicateDepartmentInfo($data);

            if (!$result) {
            $this->DepartmentModleAdmin->updateDepartmentInfo($data, $id);
            	$sdata['message'] = 'Successfull!';
            $this->session->set_userdata($sdata);

          redirect(admin_Url()."/department");
            } else {
                $sdata['errormessage'] = 'Duplicate Entry Found!';
                $this->session->set_userdata($sdata);

               redirect(admin_Url()."/department");
            }
            
       
        
    }
        public function deletedepartment($id) { 
            $id = (int) $id;
            $data['delete_config'] = $this->DepartmentModleAdmin->checkDepartmentInfo($id);
           // print_r($data); die();
            if(!empty($data['delete_config'])){
            $sdata['errormessage'] = 'Department Information Not Deleted..! Because Already Use This Anothor Portion..! So Please Contact your Software Administrator..';
            $this->session->set_userdata($sdata);
            redirect(admin_Url()."/department");
            }
            else
                {
            $this->DepartmentModleAdmin->deleteDepartmentInfo($id);
            $sdata['message'] = 'Department information deleted';
            $this->session->set_userdata($sdata);
             redirect(admin_Url()."/department");    
       }
    
   }

    //put your code here
}
