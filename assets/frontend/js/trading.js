
/*
var myDataRef = new Firebase("https://wcx-io.firebaseio.com/");
     $(document).keypress(function(e) {
		if(e.which == 13 && e.target.id== 'msgIpt')
		{
			check_user_login();
			var m = $('#msgIpt').val();
			if(u!=''&&m!='')
			{
				var start = new Date();
				myDataRef.push({name: u, text: m, date: start.getTime(),image: user_image});
				$('#msgIpt').val('');
			}
		}
    });	
$('#pres_tx_btnSubmit').click(function() {
	check_user_login();function 
	var m = $('#msgIpt').val();
	if(u!=''&&m!='')
	{
		var start = new Date();
		myDataRef.push({name: u, text: m, date: start.getTime(),image: user_image});
		$('#msgIpt').val('');
	}
});



*/


$(document).bind("contextmenu",function(e) {

 e.preventDefault();
});

$(document).keydown(function(e){
    if(e.which === 123){


       return false;
    }
});

 $('.sprocket').click(function(){

 		if(!$('.tools').hasClass('active')){
            hideAllToolPanels();
        }
		$('.tools').addClass('active');
    	$(".toolPanel-grap").fadeToggle(200);
    });


function hideAllToolPanels() {
    $('#market_settings, .toolPanel-grap').fadeOut(200);
    $('.tools.active, #panel_settings.active').removeClass('active');
}

function clear_console(){

	
/*	console.API;
	if (typeof console._commandLineAPI !== 'undefined') {
    	console.API = console._commandLineAPI; //chrome
	} else if (typeof console._inspectorCommandLineAPI !== 'undefined') {
    	console.API = console._inspectorCommandLineAPI; //Safari
	} else if (typeof console.clear !== 'undefined') {
    	console.API = console;
	}

	console.API.clear();
*/




	return true;
	
	}


$('#clear_filter').click(function() { 


	$('#myInput').val("");
	$("#clear_filter").hide();
	$(this).hide();

	$('#clear_filter').css('display', 'block');

	//$('#clear_filter').css('display': 'none');
	$('#clear_filter').removeAttr('style');
	$('#clear_filter').css('display', 'none');
	filter_pairs();

	//$(this).html('<i class="fa fa-spinner fa-spin"></i>Please wait..');
  

});


$('.sel_btn').click(function() { 

	//$(this).html('<i class="fa fa-spinner fa-spin"></i>Please wait..');
  

});



     $(".sell_btn").attr('disabled',true);

	$('.buy').click(function() { 
    var id = $(this).attr('id');
    $container.cycle(id.replace('#', '')); 
    return false; 
	});




$( "#theme_change" ).click(function() {

	var mode=$("#theme_change").attr("data-mode");
	

	if(mode=="day"){

		//$("#theme").attr("href", "assets/frontend/css/trade_dark.css");
		//$("#theme_change" ).html("SWITCH TO DAY MODE <img src='"+base_url+"assets/frontend/images/light_off.png'>");
		//$("#theme_change").attr("data-mode","night");
		 $(".mode").addClass("mode_on");
         $("#theme_change i").removeClass("fa-moon-o");
         $("#theme_change i").addClass("fa-sun-o");
         $("body").removeClass("white_web");
		var current_mode="night";


	}else{
	
	//$("#theme_change" ).html("SWITCH TO Night MODE <img src='"+base_url+"assets/frontend/images/light_on.png'>");
	//$("#theme_change").attr("data-mode","day");	
	//$("#theme").attr("href", "assets/frontend/css/trade_light.css");
	$("body").addClass("white_web");
    $("#theme_change i").removeClass("fa-sun-o");
    $("#theme_change i").addClass("fa-moon-o");
    $(".mode").removeClass("mode_on");
	

	var current_mode="day";

}


		$.ajax({
		url:base_url+'update_theme?mode='+current_mode,
		type: 'POST',            
		data: "mode="+current_mode,
		success: function(res)
		{

			var current_mode="day";

			 location.reload();
		}
	});


});




function check_user_login()
{
	if(user_id==''||user_id==undefined||user_id==0)
	{
		$('#auth-modal').modal('show');
		return false;
	}
	return true;
}

/*

myDataRef.on('child_added', function(snapshot){
        var msg = snapshot.val();
		var start = new Date();
		var time_data=start.getTime()-10;
		var timemsg=get_date(msg.date);
		if(msg.image)
		{
			var image_user=msg.image;
		}
		else
		{
			var image_user=dummyimg;
		}
        displayMsg(msg.name, msg.text,image_user,timemsg);
});
function displayMsg(name, text, image, time_of_msg)
{
	if(u==name)
	{
		var class1='chat_out';
		var class2='chat_outcnt';
	}
	else
	{
		var class1='chat_in';
		var class2='chat_incnt';
	}
	var msg_text='<div class="'+class1+'"><h4><img src="'+image+'" class="trd_usr">'+name+'<span class="chat_min">'+time_of_msg+'</span></h4><div class="'+class2+'"><p>'+text+'</p></div></div>';
	$('#msgList').append(msg_text);
	$('.chat_tab').mCustomScrollbar('scrollTo','bottom');
}
function get_date(dt1) 
{
	var dt2   = new Date();
	var diff =(dt2.getTime() - dt1) / 1000;
	diff /= 60;
	var time_taken = Math.abs(Math.round(diff));
	if(time_taken==0)
	{
		var text = 'Just Now';
	}
	else
	{
		if(time_taken<60)
		{
			var text = time_taken+' mins ago';
		}
		else
		{
			var hours = Math.floor( time_taken / 60);
			if(hours<24)
			{
				if(hours==1)placed
				{
					var text = hours+' hour ago';
				}
				else
				{
					var text = hours+' hours ago';
				}
			}
			else
			{
				var days = Math.floor( hours / 24);
				if(days==1)
				{
					var text = days+' day ago';
				}
				else
				{
					var text = days+' days ago';
				}
			}
		}
	}
	return text;
}
*/


window.onkeydown = function(e){
   if(e.keyCode == 70 && e.ctrlKey){
	    $( "#myInput" ).focus();
       return false;
           }
}






function filter_pairs() {

  var input, filter, table, tr, td, i;
  var j=0;

  input = document.getElementById("myInput");


  var textv=$("#myInput").val();

  if(textv!=""){
  	$("#clear_filter").show();
  }else{
  	$("#clear_filter").hide();
  }

  filter = input.value.toUpperCase();
  table = document.getElementById("btc_table");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
  	
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
   
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {

        tr[i].style.display = "";
		j++;
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
  if(j==0)
  {
	  //var nomarket = document.getElementById("nomarket");
	  //$("#nomarket").addClass("fd_rw");
	 // nomarket.style.display = "";
  }
  else
  {
	 // var nomarket = document.getElementById("nomarket");
	  //$("#nomarket").removeClass("fd_rw");
	 // nomarket.style.display = "none";
  }



 var input, filter, table, tr, td, i;
  var j=0;
  input = document.getElementById("myInput");

  filter = input.value.toUpperCase();

  table = document.getElementById("eth_table");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
		j++;
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
  if(j==0)
  {
	  //var nomarket = document.getElementById("nomarket");
	  //$("#nomarket").addClass("fd_rw");
	 // nomarket.style.display = "";
  }
  else
  {
	 // var nomarket = document.getElementById("nomarket");
	  //$("#nomarket").removeClass("fd_rw");
	  //nomarket.style.display = "none";
  }


 var input, filter, table, tr, td, i;
  var j=0;
  input = document.getElementById("myInput");

  filter = input.value.toUpperCase();

  table = document.getElementById("usdt_table");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
		j++;
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
  if(j==0)
  {
	  //var nomarket = document.getElementById("nomarket");
	  //$("#nomarket").addClass("fd_rw");
	 // nomarket.style.display = "";
  }
  else
  {
	 // var nomarket = document.getElementById("nomarket");
	  //$("#nomarket").removeClass("fd_rw");
	  //nomarket.style.display = "none";
  }






 var input, filter, table, tr, td, i;
  var j=0;
  input = document.getElementById("myInput");

  filter = input.value.toUpperCase();

  table = document.getElementById("bch_table");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
		j++;
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
  if(j==0)
  {
	  //var nomarket = document.getElementById("nomarket");
	  //$("#nomarket").addClass("fd_rw");
	 // nomarket.style.display = "";
  }
  else
  {
	 // var nomarket = document.getElementById("nomarket");
	  //$("#nomarket").removeClass("fd_rw");
	  //nomarket.style.display = "none";
  }



}
function filter_pairs1() {
  var input, filter, table, tr, td, i;
  var j=0;
  input = document.getElementById("myInput1");
  filter = input.value.toUpperCase();
  table = document.getElementById("filterTable1");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length-1; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
		j++;
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
  if(j==0)
  {
	  var nomarket = document.getElementById("nomarket1");
	  $("#nomarket1").addClass("fd_rw");
	  nomarket.style.display = "";
  }
  else
  {
	  var nomarket = document.getElementById("nomarket1");
	  $("#nomarket1").removeClass("fd_rw");
	  nomarket.style.display = "none";
  }
}






$( document ).ready(function() {




/*
$.getJSON('https://cdn.rawgit.com/highcharts/highcharts/v6.0.4/samples/data/new-intraday.json', function (data) {

    // create the chart
    Highcharts.stockChart('container', {


        title: {
            text: 'AAPL stock price by minute'
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
            type: 'candlestick',
            data: data,
            tooltip: {
                valueDecimals: 2
            }
        }]
    });
});





*/


/*
var url = base_url+"market_depth/"+pair_id;

$.getJSON(url, function(data) {
var sell_order=data.sell_order;
var buy_order=data.buy_order;


Highcharts.chart('market_depth', {
    chart: {
        type: 'area'
    },
    title: {
        text: ''
    },
    

    xAxis: {
        allowDecimals: false,
        title: {
            text: 'Nuclear weapon states'
        },
        labels: {
            formatter: function () {
                return this.value; // clean, unformatted number for year
            }
        }
    },
    yAxis: {
        title: {
            text: 'Nuclear weapon states'
        },
        labels: {
            formatter: function () {
                return this.value / 1000 + 'k';
            }
        }
    },
    tooltip: {
        pointFormat: '{series.name} produced <b>{point.y:,.0f}</b><br/>warheads in {point.x}'
    },
    plotOptions: {
        area: {
            pointStart: 1940,
            marker: {
                enabled: false,
                symbol: 'circle',
                radius: 2,
                states: {
                    hover: {
                        enabled: true
                    }
                }
            }
        }
    },
    series: [{
       // name: 'USA',
        data: sell_order
    }, {
      //  name: 'USSR/Russia',
        data: buy_order
    }]
});
});

*/











/*
var url =base_url+'trade/tradechart/'+pair_id+'/trade';

$.getJSON(url, function(data) {
	clear_console();
new Highcharts.stockChart('container', {
    plotOptions: {
        candlestick: {
            lineColor: '#00cc44',
            upLineColor: '#EF6164',
            upColor: '#EF6164',
            downLineColor: '#9CCE5B',
            downColor: '##9CCE5B'
        }
    },
	scrollbar: {
		enabled: false
	},	
	navigator: {
        enabled: false
    },	
	yAxis:{
		min: 0
	},
    series: [{
        type: 'candlestick',
        name: pair,
		tooltip: {
		valueDecimals: 8
		},
		data: data
    }]
});
}); 


*/
});


(function($){
			$(window).on("load",function(){

        var width = $(window).width();
      
        if(width>1024){
        $(".trade_history_scroll,.sell_order,.buy_order,.order_table_scroll,.chat_tab,.order_table_scroll1,.order_table_scroll2,.order_table_scroll3").mCustomScrollbar({
                          scrollButtons:{
                            enable:false
                          },

                      scrollbarPosition: 'inside',
                      autoExpandScrollbar:true, 
                      theme: 'minimal-dark',
                       axis:"y",
                          setWidth: "auto"
            });
          				
        }else{
    $(".trade_history_scroll,.sell_order,.buy_order,.order_table_scroll,.chat_tab,.order_table_scroll1,.order_table_scroll2,.order_table_scroll3").mCustomScrollbar({
                          scrollButtons:{
                            enable:false
                          },

                      scrollbarPosition: 'inside',
                      autoExpandScrollbar:true, 
                      theme: 'minimal-dark',
                       axis:"x",
                          setWidth: "auto"
            });
       
        }
        
				
			});
		})(jQuery);
function change_pair(url)
{
	if(pagetype=='margin')
	{
		var reurl='margin';
	}
	else
	{
		var reurl='trade';
	}
	location.href = front_url+reurl+'/'+url;
}
function calculation(a)
{	

	$('.growl-close').trigger('click');	
		if(a=='buy' || a=='sell' ){
			var amount      = $("#"+a+"_amount").val();
			var buy_price   = $('#buy_price').val();
			var sell_price  = $('#sell_price').val();
			var order_type  = $('#'+a+'_order_type').val();
			
		}else{
			var amount      = $("#stop_limit_amount").val();
			var price   = $('#stop_limit_price').val();
			var order_type  = $('stop_limit').val();
		}


	if(order_type=='instant'){


        if(a=='buy'){

          var tot   = (parseFloat(amount)*parseFloat(current_buy_price)).toFixed(8);
          var fees  = (parseFloat((parseFloat(amount)*parseFloat(current_buy_price)*maker_fee/100))).toFixed(8);
		  var n = tot.toString();
		  var n1 = fees.toString();
          if(tot>0)
			{
				var tot = (parseFloat(tot)+parseFloat(fees)).toFixed(8);
			}
			else
			{
				var tot = 0;
			}
			if(amount!="" && amount!=0 && !isNaN(amount)&&n.indexOf("e")==-1&&n1.indexOf("e")==-1)
			{

				//$('#buy_tot').val(tot);  

				
				$('#buy_fee_tot').html(fees);
			}
			else
			{
				if(n.indexOf("e")>-1||n1.indexOf("e")>-1)
				{
					$.growl.error({ message: "Please enter valid amount and price" });
					return false;
				}
				$('#buy_tot').val(0);
				$('#buy_fee_tot').html(0);
			}
        }
        else
		{
			var tot   = (parseFloat(amount)*parseFloat(current_sell_price)).toFixed(8);
			var fees = (parseFloat((parseFloat(amount)*parseFloat(current_sell_price)*taker_fee/100))).toFixed(8);
			var n = tot.toString();
			var n1 = fees.toString();
			if(tot>0)
			{
				var tot = (parseFloat(tot)-parseFloat(fees)).toFixed(8);
			}
			else
			{
				var tot = 0;
			}
			if(amount!="" && amount!=0 && !isNaN(amount)&&n.indexOf("e")==-1&&n1.indexOf("e")==-1)
			{
				//$('#sell_tot').val(tot); 
				$('#sell_fee_tot').html(fees);
			}
			else
			{
				if(n.indexOf("e")>-1||n1.indexOf("e")>-1)
				{
					$.growl.error({ message: "Please enter valid amount and price" });
					return false;
				}
				//$('#sell_tot').val(0);
				$('#sell_fee_tot').html(0);
			}
        }
    }
    else if(order_type=='limit')
	{

				if(a=='buy')
		{
			var tot   = (parseFloat(amount)*parseFloat(buy_price)).toFixed(8);
			var fees  = (parseFloat((parseFloat(amount)*parseFloat(buy_price)*maker_fee/100))).toFixed(8);
			var n = tot.toString();
			var n1 = fees.toString();
			if(tot>0)
			{
				var tot = (parseFloat(tot)+parseFloat(fees)).toFixed(8);
			}
			else
			{
				var tot = 0;
			}
			if(amount!="" && buy_price!="" && amount!=0 && buy_price!=0&&!isNaN(amount)&&n.indexOf("e")==-1&&n1.indexOf("e")==-1)
			{
				
				//$('#buy_tot').val(tot);  
				$('#buy_fee_tot').html(fees);
			}
			else
			{
				if(n.indexOf("e")>-1||n1.indexOf("e")>-1)
				{
					$.growl.error({ message: "Please enter valid amount and price" });
					return false;
				}
				//$('#buy_tot').val(0);
				$('#buy_fee_tot').html(0);
			}
		}
		else
		{
			var tot   = (parseFloat(amount)*parseFloat(sell_price)).toFixed(8);
			var fees = (parseFloat((parseFloat(amount)*parseFloat(sell_price)*taker_fee/100))).toFixed(8);
			var n = tot.toString();
			var n1 = fees.toString();
			if(tot>0)
			{
				var tot = (parseFloat(tot)-parseFloat(fees)).toFixed(8);
			}
			else
			{
				var tot = 0;
			}
			if(amount!="" && sell_price!="" && amount!="" && sell_price!=""&&!isNaN(amount)&&n.indexOf("e")==-1&&n1.indexOf("e")==-1)
			{
				//$('#sell_tot').val(tot); 

				
				$('#sell_fee_tot').html(fees);
			}
			else
			{
				if(n.indexOf("e")>-1||n1.indexOf("e")>-1)
				{
					$.growl.error({ message: "Please enter valid amount and price" });
					return false;
				}
				//$('#sell_tot').val(0);
				$('#sell_fee_tot').html(0);
			}
		}
	}else{

		
			var tot   = (parseFloat(amount)*parseFloat(price)).toFixed(8);
			//var fees  = (parseFloat((parseFloat(amount)*parseFloat(buy_price)*maker_fee/100))).toFixed(8);
			var n = tot.toString();
			//var n1 = fees.toString();
			if(tot>0)
			{
				var tot = parseFloat(tot);
			}
			else
			{
				var tot = 0;
			}


			if(amount!="" && amount!=0 &&!isNaN(amount)&&n.indexOf("e")==-1)
			{
			
						
				$('#stop_limit_tot').val(tot);  
			}
			else
			{
				if(n.indexOf("e")>-1)
				{
					$.growl.error({ message: "Please enter valid amount and price" });
					return false;
				}
				$('#stop_limit_tot').val(0);
				//$('#buy_fee_tot').html(0);
			}
		}
	
}

function amount_calculation(a)
{	



	$('.growl-close').trigger('click');	
		if(a=='buy' || a=='sell' ){
			var amount      = $("#"+a+"_amount").val();
			var buy_price   = $('#buy_price').val();
			var sell_price  = $('#sell_price').val();
			var order_type  = $('#'+a+'_order_type').val();
			
		}else{
			var amount      = $("#stop_limit_amount").val();
			var price   = $('#stop_limit_price').val();
			var order_type  = $('stop_limit').val();
		}


	if(order_type=='instant'){


        if(a=='buy'){

        	

          var tot   = (parseFloat(amount)*parseFloat(current_buy_price)).toFixed(8);
          var fees  = (parseFloat((parseFloat(amount)*parseFloat(current_buy_price)*maker_fee/100))).toFixed(8);
		  var n = tot.toString();
		  var n1 = fees.toString();
          if(tot>0)
			{
				var tot = (parseFloat(tot)+parseFloat(fees)).toFixed(8);
			}
			else
			{
				var tot = 0;
			}
			if(amount!="" && amount!=0 && !isNaN(amount)&&n.indexOf("e")==-1&&n1.indexOf("e")==-1)
			{

				//$('#buy_tot').html(tot);  
				$('#buy_tot').val(tot);  

				
				$('#buy_fee_tot').html(fees);
			}
			else
			{
				if(n.indexOf("e")>-1||n1.indexOf("e")>-1)
				{
					$.growl.error({ message: "Please enter valid amount and price" });
					return false;
				}
				//$('#buy_tot').html(0);
				$('#buy_tot').val(0);
				$('#buy_fee_tot').html(0);
			}
        }
        else
		{
			var tot   = (parseFloat(amount)*parseFloat(current_sell_price)).toFixed(8);
			var fees = (parseFloat((parseFloat(amount)*parseFloat(current_sell_price)*taker_fee/100))).toFixed(8);
			var n = tot.toString();
			var n1 = fees.toString();
			if(tot>0)
			{
				var tot = (parseFloat(tot)-parseFloat(fees)).toFixed(8);
			}
			else
			{
				var tot = 0;
			}
			if(amount!="" && amount!=0 && !isNaN(amount)&&n.indexOf("e")==-1&&n1.indexOf("e")==-1)
			{
				//$('#sell_tot').html(tot); 
				$('#buy_tot').val(tot);  
				$('#sell_fee_tot').html(fees);
			}
			else
			{
				if(n.indexOf("e")>-1||n1.indexOf("e")>-1)
				{
					$.growl.error({ message: "Please enter valid amount and price" });
					return false;
				}
				//$('#sell_tot').html(0);
				$('#buy_tot').val(tot);  
				$('#sell_fee_tot').html(0);
			}
        }
    }
    else if(order_type=='limit')
	{

				if(a=='buy')
		{
			var tot   = (parseFloat(amount)*parseFloat(buy_price)).toFixed(8);
			var fees  = (parseFloat((parseFloat(amount)*parseFloat(buy_price)*maker_fee/100))).toFixed(8);
			var n = tot.toString();
			var n1 = fees.toString();
			if(tot>0)
			{
				var tot = (parseFloat(tot)+parseFloat(fees)).toFixed(8);
			}
			else
			{
				var tot = 0;
			}
			if(amount!="" && buy_price!="" && amount!=0 && buy_price!=0&&!isNaN(amount)&&n.indexOf("e")==-1&&n1.indexOf("e")==-1)
			{
				
				//$('#buy_tot').html(tot);  
				$('#buy_tot').val(tot);  
				$('#buy_fee_tot').html(fees);
			}
			else
			{
				if(n.indexOf("e")>-1||n1.indexOf("e")>-1)
				{
					$.growl.error({ message: "Please enter valid amount and price" });
					return false;
				}
				//$('#buy_tot').html(0);
				$('#buy_tot').val(tot);  
				$('#buy_fee_tot').html(0);
			}
		}
		else
		{
			var tot   = (parseFloat(amount)*parseFloat(sell_price)).toFixed(8);
			var fees = (parseFloat((parseFloat(amount)*parseFloat(sell_price)*taker_fee/100))).toFixed(8);
			var n = tot.toString();
			var n1 = fees.toString();
			if(tot>0)
			{
				var tot = (parseFloat(tot)-parseFloat(fees)).toFixed(8);
			}
			else
			{
				var tot = 0;
			}
			if(amount!="" && sell_price!="" && amount!="" && sell_price!=""&&!isNaN(amount)&&n.indexOf("e")==-1&&n1.indexOf("e")==-1)
			{
				$('#sell_tot').val(tot); 

				
				$('#sell_fee_tot').html(fees);
			}
			else
			{
				if(n.indexOf("e")>-1||n1.indexOf("e")>-1)
				{
					$.growl.error({ message: "Please enter valid amount and price" });
					return false;
				}
				$('#sell_tot').val(0);
				$('#sell_fee_tot').html(0);
			}
		}
	}else{

		
			var tot   = (parseFloat(amount)*parseFloat(price)).toFixed(8);
			//var fees  = (parseFloat((parseFloat(amount)*parseFloat(buy_price)*maker_fee/100))).toFixed(8);
			var n = tot.toString();
			//var n1 = fees.toString();
			if(tot>0)
			{
				var tot = parseFloat(tot);
			}
			else
			{
				var tot = 0;
			}


			if(amount!="" && amount!=0 &&!isNaN(amount)&&n.indexOf("e")==-1)
			{
			
						
				$('#stop_limit_tot').val(tot);  
			}
			else
			{
				if(n.indexOf("e")>-1)
				{
					$.growl.error({ message: "Please enter valid amount and price" });
					return false;
				}
				$('#stop_limit_tot').val(0);
				//$('#buy_fee_tot').html(0);
			}
		}
	
}



function change_type(a,b)
{
	if(a=='instant')
	{
		$('#'+b+'_price_sec').hide();
		$('#'+a+'_price_sec').hide();
	}
	else
	{ 
		if(a=='limit')
		{
			$('#class'+b+'price').html('Price'); 
		}
		else
		{
			$('#class'+b+'price').html('Stop Price'); 
		}
		$('#'+b+'_price_sec').show(); 
	}
	calculation(b);
}
function order_placed(a)
{


	if(a=="buy"){

		$(".buy_sec").html('<i class="fa fa-spinner fa-spin"></i>Please wait..');

	}


	if(a=="sell"){

		$(".sell_sec").html('<i class="fa fa-spinner fa-spin"></i>Please wait..');

	}

	if(a=="stop_limit_buy"){

		$(".limit_buy").html('<i class="fa fa-spinner fa-spin"></i>Please wait..');

	}
	if(a=="stop_limit_sell"){

		$(".limit_sell").html('<i class="fa fa-spinner fa-spin"></i>Please wait..');

	}


	






	var logincheck=check_user_login();
	calculation(a);
	$('.growl-close').trigger('click');
	if(logincheck)
	{

	  if(a!="stop_limit_buy" && a!="stop_limit_sell"){			
		var c     =   $("#"+a+"_amount").val(),d = $("#"+a+"_tot").val();	
		if(isNaN(c) || isNaN(d))
		{
			$.growl.error({ message: "Please enter valid amount and price" });
				$(".buy_btn").attr('disabled',false);
			$(".sel_btn").attr('disabled',false);
			$(".buy_btn").html('BUY');	
			$(".sel_btn").html('SELL');	

			return false;
		}
		else if(c=="" || c<=0 || d=="" || d<=0)
		{
			$.growl.error({ message: "Please enter valid amount and price" });
			
			$(".buy_btn").attr('disabled',false);
			$(".sel_btn").attr('disabled',false);
			$(".buy_btn").html('BUY');	
			$(".sel_btn").html('SELL');	
			return false;
		}

	}else{





	 	var c     =   $("#stop_limit_amount").val();

	 	d = $("#stop_limit_price").val();

	 	e=$("#stop_limit_price").val();

	
		if(isNaN(c) || isNaN(d))
		{
			$.growl.error({ message: "Please enter valid amount and price" });
			
			$(".buy_btn").attr('disabled',false);
			$(".sel_btn").attr('disabled',false);
			$(".buy_btn").html('BUY');	
			$(".sel_btn").html('SELL');	
			return false;
		}
		else if(c=="" || c<=0 || d=="" || d<=0)
		{
			$.growl.error({ message: "Please enter valid amount and price" });
		$(".buy_btn").attr('disabled',false);
			$(".sel_btn").attr('disabled',false);
			$(".buy_btn").html('BUY');	
			$(".sel_btn").html('SELL');	

			return false;
		}else if(e==""){

			$.growl.error({ message: "Please enter stop price" });
				$(".buy_btn").attr('disabled',false);
			$(".sel_btn").attr('disabled',false);
			$(".buy_btn").html('BUY');	
			$(".sel_btn").html('SELL');			

			return false;

		}

			var stop_val = $("#stop_limit_price").val();
			 d=parseFloat(d).toFixed(8);
			if(a=='stop_limit_buy')
			{


				
				if(parseFloat(d)>parseFloat(current_buy_price))
				{					
					
				}
				else if(parseFloat(d)<=parseFloat(current_buy_price))
				{					
					$.growl.error({ message: "Please enter greater than current market price" });
					
				$(".buy_btn").attr('disabled',false);
			$(".sel_btn").attr('disabled',false);
			$(".buy_btn").html('BUY');	
			$(".sel_btn").html('SELL');	
					return false;
				}else if(0==parseFloat(stop_val) || parseFloat(stop_val) < 0  || stop_val=="") {
					
					$.growl.error({ message: "Please enter valid price" });
					
					$(".buy_btn").attr('disabled',false);
			$(".sel_btn").attr('disabled',false);
			$(".buy_btn").html('BUY');	
			$(".sel_btn").html('SELL');	

					return false;
				}

			}
			else
			{

				if(parseFloat(d)>parseFloat(current_sell_price))
				{
					

					$.growl.error({ message: "Please enter less than current market price" });
				
					$(".buy_btn").attr('disabled',false);
					$(".sel_btn").attr('disabled',false);
					$(".buy_btn").html('BUY');	
					$(".sel_btn").html('SELL');	
					
					return false;
				}else if(0==parseFloat(stop_val) || parseFloat(stop_val) < 0  || stop_val=="") {
					
					$.growl.error({ message: "Please enter valid price" });
						$(".buy_btn").attr('disabled',false);
					$(".sel_btn").attr('disabled',false);
					$(".buy_btn").html('BUY');	
				$(".sel_btn").html('SELL');	
					return false;
				}



			}


	}
	


	return order_confirm(a);
	}
}
function order_confirm(a)
{



	$('.growl-close').trigger('click');
	var c  = $("#"+a+"_amount").val();
	var order_type = a;
	if(order_type == "instant" || order_type=="limit")
	{
		if(a=='buy')
		{
			var  d = current_buy_price;
		}
		else
		{
			var  d = current_sell_price;
		}
	}
	else 
	{
		var  d = $("#"+a+"_price").val();
		if(order_type!='limit')
		{
			var  c = $("#stop_limit_amount").val();
			var  d = $("#stop_limit_price").val();	

			//alert("amount"+c);
			//alert("amount"+d);


			if(order_type=='stoplimit')
			{
		

		


			var stop_val = $("#stop_limit_price").val();
			if(a=='buy')
			{
				if(parseFloat(d)<=parseFloat(current_buy_price))
				{
					$.growl.error({ message: "Please enter greater than current market price" });
					
					$(".buy_btn").attr('disabled',false);
					$(".sel_btn").attr('disabled',false);
					$(".buy_btn").html('BUY');	
					$(".sel_btn").html('SELL');	
					return false;
				}else if(0==parseFloat(stop_val) || parseFloat(stop_val) < 0  || stop_val=="") {

					$.growl.error({ message: "Please enter valid price" });
					
						$(".buy_btn").attr('disabled',false);
						$(".sel_btn").attr('disabled',false);
						$(".buy_btn").html('BUY');	
						$(".sel_btn").html('SELL');	
					return false;
				}

			}
			else
			{



				if(parseFloat(d)>=parseFloat(current_sell_price))
				{
				
					$.growl.error({ message: "Please enter less than current market price" });
					
					$(".buy_btn").attr('disabled',false);
					$(".sel_btn").attr('disabled',false);
					$(".buy_btn").html('BUY');	
					$(".sel_btn").html('SELL');	

					return false;
				}
			}
		}




		}
	} 













	var multiply  = parseFloat(c)*parseFloat(d);


	if(order_type == "instant" || 	order_type == "limit"){


			if(a=="buy")
			{
				var fees      = parseFloat(multiply)*maker_fee/100;
			}
			else
			{
				var fees      = parseFloat(multiply)*taker_fee/100;
			}
			if(multiply>0)
			{
				var tot = multiply+fees;
			}
			else
			{
				var tot = 0;
			}	

}else{

	var tot = multiply;


}



	if(parseFloat(tot) < parseFloat(minimum_trade_amount)){
		$.growl.error({ message: "Minimum trade amount is "+ parseFloat(minimum_trade_amount) });
		
			$(".buy_btn").attr('disabled',false);
			$(".sel_btn").attr('disabled',false);
			$(".buy_btn").html('BUY');	
			$(".sel_btn").html('SELL');	
		return false;
	}
	var mul = parseFloat(tot).toFixed(8);
	var to_currency1 = parseFloat(to_currency);
	if(a=="buy" || a=="stop_limit_buy" )
	{ 
		if(mul > to_currency1)
		{ 
			$.growl.error({ message: "Insufficient balance" });
				$(".buy_btn").attr('disabled',false);
			$(".sel_btn").attr('disabled',false);
			$(".buy_btn").html('BUY');	
			$(".sel_btn").html('SELL');	
			return false;
		}
		else
		{

			if(a=="stop_limit_buy"){
				return executeOrder('stop_limit_buy');

			}else{

				return executeOrder('buy');
			}		
		}
	}
	else
	{     
		if(from_currency < parseFloat(c))
		{
			$.growl.error({ message: "Insufficient balance" });
				$(".buy_btn").attr('disabled',false);
			$(".sel_btn").attr('disabled',false);
			$(".buy_btn").html('BUY');	
			$(".sel_btn").html('SELL');	
			return false;
		}
		else
		{
			
			if(a=="stop_limit_buy"){
				return executeOrder('stop_limit_buy');

			}if(a=="stop_limit_sell"){

				return executeOrder('stop_limit_sell');

			}else{

				return executeOrder('sell');
			}		
		}
	}
}
function executeOrder(a)
{



	calculation(a);
	$('.growl-close').trigger('click');
	if(a!="buy" && a!="sell" ){

		var stop_price = $("#stop_price").val();

;
		var amount = $("#stop_limit_amount").val();

		var price = $("#stop_limit_price").val();
	
		var total = $("#stop_limit_tot").val(); 

	
		var ordertype = "stop_limit";	

		if(a=="stop_limit_buy"){
			a="buy";
		}else{
			a="sell";
		}



	}else{

		var stop_price = 0;
		var amount = $("#"+a+"_amount").val();
		var price = $("#"+a+"_price").val();
		var total = $("#"+a+"_tot").val(); 
		var ordertype = $("#"+a+"_order_type").val();





	}



	if(a =='buy')
	{
		var fee=maker_fee;
	}
	else
	{
		var fee=taker_fee;
	}
	if(ordertype=='instant')
	{
		if(a =='buy')
		{
			var current_price=current_buy_price;
		}
		else
		{
			var current_price=current_sell_price;
		}
		var price = (parseFloat(current_price)).toFixed(8);
	}
	else if(ordertype=='stop_limit')
	{
		var price = parseFloat(price);
	}
	$('.sel_btn,.sel_btn').prop('disabled', true);

	//$('.buy_btn').html('<i class="fa fa-spinner fa-spin"></i>Please wait..');
	

	$(".buy_btn").attr('disabled',true);	


     $(".sel_btn").attr('disabled',true);
 var loan_rate=0;

	$.ajax({
		url:base_url+'createOrder',
		type: 'POST',            
		data: "stop_price="+stop_price+"&amount="+amount+"&price="+price+"&total="+total+"&fee="+fee+"&ordertype="+ordertype+"&pair="+pair+"&pair_id="+pair_id+"&type="+a+"&loan_rate="+loan_rate+"&pagetype="+pagetype,
		success: function(res)
		{

			$(".buy_btn").attr('disabled',false);
			$(".sel_btn").attr('disabled',false);
			$(".buy_btn").html('BUY');	
			$(".sel_btn").html('SELL');	



			//alert("Enter here");
			//$("#buy_price").val("");
				$("#buy_amount").val("");
				$("#buy_tot").val("");
				//$("#sell_price").val("");
				$("#sell_amount").val("");
				$("#sell_tot").val("");	

			$('.sell_btn,.buy_btn').prop('disabled', false);
			$("#loading_circle").hide();
			var res = res.replace(/(\r\n|\n|\r)/gm,"");
			var res1=JSON.parse(res);
			if(res1.status == "balance")
			{ 
				$.growl.error({ message: "Insufficient balance" });


				return false;
			}
			else if(res1.status == "minimum_amount")
			{ 
				$.growl.error({ message: "Minimum trade amount is "+ parseFloat(minimum_trade_amount) });
				return false;
			}
			else if(res1.status == "login")
			{ 
				location.reload();
				$.growl.error({ message: "Login to your account" });
			}
			else if(res1.status == "success")
			{ 

							

				$("#onload_pp").modal({show:true,backdrop: 'static', keyboard: false});
				$.growl.notice({ message: "Your order has been placed" });
				var msg=res1.msg;
				var pp_tradeid=msg.trade_id;
				$("#pp_trade_id").html('#'+pp_tradeid);
				var type=msg.Type;
				var pp_pairs=pair.split('_');
				var tot_sec=parseFloat(msg.Amount)*parseFloat(msg.Price);
				var trsde_text='';	
				/*
				if(type=='buy')
				{
					var socket = io.connect( host+'://'+window.location.hostname+':'+port );
					socket.emit('new_message', { 
					name        : "test",
					currency_id : second_id,
					date        : date,
					user_id     : user_id,
					});

					var text_pp='You have Created a buy order for <b>'+(parseFloat(msg.Amount)).toFixed(8)+' '+pp_pairs[0]+'</b> for '+(parseFloat(tot_sec)).toFixed(8)+' '+pp_pairs[1];
					if(msg.filledAmount!=0&&msg.filledAmount!='')
					{
						if(msg.status=='filled')
						{
							trsde_text='You have bought <b> '+(parseFloat(msg.Amount)).toFixed(8)+' '+pp_pairs[0]+'</b> for '+(parseFloat(tot_sec)).toFixed(8)+' '+pp_pairs[1];
							$("#partial_div").hide();
							var price_fee='Price : '+msg.Price+' <span class="fee_cn1">Fee : '+parseFloat(msg.Fee).toFixed(8)+'</span>';
							$("#initial_div").html('<p>'+trsde_text+'</p><p>'+price_fee+'</p><p class="trd_net">Net Total : <span>'+parseFloat(msg.Total).toFixed(8)+'</span></p>');
						}
						else if(msg.status=='partially')
						{
							$("#partial_div").show();
							var tot_sec1=(parseFloat(msg.filledAmount)*parseFloat(msg.Price)).toFixed(8);
							trsde_text='You have bought partially <b> '+(parseFloat(msg.filledAmount)).toFixed(8)+' '+pp_pairs[0]+'</b> for '+(parseFloat(tot_sec1)).toFixed(8)+' '+pp_pairs[1];
							var filledprice=msg.Price*msg.filledAmount;
							var filledfee =(parseFloat(filledprice)*parseFloat(msg.fee_per)).toFixed(8);
							filledfee =(parseFloat(filledfee)/100).toFixed(8);
							var filledtotal =(parseFloat(filledprice)+parseFloat(filledfee)).toFixed(8);
							var balance_fee=(parseFloat(msg.Fee)-parseFloat(filledfee)).toFixed(8);
							var balamount=(parseFloat(msg.Amount)-parseFloat(msg.filledAmount)).toFixed(8);
							tot_sec=(parseFloat(balamount)*parseFloat(msg.Price)).toFixed(8);
							text_pp='Created a buy order for <b>'+parseFloat(balamount).toFixed(8)+' '+pp_pairs[0]+'</b> for '+parseFloat(tot_sec).toFixed(8)+' '+pp_pairs[1];
							var price_fee1='Price : '+msg.Price+' <span class="fee_cn1">Fee : '+parseFloat(filledfee).toFixed(8)+'</span>';
							var price_fee='Price : '+msg.Price+' <span class="fee_cn1">Fee : '+parseFloat(balance_fee).toFixed(8)+'</span>';
							var totbal=(parseFloat(msg.Total)-parseFloat(filledtotal)).toFixed(8);
							$("#initial_div").html('<p>'+trsde_text+'</p><p>'+price_fee1+'</p><p class="trd_net">Net Total : <span>'+parseFloat(filledtotal).toFixed(8)+'</span></p>');
							$("#partial_div").html('<p>'+text_pp+'</p><p>'+price_fee+'</p><p class="trd_net">Net Total : <span>'+parseFloat(totbal).toFixed(8)+'</span></p>');
						}
					}
					else
					{
						var price_fee='Price : '+msg.Price+' <span class="fee_cn1">Fee : '+parseFloat(msg.Fee).toFixed(8)+'</span>';
						$("#partial_div").hide();
						$("#initial_div").html('<p>'+text_pp+'</p><p>'+price_fee+'</p><p class="trd_net">Net Total : <span>'+parseFloat(msg.Total).toFixed(8)+'</span></p>');
					}
				}
				else
				{
					var socket = io.connect( host+'://'+window.location.hostname+':'+port );
					socket.emit('new_message', { 
					name        : "test",
					currency_id : first_id,
					date        : date,
					user_id     : user_id,
					});
					var text_pp='You have Created a sell order for <b>'+(parseFloat(msg.Amount)).toFixed(8)+' '+pp_pairs[0]+'</b> for '+(parseFloat(tot_sec)).toFixed(8)+' '+pp_pairs[1];
					if(msg.filledAmount!=0&&msg.filledAmount!='')
					{
						if(msg.status=='filled')
						{
							trsde_text='You have sold <b> '+(parseFloat(msg.Amount)).toFixed(8)+' '+pp_pairs[0]+'</b> for '+(parseFloat(tot_sec)).toFixed(8)+' '+pp_pairs[1];
							$("#partial_div").hide();
							var price_fee='Price : '+msg.Price+' <span class="fee_cn1">Fee : '+msg.Fee+'</span>';
							$("#initial_div").html('<p>'+trsde_text+'</p><p>'+price_fee+'</p><p class="trd_net">Net Total : <span>'+msg.Total+'</span></p>');
						}
						else if(msg.status=='partially')
						{
							$("#partial_div").show();
							var tot_sec1=(parseFloat(msg.filledAmount)*parseFloat(msg.Price)).toFixed(8);
							trsde_text='You have sold partially <b> '+(parseFloat(msg.filledAmount)).toFixed(8)+' '+pp_pairs[0]+'</b> for '+(parseFloat(tot_sec1)).toFixed(8)+' '+pp_pairs[1];
							var filledprice=(parseFloat(msg.Price)*parseFloat(msg.filledAmount)).toFixed(8);
							var filledfee =(parseFloat(filledprice)*parseFloat(msg.fee_per)).toFixed(8);
							filledfee =(parseFloat(filledfee)/100).toFixed(8);
							var filledtotal =(parseFloat(filledprice)-parseFloat(filledfee)).toFixed(8);
							var balance_fee=(parseFloat(msg.Fee)-parseFloat(filledfee)).toFixed(8);
							var price_fee1='Price : '+msg.Price+' <span class="fee_cn1">Fee : '+parseFloat(filledfee).toFixed(8)+'</span>';
							var price_fee='Price : '+msg.Price+' <span class="fee_cn1">Fee : '+parseFloat(balance_fee).toFixed(8)+'</span>';
							var balamount=(parseFloat(msg.Amount)-parseFloat(msg.filledAmount)).toFixed(8);
							tot_sec=(parseFloat(balamount)*parseFloat(msg.Price)).toFixed(8);
							text_pp='Created a sell order for <b>'+parseFloat(balamount).toFixed(8)+' '+pp_pairs[0]+'</b> for '+parseFloat(tot_sec).toFixed(8)+' '+pp_pairs[1];
							$("#initial_div").html('<p>'+trsde_text+'</p><p>'+parseFloat(price_fee1).toFixed(8)+'</p><p class="trd_net">Net Total : <span>'+parseFloat(filledtotal).toFixed(8)+'</span></p>');
							var totbal=(parseFloat(msg.Total)-parseFloat(filledtotal)).toFixed(8);
							$("#partial_div").html('<p>'+text_pp+'</p><p>'+parseFloat(price_fee)/toFixed(8)+'</p><p class="trd_net">Net Total : <span>'+parseFloat(totbal).toFixed(8)+'</span></p>');
						}
					}
					else
					{
						var price_fee='Price : '+msg.Price+' <span class="fee_cn1">Fee : '+parseFloat(msg.Fee).toFixed(8)+'</span>';
						$("#partial_div").hide();
						$("#initial_div").html('<p>'+text_pp+'</p><p>'+price_fee+'</p><p class="trd_net">Net Total : <span>'+parseFloat(msg.Total).toFixed(8)+'</span></p>');
					}
				}
			*/	

				market_depth();

			}
			else
			{
				$.growl.error({ message: res });
			}
			load_design();
			$("#"+a+"_amount").val('');
			$("#"+a+"_price").val('');
			$("#"+a+"_tot").val('');
			$("#"+a+"_fee_tot").val('');
		},
		beforeSend:function()
		{                 
			$("#loading_circle").show();
		}
	});


	



	return false;
}
function load_design()
{

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
			}, 5000);
			$('.pair_table_btc').load();
			var designs=JSON.parse(res);
			//var totalbuy=designs.total_buy;
			//var totalsell=designs.total_sell;
			var balances=designs.all_balance;

			




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
			maker_fee=parseFloat(designs.maker).toFixed(4);
			taker_fee=parseFloat(designs.taker).toFixed(4);
			$('#maker_fee').html(designs.maker+'%');
			$('#taker_fee').html(designs.taker+'%');
			
			if(balances){

				$(".bal_ETH").html(balances.ETH);
				$(".bal_BTC").html(balances.BTC);
				$(".bal_BCH").html(balances.BCH);
				$(".bal_USDT").html(balances.USDT);
				$(".bal_LTC").html(balances.LTC);
				$(".bal_DASH").html(balances.DASH);
				$(".bal_BTG").html(balances.BTG);
				$(".bal_XRP").html(balances.XRP);
				$(".bal_XMR").html(balances.XMR);
				$(".bal_ETC").html(balances.ETC);
				$(".bal_DGB").html(balances.DGB);
				$(".bal_BCC").html(balances.BCC);
				$(".bal_IOTA").html(balances.IOTA);


			}




			if(current_trade)
			{
	

				$("#lastmarketprice").html(parseFloat(lastmarketprice).toFixed(8));
				$("#last_price").html((parseFloat(current_trade['price'])).toFixed(8));
				$("#high_price").html((parseFloat(current_trade['high'])).toFixed(8));
				$("#low_price").html((parseFloat(current_trade['low'])).toFixed(8));
				$("#volume_price").html((parseFloat(current_trade['volume'])).toFixed(8));
				$("#svolume").html((parseFloat(current_trade['svolume'])).toFixed(8));
				
				//alert(current_trade['change']);

				if(current_trade['change'] == 0){

					
					var cur_change=current_trade['change'].toFixed(2)+"%";

				}else if(current_trade['change'] > 0 ){
					
					var cur_change="<span class='text-success'>"+current_trade['change']+"%<span>";
					

				}else{	

				
					var cur_change="<span class='text-danger'>"+current_trade['change'].toFixed(2)+"%<span>";
				}	

			

$("#cur_change").html(cur_change);
				

				//$("#total_buy_order").html((parseFloat(totalbuy)).toFixed(8));
				//$("#total_sell_order").html((parseFloat(totalsell)).toFixed(8));

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
					historys=historys+'<tr><td>'+orderTime1+'</td><td><span class="text-'+class1+'">'+type1+'</span></td><td><span class="text-'+class1+'">'+askPrice+'</span></td><td><span class="text-'+class1+'">'+filledAmount+'</span></td></tr>';
					historys=historys+'<tr><td>'+orderTime2+'</td><td><span class="text-'+class2+'">'+type2+'</span></td><td><span class="text-'+class2+'">'+sellaskPrice+'</span></td><td><span class="text-'+class2+'">'+filledAmount+'</span></td></tr>';
				}

				$('.transactionhistory .mCustomScrollBox .mCSB_container').html(historys);
			}
			else
			{
				$('tbody .transactionhistory .mCustomScrollBox .mCSB_container').html('<tr class="fd_rw not_found"><td colspan="4" class="text-center">No Trade History Found!</td></tr>');
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
						//var total1 = filledAmount*sellaskPrice;
						var total1 = filledAmount*askPrice;
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


					historys=historys+'<tr class="text-'+class1+'"><td>'+type+'</td><td>'+orderTime1+'</td><td>'+askPrice+'</td><td>'+filledAmount+'</td><td>'+parseFloat(total1).toFixed(8)+'</td></tr>';
					// historys=historys+'<tr><td>'+type2+'</td><td>'+orderTime2+'</td><td>'+sellaskPrice+'</td><td>'+filledAmount+'</td><td>'+parseFloat(total1).toFixed(8)+'</td></tr>';
					
				}
				$('.mytradehistory .mCustomScrollBox .mCSB_container').html(historys);
			}
			else
			{
				
				$('.mytradehistory  .mCustomScrollBox .mCSB_container').html('<tr class="fd_rw"><td colspan="4" class="text-center">No Trade History Found!</td></tr>');
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
						if(buyResult[count]['filledAmount'] && buyResult[count]['filledAmount']!="NULL" )
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
				var b=0;
				var sum=0;
				var tot_val=0;
		
				var tot_sell_val=0;
				for(var i in orders)
				{

					 tot_sell_val=tot_sell_val+parseFloat(orders[i]);

				}


				for(var i in orders)
				{
					var ret = i.replace("'","");
					if(autoinc==0)
					{
						current_sell_price=parseFloat(ret).toFixed(8);
						autoinc=1;
					}

					if(b==0){
						sum=parseFloat(orders[i])*parseFloat(ret);
					}else{
						sum=parseFloat(orders[i])*parseFloat(ret)+sum;	
					}
					b++;


					tot_val=tot_val+orders[i];
					//sum1=orders[i]+sum1;
					var parcents = (parseFloat(orders[i])*100)/tot_sell_val;

					var type="'sell'";
					$("#total_buy_order").html(sum.toFixed(8));
				
					order_table+='<tr class="hand_hover" onclick="placeorderset('+type+','+parseFloat(ret).toFixed(8)+','+parseFloat(tot_val).toFixed(8)+','+parseFloat(sum).toFixed(8)+')"><td>'+parseFloat(ret).toFixed(8)+'</td><td>'+parseFloat(orders[i]).toFixed(8)+'</td><td>'+(parseFloat(orders[i])*parseFloat(ret)).toFixed(8)+'</td><td class="filler1"><div class="filler_s" style="width: '+parcents+'%"></div>'+sum.toFixed(8)+'</tr>';
				}

				 //total_buy=sum;
				
			}
			else
			{
				sum=0;
				$("#total_buy_order").html(sum.toFixed(8));

				order_table='<tr class="fd_rw not_found"><td colspan="3" class="text-center">No Buy Order Found</td></tr>';
			}
			$('.buy_order tbody .mCustomScrollBox .mCSB_container').html(order_table);
			var orders1=[];
		   var total_buy=0


			if(orders1.length!=0||sellResult.length>0)
			{
				var order_table='';
				if(sellResult.length>0)
				{
					for(count = 0; count < sellResult.length; count++)
					{
						

						var price = "'"+sellResult[count]['Price']+"'";

					
						if(sellResult[count]['filledAmount']!="NULL" && sellResult[count]['filledAmount'])
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
				var s=0;
				var sum=0;
				var tot_val=0;
				var tot_buy_val=0;
				for(var i in orders1)
				{

					 tot_buy_val=tot_buy_val+parseFloat(orders1[i]);

				}

				for(var i in orders1)
				{
					var ret = i.replace("'","");
					ret = ret.replace("'","");
					if(autoinc1==0)
					{
						current_buy_price=parseFloat(ret).toFixed(8);
						autoinc1=1;
					}


					if(s==0){
						sum=parseFloat(orders1[i])*parseFloat(ret);
					}else{
						sum=parseFloat(orders1[i])*parseFloat(ret)+sum;
					}
					s++;
					var total_sum=sum;
					var type="'buy'";


					//tot_val=tot_val+orders[i];
				total_buy=total_buy+orders1[i];
				var parcent = (parseFloat(orders1[i])*100)/tot_buy_val;
					order_table+='<tr class="hand_hover" onclick="placeorderset('+type+','+parseFloat(ret).toFixed(8)+','+parseFloat(total_buy).toFixed(8)+','+parseFloat(sum).toFixed(8)+')"><td>'+parseFloat(ret).toFixed(8)+'</td><td>'+parseFloat(orders1[i]).toFixed(8)+'</td><td>'+(parseFloat(orders1[i])*parseFloat(ret)).toFixed(8)+'</td><td class="filler1"><div class="filler" style="width: '+parcent+'%"></div>'+sum.toFixed(8)+'</td></tr>';
				  
				$("#total_sell_val_"+count+" div").css("width","65%");
					

					

				}

				
				 $("#total_sell_order").html(total_buy.toFixed(8));
				 
			}
			else
			{

				 $("#total_sell_order").html(total_buy.toFixed(8));
				order_table='<tr class="fd_rw not_found"><td colspan="3" class="text-center">No Sell Order Found</td></tr>';
			}
			$('.sell_order tbody .mCustomScrollBox .mCSB_container').html(order_table);
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

						if(open_orders[count].Type == "sell"){

							var ordercolor = 'text-danger';

						}else{


							ordercolor = 'text-success';

						}




						open_orders_text=open_orders_text+'<tr><td><span class="'+ordercolor+' text-formet">'+open_orders[count].Type+'</span></td><td>'+open_orders[count].datetime+'</td><td>'+activePrice+'</td><td>'+activefilledAmount+'</td><td>'+activeCalcTotal+'</td><td><a href="javascript:;" onclick="'+click+'"><i class="fa fa-times-circle pad-rht"></i></a></td></tr>';
					}



					//$('.open_orders tbody .mCustomScrollBox .mCSB_container').html(open_orders_text);
					$('.open_orders .mCustomScrollBox .mCSB_container').html(open_orders_text);
				}
				else
				{
					$('.open_orders  .mCustomScrollBox .mCSB_container').html('<tr id="noopenorder" class="not_found"><td colspan="6" class="text-center">No open orders available!</td></tr>');
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
					$('.cancel_orders tbody .mCustomScrollBox .mCSB_container .mCustomScrollBox .mCSB_container').html(cancel_orders_text);
				}
				else
				{
					$('.cancel_orders tbody .mCustomScrollBox .mCSB_container').html('<tr class="not_found" id="nocancelorder"><td colspan="6" class="text-center">No cancel orders available!</td></tr>');
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

						if(stop_orders[count].Type == "sell"){

							var ordercolor = 'text-danger';

						}else{


							ordercolor = 'text-success';

						}

						stop_orders_text=stop_orders_text+'<tr><td <span class="'+ordercolor+' text-formet">'+stop_orders[count].Type+'</span></td><td>'+stop_orders[count].datetime+'</td><td>'+activePrice+'</td><td>'+activefilledAmount+'</td><td>'+activeCalcTotal+'</td><td><a href="javascript:;" onclick="'+click+'"><i class="fa fa-times-circle pad-rht"></i></a></td></tr>';
					}
	
					$('.stop_orders .mCustomScrollBox .mCSB_container').html(stop_orders_text);
				}
				else
				{
		
					$('.stop_orders .mCustomScrollBox .mCSB_container ').html('<tr id="nostoporder" class="not_found"><td colspan="6" class="text-center">No stop orders available!</td></tr>');
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
  				 		//var volume=v["volume"].toFixed(3); 		

  				 		//

  				 		

  				 	vol=v["volume"];
  				 	vol=parseFloat(vol);
  					vol=vol.toFixed(3);
  				 	$(vid).html(vol);
  				    ch=parseFloat(v["change"]);


  				 				 	
		 		 var cid="#btc_"+v[vkey]+"_change"; 

		 		$(cid).removeAttr('class');
  				if(ch ==0){
					$(cid).addClass('text-success');
			 		 ch=ch.toFixed(2);
			 	}else if(ch >0){
	 				$(cid).addClass('text-success');
	     	 		ch='+'+ch.toFixed(2);

     	 		}else{


					$(cid).addClass('text-danger');
     		 		ch=ch.toFixed(2);
     		 		ch=ch.replace("--", "-");
  		 		}
  				 	
  		 	

  	        		$(cid).html(ch);
 				
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
  				  		$(pid).html(price);
  				 		vol=v["volume"];
  				 		vol=parseFloat(vol);
  				 		vol=vol.toFixed(3);
  				 		
  				 		var vid="#eth_"+v[vkey]+"_volume";
  				 		$(vid).html(vol);

  				 		 				ch=parseFloat(v["change"]);				 	
		 		var cid="#eth_"+v[vkey]+"_change"; 
		 		$(cid).removeAttr('class');
  				if(ch ==0){
					$(cid).addClass('text-success');
			 		 ch=ch.toFixed(2);
			 	}else if(ch >0){
	 				$(cid).addClass('text-success');
	     	 		ch='+'+ch.toFixed(2);

     	 		}else{
					$(cid).addClass('text-danger');
     		 		ch=ch.toFixed(2);

     		 		ch=ch.replace("--", "-");

  		 		}
  				 	
  	        		$(cid).html(ch);
  				 	}		
  				 	
  				 });
			});



			var bch=pairs.BCH;
			Object.keys(bch).forEach(function(key){
 				 var v=bch[key];
  				 Object.keys(v).forEach(function(vkey){
  				 if(vkey=="from_currency_symbol"){
  				 		var pid="#bch_"+v[vkey]+"_price";
  				 		var price=v["price"];
  				  		$(pid).html(price);
  				 		var vid="#bch_"+v[vkey]+"_volume";
  						 vol=v["volume"];
  				 		vol=parseFloat(vol);
  				 		vol=vol.toFixed(3);
  				 		ch=parseFloat(v["change"]);
  				
		 		
 				ch=parseFloat(v["change"]);				 	
		 		var cid="#bch_"+v[vkey]+"_change"; 
		 		$(cid).removeAttr('class');
  				if(ch ==0){
					$(cid).addClass('text-success');
			 		 ch=ch.toFixed(2);
			 	}else if(ch >0){
	 				$(cid).addClass('text-success');
	     	 		ch='+'+ch.toFixed(2);

     	 		}else{
					$(cid).addClass('text-danger');
     		 		ch=ch.toFixed(2);
     		 		ch=ch.replace("--", "-");
  		 		}
  				 	
  	        		$(cid).html(ch);
 				
  				 	}		

  				 	
  				 });
			});

 





			var usdt=pairs.USDT;
		

			Object.keys(usdt).forEach(function(key){
 				 var v=usdt[key];
  				 Object.keys(v).forEach(function(vkey){
  				 if(vkey=="from_currency_symbol"){
  				 		var pid="#usdt_"+v[vkey]+"_price";
  				 		var price=v["price"];
  				  		$(pid).html(price);
  				 		var vid="#usdt_"+v[vkey]+"_volume";
  				 		//var volume=v["volume"].toFixed(3); 		

  				 		//$(vid).html(volume);

  				 		//alert(v["change"]);

  				 		vol=v["volume"];
  				 		vol=parseFloat(vol);
  				 		vol=vol.toFixed(3);
  				 	 				ch=parseFloat(v["change"]);				 	
		 		var cid="#usdt_"+v[vkey]+"_change"; 
		 		$(cid).removeAttr('class');
  				if(ch ==0){
					$(cid).addClass('text-success');
			 		 ch=ch.toFixed(2);
			 	}else if(ch >0){
	 				$(cid).addClass('text-success');
	     	 		ch='+'+ch.toFixed(2);

     	 		}else{
					$(cid).addClass('text-danger');
     		 		ch=ch.toFixed(2);
     		 		ch=ch.replace("--", "-");
  		 		}
  				 	
  	        		$(cid).html(ch);
 				
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



function priceset(type){

	
	if(type=="buy"){
		price=$("#buyprice").html();
		$("#buy_price").val(price);

	}else{
	
		price=$("#sellprice").html();
		 $("#sell_price").val(price);
	
	}
	calculation(type);




}


function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode
		if ((charCode > 34 && charCode < 41) || (charCode > 47 && charCode < 58) || (charCode == 46) || (charCode == 8) || (charCode == 9))
        return true;
    return false;
}
load_design();
clear_console();
setTimeout(function(){
$('.chat_tab').mCustomScrollbar('scrollTo','bottom');
}, 5000);
$("#sell_order_table li").click(function() {
	
});
function transfer_balance()
{
	var amount = $("#amount").val();
	var currency = $("#currency").val();
	var from_account = $("#from_account").val();
	var to_account = $("#to_account").val();
	var avail_balance=wallet_balance[from_account][currency];
	
	if(amount=="" || amount==0 || isNaN(amount))
	{
		$.growl.error({ message: "Please enter valid amount" });
		return false;
	}
	
	if(parseFloat(avail_balance)<parseFloat(amount))
	{
		$.growl.error({ message: "Insufficient balance in "+from_account+" account" });
		return false;
	}
	$.ajax({
		url:base_url+'balance_transfer',
		type: 'POST',            
		data: "amount="+amount+"&currency="+currency+"&from_account="+from_account+"&to_account="+to_account,
		success: function(res)
		{
			$('.button_transfer').prop('disabled', false);
			var res = res.replace(/(\r\n|\n|\r)/gm,"");
			if(res == "balance")
			{ 
				$.growl.error({ message: "Insufficient balance in "+from_account+" account" });
			}
			else if(res == "login")
			{ 
				$.growl.error({ message: "Login to your account" });
			}
			else if(res == "success")
			{ 
				 $("#amount").val('');
				$.growl.notice({ message: "Transfer balance is successfully completed" });
				transfer_list();
			}
			else
			{
				$.growl.error({ message: res });
			}
		},
		beforeSend:function()
		{                 
			$('.button_transfer').prop('disabled', true);
		}
	});
}
function transfer_list()
{
	$.ajax({
				url:base_url+'transfer_list',
				type: 'GET',
				success: function(res)
				{
					var res1=JSON.parse(res);
					$("#transfercoins tbody").html(res1.coindetails);
					$("#transferestimatecoins tbody").html(res1.estimatedetails);
					wallet_balance = JSON.parse(res1.wallet);
				}
				});
}
function change_to_account(from_account)
{
	if(from_account=='Exchange AND Trading')
	{
		var to_text='<option value="Margin Trading">Margin Trading</option><option value="Lending">Lending</option>';
	}
	else if(from_account=='Margin Trading')
	{
		var to_text='<option value="Exchange AND Trading">Exchange AND Trading</option><option value="Lending">Lending</option>';
	}
	else
	{
		var to_text='<option value="Exchange AND Trading">Exchange AND Trading</option><option value="Margin Trading">Margin Trading</option>';
	}
	$("#to_account").html(to_text);
}

function placeorderset(type,price,amount,total)
{


	ordertype="";
	if(ordertype==''||ordertype==undefined)
	{
		ordertype='limit';
	}


	$("#"+type+"_order_type").val(ordertype);
	//$("#"+type+"_amount").val(parseFloat(amount).toFixed(8));
	$("#"+type+"_price").val(price);

	if(type=="buy"){
		//$("#buy_tot").val(total.toFixed(8));
		var total=	total.toFixed(8);
		

		//var amount=(100*total)/((100*price)+(price*maker_fee));
 	    var amount=amount.toFixed(8); // Jatin Change in trade lib 16-6-18
 		$("#"+type+"_amount").val(amount);
		var fees  = (parseFloat((parseFloat(amount)*parseFloat(price)*maker_fee/100))).toFixed(8);
 		$("#buy_fee_tot").html(fees);
		fee=total*maker_fee/100;	

		total=parseFloat(total)+parseFloat(fee);
		
		$("#buy_tot").val(total.toFixed(8));
		$("#buy_fee_tot").html(fee.toFixed(8));
			
	}else{
		//$("#sell_tot").val(total.toFixed(8));
		var total=	total.toFixed(8);       
		//var amount=(100*total)/(100*price);
 	    var amount=amount.toFixed(8); // Jatin Change in trade lib 16-6-18
 		$("#"+type+"_amount").val(amount);
		var fees  = (parseFloat((parseFloat(amount)*parseFloat(price)*maker_fee/100))).toFixed(8);
 		$("#sell_fee_tot").html(fees);
		fee=total*taker_fee/100;

	total=parseFloat(total)-parseFloat(fee);
	

	$("#sell_tot").val(total.toFixed(8));


		$("#sell_fee_tot").html(fee.toFixed(8));
	}


	//change_type(ordertype,type);
}



function placeorder(type,price,amount,ordertype)
{


	if(ordertype==''||ordertype==undefined)
	{
		ordertype='limit';
	}
	$("#"+type+"_order_type").val(ordertype);
	$("#"+type+"_amount").val(parseFloat(amount).toFixed(8));
	$("#"+type+"_price").val(price);

	



	change_type(ordertype,type);
}


function placeorder(type,price,amount,ordertype,total)
{
	if(ordertype==''||ordertype==undefined)
	{
		ordertype='limit';
	}
	$("#"+type+"_order_type").val(ordertype);
	$("#"+type+"_amount").val(parseFloat(amount).toFixed(8));
	$("#"+type+"_price").val(price);

	if(type=="buy"){

		maker_fee

	}




	//change_type(ordertype,type);
}






function setorder(column,type)
{



	var balance=parseFloat($("#"+column).html());

	a=type;
	$("#"+a+"_amount").val("");
	//$('#buy_tot').val(balance);

	//$('.growl-close').trigger('click');	



		if(a=='buy' || a=='sell' ){
			var amount      = $("#"+a+"_amount").val();
			var buy_price   = $('#buy_price').val();
			var sell_price  = $('#sell_price').val();
			var order_type  = $('#'+a+'_order_type').val();

	
			
		}else{

			//var amount      = $("#stop_limit_amount").val();
			//var price   = $('#stop_limit_price').val();
			//var order_type  = $('stop_limit').val();
		}

	



		//if(order_type=='limit'){



        	if(a=='buy'){


        	$('#buy_tot').val(balance); 	

        	
        	var total=	$('#buy_tot').val();    



			var amount=(100*total)/((100*buy_price)+(buy_price*maker_fee));
 	    	amount=amount.toFixed(8);
 			$("#"+a+"_amount").val(amount);

 			var fees  = (parseFloat((parseFloat(amount)*parseFloat(buy_price)*maker_fee/100))).toFixed(8);
 			
 			if(amount=="Infinity"){
 				
 				$.growl.error({ message: "Please enter valid  price" });
 				$("#"+a+"_amount").val("");
					return false;
 			}

       		$("#buy_fee_tot").html(fees);
			if(amount!="" && amount!=0 && !isNaN(amount)&&n.indexOf("e")==-1&&n1.indexOf("e")==-1)
			{



				$('#buy_tot').val(tot-fees);  				
				$('#buy_fee_tot').html(fees);
			}
			else
			{
				if(n.indexOf("e")>-1||n1.indexOf("e")>-1)
				{
					$.growl.error({ message: "Please enter valid amount and price" });
					return false;
				}
				//$('#buy_tot').val(0);
				//$('#buy_fee_tot').html(0);
			}
        } if(a=='sell'){

 				$("#sell_amount").val(balance);
 				var sell_price= $("#sell_price").val();
 				var amount= $("#sell_amount").val();
 				
 				

        	var tot   = (parseFloat(amount)*parseFloat(sell_price)).toFixed(8);
			var fees = (parseFloat((parseFloat(amount)*parseFloat(sell_price)*taker_fee/100))).toFixed(8);
			var n = tot.toString();
			var n1 = fees.toString();
			if(tot>0)
			{
				var tot = (parseFloat(tot)-parseFloat(fees)).toFixed(8);
			}
			else
			{
				var tot = 0;
			}
			 if(sell_price==""){
 				
 				$.growl.error({ message: "Please enter valid  price" });
 				$("#"+a+"_amount").val("");
					return false;
 			}


			if(amount!="" && sell_price!="" && amount!="" && sell_price!=""&&!isNaN(amount)&&n.indexOf("e")==-1&&n1.indexOf("e")==-1)
			{
				$('#sell_tot').val(tot); 

				
				$('#sell_fee_tot').html(fees);
			}
			else
			{
				if(n.indexOf("e")>-1||n1.indexOf("e")>-1)
				{
					$.growl.error({ message: "Please enter valid amount and price" });
					return false;
				}
				$('#sell_tot').val(0);
				$('#sell_fee_tot').html(0);
			}



    }
        
  //  }



    else{



    	if(column=="to_cur_balance"){
    		$('#stop_limit_amount').val("");
    		
    		$('#stop_limit_tot').val(balance);

    	}else{
    		$('#stop_limit_amount').val(balance);
    			$('#stop_limit_tot').val("");

    		
    	}

  
 
     
    }
   
	
}







/*

function setorder(column,type)
{


	var balance=parseFloat($("#"+column).html());


	if(balance>0)
	{
		if(type=='buy')
		{
		
			var amount=(100*balance)/((100*current_buy_price)+(current_buy_price*maker_fee));
			placeorder(type,current_buy_price,amount,'limit');
		}
		else
		{
			placeorder(type,current_sell_price,balance,'limit');
		}
	}
}


*/
function balanceTransferChangeCurrency(currencyid,balancetype,balance)
{
	$("#currency").val(currencyid);
	if(balancetype&&balancetype!=undefined)
	{
		$("#from_account").val(balancetype);
		change_to_account(balancetype);
	}
	if(balance&&balance!=undefined)
	{
		$("#amount").val(parseFloat(balance).toFixed(8));
	}
	else
	{
		$("#amount").val('');
	}
}



function calculation_tot(a)
{

	$("#"+a+"_amount").val("");

	//$('.growl-close').trigger('click');	
		if(a=='buy' || a=='sell' ){
			var amount      = $("#"+a+"_amount").val();
			var buy_price   = $('#buy_price').val();
			var sell_price  = $('#sell_price').val();
			var order_type  = $('#'+a+'_order_type').val();


		
			
		}else{
			var amount      = $("#stop_limit_amount").val();
			var price   = $('#stop_limit_price').val();
			var order_type  = $('stop_limit').val();
		}

		if(order_type=='limit'){

			if(a=="buy"){

				//$(".buy_sec").html('<i class="fa fa-spinner fa-spin"></i>Please wait..');

				//$(".buy_sec").html('BUY');	
			}

			if(a=="sell"){

				
			}

		}else{





		}




	if(order_type=='limit'){
        	if(a=='buy'){
        	var total=	$('#buy_tot').val();       
			var amount=(100*total)/((100*buy_price)+(buy_price*maker_fee));
 	    	amount=amount.toFixed(8);
 			$("#"+a+"_amount").val(amount);

 			var fees  = (parseFloat((parseFloat(amount)*parseFloat(buy_price)*maker_fee/100))).toFixed(8);
 			$("#buy_fee_tot").html(fees);
       
			if(amount!="" && amount!=0 && !isNaN(amount)&&n.indexOf("e")==-1&&n1.indexOf("e")==-1)
			{

				$('#buy_tot').val(tot);  				
				$('#buy_fee_tot').html(fees);
			}
			else
			{
				if(n.indexOf("e")>-1||n1.indexOf("e")>-1)
				{
					$.growl.error({ message: "Please enter valid amount and price" });
					return false;
				}
				//$('#buy_tot').val(0);
				//$('#buy_fee_tot').html(0);
			}
        } if(a=='sell'){

        	var total=	$('#sell_tot').val();       
			var amount=(100*total)/((100*sell_price)+(sell_price*taker_fee));
 	    	amount=amount.toFixed(8);
 			$("#"+a+"_amount").val(amount);

 			var fees  = (parseFloat((parseFloat(amount)*parseFloat(sell_price)*taker_fee/100))).toFixed(8);
 			$("#sell_fee_tot").html(fees);
       
			if(amount!="" && amount!=0 && !isNaN(amount)&&n.indexOf("e")==-1&&n1.indexOf("e")==-1)
			{

				$('#sell_tot').val(tot);  				
				$('#sell_fee_tot').html(fees);
			}
			else
			{
				if(n.indexOf("e")>-1||n1.indexOf("e")>-1)
				{
					$.growl.error({ message: "Please enter valid amount and price" });
					return false;
				}







        }

    }else{

    	







    }




        
    }else{


    	var price=$('#stop_limit_price').val();
    

    	var total=$('#stop_limit_tot').val();
    	amount=((100*total)/(100*price)).toFixed(8);
      	$('#stop_limit_amount').val(amount);  
     
    }
   
	
}

/*
$(function () {
		// $.getJSON('https://www.highcharts.com/samples/data/jsonp.php?filename=aapl-ohlcv.json&callback=?', function (data) {
		//var site_url = $('#site_url').val();


		  var url =base_url+'trade/tradechart/'+pair_id+'/trade';

		
    
     /* $.getJSON(url, function (data) {

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
                                    });

	});*/






	$(function () {
		// $.getJSON('https://www.highcharts.com/samples/data/jsonp.php?filename=aapl-ohlcv.json&callback=?', function (data) {
		//var site_url = $('#site_url').val();


		var url =base_url+'trade/tradechart/'+pair_id+'/trade';

		//alert(url);
		$.getJSON(url , function (data) {
			// split the data set into ohlc and volume
			var ohlc = [],sma = [],ema = [],ema1 = [],volume = [],dataLength = data.length,
			// set the allowed units for data grouping
			groupingUnits = [
		                    [
		                      'week',                         // unit name
		                      [1]                             // allowed multiples
		                    ], 
		                    [
		                      'month',
		                      [1, 2, 3, 4, 6]
		                    ]
		                  ],
			i = 0;
			for (i; i < dataLength; i += 1) 
			{
				ohlc.push(
				            [
				              data[i][0], // the date
				              data[i][1], // open
				              data[i][2], // high
				              data[i][3], // low
				              data[i][4] // close
				            ]
				          );
				volume.push(
				              [
				                data[i][0], // the date
				                data[i][5] // the volume
				              ]
				            );
				sma.push(
				          [
				            data[i][0], 
				            data[i][4] 
				          ]
				        );
				ema.push(
				          [
				            data[i][0],
				            data[i][3] 
				          ]
				        );
				ema1.push(
				          [
				            data[i][0],
				            data[i][2] 
				          ]
				        );


				//  ohlc.push({
				//    "date":data[i].date, // the date
				//    "open":data[i].open, // open
				//    "high":data[i].high, // high
				//    "low":data[i].low, // low
				//    "close":data[i].close // close
				//    //"volume":33.9320213,"quoteVolume":4333.469,"weightedAverage":0.00783022},{"d
				//  });

				//  volume.push({
				//   "date": data[i].date, // the date
				//   "volume":data[i].volume // the volume
				// });
			}

		      // create the chart
			var graph_options = {
			                        chart:{
			                                  backgroundColor: null,
			                                  style: {
			                                           fontFamily: 'HelveticaNeue'
			                                         }
			                              },
			                        scrollbar: {
			                                        enabled: false
			                                    },
			                plotOptions: { candlestick: { lineColor: '#00cc44', upLineColor: 'red', upColor: 'red', downLineColor: '#00cc44', downColor: '#00cc44' } },
			                        exporting:{
			                                    enabled : false,
			                                  },
			                        rangeSelector:{
			                                          selected: 1,
			                                          inputEnabled:false  
			                                      },
			                        yAxis:[
			                                {
			                                  labels: {
			                                            formatter: function() {
			                                                return this.value;
			                                            }
			                                          },
			                                  lineWidth: 2,
			                                  opposite: true
			                                }, 
			                                {
			                                  labels: {
			                                            align: 'right',
			                                            x: -3
			                                          },
			                                  top: '65%',
			                                  height: '35%',
			                                  offset: 0,
			                                  lineWidth: 2
			                                }
			                              ],
			                        tooltip: {
			                                    split: false
			                                  },
			                        plotOptions:{
			                                      series:{
			                                                turboThreshold:25000//larger threshold or set to 0 to disable
			                                              }
			                                    },
			                        series: [
			                                  {
			                                    type: 'candlestick',
			                                    name: 'Trade',
			                                    id: 'aapl',
			                                    data: ohlc,
			                                    dataGrouping: {
			                                      units: groupingUnits
			                                    }
			                                  }, 
			                                  {
			                                    type: 'column',
			                                    name: 'Volume',
			                                    data: volume,
			                                    color: '#f44242',
			                                    yAxis: 1,
			                                    dataGrouping: {
			                                      units: groupingUnits
			                                    }
			                                  },  
			                                  {             
			                                    name: 'SMA',
			                                    data: sma,
			                                    type: 'spline',
			                                    tooltip: {
			                                      valueDecimals: 2
			                                    },
			                                    periods: 50,
			                                    visible:false
			                                  }, 
			                                  {             
			                                    name: 'EMA1',
			                                    data: ema,
			                                    type: 'line',
			                                    tooltip: {
			                                    valueDecimals: 2
			                                    },
			                                    periods: 30,
			                                    visible: false
			                                  }, 
			                                  {             
			                                    name: 'EMA2',
			                                    data: ema1,
			                                    type: 'line',
			                                    tooltip: {
			                                      valueDecimals: 2
			                                    },
			                                    periods: 20,
			                                    visible: false
			                                  },
			                                  {
			                                    type: 'bb',
			                                    linkedTo: 'aapl',
			                                    tooltip: {
			                                      valueDecimals: 2
			                                    },
			                                    periods: 20,
			                                    visible: false
			                                  }
			                                ]
			                  	};
			var chart = Highcharts.stockChart('graph_container', graph_options);


			$(document).on('click', '#smaCheckbox', function(e) {
				if($('#smaCheckbox').is(":checked") )
				{
				  chart.series[2].show();
				  $.cookie("sma", 1);   
				} 
				else
				{
				  chart.series[2].hide();
				  $.removeCookie('sma');
				}
			});

			$(document).on('click', '#emaCheckbox', function(e) {
				if($('#emaCheckbox').is(":checked") )
				{
				  chart.series[3].show();
				  $.cookie("ema1", 1);   
				} 
				else
				{
				  chart.series[3].hide();
				  $.removeCookie('ema1');
				}
			});

			$(document).on('click', '#ema2Checkbox', function(e) {
				if($('#ema2Checkbox').is(":checked") )
				{
				  chart.series[4].show();
				  $.cookie("ema2", 1);   
				} 
				else
				{
				  chart.series[4].hide();
				  $.removeCookie('ema2');
				}
			});
			$(document).on('click', '#bollingerCheckbox', function(e) {
				if($('#bollingerCheckbox').is(":checked") )
				{
				  chart.series[5].show();
				  $.cookie("bb", 1);   
				} 
				else
				{
				  chart.series[5].hide();
				  $.removeCookie('bb');
				}
			});
			if(!!$.cookie('bb'))
			{
				chart.series[5].show();
			}
			if(!!$.cookie('sma'))
			{
				chart.series[2].show();
			}
			if(!!$.cookie('ema1'))
			{
				chart.series[3].show();
			}
			if(!!$.cookie('ema2'))
			{
				chart.series[4].show();
			}
		});
	});

