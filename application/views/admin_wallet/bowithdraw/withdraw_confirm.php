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

  

</head>



<body class="hold-transition sidebar-mini">
    <div class="wrapper">
    <?php $this->load->view('admin_wallet/common/header'); ?>
    <?php $this->load->view('admin_wallet/common/sidebar'); ?>
    <div class="content-wrapper">
        <section class="content">
            <ul class="breadcrumb cm_breadcrumb">
                <li><a href="<?php echo wallet_url()."BoDashboard"; ?>">Dashboard</a></li>
                <li><a href="<?php echo wallet_url()."Bowithdraw/withdrawlist"; ?>">Manage Withdraw</a></li>
            </ul>
            <div class="inn_content">

            <div class="alert alert-denger" id="doc_rejected" style="display: none;"></div>
            <div class="alert alert-success" id="doc_success" style="display: none;"></div>          


        <?php $this->load->view('admin_wallet/common/flashMessage'); ?>

              <?php if(isset($error)) { ?>
        <div class="alert alert-denger" id="danger-alertt">
            <strong>Error!</strong> <?php echo $error; ?>.
        </div>
        <?php } ?>
        <?php if(isset($success)) { ?>
        <div class="alert alert-success" id="success-alertt">
          <strong>Success!</strong> <?php echo $success; ?>
        </div>
        <?php } ?>                    

            <?php 
            $form_attribute = array('role'=>'form','method'=>'post','id'=>'edit_withdrawdfd','name'=>'edit_withdrawdfdf','class'=>'cm_frm1 verti_frm1'); 
            echo form_open('',$form_attribute); ?>
                    
                    <div class="cm_head1">
                        <h3>Withdraw</h3>
                    </div>


              


                     <div class="form-group row clearfix"> 
                        <div class="col-sm-6 col-xs-12 cls_resp50">
                          <label class="form-control-label"> Amount</label>
                            <input type="text" class="form-control" value="<?php echo $withdraw_data->askamount ?>"  id="amount" name="amount" readonly>
                        </div>                                     
                    </div>                    

                    <div class="form-group row clearfix">

                    

                     <div class="col-sm-6 col-xs-12 cls_resp50">                     
                        <label class="form-control-label">To Address</label>
                        <input type="text" value="<?php echo $withdraw_data->to_address ?>"" class="form-control" readonly id="to_address" name="to_address">    
                      </div>

                 
                    
                 
                    </div>



                    <div class="form-group row clearfix">

                    

                     <div class="col-sm-6 col-xs-12 cls_resp50">                     
                        <label class="form-control-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password">    
                      </div>

                 
                    
                 
                    </div>


                    





                    
                                     
                    <ul class="list-inline">
                     <li>
                        <input type="submit" name="updatecmspage" value="Submit" class="cm_blacbtn1">
                    </li>                    
                    </ul>
                <?php echo form_close(); ?>
            </div>
        </section>
    </div>
  <!-- <footer class="main-footer"> Copyright © 2017 WCX Coin. All rights reserved. </footer>-->
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php echo base_url(); ?>admin_assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>admin_assets/js/dashboard.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>admin_assets/js/lc_switch.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>admin_assets/plugins/validate/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>admin_assets/plugins/validate/additional-methods.js" type="text/javascript"></script> 
<script src="<?php echo base_url();?>admin_assets/pageJS_wallet/editwithdraw.js"></script>  
<script src="<?php echo base_url();?>admin_assets/plugins/ckeditor/ckeditor.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>admin_assets/css/lc_switch.css">

<?php $this->load->view('admin_wallet/common/csrf'); ?>


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
</body>
</html>