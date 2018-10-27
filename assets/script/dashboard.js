$(document).ready(function() {
 
     $('#tfa_form').validate({ 
        rules: {
               
                tfa_code: {
                    required: true,
                    digits: true,
                   
                },
              
               
            },
            messages: {
                tfa_code: {
                    required: "Please enter code",
                    digits: "Enter numbers only",
             
                },
                
               
            },

            
       submitHandler: function(form) {
       	  var txt=$('#tfa_button').html();


            $('#tfa_button').html('');
            $('#tfa_button').html('<i class="fa fa-spinner fa-spin"></i> Please Wait..');
            $('#tfa_button').attr('disabled',true);                
            var postdata = $("#tfa_form").serialize();
            
           $.ajax({
                url: base_url+"user/update_tfa",
                type: "post",
                data:postdata,
                beforeSend:function(){       
              //  $('#otp_button').html('<i class="fa fa-spinner fa-spin"></i>Please wait..');
               // $('#otp_button').attr('disabled',true);                
                  },             
                success: function(response) {

                	if(response=="fail"){

                		$('#tfa_button').attr('disabled',false); 
                		$('#tfa_button').html(txt);
                		$('#tfa_code-error').show();
                		$('#tfa_code-error').html("Invalid code");


                	}else{
                        $("#tfa_code-success").html("TFA status updated successfully")
                		$("#tfa_button").removeClass();
                		$("#tfa_button").addClass(response);
                		$("#tfa_button").html(response);
                		$('#tfa_button').attr('disabled',false);    
                	} 
                   

                    
                }            
            });       
        }
    });

     $('#profile_form').validate({ 
        rules: {
               
                firstname: {
                 
                    lettersonly:true,
                    noSpace: true,

                     required: {
                     depends:function(){
            $(this).val($.trim($(this).val()));
            return true;
        }
    },
                   
                },
                lastname: {
                    required: {
                     depends:function(){
                         $(this).val($.trim($(this).val()));
                     return true;
                     }
                     },
                    lettersonly:true,
                   
                   
                },
                address: {
                required: true,
                  //  noSpace: true,
                                      
                },
                dob: {
                    required: true,
                    noSpace: true,
                   
                   
                },
                city: {
                required: true,
                
            
                   
                },
                  state: {
                    required: true,
                    noSpace: true,
              
                   
                },
                 country: {
                    required: true,
                 
                   
                }, 

                 postal_code: {
                    required: true,
                    required: {
                     depends:function(){
                         $(this).val($.trim($(this).val()));
                     return true;
                     }
                     },
      
                   
                }, 


            },
            messages: {
                firstname: {
                    required: "Please enter firstname",
                    
                },
                lastname: {
                    required: "Please enter lastname",
                    
                },

                address: {
                    required: "Please enter address",
                    
                },

                dob: {
                    required: "Please enter date of birth",
                    
                },  
                city: {
                    required: "Please enter city",
                    
                },  
                 state: {
                    required: "Please enter state",
                    
                },
                 country: {
                    required: "Please select country",
                    
                },
                postal_code:{
                    required: "Please enter postal code",
                    
                },                 

          
            },

            
       submitHandler: function(form) {
          var txt=$('#profile_button').html();


            //$('#profile_button').html('');
           // $('#profile_button').html('<i class="fa fa-spinner fa-spin"></i> Please Wait..');
           // $('#profile_button').attr('disabled',true);                
            var postdata = $("#profile_form").serialize();
            
           $.ajax({
                url: base_url+"user/profile",
                type: "post",
                data:postdata,
                beforeSend:function(){       
              //  $('#otp_button').html('<i class="fa fa-spinner fa-spin"></i>Please wait..');
               // $('#otp_button').attr('disabled',true);                
                  },             
                success: function(response) {

                    if(response=="success"){

                        $(".profile").show();
                        $('.prosuccess').html("Profile updated successfully");
                
                        $('#profile_button').attr('disabled',true); 
                        $('#profile_button').html(txt);
                

                    }else{

                        $("#tfa_button").removeClass();
                        $("#tfa_button").addClass(response);
                        $("#tfa_button").html(response);
                        $('#tfa_button').attr('disabled',true);    
                    } 
                   

                    
                }            
            });       
        }
    });


  $('#password_form').validate({ 
        rules: {
               
                old_password: {
                    required: true,
                    
                   
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
            otp:{
                required: true,    
            }
              
               
            },
            messages: {
                tfa_code: {
                    required: "Please enter code",
                   
             
                },
                
               
            },
            
       submitHandler: function(form) {
          var txt=$('#password_button').html();

          $('#password_button').html('');
           $('#password_button').html('<i class="fa fa-spinner fa-spin"></i> Please Wait..');
            $('#password_button').attr('disabled',true);                
            var postdata = $("#password_form").serialize();            
           $.ajax({
                url: base_url+"user/security",
                type: "post",
                data:postdata,
                beforeSend:function(){       
              //  $('#otp_button').html('<i class="fa fa-spinner fa-spin"></i>Please wait..');
               // $('#otp_button').attr('disabled',true);                
                  },             
                success: function(response) {
                   $('#password_button').html(txt);
                    $('#password_button').attr('disabled',true);

                    if(response=="Invalid"){
               
                        $('#password_button').attr('disabled',true); 
                       // $('#password_button').html(txt);
                        $('.alert-denger').show();
                        $('#error').html("Invalid Password");


                    }else if(response=="invalid_otp"){

                        $('#password_button').attr('disabled',false); 
                        //$('#password_button').html(txt);
                        $("#otp-error").show();
                          $('.alert-success').hide();
                        $("#otp-error").html("Invalid OTP");

                        
                    }else if(response=="success"){

                        $('.alert-denger').hide();
                        $('.alert-success').show();
                        $('.success').html("Your Password has been changed Successfully. Now you can login with your New Password");

                        
                    }else if(response=="old_pass"){



                    }  
                   

                    
                }            
            });       
        }
    });





   $('#change_tfa_form').validate({ 
        rules: {
            password: {
                required: true, 
            },    
            code: {
                required: true,
            }, 
            checkBackup: {
               required: true,   
            },
           
               
          },
          messages: {
                code: {
                    required: "Please enter code.",
                },

                password: {
                    required: "Please enter password.",
                },

                checkBackup: {
                    required: " I have backed up my 16-digit key.",
                },
          },

            
       submitHandler: function(form) {

          var txt=$('#change_tfa_button').html();
            $('#change_tfa_button').html('');
            $('#change_tfa_button').html('<i class="fa fa-spinner fa-spin"></i> Please Wait..');
            $('#change_tfa_button').attr('disabled',true);                
            var postdata = $("#change_tfa_form").serialize();
            
           $.ajax({
                url: base_url+"user/security",
                type: "post",
                data:postdata,
                beforeSend:function(){       
              //  $('#otp_button').html('<i class="fa fa-spinner fa-spin"></i>Please wait..');
               // $('#otp_button').attr('disabled',true);                
                  },             
                success: function(response) {

                    if(response=="Invalid_code"){
                        $('#change_tfa_button').attr('disabled',false); 
                        $('#change_tfa_button').html(txt);
                     
               
                        $('.alert-denger').show();
                        $('#error').html("Invalid Code");
                    
                    } else if(response=="Invalid_pass"){
                        $('#change_tfa_button').attr('disabled',false); 
                        $('#change_tfa_button').html(txt); 

                        $('.alert-denger').show();
                        $('#error').html("Invalid Password");

                    } else if(response=="enable"){
                        $('#change_tfa_button').attr('disabled',false); 
                        $('#change_tfa_button').html(txt);
                     
                         $('.alert-denger').hide();
                         $('.alert-success').show();
                         $('#change_tfa_button').attr('disabled',false); 
                         $('#change_tfa_button').html("ENABLE 2FA");
                         window.location.hash="#";
                         location.reload();
                         $('.success').html("TFA  status updated successfully");
                    }else if(response=="disable"){
                        $('#change_tfa_button').attr('disabled',false); 
                        $('#change_tfa_button').html(txt);          
                        $('.alert-denger').hide();
                        $('.alert-success').show();
                        $('#change_tfa_button').attr('disabled',false); 
                        $('#change_tfa_button').html("DISABLE 2FA");
                        window.location.hash="#";
                        location.reload();
                        $('.success').html("TFA  status updated successfully");
                    }else if(response=="invalid_otp"){

                        $('#change_tfa_button').attr('disabled',false); 
                        $('#change_tfa_button').html(txt);
                        $("#otp-error").show();
                          $('.alert-success').hide();
                        $("#otp-error").html("Invalid OTP");

                        
                    }else if(response=="success"){
                         $('#password_button').attr('disabled',false); 
                        $('#password_button').html(txt);                     

                        $('.alert-denger').hide();
                        $('.alert-success').show();
                        $('.success').html("Password changed successfully");

                        
                    }else if(response=="old_pass"){



                    }  
                   

                    
                }            
            });       
        }
    });












});
