<?php
ob_start();
session_start();
include 'include/dbi.php';
include 'include/session.php';
include 'include/param.php';
checksession();


$existing_record=false ;
if(isset($_POST['cus_submit']))
{
    $sel_qry = "" ; 
	$type=$_POST['cus_qry_type'];
	$value=$_POST['cus_value'];
    
 
	if ($type == "User ID"){
		$sel_qry = "Select * from user_profile where id = '$value'" ;
	}
	else if ($type == "Email ID"){
		$sel_qry = "Select * from user_profile where email= '$value'" ;
	}
	else if ($type == "Phone Number"){
	    $sel_qry = "Select * from user_profile where phone_main= '$value'" ;	
	
	}
	// echo $sel_qry ; 
   $rs = mysqli_query($conn, $sel_qry);
   
   $num_rows= mysqli_num_rows($rs);
     if($num_rows==0)
	 {
		 echo "No existing customer found with $type =$value";
	 }
	   else {
		   $existing_record=true;
		   echo"record found";
		   $row = mysqli_fetch_array($rs);	   
	   }
}


  
  


	
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Add Lead Query</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/jquery.timepicker.css">
<link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
<script src="js/jquery.timepicker.js" type="text/javascript"></script> 
<script src="js/jquery-2.2.0.min.js" type="text/javascript"></script> 
<script src="js/jquery-ui.js" type="text/javascript"></script> 
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="icon" type="image/png" href="images/icon.png" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
  
<script>
function validateForm()
{
	alert("Lead registerd successfully....");
	
}

$(document).ready(function(){
		var date_input=$('input[name="c_date"]'); //our date input has the name "date"
		var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
		date_input.datepicker({
			format: 'yyyy-mm-dd',
			container: container,
			todayHighlight: true,
			autoclose: true,
		}) ;
	
var today = new Date();
var dd = today.getDate();
var mm = today.getMonth()+1; //January is 0!
var yyyy = today.getFullYear();

if(dd<10) {
    dd='0'+dd
} 
if(mm<10) {
    mm='0'+mm
} 
today = yyyy+'-'+mm+'-'+dd;
	document.getElementById("todaydate").value = today;
	
  var d = new Date(),
      h = d.getHours(),
      m = d.getMinutes();
	  s = d.getSeconds();
	  
  nowtime = h + ':' + m + ':' + s;
  document.getElementById("todaytime").value = nowtime;
	
	$(".datepick").click(function(){
		
		$(this).datepicker({dateFormat: 'yy-mm-dd'}).val();
	});
	$(".timepick").click(function(){
		$(this).timepicker({timeFormat:  'hh:mm:ss'}).val();
	});
	
});
	</script>
 
<script>
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
  function onlyAlphabets(e, t) {
            try {
                if (window.event) {
                    var charCode = window.event.keyCode;
                }
                else if (e) {
                    var charCode = e.which;
                }
                else { return true; }
                if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123) || (charCode==8)|| (charCode==32) || (charCode==9))
                    return true;
                else
                    return false;
            }
            catch (err) {
                alert(err.Description);
            }
        }	
</script>
	<style>
.collapsible {
  background-color: #ccf2ff;
  color: #337ab7;
  cursor: pointer;
  padding: 5px;
  width: 100%;
  border: none;
  text-align: center;
  outline: none;
  font-size: 20px;
}

.active, .collapsible:hover {
  background-color: #ccf2ff;
}

.content {
  padding: 0 20px;
  max-height: 0;
  overflow: hidden;
  transition: max-height 0.2s ease-out;
  background-color: #ccf2ff;
  margin-top: 10px;
}
</style>
</head>


<body style="background-color:#ccf2ff">
<div class ="container-fluid">
	<div>
		<?php  include 'header.inc.php'; ?>
	</div>


	<div style="margin-top:80px;">
		<h2 class="text-primary text-center"> Add Lead</h2>
	</div> 

<div style="margin-top:0px;">
	<button class="collapsible">+&nbsp;Existing Customers</button>
	<div class="content">
		<form class="form-horizontal" style="margin-left:10%;" method="POST" >

		<div class="form-group row">
			<label class="control-label col-md-2" for="c_source">Query Criteria<span style="color:red">*</span></label>  
			<div class="col-md-3">
				<select class="form-control" name="cus_qry_type" required=required>
					<?php 
				 for ($i=0;$i<count($customer_qry); $i++)
				 {
				 echo "<option value='$customer_qry[$i]'>$customer_qry[$i]</option>" ;
				 }
					?>
				</select>
			</div> 
			<label class="control-label col-md-2"  for="value" style="margin-right: 10px;">Enter<span style="color:red">*</span></label>  
			<div class="col-md-3">
				<input name="cus_value" id="value"    class="form-control input-md" type="text">
			</div>

		
			<input type="submit" name="cus_submit" class="btn btn-info" value="submit" style="padding:5px 2%;"/>
		</div>
		</form>
	</div>
</div>  


<form class="form-horizontal" style="margin-left:10%;" method="POST" onSubmit="return validateForm(this)">
<h3 class="text-primary text-center" >Basic Info</h3>
	
<div class="form-group row">
  <label class="control-label col-md-2"  for="c_mob">Mobile<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="c_mob" value="<?php if ($existing_record) echo $row ['phone_main'];?>" id="c_mob" required=required maxlength="10" class="form-control input-md" type="number" >
  </div>
  <label class="control-label col-md-2"  for="c_name">Name<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input name="c_name" id="c_name" required=required  onkeypress="return onlyAlphabets(event,this);" maxlength="20"  class="form-control input-md" type="text" value="<?php if ($existing_record) echo $row['name'];?>">
  </div>
</div>

<div class="form-group row">
  <label class="control-label col-md-2"  for="c_email">Email ID</label>  
  <div class="col-md-3">
	<input  name="c_email" id="c_email" class="form-control input-md" type="email" value="<?php if ($existing_record) echo $row['email'];?>">
  </div>

 <label class="control-label col-md-2" for="c_source">Lead Source<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<select class="form-control" name="c_source" required=required>
		<?php 
	 for ($i=0;$i<count($lead_source); $i++)
	 {
		 echo "<option value='$lead_source[$i]'>$lead_source[$i]</option>" ;
	 }
		?>
	</select>
  </div>  
</div>

<div class="form-group row">
  <label class="control-label col-md-2" for="c_qry_type">Lead Type<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<select class="form-control" name="c_qry_type" required=required>
	<?php 
	 for ($i=0;$i<count($lead_type); $i++)
	 {
		 echo "<option value='$lead_type[$i]'>$lead_type[$i]</option>" ;
	 }
		?>
	</select>
  </div>
  
  <label class="col-md-2 control-label" for="c_qry">Course/Product<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input name="c_qry" required=required class="form-control input-md" type="text">
  </div>
</div>

<div class="form-group row">
  <label class="control-label col-md-2"  for="c_date">Lead Date<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input id="todaydate" name="c_date" required=required  class="form-control input-md datepick" type="text">
  </div>
  <label class="control-label col-md-2"  for="c_time">Lead Time<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input id="todaytime" name="c_time" required=required class="form-control input-md timepick" type="text">
  </div>
    
</div>
      
    <div class="form-group row">
         <label class="col-md-2 control-label" for="c_remark">Remark<span style="color:red">*</span></label>  
  <div class="col-md-8">
<input name="c_remark" id="c_remark" class="form-control input-md" type="text">
  </div>
    </div>

<h3 class="text-primary text-center" >Address Info</h3>
<div class="form-group row">
 <label class="control-label col-md-2"  for="comp_name">Company Name</label>  
  <div class="col-md-3">
	<input name="comp_name" id="comp_name" class="form-control input-md" type="text" value="<?php if ($existing_record) echo $row['comp_name'];?>">
  </div>
  
  <label class="col-md-2 control-label" for="indus_seg">Industry Segment</label>  
  <div class="col-md-3">
	<!--<input  name="indus_seg" id="indus_seg" class="form-control input-md" type="text" value="<?php //if ($existing_record) echo $row['indus_seg'];?>">-->
	  
	  <select class="form-control" name="indus_seg" required=required>
	<?php 
	 for ($i=0;$i<count($industry_segment); $i++)
	 {
		 echo "<option value='$industry_segment[$i]'>$industry_segment[$i]</option>" ;
	 }
		?>
	</select>
  </div>

</div>

<div class="form-group row">
 <label class="control-label col-md-2"  for="indus_subseg">Industry Subsegment</label>  
  <div class="col-md-3">
	<input name="indus_subseg" id="indus_subseg" class="form-control input-md" type="text" value="<?php if ($existing_record) echo $row['indus_subseg'];?>">
  </div>
  
<label class="col-md-2 control-label" for="c_street"> Address Line 1<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input  name="c_street" id="c_street" class="form-control input-md" type="text" value="<?php if ($existing_record) echo $row['cur_add'];?>">
  </div>
</div>


<div class="form-group row">
<label class="col-md-2 control-label" for="c_sector"> Address Line 2<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input name="c_sector" id="c_sector" class="form-control input-md" type="text">
  </div>
  
<label class="col-md-2 control-label" for="c_market">Market</label>  
  <div class="col-md-3">
	<input name="c_market" id="c_market" class="form-control input-md" type="text">
  </div>
</div>
  
<div class="form-group row">
<label class="col-md-2 control-label" for="c_city">City<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input name="c_city" id="c_city" class="form-control input-md" type="text">
  </div>
  <label class="col-md-2 control-label" for="c_distict">District<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input name="c_distict" id="c_distict" class="form-control input-md" type="text">
  </div>
    </div>
	
	<div class="form-group row">
<label class="col-md-2 control-label" for="c_state">State<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input name="c_state" id="c_state" class="form-control input-md" type="text">
  </div>
  <label class="col-md-2 control-label" for="c_pincode">Pin_code<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input name="c_pincode" id="c_pincode" class="form-control input-md" type="text">
  </div>
    </div>
	
	<div class="form-group row">
<label class="col-md-2 control-label" for="c_country">Country<span style="color:red">*</span></label>  
  <div class="col-md-3">
	<input name="c_country" id="c_country" class="form-control input-md" type="text">
  </div>
  </div>
  
        

<br>
<div class="form-group" style="margin-left:30%;">
  <label class=" control-label" for="c_submit"></label>
  <div>
    <input type="submit" name="c_submit" class="btn btn-info" value="Submit" style="padding:10px 7%;"/>
    <input type="reset"  name="Reset" class="btn" value="Reset" onClick="window.location.reload()" style="padding:10px 7%;"/>
	</div>
</div>
  </form>
<?php 
if(isset($_GET['view_id']))
{
	$id=$_GET['view_id'];
	$query=mysqli_query($conn,"select * from our_contact where id='$id'");
	$row=mysqli_fetch_array($query);
	$cphone=$row['p_phone'];
	$cname=$row['fname']." ".$row['lname'];
	$cemail=$row['email'];
	$ccomp=$row['comp_name'];
	$cseg=$row['indus_seg'];
	$csubseg=$row['indus_subseg'];
	$cstreet=$row['add_street'];
	$csector=$row['add_sector'];
	$cmarket=$row['add_market'];
	$ccity=$row['add_city'];
	$cdist=$row['add_district'];
    $cremk=$row['lead_remark'];
	//echo $cphone;
}
else{
	
	$cphone="";
	$cname="";
	$cemail="";
	$ccomp="";
	$cseg="";
	$csubseg="";
	$cstreet="";
	$csector="";
	$cmarket="";
	$ccity="";
	$cdist="";
    $cremk="";
}


if(isset($_POST['c_submit']))
{
$name=$_POST['c_name'];
$email=$_POST['c_email'];
$mob=$_POST['c_mob'];
$type=$_POST['c_qry_type'];
$street=$_POST['c_street'];
$sector=$_POST['c_sector'];
$market=$_POST['c_market'];
$city=$_POST['c_city'];
$distict=$_POST['c_distict'];
$state=$_POST['c_state'];
$pin_code=$_POST['c_pincode'];
$country=$_POST['c_country'];
$remark=$_POST['c_remark']; 
$qry=$_POST['c_qry'];
$date=$_POST['c_date'];
$time=$_POST['c_time'];
$dtm=$date." ".$time;
$source=$_POST['c_source'];
$comp=$_POST['comp_name'];
$indus_seg=$_POST['indus_seg'];
$indus_subseg=$_POST['indus_subseg'];
$created_by=$_SESSION['login'];


$insert_sql = "insert into lead_log (qry_type,qry_source,name,add_street,add_sector,add_market,add_city,add_distict,state,pin_code,country,lead_remark,emailID,phone_no,qry_details,req_dtm,ip_add, comp_name, indus_seg,indus_subseg,created_by) values('$type','$source','$name','$street','$sector','$market','$city','$distict','$state','$pin_code','$country','$remark','$email','$mob','$qry','$dtm','$_SERVER[REMOTE_ADDR]','$comp','$indus_seg','$indus_subseg','$created_by'
) " ;

echo $insert_sql ;
    
mysqli_query($conn,$insert_sql) or die(mysqli_error($conn));
	
	header("location:admin_page.php");
}

?>
	
	
	
	


	

</div>
	<script>
var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.maxHeight){
      content.style.maxHeight = null;
    } else {
      content.style.maxHeight = content.scrollHeight + "px";
    } 
  });
}
</script>
	
<div style="margin-top:95px;">
		<?php include("footer.inc.php");?>
	</div>
</body>
</html>