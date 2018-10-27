$(document).ready(function() {
    jQuery.validator.addMethod("greaterThan",function (value, element, param) {
      var $min = $(param);
      if (this.settings.onfocusout) {
        $min.off(".validate-greaterThan").on("blur.validate-greaterThan", function () {
          $(element).valid();
        });
      }
      return parseInt(value) > parseInt($min.val());
    }, "Max must be greater than min");

    $("#saveCurrency").validate({
        rules: {
            currency_name: {
                required: true
            },
            currency_symbol: {
                required: true
            },
            profile_image: {
                required: true,
                extension: "jpg|jpeg|png"
            },
            min_withdraw_limit: {
                required: true,
            },
            max_withdraw_limit: {
                required: true,
                min: function() { return parseFloat($('#min_withdraw_limit').val()); }
            },
            withdraw_fees: {
                required: true,
            }
        },
        messages: {
            currency_name: {
                required: "Please fill currency name"
            },
            currency_symbol: {
                required: "Please fill currency symbol"
            },
            min_withdraw_limit: {
                required: "Please fill minimum withdraw limit",
            },
            max_withdraw_limit: {
                required: "Please fill maximum withdraw limit",
            },
            withdraw_fees: {
                required: "Please fill maximum withdraw fee",
            }                                    
        }
    });

    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.profile-pic').attr('src', e.target.result);
            }
    
            reader.readAsDataURL(input.files[0]);
        }
    }
    $(".file-upload").on('change', function(){
        readURL(this);
    });
    $(".upload-button").on('click', function() {
       $(".file-upload").click();
    });    
});

    /*
     * function used to validation of the ckeditor
     * @author Sharavana Kumar
     * @link http://osiztechnologies.com/
     */

    function checkAll() {
        $('#error_ans').html('');
        var error=0;
        // check ck editor contents..
        if (CKEDITOR.instances.ckeditor.getData() == '') {
            // here, ckeditor denotes class..
            $('#error_ans').css('color','#ff0000').append('<br><b>Please fill shirt fabric description</b>');
            error=1;
        } 
        if(error==0) {
            return true;
        } 
        else {
            return false;
        }
    }