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
                <li><a href="<?php echo base_url(); ?>BoDashboard">Dashboard</a></li>
                <li><a href="<?php echo base_url(); ?>BoFaq">FAQ </a></li>

                 <li>>Edit FAQ </a></li>
            </ul>
            <div class="inn_content">
                <?php
                    $atrtibute = array('role'=>'form','name'=>'updatefaq','id'=>'updatefaq','method'=>'post','enctype' =>'multipart/form-data');
                    echo form_open('BoFaq/updateFaq',$atrtibute);
                ?>
                    <input type="hidden" name="faqID" id="faqID" value="<?php echo $faqID; ?>">
                    <div class="cm_head1">
                        <h3>Edit FAQ</h3>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 col-xs-12">
                            <label class="form-control-label">Question</label>
                            <span class="mand_field">*</span>
                            <input type="text" class="form-control" id="faqQuestion" name="faqQuestion" placeholder="Question" value="<?php echo $faqQuestion;?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Answer</label>
                        <span class="mand_field">*</span>
                        <textarea name="faqAnswer" class="form-control" id="ckeditor"><?php echo $faqAnswer; ?></textarea>                        
                        <span id="error_ans"></span>                        
                    </div>
                    
                    <div class="form-group"> 
                        <label for="subject">status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1" <?php if($status=='1'){ echo 'selected="selected"'; } ?>>Active</option>
                                <option value="0" <?php if($status=='0'){ echo 'selected="selected"'; } ?>>Inactive</option>
                            </select>                            
                    </div>
                    
                    <ul class="list-inline">
                        <li>
                            <input type="submit" name="updateFaqDetails" value="Save changes" class="cm_blacbtn1">                                                  
                        </li>
                        <li>
                            <a href="<?php echo base_url()."BoFaq"; ?>" class="cm_blacbtn1">Cancel</a>
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
<script src="<?php echo base_url();?>assets/admin/pageJS/addFaq.js"></script>
<script src="<?php echo base_url();?>assets/admin/plugins/ckeditor/ckeditor.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/lc_switch.css">
<?php $this->load->view('admin/common/csrf'); ?>

<script>

        $(document).ready(function() {
        

  $('#updatefaq').validate({
    rules:{
      faqQuestion:{
        required:true,
         
      },
      faqAnswer:{
        required:true,
      
      },

         
     
    },
    messages:{
       faqQuestion:{
        required:"Please enter question",
    
      },
      faqAnswer:{
        required:"Please enter to Answer",
        
      },

     
      
    }
  })



         });

</script>




</body>
</html>