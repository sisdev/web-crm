<?php
ob_start();
session_start();
include 'include/dbi.php';
include 'include/session.php';
checksession();

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
       
        <title>Manage Students</title>
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
<div class ="container col-md-12">
	<div>
		<?php include 'header.inc.php'; ?>
	</div>

 <div style="margin-top:100px;">
  <h3 class="text-primary text-center">Manage Batch</h3>
</div> 
	<div style="overflow-x:auto;">
<table class="table table-bordered" style="text-align:center; ">

    <thead>
      <tr>
		
		<th style='color:#b30059; text-align:center;'>Batch ID</th>  
		<th style='color:#b30059; text-align:center;'>Course</th>
		<th style='color:#b30059; text-align:center;'>Faculty Name</th>
		<th style='color:#b30059; text-align:center;'>Attendance</th>
      </tr>
    </thead>

	<tbody>
	<tr>
		<?php
		$batch_id = $_POST['update_id'];
		$base_qry="SELECT * FROM trng_batches_actual where batch_id = '$batch_id'";
		//echo $base_qry ;
	$rs = mysqli_query($conn,$base_qry);
	$rows=mysqli_fetch_array($rs);
		
		
			$qry="SELECT * FROM deal_log where batch_id = '$batch_id'";
		//echo $qry ;
	$rss = mysqli_query($conn,$qry);
	
                                                                
	?>                                                               
         <tr>
			 
            <td align="center"><?php echo $rows["batch_id"];?></td>
            <td align="center"><?php echo $rows["course_name"];?></td>
			  <td align="center"><?php echo $rows["faculty_name"];?></td>
			
			<td>
				<form action = "batch-attendance-add.php" method="POST">
					<input type = "hidden" name ="update_id" value ="<?php echo $rows["batch_id"]; ?>">
					 <input type="submit" class="btn btn-warning" role="button" value="Add"/>
				</form>
				<form action = "batch-class-view.php" method="POST">
					<input type = "hidden" name ="update_id" value ="<?php echo $rows["batch_id"]; ?>">
					 <input type="submit"  name="view_attendance" class="btn btn-warning" role="button" value="View"/>
				</form>
				<form action = "batch-attendance-update.php" method="POST">
					<input type = "hidden" name ="update_id" value ="<?php echo $rows["batch_id"]; ?>">
					 <input type="submit"  name="update_attendance" class="btn btn-warning" role="button" value="Update"/>
				</form>
				
			</td>
			
			</tr>
		
        </tbody>
        </table>
	</div>
	
	<div style="overflow-x:auto;">
		<table class="table table-bordered" style="text-align:center; ">

    <thead>
      <tr>
		
		<th style='color:#b30059; text-align:center;'>User Profile Id</th>  
		<th style='color:#b30059; text-align:center;'>Registration Id</th>
		<th style='color:#b30059; text-align:center;'>Name</th>
		<th style='color:#b30059; text-align:center;'>Enroll Date</th>
      </tr>
    </thead>

	<tbody>
                                                  
         <?php
		 while($rowss=mysqli_fetch_array($rss)) {  ?>
		
			 <tr>
            <td align="center"><?php echo $rowss["user_profile_id"];?></td>
            <td align="center"><?php echo $rowss["reg_id"];?></td>
			  <td align="center"><?php echo $rowss["user_name"];?></td>
			 <td align="center"><?php echo $rowss["enroll_dtm"];?></td>
				   </tr>
		<?php }?>
		

        </tbody>
        </table>
	</div>
	
	
		<div style="position:absolute; left:0; right:0; width:100%;">
		<?php include("footer.inc.php"); ?>
	</div>
        </div>
		
    </body>
</html>
