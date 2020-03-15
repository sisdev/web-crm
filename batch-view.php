<?php
ob_start();
session_start();
include 'include/dbi.php';
include 'include/session.php';
checksession();
if(isset($_POST['delete_id']))
{
	$id= $_POST['delete_id'];
    mysqli_query($conn,"DELETE FROM trng_batches WHERE id ='$id'");
    header("location:batch-view.php");
	exit;
}
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
       
        <title>View Batches</title>
      <link rel="icon" type="image/png" href="images/icon.png" />

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
<div class ="container col-md-12">
	<div>
		<?php include 'header.inc.php'; ?>
	</div>

 <div style="margin-top:100px;">
  <h3 class="text-primary text-center">View Batches</h3>
</div> 
	<div style="overflow-x:auto;">
<table class="table table-bordered" style="text-align:center; ">

    <thead>
      <tr>
		
		<th style='color:#b30059; text-align:center;'>Batch ID</th>  
		<th style='color:#b30059; text-align:center;'>Start Date</th>
		<th style='color:#b30059; text-align:center;'>Course</th>
		<th style='color:#b30059; text-align:center;'>Duration</th>
		<th style='color:#b30059; text-align:center;'>Faculty Profile</th>
		<th style='color:#b30059; text-align:center;'>Day & Time</th>
		<th style='color:#b30059; text-align:center;'>Course Fees</th>
		<th style='color:#b30059; text-align:center;'>No. of Seats</th>
		<th style='color:#b30059; text-align:center;'>Update</th>
		<th style='color:#b30059; text-align:center;'>Delete</th>
      </tr>
    </thead>

	<tbody>
	<tr>
		<?php
		define('MAX_REC_PER_PAGE', 20);
		$rs = mysqli_query($conn,"SELECT COUNT(*) FROM trng_batches") or die("Count query error!");
		list($total) = mysqli_fetch_row($rs);
		$total_pages = ceil($total / MAX_REC_PER_PAGE);
		$page = @$_GET["page"];     
		if (0 == $page){
			$page = 1;
		}		
		$start = MAX_REC_PER_PAGE * ($page - 1);
		$max = MAX_REC_PER_PAGE;
		$rs = mysqli_query($conn,"SELECT *  FROM trng_batches ORDER BY start_date DESC LIMIT $start, $max") or die("batch error!");
                                                                
                                                                while($qfetch = mysqli_fetch_array($rs)) {  ?>
         <tr>
			 
            <td align="center"><?php echo $qfetch["batch_id"];?></td>
            <td align="center"><?php echo $qfetch["start_date"];?></td>
            <td align="center"><?php echo $qfetch["course_name"];?></td>
            <td align="center"><?php echo $qfetch["duration"];?></td>
            <td align="center"><?php echo  $qfetch['faculty_profile'];?></td>
            <td align="center"><?php echo $qfetch["day_and_time"];?></td>
            <td align="center"><?php echo $qfetch["course_fee"];?></td>
            <td align="center"><?php echo $qfetch["no_of_seats"];?></td>            
			
			<td>
				<form action = "batch_update.php" method="post">
					<input type = "hidden" name ="update_id" value ="<?php echo $qfetch["id"]; ?>/">
					 <input type="submit" class="btn btn-warning" role="button" value="Update"/>
				</form>
				<form action = "batch-start.php" method="post">
					<input type = "hidden" name ="update_id" value ="<?php echo $qfetch["id"]; ?>/">
					 <input type="submit" class="btn btn-warning" role="button" value="Start Batch"/>
				</form>
			</td>
			<td>
			<form action = "batch-view.php" method="post" onClick="return confirmDelete(this)">
				<input type = "hidden" name ="delete_id" value ="<?php echo  $qfetch["id"]; ?>"/>
				 <input type="submit" class="btn btn-danger" role="button" value="Delete"/>
			</form></td>
			</tr>
<?php } ?>										                          
            
        </tbody>
        </table>
	</div>
	<center>															
		<?php 	
echo "<ul class='pagination pagination-lg'>";
echo "<li><a href='admin_view_batch.php?page=".($page-1)."' aria-lable='Previous' ><span aria-hidden='true'>&laquo;</span>
        <span class='sr-only'>Previous</span></a></li>"; 


    echo "<li><a href='admin_view_batch.php?page=".$page."'>".$page."</a></li>";
 

echo "<li><a href='admin_view_batch.php?page=".($page+1)."' aria-lable='Next'> <span aria-hidden='true'>&raquo;</span>
        <span class='sr-only'>Next</span></a></li>";
echo "</ul>";   
?>
</center>
		<div style="position:absolute; left:0; right:0; width:100%;">
		<?php include("footer.inc.php"); ?>
	</div>
        </div>
		
    </body>
</html>
