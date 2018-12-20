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
class InventoryModleAdmin extends CI_Model{
    //put your code here
     private $_table = "inventorycategory";
     private $_inventory = "inventory";
     private $_requirement = "inventoryrequirement";

    public function __construct() {
        parent::__construct();
    }
    
    
    public function addInventorycategoryInfo($data){
//        print_r($data); exit;
        
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();       
        
    }  
    public function addInventoryRequirement($data){
//        print_r($data); exit;
        
        $this->db->insert($this->_requirement, $data);
        return $this->db->insert_id();       
        
    } 
    
    public function getinventorycategoryList(){
         
        $result = $this->db->get($this->_table);
        return $result->result_array();  
    }
    public function getinventoryrequirementList(){
         
        $result = $this->db->get($this->_requirement);
        return $result->result_array();  
    }
    public function addInventory($data){
//        print_r($data); exit;
        $data['purchaseDate']=date('d-m-Y');
        $this->db->insert($this->_inventory, $data);
        return $this->db->insert_id();       
        
    }    
    public function getinventoryList(){
         
        $result = $this->db->get($this->_inventory);
        return $result->result_array();  
    }
    
    public function getinventoryName($Id) {
//        $this->db->select('campusName');        
        $qu = $this->db->get_where($this->_inventory, array('inventoryId' => $Id));
        $reault = $qu->row_array();
        return $reault['inventoryName'];

    }
    
     public function getinventorycategoryName($Id) {
//        $this->db->select('campusName');        
        $qu = $this->db->get_where($this->_table, array('categoryId' => $Id));
        $reault = $qu->row_array();
        return $reault['categoryName'];

    }
    
     public function editinventory($id) {
        $qu = $this->db->get_where($this->_inventory, array('inventoryId' => $id));
        return $qu->row_array();
    }
    
    public function updateinventoryInfo($data, $id) {

        $qu = $this->db->where('inventoryId', $id);
        $this->db->update($this->_inventory, $data);
        return $this->db->affected_rows();
    }

    public function deleteinventoryInfo($id) {
        $qu = $this->db->where('inventoryId', $id);
        $this->db->delete($this->_inventory);
        return $this->db->affected_rows();
    }
    
    
     public function edititemcategory($id) {
        $qu = $this->db->get_where($this->_table, array('categoryId' => $id));
        return $qu->row_array();
    }
    
    public function updateitemcategory($data, $id) {

        $qu = $this->db->where('categoryId', $id);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows();
    }

    public function deleteitemcategory($id) {
        $qu = $this->db->where('categoryId', $id);
        $this->db->delete($this->_table);
        return $this->db->affected_rows();
    }
    public function duplicateInventorycategoryInfo($data) {
//        $this->db->select('campusName');        
        $qu = $this->db->get_where($this->_table, array('categoryName' => $data['categoryName']));
        $reault = $qu->row_array();
        return $reault;
    }
    
     public function editrequirement($id) {
        $qu = $this->db->get_where($this->_requirement, array('inventoryId' => $id));
        return $qu->row_array();
    }
    
    public function updaterequirementInfo($data, $id) {

        $qu = $this->db->where('inventoryId', $id);
        $this->db->update($this->_requirement, $data);
        return $this->db->affected_rows();
    }

    public function deleterequirementInfo($id) {
        $qu = $this->db->where('inventoryId', $id);
        $this->db->delete($this->_requirement);
        return $this->db->affected_rows();
    }
   
    
    
     

    
    

}


