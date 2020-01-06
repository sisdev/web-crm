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
	$selectsql="select * from tbl_staff where id = '$id'";
	//echo $selectsql ;
	$rs = mysqli_query($conn,$selectsql);
	$rows=mysqli_fetch_array($rs);

}
$count_qry=mysqli_query($conn, "SELECT COUNT(username) as count FROM `tbl_staff` where status='active'");
	$total_active=mysqli_fetch_array($count_qry);
	$total_active_users=$total_active['count'];

if(isset($_POST['update'])){
	$username=$_POST['username'];
	$pass=$_POST['pass'];
	$name= $_POST['name'];
	$phone=$_POST['phone'];
	$email=$_POST['email'];
	$role=$_POST['role'];
	$status=$_POST['status'];

$sql="UPDATE tbl_staff set username='$username', password = '$pass',name = '$name',phone_no ='$phone',email = '$email',role = '$role', status='$status' where  id = '$id'";
$result=mysqli_query($conn,$sql);

header("location:sales-resource.php");
$err= mysqli_error($conn);
echo $err;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="icon" type="image/png" href="images/icon.png" />
<title>Sales-Resource Update</title>

<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
  
<body style="background-color:#ccf2ff">
<div class ="container-fluid" >
	<div>
		<?php include 'header.inc.php'; ?>
	</div>	

  <div style="margin-top:100px;">
  <h2 class="text-primary text-center">Update Sales-Resource</h2><br>
  </div>      

<form class="form-horizontal" style="margin-left:10%;" method="POST" onSubmit="return validateForm(this)">
<div class="form-group row">
<label class="control-label col-md-2" for="username">Username<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="username" required=required class="form-control input-md" type="text" value="<?php echo  $rows['username']; ?>">
  </div>
  
  <label class="control-label col-md-2" for="pass">Password<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="pass" required=required class="form-control input-md" type="text" value="<?php echo  $rows['password']; ?>">
  </div>
</div>


<div class="form-group row">
 <label class="control-label col-md-2" for="name">Name<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="name" required=required class="form-control input-md" type="text" value="<?php echo  $rows['name']; ?>">
  </div>
  
  <label class="control-label col-md-2"  for="phone">Phone<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="phone" required=required class="form-control input-md" type="text" value="<?php echo  $rows['phone_no']; ?>">
  </div>
</div>

<div class="form-group row">
<label class="control-label col-md-2" for="email">Email<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="email" required=required class="form-control input-md" type="email" value="<?php echo  $rows['email']; ?>">
  </div>
  
  <label class="control-label col-md-2" for="role">Role<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<select class="form-control" name="role" id="role">
	<?php
		for ($i=0;$i<count($role); $i++)
	 {
                echo '<option value="'. $role[$i] .'"';
                if ( $rows['role'] == $role[$i] ) echo 'selected="selected"';
                echo '>'.$role[$i].'</option>';
            }
			?>
	</select> 
  </div>
</div>

<div class="form-group row">
<label class="control-label col-md-2" for="status">Status<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<select class="form-control" name="status" required=required>
		<?php 
	 for ($i=0;$i<count($sales_resource_status); $i++)
	 {
		 echo '<option value="'. $sales_resource_status[$i] .'"';
                if ( $rows['status'] == $sales_resource_status[$i] ) echo 'selected="selected"';
                if($total_active_users>=$license_user){
                if($rows['status']== 'inactive'){ echo 'disabled'; }}
                echo '>'. $sales_resource_status[$i] .'</option>';
	 }
		?>
	</select>
  </div>
</div>


<div class="form-group" style="margin-left:35%;">
  <label class=" control-label" for="update"></label>
  <div>
    <input type="submit" name="update" class="btn btn-info" value="Update" style="padding:10px 3%; border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);"/>
     <input type="reset" name="cancel" class="btn btn-default" value="Cancel" onClick="location.href = 'sales-resource.php';" style="padding:10px 3%; border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);"/>
	</div>
</div>
</form>
	<div style="position:absolute; width:100%; left:0; right:0; margin-top:164px;">
		<?php include("footer.inc.php"); ?>
	</div>
</div>
</body>
</html>