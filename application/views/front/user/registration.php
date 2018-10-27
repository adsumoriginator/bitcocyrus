<?php $this->load->view('front/basic/header.php');?>
<?php $this->load->view('front/basic/outer_header.php');?>
<section class="inner_banner">
  <div class="container-login100">
	  <?php
		$error=$this->session->flashdata("error");
		if($error!=""){
	  ?>
      <div class="alert alert-denger fade in">
		<?php echo $error ?>
      </div>
	  <?php } ?>

      <div class="alert alert-success" style="display:none">
        <button class="close" type="button" data-dismiss="alert">×</button>
        <div class="success"></div>
      </div>
	  <div class="alert alert-denger ajax_error" style="display:none"></div>
     
      <div class="login_box clearfix reg_class">
          <div class="login100-form-title" style="background-image: url(assets/frontend/images/bg-01.jpg);">
			<span class="login100-form-title-1">REGISTER NOW !</span>
          </div>
          <div class="login_frm buy_main mt-4">
              <form class="form_list" id="register" method="post" action="<?php echo base_url()?>home/generate_otp">
                  <div class="form-group">
                      <label>Username *</label>
                      <input type="text" id="username" class="form-control"  name="username" placeholder="Enter username">
                  </div>
                  <div class="form-group">
                    <label>Email ID* </label>
                    <input type="text" class="form-control" name="email"  id="email" placeholder="Enter email id">
                </div>

                  <div class="form-group">
                    <label>Reference ID</label>
                    <input type="text" class="form-control" name="refer_id" id="refer_id" placeholder="Enter reference id" value="<?php echo $this->uri->segment(3); ?>">
                </div>

                 <div class="form-group">
                    <label>Mobile Number*</label>
                    <input type="text" class="form-control" name="phone_number" placeholder="Enter mobile number" id="phone_number">
                </div>

                <div class="form-group">
                  <label>Password*</label>
                  <input type="password" class="form-control" name="password" placeholder="Enter password" id="password" >
              </div>
              <div class="form-group">
                  <label>Confirm Password*</label>
                  <input type="password" class="form-control" name="confirm" placeholder="Enter confirm password" >
              </div>

			  <div class="form-check">
				<input type="checkbox" name="terms" class="form-check-input" id="exampleCheck1">
				<label class="form-check-label" for="exampleCheck1">I accepts the <a href="<?php echo base_url() ?>cms/terms">Terms & Conditions</a></label>
			    <label id="terms-error" class="error" for="terms" style="display:none"></label>
			  </div>
  
			  <div class="toggle-button toggle-button--vesi robot">
                <input id="toggleButton5" type="checkbox" name="captcha_check">
                <label for="toggleButton5" data-on-text="Verified"  data-off-text="i am not robot"></label>
                <div class="toggle-button__icon"></div>
                <label id="robot-error" class="error"  style="display:none"></label>
              </div>
			  <label id="captcha_check-error" class="error"  style="display:none"></label>
              <div class="form-group row captcha_box reg_captcha captcha_div captcha_list regCaptcha" style="display:none">
				<label  class="col-lg-3 p-0 captcha_no">
                <img src="<?php echo base_url() ?>home/captcha" id="register_cap_img" style="padding: 10px;"></label>
                <div class="col-lg-6 pad-lft">
					<div class="captcha">
						<input type="text" class="form-control" name="captcha"  id="captcha"/>
						<label style="display:none;" id="captcha-error" class="error" for="captcha">Please enter captcha</label>
					</div>
				</div>
				<div class="form-group">
					<div class="col-lg-3">
						<div class="refresh_style" id="register_capcha">
						  <i class="fa fa-refresh"></i>
						</div>
					</div>
                </div>
			  </div>
              <div class="clearfix"></div>
              <div class="box_list">
				<div class="login_btn1">
					<button class="btn btn_sub mx-auto mt-2 mb-2 d-table" id="register_button">submit</button>
				</div>
			  </div>
              </form>
          </div>
      </div>

	  <div class="rember_pwd reg_class">
		  <p>Already have a account? <a href="<?php  echo base_url() ?>home/login">Login now !</a></p>
		  </div>
	  </div>



<div class="login_box clearfix" id="otp_div" style="display:none">
  
          <div class="login100-form-title" style="background-image: url(assets/frontend/images/bg-01.jpg);">
              <span class="login100-form-title-1">Email OTP verification</span>
          </div>
          <div class="login_frm buy_main mt-4">
              <form class="form_list" id="otp_form" method="post" action="<?php echo base_url()?>home/otp_validate">
                  <div class="form-group">
                      <span class="auth-text">We have send email verification OTP to your email address, Please enter your OTP.</span>
                     <input type="text" class="form-control" id="tfa_code" value=""  name="otp" placeholder="Enter email verification code">
                  </div>
               
                <div class="clearfix"></div>
                <div class="box_list">
                    <div class="login_btn1">
                         <button class="btn btn_sub center-block" id="otp_button">Validate</button>
                    </div>
              
                </div>
              </form>
          </div>
      </div>




<!--

<div id="otp_div" class="modal fade" role="dialog">
  <div class="modal-dialog">

 
    <div class="modal-content">
      <div class="modal-header">
      <h3>      OTP validate</h3>
            <button type="button" class="close" data-dismiss="modal">&times;</button>

      </div>
      <div class="modal-body">
        <div class="form-group">
                <form class="form_list" id="otp_form" method="post" action="<?php echo base_url()?>home/otp_validate">

                 <div class="alert alert-denger otp_alert" style="display:none">
       <button class="close" type="button" data-dismiss="alert">×</button>
        <div class="otp_error"></div>
    </div>
                      <label>OTP send to your email address</label>
                      <input type="text" class="form-control" name="otp">
                  </div>
                <div class="login_btn">
                        <button class="btn btn_sub" id="otp_button">Validate</button>
                    </div>

                </form>    

      </div>
      
    </div>

  </div>
</div>-->


</section>
<style>
.fixed-top {
    background: #1C3049;
}
</style>
<?php $this->load->view('front/basic/footer');?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/additional-methods.js" ></script>