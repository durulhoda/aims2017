<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */

class Coursecategory  extends MY_Controller{
    
    
     public function __construct() {
        parent::__construct();
        $this->my_admin();
        $this->load->model('admin/coursecategory/CoursecategoryModleAdmin', 'CoursecategoryModleAdmin');
    }
    
    public function index(){
         $this->load->library('form_validation');
         
        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/coursecategory/index');        
        $this->load->view('templates/admin/common/footer');

        
    }
    
    public function insertCoursecategory(){
       // print_r($_POST);
         $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        
         $config = array(
            array(
                'field' => 'data[categoryName]',
                'label' => 'category Name',
                'rules' => 'required'
            )
            
     );
          $this->form_validation->set_rules($config);
        
        if ($this->form_validation->run() == FALSE){
//                    redirect(base_url('admin/campus'));
            $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/coursecategory/index');        
        $this->load->view('templates/admin/common/footer');
            
		}
		else
		{
                    $data = $this->input->post('data', TRUE); 
                    $this->CoursecategoryModleAdmin->addCoursecategoryInfo($data);
			redirect('admin/coursecategory','refresh');
		}

        
    }
        
    public function coursecategorylist(){
            
            $data['coursecategorylist'] = $this->CoursecategoryModleAdmin->searchcoursecategorylist();
        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/coursecategory/coursecategorylist', $data );  
        $this->load->view('templates/admin/common/footer');

              
        }
        
        public function editcoursecategory($id) {

        $this->load->view('templates/admin/common/header');
        $data['editData'] = $this->CoursecategoryModleAdmin->editcoursecategory($id);

        $this->load->view('templates/admin/coursecategory/editcoursecategory', $data);
        $this->load->view('templates/admin/common/footer');
    }

    public function updatecoursecategory($id) {

        
            $data = $this->input->post('data', TRUE);
            $result = $this->CoursecategoryModleAdmin->duplicatecoursecategoryInfo($data);

            if (!$result) {
                $this->CoursecategoryModleAdmin->updatecoursecategoryInfo($data, $id);
                redirect('admin/coursecategory', 'refresh');
            } else {
                $sdata['message'] = 'Duplicate Entry Found!';
                $this->session->set_userdata($sdata);

                redirect('admin/coursecategory', 'refresh');
            }

    }

    public function deletecoursecategory($id) {
      
        $this->CoursecategoryModleAdmin->deletecoursecategoryInfo($id);
        $this->index();
    }
  
    //put your code here
}

