<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of expenseheadModleAdmin
 *
 * @author Binita
 */
class ExpensesheadModleAdmin extends CI_Model{
    private $_table = "expensehead";

    public function __construct() {
        parent::__construct();
    }
    
    
    public function addExpensesheadInfo($data){
//        print_r($data); exit;
        
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();       
        
    }
    //put your code here
}


