/*
 * edittestimonial.js
 * To load the editEmailTemplate page JavaScript scripts. 

 * @subpackage: js
 * @author: Osiz Technologies Pvt Ltd
 * @link http://osiztechnologies.com/
 */


 jQuery.validator.addMethod("numberonly", function(value, element) {
      var testregex = /^[0-9.]+$/i;
        return testregex.test(value);
    }, "Numbers only allowed");

$('#save_testimonial').validate({
                  rules: {                    
                    name: {
                      required: true                      
                    },
                    test_description:
                    {
                      required: true
                    },
                    rating:
                    {
                       required: true                       
                    }                  
                  }                 
});


  $(document).ready(function(){
      $('INPUT[type="file"]').change(function () {
    var ext = this.value.match(/\.(.+)$/)[1];
    switch (ext) {
      
        case 'jpeg':
        case 'jpg':
        case 'png':
            
            $('#uploadButton').attr('disabled', false);
            var val = $(this).val();
            $('#'+$(this).attr('id')+'_value').val(val);
            $('#'+$(this).attr('id')+'_value').removeClass("error");
            $('#'+$(this).attr('id')+'_value').addClass("valid");
            $('#'+$(this).attr('id')+'_value_lable').html('');
            break;
        default:
            $('#uploadButton').attr('disabled', true);
            alert('This is not an allowed file type.');
            this.value = '';
            $('#'+$(this).attr('id')+'_value').attr('placeholder','No files selected');
            $('#'+$(this).attr('id')+'_value').val('');
            $('#'+$(this).attr('id')+'_value_lable').html('This field is required.');
            $('#'+$(this).attr('id')+'_value_lable').show();
    }
});

    });




/*
 * function used to validation of the ckeditor
 * @author Sharmila
 * @link http://osiztechnologies.com/
 */

