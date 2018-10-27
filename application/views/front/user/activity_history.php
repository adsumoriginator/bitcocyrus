<?php $this->load->view('front/basic/header_inner');?>

<section class="main_innerpage">
<div class="container-fluid">
	<div class="pro_section">
		<div class="pro_tit"><h3> LOGIN HISTRY</h3></div>

		<div class="pro_line"></div>

		<div class="container exchange_main">
		<div class="row">
            <div class="col-md-12">
                <div class="deposit_coin bg_sec">

				<h2 class="title_inner mb-4">Login History </h2>

				 <table id="" class="table table-bordered example" width="100%" cellspacing="0">
						<thead style="background: #1c3049; color: white">
							<tr>
								<th>S.No </th>
								<th>Date & Time</th>
								<th>IP Address </th>
								<th>OS </th>
								<th>Browser </th>
					   
							</tr>
						</thead>
					   
						<tbody>

						<?php 
						$i=0;
						foreach($activity->result() as $row){
						   $i++;
						?>

							<tr>
								<td><?php echo $i?> </td>
								<td><?php echo  $row->date ?></td>
								<td><?php echo $row->ip_address ?> </td>
								<td><?php echo $row->os_name ?></td>
								<td><?php echo $row->browser_name ?> </td>
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
</div>
</section>

<?php $this->load->view('front/basic/footer_inner');?>