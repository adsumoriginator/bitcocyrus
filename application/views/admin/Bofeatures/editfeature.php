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

</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
    <?php $this->load->view('admin/common/header'); ?>
    <?php $this->load->view('admin/common/sidebar'); ?>
    <div class="content-wrapper">
        <section class="content">

            <ul class="breadcrumb cm_breadcrumb">
              <li><a href="<?php echo base_url()."BoDashboard"; ?>">Dashboard</a></li>
              <li><a href="<?php echo base_url()."Bofeatures"; ?>">Manage Features</a></li>
            </ul>

            <div class="inn_content">

            <?php
                $atrtibute = array('role'=>'form','name'=>'save_Features','id'=>'save_Features','class'=>'cm_frm1 verti_frm1','method'=>'post','onSubmit'=>'return checkAll();','enctype' =>'multipart/form-data');
                echo form_open('Bofeatures/updatefeaturepage',$atrtibute);
            ?>  

                    <input type="hidden" name="featureid" id="featureid" value="<?php echo $featureid; ?>">

                    <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>">

                    <div class="cm_head1">
                        <h3>Edit Features Post</h3>
                    </div> 

                    <div class="form-group row clearfix">
                        <div class="col-sm-12 col-xs-12">
                            <label class="form-control-label">Name</label>
                            <span class="mand_field">*</span>
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo $name;?>">                            
                        </div>
                    </div> 
                                       
                    <div class="form-group clearfix">
                        <label class="form-control-label">Description</label>
                        <span class="mand_field">*</span>
                        <textarea name="test_description" style="height: 100px;" class="form-control"  ><?php echo $test_description; ?></textarea>
                    </div>

                  
                    
                    <div class="form-group row clearfix">
                        <div class="col-sm-12 col-xs-12">
                            <label class="form-control-label">Features Images</label>
                            <input type="file" id="immm" class="immm form-control" name="features_image"  accept="image/png,image/gif,image/jpeg">
                        </div>
                    </div>
                    
                    <div class="fw_wd">
                    <div class="uplo_img">
                      <img src="<?php echo base_url(); ?>uploads/features/<?php echo $test_image; ?>" class="img img-responsive" />   
                      </div>
                      </div>

                  <input type="hidden" name="old_features_image" value="<?php echo $test_image;?>">           
                    
                    <div class="form-group clearfix"> 
                        <label for="subject">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="1" <?php if($status=='1'){ echo 'selected="selected"'; } ?>>Active</option>
                            <option value="0" <?php if($status=='0'){ echo 'selected="selected"'; } ?>>Inactive</option>
                        </select>
                    </div>                    
                    <ul class="list-inline">
                    <li>
                        <input type="submit" name="updatecmspage" value="Save changes" class="cm_blacbtn1">
                    </li>
                    <li>
                        <a href="<?php echo base_url()."Bofeatures"; ?>" class="cm_blacbtn1">Cancel</a>
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



<script src="<?php echo base_url();?>assets/admin/pageJS/editfeatures.js"></script>
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





</body>
</html>