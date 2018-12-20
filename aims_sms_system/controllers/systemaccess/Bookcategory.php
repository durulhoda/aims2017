<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class Bookcategory extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->my_admin();
        
        $this->load->model('admin/bookcategory/BookcategoryModleAdmin', 'BookcategoryModleAdmin');
    } 

    public function index() {
        $this->load->helper(array('form', 'url'));
        $data['bookcat'] = 'active';
        $data['librarayinfo'] = 'active';
        $data['bookcategorylist'] = $this->BookcategoryModleAdmin->getBookcategorylist();
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/library/book_category', $data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
    }

    public function insertbookcategory() {
        //  print_r($_POST);

        
            $data = $this->input->post('data', TRUE);
            $result = $this->BookcategoryModleAdmin->duplicateBookcategory($data);

            if (!$result) {
                $this->BookcategoryModleAdmin->addBookcategory($data);

                $sdata['message'] = 'Successfull Inserted!';
                $this->session->set_userdata($sdata);

                redirect(admin_Url() . "/Bookcategory");
            } else {
                $sdata['errormessage'] = 'Duplicate Entry Found!';
                $this->session->set_userdata($sdata);

                redirect(admin_Url() . "/Bookcategory");
            }
        
    }

    public function bookcategorylist() {


        $data['bookcategorylist'] = $this->BookcategoryModleAdmin->getBookcategorylist();
        $data['bookcat'] = 'active';
        $data['librarayinfo'] = 'active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/library/book_category', $data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
    }

    public function editbookcategory($id) {
       


        $data['editData'] = $this->BookcategoryModleAdmin->editbookcategory($id);
        $data['bookcat'] = 'active';
        $data['librarayinfo'] = 'active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/library/editbook_category', $data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
    }

    public function updatebookcategory($id) {

  
            $data = $this->input->post('data', TRUE);
            $result = $this->BookcategoryModleAdmin->duplicateBookcategory($data);

            if (!$result) {
                $this->BookcategoryModleAdmin->updatebookcategory($data, $id);
                
                $sdata['message'] = 'Updated!';
                $this->session->set_userdata($sdata);
                
                redirect(admin_Url() . "/Bookcategory");
            } else {
                $sdata['errormessage'] = 'Duplicate Entry Found!';
                $this->session->set_userdata($sdata);

                redirect(admin_Url() . "/Bookcategory");
            }
        
    }

    public function deletebookcategory($id) {

        $this->BookcategoryModleAdmin->deletebookcategory($id);
        $sdata['message'] = 'Deleted!';
                $this->session->set_userdata($sdata);
        redirect(admin_Url() . "/Bookcategory");
    }

}
