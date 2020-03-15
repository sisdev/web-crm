<?php
ob_start();
session_start();
include 'include/dbi.php';
include 'include/session.php';
checksession();
$created_by=$_SESSION['login'];
$dtm=date("Y-m-d H:i:s");
$batch_id = $_POST['update_id'];
$base_qry="SELECT * FROM trng_batches_actual where batch_id = '$batch_id'";
		//echo $base_qry ;
	$rs = mysqli_query($conn,$base_qry);
	$rows=mysqli_fetch_array($rs);




	$qry_s="SELECT * FROM deal_log where batch_id = '$batch_id'";
		//echo $qry ;
	$rsss = mysqli_query($conn,$qry_s);




if(isset($_POST['submit'])){
	$batch_id=$_POST['batch_id'];
	$startdate=$_POST['startdate'];
	$reg_id=$_POST['reg_id'];
	
	
	$comment= $_POST['comment'];	
	$username=$_POST['user_name'];
	$attend = $_POST['attend_val'];
	print_r($username);
	print_r($attend);
	
    $chk="";  
	$student_count = count($username);
	$x = 0 ;
//	$attendval = 'P';
	$sql="INSERT into trng_batch_class (batch_id, class_dt,comment,created_dtm,created_by) VALUES('$batch_id', '$startdate', '$comment','$dtm','$created_by')";
		//echo $sql ;
		$result=mysqli_query($conn,$sql);
    for($x=0 ; $x<$student_count; $x++)  
       {  
		
		$sql="INSERT into trng_batch_students (batch_id, class_dt, student_reg_id, attend_status,comment,created_dtm,created_by) VALUES('$batch_id', '$startdate', '$reg_id[$x]','$attend[$x]','$comment','$dtm','$created_by')";
		echo $sql ;
		$result=mysqli_query($conn,$sql);
       } 
	//$checkbox= $_POST['checkbox'];
	
	
	
	
	



//header("location:mytask.php");
$err= mysqli_error($conn);
//echo $sql;
//	exit(0);
}



?>
<html>
    <head>
      <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
<script src="js/jquery.timepicker.js" type="text/javascript"></script> 
<script src="js/jquery-2.2.0.min.js" type="text/javascript"></script> 
<script src="js/jquery-ui.js" type="text/javascript"></script> 
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" type="text/css" rel="stylesheet">
	<meta http-equiv="Content-Type" content="text/html;"/>
       
        <title>Manage Students</title>
      <link rel="icon" type="image/png" href="images/icon.png" />

<script>
$(document).ready(function(){
	  $(window).load(function(){
			   $("#datepick").datepicker({
				   format: 'yyyy-mm-dd'
		  
	  });

	  $("#datepick").click(function(){
		
		$(this).datepicker({Format: 'yyyy-mm-dd'});
	});
  });
  });
	
function chkBox(val1,val2)
	{
	//	alert("Checl Box clciked:"+val1+":"+val2);
		var fldName="attend_val"+val1 ;
	//	alert(fldName);
		if (val2)
		document.getElementById(fldName).value='P';
		else
		document.getElementById(fldName).value='A';	
	}
	
	
		</script>

<style>
  ttbody:nth-of-type(odd) {
 background: #99d6ff ;
}
th {
 background: #ffb3b3 ;
 font-weight: bold;
}
  </style>


</head>
    

    <body style="background-color:#ccf2ff">
<div class ="container col-md-12">
	<div>
		<?php include 'header.inc.php'; ?>
		
	</div>

	<div class="col-md-12">
	<ul class="pager">
	<li class="previous"><a href="batch-act-manage.php"><< Back</a></li>
	</ul>
	</div>
	

 <div>
<h2 class="text-primary text-center" style="margin-top:90px;">Batch Attendance Entry</h2>
</div>

<form class="form-horizontal" style="margin-left:2%;" method="POST" onSubmit="return validateForm(this)">
<div class="form-group row">
  <label class="control-label col-md-2" for="batch_id">Batch Id<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input class="form-control" name="batch_id" id="batch_id" readonly required=required  value="<?php echo $rows["batch_id"];?>" >
</div>
  <label class="control-label col-md-2"  for="startdate">Date<span style="color:red">*</span></label>  
  <div class="col-md-3">
	 <div class="input-group input-append date" id="datePicker">     
      <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
          <input type="text" class="form-control input-md" name="startdate" id="datepick"  placeholder="yy-mm-dd" value="<?php echo date('Y-m-d'); ?>"/> 
	     </div>   	
	
  </div>
	</div>
	<div class="form-group row">
	<label class="control-label col-md-2" for="comment">Comment<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input class="form-control" name="comment" id="comment" >
</div>
	</div>
	
	
	

	
	<br>
	<br>
	<br>
	<div class="container col-md-12">
	
	<div style="overflow-x:auto;">
	<table class="table table-bordered" style="text-align:center; ">

    <thead>
      <tr>
		<th style='color:#b30059;  '>Registration Id</th>
		<th style='color:#b30059; text-align:center;'>Name</th>
		<th style='color:#b30059; text-align:center;'>Attendance</th>
      </tr>
    </thead>

	<ttbody>
                                                  
         <?php
		 $i = 0 ;
		 while($rowsss=mysqli_fetch_array($rsss)) {  ?>
		
			 <tr>
				 <td style="width: 250px;">
					 <input class="form-control" readonly name="reg_id[]" style="width: 250px;"  id="reg_id" required=required  value='<?php echo $rowsss["reg_id"];?>'></td>
			  <td align="center" >
				  <input class="form-control" readonly name="user_name[]" style="width: 250px;" id="user_name" required=required  value='<?php echo $rowsss["user_name"];?>'></td>
			 <td align="center">
		     	 <input type="checkbox" name="attendence[]" value="present" checked onclick="chkBox(<?php echo $i;?>, this.checked)" >Present
				 <input hidden id="attend_val<?php echo $i;?>" name="attend_val[]" value="P">
             <br>
 
  </td>
				   </tr>
		<?php $i++; }?>
		

        </ttbody>
        </table>
		</div>
		</div>
	</div>
	
	<div class="form-group" style="margin-left:35%;">
  <label class=" control-label" for="submit"></label>
  <div>
	  <input type = "hidden" name ="update_id" value ="<?php echo $rows["batch_id"]; ?>">
    <input type="submit" name="submit" class="btn btn-info" value="Submit" style="padding:10px 3%; border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);"/>
	  <input type="reset" name="cancel" class="btn btn-default" onclick="history.go(-2); return false;" value="Cancel"  style="padding:10px 3%; border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);"/>
	</div>
	</div>
	
		  </form>

	
	
		

	

	
	
		<div style="position:absolute; left:0; right:0; width:100%;">
		<?php include("footer.inc.php"); ?>
	</div>
        
		
    </body>
</html>
