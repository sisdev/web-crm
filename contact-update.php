<?php
ob_start();
session_start();
include 'include/dbi.php';
include 'include/session.php';
include 'include/param.php';
checksession();
if(isset($_GET['update_id']))
{
	$id=$_GET['update_id'];
	$query=mysqli_query($conn,"select * from our_contact where id = '$id'");
	$row=mysqli_fetch_array($query);
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Update Contact</title>
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
	alert("Contact Updated Successfully....");
	
}
</script>
</head>

<body style="background-color:#ccf2ff">
<div class ="container-fluid">
<div>
<?php include 'header.inc.php'; ?>
</div>

<div style="margin-top:100px;">
  <h2 class="text-primary text-center">Update Contact</h2>
</div>  

<form class="form-horizontal" style="margin-left:10%;" method="POST" onSubmit="return validateForm(this)">
<div class="form-group row">
  <label class="control-label col-md-2"  for="c_per_phone">Personal Phone<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="c_per_phone" required=required class="form-control input-md" type="text" maxlength="10" value="<?php echo $row['p_phone']; ?>">
  </div>
  
  <label class="control-label col-md-2"  for="c_email">Email ID<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="c_email" class="form-control input-md" type="email" value="<?php echo $row['email']; ?>">
  </div>
</div>

<div class="form-group row">
 <label class="control-label col-md-2"  for="c_fname">First Name<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input name="c_fname" required=required class="form-control input-md" type="text" value="<?php echo $row['fname']; ?>">
  </div>
  
   <label class="control-label col-md-2"  for="c_lname">Last Name<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input name="c_lname" required=required  class="form-control input-md" type="text" value="<?php echo $row['lname']; ?>">
  </div>
</div>

<div class="form-group row">
<label class="control-label col-md-2"  for="c_design">Designation<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input name="c_design" required=required class="form-control input-md" type="text" value="<?php echo $row['designation']; ?>">
  </div>
  
<label class="control-label col-md-2" for="c_source">Contact Source<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<select class="form-control" name="c_source" required=required>
		<?php
		for ($i=0;$i<count($contact_source); $i++)
	 {
                echo '<option value="'. $contact_source[$i] .'"';
                if ( $row['c_source'] == $contact_source[$i] ) echo 'selected="selected"';
                echo '>'.$contact_source[$i].'</option>';
            }
			?>
	</select>
  </div>  
</div>

<h4 class="text-primary">Company Info</h4>
<div class="form-group row">
 <label class="control-label col-md-2"  for="comp_name">Company Name<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input name="comp_name" class="form-control input-md" type="text" value="<?php echo $row['comp_name']; ?>">
  </div>

<label class="col-md-2 control-label" for="biz_type">Business Type<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<select class="form-control" name="biz_type" id="biz_type" required=required>
	<?php
		for ($j=0;$j<count($biz_type); $j++)
			{
                echo '<option value="'. $biz_type[$j] .'"';
                if ( $row['biz_type'] == $biz_type[$j] ) echo 'selected="selected"';
                echo '>'. $biz_type[$j] .'</option>';
            }
	?>
	</select>
</div>
</div>

<div class="form-group row">
<label class="col-md-2 control-label" for="indus_seg">Industry Segment<span style="color:red">*</span></label>  
  <div class="col-md-3">
  <input  name="indus_seg" class="form-control input-md" type="text" value="<?php echo $row['indus_seg']; ?>">
  </div>
  
<label class="col-md-2 control-label" for="indus_subseg">Industry Subsegment<span style="color:red">*</span></label>  
  <div class="col-md-3">
  <input  name="indus_subseg" class="form-control input-md" type="text" value="<?php echo $row['indus_subseg']; ?>">
  </div>
</div>

<div class="form-group row">
<label class="col-md-2 control-label" for="c_w_phone">Work Phone<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="c_w_phone" class="form-control input-md" type="text" maxlength="10" value="<?php echo $row['w_phone']; ?>">
  </div>
  
<label class="col-md-2 control-label" for="c_website">Website Name<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="c_website" class="form-control input-md" type="text" value="<?php echo $row['website']; ?>">
  </div>
</div>
 
<div class="form-group row">
<label class="col-md-2 control-label" for="c_street">Street</label>  
  <div class="col-md-3">
	<input  name="c_street" class="form-control input-md" type="text" value="<?php echo $row['add_street']; ?>">
</div>

<label class="col-md-2 control-label" for="c_sector">Sector</label>  
  <div class="col-md-3">
	<input name="c_sector" class="form-control input-md" type="text" value="<?php echo $row['add_sector']; ?>">
  </div>
</div>
  
<div class="form-group row">
<label class="col-md-2 control-label" for="c_market">Market</label>  
  <div class="col-md-3">
	<input name="c_market" class="form-control input-md" type="text" value="<?php echo $row['add_market']; ?>">
  </div>
  
<label class="col-md-2 control-label" for="c_city">City<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<select class="form-control" name="c_city" id="c_city" required=required>
	<?php
		for ($j=0;$j<count($city); $j++)
			{
                echo '<option value="'. $city[$j] .'"';
                if ( $row['add_city'] == $city[$j] ) echo 'selected="selected"';
                echo '>'. $city[$j] .'</option>';
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
		for ($j=0;$j<count($distict); $j++)
			{
                echo '<option value="'. $distict[$j] .'"';
                if ( $row['add_district'] == $distict[$j] ) echo 'selected="selected"';
                echo '>'. $distict[$j] .'</option>';
            }
			?>
	</select>
  </div>
  
<label class="col-md-2 control-label" for="c_note">Add Note<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<textarea name="c_note" class="form-control input-md"><?php echo $row['add_market']; ?></textarea>
  </div>
</div>

<div class="form-group" style="margin-left:37%;">
  <label class=" control-label" for="update"></label>
  <div>
    <input type="submit" name="update" class="btn btn-info" value="Update" style="padding:10px 3%; border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);"/>
     <input type="reset" name="cancel" class="btn btn-default" value="Cancel" onClick="location.href = 'contact-manage.php';" style="padding:10px 3%; border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);"/>
	</div>
</div>
  </form>

  
<?php 
if(isset($_POST['update']))
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

$qry="UPDATE our_contact SET fname='$fname',lname='$lname',p_phone='$permob',w_phone='$workmob',designation='$design',c_source='$source',website='$website',add_street='$street',add_sector='$sector',add_market='$market',add_city='$city',add_district='$district',email='$email',comp_name='$comp',indus_seg='$seg',indus_subseg='$subseg',biz_type='$biz',note='$note' WHERE id='$id'";
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