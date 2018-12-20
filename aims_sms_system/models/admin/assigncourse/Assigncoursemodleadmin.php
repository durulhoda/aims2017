<?php
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
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
        //print_r($programOfferId);exit;
         
           //  $this->db->select('st_cor.assignId,st_cor.employeeId,st_cor.courseId,st_cor.courseStatus,stu.studentId,stu.programOfferId,stu_info.applicationId,stu_info.firstName,stu_info.lastName,stu_info.middleName,prg.programLevel,prg.programId,prg.mediumId,prg.groupId,prg.shiftId,prg.sectionId,prg.sessionId');
           //  $this->db->from('student stu');      
           //  $this->db->join('studentinfo stu_info', 'stu_info.applicationId=stu.applicationId');  
           //  $this->db->join('programoffer prg', 'prg.programOfferId=stu.programOfferId');
           //  $this->db->join('studentassigncourse st_cor', 'stu.studentId=st_cor.studentId','left');
            
           // // $this->db->where('st_cor.programOfferId', $programOfferId); 
           //  $this->db->where('stu.programOfferId', $programOfferId); 
           //  $query = $this->db->get();
           //  $result = $query->result_array();
           //  if(!empty($result)){
           //      return $result;   
           // }

        $records = $this->db
                    ->select('
                        st_cor.assignId,
                        st_cor.employeeId,
                        st_cor.courseId,
                        st_cor.courseStatus,
                        stu.studentId,
                        stu.programOfferId,
                        stu_info.applicationId,
                        stu_info.firstName,
                        stu_info.lastName,
                        stu_info.middleName,
                        prg.programLevel,
                        prg.programId,
                        prg.mediumId,
                        prg.groupId,
                        prg.shiftId,
                        prg.sectionId,
                        prg.sessionId
                        ')
                    ->from('student AS stu')
                    ->join('studentinfo AS stu_info', 'stu_info.applicationId = stu.applicationId')
                    ->join('programoffer AS prg', 'prg.programOfferId = stu.programOfferId')
                    ->join('studentassigncourse AS st_cor', 'stu.studentId = st_cor.studentId AND st_cor.programOfferId = '.$programOfferId.'','left')
                   // ->join('promotedstudent AS ps', 'stu.studentId = ps.studentId AND ps.programOfferId = '.$programOfferId.'')
                    ->where('stu.programOfferId', $programOfferId)
                    ->group_by('st_cor.studentId')
                    ->group_by('st_cor.programOfferId')
                    ->get()
                    ->result_array();
                  // print_r($programOfferId);exit;
           // echo '<pre>';print_r($records);exit;
            return $records;
         
    }

   
    
     public function getAssignCourseListByPrg_stuid($prgid,$stuid){
         
            $this->db->select('*');
            $this->db->from('studentassigncourse');        
            $this->db->where('programOfferId', $prgid['programOfferId']); 
            $this->db->where('studentId', $stuid); 
            $query = $this->db->get();
            $result = $query->row_array();
            if(!empty($result)){
                return $result;   
           }
         
    }
        public function AssignCourseListByPrg_stuid_Another($prgid,$stuid){
           // print_r($stuid);exit;
            if ($stuid) {
                $var = $stuid;
            foreach($var as $id){
            $this->db->select('assignId,studentId,');
            $this->db->from('studentassigncourse');        
            $this->db->where('programOfferId', $prgid); 
            $this->db->where('studentId', $id['studentId']); 
            $query = $this->db->get();
            $result = $query->row_array();
           // echo "<pre>";print_r($result);die();
            if(!empty($result)){
                return $result;   
           }
         
        }
            }
            
    }

    public function getAssignCourseListByPrg_stuid_($prgid,$stuid){
         
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

    public function get_exiting_student_info($id) {
            $this->db->select('st_cor.*,stu.*,stu_info.*,prg.*');
            $this->db->select('program.programName');
            $this->db->select('section.sectionName');
            $this->db->select('shift.shiftName');
            $this->db->select('group.groupName');
            $this->db->select('medium.mediumName');
            $this->db->select('session.session');
            $this->db->from('studentassigncourse st_cor');
            $this->db->join('programoffer prg', 'prg.programOfferId=st_cor.programOfferId');
            $this->db->join('student stu', 'stu.studentId=st_cor.studentId');
            $this->db->join('studentinfo stu_info', 'stu_info.applicationId=stu.applicationId');
            $this->db->join('program','prg.programId = program.programId');
            $this->db->join('section','prg.sectionId = section.sectionId');
            $this->db->join('shift','prg.shiftId = shift.shiftId');
            $this->db->join('group','prg.groupId = group.groupId');
            $this->db->join('medium','prg.mediumId = medium.mediumId');
            $this->db->join('session','prg.sessionId = session.sessionId');
            $this->db->where('st_cor.assignId', $id);
            $query = $this->db->get();
            $result = $query->row_array();
            if(!empty($result)){
                return $result;
           }
    }

    public function editassigncoursee($id) {
            $this->db->select('st_cor.*,stu.*,stu_info.*,prg.*');
            $this->db->from('studentassigncourse st_cor');        
            $this->db->join('programoffer prg', 'prg.programOfferId=st_cor.programOfferId');
            $this->db->join('student stu', 'stu.studentId=st_cor.studentId');
            $this->db->join('studentinfo stu_info', 'stu_info.applicationId=stu.applicationId');
            $this->db->where('st_cor.assignId', $id); 
            $query = $this->db->get();
            $result = $query->result_array();
            if(!empty($result)){
                return $result;   
           }
    }

    public function getStudentId($data_programOfferId){
        $id = 642;
        $this->db->select('studentId,assignId');
            $this->db->from('studentassigncourse'); 
            $this->db->where('programOfferId', $data_programOfferId);
            $this->db->where('assignId >',$id);  
            $query = $this->db->get();
            $result = $query->result_array();
            if(!empty($result)){
                return $result;   
           }
    }
     
     public function updateassigncourse($data){
        $qu = $this->db->where('studentId', $data['studentId']);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows();
        
    }
    
    public function GetStudentAssignCourse($prgid,$stuid){
         
            $this->db->select('courseId,courseStatus,programOfferId');
            $this->db->from('studentassigncourse');        
            $this->db->where('programOfferId', $prgid); 
            $this->db->where('studentId', $stuid); 
            $query = $this->db->get();
            $result = $query->row_array();
            if(!empty($result)){
                return $result;   
           }
         
    }

    public function getStudentRollNo($programOfferId = 0) {
        $records = $this->db
                        ->select('studentId,roll_no')
                        ->where('programOfferId', $programOfferId)
                        ->get('promotedstudent')
                        ->result();
        $arr = [];
        if ($records) {
            foreach ($records as $key => $value) {
                $arr[$value->studentId] = $value->roll_no;
            }
        }
        return $arr;
    }

    public function get_student_enrollment_info($data_programOfferId){
        $this->db->select('programoffer.*,session.*,program.*,group.groupId,group.groupName,medium.mediumId,medium.mediumName,section.sectionId,section.sectionName,shift.*');
        $this->db->from('programoffer');
        $this->db->join('program','programoffer.programId = program.programId');
        $this->db->join('section','programoffer.sectionId = section.sectionId');
        $this->db->join('shift','programoffer.shiftId = shift.shiftId');
        $this->db->join('group','programoffer.groupId = group.groupId');
        $this->db->join('medium','programoffer.mediumId = medium.mediumId');
        $this->db->join('session','programoffer.sessionId = session.sessionId');
        $this->db->where('programoffer.programOfferId',$data_programOfferId);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

}