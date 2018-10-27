
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
                <li><a href="<?php echo base_url(); ?>BoDashboard">Dashboard</a></li>
                <li><a href="<?php echo base_url(); ?>subadmin">Sub admin </a></li>
            
                <li><a >Add admin </a></li>
            </ul>
            <div class="inn_content">
                <?php
                    $atrtibute = array('role'=>'form','name'=>'saveFaq','id'=>'saveFaq','method'=>'post','onSubmit'=>'return checkAll();','enctype' =>'multipart/form-data');
                    echo form_open('',$atrtibute);
                ?>
                    <div class="cm_head1">
                        <h3>Add Sub admin</h3>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 col-xs-6">
                            <label class="form-control-label">Username</label>
                            <span class="mand_field">*</span>
                            <input type="text" class="form-control" id="username" name="username" placeholder="username">
                        </div>
                    </div>


                             <div class="form-group row">
                        <div class="col-sm-6 col-xs-6">
                            <label class="form-control-label">Email Id</label>
                            <span class="mand_field">*</span>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Email Id">
                        </div>
                    </div>


                       <div class="form-group row">
                        <div class="col-sm-6 col-xs-6">
                            <label class="form-control-label"> Password</label>
                            <span class="mand_field">*</span>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        </div>
                    </div>


                       <div class="form-group row">
                        <div class="col-sm-6 col-xs-6">
                            <label class="form-control-label">Confirm Password</label>
                            <span class="mand_field">*</span>
                            <input type="password" class="form-control" id="confirm_Password" name="confirm_Password" placeholder="Confirm password">
                        </div>
                    </div>

                <div class="form-group row clearfix">
              <div class="col-sm-4 col-xs-12 cls_resp50">
               <label class="form-control-label">Pattern</label>
                <div id="patternContainer"></div>
                   <input type="hidden" value="" name="patterncode" id="patterncode" />
                </div>
                </div>
              




                       <div class="form-group row">
                        <div class="col-sm-6 col-xs-6">
                            <label class="form-control-label">User details</label>
                            <span class="mand_field">*</span>
                           <select name="userdetaisls" class="form-control valid" >
                           <option value="0">Not allow</option>.
                            <option value="1">Allow</option>
                            </select>
                        </div>
                    </div>



                      <div class="form-group row">
                        <div class="col-sm-6 col-xs-6">
                            <label class="form-control-label">TFA</label>
                            <span class="mand_field">*</span>
                           <select name="tfa" class="form-control valid" >
                           <option value="0">Not allow</option>.
                            <option value="1">Allow</option>
                            </select>
                        </div>
                    </div>
             

                 <div class="form-group row">
                        <div class="col-sm-6 col-xs-6">
                            <label class="form-control-label">Currency Details</label>
                            <span class="mand_field">*</span>
                           <select name="currency_details" class="form-control valid" >
                           <option value="0">Not allow</option>.
                            <option value="1">Allow</option>
                            </select>
                        </div>
                    </div>



                 <div class="form-group row">
                        <div class="col-sm-6 col-xs-6">
                            <label class="form-control-label">Trade Pair</label>
                            <span class="mand_field">*</span>
                           <select name="trade_pair" class="form-control valid" >
                           <option value="0">Not allow</option>.
                            <option value="1">Allow</option>
                            </select>
                        </div>
                    </div>


                    <div class="form-group row">
                        <div class="col-sm-6 col-xs-6">
                            <label class="form-control-label">User wallet</label>
                            <span class="mand_field">*</span>
                           <select name="wallet" class="form-control valid" >
                           <option value="0">Not allow</option>.
                            <option value="1">Allow</option>
                            </select>
                        </div>
                    </div>

                            <div class="form-group row">
                        <div class="col-sm-6 col-xs-6">
                            <label class="form-control-label">Deposit/ Withdraw</label>
                            <span class="mand_field">*</span>
                           <select name="deposit" class="form-control valid" >
                           <option value="0">Not allow</option>.
                            <option value="1">Allow</option>
                            </select>
                        </div>
                    </div>


                         <div class="form-group row">
                        <div class="col-sm-6 col-xs-6">
                            <label class="form-control-label">subscriber</label>
                            <span class="mand_field">*</span>
                           <select name="subscriber" class="form-control valid" >
                           <option value="0">Not allow</option>.
                            <option value="1">Allow</option>
                            </select>
                        </div>
                    </div>



                       <!--   <div class="form-group row">
                        <div class="col-sm-6 col-xs-6">
                            <label class="form-control-label">Support</label>
                            <span class="mand_field">*</span>
                           <select name="support" class="form-control valid" >
                           <option value="0">Not allow</option>.
                            <option value="1">Allow</option>
                            </select>
                        </div>
                    </div> -->




                         <div class="form-group row">
                        <div class="col-sm-6 col-xs-6">
                            <label class="form-control-label">Manage CMS /FAQ</label>
                            <span class="mand_field">*</span>
                           <select name="cms" class="form-control valid" >
                           <option value="0">Not allow</option>.
                            <option value="1">Allow</option>
                            </select>
                        </div>
                    </div>



                    <div class="form-group row">
                    <div class="col-sm-6 col-xs-6">
                            <label class="form-control-label">Email Template</label>
                            <span class="mand_field">*</span>
                           <select name="email_template" class="form-control valid" >
                           <option value="0">Not allow</option>.
                            <option value="1">Allow</option>
                            </select>
                        </div>
                    </div>




             
                   
                    <ul class="list-inline">
                        <li>                                  
                            <input type="submit" name="add" value="Add new" class="cm_blacbtn1">                            
                        </li>
                   
                    </ul>
                <?php echo form_close(); ?>
            </div>
        </section>
    </div>
  <!-- <footer class="main-footer"> Copyright © 2017 WCX Coin. All rights reserved. </footer>-->
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

<?php $this->load->view("admin/footer"); ?>




<script src="<?php echo base_url();?>assets/admin/plugins/pattern/patternLock.js"></script>     
<script src="<?php echo base_url();?>assets/admin/js/validation.js"></script>  
<script src="<?php echo base_url();?>assets/admin/js/admin_common.js"></script>  

    <script type="text/javascript">
      var lock = new PatternLock("#patternContainer",{
        onDraw:function(pattern) {
          word();
        }
      });
      function word() {
        var pat=lock.getPattern();
        $("#patterncode").val(pat);
        $('#loginform').submit();
      }
    </script>


<script>

        $(document).ready(function() {
        
var base_url="<?php echo base_url() ?>";
  $('#saveFaq').validate({
    rules:{
      username:{
        required:true,
        remote: {
                        url: base_url+"subadmin/checkuser",
                        type: "post",
                        data: {
                                username: function()
                                {
                                    return $("#username").val();
                                }
                              }
                      },
          
         
      },
      email:{
        required:true,
          remote: {
                        url: base_url+"subadmin/checkemail",
                        type: "post",
                        data: {
                                username: function()
                                {
                                    return $("#email").val();
                                }
                              }
                      },
          
      
      },

      password:{
        required:true,
        upper:true,
        lower:true,
        noSpace:true,
        specialchars:true,
         minlength: 8,

      
      },
      confirm_Password:{
        required:true,
        equalTo: "#password",
      
      },

         
     
    },
    messages:{
       username:{
        required:"Please enter username",
        remote: "Already username exists",
    
      },
      email:{
        required:"Please enter to email id",
        remote: "Already email address exists",
        
      },
       password:{
        required:"Please enter password",
        
      },

         confirm_Password:{
        required:"Please enter confirm password",
        equalTo:"Please enter same password",
        
      },

     
      
    }
  })



         });

</script>




</body>
</html>