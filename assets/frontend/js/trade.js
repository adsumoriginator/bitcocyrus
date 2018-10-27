
$( ".all_set_fav" ).click(function() {
			
		$(".fav" ).each(function( index ) {
			pair=$(this).attr("data-pair");
			$(this).addClass("star_active");
  		   $.cookie(pair, "set", { expires : 10000000000000 });
  		     // alert("added");
			

   		});

   		$(".toolPanel").hide();
	

});


$( ".all_unset_fav" ).click(function() {			
		$(".fav" ).each(function( index ) {
			pair=$(this).attr("data-pair");
			$(this).removeClass("star_active");
  		   $.removeCookie(pair);

  		   //alert("removed");
			

   		});
	

});


$(document).on('ready urmethod',function(){
	$(".fav").on('click',function(){
		var pair=$(this).attr("data-pair");
		
		var check=$(this).hasClass( "star_active" );
		if(check){
		
			$(this).removeClass("star_active");
		}else{
			$.removeCookie(pair);
	  		 $(this).addClass("star_active");
	   	}
    });
})





$( ".select_fav" ).click(function() {


			
	if($(this).is(":checked")) 
   {
		$(".fav" ).each(function( index ) {
			var check=$(this).hasClass("star_active" );
			if(check){
				$(this).parent().parent().show(); 
			}else{
				$(this).parent().parent().hide(); 
		  	}

   		});
	}else{

		$(".fav").parent().parent().show(); 

			//$(this).addClass("star_active");
		}
 	
$(".toolPanel").hide();
});







function star_click_filter(tabl="") {

   	shortdata(tabl);
	$(document).trigger('urmethod');
		$(".toolPanel").hide();

};



function shortdata(tabl=""){

var selected="";
   var unselected="";
   $("#"+tabl+"_table .fav" ).each(function( index ) {
		var check=$(this).hasClass("star_active" );
		if(check){				
			selected =selected+$(this).parent().parent().clone().wrap('<tr>').parent().html(); 
		}else{
			unselected=unselected+$(this).parent().parent().clone().wrap('<tr>').parent().html();
		}
	});
	checkcls=$(".star_filter").hasClass("shorted");
	if(checkcls){
		$(".star_filter").removeClass("shorted");
		$(".star_filter").addClass("notshorted");
		$("#"+tabl+"_table tbody").html(unselected+selected);
	}else{
        $(".star_filter").addClass("shorted");
        $(".star_filter").removeClass("notshorted");
   		$("#"+tabl+"_table tbody").html(selected+unselected);	
   	}


}


$( "#panel_settings" ).click(function() {


  		
  			var mode=$("#panel_settings").attr("data-status");

  	if(!$('#panel_settings').hasClass('active')){
            hideAllToolPanels();
        }
		$('#panel_settings').addClass('active');
    	$("#market_settings").fadeToggle(200);
  	

  				// $(".toolPanel").toggle();
  				//$("#market_settings").toggle();
  					

});

$(".name_hide").click(function() {

	var name_sec=$(this).attr("data-url");
    if(name_sec=="Name"){
		$(".toolPanel").hide();
 		$('td:nth-child(6)').hide();
  		$('th:nth-child(6)').hide();
  		$(this).attr("data-url","Name hide");
	}else{

		$(".toolPanel").hide();
 		 $('td:nth-child(6)').show();
  		$('th:nth-child(6)').show();
  		$(this).attr("data-url","Name");


	}
});

/*$(document).on('click', function (e) {

	alert();

	if( $('.toolPanel').css('display') == 'block' ) {
	$(".toolPanel").hide();
	}

});*/

var $menu = $(' #market_settings,.tools, .toolPanel-grap, .sprocket,#panel_settings'); 
	$(document).on('click', function (e) {

	    // if element is opened and click target is outside it, hide it 
	    if ( !$menu.is(e.target) && !$menu.has(e.target).length) {
	        hideAllToolPanels();
	    }
	});





$(".filter").click(function() { 

$(".toolPanel").hide();

 var to_row=$(this).attr("data-row");
var i=0;
 $('.pair_table_btc').find('tr').each(function(){ 
 	 if(i> to_row){ 
 	 	$(this).hide(); 
 	 }else{
 	 	$(this).show(); 
 	 }

	  i++; 
 	});



 var i=0;
 $('.pair_table_eth').find('tr').each(function(){ 
 	 if(i> to_row){ 
 	 	$(this).hide(); 
 	 }else{
 	 	$(this).show(); 
 	 }

	  i++; 
 	});




 var i=0;
 $('.pair_table_bch').find('tr').each(function(){ 
 	 if(i> to_row){ 
 	 	$(this).hide(); 
 	 }else{
 	 	$(this).show(); 
 	 }

	  i++; 
 	});


  var i=0;
 $('.pair_table_usdt').find('tr').each(function(){ 
 	 if(i> to_row){ 
 	 	$(this).hide(); 
 	 }else{
 	 	$(this).show(); 
 	 }

	  i++; 
 	});



    
});




function change_fav(pair=""){


	/* var classname=$(this).attr('class');

	var cookieValue = $.cookie(pair);
	if(cookieValue==undefined){
			
		$(this).addClass("star_active");

		$.cookie(pair, "set", { expires : 10000000000000 });

	}else{		
		
		$(this).removeClass("star_active");		
	}	*/
  

    var classname=$(this).attr('class');

	var cookieValue = $.cookie(pair);
	if(cookieValue==undefined){
			
		$(this).addClass("star_active");

		$.cookie(pair, "set", { expires : 10000000000000 });
	}else{		
		
		$(this).removeClass("star_active");
	} 

	//star_click_filter("clik_star");
}





 function activecheck() {
    
	$( ".fav" ).each(function( index ) {
  	var pair=$(this).attr("data-pair");

  	var cookieValue = $.cookie(pair);

	if(cookieValue==undefined){
				$(this).removeClass("star_active");
	}else{

		$(this).addClass("star_active");
		
		
		
	}

	});
    }
        window.onload = activecheck;







/*
$.cookie("test", 'cooke val', { expires : 10000000000000 });

var cookieValue = $.cookie("test");
alert("cooke name")
alert(cookieValue);

*/



function cancel_order(tradeid)
{
	if(confirm('Are you sure you want to cancel this order?'))
	{
		$.ajax({
			url: base_url+'close_active_order',
			type: 'POST',
			data: "tradeid="+tradeid+"&pair_id="+pair_id, 
			success: function(data)
			{
				var res = jQuery.parseJSON(data);
			
				if(res.result==1)
				{
					if(res.type=='buy')
					{
						cur_id = second_id;
					}
					else
					{
						cur_id = first_id;
					}
					var socket = io.connect( host+'://'+window.location.hostname+':'+port );
					socket.emit('new_message', { 
					name        : "test",
					currency_id : cur_id,
					date        : date,
					user_id     : user_id,
					});
					$.growl.notice({ message: "Order Cancelled Successfully!" });
				}
				else
				{
					$.growl.error({ message: "Error occured while cancel order!" });
				}
				load_design();
			}
		});
	}
}
function filter_openorder() {
  var input, filter, table, tr, tds, td, i,filtered;
   var j=0;
  input = document.getElementById("openordertext");
  filter = input.value.toUpperCase();
  table = document.getElementById("open_orders");
  tr = table.getElementsByTagName("tr");
  if(filter!='')
  {
	  for (i =1; i < tr.length-1; i++)
	  {
		tr[i].style.display = "none";
		$(tr[i]).find('td').each (function(e) {
			if (this.innerHTML.toUpperCase().indexOf(filter) > -1)
			{
				filtered=1;
				tr[i].style.display = "";
				j++;
			}
		});
	  }
	  if(filtered!=1)
	  {
		  tr[i].style.display = "";
	  }
	  else
	  {
		  tr[i].style.display = "none";
	  }
  }
  else
  {
	 for (i = 1; i < tr.length-1; i++)
	  {
		  tr[i].style.display = "";
	  }
	  tr[i].style.display = "none";
	  j++;
  }
	if(j==0)
	  {
		  var noopenorder = document.getElementById("noopenorder");
		  $("#noopenorder").addClass("fd_rw");
		  noopenorder.style.display = "";
	  }
	  else
	  {
		  var noopenorder = document.getElementById("noopenorder");
		  $("#noopenorder").removeClass("fd_rw");
		  noopenorder.style.display = "none";
	  }
}
function filter_closeorder() {
  var input, filter, table, tr, tds, td, i,filtered;
    var j=0;
  input = document.getElementById("closeordertext");
  filter = input.value.toUpperCase();
  table = document.getElementById("cancel_orders");
  tr = table.getElementsByTagName("tr");
  if(filter!='')
  {
	  for (i =1; i < tr.length-1; i++)
	  {
		tr[i].style.display = "none";
		$(tr[i]).find('td').each (function(e) {
			if (this.innerHTML.toUpperCase().indexOf(filter) > -1)
			{
				filtered=1;
				tr[i].style.display = "";
				j++;
			}
		});
	  }
	  if(filtered!=1)
	  {
		  tr[i].style.display = "";
	  }
	  else
	  {
		  tr[i].style.display = "none";
	  }
  }
  else
  {
	 for (i = 1; i < tr.length-1; i++)
	  {
		  tr[i].style.display = "";
	  }
	  tr[i].style.display = "none";
	  j++;
  }
if(j==0)
  {
	  var nocancelorder = document.getElementById("nocancelorder");
	  $("#nocancelorder").addClass("fd_rw");
	  nocancelorder.style.display = "";
  }
  else
  {
	  var nocancelorder = document.getElementById("nocancelorder");
	  $("#nocancelorder").removeClass("fd_rw");
	  nocancelorder.style.display = "none";
  }
}
function filter_stoporder() {
  var input, filter, table, tr, tds, td, i,filtered;
  var j=0;
  input = document.getElementById("stopordertext");
  filter = input.value.toUpperCase();
  table = document.getElementById("stop_orders");
  tr = table.getElementsByTagName("tr");
  if(filter!='')
  {
	  for (i =1; i < tr.length-1; i++)
	  {
		tr[i].style.display = "none";
		$(tr[i]).find('td').each (function(e) {
			if (this.innerHTML.toUpperCase().indexOf(filter) > -1)
			{
				filtered=1;
				tr[i].style.display = "";
				j++;
			}
		});
	  }
	  if(filtered!=1)
	  {
		  tr[i].style.display = "";
	  }
	  else
	  {
		  tr[i].style.display = "none";
	  }
  }
  else
  {
	 for (i = 1; i < tr.length-1; i++)
	  {
		  tr[i].style.display = "";
	  }
	  j++;
	  tr[i].style.display = "none";
  }
  if(j==0)
  {
	  var nostoporder = document.getElementById("nostoporder");
	  $("#nostoporder").addClass("fd_rw");
	  nostoporder.style.display = "";
  }
  else
  {
	  var nostoporder = document.getElementById("nostoporder");
	  $("#nostoporder").removeClass("fd_rw");
	  nostoporder.style.display = "none";
  }
}
function filter_mytradeorder() {
  var input, filter, table, tr, tds, td, i,filtered;
  var j=0;
  input = document.getElementById("mytradeordertext");
  filter = input.value.toUpperCase();
  table = document.getElementById("mytradehistory");
  tr = table.getElementsByTagName("tr");
  if(filter!='')
  {
	  for (i =1; i < tr.length-1; i++)
	  {
		tr[i].style.display = "none";
		$(tr[i]).find('td').each (function(e) {
			if (this.innerHTML.toUpperCase().indexOf(filter) > -1)
			{
				filtered=1;
				tr[i].style.display = "";
				j++;
			}
		});
	  }
	  if(filtered!=1)
	  {
		  tr[i].style.display = "";
	  }
	  else
	  {
		  tr[i].style.display = "none";
	  }
  }
  else
  {
	 for (i = 1; i < tr.length-1; i++)
	  {
		  tr[i].style.display = "";
	  }
	  j++;
	  tr[i].style.display = "none";
  }
  if(j==0)
  {
	  var nomytradehistory = document.getElementById("nomytradehistory");
	  $("#nomytradehistory").addClass("fd_rw");
	  nomytradehistory.style.display = "";
  }
  else
  {
	  var nomytradehistory = document.getElementById("nomytradehistory");
	  $("#nomytradehistory").removeClass("fd_rw");
	  nomytradehistory.style.display = "none";
  }
}


// Market depth


//setInterval(function(){ market_depth(); }, 100);

market_depth();


function market_depth(){


$.getJSON(base_url+"trade/market_depth/"+pair_id+"?up=0.27039444727286344", function (data){
  

   if(!data.buy_data)
      {
        data.buy_data=[0];
      }

       if(!data.sell_data)
      {
        data.sell_data=[0];
      }
      
   var graph_set = {

     chart: {
        backgroundColor: {
            linearGradient: {
                x1: 0,
                y1: 0,
                x2: 1,
                y2: 1
            },
            stops: [
                  [0, 'rgba(18, 47, 95,1)'],
                [1, 'rgba(18, 47, 95,1)']
            ]
        }
    },

        legend: {
              itemStyle: {
             
                 color: '#fff'
              },
            
           
        },
              /*chart: {
                type: 'area',
                spacingBottom: 30
              },*/
              title: {
                text: 'Market Depth',
                  style: {
                    color: '#fff',
                  }
              },
              xAxis: {
                ickInterval: 0
              },
              yAxis: {
                title: {
                  text: '',
                  enable:false
                },
                labels: {
                  formatter: function () {
                    return this.value;
                  }
                }
              },
              tooltip: {
                formatter: function () {
                  return '<b>' + this.series.name + '</b><br/>' + this.x + ': ' + this.y;
                }
              },
              plotOptions: {
                area: {
                  fillOpacity: 0.5
                }
              },
              credits: {
                enabled: false
              },
              exporting: {
                enabled: false
              },

              series: [
                    {
                      name: 'Bids',
                      data: data.buy_data,
                      color:'green',
                    }, 
                    {
                      name: 'Asks',
                      data: data.sell_data,
                      color:'red',
                          
                    }
                  ]
            };
    $('#graphcontainer').highcharts(graph_set);
  });

}



$(function(){
        $("#btc_table").stupidtable();
        $("#eth_table").stupidtable();
        $("#bch_table").stupidtable();
        $("#usdt_table").stupidtable();
  });


$(function () {

    $(window).bind("resize", function () {
        console.log($(this).width())
        if ($(this).width() < 1650) {
            $('#tade_chart_move').removeClass('col-md-9').addClass('col-md-12');
            $('#tade_history_move').removeClass('col-md-3').addClass('move_trade');
            $('#menu_trad_his').removeClass('d-none');
            
        } else {
            $('#tade_chart_move').removeClass('move_trade').addClass('col-md-3');
        }
    }).trigger('resize');
});


function openmenu(){
//$('.move_trade').css('right', '0 ');
$(".move_trade").toggleClass("move_trade_r");
 document.getElementById("myCanvasNav").style.width = "100%";
    document.getElementById("myCanvasNav").style.opacity = "0.8"; 
}

function closeOffcanvas() {
    document.getElementById("myCanvasNav").style.width = "0%";
    document.getElementById("myCanvasNav").style.opacity = "0"; 
}