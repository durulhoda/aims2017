<?php

/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class BookModleAdmin extends CI_Model {
    
     private $_table = "bookinfo";

    public function __construct() {
        parent::__construct();
    }
    
    
    public function addBook($data){
//        print_r($data); exit;
        
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();       
        
    }
    
    
    public function getBooklist($data){
        
       
        if(!empty($data)){
        
        $this->db->like('bookCategory',$data['bookCategory']);
        $this->db->like('bookName',$data['bookName']);
        $this->db->like('bookauthor',$data['bookauthor']);
        
        $this->db->order_by("bookName", "asc");
        $qu = $this->db->get($this->_table);
        return $qu->result_array();
        }        
    }
    
    public function getBookNames($bookId){               
        $qu = $this->db->get_where($this->_table,  array('bookId'=>$bookId)); 
         $reault = $qu->row_array();        
        return $reault['bookName'];
    }
    
    public function getBookArray(){
        $this->db->select('*');
        $this->db->order_by("bookName", "asc");
        $qu = $this->db->get($this->_table);
        return $qu->result_array();
        
    }
     
    public function getBookwriterArray(){
        $this->db->select('*');
        $this->db->order_by("bookauthor", "asc");
        $qu = $this->db->get($this->_table);
        return $qu->result_array();
        
    }
   
    public function editbook($id){
        $qu = $this->db->get_where($this->_table, array('bookId'=>$id));
        return $qu->row_array();
    }

    
    public function deletebook($id){
        $qu = $this->db->where('bookId', $id);
        $this->db->delete($this->_table);
        return $this->db->affected_rows();
        
    }
    
    
    public function updatebook($data, $id){
        $qu = $this->db->where('bookId', $id);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows();
        
    }
     public function duplicateBook($data) {
//        $this->db->select('campusName');        
        $qu = $this->db->get_where($this->_table, array('bookName' => $data['bookName'], 'bookauthor' => $data['bookauthor'], 'bookCategory' => $data['bookCategory'], 'bookavailable' => $data['bookavailable']));
        $reault = $qu->row_array();
        return $reault;
    }
}


