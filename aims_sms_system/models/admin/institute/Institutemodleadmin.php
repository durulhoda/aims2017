<?php
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class InstituteModleAdmin extends CI_Model{

private $_table = "institute";

    public function __construct() {
        parent::__construct();
    }
    
    
    public function addInstituteInfo($data){
//        print_r($data); exit;
        
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();       
        
    } 
 
   public function getInstituteInfo(){
	$this->db->select('institute.*');
	$this->db->select('districts.name_en district_name');
	$this->db->from('institute');
	$this->db->join('districts','districts.id=institute.district','INNER');
        $this->db->order_by('instituteId','DESC');
        $this->db->limit(1);
        $result = $this->db->get()->row_array();
        return $result;




   }

   public function getInstituteDetailedInfo(){
        $this->db->select('institute.*,districts.name_en as disname');
        $this->db->from('institute');
        $this->db->join('districts','institute.district = districts.id');
        $this->db->order_by('instituteId','ASC');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
   }
   
    public function getInstituteName(){
        $this->db->order_by('instituteId','DESC');
        $this->db->limit(1);
	$qu = $this->db->get_where($this->_table);
        $reault = $qu->row_array();
        if(!empty($reault['instituteName']))
        {
         return $reault['instituteName'];    
        }
        else{
            return "AIMS";  
        }
       
	
	}
   public function getInstituteLogo(){
       $this->db->order_by('instituteId','DESC');
        $this->db->limit(1);
	$qu = $this->db->get_where($this->_table);
        $reault = $qu->row_array();
        if(!empty($reault['logo']))
        {
         return $reault['logo'];    
        }
      
    }     
    
   public function updateInformation($data) {

        $this->db->where('instituteId', $data['instituteId']);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows();
    }     
   
}