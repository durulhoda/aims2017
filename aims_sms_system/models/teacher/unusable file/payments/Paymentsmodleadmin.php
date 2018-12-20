<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of paymentsmodleadmin
 *
 * @author Binita
 */
class PaymentsModleAdmin extends CI_Model {
    //put your code here
    
     private $_table = "payments";
     private $_fine = "studentfine";
     private $_discount = "studentdiscount";

    public function __construct() {
        parent::__construct();
    }
    
    
    public function duplicatePaymentInfo($data) {
//        $this->db->select('campusName');        
        $qu = $this->db->get_where($this->_table, array('headId' => $data['headId'],'studentId' => $data['studentId'],'programOfferId' => $data['programOfferId'],'sessionId' => $data['sessionId']));
        $reault = $qu->row_array();
        return $reault;
    }
    
    public function addpaymentInfo($data){
//        print_r($data); exit;

        $this->db->insert($this->_table, $data);
        
        return $this->db->insert_id();
 
    }
    
     public function getStudentpaymentList($studentId,$headId,$sessionId){
        $result = $this->db->get_where($this->_table, array('studentId'=>$studentId,'headId'=>$headId, 'sessionId'=>$sessionId));
        $result_info =  $result->row_array(); 
        return $result_info;        
    }
     public function getStudentDiscountList($studentId,$headId){
        $result = $this->db->get_where($this->_discount, array('studentId'=>$studentId,'headId'=>$headId));
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
//        print_r($data);       
        
        $this->db->select('*');
        $qu = $this->db->get($this->_table);
        return $qu->result_array();
              
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
    
    public function addStudentFine($data){
//        print_r($data); exit;
        
        
        $this->db->insert($this->_fine, $data);
        
        return $this->db->insert_id();
 
    }
    
    // Get Fine Amount List info by StuentId  used in paymentadd/searchpaymentlist
    public function searchfinelist($data){
       if(!empty($data)){        
        $this->db->where('studentId',$data['studentId']);
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
//        $this->db->select('campusName');        
        
        $qu = $this->db->get_where($this->_fine, array('finehead' => $data['finehead'],'studentId' => $data['studentId'],'date' => $data['date']));
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


