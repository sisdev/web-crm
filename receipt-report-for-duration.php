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
<title><?php echo $pkg_name; ?>-Lead Report For Duration</title>
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
 #no-more-tables table,{
    word-wrap: break-word;
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
  
  
 
 
    <div style="margin-top:101px;">
  <h2 class="text-primary text-center" style="margin-right:1%;">Receipt Report For Duration</h2>
</div> 
  
  
  <form method="post" style="width:60%; margin-left:22%;" >
  <div class="row">
  <div class="col-sm-1">
  <h4><strong> From: </strong></h4>
   </div>
 <div class="col-sm-4">
      <div class="input-group input-append date" id="datePicker">     
      <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
      <input class="form-control" required=required placeholder="yyyy-mm-dd" name="searchtext1" id="datepick1" type="text" autocomplete="off" value="<?php if(isset($_POST['searchtext1'])){ echo substr($_POST['searchtext1'],0,10);}?>">
            </div>
      </div>
		
		<div class="col-sm-1">
		<h4><strong> To: </strong></h4>
		</div>
		<div class="col-sm-4">
      <div class="input-group input-append date" id="datePicker">     
      <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
      <input class="form-control" required=required placeholder="yyyy-mm-dd" name="searchtext2"  id="datepick2" type="text"
       autocomplete="off" value="<?php if(isset($_POST['searchtext2'])){ echo substr($_POST['searchtext2'],0,10);}?>">
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
	$date2=$_POST['searchtext2'];
	
	$bymode = "SELECT rct_mode, SUM(amt_receipt) as sum, COUNT(*) AS count FROM tbl_receipt where rct_date between '".$date1."' and '".$date2."' group by rct_mode";
	//echo $bymode ;

	$sum= mysqli_query($conn, $bymode);
	$tot_amt = 0 ;
	$tot_cnt = 0;
	while($rw = mysqli_fetch_row($sum))
	{
	 $amt_rct = $rw[1] ;
	 $cnt_rct = $rw[2] ;
  echo "<b>".$rw[0]."</b>";
  echo "(".$cnt_rct."):";
  echo $amt_rct;
  echo "&nbsp;&nbsp;&nbsp;&nbsp;";
	$tot_amt = $tot_amt + $amt_rct ;
	$tot_cnt = $tot_cnt + $cnt_rct ;
 	}

	echo "&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "Total(".$tot_cnt.") : <b>".$tot_amt."</b>";
?>
<div id="no-more-tables">
<table class="table table-bordered table-stripped table-responsive table-condensed" style="text-align:center; margin-bottom:50px;" id="myTable">

    <thead>
      <tr>
        <th>#</th>
        <th>Receipt No</th>
        <th>Registration No</th>
		<th>Date</th>
		<th>Amount Receipt</th>
		<th>Payment Mode</th>
		<th>Bank Name</th>
		<th>Inst No</th>
		<th>Inst Date</th>
		<th>Narration</th>
		<th>Update</th>
      </tr>
    </thead>
   <?php
  
 
	$result=mysqli_query($conn,"select * from tbl_receipt where rct_date between '".$date1."' and '".$date2."' order by rct_no desc" );
	


    
$j=1;
   
          while($row = mysqli_fetch_array($result))
           {
			 
?>
		<tbody>
            <tr>
			<td data-title="#"><?php echo $j ?></td>
			<td data-title="Receipt No"><?php echo $row['rct_no'] ?></td>
			<td data-title="Registration No"><?php echo $row['reg_no'] ?></td>
			<td data-title="Date"><?php echo $row['rct_date'] ?></td>
			<td data-title="Amount Receipt"><?php echo $row['amt_receipt'] ?></td>
			<td data-title="Payment Mode"><?php echo $row['rct_mode'] ?></td>
			<td data-title="Bank Name"><?php echo $row['inst_bank_name'] ?></td>
			<td data-title="Inst No"><?php echo $row['inst_num'] ?></td>
			<td data-title="Inst Date"><?php echo $row['inst_date'] ?></td>
			<td data-title="Narration"><?php echo $row['narr_txt'] ?></td>
			<td data-title="Update" style="height:50px;">
			<?php $row_id = $row['id'] ; ?> 
				<form action = "receipt-update-record.php" method="POST" >
					<input type = "hidden" name ="update_id" value ="<?php echo $row_id  ; ?>"/>
					 <input type="submit" class="btn btn-warning" value="Update"/>
				</form></td>
			</tr>
<?php		
$j++;	
   }
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