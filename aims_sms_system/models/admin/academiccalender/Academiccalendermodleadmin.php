<?php
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class AcademicCalenderModleAdmin extends CI_Model {
      private $_table = "calendar";

    public function __construct() {
        parent::__construct();
    }
    
    public function addAcademiccalender($data){
        
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();       
        
    }
    public function academiccalendervalidation($data) {
        
        $this->db->select('*');
       $this->db->where('startdate',$data['startdate']);
        $this->db->where('description',$data['description']);
        
        $result = $this->db->get($this->_table);
        return $result->row_array();   
        
       
    }
    
 
    
    public function getCalenderList(){
        
        $this->db->select('*');
        $this->db->order_by('startdate','DESC');
        $result = $this->db->get($this->_table);
        return $result->result_array();   
    }
    
     public function showmonthlyevent() {
        
        $this->db->select('*');
        $this->db->order_by('startdate','ASC');
        $result = $this->db->get($this->_table);
        return $result->result_array();   
        
       
    }
    public function getEventdate($dates){               
        $this->db->select('*');
        $this->db->where('startdate',$dates);
        $result = $this->db->get($this->_table);
        return $result->row_array();   
//        $qu = $this->db->get_where($this->_table,  array('startdate'=>$dates)); 
//         $reasult = $qu->row_array();        
//        return $reasult['startdate'];
    }
    
    public function getEventdescription($date){               
        $qu = $this->db->get_where($this->_table,  array('startdate'=>$date)); 
         $reasult = $qu->row_array();        
        return $reasult['description'];
    }
    
      public function getevent($startdate, $enddate) {
      
          $this->db->where('startdate>=', $startdate);
          $this->db->where('enddate<=', $enddate);
          $this->db->order_by('startdate', "ASC");  
            $qu = $this->db->get($this->_table);
            return $qu->result_array();
        
    }
    
   
         public function editeventinformation($Id) {
        $qu = $this->db->get_where($this->_table, array('calendarId' => $Id));
        return $qu->row_array();
    }
    
        public function updateevent($data,$Id){
       //  print_r($data); echo $id; die();
        $this->db->where('calendarId', $Id);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows(); 
    }
    
        public function deleteevent($id){
        $qu = $this->db->where('calendarId', $id);
        $this->db->delete($this->_table);
        return $this->db->affected_rows();
        
    }
    
     public function duplicateeventInfo($stdate){

      $user_check = $this->db->get_where($this->_table, array(
          
          'startdate' =>$stdate
         
      ));
      
        if ($user_check->num_rows() > 0){
            return TRUE;
        }
        else{
            return FALSE;
        }
  
    }
    
    
     
}