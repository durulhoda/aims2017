<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LiabilitiesModleAdmin
 *
 * @author Binita
 */
class LiabilitiesModleAdmin extends CI_Model {
     private $_table = "liabilities";
     private $_table2 = "liabilitieshead";

    public function __construct() {
        parent::__construct();
    }
    
    
    public function addLiabilitiesInfo($data){
//       print_r($data); exit;
        $data['Date']=  date('d/m/Y');
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();       
        
    }    
    
    public function liabilitieslist(){
//        print_r($data);       
        
       $this->db->order_by('Date','DESC');
        $qu = $this->db->get($this->_table);
        return $qu->result_array();
               
    }
    
    public function addHeadsetupInfo($data){
//        print_r($data); exit;
        
        $this->db->insert($this->_table2, $data);
        return $this->db->insert_id();       
        
    }
    public function getLiabilitiesHeadCategoryList(){
//        print_r($data);       
        
        $qu = $this->db->get($this->_table2);
        return $qu->result_array();
               
    }
     public function editliabilitieshead($id) {
        $qu = $this->db->get_where($this->_table2, array('headId' => $id));
        return $qu->row_array();
    }

    public function updateliabilitieshead($data, $id) {

        $qu = $this->db->where('headId', $id);
        $this->db->update($this->_table2, $data);
        return $this->db->affected_rows();
    }

    public function deleteliabilitieshead($id) {
        $qu = $this->db->where('headId', $id);
        $this->db->delete($this->_table2);
        return $this->db->affected_rows();
    }
    public function getLiabilitiesHeadCategoryName($id){
            
        $qu = $this->db->get_where($this->_table2, array('headId' => $id));        
        $result = $qu->row_array();
        return $result['headName'];
    }
     public function duplicateHeadInfo($data) {
//        $this->db->select('campusName');        
        $qu = $this->db->get_where($this->_table2, array('headName' => $data['headName']));
        $reault = $qu->row_array();
        return $reault;
    }
   

}


