<?php $this->load->view('front/basic/header.php');?>
<?php $this->load->view('front/basic/outer_header.php');?>

<section class="inner_banner">

	<div class="container-login100">
		<div class="alert alert-denger" style="display:none">
			<div id="error-msg"></div>
		</div>
		<div class="alert alert-success" style="display:none">
			<button class="close" type="button" data-dismiss="alert">×</button>
			<div class="success"></div>
		</div>
		<div class="login_box clearfix" id="login_div">
			<div class="alert alert-denger" style="display:none" id="errormsg">
				<!-- <button class="close" type="button" data-dismiss="alert">×</button>-->
				<div id="error-msg" class="errormsg"></div>
			</div>

			<div class="alert alert-success" style="display:none">
				<button class="close" type="button" data-dismiss="alert">×</button>
				<div class="success"></div>
			</div>

			<div class="login100-form-title" style="background-image: url(assets/frontend/images/bg-01.jpg);">
				<span class="login100-form-title-1">login</span>
			</div>
			<div class="login_frm buy_main mt-4">
				<form class="form_list" id="login_form" >            
					<div class="form-group">
						<label>Username/ Email Id</label>
						<input type="text" class="form-control" name="username" placeholder="Enter username">
					</div>
					<div class="form-group">
						<label>Password</label>
						<input type="password" class="form-control" name="password" placeholder="Enter password">
					</div>

					<div class="toggle-button robot">
						<label id="captcha-error" class="error" for="captcha" style="display: inline-block;"></label>
						 <div class="g-recaptcha" data-callback="recaptchaCallback"  data-sitekey="6Lc2NG8UAAAAAGYBWICrLg7-8Tv5mMiIx8aAXwrZ" required >
                            </div>
                            <p id="recaptcha"></p>

                            <input id="toggleButton5" type="hideen" name="captcha_check">
						<!--<input id="toggleButton5" type="checkbox" name="captcha_check">
						<label for="toggleButton5" data-on-text="Verified"  data-off-text="i am not robot"></label>
						<div class="toggle-button__icon"></div>-->
					</div>

					<label id="robot-error" class="error"  style="display:none"></label>
					<!--<div class="form-group row captcha_box captcha_div logCaptcha" style="display:none">
						<label id="captcha" class="col-lg-3 p-0 captcha_no"><img id="login_cap_img" src="<?php echo base_url()?>home/login_captcha" style="padding: 10px;"></label>
						<div class="col-lg-6 pad-lft">
							<div class="captcha">
								<input type="text" class="form-control" name="captcha">
								<label id="captcha-error" class="error" for="captcha" style="display: inline-block;"></label>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="refresh_style" id="login_capcha">
								<i class="fa fa-refresh"></i>
							</div>
						</div>
					</div>-->

					<div class="clearfix"></div>
					<div class="box_list">
						<div class="login_btn">
							<button class="btn btn_sub" name="login" id="login_button">Submit</button>
						</div>
						<div class="forg_txt">
							<p><a href="<?php  echo base_url() ?>home/forgot_password" >forgot password ?</a></p>
						</div>
					</div>
				</form>
			</div>
		</div>

        <div class="login_box clearfix" id="tfa_div" style="display:none">
 
			<div class="login100-form-title" style="background-image: url(assets/frontend/images/bg-01.jpg);">
				<span class="login100-form-title-1">Two factor authendication</span>
			</div>
			<div class="login_frm buy_main mt-4">
              <form class="form_list" id="tfa_form" >
                  <div class="form-group">
                      <span class="auth-text">You have two factor authendication enabled, Please enter your google six digit authendication code</span>
                      <input type="text" class="form-control" name="tfa_code" placeholder="Enter 2FA code">
                  </div>              
    
                <div class="clearfix"></div>
                <div class="box_list">
                    <div class="login_btn1">
                         <button class="btn btn_sub center-block" id="tfa_button">Validate</button>
                    </div>
                </div>
              </form>
			</div>
		</div>

        <div class="login_box clearfix" id="email_div" style="display:none">
  
          <div class="login100-form-title" style="background-image: url(assets/frontend/images/bg-01.jpg);">
			<span class="login100-form-title-1">Login email verification</span>
          </div>
          <div class="login_frm buy_main mt-4">
              <form class="form_list" id="email_form" >
                  <div class="form-group">
                      <span class="auth-text">You have not enabled Two factor authentication. So, for security reason we have sent OTP to your email address. Please enter the six digit OTP code here,</span>
                     <input type="text" class="form-control" name="email_code" placeholder="Enter email verification code">
                  </div>              

                <div class="clearfix"></div>
                <div class="box_list">
                    <div class="login_btn1">
                         <button class="btn btn_sub" id="email_button">Validate</button>
                    </div>
                </div>
              </form>
          </div>
      </div>
      <div class="rember_pwd">
          <p>Dont have an account? <a href="<?php  echo base_url() ?>home/register">Register now !</a></p>
      </div>
	</div>
</section>
<style>
.fixed-top {
    background: #1C3049;
}
</style>
<script type="text/javascript" language="javascript">

function recaptchaCallback() {

	var captcha_response = grecaptcha.getResponse();

	captcha_response = captcha_response.length;

	$("#toggleButton5").val(captcha_response);


}
</script>
<?php $this->load->view('front/basic/footer');?>