<?php $this->load->view("admin/header") ?>
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
                        <a >Subscribers</a>
                    </li>
                </ul>
                <div class="inn_content">
                    <!-- <form class="cm_frm1 verti_frm1"> -->
                    <?php
                    $atrtibute = array('class'=>'cm_frm1 verti_frm1','id'=>"sub");
                    echo form_open('',$atrtibute);
                    ?>
                    <div class="cm_head1">
                        <h3>List of Subscribers</h3>
                    </div>
                    <div class="cm_tablesc1 dep_tablesc mb-20">
                        <div class="dataTables_wrapper form-inline dt-bootstrap">
                            <?php $this->load->view('admin/common/flashMessage'); ?>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="cm_tableh3 table-responsive">


                                    <a href="<?php echo base_url() ?>BoSupport_ticket/subscriber_export" class="btn btn-primary pull-right">Download</a>
 <label class="error" for="subs[]"></label>
                                        <table id="faqData" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>

                                                 <th>select</th>
                                                    <th>#</th>



                                                    <th>Email id</th>
                                                    <th>Subscribe Date</th>

                                                       <th>Send message</th>
                                                    
                                                    <th>Action  <a title="Delete" href="<?php echo base_url(); ?>BoSupport_ticket/deleteall/"onclick="return confirm('Are you sure want to delete all ?');">
                                                            <img src="<?php echo base_url(); ?>assets/admin/images/delete-icon.png" title="Delete"  />
                                                        </a></th>
                                                </tr>
                                            </thead>
                                            
                                            <tbody>
                                                <?php $ii = 0;
                                                
                                                foreach ($subscribers->result() as $value) { 



                                                    $ii++;
                                                ?>
                                                <tr>




                                                  <td><input type="checkbox" name="subs[]"value="<?php echo $value->email_id; ?>" ></td>
                                                    <td><?php echo $ii; ?></td>

                                                      <td><?php echo $value->email_id; ?></td>
                                                    <td><?php echo $value->created_date; ?></td>
                                                    
                                                 
                                                    <td>
<a href="<?php echo base_url() ?>BoSupport_ticket/sendnewsletter/<?php echo $value->id; ?>">Send</a></td>
                                                    <td>
                                                       
                                                       
                                                        <a title="Delete" href="<?php echo base_url(); ?>BoSupport_ticket/deleteSubscriber/<?php echo insep_encode($value->id); ?>"onclick="return confirm('Are you sure want to delete ?');">
                                                            <img src="<?php echo base_url(); ?>assets/admin/images/delete-icon.png" title="Delete"  />
                                                        </a>
                                                    </td>
                                                                                  </tr>
                                                <?php  } ?>
                                            </tbody>
                                        </table>


 <div class="inn_content">



                  <div class="form-group row">
                        <div class="col-sm-12 col-xs-12">
                            <label class="form-control-label">Subject</label>
                            <span class="mand_field">*</span>
                            <input type="text" class="form-control" id="faqQuestion" name="subject" placeholder="Subject">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Message</label>
                        <span class="mand_field">*</span>
                        <textarea name="message" class="ckeditor form-control" id="ckeditor"></textarea>                        
                        <span id="error_ans"></span>                        
                    </div>
                    
                   
                    <ul class="list-inline">
                        <li>                                  
                            <input type="submit" name="saveFaqDetails" value="Send" class="cm_blacbtn1">                            
                        </li>
                        <li>
                     
                        </li>
                    </ul>
</div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </section>
        </div>
        <!-- <footer class="main-footer"> Copyright © 2017 WCX Coin. All rights reserved. </footer>-->
    </div>
    <?php $this->load->view("admin/footer"); ?>
    <script type="text/javascript">
    $(document).ready(function () {
    $('#faqData').dataTable();
    });

    </script>



<script>

        $(document).ready(function() {
        

  $('#sub').validate({
    rules:{
      'subject':{
        required:true,
         
      },
      'message':{
        required:true,
      
      },
      'subs[]':{
            required: true,
           

      },

         
     
    },
    messages:{
       'subject':{
        required:"Please enter question",
    
      },
      'message':{
        required:"Please enter to Answer",
        
      },
      'subs[]':{
        required:"Please select email id",

      },

     
      
    }
  })



         });

</script>





</body>
</html>