<?php
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class FinanceheadModleAdmin extends CI_Model {
    
    private $_table = "financehead";
    private $_table1 = "finance";

    public function __construct() {
        parent::__construct();
    }
    
    
    public function addHeadsetupInfo($data){
//        print_r($data); exit;
        
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();       
        
    }
    
   public function getlistfinancehead(){ 
        $result = $this->db->get($this->_table);
         return $result->result_array();  
    }
    
        
     public function editfinancehead($id) {
        $qu = $this->db->get_where($this->_table, array('id' => $id));
        return $qu->row_array();
    }

    public function updatefinancehead($data, $id) {

        $qu = $this->db->where('id', $id);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows();
    }
    
        public function updatefinance($data, $id) {

        $qu = $this->db->where('financeId', $id);
        $this->db->update($this->_table1, $data);
        return $this->db->affected_rows();
    }

      public function deletefinancehead($id) {
        $qu = $this->db->where('id', $id);
        $this->db->delete($this->_table);
        return $this->db->affected_rows();
    }

     public function editfinance($id) {
        $qu = $this->db->get_where($this->_table1, array('financeId' => $id));
        return $qu->row_array();
    }
    
    public function deletefinance($id) {
        $qu = $this->db->where('financeId', $id);
        $this->db->delete($this->_table1);
        return $this->db->affected_rows();
    }
    
    public function getIncomeHeadCategoryName($id){   
        $qu = $this->db->get_where($this->_table, array('id' => $id));        
        $result = $qu->row_array();
        return $result['headcategory'];
    }
    
    public function duplicateInfo($data) {
//      $this->db->select('campusName');        
        $qu = $this->db->get_where($this->_table, array('headcategory' => $data['headcategory']));
        $reault = $qu->row_array();
        return $reault;
    }
    
    
   
    
    public function addFinanceInfo($data){
//        print_r($data); exit;
        
        $this->db->insert($this->_table1, $data);
        return $this->db->insert_id();       
        
    }
    
     public function getFinancedate(){   
         $this->db->select('*');
        $this->db->distinct();
         $this->db->group_by('addDate');
         $this->db->order_by('financeId','DESC');
         $qu= $this->db->get_where($this->_table1); 
        return $qu->result_array();
         
    }
         public function getFinanceheadlist(){   
         $this->db->select('*');
        $this->db->distinct();
         $this->db->group_by('headcategory');
         $this->db->order_by('id','DESC');
         $qu= $this->db->get_where($this->_table); 
        return $qu->result_array();
         
    }
    
    public function getAllfinanceinfo($data){    
        
       $date_check= $this->db->where('addDate BETWEEN "' . $data['from_date_time'] . '" and "' . $data['to_date_time'] . '"');
       if(!empty($date_check))
        {
            if(!empty($data['financeHead']) || !empty($data['financeCategory']))
            {
                $this->db->like('financeHead',$data['financeHead']);
                $this->db->where('financeCategory',$data['financeCategory']);
            }
        }
      //  $this->db->group_end();
         $qu= $this->db->get_where($this->_table1); 
         $reasult = $qu->result_array();        
        return $reasult;
    }
        public function getAllfinancelist($data){ 
         $this->db->where('addDate BETWEEN "' . $data['fromDate'] . '" and "' . $data['toDate'] . '"');
         $this->db->order_by('financeId','DESC');
         $qu= $this->db->get_where($this->_table1); 
         $reasult = $qu->result_array();        
        return $reasult;
    }
    
    public function getAll_income_financelist($data){ 
         $this->db->where('addDate BETWEEN "' . $data['fromDate'] . '" and "' . $data['toDate'] . '"');
         $this->db->where('financeCategory',1);
         $this->db->or_where('financeCategory',3);
         $this->db->order_by('financeId','DESC');
         $qu= $this->db->get_where($this->_table1); 
         $reasult = $qu->result_array();        
        return $reasult;
    }
    
    public function getAll_expences_financelist($data){ 
         $this->db->where('addDate BETWEEN "' . $data['fromDate'] . '" and "' . $data['toDate'] . '"');
         $this->db->where('financeCategory',2);
         $this->db->order_by('financeId','DESC');
         $qu= $this->db->get_where($this->_table1); 
         $reasult = $qu->result_array();        
        return $reasult;
    }
    

  
}
 

