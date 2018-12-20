<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */

class Breakmark extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->my_admin();
      $this->load->model('admin/batch/BatchModleAdmin', 'BatchModleAdmin');
      $this->load->model('admin/breakmark/BreakMarkModleAdmin', 'BreakMarkModleAdmin');
     
    }
    public function index() {
        $this->load->helper(array('form', 'url'));
        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/breakmark/index');
        $this->load->view('templates/admin/common/footer');
    }   //put your code here
    
    public function searchbreakmark(){
          $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
         $config = array(
             array(
                'field' => 'data[campusId]',
                'label' => 'campus',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[programId]',
                'label' => 'Class',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[mediumId]',
                'label' => 'Medium',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[shiftId]',
                'label' => 'Shift',
                'rules' => 'required'
            ),
             array(
                'field' => 'data[groupId]',
                'label' => 'Group',
                'rules' => 'required'
            ),
             array(
                'field' => 'data[sectionId]',
                'label' => 'Section',
                'rules' => 'required'
            ),
             
             array(
                'field' => 'data[session]',
                'label' => 'Session',
                'rules' => 'required'
            ),
             array(
                'field' => 'data[employeeId]',
                'label' => 'Teacher',
                'rules' => 'required'
            ) 
       );
          $this->form_validation->set_rules($config);
        
        if ($this->form_validation->run() == FALSE){
                    $this->load->library('form_validation');
                 $this->load->view('templates/admin/common/header');
                 $this->load->view('templates/admin/breakmark/subjectsearchlist');
                 $this->load->view('templates/admin/common/footer');
	}
	else
	{
            $data = $this->input->post('data', TRUE);
            $data['subjectlist'] = $this->BreakMarkModleAdmin->getsubjectlist($data);

            if($data['subjectlist'] ){
            $this->load->view('templates/admin/common/header');
            $this->load->view('templates/admin/breakmark/subjectsearchlist', $data );  

            $this->load->view('templates/admin/common/footer');
            }
            else{
                $sdata = array();
                $sdata['message'] = 'No Subject List Found For Break Mark';
                $this->session->set_userdata($sdata);

                $this->load->helper(array('form', 'url'));
                $this->load->view('templates/admin/common/header');
                $this->load->view('templates/admin/breakmark/subjectsearchlist',$data);
                $this->load->view('templates/admin/common/footer');
            }

        }
    }
    
    public function insertbreakmark($courseId){
        $data['courseId'] = (int)$courseId;        
        
        $data['marklist'] = $this->BreakMarkModleAdmin->getmarklist($data);
        $this->load->view('templates/admin/common/header');
      //  $data['breakmark'] = $this->BreakMarkModleAdmin->insertbreakmark($courseId);
        $this->load->view('templates/admin/breakmark/addbreakmark', $data);
        $this->load->view('templates/admin/common/footer');
         
    } 
    
      public function savebreakmark() {        
        
          $data = $this->input->post('data', TRUE); 
        $this->BreakMarkModleAdmin->savebreakmark($data);        
        $sdata = array();
        $sdata['message'] = 'Marks Added Successfully!';
        $this->session->set_userdata($sdata);
        
        redirect('admin/breakmark/index');        
    }
    public function markslist(){
        $data['title'] = "Subject Break Marks";
        $data['markslist']=$this->BreakMarkModleAdmin->getmarks();
        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/breakmark/markslist', $data);
        $this->load->view('templates/admin/common/footer');
       
        
    }
    
     public function editbreakmark($id) {
       
        $this->load->view('templates/admin/common/header');

        $data['editData'] = $this->BreakMarkModleAdmin->editBreakmarkInfo($id);
//        print_r($data);
        $this->load->view('templates/admin/breakmark/editbreakmark', $data);
        $this->load->view('templates/admin/common/footer');
    }
    
  public function updatebreakmark($id){
       
            $data = $this->input->post('data', TRUE);
            $this->BreakMarkModleAdmin->updateBreakmarkInfo($data, $id);
            $sdata['message'] = 'Marks Update Successfully!';
            $this->session->set_userdata($sdata);

            redirect('admin/breakmark/index'); 
       
        
    }
     public function deletebreakmark($id) {

      
         $this->BreakMarkModleAdmin->deleteBreakmarkInfo($id);
         redirect('admin/breakmark/index'); 
    }
}


