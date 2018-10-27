$(function(){
	//var socket = io.connect( 'https://'+window.location.hostname+':8443' );
	var socket = io.connect( 'http://'+window.location.hostname+':8080' );
	
/*
	socket.on('users', function(data){
		$('.names-list').text('');
		$.each(data,function(i,v){
			$('.names-list').append('<li>'+v+'</li>');
		});
	}); */


var currentdate = new Date();
var datetime = get_date_time1();

/* currentdate.getFullYear() + "-"  
			    + (currentdate.getMonth()+1)  + "-" 
			    + currentdate.getDate()+" "
			    + currentdate.getHours() + ":"  
			    + currentdate.getMinutes() + ":" 
			    + currentdate.getSeconds();
*/
function get_date_time()
{
	currentdate = new Date();
	datetime = 
	    currentdate.getFullYear() + "-"  
	    + (currentdate.getMonth()+1)  + "-" 
	    + currentdate.getDate()+" "
	    + currentdate.getHours() + ":"  
	    + currentdate.getMinutes() + ":" 
	    + currentdate.getSeconds();
}
var CMPLTADMIN_SETTINGS = window.CMPLTADMIN_SETTINGS || {};
$(document).ready(function() {
CMPLTADMIN_SETTINGS.chatApiWindow();
});

CMPLTADMIN_SETTINGS.tooltipsPopovers = function() {

        $('[rel="tooltip"]').each(function() {
            var animate = $(this).attr("data-animate");
            var colorclass = $(this).attr("data-color-class");
            $(this).tooltip({
                template: '<div class="tooltip ' + animate + ' ' + colorclass + '"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>'
            });
        });

        $('[rel="popover"]').each(function() {
            var animate = $(this).attr("data-animate");
            var colorclass = $(this).attr("data-color-class");
            $(this).popover({
                template: '<div class="popover ' + animate + ' ' + colorclass + '"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>'
            });
        });

    };
 /*--------------------------------
         CHAT API window
     --------------------------------*/
    CMPLTADMIN_SETTINGS.chatApiWindow = function() {

        var chatarea = $(".page-chatapi");

        $('.page-chatapi .user-row ').on('click', function() {
            var name = $(this).find(".user-info h4 a").html();
            var img = $(this).find(".user-img a img").attr("src");
            var id = $(this).attr("data-user-id");
            var user = $(this).attr("data-user-name");
            var status = $(this).find(".user-info .status").attr("data-status");
			var loggedinusername = user; //console.log(loggedinusername);
			loadMessages(id);
			$.get(base_url+'exchange/admin/update_status/'+id,function(response){
			}, 'json');
			var	user_id1 = id;
            if ($(this).hasClass("active")) {
                $(this).toggleClass("active");

                $(".chatapi-windows #user-window" + id).hide();

            } else {
                $(this).toggleClass("active");

                if ($(".chatapi-windows #user-window" + id).length) {
					
					var	user_window = $(".chatapi-windows .user-window:visible").length;	
					/* alert(user_window); */
					if( user_window > 3 )
					{
						var last_user	=	$(".chatapi-windows .user-window:visible").last().attr('data-user-id');
						$('#chat_user_'+last_user+',.page-chatapi.user-row').trigger('click');
					}
					
                    $(".chatapi-windows #user-window" + id).removeClass("minimizeit").show();

                } else {
                    var msg = chatformat_msg('Wow! What a Beautiful theme!', 'receive', name);
                    msg += chatformat_msg('Yes! Complete Admin Theme ;)', 'sent', 'You');
                    var html = "<div class='user-window' id='user-window" + id + "' data-user-id='" + id + "'>";
                    html += "<div class='controlbar'><img src='" + img + "' data-user-id='" + id + "' rel='tooltip' data-animate='animated fadeIn' data-toggle='tooltip' data-original-title='" + name + "' data-placement='top' data-color-class='primary'><span class='status " + status + "'><i class='fa fa-circle'></i></span><span class='name'>" + name + "</span><span class='opts'><i class='fa fa-times closeit' data-user-id='" + id + "'></i><i class='fa fa-minus minimizeit' data-user-id='" + id + "'></i></span></div>";
                    html += "<div class='chatarea' id='chatarea_"+ id +"'></div>";
                    html += "<div class='typearea'><input type='text' data-user-id='" + id + "' data-user-name='" + name + "' placeholder='Type & Enter' class='form-control'></div>";
                    html += "</div>";
					
					var	user_window = $(".chatapi-windows .user-window:visible").length;	
					/* alert(user_window); */
					if( user_window > 3 )
					{
						var last_user	=	$(".chatapi-windows .user-window:visible").last().attr('data-user-id');
						$('#chat_user_'+last_user+',.page-chatapi.user-row').trigger('click');
					}
					
                    $(".chatapi-windows").append(html);
					 $(".chatapi-windows #user-window" + id + " .chatarea").perfectScrollbar({
						suppressScrollX: true
					});
					$('#chatarea_'+id).scrollTop(1E10);
                }
            }

        });

        $(document).on('click', ".chatapi-windows .user-window .controlbar .closeit", function(e) {
            var id = $(this).attr("data-user-id");
            $(".chatapi-windows #user-window" + id).hide();
            $(".page-chatapi .user-row#chat_user_" + id).removeClass("active");
        });

        $(document).on('click', ".chatapi-windows .user-window .controlbar img, .chatapi-windows .user-window .controlbar .minimizeit", function(e) {
            var id = $(this).attr("data-user-id");

            if (!$(".chatapi-windows #user-window" + id).hasClass("minimizeit")) {
                $(".chatapi-windows #user-window" + id).addClass("minimizeit");
                CMPLTADMIN_SETTINGS.tooltipsPopovers();
            } else {
                $(".chatapi-windows #user-window" + id).removeClass("minimizeit");
            }

        });

        $(document).on('keypress', ".chatapi-windows .user-window .typearea input", function(e) {
            if (e.keyCode == 13) {
                var id = $(this).attr("data-user-id");
                var name = $(this).attr("data-user-name");
                var msg = $(this).val();
				updateDB(id,msg);
                msg = chatformat_msg(msg, 'sent', 'You');
               // $(".chatapi-windows #user-window" + id + " .chatarea").append(msg);
                $(this).val("");
                $(this).focus();
				$(".chatapi-windows #user-window" + id + " .chatarea").perfectScrollbar({
                suppressScrollX: true
				});
				$('#chatarea_'+id).scrollTop(1E10);
            }
           
        });

    };

    function chatformat_msg(msg, type, name) {
        var d = new Date();
        var h = d.getHours();
        var m = d.getMinutes();
        return "<div class='chatmsg msg_" + type + "'><span class='name'>" + name + "</span><span class='text'>" + msg + "</span><span class='ts'>" + h + ":" + m + "</span></div>";
    }

	socket.on('push message', function(response){

		// console.log(response+test);
		// jQuery selector to get an element
		//alert(response.name);
		var chatarea = $(".page-chatapi");
		 
		if (chatarea.hasClass("hideit")) {
			$('.toggle_chat').trigger('click');
		}
		else {
			
		}
		
		var numItems = $('#user-window'+response.userid).length;
		if(numItems==0)
		{
			$('#chat_user_'+response.userid+',.page-chatapi.user-row').trigger('click');
		}
		else
		{
			if ($('#user-window'+response.userid).css('display') == 'none') {
				$('#chat_user_'+response.userid+',.page-chatapi.user-row').trigger('click');
			}
		}

		//alert(response.userid);
        var i = 0;
		var userid = localStorage.getItem('id');
		
		var chatname = 'Sharmila';
		/* if(response.name != chatname){
			$.get(base_url+'admin/chat_count',function(response){ 
				if(response)
					$('.admin_chat_count').html(response);
			});
		}else{
			$.get(base_url+'admin/chat_status/'+chatname,function(response){ 
				
			});
		} */

		var name = (response.name) ? response.name : 'Admin';
		// console.log(name);
		
		
		if(name == 'Admin'){
			$('#chatarea_'+response.userid).append('<div class="chatmsg msg_sent" style="background-color: black"><span class="name">'+name+' </span><span class="text">'+response.msg+'.</span><span class="ts">just now</span></div>');
			// $('#msg').append('<div class="row msg_container base_sent"><div class="col-md-10 col-xs-10 pad-0"><div class="messages1 msg_sent"><h4>'+response.name+'</h4><p>'+response.msg+'.</p></div></div></div>');
		}else { //else if(response.name == chatname){
			$('#chatarea_'+response.userid).append('<div class="chatmsg msg_sent"><span class="name">'+name+' </span><span class="text">'+response.msg+'.</span><span class="ts">just now</span></div>');
		}
	
		$(".chatapi-windows #user-window" + response.userid + " .chatarea").perfectScrollbar({
                suppressScrollX: true
        });

		$('#chatarea_'+response.userid).scrollTop(1E10);
		
		//$("time.timeago1"+i).timeago();

		//$('.message-box').focus();
		
			i++;
	//get_date_time();
	});
	
	socket.on('user logout', function(response){
		if(response){
			if(logged_in && loggedin_id == response.user_id)
			location.href = base_url+'home/logout';
		}		
	});
	

	/*$(document).on('keyup','.message-box',function(e){
		var $this = $(this);
		if(e.which === 13){
			var message = $this.val();	
			$this.attr('disabled', true);		
			$this.css('opcaity', '0.2');
			alert();	
			updateDB(loggedinusername,message); //Update message in DB
		}
	});*/

	$('.message-box').keyup(function(e){
		var $this = $(this);
		if(e.which === 13){
			var message = $this.val();	
			$this.attr('disabled', true);		
			$this.css('opcaity', '0.2');
			
		
			updateDB(loggedinusername,message); //Update message in DB
		}
	});

	$(document).on('click','.admin_chat',function(e){
		var $this = $(this);
		var custom_name = $(this).attr('custom');
		$('.admin_chat_box').show();
		$('.messages').html('');
		localStorage.setItem('username',custom_name);	
			var user = custom_name;
			//alert(user);
			
			loadMessages(user);
			$('.message-box').next().val(user);
			$('.message-box').focus();
	});

	function updateDB(name,msg){
		
         //var csrf = document.getElementsByName('csrf_test_name')[0].value; //csrf_test_name:csrf
		$.post(base_url+'exchange/admin/storeChat',{method:'update',name:name,msg:msg/* ,csrf_test_name:csrf */},function(response){
			//console.log(name, msg);
			if(response.status == '0'){
				$('.chat-error-message').html(response.msg);
				$('.chat-error-message').css('display', '');
			}else{
				// backup socket.emit('new message', msg);
				socket.emit('admin message', {'userid' : name,'message' : msg});
				$('.chat-error-message').css('display', 'none');
			    $('.message-box').val('');
			}
			
			$('.message-box').attr('disabled', false);		
			$('.message-box').css('opcaity', '1');					
		}, 'json');
	}
	/* var loggedinusername='tomobon567'; */
	if(typeof(loggedinusername) != 'undefined'){
		console.log(loggedinusername);
		//alert(loggedinusername);

		socket.emit('new user', loggedinusername, function(response){
			if(response){
				localStorage.setItem('username',loggedinusername);	
				//alert(loggedinusername);				
				loadMessages(loggedinusername); //retrieve messages from Database
			} 
		});
	}

	if(typeof(user_id1) != 'undefined'){
		console.log(user_id1);
		socket.emit('new userid', user_id1, function(response){
			if(response){
				localStorage.setItem('id',user_id1);									
				loadMessages(); //retrieve messages from Database
			} 
		});
	}else{
		loadMessages();
	}

	function loadMessages(id){ 
	/* alert(user); */
		//$('.container').html('');
		/*var part1 ='<div class="container '+user+'"><div class="row chat-window col-xs-12 col-md-3" id="chat_window_1" style="margin-left:10px;"><div class="col-xs-12 col-md-12"><div class="panel panel-default admin_chat_box"><div class="panel-heading top-bar chat_top_bar"><div class="col-md-7 col-xs-7 chat_top_bar1"  style="cursor:pointer"></div><div class="col-md-5 col-xs-5" style="text-align: right;"><div> <span id="minim_chat_window" class="glyphicon glyphicon-minus icon_minim chat_icon" style="cursor:pointer; display:none"></span><span id="max_chat_window" class="glyphicon glyphicon-remove icon_close chat_icon" data-id="chat_window_1"  style="cursor:pointer"></span></div></div></div>';
		var main = '<div class="panel-body msg_container_base " style="display:none !important;"><div class="messages"> </div>';
		var foot = '  <div class="panel-footer"><div class="row msg_container base_sent"><div class="col-md-11 col-xs-11 pad-0"><div class="input-group"><input id="btn-input" type="text" class="form-control input-sm chat_input message-box " placeholder="Send message here..." /><input type="hidden" value=""></div></div></div></div>';
		
		var end = '</div></div></div></div></div>';
		$('.container').html(part1+''+main+''+foot+''+end);*/
		


		$.get(base_url+'exchange/admin/retrieveChat/'+id,function(response){
		/*	$.each(response,function(i,v){	
			if(v.from == 'admin')	{
				$('.messages').append('<div class="row msg_container base_receive "><div class="col-md-10 col-xs-10 pad-0"><div class="messages1 msg_receive"><h4>Admin</h4><p>'+v.message+'.</p></div></div></div>');
			}else{
			  $('.messages').append('<div class="row msg_container base_sent"><div class="col-md-10 col-xs-10 pad-0"><div class="messages1 msg_sent"><h4>'+v.from+'</h4><p>'+v.message+'.</p></div></div></div>');
			 }

			});*/
			//alert(response.user);
		/* $('.chatarea').animate({scrollTop: $('.messages').prop("scrollHeight")}, 500); */
		$('#chatarea_'+response.user).append(response.message);
		$(".chatapi-windows #user-window" + response.user + " .chatarea").perfectScrollbar({
                suppressScrollX: true
        });
		$('#chatarea_'+response.user).scrollTop(1E10);
		 //$("time.timeago").timeago();

			/* $('.msg_container_base').show();
			$('.message-box').focus(); */
			
		}, 'json');

		/* $.get(base_url+'admin/chat_count',function(response){ 
			if(response)
				$('.admin_chat_count').html(response);
		}); */
		/* var chatname = 'tomobon567';
		$.get(base_url+'admin/chat_status/'+chatname,function(response){ 
				
			}); */
	}

	/*** App ***/


});
