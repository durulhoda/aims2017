<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */

class Discipline extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->my_admin();
        $this->load->model('admin/discipline/DisciplineModleAdmin', 'DisciplineModleAdmin');
    }

    public function index() {
        $this->load->library('form_validation');

        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/discipline/index');
        $this->load->view('templates/admin/common/footer');
    }

    public function insertComments() {

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
            array(
                'field' => 'data[studentId]',
                'label' => 'Student Id',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[comments]',
                'label' => 'Add Comments',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
//                    redirect(base_url('admin/campus'));
            $this->load->view('templates/admin/common/header');
            $this->load->view('templates/admin/discipline/index');
            $this->load->view('templates/admin/common/footer');
        } else {
            $data = $this->input->post('data', TRUE);
            
                $this->DisciplineModleAdmin->addDisciplinecomments($data);
                        $sdata = array();
                        $sdata['redmessage'] = 'Report Added';
                        $this->session->set_userdata($sdata);
                redirect('admin/discipline/index', 'refresh');
            
        }
    }

    public function disciplinelist() {

        $data['disciplinelist'] = $this->DisciplineModleAdmin->getDisciplinecomments();
        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/discipline/index', $data);
        $this->load->view('templates/admin/common/footer');
    }

    public function editdiscipline($id) {
        $this->load->view('templates/admin/common/header');
        $data['editData'] = $this->DisciplineModleAdmin->editDisciplinecomments($id);
        $this->load->view('templates/admin/discipline/editdiscipline', $data);
        $this->load->view('templates/admin/common/footer');
    }

    public function updatediscipline($id) {

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
            array(
                'field' => 'data[studentId]',
                'label' => 'Student Id',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[comments]',
                'label' => 'Add Comments',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
//                    redirect(base_url('admin/campus'));
            $this->load->view('templates/admin/common/header');
            $data['editData'] = $this->DisciplineModleAdmin->editDisciplinecomments($id);
            $this->load->view('templates/admin/discipline/editdiscipline', $data);
            $this->load->view('templates/admin/common/footer');
        } else {
            $data = $this->input->post('data', TRUE);
            
                $this->DisciplineModleAdmin->updateDisciplinecomments($data, $id);
                        $sdata = array();
                        $sdata['redmessage'] = 'Report Updated';
                        $this->session->set_userdata($sdata);
                redirect('admin/discipline/disciplinelist', 'refresh');
           
//			 
        }
    }

    public function deletediscipline($id) {
       
        $this->DisciplineModleAdmin->deleteDisciplinecomments($id);
       redirect('admin/discipline/index', 'refresh');
    }

}

