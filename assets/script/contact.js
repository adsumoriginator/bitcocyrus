$(document).ready(function() { 

    $('#toggleButton5').click(function() {

$(".robot").hide();
  $(".captcha_div").show();
  //$(".captcha_div").show();
});


   
    $("#contact_support").validate({
        rules: {           
            name: {
                required: true,
            },
            email: {
                required: true,                
                customemail:true,
                noSpace: true                
            },   
            phone_number: {
                required: true,                
                num_only:true,
                noSpace: true ,
                minlength:7              
            },
            subject: {
                required: true
            },
            message: {
                required: true                
            },
            captcha:{
                required:true,
                remote: {
                      url: base_url+"captcha_exist",
                      type: "post",
                      data: {
                              captcha: function()
                              {
                                  return $("#captcha").val();
                              }
                            }
                    }
            }  
        },
        messages: {            
            name: {
                required: "Name field is required"
            },
            email: {
                required: "Email field is required"
            },
            phone_number: {
                required: "Phone Number field is required",
                minlength:"Please enter valid Phone Number"
            },
            subject: {
                required: "Subject field is required"
            },
            message:{
                required: "Message field is required"
            },
            captcha:{
                required: "Captcha field is required",
                remote:"Invalid captcha"
            }
        },
         submitHandler: function(form,e){

              if($("#toggleButton5").prop('checked') == true){
            }else{

          $("#robot-error").html("Please verify captcha");
                $("#robot-error").show();
         return false;
    }  



                    e.preventDefault();
                    $('#contact_btn').html('');
                     var dataform=$('#contact_support').serialize();                   
                     $.ajax({
                     type:'POST',
                     cache: false,
                     data:dataform,                                          
                     url:base_url+'contact',
                      beforeSend:function(){                        
                        $('#contact_btn').html('<i class="fa fa-spinner fa-spin"></i> Please Wait');
                        $('#contact_btn').attr('disabled',true);                       
                      },
                     success:function(output) 
                     {   
                       $("html, body").animate({
                            scrollTop: 200
                            }, 600);    

                        $('#contact_btn').html('Submit');
                        $('#contact_btn').attr('disabled',false);

                        var doutput = output.trim();

                        if( doutput == 1 )
                        {
                          $('#contact_support').trigger("reset");
                          $("#cnt_success").show();
                          $("#cnt_success").html("Contact Request added Successfully");
                           setTimeout(function(){
                          $("#cnt_success").html('');
                          },3000); 

                         }                          
                         else 
                        {
                         $("#cnt_error").show();                
                         $("#cnt_error").html('<p class="error">Error Occurred while add contact request </p>');
                          setTimeout(function(){
                          $("#cnt_error").html('');
                          },3000);
                        }                        
                     }
                 });
        },
    });



$("#support").validate({
        rules: {           
            name: {
                required: true,
            },
            email: {
                required: true,                
                customemail:true,
                noSpace: true                
            },   
            phone_number: {
                required: true,                
                num_only:true,
                noSpace: true ,
                minlength:7              
            },
            subject: {
                required: true
            },
            message: {
                required: true                
            },
            captcha_check:{
                 required: true,
            },
            captcha:{
                required:true,
                remote: {
                      url: base_url+"captcha_exist",
                      type: "post",
                      data: {
                              captcha: function()
                              {
                                  return $("#captcha").val();
                              }
                            }
                    }
            }  
        },
        messages: {            
            name: {
                required: "Name field is required"
            },
            email: {
                required: "Email field is required"
            },
            phone_number: {
                required: "Phone Number field is required",
                minlength:"Please enter valid Phone Number"
            },
            subject: {
                required: "Subject field is required"
            },
            message:{
                required: "Message field is required"
            },
            captcha:{
                required: "Captcha field is required",
                remote:"Invalid captcha"
            },
            captcha_check:{
                required: "Captcha field is required",
            }



            
        },
         submitHandler: function(form,e){
            if($("#toggleButton5").prop('checked') == true){
            }else{

                $("#robot-error").html("Please verify captcha");
                $("#robot-error").show();
                return false;
        }  


                    e.preventDefault();
                    $('#contact_btn').html('');
                     var dataform=$('#support').serialize();                   
                     $.ajax({
                     type:'POST',
                     cache: false,
                     data:dataform,                                          
                     url:base_url+'support',
                      beforeSend:function(){                        
                        $('#contact_btn').html('<i class="fa fa-spinner fa-spin"></i> Please Wait');
                        $('#contact_btn').attr('disabled',true);                       
                      },
                     success:function(output) 
                     {   
                       $("html, body").animate({
                            scrollTop: 200
                            }, 600);    

                        $('#contact_btn').html('Submit');
                        $('#contact_btn').attr('disabled',false);

                        var doutput = output.trim();

                        if( doutput == 1 )
                        {
                          $('#contact_support').trigger("reset");
                          $("#cnt_success").show();
                         $("#cnt_success").html("Support ticket submitted Successfully");
                         $(".alert-success").show();
                           $(".success").html("Support ticket submitted Successfully.");  



                           setTimeout(function(){
                          $(".alert-success").hide('');

                          location.reload();
                          },4000); 

                         }                          
                         else 
                        {
                         $("#cnt_error").show();                
                         $("#cnt_error").html('<p class="error">Error Occurred while add contact request </p>');
                          setTimeout(function(){
                          $("#cnt_error").html('');
                          },3000);
                        }                        
                     }
                 });
        },
    });




});


$('#contact_cap').click(function() {
   d = new Date();
var url=base_url+"cnt_captcha?ver=";

$("#contact_cap_img").attr("src", url+d.getTime());
  //$(".captcha_div").show();
 });



$('#support_cap').click(function() {
   d = new Date();
var url=base_url+"home/cnt_captcha?ver=";

$("#support_cap_img").attr("src", url+d.getTime());
  //$(".captcha_div").show();
 });




