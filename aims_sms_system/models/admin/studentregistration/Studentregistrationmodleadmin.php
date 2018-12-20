<?php

/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class StudentregistrationModleAdmin extends CI_Model{
    
   private $_student = "student";
   private $_access = "student_access";
   private $_promotedstudent = "promotedstudent";
      private $_preveous_academicinfo = "preveous_academicinfo";
      private $_tableassigncourse = "studentassigncourse";
     

    public function __construct() {
        parent::__construct();
    }
    
    
       public function addstufferInfo($data, $datacourse,$dataid, $roll_no){

           // $newid = sprintf('%00004d',idcounter());
         
           //   $datae = date('Y');
            // $clss=$cls['programId'];
             $data['studentId'] = $dataid;
            
            $datacourse['studentId'] = $data['studentId'];
            $datacourse['programOfferId'] = $data['programOfferId'];
            
            $nxtvalue['programOfferId']=  $data['programOfferId'];
            $nxtvalue['studentId']= $data['studentId'];
            $nxtvalue['promotionStatus']= 1;
            $nxtvalue['roll_no'] = $roll_no;
           
            $access_value['studentId'] = $data['studentId'];
            $access_value['stu_pass_access'] =md5(123456);
            $access_value['access_power'] =0;
            
            $this->db->insert($this->_promotedstudent, $nxtvalue);
            $data['promotionId'] =$this->db->insert_id();
            
        $this->db->insert($this->_student, $data);
    
        $this->db->insert($this->_access, $access_value);
        
          $this->db->insert($this->_tableassigncourse , $datacourse);
        return $this->db->insert_id();
        
    } 
    
     public function addstufferInfobyId($data,$dataid){
      //echo '<pre>';print_r($data);exit;
           // $newid = sprintf('%00004d',idcounter());
         
           //   $datae = date('Y');
            // $clss=$cls['programId'];
            $roll_no = $this->input->post('roll_no', TRUE);
             $dataa['studentId'] = $dataid;
             $dataa['programOfferId']=  $data['programOfferId']['programOfferId'];
            $dataa['applicationId']=$data['applicationId'];
            
            
            $nxtvalue['programOfferId']=  $data['programOfferId']['programOfferId'];
            $nxtvalue['studentId']= $dataa['studentId'];
            $nxtvalue['promotionStatus']= 1;
            $nxtvalue['roll_no'] = isset($roll_no) ? $roll_no : "";
           
            $access_value['studentId'] = $dataa['studentId'];
            $access_value['stu_pass_access'] =md5(123456);
            $access_value['access_power'] =0;
            
            $this->db->insert($this->_promotedstudent, $nxtvalue);
            $dataa['promotionId'] =$this->db->insert_id();
            
        $this->db->insert($this->_student, $dataa);
    
        $this->db->insert($this->_access, $access_value);
 
        return $this->db->insert_id();
        
    } 
    

    public function insertregistrationconfirm($data,$data_info,$cls) {  
        
      //   $new_stt = $data_info['Ein'];
         $newid = sprintf('%00004d',idcounter());
         
         $datae = date('Y');
             
            $value['studentId'] = $datae . $data_info['Ein'] . $cls['classId'] . $newid;
            $value['applicationId']=$data['applicationId'];
            
     
            
          $prev=$data['applicationId'];
          $tt['studentId']= $value['studentId'];
            $this->db->where('applicationId', $prev);
            $this->db->update($this->_preveous_academicinfo, $tt);
         
           
           
            $access_value['studentId'] = $value['studentId'];
            $access_value['stu_pass_access'] =md5(123456);
            $access_value['access_power'] =0;
            
            $nxtvalue['programOfferId']=  $data['programOfferId'];
            $nxtvalue['studentId']= $value['studentId'];
            $nxtvalue['promotionStatus']= 1;
           
            $this->db->insert($this->_promotedstudent, $nxtvalue);
            $value['promotionId'] =$this->db->insert_id();
            $value['programOfferId']=$data['programOfferId'];
            $this->db->insert($this->_access, $access_value);
            $this->db->insert($this->_student, $value);          
            return $this->db->insert_id();      
       
        }
    
   
   
    public function editregistrationconfirmInfo($applicationId){
        
        $qu = $this->db->get_where($this->_student, array('applicationId' => $applicationId));
 //       $qu="SELECT * FROM student WHERE applicationId IN(".implode(',',$_POST['applicationId']).")";
        return $qu->result_array(); 
    }
 
    public function getRegisteredStudentId($id){
        
            $this->db->select('*');
            $this->db->from($this->_student);
            $this->db->where('applicationId',$id);
            $qu = $this->db->get();
            $result=$qu->result_array();
            if(!empty($result))
            {
                return $result;
            }   
        }
    
    
}


