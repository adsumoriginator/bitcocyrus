<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> <?php echo $title; ?> </title>
    <meta name="description" content="<?php echo $description; ?>">
    <meta name="keywords" content="<?php echo $keywords; ?>">    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>admin_assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>admin_assets/css/style.css">
  </head>
  <body class="loginBg">
    <div class="">
      <div class="container">
        <div class="loginForm col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
        
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
             $form_attribute = array('role'=>'form','method'=>'post','id'=>'reset_form','class'=>'form-horizontal');
              echo form_open('bitcowallet/BoForgetAuthentication/update_password',$form_attribute); 
        ?>
           <div class="form-group">
              <div class="col-md-12 col-sm-12 text-center">
                <h4 class="logTit">Reset Password </h4>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-12 col-sm-12">New Password <span class="mand_field">*</span></label>
              <div class="col-md-12 col-sm-12">                
                <input type="password" class="form-control" id="newpassword" name="newpassword" placeholder="Enter your new password"> 
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-12 col-sm-12">Confirm Password <span class="mand_field">*</span></label>
              <div class="col-md-12 col-sm-12">                
                <input type="password" class="form-control" id="repassword" name="repassword" placeholder="Enter your new password"> 
              </div>
            </div>
           
            <div class="form-group">             
              <div class="col-sm-6 text-right">
               <!--  <a href="#" id="forgot_show">Login</a> -->
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-12 col-sm-12">
                <button type="submit" class="btn btn-block">Reset Password</button>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-12 col-sm-12 text-center">
                 <p><a href="<?php echo wallet_url(); ?>Authentication" id="login_show">Login</a>
                </p>
              </div>
            </div>

            <?php echo form_close(); ?>

        </div>
      </div>
    </div>

    <!-- jQuery first, then Tether, then Bootstrap JS. -->

    <script src="<?php echo base_url(); ?>admin_assets/js/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>admin_assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>admin_assets/plugins/validate/jquery.validate.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>admin_assets/plugins/validate/additional-methods.js" type="text/javascript"></script> 
    <script src="<?php echo base_url();?>admin_assets/pageJS_wallet/boLogin.js"></script>     
    <?php $this->load->view('admin_wallet/common/csrf'); ?>
    
  </body>
</html>