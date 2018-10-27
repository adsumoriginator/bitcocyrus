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
                        <a >Referal commission</a>
                    </li>
                </ul>
                <div class="inn_content">
                    <!-- <form class="cm_frm1 verti_frm1"> -->
                    <?php
                        $atrtibute = array('class'=>'cm_frm1 verti_frm1');
                        echo form_open('',$atrtibute);
                    ?>                    
                        <div class="cm_head1">
                            <h3>Referal commission</h3>
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
                <th>S.No </th>
                <th>Username</th>
                 
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

        ?>  <tr>
                <td><?php echo $i; ?> </td>
                <td><?php echo $wrow->username ?> </td>
                <td><?php echo $wrow->refer_user ?> </td>
                <td><?php echo $wrow->currency ?> </td>
                <td><?php echo $wrow->commission_amount ?> </td>
               <td><?php echo $wrow->timedate ?> </td>
               
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