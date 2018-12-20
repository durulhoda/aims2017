<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of studentregistrationmodleadmin
 *
 * @author Binita
 */
class StudentregistrationModleAdmin extends CI_Model{
    
   private $_student = "student";
   private $_access = "student_access";
   private $_promotedstudent = "promotedstudent";
     

    public function __construct() {
        parent::__construct();
    }

    public function insertregistrationconfirm($data) {  
        
         $new_stt = sprintf('%02d',$data['programId']);
         $newid = sprintf('%003d',idcounter());
         
         $datae = date('Y');
             
            $value['studentId'] = $datae . $new_stt . $data['mediumId'] .$data['shiftId'] . $data['groupId']. $newid;
            $value['applicationId']=$data['applicationId'];
            
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


