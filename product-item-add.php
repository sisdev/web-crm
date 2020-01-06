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
	$prod_name=$_POST['prod_name'];
	$prod_qty=$_POST['prod_qty'];
	$unit_of_meas= $_POST['unit_of_meas'];
	$cost_price=$_POST['cost_price'];
	$sell_price=$_POST['sell_price'];
	$grp_id=$_POST['grp_id'];
	$category=$_POST['category'];
	$created_by=$_SESSION['login'];
	
	$insert_qry="insert into product_item(prod_name,prod_qty,unit_of_meas,cost_price,sell_price,grp_id,category,dtm,created_by) values('$prod_name','$prod_qty','$unit_of_meas','$cost_price','$sell_price','$grp_id','$category','$dtm','$created_by') " ;
 
   // if ($debug)  echo $insert_qry ;	
	$result= mysqli_query($conn,$insert_qry) ;
	if ($result==false){
		$error=mysqli_error($conn) ;
		echo "<BR>Error in Insert Add Product Item".$error ;
		die($error) ;
	}
	header("Location: product-item-manage.php");
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="icon" type="image/png" href="images/icon.png" />
<title>Product Item Add</title>

<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
<script type="text/javascript">
function validateForm()
{
	alert("Product Item Added Successfully....");
}
</script>

<body style="background-color:#ccf2ff">
<div class ="container-fluid" >   	<!-- body -->
	<div>
		<?php include 'header.inc.php'; ?>
	</div>

  <div style="margin-top:100px;">
  <h2 class="text-primary text-center">Add Product Item</h2><br>
</div>      

<form class="form-horizontal" style="margin-left:10%;" method="POST" onSubmit="return validateForm(this)">
<div class="form-group row">
<label class="control-label col-md-2"  for="grp_id">Parent Group Name<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<select class="form-control" name="grp_id" required=required>
		<?php 
		echo "<option value=''></option>" ;	
		$grp_qry=mysqli_query($conn,"SELECT * from product_group");
	while($row = mysqli_fetch_array($grp_qry))
	{
	$grp=$row['grp_name'];
	$grp_id=$row['id'];
		echo "<option value='$grp_id'>$grp</option>" ;
	}
		?>
	</select>
  </div>
  
  <label class="control-label col-md-2"  for="prod_name">Product Name<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="prod_name"  placeholder="" required=required class="form-control input-md" type="text">
  </div>
</div>


<div class="form-group row">
 <label class="control-label col-md-2"  for="prod_qty">Available Stock Quantity<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="prod_qty"  placeholder="" required=required class="form-control input-md" type="text">
  </div>
  
  <label class="control-label col-md-2"  for="unit_of_meas">Unit Of Measurement<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<select class="form-control" name="unit_of_meas" required=required>
		<?php 
	 for ($i=0;$i<count($unit_of_measurement); $i++)
	 {
		 echo "<option value='$unit_of_measurement[$i]'>$unit_of_measurement[$i]</option>" ;
	 }
		?>
	</select>
  </div>
</div>

<div class="form-group row">
<label class="control-label col-md-2"  for="cost_price">Cost Price<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="cost_price"  placeholder="" required=required class="form-control input-md" type="text">
  </div>
  
  <label class="control-label col-md-2"  for="sell_price">Sell Price<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="sell_price"  placeholder="" required=required class="form-control input-md" type="text">
  </div>
</div>


<div class="form-group row">
  
 <label class="control-label col-md-2"  for="category">Category<span style="color:red">*</span></label>  
   <div class="col-md-3">
	<select class="form-control" name="category" required=required>
		<?php 
	 for ($i=0;$i<count($category); $i++)
	 {
		 echo "<option value='$category[$i]'>$category[$i]</option>" ;
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
	<div style="position:absolute; width:100%; left:0; right:0; margin-top:151px;">
		<?php include("footer.inc.php"); ?>
	</div>
</div>
</body>
</html>
