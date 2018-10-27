<aside class="main-sidebar">
    <div class="sidebar">
      <!-- sidebar menu -->
      <ul class="sidebar-menu" id="accord_side">

    <?php


    $admin_id=$this->session->userdata("loggedJTEAdminUserID");


        $condition=array("admin_id"=>$admin_id);
 
;

    if($admin_id==1){


       $user_access=1;
       $tfa=1;
       $trade=1;
       $deposit_withdraw=1;
       $wallet=1;
       $subscriper=1;
       $support=1;
       $cms=1;
       $template=1;
       $currency=1;


    }else{

       $admindetals=$this->CommonModel->getTableData("sub_admin_permissions",$condition)->row();   

       $user_access=$admindetals->user_details;
       $tfa=$admindetals->tfa;
       $trade=$admindetals->trade;
       $deposit_withdraw=$admindetals->deposit_withdraw;
       $wallet=$admindetals->wallet;
       $subscriper=$admindetals->subscriper;
       $support=$admindetals->support;
       $cms=$admindetals->cms;
       $template=$admindetals->template;
       $currency=$admindetals->currency_details;
     

}

?>

      
        <!-- <li class="hidden-xs"> <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button"> <span class="fa fa-bars hdt_cnt">Dashboard</span> </a> </li> -->

   
        
        <li class="<?php if($this->uri->segment(1) == "BoDashboard"){ echo 'active'; } ?>"> 
            <a href="<?php echo base_url()."BoDashboard"; ?>" class="mn_catgcur"><span>Dashboard</span> </a> 
        </li>


<?php
    if($admin_id==1){
 ?>
            <li class="<?php if($this->uri->segment(1) == "subadmin"){ echo 'active'; } ?>"> 
            <a href="<?php echo base_url()."subadmin"; ?>" class="mn_catgcur"><span>Sub admin</span> </a> 
        </li>









 <?php

}

  
    if($user_access==1){
?>


  

              <li class="<?php if($this->uri->segment(2) == "view" || $this->uri->segment(2) == "editUser"  )    { echo 'active'; } ?>"> 
            <a href="<?php echo base_url()."BoUser/view"; ?>" class="mn_catgcur"><span>User details</span> </a> 
        </li>
	
		<!--
		 * KYC Request menu added
		 * @author Jatin
		 * @link http://adsumoriginator.com/
		 * -->
        <li class="<?php if($this->uri->segment(2) == "request_kyc" )    { echo 'active'; } ?>"> 
            <a href="<?php echo base_url()."BoUser/request_kyc"; ?>" class="mn_catgcur"><span>Reuest kyc details</span> </a> 
        </li>


           <?php       } 
       if($tfa==1){
            ?>



     <li class="<?php if($this->uri->segment(2) == "tfa"){ echo 'active'; } ?>"> 
            <a href="<?php echo base_url()."BoUser/tfa"; ?>" class="mn_catgcur"><span>TFA</span> </a> 
        </li>



    




   <?php
       }
       if($currency==1){
            ?>


    <li class="<?php if($this->uri->segment(2) == "view_coin" || $this->uri->segment(2) == "edit_coin"){ echo 'active'; } ?>"> 
            <a href="<?php echo base_url()."BoCoin_settings/view_coin"; ?>" class="mn_catgcur"><span>Currency Details</span> </a> 
        </li>


           <?php
        } if($trade==1){ 
            ?>


            <li class="<?php if($this->uri->segment(2) == "trade_pairs" || $this->uri->segment(2) == "fees_list" || $this->uri->segment(2) == "edit_trade_pair" || $this->uri->segment(2) == "edit_trade_fee" || $this->uri->segment(2) == "add_pair_fees"  ){ echo 'active'; } ?>"> 
            <a href="<?php echo base_url()."BoCoin_settings/trade_pairs"; ?>" class="mn_catgcur"><span>Trade pair and fee</span> </a> 
        </li>



        <li class="<?php if($this->uri->segment(2) == "notification" || $this->uri->segment(2) == "edit_notification" ||$this->uri->segment(2) == "add_notification" ){ echo 'active'; } ?>"> 
            <a href="<?php echo base_url()."bocms/notification"; ?>" class="mn_catgcur"><span>Trade notification</span> </a> 
        </li>

   <?php
       }

?>



<?php
if($admin_id==1){
            ?>

 <li class="<?php if($this->uri->segment(2) == "referal_commission_history"){ echo 'active'; } ?>"> 
            <a href="<?php echo base_url()."BoAdmin_Transation/referal_commission_history"; ?>" class="mn_catgcur"><span>Referal History</span> </a> 
        </li>



        <li class="<?php if($this->uri->segment(2) == "referal_commission"){ echo 'active'; } ?>"> 
            <a href="<?php echo base_url()."boAdmin_Transation/referal_commission"; ?>" class="mn_catgcur">
                <span>Referal Commission Settings</span> 
            </a>
        </li>


        <li> 
            <a class="mn_sib <?php if( $this->uri->segment(2) == "buy" || $this->uri->segment(2) == "sell" ){ echo 'mn_sib collapsed active'; } ?>" 
            data-toggle="collapse" data-parent="#accord_side" href="#sid_mn13" aria-expanded="false">
            <span>Trade History</span></a>
          <ul id="sid_mn13" class="mnsub_catglis collapse <?php if($this->uri->segment(1) == "BoFaq"){ echo 'in'; } ?>" aria-expanded="true" style="">

                   <li> 
            <a href="<?php echo base_url()."botrade"; ?>/buy" class="mn_catgcur mnsub_catg">
                <span>Buy</span> 
            </a>
        </li>


                   <li> 
            <a href="<?php echo base_url()."botrade"; ?>/sell" class="mn_catgcur mnsub_catg">
                <span>Sell</span> 
            </a>
        </li>

        </ul>
        </li>





           <?php
}

?>



<?php
        if($wallet==1){
            ?>

      

    <li class="<?php if($this->uri->segment(2) == "user_wallet" || $this->uri->segment(2) == "view_balance" || $this->uri->segment(2) == "view_address"){ echo 'active'; } ?>"> 
            <a href="<?php echo base_url()."BoUser/user_wallet"; ?>" class="mn_catgcur"><span>User Wallet</span> </a> 
        </li>


   <?php
     }   if($deposit_withdraw==1){
            ?>


    <li class="<?php if($this->uri->segment(2) == "deposit" || $this->uri->segment(2) == "view_deposit_detail"){ echo 'active'; } ?>"> 
            <a href="<?php echo base_url()."BoAdmin_Transation/deposit"; ?>" class="mn_catgcur">
                <span>Deposit History</span> 
            </a>
        </li>




   <?php
        } if($deposit_withdraw==1){
            ?>

            <li class="<?php if($this->uri->segment(2) == "withdraw" || $this->uri->segment(2) == "view_withdraw_detail"){ echo 'active'; } ?>"> 
            <a href="<?php echo base_url()."BoAdmin_Transation/withdraw"; ?>" class="mn_catgcur">
                <span>Withdraw History</span> 
            </a>
        </li>



      <li class="<?php if($this->uri->segment(2) == "withdraw_limit"){ echo 'active'; } ?>"> 
            <a href="<?php echo base_url()."BoAdmin_Transation/withdraw_limit"; ?>" class="mn_catgcur"><span>Withdraw limit setting</span> </a> 
        </li>




   <?php }
        if($deposit_withdraw==1){
            ?>


        <li class="<?php if($this->uri->segment(2) == "withdraw_profit"){ echo 'active'; } ?>"> 
            <a href="<?php echo base_url()."BoAdmin_Transation/withdraw_profit/BTC"; ?>" class="mn_catgcur">
                <span>Withdraw Profit</span> 
            </a>
        </li>      

   <?php
      } 


if($admin_id==1){
            ?>

        <li class="<?php if($this->uri->segment(2) == "coin_profit"){ echo 'active'; } ?>"> 
            <a href="<?php echo base_url()."botrade/coin_profit"; ?>" class="mn_catgcur">
                <span>Trade Profit</span> 
            </a>
        </li>
           <?php
}


      if($subscriper==1){
            ?>

        <li class="<?php if($this->uri->segment(2) == "subscriber"){ echo 'active'; } ?>"> 
            <a href="<?php echo base_url()."BoSupport_ticket/subscriber"; ?>" class="mn_catgcur">
                <span>Subscribers</span> 
            </a>
        </li>
          <!--    <?php
}
        if($support==1){
            ?>


              <li> 
            <a class="mn_sib <?php //if($this->uri->segment(1) == "BoSupport_ticket"){ echo 'mn_sib collapsed active'; } ?>" 
            data-toggle="collapse" data-parent="#accord_side" href="#sid_mn3" aria-expanded="false">
            <span>Support</span></a>
          <ul id="sid_mn3" class="mnsub_catglis collapse <?php if($this->uri->segment(1) == "BoFaq"){ echo 'in'; } ?>" aria-expanded="true" style="">

                   <li> 
            <a href="<?php //echo base_url()."BoSupport_ticket"; ?>/support_category" class="mn_catgcur mnsub_catg">
                <span>Support Category</span> 
            </a>
        </li>

           <?php
       }
        if($support==1){
            ?>

     
         <li> 
            <a href="<?php //echo base_url()."BoSupport_ticket"; ?>" class="mn_catgcur mnsub_catg">
                <span>Contact us</span> 
            </a>
        </li>
           <?php
       }
        if($support==1){
            ?>


        <li> 
            <a href="<?php //echo base_url()."BoSupport_ticket/support_us"; ?>" class="mn_catgcur mnsub_catg">
                <span>Support Ticket</span> 
            </a>
        </li>


        

          </ul>
        </li>  -->





   <?php
     }  
?>


<li class="mnsub_catg <?php if($this->uri->segment(1) == "BoEmailTemplate" && $this->uri->segment(2) == "") { echo 'active'; } ?>" >
          <a href="<?php echo base_url()."BoEmailTemplate"; ?>" >Email Templates</a>
            </li>   

     <?php


     if($cms==1){
            ?>







       <li class="<?php if($this->uri->segment(1) == "Bocms"){ echo 'active'; } ?>"> 
            <a href="<?php echo base_url()."Bocms"; ?>" class="mn_catgcur">
                <span>Manage CMS</span> 
            </a>
        </li>

        <li> 
            <a class="<?php if($this->uri->segment(1) == "BoFaq" || $this->uri->segment(2) == "addFaq" || $this->uri->segment(2) == "addFaq"){ echo 'mn_sib collapsed'; } ?>" 
            data-toggle="collapse" data-parent="#accord_side" href="#sid_mn21" aria-expanded="false">
            <span>Manage Faq</span></a>
          <ul id="sid_mn21" class="mnsub_catglis collapse <?php if($this->uri->segment(1) == "BoFaq"){ echo 'in'; } ?>" aria-expanded="true" style="">
            <li>
                <a href="<?php echo base_url()."BoFaq/addFaq"; ?>" class="mnsub_catg <?php if($this->uri->segment(1) == "BoFaq" && $this->uri->segment(2) == "addFaq") { echo 'active'; } ?>">Add new</a>
            </li>
            <li>
                <a href="<?php echo base_url()."BoFaq"; ?>" class="mnsub_catg <?php if($this->uri->segment(1) == "BoFaq" && $this->uri->segment(2) == "") { echo 'active'; } ?>">View list</a>
            </li>
          </ul>

          <br>
          <br>

          <?php
      }
      ?>

        </li>
        

   
      </ul>
    </div>
</aside>