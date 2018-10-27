<?php $this->load->view('front/basic/header');?>
<?php $this->load->view('front/basic/outer_header');?>
<section class="inner_banner">
  <div class="container-login100">
    <div class="alert alert-success" style="display:none">
       <button class="close" type="button" data-dismiss="alert">×</button>
        <div class="success"></div>
    </div>

     <div class="alert alert-denger" style="display:none">
       <button class="close" type="button" data-dismiss="alert">×</button>
        <div class="error"></div>
     </div>
      <div class="login_box clearfix">
          <div class="login100-form-title" style="background-image: url(assets/frontend/images/bg-01.jpg);">
			<span class="login100-form-title-1">Reset Your password</span>
          </div>
          <div class="login_frm buy_main mt-4">
              <form class="form_list" id="reset_form" method="post" action="">
                  <div class="form-group"  >
                      <label>New Password</label>
                      <input type="password" id="password" class="form-control" name="password" placeholder="Enter your password">
                  </div>
                  <div class="form-group">
                    <label>Re-Type New Password</label>
                    <input type="password" class="form-control" name="confirm" placeholder="Enter confirm password">

            
                </div>

                <div class="box_list">
                    <div class="login_btn1">
                        <button class="btn btn_sub mx-auto mt-2 mb-2 d-table reset_b" name="submit" id="reset_pass" value="submit">submit</button>
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
<?php $this->load->view('front/basic/footer');?>
