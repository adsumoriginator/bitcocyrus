
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
<link href="assets/frontend/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/frontend/css/style_trade.css" rel="stylesheet">

<link href="assets/frontend/css/animate.css" rel="stylesheet">

<link href="assets/frontend/css/responsive.css" rel="stylesheet">
<link href="assets/frontend/css/owl.carousel.css" rel="stylesheet">
<link rel="stylesheet" href="assets/frontend/css/owl.theme.default.min.css">

<!-- font css -->
<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,300i,400,400i,500,500i,700,700i,900" rel="stylesheet">
<link href="assets/frontend/css/font-awesome.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

  <script src="https://www.amcharts.com/lib/4/core.js"></script>
<script src="https://www.amcharts.com/lib/4/charts.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>
</head>

<body class="my_sec white_web">

<div class="header fixed-top">
    <nav class="navbar navbar-expand-md navbar-dark "> 
		<a class="navbar-brand" href="<?php echo base_url()?>"><img src="<?php echo getSiteLogo(); ?>"></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
		<div class="collapse navbar-collapse " id="navbarCollapse">
			<ul class="navbar-nav mrl-auto">
				<li class="nav-item "> <a class="nav-link active" href="<?php echo base_url()?>trade">Exchange </a> </li>
			</ul>              
			<?php 
				$seg_page=$this->uri->segment(2);
				if(!$this->session->userdata("user_id")){
            ?>
            <ul class="navbar-nav ml-auto rite_nav">
				<li class="nav-item"> <a class="nav-link " href="<?php echo base_url() ?>home/login">Login </a> </li>
				<li class="nav-item"> <a class="nav-link " href="<?php echo base_url() ?>home/register">Register </a> </li>            
			</ul>
			<?php }else{ ?>
			<ul class="navbar-nav ml-auto rite_nav">
				<li class="nav-item"> <a class="nav-link   <?php if($seg_page=="dashboard"){?> active <?php } ?>" href="<?php echo base_url() ?>user/dashboard">DASHBOARD </a> </li>
				<?php $array_values=array("balance","deposit","deposit_withdraw");?>
				<li class="nav-item dropdown">
				<a  class="nav-link dropdown-toggle <?php if($seg_page=="balance" || $seg_page=="deposit" || $seg_page=="deposit_withdraw" || $seg_page=="history" ){ ?>active <?php } ?>" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">FUNDS</a>
					<div class="dropdown-menu" aria-labelledby="dropdown03">
						<!-- <a class="dropdown-item" href="<?php echo base_url() ?>user/dashboard"> Balances</a>-->
						<a class="dropdown-item" href="<?php echo base_url() ?>transation/deposit/BTC"> Deposits</a>
						<a class="dropdown-item" href="<?php echo base_url() ?>transation/withdraw/withdraw/BTC"> Withdrawals</a>
						<a class="dropdown-item" href="<?php echo base_url()?>transation/history"> TRANSACTIONS </a> 
					</div>
				</li>
				<li class="nav-item dropdown">
					<a  class="nav-link dropdown-toggle" id="notificationmenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">NOTIFICATIONS(<span id="notification_list">0</span>)</a>
					<div class="dropdown-menu" aria-labelledby="notificationmenu" id="nodata"></div>
				</li>
				<?php $array_values=array("security","user_activity","Profile"); ?>
				<li class="nav-item dropdown">
					<a  class="nav-link dropdown-toggle <?php if($seg_page=="profile" || $seg_page=="security" || $seg_page=="user_activity" ){ ?>active <?php } ?>" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php  echo $this->session->userdata("username");?></a>
					<div class="dropdown-menu" aria-labelledby="dropdown03">
						<a class="dropdown-item" href="<?php echo base_url() ?>user/profile">Profile</a>
						<a class="dropdown-item" href="<?php echo base_url() ?>user/security">  SECURITY</a>
						<a class="dropdown-item" href="<?php echo base_url() ?>user/user_activity">  RECENT ACTIVITY</a>
						<a class="dropdown-item" href="<?php echo  base_url() ?>home/logout">Logout</a>
					</div>
				</li>
				<li id="menu_trad_his" class="nav-item d-none">
					<a class="nav-link" href="javascript:void(0)" onclick="openmenu()"><i class="fa fa-bars"></i></a>
				</li>
			</ul>
			<?php } ?>
        </div>
	</nav>
</div>

<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url();?>"> 