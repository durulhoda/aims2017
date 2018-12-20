<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */

class Quata extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->my_admin();
        $this->load->model('admin/quata/QuataModleAdmin', 'QuataModleAdmin');
    }

    public function index() {
        $data['listdata'] = $this->QuataModleAdmin->getQuatalist();
        $data['setting']='active';
        $data['quata']='active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu',$data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu'); // top bar menu
        $this->load->view('system_path/admin/quata/index',$data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
    }

    public function insertQuata() {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $config = array(
            array(
                'field' => 'data[quata]',
                'label' => 'Quata',
                'rules' => 'required'
            )
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            $data['listdata'] = $this->QuataModleAdmin->getQuatalist();
            $data['setting']='active';
            $data['quata']='active';
            $this->load->view('system_path/admin/common/header_link'); // header Css link
            $this->load->view('system_path/admin/common/header'); // body header
            $this->load->view('system_path/admin/common/side_menu',$data); // side bar menu
            $this->load->view('system_path/admin/common/top_menu'); // top bar menu
            $this->load->view('system_path/admin/quata/index',$data); // ...........body content page...........
            $this->load->view('system_path/admin/common/footer'); // footer & script link
            
        } else {
            
            $data = $this->input->post('data', TRUE);
            $result=$this->QuataModleAdmin->duplicatequataInfo($data);
            
            if(!$result){
                $this->QuataModleAdmin->addquataInfo($data);

                $sdata['message'] = 'New quata added Successfully';
                $this->session->set_userdata($sdata);
                redirect(admin_Url() . "/quata/index", 'refresh');
               
            }
            else{
                $sdata['errormessage'] = 'Duplicate quata name Found!';
                $this->session->set_userdata($sdata);

                redirect(admin_Url() . "/quata/index", 'refresh');
            }            
        }
    }

    
     public function editquata($id){
    
        $id=(int)$id; 
        $data['editData'] = $this->QuataModleAdmin->editquata($id);
        if(!empty($data['editData']))
        {
            $data['setting'] = 'active';
            $data['quata'] = 'active';
            $this->load->view('system_path/admin/common/header_link'); // header Css link
            $this->load->view('system_path/admin/common/header'); // body header
            $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
            $this->load->view('system_path/admin/common/top_menu'); // top bar menu
            $this->load->view('system_path/admin/quata/editquata', $data); // ...........body content page...........
            $this->load->view('system_path/admin/common/footer'); // footer & script link
        }
        else{
            $sdata['errormessage'] = 'No quata information found';
            $this->session->set_userdata($sdata);
            redirect(admin_Url() . "/quata/index", 'refresh');
            
        }
                
    }
    public function updatequata($id){
    
            $data = $this->input->post('data', TRUE);
            $result = $this->QuataModleAdmin->duplicatequataInfo($data);

            if (!$result) {
            $this->QuataModleAdmin->updatequataInfo($data, $id);
            	$sdata['message'] = 'Successfull!';
                $this->session->set_userdata($sdata);

                redirect(admin_Url() . "/quata/index", 'refresh');
            } else {
                $sdata['errormessage'] = 'Duplicate quata name found!';
                $this->session->set_userdata($sdata);

                redirect(admin_Url() . "/quata/index", 'refresh');
            }
            
       
        
    }
    
        public function deletequata($id) { 
            $id = (int) $id;
            $data['delete_config'] = $this->QuataModleAdmin->checkQuataInfo($id);
           // print_r($data); die();
            if(!empty($data['delete_config'])){
            $sdata['errormessage'] = 'Quata Information Not Deleted..! Because Already Use This Anothor Portion..! So Please Contact your Software Administrator..';
            $this->session->set_userdata($sdata);
           redirect(admin_Url() . "/quata/index", 'refresh');
            }
            else
                {
            $this->QuataModleAdmin->deletequataInfo($id);
            $sdata['message'] = 'Quata information Deleted';
            $this->session->set_userdata($sdata);
            redirect(admin_Url() . "/quata/index", 'refresh');      
       }
    
   }

    //put your code here
}
