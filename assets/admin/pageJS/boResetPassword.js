$(document).ready(function() {
    $("#reset_form").validate({
        rules: {
            newpassword: {
                required: true
            },
            repassword: {
                required: true,
                equalTo:'#newpassword'                
            }            
        },
        messages: {
            newpassword: {
                required: "Please fill password"                    
            }, 
            repassword: {
                required: "Please Re type your password",
                equalTo : "Please enter the same password"
            }          
        }
    });
});