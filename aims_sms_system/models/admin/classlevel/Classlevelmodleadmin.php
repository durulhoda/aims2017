<?php

/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class ClasslevelModleAdmin extends CI_Model {

    private $_table = "classlevel";

    public function __construct() {
        parent::__construct();
    }

    public function addClasslevelInfo($data) {
//        print_r($data); exit;

        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();
    }

    public function getClasslevelInfo() {
//        $this->db->order_by("id", "asc");
        $qu = $this->db->get($this->_table);
        return $qu->result_array();
    }

    public function getClasslevelInfoArray() {

        $this->db->select('classlevelId, classlevelName');
//        $this->db->order_by("groupName", "asc");
        $qu = $this->db->get($this->_table);
        return $qu->result_array();
    }

    public function editClasslevelInfo($id) {
        $qu = $this->db->get_where($this->_table, array('classlevelId' => $id));
        return $qu->row_array();
    }

    public function deleteClasslevelInfo($id) {
        $qu = $this->db->where('classlevelId', $id);
        $this->db->delete($this->_table);
        return $this->db->affected_rows();
    }

    public function updateClasslevelInfo($data, $id) {
        $qu = $this->db->where('classlevelId', $id);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows();
    }

    public function getClasslevelName($id) {

        $qu = $this->db->get_where($this->_table, array('classlevelId' => $id));
        $result = $qu->row_array();
        return $result['classlevelName'];
    }

    public function duplicateClasslevelInfo($data) {
//        $this->db->select('campusName');        
        $qu = $this->db->get_where($this->_table, array('classlevelName' => $data['classlevelName']));
        $reault = $qu->row_array();
        return $reault;
    }

}