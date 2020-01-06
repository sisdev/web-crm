<?php
	ob_start();
	session_start();
	include 'include/dbi.php';
	include 'include/session.php';
	checksession();

	if(isset($_POST['username'])){
		$username = $_POST['username'];
		$sql = mysqli_query($conn,"select email from tbl_staff where username='$username'");
		if(mysqli_num_rows($sql)){
			echo '<STRONG>'.$username.'</STRONG> is already in use.';
		}else{
			echo 'OK';
		}
	}
?>