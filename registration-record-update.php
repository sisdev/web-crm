<?php
	ob_start();
	session_start();
	include 'include/dbi.php';
	include 'include/session.php';
	include 'include/param.php';
	checksession();
		
	if(isset($_GET['update_id']))
	{
	$get= $_GET['update_id'];
	}
	$qry=mysqli_query($conn,"select * from deal_log where enroll_id = '".$get."' ");
	$rec=mysqli_fetch_array($qry);
	$profile_id=$rec['user_profile_id'];
	$q=mysqli_query($conn,"select * from user_profile where id = '".$profile_id."' ");
	$r=mysqli_fetch_array($q);
	echo mysqli_error($conn);
	if(isset($_POST['registration_update']))
			{
				$email=$_POST['email'];
				$reg_date=$_POST['reg_date'];
				$reg_id=$_POST['reg_id'];
				$user_id=$_POST['user_profile_id'];
				$reg_batch_id=$_POST['reg_batch_id'];
				$reg_courseName=$_POST['reg_courseName'];
				$reg_courseFee=$_POST['reg_courseFee'];
				$reg_paymentStatus=$_POST['reg_paymentStatus'];
				$created_by=$_SESSION['login'];
		
				$sql="UPDATE deal_log SET user_name='$email',enroll_dtm='$reg_date',reg_id='$reg_id',user_profile_id='$user_id',batch_id='$reg_batch_id',course_name='$reg_courseName',course_fee='$reg_courseFee',payment_status='$reg_paymentStatus' where enroll_id='$get' ";
				echo $sql;
				$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
				echo mysqli_error($conn);
				header("location:manage-registration.php");
				exit;
			}
	
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Update Sales Deal</title>
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
			alert("Registration data modified successfully....");
		}
		</script>
	</head>
	
<body style="background-color:#ccf2ff">
	<div class ="container-fluid" >  
	<div>
		<?php include 'header.inc.php'; ?>
	</div>
	<div class="row" style="margin-top:80px;">
		<div class="col-md-2">
			<ul class="pager">
			<li class="previous"><a href="manage-registration.php" style="border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);"><< Back</a></li>
			</ul>
		</div>
		<div class="col-md-8">
				<h2 class="text-primary text-center" >Update- Sales DEAL</h2>
		</div>
		</div>
	
	
<form class="form-horizontal" style="margin-left:10%; margin-top:30px;" method="POST" onSubmit="return validateForm(this)">

<div class="form-group row">
  <label class="control-label col-md-2" for="name">Name</label>  
  <div class="col-md-3">
	<input name="name" id="name" class="form-control input-md" readonly type="text" value="<?php echo $r['name']; ?>">
  </div>
  <label class="control-label col-md-2" for="phone">Phone</label>  
  <div class="col-md-3">
	<input name="phone" id="phone" class="form-control input-md" readonly type="text" value="<?php echo $r['phone_main']; ?>">
  </div>
</div>

<div class="form-group row">
<label class="control-label col-md-2" for="user_profile_id">User Profile ID</label>  
  <div class="col-md-3">
	<input  name="user_profile_id" required=required class="form-control input-md" type="text" value="<?php echo $rec['user_profile_id']; ?>">
  </div>
  <label class="control-label col-md-2" for="email">Email</label>  
  <div class="col-md-3">
	<input  name="email" required=required class="form-control input-md" type="email" value="<?php echo $rec['user_name']; ?>">
  </div>
</div>

<div class="form-group row">
  <label class="control-label col-md-2" for="reg_date"><?php echo $order_no; ?></label>  
  <div class="col-md-3">
	<input  name="reg_id" required=required class="form-control input-md" type="text" value="<?php echo $rec['reg_id']; ?>">
  </div>
  <label class="control-label col-md-2" for="reg_date"><?php echo $order_date; ?><span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="reg_date" required=required class="form-control input-md" type="datetime" value="<?php echo $rec['enroll_dtm']; ?>">
  </div>
</div>

  
<div class="form-group row">
<label class="control-label col-md-2"  for="reg_courseName"><?php echo $product_name; ?></label>  
  <div class="col-md-3">
	<input  name="reg_courseName" required=required class="form-control input-md" type="text" value="<?php echo $rec['course_name']; ?>">
  </div>
 <label class="control-label col-md-2" for="reg_courseFee"><?php echo $product_price; ?></label>  
  <div class="col-md-3">
	<input  name="reg_courseFee" required=required class="form-control input-md" type="text" value="<?php echo $rec['course_fee']; ?>">
  </div> 
</div>

<div class="form-group row">
<label class="control-label col-md-2" for="reg_batch_id"><?php echo $product_sn; ?></label>  
  <div class="col-md-3">
	<input  name="reg_batch_id" required=required class="form-control input-md" type="text" value="<?php echo $rec['batch_id']; ?>">
  </div>
  
  <label class="control-label col-md-2"  for="reg_paymentStatus">Payment Status</label>  
  <div class="col-md-3">
	<input  name="reg_paymentStatus" required=required class="form-control input-md" type="text" value="<?php echo $rec['payment_status']; ?>">
  </div> 
</div>

	
<div class="form-group" style="margin-left:30%; margin-top:30px;">
  <label class=" control-label" for="registration_update"></label>
  <div>
    <input type="submit" name="registration_update" class="btn btn-warning" value="Update" style="border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19); padding:10px 7%;"/>
    <input type="button"  onClick="location.href = 'manage-registration.php';" value="Cancel" name="user_cancel" class="btn" style="border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19); padding:10px 7%;"/>
	</div>
</div>
</form>

		
		</div>
		<div style="margin-top:150px;">
		<?php include("footer.inc.php");?>
		</div>	
	</body>
</html>