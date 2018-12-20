<?php
/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */
class ProgramModleAdmin extends CI_Model {

    private $_table = "program";
    private $_offertable = "programoffer";
    private $_idcounter = "idcounter";

    public function __construct() {
        parent::__construct();
    }

    public function addProgramInfo($data) {
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();
    }

    public function getlistProgram() {
        //   $this->db->order_by('programLevel,programId','ASC'); 
        $this->db->order_by('programId', 'ASC');
        $result = $this->db->get($this->_table);
        return $result->result_array();
    }

    public function getProgramname($id) {
        $result = $this->db->get_where($this->_table, array('programId' => $id));
        $result_info = $result->row_array();
        // print_r($id);
        if (!empty($result_info['programName'])) {
            return $result_info['programName'];
        }
    }

    public function getStudentInfo($programOfferId = 0)
    {
        $arr = [];
        $records = $this->db
            ->select('s.studentId,sinfo.firstName')
            ->from('student AS s')
            ->join('studentinfo AS sinfo', 's.applicationId = sinfo.applicationId')
            ->where('s.programOfferId', $programOfferId)
            ->get()
            ->result();
        if ($records) {
            foreach ($records as $key => $val) {
                $arr[$val->studentId] = $val->firstName;
            }
        }
        return $arr;
    }

    public function getStudentInfo_for_position($programOfferId)
    {
        $arr = [];
        $records = $this->db
            ->select('s.studentId,sinfo.firstName')
            ->from('student AS s')
            ->join('studentinfo AS sinfo', 's.applicationId = sinfo.applicationId')
            ->where_in('s.programOfferId', $programOfferId)
            ->get()
            ->result();
        if ($records) {
            foreach ($records as $key => $val) {
                $arr[$val->studentId] = $val->firstName;
            }
        }
        return $arr;
    }

    public function getProgramInfoArray() {

        $this->db->select('programId, programName');
        $this->db->order_by("programId", "asc");
        $result = $this->db->get($this->_table);
        return $result->result_array();
    }

    public function editProgramInfo($id) {
        $qu = $this->db->get_where($this->_table, array('programId' => $id));
        return $qu->row_array();
    }

    public function updateProgramInfo($data, $id) {

        $qu = $this->db->where('programId', $id);
        $this->db->update($this->_table, $data);
        return $this->db->affected_rows();
    }

    public function deleteProgramInfo($id) {
        $qu = $this->db->where('programId', $id);
        $this->db->delete($this->_table);
        return $this->db->affected_rows();
    }

    public function checkProgramInfo($id) {
        $this->db->select('cls.*,prog_offer.*');

        $this->db->from('program cls');
        $this->db->join('programoffer prog_offer', 'cls.programId = prog_offer.programId');

        $this->db->where('prog_offer.programId', $id);

        $query = $this->db->get();
        $result = $query->result_array();
        if (!empty($result)) {
            return $result;
        }
    }

    // insert programoffer information
    public function addProgramOffer($data) {

        $this->db->insert($this->_offertable, $data);
        return $this->db->insert_id();
    }

    // get program offer information by data value from programoffer tbl..
    public function getOfferedProgramList($data) {
        $this->db->select('prg_offer.*,prg.*,ses.*,mdm.*,grp.*,sht.*,sct.*,emp.employeeId,emp.firstName,emp.middleName,emp.lastName,emp.phone,emp.email')
            ->from('programoffer prg_offer');
        $this->db->join('program prg', 'prg.programId= prg_offer.programId');
        $this->db->join('session ses', 'ses.sessionId= prg_offer.sessionId');
        $this->db->join('medium mdm', 'mdm.mediumId= prg_offer.mediumId');
        $this->db->join('group grp', 'grp.groupId= prg_offer.groupId');
        $this->db->join('shift sht', 'sht.shiftId= prg_offer.shiftId');
        $this->db->join('section sct', 'sct.sectionId= prg_offer.sectionId');
        $this->db->join('employee emp', 'emp.employeeId= prg_offer.employeeId');

        $this->db->where('prg_offer.programId', $data['programId']);
        $this->db->where('prg_offer.sessionId', $data['sessionId']);
        $this->db->where('prg_offer.mediumId', $data['mediumId']);
        $this->db->where('prg_offer.groupId', $data['groupId']);
        $this->db->where('prg_offer.shiftId', $data['shiftId']);
        $this->db->where('prg_offer.sectionId', $data['sectionId']);
//         $this->db->where('prg_offer.employeeId',$data['employeeId']);
//         $this->db->where('prg_offer.classStatus', $data['classStatus']);
        $this->db->order_by("prg_offer.sessionId", "DESC");
        //      $this->db->group_by("prg_offer.programId");
        $query = $this->db->get();

        $result = $query->row_array();
        if (!empty($result)) {
            return $result;
        }
    }

    public function getProgramOfferIdStudent($session,$class_level,$class,$medium,$groupid,$shiftid,$sectionid){
        $result = $this->db->get_where($this->_offertable, array
        ('mediumId' => $medium,
            'programId' => $class,
            'groupId' => $groupid,
            'sectionId' => $sectionid,
            'shiftId' => $shiftid,
            'sessionId' => $session,
            'classStatus' => 1));
        $result_info = $result->row_array();
        if (!empty($result_info)) {
            return $result_info['programOfferId'];
        }
    }

    public function getOfferedProgramListt($data_programOfferId) {
        //echo "<pre>";
        //print_r($data_programOfferId);die();
        $this->db->select('*');
        $this->db->from('courseoffer');
        $this->db->where('programOfferId',$data_programOfferId);
        $query = $this->db->get();
        $result = $query->result_array();
        if (!empty($result)) {
            return $result;
        }
    }



    public function getOfferedProgramList_bySession($data) {
        $this->db->select('prg_offer.*,prg.*,ses.*,mdm.*,grp.*,sht.*,sct.*,emp.employeeId,emp.firstName,emp.middleName,emp.lastName,emp.phone,emp.email')
            ->from('programoffer prg_offer');
        $this->db->join('program prg', 'prg.programId= prg_offer.programId', 'left outer');
        $this->db->join('session ses', 'ses.sessionId= prg_offer.sessionId', 'left outer');
        $this->db->join('medium mdm', 'mdm.mediumId= prg_offer.mediumId', 'left outer');
        $this->db->join('group grp', 'grp.groupId= prg_offer.groupId', 'left outer');
        $this->db->join('shift sht', 'sht.shiftId= prg_offer.shiftId', 'left outer');
        $this->db->join('section sct', 'sct.sectionId= prg_offer.sectionId', 'left outer');
        $this->db->join('employee emp', 'emp.employeeId= prg_offer.employeeId', 'left outer');

        $this->db->where('prg_offer.sessionId', $data['sessionId']);
        $this->db->order_by("prg_offer.sessionId", "DESC");
        //      $this->db->group_by("prg_offer.programId");
        $query = $this->db->get();

        $result = $query->result_array();
        if (!empty($result)) {
            return $result;
        }
    }

    public function getOfferedProgramList_bylv($data) {
        $this->db->select('prg_offer.*,prg.*,ses.*,mdm.*,grp.*,sht.*,sct.*,emp.employeeId,emp.firstName,emp.middleName,emp.lastName,emp.phone,emp.email')
            ->from('programoffer prg_offer');
        $this->db->join('program prg', 'prg.programId= prg_offer.programId', 'left outer');
        $this->db->join('session ses', 'ses.sessionId= prg_offer.sessionId', 'left outer');
        $this->db->join('medium mdm', 'mdm.mediumId= prg_offer.mediumId', 'left outer');
        $this->db->join('group grp', 'grp.groupId= prg_offer.groupId', 'left outer');
        $this->db->join('shift sht', 'sht.shiftId= prg_offer.shiftId', 'left outer');
        $this->db->join('section sct', 'sct.sectionId= prg_offer.sectionId', 'left outer');
        $this->db->join('employee emp', 'emp.employeeId= prg_offer.employeeId', 'left outer');

        $this->db->where('prg_offer.sessionId', $data['sessionId']);
        //  $this->db->where('prg_offer.program', $data['program']);
        $this->db->order_by("prg_offer.sessionId", "DESC");
        //      $this->db->group_by("prg_offer.programId");
        $query = $this->db->get();

        $result = $query->result_array();
        if (!empty($result)) {
            return $result;
        }
    }

    public function getlistofferprogram() {

        $this->db->select('prg_offer.*,prg.*,ses.*,mdm.*,grp.*,sht.*,sct.*,emp.employeeId,emp.firstName,emp.middleName,emp.lastName,emp.phone,emp.email')
            ->from('programoffer prg_offer');
        $this->db->join('program prg', 'prg.programId= prg_offer.programId');
        $this->db->join('session ses', 'ses.sessionId= prg_offer.sessionId');
        $this->db->join('medium mdm', 'mdm.mediumId= prg_offer.mediumId');
        $this->db->join('group grp', 'grp.groupId= prg_offer.groupId');
        $this->db->join('shift sht', 'sht.shiftId= prg_offer.shiftId');
        $this->db->join('section sct', 'sct.sectionId= prg_offer.sectionId');
        $this->db->join('employee emp', 'emp.employeeId= prg_offer.employeeId');

        $this->db->order_by("prg_offer.sessionId,prg_offer.programId", "DESC");
        //      $this->db->group_by("prg_offer.programId");
        $query = $this->db->get();

        $result = $query->result_array();
        if (!empty($result)) {
            return $result;
        }
    }

    public function getlistofferprogram_byCurrentSession() {

        $this->db->select('prg_offer.programOfferId,prg_offer.classStatus,prg_offer.applicantSeat,prg.programName,ses.session,mdm.mediumName,grp.groupName,sht.shiftName,sct.sectionName,emp.firstName,emp.middleName,emp.lastName')
            ->from('programoffer prg_offer');
        $this->db->join('program prg', 'prg.programId= prg_offer.programId');
        $this->db->join('session ses', 'ses.sessionId= prg_offer.sessionId');
        $this->db->join('medium mdm', 'mdm.mediumId= prg_offer.mediumId');
        $this->db->join('group grp', 'grp.groupId= prg_offer.groupId');
        $this->db->join('shift sht', 'sht.shiftId= prg_offer.shiftId');
        $this->db->join('section sct', 'sct.sectionId= prg_offer.sectionId');
        $this->db->join('employee emp', 'emp.employeeId= prg_offer.employeeId');

        $this->db->order_by("prg_offer.sessionId,prg_offer.programId", "DESC");
        $this->db->limit(20);
        //      $this->db->group_by("prg_offer.programId");
        $query = $this->db->get();

        $result = $query->result_array();
        if (!empty($result)) {
            return $result;
        }
    }

    // Get ProgramOfferInfo by programofferid
    public function getofferProgramInfoById($id) {

        $qu = $this->db->get_where($this->_offertable, array('programOfferId' => $id));
        return $qu->row_array();
    }

    public function getofferProgramInfoByclass($data) {

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

    public function getofferProgramInfoByclasss($id) {

        $qu = $this->db->get_where($this->_offertable, array('programId' => $id));
        return $qu->row_array();
    }

    public function updateOfferProgramInfo($data, $id) {
        //  print_r($data); die();
        $qu = $this->db->where('programOfferId', $id);
        $this->db->update($this->_offertable, $data);
        return $this->db->affected_rows();
    }

    public function deleteOfferProgram($id) {
        $qu = $this->db->where('programOfferId', $id);
        $this->db->delete($this->_offertable);
        return $this->db->affected_rows();
    }

    public function getClassId($datacls) {
        $this->db->select('*');
        $this->db->where('programId', $datacls['programId']);
        // $this->db->limit(1);
        $result = $this->db->get($this->_table);
        return $result->row_array();
    }

    public function getClassiId($datacls) {
        $this->db->select('*');
        $this->db->where('programId', $datacls['programId']);
        // $this->db->limit(1);
        $result = $this->db->get($this->_table);
        return $result->row_array();
    }

    public function getClassiiId($data) {

        $result = $this->db->get_where($this->_table, array
        (
            'programId' => $data['programId'],
        ));
        $result_info = $result->row_array();
        if (!empty($result_info)) {
            return $result_info['classId'];
        }
    }

    public function duplicateProgramInfo($data) {
//        $this->db->select('campusName');        
        $qu = $this->db->get_where($this->_table, array('classId' => $data['classId'], 'programName' => $data['programName'], 'programLevel' => $data['programLevel']));
        $reault = $qu->row_array();
        return $reault;
    }

    public function duplicateProgramOffer($data, $id = 0) {
        if ($id) {
            $quu = $this->db->get_where($this->_offertable, array('programLevel' => $data['programLevel'], 'programId' => $data['programId'], 'mediumId' => $data['mediumId'], 'groupId' => $data['groupId'], 'shiftId' => $data['shiftId'], 'sectionId' => $data['sectionId'], 'sessionId' => $data['sessionId'], 'employeeId' => $data['employeeId'], 'applicantSeat' => $data['applicantSeat'], 'classStatus' => $data['classStatus']));
        } else {
            $quu = $this->db->get_where($this->_offertable, array('programLevel' => $data['programLevel'], 'programId' => $data['programId'], 'mediumId' => $data['mediumId'], 'groupId' => $data['groupId'], 'shiftId' => $data['shiftId'], 'sectionId' => $data['sectionId'], 'sessionId' => $data['sessionId'], 'classStatus' => $data['classStatus']));
        }
        $reault = $quu->row_array();
        return $reault;
    }

    public function deleteofferedPrograme($data) {
        //      print_r($offerId); echo ("--");   
        $qu = $this->db->where('programOfferId', $data['id']);
        $this->db->delete($this->_offertable);
        return $this->db->affected_rows() > 0;
    }

    public function getOfferedProgram() {
        $this->db->select('prg_offer.*,prg.*')
            ->from('programoffer prg_offer');
        $this->db->join('program prg', 'prg.programId= prg_offer.programId');
        //  $this->db->where('prg_offer.programId=prg.programId');
        $this->db->where('prg_offer.classStatus', 1);
        $this->db->order_by("prg_offer.programId", "asc");
        $this->db->group_by("prg_offer.programId");
        $query = $this->db->get();

        $result = $query->result_array();
        if (!empty($result)) {
            return $result;
        }
    }

    public function getOfferedMedium() {

        $this->db->select('prg_offer.*,mdm.*')
            ->from('programoffer prg_offer');
        $this->db->join('medium mdm', 'mdm.mediumId= prg_offer.mediumId');
        // $this->db->where('prg_offer.mediumId=mdm.mediumId');
        $this->db->where('prg_offer.classStatus', 1);
        $this->db->order_by("prg_offer.mediumId", "asc");
        $this->db->group_by("prg_offer.mediumId");
        $query = $this->db->get();

        $result = $query->result_array();
        if (!empty($result)) {
            return $result;
        }
    }

    public function getOfferedprogramLevel() {

        $this->db->select('prg_offer.*,prlv.*')
            ->from('programoffer prg_offer');
        $this->db->join('programlevel prlv', 'prlv.programLevelId= prg_offer.programLevel');
        // $this->db->where('prg_offer.mediumId=mdm.mediumId');
        $this->db->where('prg_offer.classStatus', 1);
        $this->db->order_by("prg_offer.programLevel", "asc");
        $this->db->group_by("prg_offer.programLevel");
        $query = $this->db->get();

        $result = $query->result_array();
        if (!empty($result)) {
            return $result;
        }
    }

    public function getOfferedShift() {
        $this->db->select('prg_offer.*,sht.*')
            ->from('programoffer prg_offer');
        $this->db->join('shift sht', 'sht.shiftId= prg_offer.shiftId');
        // $this->db->where('prg_offer.shiftId=mdm.shiftId');
        $this->db->where('prg_offer.classStatus', 1);
        $this->db->order_by("prg_offer.shiftId", "asc");
        $this->db->group_by("prg_offer.shiftId");
        $query = $this->db->get();

        $result = $query->result_array();
        if (!empty($result)) {
            return $result;
        }
    }

    public function getOfferedGroup() {

        $this->db->select('prg_offer.*,grp.*')
            ->from('programoffer prg_offer');
        $this->db->join('group grp', 'grp.groupId= prg_offer.groupId');
        // $this->db->where('prg_offer.shiftId=mdm.shiftId');
        $this->db->where('prg_offer.classStatus', 1);
        $this->db->order_by("prg_offer.groupId", "asc");
        $this->db->group_by("prg_offer.groupId");
        $query = $this->db->get();

        $result = $query->result_array();
        if (!empty($result)) {
            return $result;
        }
    }

    public function getOfferedSection() {
        $this->db->select('prg_offer.*,sctn.*')
            ->from('programoffer prg_offer');
        $this->db->join('section sctn', 'sctn.sectionId= prg_offer.sectionId');
        // $this->db->where('prg_offer.shiftId=mdm.shiftId');
        $this->db->where('prg_offer.classStatus', 1);
        $this->db->order_by("prg_offer.sectionId", "asc");
        $this->db->group_by("prg_offer.sectionId");
        $query = $this->db->get();

        $result = $query->result_array();
        if (!empty($result)) {
            return $result;
        }
    }

    public function getOfferedSession() {
        $this->db->select('prg_offer.*,ses.*')
            ->from('programoffer prg_offer');
        $this->db->join('session ses', 'ses.sessionId= prg_offer.sessionId');
        // $this->db->where('prg_offer.shiftId=mdm.shiftId');
        $this->db->where('prg_offer.classStatus', 1);
        $this->db->order_by("prg_offer.sessionId", "DESC");
        $this->db->group_by("prg_offer.sessionId");
        $query = $this->db->get();

        $result = $query->result_array();
        if (!empty($result)) {
            return $result;
        }
    }

    public function getOfferedClassTeacher() {
        $this->db->select('prg_offer.*,emp.*')
            ->from('programoffer prg_offer');
        $this->db->join('employee emp', 'emp.employeeId= prg_offer.employeeId');
        // $this->db->where('prg_offer.shiftId=mdm.shiftId');
        $this->db->where('prg_offer.classStatus', 1);
        $this->db->order_by("prg_offer.employeeId", "asc");
        $this->db->group_by("prg_offer.employeeId");
        $query = $this->db->get();

        $result = $query->result_array();
        if (!empty($result)) {
            return $result;
        }
    }

    public function searchlistofferprogram($data) {
        if (!empty($data)) {

            $this->db->where('campusId', $data['campusId']);
            $this->db->where('mediumId', $data['mediumId']);
            $this->db->where('programId', $data['programId']);
            $this->db->where('groupId', $data['groupId']);
            $this->db->where('sectionId', $data['sectionId']);
            $this->db->where('shiftId', $data['shiftId']);
            $this->db->where('sessionId', $data['sessionId']);
            $this->db->where('employeeId', $data['employeeId']);

            $qu = $this->db->get($this->_offertable);
            return $qu->result_array();
        }
    }

    public function getValidateofferedprogram($data) {

        if (!empty($data)) {
            if (!empty($data['sectionId'])) {
                if (!empty($data['programLevel'])) {
                    $this->db->where('programLevel', $data['programLevel']);
                    $this->db->where('mediumId', $data['mediumId']);
                    $this->db->where('programId', $data['programId']);
                    $this->db->where('groupId', $data['groupId']);
                    $this->db->where('sectionId', $data['sectionId']);
                    $this->db->where('shiftId', $data['shiftId']);
                    $this->db->where('sessionId', $data['sessionId']);
                    $this->db->where('classStatus', 1);

                    $qu = $this->db->get($this->_offertable);
                    return $qu->result_array();
                }
                else {
                    $this->db->where('mediumId', $data['mediumId']);
                    $this->db->where('programId', $data['programId']);
                    $this->db->where('groupId', $data['groupId']);
                    $this->db->where('sectionId', $data['sectionId']);
                    $this->db->where('shiftId', $data['shiftId']);
                    $this->db->where('sessionId', $data['sessionId']);
                    $this->db->where('classStatus', 1);

                    $qu = $this->db->get($this->_offertable);
                    return $qu->result_array();
                }
            } else {
                if (!empty($data['programLevel'])) {
                    $this->db->where('programLevel', $data['programLevel']);
                    $this->db->where('mediumId', $data['mediumId']);
                    $this->db->where('programId', $data['programId']);
                    $this->db->where('groupId', $data['groupId']);
                    $this->db->where('shiftId', $data['shiftId']);
                    $this->db->where('sessionId', $data['sessionId']);
                    $this->db->where('classStatus', 1);

                    $qu = $this->db->get($this->_offertable);
                    $result = $qu->result_array();
                    if (!empty($result)) {
                        return $result[0];
                    }
                } else {
                    $this->db->where('mediumId', $data['mediumId']);
                    $this->db->where('programId', $data['programId']);
                    $this->db->where('groupId', $data['groupId']);
                    $this->db->where('shiftId', $data['shiftId']);
                    $this->db->where('sessionId', $data['sessionId']);
                    $this->db->where('classStatus', 1);

                    $qu = $this->db->get($this->_offertable);
                    $result = $qu->result_array();
                    if (!empty($result)) {
                        return $result[0];
                    }
                }
            }
        }
    }

    public function getalllist($data) {
        if (!empty($data['programLevel'])) {
            $this->db->where('programLevel', $data['programLevel']);
        }
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

        $qu = $this->db->get($this->_offertable);
        return $qu->result_array();
    }


    public function get_pro_offer_ids($data)
    {
        $this->db->from($this->_offertable);
        $this->db->where('mediumId', $data['mediumId']);
        $this->db->where('programId', $data['programId']);
        $this->db->where('groupId', $data['groupId']);
        $this->db->where('shiftId', $data['shiftId']);
        $this->db->where('sessionId', $data['sessionId']);
        $this->db->where('classStatus', 1);

        //$qu = $this->db->get($this->_offertable);
        $result = $this->db->get()->result_array();
        return $result;
    }




    // check your inserted enrolment information is validate or not in programoffer table
    public function getValidateofferedprogramold($data) {

        if (!empty($data)) {
            if (!empty($data['sectionId'])) {
                if (!empty($data['programLevel'])) {
                    $this->db->like('programLevel', $data['programLevel']);
                    $this->db->like('mediumId', $data['mediumId']);
                    $this->db->like('programId', $data['programId']);
                    $this->db->like('groupId', $data['groupId']);
                    $this->db->like('sectionId', $data['sectionId']);
                    $this->db->like('shiftId', $data['shiftId']);
                    $this->db->like('sessionId', $data['sessionId']);
                    $this->db->like('classStatus', 1);

                    $qu = $this->db->get($this->_offertable);
                    return $qu->result_array();
                } else {
                    $this->db->like('mediumId', $data['mediumId']);
                    $this->db->like('programId', $data['programId']);
                    $this->db->like('groupId', $data['groupId']);
                    $this->db->like('sectionId', $data['sectionId']);
                    $this->db->like('shiftId', $data['shiftId']);
                    $this->db->like('sessionId', $data['sessionId']);
                    $this->db->like('classStatus', 1);

                    $qu = $this->db->get($this->_offertable);
                    return $qu->result_array();
                }
            } else {
                if (!empty($data['sessionId'])) {

                    if (!empty($data['programLevel'])) {
                        $this->db->like('programLevel', $data['programLevel']);
                    }
                    if (!empty($data['mediumId'])) {
                        $this->db->like('mediumId', $data['mediumId']);
                    }
                    if (!empty($data['programId'])) {
                        $this->db->like('programId', $data['programId']);
                    }
                    if (!empty($data['groupId'])) {
                        $this->db->like('groupId', $data['groupId']);
                    }
                    if (!empty($data['shiftId'])) {
                        $this->db->like('shiftId', $data['shiftId']);
                    }
                    if (!empty($data['sectionId'])) {
                        $this->db->like('sectionId', $data['sectionId']);
                    }
                    if (!empty($data['sessionId'])) {
                        $this->db->like('sessionId', $data['sessionId']);
                    }


                    $this->db->like('classStatus', 1);

                    $qu = $this->db->get($this->_offertable);
                    $result = $qu->result_array();
                    if (!empty($result)) {
                        return $result[0];
                    }
                } else {
                    $this->db->like('mediumId', $data['mediumId']);
                    $this->db->like('programId', $data['programId']);
                    $this->db->like('groupId', $data['groupId']);
                    $this->db->like('shiftId', $data['shiftId']);
                    $this->db->like('sessionId', $data['sessionId']);
                    $this->db->like('classStatus', 1);

                    $qu = $this->db->get($this->_offertable);
                    $result = $qu->result_array();
                    if (!empty($result)) {
                        return $result[0];
                    }
                }
            }
        }
    }

    // check your inserted enrolment information is validate or not in programoffer table
    public function getSectionArrayofferedprogram($data) {

        if (!empty($data)) {
            $this->db->where('campusId', $data['campusId']);
            $this->db->where('mediumId', $data['mediumId']);
            $this->db->where('programId', $data['programId']);
            $this->db->where('groupId', $data['groupId']);
            $this->db->where('shiftId', $data['shiftId']);
            $this->db->where('sessionId', $data['sessionId']);
            $this->db->where('classStatus', 1);

            $qu = $this->db->get($this->_offertable);
            $result = $qu->result_array();
            if (!empty($result)) {
                return $result;
            }
        }
    }

    public function getProgramOfferId_withPrglevel($data) {

        $result = $this->db->get_where($this->_offertable, array('programLevel' => $data['programLevel'], 'mediumId' => $data['mediumId'], 'programId' => $data['programId'], 'groupId' => $data['groupId'], 'sectionId' => $data['sectionId'], 'shiftId' => $data['shiftId'], 'sessionId' => $data['sessionId'], 'classStatus' => 1));
        $result_info = $result->row_array();
        if (!empty($result_info)) {
            return $result_info['programOfferId'];
        }
    }

    public function getProgramOfferIdd($data) {
        if (!empty($data['sessionId'])) {

            if (!empty($data['programLevel'])) {
                $this->db->like('programLevel', $data['programLevel']);
            }
            if (!empty($data['mediumId'])) {
                $this->db->like('mediumId', $data['mediumId']);
            }
            if (!empty($data['programId'])) {
                $this->db->like('programId', $data['programId']);
            }
            if (!empty($data['groupId'])) {
                $this->db->like('groupId', $data['groupId']);
            }
            if (!empty($data['shiftId'])) {
                $this->db->like('shiftId', $data['shiftId']);
            }
            if (!empty($data['sessionId'])) {
                $this->db->like('sessionId', $data['sessionId']);
            }
            $this->db->like('classStatus', 1);

            $qu = $this->db->get($this->_offertable);
            $result = $qu->result_array();
            if (!empty($result)) {
                return $result[0];
            }
        } else {
            if (!empty($data['mediumId'])) {
                $this->db->like('mediumId', $data['mediumId']);
            }
            if (!empty($data['programId'])) {
                $this->db->like('programId', $data['programId']);
            }
            if (!empty($data['groupId'])) {
                $this->db->like('groupId', $data['groupId']);
            }
            if (!empty($data['shiftId'])) {
                $this->db->like('shiftId', $data['shiftId']);
            }
            if (!empty($data['sessionId'])) {
                $this->db->like('sessionId', $data['sessionId']);
            }
            $this->db->like('classStatus', 1);

            $qu = $this->db->get($this->_offertable);
            $result = $qu->result_array();
            if (!empty($result)) {
                return $result['programOfferId'];
            }
        }
    }

    public function checkProgramOfferAndSemester($data)
    {
//        echo '<pre>';
//        print_r($data);exit;

        if (!$data['programOfferId']['programOfferId'] || !$data['semesterId'] || !$data['courseId'])
        {
            return FALSE;
        }
        $record = $this->db
            ->where('programOfferId', $data['programOfferId']['programOfferId'])
            ->where('semesterId', $data['semesterId'])
            ->where('courseId', $data['courseId'])
            ->get('studentmarks')
            ->row();
        if ($record) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function check_student_marks($data)
    {
//        echo '<pre>';
//        print_r($data);exit;

        if (!$data['programOfferId']['programOfferId'] || !$data['semesterId'] || !$data['courseId'])
        {
            return false;
        }
        $record = $this->db
            ->where('programOfferId', $data['programOfferId']['programOfferId'])
            ->where('semesterId', $data['semesterId'])
            ->where('courseId', $data['courseId'])
            ->get('studentmarks')->result_array();

        if ($record) {
            return $record;
        }
        else {
            return false;
        }
    }

    public function getStudentAssignList($programOfferId = 0, $courseId = 0)
    {
        ini_set('max_execution_time', 300);
        $records = $this->db
            ->select('
                        sac.studentId,
                        sac.programOfferId,
                        sm.divide_mark,
                        sm.markId
                        ')
            ->from('studentassigncourse AS sac')
            ->join('studentmarks AS sm','sac.studentId = sm.studentId and sm.programOfferId = '.$programOfferId.' and sm.courseId = '.$courseId.'','left')
            ->where('sac.programOfferId', $programOfferId)
            ->group_by('sac.studentId')
            ->get()
            ->result();
        return $records;
    }

    public function getProgramOfferId($data) {

        $result = $this->db->get_where($this->_offertable, array
        ('mediumId' => $data['mediumId'],
            'programId' => $data['programId'],
            'groupId' => $data['groupId'],
            'sectionId' => $data['sectionId'],
            'shiftId' => $data['shiftId'],
            'sessionId' => $data['sessionId'],
            'classStatus' => 1));
        $result_info = $result->row_array();
        if (!empty($result_info)) {
            return $result_info;['programOfferId'];
        }
    }

    public function get_program_offer_Id($data) {


        $this->db->select('*');
        $this->db->from($this->_offertable);
        if(isset($data['mediumId']))
        {
            if($data['mediumId']>0)
            {
                $this->db->where('mediumId',$data['mediumId']);
            }
        }
        if($data['programId']>0)
        {
            $this->db->where('programId',$data['programId']);
        }
        if(isset($data['groupId']))
        {
            if($data['groupId']>0)
            {
                $this->db->where('groupId',$data['groupId']);
            }
        }
        if(isset($data['sectionId']))
        {
            if($data['sectionId']>0)
            {
                $this->db->where('sectionId',$data['sectionId']);
            }
        }
        if(isset($data['shiftId']))
        {
            if($data['shiftId']>0)
            {
                $this->db->where('shiftId',$data['shiftId']);
            }
        }
        if($data['sessionId'])
        {
            $this->db->where('sessionId',$data['sessionId']);
        }
        $this->db->where('classStatus',1);
        $results = $this->db->get()->result_array();

//        echo '<pre>';
//        print_r($results);exit;

        return $results;
    }

    public function getProgramOfferId_for_student($session,$class_level,$class,$medium,$groupid,$shiftid,$sectionid){
        $result = $this->db->get_where($this->_offertable, array
        ('mediumId' => $medium,
            'programId' => $class,
            'groupId' => $groupid,
            'sectionId' => $sectionid,
            'shiftId' => $shiftid,
            'sessionId' => $session,
            'classStatus' => 1));
        $result_info = $result->row_array();
        if (!empty($result_info)) {
            return $result_info['programOfferId'];
        }
    }

    public function getProgramOfferId_for_student_second_one($session,$class_level,$class,$medium,$groupid,$shiftid,$sectionid,$examtype){
        $result = $this->db->get_where($this->_offertable, array
        ('mediumId' => $medium,
            'programId' => $class,
            'groupId' => $groupid,
            'sectionId' => $sectionid,
            'shiftId' => $shiftid,
            'sessionId' => $session,
            'classStatus' => 1));
        $result_info = $result->row_array();
        if (!empty($result_info)) {
            return $result_info['programOfferId'];
        }
    }

    public function getProgramOfferId_another($session,$section,$shift,$class_student,$medium,$group){
        $result = $this->db->get_where($this->_offertable, array
        ('mediumId' => $medium,
            'programId' => $class_student,
            'groupId' => $group,
            'sectionId' => $section,
            'shiftId' => $shift,
            'sessionId' => $session,
            'classStatus' => 1));
        $result_info = $result->row_array();
        if (!empty($result_info)) {
            return $result_info['programOfferId'];
        }
    }

    public function getProgramOfferIdforcourse($data) {

        $result = $this->db->get_where($this->_offertable, array
        ('mediumId' => $data['mediumId'],
            'programId' => $data['programId'],
            'groupId' => $data['groupId'],
            //'sectionId' => $data['sectionId'],
            'shiftId' => $data['shiftId'],
            'sessionId' => $data['sessionId'],
            'classStatus' => 1));
        $result_info = $result->row_array();
        if (!empty($result_info)) {
            return $result_info['programOfferId'];
        }
    }

    public function getPorgramOfferId($data = [])
    {
        $result = $this->db->get_where($this->_offertable, array
        ('mediumId' => $data['mediumId'],
            'programId' => $data['programId'],
            'groupId' => $data['groupId'],
            'sectionId' => $data['sectionId'],
            'shiftId' => $data['shiftId'],
            'sessionId' => $data['sessionId'],
            'classStatus' => 1));
        $result_info = $result->row_array();
        if (!empty($result_info)) {
            return $result_info['programOfferId'];
        }
    }

    public function getProgramOfferIdforcoursee($data) {

        $result = $this->db->get_where($this->_offertable, array
        ('mediumId' => $data['mediumId'],
            'programId' => $data['programId'],
            'groupId' => $data['groupId'],
            'sectionId' => $data['sectionId'],
            'shiftId' => $data['shiftId'],
            'sessionId' => $data['sessionId'],
            'classStatus' => 1));
        $result_info = $result->row_array();
        if (!empty($result_info)) {
            return $result_info['programOfferId'];
        }
    }

    // get All program offer info array(4m programoffer-table) by applicationId from admissionapplicant table
    function getPrOfferArraybyApplicantionId($id) {
        $this->db->select('ap.applicationId,ap.programOfferId, pr.*')
            ->from('admissionapplicant ap, programoffer pr');
        $this->db->join('programoffer', 'pr.programOfferId= ap.programOfferId');
        $query = $this->db->get_where('admissionapplicant', array('ap.applicationId' => $id));

        $result = $query->result_array();
        return $result[0];
    }

    // get programoofferid from programmoffer table by session & then match student programofferid from promotedstudent table 
    function getProgramOfferIdBySessionStudent($data) {
        $this->db->select('prostu.*,pr.*')
            ->from('promotedstudent prostu, programoffer pr');
        $this->db->join('programoffer', 'pr.programOfferId= prostu.programOfferId');
        $this->db->where('pr.sessionId', $data['sessionId']);
        $this->db->where('prostu.studentId', $data['studentId']);
        $this->db->order_by('pr.programOfferId,prostu.studentId','DESC');
        $query = $this->db->get();

        $result = $query->row_array();
        if (!empty($result)) {
            return $result;
        }
    }

    // Dependable select step................
    public function getClasslist($id) {
        $this->db->select('*')
            ->from('program');
        $this->db->where('programLevel', $id);
        $this->db->order_by('programName', "ASC");
        $this->db->group_by('programName');
        $query = $this->db->get();

        $result = $query->result_array();
        if (!empty($result)) {
            return $result;
        }
    }

    // get program offered value by dependent select option
    public function getProgramOfferedValuebyclass($whr_data, $gt_data, $id, $session_id = 0) {
        $this->db->select('*')
            ->from('programoffer');

        $this->db->where('classStatus', 1);
        $this->db->where($whr_data, $id);
        if ($session_id) {
            $this->db->where('sessionId', $session_id);
        }
        //  $this->db->or_where($gt_data, $id);
        $this->db->order_by($gt_data, "ASC");
        $this->db->group_by($gt_data);
        $query = $this->db->get();

        $result = $query->result_array();
        if (!empty($result)) {
            return $result;
        }
    }

    // get program offered value by dependent select option
    public function getProgramOfferedValue($whr_data, $gt_data, $id,$session_id = 0,$class_level=0) {
        $this->db->select('*')
            ->from('programoffer');


        $this->db->where($whr_data, $id);
        $this->db->where('classStatus', 1);
        if ($session_id) {
            $this->db->where('sessionId', $session_id);
        }
        if ($class_level) {
            $this->db->where('programLevel', $class_level);
        }
        $this->db->order_by($gt_data, "ASC");
        $this->db->group_by($gt_data);
        $query = $this->db->get();

        $result = $query->result_array();
        if (!empty($result)) {
            return $result;
        }
    }

    // get program offered value by dependent select option
    public function getProgramOfferedValueshift($whr_data, $gt_data, $id,$session_id = 0,$class_level=0) {
        $this->db->select('*')
            ->from('programoffer');

        $this->db->where('classStatus', 1);


        if ($session_id && $class_level) {
            $this->db->where($whr_data, $id);
        } else {
            $this->db->or_where($whr_data, $id);
            $this->db->or_where($gt_data, $id);
        }

        if ($session_id) {
            $this->db->where('sessionId', $session_id);
        }
        if ($class_level) {
            $this->db->where('programLevel', $class_level);
        }
        $this->db->order_by($gt_data, "ASC");
        $this->db->group_by($gt_data);
        $query = $this->db->get();

        $result = $query->result_array();
        if (!empty($result)) {
            return $result;
        }
    }

    //get program offered value by dependent select option
    public function getProgramOfferedValuesection($whr_data, $gt_data, $id,$session_id = 0,$class_level=0) {
        $this->db->select('*')
            ->from('programoffer');

        $this->db->where('classStatus', 1);


        if ($session_id && $class_level) {
            $this->db->where($whr_data, $id);
        } else {
            $this->db->where($whr_data, $id);
        }

        if ($session_id) {
            $this->db->where('sessionId', $session_id);
        }
        if ($class_level) {
            $this->db->where('programLevel', $class_level);
        }
        $this->db->order_by($gt_data, "ASC");
        $this->db->group_by($gt_data);
        $query = $this->db->get();

        $result = $query->result_array();
        // echo '<pre>';
        // print_r($result);
        // exit;
        if (!empty($result)) {
            return $result;
        }
    }

    // get program offered value by dependent select option
    public function getProgramOfferedValuebyteacher($whr_data, $gt_data, $id, $userName) {
        $this->db->select('prg.*,cur.*')
            ->from('programoffer prg');
        $this->db->join('courseoffer cur', 'cur.programOfferId=prg.programOfferId');
        $this->db->where($whr_data, $id);
        $this->db->where('cur.employeeId', $userName);
        $this->db->where('prg.classStatus', 1);
        $this->db->order_by($gt_data, "ASC");
        $this->db->group_by($gt_data);
        $query = $this->db->get();

        $result = $query->result_array();
        if (!empty($result)) {
            return $result;
        }
    }

    public function test($id) {
        $this->db->select('*')
            ->from('upozila');

        $this->db->where('districtid', $id);

        $query = $this->db->get();

        $result = $query->result_array();
        if (!empty($result)) {
            return $result;
        }
    }

    public function getdesignation($id) {
        $this->db->select('*')
            ->from('designation');

        $this->db->where('employeetypeId', $id);

        $query = $this->db->get();

        $result = $query->result_array();
        if (!empty($result)) {
            return $result;
        }
    }

    public function getOfferedCourseLists($datax) {
        $this->db->select('programLevel');
        $this->db->from('programOffer');
        $this->db->where('programOfferId', $datax);
        $query = $this->db->get();

        $result = $query->row_array();
        if (!empty($result)) {
            return $result;
        }
    }

    public function getOfferedCourseList($data) {

        $result = $this->db->get_where($this->_offertable, array
        ('programOfferId' => $data['programOfferId']
        ));
        $result_info = $result->row_array();
        if (!empty($result_info)) {
            return $result_info['programOfferId'];
        }
    }

    public function GetLastStudentSerialNo($year, $classId) {
        $serNo = 0;
        $row = $this->db
            ->get_where('idcounter', array('Year' => $year, 'classId' => $classId))
            ->row();
        if ($row) {
            $serNo = $row->serialNo;
        }
        return $serNo;
        // $this->db->select('serialNo');
        // $result = $this->db->get_where('idcounter', array('Year' => $year, 'classId' => $classId));
        // if ($result !== FALSE) {
        //     if ($result->num_rows() === 1) {
        //         $data = $result->row_array();
        //         // print_r($data);
        //         if (!empty($data)) {
        //             return $data['serialNo'];
        //         } else {
        //             return 0;
        //         }
        //     } else {
        //         return 0;
        //     }
        // } else {
        //     return 0;
        // }
    }

    public function UpdateCounter($regNo, $setDate, $clsId) {


        $data['serialNo'] = $regNo;
        $data['Year'] = $setDate;
        $data['classId'] = $clsId;


        $qu = $this->db->where('classId', $data['classId']);

        $this->db->update($this->_idcounter, $data);
        return $this->db->affected_rows();
    }

    public function InsertCounter($regNo, $setDate, $clsId) {
        $data['serialNo'] = $regNo;
        $data['Year'] = $setDate;
        $data['classId'] = $clsId;
        $this->db->insert($this->_idcounter, $data);
        return $this->db->insert_id();
    }

    public function getProgramOfferId_For_Subject($session,$classlvl,$class,$medium,$group,$shift,$section){
        $result = $this->db->get_where($this->_offertable, array
        ('mediumId' => $medium,
            'programId' => $class,
            'groupId' => $group,
            'sectionId' => $section,
            'shiftId' => $shift,
            'sessionId' => $session,
            'classStatus' => 1));
        $result_info = $result->row_array();
        if (!empty($result_info)) {
            return $result_info['programOfferId'];
        }
    }

    public function get_assigned_subjects($data_programOfferId){
        $this->db->select('course.courseId,course.courseName');
        $this->db->from('courseoffer');
        $this->db->join('course','courseoffer.courseId = course.courseId');
        $this->db->where('programOfferId',$data_programOfferId);
        $query = $this->db->get();
        $result = $query->result_array();
        if(!empty($result)){
            return $result;
        }
    }

    public function search_class_information($data_programOfferId){
        $this->db->select('programoffer.*,session.*,program.*,group.groupId,group.groupName,medium.mediumId,medium.mediumName,section.sectionId,section.sectionName,shift.*');
        $this->db->from('programoffer');
        $this->db->join('program','programoffer.programId = program.programId');
        $this->db->join('section','programoffer.sectionId = section.sectionId');
        $this->db->join('shift','programoffer.shiftId = shift.shiftId');
        $this->db->join('group','programoffer.groupId = group.groupId');
        $this->db->join('medium','programoffer.mediumId = medium.mediumId');
        $this->db->join('session','programoffer.sessionId = session.sessionId');
        $this->db->where('programoffer.programOfferId',$data_programOfferId);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function getProgramOfferedIdForMerge($data){
        $result = $this->db->get_where($this->_offertable, array
        ('mediumId' => $data['mediumId'],
            'programId' => $data['programId'],
            'groupId' => $data['groupIdd'],
            'sectionId' => $data['sectionId'],
            'shiftId' => $data['shiftId'],
            'sessionId' => $data['sessionId'],
            'classStatus' => 1));
        $result_info = $result->row_array();
        if (!empty($result_info)) {
            return $result_info['programOfferId'];
        }
    }

    public function getProgramOfferedIdForAttendance($data){
        $result = $this->db->get_where($this->_offertable, array
        ('mediumId' => $data['mediumId'],
            'programId' => $data['programId'],
            'groupId' => $data['groupId'],
            'sectionId' => $data['sectionId'],
            'shiftId' => $data['shiftId'],
            'sessionId' => $data['sessionId'],
            'classStatus' => 1));
        $result_info = $result->row_array();
        if (!empty($result_info)) {
            return $result_info['programOfferId'];
        }
    }

    public function insert_merged_course_info($data,$data_programOfferId){
        $cinfo = array(
            'merge_course_name'=>$data['getnewsubName'],
            'programOfferId'=> $data_programOfferId,
            'status' => 1,
            'created_by' =>1
        );
        $this->db->insert('merge',$cinfo);
        $last_id = $this->db->insert_id();
        $data = [
            [
                'merge_id' => $last_id,
                'course_id' => $data['getfirstSubject']
            ],
            [
                'merge_id' => $last_id,
                'course_id' => $data['getsecondSubject']
            ]
        ];
        $this->db->insert_batch('merge_course', $data);
    }

    public function get_merge_subjects()
    {
        $this->db->select('merge.*');
        $this->db->select('GROUP_CONCAT(course.courseName) as merging_course_names');
        $this->db->select('GROUP_CONCAT(course.courseCode) as merging_course_codes');
        $this->db->from('merge');
        $this->db->join('merge_course','merge_course.merge_id=merge.id','INNER');
        $this->db->join('course','course.courseId=merge_course.course_id','INNER');
        $this->db->group_by('merge.id');
        $results=$this->db->get()->result_array();
        return $results;
    }

    public function get_class_info($program_offer_info)
    {
        $this->db->select('ss.session');
        $this->db->select('p.programName');
        $this->db->select('m.mediumName');
        $this->db->select('g.groupName');
        $this->db->select('s.shiftName');
        $this->db->select('se.sectionName');
        $this->db->from('programoffer as po');
        $this->db->join('program AS p', 'p.programId = po.programId','INNER');
        $this->db->join('medium AS m', 'm.mediumId = po.mediumId','INNER');
        $this->db->join('group AS g', 'g.groupId = po.groupId','INNER');
        $this->db->join('shift AS s', 's.shiftId = po.shiftId','INNER');
        $this->db->join('section AS se', 'se.sectionId = po.sectionId','INNER');
        $this->db->join('session AS ss', 'ss.sessionId = po.sessionId','INNER');
        $this->db->where('po.programOfferId', $program_offer_info);
        $records=$this->db->get()->row_array();

        if($records)
        {
            $result='';
            $i=0;
            foreach($records as $r)
            {
                if($i==0)
                {
                    $result = $r;
                }
                else
                {
                    $result = $result.' -- '.$r;
                }
                $i++;
            }
            return $result;
        }
        else
        {
            echo 'Not Found';
        }
    }

    public function delete_merge_course($id)
    {
        $this->db->where('id', $id);
        $result=$this->db->delete('merge');
        if($result)
        {
            $this->db->where('merge_id', $id);
            $this->db->delete('merge_course');
        }
    }

}
?>