

<?php
ob_start();
session_start();
include 'include/dbi.php';
include 'include/session.php';
checksession();

$trng_qry_id=$_POST['trng_qry_id'];
$followup_dt=$_POST['followup_dt'];
$followup_dtm=date("Y-m-d H:m:i");
$followupuser=$_SESSION['login'];


if(isset($_REQUEST['followup_dt']))
{


$status_update="Next Followup Date : ".$_REQUEST['followup_dt'];

 mysqli_query($conn, "update lead_log set nxt_followup_dt='".$_REQUEST['followup_dt']."' where id='".$trng_qry_id."' ");
$ins_sql = "insert into lead_followup (trng_query_id,followup_dtm,followup_text,followup_user) values(".$trng_qry_id.",'".$followup_dtm."','".$status_update."','".$followupuser."')" ;
echo $ins_sql ;

mysqli_query($conn, $ins_sql);
 
echo "Follow up date update:".$followup_dt ;
}


?>
