$(document).ready(function() {
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
                    e.preventDefault();
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
    
});





