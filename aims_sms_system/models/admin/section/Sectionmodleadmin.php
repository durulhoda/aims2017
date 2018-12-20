<?php

/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class SectionModleAdmin extends CI_Model{
     private $_table = "section";

    public function __construct() {
        parent::__construct();
    }
    
    
    public function addSectionInfo($data){
//        print_r($data); exit;
        
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();       
        
    }

      
    public function getlistSection(){
         
        $result = $this->db->get($this->_table);
        return $result->result_array();  
    }

    

    public function getSectionInfoArray(){
        
        $this->db->select('sectionId ,sectionName');
        $result = $this->db->get($this->_table);
        return $result->result_array();   
    }
    
    
        public function editSectionInfo($id) {
        $qu = $this->db->get_where($this->_table, array('sectionId' => $id));
        return $qu->row_array();
    }

    public function updateSectionInfo($data, $id) {

        $qu = $this->db->where('sectionId', $id);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows();
    }

    public function deleteSectionInfo($id) {
        $qu = $this->db->where('sectionId', $id);
        $this->db->delete($this->_table);
        return $this->db->affected_rows();
    }
    
    public function checkSectionInfo($id){
        $this->db->select('sec.*,prog_offer.*');
        
        $this->db->from('section sec');
        $this->db->join('programoffer prog_offer', 'sec.sectionId = prog_offer.sectionId');
       
           $this->db->where('prog_offer.sectionId', $id);
           
        $query = $this->db->get();
        $result = $query->result_array();
        if (!empty($result)) {
            return $result;
        }
    }
    public function getsectionName($id){
        $this->db->where('sectionId', $id);
        $qu = $this->db->get($this->_table);
       $result = $qu->row_array();
        return $result['sectionName'];
        
    }
    
     public function duplicateSectionInfo($data) {
//        $this->db->select('campusName');        
        $qu = $this->db->get_where($this->_table, array('sectionName' => $data['sectionName']));
        $reault = $qu->row_array();
        return $reault;
    }

    
}


