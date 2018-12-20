<?php

/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class GradesheetModleAdmin extends CI_Model {
    //put your code here
   // private $_table = "gradesheet";

    public function __construct() {
        parent::__construct();
    }
    
    
    public function addGradesheetInfo($data){
//        print_r($data); exit;
        
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();       
        
    }
}

