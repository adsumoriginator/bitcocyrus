  var base_url = $("#base_url").val();


    $("#subscribe").validate({
        rules: {           
            subscribe_email: {
                required: true,
                customemail:true,
                remote: {
                      url: base_url+"home/subscribe_email_exist",
                      type: "post",
                      data: {
                              subscribe_email: function()
                              {
                                  return $("#subscribe_email").val();
                              }
                            }
                    }
            }         
        },
        messages: {
            subscribe_email: {
                required: "Subscription Email field is required",
                remote:"Email Already exists"
            }
        },
        submitHandler: function(form,e){
                   // e.preventDefault();


                    $('#subscribe_btn').html('');
                     var dataform=$('#subscribe').serialize();                   
                     $.ajax({
                     type:'POST',
                     cache: false,
                     data:dataform,                                          
                     url:base_url+'home/subscribe',
                      beforeSend:function(){                        
                        $('#subscribe_btn').html('<i class="fa fa-spinner fa-spin"></i> Please Wait');
                        $('#subscribe_btn').attr('disabled',true);                       
                      },
                     success:function(output) 
                     {
                        $('#subscribe').trigger("reset");
                        $('#subscribe_btn').html('Submit');
                        $('#subscribe_btn').attr('disabled',false);

                        var doutput = output.trim();

                        if( doutput == 1 )
                        {
                          $("#sub_success").show();
                          $("#sub_success").html("Subscription added Successfully");
                           setTimeout(function(){
                          $("#sub_success").html('');                          
                          },2000);                          
                         } 
                          else if(doutput == 2)
                        {
                         $("#sub_error").show();
                         $("#sub_error").html('<p class="error">This Email is already exists');
                          setTimeout(function(){
                          $("#sub_error").html('');
                          },2000);
                        }
                         else 
                        {
                         $("#sub_error").show();                
                          $("#sub_error").html('<p class="error">Error Occurred while subscribe </p>');
                          setTimeout(function(){
                          $("#sub_error").html('');
                          },2000);
                        }                        
                     }
                 });
        },
    });
    









 

function isNumberKey(evt){
var charCode = (evt.which) ? evt.which : evt.keyCode
if (charCode > 31 && (charCode < 46 || charCode > 57))
return false;
return true;
}

    
    jQuery.validator.addMethod("upper", function(value, element) {
        return this.optional(element) || /^(.*[A-Z].*)/.test(value);
    }, "Must include 1 uppercase character");
   
    jQuery.validator.addMethod("lower", function(value, element) {
        return this.optional(element) || /^(.*[a-z].*)/.test(value);
    }, "Must include 1 lowercase character");

    jQuery.validator.addMethod("num", function(value, element) {
        return this.optional(element) || /^(.*[0-9].*)/.test(value);
    }, "Must include 1 number");


    jQuery.validator.addMethod("lettersonly", function(value, element) {
        return this.optional(element) || /^[a-z,A-Z," "]+$/i.test(value);
    }, "Letters only please");

    jQuery.validator.addMethod("noSpace", function(value, element) {
        return value.indexOf(" ") < 0 && value != "";
    }, "Space not allowed");

    jQuery.validator.addMethod("alphanumeric", function(value, element) {
      var testregex = /^[a-z0-9]+$/i;
        return testregex.test(value);
    }, "Special char not allowed");

    jQuery.validator.addMethod("num_only", function(value, element) {
      var testregex = /^[0-9]+$/i;
        return testregex.test(value);
    }, "Numbers only allowed");


    jQuery.validator.addMethod("number_only", function(value, element) {
      var testregex = /^[0-9.]+$/i;
        return testregex.test(value);
    }, "Numbers only allowed");

    jQuery.validator.addMethod("customemail", 
        function(value, element) {
          return /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(value);
        }, 
        "Please enter valid Email address"
      );

    jQuery.validator.addMethod("nodigits", function(value, element) {
    // allow any non-whitespace characters as the host part
    return this.optional( element ) || /^[a-zA-Z]/.test( value );
    }, 'Please enter a characters only.');

   jQuery.validator.addMethod("specialchars", function(value, element) {
        return this.optional(element) || /^(?=.*[!@#$%&*()_+}])/.test(value);
    }, "Must include 1 special character");


   
   $("#check_otp").validate({
        rules: {
            otp_code: {
                required: true                             
            }
        },
        messages:{
            otp_code:{
                required: "OTP Code field is required"  
            }
        },
         submitHandler: function(form) { 
          $('#check_phone_otp').html('');
           var dataform=$('#check_otp').serialize();
            $.ajax({
                     type:'POST',
                     data:dataform,
                     url:base_url+'home/check_otp',
                      beforeSend:function(){                        
                       // $('#logindetail').trigger("reset");
                        $('#check_phone_otp').html('<i class="fa fa-spinner fa-spin"></i> Please Wait');
                        $('#check_phone_otp').attr('disabled',true);                       
                      },
                     success:function(output) 
                     {
                        $('#check_phone_otp').html('Submit');
                        $('#check_phone_otp').attr('disabled',false);

                        var doutput = output.trim();
                        if(doutput == 'valid')
                        {                          
                          $("#otp_valid").show();
                          $('#otp_valid').fadeOut(6000);
                          //location.reload();
                          window.location.href = base_url+'verification';
                        }
                         else if(doutput == 'invalid')
                        {                         
                          $("#otp_invalid").show();
                          $("#otp_invalid").html('Invalid OTP ');                          
                          $('#otp_invalid').fadeOut(5000);
                        }else if(doutput == 'expired'){
                          $("#otp_invalid").show();
                          $("#otp_invalid").html('OTP Expired');
                          $('#otp_invalid').fadeOut(5000);
                        }   
                     }
                 });

        },
    });


   $("#updated_tfa").validate({
     rules: {            
            tfa_code: {
                required: true
            }
          },            
          messages: {
          tfa_code: {
                required: "<label class='error' for='confirmation'>Enter Six Digit Code</label>",
            }            
          },       
         submitHandler: function(form) {           
           var dataform=$('#updated_tfa').serialize();
            $.ajax({
                     type:'POST',
                     data:dataform,
                     url:base_url+'home/tfa',
                      beforeSend:function(){
                        $('#enable_tfa').html('<i class="fa fa-spinner fa-spin"></i> Please Wait');
                        $('#enable_tfa').attr('disabled',true);
                      },
                     success:function(output) 
                     {     
                        $('#updated_tfa').trigger("reset")                 ;
                        $('#enable_tfa').html('Activate Now');
                        $('#enable_tfa').attr('disabled',false);
                        var doutput = output.trim();
                       // alert(doutput);
                       //  return false;
                        if( doutput == 'Enable' )
                        {
                          $("#tfa_susss").show();
                          $("#tfa_susss").html('<p class="success_msg"><strong>Success!</strong><span>Your 2FA Activated Successfully.</span></p>');                         
                         setTimeout(function(){
                          $("#tfa_susss").html('');                          
                          },3000);
                        }
                        else if( doutput == 'disable')
                        {
                          $('#tfa_susss').show();                          
                          $("#tfa_susss").html('<p class="success_msg"><strong>Success!</strong><span>Your 2FA De-Activated Successfully.</span></p>');
                         setTimeout(function(){
                          $("#tfa_susss").html('');                          
                          },3000);
                        }                          
                        else
                        {
                          $("#tfa_error").show();
                          $('#tfa_error').html('<strong>Error! </strong><span>Ocurred while update TFA Status.</span>');
                          setTimeout(function(){
                          $("#tfa_error").html('');                          
                          },3000);
                        }
                     }
                 });
        },
});


   $('#tfaform').validate({
        rules: {
            tfacode: {
            required: true,
            minlength:6,
            maxlength:6
            },
          },
        messages:{
            tfacode:{
                 required: "<label class='error' for='tfacode'>Please Enter TFA code</label>",
                 minlength:"<label class='error' for='tfacode'>Please Enter six digit code</label>",
                 maxlength:"<label class='error' for='tfacode'>Please Enter six digit code</label>"
            },
        },
        submitHandler: function(form){              
           var dataform=$('#tfaform').serialize();
          // console.log(dataform);
           var returl2 = $('.returl2').val();         
           var t1 = document.login_form.user_email.value;           
           var t2 = document.login_form.password.value;
           $.ajax({
                     type:'POST',
                     data:dataform+"&user_id="+t1+"&password="+t2,
                     url:base_url+'home/checktfa',
                      beforeSend:function(){
                        $('#tfa_verification').html('<i class="fa fa-spinner fa-spin"></i> Please Wait');
                        $('#tfa_verification').attr('disabled',true);
                      },
                     success:function(output) 
                     {    
                        $('#tfaform').trigger("reset");
                        $('#tfa_verification').html('Submit');
                        $('#tfa_verification').attr('disabled',false);
                        var doutput = output.trim();
                        if( doutput == 'correct' )
                        {                         
                          $('#tfa_verification').show();
                          $("#tfa_valid").show();
                          $("#tfa_valid").html('<p class="success_msg">User Logged in successfully.');                         
                           setTimeout(function(){
                          $("#tfa_valid").html('');                          
                          window.location.href = base_url+'account';
                          },3000);
                         /*window.setTimeout(function(){
                          window.location.href = base_url+'home/profile';
                                 },2000);*/
                        }                          
                        else
                        {                          
                          $("#tfa_invalid").show();
                          $('#tfa_invalid').html('Enter valid TFA Code');
                          setTimeout(function(){
                          $("#tfa_invalid").html('');                          
                          },3000);
                        }
                     }
                 });
        },

});