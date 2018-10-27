<?php $this->load->view("admin/header") ?>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php $this->load->view('admin/common/header'); ?>
        <?php $this->load->view('admin/common/sidebar'); ?>
        <div class="content-wrapper">
            <section class="content">
                <ul class="breadcrumb cm_breadcrumb">
                    <li><a href="<?php echo base_url()."BoDashboard"; ?>">Dashboard</a></li>
                    <li>Currency Details</li>
                </ul>
                <div class="inn_content">
                    <!-- <form class="cm_frm1 verti_frm1"> -->
                    <?php
                        $atrtibute = array('class'=>'cm_frm1 verti_frm1');
                        echo form_open('',$atrtibute);
                    ?>                    
					<div class="cm_head1"><h3>Currency details</h3></div>
					<div class="cm_tablesc1 dep_tablesc mb-20">
						<a class="cm_blacbtn1" href="<?php echo base_url()."BoCoin_settings/add_coin"; ?>">Add new</a>
						<div class="dataTables_wrapper form-inline dt-bootstrap">
							<?php $this->load->view('admin/common/flashMessage'); ?>
							<div class="row">
								<div class="col-sm-12">
									<div class="cm_tableh3 table-responsive">
										<table id="faqData" class="table table-striped table-bordered table-hover">
											<thead>
												<tr>
													<th>#</th>
													<th>Currency Name</th>
													<th>Currency Code</th>
													<th>Minimum Withdaw</th>
													<th>Maximum Withdaw </th>
													<th>Withdraw fee</th>
													<th>Action</th>											   
												</tr>
											</thead>
											<tbody>
												<?php 
													$ii = 0;
													foreach($currency_settings->result() as $row) {
													$ii++;
												?>
												<tr>
													<td><?php echo $ii; ?></td>																								  
													<td><?php echo $row->currency_name ?></td>											   
													<td><?php echo $row->currency_symbol ?></td>
													<td><?php echo $row->min_withdraw_limit ?></td>
													<td><?php echo $row->max_withdraw_limit ?></td>
													<td><?php echo $row->withdraw_fees  ?></td>														
													<td> 
														<a href="<?php echo base_url(); ?>BoCoin_settings/edit_coin/<?php echo insep_encode($row->id); ?>" title="Edit">
															<img src="<?php echo base_url(); ?>assets/admin/images/edit-icon.png" title="Edit"  />
														</a>
													</td>
												</tr>
												<?php } ?>
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
