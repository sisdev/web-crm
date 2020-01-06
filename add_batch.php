<?php
ob_start();
session_start();
include 'include/dbi.php';
include 'include/session.php';

checksession();
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
<link rel="icon" type="image/png" href="images/icon.png" />
    <title>Add Batch</title> 
   
    <script type="text/javascript">
function validateForm(form)
{
	var flag=true;
	
	if(form.batchid.value=="")
	{
		flag=false;
		alert("Batch ID field should not be blank");
		form.batchid.focus();
	}
	else if(form.courcename.value=="")
	{
		flag=false;
		alert("Cource field could not be blank");
		form.courcename.focus();
		return false;
	}
else if(form.duration.value=="")
	{flag=false;
		alert("Duration field could not be blank");
		form.duration.focus();
			}
	else if(form.facultyprofile.value=="")
	{
		flag=false;
		alert("Faculty Profile field could not be blank");
		form.facultyprofile.focus();
		
	}
	else if(form.daytime.value=="")
	{
		flag=false;
		alert("Day & Time field could not be blank");
		form.daytime.focus();
		
	}
	else if(form.noofseat.value=="")
	{
		flag=false;
		alert("No of Seats field could not be blank");
		form.noofseat.focus();
		
	}
	else if(isNaN(form.noofseat.value))
				{
					alert("plz enter number in Seats");
				form.noofseat.focus();
				return false;
				}
				else 
				{
					alert('Batche Added Successfully..');
				}
			
	return(flag);
}

 
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
 
</script>
</head>
    
<body style="background-color:#ccf2ff">

<div class ="container-fluid" >   	<!-- body -->
	<div>
		<?php include 'header.inc.php'; ?>
	</div>
	<div style="margin-top:100px;">
	<h2 class="text-primary text-center">Add Batch Details</h2>
	</div> 
     
 <form class="form-horizontal" style="margin-left:27%;" action="admin_add_batch_action.php" method="post" enctype="multipart/form-data" name="eform" onSubmit="return validateForm(this)">
<!-- Form Name -->
<div><?php if(isset($_GET['msg'])) echo $_GET['msg'];?></div>
<!-- Text input-->
<div class="form-group row">
  <label class="control-label col-md-2"  for="batchid">Batch ID<span style="color:red">*</span></label>  
  <div class="col-md-4">
	<input  name="batchid"  placeholder="" id="Event Name" class="form-control input-md" type="text">
  </div>
</div>

<div class="form-group row">

  <label class="col-md-2 control-label" >Start Date<span style="color:red">*</span></label>  
  <div class="col-md-4">
  <div class="input-group input-append date" id="datePicker">     
      <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
          <input type="text" class="form-control input-md" name="startdate" id="datepick"  placeholder="yy-mm-dd" > 
	     </div>   	
        
		  </div>
</div>


<div class="form-group row">
  <label class="col-md-2 control-label" for="coursename">Course Name<span style="color:red">*</span></label>  
  <div class="col-md-4">
	<input placeholder="" id="Event Name" name="coursename" class="form-control input-md" type="text">
  </div>
</div>

<div class="form-group row">
  <label class="col-md-2 control-label" for="duration">Duration<span style="color:red">*</span></label>  
  <div class="col-md-4">
	<input placeholder="" id="Event Name" name="duration" class="form-control input-md" type="text">
  </div>
</div>


<div>
<div class="form-group row">
  <label class="col-md-2 control-label" for="facultyprofile">Faculty Profile<span style="color:red">*</span></label>  
  <div class="col-md-4">
	<textarea id="venue" name="facultyprofile" class="form-control input-md" cols="20" rows=""></textarea>
  </div>
</div>
<div class="form-group row">
  <label class="col-md-2 control-label" for="daytime">Day&amp;Time<span style="color:red">*</span></label>  
  <div class="col-md-4">
	<input id="Event Name" name="daytime" class="form-control input-md" type="text">
  </div>
</div>
</div>

<div class="form-group row">
  <label class="col-md-2 control-label" for="coursefee">Course Fees<span style="color:red">*</span></label>  
  <div class="col-md-4">
	<input id="Event Name" name="coursefee" class="form-control input-md" type="text">
  </div>
</div>
 
<div class="form-group row">
  <label class="col-md-2 control-label" for="noofseat">No. of Seats<span style="color:red">*</span></label>  
  <div class="col-md-4">
	<input id="Event Name" name="noofseat" class="form-control input-md" type="text">
  </div>
</div> 
 
<div class="form-group" style="margin-left:20%;">
  <label class=" control-label" for="upload"></label>
  <div>
    <input type="submit" class="btn btn-info" name="upload" value="Submit" onClick="return checkleapyear()" style="padding:10px 3%;"/>
    <input type="Reset"  name="Reset" class="btn" value="Reset" style="padding:10px 3%;"/>
	</div>
</div>


</form>
		
	</div>
	<div>
		<?php include("footer.inc.php"); ?>
		</div>
  </body>
</html>
