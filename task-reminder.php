<?php
ob_start();
session_start();
include 'include/dbi.php';
include 'include/session.php';
include 'include/param.php';
checksession();
$dtm1=getLocalDtm();
$uName=$_SESSION['login'];

if(isset($_POST['submit'])){
	$date1=$_POST['date'];
	$time1=$_POST['time'];
	$dtm=$date1." ".$time1;
	$task_type=$_POST['task_type'];
	$narr= $_POST['narr'];
	$closing= $_POST['output'];
	$status = $_POST['status'];
	
$sql="INSERT into mytasks (datetime, task_type, narration, closing_remark, status, dtm_created,created_by) VALUES('$dtm', '$task_type', '$narr','$closing','$status','$dtm1','$uName')";
$result=mysqli_query($conn,$sql);

//$follow_query=mysqli_query($conn,"INSERT INTO lead_followup(trng_query_id,followup_dtm,followup_text,followup_user) VALUES('$trng_id','$onlydate $onlytime','$closing','$uName')");

header("location:mytask.php");
$err= mysqli_error($conn);
echo $err;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="icon" type="image/png" href="images/icon.png" />
<title>Task Remainder</title>

<meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

<!-- Isolated Version of Bootstrap, not needed if your site already uses Bootstrap -->
<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />

<!-- Bootstrap Date-Picker Plugin -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
<!-- Bootstrap Time-Picker Plugin -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.js" type="text/javascript" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>

  <script>
  $(document).ready(function(){
	  $(window).load(function(){
			   $("#datepick").datepicker({
				   format: 'yyyy-mm-dd',
				   autoclose: true,
	});

	  $("#datepick").click(function(){
		$(this).datepicker({Format: 'yyyy-mm-dd'});
	});
  });
  });
  </script>
  
  
   <script type="text/javascript">
            $(function () {
                $('#datetimepicker3').datetimepicker({
                    format: 'HH:mm',
                });
            });
   </script>
		
<script>
function showtextarea() {
    if($("#status").val() == "Completed")
	{
		$("#closing").show();
	}
	else if($("#status").val() == "Canceled")
	{
		$("#closing").show();
	}
	else{
		$("#closing").hide();
	}
}
</script>
</head>
  
<body style="background-color:#ccf2ff">
<div class ="container-fluid" >
	<div>
		<?php include 'header.inc.php'; ?>
	</div>	

  <div style="margin-top:100px;">
  <h2 class="text-primary text-center">Add Task</h2><br>
  </div>      

<form class="form-horizontal" style="margin-left:10%;" method="POST" >
<div class="form-group row">
 <label class="control-label col-md-2" for="date">Task Date<span style="color:red">*</span></label> 
<div class="col-md-3"> 
  <div class="input-group input-append date" id="datepicker">     
      <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
          <input type="text" class="form-control input-md" name="date" id="datepick" /> 
  </div>  
</div>  
  
 <label class="control-label col-md-2" for="time">Task Time<span style="color:red">*</span></label>  
  <div class="col-md-3">
   <div class='input-group date'>
   <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                    </span>
	<input  name="time" id='datetimepicker3' class="form-control input-md" type="text">
  </div>
  </div>
</div>

<div class="form-group row">
 <label class="control-label col-md-2" for="task_type">Task Type<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<select class="form-control" name="task_type" id="task_type">
	<?php
		for ($i=0;$i<count($task_type); $i++)
	 {
                echo '<option value="'. $task_type[$i] .'">'.$task_type[$i] .'</option>';
            }
			?>
	</select> 
  </div> 
  
<label class="control-label col-md-2" for="narr">Narration<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<textarea name="narr" class="form-control input-md"></textarea>
  </div>
</div>

<div class="form-group row">
<label class="control-label col-md-2" for="status">Status<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<select class="form-control" name="status" id="status" onchange="showtextarea();">
	<?php
		for ($j=0;$j<count($follow_status); $j++)
			 {
                echo '<option value="'. $follow_status[$j] .'">'.$follow_status[$j] .'</option>';
            }
			?>
	</select> 
</div>
<div id="closing" style="display:none;">
<label class="control-label col-md-2" for="output">Output<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<textarea name="output" class="form-control input-md"></textarea>
  </div>
</div>
</div>
  
<div class="form-group" style="margin-left:35%;">
  <label class=" control-label" for="submit"></label>
  <div>
    <input type="submit" name="submit" class="btn btn-info" value="Submit" style="padding:10px 3%; border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);"/>
     <input type="reset" name="cancel" class="btn btn-default" value="Cancel" onClick="location.href = 'mytask.php';" style="padding:10px 3%; border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);"/>
	</div>
</div>
</form>
	<div style="position:absolute; width:100%; left:0; right:0; margin-top:187px;">
		<?php include("footer.inc.php"); ?>
	</div>
</div>
</body>
</html>