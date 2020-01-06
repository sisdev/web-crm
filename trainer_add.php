<?php
ob_start();
session_start();
include 'include/dbi.php';
include 'include/session.php';
checksession();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="icon" type="image/png" href="images/icon.png" />
<title>Trainer Add</title>

<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
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
	else 
	{
		alert("Trainer Add Successfully..");
	}
}
</script>

<body style="background-color:#ccf2ff">
<div class ="container-fluid" >   	<!-- body -->
	<div>
		<?php include 'header.inc.php'; ?>
	</div>

  <div style="margin-top:100px;">
  <h2 class="text-primary text-center">Add Trainer Details</h2><br>
</div>      

<form class="form-horizontal" style="margin-left:30%;" method="POST" action="trainer_add_submit.php" onSubmit="return validateForm(this)">
<div class="form-group row">
  <label class="control-label col-md-2"  for="tname">Trainer Name<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="tname"  placeholder="" required=required class="form-control input-md" type="text">
  </div>
</div>


<div class="form-group row">
  <label class="col-md-2 control-label" for="add">Address<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<textarea id="venue" name="add" required=required class="form-control input-md" cols="15" rows=""></textarea>
  </div>
</div>

<div class="form-group row">
  <label class="control-label col-md-2"  for="ph1">Phone1<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="ph1"  placeholder="" required=required maxlength="10" onkeypress="return isNumber(value)" class="form-control input-md" type="text">
  </div>
</div>

<div class="form-group row">
  <label class="control-label col-md-2"  for="ph2">Phone2</label>  
  <div class="col-md-3">
	<input  name="ph2"  placeholder="" maxlength="10" onkeypress="return isNumber(value)" class="form-control input-md" type="text">
  </div>
</div>

<div class="form-group row">
  <label class="control-label col-md-2"  for="email">Email ID<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="email"  placeholder="" required=required class="form-control input-md" type="text">
  </div>
</div>

<div class="form-group row">
  <label class="control-label col-md-2"  for="crs">Course<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="crs"  placeholder="" required=required class="form-control input-md" type="text">
  </div>
</div>

<div class="form-group row">
  <label class="col-md-2 control-label" for="profile">Profile<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<textarea name="profile" required=required class="form-control input-md" cols="15" rows=""></textarea>
  </div>
</div>

<div class="form-group" style="margin-left:18%;">
  <label class=" control-label" for="upload"></label>
  <div>
    <input type="submit" class="btn btn-info" value="Submit" style="padding:10px 3%;"/>
    <input type="reset"  name="Reset" class="btn" value="Reset" style="padding:10px 3%;"/>
	</div>
</div>
</form>
	<div style="position:absolute; width:100%; left:0; right:0;">
		<?php include("footer.inc.php"); ?>
	</div>
</div>
</body>
</html>
