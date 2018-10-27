<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <link rel="icon" type="image/png" href="<?php echo favicon()?>" sizes="16x16" />
  <title>BitcoCyrus - is the most advanced exchange.</title>
  <meta name="description" content="<?php echo $description; ?>">
  <meta name="keywords" content="<?php echo $keywords; ?>">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/style.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/style_dashbard.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/dash_responsive.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/font-awesome.min.css">
  <!-- Bootstrap -->
  <link href="<?php echo base_url(); ?>assets/admin/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->

  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/admin/plugins/pattern/patternLock.css"/>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <?php $this->load->view('admin/common/header'); ?>
  <?php $this->load->view('admin/common/sidebar'); ?>
  <div class="content-wrapper">
    <section class="content">
      <ul class="breadcrumb cm_breadcrumb">
        <li><a href="<?php echo base_url()."BoDashboard"; ?>">Dashboard</a></li>
        <li><a href="<?php echo base_url()."BoChangePassword"; ?>">Change Password</a></li>
      </ul>
      <div class="inn_content">
        <?php
            $atrtibute = array('role'=>'form','name'=>'changePwd','id'=>'changePwd','method'=>'post','class'=>'cm_frm1 verti_frm1');
            echo form_open('BoChangePassword/changePassword',$atrtibute);
        ?>        
          <div class="cm_head1">
            <h3>Change Password</h3>
          </div>
          <?php $this->load->view('admin/common/flashMessage'); ?>
          <input type="hidden" name="userID" id="userID" value="<?php echo $userID; ?>">
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
              <input type="submit" name="pwdchanges" value="save changes" class="cm_blacbtn1">
            </div>
          </div>
        <?php echo form_close(); ?>


         <div class="cm_head1" >
            <h3>Change Pattern</h3>
          </div>
          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />



          <div class="form-group row clearfix">
            <div class="col-sm-4 col-xs-12 cls_resp50">
              <label class="form-control-label">Old Pattern</label>
                <span class="mand_field">*</span>
                <div id="old_pattern"></div>
            </div>            
          </div>

          <div class="form-group row clearfix" id="new_div">
            <div class="col-sm-4 col-xs-12 cls_resp50">
              <label class="form-control-label">New Pattern</label>
                <span class="mand_field">*</span>
                <div id="new_pattern"></div>   
            </div>            
          </div>

          <div class="form-group row clearfix">
            <div class="col-sm-4 col-xs-12 cls_resp50">
              <label class="form-control-label">Confirm Pattern</label>
                <span class="mand_field">*</span>
                <div id="conf_new_pattern"></div>     
            </div>
          </div>
      </div>


      

    </section>
  </div>
  <footer class="main-footer"> Copyright &copy; <?php echo $copyRight." ".$copySiteTitle; ?>. All rights reserved. </footer>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php echo base_url(); ?>assets/admin/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/dashboard.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/lc_switch.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/admin/plugins/validate/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/admin/plugins/validate/additional-methods.js" type="text/javascript"></script> 
<script src="<?php echo base_url();?>assets/admin/pageJS/boChangePassword.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/lc_switch.css">
<script src="<?php echo base_url();?>assets/admin/plugins/pattern/patternLock.js"></script>
<?php $this->load->view('admin/common/csrf'); ?>
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
      //  return (idx%9) + 1;
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

 
  var csrf=$('input[name="csrf_test_name"]').val();

    $.ajax({
        type:'Post',        
        url:"<?php echo base_url() ?>"+"BoChangePassword/checkpattern",
         data: "pattern="+pattern+"&csrf_test_name="+csrf,
             
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
    var csrf=$('input[name="csrf_test_name"]').val();
    if(newpat==pattern)
    {
       $.ajax({
        type:'post',        
        url:"<?php echo base_url() ?>"+"BoChangePassword/set_pattern",
        data:{'newpat':newpat,'csrf_test_name':csrf},
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
</body>
</html>