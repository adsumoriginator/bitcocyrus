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
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/style.css">
  </head>
  <body class="loginBg">
    <div class="">
      <div class="container">
        <div class="loginForm col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
        
        <?php $this->load->view('admin/common/flashMessage'); ?>

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
              echo form_open('BoForgetAuthentication/update_password',$form_attribute); 
        ?>


        <input type="hidden" name="admin_id" value="<?php echo $admin_id?>">
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
              <div class="col-sm-6">
               
              </div>
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
                <p class="text-muted">
                  click to see
                  <a class="text-primary m-l-5" href="<?php echo base_url()."YfQa6hmtE8a3G2Z6Ssuf"; ?>"><b> Login</b>
                  </a>
                </p>
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
    <script src="<?php echo base_url();?>assets/admin/plugins/validate/additional-methods.js" type="text/javascript"></script> 
    <script src="<?php echo base_url();?>assets/admin/pageJS/boResetPassword.js"></script>  
    <?php $this->load->view('admin/common/csrf'); ?>   
  </body>
</html>