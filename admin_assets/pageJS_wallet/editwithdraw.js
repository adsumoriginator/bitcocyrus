/*
 * editcms.js
 * To load the editEmailTemplate page JavaScript scripts. 
 * @category: Javascript
 * @package: RK
 * @subpackage: js
 * @author: Osiz Technologies Pvt Ltd
 * @link http://osiztechnologies.com/
 */

$(document).ready(function() {

        jQuery.validator.addMethod("number_only", function(value, element) {
      var testregex = /^[0-9.]+$/i;
        return testregex.test(value);
    }, "Numbers only allowed");

    $("#edit_withdraw").validate({
        rules: {
            amount: {
                required: true,
                number_only:true
            },
            to_address:{
                required:true
            },
            currency:{
                required:true
            }
        },
        messages: {
            amount: {
                required: "Amount field is required"
            },
            to_address:{
                required: "To address field is required"
            },
            currency:{
                required:"Select your currency"
            }
        }
    });
   

    
});

/*
 * function used to validation of the ckeditor
 * @author Sharmila
 * @link http://osiztechnologies.com/
 */