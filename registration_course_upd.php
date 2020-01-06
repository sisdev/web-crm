<?php 
ob_start();
session_start();
include 'include/dbi.php';
include 'include/session.php';
//$db = new db;
if(isset($_GET['mod_id']))
{
$lead_val=$_GET['mod_id'];

$record=mysqli_query($conn,"select * from trng_enroll l where l.enroll_id='".$_GET['mod_id']."'");
$fetch=mysqli_fetch_array($record);
}
if(isset($_POST['cancel']))
{

	 header("location:registration_view_record.php?view_id=".$_GET['view_id']);
}
  if(isset($_POST['update']))
	  {
		   $update_reg_date=$_POST['mod_date'];
		   $update_batch_id=$_POST['mod_batch_id'];
		   $update_course_name=$_POST['mod_course_name'];
		   $update_course_fee=$_POST['mod_course_fee'];
		   $update_payment_status=$_POST['mod_payment_status'];
		   
		  mysqli_query($conn,"update trng_enroll set enroll_dtm='$update_reg_date',batch_id='$update_batch_id',course_name='$update_course_name',course_fee='$update_course_fee',payment_status='$update_payment_status' where enroll_id='$lead_val'") or die(mysqli_error($conn));
		  
header("Location:registration_view_record.php?view_id=".$_GET['view_id']);
	 
} 
?>
<html>
<head>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="js/jquery-2.2.0.min.js" type="text/javascript"></script> 
<link rel="stylesheet" type="text/css" href="css/jquery.timepicker.css">
<link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
<script src="js/jquery.timepicker.js" type="text/javascript"></script> 
<script src="js/jquery-2.2.0.min.js" type="text/javascript"></script> 
<script src="js/jquery-ui.js" type="text/javascript"></script> 

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Admin Panel</title>
     
      
        <!--<link href="css/datetimepicker.css" rel="stylesheet" type="text/css">-->
       
       <script>
	   $(document).ready(function(){
		
		  $("#todaydate").focus(function(){
		$(this).datepicker({dateFormat: 'dd-mm-yy'}).val();
	});
	
	$("#todaytime").focus(function(){
		$(this).timepicker({timeFormat:  'hh:mm:ss'}).val();
	});
	 
	   });
	   </script>
	   <script>
		function validateForm()
		{
			alert("Registered course data updated successfully....");
		}
		</script>
    </head>

<body style="background-color:#ccf2ff">
<div class ="container-fluid">   	
	<div>
		<?php include 'header.inc.php'; ?>
	</div>
	<div>
	<h2 class="text-primary text-center" style="margin-top:7%;" >Update Course Registration</h2>
	</div> 
	

<form class="form-horizontal" style="margin-top:50px;" method="post">
<fieldset style="margin-left:12%;">

<!-- Form Name -->


<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="mod_date">Registration Date :</label>  
  <div class="col-md-3">
	<input  name="mod_date" placeholder="" id="todaydate" value="<?php echo substr($fetch['enroll_dtm'],0,10);?>" class="form-control input-md" required="" type="text">
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="mod_batch_id">Batch ID :</label>  
  <div class="col-md-3">
  <input  name="mod_batch_id" id="batchid" placeholder="" value="<?php echo $fetch['batch_id']; ?>" class="form-control input-md" required="" type="text">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="mod_course_name">Course Name :</label>  
  <div class="col-md-3">
  <input  name="mod_course_name" id="coursename" placeholder="" value="<?php echo $fetch['course_name']; ?>" class="form-control input-md" required="" type="text">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="mod_course_fee">Course Fee :</label>  
  <div class="col-md-3">
  <input  name="mod_course_fee" id="coursefee" placeholder="" value="<?php echo $fetch['course_fee']; ?>" class="form-control input-md" required="" type="text">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="mod_payment_status">Payment Status :</label>  
  <div class="col-md-3">
  <input  name="mod_payment_status" id="paymentstatus" placeholder="" value="<?php echo $fetch['payment_status']; ?>" class="form-control input-md" required="" type="text">
    
  </div>
</div>

<!-- Button (Double) -->
<div class="form-group">
  <label class="col-md-4 control-label" for="update"></label>
  <div class="col-md-6">
    <input type="submit"  name="update" class="btn btn-warning" value="Update"/>
    <input type="submit"  name="cancel" class="btn" value="Cancel"/>
	</div>
</div>

</fieldset>
</form>
		<div style="position:absolute; width:100%; left:0; right:0; bottom:0;">
		<?php include("footer.inc.php"); ?>
		</div>
</body>
</html>