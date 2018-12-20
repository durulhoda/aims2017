<?php

/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class BookrequirementModleAdmin extends CI_Model {
    
     private $_table = "booksrequirement";

    public function __construct() {
        parent::__construct();
    }
    
    
    public function addBookrequirement($data){
//        print_r($data); exit;
        $data['dateadd'] = date('d/m/Y');
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();       
        
    }
    
    
    public function getBookrequirementlist(){
        
       
       $this->db->order_by("bookName", "asc");
        $qu = $this->db->get($this->_table);
        return $qu->result_array();
    }
    
       
    public function editbookrequirement($id){
        $qu = $this->db->get_where($this->_table, array('requirementId'=>$id));
        return $qu->row_array();
    }

    
    public function deletebookrequirement($id){
        $qu = $this->db->where('requirementId', $id);
        $this->db->delete($this->_table);
        return $this->db->affected_rows();
        
    }
    
    
    public function updatebookrequirement($data, $id){
        $qu = $this->db->where('requirementId', $id);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows();
        
    }
     public function duplicateBookrequirement($data) {
//        $this->db->select('campusName');        
        $qu = $this->db->get_where($this->_table, array('bookName' => $data['bookName'], 'bookauthor' => $data['bookauthor']));
        $reault = $qu->row_array();
        return $reault;
    }
}


