<?php
error_reporting(1);
session_start();
include 'include/dbi.php';
include 'include/session.php';
include 'include/param.php';
checksession();



if(isset($_GET['c_submit']))
{
	$id=$_GET['quote_v'];
	$query=mysqli_query($conn,"select * from lead_log where id = '$id'");
	$row=mysqli_fetch_array($query);
	$em=$row['email'];
	//echo $query;
}


if(isset($_GET['lead_id'])){
  $lead_id = $_GET['lead_id'];
  $lead_query = "SELECT * FROM lead_log where id='$id'";
  $lead_result = mysqli_query($conn, $lead_query);
  $row = mysqli_fetch_array($lead_result);
  $wr_query = "SELECT product_item.prod_name, lead_quote.id, lead_quote.description, lead_quote.qty, lead_quote.std_rate, lead_quote.discount, lead_quote.final_rate, lead_quote.amount from product_item JOIN lead_quote ON product_item.id=lead_quote.product_name where lead_quote.lead_id='$lead_id'";
  $wr_result = mysqli_query($conn, $wr_query);
  
}



?>



<?php
function fetchGST($conn ,$item_code)
{
 $query = "SELECT hsn_code,gst FROM product_group pg where pg.id = (select grp_id from product_item pi where  pi.id = $item_code)";
	echo "fetchGST:". $query ;
	$ret_array = array(0,0);

    $result = mysqli_query( $conn, $query);
	$num_rows = mysqli_num_rows($result);
	if ($num_rows ==0)
	{
		$gst_pct = 0 ;
	}
	else
	{
		$row = mysqli_fetch_array($result);
		$gst_pct = $row['gst'];
		$hsn_code = $row['hsn_code'];
		$ret_array[0] = $gst_pct ;
		$ret_array[1] = $hsn_code;
	}

        return $ret_array;	
}
	
?>






<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="icon" type="image/png" href="images/icon.png" />
<title>Add Quote</title>

<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="js/jquery.tabledit.min.js"></script>

<script type="text/javascript">
  $(document).ready(function(){
  $("#add").click(function(){
   $("#item_div").css("display","block"); 
   $("#add").attr("disabled","disabled"); 
});
});
</script>

<script type="text/javascript" >
 function fetch_select(val)
{
 $.ajax({
 type: 'post',
 dataType: "text json",
 url: 'search-item-quote-ajax.php',
 data: {
  product_val:val
 },
 success: function (response) {
  // alert(response) ;
 // document.getElementById("branch_name").value=response[0].cmp_name+","+response[0].cmp_branch_office_name; 
  document.getElementById("std_rate").value=response[0].cost_price; 
  //document.getElementById("vendor_gst").value=response[0].vendor_gstin; 
 
 }
 });
}

 $(document).ready(function(){
  $("#discount").change(function(){
    var qty = $("#qty").val();
    var std_rate = $("#std_rate").val();
    var discount = $("#discount").val();
      //var rate = qty*std_rate;
      var discount_cost = std_rate*(discount/100);
      var final_rate = std_rate-discount_cost;
      var amount = final_rate*qty;
      document.getElementById("final_rate").value=final_rate; 
      document.getElementById("amount").value=amount; 
     // document.getElementById("amount").value=; 
   

  });
  });

function confirmCompletion(){
    var txt;
    txt = confirm("Do you want to confirm, Press Ok");
    return txt ;
  }
 </script>


<style>
.item_desc{
  background-color: #000;
  color:white;
  font-weight:bold;
  height:34px;
}

#item-list{list-style:none;margin-top:-3px;padding:0;width:120px; position: absolute; z-index: 1;}
#item-list li{padding: 10px; background: #ffffff; border-bottom: #bbb9b9 1px solid;}
#item-list li:hover{background:#ece3d2;cursor: pointer;}
.item_name{padding: 4px 18px;border: #a8d4b1 1px solid;border-radius:4px;}

#editable_table th {
  color:#ffffff;
 background: #39383d ;
 font-weight: bold;
}
</style>
</head>
<body style="background-color:#ccf2ff;">
  <div class ="container-fluid" >     <!-- body -->
  <div>
    <?php include 'header.inc.php'; ?>
  </div>
	  
	  <div style="margin-top:90px;">
<h2 class="text-primary text-center">Add Quote</h2>
</div>
	 <form class="form-horizontal" style="margin-left:10%;" method="GET">
<div style="width: 60%; margin-left: 17%;">
<div class="form-group row">
    <label class="control-label col-md-2" for="quote_v">Lead ID</label>  
  <div class="col-md-4">
	<input  name="quote_v"  placeholder="" required=required  class="form-control input-md" type="text">
  </div>

   <div>
	   <label class="control-label col-md-2" for="m"></label>
	   
    <input type="submit" name="c_submit" class="btn btn-info" value="Submit" style="padding:10px 3%; border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);"/>
	   </div>
	
</div>
		  </div>
	  </form>
	
	  
	
	  
	  
<div style="margin-top:90px;">
<h2 class="text-primary text-center">Prepare Quote</h2>
</div>
 <form class="form-horizontal" style="margin-left:10%;" method="GET" >
<div style="width: 60%; margin-left: 17%;">
<div class="form-group row">
    <label class="control-label col-md-2" for="wr_num">Lead ID</label>  
  <div class="col-md-4">
	<input  name="wr_num"  placeholder="" required=required value="<?php echo $row['id'] ; ?>" class="form-control input-md" type="text">
  </div>

   <label class="control-label col-md-2" for="txn_date">Date</label>  
  <div class="col-md-4">
	<input  name="ledger_name"  placeholder="" required=required value="<?php echo $row['req_dtm'] ; ?>" class="form-control input-md" type="text">
  </div>
</div>

<div class="form-group row">
 <label class="control-label col-md-2" for="cust_name">Customer Name</label>  
 <div class="col-md-4">
	<input  name="ledger_name"  placeholder="" required=required value="<?php echo $row['name'] ; ?>" class="form-control input-md" type="text">
  </div>

  <label class="control-label col-md-2" for="address">Address</label>  
  <div class="col-md-4">
	<input  name="ledger_name"  placeholder="" required=required value="<?php echo $row['address'] ; ?>" class="form-control input-md" type="text">
  </div>
</div>

<div class="form-group row">
  <label class="control-label col-md-2" for="phone">Phone</label>  
 <div class="col-md-4">
	<input  name="ledger_name"  placeholder="" required=required value="<?php echo $row['phone_no'] ; ?>" class="form-control input-md" type="text">
  </div>
 <label class="control-label col-md-2" for="name">Email</label>  
  <div class="col-md-4">
	<input  name="ledger_name"  placeholder="" required=required value="<?php echo $row['emailID'] ; ?>" class="form-control input-md" type="text">
  </div>
</div>
</div>
</form>

<div class="row">
  <div class="col-md-3"></div>
  <div class="col-md-9">
<form class="form-horizontal" action = "print-quote.php" method="GET" target="_xyz">
  <div class="form-group row">

  <label class="checkbox-inline col-md-3"><input type="checkbox" name="discount_show" value="1">Show Discount</label>
   <label class="control-label col-md-1" for="name" >GST</label>  
  <div class="col-md-1">
 <input type="text" class="form-control input-sm" value="18" name="gst" />
</div>
  <input type = "hidden" name ="view_id" value ="<?php echo $id; ?>" />
  <input type="submit" value="Quote Preview" class="btn btn-info" style="border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);">
</div>
</form> 
</div>


</div>

	</div>

  

<div style="position:absolute; width:100%; left:0; right:0; margin-top: 177px;">
    <?php include("footer.inc.php"); ?>
    </div>


<script>  
$(document).ready(function(){  
     $('#editable_table').Tabledit({
      url:'lead-quote-ajax.php',
      columns:{
       identifier:[0, "id"],
       editable:[[2, 'description']]
      },
      restoreButton:false,
      onSuccess:function(data, textStatus, jqXHR)
      {
  //  console.log(data) ;
//alert("11111") ;
//alert(textStatus) ;
//alert(jqXHR.responseText );   
//alert(data.action);
       if(data.action == 'delete')
       {

        $('#'+data.id).remove();
        //alert("1111");
       }
        //location.reload();
       //document.location.reload(true);
      }
     
     });

});  
 </script>
	

</body>
</html>