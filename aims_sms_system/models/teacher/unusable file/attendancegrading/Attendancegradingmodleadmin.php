<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of gradingModleAdmin
 *
 * @author Binita
 */
class AttendanceGradingModleAdmin extends CI_Model {
    
    //put your code here
     private $_table = "attendancegrading";

    public function __construct() {
        parent::__construct();
    }
    
    
    public function addGradingInfo($data){
//        print_r($data); exit;
        
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();       
        
    }
    
    public function gradinglist(){
        $qu = $this->db->get($this->_table);
        return $qu->result_array();
    }
     public function duplicateGradingInfo($data) {
//        $this->db->select('campusName');        
        $qu = $this->db->get_where($this->_table, array('fromPercentage' => $data['fromPercentage'],'toPercentage' => $data['toPercentage'],'gradePoint' => $data['gradePoint'],'grade' => $data['grade'],'outOf' => $data['outOf']));
        $reault = $qu->row_array();
        return $reault;
    }
    
    public function editGradingInfo($id) {
        $qu = $this->db->get_where($this->_table, array('gradingId' => $id));
        return $qu->row_array();
    }

    public function updateGradingInfo($data, $id) {

        $qu = $this->db->where('gradingId', $id);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows();
    }

    public function deleteGradingInfo($id) {
        $qu = $this->db->where('gradingId', $id);
        $this->db->delete($this->_table);
        return $this->db->affected_rows();
    }
}

?>
