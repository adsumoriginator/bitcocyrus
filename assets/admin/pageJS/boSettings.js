$(document).ready(function() {
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

            /* Social Media */
            linkedinURL:{
                required: true,
                url: true
            },
            googleURL: {
              required: true,
                url: true
            },
            instagramURL: {
              required: true,
                url: true
            },

            facebookURL:{
                required: true,
                url: true
            },            
            twitterURL:{
                required: true,
                url: true
            },
            telegramURL: {
                required: true,
                url: true
            },
            mediumURL: {
                required: true,
                url: true
            },            
            redditURL: {
                required: true,
                url: true
            },
            youtubeURL: {
                required: true,
                url: true
            },
            /* Social Media */
            
            /*instagramURL: {
                required: true  
            },*/
            adminContactEmail: {
                required: true
            },
            addCoinFee: {
                required: true,
                number:true
            },
            address: {
                required: true
            },
            city: {
                required:true
            },
            state: {
                required:true
            },
            country: {
                required: true
            },        
            /*smtpHost: {
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
            }*/            
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
            /* Social Media */
            linkedinURL:{
                required: "Please enter linkedin url"
            },
            googleURL: {
              required: "Please enter google plus url"  
            },
            instagramURL: {
              required: "Please enter instagram url"
            },

            facebookURL:{
                required: "Please enter facebook url"
            },            
            twitterURL:{
                required: "Please enter twitter url"
            },
            telegramURL: {
                required: "Please enter telegram url"
            },
            mediumURL: {
                required: "Please enter medium url"
            },            
            redditURL: {
                required: "Please enter reddit url"
            },
            youtubeURL: {
                required: "Please enter youtube url"
            },
            /* Social Media */
            adminContactEmail: {
                required: "please fill contact email"
            },
            addCoinFee: {
                required: "please fill fee for user add coin",
                number: "please enter valid add coin fee"
            }, 
            address: {
                required: "please fill address"
            },
            city: {
                required: "please fill city"
            },
            state: {
                required: "please fill state"
            },
            country: {
                required: "please fill country"
            },                                 
            /*smtpHost: {
              required: "please enter smtp host"
            },
            smtp_port:{
                required: "please enter smtp port"
            },
            smtp_username: {
              required: "please enter smtp username"
            },
            smtp_password: {
                required: "please enter smtp password"
            }*/            
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
