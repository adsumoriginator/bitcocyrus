
$(document).bind("contextmenu",function(e) {
 e.preventDefault();
});

$(document).keydown(function(e){
    if(e.which === 123){
       return false;
    }
});

function clear_console(){
	console.API;
	if (typeof console._commandLineAPI !== 'undefined') {
    	console.API = console._commandLineAPI; //chrome
	} else if (typeof console._inspectorCommandLineAPI !== 'undefined') {
    	console.API = console._inspectorCommandLineAPI; //Safari
	} else if (typeof console.clear !== 'undefined') {
    	console.API = console;
	}

	console.API.clear();


	 

	return true;
	}

load_design();


$('.pair_class').click(function(){
	var id=$(this).attr("data-id");
    $('#pair_id').val(id);
     //$('.loader').val(id);
     var url=base_url+"assets/frontend/images/Preloader_2.gif";
     $(".transactionhistory tbody").html('<tr><td colspan="3"><img src="'+url+'"></td></tr>');

     $(".sell_order tbody").html('<tr><td colspan="3"><img src="'+url+'"></td></tr>');

     $(".buy_order tbody").html('<tr><td colspan="3"><img src="'+url+'"></td></tr>');

 	load_design();
    
});


function load_design()
{



	pair_id=$("#pair_id").val();


	$.ajax({
		url:base_url+'trade_integration/'+pair_id+'/'+user_id+'/'+pagetype,
		type: 'GET',
		success: function(res)
		{
			clear_console();


			/*var browsername=navigator ? navigator.userAgent.toLowerCase() : "other";
			var resp = browsername.split(" "); 
			var lengthbrowser=resp.length;
			var getname=resp[lengthbrowser-1];
			var res1 = getname.split("/"); 
			if(res1[1]!='safari')
			{
				console.API;
				if (typeof console._commandLineAPI !== 'undefined') {
				console.API = console._commandLineAPI; //chrome
				} else if (typeof console._inspectorCommandLineAPI !== 'undefined') {
				console.API = console._inspectorCommandLineAPI; //Safari
				} else if (typeof console.clear !== 'undefined') {
				console.API = console;
				}
				// console.API.clear();
			}
			
			
			*/
			
			setTimeout(function(){
			load_design();
			}, 1000);
			var designs=JSON.parse(res);


			var current_trade=designs.current_trade;
			var transactionhistory=designs.transactionhistory;
			var mytransactionhistory=designs.mytransactionhistory;
			var liquidity=designs.liquidity;
			var buyResult=designs.buyResult;
			var sellResult=designs.sellResult;
			var pairs=designs.pairs;

			from_currency=designs.from_currency;
			to_currency=designs.to_currency;
			wcx_userid=designs.wcx_userid;
			current_buy_price=designs.current_buy_price;
			current_sell_price=designs.current_sell_price;
			lastmarketprice=designs.lastmarketprice;
			maker_fee=parseFloat(designs.maker).toFixed(2);
			taker_fee=parseFloat(designs.taker).toFixed(2);
			$('#maker_fee').html(maker_fee+'%');
			$('#taker_fee').html(taker_fee+'%');
			if(current_trade)
			{
	

				$("#lastmarketprice").html(parseFloat(lastmarketprice).toFixed(8));
				$("#last_price").html((parseFloat(current_trade['price'])).toFixed(8));
				$("#high_price").html((parseFloat(current_trade['high'])).toFixed(8));
				$("#low_price").html((parseFloat(current_trade['low'])).toFixed(8));
				$("#volume_price").html((parseFloat(current_trade['volume'])).toFixed(8));
			}
			if(transactionhistory!=0&&transactionhistory.length>0)
			{	
				var transaction_length=transactionhistory.length;
				var historys='';
				for(count = 0; count < transaction_length; count++)
				{
					var askAmount=transactionhistory[count].askAmount;
					var buyer_trade_id=transactionhistory[count].buyer_trade_id;
					var seller_trade_id=transactionhistory[count].seller_trade_id;
					var filledAmount=transactionhistory[count].filledAmount;
					filledAmount=parseFloat(filledAmount).toFixed(8);
					if(buyer_trade_id>seller_trade_id)
					{
						var type1="Buy";
						var type2="Sell";
						var askPrice=transactionhistory[count].buyaskPrice;
						askPrice=parseFloat(askPrice).toFixed(8);
						var sellaskPrice=transactionhistory[count].sellaskPrice;
						sellaskPrice=parseFloat(sellaskPrice).toFixed(8);
						var orderTime1=transactionhistory[count].buyertime;
						var orderTime2=transactionhistory[count].sellertime;
					}
					else
					{
						var type1="Sell";
						var type2="Buy";
						var askPrice=transactionhistory[count].sellaskPrice;
						askPrice=parseFloat(askPrice).toFixed(8);
						var sellaskPrice=transactionhistory[count].buyaskPrice;
						sellaskPrice=parseFloat(sellaskPrice).toFixed(8);
						var orderTime1=transactionhistory[count].buyertime;
						var orderTime2=transactionhistory[count].sellertime;
					}

				

					if(type1=='Buy'){var class1='success';}else{var class1='danger';}
					if(type2=='Buy'){var class2='success';}else{var class2='danger';}
					historys=historys+'<tr><td>'+filledAmount+'</td><td><span class="text-'+class1+'">'+type1+'</span></td><td><span class="text-'+class1+'">'+askPrice+'</span></td><td><span class="text-'+class1+'">'+orderTime2+'</span></td></tr>';
					historys=historys+'<tr><td>'+filledAmount+'</td><td><span class="text-'+class2+'">'+type2+'</span></td><td><span class="text-'+class2+'">'+sellaskPrice+'</span></td><td><span class="text-'+class2+'">'+orderTime2+'</span></td></tr>';
				}

				$('.transactionhistory tbody').html(historys);
			}
			else
			{
				$('.transactionhistory tbody').html('<tr class="fd_rw"><td colspan="4" class="text-center">No Trade History Found!</td></tr>');
			}
			
			if(mytransactionhistory!=0&&mytransactionhistory.length>0)
			{	
				var transaction_length=mytransactionhistory.length;
				var historys='';
				for(count = 0; count < transaction_length; count++)
				{
					var askAmount=mytransactionhistory[count].askAmount;
					var buyer_trade_id=mytransactionhistory[count].buyer_trade_id;
					var seller_trade_id=mytransactionhistory[count].seller_trade_id;
					var filledAmount=mytransactionhistory[count].filledAmount;
					filledAmount=parseFloat(filledAmount).toFixed(8);
					if(buyer_trade_id>seller_trade_id)
					{
						var type1="Buy";
						var type2="Sell";
						var askPrice=mytransactionhistory[count].buyaskPrice;
						askPrice=parseFloat(askPrice).toFixed(8);
						var sellaskPrice=mytransactionhistory[count].sellaskPrice;
						sellaskPrice=parseFloat(sellaskPrice).toFixed(8);
						var orderTime1=mytransactionhistory[count].datetime;
						var orderTime2=mytransactionhistory[count].datetime;
						var total1 = filledAmount*askPrice;
						var buyerUserid=mytransactionhistory[count].buyerUserid;
					}
						else
					{
						var type1="Sell";
						var type2="Buy";
						var askPrice=mytransactionhistory[count].sellaskPrice;
						var buyerUserid=mytransactionhistory[count].buyerUserid;
						askPrice=parseFloat(askPrice).toFixed(8);
						var sellaskPrice=mytransactionhistory[count].buyaskPrice;
						sellaskPrice=parseFloat(sellaskPrice).toFixed(8);
						var orderTime1=mytransactionhistory[count].datetime;
						var orderTime2=mytransactionhistory[count].datetime;
						var total1 = filledAmount*sellaskPrice;
					}
					// if(type1=='Buy'){var class1='success';}else{var class1='danger';}
					// if(type2=='Buy'){var class2='success';}else{var class2='danger';}
					
					if(buyerUserid==user_id)
					{
						var type = 'Buy';
						class1='success'
					}
					else
					{
						var type = 'Sell';
						class1='danger';
					}


					historys=historys+'<tr><td>'+type+'</td><td>'+orderTime1+'</td><td>'+askPrice+'</td><td>'+filledAmount+'</td><td>'+orderTime2+'</td></tr>';
					// historys=historys+'<tr><td>'+type2+'</td><td>'+orderTime2+'</td><td>'+sellaskPrice+'</td><td>'+filledAmount+'</td><td>'+parseFloat(total1).toFixed(8)+'</td></tr>';
					
				}
				$('.mytradehistory tbody').html(historys);
			}
			else
			{
				$('.mytradehistory tbody').html('<tr class="fd_rw"><td colspan="4" class="text-center">No Trade History Found!</td></tr>');
			}


			var orders=[];
		
			if(orders.length!=0||buyResult.length>0)
			{
				var order_table='';
				if(buyResult.length>0)
				{
					for(count = 0; count < buyResult.length; count++)
					{
						
						var price = "'"+buyResult[count]['Price']+"'";
						if(buyResult[count]['filledAmount'])
						{
							var filledamount=parseFloat(buyResult[count]['filledAmount']);
						}
						else
						{
							var filledamount=0;
						}
						
						if(orders[price]!=undefined)
						{
							orders[price] = parseFloat(orders[price])+parseFloat(buyResult[count]['Amount'])-filledamount;
						}
						else
						{
							orders[price] = parseFloat(buyResult[count]['Amount'])-filledamount;
						}
						
					}
				}
				var autoinc=0;
				for(var i in orders)
				{
					var ret = i.replace("'","");
					if(autoinc==0)
					{
						current_sell_price=parseFloat(ret).toFixed(8);
						autoinc=1;
					}
					var type="'sell'";
					order_table+='<tr onclick="placeorder('+type+','+parseFloat(ret).toFixed(8)+','+parseFloat(orders[i]).toFixed(8)+')"><td>'+parseFloat(ret).toFixed(8)+'</td><td>'+parseFloat(orders[i]).toFixed(8)+'</td><td>'+(parseFloat(orders[i])*parseFloat(ret)).toFixed(8)+'</td></tr>';
				}
			}
			else
			{
				order_table='<tr class="fd_rw"><td colspan="3" class="text-center">No Buy Order Found</td></tr>';
			}
			$('.buy_order tbody').html(order_table);
			var orders1=[];
		
			if(orders1.length!=0||sellResult.length>0)
			{
				var order_table='';
				if(sellResult.length>0)
				{
					for(count = 0; count < sellResult.length; count++)
					{

					
						var price = "'"+sellResult[count]['Price']+"'";
						if(sellResult[count]['filledAmount'])
						{
							var filledamount=parseFloat(sellResult[count]['filledAmount']);
						}
						else
						{
							var filledamount=0;
						}
						if(orders1[price]!=undefined)
						{
							orders1[price] = parseFloat(orders1[price])+parseFloat(sellResult[count]['Amount'])-filledamount;
						}
						else
						{
							orders1[price] = parseFloat(sellResult[count]['Amount'])-filledamount;
						}
					}
				}
				var autoinc1=0;
				for(var i in orders1)
				{
					var ret = i.replace("'","");
					if(autoinc1==0)
					{
						current_buy_price=parseFloat(ret).toFixed(8);
						autoinc1=1;
					}
					var type="'buy'";
					order_table+='<tr onclick="placeorder('+type+','+parseFloat(ret).toFixed(8)+','+parseFloat(orders1[i]).toFixed(8)+')"><td>'+parseFloat(ret).toFixed(8)+'</td><td>'+parseFloat(orders1[i]).toFixed(8)+'</td><td>'+(parseFloat(orders1[i])*parseFloat(ret)).toFixed(8)+'</td></tr>';
				}
			}
			else
			{
				order_table='<tr class="fd_rw"><td colspan="3" class="text-center">No Sell Order Found</td></tr>';
			}
			$('.sell_order tbody').html(order_table);
			if(pagetype!='home')
			{
				var open_orders=designs.open_orders;
				var cancel_orders=designs.cancel_orders;
				var stop_orders=designs.stop_orders;
				if(open_orders!=0&&open_orders.length>0)
				{
					var open_length=open_orders.length;
					var open_orders_text='';
					for(count = 0; count < open_length; count++)
					{
						var activefilledAmount=open_orders[count].totalamount;
						var activePrice=open_orders[count].Price;
						activePrice=(parseFloat(activePrice)).toFixed(8);
						var activeAmount  = open_orders[count].Amount;
						if(activefilledAmount)
						{
							activefilledAmount = activeAmount-activefilledAmount;
						}
						else
						{
							activefilledAmount = activeAmount;
						}
						activefilledAmount=(parseFloat(activefilledAmount)).toFixed(8);
						var activeCalcTotal = activefilledAmount*activePrice;
						activeCalcTotal=(parseFloat(activeCalcTotal)).toFixed(8);
						var click="return cancel_order('"+open_orders[count].trade_id+"')";
						open_orders_text=open_orders_text+'<tr><td>'+open_orders[count].Type+'</td><td>'+open_orders[count].datetime+'</td><td>'+activePrice+'</td><td>'+activefilledAmount+'</td><td>'+activeCalcTotal+'</td><td><a href="javascript:;" onclick="'+click+'"><i class="fa fa-times-circle pad-rht"></i></a></td></tr>';
					}



					//$('.open_orders tbody .mCustomScrollBox .mCSB_container').html(open_orders_text);
					$('.open_orders tbody').html(open_orders_text);
				}
				else
				{
					$('.open_orders tbody').html('<tr id="noopenorder"><td colspan="6" class="text-center">No open orders available!</td></tr>');
				}
				if(cancel_orders!=0&&cancel_orders.length>0)
				{
					var cancel_length=cancel_orders.length;
					var cancel_orders_text='';
					for(count = 0; count < cancel_length; count++)
					{
						var activePrice=cancel_orders[count].Price;
						activePrice=(parseFloat(activePrice)).toFixed(8);
						var activeAmount  = cancel_orders[count].Amount;
						var activefilledAmount=cancel_orders[count].totalamount;
						if(activefilledAmount)
						{
							activefilledAmount = activeAmount-activefilledAmount;
						}
						else
						{
							activefilledAmount = activeAmount;
						}
						activefilledAmount=(parseFloat(activefilledAmount)).toFixed(8);
						var activeCalcTotal = activefilledAmount*activePrice;
						activeCalcTotal=(parseFloat(activeCalcTotal)).toFixed(8);
						cancel_orders_text=cancel_orders_text+'<tr><td>'+cancel_orders[count].Type+'</td><td>'+cancel_orders[count].tradetime+'</td><td>'+activePrice+'</td><td>'+activefilledAmount+'</td><td>'+activeCalcTotal+'</td><td>Cancelled</td></tr>';
					}
					$('.cancel_orders tbody .mCustomScrollBox .mCSB_container').html(cancel_orders_text);
				}
				else
				{
					$('.cancel_orders tbody .mCustomScrollBox .mCSB_container').html('<tr id="nocancelorder"><td colspan="6" class="text-center">No cancel orders available!</td></tr>');
				}
				if(stop_orders!=0&&stop_orders.length>0)
				{
					var stop_length=stop_orders.length;
					var stop_orders_text='';
					for(count = 0; count < stop_length; count++)
					{
						var activePrice=stop_orders[count].Price;
						activePrice=(parseFloat(activePrice)).toFixed(8);
						var activeAmount  = stop_orders[count].Amount;
						var activefilledAmount=activeAmount;
						activefilledAmount=(parseFloat(activefilledAmount)).toFixed(8);
						var activeCalcTotal = activefilledAmount*activePrice;
						activeCalcTotal=(parseFloat(activeCalcTotal)).toFixed(8);
						var click="return cancel_order('"+stop_orders[count].trade_id+"')";
						stop_orders_text=stop_orders_text+'<tr><td>'+stop_orders[count].Type+'</td><td>'+stop_orders[count].datetime+'</td><td>'+activePrice+'</td><td>'+activefilledAmount+'</td><td>'+activeCalcTotal+'</td><td><a href="javascript:;" onclick="'+click+'"><i class="fa fa-times-circle pad-rht"></i></a></td></tr>';
					}
					$('.stop_orders tbody').html(stop_orders_text);
				}
				else
				{
					$('.stop_orders tbody').html('<tr id="nostoporder"><td colspan="6" class="text-center">No stop orders available!</td></tr>');
				}
				/*var input = $("#openordertext").val();
				var input1 = $("#closeordertext").val();
				var input2 =$("#stopordertext").val();
				if(input!='')
				{
					filter_openorder();
				}
				if(input1!='')
				{
					filter_closeorder();
				}
				if(input2!='')
				{
					filter_stoporder();
				}

				*/
			}
			$("#buyprice").html(current_buy_price);
			$(".to_cur_balance").html(to_currency);
			$("#sellprice").html(current_sell_price);
			$(".from_cur_balance").html(from_currency);		
			//var pair_length=pairs.length;		
			var btc=pairs.BTC;

			Object.keys(btc).forEach(function(key){
 				 var v=btc[key];
  				 Object.keys(v).forEach(function(vkey){
  				 if(vkey=="from_currency_symbol"){
  				 		var pid="#btc_"+v[vkey]+"_price";
  				 		var price=v["price"];
  				 		$(pid).html(price);
  				 		var vid="#btc_"+v[vkey]+"_volume";
  				 		var volume=v["volume"];
  				 		$(vid).html(volume);
  				 		if(v["change"] >0){

  				 			change='<span class="grn">+'+v["change"]+'</span>';

  				 		}else{

  				 			change='<span class="red">+'+v["change"]+'</span>';
  				 		}
  				 		var cid="#btc_"+v[vkey]+"_change";

  				 		$(cid).html(change);
 				
  				 	}				

  				 	
  				 });
			});
 

			var eth=pairs.ETH;
			Object.keys(eth).forEach(function(key){
 				 var v=eth[key];
  				 Object.keys(v).forEach(function(vkey){
  				 if(vkey=="from_currency_symbol"){
  				 		var pid="#eth_"+v[vkey]+"_price";
  				 		var price=v["price"];
  				 		price="5000";
  				 		$(pid).html(price);
  				 		var vid="#btc_"+v[vkey]+"_volume";
  				 		var volume=v["volume"];
  				 		$(vid).html(volume);
  				 		if(v["change"] >0){

  				 			change='<span class="grn">+'+v["change"]+'</span>';

  				 		}else{

  				 			change='<span class="red">+'+v["change"]+'</span>';
  				 		}
  				 		var cid="#btc_"+v[vkey]+"_change";

  				 		$(cid).html(change);
 				
  				 	}				

  				 	
  				 });
			});
 







  //(brand.key + " " + brand.value)
 

		
			


				/*


				var pairsymbolactive=$("#filterTable tbody .active").attr('id');
				// var pairsymbolactive=$("#filterTable1 tbody .active").attr('id');
				for(count = 0; count < pair_length; count++)
				{
					var symbols=pairs[count].from_currency_symbol+'_'+pairs[count].to_currency_symbol;
					var pairprice=$("#"+symbols+" td:eq( 1 )").html();
					var pairchange=$("#"+symbols+" td:eq( 2 ) span").html();
					pairchange = (pairchange)?pairchange.replace("%", ""):'';
					var pairvolume=$("#"+symbols+" td:eq( 3 )").html();
					var pairprice1=pairs[count].price;
					var pairchange1=pairs[count].change;
					var pairvolume1=pairs[count].volume;
					var changval=0;
					if(pairprice!=pairprice1)
					{
						changval=1;
						$("#"+symbols+" td:eq( 1 )").html(pairprice1);
					}
					if(pairchange!=pairchange1)
					{
						changval=1;
						if(pairchange1<0)
						{
							$("#"+symbols+" td:eq( 2 ) span").removeClass( "text-danger text-success" ).addClass( "text-danger" );
						}
						else
						{
							$("#"+symbols+" td:eq( 2 ) span").removeClass( "text-danger text-success" ).addClass( "text-success" );
						}
						$("#"+symbols+" td:eq( 2 ) span").html(parseFloat(pairchange1).toFixed(2));
					}
					if(pairvolume!=pairvolume1)
					{
						changval=1;
						$("#"+symbols+" td:eq( 3 )").html(pairvolume1);
					}
				}


				*/



			//}
/*			if(pagetype=='margin')
			{
				transfer_list();
				var positions=designs.positions;
				var baseprice=designs.baseprice;
				var cond_check=0;
				var textposition='';
				if(positions!=0)
				{
					var position_count=positions.length;
					for(var posi=0;posi<position_count;posi++)
					{
						var currency_symbol = positions[posi].currency_symbol;
						var Price           = positions[posi].Price;
						var Amount          = positions[posi].Amount;
						var rate            = positions[posi].rate;
						var status          = positions[posi].status;
						var tot_minutes     = positions[posi].date_diff;
						var swapamount      = positions[posi].swap_amount;
						if(currency_symbol!='BTC')
						{
							var borrow = swapamount*Price;
						}
						else
						{
							var borrow = swapamount;
						}
						var borrow_estimate=(borrow*20)/100;
						if(pair_id == positions[posi].pair && status=='filled')
						{
							cond_check=1;
							var swapamount1=swapamount;
							if(positions[posi].Type=='buy')
							{
								var current_price   = current_sell_price;
								var base_price      = Price+((Price*baseprice)/100);
								var currentprice    = (swapamount1*Price)-borrow_estimate;
								var liqutationprice = currentprice/swapamount1;
								var profitloss      = (parseFloat(((current_price*Amount)-(Price*Amount)))).toFixed(8);
							}
							else
							{
								var current_price   = current_buy_price;
								var base_price      = Price-((Price*baseprice)/100);
								swapamount      	= '-'+swapamount;
								var currentprice    = (swapamount1*Price)+borrow_estimate;
								var liqutationprice = currentprice/swapamount1;
								var profitloss      = (parseFloat(((Price*Amount)-(current_price*Amount)))).toFixed(8);
							}
							var range             = positions[posi].range;
							var minutes           = range*24*60;
							var interest          = (parseFloat(((swapamount1*rate)/100))).toFixed(8);
							var min_interest      = interest/minutes;
							var tot_interest      = (parseFloat((min_interest*tot_minutes))).toFixed(8);
							if(positions[posi].Type=='buy'){var positiontype="Long";}else{var positiontype="Short";}
							textposition=textposition+'<tr><td>'+positiontype+'</td><td>'+swapamount+currency_symbol+'</td><td>'+parseFloat(base_price).toFixed(8)+'</td><td>'+(parseFloat(liqutationprice)).toFixed(8)+'</td><td>'+profitloss+'</td><td>'+tot_interest+'</td><td><a href="javascript:;" onclick="return cancel_order('+positions[posi].trade_id+')">Close</a></td></tr>';
						}
					}
				}
				if(textposition!='')
				{
					$("#onpositiondiv").show();
					$("#nopositiondiv").hide();
					$("#openpositionstable tbody").html(textposition);
				}
				else
				{
					$("#onpositiondiv").hide();
					$("#nopositiondiv").show();
				}
			}*/
		}
	});
}