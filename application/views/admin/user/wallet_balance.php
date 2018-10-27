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
                        <a href="<?php echo base_url()."BoUser/user_wallet"; ?>">Manage wallet</a>
                        </li>
                         <li>

                          <a>User Balance</a>
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
                                    <div class="row wUsrNm">           
                                     <div class="col-sm-12 col-xs-12 cls_resp50">
                                <label class="form-control-label">User Name</label>
                                <input type="text" readonly class="form-control" id="username" name="username" value="<?php echo $user_data->username;?>">
                              </div>
                              </div>
           
                                        
                                    <table id="faqData" class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                             
                                    
                                                <th>Currency</th> 
                                               
                                                <th>Balance</th>

                                               
                                            </tr>
                                        </thead>
                                       
                                        <tbody>
                                            <?php $ii = 0; 
                                       
                                                foreach($balance->result() as $key => $value) {
                                                if($key!="user_id" && $key!="id" ){    
                                                $ii++;      
                                            ?>
                                            <tr>
                                                <td><?php echo $ii; ?></td>
                                                                                              
                                                <td><?php echo $value->currency_symbol; ?></td>
                                                 <td><?php echo $value->balance; ?></td>




                            </tr>
                                            <?php } 

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