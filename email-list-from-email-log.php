<?php
ob_start();
session_start();
include 'include/dbi.php';
include 'include/session.php';
checksession();
if(isset($_GET['req_batch_num']))
{
	$req=$_GET['req_batch_num'];
	$rs = mysqli_query($conn,"SELECT to_email FROM email_log WHERE req_batch_num='$req'") or die("Error!");
	$i=1;
}
?>
<html>
<head>
<title>Mail List From Email-Log</title>
<link rel="icon" type="image/png" href="images/icon.png" />
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html;"/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
<style>
  tr:nth-of-type(odd) {
 background: #99d6ff ;
}
th {
 background: #ffb3b3 ;
 font-weight: bold;
}
</style>
</head>
    
<body style="background-color:#ccf2ff">
<div class ="container">
<div>
	<?php include 'header.inc.php'; ?>
</div>

<div class="row" style="margin-top:80px;">
<ul class="pager col-md-2">
<li class="previous"><a href="javascript:history.go(-1)" style="border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);"><< Back</a></li>
</ul>
<h3 class="text-primary col-md-8" align="center" style="margin-top:22px;">Email List</h3>
</div> 

<div class="col-md-3" style="margin-left:45px;"></div>
<div class="col-md-5">
<table class="table table-bordered">
    <thead>
      <tr>
	   <th style='color:#b30059; '>#</th>
       <th style='color:#b30059; '>Email Id</th>
      </tr>
    </thead>
	<tbody>
		<?php
            while($qfetch = mysqli_fetch_array($rs)) {  ?>
         <tr>
			 <td><?php echo $i;?></td>
            <td><?php echo $qfetch["to_email"];?></td>
		 </tr>
<?php 
$i++;
} ?>										                          
</table>
</div>
</div>
		<div style="position:absolute; width:100%; left:0; right:0;">
		<?php include("footer.inc.php"); ?>
		</div>
    </body>
</html>