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
    mysqli_query($conn,"DELETE FROM tbl_receipt WHERE id ='$id'");
    header("location:view-payment.php");
	exit;
}
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<title>Manage Training Leads</title>

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

<title>Training Enquiry & Follow up</title>
 <style>
 table{
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
        #no-more-tables td:before { content: attr(data-title); }
        }
  </style>
</head>

<body style="background-color:#ccf2ff">
<div class ="container-fluid" >
	<div>
		<?php include 'header.inc.php'; ?>
	</div>

 <div style="margin-top:100px;">
  <h2 class="text-primary text-center">View Payment</h2>
</div> 
 <div id="no-more-tables">
<table class="table table-bordered table-stripped table-responsive table-condensed cf col-sm-12" style="text-align:center;">

    <thead class="cf">
      <tr >
        <th style='color:#b30059; text-align:center;'>#</th>
        <th style='color:#b30059; text-align:center;'>Registration No</th>
		<th style='color:#b30059; text-align:center;'>Date</th>
		<th style='color:#b30059; text-align:center;'>Amount Receipt</th>
		<th style='color:#b30059; text-align:center;'>Payment Mode</th>
		<th style='color:#b30059; text-align:center;'>Bank Name</th>
		<th style='color:#b30059; text-align:center;'>Inst No</th>
		<th style='color:#b30059; text-align:center;'>Inst Date</th>
		<th style='color:#b30059; text-align:center;'>Narration</th>
		<th style='color:#b30059; text-align:center;'>Update</th>
		<th style='color:#b30059; text-align:center;'>Delete</th>
      </tr>
    </thead>

<?php
define('MAX_REC_PER_PAGE', 5);
		$result = mysqli_query($conn,"SELECT COUNT(*) FROM tbl_receipt") or die("");
		list($total) = mysqli_fetch_row($result);
		$total_pages = ceil($total / MAX_REC_PER_PAGE);
		$page = @$_GET["page"];     
		if (0 == $page){
			$page = 1;
		}		
		$start = MAX_REC_PER_PAGE * ($page - 1);
		$max = MAX_REC_PER_PAGE;
if($_GET['page'])
{
	$result=mysqli_query($conn,"select * from tbl_receipt order by rct_date desc LIMIT $start, $max");
	$j=$_GET['page'];
	$j= $j*20+1;
}
else
{
$result=mysqli_query($conn,"select * from tbl_receipt order by rct_date desc LIMIT $start, $max");      
$j=1;
}    
          while($row = mysqli_fetch_array($result))
           {
?>
		<tbody>
            <tr>
			<td data-title="#"><?php echo $j ?></td>
			<td data-title="Registration No"><?php echo $row['reg_no'] ?></td>
			<td data-title="Date"><?php echo $row['rct_date'] ?></td>
			<td data-title="Amount Receipt"><?php echo $row['amt_receipt'] ?></td>
			<td data-title="Payment Mode"><?php echo $row['rct_mode'] ?></td>
			<td data-title="Bank Name"><?php echo $row['inst_bank_name'] ?></td>
			<td data-title="Inst No"><?php echo $row['inst_num'] ?></td>
			<td data-title="Inst Date"><?php echo $row['inst_date'] ?></td>
			<td data-title="Narration"><?php echo $row['narr_txt'] ?></td>
			<td data-title="Update" style="height:50px;">
				<form action = "payment-update-record.php" method="POST" >
					<input type = "hidden" name ="update_id" value ="<?php echo   $row['id']; ?>"/>
					 <input type="submit" class="btn btn-warning" value="Update"/>
				</form></td>
			<td data-title="Delete" style="height:50px;">
			<form action = "view-payment.php" method="POST" onClick="return confirmDelete(this)">
				<input type = "hidden" name ="delete_id" value ="<?php echo   $row['id']; ?>"/>
				 <input type="submit" class="btn btn-danger" value="Delete"/>
			</form></td>
			</tr>
<?php		
$j++;	
   }
?>

</tbody>
</table>
</div>
<center>															
		<?php 	
echo "<ul class='pagination pagination-lg'>";
echo "<li><a href='view-payment.php?page=".($page-1)."' aria-lable='Previous' ><span aria-hidden='true'>&laquo;</span>
        <span class='sr-only'>Previous</span></a></li>"; 


    echo "<li><a href='view-payment.php?page=".$page."'>".$page."</a></li>";


echo "<li><a href='view-payment.php?page=".($page+1)."' aria-lable='Next'> <span aria-hidden='true'>&raquo;</span>
        <span class='sr-only'>Next</span></a></li>";
echo "</ul>";   
?>
</center>
	
</div>
<div style="position:relative; width:100%; left:0; right:0; bottom:0;">
	<?php include("footer.inc.php"); ?>
	</div>
</body>
</html>