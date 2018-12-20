<?php

/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class InventoryLossModleAdmin extends CI_Model{
    //put your code here

     private $_inventoryloss = "inventoryloss";
     
    public function __construct() {
        parent::__construct();
    }
  
    public function addInventoryLoss($data){
//        print_r($data); exit;
        $this->db->insert($this->_inventoryloss, $data);
        return $this->db->insert_id();       
        
    }    
    public function getinventorylossList(){
         
        $result = $this->db->get($this->_inventoryloss);
        return $result->result_array();  
    }
   
     public function editinventoryloss($id) {
        $qu = $this->db->get_where($this->_inventoryloss, array('lossId' => $id));
        return $qu->row_array();
    }
    
    public function updateinventorylossInfo($data, $id) {

        $qu = $this->db->where('lossId', $id);
        $this->db->update($this->_inventoryloss, $data);
        return $this->db->affected_rows();
    }

    public function deleteinventorylossInfo($id) {
        $qu = $this->db->where('lossId', $id);
        $this->db->delete($this->_inventoryloss);
        return $this->db->affected_rows();
    }
    
    
    
}


