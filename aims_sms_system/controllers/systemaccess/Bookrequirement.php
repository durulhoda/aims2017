<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class BookRequirement extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->my_admin();
        $this->load->model('admin/bookrequirement/BookrequirementModleAdmin', 'BookrequirementModleAdmin');
    } 

    public function index() {
        $data['librarayinfo'] = 'active';
        $data['bookrequirement'] = 'active';
        $data['bookrequirementinfo'] = 'active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/library/bookrequrementinsert', $data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
    }

    public function insertbookrequirement() {
        //  print_r($_POST);

        
            $data = $this->input->post('data', TRUE);
            $result = $this->BookrequirementModleAdmin->duplicateBookrequirement($data);

            if (!$result) {
                $this->BookrequirementModleAdmin->addBookrequirement($data);

                $sdata['message'] = 'Successfull!';
                $this->session->set_userdata($sdata);

                redirect(admin_Url() . "/bookRequirement");
            } else {
                $sdata['errormessage'] = 'Duplicate Entry Found!';
                $this->session->set_userdata($sdata);

                redirect(admin_Url()."/bookRequirement");
            }
        
    }

    public function bookrequirementlist() {
        
        $data['bookrequirementlist'] = $this->BookrequirementModleAdmin->getBookrequirementlist();
        $data['librarayinfo'] = 'active';
        $data['bookrequirement'] = 'active';
        $data['allbookrequirement'] = 'active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/library/allbookrequrment', $data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
    }
    
    public function editbookrequirement($id) {
       
        $data['editData'] = $this->BookrequirementModleAdmin->editbookrequirement($id);
        
        $data['librarayinfo'] = 'active';
        $data['bookrequirement'] = 'active';
        $data['allbookrequirement'] = 'active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/library/editbookrequirement', $data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
    }

    public function updatebookrequirement($id) {

  
            $data = $this->input->post('data', TRUE);
            
            if($data['bookPiece']==1)
            {
                $result = $this->BookrequirementModleAdmin->duplicateBookrequirement($data);

                if (!$result) {
                    $this->BookrequirementModleAdmin->updatebookrequirement($data, $id);
                     $sdata['message'] = 'Update Successfull!';
                    $this->session->set_userdata($sdata);
                    redirect(admin_Url()."/bookRequirement");
                } else {
                    $sdata['errormessage'] = 'Duplicate Entry Found!';
                    $this->session->set_userdata($sdata);

                    redirect(admin_Url()."/bookRequirement");
                }
             }
            else{
                $this->BookrequirementModleAdmin->deletebookrequirement($id);
                $sdata['message'] = 'Book Requirement Fulfilled..';
                $this->session->set_userdata($sdata);
                redirect(admin_Url()."/bookRequirement");
            }
        
    }

    public function deletebookrequirement($id) {

        $this->BookrequirementModleAdmin->deletebookrequirement($id);
        $sdata['message'] = 'Deleted!';
                $this->session->set_userdata($sdata);
         redirect(admin_Url()."/bookRequirement");
    }

}
