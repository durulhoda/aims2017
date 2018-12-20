<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of departmentmodleadmin
 *ci
 * @author Binita
 */
class NoticeModleAdmin extends CI_Model {
    //put your code here
     private $_table = "notice";

    public function __construct() {
        parent::__construct();
    }
    
    
     public function getlistNotice(){
         
        $result = $this->db->get($this->_table);
        return $result->result_array();  
    }
   
}

?>
