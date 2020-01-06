<title>Uploaded Files View</title>
					<link rel="icon" type="image/png" href="images/icon.png" />
<?php
error_reporting(1);
ob_start();
include 'include/dbi.php';
include 'include/session.php';
if($_GET['view_id1']){
	$view_id=base64_decode($_GET['view_id1']);
	$view_qry="SELECT * from sales_document where id='$view_id'";
	$view_res=mysqli_query($conn, $view_qry);
	$view_array=mysqli_fetch_array($view_res);
	$fileName=$view_array['doc_name'];
	$fileType=$view_array['file_type'];
	$loc=$view_array['location'];
}

if($_GET['view_id2']){
	$view_id=base64_decode($_GET['view_id2']);
	$view_qry="SELECT * from sales_document where id='$view_id'";
	$view_res=mysqli_query($conn, $view_qry);
	$view_array=mysqli_fetch_array($view_res);
	$loc=$view_array['location'];
	//echo $loc;
	$fileName=$view_array['doc_name'];
	$fileType=$view_array['file_type'];
}
?>

					<?php						
							if ($fileType == "video/mp4") {
					?>
					
					<div align="center" class="embed-responsive embed-responsive-16by9">
						<video id="myVideo" class="embed-responsive-item" controls autoplay>
							<source src="uploads/<?php echo $fileName;?>" type="video/mp4">
							Your browser does not support the video tag.
						</video>
					</div>
					<?php }
					
					else if ($fileType == "text/pdf" || $fileType == "application/pdf"){ ?>
					<div align="center" style="width: 100%; height: 100%; display: block;">
						 <object style="width: 100%; height: 100%;" type="application/pdf" data="<?php echo $loc.'/'.$fileName;?>"></object> 
					</div>
					<?php }
					
					else if ($fileType == "text/plain"){ ?>
					<div align="center" style="width: 100%; height: 100%; display: block;">
						 <object style="width: 100%; height: 100%;" type="text/plain" data="<?php echo $loc.'/'.$fileName;?>"></object> 
					</div>
					
					<?php }
					
					else if ($fileType == "image/png" || $fileType == "image/jpg" || $fileType == "image/jpeg") { ?>
					<div align="center" style="width: 100%; height: 100%; display: block;">
							<img  style="width: 100%; height: 100%;" src="<?php echo $loc.'/'.$fileName;?>" border="0"></img>
					</div>
					<?php }
					?>