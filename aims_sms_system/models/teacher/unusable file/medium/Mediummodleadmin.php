<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of mediumModleAdmin
 *
 * @author Binita
 */
class MediumModleAdmin extends CI_Model {
    private $_table = "medium";

    public function __construct() {
        parent::__construct();
    }
    
    
    public function addMediumInfo($data){
//        print_r($data); exit;
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();       
        
    }
    
    public function getMediumInfo(){
        $qu = $this->db->get($this->_table);
        return $qu->result_array();
    }
    
    /*
     * return arrry
     * all lists
     */
    
    public function getlistMedium(){
         
        $result = $this->db->get($this->_table);
        return $result->result_array();  
    }

    

    public function getMediumInfoArray(){
        
        $this->db->select('mediumId ,mediumName');
        $result = $this->db->get($this->_table);
        return $result->result_array();   
    }
    
    
        public function editMediumInfo($id) {
        $qu = $this->db->get_where($this->_table, array('mediumId' => $id));
        return $qu->row_array();
    }

    public function updateMediumInfo($data, $id) {

        $qu = $this->db->where('mediumId', $id);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows();
    }

    public function deleteMediumInfo($id) {
        $qu = $this->db->where('mediumId', $id);
        $this->db->delete($this->_table);
        return $this->db->affected_rows();
    }
    
    public function mediumName($id) {
        
        $qu = $this->db->get_where($this->_table, array('mediumId' => $id));        
        $result = $qu->row_array();
        return $result['mediumName'];
        }
        
     public function duplicateMediumInfo($data) {
//        $this->db->select('campusName');        
        $qu = $this->db->get_where($this->_table, array('mediumName' => $data['mediumName']));
        $reault = $qu->row_array();
        return $reault;
    }
   
}
