<?php

/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class Shiftmodleadmin extends CI_Model {
    
     private $_table = "shift";
     private $_upozila = "upozila";

    public function __construct() {
        parent::__construct();
    }
    
    
    public function addShiftInfo($data){

        
        $data['startTime'] = date('H:i:s', strtotime($data['startTime']));
        $data['endTime'] = date('H:i:s', strtotime($data['endTime']));
        
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();       
        
    }
    
    public function getlistShift(){
         
        $result = $this->db->get($this->_table);
        return $result->result_array();  
    }

    
    public function getupozilaArray($id){
        
        $this->db->select('districtid ,Upozila');
       // $this->db->where('districtid', $id);
     //   $this->db->group_by('districtid');
         $this->db->order_by('districtid','ASC');
        $result = $this->db->get($this->_upozila);
        return $result->result_array();   
    }
    
    
    
    public function getShiftInfoArray(){
        
        $this->db->select('shiftId ,shiftName');
        $result = $this->db->get($this->_table);
        return $result->result_array();   
    }
    
    
        public function editShiftInfo($id) {
        $qu = $this->db->get_where($this->_table, array('shiftId' => $id));
        return $qu->row_array();
    }

    public function updateShiftInfo($data, $id) {
        $data['startTime'] = date('H:i:s', strtotime($data['startTime']));
        $data['endTime'] = date('H:i:s', strtotime($data['endTime']));
        $qu = $this->db->where('shiftId', $id);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows();
    }

    public function deleteShiftInfo($id) {
        $qu = $this->db->where('shiftId', $id);
        $this->db->delete($this->_table);
        return $this->db->affected_rows();
    }
    
         public function checkShiftInfo($id) {
        $this->db->select('sft.*,prog_offer.*');

        $this->db->from('shift sft');
        $this->db->join('programoffer prog_offer', 'sft.shiftId = prog_offer.shiftId');

        $this->db->where('prog_offer.shiftId', $id);

        $query = $this->db->get();
        $result = $query->result_array();
        if (!empty($result)) {
            return $result;
        }
    }

    public function getShiftName($Id) {
//        $this->db->select('campusName');        
        $qu = $this->db->get_where($this->_table, array('shiftId' => $Id));
        $reault = $qu->row_array();
        return $reault['shiftName'];

    }
    public function duplicateshiftInfo($data, $id = 0) {
//        $this->db->select('campusName');    
        if ($id) {
            $qu = $this->db
                        ->where('shiftId !=', $id)
                        ->where('shiftName', $data['shiftName'])
                        ->get($this->_table);
        } else {
            $qu = $this->db->get_where($this->_table, array('shiftName' => $data['shiftName']));
        }
        
        $reault = $qu->row_array();
        return $reault;
    }
    //put your code here
}

