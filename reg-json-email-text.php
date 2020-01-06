<?php
ob_start();
session_start();
include 'include/dbi.php';
include 'include/session.php';
checksession();
header("Content-Type: application/json; charset=UTF-8");
$email = $_POST['email'] ;
$result = mysqli_query($conn, "select id, email, name, phone_main from user_profile where email LIKE '$email'");
$outp = array();
while($data = mysqli_fetch_assoc($result)) 
    {
       $outp[] = $data;
    }

echo json_encode($outp);
?>
