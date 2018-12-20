<?php

/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class GroupModleAdmin extends CI_Model {
    
    private $_table = "group";

    public function __construct() {
        parent::__construct();
    }
    
    
    public function addGroupInfo($data){
//        print_r($data); exit;
        
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();       
        
    }
    
   public function getlistGroup(){
         
        $result = $this->db->get($this->_table);
        return $result->result_array();  
    }
    
    public function getGroupInfoArray(){
        $this->db->select('groupId, groupName');
//        $this->db->order_by("groupName", "asc");
        $qu = $this->db->get($this->_table);
        return $qu->result_array();
        
    }
    
     public function editGroupInfo($id) {
        $qu = $this->db->get_where($this->_table, array('groupId' => $id));
        return $qu->row_array();
    }

    public function updateGroupInfo($data, $id) {

        $qu = $this->db->where('groupId', $id);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows();
    }

    public function deleteGroupInfo($id) {
        $qu = $this->db->where('groupId', $id);
        $this->db->delete($this->_table);
        return $this->db->affected_rows();
    }
    
     public function checkGroupInfo($id){
        $this->db->select('grp.*,prog_offer.*');
        
        $this->db->from('group grp');
        $this->db->join('programoffer prog_offer', 'grp.groupId = prog_offer.groupId');
       
           $this->db->where('prog_offer.groupId', $id);
           
        $query = $this->db->get();
        $result = $query->result_array();
        if (!empty($result)) {
            return $result;
        }
    }
    
    public function getGroupName($id){
            
        $qu = $this->db->get_where($this->_table, array('groupId' => $id));        
        $result = $qu->row_array();
        return $result['groupName'];
    }
    
    public function duplicateGroupInfo($data) {
//        $this->db->select('campusName');        
        $qu = $this->db->get_where($this->_table, array('groupName' => $data['groupName']));
        $reault = $qu->row_array();
        return $reault;
    }
   
}
 

