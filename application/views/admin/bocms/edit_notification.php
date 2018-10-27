
<?php
$this->load->view("admin/header");
?>


<style>
textarea {
    height: 40em;
    width: 50em;
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
                <li><a h>Notification </a></li>
            </ul>
            <div class="inn_content">
                <?php
                    $atrtibute = array('role'=>'form','name'=>'saveFaq','method'=>'post','onSubmit'=>'return checkAll();','enctype' =>'multipart/form-data','id'=>"saveFaqs");
                    echo form_open('',$atrtibute);
                ?>
                    <div class="cm_head1">
                        <h3>Update Notification</h3>
                    </div>
              
                    <div class="form-group">
                        <label class="form-control-label">Notification</label>
                        <span class="mand_field">*</span>
                        <textarea name="message" id="editor1"class="form-control" ><?php echo $notification->notification ?></textarea>                        
                        <span id="error_ans"></span>                        
                    </div>


                    <div class="form-group">
                        <label class="form-control-label">Status</label>
                        <span class="mand_field">*</span>
                    <select name="status" class="form-control">
                    <option name="Active" <?php if($notification->status=="Active"){?>selected="selected"<?php } ?>  > Active</option>
                    <option name="In-Active" <?php if($notification->status=="In-Active"){?>selected="selected"<?php } ?>   >In-Active</option>
                    </select>


                   </span>                        
                    </div>
                 
                   
                    <ul class="list-inline">
                        <li>                                  
                            <input type="submit" name="notification" value="Add new" class="cm_blacbtn1">                            
                        </li>
                        <li>
                         <!--   <a href="<?php echo base_url()."BoFaq"; ?>" class="cm_blacbtn1">Cancel</a> -->
                        </li>
                    </ul>
                <?php echo form_close(); ?>
            </div>
        </section>
    </div>
  <!-- <footer class="main-footer"> Copyright © 2017 WCX Coin. All rights reserved. </footer>-->
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

<?php
$this->load->view("admin/footer");
?>

<script src="https://cdn.ckeditor.com/4.8.0/standard/ckeditor.js"></script>
<script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'editor1' );
            </script>



<script>

        $(document).ready(function() {
        

  $('#saveFaqs').validate({
    rules:{
  
      'message':{
        required:true,
      
      },
      
         
     
    },
    messages:{

      'message':{
        required:"Please enter to Notification",
        
      },
         
      
    }
  })



         });

</script>
</body>
</html>