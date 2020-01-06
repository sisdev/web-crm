<?php
	error_reporting(1);
	ob_start();
	session_start();
	include 'include/dbi.php';
	include 'include/session.php';
	include 'include/param.php';
	checksession();
	$count_qry=mysqli_query($conn, "SELECT COUNT(username) as count FROM `tbl_staff` where status='active'");
	$total_active=mysqli_fetch_array($count_qry);
	$total_active_users=$total_active['count'];
	//echo $total_active_users."<br>".$license_user;
	$i=1;
	$base_qry="select * FROM tbl_staff where 1=1 ORDER BY dtm_created DESC";	
	if ($debug) echo $base_qry ;
	$result = mysqli_query($conn,$base_qry) ;
	$err=mysqli_error($conn);
	echo $err;
	if($result)
	{
?>
<html>
	<head>
	<title>Manage Sales-Resource</title>
	<link rel="icon" type="image/png" href="images/icon.png" />
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" type="text/css" rel="stylesheet">
<meta http-equiv="Content-Type" content="text/html;"/>

<script>
$(document).ready(function(){
var current_count = "<?php echo $total_active_users; ?>";
var license_user = "<?php echo $license_user; ?>";
//alert("User Count:"+ current_count+":"+license_user);
if(parseInt(current_count) >= parseInt(license_user)){
	alert("Active users more than License Users") ;
	$("#add_resource_btn").css("display", "none");
	$("#alert").css("display", "block");
}
});
</script>

<style>
table{
	
	width:100%;
	table-layout:fixed;
}
tbody{
	word-wrap: break-word;
}
  tbody:nth-of-type(odd) {
 background: #99d6ff ;
}
th {
 background: #ffb3b3 ;
 font-weight: bold;
}

@media only screen and (max-width: 800px) {
        /* Force table to not be like tables anymore */
        #no-more-tables table,
        #no-more-tables thead,
        #no-more-tables tbody,
        #no-more-tables th,
        #no-more-tables td,
        #no-more-tables tr {
        display: block;
		
        }
         
        /* Hide table headers (but not display: none;, for accessibility) */
        #no-more-tables thead tr {
        position: absolute;
        top: -9999px;
        left: -9999px;
        }
         
        #no-more-tables tr { border: 1px solid #ccc; }
          
        #no-more-tables td {
        /* Behave like a "row" */
        border: none;
        border-bottom: 1px solid #eee;
        position: relative;
        padding-left: 50%;
        white-space: normal;
        text-align:left;
        }
         
        #no-more-tables td:before {
        /* Now like a table header */
        position: absolute;
        /* Top/left values mimic padding */
        top: 6px;
        left: 2px;
		right: 2px;
        width: 55%;
        padding-right: 10px;
        white-space: nowrap;
        text-align:left;
        font-weight: bold;
        }
         
        /*
        Label the data
        */
        #no-more-tables td:before { content: attr(data-title); }
        }
        .text_count{
        	font-size: 15px;
        	border-radius:0; 
        	background-color: #ffffff;
        	box-shadow: 0 4px 8px 0 rgba(0,0,0,0.5);
        }
</style>

</head>
	
	
	<body style="background-color:#ccf2ff">
	<div class="container col-md-12" >   	<!-- body -->
	<div>
		<?php include 'header.inc.php'; ?>
	</div>
	<div style="margin-top:80px;">
	<h2 class="text-primary text-center">Manage Sales-Resource</h2>
	<div style="margin-top: -10px;">
	<form action = "sales-resource-add.php" method="post" style="float:right;">
	<input type="submit" class="btn btn-success" id="add_resource_btn" role="button" value="Add Sales-Resource" style="border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);"/>
	</form>
	<div class="alert alert-danger alert-dismissible" id="alert" style="display:none; float:right;">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  	Already <?php echo $license_user; ?> <strong>ACTIVE</strong> users!
	</div>
</div> 
</div>
	<div id="no-more-tables">
	<table class="table table-bordered table-stripped table-bordered  table-condensed" style="text-align:center; margin-bottom:80px; ">
	<thead>
		<th style='color:#b30059; text-align:center;'>#</th>
		<th style='color:#b30059; text-align:center;'>Username</th>
		<th style='color:#b30059; text-align:center;'>Password</th>		
		<th style='color:#b30059; text-align:center;'>Name</th>
		<th style='color:#b30059; text-align:center;'>Phone</th>
		<th style='color:#b30059; text-align:center;'>Email_Id</th>
		<th style='color:#b30059; text-align:center;'>DateTime</th>
		<th style='color:#b30059; text-align:center;'>Role</th>
		<th style='color:#b30059; text-align:center;'>Status</th>
		<th style='color:#b30059; text-align:center;'>Created By</th>
		<th style='color:#b30059; text-align:center;'>Update Sales-Resource</th>
	</thead>

	<?php
			  while($row = mysqli_fetch_array($result))
			   {
	 ?>	
				<tbody>
				<tr>
					<td data-title="#"><?php echo $i;?></td>
					<td data-title="User Name"><?php echo $row['username'] ;?></td>
					<td data-title="Password"><?php echo $row['password'] ;?></td>
					<td data-title="Name"><?php echo $row['name'] ; ?></td>
					<td data-title="Phone"><?php echo $row['phone_no'] ;?></td>
					<td data-title="Email_Id"><?php echo $row['email'] ;?></td>
					<td data-title="DateTime"><?php echo $row['dtm_created'] ; ?></td>
					<td data-title="Role"><?php echo $row['role'] ;?></td>
					<td data-title="Status"><?php echo $row['status'] ;?></td>
					<td data-title="Created By"><?php echo $row['created_by'] ; ?></td>

					<td data-title="Update Resource">
						<form action = "sales-resource-update.php" method="GET" >
							<input type = "hidden" name ="update_id" value ="<?php echo $row['id']; ?>"/>
							 <input type="submit" class="btn btn-warning" value="Update" style="border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);"/>
						</form>
					</td>
				</tr>
				</tbody>
	<?php		

	$i++;	
		}
	} 
	echo "<span class='text_count'>Licensed User : "."<strong>".$license_user."</strong></span>";	
	echo "&nbsp; &nbsp; &nbsp; <span class='text_count'>Active User : "."<strong>".$total_active_users."</strong></span>";	  
	?>
	</table>
	</div>
<div style="position:absolute; bottom:0; width:100%; left:0; right:0;">
		<?php include("footer.inc.php"); ?>
	</div>	
</div>

	</body>
</html>