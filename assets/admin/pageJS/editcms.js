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
    $("#savecms").validate({
        rules: {
            cmsTitle: {
                required: true
            }
        },
        messages: {
            cmsTitle: {
                required: "Please fill cms title"
            }
        }
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
        $('#error_ans').css('color','#ff0000').append('<br><b>Please fill CMS content</b>');
        error=1;
    } 
    if(error==0) {
        return true;
    } 
    else {
        return false;
    }
}