<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */


class Institute extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->my_admin();
        $this->load->helper('security');
        $this->load->helper("file");
        $this->load->model('admin/institute/InstituteModleAdmin', 'InstituteModleAdmin');
    }

    public function index() {
        $data_value['data_info']=$this->InstituteModleAdmin->getInstituteInfo();
        if(!empty($data_value['data_info']))
        {
            $data['setting']='active';
            $data['institute']='active';
            $this->load->view('system_path/admin/common/header_link'); // header Css link
            $this->load->view('system_path/admin/common/header'); // body header
            $this->load->view('system_path/admin/common/side_menu',$data); // side bar menu
            $this->load->view('system_path/admin/common/top_menu'); // top bar menu
            $this->load->view('system_path/admin/institute/view_institute_info',$data_value); // ...........body content page...........
            $this->load->view('system_path/admin/common/footer'); // footer & script link
             $this->load->view('system_path/jsquery'); // footer & script link
        }
        else{
            $data['setting']='active';
            $data['institute']='active';
            $this->load->view('system_path/admin/common/header_link'); // header Css link
            $this->load->view('system_path/admin/common/header'); // body header
            $this->load->view('system_path/admin/common/side_menu',$data); // side bar menu
            $this->load->view('system_path/admin/common/top_menu'); // top bar menu
            $this->load->view('system_path/admin/institute/index'); // ...........body content page...........
            $this->load->view('system_path/admin/common/footer'); // footer & script link
             $this->load->view('system_path/jsquery'); // footer & script link
        }
    }

        public function edit() {
        $data_value['data_info']=$this->InstituteModleAdmin->getInstituteInfo();
       // print_r($data_value);        die();
        
            $data['setting']='active';
            $data['institute']='active';
            $this->load->view('system_path/admin/common/header_link'); // header Css link
            $this->load->view('system_path/admin/common/header'); // body header
            $this->load->view('system_path/admin/common/side_menu',$data); // side bar menu
            $this->load->view('system_path/admin/common/top_menu'); // top bar menu
            $this->load->view('system_path/admin/institute/edit',$data_value); // ...........body content page...........
            $this->load->view('system_path/admin/common/footer'); // footer & script link
             $this->load->view('system_path/jsquery'); // footer & script link
        }

   public function insertinstitute() {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
       if(isset($_POST['btnSubmit']))
       {
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');

            $config = array(
                array(
                    'field' => 'data[instituteName]',
                    'label' => 'Institute Name',
                    'rules' => 'required|xss_clean|trim|alpha_numeric_spaces'
                ),
                array(
                    'field' => 'data[Ein]',
                    'label' => 'Institute Ein',
                    'rules' => 'required|xss_clean'
                )
            );            

            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() == FALSE) {

                $data['setting']='active';
                $data['institute']='active';
                $this->load->view('system_path/admin/common/header_link'); // header Css link
                $this->load->view('system_path/admin/common/header'); // body header
                $this->load->view('system_path/admin/common/side_menu',$data); // side bar menu
                $this->load->view('system_path/admin/common/top_menu'); // top bar menu
                $this->load->view('system_path/admin/institute/index'); // ...........body content page...........
                $this->load->view('system_path/admin/common/footer'); // footer & script link
                $this->load->view('system_path/jsquery'); // footer & script link
                }         
            else {

                $config['upload_path'] = './uploads/logo/';
                $config['allowed_types'] = 'jpg|gif|JPEG|png';
                $config['max_size'] = '200';
                $config['max_width'] = '200';
                $config['max_height'] = '200';

                $this->upload->initialize($config);

                $yes_upload = $this->upload->do_upload('logo');
                if(!$yes_upload) 
                {
                   $sdata['errormessage'] = 'Image Not Uploaded!';
                   $this->session->set_userdata($sdata); 

                   $this->index();
                }
                else
                {
                    $data = $this->input->post('data', TRUE);
                    
               
                    $data['programLevel'] = ',' . implode(',', $data['programLevel']) . ',';
                    
                 //   print_r($data); die();
                    $img_data =  $this->upload->data();
                    $data['logo'] = "uploads/logo/".$img_data['file_name'];
                    $insert=$this->InstituteModleAdmin->addInstituteInfo($data);
                    if(!empty($insert))
                    {
                        $sdata['message'] = 'Information saved Successfully';
                        $this->session->set_userdata($sdata);
                         redirect(admin_Url()."/institute");
                    }
                    else{
                        $sdata['errormessage'] = 'Information not insert';
                        $this->session->set_userdata($sdata);
                        $this->index();
                    }

                }    

            }
       }
       else{
           redirect(admin_Url()."/institute");
       }
        
    }
    
    public function update_logo() {
        
        if(isset($_POST['btnLogo']))
       {
            $data_value['instituteId'] = $this->input->post('instituteId', TRUE);

            if(!empty($data_value['instituteId']))
            {
                $dlt_file=$this->input->post('institutelogo', TRUE);
        
                if(file_exists($dlt_file))
                {
                  // unlink($dlt_file);
                    unlink($dlt_file);
                 }
               
               
                $config['upload_path'] = './uploads/logo/';
                $config['allowed_types'] = 'jpg|gif|JPEG|png';
                $config['max_size'] = '200';
                $config['max_width'] = '200';
                $config['max_height'] = '200';

                $this->upload->initialize($config);

                $yes_upload = $this->upload->do_upload('logo');
                if (!$yes_upload) {
                    $sdata['errormessage'] = 'Image upload failed...Please maintain image size';
                    $this->session->set_userdata($sdata);

                    $this->index();
                } else {
                    $img_data = $this->upload->data();
                    $data_value['logo'] = "uploads/logo/" . $img_data['file_name'];
                    $insert = $this->InstituteModleAdmin->updateInformation($data_value);
                    if (!empty($insert)) {
                        $sdata['message'] = 'Logo Updated';
                        $this->session->set_userdata($sdata);
                        redirect(admin_Url() . "/institute");
                    } else {
                        $sdata['errormessage'] = 'Logo Upload failed';
                        $this->session->set_userdata($sdata);
                        $this->index();
                    }
                }
            }
            else{
                $sdata['errormessage'] = 'Invalid update information';
                $this->session->set_userdata($sdata);
                redirect(admin_Url()."/institute");
            }
       }
       else{
           redirect(admin_Url()."/institute");
       }
    }
    
    public function update_information() {
            $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        if(isset($_POST['btnInfo']))
       {
         
       $config = array(
                array(
                    'field' => 'data[programLevel]',
                    'label' => 'Institute Name',
                    'rules' => 'required|xss_clean|trim|alpha_numeric_spaces'
                )
            );   
  $this->form_validation->set_rules($config);
     if ($this->form_validation->run() == FALSE) {
         
           $data['setting']='active';
            $data['institute']='active';
            $this->load->view('system_path/admin/common/header_link'); // header Css link
            $this->load->view('system_path/admin/common/header'); // body header
            $this->load->view('system_path/admin/common/side_menu',$data); // side bar menu
            $this->load->view('system_path/admin/common/top_menu'); // top bar menu
            $this->load->view('system_path/admin/institute/edit',$data_value); // ...........body content page...........
            $this->load->view('system_path/admin/common/footer'); // footer & script link
             $this->load->view('system_path/jsquery'); // footer & script link
     }

        
            $data_value = $this->input->post('data', TRUE);
           $data_value['programLevel'] = ',' . implode(',', $data_value['programLevel']) . ',';
       //    print_r($data_value); die();       
            if(!empty($data_value))
            {
                   $update = $this->InstituteModleAdmin->updateInformation($data_value);
                    if (!empty($update)) {
                        $sdata['message'] = 'Information Updated Successfully';
                        $this->session->set_userdata($sdata);
                        redirect(admin_Url() . "/institute");
                    } else {
                        $sdata['errormessage'] = 'Information not Updated';
                        $this->session->set_userdata($sdata);
                        $this->index();
                    }
              
            }
            else{
                $sdata['errormessage'] = 'Invalid update information';
                $this->session->set_userdata($sdata);
                redirect(admin_Url()."/institute");
            }
       }
       else{
           redirect(admin_Url()."/institute");
       }
    }
    
  
}
