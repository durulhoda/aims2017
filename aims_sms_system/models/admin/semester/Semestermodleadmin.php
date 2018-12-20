<?php
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class SemesterModleAdmin extends CI_Model {
    
     private $_table = "semester";

    public function __construct() {
        parent::__construct();
    }
    
    
    public function addSemesterInfo($data){
        
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();       
        
    }
    
public function getSemesterInfo(){
//        $this->db->order_by("id", "asc");
        $qu = $this->db->get($this->_table);
        return $qu->result_array();
    }
    
    public function getSemesterInfoArray(){
        $this->db->select('semesterId, semester');
        $this->db->order_by("semester", "ASC");
        $qu = $this->db->get($this->_table);
        return $qu->result_array();        
    }
    
    public function editSemesterInfo($id){
        $qu = $this->db->get_where($this->_table, array('semesterId'=>$id));
        return $qu->row_array();
    }
    
    
    public function deleteSemesterInfo($id){
        $qu = $this->db->where('semesterId', $id);
        $this->db->delete($this->_table);
        return $this->db->affected_rows();
        
    }
    
         public function checkSemesterInfo($id){
        $this->db->select('sem.*,sut_mark.*');
        
        $this->db->from('semester sem');
        $this->db->join('studentmarks sut_mark', 'sem.semesterId = sut_mark.semesterId');
       
           $this->db->where('sut_mark.semesterId', $id);
           
        $query = $this->db->get();
        $result = $query->result_array();
        if (!empty($result)) {
            return $result;
        }
    }
    
    
    public function updateSemesterInfo($data, $id){
        $qu = $this->db->where('semesterId', $id);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows();
        
    }
    

        public function getSemesterName($id){
        $result = $this->db->get_where($this->_table, array('semesterId'=>$id));
        $result_info =  $result->row_array(); 
        //echo $result_info['semester'];exit;
        return $result_info['semester'];      
        
    
    }//put your code here
    public function duplicateSemesterInfo($data) {
//        $this->db->select('campusName');        
        $qu = $this->db->get_where($this->_table, array('semester' => $data['semester']));
        $reault = $qu->row_array();
        return $reault;
    }
}

