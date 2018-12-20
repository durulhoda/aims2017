<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of groupModleAdmin
 *
 * @author Binita
 */
class PeriodModleAdmin extends CI_Model {
    
    private $_table = "period";

    public function __construct() {
        parent::__construct();
    }
    
    
    public function addPeriodInfo($data){
//        print_r($data); exit;
        
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();       
        
    }
    
   public function getlistPeriod(){
         
        $result = $this->db->get($this->_table);
        return $result->result_array();  
    }
    
    public function getPeriodInfoArray(){
        $this->db->select('*');
//        $this->db->order_by("groupName", "asc");
        $qu = $this->db->get($this->_table);
        return $qu->result_array();
        
    }
    
     public function editPeriodInfo($id) {
        $qu = $this->db->get_where($this->_table, array('periodId' => $id));
        return $qu->row_array();
    }

    public function updatePeriodInfo($data, $id) {

        $qu = $this->db->where('periodId', $id);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows();
    }

    public function deletePeriodInfo($id) {
        $qu = $this->db->where('periodId', $id);
        $this->db->delete($this->_table);
        return $this->db->affected_rows();
    }
    
    public function getPeriodTime($shiftId,$periodId){
        $result = $this->db->get_where($this->_table, array('shiftId'=>$shiftId,'periodId'=>$periodId));
        $result_info =  $result->row_array(); 
        if(!empty($result_info['periodTime']))
        {
            return $result_info['periodTime'];        
        }
        
    }
    
    public function duplicatePeriodInfo($data) {
//        $this->db->select('campusName');        
        $qu = $this->db->get_where($this->_table, array('periodName' => $data['periodName'],'shiftId' => $data['shiftId'],'periodTime' => $data['periodTime']));
        $reault = $qu->row_array();
        return $reault;
    }
}
 

