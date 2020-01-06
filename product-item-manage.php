<?php
	error_reporting(1);
	ob_start();
	session_start();
	include 'include/dbi.php';
	include 'include/session.php';
	checksession();
	
	if(isset($_POST['delete_id']))
	{
	
	$id= $_POST['delete_id'];
    $query="DELETE FROM product_item WHERE id ='$id'";
	mysqli_query($conn,$query);
	header("location:product-item-manage.php");
	exit;
	}
	$i=1;
	
	$base_qry="select * FROM product_item where 1=1 ORDER BY dtm DESC";	
	//if ($debug) echo $base_qry ;
	$result = mysqli_query($conn,$base_qry) ;
	if($result)
	{
?>
<html>
	<head>
	<title>Manage Product Item</title>
	<link rel="icon" type="image/png" href="images/icon.png" />
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
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
	<div style="margin-top:102px;">
	<h2 class="text-primary text-center">Manage Product Items</h2>
	<form action = "product-item-add.php" method="post" style="float:right;">
	<input type="submit" class="btn btn-success" role="button" value="Add Product Item" style="border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);"/>
	</form>
</div> 
	<div id="no-more-tables">
	<table class="table table-bordered table-stripped table-bordered  table-condensed" style="text-align:center; margin-bottom:80px; margin-top:50px;">
	<thead>
		<th style='color:#b30059; text-align:center;'>#</th>
		<th style='color:#b30059; text-align:center;'>Product Name</th>
		<th style='color:#b30059; text-align:center;'>Available Quantity </th>		
		<th style='color:#b30059; text-align:center;'>Unit of Measurement</th>
		<th style='color:#b30059; text-align:center;'>Cost Price</th>
		<th style='color:#b30059; text-align:center;'>Sell Price</th>
		<th style='color:#b30059; text-align:center;'>Category</th>
		<th style='color:#b30059; text-align:center;'>Group Id</th>
		<th style='color:#b30059; text-align:center;'>Date</th>
		<th style='color:#b30059; text-align:center;'>Created By</th>
		<th style='color:#b30059; text-align:center;'>Update Item</th>
		<th style='color:#b30059; text-align:center;'>Delete Item</th>
	</thead>

	<?php
			  while($row = mysqli_fetch_array($result))
			   {
	 ?>	
				<tbody>
				<tr>
					<td data-title="#"><?php echo $i;?></td>
					<td data-title="Product Name"><?php echo $row['prod_name'] ;?></td>
					<td data-title="Product Quantity"><?php echo $row['prod_qty'] ;?></td>
					<td data-title="Measurement"><?php echo $row['unit_of_meas'] ; ?></td>
					<td data-title="Cost Price"><?php echo $row['cost_price'] ;?></td>
					<td data-title="Sell Price"><?php echo $row['sell_price'] ;?></td>
					<td data-title="Category"><?php echo $row['category'] ; ?></td>
					<td data-title="Parent Id"><?php echo $row['grp_id'] ;?></td>
					<td data-title="Date"><?php echo $row['dtm'] ; ?></td>
					<td data-title="Created By"><?php echo $row['created_by'] ; ?></td>

					<td data-title="Update Item">
						<form action = "product-item-update.php" method="GET" >
							<input type = "hidden" name ="update_id" value ="<?php echo $row['id']; ?>"/>
							 <input type="submit" class="btn btn-primary" value="Update" style="border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);"/>
						</form>
					</td>
					<td data-title="Delete Item">
						<form action = "product-item-manage.php" method="POST" onClick="return confirmDelete(this)">
							<input type = "hidden" name ="delete_id" value ="<?php echo $row['id']; ?>"/>
							<input type="submit" class="btn btn-danger" role="button" value="Delete" style="border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);"/>
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