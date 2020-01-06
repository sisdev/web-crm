<?php
ob_start();
session_start();
include 'include/dbi.php';
include 'include/session.php';
//checksession();
?>
<?php
$sales_user="";
if(isset($_POST['search']))
{
	$date=substr($_POST['searchtext'],0,10);
	$sales_user=$_POST['username'];
}
//echo "User Name:". $sales_user ;
?>


<html>
<head>
<title>Sales-Resource Activity</title>
<link rel="icon" type="image/png" href="images/icon.png" />
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="js/jquery-2.2.0.min.js" type="text/javascript"></script> 
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
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
</script>

<style>
#map {
	margin-top:0;
	width: 100%;
	height: 450px;
	border:1px solid;
}

#tab_map a{
	width:140px;
	border-radius:0; 
	font-size:15px;
	
}
#tab_table a{
	width:140px;
	border-radius:0; 
	font-size:15px;
	
}
#tab_map a:hover{
	background-color:#337ab7;
	color:white;
}
#tab_table a:hover{
	background-color:#337ab7;
	color:#ffffff;
}
</style>
</head>
  
<body style="background-color:#ccf2ff">
<div class="container-fluid">
  <div>
  <?php include("header.inc.php"); ?>
  </div>
<div style="margin-top:100px;">
  <h2 class="text-primary text-center">Sales-Resource Activity</h2>
</div> 

<form method="post" style="margin-left:200px;">
<div class="form-group row">
<label class="control-label col-md-1" for="date">Date<span style="color:red">*</span></label>  
<div class="col-md-3">
<div class="input-group input-append date" id="datePicker">     
  <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
   <input class="form-control" required=required placeholder="yy-mm-dd" name="searchtext" id="datepick" type="text" value="<?php if(isset($_POST['searchtext'])){ echo substr($_POST['searchtext'],0,10);}?>">
</div>
</div>
     
<label class="control-label col-md-1" for="username">Username<span style="color:red">*</span></label>  
<div class="col-md-3">
	<select class="form-control" name="username" required=required>
	<?php 
		echo "<option value=''></option>" ;
		$qry = "SELECT distinct(username) FROM `sales_resource_tracking` WHERE username IS NOT NULL" ;
		//echo $qry."<br>";
		$qry_username = mysqli_query($conn, $qry) ;
		//echo "User Name:". $sales_user ;
		while($row=mysqli_fetch_array($qry_username))
			{
				$username_val=$row['username'];
				if($username_val==$sales_user){
					echo "<option value='$username_val' selected>$username_val</option>" ;
				}
				else
				{
					echo "<option value='$username_val'>$username_val</option>" ;
				}
			}
	?>
	</select>
</div>
<div class="col-sm-2">
<input type="submit" id="search" name="search" class="btn btn-info" value="Search" />
</div>
</div>
</form>
 <?php
 if(isset($_POST['search']))
{
 $sql_qry = "select * from sales_resource_tracking where username='$sales_user' AND SUBSTR(dtm,1,10) LIKE '".$date."%'" ;
	//echo $sql_qry. "<br>" ;
	$qry=mysqli_query($conn,$sql_qry);
	$rowcount=mysqli_num_rows($qry);
	
	echo "<div style='margin-right:800px; margin-top:10px;'>Total Activity: <b>".$rowcount."</b></div>";
	echo "<div id='tabs'><ul class='nav nav-tabs'>
				  <li id='tab_map' class='active'><a data-toggle='tab' href='#map'>By Map</a></li>
				  <li id='tab_table' ><a data-toggle='tab' href='#table'>By Table</a></li>
				</ul></div>";
	echo "<div id='table' style='display:none'><table class='table table-bordered' style='text-align:center; word-wrap: break-word; width:100%; table-layout:fixed;'>
	<thead>
		<th style='color:#b30059; text-align:center; background: #ffb3b3; font-weight: bold;'>#</th>
		<th style='color:#b30059; text-align:center; background: #ffb3b3; font-weight: bold;'>Username</th>
		<th style='color:#b30059; text-align:center; background: #ffb3b3; font-weight: bold;'>Date-Time</th>
		<th style='color:#b30059; text-align:center; background: #ffb3b3; font-weight: bold;'>Activity Text</th>		
		<th style='color:#b30059; text-align:center; background: #ffb3b3; font-weight: bold;'>Latitude</th>
		<th style='color:#b30059; text-align:center; background: #ffb3b3; font-weight: bold;' >Longitude</th>
		<th style='color:#b30059; text-align:center; background: #ffb3b3; font-weight: bold;' >IP-Address</th>
	</thead>";
			  
	 $j=1;
	 $locations=array();
	echo"<tbody id='tbody' style='background: #99d6ff ;'>";
		while($rows = mysqli_fetch_array($qry))
			   {
				   $username=$rows['username'];
				   $date_time=$rows['dtm'];
				   $activity=$rows['activity_text'];
				   $latitudes=$rows['log_latitude'];
				   $longitudes=$rows['log_longitude'];
				   $ipadd=$rows['src_ipaddress'];
				   $locations[]=array( 'text'=>$activity, 'lat'=>$latitudes, 'lng'=>$longitudes );
		echo"<tr><td>$j</td><td>$username</td><td>$date_time</td><td>$activity</td><td>$latitudes</td><td>$longitudes</td><td>$ipadd</td></tr>";
					$j++; 
			  }
			echo"</tbody></table></div>";
			
		$markers = json_encode( $locations );	
		
		/* Show Map */
		echo "<div id='map'></div>";
	
?>

<script>
var markers= <?php echo json_encode($markers); ?>;

function initMap() {
        var latlng = new google.maps.LatLng('28.6470', '77.3572');
        var myOptions = {
            zoom: 14,
            center: latlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            mapTypeControl: false
        };
        var map = new google.maps.Map(document.getElementById("map"),myOptions);
	    var infowindow = new google.maps.InfoWindow(), marker, lat, lng;
        var j=JSON.parse(markers);
		var lat,lng,name;
        for( var i in j ){
            lat = j[i].lat;
			lng = j[i].lng;
            name = j[i].text;
			var latlng1 = new google.maps.LatLng(lat, lng);
			
           var marker = new google.maps.Marker({
                position: latlng1,
				map: map,
                name:name
            }); 
            google.maps.event.addListener( marker, 'click', function(){
                infowindow.setContent( this.name );
                infowindow.open( map, this );
            }.bind( marker ) );
        }
    }
</script>

<script>
 $(document).ready(function () { 
$("#tab_table").click(function() {
 $("#map").hide();
 $('#table').show();
 });
 $("#tab_map").click(function(){
 
    $('#map').show();
    $('#table').hide();
	
    });
});
</script>

 <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBSLhN45jj80pytj6qzMzpz0ExprYFX5vo&callback=initMap">
 </script>
 
 <?php
 }
 ?> 

</div> 
 
 <div><?php include("footer.inc.php"); ?></div>
</body>
</html>