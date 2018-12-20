<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of passingcriteriamodleadmin
 *
 * @author Binita
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


