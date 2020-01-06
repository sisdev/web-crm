<?php
ob_start();
session_start();
error_reporting(1);

include 'include/dbi.php';
include 'include/session.php';

$get=$_REQUEST['passval'];
if($get=="")
	echo " ";
else
{
	$breakline=0;
$fetch=mysqli_query($conn,"SELECT phone_main FROM user_profile WHERE phone_main LIKE '".$get."%'") or die(mysqli_error($conn));
echo"<select class='form-control' id='phone_option' onChange='fetch_select(this.value);' style='width:150px;'>";
echo"<ul>";
echo "<option>Search...</option>";
while($record=mysqli_fetch_array($fetch))
{
	$breakline++;
	
echo "<option><li>".$record['phone_main']."</li></option>";	

	if($breakline==20)
		break;
	
}
echo"</ul>";
echo"</select>";
}
?>