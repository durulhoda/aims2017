<?php

/*
* Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class BookborrowModleAdmin extends CI_Model {
    
     private $_table = "borrowbook";

    public function __construct() {
        parent::__construct();
    }
    
    
    public function addBorrowedbook($data){
//        print_r($data); exit;
        
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();       
        
    }
    
   
    public function getBookborrowlist($data){
        
       
        if(!empty($data)){
        
        $this->db->like('bookId',$data['bookId']);
        $this->db->like('studentId',$data['studentId']);
        
        $this->db->order_by("returnDate", "DESC");
        $qu = $this->db->get($this->_table);
        return $qu->result_array();
        }        
    }
  
   
   public function getBookCount($id){
         
        $this->db->select_sum('bookPiece');
        $this->db->where('bookId',$id);
        $query = $this->db->get($this->_table);
        $result = $query->result();

        return $result[0]->bookPiece;
    }
    public function editborrowedbook($id){
        $qu = $this->db->get_where($this->_table, array('borrowbookId'=>$id));
        return $qu->row_array();
    }

    
    public function deleteborrowedbook($id){
        $qu = $this->db->where('borrowbookId', $id);
        $this->db->delete($this->_table);
        return $this->db->affected_rows();
        
    }
    
    
    public function updateBorrowedbook($data, $id){
        $qu = $this->db->where('borrowbookId', $id);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows();
        
    }
     public function duplicateBorrowedbook($data) {
//        $this->db->select('campusName');        
        $qu = $this->db->get_where($this->_table, array('bookId' => $data['bookId'], 'studentId' => $data['studentId']));
        $reault = $qu->row_array();
        return $reault;
    }
}


