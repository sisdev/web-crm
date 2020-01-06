<?php
ob_start();
session_start();
include 'include/dbi.php';
include 'include/session.php';
checksession();

$trng_qry_id=$_POST['trng_qry_id'];
$targ_month=$_POST['targ_month'];
$followup_dtm=getLocalDtm();
$followupuser=$_SESSION['login'];


if(isset($_REQUEST['targ_month']))
{

$status_update="Target Month : ".$_REQUEST['targ_month'];

 mysqli_query($conn, "update lead_log set target_month='".$_REQUEST['targ_month']."' where id='".$trng_qry_id."' ");
$ins_sql = "insert into lead_followup (trng_query_id,followup_dtm,followup_text,followup_user) values(".$trng_qry_id.",'".$followup_dtm."','".$status_update."','".$followupuser."')" ;
//echo $ins_sql ;

mysqli_query($conn, $ins_sql);
 
//echo "Target Month Update:".$targ_month ;
}


?>
