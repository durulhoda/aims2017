<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class Bookborrow extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->my_admin();
        $this->load->model('admin/bookborrow/BookborrowModleAdmin', 'BookborrowModleAdmin');
    } 

    public function index() {
        $data['librarayinfo']='active';
        $data['borrowbook']='active';
        $data['borrowbookrec']='active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/library/bookborrow', $data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
    }

    public function insertborrowedbook() {
        //  print_r($_POST);

        
            $data = $this->input->post('data', TRUE);
            $result = $this->BookborrowModleAdmin->duplicateBorrowedbook($data);

            if (!$result) {
                $this->BookborrowModleAdmin->addBorrowedbook($data);

                $sdata['message'] = 'Successfull!';
                $this->session->set_userdata($sdata);

                redirect(admin_Url() . "/bookborrow");
            } else {
                $sdata['errormessage'] = 'This Student Already Borrowed This Book';
                $this->session->set_userdata($sdata);

                redirect(admin_Url() . "/bookborrow");
            }
        
    }

    public function bookborrowlist() {
        
        $data['librarayinfo'] = 'active';
        $data['borrowbook'] = 'active';
        $data['borrowedbook'] = 'active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/library/bookborrowsearch', $data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
    }
    public function allbookborrowlist() {

        $data = $this->input->post('data', TRUE);
        $data['bookborrowlist'] = $this->BookborrowModleAdmin->getBookborrowlist($data);
        
        if(!empty($data['bookborrowlist'] ))
        {
        $data['librarayinfo'] = 'active';
        $data['borrowbook'] = 'active';
        $data['borrowedbook'] = 'active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/library/bookborrowsearch', $data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        }
        else{
            $sdata['errormessage'] = 'No Book found in your searching perameter...';
                $this->session->set_userdata($sdata);
               redirect(admin_Url() . "/bookborrow/bookborrowlist");
        }
    }

    public function editborrowedbook($id) {
       


        $data['editData'] = $this->BookborrowModleAdmin->editborrowedbook($id);
        $data['librarayinfo'] = 'active';
        $data['borrowbook'] = 'active';
        $data['borrowedbook'] = 'active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/library/editbookborrow', $data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
    }

    public function updateborrowedbook($id) {

  
            $data = $this->input->post('data', TRUE);
            if($data['bookPiece']==1)
            {
                $result = $this->BookborrowModleAdmin->duplicateBorrowedbook($data);

                if (!$result) {
                    $this->BookborrowModleAdmin->updateBorrowedbook($data, $id);
                     $sdata['message'] = 'Update Successfull!';
                    $this->session->set_userdata($sdata);
                     redirect(admin_Url() . "/bookborrow/bookborrowlist");
                } else {
                    $sdata['errormessage'] = 'This Student Already Borrowed This Book';
                    $this->session->set_userdata($sdata);

                     redirect(admin_Url() . "/bookborrow/bookborrowlist");
                }
            }
            else{
                $this->BookborrowModleAdmin->deleteborrowedbook($id);
                $sdata['message'] = 'Book Return Confirmed..';
                $this->session->set_userdata($sdata);
                 redirect(admin_Url() . "/bookborrow/bookborrowlist");
            }
    }

    public function deleteborrowedbook($id) {

        $this->BookborrowModleAdmin->deleteborrowedbook($id);
         $sdata['message'] = 'Deleted!';
                $this->session->set_userdata($sdata);
        redirect(admin_Url() . "/bookborrow/bookborrowlist");
    }

}
