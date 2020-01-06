<?php
	error_reporting(1);
	session_start();
	include 'include/dbi.php';
	include 'include/session.php';
	include 'include/param.php';
	checksession();
	$id=$_GET['view_id'];
	$selectsql="select * from user_profile where id = '$id'";
	$rs = mysqli_query($conn,$selectsql);
	$rows=mysqli_fetch_array($rs);
?>

<html>
 <head>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="js/jquery-2.2.0.min.js" type="text/javascript"></script> 
  <link rel="stylesheet" type="text/css" href="css/jquery.timepicker.css">
<link rel="stylesheet" type="text/css" href="css/jquery-ui.css">

<script src="js/jquery-ui.js" type="text/javascript"></script> 



        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>View Customer Records</title>
        <link rel="icon" type="image/png" href="images/icon.png" />
    

<script>
    $(document).ready(function(){
	

	if($("#cust_type").val() == "Individual")
	{
		$(".corporate_text").hide();
		$(".individual_text").show();
		$(".form-horizontal").css('margin-bottom','60px');
		
	}
	else{
		$(".corporate_text").show();
		$(".individual_text").hide();
		$(".form-horizontal").css('margin-bottom','50px');
	}	
	}) ; 
</script>   
        
    </head>
    <body style="background-color:#ccf2ff">
	<div class ="container-fluid" >   	<!-- body -->
	<div>
		<?php include 'header.inc.php'; ?>
	</div>
	  
	<div class="row" style="margin-top:80px;">
		<div class="col-md-2">
			<ul class="pager">
			<li class="previous"><a style="border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);" href="manage-user.php"><< Back</a></li>
			</ul>
		</div>
		<div class="col-md-8">
				<h2 class="text-primary text-center">View -Customer Records</h2>
	 
		</div>
	</div>
	
<form class="form-horizontal" style="margin-left:18%; width:60%;" method="POST">
	<div class="form-group row">
	<label class="control-label col-md-2 " for="id">Profile ID</label>  
	<div>
	<input name="id" class="form-control-static col-md-4" type="text" readonly value="<?php echo $rows['id']; ?>"/>
	</div>
	
	<label class="control-label col-md-2 " for="cust_type">Customer Type</label>  
	<div>
	<input name="cust_type" id="cust_type" class="form-control-static col-md-4" type="text" readonly value="<?php echo $rows['cust_type']; ?>"/>
	</div>
	</div>
	 
<div class="form-group row">
  <label class="control-label col-md-2" for="u_name">Name</label>  
  <div>
	<input  name="u_name" class="form-control-static col-md-4" readonly type="text" value="<?php echo $rows['name']; ?>">
  </div>

  <div class="individual_text" style="display:none;" >
  <label class="control-label col-md-2"  for="u_fname">Father's Name</label>  
  <div>
	<input  name="u_fname" class="form-control-static col-md-4" type="text" readonly value="<?php echo $rows['father_name']; ?>">
  </div>
  </div>

<div class="corporate_text">
  <label class="control-label col-md-2" for="comp">Company</label>  
  <div>
	<input  name="comp" class="form-control-static col-md-4" type="text" readonly value="<?php echo $rows['comp_name']; ?>">
  </div>
  </div>
</div>

<div class="corporate_text">
<div class="form-group row">
  <label class="control-label col-md-2" for="indus_seg">Segment</label>  
  <div>
	<input  name="indus_seg" class="form-control-static col-md-4" type="text" readonly value="<?php echo $rows['indus_seg']; ?>">
  </div>
   <label class="control-label col-md-2" for="indus_subseg">Subsegment</label>  
  <div>
	<input  name="indus_subseg" class="form-control-static col-md-4" type="text" readonly value="<?php echo $rows['indus_subseg']; ?>">
  </div>
</div>
</div>

<div class="individual_text" style="display:none;" >
<div class="form-group row">
  <label class="control-label col-md-2" for="u_dob">Date of Birth</label>  
  <div>
	<input  name="u_dob" class="form-control-static col-md-4" type="date" readonly value="<?php echo $rows['dob']; ?>">
  </div>
  <label class="control-label col-md-2" for="u_gender">Gender</label>
  <div>
  <input  name="u_gender" class="form-control-static col-md-4" type="text" readonly value="<?php echo $rows['gender']; ?>"> 
</div> 
</div>

 <div class="form-group row">
 <label class="control-label col-md-2" for="m_status">Marital Status</label>
  <div>
  <input  name="m_status" class="form-control-static col-md-4" type="text" readonly value="<?php echo $rows['marital_status']; ?>">  
</div>
<label class="control-label col-md-2" for="u_country">Nationality</label>  
  <div>
	<input  name="u_country" class="form-control-static col-md-4" type="text" readonly value="<?php echo $rows['citizen_country']; ?>">
  </div>
</div> 
</div>

<div class="form-group row">
  <label class="control-label col-md-2" for="u_email">E-mail ID</label>  
  <div>
	<input  name="u_email" class="form-control-static col-md-4" type="email" readonly value="<?php echo $rows['email']; ?>">
  </div>
   <label class="control-label col-md-2" for="u_mob_primary">Mobile No</label>  
  <div>
	<input  name="u_mob_primary" class="form-control-static col-md-4" type="text" maxlength="10" pattern="[0-9]{10}" readonly value="<?php echo $rows['phone_main']; ?>">
  </div>
</div>

<div class="form-group row">
<div class="corporate_text">
<label class="control-label col-md-2" for="gst">GST No</label>  
  <div>
	<input  name="gst" class="form-control-static col-md-4" type="text" readonly value="<?php echo $rows['gstin']; ?>">
  </div>
  </div>

  <label class="col-md-2 control-label" for="u_caddress">Current Address</label>  
  <div>
	<textarea name="u_caddress" class="form-control-static col-md-4" readonly><?php echo $rows['cur_add']; ?></textarea>
  </div>
  <div class="individual_text" style="display:none;" >
  <label class="col-md-2 control-label" for="u_paddress">Permanent Address</label>  
  <div>
	<textarea name="u_paddress" class="form-control-static col-md-4" readonly><?php echo $rows['perm_add']; ?></textarea>
  </div>
</div>
</div>

<div class="individual_text" style="display:none;" >
<div class="form-group row">
  <label class="col-md-2 control-label" for="u_qualification">Educational Qualification</label>  
  <div>
	<textarea name="u_qualification" class="form-control-static col-md-4" readonly><?php echo $rows['qualification']; ?></textarea>
  </div>
  <label class="col-md-2 control-label" for="u_experience">Professional Experience</label>  
  <div>
	<textarea name="u_experience" class="form-control-static col-md-4" readonly><?php echo $rows['experience']; ?></textarea>
  </div>
</div>
</div>


</form>
<?php 
				$querysel="select * from deal_log where user_profile_id='$id' order by enroll_dtm desc ";
				$query=mysqli_query($conn,$querysel);
				$count_row=mysqli_num_rows($query);
				if($count_row >1 || $count_row ==1)
				{
			?>
<h2 class="text-primary text-center">Orders</h2>
			<table class="table table-responsive table-stripped table-condensed">
						
						<thead>
							<tr>
								<th>#</th>
								<th><?php echo $order_date; ?></th>
								<th><?php echo $order_no; ?></th>
								<th><?php echo $product_name; ?></th>
								<th><?php echo $product_sn; ?></th>
								<th><?php echo $product_price; ?></th>
								<th>Payment Status</th>
							</tr>
						</thead>
						<tbody>
			<?php 
						$count=1;
	
						while($fetch=mysqli_fetch_array($query))
						{
			?>
							<tr>
								<td ><?php echo $count; ?></td>
								<td><?php echo substr($fetch['enroll_dtm'],0,10);?></td>
								<td><?php echo $fetch['reg_id']; ?></td>
								<td><?php echo $fetch['course_name']; ?></td>
								<td><?php echo $fetch['batch_id']; ?></td>
								<td ><?php echo $fetch['course_fee']; ?></td>
								<td><?php echo $fetch['payment_status']; ?></td> 
							</tr>
						<?php   $count++; 
						}
				} 			?>
				
						</tbody>
			</table>
</div>
		<div>
			<?php include("footer.inc.php");?>
		</div>		
		
</body>
</html>