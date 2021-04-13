<?php

/*
  if($this->session->userdata("verify_count")){

    $verify_count=$this->session->userdata("verify_count")+1;
    $this->session->set_userdata(array("verify_count"=>1));
    
  }else{

    $verify_count=1;
    $this->session->set_userdata(array("verify_count"=>1));
  }
*/


if(!$this->session->userdata("home_numeric_verify")){


?>
<html lang="en">
<head>
<meta charset="utf-8">
<meta id="viewport" name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" type="image/png" href="<?php echo favicon()?>" sizes="16x16" />
<title>BitcoCyrus - is the most advanced exchange.</title>

<base href="<?php echo base_url(); ?>">

<!-- Bootstrap core CSS -->
<link href="<?php echo base_url() ?>assets/frontend/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url() ?>assets/frontend/css/bootstrap-reboot.css" rel="stylesheet">
<link href="<?php echo base_url() ?>assets/frontend/css/bootstrap-grid.css" rel="stylesheet">
<link href="<?php echo base_url() ?>assets/frontend/css/style.css?ver=<?php echo time() ?>" rel="stylesheet">

<link href="<?php echo base_url() ?>assets/frontend/css/animate.css" rel="stylesheet">

<link href="<?php echo base_url() ?>assets/frontend/css/responsive.css" rel="stylesheet">
<link href="<?php echo base_url() ?>assets/frontend/css/owl.carousel.css" rel="stylesheet">
<link rel="stylesheet" href="assets/frontend/css/owl.theme.default.min.css">


<!-- font css -->
<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,300i,400,400i,500,500i,700,700i,900" rel="stylesheet">
<link href="assets/frontend/css/font-awesome.min.css" rel="stylesheet">
<script src='https://www.google.com/recaptcha/api.js'></script>

<style type="text/css">
  .error {
    color: red !important;
}
::-webkit-scrollbar {
    width: 0px;
    background: transparent; 
}
::-webkit-scrollbar-thumb {
    background: transparent;
}
.success_msg{
  color: green !important;
}
body {
    margin: 0;
    font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol";
	color: #666;
    font-size: 1rem;
    font-weight: normal;
    line-height: 1.5;
    background-color: #1C3049 !important;
	height: 100vh;
background-size: cover;
text-align: center;
}

.numeric_captcha {
	position: absolute;
    margin-left: auto;
    margin-right: auto;
    right: 0;
    left: 42%;
    top: 30px;
}
.toggle-button {
    color: #fff;
    margin: 22px auto;
        margin-right: auto;
        margin-left: auto;
    display: table;
}
</style>

    <link href="assets/frontend/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/frontend/css/bootstrap-reboot.css" rel="stylesheet">
    <link href="assets/frontend/css/bootstrap-grid.css" rel="stylesheet">
  
    </head>
    <body>


<div class="header fixed-top">
      <nav class="navbar navbar-expand-md navbar-dark "> 
    <a class="navbar-brand" style="margin: 0 auto;" href="<?php echo base_url()?>">
    <img src="<?php echo getSiteLogo(); ?>"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
 
  </nav>
    </div>


      <section class="choose_log">
	<!-- <div class="moving"></div>
      <div class="robot_captcha">
        <input type="checkbox" class="robot_verify">    
      </div>-->
      <div class="oMSSec">
        <h3>One More Step</h3>
        <p>Please Complete the security check to proceed</p>
      </div>
      <div class="oMSMid">
        <!--<div class="toggle-button toggle-button--vesi robot">
                <input id="toggleButton5" type="checkbox">
                <label for="toggleButton5" data-on-text="Verified" data-off-text="i am not robot"></label>
                <div class="toggle-button__icon"></div>
            </div>-->


    <div class="numeric_captcha">


      <div class="alert alert-success alert-dismissable success" style="display:none">
    
 
  </div>

  <div class="alert alert-denger alert-dismissable danger" style="display:none">
    
  </div>
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>">
 <div class="g-recaptcha" data-callback="recaptchaCallback"  data-sitekey="6LdxhHgUAAAAAFfiRqxCcotnYaDmhekuaLljDt1D" required >
                            </div>
                            <p id="recaptcha"></p>

    <?php
      
    //$array=array("id"=>"captcha_form","name"=>"captcha_form");
    //echo form_open("home/",$array);
    ?>

    <!--<div class="full_stretch_btn captcha_div" style="display:none">

    <img src="<?php //echo base_url()?>home/home_captcha">
    <input type="text" name="captcha" id="captcha">  

     <button name="captcha_button" id="captcha_button">Verify</button>
     <label id="captcha-error" style="display:none;" class="error" for="captcha"></label>
    </div>
     </form>-->
  </div>

</div>

    
      <script src="assets/frontend/js/jquery.min.js"></script>
      <script src="assets/frontend/js/bootstrap.min.js"></script> 

      <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.js"></script>
    <script>
   $(function(){
        var x = 0;
        setInterval(function(){
            x-=1;
            $('.moving').css('background-position', x + 'px 0');
        }, 50);
    })
	</script> 

  
      </section>

      <script>

        function recaptchaCallback() {
   // $('#submitBtn').removeAttr('disabled');
base_url = '<?=base_url()?>';
var captcha_response = grecaptcha.getResponse();

var url= base_url+"home/verify_home";
       $.ajax({
            url: url,
            type: "post",
            data: {'captcha_response': captcha_response},
                       
            success: function(response) {

              alert(response);
                 
                if(response=="invalid"){
                 
                    //$('#captcha_button').attr('disabled',false);
                    //$('#captcha_button').html('Verify');
                  $(".danger").show();
                       
                   $(".danger").html("Invalid captcha, Please enter correct value");
                      setTimeout(function(){
                          $(".danger").hide('');                                            
                                           
                      
                          },2000);


                }else{
               

                  //$('#toggleButton5').attr('readonly',true);
                 // $('#toggleButton5').attr('disabled', true);

                  // $(".robot").show();
                  $(".success").show(); 

                 // $(".captcha_div").hide();
                // $(".robot").show();
                $(".success").html("Verification success, Now redirecting Please wait..");
                      setTimeout(function(){


                          $(".success").hide(); 
                           location.reload();                         
                                           
                      
                          },2000);
                } 

                        
       
                // $('#answers').html(response);
            }            
        }); 


/*alert(captcha_response.length);
if(captcha_response.length == 0)
{
    alert("Please checkmark Captcha!");
    // Captcha is not Passed
    return false;
}
else
{
    location.reload();                         
    // Captcha is Passed
    return true;
    
}*/

};


        $('#captcha_form').validate({
 
       rules: {
            captcha: {
                required: true,
                
            },
           
        },
        messages: {
            captcha: {
                required: "Please enter Value",
               
            },
           
        },
    submitHandler: function(form) {

        $('#captcha_button').html('');
        $('#captcha_button').html('<i class="fa fa-spinner fa-spin"></i> Please Wait..');
        $('#captcha_button').attr('disabled',true);                
        var postdata = $("#captcha_form").serialize();
        var url='<?php base_url()?>home/verify_home';
        alert(url);
      
       $.ajax({
            url: url,
            type: "post",
            data:postdata,
            beforeSend:function(){       
          //  $('#otp_button').html('<i class="fa fa-spinner fa-spin"></i>Please wait..');
           // $('#otp_button').attr('disabled',true);                
              },             
            success: function(response) {
                 

                        

                if(response=="invalid"){
                 
                    $('#captcha_button').attr('disabled',false);
                    $('#captcha_button').html('Verify');
                  $(".danger").show();
                       
                   $(".danger").html("Invalid captcha, Please enter correct value");
                      setTimeout(function(){
                          $(".danger").hide('');                                            
                                           
                      
                          },2000);


                }else{
               

                  $('#toggleButton5').attr('readonly',true);
                  $('#toggleButton5').attr('disabled', true);

                  // $(".robot").show();
                  $(".success").show(); 

                  $(".captcha_div").hide();
                 $(".robot").show();
                $(".success").html("Verification success, Now redirecting Please wait..");
                      setTimeout(function(){


                          $(".success").hide(); 
                           location.reload();                         
                                           
                      
                          },2000);
                }         
                // $('#answers').html(response);
            }            
        });       
    }
});



$('#toggleButton5').click(function() {
    $('#toggleButton5').attr('disabled', true);

 if($(this).is(":checked")) 
    {
$('#toggleButton5').attr('readonly', true);
$(".robot").hide();
  $(".captcha_div").show();

  $(".captcha_div").show();
}


      });



      </script>

<?php $this->load->view('front/basic/footer'); ?>

    </body>
    </html>



<?php


exit;
}

?>
