<?php

/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class BookcategoryModleAdmin extends CI_Model {
    
     private $_table = "bookcategory";

    public function __construct() {
        parent::__construct();
    }
    
    
    public function addBookcategory($data){
//        print_r($data); exit;
        
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();       
        
    }
    
    
    public function getBookcategorylist(){
        $this->db->order_by("bookCategoryName", "asc");
        $qu = $this->db->get($this->_table);
        return $qu->result_array();
    }
    
    public function getBookCategoryNames($bookcategoryId){               
        $qu = $this->db->get_where($this->_table,  array('bookcategoryId'=>$bookcategoryId)); 
         $reault = $qu->row_array();        
        return $reault['bookCategoryName'];
    }
    
    public function getSelfStatus($bookCategoryName){            
      $this->db->select('*');
        $qu = $this->db->get_where($this->_table, array('bookCategoryName' => $bookCategoryName));
        return $qu->result_array(); 
        
    }
    
    
    public function getBookCategoryArray(){
        $this->db->select('*');
        $this->db->distinct();
        $this->db->group_by('bookCategoryName');
        $this->db->order_by("bookCategoryName", "asc");
        $qu = $this->db->get($this->_table);
        return $qu->result_array();
        
    }
    
    
    public function editbookcategory($id){
        $qu = $this->db->get_where($this->_table, array('bookcategoryId'=>$id));
        return $qu->row_array();
    }

    
    public function deletebookcategory($id){
        $qu = $this->db->where('bookcategoryId', $id);
        $this->db->delete($this->_table);
        return $this->db->affected_rows();
        
    }
    
    
    public function updatebookcategory($data, $id){
        $qu = $this->db->where('bookcategoryId', $id);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows();
        
    }
     public function duplicateBookcategory($data) {
//        $this->db->select('campusName');        
        $qu = $this->db->get_where($this->_table, array('bookCategoryName' => $data['bookCategoryName'], 'selfId' => $data['selfId']));
        $reault = $qu->row_array();
        return $reault;
    }
}


