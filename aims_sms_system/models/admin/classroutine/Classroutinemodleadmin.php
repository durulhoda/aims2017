<?php
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class ClassroutineModleAdmin extends CI_Model {
      
      private $_routine = "classroutine";
      private $_table = "courseoffer";

    public function __construct() {
        parent::__construct();
    }
    
    public function addClassroutineInfo($data){
        $this->db->insert($this->_routine, $data);
        return $this->db->insert_id();       
        
    }
    
   
    public function editClassroutineInfo($id) {
        $qu = $this->db->get_where($this->_routine, array('routineId' => $id));
        return $qu->row_array();
    }

    public function updateClassroutineInfo($data, $id) {

        $qu = $this->db->where('routineId', $id);
        $this->db->update($this->_routine, $data);
        return $this->db->affected_rows();
    }

    public function deleteClassroutineInfo($id) {
        $qu = $this->db->where('routineId', $id);
        $this->db->delete($this->_routine);
        return $this->db->affected_rows();
    }

    public function getClassRoutineInfo($programOfferId = 0)
    {
        $records = $this->db
                ->select('
                    cr.periodId,
                    cr.courseId,
                    cr.dayName,
                    c.courseName,
                    c.courseCode,
                    e.firstName,
                    e.lastName
                    ')
                ->from('classroutine AS cr')
                ->join('course AS c','cr.courseId = c.courseId', 'left')
                ->join('courseoffer AS co', 'c.courseId = co.courseId and co.programOfferId = '.$programOfferId.'', 'left')
                ->join('employee AS e','co.employeeId = e.employeeId', 'left')
                ->where('cr.programOfferId', $programOfferId)
                ->order_by('cr.dayName')
                ->get()
                ->result();
        $arr = [];
        if ($records) {
            $courseName = '';
            foreach ($records as $key => $val) {
                $full_name = '<br>(<a href="#">'.$val->firstName.' '.$val->lastName.'</a>)';
                $break_time = '<b style="color:red;font-size:15px;">Break Time</b>';
                if(isset($arr[$val->dayName][$val->periodId])) {
                    if ($val->courseId == 0) {
                        $arr[$val->dayName][$val->periodId]['course_employee_name'] .= ' /<br>'.$break_time;
                    } else {
                        $arr[$val->dayName][$val->periodId]['course_employee_name'] .= ' /<br>'.$val->courseName.$full_name;
                    }
                } else {
                    if ($val->courseId == 0) {
                        $arr[$val->dayName][$val->periodId] = [
                        'course_employee_name'=> $break_time
                    ];
                    } else {
                        $arr[$val->dayName][$val->periodId] = [
                        'course_employee_name'=> $val->courseName.$full_name
                    ];
                    }
                }
            }
        }
        // echo '<pre>';print_r($records);
        // echo '<pre>';print_r($arr);exit;
        return $arr;
    }
    
    
    
    public function getClassroutineList(){        
        
        $this->db->select('c_rt.*,prg.*,cour.*,cour_offr.*,emp.employeeId,emp.firstName,emp.middleName,emp.lastName,emp.phone');
        $this->db->from('classroutine c_rt');
        $this->db->join('programoffer prg', 'prg.programOfferId=c_rt.programOfferId');
        $this->db->join('courseoffer cour_offr', 'cour_offr.programOfferId=c_rt.programOfferId');
        $this->db->join('course cour', 'cour.courseId=cour_offr.courseId');
        $this->db->join('employee emp', 'emp.employeeId=cour_offr.employeeId');
        $this->db->group_by('c_rt.programOfferId');
        $this->db->order_by('c_rt.programOfferId','DESC');

        $query = $this->db->get();
        $result = $query->result_array();
        if (!empty($result)) {
            return $result;
        }
    }
    
    public function select_new_routine($data) {
        
        $this->db->select('*');
        $this->db->where('programOfferId',$data['programOfferId']);
        $this->db->order_by('periodId','ASC');
        $result = $this->db->get($this->_routine);
        return $result->result_array();   
    }

    public function getClassRoutineLists($programOfferId = 0) {

        $records = $this->db
                    ->select('
                        cr.routineId,
                        cr.dayName,
                        p.periodTime,
                        p.periodName,
                        p.is_break_time,
                        c.courseName,
                        c.courseCode
                        ')
                    ->from('classroutine AS cr')
                    ->join('period AS p','p.periodId = cr.periodId', 'left')
                    ->join('course AS c','cr.courseId = c.courseId', 'left')
                    ->where('cr.programOfferId', $programOfferId)
                    ->order_by('cr.dayName','asc')
                    ->order_by('p.periodId')
                    ->get()
                    ->result();
        return $records;
    }
    
        public function select_Saturday($data) {
        
        $this->db->select('*');
        $this->db->where('programOfferId',$data['programOfferId']);
          $this->db->where('dayName','Saturday');     
        $result = $this->db->get($this->_routine);
        return $result->row_array();   
    }
           public function select_Sunday($data) {
        
        $this->db->select('*');
        $this->db->where('programOfferId',$data['programOfferId']);
          $this->db->where('dayName','Sunday');      
        $result = $this->db->get($this->_routine);
        return $result->row_array();   
    }
           public function select_Monday($data) {
        
        $this->db->select('*');
        $this->db->where('programOfferId',$data['programOfferId']);
          $this->db->where('dayName','Monday');       
        $result = $this->db->get($this->_routine);
        return $result->row_array();   
    }
           public function select_Tuesday($data) {
        
        $this->db->select('*');
        $this->db->where('programOfferId',$data['programOfferId']);
          $this->db->where('dayName','Tuesday');       
        $result = $this->db->get($this->_routine);
        return $result->row_array();   
    }
           public function select_Wednessday($data) {
        
        $this->db->select('*');
        $this->db->where('programOfferId',$data['programOfferId']);
          $this->db->where('dayName','Wednessday');    
        $result = $this->db->get($this->_routine);
        return $result->row_array();   
    }
           public function select_Thursday($data) {
        
        $this->db->select('*');
        $this->db->where('programOfferId',$data['programOfferId']);
          $this->db->where('dayName','Thursday');       
        $result = $this->db->get($this->_routine);
        return $result->row_array();   
    }
           public function select_Friday($data) {
        
        $this->db->select('*');
        $this->db->where('programOfferId',$data['programOfferId']);
          $this->db->where('dayName','Monday');      
        $result = $this->db->get($this->_routine);
        return $result->row_array();   
    }
    
    public function routinevalidation1($data) {
        
        $this->db->select('*');
       
        $this->db->where('dayName',$data['dayName']);
        $this->db->where('programOfferId',$data['programOfferId']);
        $this->db->where('courseId',$data['courseId']);
        $this->db->where('periodId',$data['periodId']);
        
        $result = $this->db->get($this->_routine);
        return $result->row_array();   
        
       
    }
    public function routinevalidation2($data) {
        
        $this->db->select('*');
        $this->db->where('dayName',$data['dayName']);
        $this->db->where('courseId',$data['courseId']);
        $this->db->where('periodId',$data['periodId']);
        
        $result = $this->db->get($this->_routine);
        return $result->row_array();   
        
       
    }
   
    public function routinevalidation3($data) {
        
        $this->db->select('*');
        $this->db->where('dayName',$data['dayName']);
        $this->db->where('programOfferId',$data['programOfferId']);
        $this->db->where('courseId',$data['courseId']);
        $this->db->where('periodId',$data['periodId']);
        
        $result = $this->db->get($this->_routine);
        return $result->row_array();   
        
       
    }
     public function routinevalidation4($data) {
        
        $this->db->select('*');
        $this->db->where('programOfferId',$data['programOfferId']);
        $this->db->where('dayName',$data['dayName']);
        $this->db->where('periodId',$data['periodId']);
        
        $result = $this->db->get($this->_routine);
        return $result->row_array();   
        
       
    }
    public function routinevalidation5($data) {
        
        $this->db->select('*');
        $this->db->where('programOfferId',$data['programOfferId']);
        $this->db->where('dayName',$data['dayName']);
        $this->db->where('courseId',$data['courseId']);
        
        $result = $this->db->get($this->_routine);
        return $result->row_array();   
        
       
    }
     public function routinevalidation6($data) {
        
        $this->db->select('*');
        $this->db->where('programOfferId',$data['programOfferId']);
        $this->db->where('courseId',$data['courseId']);
       
        $results = $this->db->get($this->_table);
        return $results->row_array();    
        
       
    }
    
   public function select_class_routine($data) {
        
    
        
    $this->db->select('cls.*,prg.*'); // Select field
    $this->db->from('classroutine cls'); // from Table1
    $this->db->join('programoffer prg','cls.programOfferId = prg.programOfferId'); // Join table1 with table2 based on the foreign key
    $this->db->where('prg.sessionId',$data['sessionId']);
    $this->db->where('prg.programId',$data['programId']);// Set Filter
       $this->db->group_by('cls.programOfferId');
       $query = $this->db->get();
        $result = $query->result_array();
        if (!empty($result)) {
            return $result;
        }
    }
}