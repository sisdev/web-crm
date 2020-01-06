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
<title>Trainer Information</title>

<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  


<body style="background-color:#ccf2ff">
<div class ="container col-md-12" >   
	<div>
		<?php include 'header.inc.php'; ?>
	</div>
<div class="row">
	<div class="col-md-2">
	<ul class="pager">
	<li class="previous"><a href="manage_msg.php"><< Back</a></li>
	</ul>
	</div>
  <div class="col-md-8">
  <h2 class="text-primary text-center">Add Trainer Details</h2><br>
</div>      
</div>
<form class="form-horizontal" style="margin-left:30%;" method="POST">
<div class="form-group row">
  <label class="control-label col-md-2"  for="code">Msg_Code<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="code"  placeholder="" required=required class="form-control input-md" type="text">
  </div>
</div>


<div class="form-group row">
  <label class="col-md-2 control-label" for="msg">Message<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<textarea id="msg" name="msg" required=required class="form-control input-md" cols="15" rows="5"></textarea>
  </div>
</div>


<div class="form-group" style="margin-left:18%;">
  <label class=" control-label" for="upload"></label>
  <div>
    <input type="submit" name="upload" class="btn btn-info" value="Add" style="padding:10px 3%;"/>
    <input type="reset"  name="Reset" class="btn" value="Reset" style="padding:10px 3%;"/>
	</div>
</div>
</form>
<?php
if (isset($_POST['upload'])) {
  
    $code = $_POST['code'];
    $msg = $_POST['msg'];
	$crtd_by=$_SESSION['login'];
	$dtm=date('Y-m-d\TH:i:s.u');
    $eventsql = "INSERT INTO
                  msg_template(msg_code,msg_txt,created_by,create_dtm)
                   VALUES('$code','$msg','$crtd_by','$dtm')";
	
	echo $eventsql ;
       if( mysqli_query($conn,$eventsql))
	   {
        header("location:manage_msg.php?msg= Message Added Successfully..");
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
	<div style="margin-top:238px;">
		<?php include("footer.inc.php"); ?>
	</div>
</div>
</body>
</html>
