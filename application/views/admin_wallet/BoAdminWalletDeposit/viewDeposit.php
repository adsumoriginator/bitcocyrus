<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title> <?php echo $title; ?> </title>
<meta name="description" content="<?php echo $description; ?>">
<meta name="keywords" content="<?php echo $keywords; ?>">
<link rel="stylesheet" href="<?php echo base_url(); ?>admin_assets/css/style.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>admin_assets/css/style_dashbard.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>admin_assets/css/dash_responsive.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>admin_assets/css/font-awesome.min.css">
<!-- Bootstrap -->
<link href="<?php echo base_url(); ?>admin_assets/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
        .tarea1 { 
            height: 100px; width: 100%; border: 1px solid #ddd; padding: 5px 8px;
        }        
    </style>
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
                <!--<ul class="breadcrumb cm_breadcrumb">
                     <li>
                        <a href="<?php echo base_url(); ?>BoAdminWalletDashboard">Dashboard</a>
                    </li> -->
                    <!-- <li>
                        <a href="javascript:">View user details </a>
                    </li> 
                </ul>-->
				<div class="form-group row">
                    <label for="" class="col-sm-5 col-form-label">Select your Currency</label>
                    <div class="col-sm-7">
					<input type="hidden" name="wallet_url" id="wallet_url" value="<?php echo wallet_url(); ?>">
                      <select class="custom-select" id="dep_select">
                        <?php  
      foreach($all_currency->result() as $crow){ ?>
                        <option <?php if($currencySymbol==$crow->currency_symbol){?>selected="selected" <?php }?>    value="<?php echo $crow->currency_symbol ?>"><?php echo  $crow->currency_name ?> - <?php echo $crow->currency_symbol ?></option>
                        <?php
    }
    ?>
                      </select>
                    </div>
                  </div>
                <div class="inn_content">
                    <div class="alert alert-denger" id="doc_rejected" style="display: none;"></div>
                    <div class="alert alert-success" id="doc_success" style="display: none;"></div>    <?php
                            $atrtibute = array('role'=>'form','name'=>'saveEmailTemplate','id'=>'saveEmailTemplate','method'=>'post','onSubmit'=>'return checkAll();','enctype' =>'multipart/form-data');
                            echo form_open('BoContactUs/sendReply',$atrtibute);
                        ?>
                        <div class="cm_head1">
                            <h3><?php echo $currencySymbol." Balance "; ?><?php echo $adminBalance; ?></h3>

      

                             <?php
                        if( $currencySymbol=="TRX" ||  $currencySymbol=="EOS" ||  $currencySymbol=="NPXS" ||  $currencySymbol=="IOST" ||  $currencySymbol=="OMG" ||  $currencySymbol=="ZRX"){ ?>

                                &nbsp; &nbsp; &nbsp; &nbsp;<h3><?php echo "ETH Balance "; ?><?php echo $ethBalance; ?></h3>                     

                        <?php
                    }
                    ?>
                        </div>                       



                        <div class="form-group row"> 
                            <div class="col-sm-6 text-center"><h4>QR Code</h4></div>
                        </div>
                        
                        <div class="form-group row"> 
                            <div class="col-sm-6 text-center qrImgLg">
                                <img src="<?php echo $rootUrl; ?>">
                            </div>
                        </div>

                        <div class="form-group row"> 
                            <label class="col-sm-6 text-center">Address</label>
                        </div>
                        <div class="form-group row"> 
                            <div class="col-sm-6 text-center"><h4><?php echo $checkAddress; ?></h4></div>

                        </div>

                        <?php if($currencySymbol=="XMR") { ?>

                          <div class="form-group row"> 
                            <label class="col-sm-6 text-center">Payment id</label>
                        </div>
                        <div class="form-group row"> 
                            <div class="col-sm-6 text-center"><h4><?php echo $payment_id; ?></h4></div>

                        <?php
                    }
                    ?>



<!--                         <ul class="list-inline">
                            <li>
                                <a href="<?php echo base_url()."BoSiteUsers"; ?>" class="cm_blacbtn1">Back</a>
                            </li>
                        </ul> -->
                    <?php echo form_close(); ?>
           
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

$('#dep_select').on('change', function() {
	
	var wallet_url = $('#wallet_url').val();
	var url= wallet_url+"BoAdminWalletDeposit/deposit/"+this.value; 
	window.location.replace(url);
});
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