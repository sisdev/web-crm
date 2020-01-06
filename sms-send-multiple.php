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
  <link rel="icon" type="image/png" href="images/icon.png" />
</head>
<body style="background-color:#ccf2ff">
<div class ="container-fluid">  
	<div>
		<?php include 'header.inc.php'; ?>
	</div>
	<div class="row">
  <div style="margin-top:100px;">
  <h2 class="text-primary text-center">Send SMS(Multiple)</h2><br>
  
  <div style="float:right;">	
<?php 

$username = urlencode("RETEST");
$password = urlencode("reseller@123");
$up = "username=" . $username . "&password=" . $password ;
$target="http://smscgateway.com/balanceapi.asp?".$up ;
$ch = curl_init($target);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
echo $response;
?>
  </div>	
  </div>	
  
</div>      

<form class="form-horizontal" method="POST" style="margin-left:20%;" action="sms-send-multiple.php">
<div class="form-group row" style="margin-left:157px;">
   <input type='checkbox' name='chk1' value="all_customers">
   <label class="control-label"  for="to1">To All Customers
   <?php
   $qry=mysqli_query($conn,"SELECT COUNT(DISTINCT phone_main) FROM `user_profile`");
   while ($row=mysqli_fetch_row($qry))
    {
   echo ":".$row[0];
    }
   ?></label>
   

	<input type='checkbox' name='chk2' value="all_visitors" style="margin-left:10px;">
	<label class="control-label"  for="to2">To All Visitors
	<?php
   $qry=mysqli_query($conn,"SELECT COUNT(DISTINCT phone_no) FROM `lead_log`");
   while ($row=mysqli_fetch_row($qry))
    {
   echo ":".$row[0];
    }
   ?></label> 

	<input type='checkbox' id="myCheck" name='chk3' value="" onclick="myFunction()" style="margin-left:10px;">
	<label class="control-label"  for="to3">Today's Birthday
	<?php
	$todate=date("m-d");
    $qry=mysqli_query($conn,"SELECT COUNT(DISTINCT phone_main) FROM `user_profile` where dob like '%".$todate."'");
    while ($row=mysqli_fetch_row($qry))
    {
    echo ":".$row[0];
    }
    ?></label> 
</div>

<div class="form-group row">
  <label class="control-label col-md-2" for="ssm">Message Code</label>  
  <div class="col-md-5">
        <select id="ssm" name="ssm" style="height:100%; width:100%;" onchange="fetch_select(this.value);">
		<option value="" disabled selected>Select Message</option>
	<?php
        $query = "select msg_code from sms_template"; //Write a query
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
<div  class="col-md-5">
<textarea id="msg1" name="msg1" class="form-control input-md" cols="15" rows="10"></textarea>
</div>
</div>

<div class="form-group" style="margin-left:27%;">
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
 url: 'sms-code-ajax.php',
 data: {
  get_option:val
 },
 success: function (response) {
	
  document.getElementById("msg1").innerHTML=response; 
 }
 });
}
</script>



<script>
function myFunction() {
  
  var checkBox = document.getElementById("myCheck");

  if (checkBox.checked != true){
	  document.getElementById("msg1").innerHTML="";
	  	  document.getElementById("ssm").value="" ;

	  return ;
  }
  else
  {	  
	  var sel_msg_temp = document.getElementById("ssm") ;
      sel_msg_temp.value="Birthday";
	  sel_msg_temp.onchange() ;
  }
}
</script>
<?php
include("sms-api.php");
if (isset($_POST['send_multiple'])) 
{	
	$sent_by=$_SESSION['login']; 
	$msg=$_POST['msg1'];
	$code=$_POST['ssm'];
	if(!empty($_POST['chk1'])){
   $qry=mysqli_query($conn,"SELECT DISTINCT(phone_main) FROM `user_profile`");
   while ($row=mysqli_fetch_array($qry))
    {
	$phone=$row['phone_main'];
	sendsms($conn, $phone, $code, $msg, $sent_by);
echo "Sent successfully to &mobileno=" . $phone . "&message=" . $msg;
    }
	}
  if(!empty($_POST['chk2'])){
   $qry=mysqli_query($conn,"SELECT DISTINCT(phone_no) FROM `lead_log`");
   while ($row=mysqli_fetch_array($qry))
    {
	$phone=$row['phone_no'];
	sendsms($conn, $phone, $code, $msg, $sent_by);
echo "Sent successfully to &mobileno=" . $phone . " &message= " . $msg;
    }
}

if(!empty($_POST['chk3'])){
   $qry=mysqli_query($conn,"SELECT DISTINCT(phone_main) FROM `user_profile` where dob like '%".$todate."'");
   while ($row=mysqli_fetch_array($qry))
    {
	$phone=$row['phone_main'];
	sendsms($conn, $phone, $code, $msg, $sent_by);
echo "<br>Sent successfully to &mobileno=" . $phone . " &message= " . $msg;
    }
}
}
?>
	
</div>
<div style="position:relative; width:100%; right:0; left:0; bottom:0; margin-top:63px;">
		<?php include("footer.inc.php"); ?>
	</div>
</body>
</html>
