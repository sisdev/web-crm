<?php
error_reporting(1);
ob_start();
session_start();
include 'include/dbi.php';
include 'include/session.php';
include 'include/param.php';
checksession();
$created=$_SESSION['login'];
$type=$_GET['type'];
$course=$_GET['course'];
$date=$_GET['date'];
define('MAX_REC_PER_PAGE', 20);
$rec_per_page = MAX_REC_PER_PAGE;

$role_qry=mysqli_query($conn,"SELECT role from tbl_staff where username='$created'");
$role_array=mysqli_fetch_array($role_qry);
$roles=$role_array['role'];
//echo $roles;

if($roles=='executive'){
	$base_qry="SELECT id,qry_type, qry_status,assigned_to, comp_name, indus_seg, indus_subseg, name, address, add_street, add_market, add_sector, add_city, add_distict, emailID,phone_no,qry_details,qry_source,lead_class,req_dtm,target_month  FROM lead_log WHERE assigned_to='$created' OR created_by='$created' " ;
}
else{
	$base_qry="SELECT id,qry_type, qry_status,assigned_to, comp_name, indus_seg, indus_subseg, name, address, add_street, add_market, add_sector, add_city, add_distict, emailID,phone_no,qry_details,qry_source,lead_class,req_dtm,target_month  FROM lead_log WHERE 1 = 1" ;
	//echo $base_qry;
}

if (isset($_GET['Go']))
{
		$result = mysqli_query($conn,"SELECT COUNT(*) FROM lead_log") or die("Count query error!");
		list($total) = mysqli_fetch_row($result);
		$total_pages = ceil($total / MAX_REC_PER_PAGE);
		
		$page = 1;
		
		$where_clause = "";

if(isset($_GET['assigned_to']) && $_GET['assigned_to']!= NULL ){
	$assigned_to=$_GET['assigned_to'];
	if($assigned_to=='my_Leads')
	{
	$where_clause=$where_clause." and assigned_to='$created' or created_by='$created'" ;
	}
}

if(isset($_GET['status_wise']) && $_GET['status_wise']!= NULL ){
	$status_wise=$_GET['status_wise'];
	if($status_wise=='active_status')
	{
	$where_clause=$where_clause." and qry_status IN ('".implode("','",$lead_active)."')" ;
	}
}

if(isset($_GET['sel_status']) && $_GET['sel_status']!= NULL){
	$q_status = $_GET['sel_status'];
	$where_clause=$where_clause." and qry_status Like '%".$q_status."%'" ;
}
if(isset($_GET['type']) && $_GET['type']!= NULL ){
	$type=$_GET['type'];
	$where_clause=$where_clause." and qry_type LIKE '%".$type."%'" ;
}
// if(isset($_GET['sname']) && $_GET['sname']!= NULL){
// 	$name=$_GET['sname'];
// 	$where_clause=$where_clause." and name LIKE '%".$name."%'" ;
// }
if(isset($_GET['sname']) && $_GET['sname']!= NULL){
	$name=$_GET['sname'];
	$where_clause=$where_clause." and name LIKE '%".$name."%'" ;
}
if(isset($_GET['comp_name']) && $_GET['comp_name']!= NULL){
	$comp_name=$_GET['comp_name'];
	$where_clause=$where_clause." and comp_name LIKE '%".$comp_name."%'" ;
}

if(isset($_GET['market']) && $_GET['market']!= NULL){
	$market=$_GET['market'];
	$where_clause=$where_clause." and add_market LIKE '%".$market."%'" ;
}

if(isset($_GET['course']) && $_GET['course']!= NULL){
	$course=$_GET['course'];
	$where_clause=$where_clause." and qry_details LIKE '%".$course."%'" ;
}
if(isset($_GET['mob']) && $_GET['mob']!= NULL){
	$mobile = $_GET['mob'];
	$where_clause=$where_clause." and phone_no Like '%".$mobile."%'" ;
}

if(isset($_GET['sel_class']) && $_GET['sel_class']!= NULL){
	$q_class = $_GET['sel_class'];
	$where_clause=$where_clause." and lead_class Like '%".$q_class."%'" ;
}
if(isset($_GET['score']) && $_GET['score']!= NULL){
	$score=$_GET['score'];
	$where_clause=$where_clause." and lead_score >='".$score."'";
}
if(isset($_GET['date']) && $_GET['date']!= NULL){
	$nextfollowupdate=$_GET['date'];
	$where_clause=$where_clause." and nxt_followup_dt >='".$nextfollowupdate."'";
}
$order_clause = " ORDER BY req_dtm DESC " ;

$base_qry=$base_qry." ".$where_clause." ".$order_clause;


//echo $base_qry ;
	$q=$base_qry. "limit  0 ".",".$rec_per_page;

	$_SESSION["wh_clause"] = $where_clause ;
	$_SESSION["ord_clause"] = $order_clause ;
	$i = 1 ;
	
}
else{
	if (!isset($_GET['page'])){
	
	$page = 1;
	$where_clause = " AND qry_status IN ('".implode("','",$lead_active)."') "  ;
	$order_clause = " ORDER BY req_dtm DESC " ;

	$_SESSION["wh_clause"] = $where_clause ;
	$_SESSION["ord_clause"] = $order_clause ;
    $base_qry=$base_qry." ".$where_clause." ".$order_clause;


//echo $base_qry ;
	$q=$base_qry. "limit  0 ".",".$rec_per_page;
	$i = 1 ;
	}
}
if (isset($_GET['page'])) {
    $next_page =  $_GET['page'];
	$page = $next_page ;
	$where_clause = $_SESSION["wh_clause"] ;
	$order_clause = $_SESSION["ord_clause"] ;
	$q = $base_qry ." ".$where_clause." ".$order_clause." limit ".($next_page-1)*$rec_per_page.",".$rec_per_page;	
	$i = ($next_page-1)*$rec_per_page + 1;
}	
//echo $q ;	
$result = mysqli_query($conn,$q);	
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="icon" type="image/png" href="images/icon.png" />
<title>Lead Enquiry & Follow up</title>

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
	table-layout:fixed;
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
<div class ="container-fluid" >   	<!-- body -->
	<div>
		<?php include 'header.inc.php'; ?>
	</div>

 <div style="margin-top:100px;">
  <h2 class="text-primary text-center">Lead View All</h2>
</div> 
 <div id="no-more-tables">
<table class="table table-bordered table-stripped table-responsive table-condensed col-sm-12" style="text-align:center;">

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
	    <th style='color:#b30059; text-align:center;'>Last Followup Date<br>Target Month</th>
	    <th style='color:#b30059; text-align:center;'>Followup</th>
		<th style='color:#b30059; text-align:center;'>Modify</th>
      </tr>
    </thead>
	
<?php

$_SESSION['viewLeadSrc'] ="viewLeads" ;
			

          while($row = mysqli_fetch_array($result))
           {
?>
		<tbody>
            <tr>
			<td data-title="#"><?php echo $i; ?></td>
			<td data-title="Product"><?php echo $row['qry_details']; ?></td>
			<td data-title="Query Type & Status"><?php echo $row['qry_type']."<br>".$row['qry_status']; ?></td>
			<td data-title="Contact"><?php echo $row['name']; ?></td>
			<td data-title="Company"><?php echo $row['comp_name']; ?></td>
			<td data-title="Mobile"><?php echo $row['phone_no']; ?></td>
			<td data-title="Email"><?php echo $row['emailID']; ?></td>
			<td data-title="Address" ><?php echo $row['add_street']."<br>".$row['add_sector']."<br>".$row['add_market']."<br>".$row['add_city']."<br>".$row['add_distict']; ?></td>
			<td data-title="Query Date"><?php echo $row['req_dtm']; ?></td>
			<td data-title="Last Followup Date"><?php echo get_LastFollowupDtm($conn, $row['id'])."<br>__________<br>".$row['target_month'];?></td>
			<td data-title="View">
				<form action = "lead_view_record.php" method="GET" >
					<input type = "hidden" name ="view_id" value ="<?php echo $row['id']; ?>"/>
					<input type = "hidden" name ="page" value ="<?php echo $page; ?>"/>
					 <input type="submit" class="btn btn-primary" value="FollowUp" style="border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);"/>
				</form></td>
			<td data-title="Modify" >
			<form action = "lead_modify_record.php" method="GET" >
				<input type = "hidden" name ="mod_id" value ="<?php echo $row['id']; ?>"/>
				<input type = "hidden" name ="page" value ="<?php echo $page; ?>"/>
				 <input type="submit" class="btn btn-warning" value="Modify" style="border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);"/>
			</form></td>
			</tr>
<?php		
$i++;	
   }
?>

</tbody>
</table>
</div>
</div>
<center>															
		<?php 	
echo "<ul class='pagination pagination-lg'>";
echo "<li><a href='lead_view_all.php?page=".($page-1)."' aria-lable='Previous' ><span aria-hidden='true'>&laquo;</span>
        <span class='sr-only'>Previous</span></a></li>"; 


    echo "<li><a href='lead_view_all.php?page=".$page."'>".$page."</a></li>";
 

echo "<li><a href='lead_view_all.php?page=".($page+1)."' aria-lable='Next'> <span aria-hidden='true'>&raquo;</span>
        <span class='sr-only'>Next</span></a></li>";
echo "</ul>";   
?>
</center>
<div>

<?php
function get_LastFollowupDtm($conn, $lead_id){
  $last_followup_query = "SELECT * FROM `lead_followup` where trng_query_id='$lead_id' ORDER BY followup_dtm DESC LIMIT 1";
  $last_followup_result = mysqli_query($conn, $last_followup_query);
  $last_row = mysqli_fetch_array($last_followup_result);
  return $last_row['followup_dtm'];
}
?>
	<?php include("footer.inc.php"); ?>
	</div>
</body>
</html>