<?php

/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class TransportFeesModleAdmin extends CI_Model{
    //put your code here
     private $_table = "transportfees";
     private $_transportroot = "transportroot";

    public function __construct() {
        parent::__construct();
    }
    
    
    public function addTransportfees($data){
//        print_r($data); exit;
        
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();       
        
    }    
    public function getTransportRootList(){
         
        $result = $this->db->get($this->_transportroot);
        return $result->result_array();  
    }
     public function getTransportRoot($id) {
//        $this->db->select('campusName');        
        $qu = $this->db->get_where($this->_transportroot, array('rootId' => $id));
        $reault = $qu->row_array();
        return $reault['transportRoot'];

    }
     
    public function getTransportFeeslist(){
         
        $result = $this->db->get($this->_table);
        return $result->result_array();  
    }
   
     public function editTransportFees($id) {
        $qu = $this->db->get_where($this->_table, array('transportfeesId' => $id));
        return $qu->row_array();
    }
    
 

    public function updateTransportFees($data, $id) {

        $qu = $this->db->where('transportfeesId', $id);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows();
    }
    public function deleteTransportFees($id) {
        $qu = $this->db->where('transportfeesId', $id);
        $this->db->delete($this->_table);
        return $this->db->affected_rows();
    }
    
    
     public function duplicateTransportfees($data) {
//        $this->db->select('campusName');        
        $qu = $this->db->get_where($this->_table, array('categoryId' => $data['categoryId'],'transportId' => $data['transportId'],'rootId' => $data['rootId'],'transportFees' => $data['transportFees']));
        $reault = $qu->row_array();
        return $reault;
    }
    
  
    
    
    
     

    
    

}


