<?php
ob_start();
session_start();
include 'include/dbi.php';
include 'include/session.php';
checksession();

?>

<html>
<body>
<?php if(isset($_POST['tname'])) { echo $_POST['tname']; }?><br/>
<?php if(isset($_POST['add'])) { echo $_POST['add']; } ?><br/>
<?php if(isset($_POST['ph1'])) { echo $_POST['ph1']; }?><br/>
<?php if(isset($_POST['ph2'])) { echo $_POST['ph2']; }?><br/>
<?php if(isset($_POST['email'])) { echo $_POST['email']; }?><br/>
<?php if(isset($_POST['crs'])) { echo $_POST['crs']; }?><br/>
<?phpif(isset($_POST['profile']))  { echo $_POST['profile']; }
?>

<?php
$sql="insert into trainer(tname,address,phone1,phone2,emailid,courses,profile) values('$_POST[tname]','$_POST[add]','$_POST[ph1]','$_POST[ph2]','$_POST[email]','$_POST[crs]','$_POST[profile]')";
if(!mysqli_query($conn,$sql))
{
die('Error : '.mysqli_error($conn));
}
echo "Record added";

header("Location:trainers.php");	
?>

</body>
</html>