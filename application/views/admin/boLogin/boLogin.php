<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="<?php echo favicon()?>" sizes="16x16" />
	<title>BitcoCyrus - is the most advanced exchange.</title>
    <meta name="description" content="<?php echo $description; ?>">
    <meta name="keywords" content="<?php echo $keywords; ?>">    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/admin/plugins/pattern/patternLock.css"/>
  </head>
  <body class="loginBg">
    <div class="">
      <div class="container">
        <div class="loginForm col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
        <?php 

        $invalid_login=$this->session->flashdata("error");

        $successMsg=$this->session->flashdata("success");

        if(isset($invalid_login)) { ?>
        <div class="alert alert-denger" id="danger-alertt">
            <strong>Error!</strong> <?php echo $invalid_login; ?>.
        </div>
        <?php } ?>
        <?php if(isset($successMsg)) { ?>
        <div class="alert alert-success" id="success-alertt">
          <strong>Success!</strong> <?php echo $successMsg; ?>
        </div>
        <?php } ?>  
        <?php if(!empty($withdrawalMessage) && !empty($withdrawalStatus)) { ?>
        <?php if($withdrawalStatus == "confirmed" || $withdrawalStatus == "confirmedCancellation") { ?>
        <div class="alert alert-success fade in alert-dismissable" id="successmessagee">
            <a title="close" aria-label="close" data-dismiss="alert" class="close" href="#">×</a>
            <strong> Success!</strong> <?php echo $withdrawalMessage; ?>
        </div>                          
        <?php } else if($withdrawalStatus != "confirmed") { ?>
        <div class="alert alert-denger fade in alert-dismissable" id="failmessagee">
          <a title="close" aria-label="close" data-dismiss="alert" class="close" href="#">×</a>
            <strong>Error!</strong> <?php echo $withdrawalMessage; ?>
        </div>                  
        <?php } } ?>            
        <?php $form_attribute = array('role'=>'form','method'=>'post','id'=>'login-form','class'=>'form-horizontal'); echo form_open('YfQa6hmtE8a3G2Z6Ssuf/logincheck',$form_attribute); ?>          
            <div class="form-group">
              <div class="col-md-12 col-sm-12 text-center">
                <h4 class="logTit">Login</h4>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-12 col-sm-12">Username</label>
              <div class="col-md-12 col-sm-12">
                <input type="text" name="txtusername" id="txtusername" class="form-control" />
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-12 col-sm-12">Password</label>
              <div class="col-md-12 col-sm-12">
                <input type="password" name="txtpassword" id="txtpassword" class="form-control" />
              </div>
            </div>
                           <div id="patternContainer"></div>
                            <input type="hidden" value="" name="patterncode" id="patterncode" />
 
                          
                          <div class="space"></div>            
            <div class="form-group">
              <div class="col-sm-6">
                <!-- <label class="custom-control custom-checkbox mb-2 mr-sm-2 mb-sm-0">
                   <input type="checkbox" class="custom-control-input">
                   <span class="custom-control-indicator"></span>
                   <span class="custom-control-description">Remember me </span>
                 </label> -->
              </div>
              <?php /* <div class="col-sm-6 text-right">
                <a href="<?php echo base_url() ?>BoForgetAuthentication" >Forgot password?</a>
              </div> */ ?>
            </div>
            <div class="form-group">
              <div class="col-md-12 col-sm-12">
                <button name="signin" type="submit" value="Log In" class="btn btn-block">Login</button>
              </div>
            </div>
            <div class="row m-t-10">
              <div class="col-sm-12 text-center">
                <p class="text-muted"><a href="<?php echo base_url(); ?>BoForgetAuthentication" class="text-primary m-l-5"><b> Forgot Password ?</b></a></p>
              </div>
            </div>                    
        <?php echo form_close(); ?>
        </div>
      </div>
    </div>

    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="<?php echo base_url(); ?>assets/admin/js/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/admin/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets/admin/plugins/validate/jquery.validate.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/admin/js/admin_common.js"></script> 
    <script src="<?php echo base_url();?>assets/admin/plugins/validate/additional-methods.js" type="text/javascript"></script> 
    <script src="<?php echo base_url();?>assets/admin/pageJS/boLogin.js"></script>
    <script src="<?php echo base_url();?>assets/admin/plugins/pattern/patternLock.js"></script>     
    <?php $this->load->view('admin/common/csrf'); ?>
    <script type="text/javascript">
      var lock = new PatternLock("#patternContainer",{
        onDraw:function(pattern) {
          word();
        }
      });
      function word() {
        var pat=lock.getPattern();
        $("#patterncode").val(pat);
        $('#loginform').submit();
      }
    </script>
  </body>
</html>
