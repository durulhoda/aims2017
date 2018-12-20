<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CourseofferModleAdmin
 *
 * @author Binita
 */
class CoursereofferModleAdmin extends CI_Model{
    private $_table = "courseoffer";
    
    public function __construct() {
        parent::__construct();
    }
    
    
  
    public function searchcourseofferlist($data){
//        print_r($data);       
        
       if(!empty($data)){
            $this->db->where('programOfferId',$data['programOfferId']);
            $qu = $this->db->get($this->_table);
            return $qu->result_array();
        }        
  }
  
  public function deleteCourseoffer($data) {
  //      print_r($offerId); echo ("--");   
        $qu = $this->db->where('offerId', $data['offerId']);
        $this->db->delete($this->_table);
        return $this->db->affected_rows()> 0;
    }

     public function insertCourseofferInfo($data){
   //  print_r($data); die();
        $this->db->insert($this->_table, $data);
       return $this->db->insert_id();
    }
    
    
    
}

