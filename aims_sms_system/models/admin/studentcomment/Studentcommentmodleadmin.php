<?php

/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class StudentcommentModleAdmin extends CI_Model {
    
    private $_table = "studentcomment";

    public function __construct() {
        parent::__construct();
    }
    
    
    public function addcommentInfo($data){
//        print_r($data); exit;
        
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();       
        
    }
    
     public function detailscommentInfo($id) {
        $qu = $this->db->get_where($this->_table, array('cmtId' => $id));
        return $qu->row_array();
    }
    
   public function getlistPeriod(){
         
        $result = $this->db->get($this->_table);
        return $result->result_array();  
    }
    
    
    public function getPeriodInfoArray(){
        $this->db->select('*');
//        $this->db->order_by("groupName", "asc");
        $qu = $this->db->get($this->_table);
        return $qu->result_array();
        
    }
    
     public function editPeriodInfo($id) {
        $qu = $this->db->get_where($this->_table, array('periodId' => $id));
        return $qu->row_array();
    }

    public function updatePeriodInfo($data, $id) {

        $qu = $this->db->where('periodId', $id);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows();
    }

    public function deletePeriodInfo($id) {
        $qu = $this->db->where('periodId', $id);
        $this->db->delete($this->_table);
        return $this->db->affected_rows();
    }
    
        public function checkPeriodInfo($id) {
        $this->db->select('tpri.*,clroutin.*');

        $this->db->from('period tpri');
        $this->db->join('classroutine clroutin', 'tpri.periodId = clroutin.periodId');

        $this->db->where('clroutin.periodId', $id);

        $query = $this->db->get();
        $result = $query->result_array();
        if (!empty($result)) {
            return $result;
        }
    }

    public function getPeriodTime($shiftId,$periodId){
        $result = $this->db->get_where($this->_table, array('shiftId'=>$shiftId,'periodId'=>$periodId));
        $result_info =  $result->row_array(); 
        if(!empty($result_info['periodTime']))
        {
            return $result_info['periodTime'];        
        }
        
    }
    
    public function duplicatecommentInfo($data) {
//        $this->db->select('campusName');        
        $qu = $this->db->get_where($this->_table, array('studentId' => $data['studentId'],'employeeId' => $data['employeeId'],'programOfferId' => $data['programOfferId']));
        $reault = $qu->row_array();
        return $reault;
    }
    
    
        public function searchlist($data){
         
               $this->db->select('stu.*,prg.*,stu_info.*, stu_cmd.*');
            $this->db->from('student stu');        
            $this->db->join('programoffer prg', 'prg.programOfferId=stu.programOfferId');
            $this->db->join('studentcomment stu_cmd', 'stu_cmd.programOfferId=prg.programOfferId');
       //     $this->db->join('student stu', 'stu.studentId=prm.studentId');
            $this->db->join('studentinfo stu_info', 'stu_info.applicationId=stu.applicationId');
           if (!empty($data['mediumId'])) {
                        $this->db->where('mediumId', $data['mediumId']);
                    }
                    if (!empty($data['programId'])) {
                        $this->db->where('programId', $data['programId']);
                    }
                    if (!empty($data['groupId'])) {
                        $this->db->where('groupId', $data['groupId']);
                    }
                    if (!empty($data['shiftId'])) {
                        $this->db->where('shiftId', $data['shiftId']);
                    }
                      if (!empty($data['sectionId'])) {
                        $this->db->where('sectionId', $data['sectionId']);
                    }
                    if (!empty($data['sessionId'])) {
                        $this->db->where('sessionId', $data['sessionId']);
                    }
                 
           
            
            $query = $this->db->get();
            $result = $query->result_array();
            if(!empty($result)){
                return $result;   
           }
         
          

        }
        
        
         public function searchcommentlist($data){
         
             $this->db->select('*');
            $this->db->from('studentcomment');        
         //   $this->db->join('programoffer prg', 'prg.programOfferId=stu.programOfferId');
          //  $this->db->join('studentcomment stu_cmd', 'stu_cmd.programOfferId=prg.programOfferId');
       //     $this->db->join('student stu', 'stu.studentId=prm.studentId');
            $this->db->where('programOfferId', $data['programOfferId']);
          
            
            $query = $this->db->get();
            $result = $query->result_array();
            if(!empty($result)){
                return $result;   
         }
         
            }
         
         
           public function publishCourse($id)
    {
        $this->db->set('approvestatus',1);
        $this->db->where('cmtId',$id);
        $this->db->update('studentcomment');
    }
    public function unpublishCourse($id)
    {
        $this->db->set('approvestatus',2);
        $this->db->where('cmtId',$id);
        $this->db->update('studentcomment');
    }
}
 

