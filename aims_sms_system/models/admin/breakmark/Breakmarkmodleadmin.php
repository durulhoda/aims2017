<?php

/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class BreakMarkModleAdmin  extends CI_Model{
    
    private $_table = "courseoffer";
    private $_table1 = "breakmark";

    public function __construct() {
        parent::__construct();
    }
    
  
    // use this function admin > breakmark > getsubjectlist
    public function getsubjectlist($data){
//        print_r($data);       
        
        if(!empty($data)){
           
        $this->db->like('campusId',$data['campusId']);
        $this->db->like('mediumId',$data['mediumId']);
        $this->db->like('programId',$data['programId']);
        $this->db->like('groupId',$data['groupId']);
        $this->db->like('sectionId',$data['sectionId']);
        $this->db->like('shiftId',$data['shiftId']);
        $this->db->like('session',$data['session']);        
        $this->db->like('employeeId',$data['employeeId']);  
        
        $qu = $this->db->get($this->_table);
        return $qu->result_array();
        }        
    }
    public function getmarklist($data){
//        print_r($data);       
        
        if(!empty($data)){
         $courseId= $data['courseId'];
        
        $this->db->like('courseId',$data['courseId']);  
        
        $qu = $this->db->get($this->_table1);
        return $qu->result_array();
        }        
    }
    
    public function savebreakmark($data){
//        print_r($data); exit;
        
        $this->db->insert($this->_table1, $data);
        return $this->db->insert_id();       
        
    } 
    
    public function getmarks(){
         
        $result = $this->db->get($this->_table1);
        return $result->result_array();  
    }
    
     public function editBreakmarkInfo($id) {
        $qu = $this->db->get_where($this->_table1, array('markid' => $id));
        return $qu->row_array();
    }

    public function updateBreakmarkInfo($data, $id) {

        $qu = $this->db->where('markid', $id);
        $this->db->update($this->_table1, $data);
        return $this->db->affected_rows();
    }

    public function deleteBreakmarkInfo($id) {
        $qu = $this->db->where('markid', $id);
        $this->db->delete($this->_table1);
        return $this->db->affected_rows();
    }
}