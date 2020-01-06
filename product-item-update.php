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
	$selectsql="select * from product_item where id = '$id'";
	//echo $selectsql ;
	$rs = mysqli_query($conn,$selectsql);
	$rows=mysqli_fetch_array($rs);
	$cur_grp_id = $rows['grp_id'];

}

if(isset($_POST['update'])){
	$dtm=$_POST['dtm'];
	$grp_id=$_POST['grp_id'];
	$prod_name= $_POST['prod_name'];
	$prod_qty = $_POST['prod_qty'];
	$unit_of_meas = $_POST['unit_of_meas'];
	$cost_price = $_POST['cost_price'];
	$sell_price = $_POST['sell_price'];
	$category = $_POST['category'];


$sql="UPDATE product_item set grp_id='$grp_id', prod_name = '$prod_name',prod_qty = '$prod_qty',unit_of_meas ='$unit_of_meas',cost_price = '$cost_price',sell_price = '$sell_price',category='$category' where  id = '$id'";
$result=mysqli_query($conn,$sql);

header("location:product-item-manage.php");
$err= mysqli_error($conn);
echo $err;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="icon" type="image/png" href="images/icon.png" />
<title>Product Item Update</title>

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
  <h2 class="text-primary text-center">Update Product Item</h2><br>
  </div>      

<form class="form-horizontal" style="margin-left:10%;" method="POST" >
<div class="form-group row">
	<label class="control-label col-md-2"  for="grp_id">Parent Group Name<span style="color:red">*</span></label>  
	<div class="col-md-3">
	<select class="form-control" name="grp_id" id="grp_id" required=required>
            <?php 
			$all_grp_name=mysqli_query($conn,"SELECT id, grp_name FROM product_group");
			while($r=mysqli_fetch_array($all_grp_name))
			{
				$g_name=$r['grp_name'];
				$grp_i=$r['id'];
				if ($grp_i == $cur_grp_id) { 
				echo "<option value='$grp_i' selected>$g_name</option>" ;
				}
			else{
				 echo "<option value='$grp_i'>$g_name</option>" ;
				}
			} ?>
	</select>
	</div>
  
  <label class="control-label col-md-2"  for="prod_name">Product Name<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="prod_name"  placeholder="" required=required class="form-control input-md" type="text" value="<?php echo $rows['prod_name']; ?>">
  </div>
</div>

<div class="form-group row">
 <label class="control-label col-md-2"  for="prod_qty">Available Quantity<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="prod_qty"  placeholder="" required=required class="form-control input-md" type="text" value="<?php echo $rows['prod_qty']; ?>">
  </div>
  
  <label class="control-label col-md-2"  for="unit_of_meas">Unit Of Measurement<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<select class="form-control" name="unit_of_meas" id="unit_of_meas" required=required>
		 <option value="Piece" <?php if($rows['unit_of_meas'] == 'Piece') echo "selected"; ?>>Piece</option>
         <option value="Kg" <?php if($rows['unit_of_meas'] == 'Kg') echo "selected"; ?>>Kg</option>
         <option value="Litre" <?php if($rows['unit_of_meas'] == 'Litre') echo "selected"; ?>>Litre</option>
         <option value="Meter" <?php if($rows['unit_of_meas'] == 'Meter') echo "selected"; ?>>Meter</option>
         <option value="Foot" <?php if($rows['unit_of_meas'] == 'Foot') echo "selected"; ?>>Foot</option>
	</select> 
  </div> 
</div>

<div class="form-group row">
<label class="control-label col-md-2"  for="cost_price">Cost Price</label>  
  <div class="col-md-3">
	<input  name="cost_price"  placeholder="" required=required class="form-control input-md" type="text" value="<?php echo $rows['cost_price']; ?>">
  </div>
  
  <label class="control-label col-md-2"  for="sell_price">Sell Price<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="sell_price"  placeholder="" required=required class="form-control input-md" type="text" value="<?php echo $rows['sell_price']; ?>">
  </div>
</div>


<div class="form-group row">
 <label class="control-label col-md-2"  for="category">Category<span style="color:red">*</span></label>  
   <div class="col-md-3">
	<select class="form-control" name="category" id="category" required=required>
		 <option value="Goods" <?php if($rows['category'] == 'Food') echo "selected"; ?>>Goods</option>
         <option value="Services" <?php if($rows['category'] == 'Services') echo "selected"; ?>>Services</option>
	</select> 
  </div>
</div>

<div class="form-group" style="margin-left:35%;">
  <label class=" control-label" for="update"></label>
  <div>
    <input type="submit" name="update" class="btn btn-info" value="Update" style="padding:10px 3%; border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);"/>
     <input type="reset" name="cancel" class="btn btn-default" value="Cancel" onClick="location.href = 'product-item-manage.php';" style="padding:10px 3%; border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);"/>
	</div>
</div>
</form>
	<div style="position:absolute; width:100%; left:0; right:0; margin-top:151px;">
		<?php include("footer.inc.php"); ?>
	</div>
</div>
</body>
</html>