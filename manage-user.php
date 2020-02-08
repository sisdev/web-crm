<?php
	error_reporting(1);
	ob_start();
	session_start();
	include 'include/dbi.php';
	include 'include/session.php';
    include 'include/param.php';
	checksession();
	
	$i=1;
	$debug = true ; //true or false 
	$name=$_POST['name'];
	$email=$_POST['email'];
	$phone=$_POST['phone'];
	$add = $_POST['add'];
	$base_qry="select * FROM user_profile where 1=1 ";		
	if(isset($_POST['name']) && $_POST['name']!= NULL ){
		$base_qry=$base_qry." and name LIKE '".$name."%'" ;	
	}
	if(isset($_POST['email']) && $_POST['email']!= NULL){
		$base_qry=$base_qry." and email LIKE '".$email."%'";
	}
	if(isset($_POST['phone']) && $_POST['phone']!= NULL){
		$base_qry=$base_qry." and phone_main LIKE '".$phone."%'";
	}
	if(isset($_POST['add']) && $_POST['add']!= NULL){
		$base_qry=$base_qry." and cur_add LIKE '%".$add."%'";
	}
	
	$base_qry=$base_qry. " ORDER BY update_dtm DESC";	
	//if ($debug) echo $base_qry ;
	$result = mysqli_query($conn,$base_qry) ;
	if($result)
	{
?>
<html>
	<head>
	<title>Manage Customer</title>
	<link rel="icon" type="image/png" href="images/icon.png" />
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" type="text/css" rel="stylesheet">
<meta http-equiv="Content-Type" content="text/html;"/>

<script LANGUAGE="JavaScript">

function confirmDelete(delete_id) {
var msg;
msg= "Are you sure you want to delete the data ? " ;
var agree=confirm(msg);
if (agree)
return true ;
else
return false ;
}
</script>

<style>
table{
	word-wrap: break-word;
	width:100%;
	table-layout:fixed;
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
	<div class="container col-md-12" >   	<!-- body -->
	<div>
		<?php include 'header.inc.php'; ?>
	</div>
	 <div style="margin-top:102px;">
  <h2 class="text-primary text-center">Manage Customer</h2>
</div> 
	
	<table class="table table-bordered" style="text-align:center; margin-bottom:80px;">
	<thead>
		<th style='color:#b30059; text-align:center;'>#</th>
		<th style='color:#b30059; text-align:center;'>Cust_Type</th>
		<th style='color:#b30059; text-align:center;'>Customer Id</th>
		<th style='color:#b30059; text-align:center;'>Name</th>
		<th style='color:#b30059; text-align:center;'>Email ID </th>		
		<th style='color:#b30059; text-align:center;'>Phone</th>
		<th style='color:#b30059; text-align:center;'>Address</th>
		<th style='color:#b30059; text-align:center;'>Company</th>
		<th style='color:#b30059; text-align:center;'>Seg/ Subseg</th>
		<th style='color:#b30059; text-align:center;'>Date</th>
		<th style='color:#b30059; text-align:center;'> User</th>
		
		<th style='color:#b30059; text-align:center;'>Deal</th>
		<?php 
	                        	
		                          if ($tally_interface == "Y"){
							?>
		<th style='color:#b30059; text-align:center;'>Tally Ledger</th>
		<?php 
								  }
		?>
	</thead>

	<?php
			  while($row = mysqli_fetch_array($result))
			   {
	 ?>	
				<tbody>
				<tr>
					<td><?php echo $i ; ?></td>
					<td><?php echo $row['cust_type'] ; ?></td>
					<td><?php echo $row['id'] ; ?></td>
					<td><?php echo $row['name'] ;?></td>
					<td><?php echo $row['email'] ;?></td>
					<td><?php echo $row['phone_main'] ; ?></td>
					<td><?php echo $row['cur_add'] ;?></td>
					<td><?php echo $row['comp_name'] ; ?></td>
					<td><?php echo $row['indus_seg']."<br>".$row['indus_subseg'] ; ?></td>
					<td><?php echo $row['update_dtm'] ; ?></td>

					<td>
						<form action = "user-view-record.php" method="GET">
							<input type = "hidden" name ="view_id" value ="<?php echo $row['id']; ?>"/>
							<input type="submit" class="btn btn-info" role="button" value="View" style="border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);"/>
						</form>
						<form action = "user-record-update.php" method="GET" >
							<input type = "hidden" name ="update_id" value ="<?php echo $row['id']; ?>"/>
							 <input type="submit" class="btn btn-primary" value="Update" style="border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);"/>
						</form>
					</td>
				
					<td>
						<form action = "add-registration.php" method="GET" >
							<input type = "hidden" name ="add_id" value ="<?php echo $row['id']; ?>"/>
							 <input type="submit" class="btn btn-warning" value="Add" style="border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);"/>
						</form>
					</td>
					
					
						
							<?php 
	                        	
		                          if ($tally_interface == "Y"){
							?>
					        <td>
							<form action = "tally-ledger.php" method="GET" >
							<input type = "hidden" name ="add_gst" value ="<?php echo $row['id']; ?>"/>
							<input type="submit" class="btn btn-warning" value="Export" style="border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);"/>
							</form>
							</td>
							<?php
	                               	}
	                            	
		
							
								?>
						
					
					
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