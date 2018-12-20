<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */

class PublishResult extends MY_Controller{
    
      public function __construct() {
        parent::__construct();
        $this->teacher_logged_auth();
         $this->load->model('admin/publishresult/PublishResultModelAdmin', 'PublishResultModelAdmin');
         $this->load->model('admin/studentmarks/StudentmarksModleAdmin', 'StudentmarksModleAdmin');
         $this->load->model('admin/program/ProgramModleAdmin', 'ProgramModleAdmin');
         $this->load->model('admin/result_view/Result_viewModleAdmin', 'Result_viewModleAdmin');
  
}
    public function index(){
        $data['result'] = 'active';
        $this->load->view('system_path/admin/common/header_link'); // header Css link
        $this->load->view('system_path/admin/common/header'); // body header
        $this->load->view('system_path/admin/common/side_menu'); // side bar menu
        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
        $this->load->view('system_path/admin/publishresult/index'); // ...........body content page...........
        $this->load->view('system_path/admin/common/footer'); // footer & script link
        $this->load->view('system_path/jsquery'); // footer & script link
    }
    public function searchresult(){
        
       $data = $this->input->post('data', TRUE);

        $data['markslist'] = $this->PublishResultModelAdmin->getresult($data);

        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/publishresult/markslist', $data );  
        
        $this->load->view('templates/admin/common/footer');
        
    
    }
    
     public function searchresultforpublish(){
        
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
            array(
                'field' => 'data[programId]',
                'label' => 'Program',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[mediumId]',
                'label' => 'Medium',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[sectionId]',
                'label' => 'Section',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[groupId]',
                'label' => 'Group',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[shiftId]',
                'label' => 'Shift',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[sessionId]',
                'label' => 'Session',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[semesterId]',
                'label' => 'Semester',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            $data['result'] = 'active';
            $this->load->view('system_path/admin/common/header_link'); // header Css link
            $this->load->view('system_path/admin/common/header'); // body header
            $this->load->view('system_path/admin/common/side_menu'); // side bar menu
            $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
            $this->load->view('system_path/admin/publishresult/index'); // ...........body content page...........
            $this->load->view('system_path/admin/common/footer'); // footer & script link
            $this->load->view('system_path/jsquery'); // footer & script link
        } 
        else 
        {
            $data = $this->input->post('data', TRUE);
            $data['programOfferId'] = $this->ProgramModleAdmin->getProgramOfferId($data);
            if (!empty($data['programOfferId'])) {
                $data['markslist'] = $this->StudentmarksModleAdmin->getResultStatusByPrgid($data);
                 if(!empty($data['markslist']))
                 {
                    $data['result'] = 'active';
                    $this->load->view('system_path/admin/common/header_link'); // header Css link
                    $this->load->view('system_path/admin/common/header'); // body header
                    $this->load->view('system_path/admin/common/side_menu'); // side bar menu
                    $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu
                    $this->load->view('system_path/admin/publishresult/markslist', $data); // ...........body content page...........
                    $this->load->view('system_path/admin/common/footer'); // footer & script link
                    $this->load->view('system_path/jsquery'); // footer & script link
                    
                }
                else{
                    
                    $sdata['errormessage'] = "No Result Found";
                    $this->session->set_userdata($sdata);
                    redirect(admin_Url() . "/publishresult", "refresh");
                }
            }
            else {
                  $sdata['errormessage'] = "Classoffer Information is not offer yet";
                  $this->session->set_userdata($sdata);
                  redirect(admin_Url() . "/publishresult", "refresh");
              }  
        }
    }
    
    public function publishresults(){
        
      if (!empty($_POST['studentId'])) {  
        $data['studentId'] = $this->input->post('studentId');
        
        $ab = $data['studentId'];
        for ($i = 0; $i < count($ab); $i++) {
             $cat = $ab[$i];
             
             $datas['semesterId'] = $this->input->post('semesterId');
             $datas['programOfferId'] = $this->input->post('programOfferId');
             $datas['studentId'] = $cat;
             $datas['result_status'] = 1;
          
             $result=$this->PublishResultModelAdmin->checkduplicatepublishresults($datas);
             if(!empty($result)){
                $data_id['programOfferId']=$datas['programOfferId'];
                $data_id['studentId']=$datas['studentId'];
                $data_id['semesterId']=$datas['semesterId'];
                $datare['result_status'] =1;
                $this->PublishResultModelAdmin->publishresultsbystudent($datare,$data_id);
             }
             else{
                 $this->PublishResultModelAdmin->publishresults($datas);
                
             }
        }
        $sdata['message'] = 'Result Published';
        $this->session->set_userdata($sdata);
        redirect(admin_Url() . "/publishresult", "refresh");
    
    }
    else{
        $sdata = array();
        $sdata['errormessage'] = 'Select Student for publish result';
        $this->session->set_userdata($sdata);
        redirect(admin_Url() . "/publishresult", "refresh");
    }
    }
    
    
    public function publishresultsbystudent($programOfferId,$studentId,$semesterId){
        if(!empty($programOfferId) && !empty($studentId) && !empty($semesterId))
        {
            $data_id['programOfferId']=$programOfferId;
            $data_id['studentId']=$studentId;
            $data_id['semesterId']=$semesterId;
            $data['result_status'] =1;
            $this->PublishResultModelAdmin->publishresultsbystudent($data,$data_id);

            $sdata = array();
            $sdata['message'] = 'Result Published!';
            $this->session->set_userdata($sdata);
            redirect(base_url('admin/publishresult','refresh'));
        }
        else{
            $sdata['errormessage'] = 'Invalid request for result';
            $this->session->set_userdata($sdata);
            redirect(base_url('admin/publishresult','refresh'));
        }
    
    }
    public function unpublishresultsbystudent($programOfferId,$studentId,$semesterId){
        
        if(!empty($programOfferId) && !empty($studentId) && !empty($semesterId))
        {
            $data_id['programOfferId']=$programOfferId;
            $data_id['studentId']=$studentId;
            $data_id['semesterId']=$semesterId;
            $data['result_status'] =0;
            $this->PublishResultModelAdmin->unpublishresultsbystudent($data,$data_id);

            $sdata = array();
            $sdata['message'] = 'Result Un-Published!';
            $this->session->set_userdata($sdata);
            redirect(base_url('admin/publishresult','refresh'));
        }
        else{
            $sdata['errormessage'] = 'Invalid request for result';
            $this->session->set_userdata($sdata);
            redirect(base_url('admin/publishresult','refresh'));
        }
    
    }
    
    
}
