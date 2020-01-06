<?php
ob_start();
session_start();

include 'include/dbi.php';
include 'include/session.php';
include 'include/param.php';

checksession();
$debug=true ;
$dtm=getLocalDtm();
$year=date("Y");
$qry = "SELECT SUBSTR(reg_id,6)+1 from deal_log ORDER BY enroll_id DESC LIMIT 1" ;
$sql = mysqli_query($conn, $qry);
$row = mysqli_fetch_array($sql);
$reg=$row['SUBSTR(reg_id,6)+1'];

if($year==$enroll_prefix)
{

	if($reg<10)
	{	
	$reg=$year."-0".$reg;
	}
	else
	{
		$reg=$year."-".$reg;
	}
}	
else
{
	$reg= $enroll_prefix."-"."01";
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Add Sales Deal</title>
<link rel="icon" type="image/png" href="images/icon.png" />
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- Include Date Range Picker -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
<!--Font Awesome (added because you use icons in your prepend/append)-->
<link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css" />
 
<script>
function validateForm()
{
	alert("Deal Added Successfully....");
}
</script>

<!--By Name-->
<script>
$(document).ready(function(){
	
	$("#name").keyup(function(){
		var getvalue=document.getElementById("name").value;
		$.post("search-by-name.php",
		{
			passvalue:getvalue
		},
		function(data, status){
			document.getElementById("place_name").innerHTML=data;
			var name_count = document.getElementById("name_option").length;
			if (name_count < 2) {
				document.getElementById("reg_id").readOnly = true;
				document.getElementById("reg_date").readOnly = true;
				document.getElementById("reg_batch_id").readOnly = true;
				document.getElementById("reg_courseFee").readOnly = true;
				document.getElementById("reg_courseName").readOnly = true;
				document.getElementById("reg_paymentStatus").readOnly = true;
			}
	});
});
});
</script>

<script>
function fetch(val)
{
 $.ajax({
 type: 'post',
 dataType: "text json",
 url: 'reg-json-name-text.php',
 data: {
  name:val
 },
 success: function (response) {
  document.getElementById("phone").value=response[0].phone_main;
  document.getElementById("user_profile_id").value=response[0].id;
  document.getElementById("name").value=response[0].name;
  document.getElementById("email").value=response[0].email;
  $('#place_name').css('display','none');
  document.getElementById("name").readOnly = true;
  document.getElementById("email").readOnly = true;
  document.getElementById("user_profile_id").readOnly = true;
  document.getElementById("phone").readOnly = true;
 }
 });
}
</script>

<!--By Phone-->
<script>
$(document).ready(function(){
	$("#phone").keyup(function(){
		var getval=document.getElementById("phone").value;
		$.post("search-by-phone.php",
		{
			passval:getval
		},
		function(data, status){
			console.log(data);
					document.getElementById("place_phone").innerHTML=data;	
			var phone_count = document.getElementById("phone_option").length;
			if (phone_count < 2) {
				document.getElementById("reg_id").readOnly = true;
				document.getElementById("reg_date").readOnly = true;
				document.getElementById("reg_batch_id").readOnly = true;
				document.getElementById("reg_courseFee").readOnly = true;
				document.getElementById("reg_courseName").readOnly = true;
				document.getElementById("reg_paymentStatus").readOnly = true;
			}
	});	
});
});
</script>

<script>
function fetch_select(val)
{
 $.ajax({
 type: 'post',
 dataType: "text json",
 url: 'reg-json-phone-text.php',
 data: {
  phone:val
 },
 success: function (response) {
  document.getElementById("name").value=response[0].name;
  document.getElementById("phone").value=response[0].phone_main;
  document.getElementById("user_profile_id").value=response[0].id;
  document.getElementById("email").value=response[0].email;
  $('#place_phone').css('display','none'); 
  document.getElementById("name").readOnly = true;
  document.getElementById("email").readOnly = true;
  document.getElementById("user_profile_id").readOnly = true;
  document.getElementById("phone").readOnly = true;
 }
 });
}
</script>

<!--By User_Profile_Id-->
<script>
$(document).ready(function(){
	$("#user_profile_id").keyup(function(){
		var getvalue=document.getElementById("user_profile_id").value;
		$.post("search-by-userprofileid.php",
		{
			passvalueid:getvalue
		},
		function(data, status){
					document.getElementById("place_id").innerHTML=data;
		var user_profile_id_count = document.getElementById("user_option").length;
			if (user_profile_id_count < 2) {
				document.getElementById("reg_id").readOnly = true;
				document.getElementById("reg_date").readOnly = true;
				document.getElementById("reg_batch_id").readOnly = true;
				document.getElementById("reg_courseFee").readOnly = true;
				document.getElementById("reg_courseName").readOnly = true;
				document.getElementById("reg_paymentStatus").readOnly = true;
			}
	});
});
});
</script>

<script>
function fetch_user_profile_id(val)
{
 $.ajax({
 type: 'post',
 dataType: "text json",
 url: 'reg-json-userprofileid-text.php',
 data: {
  id:val
 },
 success: function (response) {
  document.getElementById("phone").value=response[0].phone_main;
  document.getElementById("name").value=response[0].name;
  document.getElementById("user_profile_id").value=response[0].id;
  document.getElementById("email").value=response[0].email;
  $('#place_id').css('display','none');
  document.getElementById("name").readOnly = true;
  document.getElementById("email").readOnly = true;
  document.getElementById("user_profile_id").readOnly = true;
  document.getElementById("phone").readOnly = true;
 }
 });
}
</script>


<!--By Email-->
<script>
$(document).ready(function(){
	$("#email").keyup(function(){
		var getvalue=document.getElementById("email").value;
		$.post("search-by-email.php",
		{
			passvalueemail:getvalue
		},
		function(data, status){
					document.getElementById("place_email").innerHTML=data;
			var email_count = document.getElementById("email_option").length;
			if (email_count < 2) {
				document.getElementById("reg_id").readOnly = true;
				document.getElementById("reg_date").readOnly = true;
				document.getElementById("reg_batch_id").readOnly = true;
				document.getElementById("reg_courseFee").readOnly = true;
				document.getElementById("reg_courseName").readOnly = true;
				document.getElementById("reg_paymentStatus").readOnly = true;
			}
	});
});
});
</script>

<script>
function fetch_email(val)
{
 $.ajax({
 type: 'post',
 dataType: "text json",
 url: 'reg-json-email-text.php',
 data: {
  email:val
 },
 success: function (response) {
  document.getElementById("phone").value=response[0].phone_main;
  document.getElementById("name").value=response[0].name;
  document.getElementById("email").value=response[0].email;
  document.getElementById("user_profile_id").value=response[0].id;
  $('#place_email').css('display','none');
  document.getElementById("name").readOnly = true;
  document.getElementById("email").readOnly = true;
  document.getElementById("user_profile_id").readOnly = true;
  document.getElementById("phone").readOnly = true;
 }
 });
}
</script>
<script>
    $(document).ready(function(){
		var date_input=$('input[name="reg_date"]'); //our date input has the name "date"
		var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
		date_input.datepicker({
			format: 'yyyy-mm-dd',
			container: container,
			todayHighlight: true,
			autoclose: true,
		}) ;
	}) ;
</script>
</head>


<body style="background-color:#ccf2ff">
<div class ="container-fluid">   
	<div>
		<?php include 'header.inc.php'; ?>
	</div>
<div style="margin-top:90px;">
	<h2 class="text-primary text-center">Add Sales DEAL</h2>
</div>
	
<form class="form-horizontal" style="margin-left:10%;" method="POST" onSubmit="return validateForm(this)">


<div class="form-group row">
  <label class="control-label col-md-2" for="name">Name</label>  
  <div class="col-md-3">
	<input name="name" id="name" class="form-control input-md" type="text">
  </div>
  <label class="control-label col-md-2" for="phone">Phone</label>  
  <div class="col-md-3">
	<input name="phone" id="phone" class="form-control input-md" maxlength='10' type="text">
  </div>
  <span id="place_name" ></span>
  <span id="place_phone"></span>
</div>


<div class="form-group row">
<label class="control-label col-md-2" for="user_profile_id">User Profile ID<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="user_profile_id" id="user_profile_id" required=required class="form-control input-md" type="text">
  </div>
  <label class="control-label col-md-2" for="email">Email<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="email" id="email" required=required class="form-control input-md" type="email">
  </div>
  <span id="place_id"></span>
  <span id="place_email"></span>
</div>

<div id="hide_div">
<div class="form-group row">
<label class="control-label col-md-2" for="reg_id"><?php echo $order_no; ?><span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input name="reg_id" id="reg_id" required=required class="form-control input-md" type="text" value="<?php echo $reg;?>">
  </div>
  <label class="control-label col-md-2" for="reg_date"><?php echo $order_date; ?><span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input name="reg_date" id="reg_date" required=required class="form-control input-md" type="text" value="<?php echo date('Y-m-d'); ?>">
  </div> 
</div>
 

<div class="form-group row">
 <label class="control-label col-md-2"  for="reg_courseName"><?php echo $product_name; ?><span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="reg_courseName" id="reg_courseName" required=required class="form-control input-md" type="text">
  </div>
  
<label class="control-label col-md-2" for="reg_courseFee"><?php echo $product_price; ?><span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="reg_courseFee" id="reg_courseFee" required=required class="form-control input-md" type="text">
  </div>
</div>


<div class="form-group row">
 <label class="control-label col-md-2" for="reg_batch_id"><?php echo $product_sn; ?><span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="reg_batch_id" id="reg_batch_id" required=required class="form-control input-md" type="text">
  </div>
 
 <label class="control-label col-md-2"  for="reg_paymentStatus">Payment Status<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="reg_paymentStatus" id="reg_paymentStatus" required=required class="form-control input-md" type="text">
  </div> 
</div>

<div class="form-group" style="margin-left:30%; margin-top:40px;">
  <label class=" control-label" for="c_submit"></label>
  <div>
    <input type="submit" name="u_submit" class="btn btn-info" value="Submit" style="border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19); padding:10px 7%;"/>
    <input type="reset"  name="Reset" class="btn" value="Reset" onClick="window.location.reload()" style="border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19); padding:10px 7%;"/>
	</div>
</div>
</div>
</form>

<?php
if(isset($_GET['view_id']))
{
	$id=$_GET['view_id'];
	$query=mysqli_query($conn,"select id, name, phone_main, email from user_profile where id='$id'");
	$row=mysqli_fetch_array($query);
	$uid= $row['id'];
	$uphone=$row['phone_main'];
	$uname=$row['name'];
	$uemail=$row['email'];
}
else{
	
	$uphone="";
	$uname="";
	$uemail="";
}

if(isset($_GET['add_id']))
	{
	$add_id= $_GET['add_id'];
	
$user_qry=mysqli_query($conn,"SELECT id, name, phone_main, email from user_profile where id='$add_id'");
$rec=mysqli_fetch_array($user_qry);
$get_user_add_id=$rec['id'];
$get_user_name=$rec['name'];
$get_user_phone=$rec['phone_main'];
$get_user_email=$rec['email'];
	}

	if(isset($_POST['u_submit']))
	{
		$email=$_POST['email'];
		$reg_date=$_POST['reg_date'];
		$reg_id=$_POST['reg_id'];
		$user_id=$_POST['user_profile_id'];
		$reg_batch_id=$_POST['reg_batch_id'];
		$reg_courseName=$_POST['reg_courseName'];
		$reg_courseFee=$_POST['reg_courseFee'];
		$reg_paymentStatus=$_POST['reg_paymentStatus'];
		$created_by=$_SESSION['login'];
		$insert_deal_log_qry="insert into deal_log (user_name,enroll_dtm,reg_id,user_profile_id,batch_id,course_name,course_fee,payment_status,created_by,enroll_ip) 
		values('$email','$reg_date','$reg_id','$user_id','$reg_batch_id','$reg_courseName','$reg_courseFee','$reg_paymentStatus','$created_by','.$_SERVER[REMOTE_ADDR].')" ;
		if ($debug) //echo "<BR>".$insert_deal_log_qry ;
		$result=mysqli_query($conn,$insert_deal_log_qry) or die(mysqli_error($conn));
		header("location:manage-registration.php");
		echo (mysqli_error($conn));

	}
	
?>

<script>
$(document).ready(function(){
    var add_id="<?php echo $get_user_add_id; ?>" ;
    var user_name="<?php echo $get_user_name; ?>" ;
    var user_phone="<?php echo $get_user_phone; ?>";
    var user_email="<?php echo $get_user_email; ?>";
   document.getElementById("name").value = user_name;
	document.getElementById("name").readOnly = true;
	document.getElementById("email").value = user_email;
	document.getElementById("email").readOnly = true;
	document.getElementById("user_profile_id").value = add_id;
	document.getElementById("user_profile_id").readOnly = true;
	document.getElementById("phone").value = user_phone;
	document.getElementById("phone").readOnly = true;
});
</script>

<script>
$(document).ready(function(){
   
	var phone="<?php echo $uphone; ?>" ;
    var name="<?php echo $uname; ?>" ;
    var email="<?php echo $uemail; ?>";
    var uid="<?php echo $uid; ?>";
    //var view_id = "<?php echo $_GET['view_id']; ?>";
   //	alert(view_id);
	
    document.getElementById("name").value = name;
	document.getElementById("name").readOnly = true;
	document.getElementById("email").value = email;
	document.getElementById("email").readOnly = true;
	document.getElementById("user_profile_id").value = uid;
	document.getElementById("user_profile_id").readOnly = true;
	document.getElementById("phone").value = phone;
	document.getElementById("phone").readOnly = true;
});
</script>
</div>
<div style="position:relative; bottom:0; width:100%; left:0; right:0; margin-top:138px;">
		<?php include("footer.inc.php"); ?>
	</div>

</body>
</html>