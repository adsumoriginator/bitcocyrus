<aside class="main-sidebar">
    <div class="sidebar">
      <!-- sidebar menu -->
      <ul class="sidebar-menu" id="accord_side">
      
       
        <li class="<?php if($this->uri->segment(2) == "BoDashboard"){ echo 'active'; } ?>"> 
            <a href="<?php echo wallet_url()."BoDashboard"; ?>" class="mn_catgcur"><span>Dashboard</span> </a> 
        </li>
        
        <li class="<?php if($this->uri->segment(2) == "BoChangePassword"){ echo 'active'; } ?>"> 
            <a href="<?php echo wallet_url()."BoChangePassword"; ?>" class="mn_catgcur">
                <span>Change password</span>
            </a>
        </li>         

         <li class="<?php if($this->uri->segment(2) == "BoChangePassword"){ echo 'active'; } ?>"> 
            <a href="<?php echo wallet_url()."BoAdminWalletDeposit/deposit/BTC"; ?>" class="mn_catgcur">
                <span>Admin Deposit</span>
            </a>
        </li>  

  <!--  <li> 
        <a class="<?php if($this->uri->segment(2) == "BoAdminWalletDeposit"){ echo 'mn_sib collapsed'; } ?>" data-toggle="collapse" data-parent="#accord_side" href="#sid_mn_settings" aria-expanded="false"> <span>Admin Deposit</span></a>
        <ul id="sid_mn_settings" class="mnsub_catglis collapse <?php if($this->uri->segment(1) == "BoSettings"){ echo 'in'; } ?>" aria-expanded="true" style=""> 
        <li> <a href="<?php echo wallet_url()."BoAdminWalletDeposit/deposit/BTC"; ?>" class="mnsub_catg <?php if($this->uri->segment(4) == "BTC") { echo 'active'; } ?>">BTC</a> </li> 
        <li> <a href="<?php echo wallet_url()."BoAdminWalletDeposit/deposit/ETH"; ?>" class="mnsub_catg <?php if($this->uri->segment(4) == "ETH") { echo 'active'; } ?>">ETH</a> </li>

          <li> <a href="<?php echo wallet_url()."BoAdminWalletDeposit/deposit/BCH"; ?>" class="mnsub_catg <?php if($this->uri->segment(4) == "BCH") { echo 'active'; } ?>">BCH</a> </li>

           <li> <a href="<?php echo wallet_url()."BoAdminWalletDeposit/deposit/USDT"; ?>" class="mnsub_catg <?php if($this->uri->segment(4) == "USDT") { echo 'active'; } ?>">USDT</a> </li>
                    <li> <a href="<?php echo wallet_url()."BoAdminWalletDeposit/deposit/LTC"; ?>" class="mnsub_catg <?php if($this->uri->segment(4) == "LTC") { echo 'active'; } ?>">LTC</a> </li>

           <li> <a href="<?php echo wallet_url()."BoAdminWalletDeposit/deposit/BTG"; ?>" class="mnsub_catg <?php if($this->uri->segment(4) == "BTG") { echo 'active'; } ?>">BTG</a> </li>
           <li> <a href="<?php echo wallet_url()."BoAdminWalletDeposit/deposit/XRP"; ?>" class="mnsub_catg <?php if($this->uri->segment(4) == "XRP") { echo 'active'; } ?>">XRP</a> </li>
            <li> <a href="<?php echo wallet_url()."BoAdminWalletDeposit/deposit/DASH"; ?>" class="mnsub_catg <?php if($this->uri->segment(4) == "DASH") { echo 'active'; } ?>">DASH</a> </li>
            <li> <a href="<?php echo wallet_url()."BoAdminWalletDeposit/deposit/XMR"; ?>" class="mnsub_catg <?php if($this->uri->segment(4) == "XMR") { echo 'active'; } ?>">XMR</a> </li>
            <li> <a href="<?php echo wallet_url()."BoAdminWalletDeposit/deposit/ETC"; ?>" class="mnsub_catg <?php if($this->uri->segment(4) == "ETC") { echo 'active'; } ?>">ETC</a> </li>
             <li> <a href="<?php echo wallet_url()."BoAdminWalletDeposit/deposit/DGB"; ?>" class="mnsub_catg <?php if($this->uri->segment(4) == "DGB") { echo 'active'; } ?>">DGB</a> </li>


  <li> <a href="<?php echo wallet_url()."BoAdminWalletDeposit/deposit/TRX"; ?>" class="mnsub_catg <?php if($this->uri->segment(4) == "TRX") { echo 'active'; } ?>">TRX</a> </li>

  <li> <a href="<?php echo wallet_url()."BoAdminWalletDeposit/deposit/EOS"; ?>" class="mnsub_catg <?php if($this->uri->segment(4) == "EOS") { echo 'active'; } ?>">EOS</a> </li>


        </ul> 
    </li>  -->    
        <li> 
        <a class="<?php if($this->uri->segment(2) == "Bowithdraw"){ echo 'mn_sib collapsed'; } ?>" data-toggle="collapse" data-parent="#accord_side" href="#sid_mn_settings1" aria-expanded="false"> <span>Manage Withdrawals</span></a>
        <ul id="sid_mn_settings1" class="mnsub_catglis collapse <?php if($this->uri->segment(1) == "BoSettings"){ echo 'in'; } ?>" aria-expanded="true" style=""> 
        <li> <a href="<?php echo wallet_url()."Bowithdraw"; ?>" class="mnsub_catg">withdraw Request</a> </li> 
        <li> <a href="<?php echo wallet_url()."Bowithdraw/withdrawlist"; ?>" class="mnsub_catg <?php if($this->uri->segment(3) == "withdrawlist") { echo 'active'; } ?>">Withdraw History </a> </li> 
        </ul> 
    </li>   

        
                      
      </ul>
    </div>
</aside>