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
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/style_dashbard.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/dash_responsive.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/font-awesome.min.css">
    <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>assets/admin/css/bootstrap.min.css" rel="stylesheet">
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
        <?php $this->load->view('admin/common/header'); ?>
        <?php $this->load->view('admin/common/sidebar'); ?>
        <div class="content-wrapper">
            <section class="content">
                <ul class="breadcrumb cm_breadcrumb">
                    <li>
                        <a href="<?php echo base_url()."BoDashboard"; ?>">Dashboard</a>
                    </li>
                    <li>
                        <a>Manage Email Templates</a>
                    </li>
                </ul>
                <div class="inn_content">
                    <!-- <form class="cm_frm1 verti_frm1"> -->
                        <?php
                            $atrtibute = array('class'=>'cm_frm1 verti_frm1');
                            echo form_open('',$atrtibute);
                        ?>                    
                        <div class="cm_head1">
                            <h3>List of Email Templates</h3>
                        </div>
                        <div class="cm_tablesc1 dep_tablesc mb-20">
                            <div class="dataTables_wrapper form-inline dt-bootstrap">
                                <?php $this->load->view('admin/common/flashMessage'); ?>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="cm_tableh3 table-responsive">
                                            <table id="emailTemplateData" class="table m-0" style="border: 1px solid #cccccc;">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Name</th>
                                                        <th>Mail subject</th>
                                                        <th>Last update date</th>
                                                        <!-- <th>Status</th> -->
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                              
                                                <tbody>
                                                    <?php $ii = 0; 
                                                    if(isset($getMailTemplateDetails) && !empty($getMailTemplateDetails)) { foreach ($getMailTemplateDetails as $value) { $ii++;
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $ii; ?></td>
                                                        <td><?php echo $value->name; ?></td>
                                                        <td><?php echo $value->subject; ?></td>
                                                        <td><?php echo $value->created; ?></td>
                                                        <?php /* <td>
                                                        <?php if($value->status == 1) { ?>
                                                            <label class="btn btn-success btn-sm">Active</label>
                                                        <?php }
                                                        else { ?>
                                                            <label class="btn btn-danger btn-sm">Inactive</label>
                                                        <?php } ?>
                                                        </td> */ ?>
                                                        <td>
                                                            <?php /* <a href="#" class="userRemove">
                                                                <img src="<?php echo base_url(); ?>assets/admin/images/remove-user-icon.png" title="Remove" />
                                                            </a> */ ?>
                                                            <a href="<?php echo base_url(); ?>BoEmailTemplate/editEmailTemplate/<?php echo md5($value->id); ?>" class="editUser" title="Edit">
                                                                <img src="<?php echo base_url(); ?>assets/admin/images/edit-icon.png" title="Edit"  />
                                                            </a>
                                                            <?php /* <a href="#" class="deleteUser">
                                                                <img src="<?php echo base_url(); ?>assets/admin/images/delete-icon.png" title="Delete"  />
                                                            </a> */ ?>
                                                        </td>
                                                    </tr>
                                                    <?php } } else { ?>
                                                    <tr>
                                                        <td colspan="3"><center>No email template found</center></td>
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

    <script src="<?php echo base_url(); ?>assets/admin/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/admin/js/dashboard.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/admin/js/lc_switch.js" type="text/javascript"></script>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/lc_switch.css">
    <?php $this->load->view('admin/common/csrf'); ?>
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
            $('#emailTemplateData').dataTable();
        });
    </script>
    <script type="text/javascript">
    setInterval(function() {
      $.ajax({
        url: "<?php echo base_url();?>BoNotification/viewnotificationcount",
        type: "GET",
        processData:false,
        success: function(data){
          $("#notification-count").show();
          $("#notification-count").html(data);  
        },
        error: function(){}           
      });
    }, 6000);

    function viewnotification() {
      $.ajax({
        url: "<?php echo base_url();?>BoNotification/viewnotification",
        type: "GET",
        processData:false,
        success: function(data){
         $("#notification-count").remove();  
         $("#listnotification").toggle();$("#listnotification").html(data);        
        },
        error: function(){}           
      });
    }
    </script>    
</body>
</html>