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
	$qry=mysqli_query($conn,"select * from user_profile where id = '".$get."' ");
	$rec=mysqli_fetch_array($qry);
	
	if(isset($_POST['user_update']))
			{
				$email=$_POST['user_email'];
				$name=$_POST['user_name'];
				$father_name=$_POST['user_fname'];
				$gender=$_POST['user_gender'];
				$dob=$_POST['user_dob'];
				$marital_status=$_POST['user_marital_status'];
				$cur_add=$_POST['user_cur_add'];
				$perm_add=$_POST['user_perm_add'];
				$citizen_country=$_POST['user_country'];
				$phone_alt=$_POST['user_alter_mobile'];
				$qualification=$_POST['user_education'];
				$experience=$_POST['user_exp'];
				$phone_main=$_POST['user_primary_mobile'];
				$comp=$_POST['comp'];
				$seg=$_POST['indus_seg'];
				$subseg=$_POST['indus_subseg'];
				$gst=$_POST['gst'];
				$sql="UPDATE user_profile SET email='$email',name='$name',father_name='$father_name',gender='$gender',dob='$dob',marital_status='$marital_status',cur_add='$cur_add',perm_add='$perm_add',citizen_country='$citizen_country',phone_alt='$phone_alt',qualification='$qualification',experience='$experience',phone_main='$phone_main', comp_name='$comp',indus_seg='$seg', indus_subseg='$subseg', gstin='$gst' where id='$get' ";
				echo $sql;
				$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
				//echo mysqli_error($conn);
				header("location:manage-user.php");
				exit;
			}
	
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Update User Details</title>
		<link rel="icon" type="image/png" href="images/icon.png" />
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- Include Date Range Picker -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
<script>
		function validateForm()
		{
			alert("User data modified successfully....");
		}
</script>

<script>
    $(document).ready(function(){
		var date_input=$('input[name="user_dob"]'); //our date input has the name "date"
		var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
		date_input.datepicker({
			format: 'yyyy-mm-dd',
			container: container,
			todayHighlight: true,
			autoclose: true,
		}) ;

		profile_type = ("#user_type").val() ; 

	if($(profile_type == "Individual")

	{
		$(".corporate_text").hide();
		$(".individual_text").show();
		$(".form-horizontal").css('margin-bottom','87px');
		
	}
	else{
		$(".corporate_text").show();
		$(".individual_text").hide();
		$(".form-horizontal").css('margin-bottom','203px');
	}	
	}) ; 
</script>
</head>
	
<body style="background-color:#ccf2ff">
	<div class ="container-fluid" >  
	<div>
		<?php include 'header.inc.php'; ?>
	</div>
	<div style="margin-top:90px;">
	<h2 class="text-primary text-center">Update- User Records</h2>
	</div>
		
	
<form class="form-horizontal" style="margin-left:10%;" method="POST" onSubmit="return validateForm(this)">
	<div class="form-group row">
	<label class="control-label col-md-2" for="cust_type">Customer Type</label>  
  <div class="col-md-3">
	<input  name="user_type" id="user_type" value="<?php echo $rec['cust_type']; ?>" class="form-control input-md" type="text" readonly>
  </div>
  
	<label class="control-label col-md-2"  for="user_email">E-mail ID</label>  
	<div class="col-md-3">
	<input name="user_email" id="user_email" value="<?php echo $rec['email']; ?>" class="form-control input-md" type="email">
	</div>
	</div>	
	
<div class="form-group row">
  <label class="control-label col-md-2"  for="user_name">Name</label>  
  <div class="col-md-3">
	<input  name="user_name" id="user_name" value="<?php echo $rec['name']; ?>" class="form-control input-md" type="text">
  </div>
  <div class="individual_text" style="display:none;" >
  <label class="control-label col-md-2"  for="user_fname">Father's Name</label>  
  <div class="col-md-3">
	<input  name="user_fname" id="user_fname" value="<?php echo $rec['father_name']; ?>" class="form-control input-md" type="text">
  </div>
  </div>

 <div class="corporate_text">
 <label class="control-label col-md-2" for="comp">Company</label>  
  <div class="col-md-3">
	<input  name="comp" class="form-control input-md" type="text" value="<?php echo $rec['comp_name']; ?>">
  </div>
</div>
</div>

 <div class="corporate_text">
<div class="form-group row">
  <label class="control-label col-md-2" for="indus_seg">Segment</label>  
  <div class="col-md-3">
	<input  name="indus_seg" class="form-control input-md" type="text" value="<?php echo $rec['indus_seg']; ?>">
  </div>
   <label class="control-label col-md-2" for="indus_subseg">Subsegment</label>  
  <div class="col-md-3">
	<input  name="indus_subseg" class="form-control input-md" type="text"  value="<?php echo $rec['indus_subseg']; ?>">
  </div>
</div>
</div>
  
 <div class="individual_text" style="display:none;" >
 <div class="form-group row">
  <label class="control-label col-md-2"  for="user_dob">Date of Birth</label>  
  <div class="col-md-3">
   <div class="input-group">
	<input name="user_dob" id="user_dob" value="<?php echo $rec['dob']; ?>" class="form-control input-md" type="text"><div class="input-group-addon">
         <i class="fa fa-calendar">
         </i>
        </div>
  </div>
  </div>
  <label class="control-label col-md-2">Gender</label>
  <div class="col-md-3">
  <select class="form-control" name="user_gender" id="user_gender" >
		<?php 
	 for ($i=0;$i<count($gender); $i++)
	 {
                echo '<option value="'. $gender[$i] .'"';
                if ( $rec['gender'] == $gender[$i] ) echo 'selected="selected"';
                echo '>'. $gender[$i] .'</option>';
            }
		?>
  </select>   
</div> 
</div>
</div>

<div class="individual_text" style="display:none;" >
 <div class="form-group row">
 <label class="control-label col-md-2">Marital Status</label>
  <div class="col-md-3">
  <select class="form-control" name="user_marital_status" id="user_marital_status">
		<?php 
	 for ($i=0;$i<count($marital_status); $i++)
	 {
                echo '<option value="'. $marital_status[$i] .'"';
                if ( $rec['marital_status'] == $marital_status[$i] ) echo 'selected="selected"';
                echo '>'. $marital_status[$i] .'</option>';
            }
		?>
  </select>   
</div>
<label class="control-label col-md-2"  for="user_country">Citizen Country</label>  
  <div class="col-md-3">
	<input  name="user_country" id="user_country" value="<?php echo $rec['citizen_country']; ?>" class="form-control input-md" type="text">
  </div>
</div> 
</div> 

<div class="form-group row">
  <label class="control-label col-md-2"  for="user_mob_primary">Phone No (Primary)</label>  
  <div class="col-md-3">
	<input  name="user_primary_mobile" id="user_primary_mobile" class="form-control input-md" value="<?php echo $rec['phone_main']; ?>">
  </div>
  <label class="control-label col-md-2"  for="user_mob_alternate">Phone No (Alternate)</label>  
  <div class="col-md-3">
	<input name="user_alter_mobile" id="user_alter_mobile" class="form-control input-md" type="text" value="<?php echo $rec['phone_alt']; ?>">
  </div>
</div>


<div class="individual_text" style="display:none;" >
<div class="form-group row">
  <label class="col-md-2 control-label" for="user_qualification">Educational Qualification</label>  
  <div class="col-md-3">
	<textarea name="user_education" id="user_education" class="form-control input-md"><?php echo $rec['qualification']; ?></textarea>
  </div>

  <label class="col-md-2 control-label" for="user_experience">Professional Experience</label>  
  <div class="col-md-3">
	<textarea name="user_exp" id="user_exp" class="form-control input-md"><?php echo $rec['experience']; ?></textarea>
  </div>
</div>
</div>

<div class="form-group row">
  <div class="corporate_text">
   <label class="control-label col-md-2" for="gst">GST No</label>  
  <div class="col-md-3">
	<input  name="gst" class="form-control input-md" type="text" value="<?php echo $rec['gstin']; ?>">
  </div>
  </div>

   <label class="col-md-2 control-label" for="user_caddress">Current Address</label>  
  <div class="col-md-3">
	<textarea name="user_cur_add" id="user_cur_add" class="form-control input-md"><?php echo $rec['cur_add']; ?></textarea>
  </div>

<div class="individual_text" style="display:none;" >
  <label class="col-md-2 control-label" for="user_paddress">Permanent Address</label>  
  <div class="col-md-3">
	<textarea name="user_perm_add" id="user_perm_add" class="form-control input-md"><?php echo $rec['perm_add']; ?></textarea>
  </div>
  </div>
</div>


<div class="form-group" style="margin-left:30%;">
  <label class=" control-label" for="user_update"></label>
  <div>
    <input type="submit" name="user_update" class="btn btn-warning" value="Update" style="border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19); padding:10px 7%;"/>
    <input type="button"  onClick="location.href = 'manage-user.php';" value="Cancel" name="user_cancel" class="btn" style="border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19); padding:10px 7%;"/>
	</div>
</div>
</form>

		
		</div>
		<div>
		<?php include("footer.inc.php");?>
		</div>	
	</body>
</html>