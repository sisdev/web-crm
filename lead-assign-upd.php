<?php
ob_start();
session_start();
include 'include/dbi.php';
include 'include/session.php';
checksession(); 
$followup_dtm=getLocalDtm();
$pass_assign=$_POST['pass_assign'];
$lead_id=$_POST['lead_id'];
$followupuser=$_SESSION['login'];

if(isset($_REQUEST['pass_assign']))
{

echo $pass_assign;
$status="Assigned To : ".$pass_assign;
 mysqli_query($conn, "update lead_log set assigned_to='".$pass_assign."' where id='".$lead_id."' ");
 $ins_qry = "insert into lead_followup (trng_query_id,followup_dtm,followup_text,followup_user) values('".$lead_id."','".$followup_dtm."','".$status."','".$followupuser."') ";
 //echo $ins_qry ;
 mysqli_query($conn, $ins_qry);
 echo "Assigned To :".$pass_assign ;
}


?>