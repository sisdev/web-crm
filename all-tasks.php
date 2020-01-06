<?php
ob_start();
session_start();
include 'include/dbi.php';
include 'include/session.php';
include 'include/param.php';
//checksession();
$uName = $_SESSION["login"];
$i=1;
?>
<html>
<head>
<title><?php echo $pkg_name; ?>-All Tasks</title>
<link rel="icon" type="image/png" href="images/icon.png" />
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
<script src="js/jquery.timepicker.js" type="text/javascript"></script> 
<script src="js/jquery-2.2.0.min.js" type="text/javascript"></script> 
<script src="js/jquery-ui.js" type="text/javascript"></script> 
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

<style>
#no-more-tables{
	word-wrap: break-word;
	table-layout:fixed;
}
  #no-more-tables tbody:nth-of-type(odd) {
 background: #99d6ff ;
}
#no-more-tables th {
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
  <?php include("header.inc.php"); ?>
  </div>
  
<div style="margin-top:100px;">
  <h2 class="text-primary text-center">All Tasks For Duration</h2>
</div> 
  <div>
  <form method="post">
 
  <div class="col-sm-1">
  <h4><strong> From: </strong></h4>
   </div>
 <div class="col-sm-4">
      <div class="input-group input-append date" id="datePicker">     
      <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
      <input class="form-control" required=required placeholder="yy-mm-dd" name="searchtext1" id="datepick1" type="text" value="<?php if(isset($_POST['searchtext1'])){ echo substr($_POST['searchtext1'],0,10);}?>">
            </div>
      </div>
		
		<div class="col-sm-1">
		<h4><strong> To: </strong></h4>
		</div>
		<div class="col-sm-4">
      <div class="input-group input-append date" id="datePicker">     
      <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
      <input class="form-control" required=required placeholder="yy-mm-dd" name="searchtext2"  id="datepick2" type="text" value="<?php if(isset($_POST['searchtext2'])){ echo substr($_POST['searchtext2'],0,10);}?>">
            </div>
      </div>
	
    
	   <div class="col-sm-2">
	   <input type="submit" name="searchbttn" class="btn btn-info" value="Go" />
      </div>

</form>


<?php
if(isset($_POST['searchbttn']))
{
	//$date=substr($_POST['searchtext'],0,10);
	$date1=$_POST['searchtext1'];
	$date2=$_POST['searchtext2'];
	$dtm=$date1." ".$date2;
	//echo "<h5>Requested Date:<b> ".$date1." To ".$date2."</b></h5>";
	
	$sql_qry = "select * from mytasks where created_by='$uName' OR created_by='$uName' AND SUBSTR(datetime,1,10) between '".$date1."' and '".$date2."'" ;
	//echo $sql_qry. "<br>" ;
	$qry=mysqli_query($conn,$sql_qry);
	
	$tot = "SELECT SUM(count) FROM (SELECT COUNT(assigned_user) AS count FROM mytasks where created_by='$uName' OR created_by='$uName' AND SUBSTR(datetime,1,10) between '".$date1."' and '".$date2."') as A";
	//echo $tot;
	$total = mysqli_query($conn, $tot) ;
	$row = mysqli_fetch_assoc($total);
	
?>

<div id="no-more-tables">
<table class="table table-striped table-bordered table-condensed" style="text-align:center; margin-top:10px; margin-bottom:80px;">
    <thead>
      <tr>
       <th style='color:#b30059; text-align:center;'>#</th>
		<th style='color:#b30059; text-align:center;'>Lead Qry Id</th>
		<th style='color:#b30059; text-align:center;'>Lead Contact</th>
		<th style='color:#b30059; text-align:center;'>Assigned User</th>
		<th style='color:#b30059; text-align:center;'>Task Date-Time</th>		
		<th style='color:#b30059; text-align:center;'>Task Type</th>
		<th style='color:#b30059; text-align:center;'>Narration</th>
		<th style='color:#b30059; text-align:center;'>Closing_Remark</th>
		<th style='color:#b30059; text-align:center;'>Status</th>
		<th style='color:#b30059; text-align:center;'>Created By</th>
		<th style='color:#b30059; text-align:center;'>Update Task</th>
      </tr>
    </thead>
    <tbody>
	
	<?php 

	
	if(isset($qry))
	{
	while($rec=mysqli_fetch_array($qry))
{ 
$trng_id=$rec['trng_query_id'];
$name_query=mysqli_query($conn, "SELECT name from lead_log where id='$trng_id'");
$r_name=mysqli_fetch_array($name_query);
$trng_name=$r_name['name'];

?>

      <tr>
       <td data-title="#"><?php echo $i;?></td>
					<td data-title="Training Qry Id"><?php echo $trng_id;?></td>
					<td data-title="Training Name"><?php echo $trng_name;?></td>
					<td data-title="Assign User"><?php echo $rec['assigned_user'];?></td>
					<td data-title="Date-Time"><?php echo $rec['datetime'];?></td>
					<td data-title="Task Type"><?php echo $rec['task_type'];?></td>
					<td data-title="Narration"><?php echo $rec['narration'];?></td>
					<td data-title="Output"><?php echo $rec['closing_remark'];?></td>
					<td data-title="Status"><?php echo $rec['status'];?></td>
					<td data-title="Created By"><?php echo $rec['created_by'];?></td>

					<td data-title="Update Task">
						<form action = "mytask-update.php" method="GET" >
							<input type = "hidden" name ="update_id" value ="<?php echo $rec['id']; ?>"/>
							 <input type="submit" class="btn btn-warning" value="Update" style="border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);"/>
						</form>
					</td>
		</tr>
		<?php $i++; }  }  
		 echo "<div style='margin-right:800px; margin-top:10px;'>Total Tasks : <b>".array_sum($row)."</b></div>"; 
} ?>

    </tbody>
  </table>
</div>

</div>

 
 
  </div>  
  </div>
 <div style="position:fixed; right:0; left:0; width:100%; bottom:0;"><?php include("footer.inc.php"); ?></div>
  </body>
  <script>
   $(document).ready(function(){
	  $(window).load(function(){
			   $("#datepick1").datepicker({
				   format: 'yyyy-mm-dd'
		  
	  });

	  $("#datepick1").click(function(){
		
		$(this).datepicker({Format: 'yyyy-mm-dd'});
	});
  });
  });
  
   $(document).ready(function(){
	  $(window).load(function(){
			   $("#datepick2").datepicker({
				   format: 'yyyy-mm-dd'
	  });
	  $("#datepick2").click(function(){
		
		$(this).datepicker({Format: 'yyyy-mm-dd'});
	});
  });
  });
</script>
</html>