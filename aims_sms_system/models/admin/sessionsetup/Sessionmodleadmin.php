<?php
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class SessionModleAdmin extends CI_Model{
     private $_table = "session";

    public function __construct() {
        parent::__construct();
    }
    
    
    public function addSessionInfo($data){
//        print_r($data); exit;
        
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();       
        
    }

      
    public function getlistSession(){
         
        $result = $this->db->get($this->_table);
        return $result->result_array();  
    }

    

    public function getSessionInfoArray(){
        
        $this->db->select('sessionId ,session');
        $result = $this->db->get($this->_table);
        return $result->result_array();   
    }
    
    
        public function editSessionInfo($id) {
        $qu = $this->db->get_where($this->_table, array('sessionId' => $id));
        return $qu->row_array();
    }

    public function updateSessionInfo($data, $id) {

        $qu = $this->db->where('sessionId', $id);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows();
    }

    public function deleteSessionInfo($id) {
        $qu = $this->db->where('sessionId', $id);
        $this->db->delete($this->_table);
        return $this->db->affected_rows();
    }
    
    public function checkSessionInfo($id){
        $this->db->select('ses.*,prog_offer.*');
        
        $this->db->from('session ses');
        $this->db->join('programoffer prog_offer', 'ses.sessionId = prog_offer.sessionId');
       
           $this->db->where('prog_offer.sessionId', $id);
           
        $query = $this->db->get();
        $result = $query->result_array();
        if (!empty($result)) {
            return $result;
        }
    }
    
    public function getsession($id){
        $this->db->where('sessionId', $id);
        $qu = $this->db->get($this->_table);
        $result = $qu->row_array();
        return $result['session'];
        
    }
     public function duplicateSessionInfo($data) {
//        $this->db->select('campus');        
        $qu = $this->db->get_where($this->_table, array('session' => $data['session']));
        $reault = $qu->row_array();
        return $reault;
    }

    
}


