<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

  <title> <?php echo $title; ?> </title>

  <meta name="description" content=" ">
  <meta name="keywords" content="">
  
  <link rel="stylesheet" href="<?php echo base_url(); ?>admin_assets/css/style.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>admin_assets/css/style_dashbard.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>admin_assets/css/dash_responsive.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>admin_assets/css/font-awesome.min.css">

  <!-- Event Calendar -->
  <link href='<?php echo base_url(); ?>admin_assets/css/fullcalendar.min.css' rel='stylesheet' />
  <link href='<?php echo base_url(); ?>admin_assets/css/fullcalendar.print.min.css' rel='stylesheet' media='print' />

  <!-- Bootstrap -->
  <link href="<?php echo base_url(); ?>admin_assets/css/bootstrap.min.css" rel="stylesheet">

  <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
</head>
<body class="hold-transition sidebar-mini">

<div class="loader" id="myLoad">
  <div class="spinner">
    <div class="double-bounce1"></div>
    <div class="double-bounce2"></div>
  </div>
</div>

<div class="wrapper">
  <?php $this->load->view('admin_wallet/common/header'); ?>
  <?php $this->load->view('admin_wallet/common/sidebar'); ?>
  <div class="content-wrapper">
     <section class="content">
      <ul class="breadcrumb cm_breadcrumb">
        <li><a href="<?php echo wallet_url(); ?>BoDashboard">Home</a></li>
      </ul>
      <div class="mainWrapper">
        <div class="cardsTopSec mb-20">
			
          <div class="row">
		  
		  
		  
		  
		  <?php 

			$i=0;
		  foreach($all_currency as $row){
		  
		       $currency_symbol = $row->currency_symbol;
			   $balance=number_format($row->balance,8)
		  ?>
		  
		  
		  <div class="col-md-4 col-sm-6">
              <div class="cardsBlk cardsClr3">
                <p><?php echo $currency_symbol;?>  <a href="<?php echo wallet_url(); ?>BoAdminWalletDeposit/deposit/<?php echo $currency_symbol;?>">View</a></p>
                <div class="midSec">
                 <?php echo $balance; ?>
                </div>
                <div class="bottomSec">
                </div>
              </div>
            </div> 
		  
		  <?php
		  
		  $i++;
		  }?>
		  
		  

<!--

            <div class="col-md-4 col-sm-6">
              <div class="cardsBlk cardsClr5">
                <p>Manage Withdrawals<a href="<?php echo wallet_url(); ?>Bowithdraw/withdrawlist">View</a></p>
                <div class="midSec">
                 
                </div>              
              </div>
            </div>  
            -->




          </div>           

        </div>        

      </div>
     </section> 
  </div>
  <footer class="main-footer"> Copyright &copy; <?php echo $copyRight." ".$copySiteTitle; ?>. All rights reserved. </footer>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php echo base_url(); ?>admin_assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>admin_assets/js/dashboard.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>admin_assets/js/lc_switch.js" type="text/javascript"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>admin_assets/css/lc_switch.css">
<script type="text/javascript">
/*search menu click jquery starts*/
$('.showresult').click(function(){
$('.searc_drop').css('display','block');
});
/*search menu click jquery ends*/

/*search menu close outside the container (i.e)., while clicking body starts*/
$(document).mouseup(function(e)
{
var container = $(".searc_drop");
// if the target of the click isn't the container nor a descendant of the container
if (!container.is(e.target) && container.has(e.target).length === 0)
{
 $('.searc_drop').css('display','none');
}
});
/*search menu close outside the container (i.e)., while clicking body ends*/

/*notification checkbox starts*/
$(document).ready(function(e) {
$('.setting_drp input').lc_switch();

// triggered each time a field changes status
$('body').delegate('.lcs_check', 'lcs-statuschange', function() {
var status = ($(this).is(':checked')) ? 'checked' : 'unchecked';
console.log('field changed status: '+ status );
});

// triggered each time a field is checked
$('body').delegate('.lcs_check', 'lcs-on', function() {
console.log('field is checked');
});

// triggered each time a is unchecked
$('body').delegate('.lcs_check', 'lcs-off', function() {
console.log('field is unchecked');
});
});
/*notification checkbox ends*/
</script>
<script>
jQuery(function($) {
    var panelList = $('#draggablePanelList');

    panelList.sortable({
        // Only make the .panel-heading child elements support dragging.
        // Omit this to make then entire <li>...</li> draggable.
        handle: '.panel-heading',
        update: function() {
            $('.panel', panelList).each(function(index, elem) {
                 var $listItem = $(elem),
                     newIndex = $listItem.index();

                 // Persist the new indices.
            });
        }
    });
});
</script>


<script type = "text/javascript">
  setTimeout(function(){
     document.getElementById("myLoad").style.display="none";
  }, 3000);
</script>
</body>
</html>