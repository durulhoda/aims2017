<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of result_previewmodleadmin
 *
 * @author Binita
 */
class Result_previewModleAdmin extends CI_Model{
 
 //private $_table = "coursecategory";

    public function __construct() {
        parent::__construct();
    }
    
    
    public function addResult_previewInfo($data){
//        print_r($data); exit;
        
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();       
        
    }    
//put your code here
}


