<html>
<head>
<meta http-equiv="refresh" content="10">

<style>
    @import url(https://fonts.googleapis.com/css?family=Sigmar+One);

body {
    background: #3da1d1;
    color: #fff;
    overflow: hidden;
}

.congrats {
    position: absolute;
    top: 140px;
    width: 550px;
    height: 100px;
    padding: 20px 10px;
    text-align: center;
    margin: 0 auto;
    left: 0;
    right: 0;
}

h1 {
    transform-origin: 50% 50%;
    font-size: 50px;
    font-family: 'Helvetica', cursive;
    cursor: pointer;
    z-index: 2;
    position: absolute;
    top: 0;
    text-align: center;
    width: 100%;
}

.blob {
    height: 50px;
    width: 50px;
    color: #ffcc00;
    position: absolute;
    top: 45%;
    left: 45%;
    z-index: 1;
    font-size: 30px;
    display: none;  
}
    
</style>


</head>
<body>

<?php
    date_default_timezone_set("Asia/Dhaka");
    $device_id = isset($_GET['device_id']) ? $_GET['device_id'] : 0;
    $card_no = isset($_GET['card_no']) ? $_GET['card_no'] : 0;
    $date_time = isset($_GET['date_time']) ? ($_GET['date_time'] -0) : 0;

    $servername = "localhost";
    $username = "dueogov_dmgps_mu";
    $password = "z6y8)H$%AaKb";
    $dbname = "dueogov_dmgps_main";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
        //echo "Connection Fail";
    }else{
        $check = checkEmployee($card_no, $conn);

        if (!$check) {
            studentFinger($card_no, $device_id, $date_time, $conn);
        } else {
            employeeFinger($card_no, $device_id, $date_time, $conn);
        }
    }

        function studentFinger($student_id, $device_id, $date_time, $conn)
        {
            $programOfferId = 0;
            if ($student_id) {
                $programOfferId = getLastProgramOfferId($student_id, $conn);
            }
       // print_r($programOfferId);exit;
       $qsql="SELECT * FROM event_log where device_id = $device_id and student_id=$student_id and date_time=$date_time";
        $result = mysqli_query($conn, $qsql);
    if (mysqli_num_rows($result) > 0){
         die("Connect");
    } else {
        $sql = "insert into event_log (device_id, student_id, date_time, programOfferId) VALUES ($device_id,$student_id, $date_time, $programOfferId);";
        $sqlresult=mysqli_query($conn,$sql);
        if($sqlresult){

        $sql = 'select * from lastsms';
        $resultp = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($resultp);
        $lastsms = $row['lastsms_student_id'];
        
        $smsdata = "SELECT 
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
                event_log.student_id = ".$student_id."
            GROUP BY 
               event_log.student_id";

      //  echo $smsdata;
        $smsresult = mysqli_query($conn, $smsdata);

        
        if (mysqli_num_rows($smsresult) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($smsresult)) {

               $splitTime = studentLastInfo($student_id, $conn);

                if($lastsms != $row['student_id'] && $splitTime <= '08:05:00'){

                        $to = $row['fatherPhone'];
                        $message = "Dear Parents, Your Child ".$row['firstName'].", ID: " . $row['student_id'] .  "is Attend at Time : $splitTime In School. Thanks. ONSC.";

                        MessageSend($to, $message, $row['student_id'], $conn, 1);

                }else if($lastsms != $row['student_id'] && $splitTime >= '08:06:00' && $splitTime <= '10:00:00'){

                        $to = $row['fatherPhone'];
                        $message = "Dear Parents, Your Child ".$row['firstName'].", ID: " . $row['student_id'] .  "is Late at Time : $splitTime In School. Thanks. ONSC.";

                        MessageSend($to, $message, $row['student_id'], $conn, 1);
                        
                }else if($lastsms != $row['student_id'] && $splitTime >= '10:30:00' && $splitTime <= '19:00:00'){

                            $to = $row['fatherPhone'];
                            $message = "Dear Parents, Your Child ".$row['firstName'].", ID: " . $row['student_id'] .  "is Leaves at Time : $splitTime In School. Thanks for Receiving your child. ONSC.";
                        
                            MessageSend($to, $message, $row['student_id'], $conn, 1);
                }else{
                    echo 'Already sms sent and Student is present';
                }
            }
        } else{
             echo "   There is 0 results";
        }
    }  
        }   
        }

        function employeeFinger($emp_id, $device_id, $date_time, $conn)
        {

            $qsql="SELECT * FROM emp_event_log where device_id = $device_id and emp_id=$emp_id and date_time=$date_time";
            $result = mysqli_query($conn, $qsql);
            if (mysqli_num_rows($result) > 0){
                die("Reapet");
            } else {
            $sql = "insert into emp_event_log (device_id, emp_id, date_time) VALUES ($device_id,$emp_id, $date_time);";
            $sqlresult=mysqli_query($conn,$sql);
            if($sqlresult){

            $sql = 'select * from lastsms where type = 2';
            $resultp = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($resultp);
            $lastsms = $row['lastsms_student_id'];
        
        $smsdata = "SELECT 
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
                emp_event_log.emp_id = ".$emp_id."
            GROUP BY 
               emp_event_log.emp_id";

      //  echo $smsdata;
        $smsresult = mysqli_query($conn, $smsdata);

        
        if (mysqli_num_rows($smsresult) > 0) {

           // $to = "8801921821909";
            $to = getSchoolPhoneNo($conn);
           // print_r($to);exit;
            // output data of each row
            while($row = mysqli_fetch_assoc($smsresult)) {
               $splitTime = empLastInfo($row['emp_id'], $conn);

                $full_name = $row['firstName']." ".$row['lastName'];
                if($lastsms != $row['emp_id'] && $splitTime <= '09:00:00'){

                        $message = "Dear Sir, Employee Name: ".$full_name.", ID: " . $row['emp_id'] .  " is Present at Time : $splitTime In Our School.";
                        //print_r($splitTime);exit;

                        MessageSend($to, $message, $row['emp_id'], $conn, 2);

                }else if($lastsms != $row['emp_id'] && $splitTime >= '09:00:00' && $splitTime <= '12:59:59'){

                        $message = "Dear Sir, Employee Name: ".$full_name.", ID: " . $row['emp_id'] .  " is Late at Time : $splitTime In Our School.";

                        MessageSend($to, $message, $row['emp_id'], $conn, 2);
                        
                }else if($lastsms != $row['emp_id'] && $splitTime >= '13:00:00' && $splitTime <= '19:00:00'){

                            $message = "Dear Sir, Employee Name: ".$full_name.", ID: " . $row['emp_id'] .  " is Out at Time : $splitTime In Our School.";
                        
                            MessageSend($to, $message, $row['emp_id'], $conn, 2);
                }else{
                    echo 'Already sms sent and Employee is present';
                }
            }
        } else{
             echo "   There is 0 results";
        }
    }  
        }   
        }

    
    function MessageSend($to="8801921821909", $message="Error", $emp_stu_id, $conn, $type = 1)
    {
        //$message = "hi";
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
        //$sql = "update lastsms set lastsms_student_id=" . $emp_stu_id;
        $sql = "UPDATE  lastsms SET lastsms_student_id = ".$emp_stu_id." WHERE type = ".$type."";

        $resultsm = mysqli_query($conn, $sql);
    }

    function studentLastInfo($studentId = 0, $conn)
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
            LIMIT 1
            ";
        $last = mysqli_query($conn, $sql);
        $lastrow = mysqli_fetch_assoc($last);
        $timestamp = $lastrow['ptime'];
        $splitTime=date('d-M-Y h:i:s A',$timestamp);
        // $splitTimeStamp = explode(" ",$timestamp);
        // $splitTime = $splitTimeStamp[1];
        // if (!$splitTime) {
        //     $splitTime = "";
        // }
        return $splitTime;
        // $splitTimeStamp = explode(" ",$timestamp);
        // $splitDate = $splitTimeStamp[0];
        // $splitTime = $splitTimeStamp[1];
        // if (!$splitTime) {
        //     $splitTime = "";
        // }
        //return $splitTime;
    }

    function empLastInfo($emp_id, $conn) {
        $sql = "
            SELECT 
                from_unixtime(emp_event_log.date_time) as ptime
            FROM 
                emp_event_log 
            WHERE
                emp_id = {$emp_id}
            ORDER BY 
                id DESC 
            LIMIT 1
            ";
        $last = mysqli_query($conn, $sql);
        $lastrow = mysqli_fetch_assoc($last);
        $timestamp = $lastrow['ptime'];
        $splitTime=date('d-M-Y h:i:s A',$timestamp);
        // $splitTimeStamp = explode(" ",$timestamp);
        // $splitDate = $splitTimeStamp[0];
        // $splitTime = $splitTimeStamp[1];
        // if (!$splitTime) {
        //     $splitTime = "";
        // }
        return $splitTime;
    }

    function getLastProgramOfferId($student_id = 0, $conn) {
        //print_r($student_id);exit;
        $sql = "
            SELECT 
                programOfferId
            FROM 
                promotedstudent 
            WHERE
                studentId = {$student_id}
            ORDER BY 
                promotionId DESC 
            LIMIT 1
            ";
        $query = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($query);

        $programOfferId = isset($row['programOfferId']) ? $row['programOfferId'] : 0;
       // print_r($programOfferId);exit;
        return $programOfferId;
    }

     function checkEmployee($employeeId = 0, $conn) {
        $check = false;
        $sql = "
            SELECT 
                employeeId
            FROM 
                employee 
            WHERE
                employeeId = {$employeeId}
            LIMIT 1
            ";
        $query = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($query);

        if ($row) {
            $check = true;
        }
        return $check;
    }

    function getSchoolPhoneNo($conn) {
        $sql = "
            SELECT 
                personPhone
            FROM 
                institute
            LIMIT 1
            ";
        $query = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($query);

        $personPhone = isset($row['personPhone']) ? $row['personPhone'] : 0;
        return $personPhone;
    }
    mysqli_close($conn);
?>
</body>
</html>