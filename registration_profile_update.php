<?php
	ob_start();
	session_start();

	include 'include/dbi.php';
	include 'include/session.php';

	checksession();
	if(isset($_GET['update_id']))
	{
	$get_id=$_GET['update_id'];
	}
	$qry=mysqli_query($conn,"select * from user_profile where id = '$get_id' ");
	$rec=mysqli_fetch_array($qry);
	
	if(isset($_POST['profile_update']))
			{
				//$email=$_POST['profile_email'];
				$reg_id=$_POST['profile_reg_id'];
				$name=$_POST['profile_name'];
				$father_name=$_POST['profile_fname'];
				$gender=$_POST['profile_gender'];
				$dob=$_POST['profile_dob'];
				$marital_status=$_POST['profile_marital_status'];
				$cur_add=$_POST['profile_cur_add'];
				$perm_add=$_POST['profile_perm_add'];
				$citizen_country=$_POST['profile_country'];
				$phone_alt=$_POST['profile_alter_mobile'];
				$qualification=$_POST['profile_education'];
				$experience=$_POST['profile_exp'];
				$phone_main=$_POST['profile_primary_mobile'];
				$sql="update  user_profile set reg_id='$reg_id',name='$name',father_name='$father_name',gender='$gender',dob='$dob',marital_status='$marital_status',cur_add='$cur_add',perm_add='$perm_add',citizen_country='$citizen_country',phone_alt='$phone_alt',qualification='$qualification',experience='$experience',phone_main='$phone_main' where id='$get_id' ";
				echo $sql;
				$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
				
				//header("location:training_query.php?mobile=$mob ");
				header("location:registration_query.php");
				exit;
			}
	
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Update Profile Details</title>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="js/jquery-2.2.0.min.js" type="text/javascript"></script> 
<link rel="stylesheet" type="text/css" href="css/jquery.timepicker.css">
<link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
<link rel="icon" type="image/png" href="images/icon.png" />
<script src="js/jquery-ui.js" type="text/javascript"></script> 

<script>
function validateForm()
{
alert("Profile data modified successfully....");
}
</script>
</head>
	
<body style="background-color:#ccf2ff">
	<div class ="container-fluid" >   	<!-- body -->
	<div>
		<?php include 'header.inc.php'; ?>
	</div>
	<div class="row" style="margin-top:100px;">
		<div class="col-md-2">
			<ul class="pager">
			<li class="previous"><a href="registration_query.php"><< Back</a></li>
			</ul>
		</div>
		<div class="col-md-8">
				<h2 class="text-primary text-center">Update- Registration Records</h2>
		</div>
		</div>
	
	
<form class="form-horizontal" style="margin-left:10%;" method="POST" onSubmit="return validateForm(this)">
	<div class="form-group row">
	<label class="control-label col-md-2"  for="profile_email">E-mail ID<span style="color:red">*</span></label>  
	<div class="col-md-3">
	<input name="profile_email" id="profile_email" value="<?php echo $rec['email']; ?>" required=required class="form-control input-md" type="email">
	</div>
	<label class="control-label col-md-2"  for="profile_reg_id">Registration ID<span style="color:red">*</span></label>  
	<div class="col-md-3">
	<input  name="profile_reg_id" id="profile_reg_id" required=required class="form-control input-md" type="text" value="<?php echo $rec['reg_id']; ?>">
	</div>
	</div>	
	
<div class="form-group row">
  <label class="control-label col-md-2"  for="profile_name">Name<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="profile_name" id="profile_name" value="<?php echo $rec['name']; ?>" required=required class="form-control input-md" type="text">
  </div>
  <label class="control-label col-md-2"  for="profile_fname">Father's Name<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="profile_fname" id="profile_fname" value="<?php echo $rec['father_name']; ?>" class="form-control input-md" required=required type="text">
  </div>
</div>
  
 <div class="form-group row">
  <label class="control-label col-md-2"  for="u_dob">Date of Birth<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input name="profile_dob" id="profile_dob" value="<?php echo $rec['dob']; ?>" required=required class="form-control input-md" type="date">
  </div>
  <label class="control-label col-md-2">Gender<span style="color:red">*</span></label>
  <div class="col-md-3">
  <select class="form-control" name="profile_gender" id="profile_gender" required=required>
		<option value="<?php echo $rec['gender']; ?>">Male</option>
		<option value="<?php echo $rec['gender']; ?>">Female</option>
  </select>   
</div> 
</div>

 <div class="form-group row">
 <label class="control-label col-md-2">Marital Status<span style="color:red">*</span></label>
  <div class="col-md-3">
  <select class="form-control" name="profile_marital_status" id="profile_marital_status" required=required>
		<option value="<?php echo $rec['marital_status']; ?>">Single</option>
		<option value="<?php echo $rec['marital_status']; ?>">Married</option>
  </select>   
</div>
<label class="control-label col-md-2"  for="u_country">Citizen Country<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="profile_country" id="profile_country" value="<?php echo $rec['citizen_country']; ?>" required=required class="form-control input-md" type="text">
  </div>
</div> 

<div class="form-group row">
  <label class="control-label col-md-2"  for="u_mob_primary">Phone No (Primary)<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="profile_primary_mobile" id="profile_primary_mobile" required=required class="form-control input-md" value="<?php echo $rec['phone_main']; ?>">
  </div>
  <label class="control-label col-md-2"  for="u_mob_alternate">Phone No (Alternate)<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input name="profile_alter_mobile" id="profile_alter_mobile" class="form-control input-md" type="text" value="<?php echo $rec['phone_alt']; ?>">
  </div>
</div>

<div class="form-group row">
  <label class="col-md-2 control-label" for="u_caddress">Current Address<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<textarea name="profile_cur_add" id="profile_cur_add" required=required class="form-control input-md"><?php echo $rec['cur_add']; ?></textarea>
  </div>

  <label class="col-md-2 control-label" for="u_paddress">Permanent Address<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<textarea name="profile_perm_add" id="profile_perm_add" required=required class="form-control input-md"><?php echo $rec['perm_add']; ?></textarea>
  </div>

</div>

<div class="form-group row">
  <label class="col-md-2 control-label" for="u_qualification">Educational Qualification<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<textarea name="profile_education" id="profile_education" required=required class="form-control input-md"><?php echo $rec['qualification']; ?></textarea>
  </div>

  <label class="col-md-2 control-label" for="u_experience">Professional Experience<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<textarea name="profile_exp" id="profile_exp" required=required class="form-control input-md"><?php echo $rec['experience']; ?></textarea>
  </div>
</div>
	
<div class="form-group" style="margin-left:30%;">
  <label class=" control-label" for="profile_update"></label>
  <div>
    <input type="submit" name="profile_update" class="btn btn-warning" value="Update" style="padding:10px 7%;"/>
    <input type="button"  onClick="location.href = 'registration_query.php';" value="Cancel" name="reg_cancel" class="btn" style="padding:10px 7%;"/>
	</div>
</div>
</form>

		
		</div>
		<div>
		<?php include("footer.inc.php");?>
		</div>	
	</body>
</html>