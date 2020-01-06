<?php 
ob_start();
session_start();
include 'include/dbi.php';
include 'include/session.php';

$lead_followup_id=$_GET['mod_id'];
$record=mysqli_query($conn,"select * from lead_followup l where l.lead_followup_id='".$lead_followup_id."'");
$fetch=mysqli_fetch_array($record);

?>
<html>
<head>
	 <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="js/jquery-2.2.0.min.js" type="text/javascript"></script> 
  <link rel="stylesheet" type="text/css" href="css/jquery.timepicker.css">
<link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
<script src="js/jquery.timepicker.js" type="text/javascript"></script> 
<script src="js/jquery-2.2.0.min.js" type="text/javascript"></script> 
<script src="js/jquery-ui.js" type="text/javascript"></script> 

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="icon" type="image/png" href="images/icon.png" />
        <title>Training Lead FollowUp Update</title>
     
      
        <!--<link href="css/datetimepicker.css" rel="stylesheet" type="text/css">-->
      
       <script>
	   $(document).ready(function(){
		
		  $("#todaydate").focus(function(){
		$(this).datepicker({dateFormat: 'dd-mm-yy'}).val();
	});
	
	$("#todaytime").focus(function(){
		$(this).timepicker({timeFormat:  'hh:mm:ss'}).val();
	});
	 
	   });
	   </script>
    </head>


<body style="background-color:#ccf2ff">
<div class ="container-fluid" >   
<div>
		<?php include 'header.inc.php'; ?>
	</div>
<div style="margin-top:100px;">
<h2 class="text-primary text-center">Modify- FollowUp Record</h2>
</div>
<form class="form-horizontal" style="margin-left:27%; margin-top:30px;" method="post">
<fieldset>

<!-- Form Name -->

<!-- Text input-->
<div class="form-group">
  <label class="col-md-2 control-label" for="mod_date">Date: </label>  
  <div class="col-md-4">
  <input  name="mod_date" placeholder="" id="todaydate" value="<?php echo substr($fetch['followup_dtm'],0,10); ?>" class="form-control input-md" required="" type="text">
    
  </div>
</div>
<!-- Text input-->
<div class="form-group">
  <label class="col-md-2 control-label" for="mod_time">Time: </label>  
  <div class="col-md-4">
  <input  name="mod_time" id="todaytime" placeholder="" value="<?php echo substr($fetch['followup_dtm'],11,8); ?>" class="form-control input-md" required="" type="text">
    
  </div>
</div>
<!-- Textarea -->
<div class="form-group">
  <label class="col-md-2 control-label" for="mod_text">Text: </label>
  <div class="col-md-4">                     
    <textarea class="form-control" id="mod_text" name="mod_text"><?php echo $fetch['followup_text']; ?></textarea>
  </div>
</div>
<!-- Button (Double) -->
<div class="form-group" style="margin-right:29%;">
  <label class="col-md-4 control-label" for="update"></label>
  <div class="col-md-8">
    <input type="submit"  name="update" class="btn btn-warning" value="Update"/>
    <input type="submit"  name="cancel" class="btn" value="Cancel"/>
  </div>
</div>
</fieldset>
</form>
</div>
<div style="position:absolute; width:100%; left:0; right:0; bottom:0;">
		<?php include("footer.inc.php"); ?>
		</div>
</body>
<?php

if(isset($_POST['cancel']))
{
	 header("Location:lead_view_record.php?view_id=".$_GET['view_id']."&page=".$_GET['page']);
}
  if(isset($_POST['update']))
	  {		
		$followupuser=$_SESSION['login'];
		$update_date=$_POST['mod_date'];
		$update_time=$_POST['mod_time'];
		$update_dtm=$update_date." ".$update_time;
		$update_text=$_POST['mod_text'];	   
		mysqli_query($conn,"update lead_followup set followup_dtm='$update_dtm',followup_text='$update_text',followup_user='$followupuser' where lead_followup_id='$lead_followup_id'") or die(mysqli_error($conn));
		  
		header("Location:lead_view_record.php?view_id=".$_GET['view_id']."&page=".$_GET['page']);	  
} 
?>