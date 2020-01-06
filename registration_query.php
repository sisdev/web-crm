<?php
	error_reporting(1);
	ob_start();
	session_start();
	include 'include/dbi.php';
	include 'include/session.php';
	checksession();
	$i=1;
	$debug = true ; //true or false 
	$name=$_POST['name'];
	$email=$_POST['email'];
	$reg_year = $_POST['reg_year'];
    $product =$_POST['product'];
	$base_qry="select * FROM user_profile left join deal_log on user_profile.email = deal_log.user_name where 1=1 ";		
	if(isset($_POST['name']) && $_POST['name']!= NULL ){
		$base_qry=$base_qry." and name LIKE '%".$name."%'" ;	
	}
	if(isset($_POST['email']) && $_POST['email']!= NULL){
		$base_qry=$base_qry." and email LIKE '%".$email."%'";
	}
	if(isset($_POST['reg_year']) && $_POST['reg_year']!= NULL){
		$base_qry=$base_qry." and enroll_dtm LIKE '%".$reg_year."%'";
	}
    if(isset($_POST['product']) && $_POST['product']!= NULL ){
		$base_qry=$base_qry." and course_name LIKE '%".$product."%'" ;	
	}
	
	$base_qry=$base_qry. " ORDER BY enroll_dtm DESC";	

	if ($debug) echo $base_qry ;

    $result = mysqli_query($conn,$base_qry) ;
	if($result)
	{
?>
<html>
	<head>
	 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" type="text/css" rel="stylesheet">
	<meta http-equiv="Content-Type" content="text/html;"/>
	
	<title>Manage Registration Queries</title>
	<link rel="icon" type="image/png" href="images/icon.png" />
	<style>
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
		<?php  include 'header.inc.php'; ?>
	</div>
	 <div style="margin-top:100px;">
  <h2 class="text-primary text-center">Registration Query Records</h2>
</div> 
	
	<table class="table table-bordered" style="text-align:center; margin-bottom:80px;">
	<thead>
		<th style='color:#b30059; text-align:center;'>#</th>
		<th style='color:#b30059; text-align:center;'>Registration ID</th>
		<th style='color:#b30059; text-align:center;'>Name</th>
		<th style='color:#b30059; text-align:center;'>Email ID </th>		
		<th style='color:#b30059; text-align:center;'>Enroll Date </th>
		<th style='color:#b30059; text-align:center;'>Product</th>
		<th style='color:#b30059; text-align:center;'>Product price</th>
		<th style='color:#b30059; text-align:center;'>Payment Status</th>
		<th style='color:#b30059; text-align:center;'>Batch ID </th>
		<th style='color:#b30059; text-align:center;'>View Profile</th>
		<th style='color:#b30059; text-align:center;'>Update Profile</th>
	</thead>

	<tfoot>
		<th style='color:#b30059; text-align:center;'>#</th>
		<th style='color:#b30059; text-align:center;'>Registration ID</th>
		<th style='color:#b30059; text-align:center;'>Name</th>
		<th style='color:#b30059; text-align:center;'>Email ID </th>		
		<th style='color:#b30059; text-align:center;'>Enroll Date </th>
		<th style='color:#b30059; text-align:center;'>Product</th>
		<th style='color:#b30059; text-align:center;'>Product price</th>
		<th style='color:#b30059; text-align:center;'>Payment Status</th>
		<th style='color:#b30059; text-align:center;'>Batch ID </th>
		<th style='color:#b30059; text-align:center;'>View Profile</th>
		<th style='color:#b30059; text-align:center;'>Update Profile</th>
	</tfoot>
	<?php
			  while($row = mysqli_fetch_array($result))
			   {
	 ?>	
				<tbody>
				<tr>
					<td><?php echo $i ; ?></td>
					<td><?php echo $row['reg_id'] ;?></td>
					<td><?php echo $row['name'] ;?></td>
					<td><?php echo $row['email'] ;?></td>
					<td><?php echo substr($row['enroll_dtm'],0,10) ; ?></td>
					<td><?php echo $row['course_name'] ;?></td>
					<td><?php echo $row['course_fee'] ;?></td>
					<td><?php echo $row['payment_status'] ; ?></td>
					<td><?php echo $row['batch_id'] ; ?></td>

					<td>
						<form action = "registration_view_record.php" method="GET" >
							<input type = "hidden" name ="view_id" value ="<?php echo $row['id']; ?>"/>
							 <input type="submit" class="btn btn-primary" value="View"/>
						</form>
					</td>
					<td>
						<form action = "registration_profile_update.php" method="GET" >
							<input type = "hidden" name ="update_id" value ="<?php echo $row['id']; ?>"/>
							<input type="submit" name="profile_update" class="btn btn-warning" value="Update"/>
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