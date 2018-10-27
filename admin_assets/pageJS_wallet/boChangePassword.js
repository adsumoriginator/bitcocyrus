$(document).ready(function() {
    $("#changePwd").validate({
        rules: {
            password: {
                required: true
            },
            newpassword: {
                required: true
            },
            repassword: {
                equalTo:'#newpassword'
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

$(document).ready(function() {

    var admin_url = $('#admin_url').val();   


     $("#changepattern").validate({
        rules: {
            oldpatterncode: {
                required: true,
                remote: { 

                            url: admin_url+"BoChangePassword/adminpattern_exist",
                            type: "post",
                            data: {
                            oldpatterncode: function()
                            {
                             return $("#oldpatterncode").val();
                            }
                            }
                        },
            },
            patterncode: {
                required: true
            },
            cpatterncode: {
                equalTo:'#patterncode'
            }            
        },
        messages: {
            oldpatterncode: {
                required:"Draw Your Old Login Pattern"
            },
            patterncode: {
                required:"Draw Your New Login Pattern"
            },
            cpatterncode: {
                required:"confirm Your New Login Pattern",
                equalTo:"Plase Draw the Same New Pattern"
            }
        }
    });

});
