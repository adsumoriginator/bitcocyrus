<?php $this->load->view('front/basic/header'); ?>

<?php $this->load->view('front/basic/outer_header'); ?>


<section class="con_banner">
  <div class="container-login100">
      <div class="col-lg-8 m-auto">
      
      <div class="row">
      
         <div class="col-lg-7">
      
      <div class="con_box clearfix">
          <div class="login100-form-title" style="background-image: url(assets/frontend/images/bg-01.jpg);">
              <span class="login100-form-title-1">Get In Touch Us</span>
          </div>
          <div class="login_frm buy_main mt-4">

           <div class="success_msg" id="cnt_success" style="display:none; color: #fff !important;"></div>

           <div class="error" id="cnt_error" style="display:none; color: #fff !important;"></div>
           
          <?php
            $atrtibute = array('role'=>'form','name'=>'contact_support','id'=>'contact_support','method'=>'post','class'=>'form_list');
            echo form_open('contact',$atrtibute);
          ?>
              
                  <div class="form-group">
                      <label>Name <span> * </span> </label>
                       <input class="form-control"  placeholder="Name" type="text" name="name" id="name">
                      
                  </div>
                  <div class="form-group">
                    <label>Email ID <span> * </span> </label>
                     <input class="form-control"  placeholder="Email" type="text" name="email" id="email">                    
                </div>
                <div class="form-group">
                  <label>Subject <span> * </span> </label>
                  <input class="form-control" placeholder="Subject" type="text" name="subject" id="subject">                  
              </div>
              <div class="form-group">
                  <label>Messages <span> * </span> </label>
                   <textarea class="form-control" placeholder="Message" rows="3" name="message" id="message"></textarea>
              </div>
                    <div class="toggle-button toggle-button--vesi robot">
                <input id="toggleButton5" type="checkbox" name="captcha_check">
                <label for="toggleButton5" data-on-text="Verified"  data-off-text="i am not robot"></label>
                <div class="toggle-button__icon"></div>


                
            </div>
            <label id="robot-error" class="error"  style="display:none"></label>

                <div class="form-group row captcha_box captcha_div contactCaptcha" style="display:none">
					<label class="col-lg-3 p-0 captcha_no"><img id="contact_cap_img" src="<?php echo base_url(); ?>cnt_captcha" style="padding: 10px;"></label>
                      <div class="col-lg-6">
                          <input type="text" class="form-control" value ="" name="captcha" id="captcha">
                      </div>
					<div class="col-lg-3">
						<div class="refresh_style" id="contact_cap">
						  <i class="fa fa-refresh"></i>
						</div>
					</div>
                </div>

                <div class="clearfix"></div>
                <div class="box_list">
                    <div class="login_btn1">
                        <button class="btn btn_sub mx-auto mt-2 mb-2 d-table" id="contact_btn" type="submit">Submit
                        </button>
                    </div>
                </div>

              </form>
          </div>
      </div>
      </div>
      
	  <?php $sitesettings = site_settings(); ?>
		  <div class="col-lg-5 mt-5">
		  <div class="con_rite">
			  <a href="https://bitcocyrus.freshdesk.com/"><h2 class="mt-4 mb-3"> <i class="fa fa-medkit start p-2"></i>Contact Support</h2></a>
			  <p>All Technical Support issues are handled though our support system.</p>
			  
			  <h2 class="mt-4 mb-2"> Stay in the loop</h2>
			  <p>Want to know what's happening with Bitcocyrus? Follow us here:</p>
			  
			  <ul class="social">
				<li><a target="_blank" title="Facebook" href="<?php echo $sitesettings->facebooklink; ?>"><i class="fa fa-facebook-official"></i></a></li>
				<li><a target="_blank" title="Twitter" href="<?php echo $sitesettings->twitterlink; ?>"><i class="fa fa-twitter"></i></a></li>
				<li><a target="_blank" title="Telegram" href="<?php echo $sitesettings->telegramlink; ?>"><i class="fa fa-telegram"></i></a></li>
				<li><a target="_blank" title="Medium" href="<?php echo $sitesettings->mediumlink; ?>"><i class="fa fa-medium"></i></a></li>
				<li><a target="_blank" title="Reddit" href="<?php echo $sitesettings->redditlink; ?>"><i class="fa fa-reddit-alien"></i></a></li>
				<li><a target="_blank" title="Youtube" href="<?php echo $sitesettings->youtubelink; ?>"><i class="fa fa-youtube"></i></a></li>
			  </ul>
		  </div>
      </div>
	</div>
  </div>
</section>

<?php $this->load->view('front/basic/footer'); ?>