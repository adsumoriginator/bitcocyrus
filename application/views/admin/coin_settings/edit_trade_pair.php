<?php 



$this->load->view("admin/header") ?>
    <style>
/* Paste this css to your style sheet file or under head tag */
/* This only works with JavaScript, 
if it's not present, don't show loader */
.no-js #loader { display: none;  }
.js #loader { display: block; position: absolute; left: 100px; top: 0; }
.se-pre-con {
    position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: url('https://media.giphy.com/media/RdfQlwy8hiFm8/source.gif') center no-repeat #fff;

    /*https://media.giphy.com/media/RdfQlwy8hiFm8/source.gif*/
}

#reason_text{
  outline: none !important;
    border:1px solid ;
    box-shadow: 0 0 10px #719ECE;

}

.cls_inner_cate {
    position: absolute;
    top: 100%;
}
.hiddenf {
    display: none;
}
.flyout {
    left: 0;
    position: absolute;
    top: 100%;
    z-index: 999;
}

.user_img img{
    height: 200px;
    width:200px;
}
</style>




<body class="hold-transition sidebar-mini">
    <div class="wrapper">
    <?php $this->load->view('admin/common/header'); ?>
    <?php $this->load->view('admin/common/sidebar'); ?>
    <div class="content-wrapper">
        <section class="content">
            <ul class="breadcrumb cm_breadcrumb">
                  <li><a href="<?php echo base_url(); ?>BoDashboard">Dashboard</a></li>
                   <li><a  href="<?php echo base_url(); ?>BoCoin_settings/trade_pairs">Trade pair details</a></li>

                
                <li><a >trade pair edit-<?php echo $trade_pair->trade_pair ?></a></li>
            </ul>
            <div class="inn_content">

            <div class="alert alert-denger" id="doc_rejected" style="display: none;"></div>
            <div class="alert alert-success" id="doc_success" style="display: none;"></div>
                   
            

            <?php
            $atrtibute = array('role'=>'form','name'=>'savecms','id'=>'trade_pair','method'=>'post','class'=>'cm_frm1 verti_frm1');
            echo form_open('',$atrtibute);
            ?>

           


                    
                    <div class="cm_head1">
                        <h3>Edit Trade pair - <?php echo $trade_pair->trade_pair ?></h3>
                    </div>
                   

                    <div class="form-group row clearfix">

                          <div class="col-sm-6 col-xs-12 cls_resp50">
                            <label class="form-control-label">Trade Pair</label>
                            <input type="text"  class="form-control"   value="<?php echo $trade_pair->trade_pair ?> " readonly>
                          </div>

                       
                    </div> 

                    <div class="form-group row clearfix">

                          <div class="col-sm-6 col-xs-12 cls_resp50">
                            <label class="form-control-label">Buy rate </label>
                            <input type="text"  name="buy_rate" class="form-control"   value="<?php echo $trade_pair->buy_rate_value ?>">
                          </div>

                       
                    </div> 
                    <div class="form-group row clearfix">

                          <div class="col-sm-6 col-xs-12 cls_resp50">
                            <label class="form-control-label">Sell rate</label>
                              <input type="text"  name="sell_rate" class="form-control"   value="<?php echo $trade_pair->sell_rate_value ?>">
                          </div>

                       
                    </div> 



                       <div class="form-group row clearfix">

                          <div class="col-sm-6 col-xs-12 cls_resp50">
                            <label class="form-control-label">Minimum Trade amount</label>
                            <input type="text" name="minimum_trade" class="form-control"   value="<?php echo $trade_pair->min_trade_amount ?>" >
                          </div>

                       
                    </div> 



               



                      <div class="form-group row clearfix">

                          <div class="col-sm-6 col-xs-12 cls_resp50">
                            <label class="form-control-label"></label>
                        <input class="cm_blacbtn1" type="submit" value="Update" name="Update">
                          </div>

                       
                    </div> 
    

                                   
                    <ul class="list-inline">
                  
                    <li>
               
                    </li>
                    </ul>

                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />

             

                <?php form_close(); 

                ?> 

                 
            </div>
        </section>
    </div>
  <!-- <footer class="main-footer"> Copyright © 2017 WCX Coin. All rights reserved. </footer>-->
</div>





<?php $this->load->view('admin/common/csrf'); ?>



<?php $this->load->view("admin/footer") ?>


<script>

        $(document).ready(function() {
        

  $('#trade_pair').validate({
    rules:{
      buy_rate:{
        required:true,
         number: true,
      },
      sell_rate:{
        required:true,
         number: true,
      },

       minimum_trade:{
        required:true,
         number: true,
      },         
      
     
    },
    messages:{
       buy_rate:{
        required:"Please enter buy rate",
        required:"Please enter valid buy rate",
      },

      sell_rate:{
        required:"Please enter sell rate",
        required:"Please enter sell rate",
      },

      minimum_trade:{
        required:"Please enter minimum trade",
        required:"Please enter minimum trade",
      },
   
      
    }
  })



         });

</script>


</body>
</html>