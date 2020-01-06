<?php
ob_start();
session_start();
include 'include/dbi.php';
include 'include/session.php';
checksession();
if(isset($_POST['delete_id']))
{
	$id= $_POST['delete_id'];
    mysqli_query($conn,"DELETE FROM email_template WHERE id ='$id'");
    header("location:mail-manage.php");
	exit;
}
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
       <link rel="icon" type="image/png" href="images/icon.png" />
        <title>Mail Manage</title>
      
        <script LANGUAGE="JavaScript">

function confirmDelete(delete_id) {
var msg;
msg= "Are you sure you want to delete the data ? " ;
var agree=confirm(msg);
if (agree)
return true ;
else
return false ;
}
</script>
<style>
  tbody:nth-of-type(odd) {
 background: #99d6ff ;
}
th {
 background: #ffb3b3 ;
 font-weight: bold;
}
  </style>
</head>
    

    <body style="background-color:#ccf2ff">
<div class ="container-fluid" >
	<div>
		<?php include 'header.inc.php'; ?>
	</div>

 <div style="margin-top:100px;">
  <h3 class="text-primary text-center">Manage Mail Template</h3>
  <form action = "mail-add.php" method="post" style="float:right;">
		<input type="submit" class="btn btn-primary" role="button" value="Add Mail"/>
  </form>
</div> 
<table class="table table-bordered" style="text-align:center;">

    <thead>
      <tr >
        <th style='color:#b30059; text-align:center;'>#</th>
		<th style='color:#b30059; text-align:center;'>Mail_code</th>
		<th style='color:#b30059; text-align:center;'>Subject</th>
		<th style='color:#b30059; text-align:center;'>Message</th>
		<th style='color:#b30059; text-align:center;'>Mail_Sign</th>
		<th style='color:#b30059; text-align:center;'>Created By</th>
		<th style='color:#b30059; text-align:center;'>Update</th>
		<th style='color:#b30059; text-align:center;'>Delete</th>
      </tr>
    </thead>
	
	
	<tbody>
	<tr>
		<?php
		
		$rs = mysqli_query($conn,"SELECT *  FROM email_template") or die("Error!");
                                                                
                                                                while($qfetch = mysqli_fetch_array($rs)) {  ?>
         <tr>
            <td align="center"><?php echo $qfetch["id"];?></td>
            <td align="center"><?php echo $qfetch["email_temp_name"];?></td>
            <td align="center"><?php echo $qfetch["email_subject"];?></td>
            <td align="center"><?php echo $qfetch["email_text"];?></td>
            <td align="center"><?php echo $qfetch["email_sign"];?></td>
            <td align="center"><?php echo $qfetch["created_by"];?></td>
            			
			<td>
				<form action = "mail-update.php" method="post">
					<input type = "hidden" name ="update_id" value ="<?php echo $qfetch["id"]; ?>/">
					 <input type="submit" class="btn btn-warning" role="button" value="Update"/>
				</form>
			</td>
			<td>
			<form action = "mail-manage.php" method="post" onClick="return confirmDelete(this)">
				<input type = "hidden" name ="delete_id" value ="<?php echo  $qfetch["id"]; ?>"/>
				 <input type="submit" class="btn btn-danger" role="button" value="Delete"/>
			</form></td>
			</tr>
<?php } ?>										                          
            </tr>
        </table>
</div>

<div>
		<?php include("footer.inc.php"); ?>
		</div>
    </body>
</html>
