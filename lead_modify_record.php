<?php
ob_start();
session_start();
include 'include/dbi.php';
include 'include/session.php';
include 'include/param.php';
checksession();
if(isset($_GET['mod_id']))
{
$get_id=$_GET['mod_id'];
$qry=mysqli_query($conn,"select * from lead_log where id='$get_id' ");
$rec=mysqli_fetch_array($qry);
}

if(isset($_POST['cancel']))
{
   header("Location:lead_view_all.php?page=".$_GET['page']);
}

if(isset($_POST['c_update']))
{
$name=$_POST['c_name'];
$email=$_POST['c_email'];
$mob=$_POST['c_mob'];
$type=$_POST['c_qry_type'];
$address=$_POST['c_address'];
$street=$_POST['c_street'];
$sector=$_POST['c_sector'];
$market=$_POST['c_market'];
$city=$_POST['c_city'];
$distict=$_POST['c_distict'];
$remark=$_POST['le_remark'];
$qry=$_POST['c_qry'];
$date=$_POST['c_date'];
$time=$_POST['c_time'];
$dtm=$date." ".$time;
$source=$_POST['c_source'];
$comp=$_POST['comp_name'];
$indus_seg=$_POST['indus_seg'];
$indus_subseg=$_POST['indus_subseg'];
$res="update lead_log set qry_type='$type',name='$name',address='$address',add_street='$street',add_sector='$sector',add_market='$market',add_city='$city',add_distict='$distict',lead_remark='$remark',emailID='$email',phone_no='$mob',qry_details='$qry',req_dtm='$dtm',qry_source='$source', comp_name='$comp', indus_seg='$indus_seg', indus_subseg='$indus_subseg' where id='$get_id' ";
$result=mysqli_query($conn,$res) or die(mysqli_error($conn));
  echo $res;
  //header("location:training_query.php?mobile=$mob ");
  header("location:lead_view_all.php?page=".$_GET['page']);
  exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Modify Lead Record</title>
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
<link rel="icon" type="image/png" href="images/icon.png" />
<script>
$(document).ready(function(){
  $(".datepick").click(function(){  
    $(this).datepicker({dateFormat: 'yy-mm-dd'}).val();
  });
  $(".timepick").click(function(){
    $(this).timepicker({timeFormat:  'hh:mm:ss'}).val();
  });
});

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
</head>



<body style="background-color:#ccf2ff">
  <div class ="container-fluid" >     <!-- body -->
  <div>
    <?php include 'header.inc.php'; ?>
  </div>
  <div class="row" style="margin-top:50px;">
  <div class="col-md-2">
  <ul class="pager">
   <li class="previous"><a href="javascript:history.go(-1)"> Back</a></li>
   </ul>
   </div>
  <div class="col-md-8">
    <h2 class="text-primary text-center">Modify -Lead Record</h2>
  </div>
  </div>
  
<form class="form-horizontal" style="margin-left:10%;" method="POST">
<div class="form-group row">
  <label class="control-label col-md-2"  for="c_mob">Mobile<span style="color:red">*</span></label>  
  <div class="col-md-3">
  <input  name="c_mob" value="<?php echo $rec['phone_no']; ?>" required=required onkeypress="return isNumber(event)" maxlength="10" class="form-control input-md" type="text">
  </div>
 
  <label class="control-label col-md-2"  for="c_name">Name<span style="color:red">*</span></label>  
  <div class="col-md-3">
  <input  name="c_name" value="<?php echo $rec['name']; ?>" required=required  onkeypress="return onlyAlphabets(event,this);" maxlength="20" class="form-control input-md" type="text">
  </div>
</div>

<div class="form-group row">
  <label class="control-label col-md-2"  for="c_email">Email ID<span style="color:red">*</span></label>  
  <div class="col-md-3">
  <input  name="c_email" class="form-control input-md" type="email" value="<?php echo $rec['emailID']; ?>">
  </div>
 
<label class="control-label col-md-2" for="c_source">Query Source<span style="color:red">*</span></label>  
  <div class="col-md-3">
  <select class="form-control" name="c_source">   
<?php 
   for ($i=0;$i<count($lead_source); $i++)
   {
                echo '<option value="'. $lead_source[$i] .'"';
                if ( $rec['qry_source'] == $lead_source[$i] ) echo 'selected="selected"';
                echo '>'. $lead_source[$i] .'</option>';
            }
    ?>
  </select>
  </div> 
</div>

<div class="form-group row">
<label class="control-label col-md-2" for="c_qry_type">Query Type<span style="color:red">*</span></label>  
  <div class="col-md-3">
  <select class="form-control" name="c_qry_type">
    <?php 
   for ($i=0;$i<count($lead_type); $i++)
   {
                echo '<option value="'. $lead_type[$i] .'"';
                if ( $rec['qry_type'] == $lead_type[$i] ) echo' selected="selected"';
                echo '>'. $lead_type[$i] .'</option>';
            }
    ?>
  </select>
  </div>
  
<label class="col-md-2 control-label" for="c_qry">Course/Product<span style="color:red">*</span></label>  
  <div class="col-md-3">
  <input  name="c_qry" class="form-control input-md" type="text" value="<?php echo $rec['qry_details']; ?>">
  </div>
</div>

<div class="form-group row">
  <label class="control-label col-md-2"  for="c_date">Query Date<span style="color:red">*</span></label>  
  <div class="col-md-3">
  <input id="todaydate" name="c_date" value="<?php echo substr($rec['req_dtm'],0,10); ?>" required=required  class="form-control input-md datepick" type="text">
  </div>
  
  <label class="control-label col-md-2"  for="c_time">Query Time<span style="color:red">*</span></label>  
  <div class="col-md-3">
  <input id="todaytime" name="c_time" value="<?php echo substr($rec['req_dtm'],10,8); ?>" required=required class="form-control input-md timepick" type="text">
  </div>
</div>
    
     <div class="form-group row">
         <label class="col-md-2 control-label" for="le_remark">Remark<span style="color:red">*</span></label>  
  <div class="col-md-8">
	 <input name="le_remark" id="le_remark" class="form-control input-md" type="text" value="<?php echo $rec['lead_remark']; ?>">
  </div>
    </div>

<div class="form-group row">
  <label class="control-label col-md-2"  for="comp_name">Company Name</label>  
  <div class="col-md-3">
  <input  name="comp_name" class="form-control input-md" type="text" value="<?php echo $rec['comp_name']; ?>">
  </div>

  <label class="col-md-2 control-label" for="indus_seg">Industry Segment</label>  
  <div class="col-md-3">
  <input  name="indus_seg" id="indus_seg" class="form-control input-md" type="text" value="<?php echo $rec['indus_seg']; ?>">
  </div>

  
</div>
    

<div class="form-group row">
 <label class="control-label col-md-2"  for="indus_subseg">Industry Subsegment</label>  
  <div class="col-md-3">
  <input name="indus_subseg" id="indus_subseg" class="form-control input-md" type="text" value="<?php echo $rec['indus_subseg']; ?>">
  </div>

<label class="col-md-2 control-label" for="c_address">Address<span style="color:red">*</span></label>  
  <div class="col-md-3">
  <textarea name="c_address" class="form-control input-md"><?php echo $rec['address']; ?></textarea>
  </div>
</div>
    
    
   

<div class="form-group row">
<label class="col-md-2 control-label" for="c_street"> Address Line 1<span style="color:red">*</span></label>  
  <div class="col-md-3">
  <input  name="c_street" class="form-control input-md" type="text" value="<?php echo $rec['add_street']; ?>">
  </div>

<label class="col-md-2 control-label" for="c_sector"> Address Line 2<span style="color:red">*</span></label>  
  <div class="col-md-3">
  <input name="c_sector" class="form-control input-md" type="text" value="<?php echo $rec['add_sector']; ?>">
  </div>
</div>

<div class="form-group row">
<label class="col-md-2 control-label" for="c_market">Market</label>  
  <div class="col-md-3">
  <input name="c_market" class="form-control input-md" type="text" value="<?php echo $rec['add_market']; ?>">
  </div>
  
<label class="col-md-2 control-label" for="c_city">City<span style="color:red">*</span></label>  
  <div class="col-md-3">
  <input name="c_city" class="form-control input-md" type="text" value="<?php echo $rec['add_city']; ?>">
  </div>
</div>
  
<div class="form-group row">

  <label class="col-md-2 control-label" for="c_distict">District<span style="color:red">*</span></label>  
  <div class="col-md-3">
 <input name="c_distict" class="form-control input-md" type="text" value="<?php echo $rec['add_distict']; ?>">
  </div>
</div>

<div class="form-group" style="margin-left:30%;">
  <label class=" control-label" for="c_update"></label>
  <div>
    <input type="submit" class="btn btn-warning" name="c_update" value="Update" style="border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19); padding:10px 7%;"/>
    <input type="submit"  name="cancel" class="btn" value="Cancel" style="border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19); padding:10px 7%;"/>
  </div>
</div>
  </form>
  
  
</div>
  <div  style="position:relative; width:100%; bottom:0; left:0; right:0; margin-top:32px;">
    <?php include("footer.inc.php");?>
  </div>
</body>
</html>