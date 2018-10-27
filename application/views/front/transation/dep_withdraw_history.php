<?php $this->load->view('front/basic/header_inner');?>

<section class="main_innerpage">
	<div class="container-fluid">
		<div class="pro_section">
			<div class="pro_tit">
				<h3> TRANSACTION HISTROY
				<span> Account Status : Pending</span>
				<span><img src="images/sep.png" ></span>
				<span>Account Created On : 09/12/2017, 11:21:10 </span> </h3>
			</div>
			<?php $menu_seg= $this->uri->segment(3); ?>
			<div class="pro_line"></div>
			<div class="pro_box">
				<div class="container deposit_coin bg_sec">
					<div class="deposit_coin_inner mw-100">
                        <nav>
							<div class="nav nav-tabs text-center" id="nav-tab" role="tablist">
								<a href="" data-target="#1" aria-selected="true" role="tab" aria-controls="nav-home" data-toggle="tab" class="nav-item nav-link w-25 <?php if($menu_seg=="" || $menu_seg=="deposit"){?> active <?php } ?>">Deposit </a>
								<a href="" data-target="#2" aria-selected="false" role="tab" aria-controls="nav-profile" data-toggle="tab" data-toggle="tab" class="nav-item nav-link w-25 <?php if($menu_seg=="withdraw"){?> active <?php } ?>">Withdraw </a>
								<a href="" data-target="#3" aria-selected="false" role="tab" aria-controls="nav-profile" data-toggle="tab" data-toggle="tab" class="nav-item nav-link w-25 <?php if($menu_seg=="trade"){?> active <?php } ?>">Trade History</a>
								<a href="" data-target="#4" aria-selected="false" role="tab" aria-controls="nav-profile" data-toggle="tab" data-toggle="tab" class="nav-item nav-link w-25 ">Referance Transation </a>
							</div>
						</nav>
						
						<div class="tab-content buy_main" id="nav-tabContent">
							<div id="1" class="tab-pane fade  <?php if($menu_seg==""|| $menu_seg=="deposit"){?> active show <?php } ?>" role="tabpanel" aria-labelledby="nav-home-tab">
								<div class="selct_date">
                                    <div class="row">
                                        <div class="col-lg-8">
											<?php
											$atrtibute = array('role'=>'form','name'=>'dep','method'=>'post',"class"=>"form-inline form_history","id"=>"dep_from");
											$url= base_url()."transation/history/deposit"; 
											echo form_open($url,$atrtibute);
											?>
                                            <form class="form-inline form_history">
                                                <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                                    From date
                                                    <input type="text" class="form-control" placeholder="mm/dd/yyyy" id="dep_from_date" readonly name="dep_from_date"  value="<?php echo $dep_from_date ?>" >
                                                </div>
                                                <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                                    to date
                                                    <input type="text" class="form-control" placeholder="mm/dd/yyyy" id="dep_to" readonly name="dep_to_date" value="<?php echo $dep_to_date ?>" >
                                                </div>
												<button type="submit" class="btn btn-primary" name="dep_search" value="Search">search</button>
                                            </form>
                                        </div>
                                        <div class="col-lg-4">
                                            <ul class="list-inline float-right">
                                                <li class="list-inline-item">Export</li>
                                                <li class="list-inline-item">
                                                    <a target="_blank" class="btn btn-primary" href="<?php echo base_url() ?>transation/export_excel/1">
                                                        <span>
                                                            <i class="fa fa-file-excel-o"></i>
                                                        </span> Excel</a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a target="_blank" class="btn btn-primary" href="<?php echo base_url() ?>transation/export_pdf/<?php echo insep_encode(1) ?>">
                                                        <span>
                                                            <i class="fa fa-file-pdf-o"></i>
                                                        </span> PDF</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
								
								<table id="" class="table table-bordered example" width="100%" cellspacing="0">
									<thead style="background: #1c3049; color: white">
										<tr>
											<th>S.No </th>
											<th>Date & Time</th>
											<th>Currency </th>
											<th>Transaction ID </th>
											 <th>Deposit Amount</th>
											 <th>Action</th>
										</tr>
									</thead>
									
									<tbody>
										<?php
										
										$i=0;
										foreach($deposit->result() as $drow){
											$i++;
										?>

										<tr>
											<td><?php echo $i; ?> </td>
											<td><?php echo $drow->requested_time; ?></td>
											<td><?php echo $drow->currency; ?> </td>
											<td><?php echo $drow->transactionId; ?></td>
											<td><?php echo $drow->total_amount; ?> </td>
											<td><span class="org"><?php echo $drow->status; ?></span></td>
										</tr>
										
										<?php } ?>
									</tbody>
								</table>
							</div>
						
							<div id="2" class="tab-pane fade <?php if($menu_seg=="withdraw"){?> active show <?php } ?>" role="tabpanel" aria-labelledby="nav-profile-tab">
								<div class="selct_date">
                                    <div class="row">
                                        <div class="col-lg-8">
											<?php
											$atrtibute = array('role'=>'form','name'=>'dep','method'=>'post',"class"=>"form-inline form_history","id"=>"withdraw_from");
											$url= base_url()."transation/history/withdraw";    
											echo form_open($url,$atrtibute);
											?>
                                            <form class="form-inline form_history">
                                                <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                                    From date
													<input type="text" class="form-control" placeholder="mm/dd/yyyy" id="with_from" readonly name="with_from_date"  value="<?php echo $wthdraw_from_date?>" >
                                                </div>
                                                <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                                    to date
													<input type="text" class="form-control" placeholder="mm/dd/yyyy" id="with_to" readonly name="with_to_date" value="<?php echo $withdraw_to_date?>"  >
                                                </div>
												<button type="submit" class="btn btn-primary" name="with_search" value="Search">search</button>
                                            </form>
                                        </div>
                                        <div class="col-lg-4">
                                            <ul class="list-inline float-right">
                                                <li class="list-inline-item">Export</li>
                                                <li class="list-inline-item">
													<a target="_blank"  class="btn btn_primary"href="<?php echo base_url() ?>transation/export_excel/2">
                                                        <span>
                                                            <i class="fa fa-file-excel-o"></i>
                                                        </span> Excel</a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a class="btn btn-primary" href="<?php echo base_url() ?>transation/export_pdf/<?php echo insep_encode(2) ?>">
                                                        <span>
                                                            <i class="fa fa-file-pdf-o"></i>
                                                        </span> PDF</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
							
								<table id="" class="table table-bordered example" width="100%" cellspacing="0">
									<thead style="background: #1c3049; color: white">
										<tr>
											<th>S.No </th>
											<th>Date & Time</th>
											<th>Currency </th>
											<th>Transaction ID </th>
											<th>Withdraw Amount</th>
											<th>Fees</th>
											<th>Receive Amount</th>
											<th>Status</th>
										</tr>
									</thead>
								   
									<tbody>
										<?php
										$i=1;
										foreach($withdraw->result() as $wrow){
										?>

										<tr>
											<td><?php echo $i; ?> </td>
											<td><?php echo $wrow->requested_time; ?> </td>
											<td><?php echo $wrow->currency; ?> </td>
											<td><?php echo $wrow->transactionId; ?> </td>
											<td><?php echo $wrow->total_amount; ?> </td>
											<td><?php echo $wrow->fee_percentage; ?>%</td>
											 <td><?php echo $wrow->transfer_amount; ?></td>
											<td><span class="org"><?php echo $wrow->status; ?></span></td>
										</tr>
								 
										<?php $i++; } ?>
									</tbody>
								</table>
							</div>
							
							<div id="3" class="tab-pane fade <?php if($menu_seg=="trade"){?> active show <?php } ?>" role="tabpanel" aria-labelledby="nav-profile-tab">
								<div class="selct_date">
                                    <div class="row">
                                        <div class="col-lg-8">
											<?php
											$atrtibute = array('role'=>'form','name'=>'dep','method'=>'post',"class"=>"form-inline form_history","id"=>"trade_form");
											$url= base_url()."transation/history/trade";    
											echo form_open($url,$atrtibute);
											?>
                                            <form class="form-inline form_history">
                                                <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                                    From date
													<input type="text" class="form-control" placeholder="mm/dd/yyyy" readonly value="<?php echo $trade_from_date?>" name="trade_from_date" id="trade_from"  >
                                                </div>
                                                <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                                    to date
													<input type="text" class="form-control" placeholder="mm/dd/yyyy" value="<?php echo $trade_to_date?>" readonly name="trade_to_date"  id="trade_to">
                                                </div>
												<select class="custom-select" name="type">
													<option value="all">All</option>
													<option <?php if($select=="buy"){?> selected="selected"<?php }?> value="buy">Buy</option>
													<option <?php if($select=="sell"){?> selected="selected" <?php }?> value="sell">Sell</option>
                                                </select>
                                                <input type="submit" name="trade_search" class="btn btn-primary" value="Search"></input>
                                            </form>
                                        </div>
                                        <div class="col-lg-4">
                                            <ul class="list-inline float-right">
                                                <li class="list-inline-item">Export</li>
                                                <li class="list-inline-item">
													<a target="_blank"  class="btn btn_primary"href="<?php echo base_url() ?>transation/trade_export_excel/2">
                                                        <span>
                                                            <i class="fa fa-file-excel-o"></i>
                                                        </span> Excel</a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a class="btn btn-primary" href="<?php echo base_url() ?>transation/download_pdf_trade/pdf">
                                                        <span>
                                                            <i class="fa fa-file-pdf-o"></i>
                                                        </span> PDF</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
								
								<table id="" class="table table-bordered example" width="100%" cellspacing="0">
									<thead style="background: #1c3049; color: white">
										<tr>
											<th>S.No </th>
											<th>Date & Time</th>
											<th>Type </th>
											<th>Pair </th>
											 <th>Price</th>
											 <th>Amount </th>
											 <th>Status</th>
										</tr>
									</thead>
								   
									<tbody>
										<?php 
										$i=1;
										if($trade_history->num_rows() > 0){ 
										  foreach($trade_history->result() as $row){
										?>	
										 <tr>
											<td><?php echo $i ?> </td>
											<td><?php echo $row->datetime ?></td>
											<td><?php echo $row->Type ?> </td>
											<td> <?php echo $row->to_currency_symbol ?>/<?php echo $row->from_currency_symbol ?> </td>
											<td><?php echo number_format($row->Price,8) ?> </td>
											<td><?php echo number_format($row->Amount,8)?> </td>
											<?php
											if($row->status =="cancelled" || $row->status =="stoporder"){?>
											<td><span class="rdn"><?php  echo $row->status ?></span> </td>
											<?php }else{ ?>
										    <td><span class="grn"><?php  echo $row->status ?></span> </td>
											<?php } ?>
										</tr>
										<?php
											$i++;
										  }
										}
										?>
									</tbody>
								</table>
							</div>
							
							<div id="4" class="tab-pane fade ">
								<div class="selct_date">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <ul class="list-inline float-right">
                                                <li class="list-inline-item">Export</li>
                                                <li class="list-inline-item">
													<a target="_blank"  class="btn btn_primary"href="<?php echo base_url() ?>transation/reference_download">
                                                        <span>
                                                            <i class="fa fa-file-excel-o"></i>
                                                        </span> Excel</a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a class="btn btn-primary" href="<?php echo base_url() ?>transation/download_pdf_trade/<?php echo user_id() ?>/pdf">
                                                        <span>
                                                            <i class="fa fa-file-pdf-o"></i>
                                                        </span> PDF</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
								
								<table id="" class="table table-bordered example" width="100%" cellspacing="0">
									<thead style="background: #1c3049; color: white">
										<tr>
											<th>S.No </th>
											<th>Reference user</th>
											<th>Currency </th>
											<th>Reference amount </th>
											<th>Date Time</th>
										</tr>
									</thead>
								   
									<tbody>
									<?php
									$i=0;
									foreach($reference_commission->result() as $wrow){
										$i++;
									?>  
									<tr>
										<td><?php echo $i; ?> </td>
										<td><?php echo $wrow->refer_user ?> </td>
										<td><?php echo $wrow->currency ?> </td>
										<td><?php echo $wrow->commission_amount ?> </td>
										<td><?php echo $wrow->timedate ?> </td>									   
									</tr>
									<?php } ?>
									</tbody>
								</table>
							</div>							
						</div> 
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php $this->load->view('front/basic/footer_inner');?>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="assets/frontend/js/jquery.dataTables.min.js"></script>
<script src="assets/frontend/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url() ?>assets/admin/plugins/validate/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/script/transation.js"></script>
<script>
	$( function() {
		$("#dep_from_date").datepicker({ onSelect: function(date) { $("#dep_to").datepicker('option', 'minDate', date); } }); $("#dep_to").datepicker({});
		$("#with_from").datepicker({ onSelect: function(date) { $("#with_to").datepicker('option', 'minDate', date); } }); $("#with_to").datepicker({});
		$("#trade_from").datepicker({ onSelect: function(date) { $("#trade_to").datepicker('option', 'minDate', date); } }); $("#trade_to").datepicker({});
	});
	var max_withdraw_limit="0";
	var min_withdraw_limit="0";
</script>
