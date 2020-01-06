<?php
ob_start();
session_start();
include 'include/dbi.php';
include 'include/session.php';
checksession(); 
$followup_dtm=getLocalDtm();
$class=$_POST['pass_class'];
$followupuser=$_SESSION['login'];



if(isset($_REQUEST['pass_class']))
{

//echo $_REQUEST['pass_class'];
$status_update="Class Update : ".$_REQUEST['pass_class'];
 mysqli_query($conn, "update lead_log set lead_class='".$_REQUEST['pass_class']."' where id='".$_REQUEST['id_of_user']."' ");
 $ins_qry = "insert into lead_followup (trng_query_id,followup_dtm,followup_text,followup_user) values('".$_REQUEST['id_of_user']."','".$followup_dtm."','".$status_update."','".$followupuser."') ";
 //echo $ins_qry ;
 
 mysqli_query($conn, $ins_qry);

 //echo "Class Update :".$class ;
}


?>