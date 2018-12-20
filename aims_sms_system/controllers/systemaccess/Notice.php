<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */


class Notice extends MY_Controller{
    
     public function __construct() {
        parent::__construct();
        $this->my_admin();
        $this->load->model('admin/notice/NoticeModleAdmin', 'NoticeModleAdmin');
        $this->load->model('content_model', 'co_model', TRUE);
    }
    
    public function index(){
       $this->load->library('form_validation');
         $data['datalist'] = $this->co_model->select_NoticeBoard();
         
        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/notice/index',$data);        
        $this->load->view('templates/admin/common/footer');
 
    }
    
     public function deletenotice($id) {
        $this->co_model->deletecontentmessage($id);
         $sdata['message'] = 'Duplicate Entry Found!';
                $this->session->set_userdata($sdata);

       redirect('admin/notice', 'refresh');
    }
        
   
    //put your code here
}


