
 

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
        return value.indexOf(" ") < 0;
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
