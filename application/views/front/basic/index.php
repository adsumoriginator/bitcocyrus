<?php $this->load->view('front/basic/header.php');?>
<?php $this->load->view('front/basic/outer_header.php');?>


<!--================Main Slider Area =================-->
<section class="home_agency_slider_area">
    <div id="home_slider" class="rev_slider" data-version="5.3.1.6">
        <ul>
            <li data-index="rs-1587" data-transition="fade" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="default" data-easeout="default" data-masterspeed="300" data-thumb="<?php echo base_url() ?>assets/frontend/images/home-slider/slider-1.jpg" data-rotate="0" data-saveperformance="off" data-title="Creative" data-param1="01" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
                <!-- MAIN IMAGE -->
                <img src="<?php echo base_url() ?>assets/frontend/images/home-slider/slider-1.jpg" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="5" class="rev-slidebg" data-no-retina>
            </li>
			<li data-index="rs-1588" data-transition="fade" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="default" data-easeout="default" data-masterspeed="300" data-thumb="<?php echo base_url() ?>assets/frontend/images/home-slider/slider-2.jpg" data-rotate="0" data-saveperformance="off" data-title="Creative" data-param1="01" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
                <!-- MAIN IMAGE -->
                <img src="<?php echo base_url() ?>assets/frontend/images/home-slider/slider-2.jpg" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="5" class="rev-slidebg" data-no-retina>
            </li>
            <li data-index="rs-1589" data-transition="fade" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="default" data-easeout="default" data-masterspeed="300" data-thumb="<?php echo base_url() ?>assets/frontend/images/home-slider/slider-3.jpg" data-rotate="0" data-saveperformance="off" data-title="Creative" data-param1="01" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
                <!-- MAIN IMAGE -->
                <img src="<?php echo base_url() ?>assets/frontend/images/home-slider/slider-3.jpg" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="5" class="rev-slidebg" data-no-retina>
            </li>
		</ul>
    </div>
</section>
    
<section class="clients_slider_area">
    <div class="container-fluid">
        <div class="clients_slider owl-carousel" id="statics-slider">
            <?php 
                foreach($pairs as $pairrow){  
                    foreach ($pairrow as $row){               
                        $volume=getTradeVolume($row->id);
            ?>
            <a href="<?php echo base_url() ?>trade/<?php echo $row->from_currency_symbol."_".$row->to_currency_symbol ?>">
                <div class="item">
                    <div class="price_main pt-2">
                        <div class="coin_n w-100 d-table px-2 pb-2">
                            <span class="coin_name float-left"><?php  echo $row->trade_pair ?></span>
                            <span class="coin_per float-right <?php  if($row->change < 0){ echo 'text-danger'; }else { echo "text-success";}  ?>"><?php echo number_format($row->change,2) ?> %</span>
                        </div>
                        <div class="coin_p w-100 d-table px-2 pb-3">
                            <span class="coin_value float-left"><?php echo number_format($row->price,8) ." ". $row->to_currency_symbol;?></span>
                        </div>
                        <div class="coin_v w-100 d-table text-center">
                            <div class="coin_vol"><?php  echo number_format($row->volume, 3) ?></div>
                        </div>
                        <div class="chart_price_main" data-sparkline="20, 42, 48, 78, 60, 89, 65, 90 "></div>
                    </div>
                </div>
            </a>
            <?php
                    }
                }
            ?>
        </div>
    </div>
</section>

<!--================Market Area =================-->
<section class="market_area p_100">
    <div class="container">
        <div class="market_inner">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#btc" role="tab" aria-controls="btc" aria-selected="false">BTC</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#eth" role="tab" aria-controls="eth" aria-selected="false">ETH</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#bch" role="tab" aria-controls="bch" aria-selected="false">BCH</a>
                </li>
        <li class="nav-item">
                    <a class="nav-link" id="home-tab" data-toggle="tab" href="#usdt" role="tab" aria-controls="usdt" aria-selected="true">USDT</a>
                </li>
            </ul>

            <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="btc" role="tabpanel" aria-labelledby="btc-tab">
                    <div class="table-responsive market-data-table">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Pair</th>
                                    <th>Last Price</th>
                                    <th>24hr Change</th>
                                    <th>24hr High</th>
                                    <th>24hr Low</th>
                                    <th>24hr Volume</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php
                                    foreach($pairs["BTC"] as $row){
                                        $tr_pair=$row->from_currency_symbol.'_'.$row->to_currency_symbol;
                                        $current_trad = current_trad_volume($row->id);
                                ?> 
                                <tr href="<?php echo base_url() ?>trade/<?php echo $row->from_currency_symbol."_".$row->to_currency_symbol ?>">
                                    <td>
									<?php 
										$img_exist = "assets/frontend/images/coins_icons/".strtolower($row->from_currency_symbol).".png";
									?>
									<img class="coin-icon" src="<?php echo base_url(); ?>assets/frontend/images/coins_icons/<?php if(file_exists($img_exist)){ echo strtolower($row->from_currency_symbol);} else { echo "null";}?>.png">
									<span class="pl-5"><?php echo $row->from_currency_symbol;?></span></td>
                                    <td><span class="p_up_down p_up"><?php echo  $row->price ?></span></td>
                                    <td><span class="<?php  if($row->change < 0){ echo 'text-danger'; }else { echo "text-success";}  ?>">   
                                        <?php
                        if($row->change == 0){
                                    ?>
                    <?php   echo number_format($row->change,2)."%";  ?>
                    <?php }else if($row->change >0){ ?>
                      +<?php    echo number_format($row->change,2)."%";  ?> </td>
                    <?php
                        }else{
                    ?>
                    -<?php    echo number_format($row->change,2)."%";  ?>
                    <?php
                      }
                    ?></span></td>
                                    <td><?php echo number_format($current_trad['high'],8) ;?></td>
                                    <td> <?php echo number_format($current_trad['low'],8) ;?></td>
                                    <td><?php echo number_format($row->volume,8) ;  ?></td>
                                </tr>
                                <?php
                                    }
                                ?>                               
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade" id="eth" role="tabpanel" aria-labelledby="eth-tab">

                    <div class="table-responsive market-data-table">

                        <table class="table">

                            <thead>

                                <tr>

                                    <th>Pair</th>

                                    <th>Last Price</th>

                                    <th>24h Change</th>

                                    <th>24h High</th>

                                    <th>24h Low</th>

                                    <th>24h Volume</th>

                                </tr>

                            </thead>

                            <tbody>

                               
<?php
 foreach($pairs["ETH"] as $row){
$tr_pair=$row->from_currency_symbol.'_'.$row->to_currency_symbol;
$current_trad = current_trad_volume($row->id);
?>


                                <tr href="<?php echo base_url() ?>trade/<?php echo $row->from_currency_symbol."_".$row->to_currency_symbol ?>">
									<td>
                                    <?php 
										$img_exist = "assets/frontend/images/coins_icons/".strtolower($row->from_currency_symbol).".png";
									?>
									<img class="coin-icon" src="<?php echo base_url(); ?>assets/frontend/images/coins_icons/<?php if(file_exists($img_exist)){ echo strtolower($row->from_currency_symbol);} else { echo "null";}?>.png">
									<span class="pl-5"><?php echo $row->from_currency_symbol;?></span></td>
                                    <td><span class="p_up_down p_up"><?php echo  $row->price ?></span></td>
                                    <td><span class="<?php  if($row->change < 0){ echo 'text-danger'; }else { echo "text-success";}  ?>">   <?php
  
                          if($row->change == 0){
                          ?>

                        <?php   echo number_format($row->change,2)."%";  ?>
                        <?php }else if($row->change >0){ ?>

                      +<?php    echo number_format($row->change,2)."%";  ?> </td>

                        <?php
                      }else{
                        ?>
                       -<?php    echo number_format($row->change,2)."%";  ?>
                      <?php
                      }

                      ?></span></td>

                                    <td><?php echo number_format($current_trad['high'],8) ;?></td>

                                    <td> <?php echo number_format($current_trad['low'],8) ;?></td>

                                    <td><?php  echo number_format($row->volume,3);  ?></td>

                                </tr>
                
                

   <?php
}
?>  

                               


                            </tbody>

                        </table>

                    </div>

                </div>

                <div class="tab-pane fade" id="bch" role="tabpanel" aria-labelledby="bch-tab">

                    <div class="table-responsive market-data-table">

                        <table class="table">

                            <thead>

                                <tr>

                                    <th>Pair</th>

                                    <th>Last Price</th>

                                    <th>24h Change</th>

                                    <th>24h High</th>

                                    <th>24h Low</th>

                                    <th>24h Volume</th>

                                </tr>

                            </thead>

                            <tbody>

                             
<?php
 foreach($pairs["BCH"] as $row){
$tr_pair=$row->from_currency_symbol.'_'.$row->to_currency_symbol;
$current_trad = current_trad_volume($row->id);
?>
                                <tr href="<?php echo base_url() ?>trade/<?php echo $row->from_currency_symbol."_".$row->to_currency_symbol ?>">
                                    <td>
									<?php 
										$img_exist = "assets/frontend/images/coins_icons/".strtolower($row->from_currency_symbol).".png";
									?>
									<img class="coin-icon" src="<?php echo base_url(); ?>assets/frontend/images/coins_icons/<?php if(file_exists($img_exist)){ echo strtolower($row->from_currency_symbol);} else { echo "null";}?>.png">
									<span class="pl-5"><?php echo $row->from_currency_symbol;?></span></td>
                                    <td><span class="p_up_down p_up"><?php echo  $row->price ?></span></td>
                                    <td><span class="<?php  if($row->change < 0){ echo 'text-danger'; }else { echo "text-success";}  ?>">   <?php

  
                          if($row->change == 0){
                          ?>

                        <?php   echo number_format($row->change,2)."%";  ?>
                        <?php }else if($row->change >0){ ?>

                      +<?php    echo number_format($row->change,2)."%";  ?> </td>

                        <?php
                      }else{
                        ?>
                       -<?php    echo number_format($row->change,2)."%";  ?>
                      <?php
                      }

                      ?></span></td>

                                    <td><?php echo number_format($current_trad['high'],8) ;?></td>

                                    <td> <?php echo number_format($current_trad['low'],8) ;?></td>

                                    <td><?php  echo number_format($row->volume,3);  ?></td>

                                </tr>

   <?php
}
?>  

                            </tbody>

                        </table>

                    </div>

                </div>

        <div class="tab-pane fade" id="usdt" role="tabpanel" aria-labelledby="usdt-tab">
                    <div class="table-responsive market-data-table">

                        <table class="table">

                            <thead>

                                <tr>

                                    <th>Pair</th>

                                    <th>Last Price</th>

                                    <th>24h Change</th>

                                    <th>24h High</th>

                                    <th>24h Low</th>

                                    <th>24h Volume</th>

                                </tr>

                            </thead>

                            <tbody>

                               
<?php
 foreach($pairs["USDT"] as $row){
$tr_pair=$row->from_currency_symbol.'_'.$row->to_currency_symbol;
$current_trad = current_trad_volume($row->id);
?>
                                <tr href="<?php echo base_url() ?>trade/<?php echo $row->from_currency_symbol."_".$row->to_currency_symbol ?>">
                                    <td>
									<?php 
										$img_exist = "assets/frontend/images/coins_icons/".strtolower($row->from_currency_symbol).".png";
									?>
									<img class="coin-icon" src="<?php echo base_url(); ?>assets/frontend/images/coins_icons/<?php if(file_exists($img_exist)){ echo strtolower($row->from_currency_symbol);} else { echo "null";}?>.png">
									<span class="pl-5"><?php echo $row->from_currency_symbol;?></span></td>
                                    <td><span class="p_up_down p_up"><?php echo  $row->price ?></span></td>

                                    <td><span class="<?php  if($row->change < 0){ echo 'text-danger'; }else { echo "text-success";}  ?>">   <?php

  
                          if($row->change == 0){
                          ?>

                        <?php   echo number_format($row->change,2)."%";  ?>
                        <?php }else if($row->change >0){ ?>

                      +<?php    echo number_format($row->change,2)."%";  ?> </td>

                        <?php
                      }else{
                        ?>
                       -<?php    echo number_format($row->change,2)."%";  ?>
                      <?php
                      }

                      ?></span></td>

                                    <td><?php echo number_format($current_trad['high'],8) ;?></td>

                                    <td> <?php echo number_format($current_trad['low'],8) ;?></td>

                                    <td><?php  echo number_format($row->volume,3);  ?></td>

                                </tr>

   <?php
}
?>  

                               
                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<!--================Trade Area =================-->
<section class="start_trade">

  <div class="container">
    <h2 class="wow zoomIn"  ><?php echo $footer_cnt->heading; ?></h2>          
    
    <p><?php echo $footer_cnt->content; ?></p>
    
    <?php if(user_id()!=""){ ?>
    <a class="start_btn" href="<?php echo base_url() ?>trade" >START TRADING</a>
    <?php }else{ ?>
    <a id="start_trade" class="start_btn" href="<?php echo base_url() ?>trade">START TRADING</a>
      <?php } ?>
</div>
</section>

<input type="hidden" id="pair_id" value="1">

<!--================Footer Area =================-->
<?php $this->load->view('front/basic/footer.php');?>

<script>
  
var pair_id=1;
var pagetype="home";
var user_id=1;
var base_url="<?php echo base_url() ?>";

</script>
<script>
$(document).ready(function(){
  
  
    $('table tr').click(function(){
        window.location = $(this).attr('href');
        return false;
    });
});



$(document).ready(function(){
  
  //var current_trade=designs.current_trade;

    $('table.pair_table_btc tr:gt(10)').hide(); 
  
  $('a[href^="#expe1"]').on('click', function(event) {

    $('table.pair_table_btc tr:gt(10)').show(); 
    $('#expe').hide(); 
});
});


   $(function(){
        var x = 0;
        setInterval(function(){
            x-=1;
            $('.moving2').css('background-position', x + 'px 0');
        }, 50);
    })
  </script> 
<script src="<?php echo js_url().'home.js?'.time();?>"></script>
