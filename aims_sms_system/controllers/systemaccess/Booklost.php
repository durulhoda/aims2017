<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class BookLost extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->my_admin();
        $this->load->model('admin/booklost/BooklostModleAdmin', 'BooklostModleAdmin');
    }

    public function index() {
        $data['librarayinfo'] = 'active';
        $data['booklost'] = 'active';
        $data['booklostinfo'] = 'active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/library/booklost', $data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
    }

    public function insertbooklost() {
       
        $data = $this->input->post('data', TRUE);

        $this->BooklostModleAdmin->addBooklost($data);

        $sdata['message'] = 'Successfull!';
        $this->session->set_userdata($sdata);

        redirect(admin_Url()."/booklost");
    }

    public function booklostlist() {

        $data['booklostlist'] = $this->BooklostModleAdmin->getBooklost();
        $data['librarayinfo'] = 'active';
        $data['booklost'] = 'active';
        $data['allbooklost'] = 'active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/library/booklostlist', $data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
    }

    public function editbooklost($id) {



        $data['editData'] = $this->BooklostModleAdmin->editbooklost($id);
        $data['librarayinfo'] = 'active';
        $data['booklost'] = 'active';
        $data['allbooklost'] = 'active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/library/editbooklost', $data); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
    }

    public function updatebooklost($id) {
        $data = $this->input->post('data', TRUE);
        $this->BooklostModleAdmin->updatebooklost($data, $id);
        $sdata['message'] = 'Update Successfull!';
        $this->session->set_userdata($sdata);
         redirect(admin_Url()."/booklost/booklostlist");
    }

    public function deletebooklost($id) {

        $this->BooklostModleAdmin->deletebooklost($id);
        $sdata['message'] = 'Deleted!';
        $this->session->set_userdata($sdata);
        redirect(admin_Url()."/booklost/booklostlist");
    }

}
