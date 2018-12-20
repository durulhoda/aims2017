<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */


class Marksearch extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->teacher_logged_auth();
      $this->load->model('admin/studentmarks/StudentmarksModleAdmin', 'StudentmarksModleAdmin');
    }
   
    
    public function index() {
        $this->load->helper(array('form', 'url'));
        $this->load->view('templates/admin/common/header');
        $this->load->view('templates/admin/marksearch/index');
        $this->load->view('templates/admin/common/footer');
    }   //put your code here
    
    
    
    
    
}
