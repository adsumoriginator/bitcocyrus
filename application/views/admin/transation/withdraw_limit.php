
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
                <li><a >Withdraw limit settings </a></li>
            </ul>
            <div class="inn_content">






                <?php
                    $atrtibute = array('role'=>'form','name'=>'saveFaq','id'=>'saveFaq','method'=>'post','onSubmit'=>'return checkAll();','enctype' =>'multipart/form-data');
                    echo form_open('',$atrtibute);
                ?>
                    <div class="cm_head1">
                        <h3>Withdraw limit settings</h3>
                    </div>
                    <div class="form-group row">
                          <?php $this->load->view('admin/common/flashMessage'); ?>

                    
                        <div class="col-sm-12 col-xs-12">
                            <label class="form-control-label">Maximum withdraw limit per day</label>
                            <span class="mand_field">*</span>
                            <input type="text" class="form-control" id="commission" name="withdraw_limit" placeholder="commission" value="<?php echo $withdraw_limit ?>">
                        </div>
                    </div>
                 
                    <ul class="list-inline">
                        <li>                                  
                            <input type="submit" name="Update" value="Update" class="cm_blacbtn1">                            
                        </li>
                      
                    </ul>
                    
                 
                <?php echo form_close(); ?>
            </div>






        </section>
    </div>








</div>


<?php
$this->load->view("admin/footer");
?>



<script>

        $(document).ready(function() {
        

  $('#saveFaq').validate({
    rules:{
      withdraw_limit:{
        required:true,
         number: true
         
      },
 
         
     
    },
    messages:{
       withdraw_limit:{
        required:"Please amount",
        number:"Please enter valid amount" 
    
      },
      
     
      
    }
  })



         });

</script>




</body>
</html>