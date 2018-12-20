<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */

class Programlevel extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->teacher_logged_auth();
        $this->load->model('admin/classlevel/ClasslevelModleAdmin', 'ClasslevelModleAdmin');
    }

   public function index() {
        $data['setting']='active';
        $data['programlevel']='active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu',$data); // side bar menu
        $this->load->view('system_path/admin/common/top_menu'); // top bar menu
        $this->load->view('system_path/admin/programlevel/index'); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
    }

    public function insertclasslevel() {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
            array(
                'field' => 'data[classlevelName]',
                'label' => 'classlevelName',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
//                    redirect(base_url('admin/campus'));
            $this->load->view('templates/admin/common/header');
            $this->load->view('templates/admin/classlevel/index');
            $this->load->view('templates/admin/common/footer');
        } else {
            $data = $this->input->post('data', TRUE);
            $result = $this->ClasslevelModleAdmin->duplicateClasslevelInfo($data);

            if (!$result) {
                $this->ClasslevelModleAdmin->addClasslevelInfo($data);

                $sdata['message'] = 'Successfull!';
                $this->session->set_userdata($sdata);

                redirect('admin/classlevel/Classlevellist', 'refresh');
            } else {
                $sdata['message'] = 'Duplicate Entry Found!';
                $this->session->set_userdata($sdata);

                redirect('admin/classlevel/Classlevellist', 'refresh');
            }
        }
    }

    public function Classlevellist() {

        $data['classlevellist'] = $this->ClasslevelModleAdmin->getClasslevelInfo();

        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/classlevel/classlevellist', $data);
        $this->load->view('templates/admin/common/footer');
    }

    public function editclasslevel($id) {

        $this->load->view('templates/admin/common/header');
        $data['editData'] = $this->ClasslevelModleAdmin->editClasslevelInfo($id);

        $this->load->view('templates/admin/classlevel/editclasslevel', $data);
        $this->load->view('templates/admin/common/footer');
    }

    public function updateclasslevel($id) {
//        print_r($_POST); 
       
            $data = $this->input->post('data', TRUE);
            $result = $this->ClasslevelModleAdmin->duplicateClasslevelInfo($data);

            if (!$result) {
                $this->ClasslevelModleAdmin->updateClasslevelInfo($data, $id);
                redirect('admin/classlevel/Classlevellist', 'refresh');
            } else {
                $sdata['message'] = 'Duplicate Entry Found!';
                $this->session->set_userdata($sdata);

                redirect('admin/classlevel/Classlevellist', 'refresh');
            }
        
    }

    public function deleteclasslevel($id) {

        $this->ClasslevelModleAdmin->deleteClasslevelInfo($id);
        $this->index();
    }

}