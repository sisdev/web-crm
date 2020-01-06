<?php
ob_start();
session_start();
include 'include/dbi.php';
include 'include/session.php';

checksession();
if(isset($_POST['update_id']))
{
	$id=$_POST['update_id'];
	$selectsql="select * from email_template where id = '$id'";
	$rs = mysqli_query($conn,$selectsql);
	$rows=mysqli_fetch_array($rs);
}

if(isset($_POST['update'])){
$code = $_POST['code'];
$subject = $_POST['subject'];
$msg = $_POST['msg'];
$e_sign=$_POST['e_sign'];
$dtm = date('Y-m-d\TH:i:s.u');
$ids = $_POST['tid'];

$sql="UPDATE email_template set email_temp_name ='$code', email_subject='$subject', email_sign='$e_sign', email_text ='$msg', dt_created = '$dtm' where  id = $ids";

echo $sql;

$result=mysqli_query($conn,$sql)or die("query failed".mysqli_error($conn));
header("location:mail-manage.php");
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
        <title>Mail Update</title>
		<link rel="icon" type="image/png" href="images/icon.png" />
</head>
    
<body style="background-color:#ccf2ff">

<div class ="container-fluid">   	
	<div>
		<?php include 'header.inc.php'; ?>
	</div>
	
	<div style="margin-top:95px;">
	<h2 class="text-primary text-center">Update Mail- Details</h2>
	</div> 
	
	<form class="form-horizontal" style="margin-left:20%;" action="mail-update.php" method="post" enctype="multipart/form-data">
	
	<div class="form-group row">
	<label class="col-md-2 control-label" for="code">Email_Code</label>  
	<div class="col-md-5">
	<input  name="code"  placeholder="" id="code" class="form-control input-md" type="text" value="<?php echo $rows['email_temp_name']; ?>"/>
    </div>
	</div>
	
	<div class="form-group row">
	<label class="col-md-2 control-label" for="subject">Subject</label>  
	<div class="col-md-5">
	<input  name="subject"  placeholder="" id="subject" class="form-control input-md" type="text" value="<?php echo $rows['email_subject']; ?>"/>
    </div>
	</div>

<div class="form-group row">
  <label class="col-md-2 control-label" for="msg">Message</label>  
  <div class="col-md-5">
	<textarea id="msg" name="msg" class="form-control input-md" cols="20" rows="7"><?php echo $rows['email_text']; ?></textarea>
  </div>
</div>

<div class="form-group row">
  <label class="col-md-2 control-label" for="e_sign">Email_Sign</label>  
  <div class="col-md-5">
	<textarea id="e_sign" name="e_sign" class="form-control input-md" cols="20" rows="7"><?php echo $rows['email_sign']; ?></textarea>
  </div>
</div>

<div class="form-group" style="margin-left:27%;">
  <label class=" control-label" for="update"></label>
  <div>
    <input type="text"  hidden  name="tid"   value="<?php echo $rows['id']; ?>"/>
	<input type="submit" class="btn btn-warning" name="update"  style="padding:10px 3%;" value="Update"/>
	<input type="reset"  name="Reset" class="btn" value="Cancel" onClick="location.href = 'mail-manage.php';" style="padding:10px 3%;"/>
	</div>
</div>
</form>
		
</div>
		<div style="position:relative; bottom:0; width:100%; margin-top:40px;">
		<?php include("footer.inc.php"); ?>
		</div>
    </body>
</html>
