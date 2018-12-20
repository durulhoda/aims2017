<?php

/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class Buildingmodleadmin extends CI_Model {
    
     private $_table = "building";

    public function __construct() {
        parent::__construct();
    }
    
    
    public function addBuildingInfo($data){
//        print_r($data); exit;
        
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();       
        
    }
    
    
    public function getBuildingInfo(){
        $qu = $this->db->get($this->_table);
        return $qu->result_array();
    }
    
    
    public function editBuildingInfo($id){
        $qu = $this->db->get_where($this->_table, array('buildingId'=>$id));
        return $qu->row_array();
    }

    
    
    public function getBuildingInforeArray(){
        $this->db->select('buildingId, buildingName');
        $this->db->order_by("buildingName", "asc");
        $qu = $this->db->get($this->_table);
        return $qu->result_array();
        
    }
    
    
    public function getBuildingName($buildingId){               
        $qu = $this->db->get_where($this->_table,  array('buildingId'=>$buildingId)); 
         $reault = $qu->row_array();        
        return $reault['buildingName'];
    }
    
    
    public function deleteBuildingInfo($id){
        $qu = $this->db->where('buildingId', $id);
        $this->db->delete($this->_table);
        return $this->db->affected_rows();
        
    }
    
    
    public function updateBuildingInfo($data, $id){
        $qu = $this->db->where('buildingId', $id);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows();
        
    }
     public function duplicateBuildingInfo($data) {
//        $this->db->select('campusName');        
        $qu = $this->db->get_where($this->_table, array('buildingName' => $data['buildingName'], 'campusId' => $data['campusId']));
        $reault = $qu->row_array();
        return $reault;
    }
}


