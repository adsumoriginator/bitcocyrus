<footer>

  <a class="scrollup" href="javascript:;" style="display: block;">
    <i class="fa fa-chevron-up" aria-hidden="true"></i>
  </a>

  <div class="container">
    <div class="row">
      <div class="col-lg-4">
        <img class="footer_logo" src="<?php echo getSiteLogo(); ?>"></a>
        <p class="footer_tag"> The world's largest and most advanced cryptocurrency trading platform. The leading global digital asset exchange. </p>
      </div>
      
      <div class="col-lg-2">
        <div class="row">
		<h3>RESOURCES</h3>
          <ul>
            <?php            
              $cms_ab = get_data('bcc_cms',array('id'=>1))->row();            
              $cms_re = get_data('bcc_cms',array('id'=>7))->row();            
              $cms_pr = get_data('bcc_cms',array('id'=>2))->row();            
              $cms_te = get_data('bcc_cms',array('id'=>3))->row();    
               $cms_fee = get_data('bcc_cms',array('id'=>8))->row();         
             ?>
              <li><a href="<?php echo base_url(); ?>cms/<?php echo $cms_ab->link; ?>"><?php echo $cms_ab->title; ?></a></li>
              
              <li><a href="<?php echo base_url(); ?>contact">Contact us</a></li>
            
              <?php
                //  if(user_id()){
              ?>
            <li><a href="https://bitcocyrus.freshdesk.com">Support</a></li>    
              <?php
           // }
            ?>
            </ul>
        </div>
     </div>
     
      <div class="col-lg-2">        
        <div class="row">
		<h3>SUPPORT</h3>
            <ul>
             <li><a href="<?php echo base_url(); ?>cms/<?php echo $cms_pr->link; ?>"><?php echo $cms_pr->title; ?></a></li>
             <li><a href="<?php echo base_url(); ?>cms/<?php echo $cms_te->link; ?>"><?php echo $cms_te->title; ?></a></li>
             <li><a href="<?php echo base_url(); ?>cms/<?php echo $cms_fee->link; ?>"><?php echo $cms_fee->title; ?></a></li>
            </ul>
      </div>
    </div>
  
      <?php $site_settings = site_settings();
        $condition=array('login_status'=>1);
        $result= $this->CommonModel->getTableData("userdetails",$condition);
      ?>
      
      <div class="col-lg-4">
        <h3>Newsletter signup </h3>
        <div class="newsletter">          
          
           <?php $attributes=array('id'=>'subscribe', 'name' =>'subscribe');
              echo  form_open('',$attributes); ?>
            <div class="form-group">
              <div class="input-group">
                <input type="text" name="subscribe_email" id="subscribe_email" class="form-control" placeholder="Subscribe Email" aria-label="">
                <span class="input-group-btn">
                <button class="btn btn-secondary" id="subscribe_btn" type="submit">Submit</button>
                </span> </div>
                <label id="subscribe_email-error" class="error" for="subscribe_email"></label>

                 <div class="success_msg" id="sub_success" style="display:none;"></div>

                 <div class="serror" id="sub_error" style="display:none;"></div>

            </div>
          <?php echo form_close(); ?>          
        </div>
		
		<div class="float-md-left">
			<ul class="top_social">
				<li><a target="_blank" title="Facebook" href="<?php echo $site_settings->facebooklink; ?>"><i class="fa fa-facebook-official"></i></a></li>
				<li><a target="_blank" title="Twitter" href="<?php echo $site_settings->twitterlink; ?>"><i class="fa fa-twitter"></i></a></li>
				<li><a target="_blank" title="Telegram" href="<?php echo $site_settings->telegramlink; ?>"><i class="fa fa-telegram"></i></a></li>
				<li><a target="_blank" title="Medium" href="<?php echo $site_settings->mediumlink; ?>"><i class="fa fa-medium"></i></a></li>
				<li><a target="_blank" title="Reddit" href="<?php echo $site_settings->redditlink; ?>"><i class="fa fa-reddit-alien"></i></a></li>
				<li><a target="_blank" title="Youtube" href="<?php echo $site_settings->youtubelink; ?>"><i class="fa fa-youtube"></i></a></li>
			</ul>
		</div>
      </div>
      
    </div>
  </div>
  
  <div class="copyright">
      <div class="container" style="margin-top:0;">
        <div class="col-lg-12">
         <div class="row"> 
             <div class="col-lg-4" style="margin-left: -15px;">
               © BitcoCyrus, LLC <script> document.write(new Date().getFullYear()); </script> - Little Rock, AR ,USA
             </div>
             <div class="col-lg-8" style="text-align: right;">
               <div class="footer_time"> <i class="fa fa-clock-o" aria-hidden="true"></i> <span style="color: #48c0ef;"> <?php echo date("d-m-Y H:i:s")?> </span> <?php echo date("e") ?> </div>
               <div class="footer_user"> <i class="fa fa-user-o" aria-hidden="true"></i> <span style="color: #48c0ef;"> <?php  echo $result->num_rows()?> </span></div>
               <div class="footer_volume"> <i class="fa fa-bar-chart-o" aria-hidden="true"></i> 24hr Volume : <span style="color: #48c0ef;"> <?php $btc= getTradeVolume_main(1); echo number_format($btc,3);?> </span> BTC | <span style="color: #48c0ef;"> <?php $eth=getTradeVolume_main(2); echo number_format($eth,3);?> </span> ETH | <span style="color: #48c0ef;"> <?php $bch=getTradeVolume_main(3);echo number_format($bch,3);?> </span> BCH | <span style="color: #48c0ef;"> <?php $usdt=getTradeVolume_main(4); echo number_format($usdt,3);?> </span> USDT </div>
             </div>
         </div>
        </div>
     </div>
  </div>
</footer>

<!-- Bootstrap core JavaScript
    ================================================== --> 
<!-- Placed at the end of the document so the pages load faster --> 
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> 


<?php if(!empty($main_js)) { ?>
  <script type="text/javascript" src="<?php echo base_url().'assets/script/'.$main_js.'.js?ver='.time();?>"></script>
<?php }?>
<script src="assets/frontend/js/jquery.min.js"></script> 
<script src="assets/frontend/js/popper.min.js"></script> 
<script src="assets/frontend/js/bootstrap.min.js"></script> 

<script src="assets/frontend/js/wow.min.js"></script>

<?php if(!empty($main_js)):?>

  <script src="<?php echo base_url();?>assets/admin/plugins/validate/jquery.validate.js" type="text/javascript"></script>

  <script type="text/javascript" src="<?php echo base_url(); ?>assets/script/common.js?ver=<?php echo time(); ?>"></script>

  
<?php endif;?>





<script>
new WOW().init();

 $("#start_trade").click(function(){  
    var locaaa = "<?php echo base_url(); ?>"+"home/login";
    window.location.href= locaaa; 
    }); 

</script>    
<script src="assets/frontend/vendors/owl-carousel/owl.carousel.min.js"></script>
<!--<script src="assets/frontend/js/owl.carousel.js"></script> -->
<script type="text/javascript">
 /* $('.owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:4
        }
    }
})*/
</script> 
 <script>
  /* $(function(){
        var x = 0;
        setInterval(function(){
            x-=1;
            $('.moving').css('background-position', x + 'px 0');
        }, 50);
    })*/
  </script> 

 <!--data table start-->
 
<link href="assets/frontend/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="assets/frontend/css/responsive.dataTables.min.css" rel="stylesheet">

<script src="assets/frontend/js/jquery.dataTables.min.js"></script>
<script src="assets/frontend/js/dataTables.bootstrap4.min.js"></script>
<script src="assets/frontend/js/dataTables.responsive.min.js"></script>

    <script src="assets/frontend/vendors/revolution/js/jquery.themepunch.tools.min.js"></script>
    <script src="assets/frontend/vendors/revolution/js/jquery.themepunch.revolution.min.js"></script>
    <script src="assets/frontend/vendors/revolution/js/extensions/revolution.extension.actions.min.js"></script>
    <script src="assets/frontend/vendors/revolution/js/extensions/revolution.extension.video.min.js"></script>
    <script src="assets/frontend/vendors/revolution/js/extensions/revolution.extension.slideanims.min.js"></script>
    <script src="assets/frontend/vendors/revolution/js/extensions/revolution.extension.layeranimation.min.js"></script>
    <script src="assets/frontend/vendors/revolution/js/extensions/revolution.extension.navigation.min.js"></script>
    <script src="assets/frontend/vendors/revolution/js/extensions/revolution.extension.slideanims.min.js"></script>
    <!-- Extra plugin css -->
    <script src="assets/frontend/vendors/counterup/jquery.waypoints.min.js"></script>
    <script src="assets/frontend/vendors/counterup/jquery.counterup.min.js"></script>
    
    <script src="assets/frontend/vendors/owl-carousel/owl.autoplay.min.js"></script>
    <script src="assets/frontend/vendors/animate-css/wow.min.js"></script>
    <script src="assets/frontend/vendors/parallax/parallax.min.js"></script>
    <script src="assets/frontend/vendors/counterup/jquery.waypoints.min.js"></script>
    <script src="assets/frontend/vendors/counterup/jquery.counterup.min.js"></script>
    <script src="assets/frontend/vendors/counterup/apear.js"></script>
    <script src="assets/frontend/vendors/counterup/countto.js"></script>
    <script src="assets/frontend/vendors/nice-select/jquery.nice-select.min.js"></script>
<script src="assets/frontend/js/theme.js"></script> 

<script>
$(document).ready(function() {
   $('.example').DataTable( {
    responsive: true
} );
  
} );
</script>
       
 <script type="text/javascript" src="assets/frontend/js/bootstrap-filestyle.min.js"> </script>    
 
 <script>
$(document).ready(function () {

    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('.scrollup').fadeIn();
        } else {
            $('.scrollup').fadeOut();
        }
    });

    $('.scrollup').click(function () {
        $("html, body").animate({
            scrollTop: 0
        }, 600);
        return false;
    });

});
</script> 

<!-- scroll-->
     
<script src="assets/frontend/js/jquery.mCustomScrollbar.concat.min.js"></script>
<link href="assets/frontend/css/jquery.mCustomScrollbar.css" rel="stylesheet">
<script>

(function($){
      $(window).on("load",function(){

        var width = $(window).width();
      
        if(width>1024){
      //    big screen 
        $(".order_scroll").mCustomScrollbar({
                          scrollButtons:{
                            enable:false
                          },

                      scrollbarPosition: 'inside',
                      autoExpandScrollbar:true, 
                      theme: 'dark',
                       axis:"y",
                          setWidth: "auto"
            });
                  
        }else{
    $(".order_scroll").mCustomScrollbar({
                          scrollButtons:{
                            enable:false
                          },

                      scrollbarPosition: 'inside',
                      autoExpandScrollbar:true, 
                      theme: 'dark',
                       axis:"x",
                          setWidth: "auto"
            });
       
        }
        
        
      });
    })(jQuery);

</script> 
<script src="https://code.highcharts.com/highcharts.js"></script>
<script>


        /**
         * Create a constructor for sparklines that takes some sensible defaults and merges in the individual
         * chart options. This function is also available from the jQuery plugin as $(element).highcharts('SparkLine').
         */
         Highcharts.SparkLine = function (a, b, c) {
            var hasRenderToArg = typeof a === 'string' || a.nodeName,
                options = arguments[hasRenderToArg ? 1 : 0],
                defaultOptions = {
                    chart: {
                        renderTo: (options.chart && options.chart.renderTo) || this,
                        backgroundColor: null,
                        borderWidth: 0,
                        type: 'area',
                        margin: [2, 0, 2, 0],
                        width: 228,
                        height: 60,
                        style: {
                            overflow: 'visible'
                        },

                        // small optimalization, saves 1-2 ms each sparkline
                        skipClone: true
                    },
                    title: {
                        text: ''
                    },
                    credits: {
                        enabled: false
                    },
                    xAxis: {
                        labels: {
                            enabled: false
                        },
                        title: {
                            text: null
                        },
                        startOnTick: false,
                        endOnTick: false,
                        tickPositions: [0]
                    },
                    yAxis: {
                        endOnTick: false,
                        startOnTick: false,
                        labels: {
                            enabled: false
                        },
                        title: {
                            text: null
                        },
                        tickPositions: [0]
                    },
                    legend: {
                        enabled: false
                    },
                    tooltip: {
                        enabled: false,
                        backgroundColor: null,
                        borderWidth: 0,
                        shadow: false,
                        useHTML: true,
                        hideDelay: 0,
                        shared: true,
                        padding: 0,
                        positioner: function (w, h, point) {
                            return { x: point.plotX - w / 2, y: point.plotY - h };
                        }
                    },
                    plotOptions: {
                        series: {
                            animation: false,
                            lineWidth: 1,
                            shadow: false,
                            states: {
                                hover: {
                                    lineWidth: 1
                                }
                            },
                            marker: {
                                radius: 1,
                                states: {
                                    hover: {
                                        radius: 3
                                    }
                                }
                            },
                            fillOpacity: 0.20
                        },
                        column: {
                            negativeColor: '#910000',
                            borderColor: 'silver'
                        }
                    }
                };

            options = Highcharts.merge(defaultOptions, options);

            return hasRenderToArg ?
                new Highcharts.Chart(a, options, c) :
                new Highcharts.Chart(options, b);
        }; 

        var start = +new Date(),
            $tds = $('.chart_price_main[data-sparkline]'),
            fullLen = $tds.length,
            n = 0;

        // Creating 153 sparkline charts is quite fast in modern browsers, but IE8 and mobile
        // can take some seconds, so we split the input into chunks and apply them in timeouts
        // in order avoid locking up the browser process and allow interaction.
        function doChunk() {
            var time = +new Date(),
                i,
                len = $tds.length,
                $td,
                stringdata,
                arr,
                data,
                chart;

            for (i = 0; i < len; i += 1) {
                $td = $($tds[i]);
                stringdata = $td.data('sparkline');
                arr = stringdata.split('; ');
                data = $.map(arr[0].split(', '), parseFloat);
                chart = {};

                if (arr[1]) {
                    chart.type = arr[1];
                }
                $td.highcharts('SparkLine', {
                    series: [{
                        data: data,
                        pointStart: 1
                    }],
                    tooltip: {
                        headerFormat: '<span style="font-size: 10px">' + $td.parent().find('th').html() + ', Q{point.x}:</span><br/>',
                        pointFormat: '<b>{point.y}.000</b> USD'
                    },
                    chart: chart
                });

                n += 1;

                // If the process takes too much time, run a timeout to allow interaction with the browser
                if (new Date() - time > 500) {
                    $tds.splice(0, i + 1);
                    setTimeout(doChunk, 0);
                    break;
                }

                // Print a feedback on the performance
                if (n === fullLen) {
                    $('#result').html('Generated ' + fullLen + ' sparklines in ' + (new Date() - start) + ' ms');
                }
            }
        }
        doChunk();

    </script>

<!-- datepicker-->


<!--datepicker--> 

<script src="assets/frontend/js/gijgo.js" type="text/javascript"></script>
<link href="assets/frontend/css/gijgo.css" rel="stylesheet" type="text/css" />  
<script>
        $('#datepicker').datepicker({
            uiLibrary: 'bootstrap4',
            iconsLibrary: 'fontawesome'
        });
     $('#datepicker1').datepicker({
            uiLibrary: 'bootstrap4',
            iconsLibrary: 'fontawesome'
        });
    $('#datepicker2').datepicker({
            uiLibrary: 'bootstrap4',
            iconsLibrary: 'fontawesome'
        });
    $('#datepicker3').datepicker({
            uiLibrary: 'bootstrap4',
            iconsLibrary: 'fontawesome'
        });
    $('#datepicker4').datepicker({
            uiLibrary: 'bootstrap4',
            iconsLibrary: 'fontawesome'
        });
    $('#datepicker5').datepicker({
            uiLibrary: 'bootstrap4',
            iconsLibrary: 'fontawesome'
        });
   
    
    </script> 

    <script type="text/javascript">
    var base_url = '<?php echo base_url();?>';
  var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
$(document).ready(function() {

$.ajaxPrefilter(function(options, originalOptions, jqXHR){
  if (options.type.toLowerCase() == 'post'){
  if (originalOptions.data instanceof FormData){
        originalOptions.data.append(csrfName, $("input[name=" + csrfName + "]").val());
    }
  else
  {
    options.data += '&' + csrfName + '=' + $("input[name=" + csrfName + "]").val();
    if (options.data.charAt(0) == '&'){
     options.data = options.data.substr(1);
    }
  }
   }
});



$(document).ajaxComplete(function(event, xhr, settings) {
       var n = settings.url.includes("get_simbolo"); 
       if (!n && settings.type != 'GET') {  
        $.ajax({   url: base_url + "/home/get_simbolo",  
                   type: "GET",  
                   cache: false,  
                   processData: false,  
                   success: function(data) {  
                     $("input[name=" + csrfName + "]").val(data.trim());   
                    } 
                     });
        }
});
})
function getcsrftoken()
{
  $.ajax({   url: base_url + "/home/get_simbolo",  
                   type: "GET",  
                   cache: false,  
                   processData: false,  
                   success: function(data) { 
                     $("input[name=" + csrfName + "]").val(data.trim());   
                    } 
                     });
}
</script>

<script>
$(window).scroll(function(){
  if ($(window).scrollTop() >= 50) {
     $('.fixed-top').addClass('back_fix');
  }
  else {
     $('.fixed-top').removeClass('back_fix');
  }
});
</script>

<script>
         // makes sure the whole site is loaded
         jQuery(window).load(function() {
                 // will first fade out the loading animation
          jQuery("#status").fadeOut();
                 // will fade out the whole DIV that covers the website.
          jQuery("#preloader").delay(1000).fadeOut("slow");
         })
      </script>
<script>

$(document).ready(function(){
$(".mobile_viw").click(function(){
$(".signup_form").addClass("signup_form_show");
});
$(".mobile_close").click(function(){
$(".signup_form").removeClass("signup_form_show");
});

});
</script>

<script>

var ajax_call = function() {
  //your jQuery ajax code
 var user_id=$("#online_user").val();

$.ajax({
     type : "POST",
     url : "<?php echo base_url()?>home/user_check/<?php echo user_id() ?>",
     success : function(response) {                      
        }
     });
};
var interval = 1000 * 60 * 0.3; // where X is your every X minutes

setInterval(ajax_call, interval);



/* function user_check(){
var user_id=$("#online_user").val();

$.ajax({
         type : "POST",
         url : "<?php echo base_url()?>home/user_check/<?php echo user_id() ?>",
         success : function(response) {                      
         
                      
                    }
                });

} */


callcheck();
function callcheck(){
setTimeout(function(){
      notification();
      }, 1000);
}

function notification()
{

        $.ajax({
                  type : "POST",
                  url : "<?php echo base_url()?>home/notification",
                  success : function(response) {                      
                        $("#notification_list").html(response);
                      
                    }
                });



  
}


$( "#notificationmenu" ).click(function() { 
          $.ajax({
                  type : "POST",
                  url : "<?php echo base_url()?>home/notification_list",
                  success : function(response) {                      
                        $("#nodata").html(response);
                      
                    }
                });

});

</script>

<script language="JavaScript">
window.onbeforeunload = WindowCloseHanlder;
function WindowCloseHanlder()
{
window.alert('My Window is closing');
}
</script>
     


</body>

<style>

.error {
    color: red !important;
    width: 100%;
}
</style>

</html>