<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of prgrammodleadmin
 *
 * @author Binita
 */
class ProgramModleAdmin extends CI_Model {
    
    
    private $_table = "program";
    private $_offertable = "programoffer";

    public function __construct() {
        parent::__construct();
    }
    
    
    public function addProgramInfo($data){
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();       
        
    }
    
    public function getlistProgram(){
        $this->db->order_by('programLevel,programId','ASC'); 
        $result = $this->db->get($this->_table);
        return $result->result_array();  
    }
    
    
    
    public function getProgramname($id){
        $result = $this->db->get_where($this->_table, array('programId'=>$id));
        $result_info =  $result->row_array(); 
        if(!empty($result_info['programName']))
        {
            return $result_info['programName'];    
        }
        
    }

    public function getProgramInfoArray() {
        
        $this->db->select('programId, programName');
        $this->db->order_by("programId", "asc");
        $result = $this->db->get($this->_table);
        return $result->result_array(); 
    }
    
     public function editProgramInfo($id) {
        $qu = $this->db->get_where($this->_table, array('programId' => $id));
        return $qu->row_array();
    }

    public function updateProgramInfo($data, $id) {

        $qu = $this->db->where('programId', $id);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows();
    }

    public function deleteProgramInfo($id) {
        $qu = $this->db->where('programId', $id);
        $this->db->delete($this->_table);
        return $this->db->affected_rows();
    }
    
    
    // insert programoffer information
    public function addProgramOffer($data){

        $this->db->insert($this->_offertable, $data);
        return $this->db->insert_id();       
        
    }
   
    // get program offer information by data value from programoffer tbl..
    public function getOfferedProgramList($data) {
        $this->db->select('prg_offer.*,prg.*,ses.*,mdm.*,grp.*,sht.*,sct.*,emp.employeeId,emp.firstName,emp.middleName,emp.lastName,emp.phone,emp.email')
                ->from('programoffer prg_offer');
         $this->db->join('program prg', 'prg.programId= prg_offer.programId');
         $this->db->join('session ses', 'ses.sessionId= prg_offer.sessionId');
         $this->db->join('medium mdm', 'mdm.mediumId= prg_offer.mediumId');
         $this->db->join('group grp', 'grp.groupId= prg_offer.groupId');
         $this->db->join('shift sht', 'sht.shiftId= prg_offer.shiftId');
         $this->db->join('section sct', 'sct.sectionId= prg_offer.sectionId');
         $this->db->join('employee emp', 'emp.employeeId= prg_offer.employeeId');
         
         $this->db->where('prg_offer.programId',$data['programId']);
         $this->db->where('prg_offer.sessionId',$data['sessionId']);
         $this->db->where('prg_offer.mediumId',$data['mediumId']);
         $this->db->where('prg_offer.groupId',$data['groupId']);
         $this->db->where('prg_offer.shiftId',$data['shiftId']);
         $this->db->where('prg_offer.sectionId',$data['sectionId']);
//         $this->db->where('prg_offer.employeeId',$data['employeeId']);
//         $this->db->where('prg_offer.classStatus', $data['classStatus']);
         $this->db->order_by("prg_offer.sessionId", "DESC");
   //      $this->db->group_by("prg_offer.programId");
         $query=$this->db->get();
       
        $result = $query->result_array();
        if(!empty($result)){
            return $result;
        }
        
    }

    public function getOfferedProgramList_bySession($data) {
        $this->db->select('prg_offer.*,prg.*,ses.*,mdm.*,grp.*,sht.*,sct.*,emp.employeeId,emp.firstName,emp.middleName,emp.lastName,emp.phone,emp.email')
                ->from('programoffer prg_offer');
         $this->db->join('program prg', 'prg.programId= prg_offer.programId','left outer');
         $this->db->join('session ses', 'ses.sessionId= prg_offer.sessionId','left outer');
         $this->db->join('medium mdm', 'mdm.mediumId= prg_offer.mediumId','left outer');
         $this->db->join('group grp', 'grp.groupId= prg_offer.groupId','left outer');
         $this->db->join('shift sht', 'sht.shiftId= prg_offer.shiftId','left outer');
         $this->db->join('section sct', 'sct.sectionId= prg_offer.sectionId','left outer');
         $this->db->join('employee emp', 'emp.employeeId= prg_offer.employeeId','left outer');
         
         $this->db->where('prg_offer.sessionId',$data['sessionId']);
         $this->db->order_by("prg_offer.sessionId", "DESC");
   //      $this->db->group_by("prg_offer.programId");
         $query=$this->db->get();
       
        $result = $query->result_array();
        if(!empty($result)){
            return $result;
        }
        
    }
     public function getlistofferprogram(){
         
        $this->db->select('prg_offer.*,prg.*,ses.*,mdm.*,grp.*,sht.*,sct.*,emp.employeeId,emp.firstName,emp.middleName,emp.lastName,emp.phone,emp.email')
                ->from('programoffer prg_offer');
         $this->db->join('program prg', 'prg.programId= prg_offer.programId');
         $this->db->join('session ses', 'ses.sessionId= prg_offer.sessionId');
         $this->db->join('medium mdm', 'mdm.mediumId= prg_offer.mediumId');
         $this->db->join('group grp', 'grp.groupId= prg_offer.groupId');
         $this->db->join('shift sht', 'sht.shiftId= prg_offer.shiftId');
         $this->db->join('section sct', 'sct.sectionId= prg_offer.sectionId');
         $this->db->join('employee emp', 'emp.employeeId= prg_offer.employeeId');
                 
         $this->db->order_by("prg_offer.sessionId,prg_offer.programId", "DESC");
   //      $this->db->group_by("prg_offer.programId");
         $query=$this->db->get();
       
        $result = $query->result_array();
        if(!empty($result)){
            return $result;
        }
    }

    public function getlistofferprogram_byCurrentSession(){
         
        $this->db->select('prg_offer.programOfferId,prg_offer.classStatus,prg_offer.applicantSeat,prg.programName,ses.session,mdm.mediumName,grp.groupName,sht.shiftName,sct.sectionName,emp.firstName,emp.middleName,emp.lastName')
                ->from('programoffer prg_offer');
         $this->db->join('program prg', 'prg.programId= prg_offer.programId');
         $this->db->join('session ses', 'ses.sessionId= prg_offer.sessionId');
         $this->db->join('medium mdm', 'mdm.mediumId= prg_offer.mediumId');
         $this->db->join('group grp', 'grp.groupId= prg_offer.groupId');
         $this->db->join('shift sht', 'sht.shiftId= prg_offer.shiftId');
         $this->db->join('section sct', 'sct.sectionId= prg_offer.sectionId');
         $this->db->join('employee emp', 'emp.employeeId= prg_offer.employeeId');
                 
         $this->db->order_by("prg_offer.sessionId,prg_offer.programId", "DESC");
         $this->db->limit(20);
   //      $this->db->group_by("prg_offer.programId");
         $query=$this->db->get();
       
        $result = $query->result_array();
        if(!empty($result)){
            return $result;
        }
    }

    // Get ProgramOfferInfo by programofferid
    public function getofferProgramInfoById($id) {
        
        $qu = $this->db->get_where($this->_offertable, array('programOfferId' => $id));
        return $qu->row_array();
    }
     public function updateOfferProgramInfo($data, $id) {
       //  print_r($data); die();
        $qu = $this->db->where('programOfferId', $id);
        $this->db->update($this->_offertable, $data);
        return $this->db->affected_rows();
    }
    public function deleteOfferProgram($id) {
        $qu = $this->db->where('programOfferId', $id);
        $this->db->delete($this->_offertable);
        return $this->db->affected_rows();
    }
    
    public function duplicateProgramInfo($data) {
//        $this->db->select('campusName');        
        $qu = $this->db->get_where($this->_table, array('programName' => $data['programName'],'programLevel' => $data['programLevel']));
        $reault = $qu->row_array();
        return $reault;
    }
    public function duplicateProgramOffer($data) {       
        $quu = $this->db->get_where($this->_offertable, array('programLevel' => $data['programLevel'],'programId' => $data['programId'], 'mediumId' => $data['mediumId'],'groupId'=> $data['groupId'],'shiftId' => $data['shiftId'],'sectionId' => $data['sectionId'],'sessionId' => $data['sessionId'],'employeeId'=>$data['employeeId'],'applicantSeat'=>$data['applicantSeat'],'classStatus' => $data['classStatus']));
        $reault = $quu->row_array();
        return $reault;
    }

     public function deleteofferedPrograme($data) {
  //      print_r($offerId); echo ("--");   
        $qu = $this->db->where('programOfferId', $data['id']);
        $this->db->delete($this->_offertable);
        return $this->db->affected_rows()> 0;
    }
    
    
    
  public function getOfferedProgram() {
        $this->db->select('prg_offer.*,prg.*')
                ->from('programoffer prg_offer');
         $this->db->join('program prg', 'prg.programId= prg_offer.programId');
       //  $this->db->where('prg_offer.programId=prg.programId');
         $this->db->where('prg_offer.classStatus', 1);
         $this->db->order_by("prg_offer.programId", "asc");
         $this->db->group_by("prg_offer.programId");
         $query=$this->db->get();
       
        $result = $query->result_array();
        if(!empty($result)){
            return $result;
        }
        
    }
    
    public function getOfferedMedium() {
        
        $this->db->select('prg_offer.*,mdm.*')
                ->from('programoffer prg_offer');
         $this->db->join('medium mdm', 'mdm.mediumId= prg_offer.mediumId');
        // $this->db->where('prg_offer.mediumId=mdm.mediumId');
         $this->db->where('prg_offer.classStatus', 1);
         $this->db->order_by("prg_offer.mediumId", "asc");
         $this->db->group_by("prg_offer.mediumId");
         $query=$this->db->get();
       
            $result = $query->result_array();
            if(!empty($result)){
                return $result;
            }
        
    }
    public function getOfferedShift() {
        $this->db->select('prg_offer.*,sht.*')
                ->from('programoffer prg_offer');
         $this->db->join('shift sht', 'sht.shiftId= prg_offer.shiftId');
        // $this->db->where('prg_offer.shiftId=mdm.shiftId');
         $this->db->where('prg_offer.classStatus', 1);
         $this->db->order_by("prg_offer.shiftId", "asc");
         $this->db->group_by("prg_offer.shiftId");
         $query=$this->db->get();
       
            $result = $query->result_array();
            if(!empty($result)){
                return $result;
            }
        
    }
    public function getOfferedGroup() {
        
        $this->db->select('prg_offer.*,grp.*')
                ->from('programoffer prg_offer');
         $this->db->join('group grp', 'grp.groupId= prg_offer.groupId');
        // $this->db->where('prg_offer.shiftId=mdm.shiftId');
         $this->db->where('prg_offer.classStatus', 1);
         $this->db->order_by("prg_offer.groupId", "asc");
         $this->db->group_by("prg_offer.groupId");
         $query=$this->db->get();
       
            $result = $query->result_array();
            if(!empty($result)){
                return $result;
            }
        
    }
    public function getOfferedSection() {
        $this->db->select('prg_offer.*,sctn.*')
                ->from('programoffer prg_offer');
         $this->db->join('section sctn', 'sctn.sectionId= prg_offer.sectionId');
        // $this->db->where('prg_offer.shiftId=mdm.shiftId');
         $this->db->where('prg_offer.classStatus', 1);
         $this->db->order_by("prg_offer.sectionId", "asc");
         $this->db->group_by("prg_offer.sectionId");
         $query=$this->db->get();
       
            $result = $query->result_array();
            if(!empty($result)){
                return $result;
            }
       
    }
    public function getOfferedSession() {
        $this->db->select('prg_offer.*,ses.*')
                ->from('programoffer prg_offer');
         $this->db->join('session ses', 'ses.sessionId= prg_offer.sessionId');
        // $this->db->where('prg_offer.shiftId=mdm.shiftId');
         $this->db->where('prg_offer.classStatus', 1);
         $this->db->order_by("prg_offer.sessionId", "DESC");
         $this->db->group_by("prg_offer.sessionId");
         $query=$this->db->get();
       
            $result = $query->result_array();
            if(!empty($result)){
                return $result;
            }
       
    }
    public function getOfferedClassTeacher() {
        $this->db->select('prg_offer.*,emp.*')
                ->from('programoffer prg_offer');
         $this->db->join('employee emp', 'emp.employeeId= prg_offer.employeeId');
        // $this->db->where('prg_offer.shiftId=mdm.shiftId');
         $this->db->where('prg_offer.classStatus', 1);
         $this->db->order_by("prg_offer.employeeId", "asc");
         $this->db->group_by("prg_offer.employeeId");
         $query=$this->db->get();
       
            $result = $query->result_array();
            if(!empty($result)){
                return $result;
            }
       
    }
    
    public function searchlistofferprogram($data){
       if(!empty($data)){
       
        $this->db->where('campusId',$data['campusId']);
        $this->db->where('mediumId',$data['mediumId']);
        $this->db->where('programId',$data['programId']);
        $this->db->where('groupId',$data['groupId']);
        $this->db->where('sectionId',$data['sectionId']);
        $this->db->where('shiftId',$data['shiftId']);
        $this->db->where('sessionId',$data['sessionId']);      
        $this->db->where('employeeId',$data['employeeId']);      
       
        $qu = $this->db->get($this->_offertable);
        return $qu->result_array();
        }        
    }
    
    // check your inserted enrolment information is validate or not in programoffer table
    public function getValidateofferedprogram($data){
        
       if(!empty($data)){
           if(!empty($data['sectionId'])){
               if(!empty($data['programLevel'])){
                    $this->db->where('programLevel',$data['programLevel']);
                    $this->db->where('mediumId',$data['mediumId']);
                    $this->db->where('programId',$data['programId']);
                    $this->db->where('groupId',$data['groupId']);
                    $this->db->where('sectionId',$data['sectionId']);
                    $this->db->where('shiftId',$data['shiftId']);
                    $this->db->where('sessionId',$data['sessionId']);      
                    $this->db->where('classStatus',1); 

                    $qu = $this->db->get($this->_offertable);
                    return $qu->result_array();
               }
               else{
                    $this->db->where('mediumId', $data['mediumId']);
                    $this->db->where('programId', $data['programId']);
                    $this->db->where('groupId', $data['groupId']);
                    $this->db->where('sectionId', $data['sectionId']);
                    $this->db->where('shiftId', $data['shiftId']);
                    $this->db->where('sessionId', $data['sessionId']);
                    $this->db->where('classStatus', 1);

                    $qu = $this->db->get($this->_offertable);
                    return $qu->result_array();
               }
            }        
            else{
               if(!empty($data['programLevel'])){
                 $this->db->where('programLevel',$data['programLevel']);
                 $this->db->where('mediumId',$data['mediumId']);
                 $this->db->where('programId',$data['programId']);
                 $this->db->where('groupId',$data['groupId']);
                 $this->db->where('shiftId',$data['shiftId']);
                 $this->db->where('sessionId',$data['sessionId']);      
                 $this->db->where('classStatus',1);      

                 $qu = $this->db->get($this->_offertable);
                 $result= $qu->result_array();
                 if(!empty($result)){
                    return $result[0];
                 }
              }
               else{
                   $this->db->where('mediumId', $data['mediumId']);
                    $this->db->where('programId', $data['programId']);
                    $this->db->where('groupId', $data['groupId']);
                    $this->db->where('shiftId', $data['shiftId']);
                    $this->db->where('sessionId', $data['sessionId']);
                    $this->db->where('classStatus', 1);

                    $qu = $this->db->get($this->_offertable);
                    $result= $qu->result_array();
                        if(!empty($result)){
                           return $result[0];
                        }
               }
                 
            }
       }
    }
    // check your inserted enrolment information is validate or not in programoffer table
    public function getSectionArrayofferedprogram($data){
        
       if(!empty($data)){
                 $this->db->where('campusId',$data['campusId']);
                 $this->db->where('mediumId',$data['mediumId']);
                 $this->db->where('programId',$data['programId']);
                 $this->db->where('groupId',$data['groupId']);
                 $this->db->where('shiftId',$data['shiftId']);
                 $this->db->where('sessionId',$data['sessionId']);      
                 $this->db->where('classStatus',1);      

                 $qu = $this->db->get($this->_offertable);
                 $result= $qu->result_array();
                 if(!empty($result)){
                    return $result;
                 }
           
       }
    }
    
    public function getProgramOfferId_withPrglevel($data) {
        
        $result = $this->db->get_where($this->_offertable, array('programLevel'=>$data['programLevel'],'mediumId'=>$data['mediumId'],'programId'=>$data['programId'],'groupId'=>$data['groupId'],'sectionId'=>$data['sectionId'],'shiftId'=>$data['shiftId'],'sessionId'=>$data['sessionId'],'classStatus'=>1));
        $result_info =  $result->row_array(); 
        if(!empty($result_info))
        {
            return $result_info['programOfferId'];           
        }
        
    }
    
    public function getProgramOfferId($data) {
        
        $result = $this->db->get_where($this->_offertable, array('mediumId'=>$data['mediumId'],'programId'=>$data['programId'],'groupId'=>$data['groupId'],'sectionId'=>$data['sectionId'],'shiftId'=>$data['shiftId'],'sessionId'=>$data['sessionId'],'classStatus'=>1));
        $result_info =  $result->row_array(); 
        if(!empty($result_info))
        {
            return $result_info['programOfferId'];           
        }
        
    }
    
    // get All program offer info array(4m programoffer-table) by applicationId from admissionapplicant table
    function getPrOfferArraybyApplicantionId($id) {
        $this->db->select('ap.applicationId,ap.programOfferId, pr.*')
                ->from('admissionapplicant ap, programoffer pr');
         $this->db->join('programoffer', 'pr.programOfferId= ap.programOfferId');
        $query=$this->db->get_where('admissionapplicant', array('ap.applicationId' => $id));
       
        $result = $query->result_array();
        return $result[0];
    }
   // get programoofferid from programmoffer table by session & then match student programofferid from promotedstudent table 
    function getProgramOfferIdBySessionStudent($data) {
        $this->db->select('prostu.*,pr.*')
                ->from('promotedstudent prostu, programoffer pr');
         $this->db->join('programoffer', 'pr.programOfferId= prostu.programOfferId');
         $this->db->where('pr.sessionId', $data['sessionId']);
         $this->db->where('prostu.studentId', $data['studentId']);
         
        $query=$this->db->get();
       
        $result = $query->row_array();
        if(!empty($result)){
            return $result;
        }
    }
    
    
    // Dependable select step................
    public function getClasslist($id) {
        $this->db->select('*')
                ->from('program');       
         $this->db->where('programLevel',$id);
         $this->db->order_by('programName', "ASC");
         $this->db->group_by('programName');
         $query=$this->db->get();
       
          $result = $query->result_array();
            if(!empty($result)){
                return $result;
            }
       
    }
        // get program offered value by dependent select option
    public function getProgramOfferedValue($whr_data,$gt_data,$id) {
        $this->db->select('*')
                ->from('programoffer');       
         $this->db->where($whr_data,$id);
         $this->db->where('classStatus', 1);
         $this->db->order_by($gt_data, "ASC");
         $this->db->group_by($gt_data);
         $query=$this->db->get();
       
            $result = $query->result_array();
            if(!empty($result)){
                return $result;
            }
       
    }
    
}
