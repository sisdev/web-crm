<?php
ob_start();
session_start();
include 'include/dbi.php';
include 'include/session.php';
include 'include/param.php';
$dtm=getLocalDtm();
checksession();
$debug=true ;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Add Customer</title>
<link rel="icon" type="image/png" href="images/icon.png" />
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- Include Date Range Picker -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
<!--Font Awesome (added because you use icons in your prepend/append)-->
<link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css" />

<script type="text/javascript">
$(document).ready(function(){
	$("#u_email").change(function(){
		var username = $("#u_email").val();
		var msgbox = $("#status");
		
		if(username.length > 4){
			$("#status").html('<img src="images/loader.gif" align="absmiddle">&nbsp;Checking availability...');
			$.ajax({
				type: "POST",
				url: "reg_email_check_ajax.php",
				data: "u_email="+ username,  
				success: function(msg){  
						if(msg == 'OK'){
							$("#u_email").removeClass("red");
							$("#u_email").addClass("green");
							msgbox.html('<img src="images/available.png" align="absmiddle">');
						}else{
							$("#u_email").removeClass("green");
							$("#u_email").addClass("red");
							msgbox.html(msg);
							$("#u_email").focus();
						}
					}
			});
		}else{
			$("#u_email").addClass("red");
			$("#status").html('<font color="#cc0000">Please enter atleast 5 letters.</font>');
			$("#u_email").focus();
		}
		return false;
	});
});
</script>

<script>
function validateForm()
{
	alert("Customer create successfully....");
}
</script>

<script>
function show_corp_text() {
    if($("#cust_type").val() == "Corporate")
	{
		$(".corporate_text").show();
		$(".individual_text").hide();
		$(".form-horizontal").css('margin-bottom','167px');
		
	}
	else{
		$(".corporate_text").hide();
		$(".individual_text").show();
		$(".form-horizontal").css('margin-bottom','15px');
	}	
}
</script>

<script>
    $(document).ready(function(){
		var date_input=$('input[name="u_dob"]'); //our date input has the name "date"
		var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
		date_input.datepicker({
			format: 'yyyy-mm-dd',
			container: container,
			todayHighlight: true,
			autoclose: true,
		}) ;
	}) ;
</script>

<style>
#status{
	font-size:10px;
	margin-left:0px;
}
.green{
	background-color:#CEFFCE;
}
.red{
	background-color:#FFD9D9;
	font-size: 14px;
    font-weight: bold;
    color: #FF0000;
}
</style>
</head>


<body style="background-color:#ccf2ff">
<div class ="container-fluid">   
	<div>
		<?php include 'header.inc.php'; ?>
	</div>
<div>
<h2 class="text-primary text-center" style="margin-top:90px;">Add Customer</h2>
</div>

<form class="form-horizontal" style="margin-left:10%;" method="POST" onSubmit="return validateForm(this)">
<div class="form-group row">
  <label class="control-label col-md-2" for="cust_type">Customer Type<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<select class="form-control" name="cust_type" id="cust_type" required=required onchange="show_corp_text();">
		<?php 
	 for ($i=0;$i<count($customer_type); $i++)
	 {
		 echo "<option value='$customer_type[$i]'>$customer_type[$i]</option>" ;
	 }
		?>
    </select> 
  </div>
  
  <label class="control-label col-md-2"  for="u_email">E-mail ID<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="u_email" id="u_email" class="form-control input-md" type="email"><span id="status"></span></input>
  </div> 
</div>

<div class="form-group row">
 <label class="control-label col-md-2"  for="u_name">Name<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="u_name" id="u_name" class="form-control input-md" type="text">
  </div> 
  <div class="individual_text">
 <label class="control-label col-md-2"  for="u_fname">Father's Name<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="u_fname" class="form-control input-md" type="text">
  </div>
  </div>
  
  <div class="corporate_text" style="display:none;" >
  <label class="col-md-2 control-label" for="comp_name">Company<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input name="comp_name" id="comp_name" class="form-control input-md" type="text">
  </div>
  </div>
</div>

<div class="form-group row corporate_text" style="display:none;">
 <label class="control-label col-md-2"  for="indus_seg">Segment<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="indus_seg" id="indus_seg" class="form-control input-md" type="text">
  </div> 
 
 <label class="control-label col-md-2"  for="indus_subseg">Subsegment<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="indus_subseg" id="indus_subseg" class="form-control input-md" type="text">
  </div>
</div>

<div class="individual_text">
<div class="form-group row">
<label class="control-label col-md-2" for="u_dob">Date of Birth<span style="color:red">*</span></label>  
  <div class="col-md-3">
  <div class="input-group">
	<input class="form-control" name="u_dob" class="form-control input-md" type="text">
	 <div class="input-group-addon">
         <i class="fa fa-calendar">
         </i>
        </div>
  </div>
</div>

<label class="control-label col-md-2">Gender<span style="color:red">*</span></label>
  <div class="col-md-3">
  <select class="form-control" name="u_gender">
		
	<?php 
	 for ($i=0;$i<count($gender); $i++)
	 {
		 echo "<option value='$gender[$i]'>$gender[$i]</option>" ;
	 }
		?>
	
  </select>   
</div> 
</div>
  
<div class="form-group row">      
<label class="control-label col-md-2">Marital Status<span style="color:red">*</span></label>
  <div class="col-md-3">
  <select class="form-control" name="m_status">
		<?php 
	 for ($i=0;$i<count($marital_status); $i++)
	 {
		 echo "<option value='$marital_status[$i]'>$marital_status[$i]</option>" ;
	 }
		?>
  </select>   
</div>

<label class="control-label col-md-2" for="u_country">Nationality:<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="u_country" class="form-control input-md" type="text" value="India">
</div>
</div>
</div>

<div class="form-group row"> 
 <label class="control-label col-md-2" for="u_mob_primary">Phone No (Primary)<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="u_mob_primary" id="u_mob_primary" class="form-control input-md" type="text" maxlength="10" pattern="[0-9]{10}">
  </div>
  
<label class="control-label col-md-2" for="u_mob_alternate">Phone No (Alternate)</label>  
  <div class="col-md-3">
	<input  name="u_mob_alternate" maxlength="10" pattern="[0-9]{10}" class="form-control input-md" type="text">
  </div> 
</div> 

<div class="form-group row">
 <div class="corporate_text" style="display:none;" >
  <label class="col-md-2 control-label" for="gst_num">GST No<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input name="gst_num" class="form-control input-md" type="text">
  </div>
 </div> 
  
  <label class="col-md-2 control-label" for="u_caddress">Current Address<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<textarea name="u_caddress" id="u_caddress" class="form-control input-md"></textarea>
  </div>
 
   
<div class="individual_text">
  <label class="col-md-2 control-label" for="u_paddress">Permanent Address<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<textarea name="u_paddress" class="form-control input-md"></textarea>
  </div>
</div>
</div>


<div class="form-group row">
<div class="individual_text">
  <label class="col-md-2 control-label" for="u_qualification">Educational Qualification<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<textarea name="u_qualification" class="form-control input-md"></textarea>
  </div>
  <label class="col-md-2 control-label" for="u_experience">Professional Experience<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<textarea name="u_experience" class="form-control input-md"></textarea>
  </div>
</div>
</div>
	

<div class="form-group" style="margin-left:30%;">
  <label class="control-label" for="c_submit"></label>
  <div>
    <input type="submit" name="u_submit" class="btn btn-info" value="Submit" style="border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19); padding:10px 7%;"/>
    <input type="reset"  name="Reset" class="btn" value="Reset" onClick="window.location.reload()" style="border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19); padding:10px 7%;"/>
	</div>
</div>
</form>

<?php 
if(isset($_GET['view_id']))
{
	$id=$_GET['view_id'];
	$query=mysqli_query($conn,"select * from lead_log where id='$id'");
	$row=mysqli_fetch_array($query);
	$uphone=$row['phone_no'];
	$uname=$row['name'];
	$uemail=$row['emailID'];
	$ucomp=$row['comp_name'];
	$cstreet=$row['add_street'];
	$csector=$row['add_sector'];
	$cmarket=$row['add_market'];
	$ccity=$row['add_city'];
	$cdist=$row['add_distict'];
	$uaddress = $row['add_street']." ".$row['add_sector']." ".$row['add_market']." ".$row['add_city']." ".$row['add_distict'];
	//echo $cphone;
}
else{
	
	$uphone="";
	$uname="";
	$uemail="";
	$ucomp="";
	$cstreet="";
	$csector="";
	$cmarket="";
	$ccity="";
	$cdist="";
	$uaddress ="";
}

if(isset($_POST['u_submit']))
{
	$cust_type=$_POST['cust_type'];
	$u_email=$_POST['u_email'];
	$u_mob_primary=$_POST['u_mob_primary'];
	$u_name=$_POST['u_name'];
	$u_dob=$_POST['u_dob'];
	$u_gender=$_POST['u_gender'];
	$m_status=$_POST['m_status'];
	$u_fname=$_POST['u_fname'];
	$u_country=$_POST['u_country'];
	$u_caddress=$_POST['u_caddress'];
	$u_paddress=$_POST['u_paddress'];
	$u_qualification=$_POST['u_qualification'];
	$u_experience=$_POST['u_experience'];
	$u_mob_alternate=$_POST['u_mob_alternate'];
	//$reg_id=$_POST['reg_id'];
	$comp_name=$_POST['comp_name'];
	$seg=$_POST['indus_seg'];
	$subseg=$_POST['indus_subseg'];
	$gst_num=$_POST['gst_num'];
	$created_by=$_SESSION['login'];
	
	$insert_user_profile_qry="insert into user_profile(cust_type,email,phone_main,name,father_name,gender,dob,marital_status,cur_add,perm_add,citizen_country,phone_alt,qualification,experience,comp_name,indus_seg,indus_subseg, gstin,update_dtm, created_by, update_ip)
 values('$cust_type','$u_email','$u_mob_primary','$u_name','$u_fname','$u_gender','$u_dob','$m_status','$u_caddress','$u_paddress','$u_country','$u_mob_alternate','$u_qualification','$u_experience','$comp_name','$seg','$subseg','$gst_num','$dtm','$created_by','.$_SERVER[REMOTE_ADDR].') " ;

    if ($debug)  //echo $insert_user_profile_qry ;	
	$result= mysqli_query($conn,$insert_user_profile_qry) ;
	header("location:manage-user.php");
	if ($result==false){
		$error=mysqli_error($conn) ;
		//echo "<BR>Error in Insert user_profile".$error ;
		die($error) ; // If not inserted here.. please stop 

	}
    $id = mysqli_insert_id($conn); 
}
?>

<script>
$(document).ready(function(){
    var phone="<?php echo $uphone; ?>" ;
    var name="<?php echo $uname; ?>" ;
    var email="<?php echo $uemail; ?>";
    var comp="<?php echo $ucomp; ?>";
    var address = "<?php echo $uaddress; ?>";
	document.getElementById("u_mob_primary").value = phone;
	document.getElementById("u_name").value = name;
	document.getElementById("u_email").value = email;
	document.getElementById("comp_name").value = comp;
	document.getElementById("u_caddress").value = address;
	$("#cust_type").val("Corporate").change();
});
</script>
	
</div>
<div style="position:relative; bottom:0; width:100%; left:0; right:0; margin-top:25px;">
		<?php include("footer.inc.php"); ?>
	</div>

</body>
</html>