<?php
ob_start();
session_start();
include 'include/dbi.php';
include 'include/session.php';
checksession();
if (isset($_POST['upload'])) 
{
    $batchid = $_POST['batchid'];
    $startdate = $_POST['startdate'];
    $coursename = $_POST['coursename'];
    $duration = $_POST['duration'];
    $facultyprofile = $_POST['facultyprofile'];
    $daytime = $_POST['daytime'];
	$coursefee= $_POST['coursefee'];
    $noofseat = $_POST['noofseat'];
    $eventsql = "INSERT INTO trng_batches(batch_id,start_date,course_name,duration,faculty_profile,day_and_time,course_fee,no_of_seats) VALUES('$batchid','$startdate','$coursename','$duration','$facultyprofile','$daytime','$coursefee','$noofseat')";
	
	echo $eventsql ;
       if( mysqli_query($conn,$eventsql))
	   {
        header("location:add_batch.php?msg= Batch Added Successfully..");
       echo "Batch added successfully";
	   }
	   else 
	   {
		   $error = mysqli_error($conn); 
		   echo $error;
        
	   }
}
    else {
        echo "Fail";
		 }
?>
