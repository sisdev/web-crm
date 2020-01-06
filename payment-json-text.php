<?php
ob_start();
session_start();
include 'include/dbi.php';
include 'include/session.php';
checksession();
header("Content-Type: application/json; charset=UTF-8");
$reg = $_POST['reg_val'] ;
//$reg = '2017-004' ;
//echo "<BR>:".$reg ;
$qry = "select user_profile.name, user_profile.cur_add, trng_enroll.course_name, trng_enroll.course_fee FROM user_profile left join trng_enroll on user_profile.email = trng_enroll.user_name where user_profile.reg_id ='$reg' LIMIT 1" ;

$result = mysqli_query($conn,$qry );

$outp = array();
while($data = mysqli_fetch_assoc($result)) 
    {
       $outp[] = $data;
    }


echo json_encode($outp);
?>
