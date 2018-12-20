<?php
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class TeacherModleAdmin extends CI_Model {
    private $_table = "employee";

    public function __construct() {
        parent::__construct();
    }
    

    public function getTeacherInfoArray(){
        
        $this->db->select('*');
        $this->db->where('employeeType',1);        
        $result = $this->db->get($this->_table);
        return $result->result_array();   
    }
    public function getTeacher($id){
        $this->db->select('*');
        $qu = $this->db->get_where($this->_table, array('employeeId' => $id));
        if(!empty($qu))
        {
            return $qu->row_array();    
        }
        
        
    }
       
    public function editTeacherInfo($id){
        
        $qu = $this->db->get_where($this->_table, array('employeeId' => $id));
        return $qu->row_array(); 
    }
    public function viewTeacherInfo($username){
        
        $qu = $this->db->get_where($this->_table, array('employeeId' => $username));
        return $qu->row_array(); 
    }
    
    public function updateTeacherInfo($data,$id){
        $this->db->where('employeeId', $id);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows(); 
    }
    
     public function checkcurrentpassword($userName)
    {
        $this->db->select('password');
        $this->db->from('employee');
        $this->db->where('userName',$userName);
        $query_result=$this->db->get();
        $result=$query_result->row();
        return $result;
        
    }
   
    public function updatepassword($userName,$data){
     //   $this->db->from('studentlogin');
        $this->db->where('userName', $userName);
     //   $this->db->update('password', $retypepassword); 
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows(); 
    }
    
    public function get_course_list(){
        $this->db->select('*');
        $this->db->from('course');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    
}
