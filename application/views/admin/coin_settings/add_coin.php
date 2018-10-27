<?php 
	$this->load->view("admin/header") ?>
<style>
/* Paste this css to your style sheet file or under head tag */
/* This only works with JavaScript, 
if it's not present, don't show loader */
.no-js #loader { display: none;  }
.js #loader { display: block; position: absolute; left: 100px; top: 0; }
.se-pre-con {
    position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: url('https://media.giphy.com/media/RdfQlwy8hiFm8/source.gif') center no-repeat #fff;
}

#reason_text{
  outline: none !important;
    border:1px solid ;
    box-shadow: 0 0 10px #719ECE;
}

.cls_inner_cate {
    position: absolute;
    top: 100%;
}
.hiddenf {
    display: none;
}
.flyout {
    left: 0;
    position: absolute;
    top: 100%;
    z-index: 999;
}

.user_img img{
    height: 200px;
    width:200px;
}
</style>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
		<?php $this->load->view('admin/common/header'); ?>
		<?php $this->load->view('admin/common/sidebar'); ?>
		<div class="content-wrapper">
			<section class="content">
				<ul class="breadcrumb cm_breadcrumb">
					<li><a href="<?php echo base_url()."BoDashboard"; ?>">Dashboard</a></li>
					<li><a href="<?php echo base_url()."BoCoin_settings/view_coin"; ?>">Currency Details</a></li>
					<li><a>Add Currency</a></li>
				</ul>
				<div class="inn_content">
					<div class="alert alert-denger" id="doc_rejected" style="display: none;"></div>
					<div class="alert alert-success" id="doc_success" style="display: none;"></div>
					<?php
						$atrtibute = array('role'=>'form','method'=>'post','id'=>'coin-form', 'name'=>'coin-form','class'=>'cm_frm1 verti_frm1','enctype' =>'multipart/form-data');
						echo form_open('',$atrtibute);
					?>
					<div class="cm_head1"><h3>Add Currency</h3></div>
					<div class="form-group row clearfix">
						<div class="col-sm-12 cls_resp50">
							<label class="form-control-label">Currency Name</label>
							<span class="mand_field">*</span>
							<input type="text" name="currency_name" id="currency_name" class="form-control" value=""/>
						</div>
					</div> 
					<div class="form-group row clearfix">
						<div class="col-sm-12 cls_resp50">
							<label class="form-control-label">Currency Code</label>
							<span class="mand_field">*</span>
							<input type="text" name="currency_code" id="currency_code" class="form-control" value=""/>
						</div>
					</div> 
					<div class="form-group row clearfix">
						<div class="col-sm-12 cls_resp50">
							<label class="form-control-label">Minimum withdaw limit</label>
							<span class="mand_field">*</span>
							<input type="text" name="min_withdraw_limit" id="min_withdraw_limit" class="form-control" value=""/>
						</div>
					</div> 
					<div class="form-group row clearfix">
						<div class="col-sm-12 cls_resp50">
							<label class="form-control-label">Maximum withdaw limit</label>
							<span class="mand_field">*</span>
							<input type="text" name="max_withdraw_limit" id="max_withdraw_limit" class="form-control" value=""/>
						</div>
					</div> 
					<div class="form-group row clearfix">
						<div class="col-sm-12 cls_resp50">
							<label class="form-control-label">Withdraw fee(%)</label>
							<span class="mand_field">*</span>
							<input type="text" name="withdraw_fees" id="withdraw_fees" class="form-control" value=""/>
						</div>
					</div> 
					
					<div class="form-group row clearfix">
						<div class="col-sm-12 cls_resp50">
							<label class="form-control-label">Admin Address</label>
							<span class="mand_field">*</span>
							<input type="text" name="admin_address" id="admin_address" class="form-control" value=""/>
						</div>
					</div> 
					
					<div class="form-group row clearfix">
						<div class="col-sm-12 cls_resp50">
							<div class="col-lg-11 p-0">
								<label class="form-control-label">Currency Icon</label>
								<span class="mand_field">*</span>
								<label name="currency_icons"></label>
								<div class="input-group file-upload site-logo">
									<input id="uploadFile1" class="form-control" placeholder="Upload site logo" disabled="disabled">
									<div class="input-group-addon">
									  <div class="fileUpload btn btn-primary"> <span> Upload </span>
										<input id="uploadBtn1" name="currency_icon" class="upload file-upload site-logo" type="file">
									  </div>
									</div>
								</div>
							</div>
							<div class="col-lg-1">
							<?php   if(isset($currency_icon) && !empty($currency_icon)) { ?>
							<img id="images_display" class="profil imgAlign" src="<?php echo base_url();?>assets/frontend/images/coins_icons/<?php echo $currency_icon;?>" class="img-responsive center-block" style="width: 70px; height: 70px;"/>
							<?php
							} else { ?>
							<img class="profile imgAlign" src="<?php echo base_url();?>uploads/no_image.png" style="width: 70px; height: 70px;" />
							<?php } ?>
							</div>
						</div>
					</div> 
					
					<div class="form-group row clearfix">
						<div class="col-sm-3 col-xs-12 cls_resp50">
							<label class="form-control-label">Trade Pair</label>
							<span class="mand_field">*</span>
						</div>
						<div class="col-sm-9 col-xs-12 cls_resp50">
							<div class="form-check">
								<input type="checkbox" name="chk_trad_pair[]" class="form-check-input" id="chkBTC" value="1">
								<label class="form-check-label" id="log" for="chkBTC"> BTC</label>
							
								<input type="checkbox" name="chk_trad_pair[]" class="form-check-input" id="chkETH" value="2">
								<label class="form-check-label" id="log" for="chkETH"> ETH</label>
							
								<input type="checkbox" name="chk_trad_pair[]" class="form-check-input" id="chkBCH" value="3">
								<label class="form-check-label" id="log" for="chkBCH"> BCH</label>
							
								<input type="checkbox" name="chk_trad_pair[]" class="form-check-input" id="chkUSDT" value="4">
								<label class="form-check-label" id="log" for="chkUSDT"> USDT</label>
							</div>
						</div>
					</div>
					
					<div class="form-group row clearfix">
						<div class="col-sm-6 col-xs-12 cls_resp50">
							<label class="form-control-label"></label>
							<input type="submit" name="add" value="Add new" class="cm_blacbtn1">
						</div>
					</div> 
					<ul class="list-inline"><li></li></ul>
					<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
					<?php form_close(); ?>					 
				</div>
			</section>
		</div>
	</div>
	<?php $this->load->view("admin/footer") ?>	
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="<?php echo base_url(); ?>assets/admin/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url();?>assets/admin/plugins/validate/jquery.validate.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>assets/admin/plugins/validate/additional-methods.js" type="text/javascript"></script> 
	<script src="<?php echo base_url();?>assets/admin/pageJS/addCoin.js"></script>
			
</body>
</html>