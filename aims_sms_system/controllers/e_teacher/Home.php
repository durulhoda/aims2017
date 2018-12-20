<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class Home extends MY_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->teacher_logged_auth();
    }
    
    public function index(){
        $this->load->view('system_path/teacher/common/header_link'); // header Css link
        $this->load->view('system_path/teacher/common/header'); // body header
          $this->load->view('system_path/teacher/common/side_menu'); // side bar menu
     // $this->load->view('system_path/teacher/common/top_menu'); // top bar menu
     
        $this->load->view('system_path/teacher/home/home'); // ...........body content page...........
        
        $this->load->view('system_path/teacher/common/footer'); // footer & script link
    }
    //put your code here
}
