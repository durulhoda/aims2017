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

    public function getOfferCourseList() {
        $groupId = $this->input->post('groupId', TRUE);
        $mediumId = $this->input->post('mediumId', TRUE);
        $programId = $this->input->post('programId', TRUE);
        $sessionId = $this->input->post('sessionId', TRUE);
        $shiftId = $this->input->post('shiftId', TRUE);
        $sectionId = $this->input->post('sectionId', TRUE);
        $data = [
            'groupId' => isset($groupId) ? $groupId : 0,
            'mediumId' => isset($mediumId) ? $mediumId : 0,
            'programId' => isset($programId) ? $programId : 0,
            'sessionId' => isset($sessionId) ? $sessionId : 0,
            'shiftId' => isset($shiftId) ? $shiftId : 0,
            'sectionId' => isset($sectionId) ? $sectionId : 0
        ];
        $programOfferId = $this->getPorgramOfferId($data);
        $courseList = $this->getCourseListByProgramOfferId($programOfferId);
        $offerCourseList = '<option value="">Select</option>';
        if ($courseList) {
            foreach ($courseList as $key => $val) {
                //$courseList .=  '<option value=".$val->courseId.">".$val->courseName."</option>';
                $offerCourseList .=  '<option value="'.$val->courseId.'">'.$val->courseName.'</option>';
            }
        }
        echo $offerCourseList;
        exit;
    }

    public function get_subjects_name() {

        $data['groupId'] = $this->input->post('groupId', TRUE);
        $data['mediumId'] = $this->input->post('mediumId', TRUE);
        $data['programId'] = $this->input->post('programId', TRUE);
        $data['sessionId'] = $this->input->post('sessionId', TRUE);
        $data['shiftId'] = $this->input->post('shiftId', TRUE);
        $data['sectionId'] = $this->input->post('sectionId', TRUE);
        $programOfferId = $this->getPorgramOfferId($data);
        $semesterId = $this->input->post('semesterId', TRUE);
        $courseList = $this->get_not_inserted_subject_names($semesterId,$programOfferId);

        $offerCourseList = '<option value="">Select</option>';
        if ($courseList) {
            foreach ($courseList as $key => $val) {
                //$courseList .=  '<option value=".$val->courseId.">".$val->courseName."</option>';
                $offerCourseList .=  '<option value="'.$val->courseId.'">'.$val->courseName.'</option>';
            }
        }
        echo $offerCourseList;
        exit;
    }


    private function get_not_inserted_subject_names($semesterId,$programOfferId)
    {
        $records = $this->db
            ->select('c.courseId, c.courseName')
            ->from('courseoffer AS co')
            ->join('course AS c','co.courseId = c.courseId','INNER')
            ->join('studentmarks','studentmarks.courseId = co.courseId AND studentmarks.programOfferId = co.programOfferId AND studentmarks.semesterId = "'.$semesterId.'"','LEFT')
            ->where('co.programOfferId', $programOfferId)
            ->where('studentmarks.courseId',null)
            ->get()
            ->result();
        return $records;
    }


    public function getOfferCourseList_for_teacher()
    {
        $item['groupId'] = $this->input->post('groupId');
        $item['mediumId'] = $this->input->post('mediumId');
        $item['programId'] = $this->input->post('programId');
        $item['sessionId'] = $this->input->post('sessionId');
        $item['shiftId'] = $this->input->post('shiftId');
        $item['sectionId'] = $this->input->post('sectionId');

        $programOfferId = $this->getPorgramOfferId_for_teacher($item);
        $courseList = $this->getCourseListByProgramOfferId_for_teacher($programOfferId);
        $offerCourseList = '<option value="">Select</option>';
        if ($courseList) {
            foreach ($courseList as $key => $val) {
                //$courseList .=  '<option value=".$val->courseId.">".$val->courseName."</option>';
                $offerCourseList .=  '<option value="'.$val->courseId.'">'.$val->courseName.'</option>';
            }
        }
        echo $offerCourseList;
        exit;
    }


    private function getCourseListByProgramOfferId($programOfferId = 0)
    {
        $records = $this->db
                    ->select('c.courseId, c.courseName')
                    ->from('courseoffer AS co')
                    ->join('course AS c','co.courseId = c.courseId')
                    ->where('co.programOfferId', $programOfferId)
                    ->get()
                    ->result();
        return $records;
    }

    private function getCourseListByProgramOfferId_for_teacher($programOfferId = 0)
    {
        $employeeId = $this->session->userdata('emp_userName');
        $records = $this->db
                    ->select('c.courseId, c.courseName')
                    ->from('courseoffer AS co')
                    ->join('course AS c','co.courseId = c.courseId')
                    ->where('co.programOfferId', $programOfferId)
                    ->where('co.employeeId', $employeeId)
                    ->get()
                    ->result();
        return $records;
    }

    private function getPorgramOfferId($data = [])
    {
        $where = [];
        if ($data) {
            $where = $data;
        }
        $programOfferId = 0;
        $record = $this->db
                    ->select('programOfferId')
                    ->where($where)
                    ->get('programoffer')
                    ->row();
       // echo '<pre>';print_r($where);exit;
        if ($record) {
            $programOfferId = $record->programOfferId;
        }
        return $programOfferId;
    }

    private function getPorgramOfferId_for_teacher($data)
    {
        $this->db->select('*');
        $this->db->from('programoffer');
        $this->db->where('groupId',$data['groupId']);
        $this->db->where('mediumId',$data['mediumId']);
        $this->db->where('programId',$data['programId']);
        $this->db->where('sessionId',$data['sessionId']);
        $this->db->where('shiftId',$data['shiftId']);
        $this->db->where('sectionId',$data['sectionId']);
        $result=$this->db->get()->row();
        $programOfferId = 0;
        if ($result) {
            $programOfferId = $result->programOfferId;
        }
        return $programOfferId;
    }

    public function getprogramlist(){
        $id = (int)$this->input->post('id', TRUE);
        $data['programLevel']="programLevel";
        $data['programId']="programId";
        $datalist = $this->ProgramModleAdmin->getProgramOfferedValuebyclass($data['programLevel'],$data['programId'],$id);

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
        //echo $id;die();
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

    public function getProgramOfferList(){
        $id = (int)$this->input->post('id', TRUE);
        $datalist = $this->getProgramOfferInfo($id);

        $row .= '<option value="">...Select a program offer name...</option>';
        if ($datalist) {
            
            foreach ($datalist as $key => $val) {
                $poName = $val->programName."->".$val->mediumName."->".$val->groupName."->".$val->shiftName."->".$val->sectionName;
                $row .= '<option value="'.$val->id.'">'.$poName.'</option>';
            }
        }
        echo $row;
        exit;
         

    }

    private function getProgramOfferInfo($id = 0)
    {
        $records = $this->db
                ->select('
                    po.programOfferId AS id,
                    p.programName,
                    m.mediumName,
                    g.groupName,
                    s.shiftName,
                    se.sectionName
                    ')
                ->from('programoffer as po')
                ->join('program AS p', 'po.programId = p.programId')
                ->join('medium AS m', 'po.mediumId = m.mediumId')
                ->join('group AS g', 'po.groupId = g.groupId')
                ->join('shift AS s', 'po.shiftId = s.shiftId')
                ->join('section AS se', 'po.sectionId = se.sectionId')
                ->where('po.sessionId', $id)
                ->get()
                ->result();
               // print_r($records);
        return $records;
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
         //echo "<option value=\"\">Select</option>".$prglvlList;
         echo $prglvlList;       
    }
    
    public function getoffergrouplist(){
        $id = (int)$this->input->post('id', TRUE);
       // log_message('error','eibar dekha '.print_r( $id,true));
        $data['programId']="programId";
        $data['groupId']="groupId";        
        $datalist = $this->ProgramModleAdmin->getProgramOfferedValue($data['programId'],$data['groupId'],$id);
        $prglvlList = "<option value=''>Select</option>";
        
        foreach ($datalist as $dptlist) {            
            foreach (getGroupInfoArray() as $value) {
                if($value['groupId']==$dptlist['groupId']){
                    $prglvlList .=  "<option value=\"".$value['groupId']."\">".$value['groupName']."</option>";
                }
            }
        } 
         echo $prglvlList;
         

    }
    
    public function getoffershiftlist(){
        $id = (int)$this->input->post('id', TRUE);
        log_message('error','grp id '.print_r($id,true));
        $data['programId']="programId";
        $data['shiftId']="shiftId";        
        $datalist = $this->ProgramModleAdmin->getProgramOfferedValueshift($data['programId'],$data['shiftId'],$id);
        
        $prglvlList = "";
        
        foreach ($datalist as $dptlist) {            
            foreach (getShiftList() as $value) {
                if($value['shiftId']==$dptlist['shiftId']){
                    $prglvlList .=  "<option value=\"".$value['shiftId']."\">".$value['shiftName']."</option>";
                }
            }
        }        
         echo $prglvlList;
         

    }
    
    public function getoffersectionlist(){
        $id = (int)$this->input->post('id', TRUE);
        $data['programId']="programId";
        $data['sectionId']="sectionId";      
        $datalist = $this->ProgramModleAdmin->getProgramOfferedValuesection($data['programId'],$data['sectionId'],$id);
        $prglvlList = "<option value=''>Select</option>";
        
        foreach ($datalist as $dptlist) {            
            foreach (getSectionList() as $value) {
                if($value['sectionId']==$dptlist['sectionId']){
                    $prglvlList .=  "<option value=\"".$value['sectionId']."\">".$value['sectionName']."</option>";
                }
            }
        }        
         echo $prglvlList;
         

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
    
    public function getofferSubjectlist(){
        $classid = (int)$this->input->post('id', TRUE);          
        $session = $this->input->post('session', TRUE);
        $datalist = $this->CourseModleAdmin->getSubjectValue($classid);
        
        $prglvlList = "";
        
        foreach ($datalist as $dptlist) {      
                $prglvlList .=  "<option value=\"".$dptlist['courseId']."\">".$dptlist['courseName']."</option>";
           
        }        
         echo "<option value=\"\">Select</option>".$prglvlList;         

    }

    
       public function getDistlist() {
        $id = (int) $this->input->post('id', TRUE);
        
     //   $data['sessionId'] = "sessionId";
      //  $data['programLevel'] = "programLevel";
        $datalist = $this->ProgramModleAdmin->test($id);

        $prglvlList = "";
        //  print_r($datalist); die();
      foreach ($datalist as $dptlist) {      
                $prglvlList .=  "<option value=\"".$dptlist['Upozila']."\">".$dptlist['Upozila']."</option>";
           
        }
        echo "<option value=\"\">Select</option>" . $prglvlList;
    }
    
     public function getDesignation() {
        $id = (int) $this->input->post('id', TRUE);
        
     //   $data['sessionId'] = "sessionId";
      //  $data['programLevel'] = "programLevel";
        $datalist = $this->ProgramModleAdmin->getdesignation($id);

        $prglvlList = "";
        //  print_r($datalist); die();
      foreach ($datalist as $dptlist) {      
                $prglvlList .=  "<option value=\"".$dptlist['designation']."\">".element($dptlist['designation'],getdesignation(),NULL)."</option>";
           
        }
        echo "<option value=\"\">Select</option>" . $prglvlList;
    }
    
 //Teacher Panell   
        
    
        public function getsession_programlistbyteacher(){
         $userName=$this->session->userdata('emp_userName');
         //echo $userName;die();
        $id = (int)$this->input->post('id', TRUE);
          //echo $id;die();
        $data['sessionId']="sessionId";
        $data['programId']="programId";
        $datalist = $this->ProgramModleAdmin->getProgramOfferedValuebyteacher($data['sessionId'],$data['programId'],$id,$userName);
        //echo '<pre>';
                //print_r($datalist);die();
        $prglvlList = "";
        if ($datalist) :
        foreach ($datalist as $dptlist) {            
            foreach (ProgramInfoArray() as $value) {
                if($value['programId']==$dptlist['programId']){
                    $prglvlList .=  "<option value=\"".$value['programId']."\">".$value['programName']."</option>";
                }
            }
        }     
        endif;   
         echo "<option value=\"\">Select</option>".$prglvlList;
         

    }
    
    
        public function getoffermediumlistbyteacher(){
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
    
    
    public function getofferSubjectlistbyteacher(){
        $classid = (int)$this->input->post('id', TRUE);

       $userName=$this->session->userdata('emp_userName');

//        echo $classid;
//        echo '<br>';
//        echo $userName; die();

        $datalist = $this->CourseModleAdmin->getSubjectValuebyteacher($classid, $userName);
    //    echo '<pre>';        print_r($datalist); die();
        $prglvlList = "";
        
        foreach ($datalist as $dptlist) {      
                $prglvlList .=  "<option value=\"".$dptlist['courseId']."\">".$dptlist['courseName']."</option>";
           
        }        
         echo "<option value=\"\">Select</option>".$prglvlList;         

    }
    
    
    
 /*
    public function getUpozilalist() {
        $id = (int) $this->input->post('id', TRUE);
        $data['programLevel'] = "programLevel";
        $data['programId'] = "programId";
        $datalist = $this->ProgramModleAdmin->getProgramOfferedValue($data['programLevel'], $data['programId'], $id);

        $prglvlList = "";

        foreach ($datalist as $dptlist) {
            foreach (ProgramInfoArray() as $value) {
                if ($value['programId'] == $dptlist['programId']) {
                    $prglvlList .= "<option value=\"" . $value['programId'] . "\">" . $value['programName'] . "</option>";
                }
            }
        }
        echo "<option value=\"\">Select</option>" . $prglvlList;
    }
    
    
        public function getUpozila(){
        $id = (int)$this->input->post('id', TRUE);
        
        $datalist = $this->CourseModleAdmin->getCourseListBYPrglevelId($id);

        $prglvlList = "";
        
        foreach ($datalist as $dptlist) {      
                $prglvlList .=  "<option value=\"".$dptlist['courseId']."\">".$dptlist['courseName']."</option>";
           
        }        
         echo "<option value=\"\">Select</option>".$prglvlList;
         

    }*/

    public function getsubjectNames(){
        $session = $this->input->post('session');
        $section = 1;
        $shift = 1;
        $class_student = $this->input->post('class_student');
        //ekhan theke value ashtesena......
        $medium = 1;
        $group = $this->input->post('group');
        $data['programOfferId'] = $this->ProgramModleAdmin->getProgramOfferId_another($session,$section,$shift,$class_student,$medium,$group);
       

        $result = $this->CourseModleAdmin->getSubjectNames($data);
        //log_message('error','yoooooo '.print_r($result));
       
    }

}