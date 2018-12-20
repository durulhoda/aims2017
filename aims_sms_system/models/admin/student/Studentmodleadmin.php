<?php
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */

class StudentModleAdmin extends CI_Model {

    private $_student = "student";
    private $_preveous_academicinfo = "preveous_academicinfo";
    private $_student_access = "student_access";
//     private $_studentassigncourse = "studentassigncourse";
//     private $_studentattendance = "studentattendance";
//     private $_studentmarks = "studentmarks";
//     private $_studentdiscount = "studentdiscount";
//     private $_studentfine = "studentfine";
    private $_imgrequest = "photovalidate";
    private $_admissionpromotedapplicant = "admissionpromotedapplicant";
    private $_studentinfo = "studentinfo";
    private $_admissionapplicant = "admissionapplicant";
    private $_promotedstudent = "promotedstudent";
    private $_addmissionresult = "addmissionresult";
    private $_fees = "fees";

    public function __construct() {
        parent::__construct();
    }

    public function addStudentInfo($data, $datax) {
        // echo '<pre>';print_r($data);
        // echo '<pre>';print_r($datax);
        // exit;
        if (!empty($data) && !empty($datax)) {
            $data['admissionDate'] = date("Y-m-d");
            $data['phone'] = "88".$data['phone'];
            $dataxx['programOfferId'] = $datax['programOfferId'];
            $dataxx['applicationId'] = $data['applicationId'];
            $dataxx['new_applicant_check'] = 1;
            $this->db->insert($this->_admissionapplicant, $dataxx);
            $this->db->insert($this->_studentinfo, $data);
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    public function previusStudentInfo($datay) {

        $this->db->insert($this->_preveous_academicinfo, $datay);
        return $this->db->insert_id();
    }

    public function getappInfo($applicationid) {

        $this->db->select('*');
        $this->db->where('applicationid', $applicationid);
        $qu = $this->db->get($this->_admissionapplicant);
        return $qu->row_array();
    }

    // Get ProgrammeId form admissionapplicant table
    public function getprogramOfferIdByApplicant($id) {
        $result = $this->db->get_where($this->_admissionapplicant, array('applicationId' => $id));
        $result_info = $result->row_array();
        if (!empty($result_info['programOfferId'])) {
            return $result_info['programOfferId'];
        } else {
            return 0;
        }
    }

    // Get All Application Id form admissionapplicant table by ProgrameOfferId
    public function getApplicationIdByprogramofferId($ids) {
        $this->db->select('ad_app.*,stu_info.*,prg.*');
        $this->db->select('promotedstudent.roll_no');
        $this->db->select('student.promotionId');
        $this->db->from('admissionapplicant ad_app');
        $this->db->join('programoffer prg', 'prg.programOfferId=ad_app.programOfferId');
        $this->db->join('studentinfo stu_info', 'stu_info.applicationId=ad_app.applicationId');
        $this->db->join('student', 'student.applicationId=stu_info.applicationId AND student.programOfferId=prg.programOfferId','LEFT');
        $this->db->join('promotedstudent', 'promotedstudent.promotionId=student.promotionId','LEFT');
        $this->db->where_in('ad_app.programOfferId', $ids);
        $this->db->order_by('stu_info.applicationId', 'ASC');
        $query = $this->db->get();
        $result = $query->result_array();

//        echo '<pre>';
//        print_r($result);exit;
        if (!empty($result)) {
            return $result;
        }
    }

    // Get All Student Basic Information
    public function getApplicantInfoById($id) {
        $this->db->select('*');
        $this->db->where('stuinfo_id', $id);
        $qu = $this->db->get($this->_studentinfo);
        $result = $qu->row_array();
        return $result;
    }

    // Get Single Student Basic Information by applicationId
    public function editapplicantInfo($id) {
        $this->db->select('ad_app.*,stu_info.*,prg.*');
        $this->db->from('admissionapplicant ad_app');
        $this->db->join('programoffer prg', 'prg.programOfferId=ad_app.programOfferId');
        $this->db->join('studentinfo stu_info', 'stu_info.applicationId=ad_app.applicationId');
        $this->db->where('ad_app.applicationId', $id);

        $query = $this->db->get();
        $result = $query->row_array();
        if (!empty($result)) {
            return $result;
        }
    }

    public function getPreviousAcademicInfo($id) {
        $records = $this->db
            ->where('applicationId',$id)
            ->get('preveous_academicinfo')
            ->result();
        return $records;
    }

    public function checkApplicantId($id) {
        $this->db->select('ad_app.applicationId');
        $this->db->from('admissionapplicant ad_app');
        $this->db->join('studentinfo stu_info', 'stu_info.applicationId=ad_app.applicationId');
        $this->db->where('ad_app.applicationId', $id);

        $query = $this->db->get();
        $result = $query->row_array();
        if (!empty($result)) {
            return $result;
        }
    }

    // Get Single Student Basic Information by studentId
    /*     public function editStudentInfo($id){

      $qu = $this->db->get_where($this->_student, array('studentId' => $id));
      return $qu->row_array();
      }

     */

//    function editapplicantInfo($id) {
//        $this->db->select('st.*,ap.applicationId,ap.programOfferId, pr.*')
//                ->from('studentinfo st, admissionapplicant ap, programoffer pr');
//        $query = $this->db->get_where('studentinfo', array('st.applicationId' => $id));
//        $result = $query->result_array();
//        return $result[0];
//    }
    // Get All Student Basic Information by applicationId (used in studentinfosearch page ...alternate viewapplicantInfo($id))
    public function getApplicantInfoByApplicationId($id) {
        $this->db->select('*');
        $this->db->where('applicationId', $id);
        $qu = $this->db->get($this->_studentinfo);
        return $qu->result_array();
    }

    // Update Applicant Basic Information by applicationId
    public function updateapplicantInfo($data, $id) {
        //echo '<pre>'; print_r($data); echo $id; die();
        $this->db->where('applicationId', $id);
        $result = $this->db->update($this->_studentinfo, $data);
        return $result;
        //return $this->db->affected_rows();
    }

    // Delete admissionapplicant info from _studentinfo table by applicationId
    public function deleteapplicant($id) {

        $this->db->where('applicationId', $id);
        $qu = $this->db->delete($this->_studentinfo);
        return $this->db->affected_rows();
    }

    // Delete admissionapplicant info from _admissionapplicant table by applicationId
    public function deleteadmissionapplicant($id) {

        $this->db->where('applicationId', $id);
        $this->db->delete($this->_admissionapplicant);

        $this->db->where('applicationId', $id);
        $this->db->delete($this->_studentinfo);

        $this->db->where('applicationId', $id);
        $this->db->delete($this->_preveous_academicinfo);

        return $this->db->affected_rows();
    }

    // Update ProgramOfferId by applicationId 
    public function updateprogramOfferId($data, $id) {
        $datax = array('programOfferId' => $data);

        $this->db->where('applicationId', $id);
        $result = $this->db->update($this->_admissionapplicant, $datax);

        return $result;
    }

    // get promoted applicant ID from admission promoted applicant
    public function getPromotedapplicantInfobyApplicationId($id) {


        $result = $this->db->get_where($this->_admissionpromotedapplicant, array('applicationId' => $id));
        $result_info = $result->result_array();
        if (!empty($result_info)) {
            return $result_info[0];
        }
    }

    // Get a single Applicant Info array by applicationId
    public function viewapplicantInfo($applicationid) {

        $this->db->select('apd.*,stu_info.*,p.*');
        $this->db->from('studentinfo stu_info');
        $this->db->join('admissionapplicant apd', 'stu_info.applicationId=apd.applicationId');
        $this->db->join('programoffer p', 'p.programOfferId=apd.programOfferId');
        $this->db->where('stu_info.applicationId', $applicationid);

        $query = $this->db->get();
        $result = $query->row_array();
        if (!empty($result)) {
            return $result;
        }
    }

    public function updatePreveousAcademicInfo($applicationId = 0)
    {
        //echo '<pre>';print_r($this->input->post('category', TRUE));
        //print_r($applicationId);
        //echo '<pre>';print_r($_POST);exit;
        $count = count($this->input->post('category', TRUE));
        for ($i = 0; $i < $count; $i++) {
            $data = [
                'roll' => (($this->input->post('roll', TRUE)[$i]) ? $this->input->post('roll', TRUE)[$i] : ''),
                'thana_registration' => (($this->input->post('thana_registration', TRUE)[$i]) ? $this->input->post('thana_registration', TRUE)[$i] : ''),
                'board' => (($this->input->post('board', TRUE)[$i]) ? $this->input->post('board', TRUE)[$i] : 0),
                'gpa' => (($this->input->post('gpa', TRUE)[$i]) ? $this->input->post('gpa', TRUE)[$i] : ''),
                'passing_year' => (($this->input->post('passing_year', TRUE)[$i]) ? $this->input->post('passing_year', TRUE)[$i] : '')
            ];
            if ($data) {
                $this->db
                    ->where('category', $this->input->post('category', TRUE)[$i])
                    ->where('applicationId', $applicationId)
                    ->update('preveous_academicinfo', $data);
            }
        }

        //echo '<pre>';print_r($data);exit;

    }

    public function prevaccinfo($applicationid) {

        $this->db->select('*');
        $this->db->from('preveous_academicinfo');
        $this->db->where('applicationId', $applicationid);

        $query = $this->db->get();
        $result = $query->result_array();
        if (!empty($result)) {
            return $result;
        }
    }

    public function prevaccinfo_stu($id) {

        $this->db->select('*');
        $this->db->from('preveous_academicinfo');
        $this->db->where('studentId', $id);

        $query = $this->db->get();
        $result = $query->result_array();
        if (!empty($result)) {
            return $result;
        }
    }

    // Get a single Applicant short Info array by applicationId
    public function getApplicantShortInfo($applicationid) {

        $this->db->select('apd.*,stu_info.stuinfo_id,stu_info.applicationId,stu_info.admissionDate,stu_info.firstName,stu_info.lastName,stu_info.dateOfBirth,stu_info.gender,stu_info.religion,stu_info.photo,stu_info.fatherName,stu_info.fatherProfession,stu_info.fatherPhone,stu_info.motherName,stu_info.motherProfession,stu_info.motherPhone,stu_info.presentAddress,p.*');
        $this->db->from('studentinfo stu_info');
        $this->db->join('admissionapplicant apd', 'stu_info.applicationId=apd.applicationId');
        $this->db->join('programoffer p', 'p.programOfferId=apd.programOfferId');
        $this->db->where('stu_info.applicationId', $applicationid);

        $query = $this->db->get();
        $result = $query->row_array();
        if (!empty($result)) {
            return $result;
        }
    }

//    // Get Student Info data by applicationId (used in registration)
    public function getstudentsInfoArrayByApplicationId($id) {
        $this->db->select('stu.*,apd.*,stu_info.*,p.*');
        $this->db->from('studentinfo stu_info');
        $this->db->join('student stu', 'stu.applicationId=stu_info.applicationId');
        $this->db->join('admissionapplicant apd', 'stu_info.applicationId=apd.applicationId');
        $this->db->join('programoffer p', 'p.programOfferId=apd.programOfferId');
        $this->db->where('stu_info.applicationId', $id);

        $query = $this->db->get();
        $result = $query->row_array();
        if (!empty($result)) {
            return $result;
        }
    }

    //    // Get Student Info data by applicationId (used in registration-courseassign) 
    public function getstudentInfoByApplicationId($id) {
        $this->db->select('stu.*,stu_info.*,p.*');
        $this->db->from('studentinfo stu_info');
        $this->db->join('student stu', 'stu.applicationId=stu_info.applicationId');
        $this->db->join('programoffer p', 'p.programOfferId=stu.programOfferId');
        $this->db->where('stu_info.applicationId', $id);

        $query = $this->db->get();
        $result = $query->row_array();
        if (!empty($result)) {
            return $result;
        }
    }

    public function getApplicantId($sutentId = 0)
    {
        $applicantId = 0;
        $record = $this->db->where('studentId', $sutentId)->get('student')->row();
        if ($record) {
            $applicantId = $record->applicationId;
        }
        return $applicantId;
    }

    public function getstudentNameInfo($id) {
        $this->db->select('stu.*,stu_info.*,prg.*');
        $this->db->from('student stu');
        $this->db->join('programoffer prg', 'prg.programOfferId=stu.programOfferId');
        $this->db->join('studentinfo stu_info', 'stu_info.applicationId=stu.applicationId');
        $this->db->where('stu.studentId', $id);
        //$query = $this->db->get_where('student', array('stu.studentId' => $id));
        $query = $this->db->get();
        $result = $query->row_array();
        if (!empty($result)) {
            return $result;
        }
    }

    public function getmultistudentNameInfo($ids) {
        $this->db->select('stu.*,stu_info.*,prg.*');
        $this->db->from('student stu');
        $this->db->join('programoffer prg', 'prg.programOfferId=stu.programOfferId');
        $this->db->join('studentinfo stu_info', 'stu_info.applicationId=stu.applicationId');
        $this->db->where_in('stu.studentId', $ids);
        $query = $this->db->get();
        $result = $query->result_array();
        if (!empty($result)) {
            return $result;
        }
    }

    public function getfingerstudentNameInfo($id) {
        $this->db->select('stu.*,stu_info.*');
        $this->db->from('student stu');
        $this->db->join('studentinfo stu_info', 'stu_info.applicationId=stu.applicationId');
        $this->db->where('stu.studentId', $id);
        //$query = $this->db->get_where('student', array('stu.studentId' => $id));
        $query = $this->db->get();
        $result = $query->row_array();
        //print_r($result);
        if (!empty($result)) {
            return $result;
        }
    }

    public function allcomment($username) {
        $this->db->select('*');
        $this->db->from('studentcomment');
        $this->db->where('studentId', $username);
        $this->db->where('approvestatus', 1);
        $query = $this->db->get();
        $result = $query->result_array();
        if (!empty($result)) {
            return $result;
        }
    }

    public function allcommentforteacher() {
        $this->db->select('*');
        $this->db->from('studentcomment');

        $this->db->where('approvestatus', 1);
        $query = $this->db->get();
        $result = $query->result_array();
        if (!empty($result)) {
            return $result;
        }
    }

    public function getstudentNameInfobyattendance($dataa) {
        $this->db->select('stu.*,stu_info.*,att.*');
        $this->db->from('student stu');
        $this->db->join('studentattendance att', 'att.studentId=stu.studentId');
        $this->db->join('studentinfo stu_info', 'stu_info.applicationId=stu.applicationId');
        $this->db->where('stu.studentId', $dataa);
        // $query = $this->db->get_where('student', array('stu.studentId' => $dataa['studentId']));
        $query = $this->db->get();
        $result = $query->row_array();
        if (!empty($result)) {
            return $result;
        }
    }

    public function getstudentBasicInfo($id, $sessionId) {
        $this->db->select('prg.*,stu.studentId,stu.applicationId,stu_info.firstName,stu_info.lastName,stu_info.fatherPhone,stu_info.fatherName,stu_info.motherName,stu_info.motherPhone,stu_info.quata_id,stu_info.photo');
        $this->db->from('student stu');
        if ($sessionId) {
            $this->db->join('programoffer prg', 'prg.programOfferId=stu.programOfferId and prg.sessionId = '.$sessionId.'');
        } else {
            $this->db->join('programoffer prg', 'prg.programOfferId=stu.programOfferId');
        }

        $this->db->join('studentinfo stu_info', 'stu_info.applicationId=stu.applicationId');
        $this->db->where('stu.studentId', $id);
        //$query = $this->db->get_where('student', array('stu.studentId' => $id));
        $query = $this->db->get();
        $result = $query->row_array();
        if (!empty($result)) {
            return $result;
        }
    }

    public function getStudentName_Image($applicationid) {

        $this->db->select('stu_info.firstName,stu_info.lastName,stu_info.photo,');
        $this->db->from('studentinfo stu_info');
        $this->db->join('student stu', 'stu_info.applicationId=stu.applicationId');
        $this->db->where('stu.studentId', $applicationid);

        $query = $this->db->get();
        $result = $query->row_array();
        if (!empty($result)) {
            return $result;
        }
    }

    public function getstudentPersonal_Info($id) {
        $this->db->select('stu.studentId,stu.applicationId,stu_info.firstName,stu_info.lastName,stu_info.fatherPhone,stu_info.fatherName,stu_info.motherName,stu_info.motherPhone,stu_info.quata_id,stu_info.dateOfBirth,stu_info.photo,stu_info.permanentAddress,stu_info.presentAddress');
        $this->db->from('student stu');
        $this->db->join('studentinfo stu_info', 'stu_info.applicationId=stu.applicationId');
        $this->db->where('stu.studentId', $id);
        //$query = $this->db->get_where('student', array('stu.studentId' => $id));
        $query = $this->db->get();
        $result = $query->row_array();
        if (!empty($result)) {
            return $result;
        }
    }

    //....use for View Student Profile where link Student Id....
    public function viewStudentInfo($id) {

        $qu = $this->db->get_where($this->_student, array('studentId' => $id));
        return $qu->row_array();
    }

    public function getstudentNameInfoList($id) {
        $this->db->select('stu.*,stu_info.*,prg.*');
        $this->db->from('student stu,studentinfo stu_info,programoffer prg');
        $this->db->join('programoffer', 'prg.programOfferId=stu.programOfferId');
        $this->db->join('studentinfo', 'stu_info.applicationId=stu.applicationId');
        $this->db->where('stu.studentId', $id);
        $query = $this->db->get();
        $result = $query->result_array();
        if (!empty($result)) {
            return $result;
        }
    }

    public function searchRegisteredStudentIdcard($data) {

        $this->db->select('prm.*,stu.*,stu_info.*,prg.*');
        $this->db->from('promotedstudent prm');
        $this->db->join('programoffer prg', 'prg.programOfferId=prm.programOfferId');
        $this->db->join('student stu', 'stu.studentId=prm.studentId');
        $this->db->join('studentinfo stu_info', 'stu_info.applicationId=stu.applicationId');
        $this->db->where('prm.programOfferId', $data['programOfferId']['programOfferId']);
        $query = $this->db->get();
        $result = $query->result_array();
        if (!empty($result)) {
            return $result;
        }
    }

    public function searchRegisteredStudentId($data) {

        $this->db->select('prm.*,stu.*,stu_info.*,prg.*');
        $this->db->select('institute.*');
        $this->db->from('promotedstudent prm');
        $this->db->join('programoffer prg', 'prg.programOfferId=prm.programOfferId');
        $this->db->join('student stu', 'stu.studentId=prm.studentId');
        $this->db->join('studentinfo stu_info', 'stu_info.applicationId=stu.applicationId');
        $this->db->join('institute', 'institute.instituteId=1');
        $this->db->where('prm.programOfferId', $data['programOfferId']['programOfferId']);
        $query = $this->db->get();
        $result = $query->result_array();
//        echo '<pre>';
//        print_r($result);exit;
        if (!empty($result)) {
            return $result;
        }
    }

    // Find student list or a single student with Enrollment information or studentId..use for pormotion
    public function searchRegisteredStudent($data) {

        $this->db->select('*');

        $this->db->from('student stu');
        $this->db->where('stu.programOfferId', $data['programOfferId']);
        //   $this->db->where('stu.programOfferId', $dataa['programOfferId']); 


        $query = $this->db->get();
        $result = $query->result_array();
        if (!empty($result)) {
            return $result;
        }
    }

    public function getStudentRoll($programOfferId = 0)
    {
        $records = $this->db
            ->select('roll_no, studentId')
            ->where('programOfferId', $programOfferId)
            ->get('promotedstudent')
            ->result();
        $arr = [];
        if ($records){
            foreach ($records as $key => $val) {
                $arr[$val->studentId] = $val->roll_no;
            }
        }
        return $arr;
    }

    public function getStudentRoll_for_position($programOfferId)
    {
        $records = $this->db
            ->select('roll_no, studentId')
            ->where_in('programOfferId', $programOfferId)
            ->get('promotedstudent')
            ->result();
        $arr = [];
        if ($records){
            foreach ($records as $key => $val) {
                $arr[$val->studentId] = $val->roll_no;
            }
        }
        return $arr;
    }

    public function searchlist($data) {

        $this->db->select('stu.*,prg.*,stu_info.*');
        $this->db->from('student stu');
        $this->db->join('programoffer prg', 'prg.programOfferId=stu.programOfferId');
        //     $this->db->join('student stu', 'stu.studentId=prm.studentId');
        $this->db->join('studentinfo stu_info', 'stu_info.applicationId=stu.applicationId');
        if (!empty($data['mediumId'])) {
            $this->db->where('mediumId', $data['mediumId']);
        }
        if (!empty($data['programId'])) {
            $this->db->where('programId', $data['programId']);
        }
        if (!empty($data['groupId'])) {
            $this->db->where('groupId', $data['groupId']);
        }
        if (!empty($data['shiftId'])) {
            $this->db->where('shiftId', $data['shiftId']);
        }
        if (!empty($data['sectionId'])) {
            $this->db->where('sectionId', $data['sectionId']);
        }
        if (!empty($data['sessionId'])) {
            $this->db->where('sessionId', $data['sessionId']);
        }


        $query = $this->db->get();
        $result = $query->result_array();
        if (!empty($result)) {
            return $result;
        }
    }

    public function searchRegisteredStudentbyindv($data) {

        $this->db->select('prm.*,stu.*,stu_info.*');
        $this->db->from('promotedstudent prm');
        //     $this->db->join('programoffer prg', 'prg.programOfferId=prm.programOfferId');
        $this->db->join('student stu', 'stu.studentId=prm.studentId');
        $this->db->join('studentinfo stu_info', 'stu_info.applicationId=stu.applicationId');
        $this->db->like('stu.studentId', $data['studentId']);
        $this->db->like('stu_info.firstName', $data['firstName']);
        $this->db->like('stu_info.phone', $data['phone']);
        $this->db->like('stu_info.fatherPhone', $data['fatherPhone']);
        $query = $this->db->get();
        $result = $query->result_array();
        if (!empty($result)) {
            return $result;
        }
    }

    // Find student list or a single student with Enrollment information or studentId..use for pormotion
    public function searchCurrentStudent($data) {

        $this->db->select('stu.*,stu_info.*,prg.*');
        $this->db->from('student stu');
        $this->db->join('programoffer prg', 'prg.programOfferId=stu.programOfferId');
        $this->db->join('studentinfo stu_info', 'stu_info.applicationId=stu.applicationId');
        $this->db->where('stu.programOfferId', $data['programOfferId']['programOfferId']);
        $query = $this->db->get();
        $result = $query->result_array();
        if (!empty($result)) {
            return $result;
        }
    }

    /* -------------- Test Run for XML/JSON ================ */

    // Find student list or a single student with Enrollment information or studentId..use for pormotion
    public function searchCurrentStudent_testRun() {

        $this->db->select('110431 as ein,grp.groupId,grp.groupName,sec.sectionName,se.session,pr.programName,stu.studentId,stu_info.applicationId,stu_info.firstName,
            stu_info.lastName,stu_info.dateOfBirth,stu_info.gender,stu_info.religion,stu_info.fatherName,stu_info.motherName,prg.programId,prg.sectionId,prg.sessionId');
        $this->db->from('student stu');
        $this->db->join('programoffer prg', 'prg.programOfferId=stu.programOfferId');
        $this->db->join('program pr', 'pr.programId=prg.programId', "left join");
        $this->db->join('session se', 'se.sessionId=prg.sessionId', "left join");
        $this->db->join('section sec', 'sec.sectionId=prg.sectionId', "left join");
        $this->db->join('group grp', 'grp.groupId=prg.groupId', "left join");
        $this->db->join('studentinfo stu_info', 'stu_info.applicationId=stu.applicationId');
        //   $this->db->limit(10); 
        $query = $this->db->get();
        $result = $query->result_array();
        if (!empty($result)) {
            return $result;
        }
    }

    /* ---------------- End Test Run ===================== */

    // Check Student is exist or not in student table  
    public function checkCurrentStudent($data) {
        $this->db->where('studentId', $data['studentId']);
        $this->db->where('programOfferId', $data['programOfferId']);

        $qu = $this->db->get($this->_student);
        $result = $qu->row_array();
        if (!empty($result)) {
            return $result;
        }
    }

    public function checkduplicatePromotion($data, $validprogram) {
        $this->db->where('studentId', $data['studentId']);
        $this->db->where('promotionStatus', $data['promotionStatus']);
        $this->db->where('programOfferId', $validprogram);

        $qu = $this->db->get($this->_promotedstudent);
        $result = $qu->row_array();
        if (!empty($result)) {
            return $result;
        }
    }

    public function updateStudentPromotionconfirm($data, $result) {
        // echo '<pre>';print_r($result);exit;
        $datax['studentId'] = $data['studentId'];
        $datax['programOfferId'] = $result['programOfferId'];
        $datax['promotionStatus'] = $data['promotionStatus'];
        $datax['roll_no'] = $data['roll_no'];
        $this->db->where('promotionId', $result['promotionId']);
        $this->db->update($this->_promotedstudent, $datax);
        return $this->db->affected_rows();
    }

    public function insertStudentPromotionconfirm($data, $result, $validprogram) {

        $nxtvalue['programOfferId'] = $validprogram;
        $nxtvalue['studentId'] = $data['studentId'];
        $nxtvalue['roll_no'] = $data['roll_no'];
        $nxtvalue['promotionStatus'] = 1;

        $this->db->insert($this->_promotedstudent, $nxtvalue);

        $value['promotionId'] = $this->db->insert_id();
        $value['programOfferId'] = $nxtvalue['programOfferId'];

        $this->db->where('studentId', $result['studentId']);
        $this->db->update($this->_student, $value);
        return $this->db->affected_rows();
    }

    public function deletestudent($id, $programOfferId) {

        $this->db->where('studentId', $id);
        $this->db->where('programOfferId', $programOfferId);
        $this->db->delete($this->_promotedstudent);

        $this->db->where('studentId', $id);
        $this->db->where('programOfferId', $programOfferId);
        $this->db->delete($this->_student);
        return $this->db->affected_rows();
    }

    public function getStudentByApplicationId($id) {

        $qu = $this->db->get_where($this->_student, array('applicationId' => $id));
        $result = $qu->row_array();
        if (!empty($result)) {
            return $result;
        }
    }

    // Get Student All Class information from promotion table used in student panel 
    public function getStudent_all_Class($studentId) {

        $this->db->select('pro_stu.*,prog.*');
        $this->db->from('promotedstudent pro_stu');
        $this->db->join('programoffer prog', 'prog.programOfferId=pro_stu.programOfferId');
        $this->db->where('pro_stu.studentId', $studentId);
        $this->db->order_by('pro_stu.programOfferId', 'ASC');

        $query = $this->db->get();
        $result = $query->result_array();
        if (!empty($result)) {
            return $result;
        }
    }

    // Count Student by quata from promotion table not used yet
    public function count_studentBy_class_programOfferId() {

        $this->db->select('pro_stu.programOfferId,count(stu_info.applicationId) as total_stu');
        $this->db->from('programoffer prog');
        $this->db->join('promotedstudent pro_stu', 'prog.programOfferId=pro_stu.programOfferId');
        $this->db->join('student stu', 'stu.studentId=pro_stu.studentId');
        $this->db->join('studentinfo stu_info', 'stu_info.applicationId=stu.applicationId');
        //$this->db->join('quata stu_qua', 'stu_qua.quata_id=stu_info.quata_id');
        //   $this->db->where('prog.sessionId',1);
        $this->db->order_by('prog.sessionId', 'DESC');
        //$this->db->group_by('stu_qua.quata_id'); //result generate based on quata_id
        $this->db->group_by('prog.programOfferId'); //result generate based on programOfferId
        $query = $this->db->get();
        $result = $query->result_array();
        if (!empty($result)) {
            return $result;
        }
    }

    // Count Student by quata from promotion table used in admin>payment_due report 
    public function count_studentBy_class_quata($quata) {

        $this->db->select('pro_stu.programOfferId,prog.programId,prog.groupId,prog.sectionId,prog.sessionId,count(stu_info.applicationId) as total_stu,stu_info.quata_id');
        $this->db->from('programoffer prog');
        $this->db->join('promotedstudent pro_stu', 'prog.programOfferId=pro_stu.programOfferId');
        $this->db->join('student stu', 'stu.studentId=pro_stu.studentId');
        $this->db->join('studentinfo stu_info', 'stu_info.applicationId=stu.applicationId');
        //$this->db->join('quata stu_qua', 'stu_qua.quata_id=stu_info.quata_id');
        $this->db->where('stu_info.quata_id', $quata);

        $this->db->group_by('prog.programOfferId'); //result generate based on programOfferId
        $query = $this->db->get();
        $result = $query->result_array();
//        echo '<pre>';
//        print_r($result);exit;
        if (!empty($result)) {
            return $result;
        }
    }

    public function count_all_fees_Byquata_head($result) {

        $this->db->select('SUM(amount) as tu_fees,programOfferId,headId,quata_id');
        $this->db->where('programOfferId', $result['programOfferId']);
        $this->db->where('quata_id', $result['quata_id']);
        $this->db->where('headId', $result['headId']);
        $qu = $this->db->get($this->_fees);
        $resultx = $qu->row_array();
        return $resultx;
    }

    function get_head_ids()
    {
        $this->db->select('*');
        $this->db->from('paymenthead');
        $result=$this->db->get()->result_array();
        return $result;
    }

    function countTotalStudents() {
        $this->db->select('student.studentId');
        $this->db->from('student');
        $this->db->join('studentinfo','studentinfo.applicationId=student.applicationId','INNER');
        $this->db->join('promotedstudent','promotedstudent.studentId=student.studentId AND promotedstudent.promotionStatus=1','INNER');
        $students=$this->db->get()->result_array();
        $new_array=array();
        foreach($students as $item)
        {
            if(!in_array($item,$new_array))
            {
                $new_array[]=$item;
            }
        }
        return count($new_array);
    }

    function countBoysStudents() {
        $this->db->select('student.studentId');
        $this->db->from('student');
        $this->db->join('studentinfo','studentinfo.applicationId=student.applicationId','INNER');
        $this->db->join('promotedstudent','promotedstudent.studentId=student.studentId AND promotedstudent.promotionStatus=1','INNER');
        $this->db->where('studentinfo.gender',1);
        $boys=$this->db->get()->result_array();

        $new_array=array();
        foreach($boys as $item)
        {
            if(!in_array($item,$new_array))
            {
                $new_array[]=$item;
            }
        }
        return count($new_array);
    }

    function countGirlsStudents() {
        $this->db->select('student.studentId');
        $this->db->from('student');
        $this->db->join('studentinfo','studentinfo.applicationId=student.applicationId','INNER');
        $this->db->join('promotedstudent','promotedstudent.studentId=student.studentId AND promotedstudent.promotionStatus=1','INNER');
        $this->db->where('studentinfo.gender',2);
        $boys=$this->db->get()->result_array();

        $new_array=array();
        foreach($boys as $item)
        {
            if(!in_array($item,$new_array))
            {
                $new_array[]=$item;
            }
        }
        return count($new_array);
    }

    public function getStudentInfo() {
        $this->db->where('status', 1);
        $qu = $this->db->get($this->_student);
        return $qu->result_array();
    }

    public function getRegisteredStudentInfo() {
        //       $this->db->where('status', 1);
        $qu = $this->db->get($this->_student);
        return $qu->result_array();
    }

    // record count for pagination
    function record_count() {
        return $this->db->count_all($this->_student);
    }

//    public function getapplicantName($id){
//        $this->db->select('*');
//        $qu = $this->db->get_where($this->_admissionapplicant, array('applicationId' => $id));
//        return $qu->result_array();     
//    }
//     public function getApplicantionId($id){
//       
//          
//        $result = $this->db->get_where($this->_admissionapplicant, array('appId'=>$id));
//        $result_info =  $result->row_array(); 
//        if(!empty($result_info['applicationId']))
//        {
//        return $result_info['applicationId'];           
//        }
//        else{
//            return 0;  
//        }
//     
//     }
    // not used yet....similar getstudentsName($id)
//    public function getstudents($id){
//        $this->db->select('*');
//        $qu = $this->db->get_where($this->_student, array('studentId' => $id));
// //       $qu = $this->db->get_where($this->_admissionapplicant, array('applicationId' => $id));
//        return $qu->result_array();    
//    }
//   
//    
    //....use for View Student Profile from Student Panel by Logined Student....
    public function viewStudentProfile($username) {

        $qu = $this->db->get_where($this->_student, array('studentId' => $username));
        return $qu->row_array();
    }

    //....use for Change Student Photo from Student Panel by Logined Student....
    public function photorequest($data) {

        $this->db->insert($this->_imgrequest, $data);
        return $this->db->insert_id();
    }

    //....use for View & Confirm PhotoRequest of Student from Admin Panel ....  
    public function getStudentPhotoRequest() {
        $this->db->where('publicationstatus', 0);
        $qu = $this->db->get($this->_imgrequest);
        return $qu->result_array();
    }

    public function photoconfirmation($studentId) {

        $qu = $this->db->get_where($this->_imgrequest, array('studentId' => $studentId));
        return $qu->row_array();
    }

    public function updatePhotoRequest($data, $id) {

        $this->db->where('studentId', $id);
        $this->db->update($this->_imgrequest, $data);
        return $this->db->affected_rows();
    }

    public function deletePhotoRequest($id) {

        $this->db->where('studentId', $id);
        $this->db->delete($this->_imgrequest);
        return $this->db->affected_rows();
    }

    //....use for Get Student Current Password from Student Panel by Logined Student....
    public function checkcurrentpassword($userName) {
        $this->db->select('stu_pass_access');
        $this->db->from('student_access');
        $this->db->where('studentId', $userName);
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
    }

    //....use for Update Student Current Password from Student Panel by Logined Student....
    public function updatepassword($userName, $data) {
        //   $this->db->from('studentlogin');
        $this->db->where('studentId', $userName);
        //   $this->db->update('password', $retypepassword); 
        $this->db->update($this->_student_access, $data);
        return $this->db->affected_rows();
    }

    public function getstudentinfosearch($data) {
//        print_r($data);       

        $this->db->where('campusId', $data['campusId']);
        $this->db->where('mediumId', $data['mediumId']);
        $this->db->where('programId', $data['programId']);
        $this->db->where('groupId', $data['groupId']);
        $this->db->where('sectionId', $data['sectionId']);
        $this->db->where('shiftId', $data['shiftId']);
        $this->db->where('sessionId', $data['sessionId']);

        $qu = $this->db->get($this->_studentinfo);
        return $qu->result_array();
    }

    public function getStudentSearch($data) {
//        print_r($data);       

        $classId = $data['classId'];

        if (strlen($classId) === 1) {
            $this->db->like('campusId', $data['campusId']);
            $this->db->like('mediumId', $data['mediumId']);
            $this->db->like('classId', $data['classId'], 'none');
            $this->db->like('groupId', $data['groupId']);
            $this->db->like('sectionId', $data['sectionId']);
            $this->db->like('shiftId', $data['shiftId']);
            $this->db->like('sessionId', $data['sessionId']);
            $this->db->like('studentId', $data['studentId']);

            $qu = $this->db->get($this->_student);
            return $qu->result_array();
        } elseif (empty($classId)) {
            $this->db->like('campusId', $data['campusId']);
            $this->db->like('mediumId', $data['mediumId']);
            $this->db->like('classId', $data['classId']);
            $this->db->like('groupId', $data['groupId']);
            $this->db->like('sectionId', $data['sectionId']);
            $this->db->like('shiftId', $data['shiftId']);
            $this->db->like('sessionId', $data['sessionId']);
            $this->db->like('studentId', $data['studentId']);

            $qu = $this->db->get($this->_student);
            return $qu->result_array();
        }
    }

    public function getapplicantinfosearch($data) {
        $this->db->select('*');
        $this->db->where('applicationId', $data['applicationId']);
        $qu = $this->db->get($this->_admissionapplicant);

        $s = $qu->result_array();
        //     print_r($s); die();
        return $s;
    }

    public function CheckStudentId($data) {
        $this->db->select('*');
        $this->db->where('studentId', $data['studentId']);
        $qu = $this->db->get($this->_student);

        $s = $qu->result_array();
        //     print_r($s); die();
        return $s;
    }

    public function insertbatch() {

        $studentId = $this->input->post('applicationId', TRUE);
        $bag = $this->input->post('bng', TRUE);
        $eng = $this->input->post('eng', TRUE);
        $math = $this->input->post('math', TRUE);
        $gk = $this->input->post('gk', TRUE);

//        $total = $bag + $eng + $math + $gk;
        $count = count($this->input->post('applicationId', TRUE));

        for ($i = 0; $i < $count; $i++) {

            $data = array(
                'applicationId' => $studentId[$i],
                'Bng' => $bag[$i],
                'Eng' => $eng[$i],
                'Math' => $math[$i],
                'GK' => $gk[$i],
                'total' => $total = $bag[$i] + $eng[$i] + $math[$i] + $gk[$i]
            );


            $this->db->insert($this->_addmissionresult, $data);
        }
//        exit();
        return $this->db->insert_id();
    }

    public function getregisterstudent() {

        $result = $this->db->get($this->_student);
        return $result->result_array();
    }

    //.....use for payment history (admin/paymentadd/searchpaymentlist)
//     public function studentprogram($data){
//       
//       if(!empty($data)){  
//           
//        $this->db->select('*');
//        $result = $this->db->get_where($this->_student, array('studentId'=>$data['studentId']));
//        $result_info =  $result->row_array(); 
//        if(!empty($result_info)){
//        return $result_info;           
//        }
//    
//     }
//     
//     }


    public function studentnumber($data) {
        $this->db->select('telephone');
        $this->db->where('studentId', $data['studentId']);
        $result = $this->db->get($this->_student);
        return $result->result_array();
    }

    public function getStudentPhoneNumber($id) {

        $result = $this->db->get_where($this->_student, array('studentId' => $id));
        $result_info = $result->row_array();

        return $result_info['telephone'];
    }

    public function getStudentFatherPhoneNumber($id) {

        $result = $this->db->get_where($this->_student, array('studentId' => $id));
        $result_info = $result->row_array();

        return $result_info['fatherPhone'];
    }

    public function getStudentMotherPhoneNumber($id) {

        $result = $this->db->get_where($this->_student, array('studentId' => $id));
        $result_info = $result->row_array();

        return $result_info['motherPhone'];
    }

    public function updatestudentphoto($data) {

        $this->db->where('applicationId', $data['applicationId']);
        $this->db->update($this->_studentinfo, $data);
        return $this->db->affected_rows();
    }

}
