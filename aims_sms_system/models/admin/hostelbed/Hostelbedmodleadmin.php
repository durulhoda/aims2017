<?php

/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class HostelBedModleAdmin extends CI_Model{
    //put your code here
     private $_table = "hostelbed";
     private $_table2 = "hostelroom";
     
    public function __construct() {
        parent::__construct();
    }
    
    
    public function addhostelBed($data){
//        print_r($data); exit;
        
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();       
        
    }    

     
    public function gethostelBedlist(){
         
        $result = $this->db->get($this->_table);
        return $result->result_array();  
    }
   
     public function edithostelBed($id) {
        $qu = $this->db->get_where($this->_table, array('bedId' => $id));
        return $qu->row_array();
    }
    
 

    public function updatehostelBed($data, $id) {

        $qu = $this->db->where('bedId', $id);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows();
    }

    public function deletehostelBed($id) {
        $qu = $this->db->where('bedId', $id);
        $this->db->delete($this->_table);
        return $this->db->affected_rows();
    }
    
     public function Datavalidation1($data) {
//        $this->db->select('campusName');        
        $qu = $this->db->get_where($this->_table, array('hostelId' => $data['hostelId'],'hostelRoom' => $data['hostelRoom'],'bedNo' => $data['bedNo']));
        $reault = $qu->row_array();
        return $reault;
    }
    public function Datavalidation2($data) {
//        $this->db->select('campusName');   
   //     print_r($data); die();
        $qu = $this->db->get_where($this->_table2, array('hostelId' => $data['hostelId'],'hostelRoom' => $data['hostelRoom']));
        $reault = $qu->row_array();
        return $reault;
    }
    
  
    
    
    
     

    
    

}


