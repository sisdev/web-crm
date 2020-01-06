
 <?php 
 ob_start();
session_start();
include 'include/dbi.php';
include 'include/session.php';
include 'include/param.php';

checksession();
 $qry_source= $_POST["qry_src"];
 $date1=$_POST["date1"];
 $date2=$_POST["date2"];
 $querysel="select req_dtm, name, qry_details, qry_status from lead_log where qry_source='$qry_source' and qry_status='Registered' and req_dtm between '$date1' and '$date2'";
 $query=mysqli_query($conn,$querysel); 
 //echo $querysel;		
  ?>
	
	<div class="col-md-7" style="margin-left:345px; margin-bottom:50px; margin-top:-65px;">
	<h3 class="text-primary text-center " > Registered Users</h3>
	<table class="table table-striped" id="lead_reg_table">
 
    <thead>
      <tr>
        <th>Query Date</th>
        <th>Name</th>
        <th>Course</th>
		 <th>Query Status</th>
      </tr>
    </thead>
	
    <tbody>
	<?php 
	
	if($query)
	{
	while($fetch=mysqli_fetch_array($query))
	{
	?>
      <tr>
  
        <td><?php echo substr($fetch['req_dtm'],0,10)."--".substr($fetch['req_dtm'],10,10);?></td>
        <td><?php echo $fetch['name']; ?></td>
		<td><?php echo $fetch['qry_details']; ?></td>
		<td><?php echo $fetch['qry_status']; ?></td>
      </tr>
     
	  <?php } } 
	?>
    </tbody>
	
	 
		 </table>
		 </div>
	