<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title> <?php echo $title; ?> </title>
    <meta name="description" content="<?php echo $description; ?>">
    <meta name="keywords" content="<?php echo $keywords; ?>">
    <link rel="stylesheet" href="<?php echo base_url(); ?>admin_assets/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>admin_assets/css/style_dashbard.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>admin_assets/css/dash_responsive.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>admin_assets/css/font-awesome.min.css">
    <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>admin_assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php $this->load->view('admin_wallet/common/header'); ?>
        <?php $this->load->view('admin_wallet/common/sidebar'); ?>
        <div class="content-wrapper">
            <section class="content">
                <ul class="breadcrumb cm_breadcrumb">
                    <li><a href="<?php echo wallet_url()."BoDashboard"; ?>">Dashboard</a></li>
                    <li><a href="<?php echo wallet_url()."Bowithdraw/withdrawlist"; ?>">Manage Withdraw List</a></li>
                </ul>
                <div class="inn_content">
                    <form class="cm_frm1 verti_frm1">
                      <div class="cm_head1">
                        <h3>List of Withdraw Pages</h3>
                      </div>
                      <div class="cm_tablesc1 dep_tablesc mb-20">
                      
                        <div class="dataTables_wrapper form-inline dt-bootstrap">
                            <?php $this->load->view('admin/common/flashMessage'); ?>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="cm_tableh3 table-responsive">
                                        <table id="cmsData" class="table m-0" style="border: 1px solid #cccccc;">
                                            <thead>
                                                <tr>
                                                    <th>#</th> 
                                                    <th>Date & Time</th>
                                                    <th>To address</th>
                                                    <th>Amount</th>   
                                                    <th>Currency</th>   
                                                    <th>Transaction Id</th>   
                                                    <th>Status</th>   
                                                </tr>
                                            </thead>                                               
                                           
                                            <tbody>
                                                <?php $ii = 0; 
                                                if(isset($getcmsPages) && !empty($getcmsPages)) {
                                                   /* echo "<pre>";
                                                    print_r($getcmsPages);die;*/
                                                    foreach ($getcmsPages as $value) { 
                                                        $ii++;                                                      
                                                ?>
                                                <tr>
                                                    <td><?php echo $ii; ?></td>       
                                                    <td><?php echo $value->request_date." ".$value->request_time; ?></td>
                                                    <td><?php echo $value->to_address; ?></td>
                                                    <td><?php echo $value->askamount; ?></td>
                                                    <td><?php echo $value->currency; ?></td>
                                                    <td><?php echo $value->txn_id; ?></td>
                                                    <td>
                                                    <?php if($value->status == 'processing') { ?>
                                                        <label class="btn btn-warning btn-sm"><?php echo ucfirst($value->status); ?></label>
                                                    <?php }
                                                    else if($value->status == "Completed") { ?>
                                                       <label class="btn btn-success btn-sm"><?php echo ucfirst($value->status); ?></label>
                                                    <?php }else{ ?>
                                                       <label class="btn btn-danger btn-sm"><?php echo ucfirst($value->status); ?></label>
                                                    <?php } ?>
                                                    </td> 
                                                 
                                                </tr>
                                                <?php } } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </div>
      <!-- <footer class="main-footer"> Copyright © 2017 WCX Coin. All rights reserved. </footer>-->
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->

    <!-- datatable js start here -->
    <script language="JavaScript" src="https://code.jquery.com/jquery-1.11.1.min.js" type="text/javascript"></script>
    <script language="JavaScript" src="https://cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script language="JavaScript" src="https://cdn.datatables.net/plug-ins/3cfcc339e89/integration/bootstrap/3/dataTables.bootstrap.js" type="text/javascript"></script>
    <!-- datatable js end here -->

    <script src="<?php echo base_url(); ?>admin_assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>admin_assets/js/dashboard.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>admin_assets/js/lc_switch.js" type="text/javascript"></script>


    <link rel="stylesheet" href="<?php echo base_url(); ?>admin_assets/css/lc_switch.css">
    <script type="text/javascript">
    /*search menu click jquery starts*/
    $('.showresult').click(function(){
    $('.searc_drop').css('display','block');
    });
    /*search menu click jquery ends*/

    /*search menu close outside the container (i.e)., while clicking body starts*/
    $(document).mouseup(function(e)
    {
    var container = $(".searc_drop");
    // if the target of the click isn't the container nor a descendant of the container
    if (!container.is(e.target) && container.has(e.target).length === 0)
    {
     $('.searc_drop').css('display','none');
    }
    });
    /*search menu close outside the container (i.e)., while clicking body ends*/

    /*notification checkbox starts*/
    $(document).ready(function(e) {
    $('.setting_drp input').lc_switch();

    // triggered each time a field changes status
    $('body').delegate('.lcs_check', 'lcs-statuschange', function() {
    var status = ($(this).is(':checked')) ? 'checked' : 'unchecked';
    console.log('field changed status: '+ status );
    });

    // triggered each time a field is checked
    $('body').delegate('.lcs_check', 'lcs-on', function() {
    console.log('field is checked');
    });

    // triggered each time a is unchecked
    $('body').delegate('.lcs_check', 'lcs-off', function() {
    console.log('field is unchecked');
    });
    });
    /*notification checkbox ends*/
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#cmsData').dataTable();
        });
    </script>
</body>
</html>