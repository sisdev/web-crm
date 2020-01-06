<?php
	error_reporting(1);
	ob_start();
	session_start();
	include 'include/dbi.php';
	include 'include/session.php';
	checksession();
	$uName=$_SESSION['login'];
	$curr_date=getLocalDtm();
	$target_qry="select * FROM sales_target where created_by='$uName'";	
	//echo $target_qry ;
	$result_target = mysqli_query($conn,$target_qry) ;
	
	
?>
<html>
	<head>
	<title>Sales Target Status</title>
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
	<div class="container col-md-12" >  
	<div>
		<?php include 'header.inc.php'; ?>
	</div>
	 <div class="row" style="margin-top:80px;">
<div class="col-sm-2">
   <ul class="pager">
   <li class='previous'><a href='sales-target-manage.php' style='border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);'>❮ Back</a></li>
   </ul>  
</div>

<div class="col-sm-8">
	<h2 class="text-primary text-center"> Sales-Target Status</h2>
</div> 
	</div>

	<h4>Target</h4>
	<div id="no-more-tables">
	<table class="table table-bordered table-stripped table-bordered  table-condensed" style="text-align:center; ">
	<thead>
		<th style='color:#b30059; text-align:center;'>Financial Year </th>	
		<th style='color:#b30059; text-align:center;'>Sales Executive</th>
		<th style='color:#b30059; text-align:center;'>Area Product</th>
		<th style='color:#b30059; text-align:center;'>Area Geo Name</th>
		<th style='color:#b30059; text-align:center;'>Area Geo Unit</th>
		<th style='color:#b30059; text-align:center;'>Target Amount</th>
		<th style='color:#b30059; text-align:center;'>Target New Cust</th>
		<th style='color:#b30059; text-align:center;'>Target New Lead</th>
		<th style='color:#b30059; text-align:center;'>Date Created</th>
	</thead>

	<?php
			  while($row = mysqli_fetch_array($result_target))
			   {
			   	$tid=$row['id'];
	 ?>	
				<tbody>
				<tr>
					<td data-title="Financial Year"><?php echo $row['fin_year'] ;?></td>
					<td data-title="Sales Executive">
					<?php $user_id=$row['user_id'];
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
				</tr>
				</tbody>
	<?php		

	$t_amt=$row['target_amt'] ;
	$t_cust=$row['target_new_cust'] ;
	$t_lead=$row['target_new_lead'] ;
	$targ_date=SUBSTR($row['dtm_created'],0,10);
	}	
		  
	?>
	</table>
	</div>

	<h4>Achieved</h4>
	<div id="no-more-tables">
	<table class="table table-bordered table-stripped table-bordered  table-condensed" style="text-align:center;">
	<thead>
		<th style='color:#b30059; text-align:center;'>-</th>		
		<th style='color:#b30059; text-align:center;'>-</th>		
		<th style='color:#b30059; text-align:center;'>-</th>		
		<th style='color:#b30059; text-align:center;'>-</th>		
		<th style='color:#b30059; text-align:center;'>-</th>
		<th style='color:#b30059; text-align:center;'>Amount</th>
		<th style='color:#b30059; text-align:center;'>Achieved Customer</th>
		<th style='color:#b30059; text-align:center;'>Achieved Lead</th>
		<th style='color:#b30059; text-align:center;'>-</th>
	</thead>

	<?php
	$input_qry1="SELECT SUM(course_fee) AS amount FROM `trng_enroll` where created_by='$uName'";	
	$input_qry2="SELECT COUNT(id) AS input_cust FROM `user_profile` where created_by='$uName' AND update_dtm BETWEEN '$targ_date' AND '$curr_date'"; 
	$input_qry3="SELECT COUNT(id) AS input_lead FROM `trng_query_log` where created_by='$uName' AND req_dtm BETWEEN '$targ_date' AND '$curr_date'";
	//echo $input_qry ;
	$result_input1 = mysqli_query($conn,$input_qry1) ;
		$row1 = mysqli_fetch_array($result_input1);

		$result_input2 = mysqli_query($conn,$input_qry2) ;
		$row2 = mysqli_fetch_array($result_input2);

		$result_input3 = mysqli_query($conn,$input_qry3) ;
		$row3 = mysqli_fetch_array($result_input3);
			   
	 ?>	
				<tbody>
				<tr>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<td data-title="Amount"><?php echo $row1['amount'] ; ?></td>
					<td data-title="Input Customer"><?php echo $row2['input_cust'] ;?></td>
					<td data-title="Input Lead"><?php echo $row3['input_lead'] ; ?></td>
					<td>-</td>
				</tr>
				</tbody>
	<?php		

$i_amt=$row1['amount'] ;
$i_cust=$row2['input_cust'] ;
$i_lead=$row3['input_lead'] ;

			   

			   $amt_avg=number_format($i_amt/$t_amt*100,2);
			   $cust_avg=number_format($i_cust/$t_cust*100,2);
			   $lead_avg=number_format($i_lead/$t_lead*100,2);
			  
	?>
	</table>
	</div>
	<div class="row">
	<div class="col-sm-2">
	<h4>Current Status</h4>
	</div>
	<div style="margin-top:8px;">
	<div class="col-sm-2" style="width:150px;">
	Bellow 50% :<span style="background:#ed1035;">&nbsp; &nbsp; &nbsp; &nbsp;</span>
	</div>

	<div class="col-sm-2" style="width:150px;">
	50-80% :<span style="background:#f7f31d;">&nbsp; &nbsp; &nbsp; &nbsp;</span>
	</div>

	<div class="col-sm-2" style="width:150px; margin-left:-20px;">
	Above 80% :<span style="background:#30b707;">&nbsp; &nbsp; &nbsp; &nbsp;</span>
	</div>
</div>
	</div>
	<table class="table table-bordered table-stripped table-bordered  table-condensed" style="text-align:center; margin-bottom:128px;">
	
				<tbody>
				<tr>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<?php if($amt_avg<=50){
						echo "<td style='background:#f25970;'><b>".$amt_avg."%"."</b></td>"; }
						else if($amt_avg>50 && $amt_avg<=80){
						echo "<td style='background:#f4f284;'><b>".$amt_avg."%"."</b></td>";
						}
						else{
						echo "<td style='background:#30b707;'><b>".$amt_avg."%"."</b></td>";
						}
						?>
					<?php if($cust_avg<=50){
						echo "<td style='background:#f25970;'><b>".$cust_avg."%"."</b></td>"; }
						else if($cust_avg>50 && $cust_avg<=80){
						echo "<td style='background:#f4f284;'><b>".$cust_avg."%"."</b></td>";
						}
						else{
						echo "<td style='background:#30b707;'><b>".$cust_avg."%"."</b></td>";
						}
						?>
					<?php if($lead_avg<=50){
						echo "<td style='background:#f25970;'><b>".$lead_avg."%"."</b></td>"; }
						else if($lead_avg>50 && $lead_avg<=80){
						echo "<td style='background:#f4f284;'><b>".$lead_avg."%"."</b></td>";
						}
						else{
						echo "<td style='background:#30b707;'><b>".$lead_avg."%"."</b></td>";
						}
						?>
					<td>-</td>
				</tr>
				</tbody>
	</table>

<div style="position:absolute; bottom:0; width:100%; left:0; right:0;">
		<?php include("footer.inc.php"); ?>
	</div>	
</div>

	</body>
</html>