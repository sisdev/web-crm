<?php
	error_reporting(1);
	ob_start();
	session_start();
	include 'include/dbi.php';
	include 'include/session.php';
	checksession();
	define('MAX_REC_PER_PAGE', 20);
	$rec_per_page = MAX_REC_PER_PAGE;
	$name=$_GET['name'];
	$email=$_GET['email'];
	$phone = $_GET['phone'];
	$biz = $_GET['biz_type'];
	$market = $_GET['market'];
	$city = $_GET['city'];
	$comp = $_GET['comp'];
$base_qry="SELECT * FROM our_contact WHERE 1=1" ;
if (isset($_GET['Go']))
{
		$result = mysqli_query($conn,"SELECT COUNT(*) FROM our_contact") or die("Count query error!");
		list($total) = mysqli_fetch_row($result);
		$total_pages = ceil($total / MAX_REC_PER_PAGE);
		$page = 1;
		$where_clause = "";
if(isset($_GET['name']) && $_GET['name']!= NULL ){
  $where_clause=$where_clause." and fname LIKE '%".$name."%' OR lname LIKE '%".$name."%' OR comp_name LIKE '%".$name."%'" ;	
	}
	
if(isset($_GET['type']) && $_GET['type']!= NULL ){
	$type=$_GET['type'];
	$where_clause=$where_clause." and qry_type LIKE '%".$type."%'" ;
}
if(isset($_GET['email']) && $_GET['email']!= NULL){
		$where_clause=$where_clause." and email LIKE '%".$email."%'";
	}
	if(isset($_GET['phone']) && $_GET['phone']!= NULL){
		$where_clause=$where_clause." and p_phone LIKE '%".$phone."%'";
	}
	if(isset($_GET['biz_type']) && $_GET['biz_type']!= NULL){
		$where_clause=$where_clause." and biz_type LIKE '%".$biz."%'";
	}
	if(isset($_GET['market']) && $_GET['market']!= NULL){
		$where_clause=$where_clause." and add_market LIKE '%".$market."%'";
	}
	if(isset($_GET['city']) && $_GET['city']!= NULL){
		$where_clause=$where_clause." and add_city LIKE '%".$city."%'";
	}
	if(isset($_GET['comp']) && $_GET['comp']!= NULL){
		$where_clause=$where_clause." and comp_name LIKE '%".$comp."%'";
	}
	$order_clause = " ORDER BY dtm DESC " ;
	$base_qry=$base_qry." ".$where_clause." ".$order_clause;
	$q=$base_qry. "limit  0 ".",".$rec_per_page;

	$_SESSION["cont_wh_clause"] = $where_clause ;
	$_SESSION["cont_ord_clause"] = $order_clause ;
	$i = 1 ;
	
}
else{
	if (!isset($_GET['page'])){
	
	$page = 1;
	$where_clause = "" ;
	$order_clause = " ORDER BY dtm DESC " ;
	
	$_SESSION["cont_wh_clause"] = $where_clause ;
	$_SESSION["cont_ord_clause"] = $order_clause ;
	
    $base_qry=$base_qry." ".$where_clause." ".$order_clause;
	$q=$base_qry. "limit  0 ".",".$rec_per_page;
	$i = 1 ;
	}
}
if (isset($_GET['page'])) {
    $next_page =  $_GET['page'];
	$page = $next_page ;
	$where_clause = $_SESSION["cont_wh_clause"] ;
	$order_clause = $_SESSION["cont_ord_clause"] ;
	$q = $base_qry ." ".$where_clause." ".$order_clause." limit ".($next_page-1)*$rec_per_page.",".$rec_per_page;	
	$i = ($next_page-1)*$rec_per_page + 1;
}	
$result = mysqli_query($conn,$q);	
?>
<html>
<head>
<title>Manage Contacts</title>
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
<div class="container-fluid" >
	<div>
		<?php include 'header.inc.php'; ?>
	</div>
<div style="margin-top:102px;">
	<h2 class="text-primary text-center">Manage Contacts</h2>
	<form action = "contact-add.php" method="post" style="float:right; margin-top:-40px;">
	<input type="submit" class="btn btn-success" role="button" value="Add Contact" style="border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);"/>
	</form>
</div> 

	<div id="no-more-tables" style="margin-top:-40px;">
	<table class="table table-bordered table-stripped table-bordered  table-condensed" style="text-align:center; margin-top:50px;">
	<thead>
		<th style='color:#b30059; text-align:center;'>#</th>
		<th style='color:#b30059; text-align:center;'>Phone</th>
		<th style='color:#b30059; text-align:center;'>Email</th>
		<th style='color:#b30059; text-align:center;'>Name</th>
		<th style='color:#b30059; text-align:center;'>Design</th>
		<th style='color:#b30059; text-align:center;'>Contact Source</th>
		<th style='color:#b30059; text-align:center;'>Company</th>
		<th style='color:#b30059; text-align:center;'>Seg/ Subseg</th>
		<th style='color:#b30059; text-align:center;'>Business Type</th>
		<th style='color:#b30059; text-align:center;'>Work Phone</th>
		<th style='color:#b30059; text-align:center;'>Website</th>
		<th style='color:#b30059; text-align:center;'>Address</th>
		<th style='color:#b30059; text-align:center;'>Note</th>
		<th style='color:#b30059; text-align:center;'>Date</th>
		<th style='color:#b30059; text-align:center;'>Created By</th>
		<th style='color:#b30059; text-align:center;'>View Contact</th>
		<th style='color:#b30059; text-align:center;'>Update Contact</th>
	</thead>

	<?php
			  while($row = mysqli_fetch_array($result))
			   {
	 ?>	
				<tbody>
				<tr>
					<td data-title="#"><?php echo $i;?></td>
					<td data-title="Personal Phone"><?php echo $row['p_phone'] ;?></td>
					<td data-title="Email"><?php echo $row['email'] ; ?></td>
					<td data-title="Name"><?php echo $row['fname']."<br>".$row['lname'] ;?></td>
					<td data-title="Designation"><?php echo $row['designation'] ;?></td>
					<td data-title="Contact Source"><?php echo $row['c_source'] ;?></td>
					<td data-title="Company Name"><?php echo $row['comp_name'] ;?></td>
					<td data-title="Seg/Subseg"><?php echo $row['indus_seg']."<br>".$row['indus_subseg'] ;?></td>
					<td data-title="Business Type"><?php echo $row['biz_type'] ;?></td>
					<td data-title="Work Phone"><?php echo $row['w_phone'] ; ?></td>
					<td data-title="Website Name"><?php echo $row['website'] ;?></td>
					<td data-title="Address"><?php echo $row['add_street']."<br>".$row['add_sector']."<br>".$row['add_market']."<br>".$row['add_city']."<br>".$row['add_district'] ; ?></td>
					<td data-title="Note"><?php echo $row['note'] ; ?></td>
					<td data-title="Date"><?php echo $row['dtm'] ; ?></td>
					<td data-title="Created By"><?php echo $row['created_by'] ; ?></td>

					<td data-title="View Contact">
						<form action = "contact-view.php" method="GET" >
							<input type = "hidden" name ="view_id" value ="<?php echo $row['id']; ?>"/>
							 <input type="submit" class="btn btn-primary" value="View" style="border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);"/>
						</form>
					</td>
					<td data-title="Update Contact">
						<form action = "contact-update.php" method="GET" >
							<input type = "hidden" name ="update_id" value ="<?php echo $row['id']; ?>"/>
							 <input type="submit" class="btn btn-warning" value="Update" style="border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);"/>
						</form>
					</td>
				</tr>
				</tbody>
	<?php		
	$i++;	
	   }	  
	?>
	</table>
	</div>
	<center>															
		<?php 	
echo "<ul class='pagination pagination-lg'>";
echo "<li><a href='contact-manage.php?page=".($page-1)."' aria-lable='Previous' ><span aria-hidden='true'>&laquo;</span>
        <span class='sr-only'>Previous</span></a></li>"; 


    echo "<li><a href='contact-manage.php?page=".$page."'>".$page."</a></li>";
 

echo "<li><a href='contact-manage.php?page=".($page+1)."' aria-lable='Next'> <span aria-hidden='true'>&raquo;</span>
        <span class='sr-only'>Next</span></a></li>";
echo "</ul>";   
?>
</center>
</div>
<div>
		<?php include("footer.inc.php"); ?>
	</div>	
	</body>
</html>