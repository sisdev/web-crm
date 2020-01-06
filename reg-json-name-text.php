<?php
ob_start();
session_start();
include 'include/dbi.php';
include 'include/session.php';
checksession();
header("Content-Type: application/json; charset=UTF-8");
$name = $_POST['name'] ;
$result = mysqli_query($conn, "select id, name, email, phone_main from user_profile where name like '$name'");
$outp = array();
while($data = mysqli_fetch_assoc($result)) 
    {
       $outp[] = $data;
    }

echo json_encode($outp);
?>
