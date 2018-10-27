
<?php
$this->load->view("admin/header");
?>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
    <?php $this->load->view('admin/common/header'); ?>
    <?php $this->load->view('admin/common/sidebar'); ?>
    <div class="content-wrapper">
        <section class="content">
            <ul class="breadcrumb cm_breadcrumb">
                <li><a href="<?php echo base_url(); ?>BoDashboard">Dashboard</a></li>
                <li><a href="<?php echo base_url(); ?>BoFaq">FAQ </a></li>

                  <li>>Add FAQ </a></li>
            </ul>
            <div class="inn_content">
                <?php
                    $atrtibute = array('role'=>'form','name'=>'saveFaq','id'=>'saveFaq','method'=>'post','onSubmit'=>'return checkAll();','enctype' =>'multipart/form-data');
                    echo form_open('BoFaq/saveFaq',$atrtibute);
                ?>
                    <div class="cm_head1">
                        <h3>Add FAQ</h3>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 col-xs-12">
                            <label class="form-control-label">Question</label>
                            <span class="mand_field">*</span>
                            <input type="text" class="form-control" id="faqQuestion" name="faqQuestion" placeholder="Question">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Answer</label>
                        <span class="mand_field">*</span>
                        <textarea name="faqAnswer" class="ckeditor form-control" id="ckeditor"></textarea>                        
                        <span id="error_ans"></span>                        
                    </div>
                    
                   
                    <ul class="list-inline">
                        <li>                                  
                            <input type="submit" name="saveFaqDetails" value="Add new" class="cm_blacbtn1">                            
                        </li>
                        <li>
                            <a href="<?php echo base_url()."BoFaq"; ?>" class="cm_blacbtn1">Cancel</a>
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



<script>

        $(document).ready(function() {
        

  $('#saveFaq').validate({
    rules:{
      faqQuestion:{
        required:true,
         
      },
      faqAnswer:{
        required:true,
      
      },

         
     
    },
    messages:{
       faqQuestion:{
        required:"Please enter question",
    
      },
      faqAnswer:{
        required:"Please enter to Answer",
        
      },

     
      
    }
  })



         });

</script>




</body>
</html>