<?php
ob_start();
session_start();
include 'include/dbi.php';
include 'include/session.php';
checksession();
$batch_id = '' ;
$qry_class_dt = "" ;



if (isset($_POST['view_attendance']))
{
  $batch_id = $_POST['update_id'];	
	
}

$base_qry="SELECT DISTINCT class_dt FROM trng_batch_students where batch_id='$batch_id'";
$base_qry="select * from trng_batch_class where batch_id='$batch_id'";
	$rss = mysqli_query($conn,$base_qry);
	//$rowss=mysqli_fetch_array($rss);
//echo $base_qry;
$rowcount=mysqli_num_rows($rss);
if ($rowcount==0){
	//echo "no attendence record existing";
	//exit(0);
	
	    header("batch-students-manage.php");
}

?>
<html>
    <head>
	<title>Attendance View</title>
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
<h2 class="text-primary text-center" style="margin-top:90px;">Batch Class View</h2>
</div>

	
	<div style="overflow-x:auto;">
		<table class="table table-bordered" style="text-align:center; ">
 
    <thead>
      <tr>
		<th style='color:#b30059;  '>Batch Id</th>
		<th style='color:#b30059; text-align:center;'>Date</th>
		<th style='color:#b30059; text-align:center;'>Comment</th>
		 <th style='color:#b30059; text-align:center;'>View</th>
      </tr>
    </thead>

	<tbody>
		
		<?php
		while($rowss=mysqli_fetch_array($rss)) {  ?>
		<form class="form-horizontal" style="margin-left:2%;" method="POST" action="batch-attendance-view.php">
		
			 <tr>
				 <td style="width: 250px;">
					 <input class="form-control" readonly name="reg_id" style="width: 250px;"  id="reg_id" required=required  value='<?php echo $batch_id;?>'></td>
			  <td align="center" >
				  <input class="form-control" readonly name="startdate" style="width: 250px;" id="user_name" required=required  value='<?php echo $rowss['class_dt'] ; ?>'></td>
				 
				  <td align="center" >
				  <input class="form-control" readonly name="comment" style="width: 250px;" id="user_name" required=required  value='<?php echo $rowss['comment'] ; ?>'></td>
				 
				 <td align="center" >
				
				   <input type="submit" name="s_submit" class="btn btn-info" value="View" style="padding:6px 2%; border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);"/></td>
		
				   </tr>
		</form>
		<?php 
			} // while loop
			
			?>
		
		</tbody>
        </table>
	</div>
		<div style="position:absolute;  left:0; right:0; width:100%;">
		<?php include("footer.inc.php"); ?>
	</div>
		
    </body>
</html>
