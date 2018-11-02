<?php $this->load->view('front/basic/header.php');?>
<?php $this->load->view('front/basic/outer_header.php');?>

<section class="inner_banner">
  <div class="container-login100">
      <div class="logo_inner">
		<div class="login_box fgt_box clearfix">

            <div class="alert alert-success" style="display:none">
				<button class="close" type="button" data-dismiss="alert">×</button>
				<div class="success"></div>
			</div>
			
			<div class="alert alert-denger" style="display:none">
				<button class="close" type="button" data-dismiss="alert">×</button>
				<div class="error"></div>
			</div>

			<div class="login100-form-title" style="background-image: url(assets/frontend/images/bg-01.jpg);">
				<span class="login100-form-title-1">Forgot password</span>
			</div>
			  <div class="login_frm buy_main mt-4">
				  <form class="form_list" id="forgot_form" >
					<div class="form-group">
						<label>Username / Email ID </label>
						<input type="text" class="form-control" name="username" placeholder="Enter username">
					</div>

					<!--<div class="toggle-button toggle-button--vesi robot">
						<input id="toggleButton5" type="checkbox" name="captcha_check">
						<label for="toggleButton5" data-on-text="Verified"  data-off-text="i am not robot"></label>
						<div class="toggle-button__icon"></div>
					</div>-->
					<div class="toggle-button  robot">
						<label id="captcha-error" class="error" for="captcha" style="display: inline-block;"></label>
						 <div class="g-recaptcha" data-callback="recaptchaCallback"  data-sitekey="6Lc2NG8UAAAAAGYBWICrLg7-8Tv5mMiIx8aAXwrZ" required >
                            </div>
                            <p id="recaptcha"></p>

                            <input id="toggleButton5" type="hideen" name="captcha_check">
					</div>

					<label id="robot-error" class="error"  style="display:none"></label>
					<!--<div class="form-group row captcha_box captcha_div fgtCaptcha" style="display:none">
						  <label id="captcha-error" class="col-lg-3 p-0 captcha_no"><img id="forgot_cap_img" src="<?php echo base_url()?>home/captcha" style="padding: 10px;"></label>
						  <div class="col-lg-6">
							<div class="captcha">
							  <input type="text" class="form-control" name="captcha" id="captcha">
							  <label id="captcha-error" class="error" for="captcha" style="display: inline-block;"></label>
							</div>
						  </div>

						  <div class="col-lg-3">
							<div class="refresh_style" id="forgot_capcha">
							  <i class="fa fa-refresh"></i>
							</div>
						  </div>
					</div>-->

					<div class="box_list">
						<div class="login_btn">
							<button class="btn btn_sub" id="forgot_button">submit</button>
						</div>

						<div class="rember_pwd fgt_login">
							<p> <a href="<?php  echo base_url() ?>home/login"> Go to Login >></a></p>
						</div>
					</div>
				  </form>
			  </div>
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