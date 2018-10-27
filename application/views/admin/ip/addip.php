
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
                <li><a href="<?php echo base_url(); ?>BoFaq">Admin Ip management </a></li>
            </ul>
            <div class="inn_content">
                <?php
                    $atrtibute = array('role'=>'form','name'=>'saveFaq','id'=>'saveFaq','method'=>'post','onSubmit'=>'return checkAll();','enctype' =>'multipart/form-data');
                    echo form_open('',$atrtibute);
                ?>
                    <div class="cm_head1">
                        <h3>Add IP</h3>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 col-xs-12">
                            <label class="form-control-label">Enter Ip address</label>
                            <span class="mand_field">*</span>
                            <input type="text" class="form-control" id="op" name="ip" placeholder="Ip address">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Status</label>
                        <span class="mand_field">*</span>
                       
                        <select name="status" class="form-control"> 
                         <option value="1">Active<option>
                         <option value="2">In-Active<option>
                        </select>    

                        <span id="error_ans"></span>                        
                    </div>
                    
                   
                    <ul class="list-inline">
                        <li>                                  
                            <input type="submit" name="save" value="Add new" class="cm_blacbtn1">                            
                        </li>
                        <li>
                          
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
      ip:{
        required:true,
         
      },
      

         
     
    },
    messages:{
       ip:{
        required:"Enter ip address",
    
      },

     
      
    }
  })



         });

</script>




</body>
</html>