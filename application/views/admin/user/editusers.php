<?php 



$this->load->view("admin/header") ?>

 <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/lightbox.min.css">



    <style>

    .download_btn{

      margin-top: 10px;
    }
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


.se-pre-con { position: fixed; 
left: 0px; 
top: 0px; width: 100%; 
height: 100%; z-index: 9999;
 background: url(<?php echo base_url(); ?>assets/admin/images/preloader.gif) center no-repeat #fff; /*https://media.giphy.com/media/RdfQlwy8hiFm8/source.gif*/ }


</style>

<div class="se-pre-con"></div>


<body class="hold-transition sidebar-mini">
    <div class="wrapper">
    <?php $this->load->view('admin/common/header'); ?>
    <?php $this->load->view('admin/common/sidebar'); ?>
    <div class="content-wrapper">
        <section class="content">
            <ul class="breadcrumb cm_breadcrumb">
               <li><a href="<?php echo base_url(); ?>BoDashboard">Dashboard</a></li>
                <li><a href="<?php echo base_url(); ?>BoUser/view">User List</a></li>

                <li><a href="">Edit user</a></li>
            </ul>
            <div class="inn_content">

            <div class="alert alert-denger" id="doc_rejected" style="display: none;"></div>
            <div class="alert alert-success" id="doc_success" style="display: none;"></div>
                   
            

            <?php
            $atrtibute = array('role'=>'form','name'=>'savecms','id'=>'savecms','method'=>'post','class'=>'cm_frm1 verti_frm1');
            echo form_open('',$atrtibute);
            ?>

                    <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_data->user_id; ?>">
                 

                    
                    <div class="cm_head1">
                        <h3>Edit User</h3>
                    </div>
                    <!--
                    <div class="user_cn">

                    <?php if($profilepicture!=''){ ?>
                    <img class="img-responsive" src="<?php echo base_url(); ?>uploads/users/<?php echo $profilepicture; ?>">
                    <?php }else{
                     ?>
                    <img class="img-responsive" src="<?php echo base_url(); ?>uploads/no_image.png">   
                    <?php } ?>

                    </div> -->



                              <div class="form-group row clearfix">

                          <div class="col-sm-6 col-xs-12 cls_resp50">
                            <label class="form-control-label">User ID</label>
                            <input type="text" readonly class="form-control" id="username" name="username" value="<?php echo $user_data->user_code;?>">
                          </div>

                          <div class="col-sm-6 col-xs-12 cls_resp50 xrs_mat10">
                            <label class="form-control-label">User Name</label>
                            <input type="text" class="form-control" readonly id="firstname" name="firstname" value="<?php echo $user_data->username;?>">
                          </div>
                    </div> 
                          



                    <div class="form-group row clearfix">


                          <div class="col-sm-6 col-xs-12 cls_resp50 xrs_mat10">
                            <label class="form-control-label">User Firstname</label>
                            <input type="text" class="form-control" readonly id="firstname" name="firstname" value="<?php echo $user_data->firstname;?>">
                          </div>


                                <div class="col-sm-6 col-xs-12 cls_resp50">                     
                        <label class="form-control-label">User Lastname</label>
                        <input type="text" class="form-control" readonly id="lastname" name="lastname" value="<?php echo  $user_data->lastname;?>"> 
                        </div>
                    </div> 
                                       
                  

                    <div class="form-group row clearfix">  
               
                          <div class="col-sm-6 col-xs-12 cls_resp50 xrs_mat10">
                           <label class="form-control-label">User Email</label>
                     


                         <input type="text" class="form-control" readonly id="firstname" name="firstname" value="<?php echo get_user_email($user_data->user_id);?>">
                          </div>      


                  <div class="col-sm-6 col-xs-12 cls_resp50">                    
                        <label class="form-control-label">Phone</label>
                        <input type="text" class="form-control" readonly id="cellno" name="cellno" value="<?php echo $user_data->phone_no;?>">    
                        </div>

                    </div>                       



                     <div class="form-group row clearfix">

                      <div class="col-sm-6 col-xs-12 cls_resp50">
                        <label class="form-control-label">User address</label>
                        <input type="text" class="form-control" readonly id="userip" name="userip" value="<?php echo $user_data->userAddress ?>">
                      </div>
                      
                      <div class="col-sm-6 col-xs-12 cls_resp50 xrs_mat10">
                         <label class="form-control-label">User Country</label>
                        <input type="text" class="form-control" readonly id="country" name="country" value="<?php echo $user_data->country ?>">
                      </div>

                     </div>
                   

                    <div class="form-group row clearfix">     
                    <div class="col-sm-6 col-xs-12 cls_resp50">               
                        <label class="form-control-label">User State</label>
                        <input type="text" class="form-control" readonly id="state" name="state" value="<?php echo $user_data->state ?>"> 
                        </div>
                        <div class="col-sm-6 col-xs-12 cls_resp50 xrs_mat10">
                        <label class="form-control-label"> City</label>
                        <input type="text" class="form-control" readonly id="city" name="city" value="<?php echo $user_data->city ?>">      
                        </div>                        
                    </div>
                                                    

                    <div class="form-group row clearfix">
                     <div class="col-sm-6 col-xs-12 cls_resp50">                     
                        <label class="form-control-label">Date of Birth</label>
                        <input type="text" class="form-control" readonly id="cellno" name="cellno" value="<?php echo $user_data->dob;?>">    
                        </div>
                         <div class="col-sm-6 col-xs-12 cls_resp50 xrs_mat10">
                         <label class="form-control-label">User Postal Code</label>
                        <input type="text" class="form-control" readonly id="postal_code" name="postal_code" value="<?php echo $user_data->post_code ?>"> 

                         </div>                      
                    </div>  
                   
				   
				   
				   <?php

                  $kyc_data=$kyc_data->row();
				  
                  ?>
				   <div class="row">
				    <div class="col-md-12">
				   <div class="upload_photo_list">
				   <ul class="list-inline">
				   <li>
				   <label class="form-control-label">PASSPORT(Front)</label>
  <div  class="prof_det">
                        <?php
                        if($kyc_data->id_proof1!=""){
                        ?>


                           <a class="example-image-link" href="<?php echo base_url()?>uploads/kyc/<?php echo $kyc_data->id_proof1 ?>" data-lightbox="example-1">

               <img class="example-image" src="<?php echo base_url()?>uploads/kyc/<?php echo $kyc_data->id_proof1 ?>" alt="image-1" />
               <span><img src="<?php echo base_url()?>assets/admin/images/zoom_im2.png"></span>
             </a>




            </div>
              
                            <div class="form-group row clearfix">

                    <?php 
                    if($kyc_data->proof1_status=="1"){ ?>

                     <div class="status_section_one">
                     <div class="col-sm-12 col-xs-12 cls_resp50">
                    

                     <a data-status="2" data-doc="1"  class="btn btn-success btn-sm doc_update">Approve</a>
            <a data-status="3" class="btn btn-danger btn-sm doc_reject"  data-doc="1" data-toggle="modal" data-target="#reason" >Reject</a>
                       

                        </div>
                         </div>

                         <?php
                       }else if($kyc_data->proof1_status=="3"){
                        ?>
                         <div class="col-sm-12 col-xs-12 cls_resp50">
                          <a   class="btn btn-danger btn-sm ">Rejected</a>
                          </div>
                        <?php
                       }else if($kyc_data->proof1_status=="2"){ ?>
                         <div class="col-sm-12 col-xs-12 cls_resp50">
                            <a   class="btn btn-success btn-sm ">Approved</a>
                            </div>
                        <?php

                       }

                       ?>
                          <a data-status="3" class="btn btn-info btn-sm download_btn" href="<?php echo base_url()?>uploads/kyc/<?php echo $kyc_data->id_proof1 ?>" download="passport_front"  data-doc="1" >Download</a>

                    </div> 






                        <?php
                      }else{
                        ?><b> <img width="150px" height="150px" src="<?php echo base_url()?>uploads/kyc/id_not_available.jpg"></b>
<?php
                      }
                      ?>
				   </li>
				   




				   <li>
				   <label class="form-control-label">PASSPORT(Back)</label>
				  <div  class="prof_det">
				    <?php
                        if($kyc_data->id_proof2!=""){
                        ?>
                        <!--
               <img width="150px" height="150px" src="<?php echo base_url()?>uploads/kyc/<?php echo $kyc_data->id_proof2 ?>"> -->


                 <a class="example-image-link" href="<?php echo base_url()?>uploads/kyc/<?php echo $kyc_data->id_proof2 ?>" data-lightbox="example-1">

      <img class="example-image" src="<?php echo base_url()?>uploads/kyc/<?php echo $kyc_data->id_proof2 ?>" alt="image-2" />

<span><img src="<?php echo base_url()?>assets/admin/images/zoom_im2.png"></span>
</a>

          </div>

                 <div class="form-group row clearfix">

                    <?php 
                    if($kyc_data->proof2_status=="1"){ ?>

                     <div class="status_section_two">
                     <div class="col-sm-12 col-xs-12 cls_resp50">
                    

                     <a data-status="2" data-doc="2"  class="btn btn-success btn-sm doc_update">Approve</a>
           <a data-status="3" class="btn btn-danger btn-sm doc_reject"  data-doc="2" data-toggle="modal" data-target="#reason" >Reject</a>
                       
                        </div> 

                         </div>

                         <?php
                       }else if($kyc_data->proof2_status=="3"){
                        ?>

                                <div class="col-sm-12 col-xs-12 cls_resp50">
                          <a   class="btn btn-danger btn-sm ">Rejected</a>
                          </div>
                        <?php
                       }else if($kyc_data->proof2_status=="2"){ ?>
                                <div class="col-sm-12 col-xs-12 cls_resp50">
                            <a   class="btn btn-success btn-sm ">Approved</a>
                            </div>
                        <?php

                       }

                       ?>

                        <a  class="btn btn-info btn-sm download_btn" href="<?php echo base_url()?>uploads/kyc/<?php echo $kyc_data->id_proof2 ?>" download="passport_back"  data-doc="1" >Download</a>




                    </div> 


                        <?php
                      }else{
                        ?><b> <img width="150px" height="150px" src="<?php echo base_url()?>uploads/kyc/id_not_available.jpg"></b>
<?php
                      }
                      ?>

	
				   </li>
				   




				   <li>
				   <label class="form-control-label">ID proof(Front)</label>
				  <div  class="">
				 <div  class="prof_det">
                        <?php
                        if($kyc_data->id_proof3!=""){
                        ?>

                        <!--

                          <img  width="150px" height="150px" src="<?php echo base_url()?>uploads/kyc/<?php echo $kyc_data->id_proof3 ?>">


                          -->


                             <a class="example-image-link" href="<?php echo base_url()?>uploads/kyc/<?php echo $kyc_data->id_proof3 ?>" data-lightbox="example-1">

      <img class="example-image" src="<?php echo base_url()?>uploads/kyc/<?php echo $kyc_data->id_proof3 ?>" alt="image-2" />
<span><img src="<?php echo base_url()?>assets/admin/images/zoom_im2.png"></span>
</a>
            </div>  

                 <div class="form-group row clearfix">

                    <?php 
                    if($kyc_data->proof3_status=="1"){ ?>

                     <div class="status_section_three">
                     <div class="col-sm-12 col-xs-12 cls_resp50">
                    

                     <a data-status="2" data-doc="3"  class="btn btn-success btn-sm doc_update">Approve</a>
           <a data-status="3" class="btn btn-danger btn-sm doc_reject"  data-doc="3" data-toggle="modal" data-target="#reason" >Reject</a>
                       
                        </div>

                         </div>

                         <?php
                       }else if($kyc_data->proof3_status=="3"){
                        ?>
                           <div class="col-sm-12 col-xs-12 cls_resp50">

                          <a   class="btn btn-danger btn-sm ">Rejected</a>
                          </div>
                        <?php
                       }else if($kyc_data->proof3_status=="2"){ ?>
                           <div class="col-sm-12 col-xs-12 cls_resp50">

                            <a   class="btn btn-success btn-sm ">Approved</a>
                            </div>
                        <?php

                       }

                       ?>
                          <a  class="btn btn-info btn-sm download_btn" href="<?php echo base_url()?>uploads/kyc/<?php echo $kyc_data->id_proof3 ?>" download="id_front"  >Download</a>


                    </div> 




                        <?php
                      }else{
                        ?><b> <img width="150px" height="150px" src="<?php echo base_url()?>uploads/kyc/id_not_available.jpg"></b>
<?php
                      }
                      ?>

			
						</div>
				   </li>
				   
				   
				   <li>
				   <label class="form-control-label">Id proof(Back)</label>
				  <div  class="">
				   <div  class="prof_det">
                        <?php
                        if($kyc_data->id_proof4!=""){
                        ?>

                       <!--   <img  width="150px" height="150px" src="<?php echo base_url()?>uploads/kyc/<?php echo $kyc_data->id_proof4 ?>">
              -->


                                 <a class="example-image-link" href="<?php echo base_url()?>uploads/kyc/<?php echo $kyc_data->id_proof4 ?>" data-lightbox="example-1">

      <img class="example-image" src="<?php echo base_url()?>uploads/kyc/<?php echo $kyc_data->id_proof4 ?>" alt="image-2" />
      <span><img src="<?php echo base_url()?>assets/admin/images/zoom_im2.png"></span>

      </a>
            </div>  

                 <div class="form-group row clearfix">

                    <?php 
                    if($kyc_data->proof4_status=="1"){ ?>

                     <div class="status_section_four">
                     <div class="col-sm-12 col-xs-12 cls_resp50">
                    

                     <a data-status="2" data-doc="4"  class="btn btn-success btn-sm doc_update">Approve</a>
           <a data-status="4" class="btn btn-danger btn-sm doc_reject"  data-doc="4" data-toggle="modal" data-target="#reason" >Reject</a>
                       
                        </div>

                         </div>

                         <?php
                       }else if($kyc_data->proof4_status=="3"){
                        ?>
                           <div class="col-sm-12 col-xs-12 cls_resp50">

                            
                          <a   class="btn btn-danger btn-sm ">Rejected</a>
                          </div>
                        <?php
                       }else if($kyc_data->proof4_status=="2"){ ?>
                           <div class="col-sm-12 col-xs-12 cls_resp50">


                            <a   class="btn btn-success btn-sm ">Approved</a>
                            </div>
                        <?php

                       }

                       ?>


                        <a  class="btn btn-info btn-sm download_btn" href="<?php echo base_url()?>uploads/kyc/<?php echo $kyc_data->id_proof4 ?>" download="id_back"  >Download</a>



                    </div> 




                        <?php
                      }else{
                        ?><img width="150px" height="150px" src="<?php echo base_url()?>uploads/kyc/id_not_available.jpg">
<?php
                      }
                      ?>						</div>
				   </li>
				   
				   <li>
				   <label class="form-control-label">Profile Picture</label>
				  <div  class="">
				  
            <div  class="prof_det">
                     <?php
                        if($kyc_data->id_proof5!=""){
                        ?>
<!--
               <img width="150px" height="150px" src="<?php echo base_url()?>uploads/kyc/<?php echo $kyc_data->id_proof5 ?>"> -->

                  <a class="example-image-link" href="<?php echo base_url()?>uploads/kyc/<?php echo $kyc_data->id_proof5 ?>" data-lightbox="example-1">

      <img class="example-image" src="<?php echo base_url()?>uploads/kyc/<?php echo $kyc_data->id_proof5 ?>"  />
<span><img src="<?php echo base_url()?>assets/admin/images/zoom_im2.png"></span>
      </a>


          </div>

                 <div class="form-group row clearfix">

                    <?php 
                    if($kyc_data->proof5_status=="1"){ ?>

                     <div class="status_section_five">
                     <div class="col-sm-12 col-xs-12 cls_resp50">
                    

                     <a data-status="2" data-doc="5"  class="btn btn-success btn-sm doc_update">Approve</a>
           <a data-status="3" class="btn btn-danger btn-sm doc_reject"  data-doc="5" data-toggle="modal" data-target="#reason" >Reject</a>
                       
                        </div> 

                         </div>

                         <?php
                       }else if($kyc_data->proof5_status=="3"){
                        ?>
   <div class="col-sm-12 col-xs-12 cls_resp50">

                          <a   class="btn btn-danger btn-sm ">Rejected</a>
                          </div>
                        <?php
                       }else if($kyc_data->proof5_status=="2"){ ?>
                           <div class="col-sm-12 col-xs-12 cls_resp50">


                            <a   class="btn btn-success btn-sm ">Approved</a>
                            </div>
                        <?php

                       }

                       ?>

                           <a  class="btn btn-info btn-sm download_btn" href="<?php echo base_url()?>uploads/kyc/<?php echo $kyc_data->id_proof5 ?>" download="profile"  >Download</a>

                    </div> 


                         <?php
                      }else{
                        ?><img width="150px" height="150px" src="<?php echo base_url()?>uploads/kyc/id_not_available.jpg">
<?php
                      }
                      ?>      
						</div>
				   </li>
				   </ul>
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

                  <div id="reason" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;  </button>
                                    <h4 class="modal-title" id="myModalLabel">Reason</h4>
                                </div>
                                <div class="modal-body">
                                <div class="form-group">
                                <label class="form-control-label">Reject reason</label>
                                <textarea id="reason_text" class="tarea1 form-control"> </textarea> 
                                </div>
                                <div class="form-group">
                                 <button  type="button" class="cm_blacbtn1 btn-successs  reject_doc_update doc_reason" data-status="3">Update</button>
                                 </div>
                                </div>                                
                            </div>
                        </div>
                    </div>
            </div>
        </section>
    </div>
  <!-- <footer class="main-footer"> Copyright © 2017 WCX Coin. All rights reserved. </footer>-->
</div>





<?php $this->load->view('admin/common/csrf'); ?>


  <script src="<?php echo base_url(); ?>assets/admin/js/lightbox-plus-jquery.min.js"></script>


<?php $this->load->view("admin/footer") ?>




<script>


  $(window).load(function() { $(".se-pre-con").fadeOut("slow");; });

        $(document).ready(function() {
        $(".doc_update").click(function(){
        
       
        var status=$(this).attr("data-status");
         var doc=$(this).attr("data-doc");
        var userid=$("#user_id").val();
        var csrf=$('input[name="csrf_test_name"]').val();
       // $.blockUI({ message: "<h1>KYC status updating, Please wait...</h1>" });
        var th=$(this);
        $.ajax({
        type : "POST",
        url : "<?php echo base_url() ?>BoUser/update_kyc",
        data: "userid="+userid+"&status="+status+"&csrf_test_name="+csrf+"&doc="+doc,
       beforeSend:function(){ 
        $('.se-pre-con').show();
        },
        success : function(response) {
       // $.unblockUI();
      $('.se-pre-con').hide();
        if(status==2){

          if(doc==1){

          $(".status_section_one").empty();
          $(".status_section_one").html('<div class="col-sm-12 col-xs-12 cls_resp50"><span   class="btn btn-success btn-sm ">Approved</span></div>');

        }else if(doc==2){



          $(".status_section_two").empty();
          $(".status_section_two").html('<div class="col-sm-12 col-xs-12 cls_resp50"><span   class="btn btn-success btn-sm ">Approved</span></div>');

        }else if(doc==3){

          $(".status_section_three").empty();
          $(".status_section_three").html('<div class="col-sm-12 col-xs-12 cls_resp50"><span   class="btn btn-success btn-sm ">Approved</span></div>');

        }else if(doc==4){

          $(".status_section_four").empty();
          $(".status_section_four").html('<div class="col-sm-12 col-xs-12 cls_resp50"><span   class="btn btn-success btn-sm ">Approved</span></div>');

        }else if(doc==5){

          $(".status_section_five").empty();
          $(".status_section_five").html('<div class="col-sm-12 col-xs-12 cls_resp50"><span   class="btn btn-success btn-sm ">Approved</span></div>');

        }
        }
      
        }
        });
        
        });


         $(".doc_reject").click(function(){
              var doc=$(this).attr("data-doc");     
              $(".reject_doc_update").attr("data-doc",doc);

         });




       $(".doc_reason").click(function(){
        
       
        var status=$(this).attr("data-status");
        var userid=$("#user_id").val();
        var doc=$(this).attr("data-doc");;
        var reason_text=$("#reason_text").val();
 
        var csrf=$('input[name="csrf_test_name"]').val();
       // $.blockUI({ message: "<h1>KYC status updating, Please wait...</h1>" });
        $.ajax({
        type : "POST",
        url : "<?php echo base_url() ?>BoUser/update_kyc",
        data: "reason_text="+reason_text+"&userid="+userid+"&status="+status+"&csrf_test_name="+csrf+"&doc="+doc,
        beforeSend : function() {
          $(".doc_reason").attr("disable",'true');
       
          $(".doc_reason").show().html("Please wait");
        },
        success : function(response) {
          var reason_text=$("#reason_text").val("");
                  $(".doc_reason").attr("disable",'true');
       
          $(".doc_reason").show().html("Update");

          $('#reason').modal('toggle');

       // $.unblockUI();
       if(status==3 ){

        if(doc==1){

          $(".status_section_one").empty();
          $(".status_section_one").html('<div class="col-sm-12 col-xs-12 cls_resp50"><a   class="btn btn-danger btn-sm ">Rejected</a></div>');

        }else if(doc==2){

          $(".status_section_two").empty();
          $(".status_section_two").html('<div class="col-sm-12 col-xs-12 cls_resp50"><a   class="btn btn-danger btn-sm ">Rejected</a></div>');

        }else if(doc==3){

          $(".status_section_three").empty();
          $(".status_section_three").html('<div class="col-sm-12 col-xs-12 cls_resp50"><a   class="btn btn-danger btn-sm ">Rejected</a></div>');

        }else if(doc==4){

          $(".status_section_four").empty();
          $(".status_section_four").html('<div class="col-sm-12 col-xs-12 cls_resp50"><a   class="btn btn-danger btn-sm ">Rejected</a></div>');

        }
        else if(doc==5){

          $(".status_section_five").empty();
          $(".status_section_five").html('<div class="col-sm-12 col-xs-12 cls_resp50"><a   class="btn btn-danger btn-sm ">Rejected</a></div>');

        }
        


        }
        //  alert(response);
        //$("#return_update_msg").html(response);
        // $(".post_submitting").fadeOut(1000);
        }
        });
        
        });





         });

</script>


</body>
</html>