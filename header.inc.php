<?php 
ob_start();
include 'include/dbi.php';
include 'include/menu.php';
$username_head = $_SESSION['login'];
date_default_timezone_set('Asia/Kolkata');
$date_head = date('Y-m-d'); 
$alert_query=mysqli_query($conn,"SELECT COUNT(assigned_user) FROM `mytasks` where (assigned_user='$username_head' OR created_by='$username_head') AND SUBSTR(datetime,1,10)<='$date_head' AND status='New'");

$row_head = mysqli_fetch_array($alert_query);
$count_task=$row_head['COUNT(assigned_user)'];

$sql="SELECT * FROM tbl_staff where username='$username_head'";
$role_head=mysqli_query($conn, $sql);
$r_role = mysqli_fetch_array($role_head);
?>

<div class='col-md-12 old_header' style='background-image:url(images/bg-top.jpg);background-repeat: repeat-x; left:0;right:0; position:fixed; top:0; width:100%;'>
<div class='row'>
<div class='col-xs-4' style= 'text-align:left;  color: #ffffff;'>
<h5 id='clock'> <script>
var date = new Date();

var d1 = date.toISOString().slice(0,10);
function checkTime(i) {
  if (i < 10) {
    i = '0' + i;
  }
  return i;
}

function startTime() {
  var today = new Date();
  var h = today.getHours();
  var m = today.getMinutes();
  var s = today.getSeconds();
  // add a zero in front of numbers<10
  m = checkTime(m);
  s = checkTime(s);
  document.getElementById('clock').innerHTML = d1+ ' '+ h + ':' + m + ':' + s;
  t = setTimeout(function() {
    startTime()
  }, 500);
}
startTime();
</script></h5>
 </div>
 
 <div class='col-xs-4' style= 'text-align:center;  color: #ffffff;'>
 <h4>Euphoria CRM</h4>
 </div>
<div class='col-xs-4' style= 'text-align:right;  color: #ffffff;'>
 <h4>Welcome <?php echo $_SESSION['login'].'!'; ?></h4>
</div>
</div>
</div>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
<style>
.dropdown-header{
  background-color:black;
  color:white;
}
.dropdown-submenu {
    position: relative;
  
}
.dropdown-toggle{
  border-radius:0;
}
.dropdown-toggle:hover{
  background-color:#ccf2ff;
  color:black;
}
#btn1:focus{
  background-color:white;
  color:black;
}

.dropdown-submenu .dropdown-menu {
    top: 0;
    left: 100%;
    margin-top: -1px;
}
.navigation{
  background-color:#337ab7;
  margin-top:37px;
  left:0;
  right:0;
  z-index: 1;
  
  
}
#btn_home{
  border-radius:0;
  background-color:#92d36e;
  color:#161616;
}

#btn_logout{
  border-radius:0;
  
  background-color:#dd8140;
  color:#fff;
}

#btn_home:hover{
  background-color:#84b26b;
  color:#fff;
  font-size:16px;
}

#btn_logout:hover{
  background-color:#f4c1ad;
  color:#000000;
  font-size:16px;
}

.list_open{
  display:none;
}
.fixed {
  position: fixed;
  top:-37; 
  width: 100%; 
  left:0;
  right:0;
  }
  
.mob_view{
    display:none;
}
#btn2_leads{
margin-left:-80px;  
}
#btn2_mytask{
  width:150px;
}
#btn2_contacts{
  margin-left:-20px;
}
#btn2_campaign{
  margin-left:30px;
}
#btn2_customers{
  margin-left:30px;
  }
#btn2_sales_resource{
  margin-left:30px;
  }
#btn2_myfiles{
  margin-left:30px;
}
#btn2_logout{
  border-radius:0;
  background-color:#dd8140;
  color:#fff;
  margin-left:112px;
}
#btn2_logout:hover{
  background-color:#f4c1ad;
  color:#000000;
  font-size:16px;
}
.campaign_btn{
  margin-left:15px;
}
@media only screen and (max-width: 800px) { 

.navigation{
  top:-37px;
  width:100%;
  left:0;
  right:0;
  margin-bottom:-100px;
  
}
.fixed {
  position: fixed;
  width: 100%; 
  left:0;
  
}
.fixed .list_open .glyphicon-align-justify{
  color: #fff;
  font-size: 1.2em;
  float:right;  
}
.navigation .mob_view{
  display:block;
  color:white;
  font-size:16px;
  margin-left:-30px;
}


.navigation .list_open{
  display:block;
}

.navigation .list_open .glyphicon-align-justify{
  color: #fff;
  font-size: 1.2em;
  float:right;
  margin-top:-20px;
}
  .old_header{
    display:none;
  }
  .web_view{
    display:none;
  }
 #btn_home{
 display:none;
 } 
  #btn_logout{
  margin-left:0;
  }
  #btn1{
    width:200px;
  }
  .lead_btn{
    margin-left:15px;
  }
  .mytask_btn{
    margin-left:20px;
  }
  .campaign_btn{
    margin-left:0;
  }
  .contact_btn{
    margin-left:10px;
  }
  .sales_resource_btn
  {
     margin-left:15px;
  }
  
  .btn2{
    width:200px;
  }
  #btn2_leads{
  margin-left:-380px;
  }
  #btn2_mytask{
  margin-left:-380px;
  }
  #btn2_contacts{
  margin-left:-380px;
  }
  #btn2_campaign{
  margin-left:-380px; 
  }
  #btn2_customers{
  margin-left:-380px;
  }
  #btn2_sales_resource{
  margin-left:-15px;
  }
  #btn2_myfiles{
  margin-left:0;
  }
#btn2_logout{
  margin-left:0;
  }
}
</style>
<script>
 $(document).ready(function(){
  var count_task="<?php echo $count_task; ?>";
  if(count_task>0){
   $('.badge').css('background-color', '#db3425');
   $('.badge').css('color', '#fff');
  }
  else
  {
    $('.badge').css('background-color', 'green');
    $('.badge').css('color', '#fff');
  }
});
</script>
<script>
 $(document).ready(function(){
  var role="<?php echo $r_role['role']; ?>";
  if(role!='admin'){
   $(".role").css("margin-left", "380px");
   $("#btn_logout").css("margin-left", "100px");
  }
});
</script>

<div class='col-md-12 col-sm-12 col-lg-12 col-xs-12 navigation '>
<div class='mob_view'>
<div class='col-sm-1'>
<a style='color: #fff;' href='admin_page.php'><button class='btn btn-primary' type='button'><i class='fa fa-home'></i></button></a>Euphoria CRM
</div>
</div>

<?php

echo "
<div class='row web_view' id='web_view'>
<div class='col-md-1'>
<a style='color: #fff;' href='admin_page.php'><button class='btn' id='btn_home' type='button'><i class='fa fa-home'></i>&nbsp;<strong>Home</strong></button></a>
</div>" ;

if ($mitem_lead_display) {
  
  echo "
<div class='dropdown col-md-1 col-sm-1' style='margin-left:-15px; width:100px;'>
    <button class='btn btn-primary dropdown-toggle lead_btn' id='btn1' type='button' data-toggle='dropdown'>LEADs
    <span class='fa fa-caret-down'></span></button>
    <ul class='dropdown-menu'>
      <li><a tabindex='-1' href='lead_add.php'>Add Leads</a></li>
      <li><a tabindex='-1' href='lead_view_all.php'>Manage Leads</a></li>
    <li class='dropdown-header'>REPORTS</li>
      <li><a tabindex='-1' href='lead_daily_report.php'>Daily Report Status</a></li>
      <li><a tabindex='-1' href='lead_report_for_duration.php'>Lead Report For Duration</a></li>
      <li><a tabindex='-1' href='lead-report2.php'>Lead Report Duration Segment Wise</a></li>
      <li><a tabindex='-1' href='lead-report3.php'>Lead Report Target Month</a></li>
    </ul>
</div>";
}

if($mitem_mytask_display){
echo "
<div class='dropdown col-md-1' style='width:120px; margin-left:-20px;'>
    <button class='btn btn-primary dropdown-toggle mytask_btn' id='btn1' type='button' data-toggle='dropdown'>FollowUPs
    <span class='fa fa-caret-down'></span><span class='badge' style='margin-left:2px;'>$count_task </span></button>
    <ul class='dropdown-menu'>
      <li><a tabindex='-1' href='mytask.php'>My Pending Tasks<span class='badge' style='margin-left:2px;'>$count_task</span></a></li>
      <li><a tabindex='-1' href='all-tasks.php'>All Tasks</a></li>
    <li><a tabindex='-1' href='task-reminder.php'>Add Task</a></li>
	<li><a tabindex='-1' href='quote-manage.php'>Manage quotation</a></li>
	<li><a tabindex='-1' href='add-quote.php'>Add quotation</a></li>
	
    </ul>
</div>";
}
if($mitem_campaign_display){
echo "
<div class='dropdown col-md-1'>
    <button class='btn btn-primary dropdown-toggle campaign_btn' id='btn1' type='button' data-toggle='dropdown'>Campaign
    <span class='fa fa-caret-down'></span></button>
    <ul class='dropdown-menu'>
   <li class='dropdown-header'>EMAIL CAMPAIGN</li>
    <li class='dropdown-submenu'>
        <a class='test' tabindex='-1' href='#'>Email &nbsp;<span class='fa fa-caret-right'></span></a>
     <ul class='dropdown-menu'>
          <li><a tabindex='-1' href='mail-send.php'>Send Mail(Single)</a></li>
          <li><a tabindex='-1' href='mail-send-multiple.php'>Send Mail(Multiple)</a></li>
          <li><a tabindex='-1' href='mail-manage.php'>Manage Mail Template</a></li>
          <li><a tabindex='-1' href='mail-log.php'>View Mail Log</a></li>
       </ul>
      <li class='dropdown-header'>SMS CAMPAIGN</li>
      <li class='dropdown-submenu'>
        <a class='test' tabindex='-1' href='#'>SMS <span class='fa fa-caret-right'></span></a>
        <ul class='dropdown-menu'>
          <li><a tabindex='-1' href='sms-send.php'>Send SMS(Single)</a></li>
          <li><a tabindex='-1' href='sms-send-multiple.php'>Send SMS(Multiple)</a></li>
          <li><a tabindex='-1' href='sms-manage.php'>Manage SMS Template</a></li>
          <li><a tabindex='-1' href='sms-log.php'>View SMS Log</a></li>
        </ul>
      </li>
    </ul>
  </div>";
}
if($mitem_myfiles_display){
  echo "
<div class='dropdown col-md-1' >
    <button class='btn btn-primary dropdown-toggle' id='btn1' type='button' data-toggle='dropdown'>My Files
    <span class='fa fa-caret-down'></span></button>
    <ul class='dropdown-menu'>
    <li><a tabindex='-1' href='document-files-view.php'>View Files</a></li>
    </ul>
  </div>";
}

  if($mitem_sale_display){
echo "
<div class='dropdown col-md-1'>
    <button class='btn btn-primary dropdown-toggle' id='btn1' type='button' data-toggle='dropdown'>DEALs
    <span class='fa fa-caret-down'></span></button>
    <ul class='dropdown-menu'>
      <li><a tabindex='-1' href='add-user.php'>Add Customer</a></li>
      <li><a tabindex='-1' href='manage-user.php'>Manage Customers</a></li>
     <li class='dropdown-header'>DEALs</li>
      <li><a tabindex='-1' href='add-registration.php'>Add Deal</a></li>
      <li><a tabindex='-1' href='manage-registration.php'>Manage Deal</a></li>
       <li class='dropdown-header'>REPORTS</li>
      <li><a tabindex='-1' href='registration-for-duration.php'>Deal For Duration</a></li>
      <li><a tabindex='-1' href='monthly-sales-order-report.php'>Monthly Deal Resource Wise</a></li>
    </ul>
  </div>";
}
if($mitem_contact_display){
echo "
<div class='dropdown col-md-1' style='margin-left:-10px;'>
    <button class='btn btn-primary dropdown-toggle contact_btn' id='btn1' type='button' data-toggle='dropdown'>Contacts
    <span class='fa fa-caret-down'></span></button>
    <ul class='dropdown-menu'>
      <li><a tabindex='-1' href='contact-add.php'>Add Contact</a></li>
      <li><a tabindex='-1' href='contact-manage.php'>Manage Contact</a></li>
    </ul>
</div>";
}
if($mitem_product_display){
echo "
<div class='dropdown col-md-1'>
    <button class='btn btn-primary dropdown-toggle' id='btn1' type='button' data-toggle='dropdown'>Products
    <span class='fa fa-caret-down'></span></button>
    <ul class='dropdown-menu'>
   <li class='dropdown-header'>PRODUCT ITEM</li>
      <li><a tabindex='-1' href='product-item-add.php'>Add Product Item</a></li>
      <li><a tabindex='-1' href='product-item-manage.php'>Manage Product Item</a></li>
     <li class='dropdown-header'>PRODUCT GROUP</li>
      <li><a tabindex='-1' href='product-group-add.php'>Add Product Group</a></li>
      <li><a tabindex='-1' href='product-group-manage.php'>Manage Product Group</a></li>
    </ul>
</div>";
}
if($mitem_reciept_display){
  if($r_role['role'] == 'admin'){
echo "
<div class='dropdown col-md-1'>
    <button class='btn btn-primary dropdown-toggle' id='btn1' type='button' data-toggle='dropdown'>Receipts
    <span class='fa fa-caret-down'></span></button>
    <ul class='dropdown-menu'>
      <li><a tabindex='-1' href='receipt-add.php'>Add Receipt</a></li>
      <li><a tabindex='-1' href='receipt-report-for-duration.php'>Manage Receipt</a></li>
    </ul>
  </div>";
}
}

if($mitem_sales_resource_display){
  if($r_role['role'] == 'admin')
echo "
<div class='dropdown col-md-1' style='margin-left:-15px; width:140px;'>
    <button class='btn btn-primary dropdown-toggle sales_resource_btn' id='btn1' type='button' data-toggle='dropdown'>Sales-Resource
    <span class='fa fa-caret-down'></span></button>
    <ul class='dropdown-menu'>
      <li><a tabindex='-1' href='sales-resource.php'>Manage Sales/Resource</a></li>
      <li><a tabindex='-1' href='sales-resource-activity.php'>Sales/Resource Activity</a></li>
      <li class='dropdown-header'>SALES TARGET</li>
      <li><a tabindex='-1' href='sales-target-add.php'>Add Sales Target</a></li>
      <li><a tabindex='-1' href='sales-target-manage.php'>Sales Target Manage</a></li>
    </ul>
</div>";
}
else{
  echo "
<div class='dropdown col-md-1' style='margin-left:-15px; width:140px;'>
    <button class='btn btn-primary dropdown-toggle sales_resource_btn' id='btn1' type='button' data-toggle='dropdown'>Sales-Resource
    <span class='fa fa-caret-down'></span></button>
    <ul class='dropdown-menu'>
      <li><a tabindex='-1' href='sales-resource-activity.php'>Sales/Resource Activity</a></li>
    </ul>
</div>";
}
if($mitem_trainer_display){
    echo "
<div class='dropdown col-md-1'>
    <button class='btn btn-primary dropdown-toggle' id='btn1' type='button' data-toggle='dropdown'>Trainers
    <span class='fa fa-caret-down'></span></button>
    <ul class='dropdown-menu'>
   <li class='dropdown-header'>TRAINERS</li>
      <li><a tabindex='-1' href='trainer_add.php'>Add Trainer</a></li>
      <li><a tabindex='-1' href='trainers.php'>Manage Trainer</a></li>
     <li class='dropdown-header'>BATCHES</li>
      <li><a tabindex='-1' href='add_batch.php'>Add Batch</a></li>
      <li><a tabindex='-1' href='admin_view_batch.php'>Manage Batch</a></li>
    </ul>
</div>";
}

  echo "
<div class='col-md-1' >
  <a href='logout.php'><button class='btn' id='btn_logout'><strong>Logout</strong>&nbsp;<i class='fa fa-sign-out'></i></button></a>
  </div>
   </div>
";
?>

<div >
  <a href='#' onclick="show_header()" class='list_open' id='list_open'><span class='glyphicon glyphicon-align-justify'></span></a>
  
</div>
</div>
<script>
$(document).ready(function(){
  $('.dropdown-submenu a.test').on('click', function(e){
    $(this).next('ul').toggle();
    e.stopPropagation();
    e.preventDefault();
  });
});

function show_header() {
    var x = document.getElementById("web_view");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none"; 
    }
}
</script>



<script>
$(window).scroll(function(){
  var sticky = $('.navigation'),
      scroll = $(window).scrollTop();

  if (scroll >= 60) sticky.addClass('fixed');
  else sticky.removeClass('fixed');
});
</script>