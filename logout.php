<?php
ob_start(); 
session_start();
include 'include/dbi.php';
include 'include/session.php';
logout();
header("location: index.php");
?>
