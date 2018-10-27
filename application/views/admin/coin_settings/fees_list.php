<?php $this->load->view("admin/header") ?>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php $this->load->view('admin/common/header'); ?>
        <?php $this->load->view('admin/common/sidebar'); ?>
        <div class="content-wrapper">
            <section class="content">
                <ul class="breadcrumb cm_breadcrumb">
                        <li><a href=""> Dashboard </a></li>

                <li>
                 Trade pair details </li>
                 <li>
                  Trade Fee list- <?php echo $trade_pair->trade_pair ?> 

                  </li>
                  <li>

                   Manage trade trade fee -<?php echo $trade_pair->trade_pair ?></a></li>
                </ul>
                <div class="inn_content">
                    <!-- <form class="cm_frm1 verti_frm1"> -->
                    <?php
                        $atrtibute = array('class'=>'cm_frm1 verti_frm1');
                        echo form_open('',$atrtibute);
                    ?>                    
                        <div class="cm_head1">
                            <h3>List of Trade Fees - <?php echo $trade_pair->trade_pair ?></h3>
                        </div>
                        <div class="cm_tablesc1 dep_tablesc mb-20">
                            <div class="dataTables_wrapper form-inline dt-bootstrap">
                                <?php $this->load->view('admin/common/flashMessage'); ?>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="cm_tableh3 table-responsive">



                                     <a href="<?php echo base_url() ?>/BoCoin_settings/add_pair_fees/<?php echo insep_encode($this->uri->segment(3)) ?>">Add New </a> 
                                        
                                    <table id="faqData" class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>                                                                                   <th>#</th>
                                            <th>From Volume</th>
                                            <th>To Volume</th>
                                            <th>Maker</th>
                                            <th>Taker</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                                                              

                                               
                                            </tr>
                                        </thead>
                                       
                                        <tbody>
                                            <?php $ii = 0; 
                                       
                                                foreach($trade_fees->result() as $row) {
                                                $ii++;
                                            ?>
                                            <tr>
                                                <td><?php echo $ii; ?></td>
                                                                                              
                                                <td><?php echo $row->from_volume ?></td>
                                           
                                                 <td><?php echo $row->to_volume ?></td>

                                                 <td><?php echo $row->maker     ?></td>
                                                  <td><?php echo $row->taker  ?></td>
                                            
                                                   <td><?php 
                                                   if( $row->status==1){ ?>

                                                    <label class="btn btn-success btn-sm">Active</label>

                                                   <?php }else{ ?>
                                                    <label class="btn btn-danger btn-sm">In-Active</label>

                                                  <?php } ?>

                                                     </td>
                                                    
                                              <td> 
                                                  <a href="<?php echo base_url(); ?>BoCoin_settings/edit_trade_fee/<?php echo insep_encode($row->id); ?>" title="Edit">
                                                                <img src="<?php echo base_url(); ?>assets/admin/images/edit-icon.png" title="Edit"  />
                                                            </a>

                         <a href="<?php echo base_url(); ?>BoCoin_settings/status_trade_fee/<?php echo insep_encode($row->id); ?>" title="Edit">
                            <img src="<?php echo base_url(); ?>assets/admin/images/status.png" title="Edit"  />

                                              </a>

                                                                           

                <a href="<?php echo base_url(); ?>BoCoin_settings/delete_trade_fee/<?php echo insep_encode($row->id); ?>" title="Edit">                                        <img src="<?php echo base_url(); ?>assets/admin/images/delete-icon.png" title="Edit"  />
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