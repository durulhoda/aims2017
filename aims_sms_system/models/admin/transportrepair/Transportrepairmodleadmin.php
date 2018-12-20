<?php

/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class TransportRepairModleAdmin extends CI_Model{
    //put your code here
     private $_table = "transportrepair";
     
    public function __construct() {
        parent::__construct();
    }
    
    
    public function addTransportrepair($data){
//        print_r($data); exit;
        
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();       
        
    }    
     
    public function getTransportRepairlist(){
         
        $result = $this->db->get($this->_table);
        return $result->result_array();  
    }
   
     public function editTransportRepair($id) {
        $qu = $this->db->get_where($this->_table, array('transportrepairId' => $id));
        return $qu->row_array();
    }
    
 

    public function updateTransportRepair($data, $id) {

        $qu = $this->db->where('transportrepairId', $id);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows();
    }
    
     public function deleteTransportRepair($id) {
        $qu = $this->db->where('transportrepairId', $id);
        $this->db->delete($this->_table);
        return $this->db->affected_rows();
    }
    
     public function duplicateTransportrepair($data) {
//        $this->db->select('campusName');        
        $qu = $this->db->get_where($this->_table, array('transportId' => $data['transportId'],'date' => $data['date']));
        $reault = $qu->row_array();
        return $reault;
    }
    
  
    
    
    
     

    
    

}


