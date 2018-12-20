<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CourseModelAdmin
 *
 * @author Binita
 */
class HostelRentModleAdmin extends CI_Model{
    //put your code here
     private $_table = "hostelrent";
     private $_table2 = "hostelbed";
      
    public function __construct() {
        parent::__construct();
    }
    
    
    public function addhostelRent($data){
//        print_r($data); exit;
        
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();       
        
    }    

     
    public function gethostelRentlist(){
         
        $result = $this->db->get($this->_table);
        return $result->result_array();  
    }
   
     public function edithostelRent($id) {
        $qu = $this->db->get_where($this->_table, array('rentId' => $id));
        return $qu->row_array();
    }
    
 

    public function updatehostelRent($data, $id) {

        $qu = $this->db->where('rentId', $id);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows();
    }

    public function deletehostelRent($id) {
        $qu = $this->db->where('rentId', $id);
        $this->db->delete($this->_table);
        return $this->db->affected_rows();
    }
    
     public function Datavalidation1($data) {
//        $this->db->select('campusName');        
        $qu = $this->db->get_where($this->_table, array('hostelId' => $data['hostelId'],'hostelRoom' => $data['hostelRoom'],'rent' => $data['rent']));
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


