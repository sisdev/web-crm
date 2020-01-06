<?php 
ob_start();
session_start();
include 'include/dbi.php';
include 'include/session.php';
checksession();
header("Content-Type: application/json; charset=UTF-8");
	$get_option=$_POST['get_option'];
    $qry = "select email_temp_name, email_subject, email_text, email_sign from email_template where email_temp_name='".$get_option."' LIMIT 1";
	//echo $qry;
    $rec = mysqli_query($conn, $qry);
	$outp = array();
while($data = mysqli_fetch_assoc($rec)) 
    {
       $outp[] = $data;
    }
echo json_encode($outp);
?>