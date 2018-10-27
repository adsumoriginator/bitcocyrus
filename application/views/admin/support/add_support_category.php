
<?php
$this->load->view("admin/header");
?>
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
                <li><a href="<?php echo base_url()."BoSupport_ticket/support_category"; ?>" >Support category </a></li>

                     <li><a >Add Support category </a></li>
            </ul>
            <div class="inn_content">
                <?php
                    $atrtibute = array('role'=>'form','name'=>'saveFaq','id'=>'saveFaq','method'=>'post','onSubmit'=>'return checkAll();','enctype' =>'multipart/form-data');
                    echo form_open('',$atrtibute);
                ?>
                    <div class="cm_head1">
                        <h3>Support category</h3>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 col-xs-6">
                            <label class="form-control-label">Category Name</label>
                            <span class="mand_field">*</span>
                            <input type="text" class="form-control"  required id="category_name" name="category_name" placeholder="Question">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Answer</label>
                        <span class="mand_field">*</span>
                       
                        <select name="status"> 
                        <option value="1">Active</option>
                        <option value="0">In-Active</option>



                 
                        </select>


                        <span id="error_ans"></span>                        
                    </div>
                    
                   
                    <ul class="list-inline">
                        <li>                                  
                            <input type="submit" name="saveFaqDetails" value="Add new" class="cm_blacbtn1">                            
                        </li>
                        <li>
                           
                        </li>
                    </ul>
                <?php echo form_close(); ?>
            </div>
        </section>
    </div>
  <!-- <footer class="main-footer"> Copyright © 2017 WCX Coin. All rights reserved. </footer>-->
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

<?php
$this->load->view("admin/footer");
?>
</body>
</html>