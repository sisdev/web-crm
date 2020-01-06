<?php
ob_start();
session_start();
include 'include/dbi.php';
include 'include/session.php';
include 'include/param.php';
//checksession();
$todayDate=getLocalDtm();
$uName = $_SESSION["login"];
$i=1;
?>
<html>
<head>
<title><?php echo $pkg_name; ?>-Report</title>
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
  
<div style="margin-top:80px;">
  <h2 class="text-primary text-center">Target Month Report</h2>
</div> 
  <div>
  <form method="GET">
    <div class="row">
      <div class="col-sm-4"></div>
 <div class="col-sm-4">
      <div class="input-group input-append date" id="datePicker">     
      <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
      <input class="form-control" required=required placeholder="yy-mm-dd" name="target_month" id="datepick1" type="text" value="<?php if(isset($_GET['target_month'])){ echo substr($_GET['target_month'],0,10);}?>">
            </div>
      </div>
		 
	   <div class="col-sm-2">
	   <input type="submit" name="searchbttn" class="btn btn-info" value="Go" />
      </div>

</form>


<?php
if(isset($_GET['target_month']))
{
	$date1=$_GET['target_month'];
 

	//echo "<h5>Requested Date:<b> ".$date1." To ".$date2."</b></h5>";
	
	$sql_qry ="select * from lead_log where target_month='$date1'" ;
	//echo $sql_qry. "<br>" ;
	$qry=mysqli_query($conn,$sql_qry);
	$rowcount=mysqli_num_rows($qry);
	
?>

<div id="no-more-tables">
<table class="table table-striped table-bordered table-condensed" style="text-align:center; margin-top:10px; margin-bottom:80px;">
    <thead>
      <tr>
        <th style='color:#b30059; text-align:center;'>#</th>
		<th style='color:#b30059; text-align:center;'>Product Name</th>
		<th style='color:#b30059; text-align:center;'>Query Type <br> Status</th>
		<th style='color:#b30059; text-align:center;'>Contact Person</th>
		<th style='color:#b30059; text-align:center;'>Company Name</th>		
		<th style='color:#b30059; text-align:center;'>Mobile</th>
    <th style='color:#b30059; text-align:center;'>Email</th>
    <th style='color:#b30059; text-align:center;'>Address</th>
    <th style='color:#b30059; text-align:center;'>Query Date</th>
    <th style='color:#b30059; text-align:center;'>Last Followup Date</th>
    <th style='color:#b30059; text-align:center;'>Followup</th>
		<th style='color:#b30059; text-align:center;'>Modify</th>
      </tr>
    </thead>
    <tbody>
	
	<?php 
	
	//$control_break="";
$_SESSION['viewLeadSrc'] ="targetMonth_report" ;
	while($rec=mysqli_fetch_array($qry))
	{
		// $current_date=SUBSTR($rec['req_dtm'],0,10);
		// $tid=$rec['id'];
		// $act_query="SELECT followup_text FROM `lead_followup` where trng_query_id='$tid' AND followup_dtm=(SELECT max(followup_dtm) from lead_followup where trng_query_id='$tid')";
		// //echo $act_query;
		// $qry_action=mysqli_query($conn,$act_query);
		// $act_result=mysqli_fetch_array($qry_action);
		// $action_plan=$act_result['followup_text'];
?>

      <tr>
      				<td data-title="#"><?php echo $i;?></td>
				<!-- 	<td data-title="Date">
					<?php 
						if($control_break == $current_date){
							echo "";
						} else{
							echo $current_date;
							$control_break = $current_date;

						}

					 ?>
					 </td> -->
					<td data-title="Product"><?php echo $rec['qry_details'];?></td>
					<td data-title="Query Type"><?php echo $rec['qry_type']."<br>".$rec['qry_status'];?></td>
					<td data-title="Contact Person"><?php echo $rec['name'];?></td>
					<td data-title="Company"><?php echo $rec['comp_name'];?></td>
          <td data-title="Mobile"><?php echo $rec['phone_no'];?></td>
          <td data-title="Email"><?php echo $rec['emailID'];?></td>
          <td data-title="Address"><?php echo $rec['add_street']."<br>".$rec['add_sector']."<br>".$rec['add_market']."<br>".$rec['add_city'];?></td>
          <td data-title="Date"><?php echo SUBSTR($rec['req_dtm'], 0, 10);?></td>
          <td data-title="Followup Date"><?php echo get_LastFollowupDtm($conn, $rec['id']);?></td>
         <td data-title="View" style="height:50px;">
        <form action = "lead_view_record.php" method="GET" >
          <input type = "hidden" name ="view_id" value ="<?php echo $rec['id']; ?>"/>
          <input type = "hidden" name ="target_month" value ="<?php echo $date1; ?>"/>
         <!--  <input type = "hidden" name ="page" value ="<?php echo $page; ?>"/> -->
           <input type="submit" class="btn btn-primary" value="FollowUp" style="border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);"/>
        </form></td>
      <td data-title="Modify" style="height:50px;">
      <form action = "lead_modify_record.php" method="GET" >
        <input type = "hidden" name ="mod_id" value ="<?php echo $rec['id']; ?>"/>
       <!--  <input type = "hidden" name ="page" value ="<?php echo $page; ?>"/> -->
         <input type="submit" class="btn btn-warning" value="Modify" style="border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);"/>
      </form></td>
		</tr>
		<?php $i++; } 
     echo "<div style='margin-right:800px; margin-top:10px;'>Total Prospects : <b>".$rowcount."</b></div>"; 

     $product_wise_query = "SELECT qry_details, count(*) as total_product from lead_log where target_month='".$_GET['target_month']."' GROUP BY qry_details";
     //echo $product_wise_query;
     $product_wise_result = mysqli_query($conn, $product_wise_query);
     while($row = mysqli_fetch_array($product_wise_result)){
		 echo $row['qry_details']." : <b>".$row['total_product']."</b> &nbsp;&nbsp;"; 
    }
} ?>

    </tbody>
  </table>
</div>

</div>

 
 
  </div>  
  </div>
 <!-- <div style="position:relative; right:0; left:0; width:100%; bottom:0;"><?php //include("footer.inc.php"); ?></div> -->
  </body>
  <script>
   $(document).ready(function(){
	   var date_input=$('input[name="target_month"]'); //our date input has the name "date"
    var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
    date_input.datepicker({
      showOn: 'button',
      startView: "months", 
        minViewMode: "months",
      format: 'yyyy-mm',
      container: container,
      autoclose: true,
    }) ;
  });
  
</script>

<?php
function get_LastFollowupDtm($conn, $lead_id){
  $last_followup_query = "SELECT * FROM `lead_followup` where trng_query_id='$lead_id' ORDER BY followup_dtm DESC LIMIT 1";
  $last_followup_result = mysqli_query($conn, $last_followup_query);
  $last_row = mysqli_fetch_array($last_followup_result);
  return $last_row['followup_dtm'];
}
?>
</html>