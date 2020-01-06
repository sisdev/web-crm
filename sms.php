<?php

function sendsms($numbers, $message=”) {



$username = urlencode("RETEST");

$password = urlencode("reseller@123");



$numbers = urlencode($numbers);

$sender = urlencode("MSGTST");

$message = urlencode($message);



$data = "username=" . $username . "&password=" . $password .  "&sendername=" . $sender . "&mobileno=" . $numbers . "&message=" . $message;



//$ch = curl_init("http://smscgateway.com/messageapi.asp?".$data);

$target="http://smscgateway.com/messageapi.asp?".$data ;

//echo "Target:".$target ;

$ch = curl_init($target);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);

//echo "<BR> Response:".$response;

curl_close($ch);

return $response;

}

?>


<?php

//sendsms("9808425209", "this is test");

?>