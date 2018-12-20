<?php

/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class PeriodModleAdmin extends CI_Model {
    
    private $_table = "period";

    public function __construct() {
        parent::__construct();
    }
    
    
    public function addPeriodInfo($data){
//        print_r($data); exit;
        if (isset($data['is_break_time'])) {
            $data['is_break_time'] = 1;
        }
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();       
        
    }
    
   public function getlistPeriod($sessionId = 0, $shiftId = 0){

        $where = [];
        if ($sessionId){
            $where['p.sessionId'] = $sessionId;
        }   
        if ($shiftId) {
            $where['p.shiftId'] = $shiftId;
        }  
        $result = $this->db
                    ->select('p.*,session.session')
                    ->from($this->_table.' AS p')
                    ->join('session', 'session.sessionId = p.sessionId','left')
                    ->where($where)
                    ->order_by('p.ordering', 'asc')
                    ->order_by('p.shiftId', 'asc')
                    ->order_by('p.sessionId', 'asc')
                    ->get();
        return $result->result_array();  
    }
    
    
    public function getPeriodInfoArray(){
        $this->db->select('*');
//        $this->db->order_by("groupName", "asc");
        $qu = $this->db->get($this->_table);
        return $qu->result_array();
        
    }
    
     public function editPeriodInfo($id) {
        $qu = $this->db->get_where($this->_table, array('periodId' => $id));
        return $qu->row_array();
    }

    public function updatePeriodInfo($data, $id) {
       // echo 'hi';exit;
        if (isset($data['is_break_time'])) {
            $data['is_break_time'] = 1;
        } else {
            $data['is_break_time'] = 0;
        }
        $qu = $this->db->where('periodId', $id);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows();
    }

    public function deletePeriodInfo($id) {
        $qu = $this->db->where('periodId', $id);
        $this->db->delete($this->_table);
        return $this->db->affected_rows();
    }
    
        public function checkPeriodInfo($id) {
        $this->db->select('tpri.*,clroutin.*');

        $this->db->from('period tpri');
        $this->db->join('classroutine clroutin', 'tpri.periodId = clroutin.periodId');

        $this->db->where('clroutin.periodId', $id);

        $query = $this->db->get();
        $result = $query->result_array();
        if (!empty($result)) {
            return $result;
        }
    }

    public function getPeriodTime($shiftId,$periodId){
        $result = $this->db->get_where($this->_table, array('shiftId'=>$shiftId,'periodId'=>$periodId));
        $result_info =  $result->row_array(); 
        if(!empty($result_info['periodTime']))
        {
            return $result_info['periodTime'];        
        }
        
    }
    
    public function duplicatePeriodInfo($data) {
//        $this->db->select('campusName');  
        if (isset($data['is_break_time'])) {
            $data['is_break_time'] = 1;
        } else {
            $data['is_break_time'] = 0;
        }      
        $qu = $this->db->get_where($this->_table, array('periodName' => $data['periodName'],'shiftId' => $data['shiftId'],'periodTime' => $data['periodTime'], 'sessionId' => $data['sessionId'],'is_break_time' => $data['is_break_time'], 'ordering' => $data['ordering']));
        $reault = $qu->row_array();
        return $reault;
    }
}
 

