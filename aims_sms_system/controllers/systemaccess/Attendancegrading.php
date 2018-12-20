<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class Attendancegrading extends MY_Controller{
     public function __construct() {
        parent::__construct();
        $this->my_admin();
        $this->load->model('admin/attendancegrading/AttendanceGradingModleAdmin', 'AttendanceGradingModleAdmin');
    }
    
    public function index(){
        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/attendancegrading/index');
        $this->load->view('templates/admin/common/footer');
        
    }    //put your code here
    
     public function insertattendancegrading() {
       // print_r($_POST);
         $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
         $config = array(
            array(
                'field' => 'data[grade]',
                'label' => 'Grade ',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[gradePoint]',
                'label' => 'Grade Point',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[fromPercentage]',
                'label' => 'From Percentage',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[toPercentage]',
                'label' => 'To Percentage',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[outOf]',
                'label' => 'Phone Number',
                'rules' => 'required'
            )
           );
         
           $this->form_validation->set_rules($config);
        
        if ($this->form_validation->run() == FALSE){
//                    redirect(base_url('admin/campus'));
            $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/attendancegrading/index');        
        $this->load->view('templates/admin/common/footer');
            
		}
		else
		{
                    $data = $this->input->post('data', TRUE); 
                    $result = $this->AttendanceGradingModleAdmin->duplicateAttendancegradingInfo($data);

            if (!$result) {
                    $this->AttendanceGradingModleAdmin->addAttendanceGradingInfo($data);
                     
                     $sdata['message'] = 'Successfull!';
                $this->session->set_userdata($sdata);

               redirect('admin/attendancegrading/attendancegradinglist', 'refresh');
            } else {
                $sdata['message'] = 'Duplicate Entry Found!';
                $this->session->set_userdata($sdata);

                redirect('admin/attendancegrading/attendancegradinglist', 'refresh');
            }
//			$this->load->view('formsuccess');
		}

        
    }
    public function attendancegradinglist(){
        
        $data = array();
        $data['attendancegradinglist']=$this->AttendanceGradingModleAdmin->attendancegradinglist();
      //  print_r($data['gradinglist']); die();
        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/attendancegrading/attendancegradinglist', $data );
        $this->load->view('templates/admin/common/footer');
    }
    
    public function editattendancegrading($id) {
       
//        echo $id; exit;
        $this->load->view('templates/admin/common/header');

        $data['editData'] = $this->AttendanceGradingModleAdmin->editAttendancegradingInfo($id);
//        print_r($data); exit;
        $this->load->view('templates/admin/attendancegrading/editattendancegrading', $data);
        $this->load->view('templates/admin/common/footer');
    }

    public function updateattendancegrading($id) {

  
       
            $data = $this->input->post('data', TRUE);
            $result = $this->AttendanceGradingModleAdmin->duplicateAttendancegradingInfo($data);

            if (!$result) {
                $this->GradingModleAdmin->updateAttendancegradingInfo($data, $id);
                 $sdata['message'] = 'Successfull!';
                $this->session->set_userdata($sdata);

               redirect('admin/attendancegrading/attendancegradinglist', 'refresh');
            } else {
                $sdata['message'] = 'Duplicate Entry Found!';
                $this->session->set_userdata($sdata);

                redirect('admin/attendancegrading/attendancegradinglist', 'refresh');
            }
        
    }

    public function deleteattendancegrading($id) {

        $this->GradingModleAdmin->deleteAttendancegrading($id);
        redirect('admin/attendancegrading/attendancegradinglist', 'refresh');
    }
  
}

?>
