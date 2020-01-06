<?php
ob_start();
session_start();
include 'include/dbi.php';
include 'include/session.php';
checksession();
$followup_dtm=getLocalDtm();
$followupuser=$_SESSION['login'];
$follow_text= "Score Updated:".$_POST['score'];
$id = $_POST['id'] ;

		mysqli_query($conn, "update lead_log set lead_score='".$_REQUEST['score']."' where id='$id' ");	
		mysqli_query($conn,"insert into lead_followup (trng_query_id,followup_dtm,followup_text,followup_user) values('$id','$followup_dtm','$follow_text','$followupuser')")  or die(mysqli_error($conn));	
		
		
?>