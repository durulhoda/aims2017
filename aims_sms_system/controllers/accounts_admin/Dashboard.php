<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class Dashboard extends MY_Controller{
    
    public function __construct() {
        parent::__construct();
     $this->account_access();
    }
    
    public function index(){
        $this->load->view('system_path/accounts/common/header_link'); // header Css link
        $this->load->view('system_path/accounts/common/header'); // body header
          $this->load->view('system_path/accounts/common/side_menu'); // side bar menu
     $this->load->view('system_path/accounts/common/top_menu'); // top bar menu
     
        $this->load->view('system_path/accounts/home/home'); // ...........body content page...........
        
        $this->load->view('system_path/accounts/common/footer'); // footer & script link
    }
    //put your code here
}
