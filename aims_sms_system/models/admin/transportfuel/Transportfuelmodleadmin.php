<?php

/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class TransportFuelModleAdmin extends CI_Model{
    //put your code here
     private $_table = "transportfuel";
     
    public function __construct() {
        parent::__construct();
    }
    
    
    public function addTransportfuel($data){
//        print_r($data); exit;
        
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();       
        
    }    
     
    public function getTransportFuellist(){
         
        $result = $this->db->get($this->_table);
        return $result->result_array();  
    }
   
     public function editTransportFuel($id) {
        $qu = $this->db->get_where($this->_table, array('transportfuelId' => $id));
        return $qu->row_array();
    }
    
 

    public function updateTransportFuel($data, $id) {

        $qu = $this->db->where('transportfuelId', $id);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows();
    }
    
     public function deleteTransportFuel($id) {
        $qu = $this->db->where('transportfuelId', $id);
        $this->db->delete($this->_table);
        return $this->db->affected_rows();
    }
    
     public function duplicateTransportfuel($data) {
//        $this->db->select('campusName');        
        $qu = $this->db->get_where($this->_table, array('transportId' => $data['transportId'],'date' => $data['date']));
        $reault = $qu->row_array();
        return $reault;
    }
    
  
    
    
    
     

    
    

}


