
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->

    <!-- datatable js start here -->
    <!--<script language="JavaScript" src="https://code.jquery.com/jquery-1.11.1.min.js" type="text/javascript"></script>-->
    <script language="JavaScript" src="https://cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script language="JavaScript" src="https://cdn.datatables.net/plug-ins/3cfcc339e89/integration/bootstrap/3/dataTables.bootstrap.js" type="text/javascript"></script>
    <!-- datatable js end here -->

    <script src="<?php echo base_url(); ?>assets/admin/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/admin/js/dashboard.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/admin/js/lc_switch.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>assets/admin/plugins/validate/jquery.validate.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>assets/admin/plugins/validate/additional-methods.js" type="text/javascript"></script> 
    <!-- <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>-->

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/lc_switch.css">
    <?php $this->load->view('admin/common/csrf'); ?>
    <script type="text/javascript">
    /*search menu click jquery starts*/
    $('.showresult').click(function(){
    $('.searc_drop').css('display','block');
    });
    /*search menu click jquery ends*/

    /*search menu close outside the container (i.e)., while clicking body starts*/
    $(document).mouseup(function(e)
    {
    var container = $(".searc_drop");
    // if the target of the click isn't the container nor a descendant of the container
    if (!container.is(e.target) && container.has(e.target).length === 0)
    {
     $('.searc_drop').css('display','none');
    }
    });
    /*search menu close outside the container (i.e)., while clicking body ends*/

    /*notification checkbox starts*/
    $(document).ready(function(e) {
    $('.setting_drp input').lc_switch();

    // triggered each time a field changes status
    $('body').delegate('.lcs_check', 'lcs-statuschange', function() {
    var status = ($(this).is(':checked')) ? 'checked' : 'unchecked';
    console.log('field changed status: '+ status );
    });

    // triggered each time a field is checked
    $('body').delegate('.lcs_check', 'lcs-on', function() {
    console.log('field is checked');
    });

    // triggered each time a is unchecked
    $('body').delegate('.lcs_check', 'lcs-off', function() {
    console.log('field is unchecked');
    });
    });
    /*notification checkbox ends*/
    </script>
  
    <?php /* <script type="text/javascript">
    setInterval(function() {
      $.ajax({
        url: "<?php echo base_url();?>BoNotification/viewnotificationcount",
        type: "GET",
        processData:false,
        success: function(data){
          $("#notification-count").show();
          $("#notification-count").html(data);  
        },
        error: function(){}           
      });
    }, 6000);

    function viewnotification() {
      $.ajax({
        url: "<?php echo base_url();?>BoNotification/viewnotification",
        type: "GET",
        processData:false,
        success: function(data){
         $("#notification-count").remove();  
         $("#listnotification").toggle();$("#listnotification").html(data);        
        },
        error: function(){}           
      });
    }
    </script>  */ ?>    
