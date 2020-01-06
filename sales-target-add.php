<?php
ob_start();
session_start();
include 'include/dbi.php';
include 'include/session.php';
include 'include/param.php';
checksession();

date_default_timezone_set('Asia/Kolkata');
$dtm = date("Y/m/d H:i:s"); 
if(isset($_POST['submit']))
{
	$user_id=$_POST['user_id'];
	$fin_year=$_POST['fin_year'];
	$area_prod= $_POST['area_prod'];
	$area_geo_name=$_POST['area_geo_name'];
	$area_geo_unit=$_POST['area_geo_unit'];
	$targ_amt=$_POST['targ_amt'];
	$targ_new_cust=$_POST['targ_new_cust'];
	$targ_new_lead=$_POST['targ_new_lead'];
	$created_by=$_SESSION['login'];
	
	$insert_qry="insert into sales_target(user_id,fin_year,area_product,area_geoname,area_geo_unit,target_amt,target_new_cust,target_new_lead,dtm_created,created_by) values('$user_id','$fin_year','$area_prod','$area_geo_name','$area_geo_unit','$targ_amt','$targ_new_cust','$targ_new_lead','$dtm','$created_by') " ;
 
   // if ($debug)  echo $insert_qry ;	
	$result= mysqli_query($conn,$insert_qry) ;
	if ($result==false){
		$error=mysqli_error($conn) ;
		echo "<BR>Error in Insert Add Sales Target".$error ;
		die($error) ;
	}
	//header("Location: product-item-manage.php");
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="icon" type="image/png" href="images/icon.png" />
<title>Sales Target Add</title>

<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
<script type="text/javascript">
function validateForm()
{
	alert("Sales Target Added Successfully....");
}

 $(document).ready(function(){
		var date_input=$('input[name="fin_year"]'); //our date input has the name "date"
		var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
		date_input.datepicker({
			 format: "yyyy",
    viewMode: "years", 
    minViewMode: "years",
			container: container,
			todayHighlight: true,
			autoclose: true,
		}) ;
	}) ;
</script>

<body style="background-color:#ccf2ff">
<div class ="container-fluid" >   	<!-- body -->
	<div>
		<?php include 'header.inc.php'; ?>
	</div>

  <div style="margin-top:100px;">
  <h2 class="text-primary text-center">Add Sales Target</h2><br>
</div>      

<form class="form-horizontal" style="margin-left:10%;" method="POST" onSubmit="return validateForm(this)">
<div class="form-group row">
<label class="control-label col-md-2"  for="user_id">User Id<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<select class="form-control" name="user_id" required=required>
		<?php 
		echo "<option value=''></option>" ;	
		$grp_qry=mysqli_query($conn,"SELECT * from tbl_staff");
		while($row = mysqli_fetch_array($grp_qry))
		{
		$username_for_userid=$row['username'];
		$user_id1=$row['id'];
		echo "<option value='$user_id1'>$username_for_userid</option>" ;
		}
		?>
	</select>
  </div>
  
  <label class="control-label col-md-2" for="fin_year">Financial Year<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="fin_year" id="date" required=required class="form-control input-md datepick" type="text">
  </div>
</div>


<div class="form-group row">
 <label class="control-label col-md-2" for="area_prod">Area Product<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<select class="form-control" name="area_prod" required=required>
		<?php 
		echo "<option value=''></option>" ;	
		$grp_qry=mysqli_query($conn,"SELECT * from product_group");
		while($row = mysqli_fetch_array($grp_qry))
		{
		$prod_area=$row['grp_name'];
		echo "<option value='$prod_area'>$prod_area</option>" ;
		}
		?>
	</select>
  </div>
  
  <label class="control-label col-md-2" for="area_geo_name">Area Geo Name<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="area_geo_name" required=required class="form-control input-md" type="text">
  </div>
</div>

<div class="form-group row">
<label class="control-label col-md-2" for="area_geo_unit">Area Geo Unit<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<select class="form-control" name="area_geo_unit" required=required>
		<?php 
	 for ($i=0;$i<count($area_geo_unit); $i++)
	 {
		 echo "<option value='$area_geo_unit[$i]'>$area_geo_unit[$i]</option>" ;
	 }
		?>
	</select>
  </div>
  
  <label class="control-label col-md-2" for="targ_amt">Target Amount<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="targ_amt" required=required class="form-control input-md" type="text">
  </div>
</div>


<div class="form-group row">
  
 <label class="control-label col-md-2" for="targ_new_cust">Target New Cust<span style="color:red">*</span></label>  
   <div class="col-md-3">
	<input  name="targ_new_cust" required=required class="form-control input-md" type="text">
  </div>

  <label class="control-label col-md-2" for="targ_new_lead">Target New Lead<span style="color:red">*</span></label>  
   <div class="col-md-3">
	<input  name="targ_new_lead" required=required class="form-control input-md" type="text">
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
	<div style="position:absolute; width:100%; left:0; right:0; margin-top:151px;">
		<?php include("footer.inc.php"); ?>
	</div>
</div>
</body>
</html>
