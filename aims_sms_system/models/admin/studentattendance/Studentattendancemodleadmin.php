<?php

/*
 * Project Name: Aims
 * Author: Adventure Soft
 * Author url: http://www.adventure-soft.com
 */

class StudentattendanceModleAdmin extends CI_Model {



    private $_table = "studentattendance";

    private $_table1 = "courseoffer";

    private $_table2 = "event_log";



    public function __construct() {

        parent::__construct();

    }



    public function saveStudentattendancess($data) {



        $this->db->insert('studentattendance', $data);

        return $this->db->insert_id();

    }



    // next function is for attendance check by date when any one need attendance by subject.... 

    public function checkattendance($studentId, $attendanceDate) {

        if ($attendanceDate) {
            $attendanceDate = date("Y-m-d", strtotime(trim($attendanceDate)));
        }

        $user_check = $this->db->get_where($this->_table, array(

            'studentId' => $studentId,

            'attendanceDate' => $attendanceDate

        ));



        if ($user_check->num_rows() > 0) {

            return TRUE;

        } else {

            return FALSE;

        }

    }



    // next function is for attendance check by subject when any one need attendance by subject...it also working from teacher panel. 

    public function checkattendancebysubject($studentId, $subjectId, $attendanceDate) {



        $user_check = $this->db->get_where($this->_table, array(

            'studentId' => $studentId,

            'subjectId' => $subjectId,

            'attendanceDate' => $attendanceDate

        ));



        if ($user_check->num_rows() > 0) {

            return TRUE;

        } else {

            return FALSE;

        }

    }



    // next function is for attendance get by date when any one need attendance by student.... 

    public function getstudentattendance($data)
    {



        print_r($data);


        if (!empty($data)) {

            if ($data['fromDate']) {
                $data['fromDate'] = date("Y-m-d", strtotime(trim($data['fromDate'])));
            }
            if ($data['toDate']) {
                $data['toDate'] = date("Y-m-d", strtotime(trim($data['toDate'])));
            }

            $this->db->where('studentId', trim($data['studentId']));

            $this->db->where('attendanceDate >=', $data['fromDate']);

            $this->db->where('attendanceDate <=', $data['toDate']);

            $this->db->order_by('attendanceDate', 'DESC');

            $qu = $this->db->get($this->_table);
            // print_r($this->db->last_query($qu->result_array()));exit;
            //print_r($qu->result_array());exit;

            return $qu->result_array();

        }

    }


    public function get_student_attendance_from_both_table($data)
    {
        //manual attendance
        $this->db->select('manual.*');
        $this->db->select('std.applicationId');
        $this->db->select('std_info.firstName');
        $this->db->select('session.session');
        $this->db->select('program.programName');
        $this->db->select('medium.mediumName');
        $this->db->select('group.groupName');
        $this->db->select('shift.shiftName');
        $this->db->select('section.sectionName');
        $this->db->select('"Manual" as attendance_type');
        $this->db->from('studentattendance manual');
        $this->db->join('student std','std.studentId=manual.studentId','LEFT');
        $this->db->join('studentinfo std_info','std_info.applicationId=std.applicationId','LEFT');
        $this->db->join('programoffer p_of','p_of.programOfferId=manual.programOfferId','LEFT');
        $this->db->join('session','session.sessionId=p_of.sessionId','LEFT');
        $this->db->join('program','program.programId=p_of.programId','LEFT');
        $this->db->join('medium','medium.mediumId=p_of.mediumId','LEFT');
        $this->db->join('group','group.groupId=p_of.groupId','LEFT');
        $this->db->join('shift','shift.shiftId=p_of.shiftId','LEFT');
        $this->db->join('section','section.sectionId=p_of.sectionId','LEFT');
        if($data['studentId'])
        {
            $this->db->where('manual.studentId', $data['studentId']);
        }
        $this->db->where_in('manual.programOfferId', $data['programOfferId']);
        if($data['fromDate'])
        {
            $this->db->where('manual.attendanceDate >=', $data['fromDate1']);
        }
        if($data['toDate'])
        {
            $this->db->where('manual.attendanceDate <=', $data['toDate1']);
        }
        if ($data['status'])
        {
            $this->db->where('manual.attendanceStatus', $data['status']);
        }
        $this->db->order_by('manual.attendanceDate', 'DESC');
        $this->db->order_by('manual.studentId', 'ASC');
        $results['manual']=$this->db->get()->result_array();
        //manual attendance

        if($data['status']!=2)
        {
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
//            echo $diff;exit;

            //finger print only holds present status
            //$this->db->select('el.student_id as studentId,el.programOfferId,el.date_time,std_info.firstName,MIN(el.date_time) in_time,MAX(el.date_time) out_time,"1" as attendanceStatus, DATE(FROM_UNIXTIME(el.date_time)) as attendanceDate');
            $this->db->select('el.student_id as studentId,el.programOfferId,el.date_time,std_info.firstName,MIN(el.date_time) in_time,MAX(el.date_time) out_time,"1" as attendanceStatus, DATE(CONVERT_TZ(FROM_UNIXTIME(el.date_time),"+00:00","'.$diff.'")) as attendanceDate');
            $this->db->select('session.session');
            $this->db->select('program.programName');
            $this->db->select('medium.mediumName');
            $this->db->select('group.groupName');
            $this->db->select('shift.shiftName');
            $this->db->select('section.sectionName');
            $this->db->select('"Finger Print" as attendance_type');
            $this->db->from('event_log el');
            $this->db->join('student std','std.studentId=el.student_id','LEFT');
            $this->db->join('studentinfo std_info','std_info.applicationId=std.applicationId','LEFT');
            $this->db->join('programoffer p_of','p_of.programOfferId=el.programOfferId','LEFT');
            $this->db->join('session','session.sessionId=p_of.sessionId','LEFT');
            $this->db->join('program','program.programId=p_of.programId','LEFT');
            $this->db->join('medium','medium.mediumId=p_of.mediumId','LEFT');
            $this->db->join('group','group.groupId=p_of.groupId','LEFT');
            $this->db->join('shift','shift.shiftId=p_of.shiftId','LEFT');
            $this->db->join('section','section.sectionId=p_of.sectionId','LEFT');
            if($data['studentId'])
            {
                $this->db->where('el.student_id', $data['studentId']);
            }
            if($data['fromDate'])
            {
                $this->db->where('el.date_time >=', $data['fromDate_int']);
            }
            if($data['toDate'])
            {
                $this->db->where('el.date_time <=', $data['toDate_int']);
            }
            $this->db->where_in('el.programOfferId', $data['programOfferId']);
            //$this->db->group_by('el.student_id,DATE(FROM_UNIXTIME(el.date_time))');
            $this->db->group_by('el.student_id,DATE(CONVERT_TZ(FROM_UNIXTIME(el.date_time),"+00:00","'.$diff.'"))');
            $this->db->order_by('el.date_time');
            $results['machine'] = $this->db->get()->result_array();
        }

        return $results;
    }



    public function getfingerstudentattendance($data) {



        //print_r($data);



        if (!empty($data)) {
            if ($data['fromDate']) {
                $data['fromDate'] = date("Y-m-d", strtotime(trim($data['fromDate'])));
            }
            if ($data['toDate']) {
                $data['toDate'] = date("Y-m-d", strtotime(trim($data['toDate'])));
            }

            $this->db->select('event_log.sl, event_log.device_id, event_log.student_id, FROM_UNIXTIME(event_log.date_time) AS ptime');

            $this->db->where('student_id', $data['studentId']);

            $this->db->where('date_time >=', strtotime($data['fromDate']));

            $this->db->where('date_time <=', strtotime($data['toDate']));

            $this->db->order_by('sl', 'DESC');

            $qu = $this->db->get($this->_table2);

            $result = $qu->result_array();



            return $result;



//            echo "<pre>";

//            print_r($result);

//            echo "</pre>";

        }

    }



    public function getstudentattendancestatus($data) {

        //print_r($data);

        if ($data['fromDate']) {
            $data['fromDate'] = date("Y-m-d", strtotime(trim($data['fromDate'])));
        }
        if ($data['toDate']) {
            $data['toDate'] = date("Y-m-d", strtotime(trim($data['toDate'])));
        }

        $this->db->select('stu_info.applicationId,stu_info.firstName,stu_info.lastName,stu_info.fatherName,stu_info.fatherPhone,stu.*,studentattendance.*');

        $this->db->join('student stu', 'stu.studentId=studentattendance.studentId');

        $this->db->join('studentinfo stu_info', 'stu_info.applicationId=stu.applicationId');





        $this->db->where('attendanceStatus', $data['attendanceStatus']);

        $this->db->where('attendanceDate >=', $data['fromDate']);

        $this->db->where('attendanceDate <=', $data['toDate']);

        $this->db->order_by('attendanceDate', 'ASC');

        $qu = $this->db->get($this->_table);

        return $qu->result_array();

//            $result_info = $qu->result_array();

//            echo '<pre>';

//            print_r($result_info);

//            echo '</pre>';





    }



    public function getstudentattendancesms($data) {



        if (!empty($data)) {

            $this->db->select('stu_info.applicationId,stu_info.firstName,stu_info.lastName,stu_info.phone,stu_info.fatherName,stu_info.fatherPhone,stu_info.motherName,stu_info.middleName,stu_info.motherPhone,stu.*,stu_aat.*');

            $this->db->from('studentattendance stu_aat');

            $this->db->join('student stu', 'stu.studentId=stu_aat.studentId');

            $this->db->join('studentinfo stu_info', 'stu_info.applicationId=stu.applicationId');





            //   $this->db->where('stu_aat.programOfferId', $data['programOfferId']);

            $this->db->where('stu_aat.attendanceDate >=', $data['fromDate']);

            $this->db->where('stu_aat.attendanceDate <=', $data['toDate']);





            $this->db->order_by('stu_aat.attendanceDate', 'desc');

            $qu = $this->db->get();

            return $qu->result_array();

        } else {

            return FALSE;

        }

    }



    // next function is for attendance get class attendance by date .... 

    public function getstudentattendancebyclass($data) {

        // echo '<pre>';print_r($data);exit;

        if (!empty($data)) {
            if ($data['fromDate']) {
                $data['fromDate'] = date("Y-m-d", strtotime(trim($data['fromDate'])));
            }
            if ($data['toDate']) {
                $data['toDate'] = date("Y-m-d", strtotime(trim($data['toDate'])));
            }

            $this->db->select('stu_info.applicationId,stu_info.firstName,stu_info.lastName,stu_info.fatherName,stu_info.fatherPhone,stu.*,stu_aat.*');

            $this->db->from('studentattendance stu_aat');

            $this->db->join('student stu', 'stu.studentId=stu_aat.studentId');

            $this->db->join('studentinfo stu_info', 'stu_info.applicationId=stu.applicationId');





            $this->db->where('stu_aat.programOfferId', $data['programOfferId']['programOfferId']);

            $this->db->where('stu_aat.attendanceDate >=', $data['fromDate']);

            $this->db->where('stu_aat.attendanceDate <=', $data['toDate']);





            $this->db->order_by('stu_aat.attendanceDate', 'desc');

            $qu = $this->db->get();

            return $qu->result_array();

        } else {

            return FALSE;

        }

    }



    public function getstudentattendancebyinstitute($data) {



        if (!empty($data)) {
            if ($data['fromDate']) {
                $data['fromDate'] = date("Y-m-d", strtotime(trim($data['fromDate'])));
            }
            if ($data['toDate']) {
                $data['toDate'] = date("Y-m-d", strtotime(trim($data['toDate'])));
            }

            $this->db->select('stu_info.applicationId,stu_info.firstName,stu_info.lastName,stu_info.fatherName,stu_info.fatherPhone,stu.*,stu_aat.*');

            $this->db->from('studentattendance stu_aat');

            $this->db->join('student stu', 'stu.studentId=stu_aat.studentId');

            $this->db->join('studentinfo stu_info', 'stu_info.applicationId=stu.applicationId');





            $this->db->where('stu_aat.attendanceDate >=', $data['fromDate']);

            $this->db->where('stu_aat.attendanceDate <=', $data['toDate']);





            $this->db->order_by('stu_aat.attendanceDate', 'desc');

            $qu = $this->db->get();

            return $qu->result_array();

        } else {

            return FALSE;

        }

    }



    //FingerPrint Full institute Student attendance search 



    public function getfingerstudentattendancebyinstitute($data) {



        if (!empty($data)) {

            if ($data['fromDate']) {
                $data['fromDate'] = date("Y-m-d", strtotime(trim($data['fromDate'])));
            }
            if ($data['toDate']) {
                $data['toDate'] = date("Y-m-d", strtotime(trim($data['toDate'])));
            }

            $this->db->select('stu_info.applicationId,stu_info.firstName,stu_info.lastName,stu_info.fatherName,stu_info.fatherPhone, event_log.sl, event_log.device_id, event_log.student_id, FROM_UNIXTIME(event_log.date_time) AS ptime, stu.*,');

            $this->db->from('event_log');

            $this->db->join('student stu', 'stu.studentId=event_log.student_id');

            $this->db->join('studentinfo stu_info', 'stu_info.applicationId=stu.applicationId');





            $this->db->where('event_log.date_time >=', strtotime($data['fromDate']));

            $this->db->where('event_log.date_time <=', strtotime($data['toDate']));





            $this->db->order_by('event_log.date_time', 'desc');

            $qu = $this->db->get();

            //$result = $qu->result_array();

            return $qu->result_array();



            /*echo "<pre>";

            print_r($result);

            echo "<pre>";*/



        } else {

            return FALSE;

        }





    }



    public function delete_attendance($id) {



        $this->db->where('attendanceId', $id);

        $qu = $this->db->delete($this->_table);

        return $this->db->affected_rows();

    }



    // next function is for attendance get by subject when any one need attendance by subject.... 

    public function getstudentattendanceview($data) {

//        print_r($data);       



        if (!empty($data)) {

            $this->db->like('studentId', $data['studentId']);

            $this->db->like('subjectId', $data['subjectId']);

            $this->db->order_by('attendanceDate', 'DESC');

            $qu = $this->db->get($this->_table);

            return $qu->result_array();

        }

    }



    public function searchcourselist($data) {

//        print_r($data);       

        $this->db->select('courseId');



        $this->db->like('campusId', $data['campusId']);

        $this->db->like('programId', $data['programId']);

        $this->db->like('shiftId', $data['shiftId']);

        $this->db->like('mediumId', $data['mediumId']);

        $this->db->like('groupId', $data['groupId']);

        $this->db->like('session', $data['session']);



        $qqu = $this->db->get($this->_table1);

        return $qqu->result_array();

    }



    public function deletestudentattandance($id) {

        $this->db->where('studentId', $id);

        $this->db->delete($this->_table);

        return $this->db->affected_rows();

    }

    public function getStudentAttendanceByProgramOfferId($data_programOfferId,$fromDate,$toDate,$status){
        $this->db->select('*');
        $this->db->from('studentattendance');
        $this->db->where('programOfferId',$data_programOfferId);
        // $this->db->where('attendanceId>=',6444);
        $this->db->where('attendanceDate>=',$fromDate);
        $this->db->where('attendanceStatus',$status);
        $query = $this->db->get();
        $result = $query->result();
        //echo "<pre>";print_r($result);die();
        if($result){
            return $result;
        }
    }
}