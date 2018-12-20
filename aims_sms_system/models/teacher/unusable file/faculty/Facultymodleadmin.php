<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of facultymodleadmin
 *
 * @author Binita
 */
class FacultyModleAdmin extends CI_Model {
    
     private $_table = "faculty";

    public function __construct() {
        parent::__construct();
    }
    
    
    public function addFacultyInfo($data){
//        print_r($data); exit;
        
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();       
        
    }
    

    
    
    public function getFacultyInfoArray(){
        $this->db->select('facultyId, facultyName');
        $this->db->order_by("facultyName", "asc");
        $qu = $this->db->get($this->_table);
        return $qu->result_array();
        
    }
    //put your code here
}


