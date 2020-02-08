<?php
ob_start();
session_start();
include 'include/dbi.php';
include 'include/session.php';
include 'include/param.php';
checksession();

date_default_timezone_set('Asia/Kolkata');
$dtm = date("Y/m/d H:i:s"); 


if(isset($_GET['add_gst']))
{
	$id=$_GET['add_gst'];
	$query=mysqli_query($conn,"select * from user_profile where id = '$id'");
	$row=mysqli_fetch_array($query);
	$em=$row['email'];
}

$file = 'file.xml';

if(isset($_GET['Download'])) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($file).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    readfile($file);
    exit;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="icon" type="image/png" href="images/icon.png" />
<title>Tally Ledger Add</title>

<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  

	</head>
<body style="background-color:#ccf2ff">
	
<div class ="container-fluid" >   	<!-- body -->
	<div>
		<?php include 'header.inc.php'; ?>
	</div>
	

  <div style="margin-top:100px;">
  <h2 class="text-primary text-center">Add Ledger</h2><br>
</div>  
	
		


<form class="form-horizontal" style="margin-left:10%;" method="POST" action="tally_create_ledger.php">
<div class="form-group row">
<label class="control-label col-md-2"  for="company_name">Tally Company Name<span style="color:red">*</span></label>  
  
	<div class="col-md-3">
	<select class="form-control" name="company_name" required=required>
		<?php 
	 for ($i=0;$i<count($company_name); $i++)
	 {
		 echo "<option value='$company_name[$i]'>$company_name[$i]</option>" ;
	 }
		?>
	</select>
  </div>
  
  
 
</div>


<div class="form-group row">
  <label class="control-label col-md-2"  for="ledger_name">Ledger Name<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="ledger_name"  placeholder="" required=required value="<?php echo $row['comp_name'] ; ?>" class="form-control input-md" type="text">
  </div>
  
   <label class="control-label col-md-2"  for="group">Group<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="group"  placeholder="" required=required value="<?php echo $group; ?>" class="form-control input-md" type="text">
  </div>
</div>

<div class="form-group row">
<label class="control-label col-md-2"  for="address1">Address 1<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="address1"  placeholder="" required=required value="<?php echo $row['cur_add'] ; ?>" class="form-control input-md" type="text">
  </div>
  
  <label class="control-label col-md-2"  for="address2">Address 2<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="address2"  placeholder=""  value="<?php echo $row['perm_add'] ; ?>" class="form-control input-md" type="text">
  </div>
</div>
	
	<div class="form-group row">
<label class="control-label col-md-2"  for="state">State<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="state"  placeholder="" required=required value="<?php echo $row['state'] ; ?>" class="form-control input-md" type="text">
  </div>
  
  <label class="control-label col-md-2"  for="pin">Pin<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="pin"  placeholder=""  value="<?php echo $row['pin_code'] ; ?>" class="form-control input-md" type="text">
  </div>
		
</div>
	
	
	<div class="form-group row">
<label class="control-label col-md-2"  for="country">Country<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="country"  placeholder="" required=required value="<?php echo $row['citizen_country'] ; ?>" class="form-control input-md" type="text">
  </div>
  
 
		
</div>
	

<div class="form-group row">
<label class="control-label col-md-2"  for="contact_person">Contact Person<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="contact_person"  placeholder="" required=required value="<?php echo $row['name'] ; ?>" class="form-control input-md" type="text">
  </div>
  
 
</div>
	
	<div class="form-group row">
<label class="control-label col-md-2"  for="mobile_no">Mobile No.<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="mobile_no"  placeholder=""  value="<?php echo $row['phone_main'] ; ?>" class="form-control input-md" type="text">
  </div>
  
  <label class="control-label col-md-2"  for="phone">Phone<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="phone"  placeholder="" value="<?php echo $row['phone_alt'] ; ?>" class="form-control input-md" type="text">
  </div>
</div>



<div class="form-group row">
	 <label class="control-label col-md-2"  for="email_pri">Email (primary)<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="email_pri"  placeholder=""  value="<?php echo $row['email'] ; ?>" class="form-control input-md" type="text">
  </div>
  
 <label class="control-label col-md-2"  for="email_cc">Email (cc)<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="email_cc"  placeholder=""  class="form-control input-md" type="text">
  </div>
</div>
	
	<div class="form-group row">
		<label class="control-label col-md-2"  for="gsttype">GST Registration Types<span style="color:red">*</span></label>  
   <div class="col-md-3">
	<select class="form-control" name="gsttype" required=required>
		<?php 
	 for ($i=0;$i<count($gsttype); $i++)
	 {
		 echo "<option value='$gsttype[$i]'>$gsttype[$i]</option>" ;
	 }
		?>
	</select>
  </div>
<label class="control-label col-md-2"  for="gstin">GST IN<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="gstin"  placeholder=""  value="<?php echo $row['gstin'] ; ?>" class="form-control input-md" type="text">
  </div>
  
  
 
</div>

<div class="form-group" style="margin-left:35%;">
  <label class=" control-label" for="upload"></label>
  <div>
    <input type="submit" name="submit" class="btn btn-info" value="Submit" style="padding:10px 3%; border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);"/>
    <input type="reset"  name="Reset" class="btn" value="Reset" style="padding:10px 3%; border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);"/>
	  <input type="submit"  name="Download" class="btn" value="Download" style="padding:10px 3%; border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);"/>
	</div>
</div>
</form>
	<!--<form method="get" action="">
	<div class="form-group" style="margin-left:45%;">
  <label class=" control-label" for="upload"></label>
  <div>
	  
	
		</div>
	</div>
	</form>-->
	<div style="position:absolute; width:100%; left:0; right:0; margin-top:151px;">
		<?php include("footer.inc.php"); ?>
	</div>
</div>
</body>
</html>
