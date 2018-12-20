<?php

/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class HomeworkModleAdmin extends CI_Model{
   
    private $_homework = "homework";
    private $_employee = "employee";
    
    public function __construct() {
        parent::__construct();
    }
    
     
    public function addhomeworkInfo($data){
       
        $data['date']=date('d-m-Y');
        $this->db->insert($this->_homework, $data);
        return $this->db->insert_id();       
        
    }    
    //.......use for View homework list By Teacher usernameID from Teacher Panel
     public function homeworklist($username) {        
       $this->db->select('*');
        $this->db->where('employeeId',$username);
         $this->db->order_by('date','DESC');
        $qu = $this->db->get($this->_homework);
        return $qu->result_array();

    }
    
   
    //....use for Search Student Homework Information from Student Panel by Logged Student,..........
    public function searchhomework($datas){
       
       if(!empty($datas['programOfferId']) && !empty($datas['courseId'])){
            $programOfferId = $datas['programOfferId'];
            $courseId = $datas['courseId'];

            $this->db->where('programOfferId',$programOfferId);
            $this->db->where('courseId',$courseId);
            $this->db->order_by('hwId');
            $this->db->limit(20);
            $qu = $this->db->get($this->_homework);
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
            $this->db->order_by('hwId');
            $this->db->limit(20);
            $qu = $this->db->get($this->_homework);
            $resultdata=$qu->result_array();
            if(!empty($resultdata))
            {
                return $resultdata;
            }
        }
        
  }
    public function getCourseofferInfo(){
//        $this->db->order_by("id", "asc");
        $qu = $this->db->get($this->_homework);
        return $qu->result_array();
    }
     
   
    public function searchhomeworklist($data){
//        print_r($data);       
        
       if(!empty($data)){
       
        $this->db->like('programOfferId',$data['programOfferId']);
        $this->db->like('employeeId',$data['employeeId']);
        $this->db->like('courseId',$data['courseId']);
        $this->db->order_by('date','desc');
        $this->db->limit(20);
        $qu = $this->db->get($this->_homework);
        return $qu->result_array();
        }        
  }
  
      public function searchhomeworkliststu($data){
//        print_r($data);       
        
       if(!empty($data)){
       
        $this->db->like('programOfferId',$data['programOfferId']);
        $this->db->like('courseId',$data['courseId']);
        $this->db->order_by('date','desc');
        $this->db->limit(20);
        $qu = $this->db->get($this->_homework);
        return $qu->result_array();
        }        
  }
  
  
   public function edithomeworkInfo($id) {
        $qu = $this->db->get_where($this->_homework, array('hwId' => $id));
        return $qu->row_array();
    }
    
   public function update($data, $id) {

        $qu = $this->db->where('hwId', $id);
        $this->db->update($this->_homework, $data);
        return $this->db->affected_rows();
    }
    
    public function deleteinformation($id){
        
        $qu = $this->db->where('hwId', $id);
        $this->db->delete($this->_homework);
        return $this->db->affected_rows();
        
    }

    public function userhomeworklist($username) {        
       $this->db->select('*');
        $this->db->where('employeeId',$username);
         $this->db->order_by('date','DESC');
        $qu = $this->db->get($this->_homework);
        return $qu->result_array();

    }

        public function getteacher() {        
           $this->db->select('emp.*,hinfo.*');
            $this->db->from('homework hinfo');
            $this->db->join('employee emp', 'hinfo.employeeId=emp.employeeId');
            $this->db->where('hinfo.programOfferId');
               $query = $this->db->get();
            $result = $query->result_array();
            if(!empty($result)){
                return $result;   
           }

    }

   public function getteacherinfo(){
    $this->db->select('*');
        $this->db->order_by('employeeId','DESC');
        $result = $this->db->get($this->_employee);
        return $result->row_array();   
   }
    
}

