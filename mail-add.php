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
<title>Mail Add</title>
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
<div class="row" style="margin-top:80px;">
	<div class="col-md-2">
	<ul class="pager">
	<li class="previous"><a href="mail-manage.php"><< Back</a></li>
	</ul>
	</div>
  <div class="col-md-8">
  <h2 class="text-primary text-center">Add Mail</h2><br>
</div>      
</div>
<form class="form-horizontal" style="margin-left:20%;" method="POST">
<div class="form-group row">
  <label class="control-label col-md-2"  for="code">Mail_Code<span style="color:red">*</span></label>  
  <div class="col-md-5">
	<input  name="code"  placeholder="" required=required class="form-control input-md" type="text">
  </div>
</div>

<div class="form-group row">
  <label class="control-label col-md-2"  for="subject">Subject<span style="color:red">*</span></label>  
  <div class="col-md-5">
	<input  name="subject"  placeholder="" required=required class="form-control input-md" type="text">
  </div>
</div>

<div class="form-group row">
  <label class="col-md-2 control-label" for="msg">Mail_Text<span style="color:red">*</span></label>  
  <div class="col-md-5">
	<textarea id="msg" name="msg" required=required class="form-control input-md" cols="15" rows="6"></textarea>
  </div>
</div>

<div class="form-group row">
  <label class="control-label col-md-2"  for="e_sign">Mail_Sign</label>  
  <div class="col-md-5">
	<textarea  name="e_sign"  placeholder="" class="form-control input-md" cols="15" rows="6"></textarea>
  </div>
</div>

<div class="form-group" style="margin-left:28%;">
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
    $subject = $_POST['subject'];
    $esign = $_POST['e_sign'];
    $msg = $_POST['msg'];
	$crtd_by = $_SESSION['login'];
	$dtm = date('Y-m-d\TH:i:s.u');
    $eventsql = "INSERT INTO
                  email_template(email_temp_name,email_sign,email_subject,email_text,dt_created,created_by)
                   VALUES('$code','$esign','$subject','$msg','$dtm','$crtd_by')";
	
	echo $eventsql ;
       if( mysqli_query($conn,$eventsql))
	   {
        header("location:mail-manage.php");
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
<div>
		<?php include("footer.inc.php"); ?>
	</div>
</body>
</html>
