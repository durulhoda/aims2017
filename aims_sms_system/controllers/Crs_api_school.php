<?php

class Crs_api_school extends MY_Controller {


    public function __construct() {
        parent::__construct();
    }

    public function index()
    {
        $this->db->select('Ein');
        $this->db->from('institute');
        $ein=$this->db->get()->row_array();

        $current_time=time();
        $d=date("Y-m-d",$current_time);
        $date = "'$d'";
        $from_date = strtotime($d);
        $to_date = $from_date+86400;

        $ein_code = $ein['Ein'];
        $url = base_url();

        $sql =  "SELECT ins.instituteId as institute_id, ins.instituteName as institute_name, ins.town, ins.city, ins.district, ins.Ein as EIN, '$url' as institute_url, districts.name_en as district_name,$date as today_date, COUNT(employee.emp_Id) as total_employee, UNIX_TIMESTAMP(CURRENT_TIMESTAMP()) as entry_date_time,

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
        
        if($result)
        {
            $result['entry_date_time'] = date('Y-m-d H:i:s', $result['entry_date_time']+21600);
        }
        
        echo json_encode($result);
        
        //echo $_GET['callback'] . '('.json_encode($result).')';





    }


}