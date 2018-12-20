<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */


class Incomeadd extends MY_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->my_admin();
    }
    
    public function index(){
        
        $this->load->view('templates/admin/incomeadd/index');
        
    }
    
    public function insertIncomeadd(){
        print_r($_POST);
        
    }

    //put your code here
}

?>
