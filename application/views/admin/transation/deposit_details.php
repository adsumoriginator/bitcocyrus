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
            <li>
                 <a href="<?php echo base_url()."BoDashboard"; ?>">Dashboard</a>

                   <li><a href="<?php echo base_url()."BoDashboard/deposit"; ?>">Deposit List</a></li>


                <li><a >Deposit Details</a></li>
            </ul>
            <div class="inn_content">

            <div class="alert alert-denger" id="doc_rejected" style="display: none;"></div>
            <div class="alert alert-success" id="doc_success" style="display: none;"></div>
                   
            

            <?php
         

            //print_r($deposit);
            //exit;




            $atrtibute = array('role'=>'form','name'=>'savecms','id'=>'edit_currency','method'=>'post','class'=>'cm_frm1 verti_frm1');
            echo form_open('',$atrtibute);
            ?>

                    

                    
                    <div class="cm_head1">
                        <h3>Deposit Details</h3>
                    </div>
                   

                    <div class="form-group row clearfix">

                          <div class="col-sm-6 col-xs-12 cls_resp50">
                            <label class="form-control-label">User Name</label>
                            <input type="text"  class="form-control"   value="<?php echo $deposit->username ?> " readonly>
                          </div>

                       
                    </div> 

                    <div class="form-group row clearfix">

                          <div class="col-sm-6 col-xs-12 cls_resp50">
                            <label class="form-control-label">Currency</label>
                            <input type="text" name="min_withdraw_limit" class="form-control"   value="<?php echo $deposit->currency ?>" >
                          </div>

                       
                    </div> 



                       <div class="form-group row clearfix">

                          <div class="col-sm-6 col-xs-12 cls_resp50">
                            <label class="form-control-label">Amount</label>
                            <input type="text" name="max_withdraw_limit" class="form-control"   value="<?php echo $deposit->total_amount ?>" >
                          </div>

                       
                    </div> 


                          <div class="form-group row clearfix">

                          <div class="col-sm-6 col-xs-12 cls_resp50">
                            <label class="form-control-label">Receive Address </label>
                            <input type="text" name="withdraw_fees" class="form-control"   value="<?php echo $deposit->to_address ?>" >
                          </div>

                       
                    </div> 





                     <div class="form-group row clearfix">

                          <div class="col-sm-6 col-xs-12 cls_resp50">
                            <label class="form-control-label">Status </label>
                            <input type="text" name="withdraw_fees" class="form-control"   value="<?php echo $deposit->status ?>" >
                          </div>

                       
                    </div> 





                     <div class="form-group row clearfix">

                          <div class="col-sm-6 col-xs-12 cls_resp50">
                            <label class="form-control-label">Received Time </label>
                            <input type="text" name="withdraw_fees" class="form-control"   value="<?php echo $deposit->requested_time ?>" >
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






</body>
</html>