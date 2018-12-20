<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of result_viewmodleadmin
 *
 * @author Binita
 */
class Result_viewModleAdmin extends CI_Model {

    //put your code here
    // private $_table = "gradesheet";
    private $_table1 = "studentmarks";
    private $_table2 = "publishedresult";
    private $_courseoffer = "courseoffer";
    private $_student = "student";

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
        $qu = $this->db->get_where($this->_table2, array('studentId' => $data['studentId'], 'semester' => $data['semester'], 'programOfferId' => $data['programOfferId'], 'result_status' => $resultstatus));
        $reault = $qu->row_array();
        return $reault;
    }

    //......use for  view student result (admin >> result_view >> index.php) 
    public function getmarksByStudent($data) {
        if (!empty($data)) {
            $this->db->where('studentId', $data['studentId']);
            $this->db->where('semester', $data['semester']);

            $qu = $this->db->get($this->_table1);
            return $qu->result_array();
        }
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
   

}

