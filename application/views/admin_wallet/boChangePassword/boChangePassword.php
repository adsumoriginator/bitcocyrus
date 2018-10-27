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
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>admin_assets/css/patternLock.css"/>

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
        <li><a href="<?php echo admin_url()."BoDashboard"; ?>">Dashboard</a></li>
        <li><a href="<?php echo admin_url()."BoChangePassword"; ?>">Change Password</a></li>
      </ul>

      <div class="inn_content">

      <?php $this->load->view('admin_wallet/common/flashMessage'); ?>

        <?php
            $atrtibute = array('role'=>'form','name'=>'changePwd','id'=>'changePwd','method'=>'post','class'=>'cm_frm1 verti_frm1');
            echo form_open('bitcowallet/BoChangePassword/changePassword',$atrtibute);
        ?>

          <div class="cm_head1">
            <h3>Change Password</h3>
          </div>

          <div class="form-group row clearfix">

            <div class="col-sm-6 col-xs-12 cls_resp50">
              <label class="form-control-label">Current Password</label>
                <span class="mand_field">*</span>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your current password">              
            </div>

            <div class="col-sm-6 col-xs-12 cls_resp50 xrs_mat10">
              <label class="form-control-label">New Password</label>
              <span class="mand_field">*</span>
              <input type="password" class="form-control" id="newpassword" name="newpassword" placeholder="Enter your new password">              
            </div>
            
          </div>

          <div class="form-group row clearfix">
            <div class="col-sm-6 col-xs-12 cls_resp50">
              <label class="form-control-label">Confirm New Password</label>
                <span class="mand_field">*</span>
                <input type="password" class="form-control" id="repassword" name="repassword" placeholder="Enter your confirm password">
            </div>
          </div>

          <input type="submit" name="pwdchanges" value="save changes" class="cm_blacbtn1">
        <?php echo form_close(); ?>
      </div>

       <div class="inn_content" id="generalTabContent">

        <?php
            $atrtibute = array('role'=>'form','name'=>'changepattern','id'=>'changepattern','method'=>'post','class'=>'cm_frm1 verti_frm1');
            echo form_open('PropertyKeydetails/BoChangePassword/changepattern',$atrtibute);
        ?>

          <div class="alert alert-denger" id="pat_error" style="display: none;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
            <p id="pat_error_message"></p>
          </div>

          <div class="cm_head1">
            <h3>Change Pattern</h3>
          </div>

          <div class="form-group row clearfix">
            <div class="col-sm-5 col-xs-12 cls_resp50">
              <label class="form-control-label">Old Pattern</label>
                <span class="mand_field">*</span>
                <div id="old_pattern"></div>
            </div>            
          </div>

          <div class="form-group row clearfix" id="new_div">
            <div class="col-sm-5 col-xs-12 cls_resp50">
              <label class="form-control-label">New Pattern</label>
                <span class="mand_field">*</span>
                <div id="new_pattern"></div>   
            </div>            
          </div>

          <div class="form-group row clearfix">
            <div class="col-sm-5 col-xs-12 cls_resp50">
              <label class="form-control-label">Confirm Pattern</label>
                <span class="mand_field">*</span>
                <div id="conf_new_pattern"></div>     
            </div>
          </div>

        <!--   <div class="form-group row clearfix">
            <div class="col-sm-6 col-xs-12 cls_resp50">
              <input type="submit" name="patternchanges" value="save changes" class="cm_blacbtn1">
            </div>
          </div> -->

        <?php echo form_close(); ?>

      </div>

    </section>    

  </div>

      <input type="hidden" id="admin_url" name="admin_url" value="<?php echo wallet_url(); ?>">

  <footer class="main-footer"> 
   Copyright &copy; <?php echo $copyRight." ".$copySiteTitle; ?>. All rights reserved. 
  </footer>


</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php echo base_url(); ?>admin_assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>admin_assets/js/dashboard.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>admin_assets/js/lc_switch.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>admin_assets/plugins/validate/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>admin_assets/plugins/validate/additional-methods.js" type="text/javascript"></script> 
<script src="<?php echo base_url();?>admin_assets/pageJS_wallet/boChangePassword.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>admin_assets/css/lc_switch.css">

<script src="<?php echo base_url();?>admin_assets/js/patternLock.js"></script>

<?php $this->load->view('admin_wallet/common/csrf'); ?>


    
<script>


  var lock = new PatternLock("#old_pattern",{
    mapper: function(idx){
        // return (idx%9) + 1;
    },
     onDraw:function(pattern){
           oldpattern(pattern);
    }
});

  var lock1 = new PatternLock("#new_pattern",{
    mapper: function(idx){
        // return (idx%9) + 1;
    },
  /*   onDraw:function(pattern){
           alert(pattern);
    }*/
});

   var lock2 = new PatternLock("#conf_new_pattern",{
    mapper: function(idx){
        // return (idx%9) + 1;
    },
     onDraw:function(pattern){
           confirm_pattern(pattern);
    }
});

$(document).ready(function()
{
    lock1.disable();
    lock2.disable();
});

 var admin_url = $('#admin_url').val();

 


function oldpattern(pattern)
{

 


    $.ajax({
        type:'Post',        
        url:admin_url+"BoChangePassword/checkpattern",
        data:{'pattern':pattern},
        success:function(data)
        {
            if(data==pattern)
            {
                 lock.setPattern(data);
                 lock.disable();
                 lock1.enable();
                 lock2.enable();
                 window.location.hash="#new_div";
            }
            else
            {
                lock.error();
                $("#pat_error").show();
                $("#pat_error_message").html('Old Pattern is wrong');
                $("#pat_error").fadeOut(5000);
            }
        }
    });
}

function confirm_pattern(pattern)
{
    var newpat=lock1.getPattern();
    if(newpat==pattern)
    {
       $.ajax({
        type:'post',        
        url:admin_url+"BoChangePassword/set_pattern",
        data:{'newpat':newpat},
        success:function(data)
        {
            window.location.hash="#";
            location.reload();
        }
       });
    }
    else
    {
        lock2.error();
        $("#pat_error").show();
        $("#pat_error_message").html("Doesn't match confirm new pattern");
        window.location.hash="#generalTabContent";
    }
}

  </script>




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