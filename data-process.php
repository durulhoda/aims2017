<head>
<meta http-equiv="refresh" content="10">
</head>
<body>

</body>
<?php

$valset=true;
if (isset($_GET['device_id'])) {
    $device_id= $_GET['device_id'];
}
else{
    $valset=false;
}
if (isset($_GET['card_no'])) {
    $card_no= $_GET['card_no'];
    
}else{
    $valset=false;
}
if (isset($_GET['date_time'])) {
    $date_time= $_GET['date_time'];
     $date_time= $date_time-21600;
}else{
    $valset=false;
}
//echo "DeviceID=".$device_id ."CardNO=".$card_no ."DateTime=".$date_time;



$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mtech_attn";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    //die("Connection failed: " . mysqli_connect_error());
    //echo "Connection Fail";
}else{
    
    //echo "Connection Success!!!</br>";
}

    $qsql="SELECT * FROM event_log where device_id = $device_id and card_no=$card_no and date_time=$date_time";
 //   echo $qsql;
    $result = mysqli_query($conn, $qsql);
if (mysqli_num_rows($result) > 0){
     die("Reapet");
}else{
    $sql = "insert into event_log (device_id, card_no, date_time) VALUES ($device_id,$card_no, $date_time);";
    $sqlresult=mysqli_query($conn,$sql);
    if($sqlresult){
        echo "SUCCESS";
     //   echo $sqlresult;
    }else{
    
        echo "FAIL";
    }  
}
mysqli_close($conn);
?>

