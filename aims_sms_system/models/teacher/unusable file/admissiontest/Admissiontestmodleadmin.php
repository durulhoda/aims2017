<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admissiontestmodleadmin
 *
 * @author Binita
 */
class AdmissiontestModleAdmin extends CI_Model{
    
         private $_table = "addmissionresult";
          private $_table1 = "admissionapplicant";
         private $stu_table = "student";
        private $_admissiontestapplicantstatus = "admissiontestapplicantstatus";
        private $_admissionPromotedApplicant = "admissionpromotedapplicant";

    public function __construct() {
        parent::__construct();
    }
    
    
    public function addAdmissiontestInfo($data){
//        print_r($data); exit;
        $studentId = $data['studentId'];
        $this->db->where('studentId', $studentId);
        $this->db->update($this->stu_table, array('status' =>0));
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();       
        
    }
    
    public function getAllResults(){
        $this->db->order_by("total","DESC");
        
        $results = $this->db->get($this->_table);
        return $results->result_array();
    }
    
    public function getResultByMarks($data){
        
        if($data['marks']==1)
        {
            $this->db->where('total BETWEEN 100 AND 200');
            $this->db->order_by("total","DESC");
            $results = $this->db->get($this->_table);
            return $results->result_array();
        }
        elseif($data['marks']==2){
            $this->db->where('total BETWEEN 90 AND 99');
            $this->db->order_by("total","DESC");
            $results = $this->db->get($this->_table);
            return $results->result_array();
        }
        elseif($data['marks']==3){
            $this->db->where('total BETWEEN 80 AND 89');
            $this->db->order_by("total","DESC");
            $results = $this->db->get($this->_table);
            return $results->result_array();
        }
        elseif($data['marks']==4){
            $this->db->where('total BETWEEN 70 AND 79');
            $this->db->order_by("total","DESC");
            $results = $this->db->get($this->_table);
            return $results->result_array();
        }
        elseif($data['marks']==5){
            $this->db->where('total BETWEEN 60 AND 69');
            $this->db->order_by("total","DESC");
            $results = $this->db->get($this->_table);
            return $results->result_array();
        }
        elseif($data['marks']==6){
            $this->db->where('total BETWEEN 50 AND 59');
            $this->db->order_by("total","DESC");
            $results = $this->db->get($this->_table);
            return $results->result_array();
        }
        elseif($data['marks']==7){
            $this->db->where('total BETWEEN 40 AND 49');
            $this->db->order_by("total","DESC");
            $results = $this->db->get($this->_table);
            return $results->result_array();
        }
        else{
            $this->db->where('total BETWEEN 1 AND 39');
            $this->db->order_by("total","DESC");
            $results = $this->db->get($this->_table);
            return $results->result_array();
        }
        
        
   }
  
    
    public function getApplicantMeritstatus(){
        
        $this->db->order_by("marks","DESC");
        $results = $this->db->get($this->_admissiontestapplicantstatus);
   //     $results = $this->db->get_where($this->_admissiontestapplicantstatus);
        return $results->result_array();
    }
    
    
    public function getdisallowlist(){
        
        $results = $this->db->get_where($this->_table, array('allowlist'=>0));
        return $results->result_array();
    }
    
    public function studentawaitinglist(){
        
        $results = $this->db->get_where($this->_table, array('allowlist'=>1));
        return $results->result_array();
    }
    
    
    
    
    public function req_forapprove($reqdata, $studentId){
        
        $data['allowlist'] = $reqdata;
        
        $this->db->where('studentId', $studentId);
        
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows();
    }
    
    
    public function req_fordisapprove($reqdata, $studentId){
        
        $data['allowlist'] = $reqdata;
        
        $this->db->where('studentId', $studentId);
        
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows();
    }
    
    public function waintingListstatus($reqdata, $studentId){
        
        $data['allowlist'] = $reqdata;
        
        $this->db->where('studentId', $studentId);
        
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows();
    }
    
 public function editadmissionlInfo($id){
        $qu = $this->db->get_where($this->_table, array('studentId'=>$id));
        return $qu->row_array();
    }
   
     public function updateadmissionlInfo($data, $id){
        $qu = $this->db->where('studentId', $id);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows();
        
    }
    
    
    public function getstudentallowlist($id){
        $qu = $this->db->get_where($this->_table, array('studentId'=>$id));
        return $qu->row_array();
    }
    
     public function getapplicantStatus($id){
       
          
        $result = $this->db->get_where($this->_admissiontestapplicantstatus, array('applicationId'=>$id));
        $result_info =  $result->row_array(); 
        if(!empty($result_info['applicationId']))
        {
        return $result_info['applicationId'];           
        }
        else{
            return 0;  
        }
     
     }
     public function getPromotedApplicant($id){
       
          
        $result = $this->db->get_where($this->_admissionPromotedApplicant, array('applicationId'=>$id));
        $result_info =  $result->row_array(); 
        if(!empty($result_info['applicationId']))
        {
        return $result_info['applicationId'];           
        }
        else{
            return 0;  
        }
     
     }
    
    public function insertadmissionapplicantstatus($data) {
        
      $this->db->insert($this->_admissiontestapplicantstatus, $data);
        return $this->db->insert_id(); 
        
    }
    
    public function checkDuplicatePromotedapplicant($data){
        // print_r($applicationId); exit;
         $this->db->select('*');
        $this->db->where('applicationId',$data['applicationId']);
        $result = $this->db->get($this->_admissionPromotedApplicant);
        return $result->result_array();  
        }
        
    
    public function insertAdmissionPromotedApplicant($data) {
        
      $this->db->insert($this->_admissionPromotedApplicant, $data);
        return $this->db->insert_id(); 
        
    }
    
    
    public function getstudentinfosearch($data){
//        print_r($data);       
        
        if(!empty($data)){
        
        $this->db->like('campusId',$data['campusId']);
        $this->db->like('mediumId',$data['mediumId']);
        $this->db->like('classId',$data['classId']);
        $this->db->like('groupId',$data['groupId']);
        $this->db->like('sectionId',$data['sectionId']);
        $this->db->like('shiftId',$data['shiftId']);
        $this->db->like('sessionId',$data['sessionId']);        
        
        $qu = $this->db->get($this->_table1);
        return $qu->result_array();
        }        
    }
    
    public function getPromotedApplicantinfo($data){
//        print_r($data);       
        
        if(!empty($data)){
        
//        $this->db->like('campusId',$data['campusId']);
//        $this->db->like('mediumId',$data['mediumId']);
//        $this->db->like('classId',$data['classId']);
//        $this->db->like('groupId',$data['groupId']);
//        $this->db->like('sectionId',$data['sectionId']);
//        $this->db->like('shiftId',$data['shiftId']);
//        $this->db->like('sessionId',$data['sessionId']);        
        
        $this->db->like('applicationId',$data['applicationId']);
        
        $qu = $this->db->get($this->_admissionPromotedApplicant);
        return $qu->result_array();
        }        
    }
    
    public function getApplicantbySession($data){
//        print_r($data);       
        
        if(!empty($data)){         
        $this->db->like('campusId',$data['campusId']);
        $this->db->like('mediumId',$data['mediumId']);
        $this->db->like('classId',$data['classId']);
        $this->db->like('groupId',$data['groupId']);
        $this->db->like('sectionId',$data['sectionId']);
        $this->db->like('shiftId',$data['shiftId']);
        $this->db->like('sessionId',$data['sessionId']);        
        
        $this->db->like('applicationId',$data['applicationId']);    
        
        $qu = $this->db->get($this->_table1);
        return $qu->result_array();
        }        
    }
    
    public function getApplicantsearchbySession($data){
//        print_r($data);       
        
        if(!empty($data)){         
             $this->db->like('campusId',$data['campusId']);
        $this->db->like('mediumId',$data['mediumId']);
        $this->db->like('classId',$data['classId']);
        $this->db->like('groupId',$data['groupId']);
        $this->db->like('sectionId',$data['sectionId']);
        $this->db->like('shiftId',$data['shiftId']);
        $this->db->like('sessionId',$data['sessionId']);       
        
        $qu = $this->db->get($this->_table1);
        return $qu->result_array();
        }        
    }
    
    public function getStudentId(){
        $this->db->select('applicationId');
        $qu = $this->db->get($this->_table);
        return $qu->result_array();
        }
        
    public function getTotalMarks($applicationId) {
        
//        $this->db->select('total');
        $qu = $this->db->get_where($this->_table, array('applicationId' =>$applicationId));
   //      $qu = $this->db->get_where($this->_table, array('studentId' =>$studentId));
        $reault = $qu->row_array();
        return $reault['total'];
        }
     
    public function getregisterstudentlist($data){
//        print_r($data);       
        
        if(!empty($data)){
      
        $this->db->like('campusId',$data['campusId']);
        $this->db->like('mediumId',$data['mediumId']);
        $this->db->like('classId',$data['classId']);
        $this->db->like('groupId',$data['groupId']);
        $this->db->like('sectionId',$data['sectionId']);
        $this->db->like('shiftId',$data['shiftId']);
        $this->db->like('sessionId',$data['sessionId']);        
        $this->db->like('applicantId',$data['applicantId']);
        
        $qu = $this->db->get($this->_admissiontestapplicantstatus);
        return $qu->result_array();
        }        
    }    
        
        
     
        
}

 
