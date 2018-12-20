<?php

/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class HostelModleAdmin extends CI_Model{
    //put your code here
     private $_table = "hostelcategory";
     private $_hostel = "hostel";

    public function __construct() {
        parent::__construct();
    }
    
    
    public function addHostelcategoryInfo($data){
//        print_r($data); exit;
        
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();       
        
    }    
    
    public function getHostelcategoryList(){
         
        $result = $this->db->get($this->_table);
        return $result->result_array();  
    }
     public function getHostelcategoryName($id) {
//        $this->db->select('campusName');        
        $qu = $this->db->get_where($this->_table, array('categoryId' => $id));
        $reault = $qu->row_array();
        return $reault['categoryName'];

    }
    public function addHostelname($data){
//        print_r($data); exit;
        
        $this->db->insert($this->_hostel, $data);
        return $this->db->insert_id();       
        
    }    
    public function getHostelNameList(){
         
        $result = $this->db->get($this->_hostel);
        return $result->result_array();  
    }
     public function getHostelName($id) {
//        $this->db->select('campusName');        
        $qu = $this->db->get_where($this->_hostel, array('hostelId' => $id));
        $reault = $qu->row_array();
        return $reault['hostelName'];

    }
    
     public function editHostelName($id) {
        $qu = $this->db->get_where($this->_hostel, array('hostelId' => $id));
        return $qu->row_array();
    }
    
    public function updateHostelInfo($data, $id) {

        $qu = $this->db->where('hostelId', $id);
        $this->db->update($this->_hostel, $data);
        return $this->db->affected_rows();
    }

    public function deleteHostelName($id) {
        $qu = $this->db->where('hostelId', $id);
        $this->db->delete($this->_hostel);
        return $this->db->affected_rows();
    }
    
    
     public function editHostelcategory($id) {
        $qu = $this->db->get_where($this->_table, array('categoryId' => $id));
        return $qu->row_array();
    }
    
    public function updateHostelcategory($data, $id) {

        $qu = $this->db->where('categoryId', $id);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows();
    }

    public function deleteHostelcategory($id) {
        $qu = $this->db->where('categoryId', $id);
        $this->db->delete($this->_table);
        return $this->db->affected_rows();
    }
    
     public function duplicateHostelcategoryInfo($data) {
//        $this->db->select('campusName');        
        $qu = $this->db->get_where($this->_table, array('categoryName' => $data['categoryName']));
        $reault = $qu->row_array();
        return $reault;
    }
    
   public function duplicateHostelname($data) {
//        $this->db->select('campusName');        
        $qu = $this->db->get_where($this->_hostel, array('categoryId' => $data['categoryId'],'hostelName' => $data['hostelName']));
        $reault = $qu->row_array();
        return $reault;
    }
    
    
    
     

    
    

}


