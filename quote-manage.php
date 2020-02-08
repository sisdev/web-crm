<?php
	error_reporting(1);
	ob_start();
	session_start();
	include 'include/dbi.php';
	include 'include/session.php';
    include 'include/param.php';
	checksession();

	
	$i=1;
	
    //$base_qry="select * FROM lead_quote";	
    $base_qry="SELECT product_item.prod_name, lead_quote.id,lead_quote.lead_id, lead_quote.description, lead_quote.qty, lead_quote.std_rate, lead_quote.discount, lead_quote.final_rate, lead_quote.amount ,lead_quote.hsn_code,lead_quote.gst_per, lead_quote.gst_amt from product_item JOIN lead_quote ON product_item.id=lead_quote.product_name order by lead_quote.lead_id";
	//if ($debug) echo $base_qry ;
	$result = mysqli_query($conn,$base_qry) ;
	if($result)
	{

?>








<html>
	<head>
	<title>Manage Quotations</title>
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
	
	<!-- body -->
	<body style="background-color:#ccf2ff">
	<div class="container col-md-12" >   	
	<div>
		<?php include 'header.inc.php'; ?>
	</div>
	<div style="margin-top:102px;">
	<h2 class="text-primary text-center">Manage quote</h2>
	
</div> 
	<div id="no-more-tables">
	<table class="table table-bordered table-stripped table-bordered  table-condensed" style="text-align:center; margin-bottom:80px; margin-top:50px;">
	<thead>
		<th style='color:#b30059; text-align:center;'>#</th>
		<th style='color:#b30059; text-align:center;'>Lead Id</th>
		<th style='color:#b30059; text-align:center;'>Id</th>
		
		<th style='color:#b30059; text-align:center;'>Product Name</th>
		<th style='color:#b30059; text-align:center;'>Description</th>
		<th style='color:#b30059; text-align:center;'>Quantity</th>
		<th style='color:#b30059; text-align:center;'>Hsn code</th>
		<th style='color:#b30059; text-align:center;'>Std Rate</th>
		<th style='color:#b30059; text-align:center;'>Discount</th>
		<th style='color:#b30059; text-align:center;'>Final Rate</th>
		<th style='color:#b30059; text-align:center;'>Amount</th>
		<th style='color:#b30059; text-align:center;'>GST Pct</th>
		<th style='color:#b30059; text-align:center;'>GST Amount</th>
		<th style='color:#b30059; text-align:center;'>View Quote</th>
		
	</thead>

	<?php
				$prev_lead_id = 0 ;
			  while($row = mysqli_fetch_array($result))
			   {
				  $curr_lead_id = $row['lead_id'] ;
				  
	 ?>	
				<tbody>
				<tr>
					<td data-title="#"><?php echo $i;?></td>
					<?php
				     if ($curr_lead_id != $prev_lead_id)
					 {
						 echo '<td data-title="Lead Id">'.$curr_lead_id.'</td>' ;
						 $prev_lead_id = $curr_lead_id ;
					 }
				  	else
					{
						 echo '<td data-title="Lead Id">'.''.'</td>' ; 
					}
					?>
					<td data-title="id"><?php echo $row['id'] ;?></td>
					
					<td data-title="Product Name"><?php echo $row['prod_name'];?></td>
					<td data-title="Description"><?php echo $row['description'] ;?></td>
					<td data-title="Quantity"><?php echo $row['qty'] ;?></td>
					<td data-title="Hsn code"><?php echo $row['hsn_code'] ;?></td>
					<td data-title="Std Rate"><?php echo $row['std_rate'] ;?></td>
					<td data-title="Discount"><?php echo $row['discount'] ;?></td>
					<td data-title="Final Rate"><?php echo $row['final_rate'] ; ?></td>
					<td data-title="Amount"><?php echo $row['amount'] ;?></td>
					<td data-title="GST Per"><?php echo $row['gst_per'] ;?></td>
					<td data-title="GST mount"><?php echo $row['gst_amt'] ;?></td>

					

					<td data-title="View Quote">
						<form action = "print-quote.php" method="GET" >
							<input type = "hidden" name ="gst" value ="<?php echo $row['gst_per']; ?>"/>
							<input type = "hidden" name ="view_id" value ="<?php echo $row['lead_id']; ?>"/>
							 <input type="submit" class="btn btn-primary" value="View" style="border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);"/>
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