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
                <li><a href="<?php echo base_url()."BoDashboard"; ?>">Home</a></li>
                  <li><a href="<?php echo base_url()."Bocms"; ?>">Manage CMS</a></li>
                <li><a >Edit CMS Page</a></li>
            </ul>
            <div class="inn_content">
<?php
    $atrtibute = array('role'=>'form','name'=>'savecms','id'=>'savecms','class'=>'cm_frm1 verti_frm1','method'=>'post','onSubmit'=>'return checkAll();','enctype' =>'multipart/form-data');
    echo form_open('Bocms/updatecmspage',$atrtibute);
?>                
                    <input type="hidden" name="cmsID" id="cmsID" value="<?php echo $cmsID; ?>">
                    <div class="cm_head1">
                        <h3>Edit CMS</h3>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 col-xs-12">
                            <label class="form-control-label">Page</label>
                            <span class="mand_field">*</span>
                            <input type="text" class="form-control" id="page" name="page" value="<?php echo $page;?>" readonly>                            
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 col-xs-12">
                            <label class="form-control-label">CMS Title</label>
                            <span class="mand_field">*</span>
                            <input type="text" class="form-control" id="cmsTitle" name="cmsTitle" value="<?php echo $cmsTitle;?>">                            
                        </div>
                    </div>                    
                    <div class="form-group">
                        <label class="form-control-label">CMS Content</label>
                        <span class="mand_field">*</span>
                        <textarea name="cmsDescription" class="ckeditor form-control" id="ckeditor"><?php echo $cmsDescription; ?></textarea>   
                        <span id="error_ans"></span>
                    </div>
                    
                                      
                    <ul class="list-inline">
                    <li>
                        <input type="submit" name="updatecmspage" value="Save changes" class="cm_blacbtn1">
                    </li>
                    <li>
                        <a href="<?php echo base_url()."Bocms"; ?>" class="cm_blacbtn1">Cancel</a>
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
<script src="<?php echo base_url();?>assets/admin/pageJS/editcms.js"></script>
<script src="<?php echo base_url();?>assets/admin/plugins/ckeditor/ckeditor.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/lc_switch.css">
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
<script>
CKEDITOR.replace('ckeditor' ,
{    
filebrowserBrowseUrl : '<?php echo base_url()?>assets/front/editor/ckfinder/ckfinder.html',
filebrowserImageBrowseUrl : '<?php echo base_url()?>assets/front/editor/ckfinder/ckfinder.html?type=Images',
filebrowserFlashBrowseUrl : '<?php echo base_url()?>assets/front/editor/ckfinder/ckfinder.html?type=Flash',
filebrowserUploadUrl : '<?php echo base_url()?>assets/front/editor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
filebrowserImageUploadUrl : '<?php echo base_url()?>assets/front/editor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images&currentFolder=userfiles/',
filebrowserFlashUploadUrl : '<?php echo base_url()?>assets/front/editor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
});
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
</body>
</html>