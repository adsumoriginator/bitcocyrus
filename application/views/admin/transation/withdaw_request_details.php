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
                    </li>
                    <li>
                        <a  href="<?php echo base_url()."BoAdmin_Transation/withdraw"; ?>">withdraw list</a>
                    </li>

                    <li>
                        <a>withdraw details</a>
                    </li>
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
                        <h3>Withdraw Details</h3>
                    </div>
                              <div class="form-group row clearfix">

                          <div class="col-sm-6 col-xs-12 cls_resp50">
                            <label class="form-control-label">Reference ID</label>
                            <input type="text"  class="form-control"   value="<?php echo $withdraw->transactionId ?> " readonly>
                          </div>

                       
                    </div>


                   

                    <div class="form-group row clearfix">

                          <div class="col-sm-6 col-xs-12 cls_resp50">
                            <label class="form-control-label">User Name</label>
                            <input type="text"  class="form-control"   value="<?php echo $user_name ?> " readonly>
                          </div>

                       
                    </div> 

                



                       <div class="form-group row clearfix">

                          <div class="col-sm-6 col-xs-12 cls_resp50">
                            <label class="form-control-label">Total Amount</label>
                            <input type="text" name="max_withdraw_limit" class="form-control"   value="<?php echo $withdraw->total_amount ?><?php echo $withdraw->currency ?>" >
                          </div>

                       
                    </div> 


                        <div class="form-group row clearfix">

                          <div class="col-sm-6 col-xs-12 cls_resp50">
                            <label class="form-control-label">Fee Percentage</label>
                            <input type="text" name="max_withdraw_limit" class="form-control"   value="<?php echo $withdraw->fee_percentage ?>%" >
                          </div>

                       
                    </div> 




                        <div class="form-group row clearfix">

                          <div class="col-sm-6 col-xs-12 cls_resp50">
                            <label class="form-control-label">fee Amount</label>
                            <input type="text" name="max_withdraw_limit" class="form-control"   value="<?php echo $withdraw->fee ?><?php echo $withdraw->currency ?>" >
                          </div>

                       
                    </div> 


                    <div class="form-group row clearfix">

                          <div class="col-sm-6 col-xs-12 cls_resp50">                            <label class="form-control-label">Transfer Amount</label>
                            <input type="text" name="max_withdraw_limit" class="form-control"   value="<?php echo $withdraw->transfer_amount ?><?php echo $withdraw->currency ?>" >
                          </div>

                       
                    </div> 




                          <div class="form-group row clearfix">

                          <div class="col-sm-6 col-xs-12 cls_resp50">
                            <label class="form-control-label">To Address </label>
                            <input type="text" name="withdraw_fees" class="form-control"   value="<?php echo $withdraw->to_address ?>" >
                          </div>

                       
                     </div> 





                     <div class="form-group row clearfix">

                          <div class="col-sm-6 col-xs-12 cls_resp50">
                            <label class="form-control-label">Status </label>
                            <input type="text" name="withdraw_fees" class="form-control"   value="<?php echo $withdraw->status ?>" >
                          </div>

                       
                    </div> 






                     <div class="form-group row clearfix">

                          <div class="col-sm-6 col-xs-12 cls_resp50">
                            <label class="form-control-label">Password</label>
                            <input type="password" name="password" class="form-control"   value=" " >
                          </div>

                       
                    </div> 



                                  
                  <ul class="list-inline">
                        <li>                                  
                            <input type="submit" name="witdraw_submit" value="Approve" class="cm_blacbtn1">                            
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
        

  $('#edit_currency').validate({
    rules:{
      password:{
        required:true,
    
         
      },
 
         
     
    },
    messages:{
       password:{
        required:"Please enter password",
       
    
      },
      
     
      
    }
  })



         });

</script>



</body>
</html>