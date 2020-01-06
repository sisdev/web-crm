<?php
ob_start();
session_start();
include 'include/dbi.php';
include 'include/session.php';
checksession();
header("Content-Type: application/json; charset=UTF-8");
$phone = $_POST['phone'] ;
$result = mysqli_query($conn, "select id, email, phone_main, name from user_profile where phone_main LIKE '$phone'");
$outp = array();
while($data = mysqli_fetch_assoc($result)) 
    {
       $outp[] = $data;
    }

echo json_encode($outp);
?>
