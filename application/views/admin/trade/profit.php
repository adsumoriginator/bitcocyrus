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
                        <a >Trade Profit</a>
                    </li>
                </ul>
                <div class="inn_content">
                    <!-- <form class="cm_frm1 verti_frm1"> -->
                    <?php
                        $atrtibute = array('class'=>'cm_frm1 verti_frm1');
                        echo form_open('',$atrtibute);
                    ?>                    
                        <div class="cm_head1">
                            <h3>Trade Profit</h3>
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
                                                <th>#</th>                                                             
                                                <th>Username</th>
                                                <th>Type</th>
                                                <th>Currency Name</th>
                                                <th>Profit Amount</th>             
                                                <th>Date & Time</th>
                                             
                                            </tr>
                                        </thead>
                                       
                                        <tbody>
                                        <?php
                                            if ($profit->num_rows() > 0) {
                                    if($this->uri->segment(4)!=''){ $i = $this->uri->segment(4)+1; }else { $i = 1; }
                                    foreach($profit->result() as $result) {
                                        if($result->currency_type=='fiat')
                                        {
                                            $currency_name = getfiatcurrency($result->currency);
                                        }
                                        else
                                        {
                                            $currency_name = getcryptocurrency($result->currency);
                                        }
                                        echo '<tr>';
                                        echo '<td>' . $i . '</td>';
                                        echo '<td>' . $result->username . '</td>';
                                        echo '<td>' . $result->type . '</td>';
                                        echo '<td>' . $currency_name . '</td>';
                                        echo '<td>' . $result->profit_amount . '</td>';
                               
                                        echo '<td>' . $result->datetime . '</td>';
                                        echo '</tr>';
                                        $i++;
                                    }                   
                                } else {
                                    echo '<tr>';
                                    echo '<td colspan="8">' . 'No Records Found!!' . '</td>';
                                    echo '</tr>';
                                }
                                ?>
                                    </tbody>
                                </table>
                                <?php if(isset($_GET['search_string']) && !empty($_GET['search_string'])){ }else { ?>
                                    <ul class="pagination">
                                     <?php echo $this->pagination->create_links(); ?>
                                    </ul>
                                <?php } ?>

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