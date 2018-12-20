<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CourseModelAdmin
 *
 * @author Binita
 */
class InventoryStockModleAdmin extends CI_Model{
    //put your code here

     private $_inventorystock = "inventorystock";
     
    public function __construct() {
        parent::__construct();
    }
  
    public function addInventoryStock($data){
//        print_r($data); exit;
        $this->db->insert($this->_inventorystock, $data);
        return $this->db->insert_id();       
        
    }    
    public function getinventorystockList(){
         
        $result = $this->db->get($this->_inventorystock);
        return $result->result_array();  
    }
   
     public function editinventorystock($id) {
        $qu = $this->db->get_where($this->_inventorystock, array('stockId' => $id));
        return $qu->row_array();
    }
    
    public function updateinventorystockInfo($data, $id) {

        $qu = $this->db->where('stockId', $id);
        $this->db->update($this->_inventorystock, $data);
        return $this->db->affected_rows();
    }

    public function deleteinventorystockInfo($id) {
        $qu = $this->db->where('stockId', $id);
        $this->db->delete($this->_inventorystock);
        return $this->db->affected_rows();
    }
    
    
    
}


