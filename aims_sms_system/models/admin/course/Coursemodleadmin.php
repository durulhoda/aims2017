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

        //$this->db->select(' course.*,c.courseName as marge');

            //$this->db->select(' course.*');

       // $this->db->join('course as c','course.marge=c.courseId','left');

        $this->db->order_by('course.courseCode','ASC'); 

        $result = $this->db->get($this->_table);        

        return $result->result_array();  

    }





    public function getlistbyprogramLevel($data){

        $this->db->select('*')->from('course');;

        $this->db->where($data,'programLevel');

        $this->db->order_by('courseCode', "ASC");

        $qu = $this->db->get();

        $result = $qu->result_array();

        

        if(!empty($result)){

            return $result;

    }

}





    public function getCourseInfo(){

        $this->db->order_by('courseCode','ASC');
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

    public function getCourseCode_Aonther($courseId) {

//        $this->db->select('campusName');        

       $qu = $this->db->get_where($this->_table, array('courseId' => $courseId));

        $reault = $qu->row_array();

        return $reault['courseCode'];

    }

    

    public function getCourseListBYPrglevelId($prglvlId) {


        $this->db->order_by("courseCode", "asc");

        $query = $this->db->get_where($this->_table, array('programLevel' => $prglvlId));

        $reault = $query->result_array();

        return $reault;



    }



    public function getCourseOfferList($programOfferId = 0, $programLevel = 0) {

        $where = [];

        if ($programOfferId) {

            $where['co.programOfferId'] = $programOfferId;

        }

        if ($programLevel) {

            $where['c.programLevel'] = $programLevel;

        }

        $records = $this->db

                    ->select('c.courseId, c.courseName')

                    ->from('courseoffer AS co')

                    ->join('course AS c','c.courseId = co.courseId')

                    ->where($where)

                    ->get()

                    ->result_array();

        //echo '<pre>';print_r($records);exit;

        return $records;



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

    

        public function getOfferedProgramallList($data_programOfferId) {

        $this->db->select('*');

        $this->db->from('courseoffer ');

        $this->db->where('programOfferId',$data_programOfferId);

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

        // $qu = $this->db->get_where($this->_table, array('courseName' => $data['courseName'],'courseCode' => $data['courseCode'],'programLevel' => $data['programLevel'],'marge' => $data['marge']));
        $qu = $this->db->get_where($this->_table, array('courseName' => $data['courseName'],'courseCode' => $data['courseCode'],'programLevel' => $data['programLevel']));
        $reault = $qu->row_array();

        return $reault;

    }



    public function getSubjectNames($session,$class_level,$class_student,$medium,$group){

       $this->db->distinct();

        $this->db->select('cour.courseName,prg_offer.programOfferId')->from('courseoffer cou_offer');

            $this->db->join('programoffer prg_offer', 'cou_offer.programOfferId= prg_offer.programOfferId');

            $this->db->join('course cour', 'cour.courseId= cou_offer.courseId');

            $this->db->where('prg_offer.sessionId',$session);

            $this->db->where('prg_offer.programLevel',$class_level);

            $this->db->where('prg_offer.programId',$class_student);

            $this->db->where('prg_offer.mediumId',$class_student);

            $this->db->where('prg_offer.groupId',$group);

            $this->db->order_by('cour.courseName','ASC');



       // $sql = "SELECT courseId,courseName FROM course JOIN courseoffer ON course.courseId =courseoffer.courseId WHERE ProgramOfferId=$programOffered";

      //  $this->db->query($sql);   

        $query = $this->db->get();

        $result = $query->result_array();

        return $result;

    }



    public function get_exam_type(){

        $this->db->select('*');

        $this->db->from('examtype');

        $query = $this->db->get();

        $result = $query->result_array();

        return $result;

    }



    public function get_semester_type(){

        $this->db->select('*');

        $this->db->from('semester');

        $query = $this->db->get();

        $result = $query->result_array();

        return $result;

    }



    //public function get_detailed_info($session,$class_level,$class,$medium,$groupid,$shiftid,$sectionid,$semestertype,$examtype){





    //}



    public function get_student_information($data_programOfferId){


        $this->db->select('student.studentId,student.applicationId,studentinfo.*');
        $this->db->select('promotedstudent.roll_no');

        $this->db->from('student');

        $this->db->join('studentinfo','studentinfo.applicationId = student.applicationId');
        $this->db->join('promotedstudent','promotedstudent.programOfferId = '."'$data_programOfferId'".' AND promotedstudent.studentId = student.studentId');

        $this->db->where('student.programOfferId',$data_programOfferId);

        $this->db->order_by('student.studentId','ASC');

        $query = $this->db->get();

        $result = $query->result_array();

        return $result;

    }



    public function get_student_other_informations($data_programOfferId){

        $this->db->select('programoffer.*,program.programId,program.programName,program.programLevel,group.groupId,group.groupName,medium.mediumId,medium.mediumName,section.sectionId,section.sectionName,shift.*,session.*');

        $this->db->from('programoffer');

        $this->db->join('session','programoffer.sessionId = session.sessionId');

        $this->db->join('program','programoffer.programId = program.programId');

        $this->db->join('section','programoffer.sectionId = section.sectionId');

        $this->db->join('shift','programoffer.shiftId = shift.shiftId');

        $this->db->join('group','programoffer.groupId = group.groupId');

        $this->db->join('medium','programoffer.mediumId = medium.mediumId');

        $this->db->where('programoffer.programOfferId',$data_programOfferId);

        $query = $this->db->get();

        $result = $query->result_array();

        return $result;



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



    public function getMainSubjects($courseStatus){

        //$qu = $this->db->get_where($this->_table, array('studentId' => $studentId));

        //$reault = $qu->row_array();

        //return $reault['courseName'];

        //echo "Paisi";

       

        $courseStatuss = ",".$courseStatus;

       // echo "<pre>";

       // print_r($courseStatuss);die();

        $this->db->select('courseCode');

        $this->db->from('course');

        $this->db->join('studentassigncourse','studentassigncourse.courseId = course.courseId');

        $this->db->where('courseStatus',$courseStatuss);

        $query = $this->db->get();

        $result = $query->row();

        //echo "<pre>";

        //print_r($result);die();

        //$data = explode(",", trim($result,","));

        //if()

        return $result;

    }



}