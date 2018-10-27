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
                          <li><a href=""> Dashboard </a></li>

                <li>
                 Trade pair details </li>
                 <li>
                  Trade Fee list- <?php echo $trade_pair->trade_pair ?> 

                  </li>
                  <li>

                   Manage trade trade fee -<?php echo $trade_pair->trade_pair ?></a></li>
            </ul>
            <div class="inn_content">

            <div class="alert alert-denger" id="doc_rejected" style="display: none;"></div>
            <div class="alert alert-success" id="doc_success" style="display: none;"></div>
                   
            

            <?php
            $atrtibute = array('role'=>'form','name'=>'savecms','id'=>'trade_pair','method'=>'post','class'=>'cm_frm1 verti_frm1');
            echo form_open('',$atrtibute);
            ?>

           


                    
                    <div class="cm_head1">
                        <h3>Edit Trade fees-<?php echo $trade_pair->trade_pair ?></h3>
                    </div>
                   

                    <div class="form-group row clearfix">

                          <div class="col-sm-6 col-xs-12 cls_resp50">
                            <label class="form-control-label">From Volume</label>
                            <input type="text"  name ="from_volume" class="form-control"   value="<?php echo $trade_fees->from_volume ?>">
                          </div>

                       
                    </div> 

                    <div class="form-group row clearfix">

                          <div class="col-sm-6 col-xs-12 cls_resp50">
                            <label class="form-control-label">To Volume </label>
                            <input type="text" name ="to_volume"  class="form-control"   value="<?php echo $trade_fees->to_volume ?>">
                          </div>

                       
                    </div> 



                    <div class="form-group row clearfix">

                          <div class="col-sm-6 col-xs-12 cls_resp50">
                            <label class="form-control-label">Maker fee </label>
                            <input type="text"  name="maker_fee" class="form-control"  name ="maker"  value="<?php echo $trade_fees->maker ?>">
                          </div>

                       
                    </div> 

                    <input type="hidden"  name="pair_id" value="<?php echo $trade_fees->pair_id ?>">
                    <div class="form-group row clearfix">
                          <div class="col-sm-6 col-xs-12 cls_resp50">
                            <label class="form-control-label">Taker fee </label>
                            <input type="text"   name="taker" class="form-control"   value="<?php echo $trade_fees->taker ?>">
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
      from_volume:{
        required:true,
         number: true,
      },
      to_volume:{
        required:true,
         number: true,
      },

       maker:{
        required:true,
         number: true,
      }, 

        taker:{
        required:true,
         number: true,
      },               
      
     
    },
    messages:{
       from_volume:{
        required:"Please enter from volume",
        required:"Please enter from volume",
      },
      to_volume:{
        required:"Please enter to volume",
        required:"Please enter to volume",
      },

      maker:{
        required:"Please enter maker fee",
        required:"Please enter maker fee",
      },
      taker:{
        required:"Please enter taker fee",
        required:"Please enter taker fee",
      },
   
      
    }
  })



         });

</script>


</body>
</html>