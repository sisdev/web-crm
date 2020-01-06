<?php
ob_start();
session_start();
include 'include/dbi.php';
include 'include/session.php';

checksession();
if(isset($_POST['update_id']))
{
	$id=$_POST['update_id'];
	$selectsql="select * from msg_template where id = '$id'";
	$rs = mysqli_query($conn,$selectsql);
	$rows=mysqli_fetch_array($rs);
}

 if(isset($_POST['update'])){
	 
$id= $_POST['id'];
$code = $_POST['code'];
$msg = $_POST['msg'];
$dtm = date('Y-m-d\TH:i:s.u');
$ids = $_POST['tid'];

$sql="UPDATE msg_template set id ='$id',msg_code ='$code',msg_txt ='$msg',create_dtm = '$dtm' where  id = $ids";

echo $sql;

$result=mysqli_query($conn,$sql)or die("query failed".mysqli_error($conn));
header("location:manage_msg.php");
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
</head>
    
<body style="background-color:#ccf2ff">

<div class ="container col-md-12">   	
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
	<h2 class="text-primary text-center">Update Message- Details</h2>
	</div> 
	</div>
	<form class="form-horizontal" style="margin-left:25%;" action="msg_update.php" method="post" enctype="multipart/form-data">
	
	<div class="form-group row">
	<label class="control-label col-md-2" for="id">ID</label>  
	<div class="col-md-4">
	<input  name="id"  placeholder="" id="id" class="form-control input-md" type="text" value="<?php echo $rows['id']; ?>"/>
	</div>
	</div>
	
	<div class="form-group row">
	<label class="col-md-2 control-label" for="code">Msg_Code</label>  
	<div class="col-md-4">
	<input  name="code"  placeholder="" id="code" class="form-control input-md" type="text" value="<?php echo $rows['msg_code']; ?>"/>
         </div>
		  </div>


<div class="form-group row">
  <label class="col-md-2 control-label" for="msg">Message</label>  
  <div class="col-md-4">
	<textarea id="msg" name="msg" class="form-control input-md" cols="20" rows="5"><?php echo $rows['msg_txt']; ?></textarea>
  </div>
</div>

<div class="form-group row">
  <label class="col-md-2 control-label" for="dtm">Day&amp;Time</label>  
  <div class="col-md-4">
	<input id="dtm" name="dtm" class="form-control input-md" type="text" value="<?php echo $rows['create_dtm']; ?>"/>
  </div>
</div>
 

<div class="form-group" style="margin-left:25%;">
  <label class=" control-label" for="update"></label>
  <div>
    <input type="text"  hidden  name="tid"   value="<?php echo $rows['id']; ?>"/>
	<input type="submit" class="btn btn-warning" name="update"  style="padding:10px 3%;" value="Update"/>
	</div>
</div>
</form>
		<div style="margin-top:130px;">
		<?php include("footer.inc.php"); ?>
		</div>
</div>
    </body>
</html>
