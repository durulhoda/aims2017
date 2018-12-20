<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Project Name: Aims
 * Author: Aminur Rahman
 * Author url: http://www.adventure-soft.com
 */

class Api extends CI_Controller {

    public function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Dhaka');
        $this->load->helper("url");
    }

    public function index()
    {

        // ,
        //                  {
        //                    "sync_time": "2017-07-17 03:14:56",
        //                    "logged_time": "2017-07-16 14:07:05",
        //                    "type": "fingerprint",
        //                    "uid": "e38ac95a5d67028683688c277accd98b",
        //                    "device_identifier": "0003",
        //                    "location": "Katabon",
        //                    "person_identifier": "22-1810118",
        //                    "rfid": "0002188386",
        //                    "primary_display_text": "Akash",
        //                    "secondary_display_text": "021123085"
        //                  }

        // {
        //                    "sync_time": "2017-07-17 03:14:56",
        //                    "logged_time": "2017-07-16 14:07:03",
        //                    "type": "fingerprint",
        //                    "uid": "41cb234bca0c46feeb3c4601b858f597",
        //                    "device_identifier": "0003",
        //                    "location": "Katabon",
        //                    "person_identifier": "22-201806008",
        //                    "rfid": "0002188386",
        //                    "primary_display_text": "Akash",
        //                    "secondary_display_text": "021123085"
        //                  }
        // $text = '
        //         {
        //          "payload":[
        //                                   {
        //                    "sync_time": "2017-07-17 03:14:56",
        //                    "logged_time": "2018-03-31 14:07:05",
        //                    "type": "fingerprint",
        //                    "uid": "e38ac95a5d67028683688c277accd98b",
        //                    "device_identifier": "0003",
        //                    "location": "Katabon",
        //                    "person_identifier": "22-201806009",
        //                    "rfid": "0002188386",
        //                    "primary_display_text": "Aminur",
        //                    "secondary_display_text": "Rahman"
        //                  }
        //          ]
        //         }
        //     ';
            //$payload = json_decode($text,true);
            $payload = json_decode(file_get_contents("php://input"), true);
            if ($payload['payload']) {
                 //$data = json_decode($payload,true);
                foreach($payload['payload'] as $key => $val) {
                    $arr = [
                        'sync_time' => $val['sync_time'], // device to server
                        'logged_time' => $val['logged_time'], // attendance time
                        'type' => $val['type'], // card or fingerprint
                        'uid' => $val['uid'], // unique id
                        'device_identifier' => $val['device_identifier'], // device id
                        'location' => 'location', // location
                        'person_identifier' => $val['person_identifier'], // student id or employee id
                        'rfid' => 'rfid', // card id
                        'primary_display_text' => $val['primary_display_text'], // first name
                        'secondary_display_text' => $val['secondary_display_text'] // last name
                        ];
                        $this->db->insert('data', $arr);
                    $se_id = explode("-",$val['person_identifier']);
                    $check = $this->checkEmployee($se_id[1]);
                    $logged_time = strtotime($val['logged_time']);
                    if (!$check) {
                        $this->studentFinger($se_id[1], $val['device_identifier'], $logged_time);
                    } else {
                        //echo '2';exit;
                        $this->employeeFinger($se_id[1], $val['device_identifier'], $logged_time);
                    }
                }
                
                //attendance data is in this variable
                return $this->output
                 ->set_content_type('application/json')
                 ->set_output(json_encode(array(
                 'code' => 200
                 )));
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
            //print_r($last_student_id);exit;
            if ($last_student_id != $studentId) {
                $student_info = $this->getStudentInfo($studentId);
                //echo '<pre>';print_r($student_info);exit;
                if ($student_info)
                {
                    $splitTime = $this->getStuentSplitTime($studentId);
                    $this->stuentMessage($student_info, $splitTime);
                }
            }
        }
        //$duplicate_check = $this->dublicateCheck();
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

    private function stuentMessage($row = [], $splitTime)
    {
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

    private function getStudentInfo($studentId = 0)
    {
        $sql = "SELECT 
                event_log.sl, 
                event_log.device_id,
                event_log.student_id,
                from_unixtime(event_log.date_time) as ptime,
                studentinfo.fatherPhone, 
                studentinfo.firstName
            FROM 
                event_log
            JOIN 
                student ON student.studentId = event_log.student_id
            JOIN 
                studentinfo ON studentinfo.applicationId = student.applicationId
            WHERE 
                event_log.student_id = ".$studentId."
            GROUP BY 
               event_log.student_id";
        $row = $this->db->query($sql)->row_array();
        return $row;
    }

    private function getEmpInfo($employeeId = 0)
    {
        $sql = "SELECT 
                emp_event_log.id, 
                emp_event_log.device_id,
                emp_event_log.emp_id,
                from_unixtime(emp_event_log.date_time) as ptime, 
                employee.firstName,
                employee.lastName
            FROM 
                emp_event_log
            JOIN 
                employee ON employee.employeeId = emp_event_log.emp_id
            WHERE 
                emp_event_log.emp_id = ".$employeeId."
            GROUP BY 
               emp_event_log.emp_id";
        $row = $this->db->query($sql)->row_array();
        return $row;
    }

    private function getLastProgramOfferId($studentId = 0)
    {
        $row = $this->db
                    ->select('programOfferId')
                    ->order_by('promotionId','desc')
                    ->get('promotedstudent')
                    ->row_array();

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


    //  public function data()
    // {
    //         $text = '
    //             {
    //              "payload":[
    //                      {
    //                        "sync_time": "2017-07-17 03:14:56",
    //                        "logged_time": "2017-07-16 14:07:03",
    //                        "type": "fingerprint",
    //                        "uid": "41cb234bca0c46feeb3c4601b858f597",
    //                        "device_identifier": "0003",
    //                        "location": "Katabon",
    //                        "person_identifier": "2",
    //                        "rfid": "0002188386",
    //                        "primary_display_text": "Aminur",
    //                        "secondary_display_text": "Rahman"
    //                      },
    //                      {
    //                        "sync_time": "2017-07-17 03:14:56",
    //                        "logged_time": "2017-07-16 14:07:05",
    //                        "type": "fingerprint",
    //                        "uid": "e38ac95a5d67028683688c277accd98b",
    //                        "device_identifier": "0003",
    //                        "location": "Katabon",
    //                        "person_identifier": "2",
    //                        "rfid": "0002188386",
    //                        "primary_display_text": "Akash",
    //                        "secondary_display_text": "Khan"
    //                      }
    //              ]
    //             }
    //         ';
    //         $data = json_decode($text,true);
    //        echo '<pre>';print_r($data['payload']);exit;
    //         $payload = json_decode(file_get_contents("php://input"), true);
            
    //        //  if ($payload['payload']) {
    //        //       //$data = json_decode($payload,true);
    //        //      foreach($payload['payload'] as $key => $val) {
    //        //          $arr = [
    //        //              'sync_time' => $val['sync_time'], // device to server
    //        //              'logged_time' => $val['logged_time'], // attendance time
    //        //              'type' => $val['type'], // card or fingerprint
    //        //              'uid' => 'uid', // unique id
    //        //              'device_identifier' => 'device_identifier', // device id
    //        //              'location' => 'location', // location
    //        //              'person_identifier' => 'person_identifier', // student id or employee id
    //        //              'rfid' => 'rfid', // card id
    //        //              'primary_display_text' => 'primary_display_text', // first name
    //        //              'secondary_display_text' => 'secondary_display_text' // last name
    //        //              ];
    //        //              $this->db->insert('data', $arr);
    //        //      }
                
    //        //      $this->MessageSend();
    //        //  }
    //        // // log_message('info', json_encode($payload,true));
           
    //        //      // attendance data is in this variable
    //        //      return $this->output
    //        //       ->set_content_type('application/json')
    //        //       ->set_status_header(200)
    //        //       ->set_output(json_encode(array(
    //        //       'code' => 200
    //        //       )));
        
    // }
    
    public function MessageSend($to="8801921821909", $message="Error", $emp_stu_id, $type = 1)
    {
        //$message = "hi";
        //$to = '01921821909';
        $to = substr($to, strpos($to, '0'));
        $server = "https://api.mobireach.com.bd/SendTextMultiMessage?";
        $param = "Username=advsoft&Password=Fima@302124&From=8801847050122&To=88".$to."&Message=".$message."";
        $param = str_replace(" ","%20",$param);
        $url = $server.$param;
      // print_r($url);exit;
        $ch = curl_init();                       
        curl_setopt($ch, CURLOPT_POST, false);    
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        curl_close($ch);                         
        if(!$output){
           $output =  file_get_contents($url);  
        }

        $this->db
            ->where('type', $type)
            ->update('lastsms', ['lastsms_student_id' => $emp_stu_id]);
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */