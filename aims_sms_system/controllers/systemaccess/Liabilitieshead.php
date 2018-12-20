<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */


class Liabilitieshead  extends MY_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->my_admin();
        $this->load->model('admin/liabilities/LiabilitiesModleAdmin', 'LiabilitiesModleAdmin');
    }
    
    public function index(){
         $this->load->library('form_validation');
         $data['headlist'] = $this->LiabilitiesModleAdmin->getLiabilitiesHeadCategoryList();
        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/liabilitieshead/index', $data);        
        $this->load->view('templates/admin/common/footer');

    }
    
     public function insertHeadcategory() {
        // print_r($_POST);
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');


        $config = array(
            array(
                'field' => 'data[headName]',
                'label' => 'Head category',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);


        if ($this->form_validation->run() == FALSE) {
//                    redirect(base_url('admin/campus'));
            $this->load->view('templates/admin/common/header');
            $this->load->view('templates/admin/liabilitieshead/index');
            $this->load->view('templates/admin/common/footer');
        } else {
            $data = $this->input->post('data', TRUE);
            $result = $this->LiabilitiesModleAdmin->duplicateHeadInfo($data);

            if (!$result) {
                $this->LiabilitiesModleAdmin->addHeadsetupInfo($data);

                $sdata['message'] = 'Successfull!';
                $this->session->set_userdata($sdata);

                redirect('admin/liabilitieshead/index', 'refresh');
            } else {
                $sdata['message'] = 'Duplicate Entry Found!';
                $this->session->set_userdata($sdata);

                 $this->load->view('templates/admin/common/header');
            $this->load->view('templates/admin/liabilitieshead/index');
            $this->load->view('templates/admin/common/footer');
            }
        }
    }

    
    public function editliabilitieshead($id) {

//        echo $id; exit;
        $this->load->view('templates/admin/common/header');

        $data['editData'] = $this->LiabilitiesModleAdmin->editliabilitieshead($id);
        $data['headlist'] = $this->LiabilitiesModleAdmin->getLiabilitiesHeadCategoryList();
//        print_r($data);
        $this->load->view('templates/admin/liabilitieshead/editliabilitieshead', $data);
        $this->load->view('templates/admin/common/footer');
    }

    public function updateliabilitieshead($id) {
       
            $data = $this->input->post('data', TRUE);
            $result = $this->LiabilitiesModleAdmin->duplicateHeadInfo($data);

            if (!$result) {
                $this->LiabilitiesModleAdmin->updateliabilitieshead($data, $id);
                $sdata['message'] = 'Successfull!';
                $this->session->set_userdata($sdata);

                redirect('admin/liabilitieshead/index', 'refresh');
            } else {
                $sdata['message'] = 'Duplicate Entry Found!';
                $this->session->set_userdata($sdata);

                $this->load->view('templates/admin/common/header');
                $data['editData'] = $this->LiabilitiesModleAdmin->editliabilitieshead($id);
                $data['headlist'] = $this->LiabilitiesModleAdmin->getLiabilitiesHeadCategoryList();
                $this->load->view('templates/admin/liabilitieshead/editliabilitieshead', $data);
                $this->load->view('templates/admin/common/footer');
            }
        
    }

    public function deleteliabilitieshead($id) {


        $this->LiabilitiesModleAdmin->deleteliabilitieshead($id);
        $sdata['message'] = 'Delete Succesfully...';
        $this->session->set_userdata($sdata);
        redirect('admin/liabilitieshead/index', 'refresh');
    }


    //put your code here
}

?>
