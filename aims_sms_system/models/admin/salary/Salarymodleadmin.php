<?php

/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class Salarymodleadmin extends CI_Model{
    
    private $_table = "salaryconfig";

    public function __construct() {
        parent::__construct();
    }
    
     public function addSalaryInfo($data){
//        print_r($data); exit;
        
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();       
        
    } 
    
     public function getSalaryInfo(){
//        $this->db->order_by("id", "asc");
        $qu = $this->db->get($this->_table);
        return $qu->result_array();
    }
    
    public function getSalaryInfoArray(){
        $this->db->select('salaryconfigId, employeeId');
        $this->db->order_by("employeeId", "asc");
        $qu = $this->db->get($this->_table);
        return $qu->result_array();
        
    }
    
    public function editSalaryInfo($id){
        $qu = $this->db->get_where($this->_table, array('salaryconfigId'=>$id));
        return $qu->row_array();
    }
    
    
    public function deleteSalaryInfo($id){
        $qu = $this->db->where('salaryconfigId', $id);
        $this->db->delete($this->_table);
        return $this->db->affected_rows();
        
    }
    
    
    public function updateSalaryInfo($data, $id){
        $qu = $this->db->where('salaryconfigId', $id);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows();
        
    }
    

//        public function getSalaryName($id){
//        $this->db->select('SalaryName');
//        $qu = $this->db->get_where($this->_table, array('salaryconfigId' => $id));
//        return $qu->result_array();  
//    
//    }
   

}
