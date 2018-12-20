<?php

/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class CurriculumModleAdmin extends CI_Model {
      private $_table = "curriculum";

    public function __construct() {
        parent::__construct();
    }
    
     public function addCurriculumInfo($data){
        
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();       
        
    }
    
    public function getlistCurriculum(){
         
        $result = $this->db->get($this->_table);
        return $result->result_array();  
    }

    

    public function getCurriculumInfoArray(){
        
        $this->db->select('curriculumId,curriculumName');
        $result = $this->db->get($this->_table);
        return $result->result_array();   
    }
    
    
        public function editCurriculumInfo($id) {
        $qu = $this->db->get_where($this->_table, array('curriculumId' => $id));
        return $qu->row_array();
    }

    public function updateCurriculumInfo($data, $id) {

        $qu = $this->db->where('curriculumId', $id);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows();
    }

    public function deleteCurriculumInfo($id) {
        $qu = $this->db->where('curriculumId', $id);
        $this->db->delete($this->_table);
        return $this->db->affected_rows();
    }
    //put your code here
    
    public function duplicateCurriculumInfo($data) {
//        $this->db->select('campusName');        
        $qu = $this->db->get_where($this->_table, array('curriculumName' => $data['curriculumName']));
        $reault = $qu->row_array();
        return $reault;
    }
}


