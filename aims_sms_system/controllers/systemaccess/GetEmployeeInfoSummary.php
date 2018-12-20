<?php
/**
 * Created by PhpStorm.
 * User: Adventure-Soft
 * Date: 20-Jun-18
 * Time: 5:25 PM
 */

class GetEmployeeInfoSummary extends MY_Controller {


    //put your code here
    public function __construct() {
        parent::__construct();
        //$this->my_admin();
        //$this->load->model('admin/examtype/ExamTypeModleAdmin', 'ExamTypeModleAdmin');
    }

    public function index()
    {

        $this->db->select('EIN');
        $this->db->from('institute');
        $ein=$this->db->get()->row_array();

        $current_time=time();
        $d=date("Y-m-d",$current_time);
        $date = "'$d'";
        $from_date = strtotime($d);
        $to_date = $from_date+86400;

        $ein_code = $ein['EIN'];
        $url = base_url();

        $sql =  "SELECT ins.instituteId as institute_id, ins.instituteName as institute_name, ins.town, ins.city, ins.district, ins.Ein as EIN, '$url' as institute_url, districts.name_en as district_name,$date as today_date, COUNT(employee.emp_Id) as total_employee, CURRENT_TIMESTAMP() as entry_date_time,

                (SELECT COUNT(*)
                FROM(
                SELECT distinct employee_attendance.employeeId as eml_id
                FROM employee_attendance
                INNER JOIN employee ON employee.employeeId = employee_attendance.employeeId AND employee.employeeStatus=1 AND employee.gender=1
                WHERE employee_attendance.attendance_date=$date

                UNION

                SELECT distinct emp_event_log.emp_id as em_id
                FROM emp_event_log
                INNER JOIN employee ON employee.employeeId = emp_event_log.emp_id AND employee.employeeStatus=1 AND employee.gender=1
                WHERE emp_event_log.date_time between $from_date AND $to_date) as X) as present_male_employee,

                (SELECT COUNT(*)
                FROM(
                SELECT distinct employee_attendance.employeeId as eml_id
                FROM employee_attendance
                INNER JOIN employee ON employee.employeeId = employee_attendance.employeeId AND employee.employeeStatus=1 AND employee.gender=2
                WHERE employee_attendance.attendance_date=$date

                UNION

                SELECT distinct emp_event_log.emp_id as em_id
                FROM emp_event_log
                INNER JOIN employee ON employee.employeeId = emp_event_log.emp_id AND employee.employeeStatus=1 AND employee.gender=2
                WHERE emp_event_log.date_time between $from_date AND $to_date) as Y) as present_female_employee,

                (SELECT COUNT(e.gender) FROM employee as e where e.employeeStatus=1 and e.gender=1) as total_male_employee,
                (SELECT COUNT(em.gender) FROM employee as em where em.employeeStatus=1 and em.gender=2) as total_female_employee
                FROM institute as ins
                INNER JOIN districts ON districts.id=ins.district
                JOIN employee ON 1=1
                WHERE employee.employeeStatus = 1
                AND ins.Ein = $ein_code";

        $result=$this->db->query($sql)->row_array();
        echo '<pre>';
        print_r($result);exit;

        $url = 'http://smhschool.edu.bd/test_api_school';
        $params = array(
            'auth' => 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
            'from' => '2105',
            'to' => '47xxxxxxxx',
            'type' => 'text',
            'price' => 0,
            'data' => utf8_encode('Hello, world! (æøåÆØÅ)')
        );
//
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);

// This should be the default Content-type for POST requests
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/x-www-form-urlencoded"));

        $result = curl_exec($ch);
        if(curl_errno($ch) !== 0) {
            error_log('cURL error when connecting to ' . $url . ': ' . curl_error($ch));
        }
        curl_close($ch);
        echo '<pre>';
        print_r(json_decode($result));


















//        print_r($result);exit;

//        $dbServerName = "aimscrs.com";
//        $dbServerName = "184.154.45.10";
//        $dbUsername = "aimscrs_progr";
//        $dbPassword = "MrJ,I?+9cb(~";
//        $dbName = "aimscrs_central_database";


//        $url = 'http://smhschool.edu.bd/test_api_school';
//
//        $context = stream_context_create(array(
//            'http' => array(
//                'method' => 'POST',
//                'header' => 'Content-type: application/x-www-form-urlencoded\r\n',
//                'content' => http_build_query($params),
//                'timeout' => 60
//            )
//        ));
//
//        $resp = file_get_contents($url, FALSE, $context);
//        if ($resp === FALSE)
//        {
//            echo 'error';
//        }
//        else
//        {
//            echo $resp;
//        }






    }


}