<?php
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class ExamTypeModleAdmin extends CI_Model {
    
     private $_table = "examtype";
     private $_tablemarkcat = "mark_category";

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
    
        public function getOBList(){
        $this->db->select('mark_cat_id, category_title');
        $this->db->order_by("mark_cat_id", "ASC");
        $qu = $this->db->get($this->_tablemarkcat);
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
    
         public function checkExamtypeInfo($id) {
        $this->db->select('exm.*,sut_mark.*');

        $this->db->from('examtype exm');
        $this->db->join('studentmarks sut_mark', 'exm.examtypeId = sut_mark.examtypeId');

        $this->db->where('sut_mark.examtypeId', $id);

        $query = $this->db->get();
        $result = $query->result_array();
        if (!empty($result)) {
            return $result;
        }
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

