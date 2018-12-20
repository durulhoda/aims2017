<?php
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class ExpensesModleAdmin extends CI_Model {
    
    private $_table = "expenses";

    public function __construct() {
        parent::__construct();
        
    }
    
    
    public function addExpensesInfo($data){
//        print_r($data); exit;
        $data['expenseDate']=  date('d/m/Y');
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();       
        
    }
    
    public function expenseslist(){
//        print_r($data);       
        
       $this->db->order_by('expenseDate','DESC');
        $qu = $this->db->get($this->_table);
        return $qu->result_array();
               
    }
}
