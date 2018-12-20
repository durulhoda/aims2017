<?php

/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class ClassroomModleAdmin  extends CI_Model{
    
    private $_table = "room";

    public function __construct() {
        parent::__construct();
    }
    
    
    public function addClassroomInfo($data){
//        print_r($data); exit;
        
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();       
        
    }    
    
    
    
    public function getClassroomInfo(){
//        $this->db->order_by("id", "asc");
        $qu = $this->db->get($this->_table);
        return $qu->result_array();
    }
    
    public function getClassroomInfoArray(){
        $this->db->select('roomId, roomName');
        $this->db->order_by("roomName", "asc");
        $qu = $this->db->get($this->_table);
        return $qu->result_array();
        
    }
    
    public function editClassroomInfo($id){
        $qu = $this->db->get_where($this->_table, array('roomId'=>$id));
        return $qu->row_array();
    }
    
    
    public function deleteClassroomInfo($id){
        $qu = $this->db->where('roomId', $id);
        $this->db->delete($this->_table);
        return $this->db->affected_rows();
        
    }
    
    
    public function updateClassroomInfo($data, $id){
        $qu = $this->db->where('roomId', $id);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows();
        
    }
    

        public function getClassroomName($id){
        $qu = $this->db->get_where($this->_table, array('roomId' => $id)); 
        $result = $qu->row_array();
        return $result['roomName'];
    
    }
    public function duplicateClassroomInfo($data) {
//        $this->db->select('campusName');        
        $qu = $this->db->get_where($this->_table, array('roomName' => $data['roomName'],'campusId' => $data['campusId'],'buildingId' => $data['buildingId']));
        $reault = $qu->row_array();
        return $reault;
    }
    
    
}

