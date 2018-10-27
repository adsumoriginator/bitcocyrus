$(document).ready(function() {
    $("#saveTradePair").validate({
        rules: {
            buy_rate_value: {
                required: true,
                number: true
            },
            sell_rate_value: {
                required: true,
                number: true
            },
            trade_min_amt: {
                required: true,
            }
        },
        messages: {
            buy_rate_value: {
                required: "Please fill buy rate value"
            },
            sell_rate_value: {
                required: "Please fill sell rate value"
            },
            trade_min_amt: {
                required: "Please fill trade minimum amount",
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