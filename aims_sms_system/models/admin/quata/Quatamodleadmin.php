<?php
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class QuataModleAdmin extends CI_Model {
    
    private $_table = "quata";

    public function __construct() {
        parent::__construct();
    }
    
    
    public function addquataInfo($data){
    
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();       
    }
       
    public function getQuatalist(){
        $this->db->select('*');
        $this->db->order_by("quata", "DESC");
        $qu = $this->db->get($this->_table);
        return $qu->result_array();
        
    }
    public function getQuataName($id){
       
         $qu = $this->db->get_where($this->_table, array('quata_id' => $id));      
       // $this->db->order_by("quata_id", "DESC");
        $result = $qu->row_array();
        if(!empty($result['quata'])){
            return $result['quata'];
        }
    }
    public function duplicatequataInfo($data) {
//        $this->db->select('campusName');        
        $qu = $this->db->get_where($this->_table, array('quata' => $data['quata']));
        $reault = $qu->row_array();
        return $reault;
    }
       public function editquata($id) {
        $qu = $this->db->get_where($this->_table, array('quata_id' => $id));
        return $qu->row_array();
    }

    public function updatequataInfo($data, $id) {

        $qu = $this->db->where('quata_id', $id);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows();
    }

    public function deletequataInfo($id) {
        $qu = $this->db->where('quata_id', $id);
        $this->db->delete($this->_table);
        return $this->db->affected_rows();
    }
    
         public function checkQuataInfo($id){
        $this->db->select('qut.*,stuinfo.*');
        
        $this->db->from('quata qut');
        $this->db->join('studentinfo stuinfo', 'qut.quata_id = stuinfo.quata_id');
       
           $this->db->where('stuinfo.quata_id', $id);
           
        $query = $this->db->get();
        $result = $query->result_array();
        if (!empty($result)) {
            return $result;
        }
    }
    
}


