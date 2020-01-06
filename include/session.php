<?php
include 'dbi.php';


 function getLocalDtm() {
	date_default_timezone_set('Asia/Kolkata');
	$dtm=date("Y-m-d H:i:s"); 
	return $dtm ;
    }
	
////////////////////////////////////////////// FUNCTION TO LOGIN////////////////////////
    function checklogin($conn,$user,$pass) {

        $user = mysqli_real_escape_string($conn,$user);
        $pass = mysqli_real_escape_string($conn,$pass);
	
        $loginquery = "SELECT * FROM tbl_staff WHERE username='$user' AND password='".$pass."' AND status='active'";
        $login      = mysqli_query($conn,$loginquery);
        $check      = mysqli_num_rows($login);
		echo"<script>alert('Invalid Username/Password, Please Try Again!'); window.location='index.php';</script>";
        if($check > 0) {
            $_SESSION['login'] = $user;
            header("location:admin_page.php");

        }
        else {

        // header("location:index.php?msg=Error");
        }

    }
////////////////////////////////////////////// FUNCTION TO CHECK SESSION////////////////////////
    function checksession() {
        if(empty($_SESSION['login'])) {
            header('Location:index.php?l=2');
            exit;
        }
    }
////////////////////////////////////////////// FUNCTION TO LOG OUT////////////////////////
    function logout() {
        session_destroy();
        session_unset($_SESSION["login"]);
        return 1;
    }

///////////////////////////////////////////////////Function TO DELETE A FILE//////////////////////

    function file_delete($file)
  	 {
  	     //chmod($file,0777);
  	     unlink($file);
         return 1;
  	 }


?>
