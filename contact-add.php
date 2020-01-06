<?php
ob_start();
session_start();
include 'include/dbi.php';
include 'include/session.php';
include 'include/param.php';
checksession();
$dt=getLocalDtm();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Add Contact</title>
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

<script>
function validateForm()
{
	alert("Contact Added Successfully....");
	
}
</script>
</head>

<body style="background-color:#ccf2ff; margin:auto; padding:0px;">
<div class ="container-fluid">
<div>
<?php include 'header.inc.php'; ?>
</div>

<div style="margin-top:80px;">
  <h2 class="text-primary text-center"> Add Contact</h2>
</div>  

<form class="form-horizontal" style="margin-left:10%;" method="POST" onSubmit="return validateForm(this)">
<div class="form-group row">
  <label class="control-label col-md-2"  for="c_per_phone">Personal Phone<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="c_per_phone" required=required class="form-control input-md" type="text" maxlength="10">
  </div>
  
  <label class="control-label col-md-2"  for="c_email">Email ID<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="c_email" class="form-control input-md" type="email">
  </div>
</div>

<div class="form-group row">
 <label class="control-label col-md-2"  for="c_fname">First Name<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input name="c_fname" required=required class="form-control input-md" type="text">
  </div>
  
   <label class="control-label col-md-2"  for="c_lname">Last Name<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input name="c_lname" required=required  class="form-control input-md" type="text">
  </div>
</div>

<div class="form-group row">
<label class="control-label col-md-2"  for="c_design">Designation<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input name="c_design" required=required class="form-control input-md" type="text">
  </div>
  
<label class="control-label col-md-2" for="c_source">Contact Source<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<select class="form-control" name="c_source" required=required>
		<?php 
	 for ($i=0;$i<count($contact_source); $i++)
	 {
		 echo "<option value='$contact_source[$i]'>$contact_source[$i]</option>" ;
	 }
		?>
	</select>
  </div>  
</div>

<h4 class="text-primary">Company Info</h4>
<div class="form-group row">
 <label class="control-label col-md-2"  for="comp_name">Company Name<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input name="comp_name" class="form-control input-md" type="text">
  </div>

 <label class="col-md-2 control-label" for="biz_type">Business Type<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<select class="form-control" name="biz_type" id="biz_type" required=required>
			<?php 
	 for ($i=0;$i<count($biz_type); $i++)
	 {
		 echo "<option value='$biz_type[$i]'>$biz_type[$i]</option>" ;
	 }
		?>
	</select>
</div>
</div>

<div class="form-group row">
<label class="col-md-2 control-label" for="c_w_phone">Work Phone<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="c_w_phone" class="form-control input-md" type="text" maxlength="10">
  </div>
  
<label class="col-md-2 control-label" for="c_website">Website Name<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="c_website" class="form-control input-md" type="text">
  </div>
</div>

<div class="form-group row">
<label class="col-md-2 control-label" for="indus_seg">Industry Segment<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="indus_seg" class="form-control input-md" type="text">
  </div>
  
<label class="col-md-2 control-label" for="indus_subseg">Industry Subsegment<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="indus_subseg" class="form-control input-md" type="text">
  </div>
</div>
 
<div class="form-group row">
<label class="col-md-2 control-label" for="c_street">Street</label>  
  <div class="col-md-3">
	<input  name="c_street" class="form-control input-md" type="text">
</div>

<label class="col-md-2 control-label" for="c_sector">Sector</label>  
  <div class="col-md-3">
	<input name="c_sector" class="form-control input-md" type="text">
  </div>
</div>
  
<div class="form-group row">
<label class="col-md-2 control-label" for="c_market">Market</label>  
  <div class="col-md-3">
	<input name="c_market" class="form-control input-md" type="text">
  </div>
  
<label class="col-md-2 control-label" for="c_city">City<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<select class="form-control" name="c_city" id="c_city" required=required>
			<?php 
	 for ($i=0;$i<count($city); $i++)
	 {
		 echo "<option value='$city[$i]'>$city[$i]</option>" ;
	 }
		?>
	</select>
  </div>
</div>

<div class="form-group row">
 <label class="col-md-2 control-label" for="c_district">District<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<select class="form-control" name="c_district" id="c_district" required=required>
			<?php 
	 for ($i=0;$i<count($distict); $i++)
	 {
		 echo "<option value='$distict[$i]'>$distict[$i]</option>" ;
	 }
		?>
	</select>
  </div>
  
<label class="col-md-2 control-label" for="c_note">Add Note<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<textarea name="c_note" class="form-control input-md"></textarea>
  </div>
</div>

<div class="form-group" style="margin-left:30%;">
  <label class=" control-label" for="c_submit"></label>
  <div>
    <input type="submit" name="c_submit" class="btn btn-info" value="Submit" style="padding:10px 7%;"/>
    <input type="reset"  name="Reset" class="btn" value="Reset" onClick="window.location.reload()" style="padding:10px 7%;"/>
	</div>
</div>
  </form>

  
<?php 
if(isset($_POST['c_submit']))
{
$fname=$_POST['c_fname'];
$lname=$_POST['c_lname'];
$email=$_POST['c_email'];
$permob=$_POST['c_per_phone'];
$workmob=$_POST['c_w_phone'];
$website=$_POST['c_website'];
$street=$_POST['c_street'];
$sector=$_POST['c_sector'];
$market=$_POST['c_market'];
$city=$_POST['c_city'];
$district=$_POST['c_district'];
$source=$_POST['c_source'];
$comp=$_POST['comp_name'];
$seg=$_POST['indus_seg'];
$subseg=$_POST['indus_subseg'];
$biz=$_POST['biz_type'];
$note=$_POST['c_note'];
$design=$_POST['c_design'];
$created_by=$_SESSION['login'];

$qry="insert into our_contact (fname,lname,p_phone,w_phone,designation,c_source,website,add_street,add_sector,add_market,add_city,add_district,email,dtm,comp_name, indus_seg, indus_subseg, biz_type,note,created_by) values('$fname','$lname','$permob','$workmob','$design','$source','$website','$street','$sector','$market','$city','$district','$email','$dt','$comp','$seg','$subseg','$biz','$note','$created_by'
) ";
echo $qry;
mysqli_query($conn,$qry) or die(mysqli_error($conn));
	
	header("location:contact-manage.php");
}
?>
</div>

<div>
	<?php include("footer.inc.php");?>
</div>
</body>
</html>