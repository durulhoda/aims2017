<?php

/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
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
        
    // $sql="SELECT semesterId,examtypeId,programOfferId,studentId,SUM(marks) as marks FROM studentmarks where `programOfferId`='".$data['programOfferId']."' AND `semesterId`='".$data['semesterId']."' AND `examtypeId`='".$data['examtypeId']."' GROUP BY studentId order by marks DESC" AND studentmarks.studentId='201710404';
      $sql="SELECT studentmarks.semesterId, studentmarks.examtypeId, studentmarks.programOfferId,studentmarks.studentId,programoffer.programLevel, SUM(studentmarks.marks) as marks FROM studentmarks JOIN programoffer ON studentmarks.programOfferId = programoffer.programOfferId where studentmarks.programOfferId='".$data['programOfferId']['programOfferId']."' AND studentmarks.semesterId='".$data['semesterId']."' GROUP BY studentId ORDER BY marks DESC";
      $query_result=$this->db->query($sql);
        $result=$query_result->result_array();
        return $result;
        
      
    }

    public function getHighestMarks($data){

        $sql="SELECT  MAX(studentmarks.marks) AS maxmarks
        FROM studentmarks
        WHERE studentmarks.programOfferId='".$data['programOfferId']."'
        AND studentmarks.semesterId='".$data['semesterId']."'
        AND studentmarks.examtypeId='".$data['examtypeId']."'
        AND studentmarks.courseId='".$data['courseId']."'
        ORDER BY marks DESC";

    $maxresult = $this->db->query($sql);
    $result=$maxresult->result_array();
    return $result;
    }


    
    public function getpositionbyclasst($data){
        $this->db->select(
                'SELECT 
    site_products.product_id, 
    SUM(stock amount) AS total_amount
    FROM site_products JOIN site_trans 
            ON site_products.product_id = site_trans.trans_product 
    GROUP BY site_products.product_id'
                );
        
        $result = mysql_query("SELECT studentmarks.semesterId, studentmarks.examtypeId, studentmarks.programOfferId,studentmarks.studentId, SUM(studentmarks.marks) FROM studentmarks JOIN programOffer ON studentmarks.programOfferId = studentmarks.programOfferId GROUP BY studentmarks.studentId");
        
        $this->db->from('studentmarks st_mrk');
        $this->db->join('programOffer prmid', 'prmid.programOfferId=st_mrk.programOfferId');
        $this->db->where('st_mrk.programOfferId', $data['programOfferId']);
        $this->db->where('st_mrk.semesterId', $data['semesterId']);
        $this->db->where('st_mrk.examtypeId', $data['examtypeId']);
       // $this->db->select_sum('st_mrk.marks');
        $query= $this->db->get();
        $result= $query->result_array();
        if(!empty($result)){
            return $result;
        }
        
    }

    

    public function getPositionByClasstabulation($data) {
        
      $sql="SELECT semesterId,examtypeId,programOfferId,studentId,SUM(marks) as marks FROM studentmarks where `programOfferId`='".$data['programOfferId']."' AND `semesterId`='".$data['semesterId']."' AND `examtypeId`='".$data['examtypeId']."' GROUP BY studentId order by studentId ASC";
     $query_result=$this->db->query($sql);
        $result=$query_result->result_array();
        return $result;
        
      
    }
    
      public function getPositionBytabulation($data) {
        
      $sql="SELECT semesterId,programOfferId,studentId,SUM(marks) as marks FROM studentmarks where `programOfferId`='".$data['programOfferId']."' AND `semesterId`='".$data['semesterId']."' GROUP BY studentId order by marks DESC";
     $query_result=$this->db->query($sql);
        $result=$query_result->result_array();
        return $result;
        
      
    }
    
     public function getStudentResult($data) 
      {
        $this->db->select('marks.courseId, course.courseCode');
        $this->db->from('studentmarks as marks');
        $this->db->where('marks.semesterId',$data['semesterId']);
        $this->db->where('marks.studentId',$data['studentId']);
        $this->db->where('marks.examtypeId',$data['examtypeId']);
        $this->db->where('marks.programOfferId',$data['programOfferId']['programOfferId']);
        $this->db->join('course as course','course.courseId = marks.courseId');
        $this->db->group_by('marks.courseId');
        $this->db->order_by('marks.courseId',"ASC");
        $qu = $this->db->get();

        $result = $qu->result_array();

          return $result;

      }
    
    public function deleteStudentmarksInfo($id){
        $qu = $this->db->where('studentId', $id);
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
            $this->db->select('st_mrk.*');
            $this->db->from('studentmarks st_mrk'); 
            $this->db->join('course sub', 'sub.courseId=st_mrk.courseId');    
            $this->db->where('st_mrk.studentId', $data['studentId']);
            $this->db->where('st_mrk.semesterId', $data['semesterId']);
            $this->db->order_by('sub.courseCode','ASC');
            $qu = $this->db->get();
            $result = $qu->result_array();
            // echo "<pre>";print_r($result);die();
            return $result;
            
        }
    }
        public function getmarksByStudentt($data) {
        if (!empty($data)) {
            $this->db->select('st_mrk.*');
            $this->db->from('studentmarks st_mrk'); 
            $this->db->join('course sub', 'sub.courseId=st_mrk.courseId');    
            $this->db->where('st_mrk.studentId', $data['studentId']);
            $this->db->where('st_mrk.semesterId', $data['semesterId']);
            $this->db->order_by('sub.courseCode','ASC');
              $query = $this->db->get();
        $result = $query->row_array();
        if(!empty($result)){
            return $result;   
        }
            
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
                
                $this->db->where('st_mrk.programOfferId', $data['programOfferId']['programOfferId']);
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
    public function getmarksByStudentTranscriptView($data)
    {
        if (!empty($data))
        {
            $this->db->select('st_mrk.*,sub.*,sem.*');
            $this->db->from('studentmarks st_mrk');
            $this->db->join('course sub', 'sub.courseId=st_mrk.courseId');
            $this->db->join('semester sem', 'sem.semesterId=st_mrk.semesterId');

            $this->db->where('st_mrk.studentId', $data['studentId']);
            $this->db->where('st_mrk.programOfferId', $data['programOfferId']);
            $this->db->where('st_mrk.semesterId', $data['semesterId']);

            $this->db->order_by('sub.courseCode', 'ASC');
            $this->db->group_by('st_mrk.courseId');
            $qu = $this->db->get();
            // print_r($this->db->last_query());
            // exit;
            return $qu->result_array();
        }
    }

    public function getmarksByStudentTranscriptView_new($data)
    {
        if (!empty($data))
        {
            $this->db->select('m_m.*,m_d.*');
            $this->db->select('s_m.examtypeId,s_m.divide_mark full_divide_mark,s_m.marks full_total_mark');
            $this->db->select('s_c.courseStatus,s_c.courseId');
            $this->db->from('marksheet_mst m_m');
            $this->db->join('marksheet_dtls m_d', 'm_d.master_id=m_m.id');
            $this->db->join('studentmarks s_m', 's_m.studentId="'.$data['studentId'].'" AND s_m.programOfferId="'.$data['programOfferId'].'" AND s_m.semesterId="'.$data['semesterId'].'"');
            $this->db->join('studentassigncourse s_c', 's_c.studentId="'.$data['studentId'].'" AND s_c.programOfferId="'.$data['programOfferId'].'"');
            $this->db->where('m_m.student_id', $data['studentId']);
            $this->db->where('m_m.program_offer_id', $data['programOfferId']);
            $this->db->where('m_m.semester_id', $data['semesterId']);

            $this->db->order_by('m_d.course_code', 'ASC');
            $this->db->group_by('m_d.course_id');
            return $this->db->get()->result_array();


//            $query = "SELECT
//            (SELECT MAX(MD.total_mark) FROM marksheet_dtls as MD where MD.program_offer_id=26 AND MD.semester_id=1 AND MD.course_id= GROUP BY MD.course_id=`s_c`.`courseId`) as hightest_mark,
//            `m_m`.*,
//            `m_d`.*,
//            `s_m`.`examtypeId`, `s_m`.`divide_mark` `full_divide_mark`, `s_m`.`marks` `full_total_mark`,
//            `s_c`.`courseStatus`, `s_c`.`courseId`
//             FROM `marksheet_mst` `m_m` JOIN `marksheet_dtls` `m_d` ON `m_d`.`master_id`=`m_m`.`id`
//             JOIN `studentmarks` `s_m` ON `s_m`.`studentId`=201805001 AND `s_m`.`programOfferId`=26 AND `s_m`.`semesterId`=1
//             JOIN `studentassigncourse` `s_c` ON `s_c`.`studentId`=201805001 AND `s_c`.`programOfferId`=26 WHERE `m_m`.`student_id` = 201805001 AND `m_m`.`program_offer_id` = 26 AND `m_m`.`semester_id` = 1
//             GROUP BY `m_d`.`course_id`
//             ORDER BY `m_d`.`course_code` ASC";
//            $this->db->query($query);
//
//            return $query->result_array();
        }
    }
    
    
     public function get_data($table,$where=false,$fields=false,$join_table=false,$other=false) {
        //pega os campos passados para o select

        if($fields!=false) {
            foreach ($fields as $coll => $value) {
                $this->db->select($value);
            }
        }
        //pega a tabela
        $this->db->from($table);
        // join table name and col on coz value
         if($join_table!=false) {

               if(is_array($other) && array_key_exists('join', $other)){
                foreach ($join_table as $coll => $value) {
                $this->db->join($coll, $value,$other['join']);
                 }
            }
            else{
            foreach ($join_table as $coll => $value) {
                $this->db->join($coll, $value);
                }
             }
        }
        // where col value as array
        if($where!=false){
            $this->db->where($where);
        }
        // other value like order by, group by and limit for other array
        if($other!=false){
            if(array_key_exists('or_where', $other)){
                $this->db->or_where($other['or_where']);
            }
              if(array_key_exists('order_by', $other)){
                $this->db->order_by($other['order_by'],'desc');
            }
            if(array_key_exists('group_by', $other)){
                $this->db->group_by($other['group_by']);
            }
            if(array_key_exists('limit', $other)){
                if(array_key_exists('offset', $other)){                 
                $this->db->limit($other['limit'],$other['offset']);
                    }
                else{
                    $this->db->limit($other['limit']);
                    }
            }

            if(array_key_exists('like', $other)){
                foreach ($other['like'] as $key => $value) {
                   $this->db->like($key, $value);
                }
                
            }
            if(array_key_exists('or_like', $other)){
                foreach ($other['or_like'] as $key => $value) {
                   $this->db->or_like($key, $value);
                }
                
            }
            //$this->db->group_by(1);
           
            
        }

        $query = $this->db->get();
        //return a result
        $result= $query->result_array();
       // print_r($this->db->last_query());
        return $result;
    }
    
    // used in admin/studentmarks/searchstudentlist
    public function searchsubject($data){
//        print_r($data);       
        
        if(!empty($data)){
        
            $qu = $this->db->get_where($this->_courseoffer, array(
                                            'courseId' => $data['courseId'],
                                            'programOfferId' => $data['programOfferId']['programOfferId'],
                                            'employeeId' => $data['employeeId']));
        $reault = $qu->result_array();
        if(!empty($reault))
        {
            return $reault;
        }   
             
        }        
    }

    
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
    
    
    public function savemarks($data)
    {
        $data['entryDate']=date("d-m-Y");
        $this->db->insert($this->_studentmarks, $data);
        return $this->db->insert_id();
    }
    
   // use to total view of student marks in admin >> result_view >> transcriptView 
    public function getExamMarks($data) {
      
        if(!empty($data['examtypeId']))
        {
         $this->db->select_sum('marks');
          $this->db->where('studentId',$data['studentId']); 
          $this->db->where('semesterId',$data['semesterId']); 
          $this->db->where('examtypeId',$data['examtypeId']); 
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

    public function getDivideMarks_bySubject($data) {
      
        if(!empty($data['examtypeId']))
        {
         $this->db->select('divide_mark');
          $this->db->where('studentId',$data['studentId']); 
          $this->db->where('semesterId',$data['semesterId']); 
          $this->db->where('examtypeId',$data['examtypeId']);
          $this->db->where('courseId',$data['courseId']); 
          $this->db->where('programOfferId',$data['programOfferId']['programOfferId']); 
          $qu = $this->db->get($this->_studentmarks);

          $result = $qu->row_array();

          return $result;
      }
      else{
           $this->db->select('divide_mark');
          $this->db->where('studentId',$data['studentId']); 
          $this->db->where('semesterId',$data['semesterId']); 
          $this->db->where('courseId',$data['courseId']); 
          $this->db->where('programOfferId',$data['programOfferId']['programOfferId']); 
          $qu = $this->db->get($this->_studentmarks);

          $result = $qu->row_array();

         return $result;
          
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
    
    public function getMark_stuid_corid_emtyp($studentId,$courseId) {
              
          $this->db->select('*');
          $this->db->where('studentId',$studentId); 
          $this->db->where('courseId',$courseId); 
        //  $this->db->where('mark_cat_id',$examtypeId); 
          
          $qu = $this->db->get($this->_studentmarks);
          $result = $qu->row_array();
          if(!empty($result))
          {
            return $result['divide_mark'];
          }
          else{ return "0";}
     
    }
    
      public function GetMarkBy_StuId_CouId_PrgId($studentId,$prgramOfferId,$semesterId,$courseId) {
              
          $this->db->select('*');
          $this->db->where('studentId',$studentId); 
          $this->db->where('programOfferId',$prgramOfferId); 
          $this->db->where('semesterId',$semesterId); 
          $this->db->where('courseId',$courseId); 
          
          $qu = $this->db->get($this->_studentmarks);
          $result = $qu->row_array();
          if(!empty($result))
          {
            return $result['divide_mark'];
          }
          else{ return "0";}
     
    }
    
    public function getMark_stuid_corid_semis_emtyp($studentId,$prgramOfferId,$semesterId,$courseId,$examtypeId) {
              
          $this->db->select('*');
          $this->db->where('studentId',$studentId); 
          $this->db->where('programOfferId',$prgramOfferId); 
          $this->db->where('semesterId',$semesterId); 
          $this->db->where('courseId',$courseId); 
          $this->db->where('examtypeId',$examtypeId); 
          
          $qu = $this->db->get($this->_studentmarks);
          $result = $qu->row_array();
          if(!empty($result))
          {
            return $result['marks'];
          }
          else{ return "0";}
     
    }
    
    
     // use for published result...
    public function getResultStatusByPrgid($data){
        $this->db->select('stu_info.*,prg.*,stu_mark.*,stu.*');
        $this->db->from('studentmarks stu_mark');             
        $this->db->join('programoffer prg', 'prg.programOfferId=stu_mark.programOfferId');
        $this->db->join('student stu', 'stu.studentId=stu_mark.studentId');
        $this->db->join('studentinfo stu_info', 'stu_info.applicationId=stu.applicationId');
        $this->db->where('stu_mark.programOfferId', $data['programOfferId']['programOfferId']);
        $this->db->where('stu_mark.semesterId', $data['semesterId']);
        $this->db->group_by('stu_mark.studentId');
        $this->db->order_by('stu_mark.marks',"DESC");
        $qu = $this->db->get();
        return $qu->result_array();
        
    }
    
    public function studentmarkslistbyexamtype($data){
        
        $this->db->select('*');
        $this->db->from('studentmarks');
        $this->db->where('semesterId',$data['semesterId']);
        $this->db->where('programOfferId',$data['programOfferId']);
        $this->db->where('examtypeId',$data['examtypeId']);
        $this->db->where('courseId',$data['courseId']);
        $qu=$this->db->get();
        return $qu->result_array();
    }
    
       public function checkexamtypelist($courseId,$programOfferId){
        
        $this->db->select('*');
         $this->db->from('studentmarks');      
       // $this->db->join('course cour', 'cour.courseId= cou_offer.courseId');          
        $qu = $this->db->get_where($this->_table, array('courseId' => $courseId,'programOfferId' => $programOfferId));
        $result=$qu->row_array(); 
        if(!empty($result))
        {
            return $result;
        }
    }
        
    


}