<?php
ob_start();
session_start();
include 'include/dbi.php';
include 'include/session.php';
//checksession();
?>
<html>
<head>
<meta charset="utf-8">
<title>Daily Lead Report</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
<script src="js/jquery.timepicker.js" type="text/javascript"></script> 
<script src="js/jquery-2.2.0.min.js" type="text/javascript"></script> 
<script src="js/jquery-ui.js" type="text/javascript"></script> 
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="icon" type="image/png" href="images/icon.png" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
  </head>
  
  <body style="background-color:#ccf2ff">

  <div class="container col-md-12">
  
  <div>
  <?php include("header.inc.php"); ?>
  </div>
 <div class="row" style="margin-top:100px;">
 
 
  <div class="col-sm-12">  
    <div>
  <h2 class="text-primary text-center" >Lead Report -Daily</h2>
</div> 
  <div>
  <form method="post"  style="margin-left:20%;">
  <div class="row">
  <div class="col-md-4">
	<select class="form-control" name="uname">
					<?php 
					echo "<option value='All'>All</option>" ;
					$qry = "SELECT username, name FROM `tbl_staff`" ;
					$qry_crtd = mysqli_query($conn, $qry) ;
					while($row=mysqli_fetch_array($qry_crtd))
					{	
						$username=$row['username'];
						$name=$row['name'];
						echo "<option value='$username'>$name</option>" ;
					}
					if(isset($_POST['uname'])){ echo "<option value='' selected='selected'>".$_POST['uname']."</option>";}
					?>
		</select>
	</div>
	<div class="col-md-4">
    <div class="input-group input-append date" id="datePicker">     
    <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
		<input class="form-control" required=required placeholder="yy-mm-dd" name="searchtext" id="datepick" type="text" value="<?php if(isset($_POST['searchtext'])){ echo substr($_POST['searchtext'],0,10);}?>">
    </div>	
    </div>
	 
	<div class="col-md-3">
	   <input type="submit" name="searchbttn" class="btn btn-info" value="Search" />
    </div>
    </div>
	  
</form>
<?php
if(isset($_POST['searchbttn']))
{
	//$date=substr($_POST['searchtext'],0,10);
	$n=$_POST['uname'];
	$date=$_POST['searchtext'];
	$date.="%";
	if($n=='All')
	{
	$q="select id,name,qry_type,qry_source, qry_details,created_by from lead_log where req_dtm like '".$date."'";
	//echo $q;
	}
	else
	{
		
		$q="select id,name,qry_type,qry_source, qry_details,created_by from lead_log where req_dtm like '".$date."' AND created_by='$n'";
	}
	//echo $q;
	$qry=mysqli_query($conn,$q);
	if($n=='All')
	{
		$qr="select name,qry_type,qry_source,qry_details, followup_text,req_dtm,followup_user from lead_log l1, lead_followup l2 where l2.followup_dtm like '".$date."' and l1.id=l2.trng_query_id order by l1.req_dtm desc";
	}
	else
	{
		$qr="select name,qry_type,qry_source,qry_details, followup_text,req_dtm,followup_user from lead_log l1, lead_followup l2 where l2.followup_dtm like '".$date."' and l1.id=l2.trng_query_id and l2.followup_user='$n' order by l1.req_dtm desc";
	}
	//echo $qr;
	$data=mysqli_query($conn,$qr);	
	?>
<table class="table table-striped" style="margin-top:30px">
    <thead>
      <tr>
	    <th>Source</th>
        <th>Query Date</th>
        <th>Name</th>
        <th>Query Type</th>
        <th>Course</th>
        <th>Created By</th>
      </tr>
    </thead>
    <tbody>
	
	<?php 
	$total=0;
	while($rec=mysqli_fetch_array($qry))
{
	//header("Content-type: application/vnd-ms-excel");

//header("Content-Disposition: attachment; filename=file_report.xls");
	?>
      <tr>
	      <td><?php echo $rec['qry_source']; ?></td>
        <td><?php echo substr($_POST['searchtext'],0,10); ?></td>
        <td><?php echo $rec['name']; ?></td>
        <td><?php echo $rec['qry_type']; ?></td>
        <td><?php echo $rec['qry_details']; ?></td>		
        <td><?php echo $rec['created_by']; ?></td>		
    

 
      </tr>
	  
	
<?php $total++; }
echo "<h4>Requested Date: ".substr($_POST['searchtext'],0,10)."</h4>";
echo "New Leads Today : <b>".$total."</b>";
  ?>
  
    </tbody>
  </table>

     
  <table class="table table-striped" style="margin-top:30px">
    <thead>
      <tr>
        <th>Query Date</th>
        <th>Name</th>
        <th>Query Type</th>		
        <th>Course</th>
        <th>Follow Ups</th>
        <th>Created By</th>

      </tr>
    </thead>
    <tbody>
	<?php 


	$total=0;
	while($rec=mysqli_fetch_array($data))
{
	//header("Content-type: application/vnd-ms-excel");

//header("Content-Disposition: attachment; filename=file_report.xls");
	?>
      <tr>
        <td><?php echo substr($rec['req_dtm'],0,10); ?></td>
        <td><?php echo $rec['name']; ?></td>
        <td><?php echo $rec['qry_type']; ?></td>
        <td><?php echo $rec['qry_details']; ?></td>
        <td><?php echo $rec['followup_text']; ?></td>
        <td><?php echo $rec['followup_user']; ?></td>
      </tr>
<?php $total++; }
echo "Follow ups Today : <b>".$total."</b>";
 } ?>
    </tbody>
  </table>
  </div>
  </div>
  </div>
  <div style="left:0; right:0; position:absolute;"><?php include("footer.inc.php"); ?></div>
</div>
  </body>
  <script>
  $(document).ready(function(){
	  $(window).load(function(){
			   $("#datepick").datepicker({
				   format: 'yyyy-mm-dd'
		  
	  });

	  $("#datepick").click(function(){
		
		$(this).datepicker({Format: 'yyyy-mm-dd'});
	});
  });
  });
  </script>
  </html>