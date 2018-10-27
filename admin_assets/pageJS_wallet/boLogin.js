$(document).ready(function() {
    $("#login-form").validate({
        rules: {
            txtusername: {
                required: true
            },
            txtpassword: {
                required: true  
            },
            patterncode:{
                required:true
            }
        },
        messages: {
            txtusername: {
                required: "Username is Mandatory"                    
            },            
            txtpassword: {
                required: "Password is Mandatory"
            },
            patterncode:{
                required:"Draw Your Login Pattern"
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




$('#forgot_form').validate({
  rules:{
    useremail:{
      required:true,
      email:true,
    }
  },
  messages:{
    useremail:{
    required:"Enter Your Email Id",
    email:"Enter Valid Email Id",
  }
  }
})


$(document).ready(function() {
    $("#reset_form").validate({
        rules: {          
            newpassword: {
                required: true
            },
            repassword: {
                equalTo:'#newpassword'
            }  
        },
        messages: {           
            newpassword: {
                required: "Please enter the New Password"
            },
            repassword: {
                required: "Please confirm your Password",
                equalTo : "Please enter the same Password"
            }
        }
    });
});

