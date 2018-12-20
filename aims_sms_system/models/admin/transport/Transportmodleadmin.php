<?php
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class TransportModleAdmin extends CI_Model{
    //put your code here
     private $_table = "transportcategory";
     private $_transport = "transport";

    public function __construct() {
        parent::__construct();
    }
    
    
    public function addtransportcategoryInfo($data){
//        print_r($data); exit;
        
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();       
        
    }    
    
    public function getTransportcategoryList(){
         
        $result = $this->db->get($this->_table);
        return $result->result_array();  
    }
    public function addTransportname($data){
//        print_r($data); exit;
        
        $this->db->insert($this->_transport, $data);
        return $this->db->insert_id();       
        
    }    
    public function getTransportNamelist(){
         
        $result = $this->db->get($this->_transport);
        return $result->result_array();  
    }
     public function gettransportcategoryName($id) {
//        $this->db->select('campusName');        
        $qu = $this->db->get_where($this->_table, array('categoryId' => $id));
        $reault = $qu->row_array();
        return $reault['categoryName'];

    }
    
     public function editTransportName($id) {
        $qu = $this->db->get_where($this->_transport, array('transportId' => $id));
        return $qu->row_array();
    }
    
    public function updatetransportInfo($data, $id) {

        $qu = $this->db->where('transportId', $id);
        $this->db->update($this->_transport, $data);
        return $this->db->affected_rows();
    }

    public function deleteTransportName($id) {
        $qu = $this->db->where('transportId', $id);
        $this->db->delete($this->_transport);
        return $this->db->affected_rows();
    }
    
    
     public function edittransportcategory($id) {
        $qu = $this->db->get_where($this->_table, array('categoryId' => $id));
        return $qu->row_array();
    }
    
    public function updatetransportcategory($data, $id) {

        $qu = $this->db->where('categoryId', $id);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows();
    }

    public function deletetransportcategory($id) {
        $qu = $this->db->where('categoryId', $id);
        $this->db->delete($this->_table);
        return $this->db->affected_rows();
    }
    
     public function duplicateTransportcategoryInfo($data) {
//        $this->db->select('campusName');        
        $qu = $this->db->get_where($this->_table, array('categoryName' => $data['categoryName']));
        $reault = $qu->row_array();
        return $reault;
    }
    
   public function duplicateTransportname($data) {
//        $this->db->select('campusName');        
        $qu = $this->db->get_where($this->_transport, array('categoryId' => $data['categoryId'],'transportName' => $data['transportName']));
        $reault = $qu->row_array();
        return $reault;
    }
    
    
    
     

    
    

}


