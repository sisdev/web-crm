<?php
ob_start();
session_start();
error_reporting(1);

include 'include/dbi.php';
include 'include/session.php';

$get=$_POST['passval'];
if($get=="")
	echo " ";
else
{
	$breakline=0;
$fetch=mysqli_query($conn,"SELECT id,qry_type,center,name, address,emailID,phone_no,qry_details,req_dtm  FROM lead_log WHERE phone_no LIKE '".$get."%'") or die(mysqli_error($conn));
echo"<select class='form-control' onChange='fetch(this.value);' style='width:150px;'>";
echo"<ul>";
echo "<option>Search...</option>";
while($record=mysqli_fetch_array($fetch))
{
	$breakline++;
	
echo "<option><li>".$record['phone_no']."</li></option>";	

	if($breakline==20)
		break;
	
}
echo"</ul>";
echo"</select>";
}
?>