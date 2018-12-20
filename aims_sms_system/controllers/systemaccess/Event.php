<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */


class Event extends MY_Controller{
    
     public function __construct() {
        parent::__construct();
        $this->my_admin();
     $this->load->model('admin/event/EventModleAdmin', 'EventModleAdmin');
    }
    public function index() {
        $this->load->helper(array('form', 'url'));
        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/event/index');
        $this->load->view('templates/admin/common/footer');
    }
   public function insertevent() {
//      echo $_POST; exit;
//         print_r($_POST);
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
            
            array(
                'field' => 'data[month]',
                'label' => 'Event month',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[startdate]',
                'label' => 'Start Date',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[enddate]',
                'label' => 'End Date',
                'rules' => 'required'
            ),
            array(
                'field' => 'data[description]',
                'label' => 'Event Name',
                'rules' => 'required'
            )
        );


        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
//                    redirect(base_url('admin/campus'));
            $this->load->view('templates/admin/common/header');
            $this->load->view('templates/admin/event/index');
            $this->load->view('templates/admin/common/footer');
        } else {

            $data = $this->input->post('data', TRUE);

            $validation = $this->EventModleAdmin->eventvalidation($data);
            
            if ($validation) {
                $sdata = array();
                $sdata['message'] = "Duplicate entry found..!";
                $this->session->set_userdata($sdata);

                $this->load->view('templates/admin/common/header');
                $this->load->view('templates/admin/event/index');
                $this->load->view('templates/admin/common/footer');
            } else {

                $this->EventModleAdmin->addEventInfo($data);

                $sdata = array();
                $sdata['message'] = "Insert New routine Successfully!";
                $this->session->set_userdata($sdata);
                
                $this->load->helper(array('form', 'url'));
                $this->load->view('templates/admin/common/header');
                $this->load->view('templates/admin/event/index');
                $this->load->view('templates/admin/common/footer');
            }
        }
    //put your code here
}
 public function viewevent() {

        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/event/eventlist');
        $this->load->view('templates/admin/common/footer');
    }
    
    public function showmonthlyevent($month) {
     
        $data['eventlist']= $this->EventModleAdmin->showmonthlyevent($month);
        
        $data['date']=$month;
//      print_r($data['examroutine']); die();
        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/event/eventlist', $data);
        $this->load->view('templates/admin/common/footer');
        
    }

    
public function editevent($id){
        $id = (int)$id; 
//        echo $id; exit;
        $this->load->view('templates/admin/common/header');
        
        $data['editevent'] = $this->EventModleAdmin->editEventscheduleInfo($id);
//        print_r($data);
        $this->load->view('templates/admin/event/editevent', $data); 
        $this->load->view('templates/admin/common/footer');
    }

 public function updateevent($id){
        $id = (int)$id; 
         $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $config = array(
            array(
                'field' => 'data[eventName]',
                'label' => 'eventName',
                'rules' => 'required'
            )
            );
        
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = '*';
        $config['max_size'] = '1000';
//        $config['max_width'] = '1024';
//        $config['max_height'] = '768';  
        
        $this->load->library('upload', $config);

        $yes_upload = $this->upload->do_upload('userfile');

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
//                    redirect(base_url('admin/campus'));
            $this->load->view('templates/admin/common/header');
            $this->load->view('templates/admin/event/index');
            $this->load->view('templates/admin/common/footer');
            
        } elseif (!$yes_upload) {
            
            $this->load->view('templates/admin/common/header');
            $this->load->view('templates/admin/event/index');
            $this->load->view('templates/admin/common/footer');
            
        } else {
            
             $data = $this->input->post('data', TRUE);
             
             $img_data =  $this->upload->data();

//                  print_r($img_data);
            $data['event'] = $img_data['file_name'];
//            print_r($data); exit;
            $this->EventModleAdmin->updateEventscheduleInfo($data, $id);
//			$this->load->view('formsuccess');
//            redirect(base_url('admin/classroutine'));
             $this->index('refresh');
    }
    //put your code here
}

 public function deleteevent($id) {

        $id = (int)$id;
        
         $this->EventModleAdmin->deleteEventscheduleInfo($id);
         $this->index();
    }
}