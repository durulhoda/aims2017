<?php

/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class CourseModleAdmin extends CI_Model{
    //put your code here
     private $_table = "course";

    public function __construct() {
        parent::__construct();
    }
    
    
    public function addCourseInfo($data){
//        print_r($data); exit;
        
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();       
        
    }    
    
    public function getlistCourse(){
        $this->db->order_by('courseCode','ASC'); 
        $result = $this->db->get($this->_table);
        return $result->result_array();  
    }
    public function getlistbyprogramLevel($data){
        $this->db->select('*')->from('course');;
        $this->db->where($data,'programLevel');
        $this->db->order_by('courseCode', "asc");
        $qu = $this->db->get();
        $result = $qu->result_array();
        
        if(!empty($result)){
            return $result;
    }
}


    public function getCourseInfo(){
//        $this->db->order_by("id", "asc");
        $qu = $this->db->get($this->_table);
        return $qu->result_array();
    }
    
    public function getCourseInfoArray(){
         $this->db->select('courseId, courseName');
         $this->db->order_by("courseCode", "asc");
         $qu = $this->db->get($this->_table);
        return $qu->result_array();
    }
    public function getCourseName($courseId) {
//        $this->db->select('campusName');        
        $qu = $this->db->get_where($this->_table, array('courseId' => $courseId));
        $reault = $qu->row_array();
        return $reault['courseName'];

    }
    public function getCourseCode($courseId) {
//        $this->db->select('campusName');        
        $qu = $this->db->get_where($this->_table, array('courseId' => $courseId));
        $reault = $qu->row_array();
        return $reault['courseCode'];

    }
    
    public function getCourseListBYPrglevelId($prglvlId) {
        $this->db->order_by("courseCode", "asc");
        $qu = $this->db->get_where($this->_table, array('programLevel' => $prglvlId));
        $reault = $qu->result_array();
        return $reault;

    }
    
    function getSubjectValue($classid) {
        $this->db->select('sub.*,cl.*')
                ->from('course sub');
         $this->db->join('program cl', 'cl.programLevel= sub.programLevel');
         $this->db->where('cl.programId', $classid);
         $this->db->order_by('sub.courseCode', "ASC");
         $this->db->group_by('sub.courseName');
         
        $query=$this->db->get();
       
        $result = $query->result_array();
        if(!empty($result)){
            return $result;
        }
    }
    
       function getSubjectValuebyteacher($classid,$userName) {
        $this->db->select('sub.*,cl.*,cur.*')
                ->from('course sub');
         $this->db->join('program cl', 'cl.programLevel= sub.programLevel');
           $this->db->join('courseoffer cur', 'cur.courseId= sub.courseId');
         $this->db->where('cl.programId', $classid);
         $this->db->where('cur.employeeId', $userName);
         
         $this->db->order_by('sub.courseCode', "ASC");
         $this->db->group_by('sub.courseName');
         
        $query=$this->db->get();
       
        $result = $query->result_array();
        if(!empty($result)){
            return $result;
        }
    }
    
          public function getOfferedProgramallList($data) {
        $this->db->select('*')
            ->from('courseoffer ');

        $this->db->where('programOfferId', $data['programOfferId']);
        $query = $this->db->get();

        $result = $query->result_array();
        if (!empty($result)) {
            return $result;
        }
    }
    
        function getOfferedprogramId_Subjectid_byEMP($classid) {
        $this->db->select('sub.courseName,sub.courseId,sub.courseCode')
                ->from('courseoffer cour_off');
         $this->db->join('course sub', 'sub.courseId= cour_off.courseId');
         $this->db->join('programoffer prg', 'prg.programOfferId= cour_off.programOfferId');
         $this->db->where('prg.programofferId', $classid);
         //$this->db->where('cour_off.employeeId', $employeeId);
         $this->db->order_by('sub.courseCode', "ASC");
         
        $query=$this->db->get();
       
        $result = $query->result_array();
        if(!empty($result)){
            return $result;
        }}
    
    
      public function editCourseInfo($id) {
        $qu = $this->db->get_where($this->_table, array('courseId' => $id));
        return $qu->row_array();
    }

    public function updateCourseInfo($data, $id) {

        $qu = $this->db->where('courseId', $id);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows();
    }

    public function deleteCourseInfo($id) {
        $qu = $this->db->where('courseId', $id);
        $this->db->delete($this->_table);
        return $this->db->affected_rows();
    }
    
     public function checkCourseInfo($id){
        $this->db->select('cors.*,cors_offer.*');
        
        $this->db->from('course cors');
        $this->db->join('courseoffer cors_offer', 'cors.courseId = cors_offer.courseId');
       
           $this->db->where('cors_offer.courseId', $id);
           
        $query = $this->db->get();
        $result = $query->result_array();
        if (!empty($result)) {
            return $result;
        }
    }
    
    public function duplicateCourseInfo($data) {
//        $this->db->select('campusName');        
        $qu = $this->db->get_where($this->_table, array('courseName' => $data['courseName'],'courseCode' => $data['courseCode'],'programLevel' => $data['programLevel']));
        $reault = $qu->row_array();
        return $reault;
    }
    public function get_courses(){
        $this->db->select('*');
        $this->db->from('course');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
}


