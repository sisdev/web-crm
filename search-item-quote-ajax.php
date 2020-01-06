<?php
ob_start();
session_start();
include 'include/dbi.php';
include 'include/session.php';
checksession();
header("Content-Type: application/json; charset=UTF-8");
$product_val = $_POST['product_val'] ;
//$reg = '2017-004' ;
//echo "<BR>:".$reg ;
//$qry = "SELECT * FROM tbl_vendor where id='$vendor_val' LIMIT 1" ;
$qry ="SELECT product_item.id, product_item.prod_name, product_item.cost_price, product_group.hsn_code, product_group.gst  FROM `product_item` JOIN product_group on  product_item.grp_id=product_group.id where product_item.id='$product_val'";
$result = mysqli_query($conn,$qry );

$outp = array();
while($data = mysqli_fetch_assoc($result)) 
    {
       $outp[] = $data;
    }

echo json_encode($outp);
?>