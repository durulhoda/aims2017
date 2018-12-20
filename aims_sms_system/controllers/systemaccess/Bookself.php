<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class Bookself extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->my_admin();
        $this->load->model('admin/bookself/BookselfModleAdmin', 'BookselfModleAdmin');
    } 

    public function index() {
        $this->load->helper(array('form', 'url'));
        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/bookself/index');
        $this->load->view('templates/admin/common/footer');
    }

    public function insertbookself() {
        //  print_r($_POST);

        
            $data = $this->input->post('data', TRUE);
            $result = $this->BookselfModleAdmin->duplicateBookselfInfo($data);

            if (!$result) {
                $this->BookselfModleAdmin->addBookselfInfo($data);

                $sdata['message'] = 'Successfull!';
                $this->session->set_userdata($sdata);

                redirect('admin/bookself', 'refresh');
            } else {
                $sdata['message'] = 'Duplicate Entry Found!';
                $this->session->set_userdata($sdata);

                redirect('admin/bookself', 'refresh');
            }
        
    }

    public function bookselflist() {


        $data['bookselflist'] = $this->BookselfModleAdmin->getBookselfInfo();


        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/bookself/bookselflist', $data);
        $this->load->view('templates/admin/common/footer');
    }

    public function editbookself($id) {
       
//        echo $id; exit;
        $this->load->view('templates/admin/common/header');

        $data['editData'] = $this->BookselfModleAdmin->editBookselfInfo($id);
//        print_r($data); exit;
        $this->load->view('templates/admin/bookself/editbookself', $data);
        $this->load->view('templates/admin/common/footer');
    }

    public function updatebookself($id) {

  
            $data = $this->input->post('data', TRUE);
            $result = $this->BookselfModleAdmin->duplicateBookselfInfo($data);

            if (!$result) {
                $this->BookselfModleAdmin->updateBookselfInfo($data, $id);
                redirect('admin/bookself/bookselflist', 'refresh');
            } else {
                $sdata['message'] = 'Duplicate Entry Found!';
                $this->session->set_userdata($sdata);

                redirect('admin/bookself/bookselflist', 'refresh');
            }
        
    }

    public function deletebookself($id) {

        $this->BookselfModleAdmin->deleteBookselfInfo($id);
        $sdata['message'] = 'Deleted!';
                $this->session->set_userdata($sdata);
        redirect('admin/bookself/bookselflist', 'refresh');
    }

}
