<?php $this->load->view('front/basic/header_inner.php');?>

<section class="main_innerpage">
	<div class="container-fluid">
		<div class="pro_section">
			<div class="pro_tit">
				<h3> SECURITY  </h3>
			</div>
			<div class="alert alert-denger" style="display:none" >
				<button class="close" type="button" data-dismiss="alert">×</button>
				<div id="error"></div>
			</div>

			<div class="alert alert-success profile" style="display:none">
			   <button class="close" type="button" data-dismiss="alert">×</button>
			   <div class="success"></div>
			</div>
			<div class="pro_line"></div>

			<div class="pro_box">
				<div class="row" >
					<div class="col-lg-8">
						<div class="deposit_coin bg_sec">
							<h2 class="title_inner mb-5">
								TWO FACTOR AUTHENTICATION (2FA)
								<?php
								if( $user_details->tfa_status == 0) { ?>
									IS <span class="text-denger">DISABLED</span>
								<?php } else { ?>
									IS <span class="text-success">ENABLED</span>
								<?php }?>
							</h2>
							
							<form id="change_tfa_form" action="">
							<div class="profile_main form_main">
								<div class="row">
									<div class="col-md-6">
										<h5>Two Factor Authentication 
											<?php
											if( $user_details->tfa_status == 0) { ?>
												Disabled
											<?php } else { ?>
												Enabled
											<?php }?>
										</h5>
										<?php
											if( $user_details->tfa_status == 0) { ?>
										<p>For extra account security, we strongly recommend you enable two-factor authentication (2FA).
										BitcoCyrus uses Google Authenticator for 2FA.</p>
										<p>
											<a href="#">- What is 2FA and why do I need it?</a>
											<br>
											<a href="#">- How do I to set up 2FA?</a>
										</p>
										<?php } else { ?>
										<p>If you want to turn off 2FA, input your account password and the six-digit code provided by the Google Authenticator app below, then click "Disable 2FA".</p>
										<?php }?>
										<hr/>
										<div class="form-group">
											<label>Password</label>
											<input type="password" class="form-control" placeholder="Enter Password" name="password">
										</div>
										<div class="form-group">
											<label>Verification  Code</label>
											<input type="text" class="form-control" placeholder="Enter 2FA Code" name="code">
										</div>
										
										<?php
											if( $user_details->tfa_status == 0) { ?>
										<p><strong>Before turning on 2FA, write down or
										<span onclick="printDiv('printableArea')" class="print_key">print a copy of your 16-digit key</span> and put it in a safe place.</strong> 
										If your phone gets lost, stolen, or erased, you will need this key to get back into your account!</p>
										<div class="form-check">
											<input type="checkbox" name="checkBackup" class="form-check-input" id="checkBackup">
											<label class="form-check-label" for="checkBackup">I have backed up my 16-digit key.</a></label>
											<label id="checkBackup" class="error" for="checkBackup" style="display:none"></label>
										</div>
										
										<p class="mt-1"><strong>As per our records, you have opted for OTP. We strongly recommend you to opt for 2FA.</strong>
										Once you have enabled 2FA, it is recommended that you delete your old API keys, create new ones, and apply IP Access Restriction filters.</p>
										<?php } else { ?>
										<div class="form-check">
											<input type="checkbox" name="checkBackup" class="form-check-input" id="checkBackup">
											<label class="form-check-label" for="checkBackup">I have backed up my 16-digit key.</a></label>
											<label id="checkBackup" class="error" for="checkBackup" style="display:none"></label>
										</div>
										<?php }?>
									</div>
									
									<?php
										if( $user_details->tfa_status == 0) { ?>
									<div class="col-md-6">
										<img src="<?php echo $user_details->tfa_url?>" class="d-table qr_2fa" />
										<h6 class="mt-3">16-Digit Key :
											<span class="text-danger"><?php echo $user_details->tfa_secrect_key ?></span>
										</h6>
										<p>
											<label onclick="printDiv('printableArea')" class="print_key">Print a backup of your recovery key.</label>
										</p>
										<small>NOTE: This code changes each time you enable 2FA. If you disable 2FA this code will no longer
											be valid.</small>
									</div>
									<?php } else { ?>
										<div class="col-md-6">
											<h5>Withdrawal Verification</h5>
											<p>With 2FA enabled, you will be asked to enter your 2FA code when placing withdrawals. You may optionally opt out of the additional step of email validation so that withdrawals are placed immediately after you enter your code.</p>
										</div>
									<?php } ?>
								</div>
							</div>
							<?php
							if( $user_details->tfa_status==0) { ?>
								<button class="ena_btn btn btn-primary btn_buy mx-auto mt-4 d-table" id="change_tfa_button" value="tfa_update" name="tfa_update">ENABLE 2FA</button>
							<?php
							}else { ?>
							  <button class="ena_btn btn btn-primary btn_buy mx-auto mt-4 d-table" id="change_tfa_button" value="tfa_update" name="tfa_update">DISABLE 2FA</button>
							<?php
							}
							?>
						  </form>
						</div>
					</div>

					<div class="col-lg-4">
						<div class="deposit_coin bg_sec">
							<h2 class="title_inner mb-5">Change Password</h2>
							<div class="profile_main form_main">
								<div class="col-lg-12">
									<form action="" id="password_form">
								  <div class="form-group">
									<label for="">Current Password</label>
									<input type="password" class="form-control"  placeholder="Enter Current Password" name="old_password">
								  </div>
								  
								   <div class="form-group">
									<label for="">New Password</label>
									<input type="password" class="form-control"  placeholder="Enter New Password" name="password" id="password">
								  </div>
								  
								   <div class="form-group">
									<label for="">Confirm New Password</label>
									<input type="password" class="form-control"  placeholder="Enter Confirm New Password" name="confirm">
								  </div>
								  
								   <div class="form-group">
									<label for="">Please enter 2FA code</label>
									<input type="text" class="form-control"  placeholder="Enter 2FA Code" name="otp">
									<label id="otp-error" class="error" for="otp"></label>
								  </div>				  
								  <button class="pro_btn btn btn-primary btn_buy mx-auto mt-1 d-table" name="change_pass" value="chnage pass" id="password_button">SUBMIT</button>
								  </form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</section>

<div class="center" id="printableArea" hidden>
	<img class="mt-5 d-table" src="./assets/frontend/images/logo_black.png" style="width: 500px;text-align: center;margin: 0 auto;" />
	<h1 style="font-weight: 100; line-height: 2.5em;margin: 0 auto;text-align: center;">BITCOCYRUS 2FA BACKUP CODE</h1>
	<p style="font-size:20px;margin: 0 auto;text-align: center;"><strong>If your phone is lost, stolen, or erased you'll need to restore your authenticator
	application from a this backup. Please store it in a safe place.</strong></p>

	<img src="<?php echo $user_details->tfa_url?>" class="d-table qr_2fa" style="max-width: 400px;text-align: center;margin: 0 auto;" />
	<h4 class="mt-3" style="text-align: center;margin: 0 auto;">16-Digit Key : <?php echo $user_details->tfa_secrect_key ?></h4>
	<p style="font-size:20px;margin: 0 auto;text-align: center;">NOTE: This code changes each time you enable 2FA. If you disable 2FA this code will no longer be valid.</p>
	<hr/>
	
	<div class="" style="text-align: center;margin: 0 auto;">Server time : <?php echo date("d-m-Y H:i:s")?>  <?php echo date("e") ?> </div>
	<div class="" style="text-align: center;margin: 0 auto;">24hr Volume : <?php $btc= getTradeVolume_main(1); echo number_format($btc,2);?> BTC | <?php $eth=getTradeVolume_main(2); echo number_format($eth,2);?> ETH | <?php $bch=getTradeVolume_main(3);echo number_format($bch,2);?> BCH | <?php $usdt=getTradeVolume_main(4); echo number_format($usdt,2);?> USDT </div>
	<div class="" style="text-align: center;margin: 0 auto;">©<script> document.write(new Date().getFullYear()); </script> BitcoCyrus, LLC. ALL RIGHTS RESERVED</div>
</div>

<style>
.center {
    text-align: center;
    border: 3px solid green;
}
</style>
<script>
function printDiv(printableArea) {
	var printContents = document.getElementById(printableArea).innerHTML;
	var originalContents = document.body.innerHTML;

	document.body.innerHTML = printContents;

	window.print();

	document.body.innerHTML = originalContents;
}
</script>

<?php $this->load->view('front/basic/footer_inner.php');?>
