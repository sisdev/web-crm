<?php
	ob_start();
	session_start();

	include 'include/dbi.php';
	include 'include/session.php';
	checksession();

	if(isset($_POST['reg'])){
		$reg_no = $_POST['reg'];
		$sql = mysqli_query($conn,"select reg_id from user_profile where reg_id='$reg_no'");
		if(!mysqli_num_rows($sql)){
			echo '<STRONG>'.$reg_no.'</STRONG> is wrong Registraion No.';
		}else{
			echo 'OK';
		}
	}
?>