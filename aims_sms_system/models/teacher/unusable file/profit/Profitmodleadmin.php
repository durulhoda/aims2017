<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of programModleAdmin
 *
 * @author Binita
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

