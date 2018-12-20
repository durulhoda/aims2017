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
class PublishResultModelAdmin extends CI_Model {
    //put your code here
 
    private $_table1 = "publishedresult";

    public function __construct() {
        parent::__construct();
    }
    
    
    public function publishresults($data){
        $this->db->insert($this->_table1, $data);
        return $this->db->insert_id();     
        
    }
     public function publishresultsbystudent($data,$data_id){
        $this->db->where('studentId', $data_id['studentId']);
        $this->db->where('programOfferId', $data_id['programOfferId']);
        $this->db->where('semesterId', $data_id['semesterId']);
        $this->db->update($this->_table1, $data);
        return $this->db->affected_rows();
        
    }
    public function unpublishresultsbystudent($data,$data_id){
        $this->db->where('studentId', $data_id['studentId']);
        $this->db->where('programOfferId', $data_id['programOfferId']);
        $this->db->where('semesterId', $data_id['semesterId']);
        $this->db->update($this->_table1, $data);
        return $this->db->affected_rows();
        
    }
    
    public function getresultStatus($data) {
      
        if(!empty($data))
        {
            $this->db->select('*');
            $this->db->from($this->_table1);            
            $this->db->where('studentId',$data['studentId']);
            $this->db->where('semesterId',$data['semesterId']);
            $this->db->where('programOfferId',$data['programOfferId']);
            $qu = $this->db->get();
            $reault = $qu->result_array();
            if(!empty($reault))
            {   
                return $reault;
            }
            else{
                return false;
            }
        }
        else{
                return false;
            }
    }
        
        
   public function checkduplicatepublishresults($data) {
//        $this->db->select('campusName');        
        $qu = $this->db->get_where($this->_table1, array('studentId' => $data['studentId'],'semesterId' => $data['semesterId'],'programOfferId' => $data['programOfferId']));
        $reault = $qu->row_array();
        return $reault;
    }     
}


