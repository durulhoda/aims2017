<?php

/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class PaymentlistModleAdmin extends CI_Model{
    //put your code here
     public function __construct() {
        parent::__construct();
    }
    
    
    public function addPaymentlistInfo($data){
//        print_r($data); exit;
        
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();       
        
    }
}


