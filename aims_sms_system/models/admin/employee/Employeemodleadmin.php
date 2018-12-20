<?php

/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class EmployeeModleAdmin extends CI_Model {
    //put your code here
    
     private $_table = "employee";
     private $_employeestatus = "employeestatus";   
     private $_employee_access = "employee_access";
     private $_emp_attndt="employee_attendance";
      private $_governbody="governmentbody";
      private $_employee_educational_information="employee_educational_information";
    public function __construct() {
        parent::__construct();
    }
    
    
   public function addEmployeeInfo($data,$data_acx,$items){

         $new_stt = sprintf('%02d',$_POST['data']['departmentId']);
         $newid = sprintf('%003d',empidcounter());
         
        $datae = date('y');
        
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

//        print_r($data);  die();
        
        $this->db->insert($this->_table, $data,true);
        $empid=$this->db->insert_id();
        if(!empty($empid))
        {
            if(isset($items['program_type']))
            {
                foreach($items['program_type'] as $index=>$value)
                {
                    if($value && $items['discipline'][$index] && $items['grade'][$index])
                    {
                        $temp_array['emp_id']=$data['employeeId'];
                        $temp_array['program_type']=$items['program_type'][$index];
                        $temp_array['discipline']=$items['discipline'][$index];
                        $temp_array['grade']=$items['grade'][$index];
                        $temp_array['passing_year']=$items['passing_year'][$index];
                        $temp_array['board_or_institution']=$items['board_or_institution'][$index];
                        $this->db->insert($this->_employee_educational_information, $temp_array,true);
                    }
                }
            }

            $this->db->insert($this->_employeestatus, $datax,true);
            $this->db->insert($this->_employee_access, $data_acs,true);
            return  $empid;  
        }        
        else
        {
            return  false;  
        }
    }
    
    
     public function addGovernInfo($data){

        //print_r($data_acs);  die();
        
        $this->db->insert($this->_governbody, $data,true);
       $this->db->insert_id();

             
        
    }
    
    
    public function getEmployeeInfo(){
        $qu = $this->db->get($this->_table);
        return $qu->result_array();
    }


    public function getEmployeeInfo_byType($employeeType){
        $this->db->where('employeeType',$employeeType);
        $this->db->order_by('positionNumber','ASC');
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

     public function getEmployeeName_Image($id){
        $this->db->select('employeeId,firstName,middleName,lastName,photo');
        $qu = $this->db->get_where($this->_table, array('employeeId' => $id));
        if(!empty($qu))
        {
            return $qu->row_array();    
        }
        
        
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

    public function get_employee_education_info($id){

        $this->db->select('*');
        $this->db->from('employee_educational_information');
        $this->db->where('emp_id',$id);
        $result=$this->db->get()->result_array();
        return $result;
    }

    public function editEmployeeEduInfo($id){
        $this->db->select('edu_info.*');
        $this->db->from('employee_educational_information edu_info');
        $this->db->where('edu_info.emp_id', $id);
        $results = $this->db->get()->result_array();
        return $results;
    }
    public function updateEmployeeInfo($data,$id){
        $this->db->where('employeeId', $id);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows(); 
    }

    public function updateEmployeeEduInfo($data,$id){
        $this->db->where('id', $id);
        $this->db->update('employee_educational_information', $data);
        return $this->db->affected_rows();
    }

    public function deleteEmployeeEduInfo($ids)
    {

        $this->db->where_in('id', $ids);
        $this->db->delete('employee_educational_information');
    }

    public function getEmployeeEduInfo($id)
    {
        $this->db->select('*');
        $this->db->from('employee_educational_information');
        $this->db->where('emp_id',$id);
        return $this->db->get()->result_array();
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
      //  print_r($data); die();
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
    
    public function getemployeedatasms($data){
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
    
   public function getEmployeePhoneNumber($id){
        
        $result = $this->db->get_where($this->_table, array('employeeId'=>$id));
        $result_info =  $result->row_array();         
        return $result_info['phone'];          
        
    }
    
      function countTotalEmployee_BYType($employeeType) {
          $this->db->select('count(employee.employeeId) as number');
          $this->db->from('employee');
          $this->db->where('employeeType',$employeeType);
          $number_of_boys=$this->db->get()->row_array();
          return $number_of_boys['number'];
        //return $this->db->where('employeeType',$employeeType)->count_all($this->_table);
      }

    function countMaleEmployee_BYType($employeeType) {
        $this->db->select('count(employee.employeeId) as number');
        $this->db->from('employee');
        $this->db->where('employeeType',$employeeType);
        $this->db->where('gender',1);
        $number_of_boys=$this->db->get()->row_array();
        return $number_of_boys['number'];
    }

    function countTFemaleEmployee_BYType($employeeType) {
        $this->db->select('count(employee.employeeId) as number');
        $this->db->from('employee');
        $this->db->where('employeeType',$employeeType);
        $this->db->where('gender',2);
        $number_of_boys=$this->db->get()->row_array();
        return $number_of_boys['number'];
    }
    
    public function getRegularEmployee(){
        $this->db->select('*');
        $qu = $this->db->get_where($this->_table, array('employeeStatus' => 1));
        return $qu->result_array();  
    
    }
    
    public function getemployee($data){
     
       if(empty($data['employeeStatus']))  
       {    
            $this->db->like('departmentId',$data['departmentId']);
            $this->db->like('designation',$data['designation']);
            $this->db->like('employeeType',$data['employeeType']);
            $this->db->like('employmentStatus',$data['employmentStatus']);            
            $this->db->like('employeeId',$data['employeeId']);
            
            $this->db->order_by('positionNumber','ASC');
            $qu = $this->db->get($this->_table);
            return $qu->result_array();
       }
       else{
            $this->db->select('emp.*,emp_src.*');
            $this->db->from('employee emp');
            $this->db->join('employeestatus emp_src', 'emp_src.employeeId=emp.employeeId');
            $this->db->like('emp_src.employeeStatus',$data['employeeStatus']);
            $this->db->order_by('emp.positionNumber','ASC');
            $qu = $this->db->get();
            return $qu->result_array();
       }
    }
    
      public function getgovern($data){
       //  print_r($data); die();
            $this->db->like('memberTypeId',$data['memberTypeId']);
            $this->db->like('designation',$data['designation']);
          
            $this->db->like('employmentStatus',$data['employmentStatus']);            
           
            
            $this->db->order_by('positionNumber','ASC');
            $qu = $this->db->get($this->_governbody);
            return $qu->result_array();
    }

    public function checkDuplicate_Attndn_date($data){
   
        $result=$this->db->get_where($this->_emp_attndt,array('employeeId' => $data['employeeId'],
                                                                  'attendance_date' => $data['attendance_date'],
                                                                 )
                                                             );
        $chk=$result->row_array();
        if(!empty($chk))
           {    
                return $chk;
           }
    }
    
      public function empcheckattendance($employeeId,$attendance_date){

      $user_check = $this->db->get_where($this->_emp_attndt, array(
          
          'employeeId' =>$employeeId,
          'attendance_date' => $attendance_date
      ));
      
        if ($user_check->num_rows() > 0){
            return TRUE;
        }
        else{
            return FALSE;
        }
  
    }
    
     public function confirmAttendance($data){
        $this->db->insert($this->_emp_attndt, $data);
        return $this->db->insert_id();  
     }

    public function checkattendance($data){
      $qu = $this->db->get_where($this->_emp_attndt, array('employeeId' => $data['employeeId'],'attendance_date' => $data['attendance_date']));
        $reault = $qu->row_array();
        return $reault;
    }

     public function delete_attendance($id){
        
        $this->db->where('emp_att_id', $id);
        $qu = $this->db->delete($this->_emp_attndt);
        return $this->db->affected_rows(); 
    }
    
    public function gettodayattendance($today, $value){
        $qu = $this->db->get_where($this->_emp_attndt, array('employeeId' => $value,'attendance_date' => $today));
        $reault = $qu->row_array();
        return $reault;
        
    }
    
    public function getemployeeattendance($data){

        if(!empty($data)){          
            $this->db->where('employeeId',$data['employeeId']);
            $this->db->where('attendance_date >=', $data['fromDate']);
            $this->db->where('attendance_date <=', $data['toDate']);
            $this->db->order_by('attendance_date','DESC');  
            $qu = $this->db->get($this->_emp_attndt);
            return $qu->result_array();
        }        
    }



     public function getDailyattendance($today){
        $this->db->select('emp.employeeId,emp.firstName,emp.middleName,emp.lastName,emp_att.*');
        $this->db->from('employee_attendance emp_att');
        $this->db->join('employee emp', 'emp.employeeId=emp_att.employeeId');
        $this->db->where('emp_att.attendance_date', $today);
        $qu = $this->db->get();
        $reault = $qu->result_array();
        return $reault;
        
    }
    
//    public function getEmployeeattendanceByDate($fromDate,$toDate){
//            $this->db->select('emp.employeeId,emp.firstName,emp.middleName,emp.lastName,emp_att.*');
//            $this->db->from('employee_attendance emp_att');
//            $this->db->join('employee emp', 'emp.employeeId=emp_att.employeeId');
//            // $this->db->where('emp_att.attendance_date >=', $fromDate);
//            // $this->db->where('emp_att.attendance_date <=', $toDate);
//
//            $this->db->order_by('emp_att.attendance_date','DESC');
//            $records = $this->db->get()->result_array();
//            //echo '<pre>';print_r($records);exit;
//            return $records;
//
//    }


    public function getEmployeeattendanceByDate($fromDate,$toDate,$employee_id=null){

        $this->db->select('emp.employeeId emp_id,emp.firstName,emp.middleName,emp.lastName,"Manual" as attendance_type,emp_att.*');
        $this->db->from('employee_attendance emp_att');
        $this->db->join('employee emp', 'emp.employeeId=emp_att.employeeId','LEFT');
        $this->db->where('emp_att.attendance_date >=', $fromDate);
        $this->db->where('emp_att.attendance_date <=', $toDate);
        if($employee_id)
        {
            $this->db->where('emp_att.employeeId', $employee_id);
        }

        $this->db->order_by('emp_att.attendance_date','DESC');
        $records = $this->db->get()->result_array();
        //echo '<pre>';print_r($records);exit;
        return $records;

    }

    public function getEmployeefingerattendanceByDate($fromDate,$toDate,$employee_id=null){

        $query = $this->db->query("SELECT TIMESTAMPDIFF(SECOND, NOW(), UTC_TIMESTAMP()) as diff")->row_array();
        if(!$query['diff'])
        {
            $query['diff']=0;
        }
        $result = ($query['diff']+21600);
        if($result==0)
        {
            $diff = '+00:00';
        }
        else
        {
            $diff = $result/3600;
            if($diff<0)
            {
                $diff = '-'.$diff.':00';
            }
            else
            {
                $diff = '+'.$diff.':00';
            }

        }



        $fromDate = strtotime(trim($fromDate));
        $toDate = strtotime(trim($toDate))+86399;

        //$this->db->select('eel.emp_id,e.firstName,e.lastName,MIN(eel.date_time) in_time,MAX(eel.date_time) out_time,"Finger Print" as attendance_type,"1" as attendance_status, DATE(FROM_UNIXTIME(eel.date_time)) as attendance_date');
        //$this->db->select('eel.emp_id,e.firstName,e.lastName,MIN(eel.date_time) in_time,MAX(eel.date_time) out_time,"Finger Print" as attendance_type,"1" as attendance_status, DATE(CONVERT_TZ(FROM_UNIXTIME(eel.date_time),"+00:00","+10:00")) as attendance_date');
        $this->db->select('eel.emp_id,e.firstName,e.lastName,MIN(eel.date_time) in_time,MAX(eel.date_time) out_time,(MAX(eel.date_time)-MIN(eel.date_time)) as seconds,"Finger Print" as attendance_type,"1" as attendance_status, DATE(CONVERT_TZ(FROM_UNIXTIME(eel.date_time),"+00:00","'.$diff.'")) as attendance_date');
        $this->db->from('emp_event_log eel');
        $this->db->join('employee e','e.employeeId=eel.emp_id','LEFT');
        $this->db->where('eel.date_time >=', $fromDate);
        $this->db->where('eel.date_time <=', $toDate);
        if($employee_id)
        {
            $this->db->where('eel.emp_id', $employee_id);
        }
        //$this->db->group_by('eel.emp_id,DATE(FROM_UNIXTIME(eel.date_time))');
        //$this->db->group_by('eel.emp_id,DATE(CONVERT_TZ(FROM_UNIXTIME(eel.date_time),"+00:00","+10:00"))');
        $this->db->group_by('eel.emp_id,DATE(CONVERT_TZ(FROM_UNIXTIME(eel.date_time),"+00:00","'.$diff.'"))');
        $this->db->order_by('eel.date_time');

        $records = $this->db->get()->result_array();
        //echo '<pre>';print_r($this->db->last_query());exit;
        //echo '<pre>';print_r($records);exit;
        return $records;

    }
    
}
?>