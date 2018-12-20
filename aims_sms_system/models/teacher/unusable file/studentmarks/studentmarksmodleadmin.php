<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of studentmarksmodleadmin
 *
 * @author Binita
 */
class StudentmarksModleAdmin extends CI_Model{
    //put your code here
     // private $_studentmarks = "gradesheet";
    private $_studentmarks = "studentmarks";
     private $_student = "student";
     private $_courseoffer = "courseoffer";
     private $_assignedCourse = "studentassigncourse";
     
     public function __construct() {
        parent::__construct();
    }
    
    
    public function getStudentmarksInfo(){
//        $this->db->order_by("id", "asc");
        $qu = $this->db->get($this->_studentmarks);
        return $qu->result_array();
    }
    
    public function getStudentmarksInfoArray(){
        $this->db->select('roomId, roomName');
        $this->db->order_by("roomName", "asc");
        $qu = $this->db->get($this->_studentmarks);
        return $qu->result_array();
        
    }
    
    public function editStudentmarksInfo($id){
        $qu = $this->db->get_where($this->_studentmarks, array('roomId'=>$id));
        return $qu->row_array();
    }
    
     public function getPositionByClass($data) {
        
      $sql="SELECT semesterId,studentId,SUM(marks) as marks FROM studentmarks where `programOfferId`='".$data['programOfferId']."' AND `semesterId`='".$data['semesterId']."' GROUP BY studentId order by marks DESC";
     $query_result=$this->db->query($sql);
        $result=$query_result->result_array();
        return $result;
        
      
    }
    
    
    public function deleteStudentmarksInfo($id){
        $qu = $this->db->where('roomId', $id);
        $this->db->delete($this->_studentmarks);
        return $this->db->affected_rows();
        
    }
    public function getstudentmarkinfo($studentId, $markId){
           // echo $studentId."------".$markId; die();
        $this->db->select('*');
        $this->db->from('studentmarks');
        $this->db->where('markId',$markId);
       $this->db->where('studentId',$studentId);
        $mq=$query = $this->db->get();
        return $mq->row_array(); 
        
    }


  public function updatestudentmarks($data,$markId){
        // print_r($data); echo $studentId; die();
        $this->db->where('markId', $markId);
        $this->db->update($this->_studentmarks, $data);
        return $this->db->affected_rows(); 
    }
      
   public function deletestudentmarks($studentId, $markId){
        
        $this->db->where('markId', $markId);
        $this->db->where('studentId', $studentId);
        $this->db->delete($this->_studentmarks);
        return $this->db->affected_rows(); 
    }
     //......use for  view student result (admin >> studentmarks >> marks_list.php) 
    public function getmarksByStudent($data) {
        if (!empty($data)) {
          //  print_r($data['semesterId']); die();
            $this->db->where('studentId', $data['studentId']);
            $this->db->where('semesterId', $data['semesterId']);
            $this->db->order_by('examtypeId','ASC');
            $qu = $this->db->get($this->_studentmarks);
            return $qu->result_array();
            
        }
    }
    
     //......use for  view class result (admin >> studentmarks >> marks_list_class.php) 
    public function getmarksByClass($data) {
        
        if (!empty($data['exam_type'])) {

                $this->db->select('st_mrk.*,sub.*,sem.*,exm_typ.*,stu_info.applicationId,stu_info.firstName,stu_info.lastName,stu_info.fatherName,stu_info.fatherPhone,stu.*');
                $this->db->from('studentmarks st_mrk');        
                $this->db->join('student stu', 'stu.studentId=st_mrk.studentId');
                $this->db->join('studentinfo stu_info', 'stu_info.applicationId=stu.applicationId');
                $this->db->join('course sub', 'sub.courseId=st_mrk.courseId');
                $this->db->join('semester sem', 'sem.semesterId=st_mrk.semesterId');
                $this->db->join('examtype exm_typ', 'exm_typ.examtypeId=st_mrk.examtypeId');
                
                $this->db->where('st_mrk.programOfferId', $data['programOfferId']);
                $this->db->where('st_mrk.courseId', $data['courseId']);
                $this->db->where('st_mrk.semesterId', $data['semesterId']);
                $this->db->where('st_mrk.examtypeId', $data['examtypeId']);
                
                $this->db->order_by('st_mrk.marks', 'desc');
                $qu = $this->db->get();
                return $qu->result_array();
            } else {
                $this->db->select('st_mrk.*,sub.*,sem.*,stu_info.applicationId,stu_info.firstName,stu_info.lastName,stu_info.fatherName,stu_info.fatherPhone,stu.*');
                $this->db->from('studentmarks st_mrk');        
                $this->db->join('student stu', 'stu.studentId=st_mrk.studentId');
                $this->db->join('studentinfo stu_info', 'stu_info.applicationId=stu.applicationId');
                $this->db->join('course sub', 'sub.courseId=st_mrk.courseId');
                $this->db->join('semester sem', 'sem.semesterId=st_mrk.semesterId');
                
                $this->db->where('st_mrk.programOfferId', $data['programOfferId']);
                $this->db->where('st_mrk.courseId', $data['courseId']);
                $this->db->where('st_mrk.semesterId', $data['semesterId']);
                
                $this->db->order_by('st_mrk.marks', 'desc');
                $qu = $this->db->get();
                return $qu->result_array();
            }
    }
    
    public function searchstudentlist($data){
//        print_r($data);       
        
        if(!empty($data)){
       
        $this->db->like('campusId',$data['campusId']);
   //    $this->db->like('courseId',$data['courseId']);
        $this->db->like('mediumId',$data['mediumId']);
        $this->db->like('classId',$data['programId']);
        $this->db->like('groupId',$data['groupId']);
        $this->db->like('sectionId',$data['sectionId']);
        $this->db->like('shiftId',$data['shiftId']);
        $this->db->like('sessionId',$data['session']);        
  //      $this->db->like('employeeId',$data['employeeId']);  
        
        $qu = $this->db->get($this->_student);
        return $qu->result_array();
        }        
    }
    
     //......use for  view student result in Transcript with GroupBY (admin >> result_view >> transcriptView.php) 
    public function getmarksByStudentTranscriptView($data) {
        if (!empty($data)) {
            $this->db->where('studentId', $data['studentId']);
            $this->db->where('programOfferId', $data['programOfferId']);
            $this->db->where('semesterId', $data['semesterId']);

            $this->db->group_by('courseId');
            $qu = $this->db->get($this->_studentmarks);
            return $qu->result_array();
        }
    }
    
    
    // used in admin/studentmarks/searchstudentlist
    public function searchsubject($data){
//        print_r($data);       
        
        if(!empty($data)){
        
            $qu = $this->db->get_where($this->_courseoffer, array(
                                            'courseId' => $data['courseId'],
                                            'programOfferId' => $data['programOfferId'],
                                            'employeeId' => $data['employeeId']));
        $reault = $qu->result_array();
        if(!empty($reault))
        {
            return $reault;
        }   
             
        }        
    }
//    public function searchCourse($data){
////        print_r($data);       
//        
//        if(!empty($data)){
//        
//            $qu = $this->db->get_where($this->_assignedCourse, array(
//                                            'campusId' => $data['campusId'],
//                                            'mediumId' => $data['mediumId'],
//                                            'programId'=> $data['programId'],
//                                            'groupId' => $data['groupId'],
//                                            'shiftId' => $data['shiftId'],
//                                            'session' => $data['session'],
//                                            'employeeId' => $data['employeeId']));
//        $reault = $qu->result_array();
//        return $reault;
//            
//
//        }        
//    }
    
    public function searchAssignedsubject($data){
       
        if(!empty($data)){
        
         //   $this->db->like('employeeId',$employeeId);  
            $this->db->like('employeeId',$data);  
        $qu = $this->db->get($this->_courseoffer);
        return $qu->result_array();
           

        }        
    }
    
    public function duplicateExamMarks($data) {
//        $this->db->select('campusName');        
        $quu = $this->db->get_where($this->_studentmarks, array('studentId' => $data['studentId'],'semesterId' => $data['semesterId'], 'examtypeId' => $data['examtypeId'],'courseId' => $data['courseId'],'programOfferId' => $data['programOfferId']));
        $reault = $quu->row_array();
        return $reault;
    }
    public function savemarks($data) {  
        $data['entryDate']=date("d-m-Y");
        $this->db->insert($this->_studentmarks, $data);
        
        return $this->db->insert_id();
    }
    
   // use to total view of student marks in admin >> result_view >> transcriptView 
    public function getExamMarks($data) {
      
        if(!empty($data['exam_type']))
        {
         $this->db->select_sum('marks');
          $this->db->where('studentId',$data['studentId']); 
          $this->db->where('semesterId',$data['semesterId']); 
       //   $this->db->where('examtypeId',$data['examtypeId']); 
          $this->db->where('courseId',$data['courseId']); 
          $qu = $this->db->get($this->_studentmarks);

          $result = $qu->result();

          return $result[0]->marks;
      }
      else{
           $this->db->select_sum('marks');
          $this->db->where('studentId',$data['studentId']); 
          $this->db->where('semesterId',$data['semesterId']); 
          $this->db->where('courseId',$data['courseId']); 
          
          $qu = $this->db->get($this->_studentmarks);

          $result = $qu->result();

         return $result[0]->marks;
          
      }
 
    }
    // use to total view of student marks by studentID & ProgramofferId in Promotion >> 
    public function CountMarksByStudent($data) {
      
           $this->db->select_sum('marks');
          $this->db->where('studentId',$data['studentId']); 
          $this->db->where('programOfferId',$data['programOfferId']);         
          
          $qu = $this->db->get($this->_studentmarks);

          $result = $qu->result();

         return $result[0]->marks;         
     
    }
    
    public function getMark_stuid_corid_emtyp($studentId,$courseId,$examtypeId) {
              
          $this->db->select('*');
          $this->db->where('studentId',$studentId); 
          $this->db->where('courseId',$courseId); 
          $this->db->where('examtypeId',$examtypeId); 
          
          $qu = $this->db->get($this->_studentmarks);
          $result = $qu->row_array();
          if(!empty($result))
          {
            return $result['marks'];
          }
          else{ return "00";}
     
    }
    
    
     // use for published result...
    public function getResultStatusByPrgid($data){
        $this->db->select('stu_info.*,prg.*,stu_mark.*,stu.*');
        $this->db->from('studentmarks stu_mark');             
        $this->db->join('programoffer prg', 'prg.programOfferId=stu_mark.programOfferId');
        $this->db->join('student stu', 'stu.studentId=stu_mark.studentId');
        $this->db->join('studentinfo stu_info', 'stu_info.applicationId=stu.applicationId');
        $this->db->where('stu_mark.programOfferId', $data['programOfferId']);
        $this->db->where('stu_mark.semesterId', $data['semesterId']);
        $this->db->group_by('stu_mark.studentId');
        $this->db->order_by('stu_mark.marks',"DESC");
        $qu = $this->db->get();
        return $qu->result_array();
        
    }


}