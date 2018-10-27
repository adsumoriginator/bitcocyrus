<?php $this->load->view('front/basic/header_inner.php');?>

<section class="main_innerpage">
	<div class="container-fluid pu-0">
		<div class="dash_page">
			<div class="row">
			<?php $site_data=site_settings(); ?>
				<div class="col-lg-3 pu-0">
					<div class="deposit_coin bg_sec">
						<h2 class="title_inner mb-3">your profile</h2>
						<div class="my_ac_detail">
							<div class="img_profile_my">
								<?php
									if($kyc_details->proof5_status==2){
										 $img_url=base_url()."uploads/kyc/".$kyc_details->id_proof5;
									}else{
										 $img_url=base_url()."assets/frontend/images/pro_img1.png";
									}
								?>
								<img src="<?php echo $img_url  ?>" />
								<p><?php echo $user_details->username ?></p> 
							</div>
								<?php if($user_details->kyc_status =="Verified"){?>
									<span class="text-success">Withdrawal limit : $<?php echo $site_data->allowd_withdrawal ?> USD equipment per day</span>
								<?php } else { ?>						
									<span class="text-danger">
										Withdrawal limit : $0 USD equipment per day<br/>
										Verify your profile to increase your limit to $<?php echo $site_data->allowd_withdrawal ?>. 
									</span>
								<?php }?>
							
							<hr/>
							<div class="my_ac_text">
								<div class="profile_info">
									<div class="profile_info_inner">											
										<div class="profile_info_status"><span class="badge badge-success"><i class="fa fa-check-square"></i></span></div>
										<div class="profile_info_data"><?php echo get_user_email($user_details->user_id)?></div>
									</div>
									<div class="profile_info_inner">											
										<div class="profile_info_status"><span class="badge badge-success"><i class="fa fa-check-square"></i></span></div>
										<div class="profile_info_data"><?php echo $user_details->phone_no; ?></div>
									</div>										
									<div class="profile_info_inner">
										<div class="profile_info_status"><?php
											if($user_details->kyc_status!="Verified"){ ?>
												<span class="badge badge-danger"><i class="fa fa-ban"></i></span> 
											<?php }else{ ?>
												<span class="badge badge-success"><i class="fa fa-check-square"></i></span>
											<?php } ?>
										</div>
										<div class="profile_info_data">KYC Verification</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-9 pu-0">
					<div class="deposit_coin bg_sec">
						<div class="row">
							<div class="col-md-6">
								<h2 class="title_inner mb-3 text-left">WALLET BALANCES</h2>
								<?php
									$btcval = $pairs['BTC'];
									$usdval = $pairs['USDT'];
								?>
							</div>
							<div class="col-md-6">
								<a href="<?php echo base_url()?>transation/withdraw/withdraw/BTC" class="withdraw_btn pull-right">WITHDRAW</a>
								<a href="<?php echo base_url()?>transation/deposit/BTC" class="dep_btn pull-right">DEPOSIT</a>
							</div>
						</div>
						<div class="row mt-3">
							<div class="col-md-9">
								<h4 class="dbord_text3 text-left">Estimated value of holdings : <b id="usdsum"> </b> USD / <b id="btcsum">  </b> BTC</h4>
							</div>
							<div class="col-md-3">
								<div class="form-check" style="float:right;">
									<input type="checkbox" name="coupon_question" onclick="hide_zero()" class="form-check-input" id="exampleCheck1">
									<label class="form-check-label" id="log" for="exampleCheck1">Hide Zero</label>
								</div>
							</div>
						</div>
						<div class="row col-md-12">
							<h4 class="dbord_text3 text-left">
							<?php if($user_details->kyc_status =="Verified"){
								foreach($get_usd_amount->result() as $rows){
									$usd_balance = $rows->total_usd_amount;
									$remain = $site_data->allowd_withdrawal - $usd_balance;
								}
							?>
								<b>$<?php echo number_format($remain, 2) ?></b> remaining of <b>$<?php echo number_format($site_data->allowd_withdrawal, 2) ?></b> USD daily limit.
							<?php } else { ?>
								$0.00 remaining of $0.00 USD <a style="color: #48c0ef;" href="<?php echo base_url()?>user/profile">daily limit.</a>
							<?php } ?>
							</h4>
						</div>
						<hr/>
						
						<div class="dbord_coin_list">
							<div class="row">
								<?php
									$i=0;
									foreach($get_user_dashboard_data->result() as $row) {
										$currency_symbol = $row->currency_symbol;
										$balance = $row->balance;
								?>
								<div id="zero_hide" class="col-lg-4 col-md-6 <?php if($balance == '0.00000000'){?>hide_zero<?php }?>">
									<div class="dbord_coin_list_inner">
										<div class="dbord_img">
											<?php 
												$img_exist = "assets/frontend/images/coins_icons/".strtolower($currency_symbol).".png";
											?>
											<img src="assets/frontend/images/coins_icons/<?php if(file_exists($img_exist)){ echo strtolower($currency_symbol);} else { echo "null";}?>.png">
										</div>
										<div class="dbord_text">											
											<div class="dbord_text1"><?php echo $row->currency_name ?></div>
											<div class="dbord_text2"><?php echo $balance ?></div>
											<?php
												if($i == 0) {
													$btcval = 1;
												} else {
													$btcval = $pairs['BTC'][$i-1]->price;
												}
												$btc_value = $balance * $btcval;
												$sum_btc += $btc_value;
												
												if($i == 3){
													$usd_value = $balance;
												} else {
													$usdval = $pairs['USDT'][0]->price;
													$usd_value = $btc_value * $usdval;
												}
												$sum_usd += $usd_value;
											?>
											<div class="dbord_text4">Total in BTC : <?php echo number_format($btc_value, 6); ?></div>
											<div class="dbord_text4">Total in USD : <?php echo number_format($usd_value, 6); ?></div>
										</div>
									</div>
								</div>
								<?php
										$i++;
									}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


<!-- Modal -->
<div id="address_confirm" class="modal fade copy_addr" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
      
        <h4 class="modal-title">Address Copied</h4>
		  <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
    </div>

  </div>
</div>
</section>

<?php $this->load->view('front/basic/footer_inner');?>

<script>
$(document).ready(function(){
	//initial state for coupon_question checkbox
var bal_visiblity = localStorage.getItem('balance_visiblity');	

if(bal_visiblity == 'true'){
	$('input[name="coupon_question"]').prop('checked', true);
	hide_zero();
	
}
else{
	$('input[name="coupon_question"]').prop('checked', false);
	hide_zero();
	
}
});


function copyToClipboard(element) {
	var $temp = $("<input>");
	$("body").append($temp);
	var addr=$(element).text();
	addr= $.trim(addr);
	$temp.val(addr).select();
	document.execCommand("copy");
	$temp.remove();
	$('#address_confirm').modal('toggle');
	$('#address_confirm').modal('show');
}


//set checkbox value to localstorage
function hide_zero() {
	var coupon_question = $('input[name="coupon_question"]').prop("checked");
	if( coupon_question == true){
		$(".hide_zero").hide();
		localStorage.setItem('balance_visiblity',coupon_question);				
	}
	else{
		$(".hide_zero").show();
		localStorage.setItem('balance_visiblity',coupon_question);		
	}
}

var btc_sum = "<?php echo number_format($sum_btc, 6);?>";
$('#btcsum').html(btc_sum);
var usd_sum = "<?php echo number_format($sum_usd, 6);?>";
$('#usdsum').html(usd_sum);

</script>