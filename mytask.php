<?php
	error_reporting(1);
	ob_start();
	session_start();
	include 'include/dbi.php';
	include 'include/session.php';
	checksession();
	
	$i=1;
	$uName = $_SESSION["login"];
	date_default_timezone_set('Asia/Kolkata');
	$date = date("Y-m-d");
	$base_qry="SELECT * FROM `mytasks` where (assigned_user='$uName' OR created_by='$uName') AND SUBSTR(datetime,1,10)<='$date' AND status='New' ORDER BY dtm_created DESC";	
	//echo $base_qry ;
	$result = mysqli_query($conn,$base_qry) ;
	if($result)
	{
?>
<html>
	<head>
	<title>My Task</title>
	<link rel="icon" type="image/png" href="images/icon.png" />
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" type="text/css" rel="stylesheet">
<meta http-equiv="Content-Type" content="text/html;"/>

<style>
table{
	word-wrap: break-word;
	
	table-layout:fixed;
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
</style>
</head>
	
	
<body style="background-color:#ccf2ff">
	<div class="container col-md-12">
	<div>
		<?php include 'header.inc.php'; ?>
	</div>
	<div style="margin-top:102px;">
	<h2 class="text-primary text-center">My Tasks</h2>
	</div> 
	<div id="no-more-tables">
	<table class="table table-stripped table-bordered  table-condensed" style="text-align:center; margin-bottom:80px; margin-top:20px;">
	<thead>
		<th style='color:#b30059; text-align:center;'>#</th>
		<th style='color:#b30059; text-align:center;'>Lead Qry Id</th>
		<th style='color:#b30059; text-align:center;'>Lead Details</th>
		<th style='color:#b30059; text-align:center;'>Assigned User</th>
		<th style='color:#b30059; text-align:center;'>Task Date-Time</th>		
		<th style='color:#b30059; text-align:center;'>Task Type</th>
		<th style='color:#b30059; text-align:center;'>Narration</th>
		<th style='color:#b30059; text-align:center;'>Status</th>
		<th style='color:#b30059; text-align:center;'>Created By</th>
		<th style='color:#b30059; text-align:center;'>Update Task</th>
	</thead>

	<?php
			$_SESSION['viewLeadSrc'] ="myTasks" ;
			
			  while($row = mysqli_fetch_array($result))
			   {
				   $trng_id=$row['trng_query_id'];
				   $name_query=mysqli_query($conn, "SELECT name,phone_no, qry_details from lead_log where id='$trng_id'");
$r_name=mysqli_fetch_array($name_query);
$trng_name=$r_name['name'];
	 ?>	
				<tbody>
				<tr>
					<td data-title="#"><?php echo $i;?></td>
					<td data-title="Lead Qry Id"><a href="lead_view_record.php?view_id=<?php echo $trng_id ;?>"><?php echo $trng_id ;?></a></td>
					<td data-title="Lead Details"><?php echo $trng_name."<br>".$r_name['phone_no']."<br>".$r_name['qry_details']; ?></td>
					<td data-title="Assigned User"><?php echo $row['assigned_user'];?></td>
					<td data-title="Task Date-Time"><?php echo $row['datetime'];?></td>
					<td data-title="Task Type"><?php echo $row['task_type'];?></td>
					<td data-title="Narration"><?php echo $row['narration'];?></td>
					<td data-title="Status"><?php echo $row['status'];?></td>
					<td data-title="Created By"><?php echo $row['created_by'];?></td>

					<td data-title="Update Task">
						<form action = "mytask-update.php" method="GET" >
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
	
	  	  
	?>
	</table>
	</div>
<div style="position:absolute; bottom:0; width:100%; left:0; right:0;">
		<?php include("footer.inc.php"); ?>
	</div>	
</div>

	</body>
</html>