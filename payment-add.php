<?php
ob_start();
session_start();
include 'include/dbi.php';
include 'include/session.php';
checksession();
$debug=true ;
if(isset($_POST['a_submit']))
{
	$rct_no=$_POST['rct_no'];
	$date=$_POST['date'];
	$reg= $_POST['reg'];
	$amt_paid=$_POST['amt_paid'];
	$mode=$_POST['mode'];
	$bank=$_POST['bank'];
	$ins_no=$_POST['ins_no'];
	$ins_date=$_POST['ins_date'];
	$narr=$_POST['narr'];
	$user=$_SESSION['login'];
	
	$insert_qry="insert into tbl_receipt(rct_date,rct_no,reg_no,amt_receipt,rct_mode,inst_bank_name,inst_num,inst_date,narr_txt, crtd_by) values('$date','$rct_no','$reg','$amt_paid','$mode','$bank','$ins_no','$ins_date','$narr','$user') " ;
 
   // if ($debug)  echo $insert_qry ;	
	$result= mysqli_query($conn,$insert_qry) ;
	
	if ($result==false){
		$error=mysqli_error($conn) ;
		echo "<BR>Error in Insert Add Payment".$error ;
		die($error) ;
	}
    $id = mysqli_insert_id($conn); 
}


$qry = "SELECT max(rct_no) FROM tbl_receipt where (select max(rct_no) from tbl_receipt)" ;
$sql = mysqli_query($conn, $qry);
$row = mysqli_fetch_array($sql);
 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Payment Add</title>


<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

<script>
function validateForm()
{
	alert("Payment add successfully....");
}
</script>

<script>
function showtext() {
    if($("#pmt_mode").val() == "DD")
	{
		$("#txt").show();
	}
	else if($("#pmt_mode").val() == "Cheque")
	{
		$("#txt").show();
	}
	else{
		$("#txt").hide();
	}
	 if($("#pmt_mode").val() == "DD")
	{
		$("#txt1").show();
	}
	else if($("#pmt_mode").val() == "Cheque")
	{
		$("#txt1").show();
	}
	else{
		$("#txt1").hide();
	}
	
}
</script>
<script type="text/javascript">

$(document).ready(function(){
	$("#reg_no").change(function(){
		var username = $("#reg_no").val();
		var msgbox = $("#status");
		
		if(username.length > 4){
			$("#status").html('<img src="images/loader.gif" align="absmiddle">&nbsp;Checking availability...');
			$.ajax({
				type: "POST",
				url: "payment-registration-no-ajax.php",
				data: "reg="+ username,  
				success: function(msg){  
						if(msg == 'OK'){
							$("#reg_no").removeClass("red");
							$("#reg_no").addClass("green");
							msgbox.html('');
						}else{
							$("#reg_no").removeClass("green");
							$("#reg_no").addClass("red");
							msgbox.html(msg);
							$("#reg_no").focus();
						}
					}
			});
		}else{
			$("#reg_no").addClass("red");
			$("#status").html('<font color="#cc0000">Please enter atleast 5 letters.</font>');
			$("#reg_no").focus();
		}
		return false;
	});
});
</script>
<script>
function fetch_select(val)
{
	$.ajax({
		type: 'post',
		dataType: "text json",
		url: 'payment-json-text.php',
		data: {
			reg_val:val
		},
	success: function (response) {
		document.getElementById("name").value=response[0].name; 
		document.getElementById("add").value=response[0].cur_add; 
		document.getElementById("crs").value=response[0].course_name; 
		document.getElementById("crs_fee").value=response[0].course_fee; 
 }
 });
}
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
<div class ="container col-md-12">
	<div style="left:0;right:0; position:absolute; top:0;">
		<?php include 'header.inc.php'; ?>
	</div>

	<div>
	<h2 class="text-primary text-center" style=" margin-top:100px;">Add Payment</h2>
	</div>
	
<form class="form-horizontal" style="margin-left:10%; margin-bottom:50px;" method="POST" onSubmit="return validateForm(this)">
<div class="form-group row">
<label class="control-label col-md-2"  for="rct_no">Receipt No<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="rct_no" id="no" required=required class="form-control input-md" type="text" value="<?php echo $row['max(rct_no)']+1; ?>" />
  </div>
   <label class="control-label col-md-2" for="date">Date<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="date" required=required class="form-control input-md" type="datetime" value="<?php echo date('Y-m-d'); ?>">
  </div>
 
</div>

<div class="form-group row">
<label class="control-label col-md-2" for="reg">Registration No<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="reg" id="reg_no" required=required class="form-control input-md" type="text" onfocusout="fetch_select(this.value);"><span id="status"></span></input>
  </div>
 
   <label class="control-label col-md-2"  for="name">Name</label>  
  <div class="col-md-3">
	<input  name="name" id="name" class="form-control input-md" type="text" readonly value="" />
  </div>
  
 
</div>

<div class="form-group row">
 <label class="col-md-2 control-label" for="address">Address</label>  
  <div class="col-md-3">
	<textarea name="address" id="add" class="form-control input-md" readonly></textarea>
  </div>
  <label class="col-md-2 control-label" for="course">Course</label>  
  <div class="col-md-3">
	<input  name="course" id="crs" class="form-control input-md" type="text" readonly>
  </div>

 
</div>

<div class="form-group row">
<label class="col-md-2 control-label" for="amount">Course Fee</label>  
  <div class="col-md-3">
	<input  name="amount" id="crs_fee" readonly class="form-control input-md" type="text">
  </div>

 <label class="col-md-2 control-label" for="p_till">Paid Till</label>  
  <div class="col-md-3">
	<input  name="p_till" readonly class="form-control input-md" type="text">
  </div>
 
</div>
<div class="form-group row">
<label class="col-md-2 control-label" for="amt_paid">Amount Paid<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="amt_paid" required=required class="form-control input-md" type="text">
  </div>
<label class="col-md-2 control-label" for="mode">Payment Mode<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<select class="form-control selectpicker" name="mode" id="pmt_mode" required=required onchange="showtext();">
		<option value="Cash" selected>Cash</option>
		<option value="Cheque">Cheque</option>
		<option value="DD">DD</option>
		<option value="Others">Others</option>
  </select> 
  </div>
  </div>
  
  <div class="form-group row">
  <div id="txt" style="display:none;" >
  <label class="col-md-2 control-label" for="bank">Bank Name<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="bank" class="form-control input-md" type="text">
  </div>
<label class="col-md-2 control-label" for="ins_no">Instrument No<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="ins_no" id="ins_txt"  class="form-control input-md" type="text">
  </div>
  </div>
  </div>
  
  <div class="form-group row">
  <div id="txt1" style="display:none;">
  <label class="col-md-2 control-label" for="ins_date">Instrument Date<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="ins_date" id="ins_dt" class="form-control input-md" type="datetime" value="<?php echo date('Y-m-d'); ?>">
  </div>
  </div>
<label class="col-md-2 control-label" for="narr">Narration</label>  
  <div class="col-md-3">
	<textarea name="narr" class="form-control input-md"></textarea>
  </div>
  </div>
  
<div class="form-group" style="margin-left:30%;">
  <label class=" control-label" for="a_submit"></label>
	<div>
    <input type="submit" name="a_submit" class="btn btn-info" value="Submit" style="padding:10px 7%;"/>
    <input type="reset"  name="Reset" class="btn" value="Reset" onClick="window.location.reload()" style="padding:10px 7%;"/>
	</div>
</div>
</form>

<?php 
?>
</div>

	<div style="width:100%; bottom:0; left:0; right:0; position:absolute;">
		<?php include("footer.inc.php"); ?>
	</div>
</body>
</html>