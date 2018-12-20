<?php

/*
* Project Name: aims
 * Author: adventure-soft
 * Author url: http://www.adventure-soft.com
 */
class FeesModleAdmin extends CI_Model {

    //put your code here

    private $_table = "fees";
   private $_payments = "payments";

    public function __construct() {
        parent::__construct();
    }

    public function getPaymentHeadName() {

        $this->db->select('headId ,headName');
        $result = $this->db->get($this->_table);
        return $result->result_array();
    }

       public function addfees($datax) {
        $datax['date'] = date('d/m/Y');
         $this->db->insert($this->_table, $datax);
        return $this->db->insert_id(); 

    }
    public function oldaddfees($data) {
        
        
//        print_r($data); exit;
        $datax['headId'] = $data['headId'];
        $datax['programOfferId'] = $data['programOfferId'];
        $datax['amount'] = $data['amount'];
        $datax['date'] = date('d/m/Y');
        $datax['quata_id'] = $data['quata_id'];

        $this->db->insert($this->_table, $datax);
        return $this->db->insert_id();
    }

    public function getlistfees() {
        $this->db->select('fe.*,pr.*')
                ->from('fees fe');
        $this->db->join('programoffer pr', 'pr.programOfferId= fe.programOfferId');
        $this->db->where('fe.is_deleted', 0);
        $this->db->order_by('feeId', 'DESC');
        $result = $this->db->get();
        return $result->result_array();
    }

    public function getlistfeesBydata($data) {
        $this->db->select('fe.*,pr.*')
                ->from('fees fe');
        $this->db->join('programoffer pr', 'pr.programOfferId= fe.programOfferId');
        $this->db->where('pr.programOfferId', $data['programOfferId']);
        $result = $this->db->get();
        return $result->result_array();
    }

    public function getfeesAmount($headId) {
        $result = $this->db->get_where($this->_table, array('headId' => $headId));
        $result_info = $result->row_array();
        return $result_info['amount'];
    }

    // Get all fees list used in paymentadd/searchpaymentlist
    public function searchfeeslist($datas) {

        // print_r($datas['programOfferId']); die();
        $qu = $this->db->get_where($this->_table, array('programOfferId' => $datas['programOfferId'],'quata_id='=>$datas['quata_id']));
        return $qu->result_array();
    }
    
    public function searchfeeslist_byquata($data) {

        //echo '<pre>';print_r($data); die();
        $studentStatus = $this->checkStudentStatus($data);
        //print_r($studentStatus);die();
        $this->db->select('*');
        $this->db->from('fees');
        $this->db->where('programOfferId',$data['programOfferId']);
        $this->db->where('quata_id',$data['quata_id']);
        $this->db->where('studentStatus',3);
        $query=$this->db->get()->result_array();

        if($query)
        {
            return $query;
        }
        else
        {
            $this->db->select('*');
            $this->db->from('fees');
            $this->db->where('programOfferId',$data['programOfferId']);
            $this->db->where('quata_id',$data['quata_id']);
            $this->db->where('studentStatus',$studentStatus);
            $qu=$this->db->get()->result_array();
            return $qu;
        }
    }

    private function checkStudentStatus($data = [])
    {
        $studentStatus = 1;//1
        $studentId = ($data['studentId']) ? trim($data['studentId']): 0;
        $record = $this->db->where('studentId', $studentId)->get('promotedstudent')->row();
        //echo '<pre>';
        //print_r($record);exit;
        if ($record) {
            $studentStatus = 2;//2
        }
        return $studentStatus;
    }
       public function searchfeeslist_byquataa($data) {

       // print_r($datas); die();
        $qu = $this->db->get_where($this->_table, array('programOfferId' => $data['programOfferId'],'quata_id' => $data['quata_id'],'studentStatus' => 2));
        return $qu->result_array();
    }

// Get Total fees Amount by programofferId used in paymentadd/searchpaymentlist
    public function totalamount($datas) {
        $studentStatus = $this->checkStudentStatus($datas);
       // echo '<pre>';print_r($studentStatus);exit;
        $query = $this->db->select_sum('amount');
        $query = $this->db->get_where($this->_table, array('programOfferId' => $datas['programOfferId'],'quata_id' => $datas['quata_id'], 'studentStatus' => $studentStatus));

        $result = $query->result();

        return $result[0]->amount;
    }

    public function editfees($id) {
        $this->db->select('fee.*,pr.*')
                ->from('fees fee');
        $this->db->join('programoffer pr', 'pr.programOfferId= fee.programOfferId');
        $this->db->where('fee.feeId', $id);
        $query=$this->db->get();
        return $query->row_array();
        
    }

    public function updatefees($data, $id) {

        $qu = $this->db->where('feeId', $id);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows();
    }

    public function deletefees($id) {
        $qu = $this->db->where('feeId', $id);
       // $this->db->delete($this->_table);
        $this->db->update($this->_table, ['is_deleted' => 1]);
        return $this->db->affected_rows();
    }

    public function duplicateFeesaddInfo($data) {
//        $this->db->select('campusName');        
        $qu = $this->db->get_where($this->_table, array('programOfferId' => $data['programOfferId'], 'headId' => $data['headId'], 'quata_id' => $data['quata_id'], 'amount' => $data['amount'],'DueDate' => $data['DueDate']));
        $reault = $qu->row_array();
        return $reault;
    }
    
        public function searchfeeslist_byprintlist($datas) {
       
       // print_r($datas); die();
        $qu = $this->db->get_where($this->_payments, array('mr_no' => $datas['mr_no'],'programOfferId' => $datas['programOfferId'],'studentId' =>$datas['studentId']));
        
        return $qu->result_array();
    }
    
        
    public function getsumvalue($datas) {         
    $this->db->select_sum('amount');
    $this->db->select('created_date');
    $this->db->from('payments'); // from Table1
      //  $this->db->where('prg.sessionId',$data['sessionId']);
    $this->db->where('studentId',$datas['studentId']);
     //$this->db->where('paymentDate',$datas['paymentDate']);
    // $this->db->where('time',$datas['time']);
       $query = $this->db->get();
        $result = $query->row_array();
        if (!empty($result)) {
            return $result;
        }
    }
    

}

