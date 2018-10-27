<?php $this->load->view('front/basic/header_inner');?>

<section class="main_innerpage">
  <div class="container-fluid">
  <div class="pro_section">
  <div class="pro_tit"> <h3>BALANCES </h3> </div>
  <div class="pro_line"></div>
  
  <div class="row">
      <div class="col-md-12">
         <div class="deposit_coin bg_sec inner_dep">
			<div class="deposit_coin_title"><span>Deposit</span></div>
			<div class="deposit_coin_inner">
			<div class="tab-content buy_main" id="nav-tabContent">
              <?php  if($this->uri->segment(3)!="withdraw") {?>
              <div id="1" class="tab-pane fade  active show">
                <?php }else{ ?>
                <div id="1" class="tab-pane fade">
                  <?php
                  }
                  ?>
				  <?php 
					if($select_currency=="XRP"){ ?>        
					<div class="curr_blk1">
					  <p class="text-center"> "The current minimum reserve requirement is 20 XRP." </p>
					</div>        
				  <?php
					}
				  ?>
				  <div class="deposit_coin_main">
					<form>
					  <div class="form-group">
						<label for="">Select your Currency</label>
						  <select class="form-control sel_cur" id="dep_select">
							<?php
								$is_maintain = "";
								foreach($all_currency->result() as $crow){ 
							?>
								<option <?php if($select_currency==$crow->currency_symbol){?>selected="selected" <?php }?> data-id="<?php echo $crow->in_maintenance;?>"  value="<?php echo $crow->currency_symbol ?>"><?php echo  $crow->currency_name ?> - <?php echo $crow->currency_symbol ?></option>
							<?php 
							if($select_currency==$crow->currency_symbol)
								$is_maintain = $crow->in_maintenance;
							} ?>
						  </select>
					  </div>
					  <input type="hidden" id="sid" value="<?php echo $user_id; ?>"/>
					  <?php
						if($is_maintain != 0) // 1 is not maintenance
						{ ?>
					  <div class="deposit_all">
						<div class="diposit_address">
							<p>Scan QR code</p>
							<img src="https://chart.googleapis.com/chart?cht=qr&chs=200x200&chl=<?php echo $depaddress; ?>&choe=UTF-8&chld=H%22;" class="img_address">
						</div>
						<div class="diposit_address_detail">
							<p>Or send funds to the address below</p>
							
							<div class="address-holder">
								<p>Address : </p>
								<?php if($depaddress != ''){?>
								<a onclick="copyToClipboard('#depAdr')" class="ico_cpoy">
									<i class="fa fa-files-o"></i>
								</a>
								<span class="text_address" id="depAdr">
								<?php echo $depaddress; } else {?></span>
								<a id="creatAdres" value="<?php echo $user_id; ?>" class="ico_cpoy" hidden>
									<i class="fa fa-plus-circle"></i> Create New Address
								</a>
								<?php } ?>
							</div>
							<?php if($select_currency=="XMR"){ ?>
							<div class="payment-id">
								<?php if($payment_id != '') {?>
								<p>Payment ID : 
								<a onclick="copyToClipboard('#payid')" class="ico_cpoy">
									<i class="fa fa-files-o"></i>
								</a>
								<span class="text_address" id="payid">
								<?php echo $payment_id; } ?></span></p>
							</div>
							<?php } ?>
							<span class="alert alert-danger d-table p-2">
								Send only <?php echo $select_currency ?> to this deposit address. Sending any other coin or token to this address may result in the loss of your deposit.
							</span>
						</div>
					  </div>
					  <?php } else { ?>
					  <div class="suspend mt-3">
						Deposit and Withdrawal for <b><?php echo $select_currency; ?></b> will be suspended during the mainnet swap and will open again once we deem the mainnet to be stable.
					  </div>
					  <?php } ?>
					  <div class="note mt-5">
							<p>Please note</p>
							<li>Coins will be deposited after network confirmations.</li>
							<li>After making a deposit, you can track its progress on the <a href="<?php echo base_url()?>transation/history">history</a> page.</li>
					  </div>
					</form>
				  </div>
                </div>
                </div>
         </div>
      </div>
	  </div>

       <div class="col-md-4" hidden>
        <div class="deposit_coin_list bg_sec">
			<div class="deposit_coin_title mt0 mb-3">
				<span>Recent transactions</span>
				<span class="forg_txt"><a href="<?php echo base_url()?>transation/history">View All</a></span>
			</div>			
		</div>
      </div>  

    </div>
  </div>
  </div>
</section>

<div id="address_confirm" class="modal fade copy_addr" role="dialog">
  <div class="modal-dialog"> 
    
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Address copied</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
    </div>
  </div>
</div>
<script>
  var min_withdraw_limit=<?php echo $min_withdraw_limit ?>;
  var max_withdraw_limit=<?php echo $max_withdraw_limit ?>;
  var balance=<?php echo $balance ?>;
  var withdraw_fee=<?php echo $withdraw_fee ?>;
  var tfa_status=<?php echo $tfa_status ?>;
  var kyc_status="<?php echo $kyc_status ?>";
  var usd_price="<?php echo $usd_price ?>";
  var usd_max_withdraw="<?php echo $usd_max_withdraw ?>";
</script>
<?php $this->load->view('front/basic/footer_inner');?>

<script src="<?php echo base_url() ?>assets/admin/plugins/validate/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/script/transation.js?ver=<?php echo time(); ?>"></script>

<script>

function copyToClipboard(element) {
  var $temp = $("<input>");
  $("body").append($temp);

    var addr=$(element).text();
    addr= $.trim(addr);
    $temp.val(addr).select();
  //$temp.val($(element).text()).select();
    document.execCommand("copy");
    $temp.remove();

   $('#address_confirm').modal('toggle');
$('#address_confirm').modal('show');
}

</script> 