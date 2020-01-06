<?php
ob_start();
session_start();
include 'include/dbi.php';
include 'include/session.php';
include 'include/param.php';
checksession();
$d=getLocalDtm(); 

if(isset($_POST['submit']))
{
	$username=$_POST['username'];
	$pass=$_POST['pass'];
	$name= $_POST['name'];
	$phone=$_POST['phone'];
	$email=$_POST['email'];
	$role=$_POST['role'];
	$status="active";
	$created_by=$_SESSION['login'];
	
	$insert_qry="insert into tbl_staff(username,password,name,phone_no,email,dtm_created,role,status,created_by) values('$username','$pass','$name','$phone','$email','$d','$role','$status','$created_by')" ;
	
   //echo $insert_qry ;	
	$result= mysqli_query($conn,$insert_qry) ;
	if ($result==false){
		$error=mysqli_error($conn) ;
		echo "<BR>Error in Insert Add Sales-Resource".$error ;
		die($error) ;
	}
	$last_id = mysqli_insert_id($conn);
	$folder_qry="SELECT CONCAT($last_id,'_',SUBSTR(username, 1,4)) as user FROM `tbl_staff` where id='$last_id'";
	echo $folder_qry;
	$result_folder=mysqli_query($conn, $folder_qry);
	$folder_array=mysqli_fetch_array($result_folder);
	$user_folder_name=$folder_array['user'];
	$folder_insert_qry="UPDATE tbl_admin SET user_folder_name='$user_folder_name' where id='$last_id'";
	//echo "<br>".$folder_insert_qry;
	mysqli_query($conn, $folder_insert_qry);
	header("Location:sales-resource.php");
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="icon" type="image/png" href="images/icon.png" />
<title>Sales-Resource Add</title>

<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
<script type="text/javascript">
function validateForm()
{
	alert("Sales-Resource Added Successfully....");
}
</script>

<script type="text/javascript">

$(document).ready(function(){
	$("#username").change(function(){
		var user = $("#username").val();
		var msgbox = $("#status");
		
		if(user.length > 2){
			$("#status").html('<img src="images/loader.gif" align="absmiddle">&nbsp;Checking availability...');
			$.ajax({
				type: "POST",
				url: "source-username-check-ajax.php",
				data: "username="+ user,  
				success: function(msg){  
						if(msg == 'OK'){
							$("#username").removeClass("red");
							$("#username").addClass("green");
							msgbox.html('<img src="images/available.png" align="absmiddle">');
						}else{
							$("#username").removeClass("green");
							$("#username").addClass("red");
							msgbox.html(msg);
							$("#username").focus();
						}
					}
			});
		}else{
			$("#username").addClass("red");
			$("#status").html('<font color="#cc0000">Please enter atleast 3 letters.</font>');
			$("#username").focus();
		}
		return false;
	});
});
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

  <div style="margin-top:100px;">
  <h2 class="text-primary text-center">Add Sales-Resource</h2><br>
</div>      

<form class="form-horizontal" style="margin-left:10%;" method="POST" onSubmit="return validateForm(this)">
<div class="form-group row">
<label class="control-label col-md-2" for="username">Username<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input name="username" id="username" required=required class="form-control input-md" type="text"><span id="status"></span></input>
  </div>
  
  <label class="control-label col-md-2" for="pass">Password<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input name="pass" required=required class="form-control input-md" type="text">
  </div>
</div>


<div class="form-group row">
 <label class="control-label col-md-2" for="name">Name<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input name="name" required=required class="form-control input-md" type="text">
  </div>
  
  <label class="control-label col-md-2" for="phone">Phone<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input name="phone" required=required class="form-control input-md" type="text"  maxlength="10">
  </div>
</div>

<div class="form-group row">
<label class="control-label col-md-2" for="email">Email<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input name="email" required=required class="form-control input-md" type="email">
  </div>
  
  <label class="control-label col-md-2" for="role">Role<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<select class="form-control" name="role" required=required>
		<?php 
	 for ($i=0;$i<count($role); $i++)
	 {
		 echo "<option value='$role[$i]'>$role[$i]</option>" ;
	 }
		?>
	</select>
  </div>
</div>

<div class="form-group" style="margin-left:35%;">
  <label class=" control-label" for="upload"></label>
  <div>
    <input type="submit" name="submit" class="btn btn-info" value="Submit" style="padding:10px 3%; border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);"/>
    <input type="reset"  name="Reset" class="btn" value="Reset" style="padding:10px 3%; border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);"/>
	</div>
</div>
</form>
	<div style="position:absolute; width:100%; left:0; right:0; margin-top:213px;">
		<?php include("footer.inc.php"); ?>
	</div>
</div>
</body>
</html>
