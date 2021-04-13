<?php $this->load->view('front/basic/header_trade'); ?>
<div class="main_div">


<?php


if($this->session->userdata("mode")){
     $mode=$this->session->userdata("mode");
   

}else{

  $userdata=array("mode"=>"day");
  $mode="day";
  $this->session->set_userdata($userdata);

}
?>

  <div class="watch_list">
            <div class="holdig">
				<div class="row">
					<div class="col-lg-10 col-10 pl-0 pr-0">
						<div class="holdig_curry">
							<h4><?php echo $pair_details->exchange_name; ?> Exchange</h4>
						</div>
						<div class="holdig_bal text-success text-center"><?php echo $pair[0];?>/<?php echo $pair[1];?></div>
					</div>
					<div class="col-lg-2 col-2 pl-0 pr-0">
						<div class="nav-link mode" >

                            <?php
                             if($mode == "day"){ ?>
              <a style="cursor: pointer;" id="theme_change" data-mode="day" ><i class="cursor fa "></i></a>
                        <?php }else{?>
              <a style="cursor: pointer;" id="theme_change" data-mode="night" ><i class="cursor fa "></i></a>
                        <?php } ?>
            </div>
          </div>
        </div>
            </div>
            <div class="search_box">
        <div class="row">
          <div class="col-lg-4 col-4 pl-0 pr-0">
            <label class="custom-control custom-checkbox text-center">
              <input type="checkbox" class="custom-control-input select_fav">
              <span class="custom-control-indicator"></span>
              <span class="custom-control-description"><i style="cursor:pointer;" class="fa fa-star star_active" aria-hidden="true"></i> &nbsp; Show </span>
            </label>
          </div>
          <div class="col-lg-8 col-5 pl-0 ">
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text fa fa-search"></div>
              </div>
              <input type="text" class="form-control"  placeholder="Search" id="myInput" onkeyup="filter_pairs()"  type="text">
              <span  id="clear_filter" style="display:none"> <a><i class="fa fa-times-circle"></i></a>
            </div>
          </div>
                </div>
            </div>
            <div class="buy_sell_main market_pair">
                <nav>
                    <div class="nav nav-tabs text-center" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link <?php if($pair[1]=="BTC"){ ?>active <?php } ?>" id="nav1" data-toggle="tab" href="#nav-BTC" role="tab" aria-controls="nav-home" aria-selected="true">BTC</a>
                        <a class="nav-item nav-link <?php if($pair[1]=="ETH"){ ?>active <?php } ?>" id="nav2" data-toggle="tab" href="#nav-ETH" role="tab" aria-controls="nav-profile" aria-selected="false">ETH</a>
                        <a class="nav-item nav-link <?php if($pair[1]=="BCH"){ ?>active <?php } ?>" id="nav-profile-tab" data-toggle="tab" href="#nav-BCH" role="tab" aria-controls="nav-profile" aria-selected="false">BCH</a>
                        <a class="nav-item nav-link <?php if($pair[1]=="USDT"){ ?>active <?php } ?>" id="nav-profile-tab" data-toggle="tab" href="#nav-USDT" role="tab" aria-controls="nav-profile" aria-selected="false">USDT</a>
            <span class="cog_ic"><a id="panel_settings" data-status="show" ><i class="fa fa-cog" aria-hidden="true"></i> </a></span>
                    </div>
          <div class="toolPanel" style="display: none;" id="market_settings">
            <div class="notch"></div>
            <div class="title">Market Settings</div>
            <div class="settingsRow rowSettings">
              <ul class="button-group" id="rowButtons">
              <li style="width: 30%;"><button data-row=5 class="button show show5 filter">5</button></li>
              <li style="width: 30%;"><button data-row=10 class="button show show10  filter" >10</button></li>
              <li style="width: 30%;"><button data-row=50 class="button show filter showALL">ALL</button></li>
              </ul>
              <div class="desc">Rows to Display :</div>
            </div>
            <div class="settingsRow starSettings">
              <ul class="button-group" id="starAllButtons">
              <li class="starAll "><button class="button button all_set_fav" data-url="starAll">All</button></li>
              <li class="starNone"><button class="button all_unset_fav" data-url="starNone">None</button></li>
              </ul>
              <div class="desc">Quick <i class="fa fa-star"></i> Select :</div>
            </div>
            </div>
       
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade  <?php if($pair[1]=="BTC"){ ?> show active <?php }else{?>   <?php } ?>" id="nav-BTC" role="tabpanel" aria-labelledby="nav1">
                        <div class="tbale_markets mt-0">
                            <div class="table-responsive">
                                <table class="table table-borderless table-dark table-hover pair_table_btc" id="btc_table">
                                    <thead>
                                        <tr>
                                            <th><a  onClick="star_click_filter('btc')" class="star_filter notshorted" data-filter="0"><i class="fa fa-star" aria-hidden="true"></i></a></th>
                                            <th data-sort="string" data-sort-onload="no" scope="col">Coin</th>
                                            <th data-sort="float" scope="col">Last Price</th>
                                            <th data-sort="float" scope="col">Change</th>
                                            <th data-sort="float" scope="col"> Volume  </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php

                                       $sel=$this->uri->segment(2);  
                                       $i=0;
                                       foreach($pairs["BTC"] as $row){
                                        $i++;
                                        $tr_pair=$row->from_currency_symbol.'_'.$row->to_currency_symbol;
                                    ?>
                                        <tr <?php if($sel==$tr_pair){?> class="active"  <?php } ?>  id="<?php echo $row->from_currency_symbol.'_'.$row->to_currency_symbol; ?>" <?php if($row->id!=$pair_id){ ?> <?php }else{ ?>class="active"<?php } ?> >

                                          <td value="<?php echo rand()?>">
                                            
                                            <i onclick="change_fav('<?php echo $row->from_currency_symbol.'_'.$row->to_currency_symbol; ?>')" data-pair="<?php echo $row->from_currency_symbol.'_'.$row->to_currency_symbol; ?>" class="fav fa fa-star" ></i>
                                               
                                            </td>
                                            
                                            <td <?php if($row->id!=$pair_id){ ?>onclick="change_pair('<?php echo $row->from_currency_symbol.'_'.$row->to_currency_symbol; ?>')" <?php } ?>>
                                                <?php echo trim($row->from_currency_symbol) ?></td>


                                             <td  <?php if($row->id!=$pair_id){ ?>onclick="change_pair('<?php echo $row->from_currency_symbol.'_'.$row->to_currency_symbol; ?>')" <?php } ?>  id="btc_<?php echo  $row->from_currency_symbol ?>_price"><?php echo  $row->price ?></td>
                                            <td  <?php if($row->id!=$pair_id){ ?>onclick="change_pair('<?php echo $row->from_currency_symbol.'_'.$row->to_currency_symbol; ?>')" <?php } ?> id="btc_<?php echo  $row->from_currency_symbol ?>_change"  >
                                           
                                            <span  class="<?php  if($row->change < 0){ echo 'text-danger'; }else { echo "text-success";}  ?>  "  >
                                                  <?php
                                                        if($row->change == 0){
                                                                    ?>

                                                                <?php    echo number_format($row->change,2);  ?>
                                                                <?php }else if($row->change >0){ ?>

                                                          +<?php    echo number_format($row->change,2);  ?> </td>

                                                              <?php
                                                            }else{
                                                              ?>
                                                             <?php    echo number_format($row->change,2);  ?>
                                                            <?php
                                                            }
                                                      ?>
                                                </span>
                                            </td>
                                            <td   <?php if($row->id!=$pair_id){ ?>onclick="change_pair('<?php echo $row->from_currency_symbol.'_'.$row->to_currency_symbol; ?>')" <?php } ?> id="btc_<?php echo  $row->from_currency_symbol ?>_volume"><?php  echo number_format($row->volume,3);  ?></td>
                                        </tr>
                                       <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade sell_main  <?php if($pair[1]=="ETH"){ ?> show active <?php }else{?>   <?php } ?>" id="nav-ETH" role="tabpanel" aria-labelledby="nav2">
                        <div class="tbale_markets mt-0">
                            <div class="table-responsive">
                                <table class="table table-borderless table-dark table-hover pair_table_eth" id="eth_table">
                                    <thead>
                                        <tr>
                                            <th><a  onClick="star_click_filter('eth')" class="star_filter notshorted" data-filter="0"><i class="fa fa-star" aria-hidden="true"></i></a></th>
                                            <th data-sort="string" data-sort-onload="no" scope="col">Coin</th>
                                            <th data-sort="float" scope="col">Last Price</th>
                                            <th data-sort="float" scope="col">Change</th>
                                            <th data-sort="float" scope="col"> Volume  </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php

                                       $sel=$this->uri->segment(2);  
                                       $i=0;
                                       foreach($pairs["ETH"] as $row){
                                        $i++;
                                        $tr_pair=$row->from_currency_symbol.'_'.$row->to_currency_symbol;
                                    ?>
                                        <tr <?php if($sel==$tr_pair){?> class="active"  <?php } ?>  id="<?php echo $row->from_currency_symbol.'_'.$row->to_currency_symbol; ?>" <?php if($row->id!=$pair_id){ ?> <?php }else{ ?>class="active"<?php } ?> >

                                          <td value="<?php echo rand()?>">
                                            
                                                    <i onclick="change_fav('<?php echo $row->from_currency_symbol.'_'.$row->to_currency_symbol; ?>')" data-pair="<?php echo $row->from_currency_symbol.'_'.$row->to_currency_symbol; ?>" class="fav fa fa-star" ></i>
                                               
                                            </td>
                                            
                                            <td <?php if($row->id!=$pair_id){ ?>onclick="change_pair('<?php echo $row->from_currency_symbol.'_'.$row->to_currency_symbol; ?>')" <?php } ?>>
                                                <?php echo trim($row->from_currency_symbol) ?></td>


                                             <td  <?php if($row->id!=$pair_id){ ?>onclick="change_pair('<?php echo $row->from_currency_symbol.'_'.$row->to_currency_symbol; ?>')" <?php } ?>  id="btc_<?php echo  $row->from_currency_symbol ?>_price"><?php echo  $row->price ?></td>
                                            <td  <?php if($row->id!=$pair_id){ ?>onclick="change_pair('<?php echo $row->from_currency_symbol.'_'.$row->to_currency_symbol; ?>')" <?php } ?> id="btc_<?php echo  $row->from_currency_symbol ?>_change"  >
                                           
                                            <span  class="<?php  if($row->change < 0){ echo 'text-danger'; }else { echo "text-success";}  ?>  "  >
                                                  <?php
                                                        if($row->change == 0){
                                                                    ?>

                                                                <?php    echo number_format($row->change,2);  ?>
                                                                <?php }else if($row->change >0){ ?>

                                                          +<?php    echo number_format($row->change,2);  ?> </td>

                                                              <?php
                                                            }else{
                                                              ?>
                                                             <?php    echo number_format($row->change,2);  ?>
                                                            <?php
                                                            }
                                                      ?>
                                                </span>
                                            </td>
                                            <td   <?php if($row->id!=$pair_id){ ?>onclick="change_pair('<?php echo $row->from_currency_symbol.'_'.$row->to_currency_symbol; ?>')" <?php } ?> id="eth_<?php echo  $row->from_currency_symbol ?>_volume"><?php  echo number_format($row->volume,3);  ?></td>
                                        </tr>
                                       <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade sell_main <?php if($pair[1]=="BCH"){ ?> show active <?php }else{?>   <?php } ?>" id="nav-BCH" role="tabpanel" aria-labelledby="nav3">
                        <div class="tbale_markets mt-0">
                            <div class="table-responsive">
                                <table class="table table-borderless table-dark table-hover pair_table_bch" id="bch_table">
                                    <thead>
                                        <tr>
                                            <th><a  onClick="star_click_filter('bch')" class="star_filter notshorted" data-filter="0"><i class="fa fa-star" aria-hidden="true"></i></a></th>
                                            <th data-sort="string" data-sort-onload="no" scope="col">Coin</th>
                                            <th data-sort="float" scope="col">Last Price</th>
                                            <th data-sort="float" scope="col">Change</th>
                                            <th data-sort="float" scope="col"> Volume  </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php

                                       $sel=$this->uri->segment(2);  
                                       $i=0;
                                       foreach($pairs["BCH"] as $row){
                                        $i++;
                                        $tr_pair=$row->from_currency_symbol.'_'.$row->to_currency_symbol;
                                    ?>
                                        <tr <?php if($sel==$tr_pair){?> class="active"  <?php } ?>  id="<?php echo $row->from_currency_symbol.'_'.$row->to_currency_symbol; ?>" <?php if($row->id!=$pair_id){ ?> <?php }else{ ?>class="active"<?php } ?> >

                                          <td value="<?php echo rand()?>">
                                            
                                                    <i onclick="change_fav('<?php echo $row->from_currency_symbol.'_'.$row->to_currency_symbol; ?>')" data-pair="<?php echo $row->from_currency_symbol.'_'.$row->to_currency_symbol; ?>" class="fav fa fa-star" ></i>
                                               
                                            </td>
                                            
                                            <td <?php if($row->id!=$pair_id){ ?>onclick="change_pair('<?php echo $row->from_currency_symbol.'_'.$row->to_currency_symbol; ?>')" <?php } ?>>
                                                <?php echo trim($row->from_currency_symbol) ?></td>


                                             <td  <?php if($row->id!=$pair_id){ ?>onclick="change_pair('<?php echo $row->from_currency_symbol.'_'.$row->to_currency_symbol; ?>')" <?php } ?>  id="btc_<?php echo  $row->from_currency_symbol ?>_price"><?php echo  $row->price ?></td>
                                            <td  <?php if($row->id!=$pair_id){ ?>onclick="change_pair('<?php echo $row->from_currency_symbol.'_'.$row->to_currency_symbol; ?>')" <?php } ?> id="btc_<?php echo  $row->from_currency_symbol ?>_change"  >
                                           
                                            <span  class="<?php  if($row->change < 0){ echo 'text-danger'; } else { echo "text-success";}  ?>  " >
                                                  <?php
                                                        if($row->change == 0){
                                                                    ?>

                                                                <?php    echo number_format($row->change,2);  ?>
                                                                <?php }else if($row->change >0){ ?>

                                                          +<?php    echo number_format($row->change,2);  ?> </td>

                                                              <?php
                                                            }else{
                                                              ?>
                                                             <?php    echo number_format($row->change,2);  ?>
                                                            <?php
                                                            }
                                                      ?>
                                                </span>
                                            </td>
                                            <td   <?php if($row->id!=$pair_id){ ?>onclick="change_pair('<?php echo $row->from_currency_symbol.'_'.$row->to_currency_symbol; ?>')" <?php } ?> id="bch_<?php echo  $row->from_currency_symbol ?>_volume"><?php  echo number_format($row->volume,3);  ?></td>
                                        </tr>
                                       <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade sell_main <?php if($pair[1]=="USDT"){ ?> show active <?php }else{?>   <?php } ?>" id="nav-USDT" role="tabpanel" aria-labelledby="nav4">
                        <div class="tbale_markets mt-0">
                            <div class="table-responsive">
                                 <table class="table table-borderless table-dark table-hover pair_table_usdt" id="usdt_table">
                                    <thead>
                                        <tr>
                                            <th><a  onClick="star_click_filter('usdt')" class="star_filter notshorted" data-filter="0"><i class="fa fa-star" aria-hidden="true"></i></a></th>
                                            <th data-sort="string" data-sort-onload="no" scope="col">Coin</th>
                                            <th data-sort="float" scope="col">Last Price</th>
                                            <th data-sort="float" scope="col">Change</th>
                                            <th data-sort="float" scope="col"> Volume  </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php

                                       $sel=$this->uri->segment(2);  
                                       $i=0;
                                       foreach($pairs["USDT"] as $row){
                                        $i++;
                                        $tr_pair=$row->from_currency_symbol.'_'.$row->to_currency_symbol;
                                    ?>
                                        <tr <?php if($sel==$tr_pair){?> class="active"  <?php } ?>  id="<?php echo $row->from_currency_symbol.'_'.$row->to_currency_symbol; ?>" <?php if($row->id!=$pair_id){ ?> <?php }else{ ?>class="active"<?php } ?> >

                                          <td value="<?php echo rand()?>">
                                            
                                                    <i onclick="change_fav('<?php echo $row->from_currency_symbol.'_'.$row->to_currency_symbol; ?>')" data-pair="<?php echo $row->from_currency_symbol.'_'.$row->to_currency_symbol; ?>" class="fav fa fa-star" ></i>
                                               
                                            </td>
                                            
                                            <td <?php if($row->id!=$pair_id){ ?>onclick="change_pair('<?php echo $row->from_currency_symbol.'_'.$row->to_currency_symbol; ?>')" <?php } ?>>
                                                <?php echo trim($row->from_currency_symbol) ?></td>


                                             <td  <?php if($row->id!=$pair_id){ ?>onclick="change_pair('<?php echo $row->from_currency_symbol.'_'.$row->to_currency_symbol; ?>')" <?php } ?>  id="btc_<?php echo  $row->from_currency_symbol ?>_price"><?php echo  $row->price ?></td>
                                            <td  <?php if($row->id!=$pair_id){ ?>onclick="change_pair('<?php echo $row->from_currency_symbol.'_'.$row->to_currency_symbol; ?>')" <?php } ?> id="btc_<?php echo  $row->from_currency_symbol ?>_change"  >
                                           
                                            <span  class="<?php  if($row->change < 0){ echo 'text-danger'; } else { echo "text-success";}  ?>  " >
                                                  <?php
                                                        if($row->change == 0){
                                                                    ?>

                                                                <?php    echo number_format($row->change,2);  ?>
                                                                <?php }else if($row->change >0){ ?>

                                                          +<?php    echo number_format($row->change,2);  ?> </td>

                                                              <?php
                                                            }else{
                                                              ?>
                                                             <?php    echo number_format($row->change,2);  ?>
                                                            <?php
                                                            }
                                                      ?>
                                                </span>
                                            </td>
                                            <td   <?php if($row->id!=$pair_id){ ?>onclick="change_pair('<?php echo $row->from_currency_symbol.'_'.$row->to_currency_symbol; ?>')" <?php } ?> id="usdt_<?php echo  $row->from_currency_symbol ?>_volume"><?php  echo number_format($row->volume,3);  ?></td>
                                        </tr>
                                       <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tbale_markets mt-3 notices">
                <h4>NOTICES</h4>

                  <?php
                  if($notification->num_rows() >0){

                    foreach($notification->result() as $row){ ?>


                  <div class="notices_inner">
                   <div class="notices_inner_text"><?php echo $row->notification ?></div>
                  </div>

                  <?php
                  }
                  }else{?>


                    <div class="notices_inner">
                   <div class="notices_inner_text">Notification Not found </div>
                  </div>


                  <?php } ?>

            </div>
           
        </div>

         <div class="market_list">
            <div class="container-fluid exchange_main">
                <div class="row">
                    <div id="tade_chart_move" class="col-md-12">
                        <div class="pair_main bg_sec">
                            <div class="tody_markt_outer">
                                <div class="tody_markt">
                                    <div class="tody_markt_text">last price</div>
                                    <div class="tody_markt_value"><span  id="last_price"></span><?php //echo $pair[1];?></div>
                                </div>
                            </div>
                            <div class="tody_markt_outer">
                                <div class="tody_markt">
                                    <div class="tody_markt_text">24hr high</div>
                                    <div class="tody_markt_value"><span id="high_price"></div>
                                </div>
                            </div>
                            <div class="tody_markt_outer">
                                <div class="tody_markt">
                                    <div class="tody_markt_text">24hr low</div>
                                    <div class="tody_markt_value"><span id="low_price"></div>
                                </div>
                            </div>
              <div class="tody_markt_outer">
                                <div class="tody_markt">
                                    <div class="tody_markt_text">24hr change</div>
                                    <div class="tody_markt_value"><span id="cur_change"></span> </div>
                                </div>
                            </div>
                            <div class="tody_markt_outer">
                                <div class="tody_markt tody_markt1">
                                    <div class="tody_markt_text">24hr Volume</div>
                                    <div class="tody_markt_value"><?php echo $pair[1];?>&nbsp<span  id="volume_price"> </span></div>
                                    <div class="tody_markt_value"><?php echo $pair[0];?>&nbsp<span  id="svolume"> </span></div>                                    
                                </div>
                            </div>
                        </div>
                        <div class="chart_main bg_sec">
                            <div class="market_data_main">
                                <div class="market_data_type">
                                    <span class="market_data_ico1">
                                        <img src="<?php echo base_url(); ?>assets/frontend/images/coins_icons/<?php echo strtolower($pair[0]);?>.png">
                                        <?php echo $pair[0];?></span>
                                    <span class="market_data_ico11">
                                        <i class="fa fa-exchange"></i>
                                    </span>
                                    <span class="market_data_ico1">
                                        <img src="<?php echo base_url(); ?>assets/frontend/images/coins_icons/<?php echo strtolower($pair[1]);?>.png">
                    <?php echo $pair[1];?></span>
                                </div>
                                <div class="market_data_ico sprocket">
                                   <div class="tools" style="cursor:pointer;"><i class="fa fa-cog"></i></div>
                                </div>
                            </div>
                            
                            <div class="chart_inner" id="exchange_stockgraph">
                                <div class="cls_trgrf" id="exc_graph_container">
                    <div class="toolPanel toolPanel-grap replaceCheckboxes" style="display: none;">
                      <div class="notch"></div>  
                      <ul>
                        <!-- <li>
                          <div class="name_sect"><input type="checkbox" id="fibCheckbox"><label for="fibCheckbox">Fib Levels</label></div>
                        </li> -->
                        <li>
                          <div class="name"><input type="checkbox" id="smaCheckbox" value="" <?php if(isset($_COOKIE['sma'])!="") { ?> checked="checked" <?php } else{ echo "";}?>><label for="smaCheckbox">SMA Period:</label></div>
                          <input type="text" value="50" class="chartTextEntry" id="smaPeriod">
                        </li>
                        <li>
                          <div class="name"><input type="checkbox" id="emaCheckbox" value="" <?php if(isset($_COOKIE['ema1'])!="") { ?> checked="checked" <?php } else{ echo "";}?>><label for="emaCheckbox">EMA 1 Period:</label></div>
                          <input type="text" value="30" class="chartTextEntry" id="emaPeriod">
                        </li>
                        <li>
                          <div class="name"><input type="checkbox" id="ema2Checkbox" value="" <?php if(isset($_COOKIE['ema2'])!="") { ?> checked="checked" <?php } else{ echo "";}?>><label for="ema2Checkbox">EMA 2 Period:</label></div>
                          <input type="text" value="20" class="chartTextEntry" id="ema2Period">
                        </li>
                        <li>
                          <div class="name"><input type="checkbox" id="bollingerCheckbox"><label for="bollingerCheckbox">Bollinger Band</label></div>
                        </li>
                      </ul>
                    </div>
                    <!--<div class="panel-body" id="graph_container" style="margin-top:30px;"></div>-->
                    <div class="tradingview-widget-container" id="depth_chart">
                      <div id="chartdiv"></div>
                    </div>
                  </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="buy_main_upper bg_sec">
                                    <h4>BUY</h4>
                                    <div class="buy_main">
                                        <div class="form-group mb-0">
                                            <label class="w-100">
                                                <span class="float-left">You have</span>
                                                <span  class="float-right">
                                                 
                                                    <span id="to_cur_balance" class="text-white to_cur_balance" onclick="setorder('to_cur_balance','buy')"   style="cursor:pointer;"  ><?php if($this->user_id!=0){echo $to_cur= isset($this->user_balance[$pair_details->from_symbol_id])?to_decimal($this->user_balance[$pair_details->to_symbol_id],8):0;}else{echo $to_cur=0;} ?></span>
                                                    <span> <?php echo $pair[1];?></span>
                                                </span>
                                            </label>
                                             <label class="w-100">
                                                <span class="float-left">Lowest Ask</span>
                                                <span class="float-right">
                                                    <span style="cursor:pointer;" id="buyprice" onclick="priceset('buy')" class="text-white"></span>
                                                    <span> <?php echo $pair[1];?></span>
                                                </span>
                                            </label>
                                        </div>
                                        <input id="buy_order_type" type="hidden" value="limit">
                                        <div class="form-group" id="buy_price_sec">
                                            <label id="classbuyprice">Price Per <?php echo $pair[1];?></label>
                                            <input type="text" class="form-control" value="<?php echo number_format($sell_price,8,'.', ''); ?>"  onkeypress="return isNumberKey(event)" onkeyup="amount_calculation('buy');" id="buy_price" name="buy_price"  placeholder="<?php echo $pair[1];?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Amount</label>
                                            <input type="text" class="form-control" name="buy_amount" id="buy_amount" onkeyup="amount_calculation('buy');" onkeypress="return isNumberKey(event)" placeholder="<?php echo $pair[0];?>">
                                        </div>
                                        <div class="form-group mb-2">
                                            <label class="w-100">
                                                <span class="float-left">Fee (<span id='maker_fee'><?php echo to_decimal_point($this->maker,4); ?>%</span>)</span>
                                                <span class="float-right">
                                                    <span class="text-white" id="buy_fee_tot"></span>
                                                    <span> <?php echo $pair[1];?></span>
                                                </span>
                                            </label>
                                            <label class="w-100">
                                                <span class="float-left">Total</span>
                                                <span class="float-right">
                                                    <input class="total_cal" id="buy_tot"  onkeyup="calculation_tot('buy');"></input>
                                                    <span> <?php echo $pair[1];?></span>
                                                </span>
                                            </label>
                                        </div>
                                          <?php
                                               if(user_id()){
                                            ?>
                                               <button class="btn btn-primary w-100 btn_buy mt-5 mb-4 buy_btn buy_sec"  onclick="order_placed('buy')">BUY</button>  
                                              <?php
                                            }else{
                                            ?>
                                            <div class="log_reg">
                                              <a class="logRegLink" href="<?php echo base_url() ?>home/login">Login </a>
                                              or <a href="<?php echo base_url() ?>home/register" class="logRegLink">Register</a> to trade
                                          </div>
                                            <?php
                                            }
                                            ?>

                                        
                                    </div>
                                </div>
                            </div>
                  <div class="col-md-4">
                                <div class="buy_main_upper bg_sec">
                                    <h4>STOP-LIMIT</h4>
                                    <div class="buy_main">
                                        <div class="form-group mb-0">
                                            <label class="w-100">
                                                <span class="float-left">You have</span>
                                                <span class="float-right">
                                                    <span class="text-white to_cur_balance"    onclick="setorder('to_cur_balance','stop_limit')" style="cursor:pointer;"  ><?php if($this->user_id!=0){echo $to_cur= isset($this->user_balance[$pair_details->to_symbol_id])?to_decimal($this->user_balance[$pair_details->to_symbol_id],8):0;}else{echo $to_cur=0;} ?></span>
                                                    <span><?php echo $pair[1];?></span>
                                                </span>
                                            </label>
                                            <label class="w-100">
                                                <span class="float-left">You have</span>
                                                <span class="float-right">
                                                    <span class="text-white from_cur_balance"  onclick="setorder('from_cur_balance','stop_limit')"  style="cursor:pointer;" ><?php if($this->user_id!=0){echo $from_cur= isset($this->user_balance[$pair_details->from_symbol_id])?to_decimal($this->user_balance[$pair_details->from_symbol_id],8):0;}else{echo $from_cur=0;} ?></span>
                                                    <span><?php echo $pair[0];?></span>
                                                </span>
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label>Stop</label>
                                             <input type="text"  class="form-control" id="stop_price" placeholder="<?php echo $pair[1];?>">
                                            <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                                        </div>
                                        <div class="form-group">
                                            <label>Price</label>
                                             <input type="text"  class="form-control" id="stop_limit_price" onkeypress="return isNumberKey(event)" onkeyup="amount_calculation('stop_limit_price');"  placeholder="<?php echo $pair[1];?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Amount</label>
                                            <input type="text"  class="form-control"  onkeypress="return isNumberKey(event)" onkeyup="amount_calculation('stop_limit_amount');" id="stop_limit_amount" placeholder="<?php echo $pair[0];?>">
                                        </div>
                                        <div class="form-group mb-2">
                                            <label class="w-100">
                                                <span class="float-left">Total</span>
                                                <span class="float-right">
                                                    <input type="text" onkeyup="calculation_tot('sell');"  class="total_cal" id="stop_limit_tot" >
                                                    <span><?php echo $pair[1];?></span>
                                                </span>
                                            </label>
                                        </div>
                                        <?php
                                             if(user_id()){
                                          ?>

                                            <button onclick="order_placed('stop_limit_buy')"  class="btn btn-primary float-left btn_buy btn_buy1 buy_btn limit_buy my-3">BUY</button>  
                                            <button onclick="order_placed('stop_limit_sell')"  class="btn btn-primary btn_sell btn_buy1 sel_btn limit_sell my-3">SELL</button>
                                           
                                          <?php
                                          }else{
                                          ?>
                                            <a class="logRegLink" href="<?php echo base_url() ?>home/login">Login </a>
                                            or <a href="<?php echo base_url() ?>home/register" class="logRegLink">Register</a> to trade

                                          <?php
                                          }
                                          ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="buy_main_upper bg_sec">
                                    <h4>SELL</h4>
                                    <div class="buy_main">
                                        <div class="form-group mb-0">
                                            <label class="w-100">
                                                <span class="float-left">You have</span>
                                                <span class="float-right">                                    
                                                    <span id="from_cur_balance" class="text-white from_cur_balance"  onclick="setorder('from_cur_balance','sell')"  ><?php if($this->user_id!=0){echo $to_cur= isset($this->user_balance[$pair_details->from_symbol_id])?to_decimal($this->user_balance[$pair_details->from_symbol_id],8):0;}else{echo $to_cur=0;} ?></span>
                                                    <span> <?php echo $pair[0];?></span>
                                                </span>
                                            </label>
                                            <label class="w-100">
                                                <span class="float-left">Highest Bid</span>
                                                <span class="float-right">
                                                    <span id="sellprice" class="text-white" onclick="priceset('sell')"  style="cursor:pointer;"> </span>
                                                    <span> <?php echo $pair[1];?></span>
                                                </span>
                                            </label>
                                        </div>
                                        <input id="sell_order_type" type="hidden" value="limit"> 
                                         <div class="form-group" id="sell_price_sec">
                                            <label>Price Per <?php echo $pair[1];?></label>
                                           <input type="text"  class="form-control"  onkeypress="return isNumberKey(event)" onkeyup="amount_calculation('sell');" id="sell_price" name="sell_price"  value="<?php echo number_format($buy_prrice,8,'.', ''); ?>" placeholder="<?php echo $pair[1];?>">
                                        </div> 
                                        <div class="form-group" >
                                            <label id="classsellprice">Amount</label>
                                            <input type="text"  class="form-control"   name="sell_amount" id="sell_amount" onkeyup="amount_calculation('sell');" onkeypress="return isNumberKey(event)" placeholder="<?php echo $pair[0];?>">  
                                            <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                                        </div>
                                       
                                        <div class="form-group mb-2">
                                            <label class="w-100">                                      
                                                 <span class="float-left">Fee (<span id='maker_fee'><?php echo to_decimal_point($this->taker,4); ?>%</span>)</span>
                                                <span class="float-right">
                                                    <span class="text-white" id="sell_fee_tot"></span>
                                                    <span> <?php echo $pair[1];?></span>
                                                </span>
                                            </label>
                                            <label class="w-100">
                                                <span class="float-left">Total</span>
                                                <span class="float-right">
                                                    <input type="text"  class="total_cal" id="sell_tot" onkeyup="calculation_tot('sell');">
                                                    <span> <?php echo $pair[1];?></span>
                                                </span>
                                            </label>
                                        </div>
                                           <?php
                                               if(user_id()){
                                            ?>
                                             <button  onclick="order_placed('sell')"  class="btn btn-primary w-100 btn_sell mt-5 mb-4 sel_btn sell_sec">SELL</button>

                                             <?php
                                            }else{
                                            ?>
                                            <div class="log_reg">
                                              <a class="logRegLink" href="<?php echo base_url() ?>home/login">Login </a>
                                              or <a href="<?php echo base_url() ?>home/register" class="logRegLink">Register</a> to trade
                                          </div>
                                            <?php
                                            }
                                            ?>
                                    </div>
                                </div>
                            </div>
            </div>
                        <div class="row">
                            <div class="col-md-6 pr-0">
                                <div class="tbale_markets bg_sec sell_order">
                                    <h4>SELL ORDERS
                                      <div class="sell_amnt">
                                       Total sell amount :
                                       <span id="total_sell_order">0.000000000</span><?php echo $pair[0];?>
                                      </div>

                                    </h4>

                                    <div  id="flip-scroll" class="table-responsive table_fix_buy_sell_history table_martek_deft order_tab">
                                        <table class="table table-borderless table-dark table-hover table_buy_sell">
                                            <thead>
                                                <tr>
                                                    <th scope="col"><?php echo getlang('Price');?></th>
                                                    <th scope="col"><?php echo $pair[0];?></th>
                                                    <th scope="col"><?php echo $pair[1];?></th> 
                                                    <th>Sum(<?php echo $pair[1];?>)</th>
                                                </tr>
                                            </thead>
                                            <tbody class="order_scroll">
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 p1-0">
                                <div class="tbale_markets bg_sec buy_order">
                                    <h4>BUY ORDERS
                                        <div class="sell_amnt">
                                    Total Buy amount :
                                      <span id="total_buy_order"></span><?php echo $pair[1];?>
                                    </div>

                                    </h4>
                                    <div id="flip-scroll" class="table-responsive table_fix_buy_sell_history table_martek_deft order_tab">
                                        <table class="table table-borderless table-dark table-hover table_buy_sell">
                                            <thead>
                                                <tr>
                                                    <th scope="col"><?php echo getlang('Price');?></th>
                                                    <th scope="col"><?php echo $pair[0];?></th>
                                                    <th scope="col"><?php echo $pair[1];?></th> 
                                                    <th>Sum(<?php echo $pair[1];?>)</th>
                                            </thead>
                                            <tbody class="order_scroll">
                                              
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
               <div class="row">
                    <div class="col-md-12">
                        <div class="tbale_markets bg_sec">
                            <h4>TRADE HISTORY</h4>
                            <div class="table-responsive table_fix_buy_sell_history_h">
                                <table class="table table-borderless table-dark table-hover table_buy_sell">
                                    <thead>
                                        <tr>
                                            <th><?php echo getlang('Time');?></th>
                                             <th><?php echo getlang('Type');?></th>
                                             <th><?php echo getlang('Price');?>(<?php echo $pair[1];?>)</th>
                                             <th><?php echo $pair[0];?></th>
                                        </tr>
                                    </thead>
                                    <tbody class="order_scroll transactionhistory">
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                  </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="buy_sell_main open_tarede bg_sec">
                            <nav>
                                <div class="nav nav-tabs text-center" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="nav11" data-toggle="tab" href="#nav-USDT11" role="tab" aria-controls="nav-home" aria-selected="true">MY OPEN ORDERS
                                    </a>
                                    <a class="nav-item nav-link" id="nav21" data-toggle="tab" href="#nav-BTC11" role="tab" aria-controls="nav-profile" aria-selected="false">MY STOP ORDERS
                                    </a>
                                    <a class="nav-item nav-link" id="nav31" data-toggle="tab" href="#nav-ETH11" role="tab" aria-controls="nav-profile" aria-selected="false">MY TRADE
                                    </a>
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-USDT11" role="tabpanel" aria-labelledby="nav11">
                                    <div class="tbale_markets mt-0">
                                        <div class="table-responsive table_fix_buy_sell_history orderac_tab">
                                            <table class="table table-borderless table-dark table-hover table_buy_sell">
                                                <thead>
                                                    <tr>
                                                        <th>Type</th>
                                                        <th>Date & Time</th>
                                                        <th>Price(<?php echo $pair[1]; ?>) </th>
                                                        <th>Amount(<?php echo $pair[0]; ?>) </th>
                                                        <th>Total(<?php echo $pair[1]; ?>)</th>
                                                        <th>Action</th>
                                                        
                                                    </tr>
                                                </thead>
                                                <tbody class="open_orders order_scroll">
                                                   
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade sell_main" id="nav-BTC11" role="tabpanel" aria-labelledby="nav21">
                                    <div class="tbale_markets mt-0">
                                        <div class="table-responsive table_fix_buy_sell_history orderac_tab">
                                            <table class="table table-borderless table-dark table-hover table_buy_sell">
                                                <thead>
                                                    <tr>
                                                        <th>Type</th>
                                                        <th>Date & Time</th>
                                                        <th>Price(<?php echo $pair[1]; ?>)</th>
                                                        <th>Amount(<?php echo $pair[0]; ?> )</th>
                                                        <th>Total <?php echo $pair[1]; ?>)</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody  class="stop_orders order_scroll">
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade sell_main" id="nav-ETH11" role="tabpanel" aria-labelledby="nav31">
                                    <div class="tbale_markets mt-0">
                                        <div class="table-responsive table_fix_buy_sell_history orderac_tab">
                                            <table class="table table-borderless table-dark table-hover table_buy_sell">
                                                <thead>
                                                    <tr>
                                                        <th><?php echo getlang('Type');?></th>
                                                        <th><?php echo getlang('Date & Time');?></th>
                                                        <th><?php echo $pair[1]; ?> <?php echo getlang('Price');?></th>
                                                        <th><?php echo $pair[0]; ?> <?php echo getlang('Amount');?></th>
                                                        <th><?php echo getlang('Total');?>(<?php echo $pair[1]; ?>)</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="mytradehistory order_scroll">
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>

      
</div>

  <?php $this->load->view('front/basic/footer_inner'); ?>
<!--
<link rel="stylesheet" href="<?php echo css_url();?>jquery.mCustomScrollbar.css">
<!-- Placed at the end of the document so the pages load faster --> 





<!-- scroll-->
     


<script>
var user_id='<?php echo $this->user_id; ?>';
var u='<?php echo UserName($this->user_id); ?>';

var user_image='<?php echo getChatImage($this->user_id); ?>';
var base_url='<?php echo base_url(); ?>';
var front_url='<?php echo front_url(); ?>';
var base_url = "<?php echo base_url(); ?>";
var wcx_userid = "<?php echo $this->user_id; ?>";
//var from_currency = " echo $from_cur; ";
var from_currency = "ETH";

var to_currency = "BTC";
var maker_fee = "<?php echo $this->maker; ?>";
var taker_fee = "<?php echo $this->taker; ?>";
var pair = "<?php echo implode('_',$pair); ?>";
var pair_id = "<?php echo $pair_details->id; ?>";
var mode = "<?php echo $mode; ?>";





var current_buy_price = <?php echo $this->lowestaskprice; ?>;
var current_sell_price = <?php echo $this->highestbidprice; ?>;
var minimum_trade_amount = <?php echo ($this->minimum_trade_amount!='')?$this->minimum_trade_amount:0; ?>;
var lastmarketprice = "<?php echo $this->lastmarketprice; ?>";

var pagetype='<?php echo $pagetype; ?>';
var first_id              = "<?php echo isset($pair[0])?currency_id($pair[0]):''; ?>";
var second_id              = "<?php echo isset($pair[1])?currency_id($pair[1]):''; ?>";

var pair_user_id = "<?php echo $pair_details->id.'_'.user_id(); ?>";
var pair_name = "";

var getcurn="<?php echo $pair[0];?>_<?php echo $pair[1];?>";
var res = getcurn.split("_");
var concurncy=res[1]+"_"+res[0];
var tradingView = null;


var url =base_url+'trade/tradechart/'+pair_id+'/trade';


alert(url);


//chart.data;

var data2 = [];

//var url="https://bitonehk.com/Trade/BinanceAPI/ETHBTC/1";

$.getJSON(url, function(data){



am4core.useTheme(am4themes_animated);
// Themes end

var chart = am4core.create("chartdiv", am4charts.XYChart);
chart.paddingRight = 20;

chart.dateFormatter.inputDateFormat = "YYYY-MM-dd";

var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
dateAxis.renderer.grid.template.location = 0;

var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis.tooltip.disabled = true;

var series = chart.series.push(new am4charts.CandlestickSeries());
series.dataFields.dateX = "date";
series.dataFields.valueY = "close";
series.dataFields.openValueY = "open";
series.dataFields.lowValueY = "low";
series.dataFields.highValueY = "high";
series.simplifiedProcessing = true;
series.tooltipText = "Open:${openValueY.value}\nLow:${lowValueY.value}\nHigh:${highValueY.value}\nClose:${valueY.value}";

chart.cursor = new am4charts.XYCursor();

// a separate series for scrollbar
var lineSeries = chart.series.push(new am4charts.LineSeries());
lineSeries.dataFields.dateX = "date";
lineSeries.dataFields.valueY = "close";
// need to set on default state, as initially series is "show"
lineSeries.defaultState.properties.visible = false;

// hide from legend too (in case there is one)
lineSeries.hiddenInLegend = true;
lineSeries.fillOpacity = 0.5;
lineSeries.strokeOpacity = 0.5;

var scrollbarX = new am4charts.XYChartScrollbar();
scrollbarX.series.push(lineSeries);
chart.scrollbarX = scrollbarX;

chart.data =data;
  

});



 


  /*var obj1 = data2;

var obj = JSON.stringify(obj1);

alert(obj);

console.log(obj);*/

         





   // alert(JSON.stringify(dat));
   //chart.data2;


/*function setTradingView(interval, binanceParam) {
  if(tradingView != null) {
    //表示中の場合は削除する
    tradingView.remove();
    tradingView = null;
  }

  tradingView = new TradingView.widget({
    //width:650,
    //height:430,
    autosize:true,
    fullscreen: false,
    interval: interval,
    symbol: concurncy,
    theme: "Dark",
    //style: "1",
    toolbar_bg: '#000000',
    enable_publishing: false,
    allow_symbol_change: true,
    container_id: "tv_chart_container",
    datafeed: new Datafeeds.UDFCompatibleDatafeed("https://localhost/livecode/Trade/Tradingview/"+res[0]+res[1]+'/'+1),
    library_path:"https://localhost/livecode/assets/frontend/js/charting_library/",
    locale: "en",
    drawings_access: { type: 'black', tools: [ { name: "Regression Trend" } ] },
    //disabled_features: ["use_localstorage_for_settings","left_toolbar",'header_screenshot','header_fullscreen_button','display_market_status','header_indicators','header_undo_redo','header_compare','scales_context_menu','compare_symbol','header_resolutions'],//,'header_resolutions'
    disabled_features: ["use_localstorage_for_settings","left_toolbar",'header_screenshot','header_fullscreen_button','display_market_status','header_indicators','header_undo_redo','header_compare','scales_context_menu','compare_symbol','header_settings','header_resolutions'],
    //enabled_features: ["adaptive_logo"],
    overrides: {
        "mainSeriesProperties.style": 1,
        "symbolWatermarkProperties.color" : "#944",
        "volumePaneSize": "large"
    },
    debug: false,
    time_frames: [{
      "text":"1m","resolution":"180","description":"1 minute"
    },{
      "text":"5m","resolution":"300","description":"5 minute"
    },{
      "text":"15m","resolution":"2D","description":"15 minute"
    },{
      "text":"30m","resolution":"4D","description":"30 minute"
    },{
      "text":"1h","resolution":"1W","description":"1 hour"
    },{
      "text":"1d","resolution":"6M","description":"1 day"
    },{
      "text":"1w","resolution":"3Y","description":"1 week"
    },{
      "text":"1m","resolution":"6Y","description":"1 month"
    }],
    favorites: {
        intervals: ["1","5","15","30","60","D","W","M"]
    }
  });
}

$(function () {
  //画面表示時のTradingView表示
  setTradingView("1", "1");
});

$(document).on('change','.fx',function() {
  //表示単位変更時の表示
  if(this.value != 0) {
    setTradingView(this.value, this.value);
  }
});

$(document).on('click','.fxclick',function() {
  //1D, 1W, 1Mボタンクリック時の表示
  setTradingView(this.value.slice(1, 2), this.value);
  //先頭のデータに選択状態を移動
  $(".custom_interval").find("span").removeClass("selected");
  $(this).parent().addClass("selected");
});


$(function () {  
    $("#myiframe").load(function () {                        
        frames["myframe"].document.body.innerHTML = htmlValue;
    });
}); */

</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>

<script>

//paste this code under the head tag or in a separate js file.
  // Wait for window load
  $(window).load(function() {
    // Animate loader off screen
    //$(".se-pre-con").fadeOut("slow");;
  });



  </script>

<script>
        $(document).ready(function () {
           if(mode =="day"){

                //$("body").removeClass("white_web");
                $("#theme_change i").addClass("fa-sun-o");
                $("#theme_change i").removeClass("fa-moon-o");
                $(".mode").addClass("mode_on");
                 
              
            }else{

                $(".mode").removeClass("mode_on");
                 $("#theme_change i").addClass("fa-moon-o");
                 $("#theme_change i").removeClass("fa-sun-o");
                 $("body").removeClass("white_web");

            }
        });
    </script>


<script src="<?php echo base_url()?>assets/frontend/js/jquery.cookie.js"></script>
<script src="<?php echo js_url();?>jquery.mCustomScrollbar.concat.min.js"></script>

  <script src="<?php echo js_url() ?>stupidtable.min.js?dev"></script>
<script src="https://code.highcharts.com/stock/highstock.js"></script>
<script src="https://code.highcharts.com/stock/indicators/indicators.js"></script>
<script src="https://code.highcharts.com/stock/indicators/bollinger-bands.js"></script>

<script>
                                   /* $.getJSON('https://cdn.rawgit.com/highcharts/highcharts/057b672172ccc6c08fe7dbb27fc17ebca3f5b770/samples/data/new-intraday.json', function (data) {

                                        // create the chart
                                        Highcharts.stockChart('container', {
                                            xAxis: {
                                                gapGridLineWidth: 0
                                            },

                                            rangeSelector: {
                                                buttons: [{
                                                    type: 'hour',
                                                    count: 1,
                                                    text: '1h'
                                                }, {
                                                    type: 'day',
                                                    count: 1,
                                                    text: '1D'
                                                }, {
                                                    type: 'all',
                                                    count: 1,
                                                    text: 'All'
                                                }],
                                                selected: 1,
                                                inputEnabled: false
                                            },

                                            series: [{
                                                name: 'AAPL',
                                                type: 'area',
                                                data: data,
                                                gapSize: 0,
                                                tooltip: {
                                                    valueDecimals: 2
                                                },
                                                fillColor: {
                                                    linearGradient: {
                                                        x1: 0,
                                                        y1: 0,
                                                        x2: 0,
                                                        y2: 1
                                                    },
                                                    stops: [
                                                        [0, Highcharts.getOptions().colors[0]],
                                                        [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                                                    ]
                                                },
                                                threshold: null
                                            }]
                                        });
                                    });*/
                                </script>

<script src="<?php echo js_url();?>jquery.mCustomScrollbar.concat.min.js"></script>
<script src="<?php echo js_url().'trading.js?ver='.time();?>"></script>
<script src="<?php echo js_url().'trade.js?ver='.time();?>"></script>

<!-- <script src="https://code.highcharts.com/stock/highstock.js"></script> -->

<script src="<?php echo js_url().'jquery.growl.js?'.time();?>"></script>

<link href="<?php echo base_url() ?>assets/frontend/css/jquery.growl.css" rel="stylesheet">
<!-- <script type="text/javascript" src="<?php //echo base_url();?>chat/socket.io.js"></script> -->



</html>



