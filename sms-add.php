<?php
ob_start();
session_start();
include 'include/dbi.php';
include 'include/session.php';
checksession();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SMS Add</title>
<link rel="icon" type="image/png" href="images/icon.png" />
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  


<body style="background-color:#ccf2ff">
<div class ="container-fluid" >   
	<div>
		<?php include 'header.inc.php'; ?>
	</div>
<div class="row" style="margin-top:100px;">
<div class="col-md-1"></div>
	<div class="col-md-1">
	<ul class="pager">
	<li class="previous"><a href="sms-manage.php"><< Back</a></li>
	</ul>
	</div>
  <div class="col-md-8">
  <h2 class="text-primary text-center">Add Message</h2><br>
</div>      
</div>
<form class="form-horizontal" style="margin-left:22%;" method="POST">
<div class="form-group row">
  <label class="control-label col-md-2"  for="code">Msg_Code<span style="color:red">*</span></label>  
  <div class="col-md-5">
	<input  name="code"  placeholder="" required=required class="form-control input-md" type="text">
  </div>
</div>


<div class="form-group row">
  <label class="col-md-2 control-label" for="msg">Message<span style="color:red">*</span></label>  
  <div class="col-md-5">
	<textarea id="msg" name="msg" required=required class="form-control input-md" cols="18" rows="10"></textarea>
  </div>
</div>


<div class="form-group" style="margin-left:25%;">
  <label class=" control-label" for="upload"></label>
  <div>
    <input type="submit" name="upload" class="btn btn-info" value="Add" style="padding:10px 4%;"/>
    <input type="reset"  name="Reset" class="btn" value="Reset" style="padding:10px 4%;"/>
	</div>
</div>
</form>
<?php
if (isset($_POST['upload'])) {
  
    $code = $_POST['code'];
    $msg = $_POST['msg'];
	$crtd_by=$_SESSION['login'];
	date_default_timezone_set('Asia/Kolkata');
	$dtm = date("Y/m/d H:i:s");
    $eventsql = "INSERT INTO
                  sms_template(msg_code,msg_txt,created_by,create_dtm)
                   VALUES('$code','$msg','$crtd_by','$dtm')";
	
	echo $eventsql ;
       if( mysqli_query($conn,$eventsql))
	   {
        header("location:sms-manage.php?msg= Message Added Successfully..");
       echo "Message added successfully";
	   }
	   else 
	   {
		   $error = mysqli_error($conn); 
		   echo $error;
        
	   }
    }
    else {
        //echo "Fail";
		
}
?>

</div>
<div style="position:absolute; bottom:0; width:100%;">
		<?php include("footer.inc.php"); ?>
	</div>
</body>
</html>
