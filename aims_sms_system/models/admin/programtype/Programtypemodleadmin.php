<?php
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class ProgramtypeModleAdmin extends CI_Model{
    //put your code here
    private $_table = "programtype";

    public function __construct() {
        parent::__construct();
    }
    
    
    public function addProgramtypeInfo($data){
//        print_r($data); exit;
        
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();       
        
    }
    
//    public function getDeprtmentInfoArray(){
//        $this->db->ge($this->_table);
//        return $this->db->insert_id();
//Full texts 	programType 	instituteCode 	programTypeId 
//    }
    
    
    public function getProgramtypeInfoArray(){
        $this->db->select('programTypeId, programType');
        $this->db->order_by("programType", "asc");
        $qu = $this->db->get($this->_table);
        return $qu->result_array();
        
    }
}

