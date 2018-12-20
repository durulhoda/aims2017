<?php

/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class Result_viewModleAdmin extends CI_Model {

    public $subj = 1;
    public $obj = 2;
    public $prti = 3;
    public $sba = 4;

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

    public function getCourseOfferList($programOfferId = 0) {
        $where = [];
        if ($programOfferId) {
            $where['co.programOfferId'] = $programOfferId;
        }
        $records = $this->db
                    ->select('c.courseId, c.courseName, md.mark_cat_id,co.marks')
                    ->from('courseoffer AS co')
                    ->join('course AS c','c.courseId = co.courseId')
                    ->join('mark_divide AS md','co.offerId = md.course_offerId','left')
                    ->where($where)
                    ->get()
                    ->result_array();
    // echo '<pre>';print_r($records);exit;
        return $records;

    }

    public function getStudentMarkList($programOfferId = 0, $semesterId = 0) {
         $where = [];
        if ($programOfferId) {
            $where['mst.program_offer_id'] = $programOfferId;
        }
        if ($semesterId) {
            $where['mst.semester_id'] = $semesterId;
        }

        $records = $this->db 
                    ->select('
                            mst.student_id,
                            mst.position,
                            mst.total_marks,
                            mst.total_obtain_marks,
                            mst.total_common_marks,
                            mst.total_obtain_common_marks,
                            mst.gpa_point,
                            mst.gpa_letter,
                            mst.tot_fail_subj,
                            dtls.course_id,
                            dtls.cal_mark,
                            dtls.total_mark AS sub_total_mark,
                            dtls.gpa_letter AS sub_gpa_letter
                        ')
                    ->from('marksheet_mst AS mst')
                    ->join('marksheet_dtls AS dtls', 'mst.id = master_id', 'left')
                    ->where($where)
                    ->get()
                    ->result();

//        echo '<pre>';
//        print_r($records);exit;

        $dtl_arr = [];
        $mst_arr = [];
        if ($records) {
            foreach ($records as $key => $val) {
                $cal_mark = explode(" ",trim($val->cal_mark));
                $cal_len = count($cal_mark);
                $c_mark = [];
                for ($i = 0; $i< $cal_len; $i++) {
                    $first_char = substr($cal_mark[$i], 0, 1);
                    if (trim($first_char) == "C") {
                        $cate_id = $this->subj;
                    } elseif (trim($first_char) == "O") {
                        $cate_id = $this->obj;
                    } elseif (trim($first_char) == "P") {
                        $cate_id = $this->prti;
                    } elseif (trim($first_char) == "S") {
                        $cate_id = $this->sba;
                    } else {
                        $cate_id = 0;
                    }
                    $mark_value = substr($cal_mark[$i],2);
                    $c_mark[$cate_id] = $mark_value;
                }
                $dtl_arr[$val->student_id][$val->course_id] = [
                    /*'cal_mark' => $cal_mark, */
                    'c_mark' => $c_mark,
                    'sub_total_mark' => $val->sub_total_mark,
                    'sub_gpa_letter' => $val->sub_gpa_letter
                ];

                $mst_arr[$val->student_id] = [
                    'position' => $val->position,
                    'total_marks' => $val->total_marks,
                    'total_obtain_marks' => $val->total_obtain_marks,
                    'total_common_marks' => $val->total_common_marks,
                    'total_obtain_common_marks' => $val->total_obtain_common_marks,
                    'gpa_point' => $val->gpa_point,
                    'gpa_letter' => $val->gpa_letter,
                    'tot_fail_subj' => $val->tot_fail_subj
                ];
            }
        }
        $arr = ['mst_arr' => $mst_arr, 'dtl_arr' => $dtl_arr];
        return $arr;
        // echo '<pre>';print_r($records);
        // echo '<pre>';print_r($arr);
        // exit;
    }

    public function getStudentAssignList($programOfferId = 0) {
         $where = [];
        if ($programOfferId) {
            $where['sac.programOfferId'] = $programOfferId;
        }
         $records = $this->db 
                    ->select('si.firstName, sac.studentId')
                    ->from('studentassigncourse AS sac')
                    ->join('student AS s','sac.studentId = s.studentId AND s.programOfferId = '.$programOfferId.'')
                    ->join('studentinfo AS si','s.applicationId = si.applicationId')
                    ->where($where)
                    ->get()
                    ->result();
        return $records;
    }

   public function tabulationsheetformet($data) {
        //Modified By ROY(17Nov,2016)    
        $this->db->select('couOf.programOfferId,couOf.courseId,couOf.marks,sub.courseCode'); 
        $this->db->from('courseoffer couOf');
        $this->db->join('course sub', 'sub.courseId=couOf.courseId');   
        //--------------------------------------------------------------------
        $this->db->where('couOf.programOfferId', $data['programOfferId']['programOfferId']);
 $this->db->order_by('courseCode', 'ASC');
        $qu = $this->db->get();
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
            $this->db->order_by('st_m.studentId','ASC');
            $this->db->group_by('st_m.studentId');
           
            $query = $this->db->get();
            $result = $query->result_array();
            if(!empty($result)){
                return $result;   
           }

        }

    public function getStudent_BYProgramSemester($data){
       // print_r($data); die();
            $this->db->select('stu_info.firstName,stu_info.lastName,st_m.studentId,st_m.divide_mark,st_m.programOfferId');
            $this->db->from('studentmarks st_m');        
            $this->db->join('programoffer prg', 'prg.programOfferId=st_m.programOfferId');
            $this->db->join('student stu', 'stu.studentId=st_m.studentId');
            $this->db->join('studentinfo stu_info', 'stu_info.applicationId=stu.applicationId');
            $this->db->where('st_m.programOfferId', $data['programOfferId']['programOfferId']); 
            $this->db->where('st_m.semesterId', $data['semesterId']); 
            $this->db->order_by('st_m.studentId','ASC');
            $this->db->group_by('st_m.studentId');
          //  $this->db->limit(1);
            $query = $this->db->get();
            $result = $query->result_array();
            if(!empty($result)){
                return $result;   
           }

        }    

}

