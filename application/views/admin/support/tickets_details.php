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
                <li><a href="">Dashboard</a></li>
                <li><a href="">Contact us Details</a></li>
            </ul>
            <div class="inn_content">

            <div class="alert alert-denger" id="doc_rejected" style="display: none;"></div>
            <div class="alert alert-success" id="doc_success" style="display: none;"></div>
                   
            

            <?php
            $atrtibute = array('role'=>'form','name'=>'savecms','id'=>'edit_currency','method'=>'post','class'=>'cm_frm1 verti_frm1');
            echo form_open('',$atrtibute);
            ?>

                    
                    <div class="cm_head1">
                        <h3>Ticket Details</h3>
                    </div>


                   
                    <?php

                    $rs=$support;
                        $support=$support->row();


                         ?>



                    <div class="form-group row clearfix">

                          <div class="col-sm-6 col-xs-12 cls_resp50">
                            <label class="form-control-label"> Name</label>
                            <input type="text"  class="form-control"   value="<?php echo $support->name ?> " readonly>
                          </div>

                       
                    </div> 

                    <div class="form-group row clearfix">

                          <div class="col-sm-6 col-xs-12 cls_resp50">
                            <label class="form-control-label">Email</label>
                            <input type="text" readonly  class="form-control"   value="<?php echo $support->email_id ?>" >
                          </div>

                       
                    </div> 
                    <div class="form-group row clearfix">

                          <div class="col-sm-6 col-xs-12 cls_resp50">
                            <label class="form-control-label">Subject</label>
                            <input type="text"  class="form-control"   value="<?php echo $support->subject ?>"  readonly>
                          </div>

                       
                    </div> 



                       <div class="form-group row clearfix">

                          <div class="col-sm-6 col-xs-12 cls_resp50">
                            <label class="form-control-label">Message</label>

                            <div>

                           <?php echo $support->message ?>
                          </div>
                          </div>

                       
                    </div> 



                     <div class="form-group row clearfix">

                          <div class="col-sm-6 col-xs-12 cls_resp50">
                            <label class="form-control-label">Reply</label>
                            
                            <textarea class="form-control" name="replay">


                            </textarea>


                          </div>

                       
 </div>



                     <div class="form-group row clearfix">

                          <div class="col-sm-6 col-xs-12 cls_resp50">
                            <label class="form-control-label">Status</label>
							<div class="support_det">
                            <?php 
                                 $status=$support->status;

                            ?>


                                <select name="status" class="form-control">

                                  <option <?php if($status=="1"){ ?> selected="selected" <?php } ?>   value="open">Open</option>
                                  <option <?php if($status=="0"){ ?> selected="selected" <?php } ?>   value="closed">Closed</option>
                                  
                                 </select>

                          </div>
						   </div>

                       
                    </div> 






                     <div class="form-group row clearfix">

                          <div class="col-sm-6 col-xs-12 cls_resp50">
                            <label class="form-control-label">Message Date</label>
                            <input type="text"  class="form-control"   value="<?php echo $support->created_date ?>" readonly>
                          </div>

                       
                    </div> 



                      <div class="form-group row clearfix">

                          <div class="col-sm-6 col-xs-12 cls_resp50">
                            <label class="form-control-label"></label>
                        <input class="cm_blacbtn1" type="submit" value="Update" name="Update">
                          </div>

                       
                    </div> 




   <div class="cm_tablesc1 dep_tablesc mb-20">
                        <div class="dataTables_wrapper form-inline dt-bootstrap">
                         
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="cm_tableh3 table-responsive">
                                      <h5>Previous  replays</h5>
                                        <table id="faqData" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Message</th>
                                                    <th>Date and Time</th>
                                                    
                                                </tr>
                                            </thead>
                                            
                                            <tbody>
                                                <?php $ii = 0;
                                                

                                                if($replay->num_rows() >0 ){


                                                foreach ($replay->result() as $value) { 



                                                    $ii++;
                                                ?>
                                                <tr>
                                                    <td><?php echo $ii; ?></td>
                                                    <td><?php echo $value->message; ?></td>
                                                    <td><?php echo $value->replay_time; ?></td>
                                               
                                                   
                                                </tr>
                                                <?php  } }else{
                                                ?>
                                                <tr>
                                                <td rowspan="2">

                                                Previous message not found

                                                </td>
                                                </tr>


                                                <?php

                                            }
                                            ?>


                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

    

                                   
                    <ul class="list-inline">
                  
                    <li>
               
                    </li>
                    </ul>

                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />

             

                <?php form_close(); 

                ?> 

                 
           
        </section>
    </div>
  <!-- <footer class="main-footer"> Copyright © 2017 WCX Coin. All rights reserved. </footer>-->
</div>





<?php $this->load->view('admin/common/csrf'); ?>



<?php $this->load->view("admin/footer") ?>


<script>

        $(document).ready(function() {
        $(".doc_update").click(function(){
        
       
        var status=$(this).attr("data-status");
        var userid=$("#user_id").val();
        var csrf=$('input[name="csrf_test_name"]').val();
       // $.blockUI({ message: "<h1>KYC status updating, Please wait...</h1>" });
        var th=$(this);
        $.ajax({
        type : "POST",
        url : "<?php echo base_url() ?>BoUser/update_kyc",
        data: "userid="+userid+"&status="+status+"&csrf_test_name="+csrf,
        beforeSend : function() {
        //  $(".post_submitting").show().html("<center><img src='images/loading.gif'/></center>");
        },
        success : function(response) {
       // $.unblockUI();
        if(status==2){
          $(".status_section").empty();
          $(".status_section").html('<span   class="btn btn-success btn-sm ">Approved</span>');
        }
      
        }
        });
        
        });

       $(".doc_reason").click(function(){
        
       
        var status=$(this).attr("data-status");
        var userid=$("#user_id").val();
        var reason_text=$("#reason_text").val();
        alert(reason_text);
        var csrf=$('input[name="csrf_test_name"]').val();
       // $.blockUI({ message: "<h1>KYC status updating, Please wait...</h1>" });
        $.ajax({
        type : "POST",
        url : "<?php echo base_url() ?>BoUser/update_kyc",
        data: "reason_text="+reason_text+"&userid="+userid+"&status="+status+"&csrf_test_name="+csrf,
        beforeSend : function() {
       $(".doc_reason").show().html("<center><img src='images/loading.gif'/></center>");
        },
        success : function(response) {



          $('#reason').modal('toggle');

       // $.unblockUI();
       if(status==3 ){
          $(".status_section").empty();
          $(".status_section").html('<a   class="btn btn-danger btn-sm ">Rejected</a>');
        }
        //  alert(response);
        //$("#return_update_msg").html(response);
        // $(".post_submitting").fadeOut(1000);
        }
        });
        
        });





         });







  $('#edit_currency').validate({
    rules:{
      min_withdraw_limit:{
        required:true,
         number: true,
      },
      max_withdraw_limit:{
        required:true,
         number: true,
      },

       withdraw_fees:{
        required:true,
         number: true,
      },         
      
     
    },
    messages:{
       min_withdraw_limit:{
        required:"Please enter minimum withdraw limit",
        required:"Please enter valid minimum withdraw limit",
      },

      max_withdraw_limit:{
        required:"Please enter maximum withdraw limit",
        required:"Please enter maximum withdraw limit",
      },


      withdraw_fees:{
        required:"Please enter withdraw fees",
        required:"Please enter valid withdraw fees",
      },


   
      
    }
  })
</script>




</body>
</html>