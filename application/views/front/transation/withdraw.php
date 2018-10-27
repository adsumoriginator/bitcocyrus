<?php $this->load->view('front/basic/header_inner');?>

<section class="main_innerpage">
  <div class="container-fluid">
  <div class="pro_section">
  <div class="pro_tit"> <h3>BALANCES </h3> </div>
  <div class="pro_line"></div>
  
  <div class="row">
      <div class="col-md-12">
         <div class="deposit_coin bg_sec inner_dep">
			<div class="deposit_coin_title"><span>Withdraw</span></div>
			<div class="deposit_coin_inner">
			<div class="tab-content buy_main" id="nav-tabContent">
                <?php  if($this->uri->segment(3)=="withdraw") {?>
                <div id="2" class="tab-pane fade sell_main active show">
                  <?php }else{ ?>
                  <div id="2" class="tab-pane fade">
                    <?php
                  }
                  ?>
                    <div class="withdrow_coin_main">
						<div class="alert alert-denger alert-dismissable" style="display:none"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <div class="withdraw_error"> </div>
                        </div>
        
                        <div class="withdrow_coin_main" id="withdraw_div">
                          <?php
							$attributes = array('class' => 'withdraw_form', 'id' => 'withdraw_form');
							echo form_open('email/send', $attributes); 
							  $success=$this->session->flashdata("success");
							  $error=$this->session->flashdata("error");
							   if($success!=""){
						  ?>
                          <div class="alert alert-success alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <div class="success"> <?php echo $success ?></div>
                          </div>
                          <?php } ?>
                          
                          <p style="text-align:center; font-size: 16px;"> You have <b> <?php echo $balance ?> <?php echo $select_currency ?></b> available for withdrawal.</p> 
						  
						<h4 hidden class="dbord_text3 text-center">
						<?php 
						if($kyc_status == "Verified"){							
						//print_r($get_usd_amount->result()); die();
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
						  <div class="alert alert-success alert-dismissible" style="display:none"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <div class="success_msg"></div>
                          </div>
                          <div class="form-group">
                            <label for="">Select your Currency :</label>
                            
                              <select name="currency" class="form-control" id="withdraw_select">
                                <?php  
									$is_maintain = "";
                                    foreach($all_currency->result() as $crow) {
                                ?>
                                        <option <?php if($select_currency==$crow->currency_symbol){?>selected="selected" <?php } ?>    value="<?php echo $crow->currency_symbol ?>"><?php echo  $crow->currency_name ?> - <?php echo $crow->currency_symbol ?></option>
                                <?php
									if($select_currency==$crow->currency_symbol)
										$is_maintain = $crow->in_maintenance;
                                    //print_r($crow->id);
                                    }
                                ?>
                              </select>
                          </div>
                          <?php
							if($is_maintain != 0) // 1 is not maintenance
							{ ?>
						  <div class="withdraw_all">
							  <div class="form-group">
								<label for=""> <?php echo $select_currency ?> Wallet Address <span class="red">*</span></label>
								<input type="text"  class="form-control"  value="" name="address"/>
							  </div>
			
							  <?php
			
							  if($select_currency=="XRP"){?>
			
							  <div class="form-group">
								<label for=""> <?php echo $select_currency ?> Tag value <span class="red"></span></label>
								<input type="text" data-rule-required="false"  class="form-control"  id= "xrp_tag" value="" name="xrp_tag"/>
							  </div>
							  <?php  } ?>
								<?php
			
							  if($select_currency=="XMR"){?>
			
							  <div class="form-group">
								<label for="">  Payment Id <span class="red"></span></label>
								<input type="text" data-rule-required="false"  class="form-control"  id= "payment_id" value="" name="payment_id"/>
							  </div>
							  <?php  } ?>        
							  <div class="form-group">
								<label for="">Amount of <?php echo $select_currency ?> to wallet <span class="red">*</span></label>
								<span hidden style="float: right;">1 <?php echo $select_currency ?> = <?php echo $usd_price ?> USD</span> 
								<input type="text"  class="form-control"  value="" name="withdraw_amount" id="withdraw_amount"/>
							  </div>
							  <div class="form-group" hidden>
								<label for="">USD Price</label>
								<input type="text"  class="form-control"  value="" name="usd_amount" id="usd_amount"/>
							  </div>
							  <!-- <div class="form-group">
								<label for="">Description <span class="red"></span> </label>
								<input type="text" class="form-control"  name="desc" value="" style="height:60px;"></input>
							  </div> -->
							  <div class="form-group">
								<label for="" style="width: 30%;">Transaction Fee : <b><?php echo $withdraw_fee ?></b> </label>
								<label for="" style="width: 69%; text-align: right;">You Will Get : <strong><input name="total_amt" type="hidden" value="" id="total_amt1" /><span id="total_amt">0.00000000 <?php echo $select_currency ?></span></strong> </label>
							  </div>
							  
							  <button class="ena_btn btn btn-primary mx-auto mt-3 d-table">WITHDRAW</button>                                                    
						  </div>
						  <?php } else { ?>
						  <div class="suspend mt-3">
							Deposit and Withdrawal for <b><?php echo $select_currency; ?></b> will be suspended during the mainnet swap and will open again once we deem the mainnet to be stable.
						  </div>
						  <?php } echo form_close(); ?>
						</div>                    
					
						<div class="note mt-3">
							<p>Please note</p>
							<li>Once you have submitted your withdrawal request, we will send a confirmation email.</br> Please then click on the confirmation link in your email.</li>
							<li>After making a deposit, you can track its progress on the <a href="<?php echo base_url()?>transation/history/withdraw"> history</a> page.</li>
						</div>
                    </div>
        
          <div class="login_box clearfix" id="tfa" style="width:70% !important; display:none">
          
            <div class="login100-form-title" style="background-image: url(assets/frontend/images/bg-01.jpg);">
              <span class="login100-form-title-1">TWo factor authendication</span>
            </div>
            <div class="login_frm">
              <form id="tfa_verify_form" action="" >
                <div class="form-group">
                  <span class="auth-text">For security reason need to verify two factory authendication, Please enter your google six digit authendication code</span>
                  <input type="text" class="form-control" id="tfa_code" value=""  name="tfa_code" placeholder="Enter 2FA code"/>
                </div> 
              <div class="clearfix"></div>
              <div class="box_list">
                <div class="login_btn1">
                   <button class="btn btn_sub center-block" id="withdraw_tfa_button">Validate</button>
                </div>
              
              </div>
              </form>
            </div>
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
				<span class="forg_txt"><a href="<?php echo base_url()?>transation/history/withdraw">View All</a></span>
			</div>
			
		</div>
      </div>  

    </div>
  </div>
  </div>
</section>

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

</script> 
