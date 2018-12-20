<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of syllabusmodleadmin
 *
 * @author Binita
 */
class Syllabusmodleadmin  extends CI_Model{
    private $_table = "coursesyllabus";

    public function __construct() {
        parent::__construct();
   
    }
    
    public function addSyllabusInfo($data){
//        print_r($data); exit;
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();       
        
    }
    
    public function getSyllabusInfo(){
        $qu = $this->db->get($this->_table);
        return $qu->result_array();
    }
    
        
    public function getlistSyllabus(){
         
        $result = $this->db->get($this->_table);
        return $result->result_array();  
    }

    

    public function getSyllabusInfoArray(){
        
        $this->db->select('syllabusId ,syllabusName');
        $result = $this->db->get($this->_table);
        return $result->result_array();   
    }
    
    //........use for search Syllabus List From Student panel By logged Student.....
     public function searchsyllabuslistByStudent($datas){
        
      if(!empty($datas['programOfferId']) && !empty($datas['courseId'])){
            $programOfferId = $datas['programOfferId'];
            $courseId = $datas['courseId'];

            $this->db->where('programOfferId',$programOfferId);
            $this->db->where('courseId',$courseId);
            $this->db->order_by('syllabusId');
            $this->db->limit(20);
            $qu = $this->db->get($this->_table);
            $resultdata=$qu->result_array();
            if(!empty($resultdata))
            {
                return $resultdata;
            }
        }   
        elseif(empty($datas['courseId']))
        {
            $programOfferId = $datas['programOfferId'];
            
            $this->db->where('programOfferId',$programOfferId);
            $this->db->group_by('courseId');
            $this->db->order_by('syllabusId');
            $this->db->limit(20);
            $qu = $this->db->get($this->_table);
            $resultdata=$qu->result_array();
            if(!empty($resultdata))
            {
                return $resultdata;
            }
        }
  }
    
    public function searchsyllabuslist($data){
//        print_r($data);       
        
       if(!empty($data)){
       
        $this->db->like('programOfferId',$data['programOfferId']);
        $this->db->like('courseId',$data['courseId']);
        
        $this->db->order_by('syllabusId','DESC');
        $qu = $this->db->get($this->_table);
        return $qu->result_array();
        }        
  }
  
  public function editSyllabusInfo($id) {
        $qu = $this->db->get_where($this->_table, array('syllabusId' => $id));
        return $qu->row_array();
    }

    public function updateSyllabusInfo($data, $id) {

        $qu = $this->db->where('syllabusId', $id);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows();
    }

    public function deleteSyllabusInfo($id) {
        $qu = $this->db->where('syllabusId', $id);
        $this->db->delete($this->_table);
        return $this->db->affected_rows();
    }
  
  public function duplicateSyllabusInfo($data) {
//        $this->db->select('campusName');        
        $qu = $this->db->get_where($this->_table, array('programOfferId' => $data['programOfferId'],'courseId' => $data['courseId']));
        $reault = $qu->row_array();
        return $reault;
    }
}

