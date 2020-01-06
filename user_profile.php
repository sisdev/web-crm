<?php
ob_start();
session_start();

include 'include/dbi.php';
include 'include/session.php';

checksession();
$debug=true ;

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>User Profile</title>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />

<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="js/jquery-2.2.0.min.js" type="text/javascript"></script> 
<link rel="stylesheet" type="text/css" href="css/jquery.timepicker.css">
<link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
<script src="js/jquery.timepicker.js" type="text/javascript"></script>
<script src="js/jquery-ui.js" type="text/javascript"></script> 
<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" /> 
<link rel="icon" type="image/png" href="images/icon.png" />
<!--Font Awesome (added because you use icons in your prepend/append)-->
<link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css" />

<!-- HTML Form (wrapped in a .bootstrap-iso div) -->
<script type="text/javascript">

$(document).ready(function(){
	$("#u_email").change(function(){
		var username = $("#u_email").val();
		var msgbox = $("#status");
		
		if(username.length > 4){
			$("#status").html('<img src="images/loader.gif" align="absmiddle">&nbsp;Checking availability...');
			$.ajax({
				type: "POST",
				url: "reg_email_check_ajax.php",
				data: "u_email="+ username,  
				success: function(msg){  
						if(msg == 'OK'){
							$("#u_email").removeClass("red");
							$("#u_email").addClass("green");
							msgbox.html('<img src="images/available.png" align="absmiddle">');
						}else{
							$("#u_email").removeClass("green");
							$("#u_email").addClass("red");
							msgbox.html(msg);
							$("#u_email").focus();
						}
					}
			});
		}else{
			$("#u_email").addClass("red");
			$("#status").html('<font color="#cc0000">Please enter atleast 5 letters.</font>');
			$("#u_email").focus();
		}
		return false;
	});
});
</script>

<script>
function validateForm()
{
	alert("User profile create successfully....");
}

function validateEnrollForm()
{
	alert("User registered successfully....");
}


</script>
<style>
#status{
	font-size:10px;
	margin-left:0px;
}
.green{
	background-color:#CEFFCE;
}
.red{
	background-color:#FFD9D9;
	font-size: 14px;
    font-weight: bold;
    color: #FF0000;
}
</style>
</head>

<body style="background-color:#ccf2ff">
<div class ="container-fluid">   
	<div>
		<?php include 'header.inc.php'; ?>
	</div>

	 <div>
	<h2 class="text-primary text-center" style="margin-top:100px;">User Registration</h2>
	</div>
<form class="form-horizontal" style="margin-left:10%; margin-bottom:60px;" method="POST" onSubmit="return validateForm(this)">
<div class="form-group row">
  <label class="control-label col-md-2"  for="u_email">E-mail ID<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="u_email" id="u_email" required=required class="form-control input-md" type="email"><span id="status"></span></input>
  </div>
  <label class="control-label col-md-2"  for="reg_id">Registration ID<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="reg_id" required=required class="form-control input-md" type="text">
  </div>
</div>

<div class="form-group row">
  <label class="control-label col-md-2"  for="u_name">Name<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="u_name" required=required class="form-control input-md" type="text">
  </div>
  <label class="control-label col-md-2"  for="u_fname">Father's Name<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="u_fname" required=required class="form-control input-md" type="text">
  </div>
</div>
  
 <div class="form-group row">     
  <label class="control-label col-md-2"  for="u_dob">Date of Birth<span style="color:red">*</span></label>  
  <div class="col-md-3">
  <div class="input-group">
	<input class="form-control" name="u_dob" required=required class="form-control input-md" type="date">
	 <div class="input-group-addon">
         <i class="fa fa-calendar">
         </i>
        </div>
  </div>
  </div>
  <label class="control-label col-md-2">Gender<span style="color:red">*</span></label>
  <div class="col-md-3">
  <select class="form-control" name="u_gender" required=required>
		<option value="" disabled selected>Select Gender</option>
		<option value="Male">Male</option>
		<option value="Female">Female</option>
  </select>   
</div> 
</div>

 <div class="form-group row">
 <label class="control-label col-md-2">Marital Status<span style="color:red">*</span></label>
  <div class="col-md-3">
  <select class="form-control selectpicker" name="m_status" required=required>
		<option value="" disabled selected>Select Status</option>
		<option value="Single">Single</option>
		<option value="Married">Married</option>
  </select>   
</div>
<label class="control-label col-md-2"  for="u_country">Nationality:<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="u_country" required=required class="form-control input-md" type="text" value="India">
  </div>
</div> 

<div class="form-group row">
  <label class="control-label col-md-2"  for="u_mob_primary">Phone No (Primary)<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="u_mob_primary" required=required class="form-control input-md" type="text" maxlength="10" pattern="[0-9]{10}">
  </div>
  <label class="control-label col-md-2"  for="u_mob_alternate">Phone No (Alternate)</label>  
  <div class="col-md-3">
	<input  name="u_mob_alternate" maxlength="10" pattern="[0-9]{10}" class="form-control input-md" type="text">
  </div>
</div>

<div class="form-group row">
  <label class="col-md-2 control-label" for="u_caddress">Current Address<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<textarea name="u_caddress" required=required class="form-control input-md"></textarea>
  </div>
  <label class="col-md-2 control-label" for="u_paddress">Permanent Address<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<textarea name="u_paddress" required=required class="form-control input-md"></textarea>
  </div>
</div>

<div class="form-group row">
  <label class="col-md-2 control-label" for="u_qualification">Educational Qualification<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<textarea name="u_qualification" required=required class="form-control input-md"></textarea>
  </div>
  <label class="col-md-2 control-label" for="u_experience">Professional Experience<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<textarea name="u_experience" required=required class="form-control input-md"></textarea>
  </div>
</div>
	<div>
	<h2 class="text-primary text-center" style="margin-right:12%;">Course Registration</h2>
	</div>
	
<div class="form-group row">
  <label class="control-label col-md-2"  for="reg_date">Registration Date<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="reg_date" required=required class="form-control input-md" type="datetime" value="<?php echo date('Y-m-d'); ?>">
  </div>
  <label class="control-label col-md-2"  for="reg_batch_id">Batch ID<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="reg_batch_id" required=required class="form-control input-md" type="text">
  </div>
</div>

<div class="form-group row">
  <label class="control-label col-md-2"  for="reg_courseName">Course Name<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="reg_courseName" required=required class="form-control input-md" type="text">
  </div>
  <label class="control-label col-md-2"  for="reg_courseFee">Course Fee<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="reg_courseFee" required=required class="form-control input-md" type="text">
  </div>
</div>

<div class="form-group row">
  <label class="control-label col-md-2"  for="reg_paymentStatus">Payment Status<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="reg_paymentStatus" required=required class="form-control input-md" type="text">
  </div> 
</div>

<div class="form-group" style="margin-left:30%;">
  <label class=" control-label" for="c_submit"></label>
  <div>
    <input type="submit" name="u_submit" class="btn btn-info" value="Submit" style="padding:10px 7%;"/>
    <input type="reset"  name="Reset" class="btn" value="Reset" onClick="window.location.reload()" style="padding:10px 7%;"/>
	</div>
</div>
</form>

<?php 
if(isset($_POST['u_submit']))
{
	$u_email=$_POST['u_email'];
	$u_mob_primary=$_POST['u_mob_primary'];
	$u_name=$_POST['u_name'];
	$u_dob=$_POST['u_dob'];
	$u_gender=$_POST['u_gender'];
	$m_status=$_POST['m_status'];
	$u_fname=$_POST['u_fname'];
	$u_country=$_POST['u_country'];
	$u_caddress=$_POST['u_caddress'];
	$u_paddress=$_POST['u_paddress'];
	$u_qualification=$_POST['u_qualification'];
	$u_experience=$_POST['u_experience'];
	$u_mob_alternate=$_POST['u_mob_alternate'];
	$reg_id=$_POST['reg_id'];

	$insert_user_profile_qry="insert into user_profile (email,reg_id,phone_main,name,father_name,gender,dob,marital_status,cur_add,perm_add,citizen_country,phone_alt,qualification,experience,update_dtm,update_ip)
 values('$u_email','$reg_id','$u_mob_primary','$u_name','$u_fname','$u_gender','$u_dob','$m_status','$u_caddress','$u_paddress','$u_country','$u_mob_alternate','$u_qualification','$u_experience',CURRENT_TIMESTAMP(),'.$_SERVER[REMOTE_ADDR].') " ;

    if ($debug) echo $insert_user_profile_qry ;	
	$result= mysqli_query($conn,$insert_user_profile_qry) ;
	if ($result==false){
		$error=mysqli_error($conn) ;
		echo "<BR>Error in Insert user_profile".$error ;
		die($error) ; // If not inserted here.. please stop 

	}
    $id = mysqli_insert_id($conn); 
}
?>

<?php
	if(isset($_POST['u_submit']))
	{
		$u_email=$_POST['u_email'];
		$reg_date=$_POST['reg_date'];
		$reg_batch_id=$_POST['reg_batch_id'];
		$reg_courseName=$_POST['reg_courseName'];
		$reg_courseFee=$_POST['reg_courseFee'];
		$reg_paymentStatus=$_POST['reg_paymentStatus'];
		$last_id=$id;
		$insert_trng_enroll_qry="insert into trng_enroll (user_name,enroll_dtm,user_profile_id,batch_id,course_name,course_fee,payment_status,enroll_ip) 
		values('$u_email','$reg_date','$last_id','$reg_batch_id','$reg_courseName','$reg_courseFee','$reg_paymentStatus','.$_SERVER[REMOTE_ADDR].')" ;
		if ($debug) echo "<BR>".$insert_trng_enroll_qry ;
		$result=mysqli_query($conn,$insert_trng_enroll_qry);

		if ($result==false){
			$error=mysqli_error($conn) ;
			echo "<BR>Error in Insert trng_enroll".$error ;
		}

	}
?>


	
</div>
<div style="position:relative; bottom:0; width:100%; left:0; right:0;">
		<?php include("footer.inc.php"); ?>
	</div>

</body>
</html>