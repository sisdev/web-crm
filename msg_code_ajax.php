<?php 
ob_start();
session_start();
include 'include/dbi.php';
include 'include/session.php';

checksession();
if (isset($_POST['get_option'])) {
    $qry = "select msg_txt from `msg_template` where msg_code='" . $_POST['get_option']."'";
    $rec = mysqli_query($conn, $qry);
    if (mysqli_num_rows($rec) > 0) {
        while ($res = mysqli_fetch_array($rec)) {
            echo $res['msg_txt'];
        }
    }
}
?>