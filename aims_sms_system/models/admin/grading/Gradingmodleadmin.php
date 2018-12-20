<?php

/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class GradingModleAdmin extends CI_Model {

    //put your code here
    private $_table = "grading";

    public function __construct() {
        parent::__construct();
    }

    public function addGradingInfo($data) {
//        print_r($data); exit;

        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();
    }

    public function gradinglist() {
        $qu = $this->db->get($this->_table);
        return $qu->result_array();
    }

    public function duplicateGradingInfo($data) {
//        $this->db->select('campusName');        
        $qu = $this->db->get_where($this->_table, array('fromPercentage' => $data['fromPercentage'], 'toPercentage' => $data['toPercentage'], 'gradePoint' => $data['gradePoint'], 'grade' => $data['grade'], 'outOf' => $data['outOf']));
        $reault = $qu->row_array();
        return $reault;
    }

    public function editGradingInfo($id) {
        $qu = $this->db->get_where($this->_table, array('gradingId' => $id));
        return $qu->row_array();
    }

    public function updateGradingInfo($data, $id) {

        $qu = $this->db->where('gradingId', $id);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows();
    }

    public function deleteGradingInfo($id) {
        $qu = $this->db->where('gradingId', $id);
        $this->db->delete($this->_table);
        return $this->db->affected_rows();
    }

    public function getGradeInfo($mark) {

        if ($mark) {
            $this->db->where('total BETWEEN 100 AND 200');
            $this->db->order_by("total", "DESC");
            $results = $this->db->get($this->_table);
            return $results->result_array();
        } elseif ($data['marks'] == 2) {
            $this->db->where('total BETWEEN 90 AND 99');
            $this->db->order_by("total", "DESC");
            $results = $this->db->get($this->_table);
            return $results->result_array();
        } elseif ($data['marks'] == 3) {
            $this->db->where('total BETWEEN 80 AND 89');
            $this->db->order_by("total", "DESC");
            $results = $this->db->get($this->_table);
            return $results->result_array();
        } elseif ($data['marks'] == 4) {
            $this->db->where('total BETWEEN 70 AND 79');
            $this->db->order_by("total", "DESC");
            $results = $this->db->get($this->_table);
            return $results->result_array();
        } elseif ($data['marks'] == 5) {
            $this->db->where('total BETWEEN 60 AND 69');
            $this->db->order_by("total", "DESC");
            $results = $this->db->get($this->_table);
            return $results->result_array();
        } elseif ($data['marks'] == 6) {
            $this->db->where('total BETWEEN 50 AND 59');
            $this->db->order_by("total", "DESC");
            $results = $this->db->get($this->_table);
            return $results->result_array();
        } elseif ($data['marks'] == 7) {
            $this->db->where('total BETWEEN 40 AND 49');
            $this->db->order_by("total", "DESC");
            $results = $this->db->get($this->_table);
            return $results->result_array();
        } else {
            $this->db->where('total BETWEEN 1 AND 39');
            $this->db->order_by("total", "DESC");
            $results = $this->db->get($this->_table);
            return $results->result_array();
        }
    }

}

?>
