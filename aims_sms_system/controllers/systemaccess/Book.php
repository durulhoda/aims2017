<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class Book extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->my_admin();
        $this->load->model('admin/book/BookModleAdmin', 'BookModleAdmin');
    } 

    public function index() {
        $this->load->helper(array('form', 'url'));
        
        $data['librarayinfo'] = 'active';
        $data['bookrecord']='active';
        $data['bookrecinfo']='active';
        
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu' ,$data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/library/insertBookInfo', $data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
    }

    public function insertbook() {
        //  print_r($_POST);

        
            $data = $this->input->post('data', TRUE);
            $result = $this->BookModleAdmin->duplicateBook($data);

            if (!$result) {
                $this->BookModleAdmin->addBook($data);

                $sdata['message'] = 'Successfully Inserted!';
                $this->session->set_userdata($sdata);

                redirect(admin_Url() . "/book");
            } else {
                $sdata['errormessage'] = 'Duplicate Entry Found!';
                $this->session->set_userdata($sdata);

                redirect(admin_Url() . "/book");
            }
        
    }

    public function booklist() {

        $data['librarayinfo'] = 'active';
        $data['bookrecord']='active';
        $data['allbookrecinfo']='active';
 
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/library/booklistSearch', $data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
    }
    public function allbooklist() {

        $data = $this->input->post('data', TRUE);
        $data['booklist'] = $this->BookModleAdmin->getBooklist($data);
        
        if(!empty($data['booklist'] ))
           
            
        {
        $data['librarayinfo'] = 'active';
        $data['bookrecord'] = 'active';
        $data['allbookrecinfo'] = 'active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/library/booklistSearch', $data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        }
        else{
            $sdata['errormessage'] = 'No Book found in your searching value...';
                $this->session->set_userdata($sdata);
                redirect(admin_Url() . "/book");
        }
    }

    public function editbook($id) {
       

      
        $data['librarayinfo'] = 'active';
        $data['bookrecord'] = 'active';
        $data['allbookrecinfo'] = 'active';
        $data['editData'] = $this->BookModleAdmin->editbook($id);
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/library/editbooklist', $data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
    }

    public function updatebook($id) {

  
            $data = $this->input->post('data', TRUE);
            $result = $this->BookModleAdmin->duplicateBook($data);

            if (!$result) {
                $this->BookModleAdmin->updatebook($data, $id);
                 $sdata['message'] = 'Update Successfull!';
                $this->session->set_userdata($sdata);
                redirect(admin_Url() . "/book/booklist");
            } else {
                $sdata['errormessage'] = 'Duplicate Entry Found!';
                $this->session->set_userdata($sdata);

                redirect(admin_Url() . "/book/booklist");
            }
        
    }

    public function deletebook($id) {

        $this->BookModleAdmin->deletebook($id);
        $sdata['message'] = 'Deleted!';
                $this->session->set_userdata($sdata);
        redirect(admin_Url() . "/book/booklist");
    }

}
