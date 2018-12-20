<?php

/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class CourseAssignModleAdmin extends CI_Model{
    private $_table = "studentassigncourse";
    
    public function __construct() {
        parent::__construct();
    }
    
    
    public function addCourseofferInfo($data){
  //  print_r($data); exit;
        
        $data['status']="Subject Offered for ". $data['session'];
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();       
        
    }    
    
    
    
    public function getCourseofferInfo(){
//        $this->db->order_by("id", "asc");
        $this->db->select('*');
        $this->db->distinct();
        $this->db->group_by('courseId');
        $qu = $this->db->get($this->_table);
        return $qu->result_array();
    }
    public function getOfferedCourseList($programId) {
//        $this->db->select('campusName');        
        $this->db->select('courseId');
        $this->db->where('programId',$programId);
        $qu = $this->db->get($this->_table);
        return $qu->result_array();

    } 
    
    
    public function getCommonCourseName($courseId) {
//        $this->db->select('campusName');        
        $this->db->select('categoryName');
        $this->db->where('categoryId',$courseId);
        $qu = $this->db->get($this->_table);
        return $qu->result_array();

    }
     public function getOptionalCourseName($courseId) {
//        $this->db->select('campusName');        
        $this->db->select('categoryName');
        $this->db->where('categoryId',$courseId);
        $qu = $this->db->get($this->_table);
        return $qu->result_array();

    }
    
    /*
    public function searchcourseofferlist($data){
//        print_r($data);       
        
       if(!empty($data)){
        $campusId = $data['campusId'];
        $mediumId = $data['mediumId'];
        $programId = $data['programId'];
        $groupId = $data['groupId'];
        $sectionId = $data['sectionId'];
        $shiftId = $data['shiftId'];
        $session = $data['session'];
        
        $this->db->like('campusId',$data['campusId']);
        $this->db->like('mediumId',$data['mediumId']);
        $this->db->like('programId',$data['programId']);
        $this->db->like('groupId',$data['groupId']);
        $this->db->like('sectionId',$data['sectionId']);
        $this->db->like('shiftId',$data['shiftId']);
        $this->db->like('session',$data['session']);        
        
        $qu = $this->db->get($this->_table);
        return $qu->result_array();
        }        
  } 
  
     
     */
  public function AssignedCourseStudents($data){
         
            $this->db->select('st_cor.*,stu.*,stu_info.*,prg.*');
            $this->db->from('studentassigncourse st_cor');        
            $this->db->join('programoffer prg', 'prg.programOfferId=st_cor.programOfferId');
            $this->db->join('student stu', 'prg.programOfferId=stu.programOfferId');
            $this->db->join('student', 'stu.studentId=st_cor.studentId');
            $this->db->join('studentinfo stu_info', 'stu_info.applicationId=stu.applicationId');
            $this->db->where('st_cor.programOfferId', $data['programOfferId']['programOfferId']); 
            $this->db->group_by('st_cor.studentId'); 
          //  $this->db->order_by('st_cor.studentId','DESC');
            $query = $this->db->get();
            $result = $query->result_array();
            if(!empty($result)){
                return $result;   
           }
         
    }
    
    public function AssignedCourseStudentlist($datas){
      
      
      $result = $this->db->get($this->_table, 
                                        array( 
                                            'employeeId' => $datas['employeeId'],
                                            'courseId' => $datas['courseId']
                                            
                                            ) );
        return $result->result_array();  
    }
    
    public function CheckOfferedCourseAssign($data){
      
        $this->db->select('*');
            $this->db->like('campusId',$data['campusId']);
         $this->db->like('programId',$data['classId']);
         $this->db->like('shiftId',$data['shiftId']);
         $this->db->like('sectionId',$data['sectionId']);
         $this->db->like('mediumId',$data['mediumId']);
         $this->db->like('groupId',$data['groupId']);
         $this->db->like('session',$data['sessionId']);
        
        $result = $this->db->get($this->_table);
        
        return $result->result_array();  
    
    }
    
    
    
//       public function getAssignTeacher($courseid){
//         
//           $this->db->select('employeeId');
//           $this->db->from('courseoffer1');
//           $this->db->where('courseId',$courseid);
//            $query_result = $this->db->get();
//            $result = $query_result->result_array();
//            return $result; 
//        
//    }
    public function getAssignTeacher($courseId) {
//        $this->db->select('campusName');        
        $qu = $this->db->get_where($this->_table, array('courseId' => $courseId));
        $reault = $qu->row_array();
        if(!empty($reault))
        {
            return $reault['employeeId'];
        }
       
    }
    

    
    // Get Course List by employeeId & ProgramOfferId As Array
     public function getCourseIdByStudent($data) {
        
        $this->db->select('*');
        $this->db->where('studentId',$data['studentId']);
        $this->db->where('programOfferId',$data['programOfferId']);
        $qu = $this->db->get($this->_table);
        $result= $qu->row_array();
        if(!empty($result))
        {
            return $result;
        }

    }
     public function editCourseofferInfo($id) {
        $qu = $this->db->get_where($this->_table, array('offerId' => $id));
        return $qu->row_array();
    }

    public function updateCourseofferInfo($data, $id) {

        $qu = $this->db->where('offerId', $id);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows();
    }

    public function deleteCourseofferInfo($id) {
        $qu = $this->db->where('offerId', $id);
        $this->db->delete($this->_table);
        return $this->db->affected_rows();
    }
    
    
    public function duplicateCourseofferInfo($data) {
//        $this->db->select('campusName');        
        $qu = $this->db->get_where($this->_table, array('campusId' => $data['campusId'],'mediumId' => $data['mediumId'],'programId' => $data['programId'],'groupId' => $data['groupId'],'shiftId' => $data['shiftId'],'sectionId' => $data['sectionId'],'employeeId' => $data['employeeId'],'session' => $data['session'],'courseId' => $data['courseId'],'categoryName' => $data['categoryName'],'marks' => $data['marks'],'curriculumId' => $data['curriculumId']));
        $reault = $qu->row_array();
        return $reault;
    }
    
    
     public function AssignedCourselistbyStudents($data){
         
            $this->db->select('st_cor.*,prg.*');
            $this->db->from('studentassigncourse st_cor');        
            $this->db->join('programoffer prg', 'prg.programOfferId=st_cor.programOfferId');
            $this->db->where('st_cor.programOfferId', $data['programOfferId']); 
            $this->db->limit(1); 
            $query = $this->db->get();
            $result = $query->result_array();
            if(!empty($result)){
                return $result;   
           }
         
    }
    
    
    /*
    public function getTeacherCourseList($employeeId) {
//        $this->db->select('campusName');   
       
        $this->db->select('*');
        $this->db->where('employeeId',$employeeId);
        $this->db->distinct();
        $this->db->group_by('programId','sectionId','session','mediumId','shiftId','groupId');
        $qu = $this->db->get($this->_table);
        return $qu->result_array();

    } 
    */
    //put your code here
}

