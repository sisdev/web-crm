<?php
error_reporting(1);
session_start();
include 'include/dbi.php';
include 'include/session.php';
include 'include/param.php';
checksession();
$uploaded_by = $_SESSION['login'];
$dtm = getLocalDtm();

if(isset($_GET['lead_id'])){
  $lead_id = $_GET['lead_id'];
  $lead_query = "SELECT * FROM lead_log where id='$lead_id'";
  $lead_result = mysqli_query($conn, $lead_query);
  $row = mysqli_fetch_array($lead_result);
  $wr_query = "SELECT product_item.prod_name, lead_quote.id, lead_quote.description, lead_quote.qty, lead_quote.std_rate, lead_quote.discount, lead_quote.final_rate, lead_quote.amount from product_item JOIN lead_quote ON product_item.id=lead_quote.product_name where lead_quote.lead_id='$lead_id'";
  $wr_result = mysqli_query($conn, $wr_query);
  
}



if(isset($_POST['submit']))
{
  $product_id=$_POST['product_id'];
  $description=$_POST['description'];
  $qty=$_POST['qty'];
  $std_rate=$_POST['std_rate'];
  $discount=$_POST['discount'];
  $final_rate=$_POST['final_rate'];
  $amount = $_POST['amount'];
 
    $query = '
     INSERT INTO lead_quote(lead_id, product_name, description, qty, std_rate, discount, final_rate, amount) 
     VALUES("'.$lead_id.'","'.$product_id.'","'.$description.'", "'.$qty.'", "'.$std_rate.'", "'.$discount.'", "'.$final_rate.'", "'.$amount.'");
     ';
    // echo $query;
     $result = mysqli_query($conn, $query);
      
     if ($result==false){
     $error=mysqli_error($conn) ;
     echo "<BR>Error in Insert".$error ;
     die($error) ;
      }
      echo "<meta http-equiv='refresh' content='0'>";
     // echo"<script>document.location.reload(true); </script>";
      //exit();
     // header("Location: work-request-estimation-quote.php");
  }

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="icon" type="image/png" href="images/icon.png" />
<title>Prepare Quote</title>

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
<h2 class="text-primary text-center">Prepare Quote</h2>
</div>
<form class="form-horizontal">
<div style="width: 60%; margin-left: 17%;">
<div class="form-group row">
    <label class="control-label col-md-2" for="wr_num">Lead ID</label>  
  <div>
   <input class="form-control-static col-md-4" type="text" id="wr_num" name="wr_num" value="<?php echo $row['id']; ?>" readonly />
  </div>

   <label class="control-label col-md-2" for="txn_date">Date</label>  
  <div>
   <input class="form-control-static col-md-4" type="text" id="datePick" name="txn_date" value="<?php echo $row['req_dtm']; ?>" readonly/>
  </div>
</div>

<div class="form-group row">
 <label class="control-label col-md-2" for="cust_name">Customer Name</label>  
  <div>
  <input name="cust_name" class="form-control-static col-md-4 input-md" type="text" readonly value="<?php echo $row['name']; ?>">
  </div>

  <label class="control-label col-md-2" for="address">Address</label>  
  <div>
  <textarea class="form-control-static col-md-4" id="address" type="text" name="address" readonly ><?php echo $row['add_street'].",".$row['add_sector'].",".$row['add_city']; ?></textarea>
  </div>
</div>

<div class="form-group row">
  <label class="control-label col-md-2" for="phone">Phone</label>  
  <div>
 <input type="text" class="form-control-static col-md-4" readonly value="<?php echo $row['phone_no']; ?>"/>
</div>
 <label class="control-label col-md-2" for="name">Email</label>  
  <div>
 <input type="text" class="form-control-static col-md-4" readonly value="<?php echo $row['emailID']; ?>"/>
</div>
</div>
</div>
</form>

<div class="row">
  <div class="col-md-3"></div>
  <div class="col-md-9">
<form class="form-horizontal" action = "print-quote.php" method="GET" target="_xyz">
  <div class="form-group row">
  <label class="checkbox-inline col-md-2"><input type="checkbox" name="discount_show" value="1">Show Discount</label>
   <label class="control-label col-md-1" for="name" >GST</label>  
  <div class="col-md-1">
 <input type="text" class="form-control input-sm" value="18" name="gst" />
</div>
   <label class="control-label col-md-2" for="name" >Quote Date</label>  
   <input class="form-control-static col-md-2" type="text" id="datePick" name="quote_date" value="<?php echo substr($dtm,0,10); ?>" readonly/>
  <input type = "hidden" name ="view_id" value ="<?php echo $lead_id; ?>" />
  <input type="submit" value="Quote Preview" class="btn btn-info" style="margin-left: 10px; border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);">
</div>
</form> 
</div>

</form>
</div>
<hr style="border: 1px solid black; width:100%;">

<div class="col-md-12">
<table id="editable_table" class="table table-bordered table-striped">
     <thead>
      <tr>
        <th>#</th>
        <th>Product Name </th>
        <th>Description </th>
        <th>Qty</th> 
        <th>Std Rate</th>      
        <th>Discount_%</th>       
        <th>Final Rate</th>       
        <th>Amount</th>           
      </tr>
    </thead>
       <tbody>
  
  <?php
  while($wr_row = mysqli_fetch_array($wr_result))
  {
  ?>
    <tr>
        <td><?php echo $wr_row['id']; ?></td>
        <td><?php echo $wr_row['prod_name']; ?></td>
        <td><?php echo $wr_row['description']; ?></td>
        <td><?php echo $wr_row['qty']; ?></td>
        <td><?php echo $wr_row['std_rate']; ?></td>
        <td><?php echo $wr_row['discount']; ?></td>
        <td><?php echo $wr_row['final_rate']; ?></td>
        <td><?php echo $wr_row['amount']; ?></td>
    </tr>

    <?php
   
  }
    ?>
    </tbody>
  
   
  </table>
</div>

<div class="row">
 <div class="col-md-1" id='searchOutput' style="float: left;"></div>
 <div class="col-md-1" style="float: right;">
    <input type='button' class="btn btn-md btn-primary" id="add"  style="border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);" value="+Add More" />
    </div>
  </div>
 
 <form class="form-horizontal" method="POST" onsubmit="document.location.reload(true)" enctype="multipart/form-data">
 <div id="item_div" style="margin-top: 3px; display: none;">
 <div class='row' id='th'>
  
  <div class='col-md-2 item_desc'>Product Name</div>
  <div class='col-md-2 item_desc'>Description</div>
  <div class='col-md-1 item_desc'>Qty</div>
  <div class='col-md-2 item_desc'>Std Rate</div>
  <div class='col-md-1 item_desc'>Discount_%</div>
  <div class='col-md-2 item_desc'>Final Rate</div>
  <div class='col-md-2 item_desc'>Amount</div>
  
</div>

<div class='row' style='margin-top:2px;'> 
    <div class='col-md-2'>
    <select class="form-control" name="product_id" onchange="fetch_select(this.value);">
    <option selected disabled="">Select Product</option>
    <?php
    $product_qry = mysqli_query($conn, "SELECT * from product_item");
    while( $fetch = mysqli_fetch_array($product_qry))
    {
      $cust_db_id = $fetch['id'];
   
    ?>
    <option value="<?php echo $cust_db_id; ?>"><?php echo $fetch['prod_name']; ?></option>
    <?php
  }
?>
  </select>
      </div>
      
       <div class='col-md-2'>
        <input name='description' id="description" placeholder='' class='form-control input-sm' type='text'>
       </div>
      <div class='col-md-1'>
        <input name='qty' id="qty" placeholder='' class='form-control input-sm' type='text'>
       </div>
      <div class='col-md-2'>
       <input name='std_rate' id="std_rate" placeholder='' class='form-control input-sm' type='text'>
      </div>
    
        <div class='col-md-1'>
       <input name='discount' id="discount" placeholder='' class='form-control input-sm' type='text'>
        </div>
         <div class='col-md-2'>
       <input name='final_rate' id="final_rate" placeholder='' class='form-control input-sm' type='text' readonly>
        </div>
         <div class='col-md-2'>
       <input name='amount' id="amount" placeholder='' class='form-control input-sm' type='text' readonly>
        </div>
      
</div>

        <div class="form-group" align="center" style="margin-top:20px;">
  <label class=" control-label" for="upload"></label>
  <div>
    <input type="submit" name="submit" class="btn btn-info" value="Submit" style="padding:10px 3%; border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);"/>
    <input type="reset"  name="Reset" class="btn" value="Cancel"  onClick="window.location.reload();" style="padding:10px 3%; border-radius:0; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);"/>
  </div>
</div>
</form>
</div>
  

<div style="position:absolute; width:100%; left:0; right:0; margin-top: 177px;">
    <?php include("footer.inc.php"); ?>
    </div>
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