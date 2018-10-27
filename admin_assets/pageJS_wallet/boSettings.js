$(document).ready(function() {

        jQuery.validator.addMethod("num_only", function(value, element) {
      var testregex = /^[0-9 .]+$/i;
        return testregex.test(value);
    }, "Numbers only allowed");


    $("#siteConfig").validate({
        rules: {
            companyName: {
                required: true
            },
            adminFirstName: {
                required: true
            },
            adminLastName: {
                required: true
            },
            adminContactNumber: {
              required: true,
              number:true  
            },
            email: {
                required: true,
                email :true
            },
            phoneNumber:{
                required: true,
                number:true,
                minlength:10
            },            
            address: {
                required: true
            },
            facebookURL:{
                required: true,
                url: true
            },
            linkedinURL: {
                required: true,
                url: true
            },
            twitterURL:{
                required: true,
                url: true
            },
            /*youtubeURL: {
                required: true,
                url: true
            },*/
            googleURL: {
              required: true  
            },
            /*instagramURL: {
                required: true  
            },*/
            adminContactEmail: {
                required: true
            },
            smtpHost: {
              required: true  
            },
            smtp_port:{
                required: true
            },
            smtp_username: {
              required: true  
            },
            smtp_password: {
                required: true  
            },
            tokenlimit:{
                required:true,
                num_only:true
            },
            token_fiatvalue:{
                required:true,
                num_only:true
            },
            token_btcvalue:{
                required:true,
                num_only:true
            },
            minimum_invest:{
                required:true,
                num_only:true
            },
            token_minlimit:{
                required:true,
                num_only:true
            },
            token_ethvalue:{
                required:true,
                num_only:true
            }         
        },
        messages: {
            companyName: {
                required: "Please fill company name."                    
            },    
            adminFirstName: {
                required: "Please fill first name"
            },            
            adminLastName: {
                required: "Please fill last name"
            },
            adminContactNumber: {
                required: "Please fill contact number"
            },
            email: {
                required: "Please fill email id."
            },
            phoneNumber:{
                required: "Please fill phone number"
            },            
            address:{
                required: "Please fill address"
            },
            facebookURL:{
                required: "Please enter facebook url"
            },
            linkedinURL:{
                required: "Please enter instagram url"
            },            
            twitterURL:{
                required: "Please enter twitter url"
            },
            /*youtubeURL: {
                required: "Please enter youtube url"
            },*/
            googleURL: {
              required: "Please enter google plus url"  
            },
            /*instagramURL: {
              required: "Please enter twitter url"
            },*/
            adminContactEmail: {
                required: "Please fill contact email"
            },            
            smtpHost: {
              required: "Please enter smtp host"
            },
            smtp_port:{
                required: "Please enter smtp port"
            },
            smtp_username: {
              required: "Please enter smtp username"
            },
            smtp_password: {
                required: "Please enter smtp password"
            },
            tokenlimit: {
                required: "Please enter Token Limit"
            },
            token_fiatvalue: {
                required: "Please enter Token USD Value"
            }, 
            token_minlimit: {
                required: "Please enter Token Minimum Limit Value"
            },
            minimum_invest: {
                required: "Please enter Minimum Invest Value"
            },
            token_btcvalue: {
                required: "Please enter Token BTC value"
            },
            token_ethvalue: {
                required: "Please enter Token ETH value"
            }            
        }
    });
});

/* site logo start here */
var readURL = function(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('.profile-pic').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}
$(".site-logo").on('change', function(){
    readURL(this);
});

$(".upload-button").on('click', function() {
   $(".site-logo").click();
});
/* site logo end here */

/* site favicon start here */
var readURL_1 = function(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('.favicon-pic').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}
$(".favicon-upload").on('change', function(){
    readURL_1(this);
});
$(".upload-button").on('click', function() {
   $(".favicon-upload").click();
});
/* site favicon end here */