<?php
ob_start();
session_start();
include 'include/dbi.php';
include 'include/session.php';
//include 'include/param.php';
checksession();

if(isset($_GET['lead_id'])){
  $lead_id = $_GET['lead_id'];
  $lead_query = "SELECT * FROM lead_log where id='$lead_id'";
  $lead_result = mysqli_query($conn, $lead_query);
  $row = mysqli_fetch_array($lead_result);
  $wr_query = "SELECT product_item.prod_name, lead_quote.id, lead_quote.description, lead_quote.qty, lead_quote.std_rate, lead_quote.discount, lead_quote.final_rate, lead_quote.amount from product_item JOIN lead_quote ON product_item.id=lead_quote.product_name where lead_quote.lead_id='$lead_id'";
  $wr_result = mysqli_query($conn, $wr_query);
  
}


if(isset($_GET['add_gst']))
{
	$lead_id = $_GET['view_id'];
	$id=$_GET['emailID'];
	$query=mysqli_query($conn,"select emailID from lead_log id='$lead_id'");
	$row=mysqli_fetch_array($query);
	//$em=$row['email'];
	echo $query;
}





//receiver of the email
$to = '<?php echo $row["$id"] ; ?>';
echo $to;
//subject of the email
$subject = 'Test email with attachment';

$random_hash = md5(date('r', time()));

//define the headers.
$headers = "From: sanjeev@example.comrnReply-To: sanjeev@example.com";

//mime type specification
$headers .= "\r\nContent-Type: text/html; boundary=\"PHP-mixed-".$random_hash."\"";

//read the atachment file contents into a string,

//encode the contents with MIME base64,

//and split the contents  into smaller chunks using given below function

$file_name = "quote_mail.html" ;
$path_name = "quote\\".$file_name ;
$attachments = chunk_split(base64_encode(file_get_contents($path_name)));

//define the body of the message.
ob_start(); //Turn on output buffering

?>

Hello Test!!!
This is simple text email message.




<?php

//copy current buffer contents into $message
$message = ob_get_clean();
//send the email
echo $message;
$mail_sent = @mail( $to, $subject, $message, $headers );
//if the message is sent successfully print "Mail sent". Otherwise print "Mail failed"
echo $mail_sent ? "Mail sent" : "Mail failed";

?> 