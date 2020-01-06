<?php
ob_start();
session_start();
include 'include/dbi.php';
include 'include/session.php';
include 'sms-api.php';
checksession();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SMS Single</title>

<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="icon" type="image/png" href="images/icon.png" />
</head>
<body style="background-color:#ccf2ff">
<div class ="container-fluid" >   	
	<div>
		<?php include 'header.inc.php'; ?>
	</div>
  <div class="row">
  <div style="margin-top:100px;">
  <h2 class="text-primary text-center">Send Message(Single)</h2><br>
  </div>      
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
<form class="form-horizontal" style="margin-left:20%;" method="POST">
<div class="form-group row">
  <label class="control-label col-md-2"  for="to">To<span style="color:red">*</span></label>  
  <div class="col-md-5">
	<input  name="to"  placeholder="" required=required class="form-control input-md" type="text">
  </div>
</div>

<div class="form-group row">
  <label class="control-label col-md-2" for="to">Msg_code</label>  
  <div class="col-md-5">
	 
        <select id="ssm" name="ssm" style="height:100%; width:100%;" onchange="fetch_select(this.value);">
		<option value="" disabled selected>Select Code</option>
			 <?php
        
        $query = "select msg_code from sms_template"; //Write a query
        $data = mysqli_query($conn, $query);  //Execute the query
    
    while($fetch_options = mysqli_fetch_array($data)) { //Loop all the options retrieved from the query
	$cd=$fetch_options['msg_code'];

   echo "<option>" .$cd. "</option>" ;
    
        }
    ?>
        </select>
  </div>
</div>

<div class="form-group row">
  <label class="col-md-2 control-label" for="msg">Message</label>  
  <div class="col-md-5">
	<textarea id="msg" name="msg" class="form-control input-md" cols="15" rows="10"></textarea>
  </div>
</div>


<div class="form-group" style="margin-left:26%;">
  <label class=" control-label" for="send"></label>
  <div>
    <input type="submit" name="send"class="btn btn-info" value="Send" style="padding:10px 3%;"/>
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
	
  document.getElementById("msg").innerHTML=response; 
 }
 });
}
</script>
<?php

if (isset($_POST['send'])) 
{
	$to=$_POST['to'];
	$message=$_POST['msg'];
	$code=$_POST['ssm'];
	$sent_by=$_SESSION['login']; 
sendsms($conn, $to, $code, $message, $sent_by);
echo "<BR>Sent successfully to &mobileno=" . $to . " &message=" . $message;
}
?>
</div>

<div style="position:relative; width:100%; left:0; right:0; bottom:0; margin-top:140px;">
		<?php include("footer.inc.php"); ?>
	</div>
</body>
</html>