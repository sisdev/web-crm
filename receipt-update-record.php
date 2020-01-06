<?php
ob_start();
session_start();
include 'include/dbi.php';
include 'include/session.php';

checksession();
if(isset($_POST['update_id']))
{
	$id=$_POST['update_id'];
	$selectsql="select * from tbl_receipt where id = '$id'";
	$rs = mysqli_query($conn,$selectsql);
	$rows=mysqli_fetch_array($rs);
}

 if(isset($_POST['update'])){
	 
	$rct_no=$_POST['rct_no'];
	$date=$_POST['date'];
	$reg= $_POST['reg'];
	$amt_paid=$_POST['amt_paid'];
	$mode=$_POST['mode'];
	$bank=$_POST['bank'];
	$ins_no=$_POST['ins_no'];
	$ins_date=$_POST['ins_date'];
	$narr=$_POST['narr'];
	$ids = $_POST['tid'];

$sql="UPDATE tbl_receipt set rct_no ='$rct_no',rct_date ='$date',reg_no ='$reg',amt_receipt = '$amt_paid',rct_mode ='$mode',inst_bank_name = '$bank', inst_num= '$ins_no', inst_date=" . ($ins_date==NULL ? "NULL" : "'$ins_date'") . ", narr_txt='$narr' where  id = $ids";

echo $sql;

$result=mysqli_query($conn,$sql)or die("query failed".mysqli_error($conn));
header("location:receipt-report-for-duration.php");
exit;
 }
?>
<html>
    <head>
		<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
<script src="js/jquery.timepicker.js" type="text/javascript"></script> 
<script src="js/jquery-2.2.0.min.js" type="text/javascript"></script> 
<script src="js/jquery-ui.js" type="text/javascript"></script> 
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
        <title>Receipt Update</title>
        <link rel="icon" type="image/png" href="images/icon.png" />
      
        
        <script type="text/javascript">

		function validateForm(form)
{
	var flag=true;
	if(form.rct_no.value=="")
	{
		flag=false;
		alert("Receipt No field should not be blank");
		form.rct_no.focus();
	
	}

	else if(form.date.value=="")
	{
		flag=false;
		alert("Date field could not be blank");
		form.date.focus();
		return false;
	}
else if(form.reg.value=="")
	{flag=false;
		alert("Registration No field could not be blank");
		form.reg.focus();
			}
	else if(form.amt_paid.value=="")
	{
		flag=false;
		alert("Amount Receipt field could not be blank");
		form.amt_paid.focus();
		
	}
	else if(form.mode.value=="")
	{
		flag=false;
		alert("Payment Mode field could not be blank");
		form.mode.focus();
		
	}
	
				else 
				{
					alert('Receipt Updated Successfully..');
				}
	return(flag);
}


</script>
<script>
window.onload = showtext;
function showtext() {
    if($("#pmode").val() == "DD")
	{
		$("#txt").show();
	}
	else if($("#pmode").val() == "Cheque")
	{
		$("#txt").show();
	}
	else{
		$("#txt").hide();
	}
	 if($("#pmode").val() == "DD")
	{
		$("#txt1").show();
	}
	else if($("#pmode").val() == "Cheque")
	{
		$("#txt1").show();
	}
	else{
		$("#txt1").hide();
	}
}
</script>
</head>
    
<body style="background-color:#ccf2ff">

<div class ="container">   	
	<div>
		<?php include 'header.inc.php'; ?>
	</div>
	<div class="row" style="margin-top:90px;">
	<div class="col-md-2">
	<ul class="pager">
	<li class="previous"><a href="receipt-report-for-duration.php"><< Back</a></li>
	</ul>
	</div>
	<div class="col-md-8">
	<h2 class="text-primary text-center">Update Receipt-Details</h2>
	</div> 
	</div>
	<form class="form-horizontal" style="margin-left:12%;" action="receipt-update-record.php" method="post" enctype="multipart/form-data"  onSubmit="return validateForm(this)">
	<div><?php if(isset($_GET['msg'])) echo $_GET['msg'];?></div>
	
<div class="form-group row">
<label class="control-label col-md-2"  for="rct_no">Receipt No<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="rct_no" id="no" required=required class="form-control input-md" type="text" value="<?php echo $rows['rct_no']; ?>" />
  </div>
   <label class="control-label col-md-2" for="date">Date<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="date" required=required class="form-control input-md" type="datetime" value="<?php echo $rows['rct_date']; ?>" />
  </div>
 
</div>

<div class="form-group row">
<label class="control-label col-md-2" for="reg">Registration No<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="reg" id="reg_no" required=required class="form-control input-md" type="text" value="<?php echo $rows['reg_no']; ?>"><span id="status"></span></input>
  </div>
 <label class="col-md-2 control-label" for="amt_paid">Amount Paid<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="amt_paid" required=required class="form-control input-md" type="text" value="<?php echo $rows['amt_receipt']; ?>">
  </div>
</div>


<div class="form-group row">
<label class="col-md-2 control-label" for="mode">Payment Mode<span style="color:red">*</span></label>  
   <div class="col-md-3">
	<select class="form-control selectpicker" name="mode" id="pmode" required=required onchange="showtext();" onload = "showtext()">
		 <option value="Cash" <?php if($rows['rct_mode'] == 'Cash') echo "selected"; ?>>Cash</option>
         <option value="DD" <?php if($rows['rct_mode'] == 'DD') echo "selected"; ?>>DD</option>
		 <option value="Cheque" <?php if($rows['rct_mode'] == 'Cheque') echo "selected"; ?>>Cheque</option>
         <option value="Others" <?php if($rows['rct_mode'] == 'Others') echo "selected"; ?>>Others</option>
	</select> 
  </div>
	<div id="txt" style="display:none;">
   <label class="col-md-2 control-label" for="bank">Bank Name<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input name="bank" class="form-control input-md" type="text" value="<?php echo $rows['inst_bank_name']; ?>">
  </div>
  </div>
  </div>
  
  <div id="txt1" style="display:none" class="form-group row">
 <label class="col-md-2 control-label" for="ins_no">Instrument No<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="ins_no" id="ins_txt"  class="form-control input-md" type="text" value="<?php echo $rows['inst_num']; ?>">
  </div>
	
 <label class="col-md-2 control-label" for="ins_date">Instrument Date<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input name="ins_date" id="ins_dt" class="form-control input-md" type="date" value="<?php echo $rows['inst_date']; ?>">
  </div>
  </div>
  
  <div class="form-group row">
	<label class="col-md-2 control-label" for="narr">Narration</label>  
  <div class="col-md-3">
	<textarea name="narr" class="form-control input-md" ><?php echo $rows['narr_txt']; ?></textarea>
  </div>
  </div> 

<div class="form-group" style="margin-left:27%;">
  <label class=" control-label" for="update"></label>
  <div>
    <input type="text"  hidden  name="tid"   value="<?php echo $rows['id']; ?>"/>
	<input type="submit" class="btn btn-warning" name="update"  style="padding:10px 7%;" value="Update"/>
	<input type="reset"  name="Reset" class="btn" value="Cancel" onClick="location.href = 'receipt-report-for-duration.php';" style="padding:10px 7%;"/>
	</div>
</div>
</form>
		
</div>
<div style="position:relative; margin-top:165px;">
		<?php include("footer.inc.php"); ?>
		</div>
    </body>
</html>
