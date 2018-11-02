
<?php $this->load->view("front/basic/verification") ?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta id="viewport" name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" type="image/png" href="<?php echo favicon()?>" sizes="16x16" />
<title>BitcoCyrus - is the most advanced exchange.</title>

<base href="<?php echo base_url(); ?>">

<!-- Bootstrap core CSS -->
<link href="<?php echo base_url() ?>assets/frontend/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url() ?>assets/frontend/css/bootstrap-reboot.css" rel="stylesheet">
<link href="<?php echo base_url() ?>assets/frontend/css/bootstrap-grid.css" rel="stylesheet">
<link href="<?php echo base_url() ?>assets/frontend/css/style.css?ver=<?php echo time() ?>" rel="stylesheet">

<link href="<?php echo base_url() ?>assets/frontend/css/animate.css" rel="stylesheet">

<link href="<?php echo base_url() ?>assets/frontend/css/responsive.css" rel="stylesheet">
<link href="<?php echo base_url() ?>assets/frontend/vendors/owl-carousel/owl.carousel.min.css" rel="stylesheet">
<script src="<?php echo base_url() ?>assets/frontend/js/jquery-3.2.1.min.js"></script>
<!--<link rel="stylesheet" href="assets/frontend/css/owl.theme.default.min.css">-->

    <link href="<?php echo base_url() ?>assets/frontend/vendors/flat-icon/flaticon.css" rel="stylesheet">
    <!-- Bootstrap -->
   

    <!-- Rev slider css -->
    <link href="<?php echo base_url() ?>assets/frontend/vendors/revolution/css/settings.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/frontend/vendors/revolution/css/layers.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/frontend/vendors/revolution/css/navigation.css" rel="stylesheet">

    <!-- Extra plugin css -->
    <link href="<?php echo base_url() ?>assets/frontend/vendors/nice-select/nice-select.css" rel="stylesheet">
    <script type="text/javascript" src="https://www.google.com/recaptcha/api.js"></script>

    <!--<link href="css/style.css" rel="stylesheet">-->
  
    

<!-- font css -->
<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,300i,400,400i,500,500i,700,700i,900" rel="stylesheet">
<link href="assets/frontend/css/font-awesome.min.css" rel="stylesheet">

<style type="text/css">
	.error {
    color: red !important;
}

.success_msg{
	color: green !important;
}
</style>
</head>
<!--  Preloader -->
<div class="preloader">
    <div class="left_pre"></div>
    <div class="right_pre"></div>
    <div class="row m0 content">
        <div class="circle">
            <div class="red">
                <div class="rotator">
                    <img src="<?php base_url() ?>assets/frontend/images/curve.png" alt="">
                </div>
                <a class="logo"><img src="<?php base_url() ?>assets/frontend/images/loading-img.png" alt=""></a>
            </div>
        </div>
    </div>
</div>

<body>
<!--  Preloader -->

<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>">