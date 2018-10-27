<?php 
  $getAdminUserInfo           = $this->CommonModel->getLoggedInAdminDetails();


  $siteConfig                 = $this->CommonModel->getSiteConfigInfo();
?>
<header class="main-header">
  <div class="tp_layer1"> 
    <a href="<?php echo base_url()."BoDashboard"; ?>" class="logo">
      <!-- Logo -->
      <span class="logo-mini">
      <!--<b>A</b>H-admin-->
      <img src="<?php echo base_url(); ?>assets/admin/images/tp_logo.png" alt=""> 
      </span> <span class="logo-lg">
      <b><?php echo $siteConfig['0']->site_name; ?></b>
      <?php /* <img src="<?php echo base_url(); ?>assets/admin/images/tp_logo.png" alt=""> */ ?> </span> 
    </a> 
    <a href="#" class="sidebar-toggle hidden-norm" data-toggle="offcanvas" role="button"> 
      <span class="fa fa-bars hdt_cnt">Dashboard</span> 
    </a> 
  </div>


    <input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
  <!-- Header Navbar -->
  <nav class="navbar navbar-static-top">
    <div class="mn_righ">
      <div class="mn_rightp fd_rw">
        <div class="tp_sear1">
         
        </div>
        <div class="navbar-custom-menu">
          <ul class="nav navbar-right">
                  
            <!-- user -->
            <li class="dropdown dropdown-user"> <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <div class="user-image"><span class="hidden-xs">Hi, <?php echo $getAdminUserInfo['0']->admin_name ?></span> 
			  <img src="<?php echo base_url(); ?>assets/admin/images/mn_imusr.png" class="img-responsive" alt="User"> </div>
              </a>
              <ul class="dropdown-menu usr_drpmn">
                <!-- User image -->
                <li class="user-header">
                  <div class="usr_mask">
                    <p class="adminName"> <?php echo $getAdminUserInfo['0']->adminFirstName." ".$getAdminUserInfo['0']->adminLastName; ?></p>
                  </div>
          
                  <?php
                 

                    $companylogo = $getAdminUserInfo['0']->profile_pic;
                    if(isset($companylogo) && !empty($companylogo)) {
                      $imageChecking = "uploads/siteLogo/$companylogo"; 
                      if(file_exists($imageChecking)) { ?>
                    <img id="images_display" class="profile-pic imgAlign img-responsive" src="<?php echo base_url();?>uploads/siteLogo/<?php echo $companylogo;?>" class="img-responsive center-block">
                  <?php } else {   ?> 
                    <img class="profile-pic imgAlign img-responsive" src="<?php echo base_url();?>uploads/no_image.png">
                  <?php } } else { ?>
                    <img class="profile-pic imgAlign img-responsive" src="<?php echo base_url();?>uploads/no_image.png">
                  <?php } ?>
                </li>
                <!-- Menu Body -->
                <!-- assign active class start here -->
                <?php 
                if($this->uri->segment(1) == "BoChangePassword") {
                  $assignActivepwd = "active";
                }
                else {
                  $assignActivepwd = "";
                }
                if($this->uri->segment(1) == "BoSettings") {
                  $assignActivesettings = "active";
                }
                else {
                  $assignActivesettings = "";
                }                
                ?>
                <!-- assign active class end here -->
                <li class="user-body">
                  <div class="">
                    <div class="col-xs-12"> 
                      <a href="<?php echo base_url()."BoChangePassword"; ?>" class="<?php echo $assignActivepwd; ?>">Change password </a> 
                    </div>
                    <div class="col-xs-12"> 
                    <?php

                      $admin_id=$this->session->userdata("loggedJTEAdminUserID");

                      //if($admin_id==1){ ?>
                      <a href="<?php echo base_url()."BoSettings"; ?>" class="<?php echo $assignActivesettings; ?>">Settings</a> 

                      <?php
                   // }
                      ?>
                    </div>
                  </div>
                  <!-- /.row -->
                </li>
                <!-- Menu Footer-->
                <li class="user-footer text-center"> <a href="<?php echo base_url()."YfQa6hmtE8a3G2Z6Ssuf/logout"; ?>" class="btn btn-flat center-block">Logout</a> </li>
              </ul>
            </li>
            <!-- <li class="dropdown noti_dric"> <a data-toggle="dropdown" class="dropdown-toggle drop_icocn"><span class="mn_ico1"><img src="<?php echo base_url(); ?>assets/admin/images/mn_noti1.png"> </span></a>
              <div class="dropdown-menu anti_dropdown setting_drp">
                <div class="table-responsive">
                  <table class="table">
                    <tr>
                      <td width="92%">New Users</td>
                      <td width="8%"><input type="checkbox" name="check-1" value="4" class="lcs_check" autocomplete="On" /></td>
                    </tr>
                    <tr>
                      <td>New Messages</td>
                      <td><input type="checkbox" name="check-1" value="4" class="lcs_check" autocomplete="On" /></td>
                    </tr>
                    <tr>
                      <td>Pending KYC</td>
                      <td><input type="checkbox" name="check-1" value="4" class="lcs_check" autocomplete="On" /></td>
                    </tr>
                    <tr>
                      <td>Pending Withdraw</td>
                      <td><input type="checkbox" name="check-1" value="4" class="lcs_check" autocomplete="On" /></td>
                    </tr>
                    <tr>
                      <td>Total Users</td>
                      <td><input type="checkbox" name="check-1" value="4" class="lcs_check" autocomplete="Off" /></td>
                    </tr>
                    <tr>
                      <td>Support Ticket</td>
                      <td><input type="checkbox" name="check-1" value="4" class="lcs_check" autocomplete="Off" /></td>
                    </tr>
                    <tr>
                      <td>Users and Fees</td>
                      <td><input type="checkbox" name="check-1" value="4" class="lcs_check" autocomplete="On" /></td>
                    </tr>
                    <tr>
                      <td>Chat</td>
                      <td><input type="checkbox" name="check-1" value="4" class="lcs_check" autocomplete="On" /></td>
                    </tr>
                    <tr>
                      <td>Users From</td>
                      <td><input type="checkbox" name="check-1" value="4" class="lcs_check" autocomplete="On" /></td>
                    </tr>
                    <tr>
                      <td>Total Deposit and Withdraw</td>
                      <td><input type="checkbox" name="check-1" value="4" class="lcs_check" autocomplete="On" /></td>
                    </tr>
                    <tr>
                      <td>Alert / Information</td>
                      <td><input type="checkbox" name="check-1" value="4" class="lcs_check" autocomplete="On" /></td>
                    </tr>
                    <tr>
                      <td>Calendar</td>
                      <td><input type="checkbox" name="check-1" value="4" class="lcs_check" autocomplete="On" /></td>
                    </tr>
                    <tr>
                      <td>Fees</td>
                      <td><input type="checkbox" name="check-1" value="4" class="lcs_check" autocomplete="On" /></td>
                    </tr>
                  </table>
                </div>
              </div>
            </li> -->
          </ul>
        </div>
      </div>
    </div>
  </nav>
</header>