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
                        <a >Manage wallet</a>
                    </li>
                </ul>
                <div class="inn_content">
                    <!-- <form class="cm_frm1 verti_frm1"> -->
                    <?php
                        $atrtibute = array('class'=>'cm_frm1 verti_frm1');
                        echo form_open('',$atrtibute);
                    ?>                    
                        <div class="cm_head1">
                            <h3>List of user wallet</h3>
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
                                                <th>User Name</th> 
                                                <th>Last Login IP</th>                                                
                                                <th>Balance</th>

                                                <th>Address</th>
                                            </tr>
                                        </thead>
                                       
                                        <tbody>
                                            <?php $ii = 0; 
                                            if($user_details->num_rows() >0) {
                                                foreach ($user_details->result() as $value) { $ii++;
                                            ?>
                                            <tr>
                                                <td><?php echo $ii; ?></td>
                                                <td><?php echo $value->username; ?></td>
                                                <td><?php echo $value->IP; ?></td>
                                                <td> 
													<a href="<?php echo base_url(); ?>BoUser/view_balance/<?php echo insep_encode($value->user_id); ?>" title="Edit">
														<img src="<?php echo base_url(); ?>assets/admin/images/edit-icon.png" title="Edit"  />
													</a>
                                                </td>
												<td>
                                                   <a href="<?php echo base_url(); ?>BoUser/view_address/<?php echo insep_encode($value->user_id); ?>" title="Edit">
                                                                <img src="<?php echo base_url(); ?>assets/admin/images/edit-icon.png" title="Edit"  />
                                                            </a>

                                                   </td>



                            </tr>
                                            <?php } } ?>
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
    </div>
   <?php $this->load->view("admin/footer"); ?>

    <script type="text/javascript">
        $(document).ready(function () {
        
            $('#faqData').dataTable();
        });
    </script>
</body>
</html>