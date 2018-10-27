<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>">


<script type="text/javascript"> 

  var base_url = $("#base_url").val();


  var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
$(document).ready(function() {

$.ajaxPrefilter(function(options, originalOptions, jqXHR) { 
  if (options.type.toLowerCase() == 'post') { 
  if (originalOptions.data instanceof FormData) { 
        originalOptions.data.append(csrfName, $("input[name=" + csrfName + "]").val()); 
    }
  else
  {
    options.data += '&' + csrfName + '=' + $("input[name=" + csrfName + "]").val(); 
    if (options.data.charAt(0) == '&') {  
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
</script>