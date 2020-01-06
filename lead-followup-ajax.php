<?php

ob_start();
session_start();
include 'include/dbi.php';
include 'include/session.php';
checksession();
$follow_dtm=getLocalDtm();
		$followupuser=$_SESSION['login'];
		$id = $_POST['id'];
		$follow_text=$_POST['follow_text'];
			
		mysqli_query($conn,"insert into lead_followup (trng_query_id,followup_dtm,followup_text,followup_user) values('$id','$follow_dtm','$follow_text','$followupuser')")  or die(mysqli_error($conn));	
		
	
	
?>