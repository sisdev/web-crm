<?php
ob_start();
session_start();
include 'include/dbi.php';
include 'include/session.php';
include 'mail-send-api.php';
include 'include/param.php';
checksession();
$dtm=getLocalDtm();
$today= SUBSTR($dtm,5,5);
if (isset($_POST['send_multiple'])) 
{	
	$subject = $_POST['subject'];
    $msg = $_POST['msg2'];
	$from= $_POST['from'];
	//$header = "From: Sisoft<".$_POST['from'].">\r\n";
	$name="Sisoft";
	$sent_by=$_SESSION['login']; 
	
	if(!empty($_POST['chk1'])){
		$qry=mysqli_query($conn,"SELECT DISTINCT(email) FROM `user_profile` where email_unsubscribe='N'");
		echo "<BR><BR><BR><BR>";
		$batch_num=$_POST['chk1'];
		
		mysqli_query($conn, "INSERT INTO email_send_req(req_email_dtm, req_from_email_id, req_email_recipients, req_email_subject, req_email_text, req_from_user_id)VALUES('$dtm', '$from', '$batch_num', '$subject', '$msg', '$sent_by')") or die(mysqli_error($conn));
		$last_id = mysqli_insert_id($conn);
		while ($row=mysqli_fetch_array($qry))
		{
		$to=$row['email'];
		sisoft_email($conn,$last_id, $from, $name, $to,$subject,$msg, $sent_by);
		echo "<BR>Sent successfully to Email=" . $to;
		}
	}

	if(!empty($_POST['chk2'])){	  
		$qry=mysqli_query($conn,"SELECT DISTINCT(emailID) FROM `lead_log` where email_unsubscribe='N'");
		echo "<BR><BR><BR><BR>";
		$batch_num=$_POST['chk2'];
		mysqli_query($conn, "INSERT INTO email_send_req(req_email_dtm, req_from_email_id, req_email_recipients, req_email_subject, req_email_text, req_from_user_id)VALUES('$dtm', '$from', '$batch_num', '$subject', '$msg', '$sent_by')") or die(mysqli_error($conn));
		$last_id = mysqli_insert_id($conn);
		while ($row=mysqli_fetch_array($qry))
		{
		$to=$row['emailID'];
		sisoft_email($conn, $last_id, $from, $name, $to,$subject,$msg, $sent_by);
		echo "<BR>Sent successfully to Email=" . $to;
			}
		}

		
if(!empty($_POST['chk3'])){
	
	if(isset($_POST["by_course"])){
	$search_key = $_POST["by_course"] ;
	}
	$batch_num=$_POST['chk3'];
	mysqli_query($conn, "INSERT INTO email_send_req(req_email_dtm, req_from_email_id, req_email_recipients, req_email_subject, req_email_text, req_from_user_id)VALUES('$dtm', '$from', '$batch_num', '$subject', '$msg', '$sent_by')") or die(mysqli_error($conn));
	$last_id = mysqli_insert_id($conn);
	
	$qry=mysqli_query($conn,"SELECT DISTINCT(emailID) FROM `lead_log` where qry_details like '%".$search_key."%' AND email_unsubscribe='N'");
	echo "<BR><BR><BR><BR>";
    while ($r=mysqli_fetch_array($qry))
    {
		$to= $r['emailID'];
		sisoft_email($conn, $last_id, $from, $name,$to,$subject,$msg, $sent_by);
		echo "<BR>Sent successfully to Email=" . $to;
	}
   }
   
if(!empty($_POST['chk_enroll'])){
	
	if(isset($_POST["by_course"])){
	$s_key = $_POST["by_course"] ;
	}
	$batch_num=$_POST['chk_enroll'];
	mysqli_query($conn, "INSERT INTO email_send_req(req_email_dtm, req_from_email_id, req_email_recipients, req_email_subject, req_email_text, req_from_user_id)VALUES('$dtm', '$from', '$batch_num', '$subject', '$msg', '$sent_by')") or die(mysqli_error($conn));
	$last_id = mysqli_insert_id($conn);
	
	$qry=mysqli_query($conn,"SELECT DISTINCT(user_name) FROM `deal_log` where course_name like '%".$s_key."%' AND email_unsubscribe='N'");
	echo "<BR><BR><BR><BR>";
    while ($r=mysqli_fetch_array($qry))
    {
		$to= $r['user_name'];
		sisoft_email($conn, $last_id, $from, $name,$to,$subject,$msg, $sent_by);
		echo "<BR>Sent successfully to Email=" . $to;
	}
   }
    
if(!empty($_POST['chk4'])){
   $qry=mysqli_query($conn,"SELECT DISTINCT(email) FROM `user_profile` where dob like '%".$today."' AND email_unsubscribe='N'");
   echo "<BR><BR><BR><BR>";
   $batch_num = $_POST['chk4'];
   
   mysqli_query($conn, "INSERT INTO email_send_req(req_email_dtm, req_from_email_id, req_email_recipients, req_email_subject, req_email_text, req_from_user_id)VALUES('$dtm', '$from', '$batch_num', '$subject', '$msg', '$sent_by')") or die(mysqli_error($conn));
   $last_id = mysqli_insert_id($conn);
   while ($row=mysqli_fetch_array($qry))
    {
	$to=$row['email'];
	sisoft_email($conn, $last_id, $from, $name, $to,$subject,$msg, $sent_by);
	echo "<BR>Sent successfully to Email=" . $to;
    }
}

if(!empty($_POST['chk_contact'])){
   $qry=mysqli_query($conn,"SELECT DISTINCT(email) FROM `our_contact` where email_unsubscribe='N'");
   echo "<BR><BR><BR><BR>";
   $batch_num = $_POST['chk_contact'];
   
   mysqli_query($conn, "INSERT INTO email_send_req(req_email_dtm, req_from_email_id, req_email_recipients, req_email_subject, req_email_text, req_from_user_id)VALUES('$dtm', '$from', '$batch_num', '$subject', '$msg', '$sent_by')") or die(mysqli_error($conn));
   $last_id = mysqli_insert_id($conn);
   while ($row=mysqli_fetch_array($qry))
    {
	$to=$row['email'];
	sisoft_email($conn, $last_id, $from, $name, $to,$subject,$msg, $sent_by);
	echo "<BR>Sent successfully to Email=" . $to;
    }
}


}
?>
  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Mail Multiple</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="icon" type="image/png" href="images/icon.png" />

<script type="text/javascript" >
 	function searchCourses(course)
	{
		if (course.length>1) 
		{
		$.ajax({	
			url: "ajax-search-course.php",
			type: "post",
			data: {course:course} ,
			success: function (response) {
			var txt_val = "To "+ course + " Visitors :"+response ;
			$("#visitor_info").html(txt_val);
			document.getElementsByName('chk3')[0].value = txt_val ;
			$("#searchOutput").css("display","block");
			}
		});
		}
	}
</script>	

<script type="text/javascript">	
	function searchEnroll(course_enroll)
	{
		if (course_enroll.length>1) 
		{
		$.ajax({	
			url: "ajax-search-course-enroll.php",
			type: "post",
			data: {course_enroll:course_enroll} ,
			success: function (response) {	
			var txt = "To "+ course_enroll + " Customers :"+response ;
			$("#enroll_info").html(txt);
			document.getElementsByName('chk_enroll')[0].value = txt ; 
			$("#searchenroll").css("display","block");
			}
		});
		}
	}
</script>
</head>

<body style="background-color:#ccf2ff">
<div class ="container-fluid">  
	<div>
		<?php include 'header.inc.php'; ?>
	</div>
<div class="row">
  <div style="margin-top:90px;">
  <h2 class="text-primary text-center">Send Mail(Multiple)</h2>	
  </div>	
</div>      

<form class="form-horizontal" method="POST" style="margin-left:20%;" action="mail-send-multiple.php">
<div class="form-group row">
 <label class="control-label col-md-2" for="to" style="margin-left:-103px;">To<span style="color:red">*</span></label>
 
  <?php
   $qry=mysqli_query($conn,"SELECT COUNT(DISTINCT email) FROM `user_profile` where email_unsubscribe='N'");
   while ($row=mysqli_fetch_row($qry))
    {
	$customer_cnt=$row[0];
    }
   ?>
   
   <input type='checkbox' name='chk1' value="All_Customers:<?php echo $customer_cnt;?>">
   <label class="control-label" for="to1">All Customers :<?php echo $customer_cnt;?>
   </label>
 
<?php
	$todate=date("m-d");
    $qry=mysqli_query($conn,"SELECT COUNT(DISTINCT email) FROM `user_profile` where dob like '%".$todate."' AND email_unsubscribe='N'");
    while ($row=mysqli_fetch_row($qry))
    {
    $birthday_cnt=$row[0];
    }
?> 
<input type='checkbox' id="myCheck" name='chk4' value="Today_Birthday:<?php echo $birthday_cnt;?>" onclick="myFunction()" style="margin-left:21px;">
<label class="control-label" for="to3">Today's Birthday :<?php echo $birthday_cnt;?>
	
</label> 

	<?php
   $qry=mysqli_query($conn,"SELECT COUNT(DISTINCT emailID) FROM `lead_log` where email_unsubscribe='N'");
   while ($row=mysqli_fetch_row($qry))
    {
		$visitor_cnt = $row[0];
    }
	?>
<input type='checkbox' name='chk2' value="All_Visitors:<?php echo $visitor_cnt;?>" style="margin-left:21px;">
<label class="control-label" for="to2">All Visitors :<?php echo $visitor_cnt;?>
</label>
<?php
   $qry=mysqli_query($conn,"SELECT COUNT(DISTINCT email) FROM `our_contact` where email_unsubscribe='N'");
   while ($row=mysqli_fetch_row($qry))
    {
	$contact_cnt=$row[0];
    }
   ?>
   
   <input type='checkbox' name='chk_contact' value="All_Contacts:<?php echo $contact_cnt;?>" style="margin-left:16px;">
   <label class="control-label" for="to1">All Contacts :<?php echo $contact_cnt;?>
   </label>
</div>

<div class="form-group row">
<label class="control-label col-md-2">To Specific Course</label>
<div class="col-md-3">
   <input class="form-control input-md" type="text" id="searchCourse" name='by_course' placeholder="Search visitors..." onKeyUp="searchCourses(this.value); searchEnroll(this.value)">
   <div id="searchOutput" style="width:500px; height:auto; display:none;">
    <ul id="search" style="list-style: none;">
    <li style="margin-left:210px; margin-top:-40px;">
	<input type='checkbox' name='chk3' value="">
	<label class="control-label"  for="to"  id="visitor_info"></label>
	</li>
	</ul>
	</div>
	
	<div id="searchenroll" style="width:500px; height:auto; display:none;">
    <ul id="search" style="list-style: none;">
    <li style="margin-left:210px; margin-top:-6px;">
	<input type='checkbox' name='chk_enroll' value="">
	<label class="control-label"  for="to"  id="enroll_info"></label>
	</li>
	</ul>
	</div>
</div>
</div>
  
<div class="form-group row">
  <label class="control-label col-md-2" for="msg">Message Code</label>  
  <div class="col-md-3">
        <select id="ssm" name="msg" style="height:25px; width:100%; margin-top:8px;" onchange="fetch_select(this.value);">
		<option value="" disabled selected>--Select Message--</option>
	<?php
        $query = "select email_temp_name from email_template";
        $data = mysqli_query($conn, $query);  
    while($fetch_options = mysqli_fetch_array($data)) 
	{ 
		echo "<option>" .$fetch_options['email_temp_name']. "</option>" ;
    }
    ?>
        </select>
  </div>
</div>

<div class="form-group row">
<label class="control-label col-md-2" for="subject">Subject<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input name="subject" id="subject" placeholder="" required=required class="form-control input-md" type="text">
  </div>

<label class="control-label col-md-1" for="from">From<span style="color:red">*</span></label>  
  <div class="col-md-2">
	<select id="from" name="from" style="height:25px;; width:100%; margin-top:8px; overflow: hidden;">
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
 <label class="control-label col-md-2" for="msg2">Message<span style="color:red">*</span></label>  
<div  class="col-md-6">
<textarea id="msg1" name="msg2" required=required class="form-control input-md" cols="65" rows="8"></textarea>
</div>
</div>

<div class="form-group" style="margin-left:18%;">
  <label class=" control-label" for="send_multiple"></label>
  <div>
    <input type="submit" name="send_multiple" class="btn btn-info" value="Send" style="padding:10px 3%;" />
    <input type="reset"  name="Reset" class="btn" value="Reset" style="padding:10px 3%;"/>
	</div>
</div>
</form>
<script>
function fetch_select(val)
{
 $.ajax({
 type: 'post',
 dataType: "text json",
 url: 'mail-code-ajax.php',
 data: {
  get_option:val
 },
 success: function (response) {
 // alert(response);
  document.getElementById("subject").value=response[0].email_subject;
  document.getElementById("msg1").value=response[0].email_text;
  document.getElementById("msg1").value+="\n";
  document.getElementById("msg1").value+=response[0].email_sign;
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
	
</div>

<div style="position:relative; width:100%; right:0; left:0; bottom:0; margin-top:41px;">
	<?php include("footer.inc.php"); ?>
</div>

</body>
</html>