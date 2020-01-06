<?php
session_start();
include 'include/session.php';
include 'include/dbi.php';
include 'include/param.php';
$dtm = getLocalDtm();

$i = 1;
if(isset($_GET['view_id'])){
  $lead_id = $_GET['view_id'];
  $gst = $_GET['gst'];
  $quote_dt = $_GET['quote_date'];
  if(empty($_GET['discount_show']) && isset($_GET['discount_show'])){
  $discount_show = $_GET['discount_show'];
}
  
$lead_result = mysqli_query($conn, "SELECT * FROM lead_log where id='$lead_id'");
$lead_row = mysqli_fetch_array($lead_result);
$wr_query = "SELECT product_item.prod_name, lead_quote.id, lead_quote.description, lead_quote.qty, lead_quote.std_rate, lead_quote.discount, lead_quote.final_rate, lead_quote.amount from product_item JOIN lead_quote ON product_item.id=lead_quote.product_name where lead_quote.lead_id='$lead_id'";
$work_quote_result = mysqli_query($conn, $wr_query);
}
?>
<html>
<head>
  <link rel="icon" type="image/png" href="images/icon.png" />
  <title><?php echo "Quote".$lead_row['id']; ?></title>

<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<style>
#print th, #print td{
border: 1px solid black;
border-collapse: collapse;
}
#print{
  width: 100%;
}
#print th{
  font-size: 14px;
}
#print td{
  font-size: 11px;
}
#line{
   display: block;
   
    border: 2px solid black;
   
}

@page {
  background: white;
  display: block;
  margin: 0 auto;
  margin-bottom: 0.5cm;
  
}
body{
  width: 21cm;
  height: 29.7cm;
  margin-left: 360px;
  box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
}
@page{  
  width: 21cm;
  height: 29.7cm;
}
@media print {
  @page {
    margin: 0;
  }
  body{margin: 1.6cm; border-style: 1px solid black;}
   #print_btn{
       display:none !important;
   }
}
</style>

<script>
function printBill(){
  window.print();
}
</script>
</head>

<body>
<page class="A4">
<div class="lead_row">
<div align="center"><u><b>QUOTATION</b></u></div>
</div>

<table style="width:98%; margin-left: 1%;" border="1">
  <tr>
    <td>
      <table border="1" style="float: right; height: 90px; margin-top: 37px;">
      <tr>
      <th style="padding: 2px;">Quotation No:</th> <td style="padding: 2px;"><?php echo $lead_row['id']; ?></td>
      </tr>
      <tr>
      <th style="padding: 2px;">Date: </th><td style="padding: 2px;"> <?php echo $quote_dt; ?></td>
      </tr>
      </table>

      <span style="">GSTIN: <b>09AAOCS7654P3Z5</b></span>
      <span style="float: right;">Mobile No: 9999283283</span><br>
     
     <br>
      <div align="center" >
      <b style=" font-size: 19px;">Sisoft Technologies</b>
      </div>
      <div align="center" style="font-size: 12px;">
        SRC E7-E8, Shipra Riviera, Gyan Khand-3,Indirapuram
      </div>
	  <div align="center" style="font-size: 12px;">
         Ghaziabad - 201014
      </div>
      <br>
      <span style="font-size: 13px; font-weight: bold;"></span><br>
      <span style="font-size: 13px; font-weight: bold;"></span>
    
    </td>
    
  </tr>

  
</table>

      <br>
      &nbsp;&nbsp;&nbsp;To,<br>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Mr. <?php echo $lead_row['name']; ?></b><br>
	  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> <?php echo $lead_row['comp_name']; ?></b><br>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $lead_row['add_street'].",".$lead_row['add_city']; ?>
      <br>
      <br>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Sub</b>: Quotation <br><br>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dear Sir <br>

   
<br>
<table style="" id="print">
  <tr>
        <th>&nbsp;S. No.</th>
        <th>Product Name </th>
        <th>Description </th>
        <th>Qty</th> 
          <?php 
    if(isset($_GET['discount_show'])){
      ?>
        <th>Std Rate</th>      
        <th>Discount_%</th>   
        <?php
        }
        ?>    
        <th>Final Rate</th>       
        <th>Amount</th>      
  </tr>

<?php

$sub_total =0;

$total =0 ;
while($wr_row = mysqli_fetch_array($work_quote_result))
{
$sub_total += $wr_row['amount'];

?>
<tr>  
    <td style="text-align: center;"> <?php echo $i; ?></td>
    <td><?php echo $wr_row['prod_name']; ?></td>
    <td><?php echo $wr_row['description']; ?></td>
    <td><?php echo $wr_row['qty']; ?></td>
     <?php 
    if(isset($_GET['discount_show'])){
      ?>
    <td><?php echo $wr_row['std_rate']; ?></td>
    <td style="text-align: center;"><?php echo $wr_row['discount']; ?></td>
    <?php
      }
    ?>
    <td style="text-align: center;"><?php echo $wr_row['final_rate']; ?></td>
    <td style="text-align: center;"><?php echo $wr_row['amount']; ?></td>
</tr>

     <?php

     $i++;
  }
  $gst_amt = $sub_total*($gst/100);
  $total = $sub_total+$gst_amt;
  
   ?> 
</table>
 <hr id="line">

 <table style=" width:40%; line-height: 20px;">
<tr>
  <td style="text-align: right;">
    <b >Sub Total:</b> <?php echo number_format($sub_total,2); ?>
  </td>
</tr>
    <?php 
    if(isset($_GET['gst']) && ($_GET['gst'] != 0)){
      ?>
<tr>
  <td style="text-align: right;">
    <b>GST Amount:</b> 0<?php echo number_format($gst_amt,2); ?>
  </td>
</tr>
  <?php
  }
  ?>
<tr>
  <td style="text-align: right;">
    <b>Total:</b> <?php echo number_format($total,2); ?>
  </td>
</tr>
 </table>
<br>
<br>
<br>
<br>
<div style="margin-left:25px; line-height: 25px;">
<span >Note:</span><br>
<span ><b>Thanking You</b></span><br>
<span >For Sisoft Technologies Pvt Ltd</span><br>
<span >Auth. Signatory</span><br>
</div>
<div style="text-align:center; margin-top:10px; margin-right: 10px;">
 <button id="print_btn" onclick="printBill()" style="padding: 10px 30px; ">Print</button>
</div>
</page>
</body>
</html>