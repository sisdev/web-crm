<?php
ob_start();
session_start();
include 'include/dbi.php';
include 'include/session.php';
checksession();
date_default_timezone_set('Asia/Kolkata');
$dtm = date("Y-m-d H:i:s"); 

		$followupuser=$_SESSION['login'];
		$ids = $_POST['ids'];
		$follow_action_date=$_POST['follow_action_date'];
		$follow_action_time=$_POST['follow_action_time'];
		$follow_dtm=$follow_action_date." ".$follow_action_time;
		$task_type=$_POST['task_type'];
		$assign_to=$_POST['assign_to'];
		$follow_action_text=$_POST['follow_action_text'];
		$follow_status="New";
		
		$action_status = "Next Follow On:".$follow_action_date." ".$follow_action_time." By:".$assign_to ;
		
		mysqli_query($conn,"insert into mytasks (trng_query_id,assigned_user,datetime,task_type,narration,status,dtm_created,created_by) values('$ids','$assign_to','$follow_dtm','$task_type','$follow_action_text','$follow_status','$dtm','$followupuser')")  or die(mysqli_error($conn));
			
		mysqli_query($conn,"insert into lead_followup (trng_query_id,followup_dtm,followup_text,followup_user) values('$ids','$dtm','$action_status','$followupuser')")  or die(mysqli_error($conn));
		mysqli_query($conn, "update lead_log set nxt_followup_dt='".$follow_action_date."' where id='".$ids."' ");
?>