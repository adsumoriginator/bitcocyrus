$(document).ready(function() {
    $("#forgot_form").validate({
        rules: {
            userEmail: {
                required: true,
                email:true,
            }          
        },
        messages: {
            userEmail: {
                required: "Please fill email id",
                email:"Please enter valid email id",
            }        
        }
    });
});