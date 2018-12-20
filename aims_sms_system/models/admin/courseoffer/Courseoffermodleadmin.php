<?php
class CourseofferModleAdmin extends CI_Model{
    private $_table = "courseoffer";
    private $_markcatagory = "mark_category";
     private $_tablecourse = "course";
      private $_table_dvdmark = "mark_divide";
       private $_studentmarks = "studentmarks";
    
    public function __construct() {
        parent::__construct();
    }
    
    
    public function addCourseofferInfo($data){
        // echo "<pre>";
        // print_r($data);die();
        if ($data['employeeId'] && $data['marks'] && $data['courseId']){
            $this->db->insert($this->_table, $data);
            //return $this->db->insert_id();   
        }    
        
    }    
    
    
    // get course list as groupby from course offer table
    public function getCourseofferInfo(){
//        $this->db->order_by("id", "asc");
        $this->db->select('cour_off.*,cour.*')
                ->from('courseoffer cour_off');
        $this->db->join('course cour', 'cour.courseId= cour_off.courseId');
     //   $this->db->distinct();
        $this->db->group_by('cour.courseId');
        $qu = $this->db->get();
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
    
    public function getcourseOfferId($arry){
       // echo "<pre>";
       // print_r($arry);die();
        $this->db->select('*');
        $this->db->where('programOfferId',$arry['programOfferId']['programOfferId']);
        $this->db->where('courseId',$arry['courseId']);
        $qu = $this->db->get($this->_table);
        $result=$qu->row_array();
        if(!empty($result))
        {    
            return $result;  
        }
    }

    public function getcourseOfferId1($courseId = 0, $programOfferId = 0){
       // echo "<pre>";
       // print_r($arry);die();
        $this->db->select('*');
        $this->db->where('programOfferId',$programOfferId);
        $this->db->where('courseId',$courseId);
        $qu = $this->db->get($this->_table);
        $result=$qu->row_array();
        if(!empty($result))
        {    
            return $result;  
        }
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
    
    function getOfferedprogramId_Subjectid_byEMP($classid,$employeeId) {
        $this->db->select('sub.courseName,sub.courseId,sub.courseCode')
                ->from('courseoffer cour_off');
         $this->db->join('course sub', 'sub.courseId= cour_off.courseId');
         $this->db->join('programoffer prg', 'prg.programOfferId= cour_off.programOfferId');
         $this->db->where('prg.programId', $classid);
         $this->db->where('cour_off.employeeId', $employeeId);
         $this->db->order_by('sub.courseCode', "ASC");
         
        $query=$this->db->get();
       
        $result = $query->result_array();
        if(!empty($result)){
            return $result;
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
    
    public function GetSubjectInformation($subjectId,$programOfferId){
        
        $this->db->select('sub.courseId,sub.courseName,so.marks as FullMark,sub.courseCode');
        $this->db->from('courseoffer so');
        $this->db->join('course sub','sub.courseId=so.courseId');        
        $this->db->where('so.courseId',$subjectId);
        $this->db->where('so.programOfferId',$programOfferId);       
        
        $result=$this->db->get();
        $query=$result->row_array();
        if(!empty($query)){
            return $query;
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
       //echo "<pre>";print_r($data);die();
        $qu = $this->db->get_where($this->_table, array('programOfferId' => $data['programOfferId'],'courseId' => $data['courseId']));
        $reaults = $qu->row_array();
        if(!empty($reaults['marks'])){
            return $reaults['marks'];
        }
        
    }
    public function getCourseMarksAnother($data) {
       //echo "<pre>";print_r($data);die();
        $qu = $this->db->get_where($this->_table, array('programOfferId' => $data['programOfferId']['programOfferId'],'courseId' => $data['courseId']));
        $reaults = $qu->row_array();
        if(!empty($reaults['marks'])){
            return $reaults['marks'];
        }
        
    }
    
    public function search_specific_course_details($data_programOfferId){

       if(!empty($data_programOfferId)){
          $this->db->select('cou_offer.offerId,cou_offer.courseId,cou_offer.marks,cou_offer.status,cour.courseName,cour.courseCode,prg_offer.programOfferId,emp.employeeId,emp.firstName,emp.middleName,emp.lastName')
                ->from('courseoffer cou_offer');
            $this->db->join('programoffer prg_offer', 'cou_offer.programOfferId= prg_offer.programOfferId');
            $this->db->join('employee emp', 'emp.employeeId= cou_offer.employeeId');
            $this->db->join('course cour', 'cour.courseId= cou_offer.courseId');

            $this->db->where('cou_offer.programOfferId',$data_programOfferId);
            $this->db->order_by('cour.courseCode','ASC');
            $query = $this->db->get();      
       
            $result = $query->result_array();
            if(!empty($result)){
                return $result;
            }
       
        }        
  } 
  
     public function searchcourseofferlistbyteacherid($data,$employeeId){

       if(!empty($data)){
          $this->db->select('cou_offer.offerId,cou_offer.marks,cou_offer.status,cour.courseName,cour.courseCode,prg_offer.programOfferId,emp.employeeId,emp.firstName,emp.middleName,emp.lastName')
          //$this->db->select('cou_offer.*,cour.*,prg.*,ses.*,mdm.*,grp.*,sht.*,sct.*,emp.employeeId,emp.firstName,emp.middleName,emp.lastName,emp.phone,emp.email')
                ->from('courseoffer cou_offer');
            $this->db->join('programoffer prg_offer', 'cou_offer.programOfferId= prg_offer.programOfferId');
            
            // not used in any other function except view course offer list information

            //$this->db->join('program prg', 'prg.programId= prg_offer.programId');
            // $this->db->join('session ses', 'ses.sessionId= prg_offer.sessionId');
            // $this->db->join('medium mdm', 'mdm.mediumId= prg_offer.mediumId');
            // $this->db->join('group grp', 'grp.groupId= prg_offer.groupId');
            // $this->db->join('shift sht', 'sht.shiftId= prg_offer.shiftId');
            // $this->db->join('section sct', 'sct.sectionId= prg_offer.sectionId');
            $this->db->join('employee emp', 'emp.employeeId= cou_offer.employeeId');
            $this->db->join('course cour', 'cour.courseId= cou_offer.courseId');

            $this->db->where('cou_offer.programOfferId', $data['programOfferId']['programOfferId']);
            $this->db->where('cou_offer.employeeId', $employeeId);
            $this->db->order_by('cour.courseCode','ASC');
            $query = $this->db->get();      
       
            $result = $query->result_array();
            if(!empty($result)){
                return $result;
            }
       
        }        
  } 
  
   public function searchcourseofferalllist($data){

       if(!empty($data)){
          $this->db->select('cou_offer.offerId,cou_offer.marks,cou_offer.status,cour.courseName,cour.courseCode,prg_offer.programOfferId')
          //$this->db->select('cou_offer.*,cour.*,prg.*,ses.*,mdm.*,grp.*,sht.*,sct.*,emp.employeeId,emp.firstName,emp.middleName,emp.lastName,emp.phone,emp.email')
                ->from('courseoffer cou_offer');
            $this->db->join('programoffer prg_offer', 'cou_offer.programOfferId= prg_offer.programOfferId');
            
            // not used in any other function except view course offer list information

            //$this->db->join('program prg', 'prg.programId= prg_offer.programId');
            // $this->db->join('session ses', 'ses.sessionId= prg_offer.sessionId');
            // $this->db->join('medium mdm', 'mdm.mediumId= prg_offer.mediumId');
            // $this->db->join('group grp', 'grp.groupId= prg_offer.groupId');
            // $this->db->join('shift sht', 'sht.shiftId= prg_offer.shiftId');
            // $this->db->join('section sct', 'sct.sectionId= prg_offer.sectionId');
           // $this->db->join('employee emp', 'emp.employeeId= cou_offer.employeeId');
           
            $this->db->join('course cour', 'cour.courseId= cou_offer.courseId');

            $this->db->where('cou_offer.programOfferId', $data['programOfferId']);
            $this->db->order_by('cour.courseCode','ASC');
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
    public function CheckOfferedCourseAssign($programOfferId){
       // print_r($programOfferId);exit;

         $this->db->select('*');
         if ($programOfferId) {
            $this->db->where('programOfferId',$programOfferId);
         }
         
         $this->db->order_by('offerId','ASC');
        
        $result = $this->db->get($this->_table);    
        $return=$result->result_array();
        if(!empty($return))
        {
            return $return; 
        }
       
    
    }

    public function get_assign_course_id_and_name($programOfferId)
    {
        $this->db->select('courseoffer.*');
        $this->db->select('course.courseName,course.courseCode');
        $this->db->select('employee.firstName,employee.lastName');
        $this->db->from('courseoffer');
        $this->db->join('course','course.courseId=courseoffer.courseId','INNER');
        $this->db->join('employee','employee.employeeId=courseoffer.employeeId','INNER');
        $this->db->order_by('courseoffer.offerId','ASC');
        $this->db->where('courseoffer.programOfferId',$programOfferId);
        $result = $this->db->get()->result_array();
        return $result;
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
          $this->db->select('cou_offer.*,cour.*,prg_offer.programLevel,prg_offer.programId,prg_offer.mediumId,prg_offer.groupId,prg_offer.shiftId,prg_offer.sectionId,prg_offer.sessionId')
                ->from('courseoffer cou_offer');
            $this->db->join('programoffer prg_offer', 'cou_offer.programOfferId= prg_offer.programOfferId');           
           // $this->db->join('employee emp', 'emp.employeeId= cou_offer.employeeId');
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
    
      public function duplicateCourseofferInfo($data){
        $check = FALSE;
        if ($data['employeeId'] && $data['marks']) {
            $row = $this->db
                    ->where('programOfferId', $data['programOfferId'])
                    ->where('courseId', $data['courseId'])
                    ->get('courseoffer')
                    ->row();
            if ($row) {
                $check = TRUE;
            }
        }
        
      
        return $check;
  
    }
    
        public function getofferedId($id,$test){
           // print_r($test);
            //echo '<pre>';print_r($test);exit;
            if (is_array($test)) {
                    $programOfferId = $test['programOfferId'];
            } else {
                    $programOfferId = $test;
            }
        
        $this->db->select('cou_offer.*,cour.*')
                ->from('courseoffer cou_offer');        
        $this->db->join('course cour', 'cour.courseId= cou_offer.courseId');          
        $qu = $this->db->get_where($this->_table, array('cou_offer.courseId' => $id,'cou_offer.programOfferId' => $programOfferId));
        $result=$qu->row_array(); 
        if(!empty($result))
        {
            return $result;
        }
    }
    
            public function getcourseofferlist($id,$test){
        
        $qu = $this->db->get_where($this->_table, array('employeeId' => $id,'programOfferId' => $test));
        $result=$qu->row_array(); 
        if(!empty($result))
        {
            return $result;
        }
    }
    
            public function getofferedIdBymrk($id){
        
        $qu = $this->db->get_where($this->_table_dvdmark, array('course_offerId' => $id));
        $result=$qu->row_array(); 
        if(!empty($result))
        {
            return $result;
        }
    }
    
    
            public function getofferedval($id){
        
        $qu = $this->db->get_where($this->_table, array('courseId' => $id));
        $result=$qu->row_array(); 
        if(!empty($result))
        {
            return $result;
        }
    }
  
    public function oldduplicateCourseofferInfo($programOfferId,$courseId) {
        $qu = $this->db->get_where($this->_table, array('programOfferId' => $data['programOfferId'],'courseId' => $data['courseId']));
        $reault = $qu->row_array();
        return $reault;
    }
    
   /* used for validation to insert courseoffer details */
  
    public function checkCourseofferInfo($data) {
        $qu = $this->db->get_where($this->_table, array('programOfferId' => $data['programOfferId'],'employeeId' => $data['employeeId'],'courseId' => $data['courseId']));
        $reault = $qu->row_array();
        return $reault;
    }  
    
    public function getTeacherCourseList($employeeId) {
        $this->db->select('*');
        $this->db->where('employeeId',$employeeId);
        $qu = $this->db->get($this->_table);
        return $qu->result_array();

    } 
    
     public function addmarkcategoryInfo($data){
//        print_r($data); exit;
        
        $this->db->insert($this->_markcatagory, $data);
        return $this->db->insert_id();       
        
    }   
    
         public function duplicatemarkcategoryInfo($data) {
//        $this->db->select('campusName');        
        $qu = $this->db->get_where($this->_markcatagory, array('category_title' => $data['category_title']));
        $reault = $qu->row_array();
        return $reault;
    }
    
        public function getmarkcategoryList(){
         
        $result = $this->db->get($this->_markcatagory);
        return $result->result_array();  
    } 
    
    public function editMarkcatagory($id) {
        $qu = $this->db->get_where($this->_markcatagory, array('mark_cat_id' => $id));
        return $qu->row_array();
    }
    
      public function editMarkdistribute($id) {
        $qu = $this->db->get_where($this->_table_dvdmark, array('course_offerId' => $id));
       
        return $qu->row_array();
    }
    
    public function getMarkTitle($id){
        $this->db->select('category_title');
        $this->db->where('mark_cat_id',$id);
         $qu = $this->db->get($this->_markcatagory);
        $result=$qu->row_array();
        if(!empty($result))
        {    
            return $result['category_title'];  
        }
        else
        {
            return 0;
        }
    }
   
        public function updateMarkInfo($data, $id) {

        $qu = $this->db->where('mark_cat_id', $id);
        $this->db->update($this->_markcatagory, $data);
        return $this->db->affected_rows();
    }

    public function deleteMarkName($id) {
        $qu = $this->db->where('mark_cat_id', $id);
        $this->db->delete($this->_markcatagory);
        return $this->db->affected_rows();
    }
      public function duplicatemarkcat($data,$id) {
//        $this->db->select('campusName');        
        $qu = $this->db->get_where($this->_markcatagory, array('mark_cat_id' => $id,'category_title' => $data['category_title']));
        $reault = $qu->row_array();
        return $reault;
    }
        public function Markdistribute($id) {
        $qu = $this->db->get_where($this->_table, array('courseId' => $id));
        return $qu->row_array();
    }
    
       public function getcourse($id) {
        $qu = $this->db->get_where($this->_tablecourse, array('courseId' => $id));
        return $qu->row_array();
    }
    public function getCourseInfo($id){
//        $this->db->order_by("id", "asc");
        $this->db->select('cour_off.*,cour.*')
                ->from('courseoffer cour_off');
        $this->db->join('course cour', 'cour.courseId= cour_off.courseId');
        $this->db->where('cour_off.offerId', $id);
        
        $qu = $this->db->get($this->_table);
        return $qu->row_array();
    }
    
     public function addmark_dvd($data){
//        print_r($data); exit;
        
        $this->db->insert($this->_table_dvdmark, $data);
        return $this->db->insert_id();       
        
    }
    public function duplicate_divide_mark($course_offerId) {
//        $this->db->select('campusName');        
        $qu = $this->db->get_where($this->_table_dvdmark, array('course_offerId' => $course_offerId));
        $reault = $qu->row_array();
        return $reault;
    }
     public function update_mark_dvd($data, $dividemark_id) {
        //echo '<pre>';print_r($data);print_r($dividemark_id);exit;
        $qu = $this->db->where('dividemark_id', $dividemark_id);
        $this->db->update($this->_table_dvdmark, $data);
        return $this->db->affected_rows();
    }
     public function getcoursedvdmark($id) {
        $qu = $this->db->get_where($this->_table_dvdmark, array('course_offerId' => $id));
        return $qu->row_array();
    }
    
    public function getcoursedvdmark_byPrgid_Subject($data) {
        if(!empty($data)){
          $this->db->select('cou_offer.offerId,cou_offer.programOfferId,cou_offer.courseId,mark_dvd.*')
                ->from('courseoffer cou_offer');
            $this->db->join('mark_divide mark_dvd', 'cou_offer.offerId=mark_dvd.course_offerId'); 
            
            $this->db->where('cou_offer.programOfferId', $data['programOfferId']);
            $this->db->where('cou_offer.courseId', $data['courseId']);
            
            $query = $this->db->get();             
            $result = $query->row_array();
            if(!empty($result)){
                return $result;
            }       
        }        
        else {
            return false;
        }
    }

     public function getMarkDevidevalue($data) {
        if(!empty($data)){
          $this->db->select('mark_dvd.mark_cat_id,mark_dvd.divide_mark as dis_divide_mark,mark_dvd.mark_percent')
                ->from('courseoffer cou_offer');
            $this->db->join('mark_divide mark_dvd', 'cou_offer.offerId=mark_dvd.course_offerId'); 
            
           // $this->db->where('cou_offer.programOfferId', $data['programOfferId']['programOfferId']); //Extra//needed//very important
            $this->db->where('cou_offer.courseId', $data['courseId']);            
            
            $query = $this->db->get();             
            $result = $query->row_array();
            if(!empty($result)){
                return $result;
            }       
        }        
        else {
            return false;
        }
    }
    
    
      public function getofferedtttt($courseId,$programOfferId){
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
    
         public function getofferedtt($courseId,$programOfferId,$semesterId,/*$examtypeId,*/$studentId) {
        $qu = $this->db->get_where($this->_studentmarks, array('courseId' => $courseId,'programOfferId' => $programOfferId['programOfferId'],'semesterId' => $semesterId,/*'examtypeId' => $examtypeId,*/'studentId' =>$studentId));
    
        return $qu->row_array();
    }


       public function get_courses(){
        $this->db->distinct();
        $this->db->select('cour.courseName,prg_offer.programOfferId')->from('courseoffer cou_offer');
            $this->db->join('programoffer prg_offer', 'cou_offer.programOfferId= prg_offer.programOfferId');
            $this->db->join('course cour', 'cour.courseId= cou_offer.courseId');
            //$this->db->where('cou_offer.programOfferId');
            $this->db->order_by('cour.courseCode','ASC');

       // $sql = "SELECT courseId,courseName FROM course JOIN courseoffer ON course.courseId =courseoffer.courseId WHERE ProgramOfferId=$programOffered";
      //  $this->db->query($sql);   
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function searchcourseofferlist($data_programOfferId){

       if(!empty($data_programOfferId)){
          $this->db->select('cou_offer.offerId,cou_offer.marks,cou_offer.status,cour.courseName,cour.courseCode,prg_offer.programOfferId,emp.employeeId,emp.firstName,emp.middleName,emp.lastName')
                ->from('courseoffer cou_offer');
            $this->db->join('programoffer prg_offer', 'cou_offer.programOfferId= prg_offer.programOfferId');
            $this->db->join('employee emp', 'emp.employeeId= cou_offer.employeeId');
            $this->db->join('course cour', 'cour.courseId= cou_offer.courseId');

            $this->db->where('cou_offer.programOfferId',$data_programOfferId);
            $this->db->order_by('cour.courseCode','ASC');
            $query = $this->db->get();      
       
            $result = $query->result_array();
            if(!empty($result)){
                return $result;
            }
       
        }        
  } 

  public function search_all_teacher_list(){
    $this->db->select('employeeId,firstName,middleName,lastName');
    $this->db->from('employee');
    $this->db->order_by('employeeId','ASC');
    $query = $this->db->get();
    $result = $query->result_array();
    if((!empty($result))){
        return $result;
    }else{
        return 0;
    }

  }
}
?>