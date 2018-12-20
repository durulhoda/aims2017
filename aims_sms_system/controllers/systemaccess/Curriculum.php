<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */


class Curriculum extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->my_admin();
        $this->load->model('admin/curriculum/CurriculumModleAdmin', 'CurriculumModleAdmin');
    }

    public function index() {
        $this->load->helper(array('form', 'url'));
        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/curriculum/index');
        $this->load->view('templates/admin/common/footer');
    }
    
      public function do_upload() {
//       print_r($_POST);
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
            array(
                'field' => 'data[curriculumName]',
                'label' => 'curriculumName',
                'rules' => 'required'
            )
            
            );

      $this->form_validation->set_rules($config);
        
          if ($this->form_validation->run() == FALSE) {
//                    redirect(base_url('admin/campus'));
            $this->load->view('templates/admin/common/header');
            $this->load->view('templates/admin/curriculum/index');
            $this->load->view('templates/admin/common/footer');
            
        } else {
            
             $data = $this->input->post('data', TRUE);
             $result = $this->CurriculumModleAdmin->duplicateCurriculumInfo($data);

            if (!$result) {
                $this->CurriculumModleAdmin->addCurriculumInfo($data);

			$sdata['message'] = 'Successfull!';
            $this->session->set_userdata($sdata);

            redirect('admin/curriculum', 'refresh');
            } else {
                $sdata['message'] = 'Duplicate Entry Found!';
                $this->session->set_userdata($sdata);

                redirect('admin/curriculum', 'refresh');
            }
            
    }
}   
public function curriculumlist(){
    
    $data['curriculumlist'] = $this->CurriculumModleAdmin->getlistCurriculum();
//        print_r($examroutinelist);
       $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/curriculum/curriculumlist', $data);
        $this->load->view('templates/admin/common/footer');
        
    
    }
    
     public function editcurriculum($id){
       
//        echo $id; exit;
        $this->load->view('templates/admin/common/header');
        
        $data['editData'] = $this->CurriculumModleAdmin->editCurriculumInfo($id);
//        print_r($data);exit;
        $this->load->view('templates/admin/curriculum/editcurriculum', $data); 
        $this->load->view('templates/admin/common/footer');
    }
    
    public function updatecurriculum($id){
//         print_r($_POST);
    
            $data = $this->input->post('data', TRUE);
            $result = $this->CurriculumModleAdmin->duplicateCurriculumInfo($data);

            if (!$result) {
            $this->CurriculumModleAdmin->updateCurriculumInfo($data, $id);
            	$sdata['message'] = 'Successfull!';
            $this->session->set_userdata($sdata);

            redirect('admin/curriculum', 'refresh');
            } else {
                $sdata['message'] = 'Duplicate Entry Found!';
                $this->session->set_userdata($sdata);

                redirect('admin/curriculum/curriculumlist', 'refresh');
            }
            
       
        
    }
    public function deletecurriculum($id) {

        
         $this->CurriculumModleAdmin->deleteCurriculumInfo($id);
         $this->index();
    }

}
