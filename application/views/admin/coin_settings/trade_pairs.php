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
                        <a >Trade pair details</a>
                    </li>
                </ul>
                <div class="inn_content">
                    <!-- <form class="cm_frm1 verti_frm1"> -->
                    <?php
                        $atrtibute = array('class'=>'cm_frm1 verti_frm1');
                        echo form_open('',$atrtibute);
                    ?>                    
                        <div class="cm_head1">
                            <h3>List of Trade pairs</h3>
                        </div>
                        <div class="cm_tablesc1 dep_tablesc mb-20">
                            <div class="dataTables_wrapper form-inline dt-bootstrap">
                                <?php $this->load->view('admin/common/flashMessage'); ?>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="cm_tableh3 table-responsive">

                                               
                                        
                                    <table id="faqData" class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>                                                                                   <th>#</th>
                                                <th>Trade Pair</th>
                                                <th>Trade Buy Rate</th>
                                                <th>Trade Sell Rate</th>
                                                 <th>Minimum Trade Amount</th>
                                                <th>Action</th>
                                                <th>Fee</th>                               

                                               
                                            </tr>
                                        </thead>
                                       
                                        <tbody>
                                            <?php $ii = 0; 
                                       
                                                foreach($trade_pair->result() as $row) {
                                                $ii++;
                                            ?>
                                            <tr>
                                                <td><?php echo $ii; ?></td>
                                                                                              
                                                <td><?php echo $row->trade_pair ?></td>
                                           
                                                 <td><?php echo $row->buy_rate_value ?></td>

                                                 <td><?php echo $row->sell_rate_value     ?></td>
                                                  <td><?php echo $row->min_trade_amount     ?></td>
                                            

                                                    
                                              <td> 
                                                  <a href="<?php echo base_url(); ?>BoCoin_settings/edit_trade_pair/<?php echo insep_encode($row->id); ?>" title="Edit">
                                                                <img src="<?php echo base_url(); ?>assets/admin/images/edit-icon.png" title="Edit"  />
                                                            </a>


                                              </td> 



                                              <td>

                                                <a href="<?php echo base_url(); ?>BoCoin_settings/fees_list/<?php echo insep_encode($row->id); ?>" title="Edit">
                                                                <img src="<?php echo base_url(); ?>assets/admin/images/edit-icon.png" title="Edit"  />
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