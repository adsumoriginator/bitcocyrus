<?php $this->load->view('front/basic/header'); ?>
<?php $this->load->view('front/basic/outer_header'); ?>


<section class="con_banner">
  <div class="container">
      <!-- <div class="logo_inner">
         <a href="<?php echo base_url() ?>"> <img src="assets/frontend/images/logo.png" class="img-fluid"></a>
      </div>  -->
      
      <div class="col-lg-12 m-auto">
      
      <div class="row">
      
         <div class="col-lg-12">
      
      <div class="con_box support_bg clearfix">
          <div class="con_head">
              <h4>Support</h4>
          </div>
          <div class="login_frm">

           <div class="success_msg" id="cnt_success" style="display:none; color: #fff !important;"></div>

           <div class="error" id="cnt_error" style="display:none; color: #fff !important;"></div>
           
          <?php
            $atrtibute = array('role'=>'form','name'=>'support','id'=>'support','method'=>'post','class'=>'form_list support_form');
            echo form_open('contact',$atrtibute);
          ?>
              
                  <div class="form-group">
                      <label>Name<span> * </span></label>
                       <input class="form-control"  placeholder="Name" type="text"  name="name" id="name" value="">
                      
                  </div>
                  <div class="form-group">
                    <label>Email ID <span> * </span></label>
                     <input   class="form-control"  placeholder="Email" type="text" name="email" id="email" value="" >                    
                </div>
                <div class="form-group">
                  <label>Subject<span> * </span></label>
                  <input class="form-control" placeholder="Subject" type="text" name="subject" id="subject">                  
              </div>

              <div class="form-group">
                  <label>Category<span> * </span></label>
                  <select name="category" class="form-control">
                  <?php 

                    foreach($support_category->result() as $row){
                       ?>
                       <option value="<?php echo $row->category_name ?>" ><?php echo $row->category_name ?> </option>
                  <?php
                    }

                    ?>

                  </select>           
              </div>



              <div class="form-group">
                  <label>Messages<span> * </span></label>
                   <textarea class="form-control" placeholder="Message" style="height:70px;" name="message" id="message"></textarea>
              </div>


            <div class="toggle-button toggle-button--vesi robot">
                <input id="toggleButton5" type="checkbox" name="captcha_check">
                <label for="toggleButton5" data-on-text="Verified"  data-off-text="i am not robot"></label>
                <div class="toggle-button__icon"></div>


                
            </div>

            <label id="robot-error" class="error"  style="display:none"></label>
                 <div class="form-group row captcha_box captcha_div" style="display:none">
 
             
                  <label class="col-lg-3 p-0 captcha_no"><img id="support_cap_img"src="<?php echo base_url(); ?>cnt_captcha"> <span class="captcha_equal">=</span> </label>
                      <div class="col-lg-6">
					  <div class="captcha">
                          <input type="text" class="form-control" value ="" name="captcha" id="captcha">
						  </div>
                      </div>

                        <div class="col-lg-3">
        <div class="refresh_style" id="support_cap">
          <i class="fa fa-refresh"></i>
        </div>
        </div>
              
                </div>

                <div class="clearfix"></div>
                <div class="box_list">
                    <div class="login_btn">
                        <button class="btn btn_sub" id="contact_btn" type="submit">Submit
                        </button>
                    </div>
                </div>

              </form>
          </div>
      </div>
      </div>
      
      
      
      </div>

</div>

  </div>
</section>

<?php $this->load->view('front/basic/footer'); ?>

<script>




</script>