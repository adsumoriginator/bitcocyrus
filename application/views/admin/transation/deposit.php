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
                        <a >Deposit list</a>
                    </li>
                </ul>
                <div class="inn_content">
                  
                    <?php
                        $atrtibute = array('class'=>'cm_frm1 verti_frm1');
                        echo form_open('',$atrtibute);
                    ?>                    
                        <div class="cm_head1">
                            <h3>List of Deposits</h3>
                        </div>
                        <div class="cm_tablesc1 dep_tablesc mb-20">
                            <div class="dataTables_wrapper form-inline dt-bootstrap">
                                <?php $this->load->view('admin/common/flashMessage'); ?>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="cm_tableh3 table-responsive">

                          
                                        
                                    <table id="faqData" class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>                                                       <th>#</th>
                                            <th>Name</th>
                                            <th>Amount</th>
                                            <th>Currency</th>
                                            <th>Status</th>
                                            <th>Date & Time</th>
                                                                              
                                            <th>View</th>
                                               
                                            </tr>
                                        </thead>
                                       
                                        <tbody>
                                            <?php $ii = 0; 
                                       
                                 foreach($deposits->result() as $row) {

                                              
                                                $ii++;
                                            ?>
                                            <tr>
                                                <td><?php echo $ii; ?></td>
                                                                                              
                                                <td><?php echo $row->username ?></td>
                                           
                                                 <td><?php echo $row->total_amount ?></td>

                                                 <td><?php echo $row->currency     ?></td>
                                                  <td><?php echo $row->status  ?></td>
                                            
                                                 
                                                <td><?php echo $row->requested_time  ?></td>

                                                  <td>
                                                      
                            <a title="Change user status" href="<?php echo base_url(); ?>BoAdmin_Transation/view_deposit_detail/<?php echo insep_encode($row->id); ?>"">
                                <img src="<?php echo base_url(); ?>assets/admin/images/eye.png" title="View details"  />
                                                            </a>

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
</body>
</html>