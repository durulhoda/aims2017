<?php

/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class TransportRootModleAdmin extends CI_Model{
    //put your code here
     private $_table = "transportroot";
     private $_transport = "transport";

    public function __construct() {
        parent::__construct();
    }
    
    
    public function addTransportroot($data){
//        print_r($data); exit;
        
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();       
        
    }    
    public function getTransportNameList(){
         
        $result = $this->db->get($this->_transport);
        return $result->result_array();  
    }
     public function getTransportName($id) {
//        $this->db->select('campusName');        
        $qu = $this->db->get_where($this->_transport, array('transportId' => $id));
        $reault = $qu->row_array();
        return $reault['transportName'];

    }
     
    public function getTransportRootlist(){
         
        $result = $this->db->get($this->_table);
        return $result->result_array();  
    }
   
     public function editTransportRoot($id) {
        $qu = $this->db->get_where($this->_table, array('rootId' => $id));
        return $qu->row_array();
    }
    
 

    public function updateTransportRoot($data, $id) {

        $qu = $this->db->where('rootId', $id);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows();
    }

    public function deleteTransportRoot($id) {
        $qu = $this->db->where('rootId', $id);
        $this->db->delete($this->_table);
        return $this->db->affected_rows();
    }
    
     public function duplicateTransportRoot($data) {
//        $this->db->select('campusName');        
        $qu = $this->db->get_where($this->_table, array('categoryId' => $data['categoryId'],'transportId' => $data['transportId'],'transportRoot' => $data['transportRoot']));
        $reault = $qu->row_array();
        return $reault;
    }
    
  
    
    
    
     

    
    

}


