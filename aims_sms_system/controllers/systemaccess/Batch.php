<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class Batch extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->my_admin();
        $this->load->model('admin/batch/BatchModleAdmin', 'BatchModleAdmin');
    }

    public function index() {
        $this->load->helper(array('form', 'url'));
        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/batch/index');
        $this->load->view('templates/admin/common/footer');
    }

    public function insertbatch() {
//      echo $_POST; exit;
//         print_r($_POST);
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
            array(
                'field' => 'data[batchName]',
                'label' => 'batch',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[sessionId]',
                'label' => 'session',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
//                    redirect(base_url('admin/campus'));
            $this->load->view('templates/admin/common/header');
            $this->load->view('templates/admin/batch/index');
            $this->load->view('templates/admin/common/footer');
        } else {
            $data = $this->input->post('data', TRUE);
            $result = $this->BatchModleAdmin->duplicateSectionInfo($data);

            if (!$result) {
                $this->BatchModleAdmin->addBatchInfo($data);

                $sdata['message'] = 'Successfull!';
                $this->session->set_userdata($sdata);

                redirect('admin/batch', 'refresh');
            } else {
                $sdata['message'] = 'Duplicate Entry Found!';
                $this->session->set_userdata($sdata);

                redirect('admin/batch', 'refresh');
            }
        }
    }

    public function Batchlist() {

        $data['batchlist'] = $this->BatchModleAdmin->getBatchInfo();
        
        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/batch/batchlist', $data);
        $this->load->view('templates/admin/common/footer');
        
        
    }

    public function editbatch($id) {

        $this->load->view('templates/admin/common/header');
        $data['editData'] = $this->BatchModleAdmin->editBatchInfo($id);
        $data['classlevelId'] = (int) $id;

        $this->load->view('templates/admin/batch/editbatch', $data);
        $this->load->view('templates/admin/common/footer');
    }

    public function updatebatch($id) {
//        print_r($_POST); 
        $id = (int) $id;

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
            array(
                'field' => 'data[batchName]',
                'label' => 'batch',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[sessionId]',
                'label' => 'session',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
//                    redirect(base_url('admin/campus'));
            $this->load->view('templates/admin/common/header');
            $this->load->view('templates/admin/batch/index');
            $this->load->view('templates/admin/common/footer');
        } else {
            $data = $this->input->post('data', TRUE);
            $result = $this->BatchModleAdmin->duplicateSectionInfo($data);

            if (!$result) {
                $this->BatchModleAdmin->updateBatchInfo($data, $id);
                $sdata['message'] = 'Successfull!';
                $this->session->set_userdata($sdata);

                redirect('admin/batch', 'refresh');
            } else {
                $sdata['message'] = 'Duplicate Entry Found!';
                $this->session->set_userdata($sdata);

                redirect('admin/batch', 'refresh');
            }
        }
    }

    public function deletebatch($id) {
        
        $this->BatchModleAdmin->deleteBatchInfo($id);
        $this->index();
    }

}