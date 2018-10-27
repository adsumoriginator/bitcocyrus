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
                        <a >Trade notification</a>
                    </li>
                </ul>
                <div class="inn_content">
                    <!-- <form class="cm_frm1 verti_frm1"> -->
                    <?php
                        $atrtibute = array('class'=>'cm_frm1 verti_frm1');
                        echo form_open('',$atrtibute);
                    ?>                    
                        <div class="cm_head1">
                            <h3>List of Trade notification</h3>
                        </div>
                        <div class="cm_tablesc1 dep_tablesc mb-20">
                            <div class="dataTables_wrapper form-inline dt-bootstrap">
                                <?php $this->load->view('admin/common/flashMessage'); ?>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="cm_tableh3 table-responsive">

                                    <a class="cm_blacbtn1" href="<?php echo base_url()?>bocms/add_notification">Add new</a>

                                    <table id="faqData" class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Notification</th>
                                        
                                                <th>Status</th>   
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                            <?php $ii = 0; 
                                          
                                                foreach ($notification->result() as $row) { $ii++;
                                            ?>
                                            <tr>
                                                <td><?php echo $ii; ?></td>
                                                <td><?php echo $row->notification; ?></td>
                                           
                                                <td>
                                                <?php if($row->status == "Active") { ?>
                                                    <label class="btn btn-success btn-sm">Active</label>
                                                <?php }
                                                else { ?>
                                                    <label class="btn btn-danger btn-sm">Inactive</label>
                                                <?php } ?>
                                                </td>                                               
                                                        <td>
                                                            <?php /* <a href="#" class="userRemove">
                                                                <img src="<?php echo base_url(); ?>assets/admin/images/remove-user-icon.png" title="Remove" />
                                                            </a> */ ?>
                                                            <a href="<?php echo base_url(); ?>bocms/edit_notification/<?php echo $row->id; ?>" title="Edit">
                                                                <img src="<?php echo base_url(); ?>assets/admin/images/edit-icon.png" title="Edit"  />
                                                            </a>
                                                            <a title="Delete" href="<?php echo base_url(); ?>bocms/deletenotification/<?php echo $row->id; ?>"onclick="return confirm('Are you sure want to delete ?');">
                                                                <img src="<?php echo base_url(); ?>assets/admin/images/delete-icon.png" title="Delete"  />
                                                            </a>
                                                        </td>

<?php /*                                                 <td>
<a title="Edit" href="<?php echo base_url(); ?>BoFaq/editFaq/<?php echo md5($value->faq_id); ?>">
<i class="fa fa-edit"></i>
</a>&nbsp;
<a title="Delete" href="<?php echo base_url(); ?>BoFaq/deleteFaq/<?php echo md5($value->faq_id); ?>"onclick="return confirm('Are you sure want to delete ?');"><i class="fa fa-trash-o"></i></a>
</td> */ ?>
                                            </tr>
                                            <?php }  ?>
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