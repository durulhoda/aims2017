<?php
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class Userquery extends CI_controller { 

    public function __construct(){
        parent::__construct();

         $this->load->model('admin/program/ProgramModleAdmin', 'ProgramModleAdmin');
         $this->load->model('admin/course/CourseModleAdmin', 'CourseModleAdmin');
    }

    public function index(){
        $this->load->view('user/common/header');
        $this->load->view('user/index');
        $this->load->view('user/common/footer');
        $this->load->view('user/jsquery');
    }
    
    public function getClasslist(){
        $id = (int)$this->input->post('id', TRUE);
       
        $datalist = $this->ProgramModleAdmin->getClasslist($id);

        $prglvlList = "";
     
        foreach ($datalist as $dptlist) {            
              $prglvlList .=  "<option value=\"".$dptlist['programId']."\">".$dptlist['programName']."</option>";               
        }        
         echo "<option value=\"\">Select</option>".$prglvlList;
         

    }
    
    public function getprogramLevellist(){
        $id = (int)$this->input->post('id', TRUE);
        $data['sessionId']="sessionId";
        $data['programLevel']="programLevel";        
        $datalist = $this->ProgramModleAdmin->getProgramOfferedValue($data['sessionId'],$data['programLevel'],$id);

        $prglvlList = "";
      //  print_r($datalist); die();
        foreach ($datalist as $dptlist) {            
            foreach (getProgramLevel() as $key => $value) {
                if($key==$dptlist['programLevel']){
                    $prglvlList .=  "<option value=\"".$key."\">".$value."</option>";
                }
            }
        }        
         echo "<option value=\"\">Select</option>".$prglvlList;
         

    }
    
    public function getcourselist(){
        $id = (int)$this->input->post('id', TRUE);
        
        $datalist = $this->CourseModleAdmin->getCourseListBYPrglevelId($id);

        $prglvlList = "";
        
        foreach ($datalist as $dptlist) {      
                $prglvlList .=  "<option value=\"".$dptlist['courseId']."\">".$dptlist['courseName']."</option>";
           
        }        
         echo "<option value=\"\">Select</option>".$prglvlList;
         

    }

    public function getprogramlist(){
        $id = (int)$this->input->post('id', TRUE);
        $data['programLevel']="programLevel";
        $data['programId']="programId";
        $datalist = $this->ProgramModleAdmin->getProgramOfferedValue($data['programLevel'],$data['programId'],$id);

        $prglvlList = "";
        
        foreach ($datalist as $dptlist) {            
            foreach (ProgramInfoArray() as $value) {
                if($value['programId']==$dptlist['programId']){
                    $prglvlList .=  "<option value=\"".$value['programId']."\">".$value['programName']."</option>";
                }
            }
        }        
         echo "<option value=\"\">Select</option>".$prglvlList;
         

    }
    
    public function getsession_programlist(){
        $id = (int)$this->input->post('id', TRUE);
        $data['sessionId']="sessionId";
        $data['programId']="programId";
        $datalist = $this->ProgramModleAdmin->getProgramOfferedValue($data['sessionId'],$data['programId'],$id);

        $prglvlList = "";
        
        foreach ($datalist as $dptlist) {            
            foreach (ProgramInfoArray() as $value) {
                if($value['programId']==$dptlist['programId']){
                    $prglvlList .=  "<option value=\"".$value['programId']."\">".$value['programName']."</option>";
                }
            }
        }        
         echo "<option value=\"\">Select</option>".$prglvlList;
         

    }
    
    public function getoffermediumlist(){
        $id = (int)$this->input->post('id', TRUE);
        $data['programId']="programId";
        $data['mediumId']="mediumId";        
        $datalist = $this->ProgramModleAdmin->getProgramOfferedValue($data['programId'],$data['mediumId'],$id);

        $prglvlList = "";
        
        foreach ($datalist as $dptlist) {            
            foreach (getMediumList() as $value) {
                if($value['mediumId']==$dptlist['mediumId']){
                    $prglvlList .=  "<option value=\"".$value['mediumId']."\">".$value['mediumName']."</option>";
                }
            }
        }        
         echo "<option value=\"\">Select</option>".$prglvlList;
         

    }
    
    public function getoffergrouplist(){
        $id = (int)$this->input->post('id', TRUE);
        $data['mediumId']="mediumId";
        $data['groupId']="groupId";        
        $datalist = $this->ProgramModleAdmin->getProgramOfferedValue($data['mediumId'],$data['groupId'],$id);
        
        $prglvlList = "";
        
        foreach ($datalist as $dptlist) {            
            foreach (getGroupInfoArray() as $value) {
                if($value['groupId']==$dptlist['groupId']){
                    $prglvlList .=  "<option value=\"".$value['groupId']."\">".$value['groupName']."</option>";
                }
            }
        }        
         echo "<option value=\"\">Select</option>".$prglvlList;
         

    }
    
    public function getoffershiftlist(){
        $id = (int)$this->input->post('id', TRUE);
        $data['groupId']="groupId";
        $data['shiftId']="shiftId";        
        $datalist = $this->ProgramModleAdmin->getProgramOfferedValue($data['groupId'],$data['shiftId'],$id);
        
        $prglvlList = "";
        
        foreach ($datalist as $dptlist) {            
            foreach (getShiftList() as $value) {
                if($value['shiftId']==$dptlist['shiftId']){
                    $prglvlList .=  "<option value=\"".$value['shiftId']."\">".$value['shiftName']."</option>";
                }
            }
        }        
         echo "<option value=\"\">Select</option>".$prglvlList;
         

    }
    
    public function getoffersectionlist(){
        $id = (int)$this->input->post('id', TRUE);
        $data['shiftId']="shiftId";
        $data['sectionId']="sectionId";      
        $datalist = $this->ProgramModleAdmin->getProgramOfferedValue($data['shiftId'],$data['sectionId'],$id);
        
        $prglvlList = "";
        
        foreach ($datalist as $dptlist) {            
            foreach (getSectionList() as $value) {
                if($value['sectionId']==$dptlist['sectionId']){
                    $prglvlList .=  "<option value=\"".$value['sectionId']."\">".$value['sectionName']."</option>";
                }
            }
        }        
         echo "<option value=\"\">Select</option>".$prglvlList;
         

    }
    
    public function getofferemployeelist(){
        $id = (int)$this->input->post('id', TRUE);
        $data['programId']="programId";
        $data['employeeId']="employeeId";    
        $datalist = $this->ProgramModleAdmin->getProgramOfferedValue($data['programId'],$data['employeeId'],$id);
        
        $prglvlList = "";
        
        foreach ($datalist as $dptlist) {            
            foreach (getTeacherInfoArray() as $value) {
                if($value['employeeId']==$dptlist['employeeId']){
                    $prglvlList .=  "<option value=\"".$value['employeeId']."\">". $value['firstName'] . " " . $value['lastName']."</option>";
                }
            }
        }        
         echo "<option value=\"\">Select</option>".$prglvlList;
         

    }
    
    

}