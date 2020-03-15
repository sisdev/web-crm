<?php
ob_start();
session_start();
include 'include/dbi.php';
include 'include/session.php';
include 'include/param.php';

checksession();


	$base_qry="SELECT username FROM users WHERE role='trainer'";
	$rss = mysqli_query($conn,$base_qry);
	$rowss=mysqli_fetch_array($rss);


if(isset($_POST['update_id']))
{
	$id=$_POST['update_id'];
	$selectsql="select * from trng_batches where id = '$id'";
	$rs = mysqli_query($conn,$selectsql);
	$rows=mysqli_fetch_array($rs);
}




 if(isset($_POST['update'])){
	 
$batchid= $_POST['batchid'];
$start = $_POST['startdate'];
$cource = $_POST['courcename'];
$duration = $_POST['duration'];
$profile = $_POST['facultyprofile'];
$daytime = $_POST['daytime'];
$batchstatus = $_POST['batchstatus'];
$enddate = $_POST['enddate'];

$remark= $_POST['remark'];

$sql="INSERT INTO trng_batches_actual(batch_id,start_date,course_name,duration,faculty_name,day_and_time,batch_status,remark) VALUES('$batchid','$start','$cource','$duration','$profile','$daytime','$batchstatus','$remark')";
 header("location:batch-view.php");

//echo $sql;

$result=mysqli_query($conn,$sql);
	 
//	 or die("query failed".mysqli_error($conn))
//echo "<br>";
//echo "1111:".$result;
	if ($result){
		echo "success result";
	}
	 else{
		 echo "failed  result";
		 
		 echo mysqli_errno($conn).":".mysqli_error($conn);
exit;
	 }

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
        <title>Update Batch Record</title>
        <link rel="icon" type="image/png" href="images/icon.png" />
      
        
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
					alert('Batch Updated Successfully..');
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

<div class ="container-fluid">   	
	<div>
		<?php include 'header.inc.php'; ?>
	</div>
	<div class="row" style="margin-top:90px;">
	<div class="col-md-2">
	<ul class="pager">
	<li class="previous"><a href="batch-view.php"><< Back</a></li>
	</ul>
	</div>
	<div class="col-md-8">
	<h2 class="text-primary text-center"> Batch Start</h2>
	</div> 
	</div>
	<form class="form-horizontal" style="margin-left:25%;" method="post" enctype="multipart/form-data"  onSubmit="return validateForm(this)">
	<div><?php if(isset($_GET['msg'])) echo $_GET['msg'];?></div>
	
	<div class="form-group row">
	<label class="control-label col-md-2" for="batchid">Batch ID<span style="color:red">*</span></label>  
	<div class="col-md-4">
	<input  name="batchid"  placeholder="" id="Event Name" class="form-control input-md" type="text" value="<?php echo $rows['batch_id']; ?>"/>
	</div>
	</div>
	
	<div class="form-group row">
	<label class="col-md-2 control-label" for="startdate">Start Date<span style="color:red">*</span></label>  
	<div class="col-md-4">
  <div class="input-group input-append date" id="datePicker">     
      <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
          <input type="text" class="form-control input-md" name="startdate" id="datepick"  placeholder="yy-mm-dd" value="<?php echo $rows['start_date']; ?>"/> 
	     </div>   	
         </div>
		  </div>
	
	
	<div class="form-group row">
	<label class="control-label col-md-2"  for="courcename">Course Name<span style="color:red">*</span></label>  
	<div class="col-md-4">
	<input  name="courcename"  placeholder="" id="Event Name" class="form-control input-md" type="text" value="<?php echo $rows['course_name']; ?>"/>
	</div>
	</div>
	
	<div class="form-group row">
  <label class="col-md-2 control-label" for="duration">Duration<span style="color:red">*</span></label>  
  <div class="col-md-4">
	<input id="Event Name" name="duration" class="form-control input-md" type="text" value="<?php echo $rows['duration']; ?>"/>
  </div>
</div>


<div class="form-group row">
  <label class="col-md-2 control-label" for="facultyprofile">Faculty Name<span style="color:red">*</span></label>  
  <div class="col-md-4">
	  <?php
	          

  echo '<select   class="form-control input-md" name="facultyprofile" >';
  //echo "<select name='to_user'>";
             while ($rowss=mysqli_fetch_array($rss)){
         echo "<option value='". $rowss['username'] ."'>" .$rowss['username'] ."</option>" ;
                            }
                            echo "</select>" ;

	  ?>
	
  </div>
</div>

<div class="form-group row">
  <label class="col-md-2 control-label" for="daytime">Day&amp;Time<span style="color:red">*</span></label>  
  <div class="col-md-4">
	<input id="Event Name" name="daytime" class="form-control input-md" type="text" value="<?php echo $rows['day_and_time']; ?>"/>
  </div>
</div>



<div class="form-group row">
  <label class="col-md-2 control-label" for="batchstatus">Batch Status<span style="color:red">*</span></label>  
   <div class="col-md-4">
	<select class="form-control" name="batchstatus" required=required>
		<?php 
	 for ($i=0;$i<count($batch_status); $i++)
	 {
		 echo "<option value='$batch_status[$i]'>$batch_status[$i]</option>" ;
	 }
		?>
	</select>
  </div>  
</div> 
		
		<div class="form-group row">
  <label class="col-md-2 control-label" for="enddate">End Date<span style="color:red">*</span></label>  
 <div class="col-md-4">
  <div class="input-group input-append date" id="datePicker">     
      <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
          <input type="text" class="form-control input-md" name="enddate" id="datepick"  placeholder="yy-mm-dd" /> 
	     </div>   	
         </div>
</div> 
		
		<div class="form-group row">
  <label class="col-md-2 control-label" for="remark">Remark<span style="color:red">*</span></label>  
  <div class="col-md-4">
	<input id="Event Name" name="remark" class="form-control input-md" type="text" value="<?php echo $rowss['username']; ?>" />
  </div>
</div> 

<div class="form-group" style="margin-left:19%;">
  <label class=" control-label" for="update"></label>
  <div>
    <input type="text"  hidden  name="tid"   value="<?php echo $rows['id']; ?>"/>
	<input type="submit" class="btn btn-warning" name="update"  style="padding:10px 5%;" value="Submit"/>
	<input type="reset"  name="Reset" class="btn" value="Cancel" onClick="location.href = 'batch-view.php';" style="padding:10px 5%;"/>
	</div>
</div>
</form>
		
</div>
	
	
<div>
		<?php include("footer.inc.php"); ?>
		</div>
    </body>
</html>
