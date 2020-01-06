<?php
ob_start();
session_start();
include 'include/dbi.php';
include 'include/session.php';
include 'include/param.php';
//checksession();
$uName=$_SESSION['login'];
?>

<html>
<head>
<title><?php echo $pkg_name; ?>-Monthly Sales Deal Report</title>
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
#no-more-tables table{
	width:100%;
    word-wrap: break-word;
	table-layout:fixed;
 }
 #no-more-tables tbody:nth-of-type(odd) {
 background: #99d6ff ;
}
#no-more-tables th {
 background: #ffb3b3 ;
 font-weight: bold;
 color:#b30059;
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
<div class="container-fluid">
  <div>
  <?php include("header.inc.php"); ?>
  </div>
  
<div style="margin-top:90px;">
  <h2 class="text-primary text-center">Monthly Sales-DEAL Report</h2>
</div> 
   
<form method="post" style="margin-left:34%;" >
  <div class="row">
  <div class="col-sm-1">
  <h4> Pick Month: </h4>
   </div>
 <div class="col-sm-4">
      <div class="input-group input-append date" id="datePicker">     
      <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
      <input class="form-control" required=required placeholder="Pick a Month" name="searchtext1" id="datepick1" type="text" value="<?php if(isset($_POST['searchtext1'])){ echo substr($_POST['searchtext1'],0,10);}?>">
            </div>
      </div>
		
		 <div class="col-sm-3">
	   <input type="submit" name="searchbttn" class="btn btn-info" value="Go" style="border-radius:0; box-shadow: 0 2px 4px 0 rgba(0,0,0,0.2), 0 2px 8px 0 rgba(0,0,0,0.19);"/>
      </div>
</div>	  
</form>
<?php
  if(isset($_POST['searchbttn']))
{
	$date1=$_POST['searchtext1'];
		
?>
<div id="no-more-tables">
<table class="table table-bordered table-stripped table-responsive table-condensed" style="text-align:center; margin-bottom:80px;" id="myTable">
	<thead>
		<th style='color:#b30059; text-align:center;'>#</th>
		<th style='color:#b30059; text-align:center;'>Date</th>
		<th style='color:#b30059; text-align:center;'>Registration ID </th>		
		<th style='color:#b30059; text-align:center;'>User Profile Id</th>
		<th style='color:#b30059; text-align:center;'>Email</th>
		<th style='color:#b30059; text-align:center;'>Batch Id</th>
		<th style='color:#b30059; text-align:center;'>Course-Product</th>
		<th style='color:#b30059; text-align:center;'>Fee/Price</th>
		<th style='color:#b30059; text-align:center;'>Payment Status</th>
		<th style='color:#b30059; text-align:center;'>Created By</th>
	</thead>
   <?php  
   if($uName!='admin'){
    $dur_qry="select * from deal_log where enroll_dtm LIKE '".$date1."%' and created_by='$uName' order by enroll_dtm desc"; 
	
//echo $dur_qry;
 }
else{

 $dur_qry="select * from deal_log where enroll_dtm LIKE '".$date1."%' order by enroll_dtm desc";
}
//	echo $dur_qry;
	$result=mysqli_query($conn,$dur_qry );   
$j=0;
   
   $total_fees=0;
          while($row = mysqli_fetch_array($result))
           {	
			$fees=$row['course_fee'];
	   
$j++;	   
?>
		<tbody>
				<tr>
					<td data-title="#"><?php echo $j;?></td>
					<td data-title="Date"><?php echo SUBSTR($row['enroll_dtm'],0,10);?></td>
					<td data-title="Reg ID"><?php echo $row['reg_id'];?></td>
					<td data-title="User ID"><?php echo $row['user_profile_id'];?></td>
					<td data-title="Email"><?php echo $row['user_name'];?></td>
					<td data-title="Batch ID"><?php echo $row['batch_id'];?></td>
					<td data-title="Course/Product"><?php echo $row['course_name'];?></td>
					<td data-title="Fee/Price"><?php echo $fees; ?></td>
					<td data-title="Pay Status"><?php echo $row['payment_status'];?></td>
					<td data-title="Created By"><?php echo $row['created_by'];?></td>
				</tr>				
<?php		
  $total_fees+=$fees;
  }
   $tot_fee = number_format($total_fees,2);
   echo "<div style='margin-right:800px; margin-top:10px; width:150px; height: 30px; border-radius:0; box-shadow: 0 2px 4px 0 rgba(0,0,0,0.2), 0 2px 8px 0 rgba(0,0,0,0.19);'>Total Orders: <b>".$j."</b></div>";	
   echo "<div style='margin-top:-30px; margin-bottom:3px; float:right; width:150px; height: 30px; border-radius:0; box-shadow: 0 2px 4px 0 rgba(0,0,0,0.2), 0 2px 8px 0 rgba(0,0,0,0.19);'>Total Income: <b>".$tot_fee."</b></div>";	
   
}
?>
		</tbody>
</table>
</div>
</div>

<div style="position:fixed; bottom:0; width:100%; left:0; right:0;"><?php include("footer.inc.php"); ?></div>
</body>
 
<script>
  $(document).ready(function(){
    var date_input=$('input[name="searchtext1"]'); //our date input has the name "date"
    var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
    date_input.datepicker({
       format: "yyyy-mm",
    viewMode: "months", 
    minViewMode: "months",
      container: container,
      todayHighlight: true,
      autoclose: true,
    }) ;
  }) ;
</script>
</html>