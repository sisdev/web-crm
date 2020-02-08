<?php
$company_name=$_POST['company_name'];
$ledger_name=$_POST['ledger_name'];
$ledger_group = $_POST['group'];
$address1 =$_POST['address1'];
$address2 =$_POST['address2'];
$state =$_POST['state'];
$pin    = $_POST['pin'];
$country =$_POST['country'];

$contact_person =$_POST['contact_person'];
$phone1 =$_POST['mobile_no'];
$phone2 =$_POST['phone'];
$email =$_POST['email_pri'];
$cc =$_POST['email_cc'];

$gst_reg_type =$_POST['gsttype'];
$gstin =$_POST['gstin'];

$opening_bal = "-2000" ;




$req_str =<<<XML
	

<ENVELOPE>

<HEADER>

<TALLYREQUEST>Import Data</TALLYREQUEST>

</HEADER>


<BODY>


<IMPORTDATA>


	<REQUESTDESC>

		<REPORTNAME>All Masters</REPORTNAME>
		<STATICVARIABLES>
			<SVCURRENTCOMPANY>$company_name</SVCURRENTCOMPANY>
		</STATICVARIABLES>


	</REQUESTDESC>


<REQUESTDATA>


<TALLYMESSAGE xmlns:UDF="TallyUDF">

	<LEDGER Action = "Create">
      <NAME.LIST TYPE="String">
			<NAME>$ledger_name</NAME>
	  </NAME.LIST>
	  <PARENT>Sundry Debtors</PARENT>

	  
      <ADDRESS.LIST TYPE="String">
       <ADDRESS>$address1</ADDRESS>
       <ADDRESS>$address2</ADDRESS>
      </ADDRESS.LIST>
	  
      <LEDSTATENAME>$state</LEDSTATENAME>
      <COUNTRYNAME>$country</COUNTRYNAME>
      <PINCODE>$pin</PINCODE>

      <LEDGERCONTACT>$contact_person</LEDGERCONTACT>
      <LEDGERPHONE>$phone1</LEDGERPHONE>
      <LEDGERMOBILE>$phone2</LEDGERMOBILE>
      <EMAIL>$email</EMAIL>
      <EMAILCC>$cc</EMAILCC>

      <GSTREGISTRATIONTYPE>$gst_reg_type</GSTREGISTRATIONTYPE>
      <PARTYGSTIN>$gstin</PARTYGSTIN>

      <OPENINGBALANCE>$opening_bal</OPENINGBALANCE>

</LEDGER>

</TALLYMESSAGE>

</REQUESTDATA>

</IMPORTDATA>

</BODY>

</ENVELOPE>

XML;

echo $req_str ;
if(isset($_POST['submit'])) {
$url = "http://localhost:9000/";
        //setting the curl parameters.
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
// Following line is compulsary to add as it is:
        curl_setopt($ch, CURLOPT_POSTFIELDS, "xmlRequest=" . $req_str);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);
        $data = curl_exec($ch);
		//echo '<pre>';
		//var_dump($data);die;
        curl_close($ch);
		echo $data ;
		// get the xml object 
}
    
?>
<?php
$ledger_file = str_replace(' ', '', $ledger_name);
$file = $ledger_file.'.xml';


//$handle = fopen($file, "rw");

//$current = file_get_contents($file);
// Append a new person to the file
//$current .= "John Smith\n";
// Write the contents back to the file
file_put_contents($file, $req_str);





if(isset($_POST['Download'])) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($file).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    readfile($file);
    exit();
}
?>


	