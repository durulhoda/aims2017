<?php

/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class BooklostModleAdmin extends CI_Model {
    
     private $_table = "booklost";

    public function __construct() {
        parent::__construct();
    }
    
    
    public function addBooklost($data){
//        print_r($data); exit;
        $data['lostDate'] = date('d/m/Y');
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();       
        
    }
    
    
    public function getBooklost(){
        
       
       $this->db->order_by("lostDate", "asc");
        $qu = $this->db->get($this->_table);
        return $qu->result_array();
    }
    
       
    public function editbooklost($id){
        $qu = $this->db->get_where($this->_table, array('lostId'=>$id));
        return $qu->row_array();
    }

    
    public function deletebooklost($id){
        $qu = $this->db->where('lostId', $id);
        $this->db->delete($this->_table);
        return $this->db->affected_rows();
        
    }
    
    
    public function updatebooklost($data, $id){
        $qu = $this->db->where('lostId', $id);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows();
        
    }
     public function duplicateBooklost($data) {
//        $this->db->select('campusName');        
        $qu = $this->db->get_where($this->_table, array('bookName' => $data['bookName'], 'bookauthor' => $data['bookauthor']));
        $reault = $qu->row_array();
        return $reault;
    }
}


