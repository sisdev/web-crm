<?php
ob_start();
session_start();
include 'include/dbi.php';
include 'include/session.php';
checksession();

$q="SELECT trainerid,tcenter,tname, address,phone1,phone2,emailid,courses,profile  FROM trainer WHERE del_flag='n' ";
$orderby = " ORDER BY update_dtm desc ";
if(isset($_POST['name']) && $_POST['name']!= NULL )
{
	$name=$_POST['name'];
    $q= $q." AND tname LIKE'%".$name."%'" ;

}   
 if(isset($_POST['course']) && $_POST['course']!= NULL )
 {
		$course=$_POST['course']; 
	    $q=$q." AND courses LIKE '%".$course."%' ";

 }	   

 if(isset($_POST['location']) && $_POST['location']!= NULL)
 {
	 $location=$_POST['location'];
		$q=$q."AND address LIKE '%".$location."%' ";			
}
     $q = $q.$orderby ;
    
     //$result = mysqli_query($conn,$q);
	 //echo $q;
	 
	$i=1 ;
 //echo "Query:".$q ;
$result = mysqli_query($conn,$q);

  
if($result)
{
?>
<html>
<head>
   <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script> 
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" type="text/css" rel="stylesheet">
	<meta http-equiv="Content-Type" content="text/html;"/>
<title>Manage Trainers</title>
<link rel="icon" type="image/png" href="images/icon.png" />
<style>
table{
	
	width:100%;
	table-layout:fixed;
}
  tbody:nth-of-type(odd) {
 background: #99d6ff ;
 word-wrap: break-word;
}
th {
 background: #ffb3b3 ;
 font-weight: bold;
}
@media only screen and (max-width: 800px) {
        /* Force table to not be like tables anymore */
        #no-more-tables table,
        #no-more-tables thead,
        #no-more-tables tbody,
        #no-more-tables th,
        #no-more-tables td,
        #no-more-tables tr {
        display: block;
		
        }
         
        /* Hide table headers (but not display: none;, for accessibility) */
        #no-more-tables thead tr {
        position: absolute;
        top: -9999px;
        left: -9999px;
        }
         
        #no-more-tables tr { border: 1px solid #ccc; }
          
        #no-more-tables td {
        /* Behave like a "row" */
        border: none;
        border-bottom: 1px solid #eee;
        position: relative;
        padding-left: 50%;
        white-space: normal;
        text-align:left;
        }
         
        #no-more-tables td:before {
        /* Now like a table header */
        position: absolute;
        /* Top/left values mimic padding */
        top: 6px;
        left: 2px;
		right: 2px;
        width: 55%;
        padding-right: 10px;
        white-space: nowrap;
        text-align:left;
        font-weight: bold;
        }
         
        /*
        Label the data
        */
        #no-more-tables td:before { content: attr(data-title); }
        }
  </style>
</head>
<!--Body-->
<body style="background-color:#ccf2ff">
<div class ="container col-md-12">   	<!-- body -->
	<div>
		<?php include 'header.inc.php'; ?>
	</div>
 
 <div style="margin-top:100px;">
  <h2 class="text-primary text-center">Trainers Manage</h2>
</div>

<div id="no-more-tables">
<table class="table-bordered" style="text-align:center;">
<thead>
	<tr  style="height: 8vh;">
		<th style="color:#b30059; text-align:center;">#</th>
		<th style="color:#b30059; text-align:center;">Name </th>
		<th style="color:#b30059; text-align:center;">Courses</th>
		<th style="color:#b30059; text-align:center;">Phone 1</th>
		<th style="color:#b30059; text-align:center;">Phone 2</th>
		<th style="color:#b30059; text-align:center;">Emailid</th>
		<th style="color:#b30059; text-align:center;">Address</th>
		<th style="color:#b30059; text-align:center; ">Profile</th>
		<th style="color:#b30059; text-align:center; ">Update</th>
	</tr>
</thead>


<?php
             
          while($row = mysqli_fetch_array($result))
           {
 ?>
 <tbody>
	<tr>
		<td data-title="#"><?php echo $i ?></td>
		<td data-title="Name"><?php echo $row['tname'] ?></td>
		<td data-title="Course"><?php echo $row['courses'] ?></td>
		<td data-title="Phone 1"><?php echo $row['phone1'] ?></td>
		<td data-title="Phone 2"><?php echo $row['phone2'] ?></td>
		<td data-title="Email"><?php echo $row['emailid'] ?></td>
		<td data-title="Address"><?php echo $row['address'] ?></td>
		<td data-title="Profile"><?php echo $row['profile'] ?></td>
		 <td data-title="Update"><form action="trainer_update_data.php" method="post"> 
	         
	     <input type="hidden" name="update_id" value ="<?php echo   $row['trainerid']; ?>"/> 
        <input type="submit" class="btn btn-warning" value="Update" />  
			</form> </td>
	</tr>

<?php	
$i++;		
           }
}		   
 
  else{
  
  echo"<script>alert('No Records Were Found');window.location='admin_page.php';</script>";

  }
        	 
?>
 </tbody>
</table>
</div>

<div style="position:absolute; left:0; right:0; width:100%;">
		<?php include("footer.inc.php"); ?>
	</div>
	</div>
</body>
</html>