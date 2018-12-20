<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of paymentsmodleadmin
 *
 * @author Binita
 */
class FeesModleAdmin extends CI_Model {

    //put your code here

    private $_table = "fees";

    public function __construct() {
        parent::__construct();
    }

    public function getPaymentHeadName() {

        $this->db->select('headId ,headName');
        $result = $this->db->get($this->_table);
        return $result->result_array();
    }

    public function addfees($data) {
//        print_r($data); exit;
        $datax['headId'] = $data['headId'];
        $datax['programOfferId'] = $data['programOfferId'];
        $datax['amount'] = $data['amount'];
        $datax['date'] = date('d/m/Y');

        $this->db->insert($this->_table, $datax);
        return $this->db->insert_id();
    }

    public function getlistfees() {
        $this->db->select('fe.*,pr.*')
                ->from('fees fe');
        $this->db->join('programoffer pr', 'pr.programOfferId= fe.programOfferId');
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
        $qu = $this->db->get_where($this->_table, array('programOfferId' => $datas['programOfferId']));
        return $qu->result_array();
    }

// Get Total fees Amount by programofferId used in paymentadd/searchpaymentlist
    public function totalamount($datas) {

        $query = $this->db->select_sum('amount');
        $query = $this->db->get_where($this->_table, array('programOfferId' => $datas['programOfferId']));

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
        $this->db->delete($this->_table);
        return $this->db->affected_rows();
    }

    public function duplicateFeesaddInfo($data) {
//        $this->db->select('campusName');        
        $qu = $this->db->get_where($this->_table, array('programOfferId' => $data['programOfferId'], 'headId' => $data['headId'], 'amount' => $data['amount']));
        $reault = $qu->row_array();
        return $reault;
    }

}

