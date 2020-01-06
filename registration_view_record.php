<?php
	error_reporting(1);
	session_start();
	include 'include/dbi.php';
	include 'include/session.php';
	checksession();
	$id=$_GET['view_id'];

	$selectsql="select * from user_profile where id = '$id'";
	$rs = mysqli_query($conn,$selectsql);
	$rows=mysqli_fetch_array($rs);

	//$cur_date = date("Ym");
	//$pre_batch = "SIS$cur_date/";
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

<!-- Include Date Range Picker -->



        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Registration View Record</title>
        <link rel="icon" type="image/png" href="images/icon.png" />
        <!--<link href="css/datetimepicker.css" rel="stylesheet" type="text/css">-->
       
		<script type="text/javascript">
		 function course_reg_new(){
			 alert("New course registered successfully.");
		 }
		</script>
        
    </head>
    <body style="background-color:#ccf2ff">
	<div class ="container-fluid" >   	<!-- body -->
	<div>
		<?php include 'header.inc.php'; ?>
	</div>
	  
	<div class="row" style="margin-top:100px;">
		<div class="col-md-2">
			<ul class="pager">
			<li class="previous"><a style="border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);" href="registration_query.php"><< Back</a></li>
			</ul>
		</div>
		<div class="col-md-8">
				<h2 class="text-primary text-center">View -Registration Records</h2>
	 
		</div>
	</div>
	
<form class="form-horizontal" style="margin-left:18%; width:60%;" method="POST" onSubmit="return validateForm(this)">
	<div class="form-group row">
	<label class="control-label col-md-2 "  for="id">Profile ID<span style="color:red">*</span></label>  
	<div>
	<input name="id" class="form-control-static col-md-4" type="text" readonly value="<?php echo $rows['id']; ?>"/>
	</div>
	<label class="control-label col-md-2"  for="reg_id">Registration ID<span style="color:red">*</span></label>  
	<div>
	<input  name="reg_id" class="form-control-static col-md-4" type="text" readonly value="<?php echo $rows['reg_id']; ?>"/>
	</div>
	</div>
	 
	<div class="form-group row">
  <label class="control-label col-md-2"  for="u_name">Name<span style="color:red">*</span></label>  
  <div>
	<input  name="u_name" class="form-control-static col-md-4" readonly type="text" value="<?php echo $rows['name']; ?>">
  </div>
  <label class="control-label col-md-2"  for="u_fname">Father's Name<span style="color:red">*</span></label>  
  <div>
	<input  name="u_fname" class="form-control-static col-md-4" type="text" readonly value="<?php echo $rows['father_name']; ?>">
  </div>
</div>

<div class="form-group row">
  <label class="control-label col-md-2"  for="u_dob">Date of Birth<span style="color:red">*</span></label>  
  <div>
	<input  name="u_dob" class="form-control-static col-md-4" type="date" readonly value="<?php echo $rows['dob']; ?>">
  </div>
  <label class="control-label col-md-2" for="u_gender">Gender<span style="color:red">*</span></label>
  <div>
  <input  name="u_gender" class="form-control-static col-md-4" type="text" readonly value="<?php echo $rows['gender']; ?>"> 
</div> 
</div>

 <div class="form-group row">
 <label class="control-label col-md-2" for="m_status">Marital Status<span style="color:red">*</span></label>
  <div>
  <input  name="m_status" class="form-control-static col-md-4" type="text" readonly value="<?php echo $rows['marital_status']; ?>">  
</div>
<label class="control-label col-md-2"  for="u_country">Nationality:<span style="color:red">*</span></label>  
  <div>
	<input  name="u_country" class="form-control-static col-md-4" type="text" readonly value="<?php echo $rows['citizen_country']; ?>">
  </div>
</div> 

<div class="form-group row">
  <label class="control-label col-md-2"  for="u_email">E-mail ID<span style="color:red">*</span></label>  
  <div>
	<input  name="u_email" class="form-control-static col-md-4" type="email" readonly value="<?php echo $rows['email']; ?>">
  </div>
   <label class="control-label col-md-2"  for="u_mob_primary">Mobile No<span style="color:red">*</span></label>  
  <div>
	<input  name="u_mob_primary" class="form-control-static col-md-4" type="text" maxlength="10" pattern="[0-9]{10}" readonly value="<?php echo $rows['phone_main']; ?>">
  </div>
</div>

<div class="form-group row">
  <label class="col-md-2 control-label" for="u_caddress">Current Address<span style="color:red">*</span></label>  
  <div>
	<textarea name="u_caddress" class="form-control-static col-md-4" readonly><?php echo $rows['cur_add']; ?></textarea>
  </div>
  <label class="col-md-2 control-label" for="u_paddress">Permanent Address<span style="color:red">*</span></label>  
  <div>
	<textarea name="u_paddress" class="form-control-static col-md-4" readonly><?php echo $rows['perm_add']; ?></textarea>
  </div>
</div>

<div class="form-group row">
  <label class="col-md-2 control-label" for="u_qualification">Educational Qualification<span style="color:red">*</span></label>  
  <div>
	<textarea name="u_qualification" class="form-control-static col-md-4" readonly><?php echo $rows['qualification']; ?></textarea>
  </div>
  <label class="col-md-2 control-label" for="u_experience">Professional Experience<span style="color:red">*</span></label>  
  <div>
	<textarea name="u_experience" class="form-control-static col-md-4" readonly><?php echo $rows['experience']; ?></textarea>
  </div>
</div>
<div class="col-sm-4" style="margin-left:43%;"><button type="button" style="border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);" class="btn btn-primary" data-toggle="modal" data-target="#reg_follow">Add New Course</button></div><br><br><br>
</form>
	<!-- Follow Up-->
	<div class="modal fade" id="reg_follow" role="dialog">
	<form class="form-horizontal" method="post" onSubmit="return course_reg_new();">
		<div class="modal-dialog">
						
						<!-- Follow Up content-->
						  
						<div class="modal-content">
							<div class="modal-header" style='background-color:#428bca; color:white;'>
								<button type="button" class="close" style='font-size:38px; color:white;' data-dismiss="modal">&times;</button>
								<h3 class="modal-title" align='center'>Course Registration</h3>
							</div>
						
							<div class="modal-body">
							
	<div style="margin-left:20px;">					
	<div class="form-group row">
	<label class="control-label col-md-3"  for="reg_date">Registration Date<span style="color:red">*</span></label>  
	<div class="col-md-7">
	<input name="reg_date" required=required class="form-control input-md" type="datetime" value="<?php echo date('Y-m-d'); ?>">
	</div>
	</div>
	
	<div class="form-group row">
	<label class="control-label col-md-3"  for="reg_date">Registration ID<span style="color:red">*</span></label>  
	<div class="col-md-7">
	<input name="reg_id" required=required class="form-control input-md" type="text">
	</div>
	</div>
	
	<div class="form-group row">
	<label class="control-label col-md-3"  for="reg_batch_id">Batch ID<span style="color:red">*</span></label>  
	<div class="col-md-7">
	<input  name="reg_batch_id" required=required class="form-control input-md" type="text">
	</div>
	</div>
	
	<div class="form-group row">
	<label class="control-label col-md-3"  for="reg_courseName">Course Name<span style="color:red">*</span></label>  
	<div class="col-md-7">
	<input  name="reg_courseName" required=required class="form-control input-md" type="text">
	</div>
	</div>
	
	<div class="form-group row">
	<label class="control-label col-md-3"  for="reg_courseName">Course Fee<span style="color:red">*</span></label>  
	<div class="col-md-7">
	<input type="number" name="reg_courseFee" required=required class="form-control input-md">
	</div>
	</div>
	
	<div class="form-group row">
	<label class="control-label col-md-3"  for="reg_courseName">Payment Status<span style="color:red">*</span></label>  
	<div class="col-md-7">
	<input type="text" name="reg_paymentStatus" required=required class="form-control input-md">
	</div>
	</div>
	
	<div class="form-group" style="margin-left:30%;">
  <label class=" control-label" for="reg_btn"></label>
  <div>
    <input type="submit" name="reg_btn" class="btn btn-primary" style="border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);" value="Registration"/>
    <button type="button" class="btn btn-warning" style="border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);"  data-dismiss="modal">Close</button>
	</div>
</div>
</div>
</div>
</div>
</div>
	</div>
	</form>	
	
	
	
	
	
			<?php
				if(isset($_POST['reg_btn']))
				{
					if($id==$rows['id'])
					{
						$user_name=$rows['email'];
					}
					$reg_date=$_POST['reg_date'];
					$reg_id=$_POST['reg_id'];
					$reg_batch_id=$_POST['reg_batch_id'];
					$reg_courseName=$_POST['reg_courseName'];
					$reg_courseFee=$_POST['reg_courseFee'];
					$reg_paymentStatus=$_POST['reg_paymentStatus'];
					
					mysqli_query($conn,"insert into trng_enroll (user_name,reg_id,batch_id,course_name,course_fee,payment_status,enroll_dtm,user_profile_id,enroll_ip) 
					values('$user_name','$reg_id','$reg_batch_id','$reg_courseName','$reg_courseFee','$reg_paymentStatus','$reg_date','$id','.$_SERVER[REMOTE_ADDR].')")  or die(mysqli_error($conn));
					
					$last_id = mysqli_insert_id();
					//$batch_id = $pre_batch.$last_id;
					//mysql_query("update trng_enroll set batch_id = '$batch_id' where enroll_id='$last_id'");
				}
			?>

			<?php 
				$querysel="select * from trng_enroll where user_profile_id='$id' order by enroll_dtm desc ";
				$query=mysqli_query($conn,$querysel);
				$count_row=mysqli_num_rows($query);
				if($count_row >1 || $count_row ==1)
				{
			?>
					
				
			<h2 class="text-primary text-center">Course Registration</h2>
			<table class="table table-responsive table-stripped table-condensed">
						
						<thead>
							<tr>
								<th>#</th>
								<th>Enroll Date</th>
								<th>Registration ID</th>
								<th>User Profile ID</th>
								<th>Batch ID</th>
								<th>Course Name</th>
								<th>Course Fee</th>
								<th>Payment Status</th>
								<th>Modify</th>
								<th>Delete</th>
							</tr>
						</thead>
						<tbody>
			<?php 
						$count=1;
	
						while($fetch=mysqli_fetch_array($query))
						{
			?>
							<tr>
								<td align="center"><?php echo $count; ?></td>
								<td><?php echo substr($fetch['enroll_dtm'],0,10);?></td>
								<td><?php echo $fetch['reg_id']; ?></td>
								<td><?php echo $fetch['user_profile_id']; ?></td>
								<td><?php echo $fetch['batch_id']; ?></td>
								<td><?php echo $fetch['course_name']; ?></td>
								<td align="center"><?php echo $fetch['course_fee']; ?></td>
								<td><?php echo $fetch['payment_status']; ?></td> 
								<td>
									<a class="btn btn-warning btn-sm" style="border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);" name="mod_follow" href="registration_course_upd.php?view_id=<?php echo $_GET['view_id']; ?>&mod_id=<?php echo $fetch['enroll_id']; ?>" >Modify</a>  
								</td>
								<td> 
									<script>
										function delete_follow()
										{
											var del=confirm("Are you sure you want to delete this record?");
											if (del==true){
												return true;
											}
											else
											{
												return false;
											}
										}
									</script>
									<?php 
										if(isset($_GET['del_val']))
										{
											mysqli_query($conn,"delete from trng_enroll where enroll_id='".$_GET['del_val']."'");
											header("Refresh:0; url=registration_view_record.php?view_id=".$_GET['view_id']);
										}
									?>
										<a class="btn btn-danger btn-sm"  style="border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19); text-decoration: none;" onclick="return delete_follow()" name="del_follow" href="registration_view_record.php?view_id=<?php echo $_GET['view_id']; ?>&del_val=<?php echo $fetch['enroll_id']; ?>"   >Delete</a>  
								</td>
		
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