<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */


class Empsearch extends MY_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->my_admin();
         $this->load->model('admin/empsearch/EmpsearchModleAdmin', 'EmpsearchModleAdmin');
    //put your code here
}
    public function index(){
         $this->load->library('form_validation');
         $this->load->view('templates/admin/common/header');
         $this->load->view('templates/admin/empsearch/index');
         $this->load->view('templates/admin/common/footer');

    }
    public function employeesearch(){
        
        $data = $this->input->post('data', TRUE);
        $data['employeelist'] = $this->EmpsearchModleAdmin->getemployee($data);
 //     print_r($data['employeelist']);die();
        if (isset($_POST['search'])) 
        {  
          $this->load->view('templates/admin/common/header');
          $this->load->view('templates/admin/empsearch/employeelist', $data);
          $this->load->view('templates/admin/common/footer');
        }
        elseif (isset($_POST['print'])) 
        {
            $this->load->view('templates/admin/common/header');
            $this->load->view('templates/admin/empsearch/printemployeelist', $data );  

            $this->load->view('templates/admin/common/footer');
        }
        else{
            $sdata['message'] = 'Data Not Found';
            $this->session->set_userdata($sdata);
            $this->load->view('templates/admin/common/header');
            $this->load->view('templates/admin/empsearch/index');
            $this->load->view('templates/admin/common/footer');
        }
        
    
    }
    
}