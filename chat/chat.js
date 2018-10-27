
$(function(){
	//var socket = io.connect( 'https://'+window.location.hostname+':8443' );
	var socket = io.connect( 'http://'+window.location.hostname+':8080' );
	var base_url = $('#base_url').val();
	
/*
	socket.on('users', function(data){
		$('.names-list').text('');
		$.each(data,function(i,v){
			$('.names-list').append('<li>'+v+'</li>');
		});
	}); */
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

var currentdate = new Date();
var datetime = get_date_time(); 

 				/*currentdate.getFullYear() + "-"  
			    + (currentdate.getMonth()+1)  + "-" 
			    + currentdate.getDate()+" "
			    + currentdate.getHours() + ":"  
			    + currentdate.getMinutes() + ":" 
			    + currentdate.getSeconds();*/
				
	socket.on('getCSRF', function(user_id){ 
		update_csrf(user_id);
	});
	
	socket.on('getCSRFS', function(user_id){ 
		update_csrfs(user_id);
	});
	
    function update_csrf(user_id)
	{
		$.get(site_url+'exchanges/getCSRF',function(response){

			$.post(site_url+'exchanges/change_status',{user_id:user_id,user_status:"1"},function(response){
			
			});
			
		}, 'json');
	}  

	function update_csrfs(user_id)
	{
		$.get(site_url+'exchanges/getCSRF',function(response){

			$.post(site_url+'exchanges/change_status',{user_id:user_id,user_status:"0"},function(response){
			
			});
			
		}, 'json');
	}
	
	socket.on('count message', function(response){
		if($('#current_user').val()==response.user_id)
		{
			$('#meg_count').html(response.count);
		}
	});

	socket.on('push message', function(response){ 
		console.log(response);
		//alert(response.userid);
		var userid= response.userid;
 
        var i = 0;

		var name = (response.name) ? response.name : 'Admin';
		if(name == 'Admin'){
			$('#msg'+userid).append('<div class="row msg_container base_receive "><div class="col-md-10 col-xs-10 pad-0"><div class="messages1 msg_receive"><h4>'+name+' </h4><p>'+response.msg+'.</p><p style="text-align: right;"><time class="timeago'+i+'" datetime="'+datetime+'">just now</time></p></div></div></div>');
		}else{
			
			$('#msg'+userid).append('<div class="row msg_container base_sent"><div class="col-md-10 col-xs-10 pad-0"><div class="messages1 msg_sent"><h4>'+response.name+'</h4><p>'+response.msg+'.</p><p style="text-align: right;"><time class="timeago'+i+'" datetime="'+datetime+'">just now</time></p></div></div></div>');
			//$('.messages').append('<div class="row msg_container base_receive "><div class="col-md-10 col-xs-10 pad-0"><div class="messages1 msg_receive"><h4>'+name+' </h4><p>'+response.msg+'.</p></div></div></div>');
		}
		//$("time.timeago"+i).timeago();
		$('.message-box').focus();
		//$('.messages').append('<div class="row msg_container base_sent"><div class="col-md-10 col-xs-10 pad-0"><div class="messages1 msg_sent"><h4>'+response.name+'</h4><p>'+response.msg+'.</p></div></div></div>');
		$.get(site_url+'exchanges/status_update/'+userid,function(response){
		})
		$('.msg_container_base').show();
		$('.message-box').focus();
		$('.messages').scrollTop(1E10);
		//$('.messages').animate({scrollTop: $('.messages').prop("scrollHeight")}, 500);
	i++;
	// get_date_time();
	});
	
	socket.on('user logout', function(response){
		if(response){
			if(logged_in && loggedin_id == response.user_id)
			location.href = base_url+'home/logout';
		}		
	});
	

	$(document).on('keyup','.message-box',function(e){
		var $this = $(this);
		if(e.which === 13){
			var message = $this.val();	
			$this.attr('disabled', true);		
			$this.css('opcaity', '0.2');		
			updateDB(user_id,message); //Update message in DB
		}
	});

	$(document).on('click','.chat_top_bar1',function(e){
		$('.msg_container_base').show();
		$('.message-box').focus();
	});

	function updateDB(name,msg){
        var csrf = document.getElementsByName('csrf_bvue_fd')[0].value;
		$.post(site_url+'exchanges/storeChat',{method:'update',name:name,msg:msg,csrf_bvue_fd:csrf},function(response){
		
			//console.log(name, msg);
			/* alert(name, msg); */
			if(response.status == '0'){
				$('.chat-error-message').html(response.msg);
				$('.chat-error-message').css('display', '');
			}else{
				socket.emit('new message', msg);
				$('.chat-error-message').css('display', 'none');
			    $('.message-box').val('');
			}
			
			$('.message-box').attr('disabled', false);		
			$('.message-box').css('opcaity', '1');					
		}, 'json');
	}

	if(typeof(loggedinusername) != 'undefined'){
		socket.emit('new user', loggedinusername, function(response){
		//alert(loggedinusername);
			if(response){
				localStorage.setItem('username',loggedinusername);									
				loadMessages(); //retrieve messages from Database
			} 
		});
	}else{
		loadMessages();
	}	

		if(typeof(user_id) != 'undefined'){
		socket.emit('new userid', user_id, function(response){
			if(response){
				localStorage.setItem('id',user_id);									
				loadMessages(); //retrieve messages from Database
			} 
		});
	}else{
		loadMessages();
	}


	function loadMessages(){ 
		/* $.get(base_url+'welcome/chat_status',function(response){ 
			if(response == '1')
				$('.msg_container_base').show();
				$('.message-box').focus();
		}); */
 					

		$.get(site_url+'exchanges/retrieveChat',function(response){
			
		/*	$.each(response,function(i,v){	
			if(v.from == 'admin')	{
				$('.messages').append('<div class="row msg_container base_receive "><div class="col-md-10 col-xs-10 pad-0"><div class="messages1 msg_receive"><h4>Admin</h4><p>'+v.message+'.</p></div></div></div>');
			}else{
			  $('.messages').append('<div class="row msg_container base_sent"><div class="col-md-10 col-xs-10 pad-0"><div class="messages1 msg_sent"><h4>'+v.from+'</h4><p>'+v.message+'.</p></div></div></div>');
			 }

			  //$('.messages').append('<div class="clearfix"><div class="cls_single"><span>'+v.name+'&nbsp;:</span>'+v.message+'</div><div class="cls_bo pad-no"></div></div>');
			  // $('.messages').append('<li><div class="timeline-badge"><i class="fa fa-user"></i></div><div class="timeline-panel"><div class="timeline-heading"><div class="timeline-title">&nbsp;&nbsp;<span class="label label-info">'+v.name+'</span></div><p>'+v.message+'<br/><span data-livestamp="'+v.created_at+'" class="msg-rhs"></span></p></div></div></li>');
			});*/
 $('.messages').append(response);
		//$("time.timeago").timeago();
			
			//$('.messages').animate({scrollTop: $('.messages').prop("scrollHeight")}, 500);
			$('.messages').scrollTop(1E10);
		}, 'json');
	}
	
	/* $.get(site_url+'exchanges/chat_count',function(response){ 
			if(response)
				alert(response);
		}); */
		
	socket.on('message', function(msg){	
		alert(msg);
	});	

	/*** App ***/


});