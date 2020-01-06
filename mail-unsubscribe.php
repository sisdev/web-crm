<?php
include 'include/dbi.php';
include 'include/session.php';
	
  $email=base64_decode(rawurldecode($_REQUEST['reqID']));
  $query = "UPDATE user_profile SET email_unsubscribe='Y' where email='$email'";
  mysqli_query($conn, $query);
  $query = "UPDATE lead_log SET email_unsubscribe='Y' where emailID='$email'";
  mysqli_query($conn, $query);
   $query = "UPDATE our_contact SET email_unsubscribe='Y' where email='$email'";
  mysqli_query($conn, $query);
   $query = "UPDATE deal_log SET email_unsubscribe='Y' where user_name='$email'";
  mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Unsubscribe Page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
<script type="text/javascript">
    $(window).on('load',function(){
        $('#myModal').modal('show');
    });
</script>
</head>

<body>
<div class="container">
 <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
	  <div class="modal-header" style="background:#006699; height:52px; text-align:center; color:white;">
	  <h4>Sisoft: Email Unsubscribe</h4>
	  </div>
        <div class="modal-body">
          <p>You were successfully removed from the Subscribers List.</p>
        </div>
       <a href="http://www.sisoft.in" class="btn btn-primary" style="margin-left:125px; margin-top:-25px;">Ok</a>
      </div>
    </div>
  </div>
</div>

</body>
</html>