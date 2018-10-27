
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
                <li><a >Referal Commission </a></li>
            </ul>
            <div class="inn_content">

               <?php
                    $atrtibute = array('role'=>'form','name'=>'saveFaq','id'=>'saveFaq','method'=>'post','onSubmit'=>'return checkAll();','enctype' =>'multipart/form-data');
                    echo form_open('',$atrtibute);
                ?>
                    <div class="cm_head1">
                        <h3>Referal commission</h3>
                    </div>
                    <div class="form-group row">
                          <?php $this->load->view('admin/common/flashMessage'); ?>

                    
                        <div class="col-sm-12 col-xs-12">
                            <label class="form-control-label">Enter Commission(%)</label>
                            <span class="mand_field">*</span>
                            <input type="text" class="form-control" id="commission" name="commission" placeholder="commission" value="<?php echo $commission ?>">
                        </div>
                    </div>
                 
                    
                   
                    <ul class="list-inline">
                        <li>                                  
                            <input type="submit" name="Update" value="Update" class="cm_blacbtn1">                            
                        </li>
                      
                    </ul>
                <?php echo form_close(); ?>
            </div>





   <div class="cm_tablesc1 dep_tablesc mb-20">
                        <div class="dataTables_wrapper form-inline dt-bootstrap">
                         
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="cm_tableh3 table-responsive">
                                      <h5>Previous  Commissions</h5>
                                        <table id="faqData" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>commission</th>
                                                    <th>Date and Time</th>
                                                    
                                                </tr>
                                            </thead>
                                            
                                            <tbody>
                                                <?php $ii = 0;
                                                

                                                if($referral_commission->num_rows() >0 ){


                                                foreach ($referral_commission->result() as $value) { 



                                                    $ii++;
                                                ?>
                                                <tr>
                                                    <td><?php echo $ii; ?></td>
                                                    <td><?php echo $value->commission; ?>%</td>
                                                    <td><?php echo $value->datetime; ?></td>
                                               
                                                   
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
      commission:{
        required:true,
         number: true
         
      },
 
         
     
    },
    messages:{
       commission:{
        required:"Please amount",
        number:"Please enter valid amount" 
    
      },
      
     
      
    }
  })



         });

</script>




</body>
</html>