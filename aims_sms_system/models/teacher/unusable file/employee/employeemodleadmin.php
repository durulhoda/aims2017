<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of employeeModleAdmin
 *
 * @author Binita
 */
class EmployeeModleAdmin extends CI_Model {
    //put your code here
    
     private $_table = "employee";
     private $_employeestatus = "employeestatus";   
     private $_employee_access = "employee_access";
     private $_emp_attndt="employee_attendance";
    public function __construct() {
        parent::__construct();
    }
    
    
   public function addEmployeeInfo($data,$data_acx){
//        print_r($data); exit;
         $new_stt = sprintf('%02d',$_POST['data']['departmentId']);
         $newid = sprintf('%003d',empidcounter());
         
        $datae = date('Y');
        
        $data['employeeId'] = $datae . $new_stt . $newid;
        $data['phone'] ="88". $data['phone'];
                        
        $data_acs = array(
                    'emp_userName'=>$data['employeeId'],
                    'emp_pass'=>md5($data['employeeId']."aims"),
                    'hr' => $data_acx['hr'],
                    'hrAdmin' => $data_acx['hrAdmin'],
                    'academic' => $data_acx['academic'],
                    'academicAdmin' => $data_acx['academicAdmin'],
                    'finance' => $data_acx['finance'],
                    'financeAdmin' => $data_acx['financeAdmin'],
                    'admissionAndResult' => $data_acx['admissionAndResult'],
                    'admissionAndResultAdmin' => $data_acx['admissionAndResultAdmin']
                );
                
        $datax['employeeId']=$data['employeeId'];
        $datax['employeeStatus']=$data['employeeStatus'];
        $datax['addDate']=date('d/m/Y');
        
        //print_r($data_acs);  die();
        
        $this->db->insert($this->_table, $data,true);
        $empid=$this->db->insert_id();
        if(!empty($empid))
        {
            $this->db->insert($this->_employeestatus, $datax,true);
            $this->db->insert($this->_employee_access, $data_acs,true);
            return  $empid;  
        }        
        else{
            return  false;  
        }
             
        
    }
    
    public function getEmployeeInfo(){
        $qu = $this->db->get($this->_table);
        return $qu->result_array();
    }
    
     public function getEmployeeInfoArray(){
        $this->db->select('employeeId, firstName');
        $this->db->order_by("firstName", "asc");
        $qu = $this->db->get($this->_table);
        return $qu->result_array();
        
    }
    
    function CountEmployeeByPosition($id) // get all student by batchId as array
	{
		$this->db->select('employeeId');	
		$query=$this->db->get_where('employee',array('designation'=>$id));	
		$result = $query->num_rows();
		if(!empty($result)){  return $result; }
		else{ return 0;}
		
	   
	}
    
      public function getEmployeeName($id){
        $this->db->select('firstName,lastName,employeeId,designation');
        $qu = $this->db->get_where($this->_table, array('employeeId' => $id));
        return $qu->result_array();  
    
    }
     
     public function getoneEmployeeName($id){
        $this->db->select('firstName,lastName,employeeId,designation');
        $qu = $this->db->get_where($this->_table, array('employeeId' => $id));
        return $qu->row_array();  
    
    }
     public function editEmployeeInfo($id){
         $this->db->select('emp.*,emp_src.*, emp_acss.*');
            $this->db->from('employee emp');
            $this->db->join('employee_access emp_acss', 'emp_acss.emp_userName=emp.employeeId');
            $this->db->join('employeestatus emp_src', 'emp_src.employeeId=emp.employeeId');
            $this->db->where('emp.employeeId', $id);
           
            $qu = $this->db->get();
            return $qu->row_array();

    }
    public function updateEmployeeInfo($data,$id){
        $this->db->where('employeeId', $id);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows(); 
    }
    
    
    public function deleteEmployee($id){
        
        $this->db->where('employeeId', $id);
        $qu = $this->db->delete($this->_table);
        return $this->db->affected_rows(); 
    }
    
    public function viewemployeeinfo($id){
      
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->where("employeeId", $id);
        $qu = $this->db->get();
        $resultt=$qu->row_array();
        if(!empty($resultt))
        {
            return $resultt;
        }
    }
    
     public function selectemployeenumber($data){ 

        $this->db->select('*');
        $qu = $this->db->get_where($this->_table, array('employeeId'=> $data['employeeId']));
        return $qu->result_array();  
        
//        $this->db->where('employeeId',$data['employeeId']);
//        $query = $this->db->get($this->_table);
//        $result = $query->result();
//
//        return $result[0]->phone;
    }
    public function getemployeenumber($data){
        
        $this->db->like('departmentId',$data['departmentId']);
        $this->db->like('employeeType',$data['employeeType']);
        $this->db->like('firstName',$data['firstName']);
        $this->db->like('lastName',$data['lastName']);
        $this->db->like('nationalIdentity',$data['nationalIdentity']);
        $this->db->like('bloodGroup',$data['bloodGroup']);        
        $this->db->like('email',$data['email']);
        $this->db->like('employmentStatus',$data['employmentStatus']);
        $this->db->like('employeeId',$data['employeeId']);
        
        $qu = $this->db->get($this->_table);
        return $qu->result_array(); 
       
    }
    
   public function getEmployeePhoneNumber($id){
        
        $result = $this->db->get_where($this->_table, array('employeeId'=>$id));
        $result_info =  $result->row_array(); 
        
        return $result_info['phone'];           
        
    }
    
    public function getRegularEmployee(){
        $this->db->select('*');
        $qu = $this->db->get_where($this->_table, array('employeeStatus' => 1));
        return $qu->result_array();  
    
    }
    
    public function getemployee($data){
       //  print_r($data); die();
      
       if(empty($data['employeeStatus']))  
       {    
            $this->db->like('departmentId',$data['departmentId']);
            $this->db->like('designation',$data['designation']);
            $this->db->like('employeeType',$data['employeeType']);
            $this->db->like('employmentStatus',$data['employmentStatus']);            
            $this->db->like('employeeId',$data['employeeId']);
            
            $this->db->order_by('employeeId','DESC');
            $qu = $this->db->get($this->_table);
            return $qu->result_array();
       }
       else{
            $this->db->select('emp.*,emp_src.*');
            $this->db->from('employee emp');
            $this->db->join('employeestatus emp_src', 'emp_src.employeeId=emp.employeeId');
            $this->db->like('emp_src.employeeStatus',$data['employeeStatus']);
            $this->db->order_by('emp.employeeId','DESC');
            $qu = $this->db->get();
            return $qu->result_array();
       }
       
    }
    
     public function confirmAttendance($data){
        $this->db->insert($this->_emp_attndt, $data);
        return $this->db->insert_id();       
        
    }
    public function checkattendance($data){
      $qu = $this->db->get_where($this->_emp_attndt, array('employeeId' => $data['employeeId'],'attendDate' => $data['attendDate']));
        $reault = $qu->row_array();
        return $reault;
    }
    
    public function gettodayattendance($today, $value){
        $qu = $this->db->get_where($this->_emp_attndt, array('employeeId' => $value,'attendDate' => $today));
        $reault = $qu->row_array();
        return $reault;
        
    }
    
       public function getemployeeattendance($data){

        if(!empty($data)){
           
            $this->db->where('employeeId',$data['employeeId']);
            $this->db->where('attendDate >=', $data['fromDate']);
            $this->db->where('attendDate <=', $data['toDate']);
            $this->db->order_by('attendDate','DESC');  
            $qu = $this->db->get($this->_emp_attndt);
            return $qu->result_array();
        }        
    }
   
    
}

