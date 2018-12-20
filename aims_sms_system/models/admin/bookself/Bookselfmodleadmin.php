<?php

/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class BookselfModleAdmin extends CI_Model {
    
     private $_table = "bookself";

    public function __construct() {
        parent::__construct();
    }
    
    
    public function addBookselfInfo($data){
//        print_r($data); exit;
        
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();       
        
    }
    
    
    public function getBookselfInfo(){
        $this->db->order_by("selfName", "asc");
        $qu = $this->db->get($this->_table);
        return $qu->result_array();
    }
    
    public function getSelfNames($selfId){               
        $qu = $this->db->get_where($this->_table,  array('selfId'=>$selfId)); 
         $reault = $qu->row_array();        
        return $reault['selfName'];
    }
     
    public function getSelfInfoArray(){
        $this->db->select('*');
        $this->db->order_by("selfName", "asc");
        $qu = $this->db->get($this->_table);
        return $qu->result_array();
        
    }
    
    
    public function editBookselfInfo($id){
        $qu = $this->db->get_where($this->_table, array('selfId'=>$id));
        return $qu->row_array();
    }

    
    public function deleteBookselfInfo($id){
        $qu = $this->db->where('selfId', $id);
        $this->db->delete($this->_table);
        return $this->db->affected_rows();
        
    }
    
    
    public function updateBookselfInfo($data, $id){
        $qu = $this->db->where('selfId', $id);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows();
        
    }
     public function duplicateBookselfInfo($data) {
//        $this->db->select('campusName');        
        $qu = $this->db->get_where($this->_table, array('selfName' => $data['selfName']));
        $reault = $qu->row_array();
        return $reault;
    }
}


