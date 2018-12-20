<?php

/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class IncomesModleAdmin extends CI_Model {
     private $_table = "incomes";

    public function __construct() {
        parent::__construct();
    }
    
    
    public function addIncomesInfo($data){
//       print_r($data); exit;
        $data['incomeDate']=  date('d/m/Y');
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();       
        
    }    
    
    public function incomeslist(){
//        print_r($data);       
        
       $this->db->order_by('incomeDate','DESC');
        $qu = $this->db->get($this->_table);
        return $qu->result_array();
               
    }

}


