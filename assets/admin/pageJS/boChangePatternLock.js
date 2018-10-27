/*
 * boChangePatternLock.js
 * To load the change pattern lock page JavaScript scripts. 
 * @category: Javascript
 * @package: Coin control
 * @subpackage: js
 * @author: Osiz Technologies Pvt Ltd
 * @link http://osiztechnologies.com/
 */

$(document).ready(function() {
    $("#updatePatternLock").validate({
        rules: {
            patterncode : {
                required: true
            }
        },
        messages: {
            patterncode : {
                required: "Please select pattern"
            }
        }
    });
});

var lock = new PatternLock("#patternContainer",{
    onDraw:function(pattern) {
      word();
    }
});
function word() {
    var pat=lock.getPattern();
    $("#patterncode").val(pat);
}

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
        $('#error_ans').css('color','#ff0000').append('<br><b>Please fill mail content</b>');
        error=1;
    } 
    if(error==0) {
        return true;
    } 
    else {
        return false;
    }
}