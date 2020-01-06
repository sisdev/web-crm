<?php
ob_start();
session_start();
include 'include/dbi.php';
include 'include/session.php';
include 'mail-send-api.php';
include 'include/param.php';
checksession();
$dtm=getLocalDtm();
if(isset($_POST['email_send'])){
     $to = $_POST['to']; 
     $subject = $_POST['subject'];
     $msg = $_POST['msg2'];
	 $from= $_POST['from'];
	 //$header = "From: Sisoft<".$_POST['from'].">\r\n";
	 $name="Sisoft";
	$sent_by=$_SESSION['login'];
	$batch_num="Single";
	mysqli_query($conn, "INSERT INTO email_send_req(req_email_dtm, req_from_email_id, req_email_recipients, req_email_subject, req_email_text, req_from_user_id)VALUES('$dtm', '$from', '$batch_num', '$subject', '$msg', '$sent_by')") or die(mysqli_error($conn));
	 $last_id = mysqli_insert_id($conn);
	// echo $last_id;
    sisoft_email($conn, $last_id, $from, $name, $to,$subject,$msg, $sent_by);
	echo "<script>alert('Sent successfull to Email=$to');</script>";
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Mail Single</title>

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
  <h2 class="text-primary text-center">Send Mail(Single)</h2><br>
  </div>      
  </div>	
<form class="form-horizontal" style="margin-left:6%;" method="POST">
<div class="form-group row">
  <label class="control-label col-md-2"  for="to">To<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="to"  placeholder="" required=required class="form-control input-md" type="text">
  </div>

  <label class="control-label col-md-2"  for="from">From<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<select id="from" name="from" style="height:25px; width:100%;">
		<option value="" disabled selected>--Select Email Id--</option>
			<?php 
	 for ($i=0;$i<count($mail_from); $i++)
	 {
		 echo "<option value='$mail_from[$i]'>$mail_from[$i]</option>" ;
	 }
		?>
	</select>
  </div>
  
</div>


<div class="form-group row">

<label class="control-label col-md-2" for="to">Mail_code</label>  
  <div class="col-md-3">
	 
        <select id="ssm" name="ssm" style="height:25px; width:100%;" onchange="fetch_select(this.value);">
		<option value="" disabled selected>--Select Code--</option>
			 <?php
        
        $query = "select email_temp_name from email_template"; 
        $data = mysqli_query($conn, $query);
    
    while($fetch_options = mysqli_fetch_array($data)) {
   

   echo "<option>" .$fetch_options['email_temp_name']. "</option>" ;
    
        }
    ?>
        </select>
  </div>

 <label class="control-label col-md-2"  for="subject">Subject<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="subject" id="subject" placeholder="" required=required class="form-control input-md" type="text">
  </div>  
</div>



<div class="form-group row">
  <label class="col-md-2 control-label" for="msg2">Message<span style="color:red">*</span></label>  
  <div class="col-md-6">
	<textarea id="msg" name="msg2" required=required class="form-control input-md" cols="65" rows="10"></textarea>
  </div>
</div>


<div class="form-group" style="margin-left:37%;">
  <label class=" control-label" for="email_send"></label>
  <div>
    <input type="submit" name="email_send"class="btn btn-info" value="Send" style="padding:10px 7%;"/>
    <input type="reset"  name="Reset" class="btn" value="Reset" style="padding:10px 7%;"/>
	</div>
</div>
</form>
<script>
function fetch_select(val)
{
	
 $.ajax({
 type: 'post',
 url: 'mail-code-ajax.php',
 data: {
  get_option:val
 },
 success: function (response) {
  document.getElementById("subject").value=response[0].email_subject;
  document.getElementById("msg").value=response[0].email_text;
  document.getElementById("msg").value+="\n";
  document.getElementById("msg").value+=response[0].email_sign;
 }
 });
}
</script>
<?php


?>
</div>

<div style="position:relative; width:100%; left:0; right:0; bottom:0;">
		<?php include("footer.inc.php"); ?>
	</div>
</body>
</html>