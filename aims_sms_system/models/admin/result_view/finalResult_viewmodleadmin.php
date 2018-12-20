<?php

/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class Result_viewModleAdmin extends CI_Model {

    //put your code here
    // private $_table = "gradesheet";
    private $_table1 = "studentmarks";
    private $_table2 = "publishedresult";
    private $_courseoffer = "courseoffer";
    private $_student = "student";
     private $_markdivide = "mark_divide";

    public function __construct() {
        parent::__construct();
    }

    public function addresult_viewInfo($data) {
//        print_r($data); exit;

        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();
    }

    // check student result published or not from student result_view
    public function checkstudentresultstatus($data) {

        //   print_r($data); die();
        $resultstatus = 1;
        $qu = $this->db->get_where($this->_table2, array('studentId' => $data['studentId'], 'semesterId' => $data['semesterId'], 'programOfferId' => $data['programOfferId'], 'result_status' => $resultstatus));
        $reault = $qu->row_array();
        return $reault;
    }

    //......use for  view student result (admin >> result_view >> index.php) 
    public function getmarksByStudent($data) {
        if (!empty($data)) {
            $this->db->where('studentId', $data['studentId']);
            $this->db->where('semesterId', $data['semesterId']);

            $qu = $this->db->get($this->_table1);
            return $qu->result_array();
        }
    }

   public function getmarksByStudentTranscriptView($data) {
       if (!empty($data)) {
           $this->db->where('studentId', $data['studentId']);
           $this->db->where('programOfferId', $data['programOfferId']);
         //  $this->db->where('semester', $data['semester']);

           $this->db->group_by('courseId');
           $qu = $this->db->get($this->_table1);
           return $qu->result_array();
       }
   }
   
   public function getResultMarks_BYclass_student_semester($data) {
           $this->db->select('st_mrk.*');
           $this->db->from('studentmarks st_mrk');  
           $this->db->join('course sub', 'sub.courseId=st_mrk.courseId');   
           $this->db->where('st_mrk.studentId', $data['studentId']);
           $this->db->where('st_mrk.programOfferId', $data['programOfferId']);
           $this->db->where('st_mrk.semesterId', $data['semesterId']);
           $this->db->order_by('sub.courseCode','ASC');
           $this->db->group_by('sub.courseId');
           $qu = $this->db->get($this->_table1);
           return $qu->result_array();
      
   }
   
   

    public function getmarksByClass($data) {
        
      
    if (!empty($data['courseId']) && !empty($data['exam_type'])) {
            
            $this->db->select('*');
            $this->db->where('programOfferId', $data['programOfferId']);
            $this->db->where('courseId', $data['courseId']);
            $this->db->where('semester', $data['semester']);
            $this->db->where('exam_type', $data['exam_type']);
            $this->db->order_by('marks', 'desc');
            $qu = $this->db->get($this->_table1);
            return $qu->result_array();
        } else {
       //       print_r($data); die();
            $this->db->select('*');
            $this->db->where('programOfferId', $data['programOfferId']);
            $this->db->where('courseId', $data['courseId']);
            $this->db->where('semester', $data['semester']);
        //    $this->db->where('exam_type', $data['exam_type']);
            $this->db->order_by('marks', 'desc');
            $qu = $this->db->get($this->_table1);
            return $qu->result_array();
        }
    }

    public function tabulationsheetformet($data) {
        $this->db->where('programOfferId', $data['programOfferId']);

        $qu = $this->db->get($this->_courseoffer);
        return $qu->result_array();
    }

    public function getdividevalue() {
            $this->db->select('*');
       // $this->db->where('course_offerId', $courseId);

        $qu = $this->db->get($this->_markdivide);
        return $qu->r_array();
    }

    public function getMarkCategory_ByCourse($courseId,$programOfferId) {
        $this->db->select('mark_dvd.mark_cat_id, mark_dvd.divide_mark, mark_dvd.mark_percent');
        $this->db->from('mark_divide as mark_dvd');
        $this->db->join('courseoffer couOf', 'couOf.offerId=mark_dvd.course_offerId','left join');
        $this->db->where('couOf.courseId', $courseId);
        $this->db->where('couOf.programOfferId', $programOfferId);
        
         $query = $this->db->get();
            $result = $query->row_array();
            if(!empty($result)){
                return $result;   
           }
    }

    public function getdividevaluee($data) {
        $this->db->select('stu_mrk.*,cur.*');
        $this->db->from('studentmarks stu_mrk');
        $this->db->join('courseoffer cur', 'stu_mrk.courseId=cur.courseId');
        $this->db->where('cur.programOfferId', $data['programOfferId']);
         $this->db->where('stu_mrk.semesterId', $data['semesterId']);

         $query = $this->db->get();
            $result = $query->result_array();
            if(!empty($result)){
                return $result;   
           }
    }

    // Find student list or a single student with Enrollment information or studentId..use for pormotion
    public function getStudentMarksList($data){
       
            $this->db->select('stu.*,stu_info.*,prg.*,st_m.*');
            $this->db->from('studentmarks st_m');        
            $this->db->join('programoffer prg', 'prg.programOfferId=st_m.programOfferId');
            $this->db->join('student stu', 'stu.studentId=st_m.studentId');
            $this->db->join('studentinfo stu_info', 'stu_info.applicationId=stu.applicationId');
            $this->db->where('st_m.programOfferId', $data['programOfferId']); 
            $this->db->order_by('st_m.studentId','ASC');
            $query = $this->db->get();
            $result = $query->result_array();
            if(!empty($result)){
                return $result;   
           }

        }
    // Find student list or a single student with Enrollment information or studentId..use for pormotion
    public function getStudentMarksList_withSemester($data){
       // print_r($data); die();
            $this->db->select('stu.*,stu_info.applicationId,stu_info.firstName,stu_info.lastName,prg.programOfferId,st_m.*');
            $this->db->from('studentmarks st_m');        
            $this->db->join('programoffer prg', 'prg.programOfferId=st_m.programOfferId');
            $this->db->join('student stu', 'stu.studentId=st_m.studentId');
            $this->db->join('studentinfo stu_info', 'stu_info.applicationId=stu.applicationId');
            $this->db->where('st_m.programOfferId', $data['programOfferId']); 
            $this->db->where('st_m.semesterId', $data['semesterId']); 
            $this->db->group_by('st_m.studentId');
            $this->db->order_by('st_m.studentId','ASC');
            
            $query = $this->db->get();
            $result = $query->result_array();
            if(!empty($result)){
                return $result;   
           }

        }

}

