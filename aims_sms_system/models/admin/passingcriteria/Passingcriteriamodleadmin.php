<?php

/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class passingcriteriamodleadmin {
    //put your code here
    
    private $_table = "";

    public function __construct() {
        parent::__construct();
        
    }
    
    
    public function addpassingcriteriaInfo($data){
//        print_r($data); exit;
        
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();       
        
    }
}


