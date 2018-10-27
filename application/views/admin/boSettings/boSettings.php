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
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <?php $this->load->view('admin/common/header'); ?>
  <?php $this->load->view('admin/common/sidebar'); ?>
  <div class="content-wrapper">
    <section class="content">
      <ul class="breadcrumb cm_breadcrumb">
        <li><a href="<?php echo base_url()."BoDashboard"; ?>">Dashboard</a></li>
        <li><a href="<?php echo base_url()."BoSettings"; ?>">General Settings</a></li>
      </ul>
      <div class="inn_content">
          <?php
              $atrtibute = array('role'=>'form','name'=>'siteConfig','id'=>'siteConfig','method'=>'post','class'=>'cm_frm1 verti_frm1','enctype' =>'multipart/form-data');
              echo form_open('BoSettings/siteConfigUpdate',$atrtibute);
          ?>        
          
          <input type="hidden" name="adminID" id="adminID" value="<?php echo $adminID; ?>">
          <div class="cm_head1">
            <h3>General Settings</h3>
          </div>
          <?php $this->load->view('admin/common/flashMessage'); ?>
		  
		  <?php
			if($loggedUserId==1){
		  ?>
		  <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
          <div class="row">
			<div class="col-md-6">
			  <div class="form-group clearfix">
				  <label class="form-control-label">Admin First Name</label>
				  <span class="mand_field">*</span>
				  <input type="text" class="form-control" id="adminFirstName" name="adminFirstName" placeholder="Enter your first name" value="<?php echo $adminFirstName; ?>">
			  </div>
			</div>
			<div class="col-md-6">
				<div class="form-group clearfix">
                  <label class="form-control-label">Admin Last Name</label>
                  <span class="mand_field">*</span>
                  <input type="text" class="form-control" id="adminLastName" name="adminLastName" placeholder="Enter your last name" value="<?php echo $adminLastName; ?>">
                </div>
			</div>
		  </div>
          
		  <div class="row">
			<div class="col-md-6">
				<div class="form-group clearfix">
                  <label class="form-control-label">Site Name</label>
                  <span class="mand_field">*</span>
                  <input type="text" class="form-control" id="companyName" name="companyName" placeholder="Enter your company name" value="<?php echo $companyname; ?>">
                </div>
			</div>
			<div class="col-md-6">
				<div class="form-group clearfix">
                  <ul class="list-inline stng_lis1">
                    <li class="sfd1">
                      <label class="form-control-label">Site Logo</label>
                      <span class="mand_field">*</span>
                      <div class="input-group file-upload site-logo">
                        <input id="uploadFile1" class="form-control" placeholder="Upload site logo" disabled="disabled">
                        <input type="hidden" name="old_site_logo" value="<?php echo $companylogo;?>">                        
                        <div class="input-group-addon">
                          <div class="fileUpload btn btn-primary"> <span> Upload </span>
                            <input id="uploadBtn1" name="site_logo_image" class="upload file-upload site-logo" type="file">
                          </div>
                        </div>
                      </div>
                    </li>
                    <li class="sfd2"> 
                      <?php   if(isset($companylogo) && !empty($companylogo)) {
                              $imageChecking = "uploads/siteLogo/$companylogo"; 
                              if(file_exists($imageChecking)) { ?>
                        <img id="images_display" class="site_logo imgAlign" src="<?php echo base_url();?>uploads/siteLogo/<?php echo $companylogo;?>" class="img-responsive center-block" style="width: 73px; height: 61px;"/>
                      <?php } else {   ?> 
                        <img class="site_logo imgAlign" src="<?php echo base_url();?>uploads/no_image.png" style="width: 73px; height: 61px;" />
                      <?php } } else { ?>
                        <img class="site_logo imgAlign" src="<?php echo base_url();?>uploads/no_image.png" style="width: 73px; height: 61px;" />
                      <?php } ?>                    
                      <?php /* <img class="profile-pic img-responsive" alt="image" src="<?php echo base_url()."assets/admin/images/andro_im.png"; ?>" style="width: 73px; height: 61px;"> */ ?>
                    </li>
                  </ul>
                </div>
			</div>
		  </div>
		  
		  <div class="row">
			<div class="col-md-6">
				<div class="form-group clearfix">
					<label class="form-control-label">Admin contact number</label>
					<span class="mand_field">*</span>
					<input type="text" class="form-control" id="adminContactNumber" name="adminContactNumber" placeholder="Enter your contact number" value="<?php echo $adminContactNumber; ?>" maxlength="10">
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group clearfix">
                  <ul class="list-inline stng_lis1">
                    <li class="sfd1">
                      <label class="form-control-label">Site Favicon</label>
                      <span class="mand_field">*</span>
                      <div class="input-group file-upload favicon-upload">
                        <input id="uploadFile1" class="form-control" placeholder="Upload site Favicon" disabled="disabled">
                        <input type="hidden" name="old_site_favicon" value="<?php echo $companyfavicon;?>">                        
                        <div class="input-group-addon">
                          <div class="fileUpload btn btn-primary"> <span> Upload </span>
                            <input id="uploadBtn1" name="site_favicon" class="upload file-upload favicon-upload" type="file">
                          </div>
                        </div>
                      </div>
                    </li>
                    <li class="sfd2"> 
                      <?php   if(isset($companyfavicon) && !empty($companyfavicon)) {
                              $imageChecking = "uploads/siteLogo/$companyfavicon"; 
                              if(file_exists($imageChecking)) { ?>
                        <img id="images_display" class="favicon-pic imgAlign" src="<?php echo base_url();?>uploads/siteLogo/<?php echo $companyfavicon;?>" class="img-responsive center-block" style="width: 73px; height: 61px;"/>
                      <?php } else {   ?> 
                        <img class="favicon-pic imgAlign" src="<?php echo base_url();?>uploads/no_image.png" style="width: 73px; height: 61px;" />
                      <?php } } else { ?>
                        <img class="favicon-pic imgAlign" src="<?php echo base_url();?>uploads/no_image.png" style="width: 73px; height: 61px;" />
                      <?php } ?>
                    </li>
                  </ul>
                </div>
			</div>
		  </div>
		  
		  <div class="row">
			<div class="col-md-6">
				<div class="form-group clearfix">
				  <label class="form-control-label">Admin Contact us Mail</label>
				  <span class="mand_field">*</span>
				  <input type="email" class="form-control" id="adminContactEmail" name="adminContactEmail" placeholder="Enter your contact mail" value="<?php echo $contact_email; ?>">
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group clearfix">
                  <ul class="list-inline stng_lis1">
                    <li class="sfd1">
                      <label class="form-control-label">Profile image  <?php // echo $profile_image; ?></label>
                      <span class="mand_field">*</span>
                      <div class="input-group file-upload site-logo">
                        <input id="uploadFile1" class="form-control" placeholder="Upload site logo" disabled="disabled">
                        <input type="hidden" name="old_profile_image" value="<?php echo $profile_image;?>">                        
                        <div class="input-group-addon">
                          <div class="fileUpload btn btn-primary"> <span> Upload </span>
                            <input id="uploadBtn1" name="profile_image" class="upload file-upload site-logo" type="file">
                          </div>
                        </div>
                      </div>
                    </li>
                    <li class="sfd2"> 
                      <?php   if(isset($profile_image) && !empty($profile_image)) { ?>
                        <img id="images_display" class="profil imgAlign" src="<?php echo base_url();?>uploads/siteLogo/<?php echo $profile_image;?>" class="img-responsive center-block" style="width: 73px; height: 61px;"/>
                        <?php
                     } else { ?>
                        <img class="profile imgAlign" src="<?php echo base_url();?>uploads/no_image.png" style="width: 73px; height: 61px;" />
                      <?php } ?>                    
                      <?php /* <img class="profile-pic img-responsive" alt="image" src="<?php echo base_url()."assets/admin/images/andro_im.png"; ?>" style="width: 73px; height: 61px;"> */ ?>
                    </li>
                  </ul>
                </div>
			</div>
		  </div>
		  
		  <div class="row">
			<div class="col-md-6">
				 <div class="form-group clearfix">
                  <label class="form-control-label">Street address(with number)</label>
                  <span class="mand_field">*</span>
                  <input type="text" class="form-control" id="address" name="address" placeholder="Enter your contact number" value="<?php echo $address; ?>">
                </div>
             <!--   <div class="form-group clearfix">
                  <label class="form-control-label">State</label>
                  <span class="mand_field">*</span>
                  <input type="text" class="form-control" id="state" name="state" placeholder="Enter your contact number" value="<?php echo $state; ?>">
                </div>  -->
			</div>
			<div class="col-md-6">
				<div class="form-group clearfix">
                  <label class="form-control-label">City</label>
                  <span class="mand_field">*</span>
                  <input type="text" class="form-control" id="city" name="city" placeholder="Enter your contact number" value="<?php echo $city; ?>">
                </div>
			</div>
		  </div>
		  <div class="row">
			<div class="col-md-6">
			  <div class="form-group clearfix">
				  <label class="form-control-label">State</label>
				  <span class="mand_field">*</span>
				  <input type="text" class="form-control" id="state" name="state" placeholder="Enter your contact number" value="<?php echo $state; ?>">
			  </div>
			</div>
			<div class="col-md-6">
				<div class="form-group clearfix">
                  <label class="form-control-label">Country</label>
                  <span class="mand_field">*</span>
                  <input type="text" class="form-control" id="country" name="country" placeholder="Enter your contact number" value="<?php echo $country; ?>">
                </div> 
			</div>
		  </div>
			
		  <div class="cm_head1">
            <h4>Social Media</h4>
          </div>
		  <div class="row">
			<div class="col-md-6">
			  <div class="form-group clearfix">
                <label class="form-control-label">Facebook</label>
                <span class="mand_field">*</span>
                <input type="text" class="form-control" id="facebookURL" name="facebookURL" placeholder="Please enter Facebook URL" value="<?php echo $facebook_url; ?>">
              </div>              
			</div>
			<div class="col-md-6">
			  <div class="form-group clearfix">
                <label class="form-control-label">Twitter</label>
                <span class="mand_field">*</span>
                <input type="text" class="form-control" id="twitterURL" name="twitterURL" placeholder="Please enter Twitter URL" value="<?php echo $twitter_url; ?>">
              </div>
			</div>
		  </div>
		  
		  <div class="row">
			<div class="col-md-6">
			  <div class="form-group clearfix">
                <label class="form-control-label">Telegram</label>
                <span class="mand_field">*</span>
                <input type="text" class="form-control" id="telegramURL" name="telegramURL" placeholder="Please enter Telegram URL" value="<?php echo $telegram_url; ?>">
              </div>
			</div>
			<div class="col-md-6">
			  <div class="form-group clearfix">
                <label class="form-control-label">Medium</label>
                <span class="mand_field">*</span>
                <input type="text" class="form-control" id="mediumURL" name="mediumURL" placeholder="Please enter Medium URL" value="<?php echo $medium_url; ?>">
              </div>
			</div>
		  </div>

		  <div class="row">
			<div class="col-md-6">
			  <div class="form-group clearfix">
                <label class="form-control-label">Reddit</label>
                <span class="mand_field">*</span>
                <input type="text" class="form-control" id="redditURL" name="redditURL" placeholder="Please enter Reddit URL" value="<?php echo $reddit_url; ?>">
              </div>
			</div>
			<div class="col-md-6">
			  <div class="form-group clearfix">
                <label class="form-control-label">Youtube</label>
                <span class="mand_field">*</span>
                <input type="text" class="form-control" id="youtubeURL" name="youtubeURL" placeholder="Please enter Youtube URL" value="<?php echo $youtube_url; ?>">
              </div>
			</div>
		  </div>

		  
		  <?php } ?>

		  <div class="form-group row clearfix">
			<div class="col-sm-6 col-xs-6">
				<input type="submit" name="saveConfig" value="save changes" class="cm_blacbtn1">
			</div>
  		  </div>
        <?php echo form_close(); ?>
      </div>
    </section>
  </div>  
  <?php /* <div class="content-wrapper">
    <section class="content">
      <ul class="breadcrumb cm_breadcrumb">
        <li><a href="<?php echo base_url()."BoDashboard"; ?>">Dashboard</a></li>
        <li><a href="<?php echo base_url()."BoSettings"; ?>">General Settings</a></li>
      </ul>
      <div class="inn_content">
        <form class="cm_frm1 verti_frm1">
          <div class="cm_head1">
            <h3>General Settings</h3>
          </div>
          <div class="form-group row clearfix">
            <div class="col-sm-6 col-xs-12 cls_resp50">
              <label class="form-control-label">Username</label>
              <input type="text" class="form-control" placeholder="Username">
            </div>
            <div class="col-sm-6 col-xs-12 cls_resp50 xrs_mat10">
              <label class="form-control-label">Email</label>
              <input type="text" class="form-control" placeholder="Email">
            </div>
          </div>
          <div class="form-group row clearfix">
            <div class="col-sm-6 col-xs-12 cls_resp50">
              <label class="form-control-label">Phone 1</label>
              <input type="text" class="form-control" placeholder="Phone 1">
            </div>
            <div class="col-sm-6 col-xs-12 cls_resp50 xrs_mat10">
              <label class="form-control-label">Phone 2</label>
              <input type="text" class="form-control" placeholder="Phone 2">
            </div>
          </div>
          <div class="form-group row clearfix">
            <div class="col-sm-6 col-xs-12 cls_resp50">
              <label class="form-control-label">Address</label>
              <input type="text" class="form-control" placeholder="Address">
            </div>
            <div class="col-sm-6 col-xs-12 cls_resp50 xrs_mat10">
              <label class="form-control-label">City</label>
              <input type="text" class="form-control" placeholder="City">
            </div>
          </div>
          <div class="form-group row clearfix">
            <div class="col-sm-6 col-xs-12 cls_resp50">
              <label class="form-control-label">Postal Code</label>
              <input type="text" class="form-control" placeholder="Postal Code">
            </div>
            <div class="col-sm-6 col-xs-12 cls_resp50 xrs_mat10">
              <label class="form-control-label">State / Province</label>
              <input type="text" class="form-control" placeholder="State">
            </div>
          </div>
          <div class="form-group row clearfix">
            <div class="col-sm-6 col-xs-12 cls_resp50">
              <label class="form-control-label">Country</label>
              <div class="select_style1">
                <select>
                  <option>Select Country</option>
                  <option>India</option>
                  <option>America</option>
                </select>
              </div>
              <button type="button" class="cm_blacbtn1">Submit</button>
            </div>
          </div>
        </form>
      </div>
    </section>
  </div> */ ?>
    <footer class="main-footer"> Copyright &copy; <?php echo $copyRight." ".$copySiteTitle; ?>. All rights reserved. </footer>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php echo base_url(); ?>assets/admin/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/admin/plugins/validate/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/admin/plugins/validate/additional-methods.js" type="text/javascript"></script> 
<script src="<?php echo base_url();?>assets/admin/pageJS/boSettings.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/dashboard.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/lc_switch.js" type="text/javascript"></script>
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
