
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=320; user-scalable=no; initial-scale=1.0; maximum-scale=1.0">

    <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="<?php echo base_url(); ?>admin_assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>admin_assets/css/style.css">

<style>
    body{
        font-family:Arial, Helvetica, sans-serif;
    }
    .error{
      color:red;
    }
</style>

  </head>
  <body class="loginBg">
  
  
    <div class="" id="login_div">
      <div class="container">
        <div class="loginForm col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">


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




      <?php
      //$sec_url = 'xchan76gx/gaiaex/'.encrypt_decrypt('encrypt',$url);
      ?>
      <?php
          
          $attr = array('class'=>'form-horizontal','id'=>'login_form'); 
          echo form_open(base_url('bitcowallet/Authentication/logincheck'),$attr);
      ?>
          
            <div class="form-group">
              <div class="col-md-12 col-sm-12 text-center">
                <h4 class="logTit">Login</h4>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-12 col-sm-12">Email Address</label>
              <div class="col-md-12 col-sm-12">
                <input type="text" name="username" id="username" class="form-control" />
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-12 col-sm-12">Password</label>
              <div class="col-md-12 col-sm-12">
                <input type="password" name="user_pwd" id="user_pwd" class="form-control" />
              </div>
            </div>
          
            <div class="control-group">
              <label class="col-md-12 col-sm-12">Pattern Code</label>
              <div class="col-md-12 col-sm-12">
              <div id="patternContainer"></div>
               <input type="hidden"  name="pattern_code" id="patterncode"> 
              </div>
            </div>  

           

         <div class="form-group">
              <div class="col-sm-6">
               <!--  <label class="custom-control custom-checkbox mb-2 mr-sm-2 mb-sm-0">
                   <input type="checkbox" class="custom-control-input">
                   <span class="custom-control-indicator"></span>
                   <span class="custom-control-description">Remember me</span>
                 </label>  -->
              </div>
              <div class="col-sm-6 text-right">
                <!-- <a href="#" id="forgot_show">Forgot password?</a> -->
              </div>
            </div> 
            <div class="form-group">
              <div class="col-md-12 col-sm-12">
                <button type="submit" name="signin" value="Log In" class="btn btn-block">Login</button>
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-12 col-sm-12 text-center">
                <p>
                  Forgot password? 
                  <!-- <a href="#" id="forgot_show">Click here</a> -->
                  <a href="<?php echo wallet_url() ?>BoForgetAuthentication" id="forgot_show">Click here</a>
                </p>
              </div>
            </div>
          <!-- </form> -->
          <?php echo form_close(); ?>
        </div>
      </div>
    </div>

    <div class="" style="display:none;" id="forgot_div">
      <div class="container">
        <div class="loginForm col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
     
      <?php
          $furl = base_url('tmmanager/subfp');
          $attr = array('class'=>'form-horizontal','id'=>'forgot_form'); 
          echo form_open('',$attr);
      ?>
          
            <div class="form-group">
              <div class="col-md-12 col-sm-12 text-center">
                <h4 class="logTit">Forgot Password </h4>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-12 col-sm-12">Email</label>
              <div class="col-md-12 col-sm-12">
                <input type="text" name="useremail" id="useremail" class="form-control" />
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
                <button id="pass_reset" type="submit" class="btn btn-block">Reset Password</button>
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-12 col-sm-12 text-center">
                <p>
                  <a href="#" id="login_show">Login</a>
                </p>
              </div>
            </div>
          <!-- </form> -->
          <?php echo form_close(); ?>
        </div>
      </div>
    </div>



    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="<?php echo base_url(); ?>admin_assets/js/jquery-2.1.1.min.js"></script>
    <script src="<?php echo base_url(); ?>admin_assets/js/bootstrap.min.js"></script>

<script src ="<?php echo base_url('admin_assets/js/patternLock.js'); ?>"></script>
<link href="<?php echo base_url('admin_assets/css/patternLock.css'); ?>" rel="stylesheet" type="text/css" />
<script src ="<?php echo base_url('admin_assets/js/jquery.validate.min.js'); ?>"></script>



    
<script>
var lock = new PatternLock("#patternContainer",{
   onDraw:function(pattern){
      word();
    }
});
function word()
{
  var pat=lock.getPattern();
  
  $("#patterncode").val(pat);
  $('#login_form').valid()
}


$('#login_form').validate({
  ignore:"",
  rules:{
    username:{
      required:true      
    },
    user_pwd:{
      required:true,
    },
    pattern_code:{
      required:true,
    }
  },
  messages:{
     username:{
      required:"Enter email address",
    },
    user_pwd:{
      required:"Enter Password",
    },
    pattern_code:{
      required:"Draw Pattern",
    }
  }
})

$('document').ready(function(){
  var error = "<?php echo $this->session->flashdata('error'); ?>";
  if(error != "")
  {
      alert(error);
  }
})


$('#forgot_show').click(function(){
  $('#login_div').hide();
  $('#forgot_div').show();
});

$('#login_show').click(function(){
  $('#login_div').show();
  $('#forgot_div').hide();
});

$('#forgot_form').validate({
  rules:{
    useremail:{
      required:true,
      email:true,
    }
  },
  messages:{
    useremail:{
    required:"Enter your email id",
    email:"Enter valid email id",
  }
  },
  submitHandler:function()
  {

    $('#pass_reset').html('<i class="fa fa-spinner fa-spin"></i> Please Wait');
      // var csrf=$('input[name="csrf_test_name"]').val();
       //alert(csrf);

         $('#pass_reset').trigger("reset");
                        $('#pass_reset').attr('disabled',true)
     $.ajax({
      url:"<?php echo $furl; ?>",
      method:"POST",
      data:$('#forgot_form').serialize(),
      success:function(data)
      {
          $('#forgot_form').trigger('reset');
          data = $.parseJSON(data);
          alert(data.msg);

         //  $('#pass_reset').trigger("reset");
            $('#pass_reset').html("Reset Password");
            $('#pass_reset').attr('disabled',false);
      }
     })
  }
})
</script>


  </body>
</html>
