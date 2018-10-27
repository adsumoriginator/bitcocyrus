$(document).ready(function() {
        jQuery.validator.addMethod("specialchars", function(value, element) {
          return this.optional(element) || /^(?=.*[!@#$%&*()_+}])/.test(value);
        }, "Your password should have at least one special character");    

        jQuery.validator.addMethod("lower", function(value, element) {
          return this.optional(element) || /^(.*[a-z].*)/.test(value);
        }, "Your password should have at least one lowercase character");
        
        jQuery.validator.addMethod("noSpace", function(value, element) {
          return value.indexOf(" ") < 0 && value != "";
        }, "Please fill without Space");    

        jQuery.validator.addMethod("upper", function(value, element) {
          return this.optional(element) || /^(.*[A-Z].*)/.test(value);
        }, "Your password should have at least one uppercase character");

        jQuery.validator.addMethod("customemail", function(value, element) {
            return /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i.test(value);
        },"Your email is not valid");

        jQuery.validator.addMethod("alphabet", function(value, element) {
          return this.optional(element) || /^(.*[a-zA-Z].*)/.test(value);
        }, "Your password should have at least one character");    

        /**
         * Custom validator for contains at least one number.
         */
        jQuery.validator.addMethod("numericVal", function (value, element) {
            return this.optional(element) || /[0-9]+/.test(value);
        }, "Your password should have at least one number");

        $("#changePwd").validate({
            rules: {
                password: {
                    required: true
                },
                newpassword: {
                    required: true, 
                    specialchars: true,
                    //upper:true, 
                    //lower: true,
                    alphabet:true,
                    noSpace: true,  
                    numericVal:true,            
                    minlength: 6                    
                },
                repassword: {
                    equalTo:'#newpassword',
                }  
            },
            messages: {
                password: {
                    required: "Please enter your current password"                    
                },
                newpassword: {
                    required: "Please enter the password"
                },
                repassword: {
                    required: "Please confirm your password",
                    equalTo : "Please enter the same password"
                }
            }
        });
});