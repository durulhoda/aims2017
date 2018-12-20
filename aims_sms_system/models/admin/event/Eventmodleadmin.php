<?php

/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class EventModleAdmin  extends CI_Model {
      private $_table = "eventschedule";

    public function __construct() {
        parent::__construct();
    }
    
    public function addEventInfo($data){
        
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();       
        
    }
     public function eventvalidation($data) {
        
        $this->db->select('*');
        $this->db->where('startdate',$data['startdate']);
        $this->db->where('description',$data['description']);
        
        $result = $this->db->get($this->_table);
        return $result->row_array();   
        
       
    }
    
    public function showmonthlyevent($month) {
        $this->db->select('*');
         $this->db->where('month',$month);
        $this->db->order_by('startdate','ASC');
        $result = $this->db->get($this->_table);
        return $result->result_array();   
        
       
    }
    
    
    public function getlistEventschedule(){
         
        $result = $this->db->get($this->_table);
        return $result->result_array();  
    }

    

    public function getEventscheduleInfoArray(){
        
        $this->db->select('eventId,eventName');
        $result = $this->db->get($this->_table);
        return $result->result_array();   
    }
    
    
        public function editEventscheduleInfo($id) {
        $qu = $this->db->get_where($this->_table, array('eventId' => $id));
        return $qu->row_array();
    }

    public function updateEventscheduleInfo($data, $id) {

        $qu = $this->db->where('eventId', $id);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows();
    }

    public function deleteEventscheduleInfo($id) {
        $qu = $this->db->where('eventId', $id);
        $this->db->delete($this->_table);
        return $this->db->affected_rows();
    }
    
}

