<?php
ob_start();
session_start();
include 'include/dbi.php';
include 'include/session.php';
checksession();
header("Content-Type: application/json; charset=UTF-8");
$reg = $_POST['reg_val'] ;
//$reg = '2020-02' ;
//echo "<BR>:".$reg ;
$qry = "select user_profile.name, user_profile.cur_add, deal_log.course_name, deal_log.course_fee,deal_log.user_name FROM user_profile left join deal_log on user_profile.email = deal_log.user_name where deal_log.reg_id ='$reg' LIMIT 1" ;
//echo $qry;
$result = mysqli_query($conn,$qry );

$outp = array();
while($data = mysqli_fetch_assoc($result)) 
    {
       $outp[] = $data;
    }
$qry2 = "SELECT sum(amt_receipt) paid_amount FROM `tbl_receipt` WHERE reg_no = '$reg'";
  $result = mysqli_query($conn,$qry2 );

//$outp = array();
while($data = mysqli_fetch_assoc($result)) 
    {
       $outp[] = $data;
    }

echo json_encode($outp);
?>