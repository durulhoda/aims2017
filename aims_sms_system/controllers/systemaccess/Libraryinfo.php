<?php

/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class Libraryinfo extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
       //$this->my_admin();
        $this->load->model('admin/bookself/BookselfModleAdmin', 'BookselfModleAdmin');
    }
    
    
    public function index() {
        
        echo  $this->load->view();
        
    }
    public function bookselfinfo(){
        
                $data['librarayinfo'] = 'active';
                $data['bookself']='active';
                $data['bookselflist'] = $this->BookselfModleAdmin->getBookselfInfo();
                $this->load->view('system_path/admin/common/header_link'); // header Css link
                $this->load->view('system_path/admin/common/header'); // body header
                $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
                $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                $this->load->view('system_path/admin/library/bookself',$data); // ...........body content page...........
                $this->load->view('system_path/admin/common/footer'); // footer & script link
    }
    
      public function insertbookself() {
        //  print_r($_POST);

        
            $data = $this->input->post('data', TRUE);
            $result = $this->BookselfModleAdmin->duplicateBookselfInfo($data);

            if (!$result) {
                $this->BookselfModleAdmin->addBookselfInfo($data);

                $sdata['message'] = 'Successfull Added!';
                $this->session->set_userdata($sdata);
                redirect(admin_Url() . "/libraryinfo/bookselfinfo");
            
            } else {
                $sdata['errormessage'] = 'Duplicate Entry Found!';
                $this->session->set_userdata($sdata);

               redirect(admin_Url() . "/libraryinfo/bookselfinfo");
            }
        
    }
    
       public function editbookself($id) {

//        echo $id; exit;
        
                $data['librarayinfo'] = 'active';
                $data['bookself']='active';
                $data['editData'] = $this->BookselfModleAdmin->editBookselfInfo($id);
                $this->load->view('system_path/admin/common/header_link'); // header Css link
                $this->load->view('system_path/admin/common/header'); // body header
                $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
                $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                $this->load->view('system_path/admin/library/editbookself',$data); // ...........body content page...........
                $this->load->view('system_path/admin/common/footer'); // footer & script link
        
    }
    
        public function updatebookself($id) {


        $data = $this->input->post('data', TRUE);
        $result = $this->BookselfModleAdmin->duplicateBookselfInfo($data);
       
        if (!$result) {
            $this->BookselfModleAdmin->updateBookselfInfo($data, $id);
            $sdata['message'] = 'Updated!';
            $this->session->set_userdata($sdata);
            
            redirect(admin_Url() . "/libraryinfo/bookselfinfo");
        } else {
            $sdata['errormessage'] = 'Duplicate Entry Found!';
            $this->session->set_userdata($sdata);

            redirect(admin_Url() . "/libraryinfo/bookselfinfo");
        }
    }
    
        public function deletebookself($id) {

        $this->BookselfModleAdmin->deleteBookselfInfo($id);
        $sdata['message'] = 'Deleted!';
        $this->session->set_userdata($sdata);
        redirect(admin_Url() . "/libraryinfo/bookselfinfo");
    }

}
