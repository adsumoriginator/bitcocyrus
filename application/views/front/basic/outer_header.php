
<div class="home_head">
<nav class="navbar navbar-expand-md navbar-dark fixed-top"> 
	<a class="navbar-brand" href="<?php echo base_url()?>"><img src="<?php echo getSiteLogo(); ?>"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
    <div class="collapse navbar-collapse " id="navbarCollapse">
        <ul class="navbar-nav mrl-auto">
			<li class="nav-item "> <a class="nav-link active" href="<?php echo base_url() ?>trade">Exchange </a> </li>
        </ul>    
        <?php 
			$seg_page=$this->uri->segment(2);
			if(!$this->session->userdata("user_id")){
        ?>
        <ul class="navbar-nav ml-auto rite_nav">
			<li  class="nav-item"> <a class="nav-link <?php if($seg_page=="login"){?> active <?php } ?>" href="<?php echo base_url() ?>home/login">Login </a> </li>
            <li  class="nav-item"> <a class="nav-link  <?php if($seg_page=="register"){?> active <?php } ?>" href="<?php echo base_url() ?>home/register">Register </a> </li>
            <?php }else{ ?>
        </ul>
        <ul class="navbar-nav ml-auto rite_nav">
			<li class="nav-item "> <a class="nav-link <?php if($seg_page=="dashboard"){?> active <?php } ?>"" href="<?php echo base_url() ?>user/dashboard">DASHBOARD </a> </li>
			<?php $array_values=array("balance","deposit","withdraw");?>
			<li class="nav-item dropdown">
			<a  class="nav-link dropdown-toggle <?php if($seg_page=="balance" || $seg_page=="deposit" || $seg_page=="withdraw" || $seg_page=="history" ){ ?>active <?php } ?>" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">FUNDS</a>
				<div class="dropdown-menu" aria-labelledby="dropdown03">
					<!-- <a class="dropdown-item" href="<?php echo base_url() ?>user/dashboard"> Balances</a>-->
					<a class="dropdown-item" href="<?php echo base_url() ?>transation/deposit/BTC"> Deposits</a>
					<a class="dropdown-item" href="<?php echo base_url() ?>transation/withdraw/withdraw/BTC"> Withdrawals</a>
					<a class="dropdown-item" href="<?php echo base_url()?>transation/history"> TRANSACTIONS </a> 
				</div>
			</li>
			<li class="nav-item dropdown">
				<a  class="nav-link dropdown-toggle" id="notificationmenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">NOTIFICATIONS(<span id="notification_list">0 </span>)</a>
				<div class="dropdown-menu" aria-labelledby="notificationmenu" id="nodata"></div>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php  echo $this->session->userdata("username");?></a>
				<div class="dropdown-menu" aria-labelledby="dropdown03">
					<a class="dropdown-item" href="<?php echo base_url() ?>user/profile">Profile</a>
					<a class="dropdown-item" href="<?php echo base_url() ?>user/security">  SECURITY</a>
					<a class="dropdown-item" href="<?php echo base_url() ?>user/user_activity">  RECENT ACTIVITY</a>
					<a class="dropdown-item" href="<?php echo  base_url() ?>home/logout">Logout</a>
				</div>
			</li>       
      </ul>
      <?php } ?>
    </div>
</nav>
</div>