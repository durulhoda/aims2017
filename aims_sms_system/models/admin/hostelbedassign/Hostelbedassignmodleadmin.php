<?php

/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class HostelBedAssignModleAdmin extends CI_Model{
    //put your code here
     private $_table = "hostelbedassign";
     private $_table2 = "hostelbed";
     private $_table3 = "hostelrent";
     private $_student = "student";
     
    public function __construct() {
        parent::__construct();
    }
    
    
    public function addhostelBedAssign($data){
//        print_r($data); exit;
        
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();       
        
    }    

    public function getAssignBed($bedno){               
        $qu = $this->db->get_where($this->_table,  array('bedNo' => $bedno));
         $reault = $qu->row_array();        
        return $reault['bedNo'];
    }
     
    
    public function gethostelBedAssignlist(){
         
        $result = $this->db->get($this->_table);
        return $result->result_array();  
    }
   
     public function edithostelBedAssign($id) {
        $qu = $this->db->get_where($this->_table, array('bedassignId' => $id));
        return $qu->row_array();
    }
    
 

    public function updatehostelBedAssign($data, $id) {

        $qu = $this->db->where('bedassignId', $id);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows();
    }

    public function deletehostelBedAssign($id) {
        $qu = $this->db->where('bedassignId', $id);
        $this->db->delete($this->_table);
        return $this->db->affected_rows();
    }
    public function getBedRent($data) {
//        $this->db->select('campusName');        
        $qu = $this->db->get_where($this->_table3, array('hostelId' => $data['hostelId'],'hostelRoom' => $data['hostelRoom']));
        $reault = $qu->row_array();
        return $reault['rent'];
    }
    public function getStudentBedRent($data) {
//        $this->db->select('campusName');        
        $qu = $this->db->get_where($this->_table, array('studentId' => $data['studentId']));
        $reault = $qu->row_array();
        return $reault;
    }
     public function Datavalidation1($data) {
//        $this->db->select('campusName');        
        $qu = $this->db->get_where($this->_table, array('hostelId' => $data['hostelId'],'hostelRoom' => $data['hostelRoom'],'bedNo' => $data['bedNo'],'studentId' => $data['studentId']));
        $reault = $qu->row_array();
        return $reault;
    }
    public function Datavalidation2($data) {
//        $this->db->select('campusName');   
   //     print_r($data); die();
        $qu = $this->db->get_where($this->_table2, array('hostelId' => $data['hostelId'],'hostelRoom' => $data['hostelRoom'],'bedNo' => $data['bedNo']));
        $reault = $qu->row_array();
        return $reault;
    }
    public function Datavalidation3($data) {
//        $this->db->select('campusName');   
   //     print_r($data); die();
        $qu = $this->db->get_where($this->_student, array('studentId' => $data['studentId']));
        $reault = $qu->row_array();
        return $reault;
    }
    public function Datavalidation4($data) {

        $qu = $this->db->get_where($this->_table, array('studentId' => $data['studentId']));
        $reault = $qu->row_array();
        return $reault;
    }
    public function Datavalidation5($data) {

        $qu = $this->db->get_where($this->_table, array('hostelId' => $data['hostelId'],'hostelRoom' => $data['hostelRoom'],'bedNo' => $data['bedNo']));
        $reault = $qu->row_array();
        return $reault;
    }
    
  public function Datavalidation6($data) {
//        $this->db->select('campusName');   
   //     print_r($data); die();
        $this->db->select('studentId');
        $this->db->where('hostelId',$data['hostelId']);
        $this->db->where('hostelRoom',$data['hostelRoom']);
        $query = $this->db->get($this->_table);
        $result = $query->result_array();
        
        return $result;
    }
    
  
  
    
    
    
     

    
    

}


