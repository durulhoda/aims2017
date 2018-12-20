<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of groupModleAdmin
 *
 * @author Binita
 */
class FinanceheadModleAdmin extends CI_Model {
    
    private $_table = "financehead";
    private $_table1 = "finance";

    public function __construct() {
        parent::__construct();
    }
    
    
    public function addHeadsetupInfo($data){
//        print_r($data); exit;
        
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();       
        
    }
    
   public function getlistfinancehead(){
         
        $result = $this->db->get($this->_table);
        return $result->result_array();  
    }
    
        
     public function editfinancehead($id) {
        $qu = $this->db->get_where($this->_table, array('id' => $id));
        return $qu->row_array();
    }

    public function updatefinancehead($data, $id) {

        $qu = $this->db->where('id', $id);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows();
    }

    public function deletefinancehead($id) {
        $qu = $this->db->where('id', $id);
        $this->db->delete($this->_table);
        return $this->db->affected_rows();
    }
    
    public function getIncomeHeadCategoryName($id){
            
        $qu = $this->db->get_where($this->_table, array('id' => $id));        
        $result = $qu->row_array();
        return $result['headcategory'];
    }
    
    public function duplicateInfo($data) {
//        $this->db->select('campusName');        
        $qu = $this->db->get_where($this->_table, array('headcategory' => $data['headcategory']));
        $reault = $qu->row_array();
        return $reault;
    }
   
    
    public function addFinanceInfo($data){
//        print_r($data); exit;
        
        $this->db->insert($this->_table1, $data);
        return $this->db->insert_id();       
        
    }
    
     public function getFinancedate(){   
         $this->db->select('*');
        $this->db->distinct();
         $this->db->group_by('addDate');
         $this->db->order_by('financeId','DESC');
         $qu= $this->db->get_where($this->_table1); 
        return $qu->result_array();
         
    }
    
    public function getAllfinanceinfo(){    
         $this->db->order_by('financeId','DESC');
         $qu= $this->db->get_where($this->_table1); 
         $reasult = $qu->result_array();        
        return $reasult;
    }
  
}
 

