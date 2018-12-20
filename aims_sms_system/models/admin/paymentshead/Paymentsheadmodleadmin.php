<?php

/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class PaymentsHeadModleAdmin extends CI_Model {
    //put your code here
    
     private $_table = "paymenthead";

    public function __construct() {
        parent::__construct();
    }
    
     public function getPaymentHeadName(){
        
        $this->db->select('headId ,headCategory,headName');
        $result = $this->db->get($this->_table);
        return $result->result_array();   
    }
    public function getPaymentsHeadName($headId){
        $result = $this->db->get_where($this->_table, array('headId'=>$headId));
        $result_info =  $result->row_array(); 
        return $result_info['headName'];        
    }
    public function getPaymentheadListarray($id){
        $this->db->select('*');
        $qu = $this->db->get_where($this->_table, array('headId' => $id));
        return $qu->result_array();     
    }
    public function addPaymentheadInfo($data){
//        print_r($data); exit;
        
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();       
        
    }
    public function getFineHeadList(){
        
       
        $this->db->select('headId ,headCategory,headName');
        $result = $this->db->get_where($this->_table, array('headCategory'=>2));
        return $result->result_array();   
    }
    
     public function getlistpaymenthead(){
         
        $result = $this->db
        ->where('is_deleted', 0)
        ->get($this->_table);
        return $result->result_array();  
    }
    
        public function editpaymentheadInfo($id) {
        $qu = $this->db->get_where($this->_table, array('headId' => $id));
        return $qu->row_array();
    }

    public function updatepaymentheadInfo($data, $id) {

        $qu = $this->db->where('headId', $id);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows();
    }

    public function deletepaymentheadInfo($id) {
        $qu = $this->db->where('headId', $id);
        //$this->db->delete($this->_table);
        $this->db->update($this->_table, ['is_deleted' => 1]);
        return $this->db->affected_rows();
    }
    
    public function duplicatePaymentheadInfo($data) {
//        $this->db->select('campusName');        
        $qu = $this->db->get_where($this->_table, array('headCategory' => $data['headCategory'], 'headName' => $data['headName']));
        $reault = $qu->row_array();
        return $reault;
    }
    
}


