<?php
ob_start();
session_start();
include 'include/dbi.php';
include 'include/session.php';
include 'include/param.php';
checksession(); 
$followup_dtm=getLocalDtm();
$pass_status=$_POST['pass_status'];
$followupuser=$_SESSION['login'];
$score = $lead_status_score[$pass_status];
//echo $score;

if(isset($_REQUEST['pass_status']))
{

//echo $_REQUEST['pass_status'];
$status_update="Status update : ".$_REQUEST['pass_status'];
 mysqli_query($conn, "update lead_log set qry_status='".$_REQUEST['pass_status']."'  where id='".$_REQUEST['id_of_lead']."' ");
 $ins_qry = "insert into lead_followup (trng_query_id,followup_dtm,followup_text,followup_user) values('".$_REQUEST['id_of_lead']."','".$followup_dtm."','".$status_update."','".$followupuser."') ";
 //echo $ins_qry ;
 
 mysqli_query($conn, $ins_qry);

if($score > 0)
{
 mysqli_query($conn, "update lead_log set lead_score='".$score."'  where id='".$_REQUEST['id_of_lead']."' ");
}
}


?>