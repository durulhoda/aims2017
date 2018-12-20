<?php

/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class PaymentsModleAdmin extends CI_Model {
    //put your code here
    
     private $_table = "payments";
     private $_fine = "studentfine";
     private $_discount = "studentdiscount";
      private $_promotedstudent = "promotedstudent";

    public function __construct() {
        parent::__construct();
    }
    
    
    public function duplicatePaymentInfo($data) {
//        $this->db->select('campusName');        
        $qu = $this->db->get_where($this->_table, array('headId' => $data['headId'],'studentId' => $data['studentId'],'programOfferId' => $data['programOfferId'],'sessionId' => $data['sessionId'], 'payment_status' => $data['payment_status']));
        $reault = $qu->row_array();
        return $reault;
    }
    
    public function addpaymentInfo($data){
    //    print_r($data); die();
        $this->db->insert($this->_table, $data);
        
        return $this->db->insert_id();
 
    }
    
     public function getStudentpaymentList($studentId,$headId,$sessionId, $status = 0){
        $result = $this->db->get_where($this->_table, array('studentId'=>$studentId,'headId'=>$headId, 'sessionId'=>$sessionId, 'payment_status' => $status));
        $result_info =  $result->row_array(); 
        return $result_info;        
    }
    
       public function getStudentpaymentListt($studentId,$te){
        $result = $this->db->get_where($this->_table, array('studentId'=>$studentId,'headId'=>$te));
        $result_info =  $result->row_array(); 
        return $result_info;        
    }
     public function getStudentDiscountList($studentId,$headId, $programOfferId){
        $result = $this->db->get_where($this->_discount, array('studentId'=>$studentId,'headId'=>$headId, 'programOfferId' => $programOfferId));
        $result_info =  $result->row_array(); 
        return $result_info;        
    }
    
    // Get Paid Amount List info by StuentId & programofferId used in paymentadd/searchpaymentlist
    public function searchpaymentlist($data){
        
       if(!empty($data)){
        
        $this->db->where('studentId',$data['studentId']);
        $this->db->where('programOfferId',$data['programOfferId']);
        $qu = $this->db->get($this->_table);
        return $qu->result_array();
        }        
  }
  public function getpaymentlist(){

        $this->db->select('*');
        $qu = $this->db->get($this->_table);
        return $qu->result_array();
              
  }
  
    public function getstus($studentId){

        $this->db->select('*');
        $this->db->where('studentId',$studentId);
        $qu = $this->db->get($this->_promotedstudent);
        return $qu->result_array();
              
  }
  
    public function getpaymentlistprofitloss($data){
            
         $this->db->where('DATE(created_date) BETWEEN "' . $data['fromDate'] . '" and "' . $data['toDate'] . '"');
         $this->db->order_by('paymentId','DESC');
         $qu= $this->db->get_where($this->_table); 
         $reasult = $qu->result_array();        
        return $reasult;
              
  }
  
   
   /* -- ------ Use for payment list view to count paid amount---- --*/
   // Get Total Paid Amount List info by StuentId $ programOfferId used in paymentadd/searchpaymentlist
    public function totalpaidamount($data){
         
        $this->db->select_sum('amount');
        $this->db->where('studentId',$data['studentId']);
        $this->db->where('programOfferId',$data['programOfferId']);
        $query = $this->db->get($this->_table);
        $result = $query->result();

        return $result[0]->amount;
    }
    
    /* -- ------ Use for finace report to count paid amount---- --*/
    public function totalpaidamountbydate($data){
         
        $this->db->select_sum('amount');
        $this->db->where('paymentDate',$data);
        $query = $this->db->get($this->_table);
        $result = $query->result();

        return $result[0]->amount;
    }
    
    
    public function getAllPaymentinfo_byClass($data){    
        $this->db->select('stu_pay.*,stu.studentId,stu.applicationId,stu_info.applicationId,stu_info.firstName,stu_info.lastName,stu_info.middleName,SUM(stu_pay.amount) as stu_amount');
        $this->db->from('payments stu_pay');
        $this->db->join('student stu', 'stu.studentId=stu_pay.studentId');
        $this->db->join('studentinfo stu_info', 'stu.applicationId=stu_info.applicationId');
        $this->db->where('stu_pay.paymentDate BETWEEN "' . $data['from_date_time'] . '" and "' . $data['to_date_time'] . '"');
        $this->db->where('stu_pay.programOfferId',$data['programOfferId']);
        if(!empty($data['headId']))
        {
            $this->db->where('stu_pay.headId',$data['headId']);
        }
      //  $this->db->group_end();
         $qu= $this->db->get(); 
         $reasult = $qu->result_array();        
        return $reasult;
    }
    
    public function getCountByPaymentHead_date($data){
         
        $this->db->select_sum('amount');
        $this->db->where('DATE(created_date)>=',$data['from_date_time']);
        $this->db->where('DATE(created_date)<=',$data['to_date_time']);
        if(!empty($data['headId']))
        {
            $this->db->where('headId',$data['headId']);
        }
        $query = $this->db->get($this->_table);
        $result = $query->result();
//        echo '<pre>';
//        print_r($result);exit;

        return $result[0]->amount;
    }
    
    public function getPayment_Head_Class_date($data){    
        $this->db->select('stu_pay.programOfferId,stu_pay.created_date as paymentDate,stu_pay.headId,stu_pay.headId,SUM(stu_pay.amount) as stu_amount,prg.programOfferId,prg.programId,prg.groupId,prg.sectionId,prg.sessionId');
        $this->db->from('payments stu_pay');
        $this->db->join('programoffer prg', 'prg.programOfferId=stu_pay.programOfferId');
        $this->db->where('DATE(stu_pay.created_date) BETWEEN "' . $data['from_date_time'] . '" and "' . $data['to_date_time'] . '"');
        if(!empty($data['headId']))
        {
            $this->db->where('stu_pay.headId',$data['headId']);
        }
        $this->db->order_by('stu_pay.programOfferId','ASC');
        $this->db->group_by('stu_pay.programOfferId');
         $qu= $this->db->get(); 
         $reasult = $qu->result_array();
        return $reasult;
    }
    
    public function getDuesByClass_date($data){    
        $this->db->select('stu_pay.programOfferId,stu_pay.paymentDate,stu_pay.headId,stu_pay.headId,SUM(stu_pay.amount) as stu_amount,prg.programOfferId,prg.programId,prg.groupId,prg.sectionId,prg.sessionId,promot.programOfferId,count(promot.studentId) as total_student,tui_fee.programOfferId,tui_fee.amount,tui_fee.quata_id');
        $this->db->from('payments stu_pay');
        $this->db->join('programoffer prg', 'prg.programOfferId=stu_pay.programOfferId');
        $this->db->join('promotedstudent promot', 'promot.programOfferId=prg.programOfferId');
        $this->db->join('fees tui_fee', 'tui_fee.programOfferId=prg.programOfferId');
        $this->db->where('stu_pay.paymentDate BETWEEN "' . $data['from_date_time'] . '" and "' . $data['to_date_time'] . '"');
        if(!empty($data['headId']))
        {
            $this->db->where('stu_pay.headId',$data['headId']);
        }
        $this->db->order_by('stu_pay.programOfferId','ASC');
        $this->db->group_by('stu_pay.programOfferId');
         $qu= $this->db->get(); 
         $reasult = $qu->result_array();        
        return $reasult;
    }
    
    
    
    
    
    public function addStudentFine($data){
//        print_r($data); exit;
        
        
        $this->db->insert($this->_fine, $data);
        
        return $this->db->insert_id();
 
    }
    
    // Get Fine Amount List info by StuentId  used in paymentadd/searchpaymentlist
    public function searchfinelist($data, $programOfferId = 0){
       if(!empty($data)){        
          $this->db->where('studentId',$data['studentId']);
         $this->db->where('programOfferId',$programOfferId);
        $qu = $this->db->get($this->_fine);
        return $qu->result_array();
      }        
  }
  public function searchdiscountlist($data){
     
       if(!empty($data)){
        
        $this->db->where('studentId',$data['studentId']);
      //  $this->db->order_by('date','DESC');
        $qu = $this->db->get($this->_discount);
        return $qu->result_array();
        }        
  }
  public function getStudentfineList($studentId,$finehead,$date){
        $result = $this->db->get_where($this->_table, array('studentId'=>$studentId,'headId'=>$finehead, 'session'=>$date));
        $result_info =  $result->row_array(); 
        return $result_info;        
    }
   public function totalfineamount($data){
         
        $this->db->select_sum('amount');
        $this->db->where('studentId',$data['studentId']);
        $query = $this->db->get($this->_fine);
        $result = $query->result();

        return $result[0]->amount;
    }
    
    public function duplicateStudentFine($data) {   
        
        $qu = $this->db->get_where($this->_fine, array('finehead' => $data['finehead'],'studentId' => $data['studentId'],'programOfferId' => $data['programOfferId']));
        $reault = $qu->row_array();
        return $reault;
    }
    
    public function addDiscount($data){
//        print_r($data); exit;

        $this->db->insert($this->_discount, $data);
        
        return $this->db->insert_id();
 
    }
    public function deletestudentdiscount($id){
        
        $this->db->where('studentId', $id);
        $this->db->delete($this->_discount);
        return $this->db->affected_rows(); 
    }
    public function deletestudentfine($id){
        
        $this->db->where('studentId', $id);
        $this->db->delete($this->_fine);        
        return $this->db->affected_rows(); 
    }
      public function getPaymentdate(){   
         $this->db->select('*');
        $this->db->distinct();
         $this->db->group_by('paymentDate');
         $this->db->order_by('paymentId','DESC');
         $qu= $this->db->get_where($this->_table); 
        return $qu->result_array();
         
    }
    
}


