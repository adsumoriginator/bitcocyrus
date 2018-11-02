<!DOCTYPE html>
<html>
<head>
    <title>Coming soon</title>
    <style>
        body, html {
            height: 100%;
            margin: 0;
        }
        .bgimg {
            background-image: url(".../../uploads/forestbridge.jpg");
            height: 100%;
            background-position: center;
            background-size: cover;
            position: relative;
            color: white;
            font-family: "Courier New", Courier, monospace;
            font-size: 25px;
        }
		.topleft {
            position: absolute;
            top: 0;
            left: 16px;
        }
		.bottomleft {
            position: absolute;
            bottom: 0;
            left: 16px;
        }
		.middle {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }
		hr {
            margin: auto;
            width: 40%;
        }
    </style>  
    <script type="text/javascript" src="https://www.google.com/recaptcha/api.js"></script>  
    <script src="assets/frontend/js/jquery.min.js"></script> 
</head>
<body>
<div class="bgimg">
  <div class="topleft">
    <!-- <p>Logo</p> -->
  </div>
  <div class="middle">
    <h1>COMING SOON</h1>
    <hr>
     <button name="captcha_button" id="captcha_response">Verify</button>
    <div class="g-recaptcha" data-callback="recaptchaCallback"  data-sitekey="6Lc2NG8UAAAAAGYBWICrLg7-8Tv5mMiIx8aAXwrZ" required >
                            </div>
                            <p id="recaptcha"></p>
    <!-- <p>35 days left</p> -->
  </div>
  <!-- <div class="bottomleft">
    <p>Some text</p>
  </div> -->
</div>
</body>
<script type="text/javascript" language="javascript">

function recaptchaCallback() {
   // $('#submitBtn').removeAttr('disabled');
   alert();
base_url = '<?=base_url()?>';
var captcha_response = grecaptcha.getResponse();

var url= base_url+"home/verify_home";
   alert(url);
       $.ajax({
            url: url,
            type: "post",
            data: {'captcha_response': captcha_response},
                       
            success: function(response) {
                 
                alert(response);
                        
       
                // $('#answers').html(response);
            }            
        }); 


/*alert(captcha_response.length);
if(captcha_response.length == 0)
{
    alert("Please checkmark Captcha!");
    // Captcha is not Passed
    return false;
}
else
{
    location.reload();                         
    // Captcha is Passed
    return true;
    
}*/

};




</script>
</html>