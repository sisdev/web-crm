<?php
function sendsms($conn, $numbers, $cd, $message=”, $sent_by) 
{

$username = urlencode("RETEST");
$password = urlencode("reseller@123");
$numbers = urlencode($numbers);
$sender = urlencode("MSGTST");
$message = urlencode($message);


$data = "username=" . $username . "&password=" . $password .  "&sendername=" . $sender ;
$info= "&mobileno=" . $numbers . "&message=" . $message;

//$ch = curl_init("http://smscgateway.com/messageapi.asp?".$data);
$target="http://smscgateway.com/messageapi.asp?".$data.$info ;
$ch = curl_init($target);
//curl_setopt($ch, CURLOPT_POST, true);
//curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
echo "<BR>Response:".$response;
curl_close($ch);


date_default_timezone_set('Asia/Kolkata');
$dtm = date("Y/m/d H:i:s"); 
mysqli_query($conn, "INSERT INTO sms_log(dtm_sms, from_phnum, to_phnum,msg_text,msg_code, sent_by)VALUES('$dtm', '$sender', '$numbers', '$message','$cd', '$sent_by')") or die(mysqli_error($conn));
return $response;
}
?>

<?php
//sendsms("9808425209", "this is test");
?>