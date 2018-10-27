$(document).ready(function() {
    $("#login-form").validate({
        rules: {
            txtusername: {
                required: true
            },
            txtpassword: {
                required: true, 
                noSpace:true,
            }            
        },
        messages: {
            txtusername: {
                required: "Please fill user name"                    
            },            
            txtpassword: {
                required: "Please fill password"
            }          
        }
    });

	$("#danger-alertt").hide();
	$("#danger-alertt").alert();
    $("#danger-alertt").fadeTo(2000, 500).slideUp(500, function(){
		$("#danger-alertt").slideUp(500);
	});

	$("#success-alertt").hide();
	$("#success-alertt").alert();
    $("#success-alertt").fadeTo(2000, 500).slideUp(500, function(){
		$("#success-alertt").slideUp(500);
	});    
});