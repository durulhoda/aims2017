<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*

 * Project Name: Aims

 * Author: Adventure Soft

 * Author url: http://www.adventure-soft.com

 */

class Studentsattendance extends MY_Controller {

    public function __construct() {

        parent::__construct();

        $this->my_admin();

        $this->load->model('admin/studentattendance/StudentattendanceModleAdmin', 'StudentattendanceModleAdmin');

        $this->load->model('admin/student/StudentModleAdmin', 'StudentModleAdmin');

        $this->load->model('admin/studentregistration/StudentregistrationModleAdmin', 'StudentregistrationModleAdmin');

        $this->load->model('admin/studentmarks/StudentmarksModleAdmin', 'StudentmarksModleAdmin');

        $this->load->model('admin/courseassign/CourseAssignModleAdmin', 'CourseAssignModleAdmin');

        $this->load->model('admin/program/ProgramModleAdmin', 'ProgramModleAdmin');

        $this->load->model('admin/result/Result_model_admin', 'rma');

    }



    public function index() {

        $data['Attendance'] = 'active';



        $this->load->view('system_path/admin/common/header_link'); // header Css link

        $this->load->view('system_path/admin/common/header'); // body header

        $this->load->view('system_path/admin/common/side_menu'); // side bar menu

        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu

        $this->load->view('system_path/admin/attendance/insertform'); // ...........body content page...........

        $this->load->view('system_path/admin/common/footer'); // footer & script link

        $this->load->view('system_path/jsquery'); // footer & script link

    }



    public function test($programOfferId = 0)

    {



        $sql = "

                SELECT

                    sinfo.firstName AS student_name,

                    t.*

                FROM

                (

                    (

                        SELECT

                            ps.studentId AS student_id,

                            e.a_date,

                            e.in_time,

                            e.out_time,

                            e.in_time_status,

                            e.out_time_status,

                            IF(e.a_date IS NULL,2,1) AS a_status,

                            '1' AS type

                        FROM

                            promotedstudent AS ps

                        LEFT JOIN 

                        (

                            SELECT 

                                el.student_id,

                                el.programOfferId,

                                DATE(FROM_UNIXTIME(el.date_time)) AS a_date,

                                TIME(MIN(FROM_UNIXTIME(el.date_time))) AS in_time,

                                TIME(MAX(FROM_UNIXTIME(el.date_time))) AS out_time,

                                IF(TIME(MIN(FROM_UNIXTIME(el.date_time))) >= '09:00:00', 'Late', 'Present') AS in_time_status,

                                IF(TIME(MIN(FROM_UNIXTIME(el.date_time))) >= '04:00:00', 'Early', 'Present') AS out_time_status

                            FROM 

                                event_log AS el

                            JOIN 

                                (

                                    SELECT 

                                        distinct FROM_UNIXTIME(event_log.date_time)  AS date_time

                                    FROM 

                                        event_log

                                ) e2

                            WHERE 

                                FROM_UNIXTIME(el.date_time) = e2.date_time

                            GROUP BY 

                                el.student_id,

                                DATE(e2.date_time)

                        ) AS e

                            ON ps.studentId = e.student_id AND e.programOfferId = {$programOfferId}

                        WHERE

                            ps.programOfferId = {$programOfferId}

                    )

                    UNION

                    (

                        SELECT

                            sa.studentId AS student_id,

                            TRIM(sa.attendanceDate) AS a_date,

                            '' AS in_time,

                            '' As out_time,

                            '' AS in_time_status,

                            '' AS out_time_status,

                            sa.attendanceStatus AS a_status,

                            '2' AS type

                        FROM

                            studentattendance AS sa

                        GROUP BY

                            sa.studentId,

                            sa.attendanceDate

                    )

            ) AS t

                JOIN

                    student AS s ON t.student_id = s.studentId

                JOIN 

                    studentinfo AS sinfo ON s.applicationId = sinfo.applicationId

            GROUP BY

                t.student_id,

                t.a_date

            ORDER BY 

                t.a_date

        ";

        $records = $this->db->query($sql)->result();

        return $records;

        //echo '<pre>';print_r($records);exit;

    }



    public function getStudentAttendace($programOfferId = 0)

    {

        //echo "<pre>";print_r($programOfferId);die();

        $con = '';

        $studentId = trim($this->input->post('studentId', true));

        $fromDate = $this->input->post('fromDate', true);

        $toDate = $this->input->post('toDate', true);

        $status = $this->input->post('status', true);

        if ($studentId) {

            $con .= 'AND t.student_id = '.$studentId.'';

        }

        if ($status) {

            $con .= ' AND t.a_status = '.$status.'';

        }



        if ($fromDate && $toDate) {

            $fromDate = "'".date("Y-m-d", strtotime($fromDate))."'";

            $toDate = "'".date("Y-m-d", strtotime($toDate))."'";

            $con .= ' AND t.a_date >= '.$fromDate.'';

            $con .= ' AND t.a_date <= '.$toDate.'';

        }

        // print_r($studentId);

        // print_r($con);

        $sql = "

                SELECT

                    sinfo.firstName AS student_name,

                    t.*

                FROM

                (

                    (

                         SELECT 

                                el.student_id,

                                DATE(FROM_UNIXTIME(el.date_time)) AS a_date,

                                TIME(MIN(FROM_UNIXTIME(el.date_time))) AS in_time,

                                TIME(MAX(FROM_UNIXTIME(el.date_time))) AS out_time,

                                IF(TIME(MIN(FROM_UNIXTIME(el.date_time))) >= '09:00:00', 'Late', 'Present') AS in_time_status,

                                IF(TIME(MIN(FROM_UNIXTIME(el.date_time))) >= '04:00:00', 'Early', 'Present') AS out_time_status,

                                '1' AS a_status,

                                '1' AS type

                            FROM 

                                event_log AS el

                            JOIN 

                                (

                                    SELECT 

                                        distinct FROM_UNIXTIME(event_log.date_time)  AS date_time

                                    FROM 

                                        event_log

                                ) e2

                            WHERE 

                                FROM_UNIXTIME(el.date_time) = e2.date_time

                            AND 

                                el.programOfferId = {$programOfferId}

                            GROUP BY 

                                el.student_id,

                                DATE(e2.date_time)

                    )

                    UNION

                    (

                        SELECT

                            sa.studentId AS student_id,

                            TRIM(sa.attendanceDate) AS a_date,

                            '' AS in_time,

                            '' As out_time,

                            '' AS in_time_status,

                            '' AS out_time_status,

                            sa.attendanceStatus AS a_status,

                            '2' AS type

                        FROM

                            studentattendance AS sa

                        WHERE 

                            sa.programOfferId = {$programOfferId}

                        GROUP BY

                            sa.studentId,

                            sa.attendanceDate

                    )

            ) AS t

                JOIN

                    student AS s ON t.student_id = s.studentId

                JOIN 

                    studentinfo AS sinfo ON s.applicationId = sinfo.applicationId

                WHERE 

                    1=1

                    {$con}

            GROUP BY

                t.student_id,

                t.a_date

            ORDER BY 

                t.a_date

        ";

        $records = $this->db->query($sql)->result();

        //print_r($this->db->last_query($records));exit;

        return $records;

        // echo '<pre>';print_r($records);exit;

    }



    public function studentAttendaceSearch(){

        $data = $this->input->post('data');

        $studentId = trim($this->input->post('studentId', true));

        $fromDate = $this->input->post('fromDate', true);

        $toDate = $this->input->post('toDate', true);

        $status = $this->input->post('status', true);

        $data_programOfferId = $this->ProgramModleAdmin->getProgramOfferedIdForAttendance($data);

        $data['result'] = $this->StudentattendanceModleAdmin->getStudentAttendanceByProgramOfferId($data_programOfferId,$fromDate, $toDate);

        if($data['result']){

            $this->load->view('system_path/admin/common/header_link'); // header Css link

            $this->load->view('system_path/admin/common/header'); // body header

            $this->load->view('system_path/admin/common/side_menu'); // side bar menu

            $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu

            $this->load->view('system_path/admin/attendance/attendance', $data); // ...........body content page...........

            $this->load->view('system_path/admin/common/footer'); // footer & script link

            $this->load->view('system_path/jsquery'); // footer & script link

        }

        $this->load->view('system_path/admin/common/header_link'); // header Css link

        $this->load->view('system_path/admin/common/header'); // body header

        $this->load->view('system_path/admin/common/side_menu'); // side bar menu

        $this->load->view('system_path/admin/common/top_menu'); // top bar menu

        $this->load->view('system_path/admin/attendance/attendance'); // ...........body content page...........

        $this->load->view('system_path/admin/common/footer'); // footer & script link

        $this->load->view('system_path/jsquery'); // footer & script link

    }



    public function getStudentAbsent($programOfferId = 0, $type = 2)

    {

        $today = "'".DATE('Y-m-d')."'";

        //$today = "'2017-09-13'";



        $msql = "

            SELECT

                t.studentId AS student_id,

                sinfo.firstName AS student_name,

                sinfo.fatherPhone AS father_phone,

                t.type

            FROM

                (

                    (

                        SELECT

                            ps.studentId,

                            '1' AS type

                        FROM

                            promotedstudent AS ps

                        LEFT JOIN

                            event_log AS el 

                            ON ps.studentId = el.student_id AND DATE(FROM_UNIXTIME(el.date_time)) = {$today}

                        WHERE

                            ps.programOfferId = {$programOfferId}

                        AND 

                            el.student_id IS NULL

                    )

                    UNION

                    (

                        SELECT

                            sa.studentId,

                            '2' AS type

                        FROM

                            studentattendance AS sa

                        WHERE

                            sa.programOfferId = {$programOfferId}

                        AND

                            sa.attendanceDate = {$today}

                        AND 

                            sa.attendanceStatus = 2

                    )

                ) AS t

                JOIN

                    student AS s ON t.studentId = s.studentId

                JOIN 

                    studentinfo AS sinfo ON s.applicationId = sinfo.applicationId

                WHERE 

                    t.type = {$type}

        ";

        $records = $this->db->query($msql)->result();

        // echo '<pre>';print_r($records);exit;

        return $records;

    }



    public function studentAbsent()

    {

        ini_set('memory_limit', '-1');

        $data['records'] = [];

        $this->checkValidation();

        if ($this->form_validation->run() == FALSE) {



        } else {

            if ($_POST) {

                $programOfferId = 0;

                $data = $this->input->post('data', TRUE);

                $data['programOfferId'] = getProgramOfferId($data);

                if ($data['programOfferId']) {

                    $programOfferId = ($data['programOfferId']['programOfferId']) ? $data['programOfferId']['programOfferId'] : 0;

                }

                if ($programOfferId) {

                    // print_r($programOfferId);exit;

                    $type = $this->input->post('type');

                    $data['institute_info'] = $this->rma->getInstituteInfo();

                    $data['records'] = $this->getStudentAbsent($programOfferId, $type);

                } else {

                    $sdata['errormessage'] = 'Inserted Enrollment information is not offered yet!';

                    $this->session->set_userdata($sdata);

                    redirect(admin_Url() . "/studentAttendace");

                }

            }

        }

        $this->load->view('system_path/admin/common/header_link'); // header Css link

        $this->load->view('system_path/admin/common/header'); // body header

        $this->load->view('system_path/admin/common/side_menu'); // side bar menu

        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu

        $this->load->view('system_path/admin/attendance/absent', $data); // ...........body content page...........

        $this->load->view('system_path/admin/common/footer'); // footer & script link

        $this->load->view('system_path/jsquery'); // footer & script link

    }



    public function sendAbsentMessage()

    {

        $student_id = $this->input->post('student_id', TRUE);

        $father_phone = $this->input->post('father_phone', TRUE);

        $serial = $this->input->post('serial', TRUE);

        $phone = '';

        $count = count($serial);

        if ($count > 0) {

            for ($i=0; $i < $count ; $i++) {

                $stu_id = $serial[$i]-1;

                if ($father_phone[$stu_id]) {

                    $phone .= substr($father_phone[$stu_id],strpos($father_phone[$stu_id],"0")).",";

                }

            }

        }



        if ($phone && !empty($phone)) {

            //$phone = "8801921821909,8801737697395,";

            echo '<form action="https://api.mobireach.com.bd/SendTextMultiMessage" method="post" name="member_signup">

            <input type="text" name="Username" value="advsoft" />

            <input type="text" name="Password" value="Fima@302124" />    

            <input type="text" name="From" value="8801847050122"/>

            <input type="text" name="To" value="'.$phone.'" />

            <input type="text" name="Message" value="testmessage"/>

            <input type="submit" value="Submit" /> 

        </form>



        <script type="text/javascript">

            window.onload = function(){

        document.forms["member_signup"].submit();

        }

        </script> ';

        }

    }



    public function test1()

    {

        $phone = "8801921821909";

        //echo substr($phone,strpos($phone,"0"));

        echo substr($phone,2);

        //  print_r($phone);

    }



    public function studentAttendace()
    {

        $data['active'] = 'Student Attendence';

        $data['institute_info'] = $this->rma->getInstituteInfo();

        ini_set('memory_limit', '-1');
        $data = [];

        $data['records'] = [];


        $data['institute_info'] = $this->rma->getInstituteInfo();

        $this->checkValidation();

        if ($this->form_validation->run() == FALSE)
        {

        }
        else
        {
            if($_POST)
            {
                //$programOfferId = 0;
                $data = $this->input->post('data', TRUE);

                //get program_offer_Id
                $items = get_Program_offer_Id($data);

                if($items)
                {
                    foreach ($items as $item)
                    {
                        $data['programOfferId'][] = $item['programOfferId'];
                    }
                    $data['records'] = $this->getStudentAttendace_new($data);
                }
                else
                {
                    $sdata['errormessage'] = 'Inserted Enrollment information is not offered yet!';
                    $this->session->set_userdata($sdata);
                    redirect(admin_Url() . "/studentsattendance/studentAttendace");
                }
                $data['institute_info'] = $this->rma->getInstituteInfo();
            }
        }

        $this->load->view('system_path/admin/common/header_link'); // header Css link

        $this->load->view('system_path/admin/common/header'); // body header

        $this->load->view('system_path/admin/common/side_menu'); // side bar menu

        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu

        $this->load->view('system_path/admin/attendance/attendance', $data);

        $this->load->view('system_path/admin/common/footer'); // footer & script link

        $this->load->view('system_path/jsquery'); // footer & script link

    }

    public function getStudentAttendace_new($data)
    {
        if($data['fromDate'])
        {
            $data['fromDate_int'] = strtotime($data['fromDate']);
            $data['fromDate1'] = date('Y-m-d',$data['fromDate_int']);
        }
        if ($data['toDate'])
        {
            $data['toDate_int'] = strtotime($data['toDate'])+86399;
            $data['toDate1'] = date('Y-m-d',$data['toDate_int']);
        }

//        echo '<pre>';
//        print_r($data);exit;

        $student_list = $this->StudentattendanceModleAdmin->get_student_attendance_from_both_table($data);

//        echo '<pre>';
//        print_r($student_list);exit;

        $dates = array();
        if(isset($student_list['manual']))
        {
            foreach ($student_list['manual'] as $sl) {
                $dates[] = $sl['attendanceDate'];
            }
        }
        if(isset($student_list['machine']))
        {
            foreach ($student_list['machine'] as $sl) {
                $dates[] = $sl['attendanceDate'];
            }
        }

        $dates = array_unique($dates);
        $attendance_list=array();
        foreach($dates as $date)
        {
            if(isset($student_list['manual']))
            {
                foreach($student_list['manual'] as $manual)
                {
                    if($manual['attendanceDate']==$date)
                    {
                        $attendance_list[]=$manual;
                    }
                }
            }
            if(isset($student_list['machine']))
            {
                foreach($student_list['machine'] as $machine)
                {
                    if($machine['attendanceDate']==$date)
                    {
                        $attendance_list[] = $machine;
                    }
                }
            }
        }
        // echo '<pre>';
        // print_r($attendance_list);exit;
        return $attendance_list;
    }

    public function checkValidation()

    {

        $this->load->helper(array('form', 'url'));

        $this->load->library('form_validation');



        $config = array(

            array(

                'field' => 'data[sessionId]',

                'label' => 'Session',

                'rules' => 'required'

            )

        );

        $this->form_validation->set_rules($config);

    }

    public function searchstudent() {



        ini_set('memory_limit', '-1');



        $this->load->helper(array('form', 'url'));

        $this->load->library('form_validation');



        $config = array(

            array(

                'field' => 'data[programId]',

                'label' => 'Program',

                'rules' => 'required'

            ),

            array(

                'field' => 'data[mediumId]',

                'label' => 'Medium',

                'rules' => 'required'

            ),

            array(

                'field' => 'data[sectionId]',

                'label' => 'Section',

                'rules' => 'required'

            ),

            array(

                'field' => 'data[groupId]',

                'label' => 'Group',

                'rules' => 'required'

            ),

            array(

                'field' => 'data[shiftId]',

                'label' => 'Shift',

                'rules' => 'required'

            ),

            array(

                'field' => 'data[sessionId]',

                'label' => 'Session',

                'rules' => 'required'

            )

        );

        $this->form_validation->set_rules($config);



        if ($this->form_validation->run() == FALSE) {

            $sdata['errormessage'] = "Required Field Missing";

            $this->session->set_userdata($sdata);

            $data['Attendance'] = 'active';

            $this->load->view('system_path/admin/common/header_link'); // header Css link

            $this->load->view('system_path/admin/common/header'); // body header

            $this->load->view('system_path/admin/common/side_menu'); // side bar menu

            $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu

            $this->load->view('system_path/admin/attendance/insertform'); // ...........body content page...........

            $this->load->view('system_path/admin/common/footer'); // footer & script link

            $this->load->view('system_path/jsquery'); // footer & script link

        } else {

            $data = $this->input->post('data', TRUE);



            $data['programOfferId'] = getProgramOfferId($data);

            if ($data['programOfferId'] != 0) {

                $data['studentlist'] = $this->StudentModleAdmin->searchCurrentStudent($data);

                if (!empty($data['studentlist'])) {

                    $data['Attendance'] = 'active';

                    $this->load->view('system_path/admin/common/header_link'); // header Css link

                    $this->load->view('system_path/admin/common/header'); // body header

                    $this->load->view('system_path/admin/common/side_menu'); // side bar menu

                    $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu

                    $this->load->view('system_path/admin/attendance/studentlistbydate'); // ...........body content page...........

                    $this->load->view('system_path/admin/common/footer'); // footer & script link

                    $this->load->view('system_path/jsquery'); // footer & script link

                } else {

                    $sdata['errormessage'] = 'No student found inserted enrollment information';

                    $this->session->set_userdata($sdata);

                    redirect(admin_Url() . "/studentsattendance");

                }

            } else {

                $sdata['errormessage'] = 'Inserted Enrollment information is not offered yet!';

                $this->session->set_userdata($sdata);

                redirect(admin_Url() . "/studentsattendance");

            }

        }

    }



    // next function is for attendance insert by date when any one need attendance by date....   

    public function insertattendance() {

        // echo '<pre>';print_r($_POST);exit;



        $studentId = $this->input->post('studentId');

        $serial = $this->input->post('serial');

        $attendanceStatus = $this->input->post('attendanceStatus');

        if (!empty($serial)) {

            $ab = $serial;



            for ($i = 0; $i < count($ab); $i++) {



                $find_value = $serial[$i] - 1;



                $data['studentId'] = $studentId[$find_value];

                $data['attendanceStatus'] = $attendanceStatus[$find_value];

                $data['programOfferId'] = $this->input->post('programOfferId', true);

                $data['attendanceDate'] = date("Y-m-d", strtotime(trim($this->input->post('attendanceDate', true))));



                $results = $this->StudentattendanceModleAdmin->checkattendance($data['studentId'], $data['attendanceDate']);



                if ($results == TRUE) {

                    $sdata = array();

                    $sdata['message'] = "Attendence Already done";

                    $this->session->set_userdata($sdata);

                    redirect(admin_Url() . "/studentsattendance");

                } elseif ($results == FALSE) {

                    //   print_r($data);

                    $this->StudentattendanceModleAdmin->saveStudentattendancess($data);

                }

            }

            //      die();

            $sdata['message'] = 'Attendance Successfull inserted';

            $this->session->set_userdata($sdata);



            redirect(admin_Url() . "/studentsattendance");

        } else {

            $sdata['errormessage'] = 'Student Information not found';

            $this->session->set_userdata($sdata);



            redirect(admin_Url() . "/studentsattendance");

        }

    }



    // next function is for attendance insert by date when any one need attendance by date....      

    public function studentattendancesearch() {

        $data['Attendance'] = 'active';

        $this->load->view('system_path/admin/common/header_link'); // header Css link

        $this->load->view('system_path/admin/common/header'); // body header

        $this->load->view('system_path/admin/common/side_menu'); // side bar menu

        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu

        $this->load->view('system_path/admin/attendance/searchstudentattendance'); // ...........body content page...........

        $this->load->view('system_path/admin/common/footer'); // footer & script link

        $this->load->view('system_path/jsquery'); // footer & script link

    }



    // next function is for attendance insert by date when any one need attendance by date....     

    public function searchattendanceinfo() {



        $data = $this->input->post('data', TRUE);

        if (empty($data['studentId'])) {

            $sdata['errormessage'] = 'Enter Student Id';

            $this->session->set_userdata($sdata);

            redirect(admin_Url() . "/studentsattendance/studentattendancesearch");

        } else {

            $data['attendancelist'] = $this->StudentattendanceModleAdmin->getstudentattendance($data);



            $data['studentinfo'] = $this->StudentModleAdmin->getstudentNameInfo($data['studentId']);

            if (!empty($data['attendancelist'])) {

                $data['Attendance'] = 'active';

                $this->load->view('system_path/admin/common/header_link'); // header Css link

                $this->load->view('system_path/admin/common/header'); // body header

                $this->load->view('system_path/admin/common/side_menu'); // side bar menu

                $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu

                $this->load->view('system_path/admin/attendance/searchstudentattendance', $data); // ...........body content page...........

                $this->load->view('system_path/admin/common/footer'); // footer & script link

                $this->load->view('system_path/jsquery'); // footer & script link

            } else {



                $sdata['errormessage'] = 'Attendance Information Not Found';

                $this->session->set_userdata($sdata);

                redirect(admin_Url() . "/studentsattendance/studentattendancesearch");

            }

        }

    }



    //###################Student Finger Attendence#################



    public function searchfingerattendanceinfo() {

        //  echo '<pre>';print_r($_POST);

        $data = $this->input->post('data', TRUE);

        if (empty($data['studentId'])) {

            $sdata['errormessage'] = 'Enter Student Id';

            $this->session->set_userdata($sdata);

            redirect(admin_Url() . "/studentsattendance/studentattendancesearch");

        } else {

            $data['attendancelist'] = $this->StudentattendanceModleAdmin->getfingerstudentattendance($data);



            $data['studentinfo'] = $this->StudentModleAdmin->getfingerstudentNameInfo($data['studentId']);

            // echo '<pre>';print_r($data);exit;

            if (!empty($data['attendancelist']) && !empty($data['studentinfo'])) {

                $data['Attendance'] = 'active';

                $this->load->view('system_path/admin/common/header_link'); // header Css link

                $this->load->view('system_path/admin/common/header'); // body header

                $this->load->view('system_path/admin/common/side_menu'); // side bar menu

                $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu

                $this->load->view('system_path/admin/attendance/fingerprintstudent', $data); // ...........body content page...........

                $this->load->view('system_path/admin/common/footer'); // footer & script link

                $this->load->view('system_path/jsquery'); // footer & script link

            } else {

                $sdata['errormessage'] = 'Attendance Information Not Found';

                $this->session->set_userdata($sdata);

                redirect(admin_Url() . "/studentsattendance/studentattendancesearch");

            }

        }

    }







    // Search by attendence status



    public function searchbyattendancestatus() {





        ini_set('memory_limit', '-1');

        $this->load->helper(array('form', 'url'));

        $this->load->library('form_validation');



        $config = array(

            array(

                'field' => 'data[attendanceStatus]',

                'label' => 'From Date',

                'rules' => 'required'

            ),

            array(

                'field' => 'data[fromDate]',

                'label' => 'From Date',

                'rules' => 'required'

            ),

            array(

                'field' => 'data[toDate]',

                'label' => 'To Date',

                'rules' => 'required'

            )

        );

        $this->form_validation->set_rules($config);



        if ($this->form_validation->run() == FALSE) {

            $sdata['errormessage'] = "Please Fill Up all field";

            $this->session->set_userdata($sdata);

            redirect(admin_Url() . "/studentsattendance/studentattendancesearch", "refresh");

        } else {

            $data = $this->input->post('data', TRUE);



            $data['attendanceStatus'] = $this->StudentattendanceModleAdmin->getstudentattendancestatus($data);

//             echo '<pre>';

//             print_r($data['attendanceStatus']);

//             echo '</pre>';



            if (!empty($data['attendanceStatus'])) {

                //$data['attendancelist'] = $this->StudentattendanceModleAdmin->getstudentattendancebystatus($data);

                $data['Attendance'] = 'active';

                $this->load->view('system_path/admin/common/header_link'); // header Css link

                $this->load->view('system_path/admin/common/header'); // body header

                $this->load->view('system_path/admin/common/side_menu'); // side bar menu

                $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu

                $this->load->view('system_path/admin/attendance/student_list_by_attendance_status', $data); // ...........body content page...........

                $this->load->view('system_path/admin/common/footer'); // footer & script link

                $this->load->view('system_path/jsquery'); // footer & script link

            } else {

                $sdata['errormessage'] = "No Attendance Found";

                $this->session->set_userdata($sdata);

                redirect(admin_Url() . "/studentsattendance/studentattendancesearch", "refresh");



            }

        }

    }



    public function searchattendancebyclass() {



        ini_set('memory_limit', '-1');

        $this->load->helper(array('form', 'url'));

        $this->load->library('form_validation');



        $config = array(

            array(

                'field' => 'data[programId]',

                'label' => 'Program',

                'rules' => 'required'

            ),

            array(

                'field' => 'data[mediumId]',

                'label' => 'Medium',

                'rules' => 'required'

            ),

            array(

                'field' => 'data[sectionId]',

                'label' => 'Section',

                'rules' => 'required'

            ),

            array(

                'field' => 'data[groupId]',

                'label' => 'Group',

                'rules' => 'required'

            ),

            array(

                'field' => 'data[shiftId]',

                'label' => 'Shift',

                'rules' => 'required'

            ),

            array(

                'field' => 'data[sessionId]',

                'label' => 'Session',

                'rules' => 'required'

            ),

            array(

                'field' => 'data[fromDate]',

                'label' => 'From Date',

                'rules' => 'required'

            ),

            array(

                'field' => 'data[toDate]',

                'label' => 'To Date',

                'rules' => 'required'

            )

        );

        $this->form_validation->set_rules($config);



        if ($this->form_validation->run() == FALSE) {

            $sdata['errormessage'] = "Please Fill Up all field";

            $this->session->set_userdata($sdata);

            redirect(admin_Url() . "/studentsattendance/studentattendancesearch", "refresh");

        } else {

            $data = $this->input->post('data', TRUE);

            $data['programOfferId'] = $this->ProgramModleAdmin->getProgramOfferId($data);



            if (!empty($data['programOfferId'])) {

                $data['attendancelist'] = $this->StudentattendanceModleAdmin->getstudentattendancebyclass($data);

                if (!empty($data['attendancelist'])) {

                    $data['Attendance'] = 'active';

                    $this->load->view('system_path/admin/common/header_link'); // header Css link

                    $this->load->view('system_path/admin/common/header'); // body header

                    $this->load->view('system_path/admin/common/side_menu'); // side bar menu

                    $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu

                    $this->load->view('system_path/admin/attendance/student_list_bydate', $data); // ...........body content page...........

                    $this->load->view('system_path/admin/common/footer'); // footer & script link

                    $this->load->view('system_path/jsquery'); // footer & script link

                } else {

                    $sdata['errormessage'] = "No Attendance Found";

                    $this->session->set_userdata($sdata);

                    redirect(admin_Url() . "/studentsattendance/studentattendancesearch", "refresh");

                }

            } else {

                $sdata['errormessage'] = "Classoffer Information is not offer yet";

                $this->session->set_userdata($sdata);

                redirect(admin_Url() . "/studentsattendance/studentattendancesearch", "refresh");

            }

        }

    }



    public function searchattendancebyinstitute() {



        ini_set('memory_limit', '-1');

        $this->load->helper(array('form', 'url'));

        $this->load->library('form_validation');



        $config = array(

            array(

                'field' => 'data[fromDate]',

                'label' => 'From Date',

                'rules' => 'required'

            ),

            array(

                'field' => 'data[toDate]',

                'label' => 'To Date',

                'rules' => 'required'

            )

        );

        $this->form_validation->set_rules($config);



        if ($this->form_validation->run() == FALSE) {

            $sdata['errormessage'] = "Please Fill Up all field";

            $this->session->set_userdata($sdata);

            redirect(admin_Url() . "/studentsattendance/studentattendancesearch", "refresh");

        } else {

            $data = $this->input->post('data', TRUE);

            //$data['programOfferId'] = $this->ProgramModleAdmin->getProgramOfferId($data);



            if (!empty($data['fromDate']) && !empty($data['toDate'])) {

                $data['attendancelist'] = $this->StudentattendanceModleAdmin->getstudentattendancebyinstitute($data);

                if (!empty($data['attendancelist'])) {

                    $data['Attendance'] = 'active';

                    $this->load->view('system_path/admin/common/header_link'); // header Css link

                    $this->load->view('system_path/admin/common/header'); // body header

                    $this->load->view('system_path/admin/common/side_menu'); // side bar menu

                    $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu

                    $this->load->view('system_path/admin/attendance/student_list_by_date_institute', $data); // ...........body content page...........

                    $this->load->view('system_path/admin/common/footer'); // footer & script link

                    $this->load->view('system_path/jsquery'); // footer & script link

                } else {

                    $sdata['errormessage'] = "No Attendance Found";

                    $this->session->set_userdata($sdata);

                    redirect(admin_Url() . "/studentsattendance/studentattendancesearch", "refresh");

                }

            } else {

                $sdata['errormessage'] = "Classoffer Information is not offer yet";

                $this->session->set_userdata($sdata);

                redirect(admin_Url() . "/studentsattendance/studentattendancesearch", "refresh");

            }

        }

    }



    // Finger Print full institute attendence Search



    public function searchfingerattendancebyinstitute() {



        ini_set('memory_limit', '-1');

        $this->load->helper(array('form', 'url'));

        $this->load->library('form_validation');



        $config = array(

            array(

                'field' => 'data[fromDate]',

                'label' => 'From Date',

                'rules' => 'required'

            ),

            array(

                'field' => 'data[toDate]',

                'label' => 'To Date',

                'rules' => 'required'

            )

        );

        $this->form_validation->set_rules($config);



        if ($this->form_validation->run() == FALSE) {

            $sdata['errormessage'] = "Please Fill Up all field";

            $this->session->set_userdata($sdata);

            redirect(admin_Url() . "/studentsattendance/studentattendancesearch", "refresh");

        } else {

            $data = $this->input->post('data', TRUE);

            //$data['programOfferId'] = $this->ProgramModleAdmin->getProgramOfferId($data);



            if (!empty($data['fromDate']) && !empty($data['toDate'])) {

                $data['attendancelist'] = $this->StudentattendanceModleAdmin->getfingerstudentattendancebyinstitute($data);

                if (!empty($data['attendancelist'])) {

                    $data['Attendance'] = 'active';

                    $this->load->view('system_path/admin/common/header_link'); // header Css link

                    $this->load->view('system_path/admin/common/header'); // body header

                    $this->load->view('system_path/admin/common/side_menu'); // side bar menu

                    $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu

                    $this->load->view('system_path/admin/attendance/searchfingerstudentattendance', $data); // ...........body content page...........

                    $this->load->view('system_path/admin/common/footer'); // footer & script link

                    $this->load->view('system_path/jsquery'); // footer & script link

                } else {

                    $sdata['errormessage'] = "No Attendance Found";

                    $this->session->set_userdata($sdata);

                    redirect(admin_Url() . "/studentsattendance/studentattendancesearch", "refresh");

                }

            } else {

                $sdata['errormessage'] = "Classoffer Information is not offer yet";

                $this->session->set_userdata($sdata);

                redirect(admin_Url() . "/studentsattendance/studentattendancesearch", "refresh");

            }

        }

    }











    public function delete_attendance($id) {

        $id = (int) $id;

        $dlt = $this->StudentattendanceModleAdmin->delete_attendance($id);

        if ($dlt) {

            $sdata['message'] = 'Attendance information Deleted';

            $this->session->set_userdata($sdata);

            redirect(admin_Url() . "/studentsattendance/studentattendancesearch");

        } else {

            $sdata['message'] = 'Attendance information Not Deleted';

            $this->session->set_userdata($sdata);

            redirect(admin_Url() . "/studentsattendance/studentattendancesearch");

        }

    }



    public function studentattendancelist() {

        ini_set('memory_limit', '-1');



        $this->load->helper(array('form', 'url'));

        $this->load->library('form_validation');



        $config = array(

            array(

                'field' => 'data[programLevel]',

                'label' => 'Class Level',

                'rules' => 'required'

            ),

            array(

                'field' => 'data[programId]',

                'label' => 'Program',

                'rules' => 'required'

            ),

            array(

                'field' => 'data[mediumId]',

                'label' => 'Medium',

                'rules' => 'required'

            ),

            array(

                'field' => 'data[sectionId]',

                'label' => 'Section',

                'rules' => 'required'

            ),

            array(

                'field' => 'data[groupId]',

                'label' => 'Group',

                'rules' => 'required'

            ),

            array(

                'field' => 'data[shiftId]',

                'label' => 'Shift',

                'rules' => 'required'

            ),

            array(

                'field' => 'data[sessionId]',

                'label' => 'Session',

                'rules' => 'required'

            )

        );



        $this->form_validation->set_rules($config);



        if ($this->form_validation->run() == FALSE) {

            $data['student'] = 'active';

            $this->load->view('system_path/admin/common/header_link'); // header Css link

            $this->load->view('system_path/admin/common/header'); // body header

            $this->load->view('system_path/admin/common/side_menu'); // side bar menu

            $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu

            $this->load->view('system_path/admin/student/studentsearch'); // ...........body content page...........

            $this->load->view('system_path/admin/common/footer'); // footer & script link

            $this->load->view('system_path/jsquery'); // footer & script link

        } else {

            $data = $this->input->post('data', TRUE);

            $data['programOfferId'] = $this->ProgramModleAdmin->getProgramOfferId($data);



            if (!empty($data['programOfferId'])) {



                $data['studentlist'] = $this->StudentModleAdmin->searchRegisteredStudent($data);

                // print_r($data['studentlist']); die();



                if (!empty($data['studentlist'])) {

                    if (isset($_POST['search'])) {

                        $data['student'] = 'active';

                        $this->load->view('system_path/admin/common/header_link'); // header Css link

                        $this->load->view('system_path/admin/common/header'); // body header

                        $this->load->view('system_path/admin/common/side_menu'); // side bar menu

                        $this->load->view('system_path/admin/common/top_menu', $data); // top bar menu

                        $this->load->view('system_path/admin/student/student_list', $data); // ...........body content page...........

                        $this->load->view('system_path/admin/common/footer'); // footer & script link

                        $this->load->view('system_path/jsquery'); // footer & script link

                    } elseif (isset($_POST['print'])) {

                        $this->load->view('system_path/admin/common/header_link'); // header Css link

                        $this->load->view('system_path/admin/student/printstudentlist', $data); // ...........body content page...........

                        $this->load->view('system_path/admin/common/footer'); // footer & script link  

                    } else {

                        $sdata['errormessage'] = 'Student Not Found';

                        $this->session->set_userdata($sdata);

                        redirect(admin_Url() . "/student");

                    }

                } else {

                    $sdata['errormessage'] = 'No student found inserted enrollment information';

                    $this->session->set_userdata($sdata);

                    redirect(admin_Url() . "/student");

                }

            } else {

                $sdata['errormessage'] = 'Inserted Enrollment information is not offered yet!';

                $this->session->set_userdata($sdata);

                redirect(admin_Url() . "/student");

            }

        }

    }



    public function printStudentList($programofferid) {

        $datax['programOfferId'] = (int) $programofferid;

        $datax = $this->ProgramModleAdmin->getofferProgramInfoById($datax['programOfferId']);

        if (!empty($datax)) {

            $data = array(

                'sessionId' => $datax['sessionId'],

                'programLevel' => $datax['programLevel'],

                'programId' => $datax['programId'],

                'mediumId' => $datax['mediumId'],

                'shiftId' => $datax['shiftId'],

                'groupId' => $datax['groupId'],

                'programOfferId' => $datax['programOfferId']

            );

            $data['studentlist'] = $this->StudentModleAdmin->searchRegisteredStudent($data);

            if (!empty($data['studentlist'])) {

                $this->load->view('system_path/admin/common/header_link'); // header Css link

                $this->load->view('system_path/admin/student/printstudentlist', $data); // ...........body content page...........

                $this->load->view('system_path/admin/common/footer'); // footer & script link  

            } else {

                $sdata['errormessage'] = 'No Student Found';

                $this->session->set_userdata($sdata);

                redirect(admin_Url() . "/student");

            }

        } else {

            $sdata['errormessage'] = 'No Student Found';

            $this->session->set_userdata($sdata);

            redirect(admin_Url() . "/student");

        }

    }



    // next function is for attendance insert by subject when any one need attendance by subject....     

    public function searchattendanceview() {

        $data['title'] = "Applicant Search";

        $data = $this->input->post('data', TRUE);

        if (empty($data['studentId'])) {

            $sdata['message'] = 'Enter Student Id';

            $this->session->set_userdata($sdata);

            $this->load->view('templates/admin/common/header');

            $this->load->view('templates/admin/studentsattendance/studentattendancesearch', $data);

            $this->load->view('templates/admin/common/footer');

        } else {

            $data['attendancelist'] = $this->StudentattendanceModleAdmin->getstudentattendanceview($data);



            //      redirect('admin/studentsattendance/studentattendancesearch');

            $this->load->view('templates/admin/common/header');

            $this->load->view('templates/admin/studentsattendance/attendancelist', $data);



            $this->load->view('templates/admin/common/footer');

        }

    }







}