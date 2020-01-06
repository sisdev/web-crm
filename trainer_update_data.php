<?php
ob_start();
session_start();
include 'include/dbi.php';
include 'include/session.php';
checksession();
if(isset($_POST['update_id']))
{
	$id=$_POST['update_id'];
	$selectsql="select * from trainer where trainerid = '$id'";
	echo $selectsql ;
	$rs = mysqli_query($conn,$selectsql);
	$rows=mysqli_fetch_array($rs);

}

if(isset($_POST['update'])){
	$name= $_POST['tname'];
	$adds = $_POST['add'];
	$ph1 = $_POST['ph1'];
	$ph2 = $_POST['ph2'];
	$email = $_POST['email'];
	$course = $_POST['crs'];
	$prof = $_POST['profile'];
	$ids = $_POST['tid'];
}
if(isset($ids))
{

$sql="UPDATE trainer set tname = '$name',address = '$adds',phone1 ='$ph1',phone2 = '$ph2',emailid = '$email',courses = '$course',profile='$prof' where  trainerid = '$ids'";
$result=mysqli_query($conn,$sql);

header("location:trainers.php");
  exit;
mysqli_close();
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <meta http-equiv="Content-Type" content="text/html;"/>
<title>Trainer Update</title>
<script type="text/javascript">
function validateForm(form)
{
	if(form.tname.value=="")
	{
		alert("Trainer Name field should not be blank");
		form.tname.focus();
		return false;
	}

	if(form.add.value=="")
	{
		alert("Address field could not be blank");
		form.add.focus();
		return false;
	}

		
	if(form.ph1.value=="")
					{
						alert("plz enter contact number");
						form.ph1.focus();
						return false;
					}
	else if(isNaN(form.ph1.value))
				{
					alert("plz enter number in ph1");
				form.ph1.focus();
				return false;
				}
		else {
				var val=form.ph1.value.length;
				//document.write(val);
				if(val<10 || val>10)
				{
					alert("plz enter 10 digit number, you have enter "+val);
					form.ph1.focus();
					return false;
				}
			}
			if(form.ph2.value=="")
					{
						alert("plz enter contact number in ph2");
						form.ph2.focus();
						return false;
					}
	else if(isNaN(form.ph2.value))
				{
					alert("plz enter number");
				form.ph2.focus();
				return false;
				}
		else {
				var val=form.ph2.value.length;
				//document.write(val);
				if(val<10 || val>10)
				{
					alert("plz enter 10 digit number, you have enter "+val);
					form.ph2.focus();
					return false;
				}
				
			}	
			

	if(form.email.value=="")
	{
		alert("Email field could not be blank");
		form.email.focus();
		return false;
	}
	else
	{
		var x=form.email.value;
		var atpos=x.indexOf("@");
		var dotpos=x.lastIndexOf(".");
		if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
  		{
  			alert("Not a valid e-mail address");
  			return false;
  		}
	}
	if(form.crs.value=="")
	{
		alert("Course field could not be blank");
		form.crs.focus();
		return false;
	}

	if(form.profile.value=="")
	{
		alert("Profile field could not be blank");
		form.profile.focus();
		return false;
	}

}
</script>


<body style="background-color:#ccf2ff">
<div class ="container col-md-12" >   	<!-- body -->
	<div>
		<?php include 'header.inc.php'; ?>
	</div>

  <div>
  <h2 class="text-primary text-center">Update Trainer Details</h2><br>
</div>      

<form class="form-horizontal" style="margin-left:30%;" method="POST" action="trainer_update_data.php" onSubmit="return validateForm(this)">
<div class="form-group row">
  <label class="control-label col-md-2"  for="tname">Trainer Name<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="tname"  placeholder="" class="form-control input-md" type="text" value="<?php echo $rows['tname']; ?>"/>
  </div>
</div>

<div class="form-group row">
  <label class="col-md-2 control-label" for="add">Address<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<textarea id="venue" name="add" class="form-control input-md" cols="15" rows=""><?php echo $rows['address']; ?></textarea>
  </div>
</div>

<div class="form-group row">
  <label class="control-label col-md-2"  for="ph1">Phone1<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="ph1"  placeholder="" class="form-control input-md" type="text" value="<?php echo $rows['phone1']; ?>" />
  </div>
</div>

<div class="form-group row">
  <label class="control-label col-md-2"  for="ph2">Phone2<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="ph2"  placeholder="" class="form-control input-md" type="text" value="<?php echo $rows['phone2']; ?>" />
  </div>
</div>

<div class="form-group row">
  <label class="control-label col-md-2"  for="email">Email ID<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="email"  placeholder="" class="form-control input-md" type="text" value="<?php echo $rows['emailid']; ?>"/>
  </div>
</div>

<div class="form-group row">
  <label class="control-label col-md-2"  for="crs">Course<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="crs"  placeholder="" class="form-control input-md" type="text" value="<?php echo $rows['courses']; ?>"/>
  </div>
</div>

<div class="form-group row">
  <label class="col-md-2 control-label" for="profile">Profile<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<textarea name="profile" class="form-control input-md" cols="15" rows=""><?php echo $rows['profile']; ?></textarea>
  </div>
</div>

<div class="form-group" style="margin-left:18%;">
  <label class=" control-label" for="tid"></label>
  <div>
    <input name="tid" type="hidden" value="<?php echo $rows['trainerid']; ?>"/>
    <input type="submit"  name="update" class="btn btn-warning" value="Update" style="padding:10px 3%;" onClick="return confirmDelete(this)"/>
	</div>
</div>
</form>
	<div>
		<?php include("footer.inc.php"); ?>
	</div>
</div>
</body>
</html>