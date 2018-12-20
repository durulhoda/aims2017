<?php
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class DisciplineModleAdmin extends CI_Model {
    
     private $_table = "disciplinecomment";

    public function __construct() {
        parent::__construct();
    }
    
    
    public function addDisciplinecomments($data){
//        print_r($data); exit;
        
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();       
        
    }
    
public function getDisciplinecomments(){
//        $this->db->order_by("id", "asc");
        $this->db->order_by("comment_Id", "desc");
        $qu = $this->db->get($this->_table);
        
        return $qu->result_array();
    }
    
   
    public function editDisciplinecomments($id){
        $qu = $this->db->get_where($this->_table, array('comment_Id'=>$id));
        return $qu->row_array();
    }
    
    
    public function deleteDisciplinecomments($id){
        $qu = $this->db->where('comment_Id', $id);
        $this->db->delete($this->_table);
        return $this->db->affected_rows();
        
    }
    
    
    public function updateDisciplinecomments($data, $id){
        $qu = $this->db->where('comment_Id', $id);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows();
        
    }
    
}

