<?php
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class Admin_Login extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('content_model','co_model',TRUE);
     
        $admin_id=$this->session->userdata('admin_id');
        //echo '------'.$user_id;
        if($admin_id!=NULL)
        {
           redirect("dashboard","refresh");
        }
    }
    
    
    /*public function index()
    {
        $this->load->view('admin/admin_log');
    }*/
    
    
   
   public function index ()
               
	{
	    $data=array();
            $this->load->view('admin_login',TRUE);
           
            
        }

    public function admin_login_check()
    {
        $admin_username=$this->input->post('username',true);
        $admin_password=$this->input->post('password',true);
        //echo $email_address.'-------'.$password;
        $result=$this->co_model->check_login_info($admin_username,$admin_password);
        //echo '<pre>';
        //print_r($result);
        if($result)
        {
            $sdata=array();
            $sdata['admin_name']=$result->admin_name;
            $sdata['admin_id']=$result->admin_id;
            $sdata['login_status']=True;
            $this->session->set_userdata($sdata);
            redirect("dashboard");
        }
        else{
            $sdata=array();
            $sdata['exception']="Invalide Admin Id or Password..!";
            $this->session->set_userdata($sdata);
            redirect("admin_login");
        }
        
    }
    
    
        
        
    
    
    
}

?>
