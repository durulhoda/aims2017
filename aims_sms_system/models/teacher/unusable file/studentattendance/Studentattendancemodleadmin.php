<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of studentregistrationmodleadmin
 *
 * @author Binita
 */
class StudentattendanceModleAdmin extends CI_Model{
    
    private $_table = "studentattendance";
    private $_table1 = "courseoffer";
  
    public function __construct() {
        parent::__construct();
    }
    
    
    public function saveStudentattendancess($data){
        
       $this->db->insert('studentattendance',$data);   
       return $this->db->insert_id();
        
    }    
    
    // next function is for attendance check by date when any one need attendance by subject.... 
  public function checkattendance($studentId,$attendanceDate){

      $user_check = $this->db->get_where($this->_table, array(
          
          'studentId' =>$studentId,
          'attendanceDate' => $attendanceDate
      ));
      
        if ($user_check->num_rows() > 0){
            return TRUE;
        }
        else{
            return FALSE;
        }
  
    }
    
      // next function is for attendance check by subject when any one need attendance by subject...it also working from teacher panel. 
    public function checkattendancebysubject($studentId,$subjectId,$attendanceDate){

      $user_check = $this->db->get_where($this->_table, array(
          
          'studentId' =>$studentId,
          'subjectId' => $subjectId,
          'attendanceDate' => $attendanceDate
      ));
      
        if ($user_check->num_rows() > 0){
            return TRUE;
        }
        else{
            return FALSE;
        }
  
    }
     // next function is for attendance get by date when any one need attendance by student.... 
    public function getstudentattendance($data){

        if(!empty($data)){
           
            $this->db->where('studentId',$data['studentId']);
            $this->db->where('attendanceDate >=', $data['fromDate']);
            $this->db->where('attendanceDate <=', $data['toDate']);
            $this->db->order_by('attendanceDate','DESC');  
            $qu = $this->db->get($this->_table);
            return $qu->result_array();
        }        
    }


     // next function is for attendance get class attendance by date .... 
    public function getstudentattendancebyclass($data){

        if(!empty($data)){
            $this->db->select('stu_info.applicationId,stu_info.firstName,stu_info.lastName,stu_info.fatherName,stu_info.fatherPhone,stu.*,stu_aat.*');
                $this->db->from('studentattendance stu_aat');        
                $this->db->join('student stu', 'stu.studentId=stu_aat.studentId');
                $this->db->join('studentinfo stu_info', 'stu_info.applicationId=stu.applicationId');
               
                
                $this->db->where('stu_aat.programOfferId', $data['programOfferId']);
                $this->db->where('stu_aat.attendanceDate >=', $data['fromDate']);
                $this->db->where('stu_aat.attendanceDate <=', $data['toDate']);
                
                
                $this->db->order_by('stu_aat.attendanceDate', 'desc');
                $qu = $this->db->get();
                return $qu->result_array();
        }        
        else{
          return FALSE;
        }
    }
    
     // next function is for attendance get by subject when any one need attendance by subject.... 
     public function getstudentattendanceview($data){
//        print_r($data);       
        
        if(!empty($data)){
            $this->db->like('studentId',$data['studentId']);  
            $this->db->like('subjectId',$data['subjectId']);  
            $this->db->order_by('attendanceDate','DESC');  
            $qu = $this->db->get($this->_table);
            return $qu->result_array();
        }        
    }
    
    public function searchcourselist($data){
//        print_r($data);       
        $this->db->select('courseId');
        
         $this->db->like('campusId',$data['campusId']);
         $this->db->like('programId',$data['programId']);
         $this->db->like('shiftId',$data['shiftId']);
         $this->db->like('mediumId',$data['mediumId']);
         $this->db->like('groupId',$data['groupId']);
         $this->db->like('session',$data['session']); 
        
        $qqu = $this->db->get($this->_table1);        
        return  $qqu->result_array();  
         
    }        
       
    public function deletestudentattandance($id){
        
        $this->db->where('studentId', $id);
        $this->db->delete($this->_table);
        return $this->db->affected_rows(); 
    }
}


