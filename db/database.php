<?php 
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET,HEAD,OPTIONS,POST,PUT');
header("Access-Control-Allow-Headers: X-Requested-With");


 $HostName = "localhost";
 $DatabaseName = "attendance_monitoring";
 $HostUser = "root";
 $HostPass = ""; 
 
 $con = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);
?>