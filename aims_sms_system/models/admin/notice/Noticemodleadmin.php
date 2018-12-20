<?php

/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
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
