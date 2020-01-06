<?php
	error_reporting(0);
	include("include/dbi.php");
	
	$s_key=$_POST["course_enroll"];
	$recCnt= 0 ;
    $res=mysqli_query($conn, "select COUNT(DISTINCT user_name) from deal_log where course_name like '%".$s_key."%' AND email_unsubscribe='N'");
    $r=mysqli_fetch_row($res);
    $recCnt=$r[0] ;
    echo $recCnt ;
?>
