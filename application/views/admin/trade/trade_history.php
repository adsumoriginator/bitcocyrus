<?php $this->load->view("admin/header") ?>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php $this->load->view('admin/common/header'); ?>
        <?php $this->load->view('admin/common/sidebar'); ?>
        <div class="content-wrapper">
            <section class="content">
                <ul class="breadcrumb cm_breadcrumb">                    <li>
                        <a href="<?php echo base_url()."BoDashboard"; ?>">Dashboard</a>
                    </li>
                    <li>
                        <a >Trade history</a>
                    </li>
                </ul>
                <div class="inn_content">
                    <!-- <form class="cm_frm1 verti_frm1"> -->
                    <?php
                        $atrtibute = array('class'=>'cm_frm1 verti_frm1');
                        echo form_open('',$atrtibute);
                    ?>                    
                        <div class="cm_head1">
                            <h3>Trade history</h3>
                        </div>
                        <div class="cm_tablesc1 dep_tablesc mb-20">
                            <div class="dataTables_wrapper form-inline dt-bootstrap">
                                <?php $this->load->view('admin/common/flashMessage'); ?>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="cm_tableh3 table-responsive">
                                    <table id="faqData" class="table table-striped table-bordered table-hover">
                                     <thead>
                                        <tr>
                                        <th class="text-center">S.No</th>
                                        <th class="text-center">Date & Time</th>
                                        <th class="text-center">Username</th>
                                        <th class="text-center">Pair</th>
                                        <th class="text-center">Amount</th>
                                        <th class="text-center">Price</th>
                                        <th class="text-center">Fee</th>
                                        <th class="text-center">Total</th>
                                        <th class="text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody style="text-align: center;">
                                    <?php

                                    $total=0;
                                if ($trade_history->num_rows() > 0) {
                                    if($this->uri->segment(4)!=''){ $i = $this->uri->segment(4)+1; }else { $i = 1; }
                                    foreach($trade_history->result() as $result) {
                                       echo '<tr>';
                                        echo '<td>' . $i . '</td>';
                                        echo '<td>' . $result->datetime . '</td>';
                                        echo '<td>' . $result->username . '</td>';
                                        echo '<td>' . $result->to_currency_symbol.'/'.$result->from_currency_symbol . '</td>';
                                        echo '<td>' . to_decimal($result->Amount,8) . '</td>';
                                        echo '<td>' . to_decimal($result->Price,8) . '</td>';
                                        echo '<td>' . to_decimal($result->Fee,8) . '</td>';
                                        echo '<td>' . to_decimal($result->Total,8) . '</td>';
                                        echo '<td>' . ucfirst($result->status) . '</td>';
                                        echo '</tr>';
                                        $i++;

                                        $total=$total+$result->to_currency_symbol;
                                    }                   
                                }
                                else {
                                    echo '<tr>';
                                    echo '<td colspan="9">' . 'No Records Found!!' . '</td>';
                                    echo '</tr>';
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