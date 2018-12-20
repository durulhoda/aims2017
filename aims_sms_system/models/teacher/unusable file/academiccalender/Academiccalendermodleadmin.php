<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ExamroutineModleAdmin
 *
 * @author Binita
 */
class AcademicCalenderModleAdmin extends CI_Model {
      private $_table = "calendar";

    public function __construct() {
        parent::__construct();
    }
    
    public function addAcademiccalender($data){
        
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();       
        
    }
    public function academiccalendervalidation($data) {
        
        $this->db->select('*');
       $this->db->where('startdate',$data['startdate']);
        $this->db->where('description',$data['description']);
        
        $result = $this->db->get($this->_table);
        return $result->row_array();   
        
       
    }
    
    
    public function getCalenderList(){
        
        $this->db->select('*');
        $this->db->order_by('startdate','DESC');
        $result = $this->db->get($this->_table);
        return $result->result_array();   
    }
    
     public function showmonthlyevent() {
        
        $this->db->select('*');
        $this->db->order_by('startdate','ASC');
        $result = $this->db->get($this->_table);
        return $result->result_array();   
        
       
    }
    public function getEventdate($dates){               
        $this->db->select('description');
        $this->db->where('startdate',$dates);
        $result = $this->db->get($this->_table);
        return $result->row_array();   
//        $qu = $this->db->get_where($this->_table,  array('startdate'=>$dates)); 
//         $reasult = $qu->row_array();        
//        return $reasult['startdate'];
    }
    
    public function getEventdescription($date){               
        $qu = $this->db->get_where($this->_table,  array('startdate'=>$date)); 
         $reasult = $qu->row_array();        
        return $reasult['description'];
    }
    
    
    
    
    
    
     
}