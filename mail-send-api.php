<?php
function sisoft_email($db_conn, $reg_last_id, $from_email,$from_name, $to_email, $subject, $msg, $sent_by)
{
	date_default_timezone_set('Asia/Kolkata');
	$dtm = date("Y/m/d H:i:s"); 
	
	$ins_qry="INSERT INTO email_log(req_batch_num,dtm_email, from_email, to_email, subject, email_text, sent_by)VALUES('$reg_last_id','$dtm','$from_email','$to_email','$subject','$msg','$sent_by')";
	mysqli_query($db_conn, $ins_qry) or die(mysqli_error($db_conn));
	
	$header = "From: ".$from_name."<".$from_email.">\r\n";
	//$msg = $msg."<BR>"."<img src=\"http://localhost/sisoft-crm2/mail-track.php?track_id=".$last_id." width=\"0\" height=\"0\" >";
	$msg = $msg."<BR><BR>"."If you do not want to recieve these emails  <a href='http://www.sisoft.in/training/admin/mail-unsubscribe.php?reqID=".rawurlencode(base64_encode($to_email))."'>unsubscribe</a> here!";
	//echo $msg;
	mail($to_email,$subject,$msg,$header);	
}
?>