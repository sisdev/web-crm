<?php
error_reporting(1);
session_start();
include 'include/dbi.php';
include 'include/session.php';
include 'include/param.php';
checksession();
$id=$_GET['view_id'];
$selectsql="select * from lead_log where id = '$id'";
$rs = mysqli_query($conn,$selectsql);
$rows=mysqli_fetch_array($rs);
	if(isset($_GET['del_follow']))
	{	mysqli_query($conn,"delete from lead_followup where lead_followup_id='".$_GET['del_follow']."'");
		header("Refresh:0; url=lead_view_record.php?view_id=".$_GET['view_id']);
	}
?>
<input type="hidden" id="lead_id" value="<?php echo $id ?>" />
<html>
    <head>
	<title>Lead View & Followup</title>
    <link rel="icon" type="image/png" href="images/icon.png" />
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html;"/>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- Include Date Range Picker -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

	<!-- Bootstrap Date-Picker Plugin -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
<!-- Bootstrap Time-Picker Plugin -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.js" type="text/javascript" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>

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

   $(function(){
                $('#flw_act_todaytime').datetimepicker({
                    format: 'HH:mm',
	           });	   
    });
	$(function(){
                $('#todaytime').datetimepicker({
                    format: 'HH:mm',
	           });	   
    });
    $(document).ready(function(){
	$(window).load(function(){
			   $("#flw_act_todaydate").datepicker({
				   format: 'yyyy-mm-dd',
				   autoclose: true,
	});
	$("#flw_act_todaydate").click(function(){
	$(this).datepicker({Format: 'yyyy-mm-dd'});
	});
  });
   $(window).load(function(){
			   $("#todaydate").datepicker({
				   format: 'yyyy-mm-dd',
				   autoclose: true,
	});
	$("#todaydate").click(function(){
	$(this).datepicker({Format: 'yyyy-mm-dd'});
	});
  });
  
  <!-- Assign User -->
	$("#assign_id li").click(function(){
	var set_assign=this.id;
	var leadID="<?php echo $id ?>" ;
    $.post("lead-assign-upd.php",
    {
    pass_assign: set_assign,
	lead_id:leadID
    },
    function(data1, lassign){ 
		$("#assign_set").text("Assigned To: "+data1);
		location.reload();
    });		
	});
	<!-- Status Update -->
	$("#status_id li").click(function(){	
		var set_st=this.id;
	var lead_id=$("#lead_id").val();
    $.post("lead_status_upd.php",
    {
    pass_status: set_st,
	id_of_lead:lead_id,
	},
    function(data, status){
     // alert(data);
	  $("#status_set").text("Status : "+data);
 location.reload();
    });	
		
	});
	
	<!-- Class Update -->
	$("#class_id li").click(function(){
		var set_st=this.id;
	var lead_id=$("#lead_id").val();
    $.post("lead-class-upd.php",
    {
    pass_class: set_st,
	id_of_user:lead_id,
	},
    function(data, lclass){ 
		$("#class_set").text("Class : "+data);
		location.reload();
    });		
	});
	<!-- Score Update -->
	 $("#score_btn").click(function(){
	var id_val= "<?php echo $id ?>" ;
    var score_val = $("#score_id").val();
    $.ajax({
       url:'lead-score-upd-ajax.php',
       type:'POST',
       data:{id:id_val,score:score_val},
       success:function(response){  
          location.reload();
       }
    });
	});
	<!--Follow Action Ajax-->
  $("#flw_act").click(function(){
	var ids= "<?php echo $id ?>" ;
    var follow_action_date = $("#flw_act_todaydate").val();
    var follow_action_time = $("#flw_act_todaytime").val();
    var task_type = $("#task_type").val();
    var assign_to = $("#assign_to").val();
    var follow_action_text = $("#follow_action_text").val();
    $.ajax({
       url:'lead-followup-action-ajax.php',
       type:'POST',
       data:{ids:ids,follow_action_date:follow_action_date,follow_action_time:follow_action_time,task_type:task_type,assign_to:assign_to,follow_action_text:follow_action_text},
       success:function(response){
		   alert(response);
          location.reload();
       }
    });
  });
  <!--Follow Comments Ajax-->
  $("#flw").click(function(){
	var id= "<?php echo $id ?>" ;
    var follow_text = $("#follow_txt").val();
    $.ajax({
       url:'lead-followup-ajax.php',
       type:'POST',
       data:{id:id,follow_text:follow_text},
       success:function(response){
		 // alert(response);
          location.reload();
       }
    });
  });
});
</script>
 
<script>
	$(document).ready(function(){
		var date_input=$('input[name="date"]'); //our date input has the name "date"
		var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
		date_input.datepicker({
			showOn: 'button',
			format: 'yyyy-mm-dd',
			container: container,
			todayHighlight: true,
			autoclose: true,
		}) ;
        date_input.on('changeDate',function(){
            var ok = confirm("Change the followup Date?") ;
            if (ok==true){
                alert("Date Changed") ;
                var qry_id=$("#lead_id").val();
                var next_dt = $(this).val() ;
                 $.post("lead_followup_dt_upd.php",
                {
                    trng_qry_id: qry_id,
                    followup_dt:next_dt
                },
                function(data, status){
                  $("#status_set").text("Status : "+data);
                    location.reload();
                });
            }
            else{
                    date_input.value="<?php echo $rows['nxt_followup_dt']; ?>" ;
                    location.reload();
            }         
        }) ;
	}) ;

	$(document).ready(function(){
		var date_input=$('input[name="targ_month"]'); //our date input has the name "date"
		var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
		date_input.datepicker({
			showOn: 'button',
			startView: "months", 
   			minViewMode: "months",
			format: 'yyyy-mm',
			container: container,
			autoclose: true,
		}) ;
        date_input.on('changeDate',function(){
            var ok = confirm("Change the Target Month?") ;
            if (ok==true){
                alert("Target Month Changed!") ;
                var qry_id=$("#lead_id").val();
                var target_month = $(this).val() ;
                 $.post("lead-target-month-upd.php",
                {
                    trng_qry_id: qry_id,
                    targ_month:target_month
                },
                function(data, status){
                  $("#status_set").text("Status : "+data);
                    location.reload();
                });
            }
            else{
                    date_input.value="<?php echo $rows['targ_month']; ?>" ;
                    location.reload();
            }         
        }) ;
	}) ;
</script>


<!--Follow Action Date-Time-->
<script>
	function setIdle(cb, seconds) {
    var timer; 
    var interval = seconds * 1000;
    function refresh() {
            clearInterval(timer);
            timer = setTimeout(cb, interval);
    };
    $(document).on('keypress, click, mousemove', refresh);
    refresh();
}
setIdle(function() {
    location.href = location.href;
}, 200);	
$(document).ready(function(){
var today = new Date();
var dd = today.getDate();
var mm = today.getMonth()+1;
var yyyy = today.getFullYear();
if(dd<10) {
    dd='0'+dd
} 
if(mm<10) {
    mm='0'+mm
} 
today = yyyy+'-'+mm+'-'+dd;
document.getElementById("flw_act_todaydate").value = today;
  var d = new Date(),
      h = d.getHours(),
      m = d.getMinutes();
if(m<10) {
    m='0'+m
} 	 
  nowtime = h + ':' + m ;
  document.getElementById("flw_act_todaytime").value = nowtime;
	$("#flw_act_todaydate").focus(function(){
		$(this).datepicker({dateFormat: 'yy-mm-dd'}).val();
	});
	$("#flw_act_todaytime").focus(function(){
		$(this).timepicker({timeFormat:  'hh:mm'}).val();
	});
});
</script>


<script>
 function showText(data, score){ 
		$("#score_set").text("Score : "+data);
		location.reload();
    }
</script>

<script>
 <?php
		$lead_emailID_qry="Select emailID from lead_log where id='$id' AND qry_status='$deal_done'";
		$fetch_emailID=mysqli_query($conn, $lead_emailID_qry);
		$fetch_emailID_array=mysqli_fetch_array($fetch_emailID);
		$lead_email= $fetch_emailID_array['emailID'];
		
		$check_customer_email_qry="SELECT id,email from user_profile where email='$lead_email'";
		$fetch_email=mysqli_query($conn, $check_customer_email_qry);
		$fetch_email_array=mysqli_fetch_array($fetch_email);
        $user_profile_id= $fetch_email_array['id'];
		$match_customer_email=$fetch_email_array['email'];
		
		$reg_email_qry="SELECT user_name from deal_log where user_name='$lead_email'";
		$fetch_reg_email=mysqli_query($conn, $reg_email_qry);
		$fetch_reg_array=mysqli_fetch_array($fetch_reg_email);
		$match_reg_email=$fetch_reg_array['user_name'];
		?>
		
		var customer_email="<?php echo $match_customer_email; ?>" ;
		var lead_email="<?php echo $lead_email; ?>" ;
		var reg_email="<?php echo $match_reg_email; ?>" ;
		if(lead_email!=customer_email)
		{
			$(window).load(function(){
             $('#add_cust_reg_modal').modal('show');
         });
			
		}	
		else if(lead_email!=reg_email)
		{
			$(window).load(function(){
             $('#add_cust_reg_modal').modal('show');
             $('#add_to_reg').css('display','block');
             $('#add_to_customer').css('display','none');
         });
		}
</script>	
<style type="text/css">
    .modal.right .modal-dialog {
    position: fixed;
    margin: auto;
    width: 320px;
    height: 100%;
    -webkit-transform: translate3d(0%, 0, 0);
        -ms-transform: translate3d(0%, 0, 0);
         -o-transform: translate3d(0%, 0, 0);
            transform: translate3d(0%, 0, 0);
  }


  .modal.right .modal-content {
    height: 100%;
    overflow-y: auto;
  }
  
    .modal.right .modal-body {
    padding: 15px 15px 80px;
  }


/*Right*/
  .modal.right.fade .modal-dialog {
    right: -320px;
    -webkit-transition: opacity 0.3s linear, right 0.3s ease-out;
       -moz-transition: opacity 0.3s linear, right 0.3s ease-out;
         -o-transition: opacity 0.3s linear, right 0.3s ease-out;
            transition: opacity 0.3s linear, right 0.3s ease-out;
  }
  
  .modal.right.fade.in .modal-dialog {
    right: 0;
  }

/* ----- MODAL STYLE ----- */
  .modal-content {
    border-radius: 0;
    border: none;
  }

  .modal-header {
    border-bottom-color: #EEEEEE;
    background-color: #FAFAFA;
  }


</style>
</head>


<body style="background-color:#ccf2ff;">
<div class ="container-fluid" style="width:97%;" >

	<div>
		<?php include 'header.inc.php'; ?>
	</div>
	 <div class="row" style="margin-top:80px;">
		<div class="col-sm-2">
   <ul class="pager">
   <?php 
   $viewLeadSrc = $_SESSION["viewLeadSrc"];
  
   if ($viewLeadSrc == "myTasks")
   {
	   
      echo"<li class='previous'><a href='mytask.php' style='border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);'>❮ Back</a></li>";
   }
   else if($viewLeadSrc == "viewLeads"){
     $p=$_GET['page'];
    echo"<li class='previous'><a href='lead_view_all.php?page=$p' style='border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);'>❮ Back</a></li>";
   }
   else{
      $target_month = $_GET['target_month'];
     echo"<li class='previous'><a href='lead-report3.php?target_month=$target_month' style='border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);'>❮ Back</a></li>";
   }
   ?>
   </ul>  
	</div>   
     <div class="col-sm-8">
	<h2 class="text-primary text-center"> Lead Details - View and Followup</h2>
	</div> 
	</div>
	
	<form class="form-horizontal" style="margin-left:25%; width:50%; margin-bottom:50px;"  method="POST" enctype="multipart/form-data" name="eform" onSubmit="return validateForm(this)">
<!-- Form Name -->

<!-- Text input-->
<div class="form-group row">
  <label class="control-label col-md-2" for="id">Enquiry ID</label>  
  <div>
    <input type="text" class="form-control-static col-md-4" readonly value="<?php echo $rows['id']; ?>"/>
  </div>
  <label class="control-label col-md-2"  for="phone_no">Mobile:</label>  
  <div>
   <input type="text" class="form-control-static col-md-4" readonly value="<?php echo $rows['phone_no']; ?>"/>
  </div>
 </div>
 
 <div class="form-group row">
  <label class="control-label col-md-2" for="name">Name:</label>  
  <div>
  <input type="text" class="form-control-static col-md-4" readonly value="<?php echo $rows['name']; ?>"/>
  </div>
   <label class="control-label col-md-2 "  for="emailID">Email ID:</label>  
  <div>
  <input type="text" class="form-control-static col-md-4" readonly value="<?php echo $rows['emailID']; ?>"/>
	</div>
</div>
<div class="form-group row">
   <label class="control-label col-md-2" for="req_dtm">Query Date:</label>  
  <div>
  	<input type="text" class="form-control-static col-md-4" readonly value="<?php echo $rows['req_dtm']; ?>"/>
  </div> 
  <label class="control-label col-md-2" for="qry_type">Query Type:</label>  
  <div>
	<input type="text" class="form-control-static col-md-4" readonly value="<?php echo $rows['qry_type']; ?>"/>
  </div>
 </div>

 <div class="form-group row">
   <label class="control-label col-md-2" for="querydetail">Course/<br>Product:</label>  
  <div>
	<textarea class="col-md-4" readonly><?php echo $rows['qry_details']; ?></textarea>
  </div>
   <label class="control-label col-md-2" for="address">Address:</label>  
  <div>
	<textarea class="col-md-4" readonly rows="2"><?php echo $rows['address']; ?></textarea>
  </div> 
</div>
          
    <div class="form-group row">
         <label class="col-md-2 control-label" for="le_remark">Remark<span style="color:red">*</span></label>  
  <div class="col-md-16">
	<input type="text" class="form-control-static col-md-10" readonly value="<?php echo $rows['lead_remark']; ?>"/>
  </div>
    </div>

<div class="form-group row">
  <label class="control-label col-md-2" for="status_set" >NextFollow:</label> 
  <div id="datePicker">     
	<input class="col-md-4" id="date" name="date" placeholder="YY-MM-DD" type="text" value="<?php echo $rows['nxt_followup_dt'];?>">
	</div>

	<label class="control-label col-md-2" for="status_set" >Target Month:</label> 
  	<div id="date">     
	<input class="col-md-4" id="targ_month" name="targ_month" placeholder="YY-MM" type="text" value="<?php echo $rows['target_month'];?>">
	</div>
 </div>
 
 <div class="form-group row">
 	<label class="control-label col-md-2" for="comp">Company:</label>  
   <div>
	<input type="text" class="form-control-static col-md-4" readonly value="<?php echo $rows['comp_name']; ?>"/>
  </div>

  <label class="control-label col-md-2" for="indus_seg" >Industry Segment:</label> 
  <div>     
	<input class="col-md-4" id="indus_seg" name="indus_seg" readonly type="text" value="<?php echo $rows['indus_seg'];?>">
	</div>
</div>

<div class="form-group row">
	<label class="control-label col-md-2" for="indus_subseg">Industry Subsegment:</label>  
   <div>
	<input type="text" id="indus_subseg" name="indus_subseg" class="col-md-4" readonly value="<?php echo $rows['indus_subseg']; ?>"/>
  </div>

  <label class="control-label col-md-2" for="add_street" > Address Line 1:</label> 
  <div>     
	<input class="col-md-4" id="add_street" name="add_street" readonly type="text" value="<?php echo $rows['add_street'];?>">
	</div>
</div>
 
<div class="form-group row">
	 <label class="control-label col-md-2" for="add_sector"> Address Line 2:</label>  
   <div>
	<input type="text" id="add_sector" name="add_sector" class="col-md-4" readonly value="<?php echo $rows['add_sector']; ?>"/>
  </div>

  <label class="control-label col-md-2" for="add_market" >Market:</label> 
  <div>     
	<input class="col-md-4" id="add_market" name="add_market" readonly type="text" value="<?php echo $rows['add_market'];?>">
	</div>
</div>
 
<div class="form-group row">
	<label class="control-label col-md-2" for="add_city">City:</label>  
   <div>
	<input type="text" id="add_city" name="add_city" class="col-md-4" readonly value="<?php echo $rows['add_city']; ?>"/>
  </div>

  <label class="control-label col-md-2" for="add_distict" >Distict:</label> 
  <div>     
	<input class="col-md-4" id="add_distict" name="add_distict" readonly type="text" value="<?php echo $rows['add_distict'];?>">
  </div>
</div>

<hr style="background-color: #428bca; height: 1px; border: none;">

 
<div class="form-group row">
<div class="col-md-4">
 <button type="button"  style="margin-left:65px; border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);" class="btn btn-primary" data-toggle="modal" data-target="#follow">Follow-Up Comments</button>
  </div>
  
<div class="col-md-4">
 <button type="button"  style="margin-left:65px; border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);" class="btn btn-primary" data-toggle="modal" data-target="#follow_action">Follow-Up Actions</button>
  </div>
  
  <div class="col-md-3">
    <div class="dropup">
  		<button  type="button" style="margin-left:40px; border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
		<span id="assign_set">
		Assigned To:
		<?php echo $rows['assigned_to'];
		?>
		</span> 
		<span class="caret"></span></button>
		<ul id='assign_id' class='dropdown-menu' role='menu'>
		<?php
		$assign_query=mysqli_query($conn,"select username from tbl_staff where 1=1");
			while($r=mysqli_fetch_array($assign_query))
			{
			$a_to=$r['username'];
			echo "<li id='$a_to'><a href='javascript:;'>$a_to</a></li>" ;
			}
		?>
		</ul>
  </div> 
  </div> 
</div>
  
<div class="form-group row">
<div class="col-md-3">
  <div class="dropup">
						<button  type="button" style="border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
						<span id="status_set">
						Status: <?php 
						$status=mysqli_query($conn,"select qry_status from lead_log where id='".$_GET['view_id']."'");
						$sts=mysqli_fetch_array($status);
						echo $sts['qry_status'];
						?> </span> <span class="caret"></span></button>
						<ul id="status_id" class="dropdown-menu" role="menu">
						<?php 
	 for ($i=0;$i<count($lead_status); $i++)
	 {
		 echo "<li id='$lead_status[$i]'><a href='javascript:;'>$lead_status[$i]</a></li>" ;
	 }
		?>
						</ul>
  
  </div> 
  </div> 
  
  <div class="col-md-2">
  <div class="dropup">
						<button  type="button" style="margin-left:40px; border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
						<span id="class_set">
						Class: <?php 
						$lclass=mysqli_query($conn,"select lead_class from lead_log where id='".$_GET['view_id']."'");
						$sts=mysqli_fetch_array($lclass);
						echo $sts['lead_class'];
						?> </span> <span class="caret"></span></button>
						<ul id="class_id" class="dropdown-menu" role="menu">
						<?php 
	 for ($i=0;$i<count($lead_class); $i++)
	 {
		 echo "<li id='$lead_class[$i]'><a href='javascript:;'>$lead_class[$i]</a></li>" ;
	 }
		?>
						</ul>
  </div> 
  </div> 
  
  <div class="col-md-2">
 <button type="button" style="margin-left:35px; border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);" name="scr_btn" id="scr_btn" class="btn btn-info" data-toggle="modal" data-target="#score">
 <span id="score_set">
						Score: <?php 
						$score=mysqli_query($conn,"select lead_score from lead_log where id='".$_GET['view_id']."'");
						$sts=mysqli_fetch_array($score);
						echo $sts['lead_score'];
						?> </span></button>
  </div>

<div class="col-md-3">
 <button type="button"  style="margin-left:65px; border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);" class="btn btn-primary" data-toggle="modal" data-target="#insight_modal">Insights</button>
  </div>
</form>
  <div class="col-md-2">
  <form action = "prepare-quote.php" method="GET" >
          <input type = "hidden" name ="lead_id" value ="<?php echo $_GET['view_id']; ?>"/>
           <input type="submit" class="btn btn-success" value="Prepare Quote" style="border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);"/>
  </form>
  </div>
</div>

							
		<form class="form-horizontal"  method="POST" > 
									<!-- Follow Up-->
			<div class="modal fade" id="follow" role="dialog">
					<div class="modal-dialog modal-sm">
									<!-- Follow Up content-->
					<div class="modal-content">
					<div class="modal-header" style="background-color:#428bca; color:white;">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Follow Up Comments</h4>
					</div>
							<div class="modal-body">
								<p>Text: <textarea class="form-control" name="follow_text" id="follow_txt" placeholder="Follow up text goes here..."></textarea></p> 
							</div>
									<input type="submit" id="flw" class="btn btn-success" name="follow_btn" style="margin-bottom:20px; margin-left:120px; border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19); background-color: #FFF; color:green;" onMouseOver="this.style.backgroundColor='#5cb85c'" onMouseOut="this.style.backgroundColor='#FFF'" value="Follow">
							</div>
							</div>
						</div>
		</form>
		
		<form class="form-horizontal"  method="POST" > 
									<!-- Follow Up-->
			<div class="modal fade" id="follow_action" role="dialog">
					<div class="modal-dialog modal-sm">
									<!-- Follow Up content-->
					<div class="modal-content">
					<div class="modal-header" style="background-color:#428bca; color:white;">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Follow Up Actions</h4>
					</div>
							<div class="modal-body">
								<p>Date: <input type="text" name="follow_action_date" id="flw_act_todaydate"  class="form-control"></p>
								<p>Time: <input type="text" name="follow_action_time" id="flw_act_todaytime" class="form-control"></p> 
								Task Type: <select class="form-control" name="task_type" id="task_type">
								<?php 
								for ($j=0;$j<count($task_type); $j++)
								{
									echo "<option value='$task_type[$j]'>$task_type[$j]</option>" ;
								}
								?>
								</select>
								Assign_To:
								<select class="form-control" name="assign_to" id="assign_to">
								<?php
								$assign_qry=mysqli_query($conn, "SELECT username from tbl_staff");
								while($ar=mysqli_fetch_array($assign_qry))
								{
									$uname=$ar['username'];
									if($uname==$_SESSION['login'])
									{
									echo "<option value='$uname' selected>$uname</option>" ;
									}
									else
									{
										echo "<option value='$uname'>$uname</option>" ;
									}
								}
								?>
								</select>
								<p>Narration: <textarea class="form-control" name="follow_action_text" id="follow_action_text" placeholder="Follow up text goes here..."></textarea></p> 
								
								
							</div>
									<input type="submit" id="flw_act" class="btn btn-success" name="follow_action_btn" style="margin-bottom:20px; margin-left:120px; border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19); background-color: #FFF; color:green;" onMouseOver="this.style.backgroundColor='#5cb85c'" onMouseOut="this.style.backgroundColor='#FFF'" value="Follow">
							</div>
							</div>
						</div>
		</form>
		<!-- Modal -->
  <div class="modal right fade" id="insight_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#428bca; color:white;">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel2">INSIGHTS</h4>
        </div>
        <div class="modal-body">
         <h3>Matching Company</h3>
         <ol>
         <?php
         $company_matching = "SELECT * FROM `lead_log` where comp_name LIKE '%".$rows['comp_name']."%' AND name NOT LIKE '%".$rows['name']."%'";
        // ECHO $company_matching;
         $company_result= mysqli_query($conn, $company_matching);
         $rowcount=mysqli_num_rows($result);
         if($rowcount > 0){
         while($cm_row=mysqli_fetch_array($company_result))
         {
        ?>
          <li> <a href="lead_view_record.php?view_id=<?php echo $cm_row['id']; ?>&page=<?php echo $_GET['page']; ?>" target="_xyz"><?php echo $cm_row['name']." (".$cm_row['qry_details'].")"; ?></a></li>
        <?php
         }
       }
       else{
        echo "No records found";
        
       }
       ?>
       </ol>
       <h3>Matching City</h3>
         <ol >
         <?php
         $city_matching = "SELECT * FROM `lead_log` where add_city LIKE '%".$rows['add_city']."%' AND name NOT LIKE '%".$rows['name']."%'";
         $city_result= mysqli_query($conn, $city_matching);
          $rowcount=mysqli_num_rows($city_result);
         if($rowcount > 0){
         while($cm_row=mysqli_fetch_array($city_result))
         {
        ?>
          <li>
          <a href="lead_view_record.php?view_id=<?php echo $cm_row['id']; ?>&page=<?php echo $_GET['page']; ?>" target="_xyz"><?php echo $cm_row['name']." (".$cm_row['qry_details'].")"; ?></a>
          </li>
        <?php
         }
       }
       else{
        echo "No result found";
       }
         ?>
     
       </ol>
       <h3>Matching Last Name</h3>
         <ol>
         <?php
          $lastname = $rows['name'];
          $parts = explode(" ", $lastname);
          if(count($parts) > 1) {
              $lastnames = array_pop($parts);
              $firstname = implode(" ", $parts);
          }
          else
          {
              $firstname = $lastname;
              $lastnames = " ";
          }
         
         $lname_matching = "SELECT * FROM `lead_log` where name LIKE '%".$lastnames."' AND name NOT LIKE '%".$rows['name']."%'";
        // echo $lname_matching;
         $lname_result= mysqli_query($conn, $lname_matching);
          $rowcount=mysqli_num_rows($lname_result);
         if($rowcount > 0){
         while($cm_row=mysqli_fetch_array($lname_result))
         {
        ?>
        <li>
          <a href="lead_view_record.php?view_id=<?php echo $cm_row['id']; ?>&page=<?php echo $_GET['page']; ?>" target="_xyz"><?php echo $cm_row['name']." (".$cm_row['qry_details'].")"; ?></a>
        </li>
        <?php
         }
       }
       else{
        echo "No records found";
         
       }
       ?>
       </ol>

        <h3>Matching Industry Segment</h3>
         <ol>
         <?php
         $seg_matching = "SELECT * FROM `lead_log` where indus_seg LIKE '%".$rows['indus_seg']."%' AND name NOT LIKE '%".$rows['name']."%'";
        // echo $seg_matching;
         $seg_result= mysqli_query($conn, $seg_matching);
          $rowcount=mysqli_num_rows($seg_result);
         if($rowcount > 0){
         while($seg_row=mysqli_fetch_array($seg_result))
         {
        ?>
         <li>
         <a href="lead_view_record.php?view_id=<?php echo $seg_row['id']; ?>&page=<?php echo $_GET['page']; ?>" target="_xyz"><?php echo $seg_row['name']." (".$seg_row['qry_details'].")"; ?></a>
         </li>
        <?php
         }
       }
       else{
        echo "No records found";
         
       }
       ?>
       </ol>
        </div>

      </div><!-- modal-content -->
    </div><!-- modal-dialog -->
  </div><!-- modal -->
  
  
		<form class="form-horizontal"  method="POST" > 
									<!-- Score-->
			<div class="modal fade" id="score" role="dialog">
					<div class="modal-dialog modal-sm">
									<!-- Score Input-->
					<div class="modal-content">
					<div class="modal-header" style="background-color:#428bca; color:white;">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Lead Score</h4>
					</div>
							<div class="modal-body">
								<input type="hidden" name="score_dtm" id="score_dtm" >
								<input type="text" name="score" id="score_id" class="form-control" placeholder="*Enter Score Here. . .">
								<input type="submit" class="btn btn-success btn-block" id="score_btn" name="score_btn" value="OK"  style="width:30%; margin-left:95px; margin-top:10px; border-radius:0; background-color: #FFF; color:green; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);" onMouseOver="this.style.backgroundColor='#5cb85c'" onMouseOut="this.style.backgroundColor='#FFF'">
								</div>
							</div>
						</div>
		</form>
		
		
 
    <?php 
	  $querysel="select * from lead_followup where trng_query_id='$id' order by followup_dtm desc ";
	  $query=mysqli_query($conn,$querysel);
	  $count_row=mysqli_num_rows($query);
	  if($count_row >1 || $count_row ==1)
	  {
	  ?>
	  </div>
  
<div class="modal fade" id="add_cust_reg_modal" role="dialog">
  <div class="modal-dialog modal-sm">
	<div class="modal-content">
		<div class="modal-header" style="background-color:#428bca; color:white;">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h5 class="modal-title">Add to Customer or Registration</h5>
		</div>
    <div class="modal-body">
	  <div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-8" style="margin-top:-20px; margin-left:20px;">
		<div id="add_to_customer">
      <br>
		<p class="text-center">Not a Customer!</p>
      

    <form id="add_lead" action ="add-user.php" method="GET" style="">
      <div align="center">
          <input type="submit" class="btn btn-success" role="button" value="Add To Customer" style="border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);"/>
        </div>
<input type="hidden" name="view_id" value="<?php echo $rows['id']; ?>"/>
</form>
</div>
		
		<div id="add_to_reg" style="display:none;">
      <br>
		<p class="text-center">Already a Customer!</p>
    
            <form id="add_lead" action ="add-registration.php" method="GET" style="">
               <div align="center">
          <input type="submit" class="btn btn-success" role="button" value="Add To Registration" style="border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);"/>
        </div>
<input type="hidden" name="view_id" value="<?php echo $user_profile_id; ?>"/>
</form>
 </div>   
             
		
		</div>    
	  </div>    
	</div>    
	</div>
  </div>
</div>
	  <div class="row">
	  <div class="col-md-8"  >
	<h2 class="text-primary text-center " style="margin-left:45%; text-align:center;"> Followers</h2>
	</div>
	</div>
  <table class="table table-responsive" style="width:85%; margin-left:8%; margin-bottom:40px;">
 
    <thead>
      <tr>
        <th>#</th>
        <th>Date & Time</th>
        <th>Status</th>
        <th>FollowUp By</th>
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
        <td><?php echo $count; ?></td>
        <td><?php echo substr($fetch['followup_dtm'],0,10)."--".substr($fetch['followup_dtm'],10,10);?></td>
        <td><?php echo $fetch['followup_text']; ?></td>
       	<td><?php echo $fetch['followup_user']; ?></td>
		<td><form action="lead_followup_upd.php" method="GET"> 
	     <input type="hidden" name="mod_id" value ="<?php echo $fetch['lead_followup_id']; ?>"/>
	     <input type="hidden" name="view_id" value ="<?php echo $_GET['view_id']; ?>"/>
	     <input type="hidden" name="page" value ="<?php echo $_GET['page']; ?>"/>
        <input type="submit" class="btn btn-warning btn-sm" style="text-decoration: none; border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);" value="Modify" />  
			</form> </td>
			
		<td><form action = "lead_view_record.php" method="GET" onclick="return delete_follow()">
		<input type = "hidden" name ="view_id" value ="<?php echo $_GET['view_id']; ?>"/>
		<input type = "hidden" name ="del_val" value ="<?php echo $fetch['lead_followup_id']; ?>"/>
		<input type="hidden" name="page" value ="<?php echo $_GET['page']; ?>"/>
		<input type = "hidden" name ="del_follow" value ="<?php echo $fetch['lead_followup_id']; ?>"/>
		<input type ="submit" class="btn btn-danger btn-sm" style="text-decoration: none; border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);" value = "Delete " />
		</form></td>
    </tr>   

	<?php $count++;  } 
	?>
    </tbody>
 
	  <?php } 
	  ?>
		 </table>
       
		
</div>
		<div style="position:absolute; width:100%; left:0; right:0; margin-top:5px;">
		<?php include("footer.inc.php"); ?>
		</div>
    </body>
</html>