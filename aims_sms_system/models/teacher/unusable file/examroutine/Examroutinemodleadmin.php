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
class ExamroutineModleAdmin extends CI_Model {
      private $_table = "examroutine";

    public function __construct() {
        parent::__construct();
    }
    
    public function addExamroutineInfo($data){
        
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();       
        
    }
    public function routinevalidation1($data) {
        
        $this->db->select('*');
        $this->db->where('programOfferId',$data['programOfferId']);
        $this->db->where('courseId',$data['courseId']);
        $this->db->where('examname',$data['examname']);
        $this->db->where('date',$data['date']);
        $this->db->where('examtime',$data['examtime']);
        $this->db->where('room',$data['room']);
        
        $result = $this->db->get($this->_table);
        return $result->row_array();   
        
       
    }
    public function routinevalidation2($data) {
        
        $this->db->select('*');
        $this->db->where('programOfferId',$data['programOfferId']);    
        $this->db->where('courseId',$data['courseId']);
        $this->db->where('examname',$data['examname']);
        
        $result = $this->db->get($this->_table);
        return $result->row_array();   
        
       
    }
    public function routinevalidation3($data) {
        
        $this->db->select('*');
        $this->db->where('programOfferId',$data['programOfferId']);
         $this->db->where('date',$data['date']);
        $this->db->where('examname',$data['examname']);
        $this->db->where('examtime',$data['examtime']);
        
        $result = $this->db->get($this->_table);
        return $result->row_array();   
        
       
    }
    
    public function getExamroutineList(){
        
        $this->db->select('programOfferId,examname');
        $this->db->group_by('programOfferId,examname');
   //     $this->db->where('session', date('Y'));
        $this->db->order_by('date','DESC');
        $result = $this->db->get($this->_table);
        $datas=$result->result_array();  
        if(!empty($datas))
        {
            return  $datas;
        }
        
    }
    
     public function select_new_routine($data) {
        
        $this->db->select('*');
        $this->db->where('examname',$data['examname']);
        $this->db->where('programOfferId',$data['programOfferId']);
        $this->db->order_by('date','DESC');
        $this->db->limit(50);
        
        $result = $this->db->get($this->_table);
        return $result->result_array();   
        
       
    }
    
    
    
    
  
        public function editExamroutineInfo($id) {
        $qu = $this->db->get_where($this->_table, array('routineId' => $id));
        return $qu->row_array();
    }

    public function updateExamroutineInfo($data, $id) {

        $qu = $this->db->where('routineId', $id);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows();
    }

    public function deleteExamroutineInfo($id) {
        $qu = $this->db->where('routineId', $id);
        $this->db->delete($this->_table);
        return $this->db->affected_rows();
    }
     
}