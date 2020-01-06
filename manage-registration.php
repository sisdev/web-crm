<?php
	error_reporting(1);
	ob_start();
	session_start();
	include 'include/dbi.php';
	include 'include/session.php';
	checksession();
	
	$i=1;
	$base_qry="select * FROM deal_log where 1=1 ORDER BY enroll_dtm DESC";		
	//if ($debug) echo $base_qry ;
	$result = mysqli_query($conn,$base_qry) ;
	if($result)
	{
?>
<html>
	<head>
	<title>Manage Sales Deal</title>
	<link rel="icon" type="image/png" href="images/icon.png" />
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" type="text/css" rel="stylesheet">
<meta http-equiv="Content-Type" content="text/html;"/>

<style>
table{
	table-layout:fixed;
}
tbody
{
	word-wrap: break-word;
}
  tbody:nth-of-type(odd) {
 background: #99d6ff ;
}
th {
 background: #ffb3b3 ;
 font-weight: bold;
}
</style>
</head>
		
	<body style="background-color:#ccf2ff">
	<div class="container col-md-12">
	<div>
		<?php include 'header.inc.php'; ?>
	</div>
	 <div style="margin-top:90px;">
	<h2 class="text-primary text-center">Manage Sales DEALs</h2>
	</div> 
	
	<table class="table table-bordered" style="text-align:center; margin-bottom:80px;">
	<thead>
		<th style='color:#b30059; text-align:center;'>#</th>
		<th style='color:#b30059; text-align:center;'>Date</th>
		<th style='color:#b30059; text-align:center;'>Registration ID </th>		
		<th style='color:#b30059; text-align:center;'>User Profile Id</th>
		<th style='color:#b30059; text-align:center;'>Email</th>
		<th style='color:#b30059; text-align:center;'>Batch Id</th>
		<th style='color:#b30059; text-align:center;'>Course-Product</th>
		<th style='color:#b30059; text-align:center;'>Fee/Price</th>
		<th style='color:#b30059; text-align:center;'>Payment Status</th>
		<th style='color:#b30059; text-align:center;'>Created By</th>
		<th style='color:#b30059; text-align:center;'>Update</th>
	</thead>

	<?php
			  while($row = mysqli_fetch_array($result))
			   {
	 ?>	
				<tbody>
				<tr>
					<td><?php echo $i;?></td>
					<td><?php echo SUBSTR($row['enroll_dtm'],0,10);?></td>
					<td><?php echo $row['reg_id'];?></td>
					<td><?php echo $row['user_profile_id'];?></td>
					<td><?php echo $row['user_name'];?></td>
					<td><?php echo $row['batch_id'];?></td>
					<td><?php echo $row['course_name'];?></td>
					<td><?php echo $row['course_fee'];?></td>
					<td><?php echo $row['payment_status'];?></td>
					<td><?php echo $row['created_by'];?></td>

					<td>
						<form action="registration-record-update.php" method="GET">
							<input type = "hidden" name ="update_id" value ="<?php echo $row['enroll_id']; ?>"/>
							 <input type="submit" class="btn btn-primary" value="Update" style="border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);"/>
						</form>
					</td>
				</tr>
				</tbody>
	<?php		
	$i++;	
				}
	}	 	  
	?>
	</table>
	<div style="position:absolute; bottom:0; width:100%; left:0; right:0;">
		<?php include("footer.inc.php"); ?>
	</div>	
</div>
	</body>
</html>