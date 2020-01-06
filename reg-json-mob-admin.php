<?php
ob_start();
session_start();
include 'include/dbi.php';
include 'include/session.php';
checksession();
header("Content-Type: application/json; charset=UTF-8");
$phone = $_POST['mob'] ;
$result = mysqli_query($conn, "select phone_no from trng_query_log where phone_no LIKE '$phone'");
$outp = array();
while($data = mysqli_fetch_assoc($result)) 
    {
       $outp[] = $data;
    }

echo json_encode($outp);
?>
