<?php
	error_reporting(0);
	include("include/dbi.php");
	
	$search_key = $_POST["course"];
	$recCount= 0 ;
	$result=mysqli_query($conn, "select COUNT(DISTINCT emailID) from lead_log where qry_details like '%".$search_key."%' AND email_unsubscribe='N'");
    $row=mysqli_fetch_row($result);
    $recCount=$row[0] ;
    echo $recCount ;
    
?>
