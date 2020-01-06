<?php
ob_start();
session_start();
include 'include/dbi.php';
include 'include/session.php';

checksession();
if(isset($_POST['update_id']))
{
	$id=$_POST['update_id'];
	$selectsql="select * from sms_template where id = '$id'";
	$rs = mysqli_query($conn,$selectsql);
	$rows=mysqli_fetch_array($rs);
}

 if(isset($_POST['update'])){
	 
$id= $_POST['id'];
$code = $_POST['code'];
$msg = $_POST['msg'];
date_default_timezone_set('Asia/Kolkata');
$dtm = date("Y/m/d H:i:s");
$ids = $_POST['tid'];

$sql="UPDATE sms_template set id ='$id',msg_code ='$code',msg_txt ='$msg',create_dtm = '$dtm' where  id = $ids";

echo $sql;

$result=mysqli_query($conn,$sql)or die("query failed".mysqli_error($conn));
header("location:sms-manage.php");
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
        <title>Message Update</title>
		<link rel="icon" type="image/png" href="images/icon.png" />
</head>
    
<body style="background-color:#ccf2ff">

<div class ="container-fluid">   	
	<div>
		<?php include 'header.inc.php'; ?>
	</div>
	
	<div style="margin-top:100px;">
	<h2 class="text-primary text-center">Update Message- Details</h2>
	</div> 
	
	<form class="form-horizontal" style="margin-left:20%;" action="sms-update.php" method="post" enctype="multipart/form-data">
	
	<div class="form-group row">
	<label class="control-label col-md-2" for="id">ID</label>  
	<div class="col-md-5">
	<input  name="id"  placeholder="" id="id" class="form-control input-md" type="text" value="<?php echo $rows['id']; ?>"/>
	</div>
	</div>
	
	<div class="form-group row">
	<label class="col-md-2 control-label" for="code">Msg_Code</label>  
	<div class="col-md-5">
	<input  name="code"  placeholder="" id="code" class="form-control input-md" type="text" value="<?php echo $rows['msg_code']; ?>"/>
         </div>
		  </div>


<div class="form-group row">
  <label class="col-md-2 control-label" for="msg">Message</label>  
  <div class="col-md-5">
	<textarea id="msg" name="msg" class="form-control input-md" cols="20" rows="10"><?php echo $rows['msg_txt']; ?></textarea>
  </div>
</div>

<div class="form-group row">
  <label class="col-md-2 control-label" for="dtm">Day&amp;Time</label>  
  <div class="col-md-5">
	<input id="dtm" name="dtm" class="form-control input-md" type="text" value="<?php echo $rows['create_dtm']; ?>"/>
  </div>
</div>
 

<div class="form-group" style="margin-left:25%;">
  <label class=" control-label" for="update"></label>
  <div>
    <input type="text"  hidden  name="tid"   value="<?php echo $rows['id']; ?>"/>
	<input type="submit" class="btn btn-warning" name="update"  style="padding:10px 3%;" value="Update"/>
	<input type="reset"  name="Reset" class="btn" value="Cancel" onClick="location.href = 'sms-manage.php';" style="padding:10px 3%;"/>
	</div>
</div>
</form>
		
</div>
		<div style="position:relative; bottom:0; width:100%; margin-top:114px;">
		<?php include("footer.inc.php"); ?>
		</div>
    </body>
</html>
