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
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/style.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/style_dashbard.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/dash_responsive.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/font-awesome.min.css">
<!-- Bootstrap -->
<link href="<?php echo base_url(); ?>assets/admin/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/admin/plugins/pattern/patternLock.css"/>
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
    <?php $this->load->view('admin/common/header'); ?>
    <?php $this->load->view('admin/common/sidebar'); ?>
    <div class="content-wrapper">
        <section class="content">
            <ul class="breadcrumb cm_breadcrumb">
                <li><a href="<?php echo base_url(); ?>BoDashboard">Dashboard</a></li>
                <li><a href="<?php echo base_url(); ?>BoSettings">Settings </a></li>
            </ul>
            <div class="inn_content">
                <?php
                    $atrtibute = array('role'=>'form','name'=>'updatePatternLock','id'=>'updatePatternLock','method'=>'post');
                    echo form_open('BoSettings/updatePatternLock',$atrtibute);
                ?>
                    <input type="hidden" name="userID" id="userID" value="<?php echo $userID; ?>">
                <!-- <form name="savePattern" id="savePattern"> -->
                    <div class="cm_head1">
                        <h3>Change Pattern Lock</h3>
                    </div>
                    <?php if(isset($invalid_login)) { ?>
                    <div class="alert alert-denger" id="danger-alertt">
                        <strong>Error!</strong> <?php echo $invalid_login; ?>.
                    </div>
                    <?php } ?>
                    <?php if(isset($successMsg)) { ?>
                    <div class="alert alert-success" id="success-alertt">
                      <strong>Success!</strong> <?php echo $successMsg; ?>
                    </div>
                    <?php } ?> 
                    <?php $this->load->view('admin/common/flashMessage'); ?>
                    <div class="form-group">
                        <div class="col-sm-12 col-xs-12">
                            <label class="form-control-label">  </label>
                            <div class="col-sm-5">
                                <div id="patternContainer"></div>
                                <input type="text" class="form-control" name="patterncode" id="patterncode" style="visibility: hidden;" />
                            </div>
                        </div>
                    </div>
                                                        
                    <ul class="list-inline">
                        <li>      
                            <input type="submit" name="updatePatternLock" value="Save pattern" class="cm_blacbtn1">                                          
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
<script src="<?php echo base_url(); ?>assets/admin/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/dashboard.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/lc_switch.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/admin/plugins/validate/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/admin/plugins/validate/additional-methods.js" type="text/javascript"></script> 
<script src="<?php echo base_url();?>assets/admin/plugins/ckeditor/ckeditor.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/lc_switch.css">
<script src="<?php echo base_url();?>assets/admin/plugins/pattern/patternLock.js"></script>
<script src="<?php echo base_url();?>assets/admin/pageJS/boChangePatternLock.js"></script>
<?php $this->load->view('admin/common/csrf'); ?>
<?php /* <script type="text/javascript">
setInterval(function() {
  $.ajax({
    url: "<?php echo base_url();?>BoNotification/viewnotificationcount",
    type: "GET",
    processData:false,
    success: function(data){
      $("#notification-count").show();
      $("#notification-count").html(data);  
    },
    error: function(){}           
  });
}, 6000);

function viewnotification() {
  $.ajax({
    url: "<?php echo base_url();?>BoNotification/viewnotification",
    type: "GET",
    processData:false,
    success: function(data){
     $("#notification-count").remove();  
     $("#listnotification").toggle();$("#listnotification").html(data);        
    },
    error: function(){}           
  });
}
</script> */ ?>
</body>
</html>