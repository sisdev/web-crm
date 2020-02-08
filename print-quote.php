<?php
session_start();
include 'include/session.php';
include 'include/dbi.php';
include 'include/param.php';
//include 'fpd/email.php';
$dtm = getLocalDtm();

$i = 1;
if(isset($_GET['view_id'])){
  $lead_id = $_GET['view_id'];
  $gst = $_GET['gst'];
  if(empty($_GET['discount_show']) && isset($_GET['discount_show'])){
  $discount_show = $_GET['discount_show'];
}
  
$lead_result = mysqli_query($conn, "SELECT * FROM lead_log where id='$lead_id'");
$lead_row = mysqli_fetch_array($lead_result);
$wr_query = "SELECT product_item.prod_name, lead_quote.id, lead_quote.description, lead_quote.qty, lead_quote.std_rate, lead_quote.discount, lead_quote.final_rate, lead_quote.amount from product_item JOIN lead_quote ON product_item.id=lead_quote.product_name where lead_quote.lead_id='$lead_id'";
$work_quote_result = mysqli_query($conn, $wr_query);
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
  $gst_array = fetchGST($conn, $product_id);
 
	$gst_per = $gst_array[0];
	$hsn_sac = $gst_array[1];
	echo "1233:". $gst_per .":". $hsn_sac;
 $gst_amt = ($final_rate * $gst_per)/100 ;
	echo "2345:", $gst_amt ;
	
	
 
    $query = '
     INSERT INTO lead_quote(lead_id, product_name, description, qty, std_rate, discount, final_rate, amount,hsn_code, gst_per, gst_amt) 
     VALUES("'.$lead_id.'","'.$product_id.'","'.$description.'", "'.$qty.'", "'.$std_rate.'", "'.$discount.'", "'.$final_rate.'","'.$amount.'", "'.$hsn_sac.'", "'.$gst_per.'","'.$gst_amt.'");';
     echo $query;
     $result = mysqli_query($conn, $query);
      
     if ($result==false){
     $error=mysqli_error($conn) ;
     echo "<BR>Error in Insert".$error;
     die($error) ;
      }
      echo "<meta http-equiv='refresh' content='0'>";
     // echo"<script>document.location.reload(true); </script>";
      //exit();
     // header("Location: work-request-estimation-quote.php");
  }
  




$html_str = "";
$html_str .= "<html>";
$html_str .= "<head>" ;
$html_str .= '<link rel="icon" type="image/png" href="images/icon.png" />';
$html_str .= '  <title>Quote'.$lead_row["id"].'</title>';
$html_str .= '<meta charset="utf-8">';
 $html_str .= '<meta name="viewport" content="width=device-width, initial-scale=1">';
$html_str .= '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">';
 $html_str .= '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>';
 $html_str .= '<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>';

$html_str .= "<style>
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
   #email_btn{
   display:none !important;
   }
}
</style>";

$html_str .="<script>
function printBill(){
  window.print();
}
</script>";



$html_str .= "</head>";

$html_str .= "<body>";
$html_str .= '<page class="A4">';
$html_str .= '<div class="lead_row">
<div align="center"><u><b>QUOTATION</b></u></div>
</div> <br/>';

$html_str .= '<table style="width:97%; margin-left: 1%;" border="1">';
  $html_str .= '<tr>';
    $html_str .= '<td>';
     $html_str .= '<span style="float:right; ">Mobile No: '.$org_phone1.'</span>';
//     $html_str .= '<table border="1" style="float: right; height: 70px; margin-top: 37px;">';   
//      $html_str .= '<tr>';
//      $html_str .= '</tr>';
//      $html_str .= '<tr>';
//      $html_str .= '</tr>';
//      $html_str .= '</table>';

      $html_str .= '<span style="">GSTIN: '.$org_gstin.'</span>';
      //$html_str .= '<span style="float: right; text-align:20px;">Mobile No: '.$org_phone1.'</span><br>';
     
     $html_str .= '<br>';
      $html_str .= '<div align="center" >';
      $html_str .= '<b style=" font-size: 19px;">'.$org_name.'</b>';
      $html_str .= '</div>';
      $html_str .= '<div align="center" style="font-size: 12px;">
        '.$org_address1.'<br>'.$org_address2.'
      </div>';
//      $html_str .= '<br>';
//      $html_str .= '<span style="font-size: 13px; font-weight: bold;">'.$lead_row["name"].'</span><br>';
//      $html_str .= '<span style="font-size: 13px; font-weight: bold;">'.$lead_row["emailID"].'</span><br>';
//      $html_str .= '<span style="font-size: 13px; font-weight: bold;">'.$lead_row["comp_name"].'</span>';
    
   $html_str .= '</td>';
    
  $html_str .= '</tr>';

  
$html_str .= '</table>';

      $html_str .= '<br>&nbsp;&nbsp;&nbsp;&nbsp;<b> Quotation No: </b>'.$lead_row["id"];
      
      $html_str .= '<style="float: right;> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Date:</b> '.SUBSTR($lead_row["req_dtm"],0,10).'<br></style>';

      $html_str .= '<br> &nbsp;&nbsp;&nbsp;To,<br>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>'.$lead_row["name"].'</b><br>';
	  $company_name = $lead_row["comp_name"] ; 
	  if (!empty($company_name))
				$html_str .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$company_name ;
      $html_str .= '<br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$lead_row["add_street"].','.$lead_row["add_sector"].','.$lead_row["add_city"].'  <br>      <br>';
      $html_str .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Sub</b>: Quotation <br>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dear Sir/Madam <br><br>";

   

$html_str .= '<table style="width:98%; margin-left: 1%;" border="1" id="print">';
  $html_str .= '<tr>';
        $html_str .= '<th style="text-align: center;">&nbsp;S. No.</th>';
        $html_str .= '<th >&nbsp;&nbsp;Product Name </th>';
        $html_str .= '<th >&nbsp;&nbsp;Description </th>';
        $html_str .= '<th style="text-align: center;">Qty</th>';
         
    if(isset($_GET['discount_show'])){
		
      
        $html_str .= '<th>Std Rate</th>';   
        $html_str .= '<th>Discount_%</th>';   
        
        }
          
       $html_str .= '<th style="text-align: center;">Final Rate</th>';     
        $html_str .= '<th style="text-align: center;">Amount</th>' ;   
  $html_str .= '</tr>';



$sub_total =0;

$total =0 ;
while($wr_row = mysqli_fetch_array($work_quote_result))
{
$sub_total += $wr_row['amount'];


$html_str .= '<tr>' ; 
    $html_str .= '<td style="text-align: center;">'.$i.'</td>';
    $html_str .= '<td >&nbsp;&nbsp;'.$wr_row["prod_name"].'</td>';
    $html_str .= '<td >&nbsp;&nbsp;'.$wr_row["description"].'</td>';
    $html_str .= '<td style="text-align: center;">'.$wr_row["qty"].'</td>';
     
    if(isset($_GET['discount_show'])){
     
    $html_str .= '<td>'.$wr_row["std_rate"].'</td>';
    $html_str .= '<td style="text-align: center;">'.$wr_row["discount"].'</td>';
    
      }
   
    $html_str .= '<td style="text-align: center;">'.$wr_row["final_rate"].'</td>';
    $html_str .= '<td style="text-align: center;">'.$wr_row["amount"].'</td>';
$html_str .= '</tr>';

     

     $i++;
  }
  $gst_amt = $sub_total*($gst/100);
  $total = $sub_total+$gst_amt;
  
  
$html_str .= '</table>';

$html_str .= '<br/><br/>';   // Three lines after the table 

// $html_str .= '<hr id="line">';

 $html_str .= '<table style=" width:40%; line-height: 20px;">';
$html_str .= '<tr>';
  $html_str .= '<td style="text-align: right;">';
    $html_str .= '<b>Sub Total:</b>'.number_format($sub_total,2).'';
  $html_str .= '</td>';
$html_str .= '</tr>';
    
    if(isset($_GET['gst']) && ($_GET['gst'] != 0)){
     
$html_str .= '<tr>';
  $html_str .= '<td style="text-align: right;">';
    $html_str .= '<b>GST Amount:</b> 0'.number_format($gst_amt,2).'';
  $html_str .= '</td>';
$html_str .= '</tr>';

  }

$html_str .= '<tr>';
  $html_str .= '<td style="text-align: right;">';
    $html_str .= '<b>Total:</b>'.number_format($total,2).'';
  $html_str .= '</td>';
$html_str .= '</tr>';
 $html_str .= '</table>';
$html_str .= '<br><br><br><br>';

$html_str .= '<div style="margin-left:25px; line-height: 25px;">';

$html_str .= '<span ><b>Thanking You</b></span><br>';

$html_str .= '<span >For&nbsp;&nbsp;'.$org_name.'</span><br>';
$html_str .= '<span >Auth. Signatory</span><br>';
$html_str .= '<span >Note:</span><br>';
$html_str .= '</div>';
$html_str .= '<div style="text-align:center; margin-top:10px; margin-right: 10px;">';
$html_str .= '<form action="" method="post">';
$html_str .= '<button id="print_btn" onclick="printBill()" style="padding: 10px 30px; ">Print</button>';
//$html_str .= '1233344444';
$html_str .= '</form>';

$html_str .= '<form action="quote_email.php" method="GET">';
//$html_str .= '555555555555';
$html_str .= '<input type = "hidden" name ="view_id" value ='.$lead_id.' />';
 $html_str .= '<button id="email_btn" name ="submit" value="" style="padding: 10px 30px; ">Email</button>';
$html_str .= '</form>';
$html_str .= '</div>';
///$html_str .= '</form>';	
$html_str .= "</page>";
$html_str .= "</body>";
$html_str .= "</html>"; 
echo $html_str ;


$file = 'quote\quote_mail.html';
$data = '$html_str';
file_put_contents($file, $html_str);
?>