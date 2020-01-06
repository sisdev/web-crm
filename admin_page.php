<?php
ob_start();
session_start();
include 'include/dbi.php';
include 'include/session.php';
include 'include/param.php';
include 'include/menu.php';
checksession();
$uname = $_SESSION['login'];

$sql="SELECT * FROM tbl_staff where username='$uname'";
$result=mysqli_query($conn, $sql);

$r = mysqli_fetch_array($result);
$exec =$r['role'];

$lead_count = mysqli_query($conn,"SELECT COUNT(*) AS week_count FROM `lead_log` where req_dtm > (DATE(NOW()) - INTERVAL 7 DAY)");
$lead_row = mysqli_fetch_array($lead_count);
$week_lead = $lead_row['week_count'];

$lead_count_month = mysqli_query($conn,"SELECT COUNT(*) AS month_count FROM `lead_log` where req_dtm > (DATE(NOW()) - INTERVAL 30 DAY)");
$lead_row_month = mysqli_fetch_array($lead_count_month);
$month_lead = $lead_row_month['month_count'];

$order_count = mysqli_query($conn,"SELECT COUNT(*) AS week_order FROM `deal_log` where  enroll_dtm > (DATE(NOW()) - INTERVAL 7 DAY)");
$order_row = mysqli_fetch_array($order_count);
$week_order = $order_row['week_order'];

$order_count_month = mysqli_query($conn,"SELECT COUNT(*) AS month_order FROM `deal_log` where  enroll_dtm > (DATE(NOW()) - INTERVAL 30 DAY)");
$order_row_month = mysqli_fetch_array($order_count_month);
$month_order = $order_row_month['month_order'];

$status_wise_qry = mysqli_query($conn, "SELECT COUNT(*) as total, qry_status FROM `lead_log` where  req_dtm > (DATE(NOW()) - INTERVAL 30 DAY) group by qry_status");
$class_wise_qry = mysqli_query($conn, "SELECT COUNT(*) as total_class, lead_class FROM `lead_log` where  req_dtm > (DATE(NOW()) - INTERVAL 30 DAY) group by lead_class");
$product_wise_qry = mysqli_query($conn, "SELECT COUNT(*) as total_product, qry_details FROM `lead_log` where  req_dtm > (DATE(NOW()) - INTERVAL 30 DAY) group by qry_details");
?>
<html>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<meta name='viewport' content='width=device-width, initial-scale=1'>
<link rel='icon' type='image/png' href='images/icon.png' />
<title>Admin Panel</title>
 <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
 <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
 <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
<!-- Bootstrap Date-Picker Plugin -->
<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js'></script>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css'/>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
	  google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Status', 'Total'],
         <?php
         while($s_row = mysqli_fetch_array($status_wise_qry)){
         	echo "['".$s_row['qry_status']."',".$s_row['total']."],";
         }
         ?>
        ]);

        var options = {
          title: 'Status Wise Leads'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        //var chart1 = new google.visualization.PieChart(document.getElementById('piechart1'));

        chart.draw(data, options);
      //  chart1.draw(data, options);
      }
</script>

<script type="text/javascript">
	      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Class', 'Total'],
         <?php
         while($c_row = mysqli_fetch_array($class_wise_qry)){
         	echo "['".$c_row['lead_class']."',".$c_row['total_class']."],";
         }
         ?>
        ]);

        var options = {
          title: 'Class Wise Leads'
        };

        var chart1 = new google.visualization.PieChart(document.getElementById('piechart1'));
        //var chart1 = new google.visualization.PieChart(document.getElementById('piechart1'));

        chart1.draw(data, options);
      //  chart1.draw(data, options);
      }
</script>
<script type="text/javascript">
	  google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Product', 'Total'],
         <?php
         while($p_row = mysqli_fetch_array($product_wise_qry)){
         	echo "['".$p_row['qry_details']."',".$p_row['total_product']."],";
         }
         ?>
        ]);

        var options = {
          title: 'Product Wise Leads'
        };

        var chart2 = new google.visualization.PieChart(document.getElementById('piechart2'));
        //var chart1 = new google.visualization.PieChart(document.getElementById('piechart1'));

        chart2.draw(data, options);
      //  chart1.draw(data, options);
      }
</script>
<script>
$(document).ready(function(){
	$('#mob').keyup(function(){
		var getval=document.getElementById('mob').value;
		
		$.post('search_by_mob.php',
		{
			passval:getval
		},
		function(data, status){
					document.getElementById('place').innerHTML=data;
	});
	
});
});

</script>

<script>
function fetch(val)
{
 $.ajax({
 type: 'post',
 dataType: 'text json',
 url: 'reg-json-mob-admin.php',
 data: {
  mob:val
 },
 success: function (response) {
  document.getElementById('mob').value=response[0].phone_no;
 $('#place').css('display','none');
  }
 });
}
</script>

<script>
    $(document).ready(function(){
		var date_input=$("input[name='date']"); //our date input has the name 'date'
		var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : 'body';
		date_input.datepicker({
			format: 'yyyy-mm-dd',
			container: container,
			todayHighlight: true,
			autoclose: true,
		}) ;
	}) ;
</script>

<style>
.alert{
	float:right;
	width:650px; 
	margin-top:100px;
	}
	
	
</style>
</head>


<body style='background-color:#ccf2ff'>
<div class ='container-fluid' >   	<!-- body -->
	<div>
		<?php include 'header.inc.php'; ?>
	</div>
	<div class="row" style="">
		  <div class="col-md-12"><a style="float: right;" href='admin_page_old.php' class="btn btn-warning">Old Dashboard</a></div>
		</div>
	<div class="row" style="margin-top:10px;">
	  
		   
	<div class="col-md-3 col-sm-3">
		<table class="table table-bordered table-responsive" style="background-color: #ffffff;">
			<tr><td></td><th>Last 7 Days</th><th>Last 30 Days</th></tr>
			<tr><th>Leads</th><td><?php echo $week_lead; ?></td><td><?php echo $month_lead; ?></td></tr>
			<tr><th>Deals</th><td><?php echo $week_order; ?></td><td><?php echo $month_order; ?></td></tr>
		</table>
	</div>
		
	<div class="col-md-3 col-sm-3">
    <div id="piechart" style=" width: 300px; height: 200px;"></div>
   	</div>
   
    <div class="col-md-3 col-sm-3">
        <div id="piechart1" style=" width: 300px; height: 200px;"></div>
    </div>
    <div class="col-md-3 col-sm-3">
        <div id="piechart2" style=" width: 300px; height: 200px;"></div>
    </div>
    </div>
	<!-- <div class='row' style='margin-bottom:50px; margin-top:80px;'> -->
<?php 	
		if($mitem_lead_display){
		
			echo "
		<div class='col-md-12' style='margin-bottom:10px; margin-top:20px;'>
		<div class='panel panel-primary'>
		<div class='panel-heading'>Leads Query</div>
		<div class='panel-body'> 
		<form class='form' name='form' id='form' action='lead_view_all.php' method='GET'>
		<div class='col-sm-2'><div style='font: 15px Arial;'>User Wise:</div>
		  	<div>
				<label class='radio-inline all_leads'>
				<input type='radio' name='assigned_to' id='all_leads' value='all_leads' checked />All
			</label>
			
			<label class='radio-inline'>
				<input type='radio' name='assigned_to' id='myleads' value='my_Leads' />My Leads
			</label>
			</div>
			</div>
			<div class='col-sm-2'><div style='font: 15px Arial;'>Status Wise:</div>
				<div>
				<label class='radio-inline'>
				<input type='radio' name='status_wise' id='active_status' value='active_status' onclick='hide_sel_status()' checked/>Active
			</label>

				<label class='radio-inline'>
				<input type='radio' name='status_wise' id='all_status' value='all_status' onclick='hide_sel_status()' />All
			</label>

			
			</div>
			</div>
			 <div class='col-sm-2'><label class='radio-inline'>
				<input type='radio' name='status_wise' id='part_status' value='part_status' onclick='show_sel_status()'/>Particular Status
			</label><div><select id='sel_status' name='sel_status' style='display:none;'>";
					
					echo "<option value=''></option>" ;
					$qry = 'SELECT distinct(qry_status) FROM `lead_log` WHERE qry_status IS NOT NULL' ;
					$qry_status = mysqli_query($conn, $qry) ;
					while($row=mysqli_fetch_array($qry_status))
					{
						$stat_val=$row['qry_status'];
						echo "<option value='$stat_val'>$stat_val</option>" ;
					}
		echo "		
		</select></div>
			</div>" ;	
		
			
          echo " <div class='col-sm-2'><div style='font: 15px Arial;'>Query Type:</div><div><select name='type' style=''>";

					
					echo "<option value=''></option>" ;
					$qry = 'SELECT distinct(qry_type) FROM `lead_log` WHERE qry_type IS NOT NULL' ;
					$qry_type = mysqli_query($conn, $qry) ;
					while($row=mysqli_fetch_array($qry_type))
					{
						$type_val=$row['qry_type'];
						echo "<option value='$type_val'>$type_val</option>" ;
					}
	echo "
		</select></div></div>
           <div class='col-sm-2'><div style='font: 15px Arial;'>Course/Product:</div><div><input type='text' name='course' id='course'/></div></div>
		   <div class='col-sm-2'><div style='font: 15px Arial;'>By Mobile:</div><div><input type='text' name='mob' id='mob'/></div></div>
		   <div><div style='font: 15px Arial;'></div><div><div id='place' style='position:absolute;background-color:white;'></div></div></div>
           <div class='col-sm-2'><div style='font: 15x Arial;'>Name:</div><div><input type='text' name='sname' id='sname'/></div></div>
		   <div class='col-sm-2'><div style='font: 15x Arial;'>Company:</div><div><input type='text' name='comp_name' id='comp_name'/></div></div>
		   <div class='col-sm-2'><div style='font: 15x Arial;'>Address:</div><div><input id='add' name='add' type='text' /></div></div>
		   <div class='col-sm-2'><div style='font: 15x Arial;'>Market:</div><div><input id='market' name='market' type='text' /></div></div>
		   
			<div class='col-sm-2'><div style='font: 15px Arial;'>Class:</div><div>
		<select name='sel_class' style='width:100%'>";
				
					echo "<option value=''></option>" ;					
					$qry = 'SELECT distinct(lead_class) FROM `lead_log` WHERE lead_class IS NOT NULL' ;
					$lead_class = mysqli_query($conn, $qry) ;
					while($row=mysqli_fetch_array($lead_class))
					{
						$class_val=$row['lead_class'];					
						echo "<option value='$class_val'>$class_val</option>" ;
					}
					
		echo "
		</select></div>
			</div>
			 <div class='col-sm-2'><div style='font: 15x Arial;'>Score:</div><div><input type='text' name='score' id='score'/></div></div>
			 <div class='col-sm-2'><div style='font: 15x Arial;'>NextFollowupDate:</div><div><input type='text' name='date' id='date'/></div></div>
             <div class='col-sm-12'><div style='margin-top:15px;'><input type='submit' value='Go' name='Go' /></div></div>
           </form>
		 </div>
		 </div>
		 </div>";
		}
		
	
		 
	/*	<!--<div class='col-md-2'>
	<div class='panel panel-primary'>
		<div class='panel-heading'> User Query</div>
		<div class='panel-body'> 
		
		<form class='form' name='form' id='form' action='manage-user.php' method='POST'>
         <div>
           <div><div style='font: 15px Arial;'>Name :</div><div><input type='text' name='name' id='name'/></div></div>
           <div><div style='font: 15px Arial;'>Email ID :</div><div><input type='text' name='email' id='email'/></div></div>
           <div><div style='font: 15px Arial;'>Phone :</div><div><input type='text' name='phone' id='phone'/></div></div>   
           <div><div style='font: 15px Arial;'>Address :</div><div><input type='text' name='add' id='add'/></div></div>   
           <div><div style='margin-top:15px;'><input type='submit' value='Go' /></div></div>
         </div>
         </form>
		 </div>
		 </div>
	</div>-->*/
	
	if($mitem_contact_display){
		
			echo "
<div class='col-md-12'>
	<div class='panel panel-primary'>
		<div class='panel-heading'> Contact Query</div>
		<div class='panel-body'> 
		
		<form class='form' name='form' id='form' action='contact-manage.php' method='GET'>
         <div>
           <div class='col-sm-2'><div style='font: 15px Arial;'>Name :</div><div><input type='text' name='name' id='name'/></div></div>
           <div class='col-sm-2'><div style='font: 15px Arial;'>Email ID :</div><div><input type='text' name='email' id='email'/></div></div>
           <div class='col-sm-2'><div style='font: 15px Arial;'>Phone :</div><div><input type='text' name='phone' id='phone'/></div></div>
           <div class='col-sm-2'><div style='font: 15px Arial;'>Business Type :</div><div><input type='text' name='biz_type' id='biz_type'/></div></div>
           <div class='col-sm-2'><div style='font: 15px Arial;'>Market :</div><div><input type='text' name='market' id='market'/></div></div>
           <div class='col-sm-2'><div style='font: 15px Arial;'>City :</div><div><input type='text' name='city' id='city'/></div></div>
           <div class='col-sm-2'><div style='font: 15px Arial;'>Company :</div><div><input type='text' name='comp' id='comp'/></div></div>
           <div class='col-sm-12'><div style='margin-top:15px;'><input type='submit' name='Go' value='Go' /></div></div>
         </div>
         </form>
		 </div>
		 </div>
	</div>";
}
	
	if($mitem_sale_display){
	
			echo "
<div class='col-md-12'>
	<div class='panel panel-primary'>
		<div class='panel-heading'> Customer Query</div>
		<div class='panel-body'> 
		
		<form class='form' name='form' id='form' action='registration_query.php' method='POST'>
         <div>
           <div class='col-sm-4'><div style='font: 15px Arial;'>Name :</div><div><input type='text' name='name' id='name'/></div></div>
           <div class='col-sm-4'><div style='font: 15px Arial;'>Email ID :</div><div><input type='text' name='email' id='email'/></div></div>
           <div class='col-sm-4'><div style='font: 15px Arial;'>Registration Year :</div><div><input type='text' name='reg_year' id='reg_year' size='8' pattern='[2][0][0-2][0-9]' maxlength='4' placeholder='2009 - 2029' style='width:63%;'/></div></div>
             <div class='col-sm-4'><div style='font: 15px Arial;'>Product :</div><div><input type='text' name='product' id='product'/></div></div>
           <div class='col-sm-12'><div style='margin-top:15px;'><input type='submit' value='Go' /></div></div>
         </div>
         </form>
		 </div>
		 </div>
	</div>";
}
	
if($mitem_trainer_display){

echo "<div class='col-md-12'> 

	<div class='panel panel-primary' style='margin-top:-2px; margin-right:-2px;'>
		<div class='panel-heading'>Trainer Query</div>
		<div class='panel-body'>	
		 <form name='form' id='form' action='trainers.php' method='POST'>
         
          <div class='col-sm-4'>
				<div style='font:15px Arial;'>Name:</div>
				<div><input type='text' name='name' id='name'/></div>
			</div>
			<div class='col-sm-4'>
				<div style='font: 15px Arial;'>Course:</div>
				<div><input type='text' name='course' id='course'/></div>
			</div>
           <div class='col-sm-4'>
				<div style='font:15px Arial;'>Location:</div>
				<div><input type='text' name='location' id='location'/></div>
			</div>
		    <div class='col-sm-12'>
				<div style='margin-top:15px;'><input type='submit' value='Go' /></div>
			</div>
         
         </form>
		 </div>
		
</div>";

}
?>
<script>
var role =  '<?php echo $exec; ?>';
if(role=='executive'){
	document.getElementById('all_leads').checked = false;
	$('.all_leads').css('display','none');
	document.getElementById('myleads').checked = true;
}

function show_sel_status() {
if(document.getElementById('part_status').checked == true){
	document.getElementById('sel_status').style.display = "block";
}
}
function hide_sel_status(){
if(document.getElementById('active_status').checked == true || document.getElementById('all_status').checked == true){
	document.getElementById('sel_status').style.display = "none";
}
}
</script>		 
</div>	
  </div>
 <div style='position:absolute; width:100%; left:0; right:0;'>
		<?php include('footer.inc.php'); ?>
	</div> 
</body>
</html>