<?php
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class AdmidModleAdmin extends CI_Model {
    
    private $_table = "admidcardinfo";

    public function __construct() {
        parent::__construct();
    }
    
    
    public function addadmidInfo($data){
    
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();       
    }
       
    public function getadmidlist(){
        $this->db->select('add.*,prg.*');
        $this->db->from('admidcardinfo add');
        $this->db->join('programoffer prg', 'add.programofferId=prg.programofferId');
      
           $query = $this->db->get();
        $result = $query->result_array();
        if (!empty($result)) {
            return $result;
        }
        
    }
    
    public function getadmidinfo($programOfferId){
        $this->db->select('add.*,prg.*');
        $this->db->from('admidcardinfo add');
        $this->db->join('programoffer prg', 'add.programofferId=prg.programofferId');
        $this->db->where('add.programofferId', $programOfferId);
           $query = $this->db->get();
        $result = $query->row_array();
        if (!empty($result)) {
            return $result;
        }
        
    }
    public function getQuataName($id){
       
         $qu = $this->db->get_where($this->_table, array('quata_id' => $id));        
        $result = $qu->row_array();
        if(!empty($result['quata'])){
            return $result['quata'];
        }
    }
    public function duplicateadmidInfo($data) {
//        $this->db->select('campusName');        
        $qu = $this->db->get_where($this->_table, array('quata' => $data['quata']));
        $reault = $qu->row_array();
        return $reault;
    }
       public function editinfo($id) {
        $qu = $this->db->get_where($this->_table, array('id' => $id));
        return $qu->row_array();
    }

    public function updateadmidInfo($data, $id) {

        $qu = $this->db->where('id', $id);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows();
    }

    public function deleteadmidInfo($id) {
        $qu = $this->db->where('id', $id);
        $this->db->delete($this->_table);
        return $this->db->affected_rows();
    }
    
         public function checkQuataInfo($id){
        $this->db->select('qut.*,stuinfo.*');
        
        $this->db->from('quata qut');
        $this->db->join('studentinfo stuinfo', 'qut.quata_id = stuinfo.quata_id');
       
           $this->db->where('stuinfo.quata_id', $id);
           
        $query = $this->db->get();
        $result = $query->result_array();
        if (!empty($result)) {
            return $result;
        }
    }
    
}


