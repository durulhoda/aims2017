<?php
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class DepartmentModleAdmin extends CI_Model {
    
    private $_table = "department";

    public function __construct() {
        parent::__construct();
    }
    
    
    public function addDepartmentInfo($data){
    
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();       
    }
       
    public function getlistDepartment(){
        $this->db->select('departmentId, departmentName');
        $this->db->order_by("departmentName", "ASC");
        $qu = $this->db->get($this->_table);
        return $qu->result_array();
        
    }
    public function getDepartmentName($id){
       
         $qu = $this->db->get_where($this->_table, array('departmentId' => $id));        
        $result = $qu->row_array();
        if(!empty($result['departmentName'])){
            return $result['departmentName'];
        }
    }
    public function duplicateDepartmentInfo($data) {
//        $this->db->select('campusName');        
        $qu = $this->db->get_where($this->_table, array('departmentName' => $data['departmentName']));
        $reault = $qu->row_array();
        return $reault;
    }
       public function editdepartment($id) {
        $qu = $this->db->get_where($this->_table, array('departmentId' => $id));
        return $qu->row_array();
    }

    public function updateDepartmentInfo($data, $id) {

        $qu = $this->db->where('departmentId', $id);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows();
    }

    public function deleteDepartmentInfo($id) {
        $qu = $this->db->where('departmentId', $id);
        $this->db->delete($this->_table);
        return $this->db->affected_rows();
    }
    
        public function checkDepartmentInfo($id){
        $this->db->select('dept.*,empDpt.*');
        
        $this->db->from('department dept');
        $this->db->join('employee empDpt', 'dept.departmentId = empDpt.departmentId');
       
           $this->db->where('empDpt.departmentId', $id);
           
        $query = $this->db->get();
        $result = $query->result_array();
        if (!empty($result)) {
            return $result;
        }
    }
    
}


