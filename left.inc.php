<?php 
ob_start();
include 'include/dbi.php';

$uName = $_SESSION["login"];
date_default_timezone_set('Asia/Kolkata');
$date = date("Y-m-d"); 
$alert_query=mysqli_query($conn,"SELECT COUNT(assigned_user) FROM `mytasks` where assigned_user='$uName' AND SUBSTR(datetime,1,10)<='$date' AND status='New'");
$row = mysqli_fetch_array($alert_query);
$count=$row['COUNT(assigned_user)'];
?>
<script>
 $(document).ready(function(){
	 var count=<?php echo $count; ?>;
	if(count>0){
	 $(".badge").css("background-color", "red");
	}
	else
	{
		$(".badge").css("background-color", "green");
	}
});
</script>

<div class="panel panel-primary" >
<div class="panel-heading">Admin Options</div>
			<div class="panel-body">
<?php
$sql="SELECT * FROM tbl_admin where username='$uName'";
$result=mysqli_query($conn, $sql);
$r = mysqli_fetch_array($result);
if($r['role'] == 'admin')
{
  echo "<h4 style='color:black;'>Lead Management</h4>	 	  			  
					<a href='training_lead_add.php'>Add Leads</a><br/>			  
					<a href='training_lead_view_all.php'>Manage Leads</a>
					<h4 style='color:black;'>Reports</h4>			  
					<a href='training_lead_daily_report.php' >Daily Report Status</a><br>
					<a href='lead_report_for_duration.php' >Lead Report For Duration</a>
					
					<h4 style='color:black;'>My Tasks</h4>			  
					<a href='mytask.php' >My Pending Tasks<span class='badge' style='margin-left:2px;'>$count</span></a><br>
					<a href='all-tasks.php' >All Tasks</a><br>
					<h4 style='color:black;'>Manage Contact</h4>	
					<a href='contact-manage.php'>Manage Contact</a><br>
					<hr style='border-top: 1px solid blue;'>
				
				<h4 style='color:black;'>SMS Campaign</h4>
					<a href='sms-send.php'>Send SMS(Single)</a><br/>
					<a href='sms-send-multiple.php'>Send SMS(Multiple)</a><br/>
					<a href='sms-manage.php'>Manage SMS Template</a><br/>
					<a href='sms-log.php'>View SMS Log</a><br/>
					
				<h4 style='color:black;'>E-Mail Campaign</h4>
					<a href='mail-send.php'>Send Mail(Single)</a><br/>
					<a href='mail-send-multiple.php'>Send Mail(Multiple)</a><br/>
					<a href='mail-manage.php'>Manage Mail Template</a><br/>
					<a href='mail-log.php'>View Mail Log</a><br/>
					<hr style='border-top: 1px solid blue;'>
				<h4 style='color:black;'>Trainers </h4>	 
					<a href='trainer_add.php'>Add Trainer</a><br/>
					<a href='trainers.php'>Manage Trainer</a><br/>	
				<h4 style='color:black;'>Batches </h4>
					<a href='add_batch.php'>Add Batch</a><br/>
					<a href='admin_view_batch.php'>Manage Batch</a><br/>
					<hr style='border-top: 1px solid blue;'>
				
				<h4 style='color:black;'>Products </h4>
					<a href='product-item-add.php'>Add Product Item</a><br/>
					<a href='product-item-manage.php'>Manage Product Item</a><br/>
					<a href='product-group-add.php'>Add Product Group</a><br/>
					<a href='product-group-manage.php'>Manage Product Group</a><br/>
					
					<h4 style='color:black;'>Enrollments</h4>
					<a href='add-user.php'>Add User</a><br/>
					<a href='manage-user.php'>Manage User</a><br/>
					<a href='add-registration.php'>Add Registration</a><br/>
					<a href='manage-registration.php'>Manage Registration</a><br/>
					<a href='user_profile.php'>User Registration</a><br/>
					<a href='registration_query.php'>Manage User Registration</a>
				<h4 style='color:black;'>Receipts</h4>
					<a href='receipt-add.php'>Add Receipt</a><br/>
					<a href='receipt-report-for-duration.php'>Manage Receipt</a>
				<h4 style='color:black;'>Sales Resource</h4>
					<a href='sales-resource.php'>Manage Sales/Resource</a><br/>
					<a href='sales-resource-activity.php'>Sales/Resource Activity</a><br/>
					
			<!--	<h4>Jobs </h4>	 
					<a href='../../rct_listJobs.php' target='_blank'>View Jobs</a><br/>
					<a href=''>Approve Jobs</a><br/>	-->		 
";
}
else if($r['role'] == 'manager' || 'executive')
{
  echo "<h4 style='color:black;'>Lead Management</h4>	 	  			  
					<a href='training_lead_add.php'>Add Leads</a><br/>			  
					<a href='training_lead_view_all.php'>Manage Leads</a>
				<h4 style='color:black;'>Enrollments</h4>
					<a href='user_profile.php'>User Registration</a><br/>
					<a href='registration_query.php'>Manage Registration</a>
				<h4 style='color:black;'>SMS </h4>
					<a href='sms-send.php'>Send SMS(Single)</a><br/>
					<a href='sms-send-multiple.php'>Send SMS(Multiple)</a><br/>
					<a href='sms-manage.php'>Manage SMS</a><br/>
				<h4 style='color:black;'>Reports</h4>			  
					<a href='training_lead_daily_report.php' >Daily Report Status</a><br>
					<a href='lead_report_for_duration.php' >Lead Report For Duration</a>
				<h4 style='color:black;'>E-Mail </h4>
					<a href='mail-send.php'>Send Mail(Single)</a><br/>
					<a href='mail-send-multiple.php'>Send Mail(Multiple)</a><br/>
					<a href='mail-manage.php'>Manage Mail</a><br/>";
}
else
{
	echo " ";
}

?>					
		</div>
		
</div>


