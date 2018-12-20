<?php
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class Student extends MY_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->student_logged_auth();
        
         $this->load->model('admin/student/StudentModleAdmin', 'StudentModleAdmin');
    }
    
     public function profile(){
        $username=$this->session->userdata('studentId');
        $data['profile']='active'; 
          $data['editData'] = $this->StudentModleAdmin->getstudentNameInfo($username);
        
        $this->load->view('system_path/student/common/header_link'); // header Css link
        $this->load->view('system_path/student/common/header'); // body header
        $this->load->view('system_path/student/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/student/student/index', $data); // ...........body content page...........
        $this->load->view('system_path/student/common/footer'); // footer & script link
       
         
    } 

         public function studentComment(){
        $username=$this->session->userdata('studentId');
        $data['stucmt']='active'; 
          $data['commentData'] = $this->StudentModleAdmin->allcomment($username);
       //   print_r($data); die();
        $this->load->view('system_path/student/common/header_link'); // header Css link
        $this->load->view('system_path/student/common/header'); // body header
        $this->load->view('system_path/student/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/student/student/commentlist', $data); // ...........body content page...........
        $this->load->view('system_path/student/common/footer'); // footer & script link                
    }  
    
   public function ewditstudent($id){
      

        $data['editData'] = $this->StudentModleAdmin->getstudentNameInfo($id);


       $this->load->view('system_path/student/common/header_link'); // header Css link
       $this->load->view('system_path/student/common/header'); // body header
        $this->load->view('system_path/student/common/side_menu', $data); // side bar menu
        $this->load->view('system_path/student/student/editstudent', $data); // ...........body content page...........
       $this->load->view('system_path/student/common/footer'); // footer & script link
   
    } 
    
        public function editstudent($id) {
        $data['editData'] = $this->StudentModleAdmin->getstudentNameInfo($id);
     
        //     print_r($data); die();
        if (!empty($data['editData'])) {
            $data['profile'] = 'active';
            $this->load->view('system_path/student/common/header_link'); // header Css link
            $this->load->view('system_path/student/common/header'); // body header
            $this->load->view('system_path/student/common/side_menu', $data); // side bar menu
            $this->load->view('system_path/student/student/editstudent', $data); // ...........body content page...........
            $this->load->view('system_path/student/common/footer'); // footer & script link
        } else {
       //     echo "DIEEEE"; die();
             $sdata['errormessage'] = 'Invalid Student Id...Please try again';
             $this->session->set_userdata($sdata);
           // $this->searchapplicant();
            redirect(admin_Url() . "/student/searchRegisteredStudent");
        }
    } 
   
        public function updateStudent($id) {

        $data = $this->input->post('data', TRUE);

        $data['editData']=$this->StudentModleAdmin->updateapplicantInfo($data, $id);
        if( $data['editData'])
        {
        $sdata = array();
        $sdata['message'] = 'Updated Successfully !';
        $this->session->set_userdata($sdata);
        }else
        {
            $sdata['message'] = 'Not Updated !';
        $this->session->set_userdata($sdata);
        }
       
        redirect(student_Url() . "/student/profile");
    }
    
    public function dtudent($id){
        $id = (int)$id;
        
        $this->StudentModleAdmin->editStudentInfo($id);
        
         
    } 
    
    
   
    
    public function updatestudent_photo() {
        
        if(isset($_POST['btnSubmit']))
       {
            $data_value['applicationId'] = $this->input->post('applicationId', TRUE);

            if(!empty($data_value['applicationId']))
            {
                $dlt_file=$this->input->post('photo', TRUE);
        
                if(file_exists($dlt_file))
                {
                  // unlink($dlt_file);
                    unlink($dlt_file);
                 }
               
               
                $config['upload_path'] = './uploads/Students/';
                $config['allowed_types'] = 'jpg|gif|JPEG|png';
                $config['max_size'] = '10000';
                $config['max_width'] = '350';
                $config['max_height'] = '350';

                $this->upload->initialize($config);

                $yes_upload = $this->upload->do_upload('photo');
                if (!$yes_upload) {
                    $sdata['errormessage'] = 'Image upload failed...Please maintain image size';
                    $this->session->set_userdata($sdata);
                       redirect(student_Url() . "/student/profile");
                 // $this->index();
                } else {
                    $img_data = $this->upload->data();
                    $data_value['photo'] = "uploads/Students/".$img_data['file_name'];
                    $insert = $this->StudentModleAdmin->updatestudentphoto($data_value);
                    
                    if (!empty($insert)) {
                        $sdata['message'] = 'Image Updated';
                        $this->session->set_userdata($sdata);
                               redirect(student_Url() . "/student/profile");
                    } else {
                        $sdata['errormessage'] = 'Image Upload failed';
                        $this->session->set_userdata($sdata);
                        $this->index();
                    }
                }
            }
            else{
                $sdata['errormessage'] = 'Invalid update information';
                $this->session->set_userdata($sdata);
                       redirect(student_Url() . "/student/profile");
            }
       }
       else{
                  redirect(student_Url() . "/student/profile");
       }
    }
    

    
     public function changepassword(){
        $this->load->view('system_path/student/common/header_link'); // header Css link
        $this->load->view('system_path/student/common/header'); // body header
        $this->load->view('system_path/student/common/side_menu'); // side bar menu
        $this->load->view('system_path/student/student/changepassword'); // ...........body content page...........
        $this->load->view('system_path/student/common/footer'); // footer & script link

    }
    
     public function updatepassword() {
        
        $userName=$this->session->userdata('studentId');
            $currentpassword=md5($this->input->post('currentpassword',true));
            $newpassword=md5($this->input->post('newpassword',true));
            $data['stu_pass_access']=md5($this->input->post('retypepassword',true));
        if(!empty($currentpassword) || !empty($newpassword) || !empty($retypepassword) )
        {
          
            $result=$this->StudentModleAdmin->checkcurrentpassword($userName);
            
            $password= $result->stu_pass_access;
            
            if($password == $currentpassword)
            {
         
                if($newpassword == $data['stu_pass_access'])
                {
                    
                    $this->StudentModleAdmin->updatepassword($userName,$data);

                    $sdata['message'] = 'Password Updated';
                    $this->session->set_userdata($sdata);
                    redirect(student_Url() . "/student/changepassword");
                    
                }
                else
                {
                    $sdata['errormessage'] = 'New Password & Retype Password is not match';
                    $this->session->set_userdata($sdata);
                    redirect(student_Url() . "/student/changepassword"); 
                }
            }
            else{
                $sdata['errormessage'] = 'Current Password is not match';
                $this->session->set_userdata($sdata);
                redirect(student_Url() . "/student/changepassword"); 
            }
        }
     }
       
}
