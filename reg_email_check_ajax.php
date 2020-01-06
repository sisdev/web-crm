<?php
	ob_start();
	session_start();

	include 'include/dbi.php';
	include 'include/session.php';
	checksession();

	if(isset($_POST['u_email'])){
		$u_email = $_POST['u_email'];
		$sql = mysqli_query($conn,"select email from user_profile where email='$u_email'");
		if(mysqli_num_rows($sql)){
			echo '<STRONG>'.$u_email.'</STRONG> is already in use.';
		}else{
			echo 'OK';
		}
	}
?>