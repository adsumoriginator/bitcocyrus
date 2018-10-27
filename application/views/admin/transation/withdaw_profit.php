<?php  $this->load->view("admin/header") ?>
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
                        <a href="<?php echo base_url()."BoFaq"; ?>">withdraw Profit</a>
                    </li>
                </ul>
                <div class="inn_content">
                    <!-- <form class="cm_frm1 verti_frm1"> -->
                    <?php
                        $atrtibute = array('class'=>'cm_frm1 verti_frm1');
                        echo form_open('',$atrtibute);
                    ?>                    
                        <div class="cm_head1">
                            <h3>List of withdraw Profit</h3>
                        </div>
                        <div class="cm_tablesc1 dep_tablesc mb-20">
                            <div class="dataTables_wrapper form-inline dt-bootstrap">
                                <?php $this->load->view('admin/common/flashMessage'); ?>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="cm_tableh3 table-responsive">


                       <center>                     

                      <div class="form-group">
                    <label for="gender1" class="col-sm-12 control-label">Change Currency:</label>
                    <div class="col-sm-12">
                          <Select class="form-control" name="currency" id="change_currency">       <?php 
                               foreach($currency->result() as $cur){
                                  ?>
                                 <option  <?php if($selected_currency==$cur->currency_symbol){?> selected="selected" <?php }?>      value="<?php echo $cur->currency_symbol?>"><?php echo $cur->currency_symbol ?></option>
                                  <?php
                                  
                                      }
                                ?>
                                                    </Select>


                      
                    </div>
            </div>          

            </center>









                                   
                                        
                                    <table id="faqData" class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>                                                                                   <th>#</th>
                                            <th>Name</th>
                                            <th>Withdraw Amount</th>
                                            <th>Profit prcentage</th>
                                            <th>Profit Amount</th>                   
                                            <th>Currency</th>                   
                                            <th>Date & Time</th>
                                                                              
                                  
                                               
                                            </tr>
                                        </thead>
                                       
                                        <tbody>
                                            <?php $ii = 0; 
                                            $total=0;
                                       
                                 foreach($withdraw->result() as $row) {

                                                $ii++;
                                            ?>
                                            <tr>
                                                <td><?php echo $ii; ?></td>
                                                
                                                 <td><?php echo $row->username?> </td>                                              
                                      
                                           
                                                 <td><?php echo $row->total_amount ?></td>


                                                 <td><?php echo $row->fee_percentage ?></td>
                                                 <td><?php echo $row->fee;

                                                 $total=$total+$row->fee;
                                                  ?></td>

                                                 <td><?php echo $row->currency     ?></td>
                                      
                                            
                                                 
                                                <td><?php echo $row->requested_time  ?></td>

                      
                                             </tr>
                                            <?php

                                        }


                                             ?>
                                        </tbody>
                                    </table>

                                    <Label>Total :  <?php echo number_format($total,8)." ".$row->currency ?> 

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


            $('#change_currency').on('change', function() {
               var currency=this.value;
                window.location.replace(currency);
            })

        });
    </script>
</body>
</html>