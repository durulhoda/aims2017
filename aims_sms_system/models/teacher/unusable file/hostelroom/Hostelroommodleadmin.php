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
class HostelRoomModleAdmin extends CI_Model{
    //put your code here
     private $_table = "hostelroom";
     
    public function __construct() {
        parent::__construct();
    }
    
    
    public function addhostelRoom($data){
//        print_r($data); exit;
        
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();       
        
    }    

     
    public function gethostelRoomlist(){
         
        $result = $this->db->get($this->_table);
        return $result->result_array();  
    }
   
     public function edithostelRoom($id) {
        $qu = $this->db->get_where($this->_table, array('roomId' => $id));
        return $qu->row_array();
    }
    
 

    public function updatehostelRoom($data, $id) {

        $qu = $this->db->where('roomId', $id);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows();
    }

    public function deletehostelRoom($id) {
        $qu = $this->db->where('roomId', $id);
        $this->db->delete($this->_table);
        return $this->db->affected_rows();
    }
    
     public function duplicatehostelRoom($data) {
//        $this->db->select('campusName');        
        $qu = $this->db->get_where($this->_table, array('categoryId' => $data['categoryId'],'hostelId' => $data['hostelId'],'hostelRoom' => $data['hostelRoom']));
        $reault = $qu->row_array();
        return $reault;
    }
    public function duplicatehostelRoom2($data) {
//        $this->db->select('campusName');        
        $qu = $this->db->get_where($this->_table, array('hostelRoom' => $data['hostelRoom']));
        $reault = $qu->row_array();
        return $reault;
    }
    
  
    
    
    
     

    
    

}


