<?php
ob_start();
session_start();
include 'include/dbi.php';
include 'include/session.php';
checksession();
$batch_id = '' ;
$qry_class_dt = "" ;



if (isset($_POST['update_attendance']))
{
  $batch_id = $_POST['update_id'];	
	

	
}
if(isset($_GET['s_submit']))
{
	$batch_id = $_GET['batch_id'];
	$qry_class_dt=$_GET['startdate'];
	$query="select * from trng_batch_students t1 INNER JOIN deal_log t2 ON t1.student_reg_id = t2.reg_id  where created_dtm = '$qry_class_dt' and t1.batch_id='$batch_id'";
	//echo $query;
	$rs = mysqli_query($conn,$query);
	
}
$base_qry="SELECT DISTINCT class_dt FROM trng_batch_students where batch_id='$batch_id'";
	$rss = mysqli_query($conn,$base_qry);
	//$rowss=mysqli_fetch_array($rss);
//echo $base_qry;
$rowcount=mysqli_num_rows($rss);
if ($rowcount==0){
	//echo "no attendence record existing";
	//exit(0);
}



	
	
	
	
if(isset($_POST['u_submit'])){
	$arr_batch_id=$_POST['batch_id'];
	$startdate=$_POST['class_dt'];
	$arr_reg_id=$_POST['reg_id'];
	
	
	$comment= $_POST['comment'];	
	$username=$_POST['user_name'];
	$attend = $_POST['attend_val'];
	print_r($username);
	print_r($attend);
	
    $chk="";  
	$student_count = count($username);
	$x = 0 ;
//	$attendval = 'P';
    for($x=0 ; $x<$student_count; $x++)  
       {  
		
		$sql="UPDATE trng_batch_students SET comment='$comment[$x]',attend_status='$attend[$x]' WHERE  batch_id='$arr_batch_id[$x]'and student_reg_id='$arr_reg_id[$x]' and class_dt='$startdate[$x]'";
		echo $sql ;
		$result=mysqli_query($conn,$sql);
       } 	



}



?>
<html>
    <head>
      <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
<script src="js/jquery.timepicker.js" type="text/javascript"></script> 
<script src="js/jquery-2.2.0.min.js" type="text/javascript"></script> 
<script src="js/jquery-ui.js" type="text/javascript"></script> 
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" type="text/css" rel="stylesheet">
	<meta http-equiv="Content-Type" content="text/html;"/>
       
        <title>Attendance Update</title>
      <link rel="icon" type="image/png" href="images/icon.png" />

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
	
function chkBox(val1,val2)
	{
	//	alert("Checl Box clciked:"+val1+":"+val2);
		var fldName="attend_val"+val1 ;
	//	alert(fldName);
		if (val2)
		document.getElementById(fldName).value='P';
		else
		document.getElementById(fldName).value='A';	
	}
	
	
		</script>

<style>
  ttbody:nth-of-type(odd) {
 background: #99d6ff ;
}
th {
 background: #ffb3b3 ;
 font-weight: bold;
}
  </style>


</head>
    

    <body style="background-color:#ccf2ff">
<div class ="container col-md-12">
	<div>
		<?php include 'header.inc.php'; ?>
	</div>
	<div class="col-md-12">
	<ul class="pager">
	<li class="previous"><a href="batch-act-manage.php"><< Back</a></li>
	</ul>
	</div>

 <div>
<h2 class="text-primary text-center" style="margin-top:90px;">Batch Attendance Update</h2>
</div>

<form class="form-horizontal" style="margin-left:14%;" method="GET">
<div class="form-group row">
  <label class="control-label col-md-2" for="batch_id">Batch Id<span style="color:red">*</span></label>  
   <div class="col-md-3">
	<input class="form-control" name="batch_id" id="batch_id" readonly required=required  value="<?php echo $batch_id;?>">
</div>
  <label class="control-label col-md-2"  for="startdate">Date<span style="color:red">*</span></label>  
  <div class="col-md-3">
	 <div class="input-group input-append date" id="datePicker">     
		 <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
           <?php
	          

  echo '<select   class="form-control input-md" name="startdate" >';
  //echo "<select name='to_user'>";
             while ($rowss=mysqli_fetch_array($rss)){
				 
				 
				 
    echo '<option value="'. $rowss['class_dt'] .'"';
                if ( $rowss['class_dt'] ==  $qry_class_dt  ) echo 'selected="selected"';
                echo '>'. $rowss['class_dt'] .'</option>';
			 }
		    echo "</select>" ;

	  ?> </div>
	     </div>   	
	
 
	  
	 <div>
    <input type="submit" name="s_submit" class="btn btn-info" value="Submit" style="padding:6px 2%; border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);"/>
	</div>
	   </div>
	
	</form>
	
		</div>
	
	
	<br>
	<br>
	<br>
	<div class="container col-md-12">
	  <?php
		 //$i = 0 ;
		if(isset($_GET['s_submit']))
		{
			 $row_cnt = mysqli_num_rows($rs);
			if ($row_cnt==0){
				echo "No record found for this date";
				exit(0) ;
			}
		?>
	<div style="overflow-x:auto;">
	<table class="table table-bordered" style="text-align:center; ">
 <div>
<h2 class="text-primary" style="margin-top:90px;">Date of Attendance View: &nbsp;<?php echo $qry_class_dt ?> </h2>
</div>
    <thead>
      <tr>
		<th style='color:#b30059;'>Registration Id</th>
		<th style='color:#b30059; text-align:center;'>Name</th>
		<th style='color:#b30059; text-align:center;'>Attendance</th>
		  <th style='color:#b30059; text-align:center; '>Comment</th>
      </tr>
    </thead>

		<ttbody>
           <form class="form-horizontal" style="margin-left:2%;" method="POST" onSubmit="return validateForm(this)">
                                       
         <?php
		 $i = 0 ;
		 while($rowsss=mysqli_fetch_array($rs)) {  ?>
				
			 <tr>
				 <td style="width: 250px;">
					 <input class="form-control" readonly name="reg_id[]" style="width: 250px;"  id="reg_id" required=required  value='<?php echo $rowsss["student_reg_id"];?>'>
				  <input type="text"  hidden name="batch_id[]" style="width: 250px;"  required=required  value='<?php echo $rowsss["batch_id"];?>'>
				 
				  <input type="text"  hidden name="class_dt[]" style="width: 250px;"  required=required  value='<?php echo $rowsss["class_dt"];?>'>
				 </td>
				 
				 
			  <td align="center" >
				  <input class="form-control" readonly name="user_name[]" style="width: 250px;" id="user_name" required=required  value='<?php echo $rowsss["user_name"];?>'></td>
			 <td align="center">
		     	 <input type="checkbox" name="attendence[]"  <?php if ($rowsss["attend_status"]=="P") echo "checked"; ?> onclick="chkBox(<?php echo $i;?>, this.checked)" >Present  
				 <input hidden id="attend_val<?php echo $i;?>" name="attend_val[]" value='<?php echo $rowsss["attend_status"];?> '>
             <br>
 
  </td>
				  <td align="center" >
				  <input class="form-control"  name="comment[]" style="width: 250px;"  required=required  value='<?php echo $rowsss["comment"];?>'></td>
				   </tr>
			
		<?php $i++; }?>
			

        </ttbody>
		
		
		</table>
		</div>
	
		
	<div class="form-group" style="margin-left:35%;">
  <label class=" control-label" for="submit"></label>
  <div>
	  
    <input type="submit" name="u_submit" class="btn btn-info" value="Submit" style="padding:10px 3%; border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);"/>
	  <input type="reset" name="cancel" class="btn btn-default" onclick="history.go(-2); return false;" value="Cancel"  style="padding:10px 3%; border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);"/>
	</div>
	</div>
	
		
		  </form>
		
	
<?php
		
		} // if condition
		
		?>
	
	
		

	

	
	
		<div style="position:absolute; left:0; right:0; width:100%;">
		<?php include("footer.inc.php"); ?>
	</div>
        
		
    </body>
</html>
