<?php

/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class DuesModleAdmin  extends CI_Model{
    
     private $_table = "dues";

    public function __construct() {
        parent::__construct();
    }
    
    
    public function addDuesInfo($data){
//        print_r($data); exit;
        
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();       
        
    }
    //put your code here
}

?>
