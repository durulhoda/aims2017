<?php

/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class BatchModleAdmin  extends CI_Model{
    
    private $_table = "batch";

    public function __construct() {
        parent::__construct();
    }
    
     public function addBatchInfo($data){
//        print_r($data); exit;
        
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();       
        
    }    
    
    
    
    public function getBatchInfo(){
//        $this->db->order_by("id", "asc");
        $qu = $this->db->get($this->_table);
        return $qu->result_array();
    }
    
    public function getBatchInfoArray(){
        $this->db->select('batchId, batchName');
        $this->db->order_by("batchName", "asc");
        $qu = $this->db->get($this->_table);
        return $qu->result_array();
        
    }
    
    public function editBatchInfo($id){
        $qu = $this->db->get_where($this->_table, array('batchId'=>$id));
        return $qu->row_array();
    }
    
    
    public function deleteBatchInfo($id){
        $qu = $this->db->where('batchId', $id);
        $this->db->delete($this->_table);
        return $this->db->affected_rows();
        
    }
    
    
    public function updateBatchInfo($data, $id){
        $qu = $this->db->where('batchId', $id);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows();
        
    }
    

        public function getbatchName($id){
        $this->db->select('batchName');
        $qu = $this->db->get_where($this->_table, array('batchId' => $id));
        return $qu->result_array();  
    
    }
    public function duplicateSectionInfo($data) {
//        $this->db->select('campusName');        
        $qu = $this->db->get_where($this->_table, array('batchName' => $data['batchName'],'sessionId' => $data['sessionId']));
        $reault = $qu->row_array();
        return $reault;
    }

     
    
}