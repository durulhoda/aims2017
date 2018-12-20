<?php

/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class ExamroutineModleAdmin extends CI_Model {
      private $_table = "examroutine";
      private $_program = "program";

    public function __construct() {
        parent::__construct();
    }
    
    public function addExamroutineInfo($data){
        
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();       
        
    }
    
    public function routinevalidation($data, $prg_id) {
        
        $this->db->select('*');
        $this->db->where('programOfferId',$prg_id);
        $this->db->where('courseId',$data['courseId']);
        $this->db->where('semester_id',$data['semester_id']);
        $this->db->where('date',$data['date']);
        $this->db->where('examtime',$data['examtime']);
        $this->db->where('room',$data['room']);
        
        $result = $this->db->get($this->_table);
        return $result->row_array();   
        
       
    } 
    public function routinevalidation1($data) {
        //echo "<pre>";print_r($data);die();
        $this->db->select('*');
        $this->db->where('programOfferId',$data['programOfferId']);
        $this->db->where('courseId',$data['courseId']);
        $this->db->where('semester_id',$data['semester_id']);
        $this->db->where('date',$data['date']);
        $this->db->where('examtime',$data['examtime']);
        $this->db->where('room',$data['room']);
        
        $result = $this->db->get($this->_table);
        return $result->row_array();   
        
       
    }
    public function routinevalidation2($data) {
        
        $this->db->select('*');
        $this->db->where('programOfferId',$data['programOfferId']);    
        $this->db->where('courseId',$data['courseId']);
        $this->db->where('semester_id',$data['semester_id']);
        
        $result = $this->db->get($this->_table);
        return $result->row_array();   
        
       
    }
    public function routinevalidation3($data) {
        
        $this->db->select('*');
        $this->db->where('programOfferId',$data['programOfferId']);
        $this->db->where('date',$data['date']);
        $this->db->where('semester_id',$data['semester_id']);
        $this->db->where('examtime',$data['examtime']);
        
        $result = $this->db->get($this->_table);
        return $result->row_array();   
        
       
    }
    public function getExamroutineList(){        
        
        $this->db->select('c_rt.*,prg.*');
        $this->db->from('examroutine c_rt');
        $this->db->join('programoffer prg', 'prg.programOfferId=c_rt.programOfferId');
        $this->db->group_by('c_rt.programOfferId, c_rt.semester_id');
        
        $this->db->order_by('c_rt.date,prg.programId','DESC');

        $query = $this->db->get();
        $result = $query->result_array();

        if (!empty($result)) {
            return $result;
        }
    }
    
    public function exam_routine($data) {
        $this->db->select('*,date_format(str_to_date(date, "%d-%m-%Y"), "%Y%m%d") as dateright1');
        $this->db->where('programOfferId',$data['programOfferId']);
        $this->db->order_by('dateright1','ASC');        
        $result = $this->db->get($this->_table);
        $query = $result->result_array();
        return $query;   
    }
    
    public function getExamroutineList_wojoin(){
        
        $this->db->select('programOfferId,semestername');
        $this->db->group_by('programOfferId,semestername');
   //     $this->db->where('session', date('Y'));
        $this->db->order_by('date','DESC');
        $result = $this->db->get($this->_table);
        $datas=$result->result_array();  
        if(!empty($datas))
        {
            return  $datas;
        }
        
    }
    
     public function select_new_routine($data) {
        
        $this->db->select('*');
        //$this->db->where('semestername',$data['semestername']);
        $this->db->where('programOfferId',$data['programOfferId']);
        $this->db->order_by('date','DESC');
        $this->db->limit(50);
        
        $result = $this->db->get($this->_table);
        return $result->result_array();   
        
       
    }
    
    public function select_exam_routine($data) {
                   
        $this->db->select('exm.*,prg.*'); // Select field
        $this->db->from('examroutine exm'); // from Table1
        $this->db->join('programoffer prg','exm.programOfferId = prg.programOfferId'); // Join table1 with table2 based on the foreign key
        $this->db->where('prg.sessionId',$data['sessionId']);
        $this->db->where('prg.programId',$data['programId']);// Set Filter
        $this->db->group_by('exm.semestername');// Set Filter
        $query = $this->db->get();
        $result = $query->result_array();
        if (!empty($result)) {
            return $result;
        }
    }

    public function select_new_exam_routine($data) {
        $result=array();
        $this->db->select('exm.*'); // Select field
        $this->db->from('examroutine exm'); // from Table1
        $this->db->join('programoffer prg','exm.programOfferId = prg.programOfferId AND exm.semester_id="'.$data['semesterId'].'"'); // Join table1 with table2 based on the foreign key
        $this->db->where('prg.programId',$data['programId']);
        $this->db->where('prg.mediumId',$data['mediumId']);
        $this->db->where('prg.groupId',$data['groupId']);
        $this->db->where('prg.shiftId',$data['shiftId']);
        $this->db->where('prg.sectionId',$data['sectionId']);
        $this->db->where('prg.sessionId',$data['sessionId']);
        $this->db->order_by('exm.date','ASC');
        //$this->db->group_by('exm.semestername');// Set Filter
        $query = $this->db->get();
        $result = $query->result_array();

        //if (!empty($result)) {
            return $result;
        //}
    }

    public function getSemesterNameById($id)
    {
        $this->db->select('semester');
        $this->db->from('semester');
        $this->db->where('semesterId',$id);
        $result = $this->db->get()->row();
        return $result->semester;
    }

  
        public function editExamroutineInfo($id) {
        $qu = $this->db->get_where($this->_table, array('routineId' => $id));
        return $qu->row_array();
    }

    public function updateExamroutineInfo($data, $id) {

        $qu = $this->db->where('routineId', $id);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows();
    }

    public function deleteExamroutineInfo($id) {
        $qu = $this->db->where('routineId', $id);
        $this->db->delete($this->_table);
        return $this->db->affected_rows();
    }

    public function get_exam_routine_in_admit_card($data_programOfferId,$semestertype){

        $this->db->select('examroutine.*,course.courseName, course.courseCode,date_format(str_to_date(examroutine.date, "%d-%m-%Y"), "%Y%m%d") as dateright');
        $this->db->from('examroutine');
        $this->db->join('course','examroutine.courseId = course.courseId');
        $this->db->where('examroutine.programOfferId',$data_programOfferId);
        $this->db->where('examroutine.semester_id',$semestertype);
        $this->db->order_by('dateright','ASC'); 
        $query = $this->db->get();
        $result = $query->result_array();
        if($result)
        {
            foreach($result as &$item)
            {
                $item['order'] = strtotime($item['date']);
            }
        }

        return $result;
    }
     
}