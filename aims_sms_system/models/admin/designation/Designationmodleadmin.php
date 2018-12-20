<?php
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class DesignationModleAdmin extends CI_Model {
    
    private $_table = "designation";

    public function __construct() {
        parent::__construct();
    }   
    
    public function addDesignationInfo($data){
    
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();       
    }
       
    public function getlistDesignation(){
        $this->db->select('*');
        $this->db->order_by("designation", "ASC");
        $qu = $this->db->get($this->_table);
        return $qu->result_array();
        
    }
    public function getDesignationName($id){
       
         $qu = $this->db->get_where($this->_table, array('dsgId' => $id));        
        $result = $qu->row_array();
        if(!empty($result['designation'])){
            return $result['designation'];
        }
    }
    public function duplicateDesignationInfo($data) {
//        $this->db->select('campusName');        
        $qu = $this->db->get_where($this->_table, array('designation' => $data['designation']));
        $reault = $qu->row_array();
        return $reault;
    }
       public function editdesignation($id) {
        $qu = $this->db->get_where($this->_table, array('dsgId' => $id));
        return $qu->row_array();
    }

    public function updateDesignationInfo($data, $id) {

        $qu = $this->db->where('dsgId', $id);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows();
    }

    public function deleteDesignationInfo($id) {
        $qu = $this->db->where('dsgId', $id);
        $this->db->delete($this->_table);
        return $this->db->affected_rows();
    }
    
         public function checkDesignationInfo($id){
        $this->db->select('desg.*,empd.*');
        
        $this->db->from('designation desg');
        $this->db->join('employee empd', 'desg.designation = empd.designation');
       
           $this->db->where('empd.designation', $id);
           
        $query = $this->db->get();
        $result = $query->result_array();
        if (!empty($result)) {
            return $result;
        }
    }
}


