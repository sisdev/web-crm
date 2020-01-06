<?php
ob_start();
session_start();
include 'include/dbi.php';
include 'include/session.php';
checksession();
?>
 
   
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SMS Multiple</title>

<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
</head>
<body style="background-color:#ccf2ff">
<div class ="container col-md-12" >  
	<div>
		<?php include 'header.inc.php'; ?>
	</div>

  <div>
  <h2 class="text-primary text-center">Send SMS(Multiple)</h2><br>
</div>      

<form class="form-horizontal" method="POST" style="margin-left:30%;" action="send_msg_multiple.php">
<div class="form-group row" style="margin-left:160px;">
   <input type='checkbox' name='chk1' value="all_customers">
   <label class="control-label"  for="to1">To All Customers
   <?php
   $qry=mysqli_query($conn,"SELECT COUNT(DISTINCT phone_main) FROM `user_profile`");
   while ($row=mysqli_fetch_row($qry))
    {
   echo ":".$row[0];
    }
   ?></label>
   
</div>
<div class="form-group row" style="margin-left:160px;">
	<input type='checkbox' name='chk2' value="all_visitors">
	<label class="control-label"  for="to2">To All Visitors
	<?php
   $qry=mysqli_query($conn,"SELECT COUNT(DISTINCT phone_no) FROM `trng_query_log`");
   while ($row=mysqli_fetch_row($qry))
    {
   echo ":".$row[0];
    }
   ?></label> 
</div>

<div class="form-group row" style="margin-left:160px;">
	<input type='checkbox' name='chk3' value="all_birthdays">
	<label class="control-label"  for="to3">Today's Birthday
	<?php
	$todate=date("m-d");
	//$query = "SELECT DATE_FORMAT(dob,'%m-%d') from user_profile";
   $qry=mysqli_query($conn,"SELECT COUNT(DISTINCT phone_main) FROM `user_profile` where dob like '%".$todate."'");
   while ($row=mysqli_fetch_row($qry))
    {
   echo ":".$row[0];
    }
   ?></label> 
</div>

<div class="form-group row">
  <label class="control-label col-md-2"  for="msg">Message Code</label>  
  <div class="col-md-3">
        <select id="ssm" name="msg" style="height:100%; width:100%;" onchange="fetch_select(this.value);">
		<option value="" disabled selected>Select Message</option>
	<?php
        $query = "select msg_code from msg_template"; //Write a query
        $data = mysqli_query($conn, $query);  //Execute the query
    
    while($fetch_options = mysqli_fetch_array($data)) { //Loop all the options retrieved from the query
   

   echo "<option>" .$fetch_options['msg_code']. "</option>" ;
    
        }
    ?>
        </select>
  </div>
</div>
<div class="form-group row">
 <label class="control-label col-md-2"  for="msg1">Message</label>  
<div  class="col-md-3">
<textarea id="msg1" name="msg1" class="form-control input-md" cols="15" rows="5"></textarea>
</div>
</div>

<div class="form-group" style="margin-left:18%;">
  <label class=" control-label" for="send_multiple"></label>
  <div>
    <input type="submit" name="send_multiple" class="btn btn-info" value="Send" style="padding:10px 3%;"/>
    <input type="reset"  name="Reset" class="btn" value="Reset" style="padding:10px 3%;"/>
	</div>
</div>
</form>
<script>
function fetch_select(val)
{
	
 $.ajax({
 type: 'post',
 url: 'msg_code_ajax.php',
 data: {
  get_option:val
 },
 success: function (response) {
	
  document.getElementById("msg1").innerHTML=response; 
 }
 });
}
</script>
<?php
include("sms.php");
if (isset($_POST['send_multiple'])) 
{
	$msg=$_POST['msg1'];
	if(!empty($_POST['chk1'])){
   $qry=mysqli_query($conn,"SELECT DISTINCT(phone_main) FROM `user_profile`");
   while ($row=mysqli_fetch_array($qry))
    {
	$phone=$row['phone_main'];
	sendsms($phone, $msg);
echo "Sent successfully to &mobileno=" . $phone . "&message=" . $msg;
    }
	}
  if(!empty($_POST['chk2'])){
   $qry=mysqli_query($conn,"SELECT DISTINCT(phone_no) FROM `trng_query_log`");
   while ($row=mysqli_fetch_array($qry))
    {
	$phone=$row['phone_no'];
	sendsms($phone, $msg);
echo "Sent successfully to &mobileno=" . $phone . " &message= " . $msg;
    }
}

if(!empty($_POST['chk3'])){
   $qry=mysqli_query($conn,"SELECT DISTINCT(phone_main) FROM `user_profile` where dob like '%".$todate."'");
   while ($row=mysqli_fetch_array($qry))
    {
	$phone=$row['phone_main'];
	sendsms($phone, $msg);
echo "Sent successfully to &mobileno=" . $phone . " &message= " . $msg;
    }
}
}
?>
	<div style="margin-top:119px;">
		<?php include("footer.inc.php"); ?>
	</div>
</div>
</body>
</html>
