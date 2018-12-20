<?php

/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class ProfitModleAdmin extends CI_Model {
    
    private $_table = "profit";

    public function __construct() {
        parent::__construct();
    }
    
    
    public function addProfitInfo($data){
//        print_r($data); exit;
        
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();       
        
    }

    
    
    //put your code here
}

