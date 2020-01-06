<?php
	error_reporting(1);
	ob_start();
	session_start();
	include 'include/dbi.php';
	include 'include/session.php';
	checksession();
	
	define('MAX_REC_PER_PAGE', 20);
	$rec_per_page = MAX_REC_PER_PAGE;
	
	$i=1;
	$page = 1;
	
	$base_qry="select * FROM sms_log where 1=1 ORDER BY dtm_sms DESC";	
	$q=$base_qry. " LIMIT  0 ".",".$rec_per_page;
	
	if (isset($_GET['page'])) {
	$page = 1;
    $next_page =$_GET['page'];
	$page = $next_page ;
	$q = $base_qry ." LIMIT ".($next_page-1)*$rec_per_page.",".$rec_per_page;
	$i = ($next_page-1)*$rec_per_page + 1;
	}	
	
	$result = mysqli_query($conn,$q) ;
	if($result)
	{
?>
<html>
<head>
<title>SMS Log</title>
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
	<h2 class="text-primary text-center">SMS Log</h2>
</div> 

	<div id="no-more-tables" style="margin-top:-40px;">
	<table class="table table-bordered table-stripped table-bordered  table-condensed" style="text-align:center; margin-top:50px;">
	<thead>
		<th style='color:#b30059; text-align:center;'>#</th>
		<th style='color:#b30059; text-align:center;'>Date-Time</th>
		<th style='color:#b30059; text-align:center;'>From</th>
		<th style='color:#b30059; text-align:center;'>To</th>
		<th style='color:#b30059; text-align:center;'>Sms Code</th>
		<th style='color:#b30059; text-align:center;'>Text</th>
		<th style='color:#b30059; text-align:center;'>Sent By</th>
	</thead>

	<?php
			  while($row = mysqli_fetch_array($result))
			   {
	 ?>	
				<tbody>
				<tr>
					<td data-title="#"><?php echo $i;?></td>
					<td data-title="Date-Time"><?php echo $row['dtm_sms'] ;?></td>
					<td data-title="From"><?php echo $row['from_phnum'] ; ?></td>
					<td data-title="To"><?php echo $row['to_phnum'] ;?></td>
					<td data-title="Sms Code"><?php echo $row['msg_code'] ;?></td>
					<td data-title="Text"><?php echo $row['msg_text'] ;?></td>
					<td data-title="Sent By"><?php echo $row['sent_by'] ;?></td>
				</tr>
				</tbody>
	<?php		
	$i++;	
	   }
	}	  
	?>
	</table>
	</div>
	<center>															
		<?php 	
echo "<ul class='pagination pagination-lg'>";
echo "<li><a href='sms-log.php?page=".($page-1)."' aria-lable='Previous' ><span aria-hidden='true'>&laquo;</span>
        <span class='sr-only'>Previous</span></a></li>"; 


    echo "<li><a href='sms-log.php?page=".$page."'>".$page."</a></li>";
 

echo "<li><a href='sms-log.php?page=".($page+1)."' aria-lable='Next'> <span aria-hidden='true'>&raquo;</span>
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