<?php
	error_reporting(1);
	ob_start();
	session_start();
	include 'include/dbi.php';
	include 'include/session.php';
	checksession();
	
	
	$i=1;
	$base_qry="select * FROM sales_target where 1=1 ORDER BY dtm_created DESC";	
	//if ($debug) echo $base_qry ;
	$result = mysqli_query($conn,$base_qry) ;
	if($result)
	{
?>
<html>
	<head>
	<title>Manage Target Sales</title>
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
</style>
</head>
	
	
	<body style="background-color:#ccf2ff">
	<div class="container col-md-12" >   	<!-- body -->
	<div>
		<?php include 'header.inc.php'; ?>
	</div>
	<div style="margin-top:100px;">
	<h2 class="text-primary text-center">Manage Target Sales</h2>
	</div> 
	<div id="no-more-tables">
	<table class="table table-bordered table-stripped table-bordered  table-condensed" style="text-align:center; margin-bottom:50px;">
	<thead>
		<th style='color:#b30059; text-align:center;'>#</th>
		<th style='color:#b30059; text-align:center;'>Financial Year </th>		
		<th style='color:#b30059; text-align:center;'>Sales Executive</th>
		<th style='color:#b30059; text-align:center;'>Area Product</th>
		<th style='color:#b30059; text-align:center;'>Area Geo Name</th>
		<th style='color:#b30059; text-align:center;'>Area Geo Unit</th>
		<th style='color:#b30059; text-align:center;'>Target Amount</th>
		<th style='color:#b30059; text-align:center;'>Target New Cust</th>
		<th style='color:#b30059; text-align:center;'>Target New Lead</th>
		<th style='color:#b30059; text-align:center;'>Date Created</th>
		<th style='color:#b30059; text-align:center;'>Update Target</th>
		<th style='color:#b30059; text-align:center;'>View Status</th>
	</thead>

	<?php
			  while($row = mysqli_fetch_array($result))
			   {
	 ?>	
				<tbody>
				<tr>
					<td data-title="#"><?php echo $i;?></td>
					<td data-title="Financial Year"><?php echo $row['fin_year'] ;?></td>
					<td data-title="Sales Executive"><?php 
					$user_id=$row['user_id'];
					$sales_exec_qry=mysqli_query($conn,"SELECT * from tbl_staff where id='$user_id'");
					$row1 = mysqli_fetch_array($sales_exec_qry);
					$username_for_userid=$row1['username'];
					echo $row1['username'] ;?>
						
					</td>
					<td data-title="Area Product"><?php echo $row['area_product'] ; ?></td>
					<td data-title="Area Geo Name"><?php echo $row['area_geoname'] ;?></td>
					<td data-title="Area Geo Unit"><?php echo $row['area_geo_unit'] ;?></td>
					<td data-title="Target Amount"><?php echo $row['target_amt'] ; ?></td>
					<td data-title="Target New Cust"><?php echo $row['target_new_cust'] ;?></td>
					<td data-title="Target New Lead"><?php echo $row['target_new_lead'] ; ?></td>
					<td data-title="Date"><?php echo $row['dtm_created'] ; ?></td>

					<td data-title="Update Target">
						<form action = "sales-target-update.php" method="GET" >
							<input type = "hidden" name ="update_id" value ="<?php echo $row['id']; ?>"/>
							 <input type="submit" class="btn btn-primary" value="Update" style="border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);"/>
						</form>
					</td>

					<td data-title="View Status">
					<form action = "sales-target-status.php" method="GET" >
						<input type = "hidden" name ="view_id" value ="<?php echo $row['id']; ?>"/>
						 <input type="submit" class="btn btn-warning" value="View" style="border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);"/>
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
<div style="position:fixed; bottom:0; width:100%; left:0; right:0;">
		<?php include("footer.inc.php"); ?>
	</div>	
</div>

	</body>
</html>