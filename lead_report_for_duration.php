<?php
ob_start();
session_start();
include 'include/dbi.php';
include 'include/session.php';
include 'include/param.php';
//checksession();
?>
<html>
<head>
<title><?php echo $pkg_name; ?>-Lead Report</title>
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
  </head>
  
  <body style="background-color:#ccf2ff">

  <div class="container col-md-12">
 
  <div>
  <?php include("header.inc.php"); ?>
  </div>
  <div class="row" style="margin-top:80px; margin-bottom:50px;">
 
 
  <div class="col-sm-12">  
    <div>
  <h2 class="text-primary text-center">Lead Report For Duration</h2>
</div> 
  <div>
  
  <form method="post"  style="margin-left:7%;">
  <div class="row">
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
</div>	  
</form>

<?php
if(isset($_POST['searchbttn']))
{
	//$date=substr($_POST['searchtext'],0,10);
	$date1=$_POST['searchtext1'];
	$date1.=" 00:00:00";
	$date2=$_POST['searchtext2'];
	$date2.=" 00:00:00";
	$dtm=$date1." ".$date2;
	//echo "<h5>Requested Date:<b> ".$date1." To ".$date2."</b></h5>";
	
	$sql_qry = "select qry_status, count(qry_status) as count from lead_log where req_dtm between '".$date1."' and '".$date2."' group by qry_status " ;
//	echo $sql_qry. "<br>" ;
	$qry=mysqli_query($conn,$sql_qry) ;

	$qry1= "SELECT qry_source, count(qry_source) as count1 FROM lead_log WHERE req_dtm between '".$date1."' and '".$date2."' group by qry_source" ;
	//echo $qry1 ;
	$qry2=  "SELECT qry_source, COUNT(qry_source) as 'Registered' FROM lead_log WHERE req_dtm between '".$date1."' and '".$date2."' and qry_status='Registered' group by qry_source" ;
	$data=mysqli_query($conn,$qry1) ;
	$data1=mysqli_query($conn,$qry2) ;
	
	$tot = "SELECT SUM(count) FROM (SELECT COUNT(qry_status) AS count FROM lead_log where req_dtm between '".$date1."' and '".$date2."') as A";
	$total = mysqli_query($conn, $tot) ;
	$row = mysqli_fetch_assoc($total);
	
	
?>
<div class="col-md-1"></div>
<!-- Report - Query Status Wise -->
<div class="col-md-5">
<table class="table table-striped" style="margin-top:10px">
    <thead>
      <tr>
        <th>Query Status</th>
		<th>Total</th>
      </tr>
    </thead>
    <tbody>
	
	<?php 

	
	if(isset($qry))
	{
	while($rec=mysqli_fetch_array($qry))
{ ?>

      <tr>
	   
        <td><?php   echo $rec['qry_status']; ?></td>
		<td><?php if(isset($rec['count'])){ echo $rec['count'] ; } ?></td>
		</tr>
		<?php  }  }  
		echo "Total Leads : <b>".array_sum($row)."</b>";
		?>
    </tbody>
  </table>
</div>

<!-- Report - Query Source Wise. -->

<div class="col-md-5">
<table class="table table-striped" style="margin-top:49px">
    <thead>
      <tr>
        <th>Query Source</th>
		<th>Total</th>
		<th>Registered</th>
		<th>View</th>
      </tr>
    </thead>
    <tbody>
	
    
	   <?php
	if(isset($data))
	{
	while($rec=mysqli_fetch_array($data))
	{	
		$source = $rec['qry_source'];
	?>  <tr>
		<td><?php if(isset($rec['qry_source'])){ echo $rec['qry_source']; } ?></td>
		<td><?php if(isset($rec['count1'])){ echo $rec['count1']; } ?></td>
		<td><?php $cnt = getRegisteredNumForQrySource($conn,$source, $date1, $date2 ); echo $cnt; ?></td>
		<td>
				
					<input type="submit" class="btn btn-primary " name="view" value="View" onclick="getDetails('<?php echo $source ; ?>', '<?php echo $date1 ; ?>','<?php echo $date2 ; ?>')"/>
				
		</td>
<?php  } }

 }

 ?> 
		  
    </tbody>
  </table>
</div>
</div>

 
 
  </div>  
  </div>
  </div>
  </div>
 <div id="lead_reg" name="lead_reg">
 
 <script>
 function getDetails(var1,var2,var3)
 {
$.ajax({
	method: "POST",
	data:  { qry_src : var1, date1: var2, date2:var3 },
	url : "ajax_lead_report_reg.php",
	success: function(result)
	{
		$("#lead_reg").html(result)
	}
	 });
 }
 </script>
  
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
  <?php
  function getRegisteredNumForQrySource( $con1,  $query_source,  $dt1,  $dt2){
	$sql_qry = "SELECT COUNT(*) as 'Registered' FROM lead_log WHERE req_dtm between '".$dt1."' and '".$dt2."' and qry_source='$query_source' and qry_status like 'Registered'";
	$fetch = mysqli_query($con1, $sql_qry) ;
	$row= mysqli_fetch_row($fetch) ;
	$cnt =$row[0] ;
	return $cnt ;
  }
  ?>