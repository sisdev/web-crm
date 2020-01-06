<?php
ob_start();
session_start();
include 'include/dbi.php';
include 'include/session.php';
include 'include/param.php';
checksession();
if(isset($_GET['view_id']))
{
	$id=$_GET['view_id'];
	$query=mysqli_query($conn,"select * from our_contact where id = '$id'");
	$row=mysqli_fetch_array($query);
	$em=$row['email'];
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>View Contact</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/jquery.timepicker.css">
<link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
<script src="js/jquery.timepicker.js" type="text/javascript"></script> 
<script src="js/jquery-2.2.0.min.js" type="text/javascript"></script> 
<script src="js/jquery-ui.js" type="text/javascript"></script> 
<link rel="icon" type="image/png" href="images/icon.png" />

</head>

<body style="background-color:#ccf2ff">
<div class ="container-fluid">
<div>
<?php include 'header.inc.php'; ?>
</div>

<div class="row" style="margin-top:75px;">
<div style="margin-top:30px; margin-left:40px;">
<ul class="pager">
<li class="previous"><a href="contact-manage.php" style="border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);"><< Back</a></li>
</ul>
</div>
<h2 class="text-primary text-center" style="margin-right:50px; margin-top:-50px;">View Contact</h2>
<form id="add_lead" action ="training_lead_add.php" method="GET" style="float:right; margin-top:-40px; margin-right:30px;">
<input type="submit" class="btn btn-success" role="button" value="Add To Lead" style="border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);"/>
<input type="hidden" name="view_id" value="<?php echo $row['id']; ?>"/>
</form>
</div>  

<form class="form-horizontal" style="margin-left:10%;" method="POST" onSubmit="return validateForm(this)">
<div class="form-group row">
  <label class="control-label col-md-2" for="c_per_phone">Personal Phone<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="c_per_phone" required=required class="form-control input-md" type="text" maxlength="10" readonly value="<?php echo $row['p_phone']; ?>">
  </div>
  
  <label class="control-label col-md-2" for="c_email">Email ID<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="c_email" class="form-control input-md" type="email" readonly value="<?php echo $row['email']; ?>">
  </div>
</div>

<div class="form-group row">
 <label class="control-label col-md-2"  for="c_fname">First Name<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input name="c_fname" required=required class="form-control input-md" type="text" readonly value="<?php echo $row['fname']; ?>">
  </div>
  
   <label class="control-label col-md-2"  for="c_lname">Last Name<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input name="c_lname" required=required  class="form-control input-md" type="text" readonly value="<?php echo $row['lname']; ?>">
  </div>
</div>

<div class="form-group row">
<label class="control-label col-md-2"  for="c_design">Designation<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input name="c_design" required=required class="form-control input-md" type="text" readonly value="<?php echo $row['designation']; ?>">
  </div>
  
<label class="control-label col-md-2" for="c_source">Contact Source<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input name="c_source" required=required class="form-control input-md" type="text" readonly value="<?php echo $row['c_source']; ?>">
  </div>  
</div>

<h4 class="text-primary">Company Info</h4>
<div class="form-group row">
 <label class="control-label col-md-2"  for="comp_name">Company Name<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input name="comp_name" class="form-control input-md" type="text" readonly value="<?php echo $row['comp_name']; ?>">
  </div>

<label class="col-md-2 control-label" for="biz_type">Business Type<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input name="biz_type" class="form-control input-md" type="text" readonly value="<?php echo $row['biz_type']; ?>">
  </div>
</div>

<div class="form-group row">
<label class="col-md-2 control-label" for="indus_seg">Industry Segment<span style="color:red">*</span></label>  
  <div class="col-md-3">
  <input  name="indus_seg" class="form-control input-md" type="text" readonly value="<?php echo $row['indus_seg']; ?>">
  </div>
  
<label class="col-md-2 control-label" for="indus_subseg">Industry Subsegment<span style="color:red">*</span></label>  
  <div class="col-md-3">
  <input  name="indus_subseg" class="form-control input-md" type="text" readonly value="<?php echo $row['indus_subseg']; ?>">
  </div>
</div>

<div class="form-group row">
<label class="col-md-2 control-label" for="c_w_phone">Work Phone<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="c_w_phone" class="form-control input-md" type="text" maxlength="10" readonly value="<?php echo $row['w_phone']; ?>">
  </div>
  
<label class="col-md-2 control-label" for="c_website">Website Name<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="c_website" class="form-control input-md" type="text" readonly value="<?php echo $row['website']; ?>">
  </div>
</div>
 
<div class="form-group row">
<label class="col-md-2 control-label" for="c_street">Street</label>  
  <div class="col-md-3">
	<input  name="c_street" class="form-control input-md" type="text" readonly value="<?php echo $row['add_street']; ?>">
</div>

<label class="col-md-2 control-label" for="c_sector">Sector</label>  
  <div class="col-md-3">
	<input name="c_sector" class="form-control input-md" type="text" readonly value="<?php echo $row['add_sector']; ?>">
  </div>
</div>
  
<div class="form-group row">
<label class="col-md-2 control-label" for="c_market">Market</label>  
  <div class="col-md-3">
	<input name="c_market" class="form-control input-md" type="text" readonly value="<?php echo $row['add_market']; ?>">
  </div>
  
<label class="col-md-2 control-label" for="c_city">City<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input name="c_city" class="form-control input-md" type="text" readonly value="<?php echo $row['add_city']; ?>">
  </div>
</div>

<div class="form-group row">
<label class="col-md-2 control-label" for="c_district">District<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input name="c_district" class="form-control input-md" type="text" readonly value="<?php echo $row['add_district']; ?>">
  </div>
  
<label class="col-md-2 control-label" for="c_note">Add Note<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<textarea name="c_note" class="form-control input-md" readonly><?php echo $row['add_market']; ?></textarea>
  </div>
</div>
</form>
</div>

<div style="margin-top:-15px;">
<center>															
		<?php 	
echo "<ul class='pagination pagination-lg'>";
echo "<li><a href='contact-view.php?view_id=".($id-1)."' aria-lable='Previous' ><span aria-hidden='true'>&laquo;</span>
        <span class='sr-only'>Previous</span></a></li>"; 
		
echo "<li><a href='contact-view.php?view_id=".($id+1)."' aria-lable='Next'> <span aria-hidden='true'>&raquo;</span>
        <span class='sr-only'>Next</span></a></li>";
echo "</ul>";   
?>
</center>
</div>
<div>
	<?php include("footer.inc.php");?>
</div>
</body>
</html>