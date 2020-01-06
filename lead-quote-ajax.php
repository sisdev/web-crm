<?php  
//action.php
//ob_start();
//session_start();
//error_reporting(1);

include 'include/dbi.php';
//include 'include/session.php';
//$connect = mysqli_connect('localhost', 'root', '', 'testing');
//header('Content-Type: application/json');
$input = filter_input_array(INPUT_POST);

//$txn_date = mysqli_real_escape_string($connect, $input["txn_date"]);
$description = mysqli_real_escape_string($conn, $input["description"]);




if($input["action"] === 'edit')
{
 $query = "
 UPDATE lead_quote 
 SET description = '".$description.
"' WHERE id = '".$input["id"]."'";

 mysqli_query($conn, $query);

 
 
}
if($input["action"] === 'delete')
{
 $query = "
 DELETE FROM lead_quote 
 WHERE id = '".$input["id"]."'
 ";
 mysqli_query($conn, $query);
 
}

echo json_encode($query);
//echo $query ;
?>