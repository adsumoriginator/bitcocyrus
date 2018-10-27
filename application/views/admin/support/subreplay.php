
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
                <li><a>Dashboard</a></li>
                <li><a >Subscriber message </a></li>
            </ul>
            <div class="inn_content">
                <?php
                    $atrtibute = array('role'=>'form','name'=>'saveFaq','id'=>'saveFaq','method'=>'post','onSubmit'=>'return checkAll();','enctype' =>'multipart/form-data');
                    echo form_open('',$atrtibute);
                ?>
                    <div class="cm_head1">
                        <h3>Subscriber message</h3>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 col-xs-6">
                            <label class="form-control-label">Email Address</label>
                            <span class="mand_field">*</span>
                            <input type="text" class="form-control"  required id="email" name="email" placeholder="Question" readonly value=<?php echo $subdata->email_id?>>
                        </div>
                    </div>


                              <div class="form-group row">
                        <div class="col-sm-6 col-xs-6">
                            <label class="form-control-label">Subject</label>
                            <span class="mand_field">*</span>
                            <input type="text" class="form-control"  required id="subject" name="subject" placeholder="subject" value="">
                        </div>
                    </div>

                    <div class="form-group row">
					<div class="col-sm-6 col-xs-6 message_box">
                        <label class="form-control-label">Send message</label>
                        <span class="mand_field">*</span>
                       
                        <textarea name="message" class="form-control ckeditor"></textarea>
               
                


                        <span id="error_ans"></span>                        
                    </div>
					</div>
					
					<div class="clearfix"></div>
                    
                   
                    <ul class="list-inline">
                        <li>                                  
                            <input type="submit" name="saveFaqDetails" value="Send" class="cm_blacbtn1">                            
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