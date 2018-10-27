<header class="main-header">
  <div class="tp_layer1"> <a href="#" class="logo">
    <!-- Logo -->
    <span class="logo-mini">
    <!--<b>A</b>H-admin-->
    <img src="<?php echo base_url(); ?>admin_assets/images/tp_logo.png" alt=""> 
    </span> <span class="logo-lg">
    <b><img src="<?php echo getSiteLogo() ?>" ></b>
    <?php /* <img src="<?php echo base_url(); ?>admin_assets/images/tp_logo.png" alt=""> */ ?> </span> </a> <a href="#" class="sidebar-toggle hidden-norm" data-toggle="offcanvas" role="button"> <span class="fa fa-bars hdt_cnt">Dashboard</span> </a> </div>


    <input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
    
    <input type="hidden" id="admin_url" name="admin_url" value="<?php echo wallet_url(); ?>">


    <img src="<?php echo base_url(); ?>uploads/pre_loader.gif" id="page_laoder" style="display: none;"> 

  <!-- Header Navbar -->
  <nav class="navbar navbar-static-top">
    <div class="mn_righ">
      <div class="mn_rightp fd_rw">
        <div class="tp_sear1">
          
        </div>
        <div class="navbar-custom-menu">
          <ul class="nav navbar-right">           
            
            <li class="dropdown dropdown-user"> <a href="#" class="dropdown-toggle" data-toggle="dropdown">

              <div class="user-image">
                <span class="hidden-xs">Hi admin</span> 
                <img src="<?php echo base_url(); ?>admin_assets/images/mn_imusr.png" class="img-responsive" alt="User">
              </div>
              </a>

              <ul class="dropdown-menu usr_drpmn">
                <li class="user-footer text-center"> <a href="<?php echo wallet_url()."Authentication/logout"; ?>" class="btn btn-flat center-block">Logout</a> </li>

              </ul>
            </li>           
          </ul>
        </div>
      </div>
    </div>
  </nav>
</header>


