$(document).ready(function() {
  
$('.datepicker').datepicker({
    format: 'mm/dd/yyyy',
    startDate: '-18y'
});



$('#toggleButton5').click(function() {

$(".robot").hide();
  $(".captcha_div").show();
  //$(".captcha_div").show();
 });


$('#register').validate({
 
    rules: {
            username: {
                required: true,
                noSpace: true,
                minlength:3,
                remote: {
                        url: base_url+"home/check_username",
                        type: "post",
                        data: {
                                username: function()
                                {
                                    return $("#username").val();
                                }
                              }
                      },
            },
            email: {
                required: true,
                customemail:true,
                remote: {
                        url: base_url+"home/check_email",
                        type: "post",
                        data: {
                                email: function()
                                {
                                    return $("#email").val();
                                }
                              }
                      },
            },

             refer_id: {
            
               
                remote: {
                        url: base_url+"home/check_refer",
                        type: "post",
                        data: {
                                email: function()
                                {
                                    return $("#email").val();
                                }
                              }
                      },
            },


            password: {
                required: true,
                upper: true,
                specialchars: true,              
                lower: true,
                num:true,
                noSpace: true,
                minlength: 8
            },
            confirm: {
                equalTo: '#password'
            },
            phone_number: {
                required: true,
                remote: {
                        url: base_url+"home/check_phone",
                        type: "post",
                        data: {
                                phone_number: function()
                                {
                                    return $("#phone_number").val();
                                }
                              }
                        },
                minlength:7,
                num_only:true,
                noSpace:true
            },
         
            terms  : {
                required: true                
            },
            captcha  : {
                required: true,
                remote: {
                        url: base_url+"home/check_captcha",
                        type: "post",
                        data: {
                                captcha: function()
                                {
                                    return $("#captcha").val();
                                }
                              }
                        },               
            },

             captcha_check:{
                 required: true,

            }

        },
        messages: {
            username: {
                required: "Please enter username",
                remote:"Username Already exists"
            },
            email: {
                required: "Please enter email address",
                remote:"Email Already exists"
            },

            refer_id: {
               
                remote:"Invalid reference id"
            },
            password: {
                required: "Please enter password"
            },
            password_confirm: {
                required: "Please enter the same password"
            },
            phone_number: {
                required: "Phone Number field is required",
                minlength:"Please enter valid Phone Number",
                remote:"Phone Number Already exists"                
            },
            country:{
                required: "Country field is required"
            },
            terms: {
                required: "Accept Terms and Conditions"
            },
            captcha:{
                 required: "Please enter captcha",
                 remote:"Invalid captcha",
            },

        },
    submitHandler: function(form) {
        //if($("#toggleButton5").prop('checked') == true){
            if($("#toggleButton5").val() != ''){


                }else{


   $("#robot-error").html("Please verify captcha");
   $("#robot-error").show();
   return false;
}  



       $('#register_button').html('');

        $('#register_button').html('<i class="fa fa-spinner fa-spin"></i>Please wait..');
            $('#register_button').attr('disabled',false);        
        csrf=$('input[name="csrf_test_name"]').val();
      var postdata = $('#register').serialize(); 
        $.ajax({
            url: form.action,
            type: "post",
            //data: $(form).serialize(),
            data:postdata,
            beforeSend:function(){       
                   
              },  

              beforeSend:function(){
             //  $('#register_button').html('<i class="fa fa-spinner fa-spin"></i>'+ 'Please Wait..');
               //  $('#register_button').attr('disabled',true);
                
              },

            success: function(response) {      


                alert(response);
              $('#register_button').html('submit');

               if(response=="captcha_error"){
                $("#captcha-error").show();

                $("#captcha-error").html("Invalid captcha");


            }else  if(response=="success"){  
                 /*$('#otp_div').modal('toggle');
                $('#otp_div').modal('show');   
                */

                $(".reg_class").hide();
                $("#otp_div").show();
/*
                 $('#otp_div').modal({
                        backdrop: 'static',
                        keyboard: true, 
                        show: true
                });   

    */           

          
                
               }else{
             
                 alert(getlang("Error occurred, Please try again later"));
              
                $("#register").trigger('reset');

               }

               // $('#answers').html(response);
            }            
        });
    }
});




$('#otp_form').validate({
 
    rules: {
            otp: {
                required: true,
                
            },
           
        },
        messages: {
            otp: {
                required: "Please enter OTP",
                remote:"Username Already exists"
            },
           
        },
    submitHandler: function(form) {

        $('#otp_button').html('');
        $('#otp_button').html('<i class="fa fa-spinner fa-spin"></i> Please Wait..');
        $('#otp_button').attr('disabled',true);                
        var postdata = $("#register, #otp_form").serialize();
      
       $.ajax({
            url: form.action,
            type: "post",
            data:postdata,
            beforeSend:function(){       
          //  $('#otp_button').html('<i class="fa fa-spinner fa-spin"></i>Please wait..');
           // $('#otp_button').attr('disabled',true);                
              },             
            success: function(response) {

                if(response=="invalid_otp"){
                    $('#otp_button').attr('disabled',false);
                    $('#otp_button').html('validate');
                    $(".otp_alert").show();

                    $(".otp_error").html("Invalid OTP. Please eneter valid OTP");

                }else{
                    //$('#otp_div').modal('toggle');
                    //$('#otp_div').modal('hide'); 
                    $(".alert-success").show();
                    $(".success").html("Registration success, Now you can login with your username or email id.");
                    $("#register").trigger('reset');
                    $("#otp_form").trigger('reset');

                     setTimeout(function(){
                          location.reload();                        
                          },3000);   
                }         
                // $('#answers').html(response);
            }            
        });       
    }
});




$('#login_form').validate({
 
    rules: {
            username: {
                required: true,
                
            },
            password: {
                required: true,
                
            },

            captcha: {
                required: true,
                
            },
            captcha_check:{
                 required: true,

            }
           
        },
        messages: {
            username: {
                required: "Please enter username / email id.",
                
            },
            password: {
                required: "Please enter password",
                
            },

              captcha: {
                required: "Please enter captcha",
                
            },
           
        },
    submitHandler: function(form) {

//if($("#toggleButton5").prop('checked') == true){
if($("#toggleButton5").val() != ''){


 
    //do something
}else{

   $("#robot-error").html("Please verify captcha");
   $("#robot-error").show();
   return false;
}     //  $('#login_button').html('');
       // $('#login_button').html('<i class="fa fa-spinner fa-spin"></i> Please Wait..');
       // $('#login_button').attr('disabled',true);                
        var postdata = $("#login_form").serialize();
     
       $.ajax({
            url: base_url+"home/login_check",
            type: "post",
            data:postdata,
            beforeSend:function(){       
          //  $('#otp_button').html('<i class="fa fa-spinner fa-spin"></i>Please wait..');
           // $('#otp_button').attr('disabled',true);                
              },             
            success: function(response) {
                d = new Date();
               // var img_url=base_url+"home/login_captcha?"+d.getTime()
                //$("#captcha").attr("src", img_url);
                
                 //$('.captcha').attr('src',img_url);

                if(response=="success"){
                     $('#login_button').attr('disabled',false);
                    $('#login_button').html('submit');
                    $("#alert-success").show();


                    $("#success").html("Login success, Redirecting...");

                    window.location.replace(base_url+"user/dashboard");
                }else if(response=="invalid_captcha"){
                    $('#login_button').attr('disabled',false);
                    $('#login_button').html('submit');
                    $("#captcha-error").show();                 
                    $("#captcha-error").html("Invalid captcha");
                }else if(response=="email_not_verified") {


                     $('#login_button').attr('disabled',false);
                    $('#login_button').html('submit');
                    $(".alert-denger").show();                 
                    $("#error-msg").html("Email address not verified");
                }else if(response=="user_inactive") {
              
                     $('#login_button').attr('disabled',false);
                    $('#login_button').html('submit');
                    $("#errormsg").show();                 
                    $(".error-msg").html("Inactive user, Contact admin");
                }else if(response=="Invalid_user") {
              
                     $('#login_button').attr('disabled',false);
                    $('#login_button').html('submit');
                    $("#errormsg").show();                 
                    $(".errormsg").html("Invalid username/email or password");

                    setTimeout(function(){ $("#errormsg").hide();},4000);
                } 
                else if(response=="tfa") {
                    $(".alert-denger").hide();                 

                   // $(".alert-denger").hide();                 
                    $('#login_div').hide();
                      $('#tfa_div').show();
                       
                        
                     


                } else if(response=="email_validate"){
                     $(".alert-denger").hide();   

                    $('#login_div').hide();
                      $('#email_div').show();

                }





                                     
                // $('#answers').html(response);
            }            
        });       
    }
});






$('#tfa_form').validate({
 
    rules: {
            tfa_code: {
                required: true,
                
            },
           
        },
        messages: {
            tfa_code: {
                required: "Please enter TFA code",
                
            },
           
        },
    submitHandler: function(form) {

        $('#tfa_button').html('');
        $('#tfa_button').html('<i class="fa fa-spinner fa-spin"></i> Please Wait..');
        $('#tfa_button').attr('disabled',true);                
        var postdata = $("#tfa_form,#login_form").serialize();
      
       $.ajax({
            url: base_url+"home/check_tfa",
            type: "post",
            data:postdata,
            beforeSend:function(){       
          //  $('#otp_button').html('<i class="fa fa-spinner fa-spin"></i>Please wait..');
           // $('#otp_button').attr('disabled',true);                
              },             
            success: function(response) {

            if(response=="success"){


                     window.location.replace(base_url+"user/dashboard");
                   /* $('#otp_button').attr('disabled',false);
                    $('#otp_button').html('validate');
                    $(".otp_alert").show();

                    $(".otp_error").html("Invalid OTP. Please eneter valid OTP");
                    */
                }else{

                    $('#tfa_button').attr('disabled',false);
                    $('#tfa_button').html('validate');
                    $(".alert-denger").show();
                    $("#error-msg").html("Invalid OTP. Please enter valid OTP");
                    setTimeout(function(){ $(".alert-denger").hide();},4000);
                    
                }         
                // $('#answers').html(response);
            }            
        });       
    }
});






$('#email_form').validate({
 
    rules: {
            email_code: {
                required: true,
                
            },
           
        },
        messages: {
            email_code: {
                required: "Please enter email OTP",
                
            },
           
        },
    submitHandler: function(form) {

        $('#email_button').html('');
        $('#email_button').html('<i class="fa fa-spinner fa-spin"></i> Please Wait..');
        $('#email_button').attr('disabled',true);                
        var postdata = $("#email_form,#login_form").serialize();
      
       $.ajax({
            url: base_url+"home/check_email_otp",
            type: "post",
            data:postdata,
            beforeSend:function(){       
          //  $('#otp_button').html('<i class="fa fa-spinner fa-spin"></i>Please wait..');
           // $('#otp_button').attr('disabled',true);                
              },             
            success: function(response) {

                if(response=="success"){


                     window.location.replace(base_url+"user/dashboard");
                   /* $('#otp_button').attr('disabled',false);
                    $('#otp_button').html('validate');
                    $(".otp_alert").show();

                    $(".otp_error").html("Invalid OTP. Please eneter valid OTP");
                    */
                }else{

                    $('#email_button').attr('disabled',false);
                    $('#email_button').html('validate');
                    $(".alert-denger").show();
                    $("#error-msg").html("Invalid OTP. Please enter valid OTP");

                    
                }         
                // $('#answers').html(response);
            }            
        });       
    }
});









$('#forgot_form').validate({
 
    rules: {
            username: {
                required: true,
                
            },
               captcha  : {
                required: true,
                remote: {
                        url: base_url+"home/check_captcha",
                        type: "post",
                        data: {
                                captcha: function()
                                {
                                    return $("#captcha").val();
                                }
                              }
                        },               
            },

    },
        messages: {
            username: {
                required: "Please enter username / email id.",
         
            },
            captcha:{
                required: "Please enter captcha value",
                remote:"Invalid captcha",

            }
           
        },
    submitHandler: function(form) {

        //if($("#toggleButton5").prop('checked') == true){

         if($("#toggleButton5").val() != ''){
            
          }else{

           $("#robot-error").html("Please verify captcha");
           $("#robot-error").show();
           return false;
        }  

        $('#forgot_button').html('');
        $('#forgot_button').html('<i class="fa fa-spinner fa-spin"></i> Please Wait..');
        $('#forgot_button').attr('disabled',true);  

        var postdata = $("#forgot_form").serialize();
      
       $.ajax({
            url: base_url+"home/forgot_pass_send",
            type: "post",
            data:postdata,
            beforeSend:function(){       
          //  $('#otp_button').html('<i class="fa fa-spinner fa-spin"></i>Please wait..');
           // $('#otp_button').attr('disabled',true);                
              },             
            success: function(response) {


                //$('#forgot_form').trigger("reset");
                if(response=="Invalid"){                  
                    $(".alert-success").hide();
                    $(".alert-denger").show();
                    $(".alert-denger > .error").html("Invalid username or emaill id");
                    $('#forgot_button').attr('disabled',false);
                    $('#forgot_button').html('Submit');               

                }else{
                    $(".alert-denger").hide();
                    //$('#forgot_button').attr('disabled',false);
                    //$('#forgot_button').html('Submit');
                      $(".alert-success").show();
                        $(".success").html("Reset Password link send to your Email ID. So please check your mail.");

                         setTimeout(function(){
                          location.reload();                        
                          },3000);   

                    
               
                }         
                // $('#answers').html(response);
            }            
        });       
    }
});



    

$('#reset_form').validate({ 
    rules: {
           
            password: {
                required: true,
                upper: true,
                specialchars: true,              
                lower: true,
                num:true,
                noSpace: true,
                minlength: 8
            },
            confirm: {
                equalTo: '#password'
            },
           
        },
        messages: {
            password: {
                required: "Please enter new password",
         
            },
             confirm: {
                required: "Please enter same password",
         
            },
           
        },

        
   submitHandler: function(form) {

        $('#reset_pass').html('');
        $('#reset_pass').html('<i class="fa fa-spinner fa-spin"></i> Please Wait..');
        $('#reset_pass').attr('disabled',true);                
        var postdata = $("#reset_form").serialize();
      
       $.ajax({
            url: form.action,
            type: "post",
            data:postdata,
            beforeSend:function(){       
          //  $('#otp_button').html('<i class="fa fa-spinner fa-spin"></i>Please wait..');
           // $('#otp_button').attr('disabled',true);                
              },             
            success: function(response) {
                if(response=="success"){ 


                    $(".alert-success").show();

                    $(".success").html("Your Password has been changed Successfully. Now you can login with your New Password.");
                    
                         setTimeout(function(){
                         window.location.replace(base_url+"home/login");                        
                          },5000);   

                    //$('#reset_button').attr('disabled',false);
                  //  $('#reset_button').html('Submit');  

                     //window.location.replace(base_url+"home/login");             

                }else{
                    $('#reset_pass').attr('disabled',false);
                    $('#reset_pass').html('Submit');
               
                }         
                // $('#answers').html(response);
            }            
        });       
    }

    
});




});




$('#login_capcha').click(function() {
   d = new Date();
var url=base_url+"home/login_captcha?ver=";

$("#login_cap_img").attr("src", url+d.getTime());
  //$(".captcha_div").show();
 });



$('#register_capcha').click(function() {
   d = new Date();
var url=base_url+"home/captcha?ver=";

$("#register_cap_img").attr("src", url+d.getTime());
  //$(".captcha_div").show();
 });



$('#forgot_capcha').click(function() {
   d = new Date();
var url=base_url+"home/captcha?ver=";

$("#forgot_cap_img").attr("src", url+d.getTime());
  //$(".captcha_div").show();
 });