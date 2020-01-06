<?php
	error_reporting(1);
	ob_start();
	session_start();
	include 'include/dbi.php';
	include 'include/session.php';
	include 'include/param.php';
	checksession();
	$dtm_upload= getLocalDtm();
	$i=1;
	$uName = $_SESSION['login'];
	$base_qry="select * FROM sales_document where user_name='$uName' ORDER BY dtm_upload DESC";	
	$result = mysqli_query($conn,$base_qry) ;
	$err=mysqli_error($conn);
	echo $err;
	
	$all_base_qry="select * FROM sales_document ORDER BY dtm_upload DESC";	
	$all_result = mysqli_query($conn,$all_base_qry) ;
	$err=mysqli_error($conn);
	echo $err;
	
?>
<html>
<head>
<title>Document Files View & Upload</title>
<link rel="icon" type="image/png" href="images/icon.png" />
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<meta http-equiv="Content-Type" content="text/html;"/>

<style>
#tab_myfiles a{
	width:140px;
	border-radius:0; 
	font-size:15px;
	
}
#tab_allfiles a{
	width:140px;
	border-radius:0; 
	font-size:15px;
	
}
#tab_myfiles a:hover{
	background-color:#337ab7;
	color:white;
}
#tab_allfiles a:hover{
	background-color:#337ab7;
	color:#ffffff;
}

table{
	
	width:100%;
	table-layout:fixed;
}
tbody{
	word-wrap: break-word;
}
  tbody:nth-of-type(odd) {
 background: #99d6ff ;
}
th {
 background: #ffb3b3 ;
 font-weight: bold;
}

@media only screen and (max-width: 800px) {
        /* Force table to not be like tables anymore */
        #no-more-tables table,
        #no-more-tables thead,
        #no-more-tables tbody,
        #no-more-tables th,
        #no-more-tables td,
        #no-more-tables tr {
        display: block;
		
        }
         
        /* Hide table headers (but not display: none;, for accessibility) */
        #no-more-tables thead tr {
        position: absolute;
        top: -9999px;
        left: -9999px;
        }
         
        #no-more-tables tr { border: 1px solid #ccc; }
          
        #no-more-tables td {
        /* Behave like a "row" */
        border: none;
        border-bottom: 1px solid #eee;
        position: relative;
        padding-left: 50%;
        white-space: normal;
        text-align:left;
        }
         
        #no-more-tables td:before {
        /* Now like a table header */
        position: absolute;
        /* Top/left values mimic padding */
        top: 6px;
        left: 2px;
		right: 2px;
        width: 55%;
        padding-right: 10px;
        white-space: nowrap;
        text-align:left;
        font-weight: bold;
        }
         
        /*
        Label the data
        */
        #no-more-tables td:before { content: attr(data-title); }
        }
</style>
</head>
	
	
	<body style="background-color:#ccf2ff">
	<div class="container-fluid" >
	<div>
		<?php include 'header.inc.php'; ?>
	</div>
	<div style="margin-top:90px;">
	<h2 class="text-primary text-center">Document Files</h2>
	<button class="btn btn-success" id="upload_btn" style="float:right; border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);">Upload &nbsp;<i class="fa fa-cloud-upload" aria-hidden="true"></i></button>
	
	<div id='tabs'>
	<ul class='nav nav-tabs'>
		<li id='tab_myfiles' class='active'><a data-toggle='tab' href='#myfiles'>My Files</a></li>
		<li id='tab_allfiles' ><a data-toggle='tab' href='#allfiles'>All Files</a></li>
	</ul>
	</div>
	</div> 
	
<div id="upload_form" style="display:none;">
<h3 class="text-primary text-center">Upload File</h3>
<p class="text-center">Upload files PDF, TEXT, PNG, JPG, JPEG, MP4 Only</p>
<div style="margin-left:27%;">

<form class="form-horizontal" method="POST" enctype="multipart/form-data">
<div class="form-group row">
 <label class="control-label col-md-2"  for="f_desc">File Description<span style="color:red">*</span></label>  
  <div class="col-md-4">
	<input  name="f_desc" required=required class="form-control input-md" type="text">
  </div> 
  </div> 
  <div class="form-group row">
 <label class="control-label col-md-2"  for="f_upload">Upload File<span style="color:red">*</span></label>  
  <div class="col-md-4">
	<input  name="fileToUpload" class="form-control input-md" type="file">
  </div>
  </div>
  
 <div class="form-group" style="margin-left:215px;">
  <label class="control-label" for="upload"></label>
  
    <button type="submit" name="upload" class="btn btn-info" value="Upload" style="border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19); padding:10px 7%;">Upload &nbsp;<i class="fa fa-cloud-upload" aria-hidden="true"></i></button>
 </div>
</form>
</div>
</div>
	
	<div id="myfiles_table">
	<div class="col-md-1"></div>
	<div id="no-more-tables" class="col-md-10">
	<table class="table table-bordered table-stripped table-bordered  table-condensed" style="text-align:center;">
	<thead>
		<th style='color:#b30059; text-align:center;'>#</th>
		<th style='color:#b30059; text-align:center;'>File Name</th>
		<th style='color:#b30059; text-align:center;'>Description</th>		
		<th style='color:#b30059; text-align:center;'>Size</th>
		<th style='color:#b30059; text-align:center;'>View</th>
	</thead>

	<?php
			  while($row = mysqli_fetch_array($result))
			   {
	 ?>	
				<tbody>
				<tr>
					<td data-title="#"><?php echo $i;?></td>
					<td data-title="File Name"><?php echo $row['doc_name'] ;?></td>
					<td data-title="Description"><?php echo $row['doc_desc'] ;?></td>
					<td data-title="Size"><?php echo $row['file_size'] ; ?></td>
					<td data-title="View">
						<form action="document-view.php" method="GET">
							<input type = "hidden" name="view_id1" value="<?php echo base64_encode($row['id']); ?>"/>
							 <input type="submit" class="btn btn-info" id="view" value="View" style="border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);"/>
						</form>
					</td>
				</tr>
				</tbody>
	<?php		

	$i++;	
		}	  
	?>
	</table>
	</div>
	</div>
	
	<div id="allfiles_table" style="display:none;">
	<div class="col-md-1"></div>
	<div id="no-more-tables" class="col-md-10">
	<table class="table table-bordered table-stripped table-bordered  table-condensed" style="text-align:center;">
	<thead>
		<th style='color:#b30059; text-align:center;'>#</th>
		<th style='color:#b30059; text-align:center;'>File Name</th>
		<th style='color:#b30059; text-align:center;'>Description</th>		
		<th style='color:#b30059; text-align:center;'>Size</th>
		<th style='color:#b30059; text-align:center;'>Username</th>
		<th style='color:#b30059; text-align:center;'>View</th>
	</thead>

	<?php
		$j=1;
			  while($all_row = mysqli_fetch_array($all_result))
			   {
	 ?>	
				<tbody>
				<tr>
					<td data-title="#"><?php echo $j;?></td>
					<td data-title="File Name"><?php echo $all_row['doc_name'] ;?></td>
					<td data-title="Description"><?php echo $all_row['doc_desc'] ;?></td>
					<td data-title="Size"><?php echo $all_row['file_size'] ; ?></td>
					<td data-title="Username"><?php echo $all_row['user_name'] ; ?></td>
					<td data-title="View">
						<form action="document-view.php" method="GET">
							<input type = "hidden" name ="view_id2" value ="<?php echo base64_encode($all_row['id']); ?>"/>
							 <input type="submit" class="btn btn-info" id="view" value="View" style="border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);"/>
						</form>
					</td>
				</tr>
				</tbody>
	<?php		

	$j++;	
		}	  
	?>
	</table>
	</div>
	</div>
	
<?php
$folder_qry_upload="SELECT user_folder_name from tbl_admin where username='$uName'";
$result_folder=mysqli_query($conn, $folder_qry_upload);
$folder_fetch=mysqli_fetch_array($result_folder);
$folder_name=$folder_fetch['user_folder_name'];

$maxFileSize = 64*1024*1024 ;  //64 MB 
$target_dir = $user_doc_location."/".$folder_name."/";
//echo $target_dir;

if (!mkdir($target_dir, 0777, true)) {
	//$error = error_get_last();
	//die('Failed to create folders...'.$folder_name.":".$error['message']);
	//error_log('Failed to create folders'.$folder_name) ;
}
else {
	$upd_dir = "UPDATE sales_document SET location='$target_dir' WHERE user_name = '$uName' " ;
	if ($debug) echo $upd_dir ;
	mysqli_query($conn,$upd_dir) ;
	}
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
if(isset($_POST["upload"])) {
    $check = $_FILES["fileToUpload"]["size"];
    if($check !== false) {
       // echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        //echo "File is not an image.";
        $uploadOk = 0;
    }
	if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
if ($_FILES["fileToUpload"]["size"] > $maxFileSize) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
if($FileType != "jpg" && $FileType != "png" && $FileType != "jpeg"
&& $FileType != "pdf" && $FileType == "ppt" && $FileType != "txt" && $FileType == "docx" && $FileType != "mp4") {
    echo "Sorry, only JPG, JPEG, PNG , PDF, TEXT, MP4 files are allowed.";
    $uploadOk = 0;
}
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

$file_desc=$_POST['f_desc'];
$file_name=$_FILES['fileToUpload']['name'];
$file_type=$_FILES['fileToUpload']['type'];
$file_size=$_FILES['fileToUpload']['size'];
$location=$target_dir;
$ip=$_SERVER['REMOTE_ADDR'];
mysqli_query($conn, "INSERT INTO sales_document(doc_desc, doc_name, location, file_type, file_size, dtm_upload, user_name, ip_add) VALUES('$file_desc','$file_name','$location','$file_type','$file_size','$dtm_upload','$uName', '$ip')") or die(mysqli_error($conn));
}

?>
<script>
 $(document).ready(function () { 
$("#tab_allfiles").click(function() {
 $('#allfiles_table').show();
 $('#myfiles_table').hide();
 });
 $("#tab_myfiles").click(function(){
    $('#allfiles_table').hide();
    $('#myfiles_table').show();
	
    });
});
</script>

<script>
 $(document).ready(function () { 
$("#tab_allfiles").click(function() {
 $('table').show();
 });
 $("#tab_myfiles").click(function(){
    $('.table').show();
	
    });
});
</script>

<script>
 $(document).ready(function (){ 
$("#upload_btn").click(function() {
 $('#upload_form').show();
 $('#upload_form').css("margin-bottom","212px");
 $('.table').hide();
 });
 $("#tab_myfiles").click(function(){
    $('#upload_form').hide();
	
    });
	$("#tab_allfiles").click(function(){
    $('#upload_form').hide();
    });
});
</script>

</div>
<div style="position:flex; bottom:0; width:100%; left:0; right:0;">
		<?php include("footer.inc.php"); ?>
	</div>	
	</body>
</html>