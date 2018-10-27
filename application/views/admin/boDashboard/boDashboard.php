


<?php 
$this->load->view("admin/header") ?>





  <style type="text/css">
    .graphMinHgt {
      min-height: 400px;
      width: 100%;
      position: relative;
    }
    .loaderGraph {
      background: rgba(0, 0, 0, 0.5) none repeat scroll 0 0;
      content: "";
      height: 100%;
      left: 0;
      position: absolute;
      top: 0;
      width: 100%;
      z-index: 1;
    }
    .loaderGraph img {
      position: absolute;
      left: 0;
      right: 0;
      top: 0;
      bottom: 0;
      margin: auto;
    }    
  </style>

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->

<body class="hold-transition sidebar-mini">

<div class="loader" id="myLoad">
  <div class="spinner">
    <div class="double-bounce1"></div>
    <div class="double-bounce2"></div>
  </div>
</div>

<div class="wrapper">
  <?php $this->load->view('admin/common/header'); ?>
  <?php $this->load->view('admin/common/sidebar'); ?>
  <?php
    $atrtibute = array('class'=>'');
    echo form_open('',$atrtibute);
  ?>
  <div class="content-wrapper">
    <section class="content">
      <ul class="breadcrumb cm_breadcrumb">
        <li><a href="#">Home</a></li>
      </ul>
      <div class="mainWrapper">


    <?php


    $admin_id=$this->session->userdata("loggedJTEAdminUserID");


        $condition=array("admin_id"=>$admin_id);
 
;

    if($admin_id==1){


       $user_access=1;
       $tfa=1;
       $trade=1;
       $deposit_withdraw=1;
       $wallet=1;
       $subscriper=1;
       $support=1;
       $cms=1;
       $template=1;
       $currency=1;

    }else{

       $admindetals=$this->CommonModel->getTableData("sub_admin_permissions",$condition)->row();   

       $user_access=$admindetals->user_details;
       $tfa=$admindetals->tfa;
       $trade=$admindetals->trade;
       $deposit_withdraw=$admindetals->deposit_withdraw;
       $wallet=$admindetals->wallet;
       $subscriper=$admindetals->subscriper;
       $support=$admindetals->support;
       $cms=$admindetals->cms;
       $template=$admindetals->template;
       $currency=$admindetals->currency_details;
     

}

?>



        <div class="cardsTopSec mb-20">
          <div class="row">
          <?php
          if( $user_access==1) {
            ?>

            <div class="col-md-3 col-sm-6">
              <div class="cardsBlk cardsClr1">
                <p>Total users  <a href="<?php echo base_url()."BoUser/view"; ?>">View</a></p>
                  <div class="midSec">
              
                    <?php echo $siteUserCount; ?>
                  </div>
              </div>
            </div>
            <?php
          }
        

 if($currency==1){
            ?>

            <div class="col-md-3 col-sm-6">
              <div class="cardsBlk cardsClr5">
                <p>Currency  <a href="<?php echo base_url()."BoCoin_settings/view_coin"; ?>">View</a> </p>
                <div class="midSec">
                    <?php echo $currency_count; ?>
                </div>
              </div>
            </div>
            <?php
          }



 if($trade==1){
            ?>
            <div class="col-md-3 col-sm-6">
              <div class="cardsBlk cardsClr3">
                <p>Trade pairs  <a href="<?php echo base_url()."BoCoin_settings/trade_pairs"; ?>">View</a>  </p>
                <div class="midSec">
                     <?php echo $trade_pair; ?>
                </div>
              </div>
            </div>


            <?php

          }
          if($deposit_withdraw==1){
            ?>

             <div class="col-md-3 col-sm-6">
              <div class="cardsBlk cardsClr3">
                <p>Wthdraw Request  <a href="<?php echo base_url()."BoAdmin_Transation/withdraw"; ?>">View</a></p>
                <div class="midSec">
                  <?php echo $withdraw_request; ?>
                </div>
              </div>
            </div>


            <?php
          }
          ?>

          </div>
          <div class="row">
           <?php
      if($deposit_withdraw==1){
            ?>

                <div class="col-md-3 col-sm-6">
              <div class="cardsBlk cardsClr2">
                <p>Deposit   <a href="<?php echo base_url()."BoAdmin_Transation/deposit"; ?>">View</a> </p>
                <div class="midSec">
                  <?php echo $deposits; ?>
                </div>
                <div class="bottomSec">
                </div>
              </div>
            </div>  

<?php
}


  if($support==1){
?>

            <div class="col-md-3 col-sm-6">
              <div class="cardsBlk cardsClr4">
                <p>Support Ticket <a href="<?php echo base_url()."BoSupport_ticket/support_us"; ?>">View</a> </p>
                  <div class="midSec">
              
<?php echo $support_count;  ?>
                  </div>
              </div>
            </div>



            <div class="col-md-3 col-sm-6">
              <div class="cardsBlk cardsClr2">
                <p>Subscribers  <a href="<?php echo base_url()."BoSupport_ticket/subscriber"; ?>">View</a></p>
                <div class="midSec">
                  <?php echo $subscribers; ?>
                </div>
                <div class="bottomSec">
                </div>
              </div>
            </div>
            <?php
}
?>
                  
          </div>
        </div>
       <div class="cardsTopSec mb-20">
          <div id="container" style="min-width: 100%; height: 400px; margin: 0 auto"></div>
        </div> 

        <!-- <ul id="draggablePanelList" class="list-unstyled">
            <li class="panel">
              <div class="fancy-collapse-panel usrsFees">
                  <div class="panel-group" id="accordionUsrsFees" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default">
                      <div class="panel-heading" role="tab" id="headingOne">
                          <h4 class="panel-title">
                              <div class="panelLft">
                                <img src="<?php echo base_url(); ?>assets/admin/images/users-icon.png" /><span>Trade</span>
                              </div>
                              <div class="panelRight">
                                <a href="#">Today</a>
                                <a href="#">This Week</a>
                                <a href="#">This Month</a>
                                <a href="#"><img src="<?php echo base_url(); ?>assets/admin/images/drog-icon.png" /></a>
                                <a data-toggle="collapse" data-parent="#accordionUsrsFees" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                  <div id="container" class="graphMinHgt"></div>
                                  <span class=""><img src="<?php echo base_url(); ?>assets/admin/images/bar-icon.png" /></span>
                                </a>
                              </div>
                          </h4>
                      </div>
                      <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                          <div class="panel-body panelMinHgt">
                              <img src="<?php echo base_url(); ?>assets/admin/images/graph.jpg" class="img-responsive" />
                          </div>
                      </div>
                    </div>
                  </div>
                </div>
            </li>
            <li class="panel">
              <div class="fancy-collapse-panel chatBox">
                  <div class="panel-group" id="accordion1" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingTwo">
                            <h4 class="panel-title">
                                <div class="panelLft">
                                  <img src="<?php echo base_url(); ?>assets/admin/images/chat-icon.png" /><span>Chat</span>
                                </div>
                                <div class="panelRight">
                                  <a href="#">Online</a>
                                  <a href="#">Offline</a>
                                  <a href="#">Invisible</a>
                                  <a href="#"><img src="<?php echo base_url(); ?>assets/admin/images/drog-icon.png" /></a>
                                  <a data-toggle="collapse" data-parent="#accordion1" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                    <span class=""><img src="<?php echo base_url(); ?>assets/admin/images/bar-icon.png" /></span>
                                  </a>
                                </div>
                            </h4>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTwo">
                            <div class="panel-body panelMinHgt p-0">
                              <div class="ofChatWindow">
                                                        <div class="">
                                                            <div class="row m-0 chatContent">
                                                                <div class="chatRow sent">
                                                                    <div class="chatImg">
                                                                        <img src="<?php echo base_url(); ?>assets/admin/images/client-1.jpg">
                                                                    </div>
                                                                    <div class="chatPop">
                                                                        Hi
                                                                    </div>
                                                                </div>
                                                                <div class="chatRow receive">
                                                                    <div class="chatImg">
                                                                        <img src="<?php echo base_url(); ?>assets/admin/images/client-2.jpg">
                                                                    </div>
                                                                    <div class="chatPop">
                                                                        Hello
                                                                    </div>
                                                                </div>
                                                                <div class="chatRow receive">
                                                                    <div class="chatImg">
                                                                        <img src="<?php echo base_url(); ?>assets/admin/images/client-2.jpg">
                                                                    </div>
                                                                    <div class="chatPop">
                                                                        Did you read all my terms / offers?
                                                                    </div>
                                                                </div>
                                                                <div class="chatRow sent">
                                                                    <div class="chatImg">
                                                                        <img src="<?php echo base_url(); ?>assets/admin/images/client-1.jpg">
                                                                    </div>
                                                                    <div class="chatPop">
                                                                        Yes
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row m-0 chatFooter">
                                                                <div class="col-sm-10 col-xs-9">
                                                                    <div class="input-group">
                                                                        <div class="input-group-btn">
                                                                          <button class="btn btn-default" type="submit">
                                                                            <i class="fa fa-paperclip"></i>
                                                                          </button>
                                                                        </div>
                                                                        <input type="text" class="form-control" placeholder="Message...">
                                                                      </div>
                                                                </div>
                                    <div class="col-sm-2 col-xs-3 p-0">
                                                                    <span class="smileyIcon"><a href="#"><i class="fa fa-smile-o"></i></a></span>
                                      <span class="sendIcon"><a href="#"><i class="fa fa-paper-plane"></i></a></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
            </li>
            <li class="panel">
              <div class="fancy-collapse-panel usrsFrom">
                  <div class="panel-group" id="accordion2" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="usersFrom">
                            <h4 class="panel-title">
                                <div class="panelLft">
                                  <img src="<?php echo base_url(); ?>assets/admin/images/users-icon.png" /><span>Users From</span>
                                </div>
                                <div class="panelRight">
                                  <a href="#"><img src="<?php echo base_url(); ?>assets/admin/images/drog-icon.png" /></a>
                                  <a data-toggle="collapse" data-parent="#accordion2" href="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                    <span class=""><img src="<?php echo base_url(); ?>assets/admin/images/bar-icon.png" /></span>
                                  </a>
                                </div>
                            </h4>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="usersFrom">
                            <div class="panel-body panelMinHgt">
                                <img src="<?php echo base_url(); ?>assets/admin/images/pie-chart.jpg" class="img-responsive" />
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
            </li>
            <li class="panel">
              <div class="fancy-collapse-panel totDepWdw">
                  <div class="panel-group" id="accordion3" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingThree">
                            <h4 class="panel-title">
                                <div class="panelLft">
                                  <img src="<?php echo base_url(); ?>assets/admin/images/db-icon.png" /><span>Total Deposit and Withdraw</span>
                                </div>
                                <div class="panelRight">
                                  <a href="#">Today</a>
                                  <a href="#">This Week</a>
                                  <a href="#">This Month</a>
                                  <a href="#"><img src="<?php echo base_url(); ?>assets/admin/images/drog-icon.png" /></a>
                                  <a data-toggle="collapse" data-parent="#accordion3" href="#collapseTotDepWdw" aria-expanded="true" aria-controls="collapseTotDepWdw">
                                    <span class=""><img src="<?php echo base_url(); ?>assets/admin/images/bar-icon.png" /></span>
                                  </a>
                                </div>
                            </h4>
                        </div>
                        <div id="collapseTotDepWdw" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree">
                            <div class="panel-body panelMinHgt">
                                <img src="<?php echo base_url(); ?>assets/admin/images/bar-chart.jpg" class="img-responsive" />
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
            </li>
            <li class="panel">
              <div class="fancy-collapse-panel eventCalendar">
                  <div class="panel-group" id="accordion5" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingFive">
                            <h4 class="panel-title">
                                <div class="panelLft">
                                  <img src="<?php echo base_url(); ?>assets/admin/images/calendar-icon.png" /><span>Calendar</span>
                                </div>
                                <div class="panelRight">
                                  <a href="#"><img src="<?php echo base_url(); ?>assets/admin/images/drog-icon.png" /></a>
                                  <a data-toggle="collapse" data-parent="#accordion5" href="#collapseCalendar" aria-expanded="true" aria-controls="collapseCalendar">
                                    <span class=""><img src="<?php echo base_url(); ?>assets/admin/images/bar-icon.png" /></span>
                                  </a>
                                </div>
                            </h4>
                        </div>
                        <div id="collapseCalendar" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingFive">
                            <div class="panel-body panelMinHgt" style="padding:5px;">
                              <div id='calendar' class="pt-10"></div>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
            </li>
            <li class="panel">
              <div class="fancy-collapse-panel usrsFrom">
                  <div class="panel-group" id="accordion7" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="alertInfo">
                            <h4 class="panel-title">
                                <div class="panelLft">
                                  <img src="<?php echo base_url(); ?>assets/admin/images/warning-icon.png" /><span>Alert / Information</span>
                                </div>
                                <div class="panelRight">
                                  <a href="#"><img src="<?php echo base_url(); ?>assets/admin/images/drog-icon.png" /></a>
                                  <a data-toggle="collapse" data-parent="#accordion7" href="#collapseAlertInfo" aria-expanded="true" aria-controls="collapseAlertInfo">
                                    <span class=""><img src="<?php echo base_url(); ?>assets/admin/images/bar-icon.png" /></span>
                                  </a>
                                </div>
                            </h4>
                        </div>
                        <div id="collapseAlertInfo" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="alertInfo">
                            <div class="panel-body">
                              <div class="paneIn">
                                <form class="form-inline">
                                  <div class="mb-10">
                                    <textarea cols="4" rows="4">Ripple (XRP), Monero (XMR) will be available soon  from Tradecoin wallet</textarea>
                                  </div>
                                  <div class="optBtns">
                                    <div class="radio">
                                      <label class="">
                                        <input type="radio" name="o5" value="">
                                        <span class="cr"><i class="cr-icon fa fa-circle"></i></span>
                                        <span class="">All Pages</span>
                                      </label>
                                    </div>
                                    <div class="radio">
                                      <label class="">
                                        <input type="radio" name="o5" value="">
                                        <span class="cr"><i class="cr-icon fa fa-circle"></i></span>
                                        <span class="">Home</span>
                                      </label>
                                    </div>
                                    <div class="radio">
                                      <label class="">
                                        <input type="radio" name="o5" value="">
                                        <span class="cr"><i class="cr-icon fa fa-circle"></i></span>
                                        <span class="">Dashboard</span>
                                      </label>
                                    </div>
                                    <div class="radio">
                                      <label class="">
                                        <input type="radio" name="o5" value="">
                                        <span class="cr"><i class="cr-icon fa fa-circle"></i></span>
                                        <span class="">Trade</span>
                                      </label>
                                    </div>

                                      <button type="button" class="cm_blacbtn1 fright">Submit</button>
                                  </div>

                                </form>
                              </div>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
            </li>
            <li class="panel">
              <div class="fancy-collapse-panel usrsFrom">
                  <div class="panel-group" id="accordion6" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="alertInfo">
                            <h4 class="panel-title">
                                <div class="panelLft">
                                  <img src="<?php echo base_url(); ?>assets/admin/images/db-icon.png" /><span>Fees</span>
                                </div>
                                <div class="panelRight">
                                  <a href="#"><img src="<?php echo base_url(); ?>assets/admin/images/drog-icon.png" /></a>
                                  <a data-toggle="collapse" data-parent="#accordion6" href="#collapseFees" aria-expanded="true" aria-controls="collapseFees">
                                    <span class=""><img src="<?php echo base_url(); ?>assets/admin/images/bar-icon.png" /></span>
                                  </a>
                                </div>
                            </h4>
                        </div>
                        <div id="collapseFees" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="fees">
                            <div class="panel-body">
                              <div class="feesPaneIn">
                                <form class="form-inline">
                                  <div class="form-group">
                                    <div class="input-group">
                                      <input id="msg" type="text" class="form-control" name="msg" placeholder="0.1">
                                      <span class="input-group-addon">%</span>
                                    </div>
                                    <span class="spanLbl">From</span>
                                    <div class="input-group">
                                      <input id="msg" type="text" class="form-control" name="msg" placeholder="1000">
                                      <span class="input-group-addon">USD</span>
                                    </div>
                                    <span class="spanLbl">To</span>
                                    <div class="input-group">
                                      <input id="msg" type="text" class="form-control" name="msg" placeholder="1000">
                                      <span class="input-group-addon">USD</span>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <div class="input-group">
                                      <input id="msg" type="text" class="form-control" name="msg" placeholder="0.1">
                                      <span class="input-group-addon">%</span>
                                    </div>
                                    <span class="spanLbl">From</span>
                                    <div class="input-group">
                                      <input id="msg" type="text" class="form-control" name="msg" placeholder="1000">
                                      <span class="input-group-addon">USD</span>
                                    </div>
                                    <span class="spanLbl">To</span>
                                    <div class="input-group">
                                      <input id="msg" type="text" class="form-control" name="msg" placeholder="1000">
                                      <span class="input-group-addon">USD</span>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <div class="input-group">
                                      <input id="msg" type="text" class="form-control" name="msg" placeholder="0.1">
                                      <span class="input-group-addon">%</span>
                                    </div>
                                    <span class="spanLbl">From</span>
                                    <div class="input-group">
                                      <input id="msg" type="text" class="form-control" name="msg" placeholder="1000">
                                      <span class="input-group-addon">USD</span>
                                    </div>
                                    <span class="spanLbl">To</span>
                                    <div class="input-group">
                                      <input id="msg" type="text" class="form-control" name="msg" placeholder="1000">
                                      <span class="input-group-addon">USD</span>
                                    </div>
                                  </div>
                                  <div class="text-center">
                                    <button type="button" class="btn cm_blacbtn1">Submit</button>
                                  </div>
                                </form>
                              </div>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
            </li> -->
        </ul>
      </div>
    </section>
  </div>
  <?php echo form_close(); ?>
  <!-- <footer class="main-footer"> Copyright &copy; <?php echo $copyRight." ".$copySiteTitle; ?>. All rights reserved. </footer> -->
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php echo base_url(); ?>assets/admin/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/dashboard.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/lc_switch.js" type="text/javascript"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/lc_switch.css">
<?php $this->load->view('admin/common/csrf'); ?>
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
</script> */ ?>
<script src="<?php echo base_url(); ?>assets/admin/js/highcharts.js"></script>
<script src="<?php echo base_url(); ?>assets/front/plugins/highchart/exporting.js"></script>
<script type = "text/javascript">
  setTimeout(function() {
     document.getElementById("myLoad").style.display="none";
  }, 3000);
  /*var datas='<?php echo $chartdata;?>';
  var chartdata=JSON.parse(datas);
  Highcharts.chart('container', {
    title: {
        text: 'Site Transaction Chart'
    },
    xAxis: {
        categories:chartdata.xaxis,
        title: {
            text: 'Date'
        }
    },
    yAxis: {
        title: {
            text: 'Snow depth (m)'
        },
        min: 0
    },
    tooltip: {
        headerFormat: '<b>{series.name}</b><br>',
        pointFormat: '{point.y:.2f}'
    },
    credits: {
      enabled: false
    },    
    plotOptions: {
        spline: {
            marker: {
                enabled: true
            }
        }
    },
    series: chartdata.series
  });*/
</script>
<!-- hightchart section script end here -->
</body>
</html>