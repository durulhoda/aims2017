<?php
/**
 * Created by PhpStorm.
 * User: Adventure-Soft
 * Date: 9/27/18
 * Time: 1:01 PM
 */

class Pullattendancedata extends CI_Controller{

    public function __construct() {
        parent::__construct();
    }

    public function index()
    {
        //old
        //  $username = '01612302124';
        //  $password = 'ABCDabcd1234';
        // //$from = '+8801922626122';
        //  $from = 'Friend';
        // $msg = 'test for testing';
        // $sms_msg=urlencode($msg);
        // //$SMSText=urlencode($SMSText);
        // $GSM='8801820028799,8801999928721';
        // $number=urlencode($GSM);
        // $type='longSMS';

        // $url = "http://api.zaman-it.com/api/sendsms/plain?user=01612302124&password=ABCDabcd1234&sender=Friend&SMSText=$sms_msg&GSM=$GSM";


/**
        // echo $url;
        //$url = "http://api.zaman-it.com/api/sendsms/plain?user=01612302124&password=ABCDabcd1234&sender=Friend&SMSText=$sms_msg&GSM=$GSM";
        
        // echo $url;
        // exit;

        // $aimsurl='';
        // $urlL = "http://api.zaman-it.com/api/v3/sendsms/plain?";
        // $aimsurl.= '&user='.$username;
        // $aimsurl.= '&password='.$password;
        // $aimsurl.= '&sender='.$from;
        // $aimsurl.= '&SMSText='.urlencode($SMSText);
        // $aimsurl.= '&GSM='.urlencode($GSM);
        // $aimsurl.= '&type='.urlencode($type);
        // $urlFinal =  $urlL.$aimsurl;
        // $url=$urlFinal;


        $url="http://api.zaman-it.com/api/v3/sendsms/plain?user=01612302124&password=ABCDabcd1234&sender=Friend&SMSText=longsms&GSM=$GSM&type=longSMS";

        // echo $url;
        // exit;

        its not using

**/ 
       // $url="http://api.zaman-it.com/api/v3/sendsms/plain?user=01612302124&password=ABCDabcd1234&sender=Friend&SMSText=longsms&GSM=$GSM&type=longSMS";
       //  $authorization = base64_encode("$username:$password");
       //  $curl = curl_init();
       //  curl_setopt_array($curl, array(
       //      CURLOPT_URL => $url,
       //      CURLOPT_RETURNTRANSFER => true,
       //      CURLOPT_ENCODING => "",
       //      CURLOPT_MAXREDIRS => 10,
       //      CURLOPT_TIMEOUT => 30,
       //      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
       //      CURLOPT_CUSTOMREQUEST => "POST",
       //      //CURLOPT_POSTFIELDS => "{ 'messages':[ { 'from':'$from', 'to':[ '$from' ], 'text':'I Love You :* Call Me : 01734333992 Personal'] }",
       //      CURLOPT_HTTPHEADER => array(
       //          "accept: application/json",
       //          "authorization: Basic $authorization",
       //          "content-type: application/json"
       //      ),
       //  ));

       //  $response = curl_exec($curl);
       //  // echo '<pre>';
       //  // print_r($response);
       //  // exit;
       //  $err = curl_error($curl);
       //  curl_close($curl);

       //  if ($err)
       //  {
       //      echo 'not ok';
       //      echo "cURL Error #:" . $err;
       //      exit;
       //  }
       //  else
       //  {
       //      echo 'ok response';
       //      echo $response;
       //      exit;
       //  }

        $time =time();
        $this->db->select('cron_job_time.time');
        $this->db->from('cron_job_time');
        $result = $this->db->get()->row_array();
        // print_r($result);
        // exit;

        if($result)
        {
            $start_time = (int)$result['time'] + 1;
            $end_time=$time;
            $start = date("Y-m-d H:i:s",$start_time);
            $end = date("Y-m-d H:i:s",$end_time);
        }
        else
        {
            $start_time = $time-1800;
            $end_time=$time;
            $start = date("Y-m-d H:i:s",$start_time);
            $end = date("Y-m-d H:i:s",$end_time);
        }

        //api token is unique for all school     
        $api_token='547c-427d-1e07-2d80-f4a1-231c-dfc7-3aa4-13d3-70d6-c0a4-4143-87be-971f-f22a-aa77';
        $per_page=20000;
        $url = 'http://school-central-api.inovacetech.com/api/v1/logs/?';
        $link = $url.'start='.$start.'&end='.$end.'&api_token='.$api_token.'&per_page='.$per_page;
        if($this->callCURL($link))
        {
            if($result)
            {
                $this->db->set('time',$end_time);
                $this->db->where('id',1);
                $this->db->update('cron_job_time');
            }
            else
            {
                $a['time'] = $end_time;
                $this->db->insert('cron_job_time',$a);
            }
        }
        else
        {
            if($result)
            {
                $this->db->set('time',$end_time);
                $this->db->where('id',1);
                $this->db->update('cron_job_time');
            }
            else
            {
                $a['time'] = $end_time;
                $this->db->insert('cron_job_time',$a);
            }
        }
    }

    public function callCURL($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        $response = curl_exec($ch);
        $errors = curl_error($ch);
        $response_info = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close ($ch);

        $result['error'] = $errors;
        $result['response'] = $response;
        $data=json_decode($result['response']);

        // echo '<pre>';
        // print_r($data);
        // exit;
        // echo '<pre>';
        // print_r($data->data);
        // exit;
        if($data->data)
        {
            $this->data_analysis($data->data);
            return true;
        }
        else
        {
            return false;
        }
    }

    public function data_analysis($data)
    {
        foreach($data as $key => $val) {

            $arr = [
                'sync_time' => $val->sync_time, // device to server
                'logged_time' => $val->logged_time, // attendance time
                'type' => $val->type, // card or fingerprint
                'uid' => $val->uid, // unique id
                'device_identifier' => $val->device_identifier, // device id
                'location' => 'location', // location
                'person_identifier' => $val->person_identifier, // student id or employee id
                'rfid' => 'rfid', // card id
                'primary_display_text' => $val->primary_display_text, // first name
                'secondary_display_text' => $val->secondary_display_text // last name
            ];

            $this->db->insert('data', $arr);
            $se_id = explode("-",$val->person_identifier);
            $check = $this->checkEmployee($se_id[1]);
            $logged_time = strtotime($val->logged_time);
            if (!$check) {
                $this->studentFinger($se_id[1], $val->device_identifier, $logged_time);
            } else {
                //echo '2';exit;
                $this->employeeFinger($se_id[1], $val->device_identifier, $logged_time);
            }
        }
    }

    private function checkEmployee($employeeId = 0)
    {
        $check = false;
        $row = $this->db
            ->where('employeeId', $employeeId)
            ->get('employee')
            ->row();
        if ($row) {
            $check = true;
        }
        return $check;
    }

    private function studentFinger($studentId = 0, $device_id = 0, $date_time = "")
    {
        $programOfferId = 0;
        if ($studentId) {
            $programOfferId =$this->getLastProgramOfferId($studentId);
        }
        $insert_data = [
            'device_id' => $device_id,
            'student_id' => $studentId,
            'date_time' => $date_time,
            'programOfferId' => $programOfferId
        ];
        //echo '<pre>';print_r($insert_data);exit;
        if ($this->db->insert('event_log', $insert_data)) {
            $last_student_id = $this->getLastSmsId(1);
            // print_r($last_student_id);
            // echo $studentId;
            // exit;

            if ($last_student_id != $studentId) {
             //    echo 'done';
             //    print_r($last_student_id);
             // echo $studentId;
             // exit;
                $student_info = $this->getStudentInfo($studentId);

                 // echo $studentId;
                 // exit;
                // print_r($student_info);
                // exit;
                // echo '<pre>';print_r($student_info);exit;
                if ($student_info)
                {
                    $splitTime = $this->getStuentSplitTime($studentId);
                    $this->stuentMessage($student_info, $splitTime);
                }
            }
        }
        //$duplicate_check = $this->dublicateCheck();
    }

    private function stuentMessage($row = [], $splitTime)
    {
        // echo 'done';
        // echo $splitTime;

        // exit;

        //$splitTime <= '10:04:00'

        // echo 'done';
        // echo $splitTime;
        // exit;

        if($splitTime <= '10:04:00'){
            $to = $row['fatherPhone'];
            $message = "Dear Parents, Your Child ".$row['firstName'].", ID: " . $row['student_id'] .  " is Attend at Time : $splitTime In School. BAMMHS";
            $this->messageSend($to, $message, $row['student_id'], 1);

        }else if($splitTime >= '10:05:00' && $splitTime <= '10:30:59'){

            $to = $row['fatherPhone'];
            $message = "Dear Parents, Your Child ".$row['firstName'].", ID: " . $row['student_id'] .  " is Late at Time : $splitTime In School. BAMMHS";
            $this->messageSend($to, $message, $row['student_id'], 1);

        }else if($splitTime >= '13:00:00' && $splitTime <= '19:00:00'){
            $to = $row['fatherPhone'];
            $message = "Dear Parents, Your Child ".$row['firstName'].", ID: " . $row['student_id'] .  " is Out at Time : $splitTime In School. BAMMHS";
            $this->messageSend($to, $message, $row['student_id'], 1);
        }
    }

    private function getLastProgramOfferId($studentId = 0)
    {
        $row = $this->db
            ->select('programOfferId')
            ->from('promotedstudent')
            ->where('studentId',$studentId)
            ->order_by('promotionId','desc')
            ->get()->row_array();

        $programOfferId = isset($row['programOfferId']) ? $row['programOfferId'] : 0;
        return $programOfferId;
    }

    private function getLastSmsId($type = 1)
    {
        $row = $this->db
            ->where('type', $type)
            ->order_by('id','desc')
            ->get('lastsms')
            ->row();
        if ($row) {
            return $row->lastsms_student_id;
        }
        return 0;
    }

    private function getSchoolPhoneNo()
    {
        $row = $this->db
            ->select('personPhone')
            ->get('institute')
            ->row_array();
        $personPhone = isset($row['personPhone']) ? $row['personPhone'] : 0;
        return $personPhone;
    }

    private function getStudentInfo($studentId = 0)
    {
        // echo $studentId;

        /*Old Query Code*/
        // echo 'done student info';
        // exit;
        // $sql = "SELECT
        //         event_log.sl,
        //         event_log.device_id,
        //         event_log.student_id,
        //         from_unixtime(event_log.date_time) as ptime,
                
        //     FROM
        //         event_log
        //       JOIN
        //         student ON student.studentId = event_log.student_id
        //      JOIN
        //         studentinfo ON studentinfo.applicationId = student.applicationId
        //     WHERE
        //         event_log.student_id = ".$studentId."
        //     GROUP BY
        //       event_log.student_id";
        // $row = $this->db->query($sql)->row_array();
        // print_r($row);
        // exit;
        // return $row;

        /*Have to see from_unix time is working or not in below query*/

        $this->db->select('event_log.sl,event_log.device_id,event_log.student_id,event_log.date_time ptime,studentinfo.fatherPhone,studentinfo.firstName');
        $this->db->from('event_log');
      
        $this->db->join('student','student.studentId=event_log.student_id');
        $this->db->join('studentinfo','studentinfo.applicationId=student.applicationId');

        $this->db->where('event_log.student_id',$studentId);

    $this->db->group_by('event_log.student_id');

        $query_result=$this->db->get();
        $row=$query_result->row_array();
        return $row;
    }

    private function getEmpInfo($employeeId = 0)
    {
        // $sql = "SELECT
        //         emp_event_log.id,
        //         emp_event_log.device_id,
        //         emp_event_log.emp_id,
        //         from_unixtime(emp_event_log.date_time) as ptime,
        //         employee.firstName,
        //         employee.lastName
        //     FROM
        //         emp_event_log
        //     JOIN
        //         employee ON employee.employeeId = emp_event_log.emp_id
        //     WHERE
        //         emp_event_log.emp_id = ".$employeeId."
        //     GROUP BY
        //       emp_event_log.emp_id";
        // $row = $this->db->query($sql)->row_array();
        // return $row;



        $this->db->select('emp_event_log.id,emp_event_log.device_id,emp_event_log.emp_id,emp_event_log.date_time ptime,employee.firstName,employee.lastName');
        $this->db->from('emp_event_log');
      
        $this->db->join('employee','employee.employeeId=emp_event_log.emp_id');
        // $this->db->join('studentinfo','studentinfo.applicationId=student.applicationId');

        $this->db->where('emp_event_log.emp_id',$employeeId);

    $this->db->group_by('emp_event_log.emp_id');

        $query_result=$this->db->get();
        $row=$query_result->row_array();
        return $row;

    }

    private function getStuentSplitTime($studentId = 0)
    {
        $sql = "
            SELECT
                from_unixtime(event_log.date_time) as ptime
            FROM
                event_log
            WHERE
                student_id = {$studentId}
            ORDER BY
                sl DESC
            ";
        $row = $this->db->query($sql)->row_array();
        $timestamp = $row['ptime'];
        $splitTimeStamp = explode(" ",$timestamp);
        $splitTime = $splitTimeStamp[1];
        if (!$splitTime) {
            $splitTime = "";
        }
        return $splitTime;
    }

    private function getEmpSplitTime($employeeId = 0)
    {
        $sql = "
            SELECT
                from_unixtime(emp_event_log.date_time) as ptime
            FROM
                emp_event_log
            WHERE
                emp_id = {$employeeId}
            ORDER BY
                id DESC
            ";
        $row = $this->db->query($sql)->row_array();
        $timestamp = $row['ptime'];
        $splitTimeStamp = explode(" ",$timestamp);
        $splitTime = $splitTimeStamp[1];
        if (!$splitTime) {
            $splitTime = "";
        }
        return $splitTime;
    }

    private function employeeFinger($employeeId = 0, $device_id = 0, $date_time = "")
    {
        $insert_data = [
            'device_id' => $device_id,
            'emp_id' => $employeeId,
            'date_time' => $date_time
        ];
        if ($this->db->insert('emp_event_log', $insert_data)) {
            $last_emp_id = $this->getLastSmsId(2);
            if ($last_emp_id != $employeeId) {
                $emp_info = $this->getEmpInfo($employeeId);
                if ($emp_info) {
                    $splitTime = $this->getEmpSplitTime($employeeId);
                    $this->empMessage($emp_info, $splitTime);
                }
            }
        }
    }

    public function MessageSend($to="8801921821909", $message="Error", $emp_stu_id, $type = 1)
    {       
        $number='88'.$to;
        //  echo $to;
        // // echo $message;
        //  exit;

        /*old code for sending sms*/


        // $message = "hi";
        // $to = '01921821909';
        // $to = substr($to, strpos($to, '0'));
        // $server = "https://api.mobireach.com.bd/SendTextMultiMessage?";
        // $param = "Username=advsoft&Password=Fima@302124&From=8801847050122&To=88".$to."&Message=".$message."";
        // $param = str_replace(" ","%20",$param);
        // $url = $server.$param;
        // // print_r($url);exit;
        // $ch = curl_init();
        // curl_setopt($ch, CURLOPT_POST, false);
        // curl_setopt($ch, CURLOPT_URL, $url);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // $output = curl_exec($ch);
        // curl_close($ch);
        // if(!$output){
        //     $output =  file_get_contents($url);
        // }
        $sms_msg=urlencode($message);

         $url="http://api.zaman-it.com/api/v3/sendsms/plain?user=01612302124&password=ABCDabcd1234&sender=Friend&SMSText=$sms_msg&GSM=$number&type=longSMS";
        $authorization = base64_encode("$username:$password");
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            //CURLOPT_POSTFIELDS => "{ 'messages':[ { 'from':'$from', 'to':[ '$from' ], 'text':'I Love You :* Call Me : 01734333992 Personal'] }",
            CURLOPT_HTTPHEADER => array(
                "accept: application/json",
                "authorization: Basic $authorization",
                "content-type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        // echo '<pre>';
        // print_r($response);
        // exit;
        $err = curl_error($curl);
        curl_close($curl);

        // if ($err)
        // {
        //     echo 'not ok';
        //     echo "cURL Error #:" . $err;
        //     exit;
        // }
        // else
        // {
        //     echo 'ok response';
        //     echo $response;
        //     exit;
        // }

        $this->db
            ->where('type', $type)
            ->update('lastsms', ['lastsms_student_id' => $emp_stu_id]);
    }

    private function empMessage($row = [], $splitTime)
    {
        $full_name = $row['firstName']." ".$row['lastName'];
        $to = $this->getSchoolPhoneNo();
        if($splitTime <= '09:00:00'){
            $message = "Dear Sir, Employee Name: ".$full_name.", ID: " . $row['emp_id'] .  " is Present at Time : $splitTime In Our School.";
            $this->messageSend($to, $message, $row['emp_id'], 2);

        }else if ($splitTime >= '09:00:00' && $splitTime <= '12:59:59'){

            $message = "Dear Sir, Employee Name: ".$full_name.", ID: " . $row['emp_id'] .  " is Late at Time : $splitTime In Our School.";
            $this->messageSend($to, $message, $row['emp_id'], 2);

        }else if ($splitTime >= '13:00:00' && $splitTime <= '19:00:00'){
            $message = "Dear Sir, Employee Name: ".$full_name.", ID: " . $row['emp_id'] .  " is Out at Time : $splitTime In Our School.";
            $this->messageSend($to, $message, $row['emp_id'], 2);
        }
    }
}
?>