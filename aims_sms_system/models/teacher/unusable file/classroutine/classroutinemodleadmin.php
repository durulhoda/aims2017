<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ClassroutineModleAdmin
 *
 * @author Binita
 */
class ClassroutineModleAdmin extends CI_Model {
      
      private $_routine = "classroutine";
      private $_table = "courseoffer";

    public function __construct() {
        parent::__construct();
    }
    
    public function addClassroutineInfo($data){
        
        $this->db->insert($this->_routine, $data);
        return $this->db->insert_id();       
        
    }
    
   
    public function editClassroutineInfo($id) {
        $qu = $this->db->get_where($this->_routine, array('routineId' => $id));
        return $qu->row_array();
    }

    public function updateClassroutineInfo($data, $id) {

        $qu = $this->db->where('routineId', $id);
        $this->db->update($this->_routine, $data);
        return $this->db->affected_rows();
    }

    public function deleteClassroutineInfo($id) {
        $qu = $this->db->where('routineId', $id);
        $this->db->delete($this->_routine);
        return $this->db->affected_rows();
    }
    
    
    
    public function getClassroutineList(){        
        
        $this->db->select('c_rt.*,prg.*,cour.*,cour_offr.*,emp.employeeId,emp.firstName,emp.middleName,emp.lastName,emp.phone');
        $this->db->from('classroutine c_rt');
        $this->db->join('programoffer prg', 'prg.programOfferId=c_rt.programOfferId');
        $this->db->join('courseoffer cour_offr', 'cour_offr.programOfferId=c_rt.programOfferId');
        $this->db->join('course cour', 'cour.courseId=cour_offr.courseId');
        $this->db->join('employee emp', 'emp.employeeId=cour_offr.employeeId');
        $this->db->group_by('c_rt.programOfferId');
        $this->db->order_by('c_rt.programOfferId','DESC');

        $query = $this->db->get();
        $result = $query->result_array();
        if (!empty($result)) {
            return $result;
        }
    }
    
    public function select_new_routine($data) {
        
        $this->db->select('*');
        $this->db->where('programOfferId',$data['programOfferId']);
        $this->db->order_by('periodId','ASC');        
        $result = $this->db->get($this->_routine);
        return $result->result_array();   
    }
    
    public function routinevalidation1($data) {
        
        $this->db->select('*');
       
        $this->db->where('dayName',$data['dayName']);
        $this->db->where('programOfferId',$data['programOfferId']);
        $this->db->where('courseId',$data['courseId']);
        $this->db->where('periodId',$data['periodId']);
        
        $result = $this->db->get($this->_routine);
        return $result->row_array();   
        
       
    }
    public function routinevalidation2($data) {
        
        $this->db->select('*');
        $this->db->where('dayName',$data['dayName']);
        $this->db->where('courseId',$data['courseId']);
        $this->db->where('periodId',$data['periodId']);
        
        $result = $this->db->get($this->_routine);
        return $result->row_array();   
        
       
    }
   
    public function routinevalidation3($data) {
        
        $this->db->select('*');
        $this->db->where('dayName',$data['dayName']);
        $this->db->where('programOfferId',$data['programOfferId']);
        $this->db->where('courseId',$data['courseId']);
        $this->db->where('periodId',$data['periodId']);
        
        $result = $this->db->get($this->_routine);
        return $result->row_array();   
        
       
    }
     public function routinevalidation4($data) {
        
        $this->db->select('*');
        $this->db->where('programOfferId',$data['programOfferId']);
        $this->db->where('dayName',$data['dayName']);
        $this->db->where('periodId',$data['periodId']);
        
        $result = $this->db->get($this->_routine);
        return $result->row_array();   
        
       
    }
    public function routinevalidation5($data) {
        
        $this->db->select('*');
        $this->db->where('programOfferId',$data['programOfferId']);
        $this->db->where('dayName',$data['dayName']);
        $this->db->where('courseId',$data['courseId']);
        
        $result = $this->db->get($this->_routine);
        return $result->row_array();   
        
       
    }
     public function routinevalidation6($data) {
        
        $this->db->select('*');
        $this->db->where('programOfferId',$data['programOfferId']);
        $this->db->where('courseId',$data['courseId']);
       
        $results = $this->db->get($this->_table);
        return $results->row_array();    
        
       
    }
}