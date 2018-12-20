<?php

/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class CoursecategoryModleAdmin extends CI_Model{
    //put your code here
     private $_table = "coursecategory";

    public function __construct() {
        parent::__construct();
    }
    
    
    public function addCoursecategoryInfo($data){
//        print_r($data); exit;
        
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();       
        
    }    
    
    
    
    public function getCoursecategoryInfoArray(){
        $this->db->select('categoryID,categoryName');
        $result = $this->db->get($this->_table);
        return $result->result_array();
//        $this->db->order_by("id", "asc");
     
    }
    
    public function getCourseInfoArray(){
         $this->db->select('categoryID, categoryName');
        $this->db->order_by("categoryName", "asc");
        $qu = $this->db->get($this->_table);
        return $qu->result_array();
    }
    public function searchcoursecategorylist(){
//        $this->db->order_by("id", "asc");
        $qu = $this->db->get($this->_table);
        return $qu->result_array();
    }
    
    public function editcoursecategory($id) {
        $qu = $this->db->get_where($this->_table, array('categoryID' => $id));
        return $qu->row_array();
    }

    public function updatecoursecategoryInfo($data, $id) {

        $qu = $this->db->where('categoryID', $id);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows();
    }

    public function deletecoursecategoryInfo($id) {
        $qu = $this->db->where('categoryID', $id);
        $this->db->delete($this->_table);
        return $this->db->affected_rows();
    }
    
     public function duplicatecoursecategoryInfo($data) {
//        $this->db->select('campusName');        
        $qu = $this->db->get_where($this->_table, array('categoryName' => $data['categoryName']));
        $reault = $qu->row_array();
        return $reault;
    }
}


