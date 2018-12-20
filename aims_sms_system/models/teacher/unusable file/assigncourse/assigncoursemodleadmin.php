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
class AssignCourseModleAdmin extends CI_Model{
    //put your code here
     private $_table = "studentassigncourse";

    public function __construct() {
        parent::__construct();
    }
    
    
    public function insertassigncourse($data){
//        print_r($data); exit;
        
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();       
        
    } 
     public function deletestudent($id){
        
        $this->db->where('studentId', $id);
        $this->db->delete($this->_table);
        return $this->db->affected_rows(); 
    }
    
    public function getAssignCourseListByProgramofferId($programOfferId){
         
            $this->db->select('st_cor.*,stu.*,stu_info.*,prg.*');
            $this->db->from('studentassigncourse st_cor');        
            $this->db->join('programoffer prg', 'prg.programOfferId=st_cor.programOfferId');
            $this->db->join('student stu', 'stu.studentId=st_cor.studentId');
            $this->db->join('studentinfo stu_info', 'stu_info.applicationId=stu.applicationId');
            $this->db->where('st_cor.programOfferId', $programOfferId); 
            $query = $this->db->get();
            $result = $query->result_array();
            if(!empty($result)){
                return $result;   
           }
         
    }
     public function getAssignCourseListByPrg_stuid($prgid,$stuid){
         
            $this->db->select('*');
            $this->db->from('studentassigncourse');        
            $this->db->where('programOfferId', $prgid); 
            $this->db->where('studentId', $stuid); 
            $query = $this->db->get();
            $result = $query->row_array();
            if(!empty($result)){
                return $result;   
           }
         
    }
    public function editassigncourse($id) {
            $this->db->select('st_cor.*,stu.*,stu_info.*,prg.*');
            $this->db->from('studentassigncourse st_cor');        
            $this->db->join('programoffer prg', 'prg.programOfferId=st_cor.programOfferId');
            $this->db->join('student stu', 'stu.studentId=st_cor.studentId');
            $this->db->join('studentinfo stu_info', 'stu_info.applicationId=stu.applicationId');
            $this->db->where('st_cor.assignId', $id); 
            $query = $this->db->get();
            $result = $query->row_array();
            if(!empty($result)){
                return $result;   
           }
    }
     
     public function updateassigncourse($data){
        $qu = $this->db->where('studentId', $data['studentId']);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows();
        
    }

}

