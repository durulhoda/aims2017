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
class CourseofferModleAdmin extends CI_Model{
    private $_table = "courseoffer";
    
    public function __construct() {
        parent::__construct();
    }
    
    
    public function addCourseofferInfo($data){
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();       
        
    }    
    
    
    // get course list as groupby from course offer table
    public function getCourseofferInfo(){
//        $this->db->order_by("id", "asc");
        $this->db->select('cour_off.*,cour.*')
                ->from('courseoffer cour_off');
        $this->db->join('course cour', 'cour.courseId= cour_off.courseId');
        $this->db->distinct();
        $this->db->group_by('cour_off.courseId');
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
    
    
    // Get Validate Offered course by employee/course & programofferId
    public function getValidateOfferedCourses($data) {

        $this->db->select('*');
        $qu = $this->db->get_where($this->_table, array('programOfferId' => $data['programOfferId'],'employeeId' => $data['employeeId'],'courseId' => $data['courseId']));
        $reault= $qu->result_array();
       return $reault;

    }
    
    
    public function getCommonCourseName($courseId) {
//        $this->db->select('campusName');        
        $this->db->select('categoryName');
        $this->db->where('categoryId',$courseId);
        $qu = $this->db->get($this->_table);
        return $qu->result_array();

    }
    public function getEmployeeIdBySubject($id){
        $this->db->select('employeeId');
        $qu = $this->db->get_where($this->_table, array('courseId' => $id));
        return $qu->result_array();  
    
    }
    
     public function getEmployeeIdByProgramAndSubject($programOfferId,$courseid){
        $this->db->select('employeeId');
        $this->db->where('programOfferId',$programOfferId);
        $this->db->where('courseId',$courseid);
        $this->db->group_by('employeeId');
        $qu = $this->db->get($this->_table);
        $result=$qu->row_array();
        if(!empty($result))
        {    
            return $result['employeeId'];  
        }
    }
    
   
    
    // Get Course List by employeeId & ProgramOfferId As Array
     public function getCourseIdByTeacher($data) {
        
        $this->db->select('courseId');
        $this->db->where('employeeId',$data['employeeId']);
        $this->db->where('programOfferId',$data['programOfferId']);
        $qu = $this->db->get($this->_table);
        $result= $qu->result_array();
        if(!empty($result))
        {
            return $result;
        }

    }
    
    
    
     public function getOptionalCourseName($courseId) {
//        $this->db->select('campusName');        
        $this->db->select('categoryName');
        $this->db->where('categoryId',$courseId);
        $qu = $this->db->get($this->_table);
        return $qu->result_array();

    }
     public function getOfferedCourseInfoByCourse($courseId) {
         $this->db->select('*');
        $qu = $this->db->get_where($this->_table, array('courseId' => $courseId));
       return $qu->result_array(); 
    }
    public function getCourseMarks($data) {
        $qu = $this->db->get_where($this->_table, array('programOfferId' => $data['programOfferId'],'courseId' => $data['courseId']));
        $reaults = $qu->row_array();
        if(!empty($reaults['marks'])){
            return $reaults['marks'];
        }
        else{
            echo '000';
        }
    }
    public function searchcourseofferlist($data){

       if(!empty($data)){
          $this->db->select('cou_offer.*,cour.*,prg.*,ses.*,mdm.*,grp.*,sht.*,sct.*,emp.employeeId,emp.firstName,emp.middleName,emp.lastName,emp.phone,emp.email')
                ->from('courseoffer cou_offer');
            $this->db->join('programoffer prg_offer', 'cou_offer.programOfferId= prg_offer.programOfferId');
            $this->db->join('program prg', 'prg.programId= prg_offer.programId');
            $this->db->join('session ses', 'ses.sessionId= prg_offer.sessionId');
            $this->db->join('medium mdm', 'mdm.mediumId= prg_offer.mediumId');
            $this->db->join('group grp', 'grp.groupId= prg_offer.groupId');
            $this->db->join('shift sht', 'sht.shiftId= prg_offer.shiftId');
            $this->db->join('section sct', 'sct.sectionId= prg_offer.sectionId');
            $this->db->join('employee emp', 'emp.employeeId= prg_offer.employeeId');
            $this->db->join('course cour', 'cour.courseId= cou_offer.courseId');

            $this->db->where('cou_offer.status', $data['status']);
            $this->db->where('cou_offer.programOfferId', $data['programOfferId']);
           
            $query = $this->db->get();      
       
            $result = $query->result_array();
            if(!empty($result)){
                return $result;
            }
       
        }        
  } 
  
  public function searchcourseassignlist($data){
      
      
      $result = $this->db->get($this->_table, 
                                        array('campusId' => $data['campusId'],
                                              'programId' => $data['classId'],
                                              'mediumId' => $data['mediumId'],
                                              'groupId' => $data['groupId'],
                                              'shiftId' => $data['shiftId'],
                                              'sectionId' => $data['sectionId'],
                                              'session' => $data['sessionId'])
                                             );
        return $result->result_array();  
    }
    
    
    // use for after student registration studentregistration >> insertregistrationconfirm
    public function CheckOfferedCourseAssign($datas){
     
         $this->db->select('*');
         
         $this->db->where('programOfferId',$datas);
         $this->db->order_by('categoryName','ASC');
        
        $result = $this->db->get($this->_table);    
        $return=$result->result_array();
        if(!empty($return))
        {
            return $return; 
        }
       
    
    }
    
    public function getAssignTeacher($courseId) { 
        $qu = $this->db->get_where($this->_table, array('courseId' => $courseId));
        $reault = $qu->row_array();
        if(!empty($reault))
        {
            return $reault['employeeId'];
        }
       
    }
    
     public function editCourseofferInfo($id) {
        if(!empty($id)){
          $this->db->select('cou_offer.*,cour.*,prg_offer.*')
                ->from('courseoffer cou_offer');
            $this->db->join('programoffer prg_offer', 'cou_offer.programOfferId= prg_offer.programOfferId');           
            $this->db->join('employee emp', 'emp.employeeId= cou_offer.employeeId');
            $this->db->join('course cour', 'cour.courseId= cou_offer.courseId');
            $this->db->where('cou_offer.offerId', $id);
            
            $query = $this->db->get();             
            $result = $query->row_array();
            if(!empty($result)){
                return $result;
            }       
        }        
    }

    public function updateCourseofferInfo($data, $id) {

        $this->db->where('offerId', $id);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows();
    }

    public function deleteCourseofferInfo($id) {
        $qu = $this->db->where('offerId', $id);
        $this->db->delete($this->_table);
        return $this->db->affected_rows();
    }
  
    public function duplicateCourseofferInfo($data) {
        $qu = $this->db->get_where($this->_table, array('programOfferId' => $data['programOfferId'],'employeeId' => $data['employeeId'],'courseId' => $data['courseId'],'categoryName' => $data['categoryName'],'marks' => $data['marks']));
        $reault = $qu->row_array();
        return $reault;
    }
    
   /* used for validation to insert courseoffer details
  
 /*   public function duplicateCourseofferInfo2($data) {
        $qu = $this->db->get_where($this->_table, array('campusId' => $data['campusId'],'mediumId' => $data['mediumId'],'programId' => $data['programId'],'groupId' => $data['groupId'],'shiftId' => $data['shiftId'],'sectionId' => $data['sectionId'],'session' => $data['session'],'employeeId' => $data['employeeId'],'courseId' => $data['courseId']));
        $reault = $qu->row_array();
        return $reault;
    }  */
    
    public function getTeacherCourseList($employeeId) {
        $this->db->select('*');
        $this->db->where('employeeId',$employeeId);
        $qu = $this->db->get($this->_table);
        return $qu->result_array();

    } 
    
   
    
    //put your code here
}

