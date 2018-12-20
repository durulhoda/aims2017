<?php

/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class Teacher extends MY_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->teacher_logged_auth();
        
         $this->load->model('teacher/teacher/TeacherModleAdmin', 'TeacherModleAdmin');
    }
    
     public function profile(){
        $username=$this->session->userdata('emp_userName');
        $data['profile']='active';
          $data['editData'] = $this->TeacherModleAdmin->viewTeacherInfo($username);
        
        $this->load->view('system_path/teacher/common/header_link'); // header Css link
        $this->load->view('system_path/teacher/common/header'); // body header
        $this->load->view('system_path/teacher/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/teacher/teacher/index', $data); // ...........body content page...........
        $this->load->view('system_path/teacher/common/footer'); // footer & script link
       
         
    } 

    
    public function editteacher(){
      
        $username=$this->session->userdata('emp_userName');
       
        $data['editData'] = $this->TeacherModleAdmin->viewTeacherInfo($username);
        $data['profile']='active';
        $this->load->view('system_path/teacher/common/header_link'); // header Css link
        $this->load->view('system_path/teacher/common/header'); // body header
        $this->load->view('system_path/teacher/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/teacher/teacher/editteacher', $data); // ...........body content page...........
        $this->load->view('system_path/teacher/common/footer'); // footer & script link
   
    } 
    
    
     public function updateTeacher($id){
          
            
            $data = $this->input->post('data', TRUE);           

            $this->TeacherModleAdmin->updateTeacherInfo($data,$id);

            $sdata['message'] = 'Successfull!';
            $this->session->set_userdata($sdata);
            redirect(teacher_Url() . "/teacher/profile");
    }
   
         public function updateTeacherphoto($id){

         
        $this->load->library('upload',  $config);
        $config['upload_path'] = './uploads/Employee/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '1000';
        $config['max_width'] = '1024';
        $config['max_height'] = '768';
        $error = '';
        $udata = '';

        $this->upload->initialize($config);
        if (!$this->upload->do_upload('userfile')) {
            $error = array('error' => $this->upload->display_errors());
        } else {
            $udata = array('upload_data' => $this->upload->data());
            $data['photo'] = "/uploads/Employee/" . $udata['upload_data']['file_name'];
        }
        $insrt=$this->TeacherModleAdmin->updateTeacherphoto($id);
       
        if($insrt)
        {
            $sdata = array();
            $sdata['message'] = "Save Photo succesfully!";
            $this->session->set_userdata($sdata);
             redirect(teacher_Url() . "/teacher/profile");
        }
        else{
            $sdata['errormessage'] = "Photo not saved";
            $this->session->set_userdata($sdata);
            redirect(teacher_Url() . "/teacher/profile");
        }
        
    }
    
    
    public function update_photo() {
        
        if(isset($_POST['btnSubmit']))
       {
            $data_value['employeeId'] = $this->input->post('employeeId', TRUE);

            if(!empty($data_value['employeeId']))
            {
                $dlt_file=$this->input->post('photo', TRUE);
        
                if(file_exists($dlt_file))
                {
                  // unlink($dlt_file);
                    unlink($dlt_file);
                 }
               
               
                $config['upload_path'] = './uploads/Employee/';
                $config['allowed_types'] = 'jpg|gif|JPEG|png';
                $config['max_size'] = '1000';
                $config['max_width'] = '1024';
                $config['max_height'] = '768';

                $this->upload->initialize($config);

                $yes_upload = $this->upload->do_upload('photo');
                if (!$yes_upload) {
                    $sdata['errormessage'] = 'Image upload failed...Please maintain image size';
                    $this->session->set_userdata($sdata);
                    redirect(teacher_Url() . "/teacher/profile");
                 // $this->index();
                } else {
                    $img_data = $this->upload->data();
                    $data_value['photo'] =  $img_data['file_name'];
                    $insert = $this->TeacherModleAdmin->updateTeacherphoto($data_value);
                    
                    if (!empty($insert)) {
                        $sdata['message'] = 'Image Updated';
                        $this->session->set_userdata($sdata);
                        redirect(teacher_Url() . "/teacher/profile");
                    } else {
                        $sdata['errormessage'] = 'Image Upload failed';
                        $this->session->set_userdata($sdata);
                        redirect(teacher_Url() . "/teacher/profile");
                    }
                }
            }
            else{
                $sdata['errormessage'] = 'Invalid update information';
                $this->session->set_userdata($sdata);
                redirect(teacher_Url() . "/teacher/profile");
            }
       }
       else{
                  redirect(teacher_Url() . "/teacher/profile");
       }
    }
    

    
     public function changepassword(){
        //$data['profile'] = 'active';
        $this->load->view('system_path/teacher/common/header_link'); // header Css link
        $this->load->view('system_path/teacher/common/header'); // body header
        $this->load->view('system_path/teacher/common/side_menu'); // side bar menu
        $this->load->view('system_path/teacher/teacher/changepassword'); // ...........body content page...........
        $this->load->view('system_path/teacher/common/footer'); // footer & script link
    }
    
     public function updatepassword() {
        
//        echo hello; exit;
         $data = array();
          $userName=$this->session->userdata('emp_userName');
        //  print_r($userName); die();
            $currentpassword=md5($this->input->post('currentpassword',true));
            //print_r($currentpassword); die();
            $newpassword=md5($this->input->post('newpassword',true));
            $data['emp_pass']=md5($this->input->post('retypepassword',true));
         //   print_r($data);            die();
        if(!empty($currentpassword) || !empty($newpassword) || !empty($data['emp_pass']))
        {
          
            $result=$this->TeacherModleAdmin->checkcurrentpassword($userName);
          // print_r($result); die();
           // $password= $result->emp_pass;
            
            if($currentpassword = $result)
            {
         
                if($newpassword == $data['emp_pass'])
                {
                 $this->TeacherModleAdmin->updatepassword($userName,$data);
                 //   print_r($newpasswor); die();  
                     
                        $sdata=array();
                        $sdata['message']=" Password Change Successfully..";
                        $this->session->set_userdata($sdata);
                   //     redirect(base_url('student'));
                        redirect(teacher_Url() . "/teacher/changepassword");
                    
                }
                else
                {
                    $sdata=array();
                    $sdata['errormessage']="New Password & Retype Password is not match..!";
                    $this->session->set_userdata($sdata);
               //     redirect(base_url('student'));
                      redirect(teacher_Url() . "/teacher/changepassword"); 
                }
            }
            else{
                $sdata=array();
                $sdata['errormessage']="Current Password is not match..!";
                $this->session->set_userdata($sdata);
           //     redirect(base_url('student'));
                   redirect(teacher_Url() . "/teacher/changepassword");
            }
        }
     }
       
}
