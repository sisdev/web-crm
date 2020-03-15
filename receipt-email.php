<?php
  $to = $_POST['email'] ;
  $name =$_POST['name'];
  $rct_no =$_POST['rct_no'];
  $date =$_POST['date'];
  $reg =$_POST['reg'];
  $course =$_POST['course'];
  $amount =$_POST['amount'];
  $amt_paid =$_POST['amt_paid'];
  $p_till =$_POST['p_till'];


   $from ='info@sisoft.in';
  $subject ='Payment Acknowledgement';

  $headers  = 'MIME-Version: 1.0' . "\r\n";
  $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
  $headers .= 'From: '.$from."\r\n".
    'Reply-To: '.$from."\r\n" .
	  
	  


  $message = '<html><body>';

  $message .= 'Dear'.$name ;


  $message .= "<br>Greetings from Sisoft !!\n" ;

  $message .= "<br>Thanks you for your payment. Please find below the payment details:\n";

$message .= "<br>Receipt #:". $rct_no;
$message .= "<br>Payment Date:". $date;
$message .= "<br>Registration #:". $reg;
$message .= "<br>Course Name:". $course;
$message .= "<br>Course fees:". $amount;
$message .= "<br>Amount Paid:". $amt_paid;
$message .= "<br>Balance Amount". $p_till;

$message .= "<br>Please let us know if you have any questions!!";
$message .= "<br><br> Thanks and Best Regards";

$message .= "<br>Team - Sisoft";
$message .= "<br>Website: www.sisoft.in ";
$message .= "<br>Phone: 9540283283";

$message .= "</body></html>";


 
echo "$message";
 if(mail($to, $subject, $message, $headers)){
    echo 'Your mail has been sent successfully.';
	mail("vijayrastogi@yahoo.com", $subject, $message, $headers);
} else{
    echo 'Unable to send email. Please try again.';
}
 
  
?>
 
<br><a href="receipt-add.php"><button name="BACK" onClick="redirect()">BACK</button></a>