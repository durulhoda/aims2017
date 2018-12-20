<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ExamTypeModleAdmin
 *
 * @author Binita
 */
class ExamTypeModleAdmin extends CI_Model {
    
     private $_table = "examtype";

    public function __construct() {
        parent::__construct();
    }
    
    
    public function addExamTypeInfo($data){
//        print_r($data); exit;
        
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();       
        
    }
    
public function getExamTypeInfo(){
        $this->db->order_by("examtypeName", "asc");
        $qu = $this->db->get($this->_table);
        return $qu->result_array();
    }
    
    public function getExamList(){
        $this->db->select('examtypeId, examtypeName');
        $this->db->order_by("examtypeName", "asc");
        $qu = $this->db->get($this->_table);
        return $qu->result_array();
        
    }
    
    public function editExamTypeInfo($id){
        $qu = $this->db->get_where($this->_table, array('examtypeId'=>$id));
        return $qu->row_array();
    }
    
    
    public function deleteExamTypeInfo($id){
        $qu = $this->db->where('examtypeId', $id);
        $this->db->delete($this->_table);
        return $this->db->affected_rows();
        
    }
    
    
    public function updateExamTypeInfo($data, $id){
        $qu = $this->db->where('examtypeId', $id);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows();
        
    }
    

        public function getExamTypeName($id){
        $result = $this->db->get_where($this->_table, array('examtypeId'=>$id));
        $result_info =  $result->row_array(); 
        return $result_info['examtypeName'];      
        
    
    }//put your code here
    public function duplicateExamTypeInfo($data) {
//        $this->db->select('campusName');        
        $qu = $this->db->get_where($this->_table, array('examtypeName' => $data['examtypeName']));
        $reault = $qu->row_array();
        return $reault;
    }
}

