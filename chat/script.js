/* const https = require('https');
const fs = require('fs');
var server = https.createServer({
key: fs.readFileSync('/var/www/html/gotbitcoinus/chat/osiztech.key').toString(),
cert: fs.readFileSync('/var/www/html/gotbitcoinus/chat/osiztech.crt').toString(),
NPNProtocols: ['http/2.0', 'spdy', 'http/1.1', 'http/1.0']
}) */

var server = require('http').createServer(); // HTTP

var io = require('socket.io')(server);
var request = require('request');
var users = [];
var users_id = [];
io.on('connection', function (socket) {

//'* * * * * *' - runs every second
//'*/5 * * * * *' - runs every 5 seconds/
//'10,20,30 * * * * *' - run at 10th, 20th and 30th second of every minute
//'0 * * * * *' - runs every minute
//'0 0 * * * *' - runs every hour (at 0 minutes and 0 seconds)
var cron = require('cron');
var cronJob = cron.job("*/5 * * * * *", function(){
// perform operation e.g. GET request http.get() etc.
	
	if(socket.userid=='undefined')
	{
		console.log("undefined ="+socket.userid);
	}
	else if(socket.userid)
	{
		console.log("defined ="+socket.userid);
		request('http://localhost/bitcocyrus/trade_integration/'+socket.trade_id+'/'+socket.userid+'/trade', function (error, response, body) {
		console.log(body);
		//console.log(error);
		var obj	=	JSON.parse(body);
		console.log(obj);
		var count	=	obj;	
		var user_id	=	obj.user_id;	
		io.emit('count message', {count: count, user_id: user_id});
	
	/* if(body!='')
	{
		if(response)
				console.log("en response ="+response.test);
		request('http://localhost/usiexchange/en/exchanges/chat_count/'+socket.userid+'/1', function (error, response, body) {
			if(response)
				console.log("en response ="+response.test);
		
		});
	} */
},'json');}
console.log('cron job completed');
}); 
cronJob.start();


    socket.on('new userid', function(user_id , callback){
    //console.log(name);
    if(user_id.length > 0){
      //if(users.indexOf(name) == -1){
       socket.userid = user_id;
       console.log("new userid = "+socket.userid);
        //updateUsers_id();
        callback(true);
     	// } else{

      //  callback(false);
     // }
    }
  });

    socket.on('new trade_id', function(trade_id , callback){
    //console.log(name);
    if(trade_id.length > 0){
      //if(users.indexOf(name) == -1){
      socket.trade_id = trade_id;
      console.log("new trade_id = "+socket.trade_id);
       //updateUsers_id();
      callback(true);
     // } else{

      //  callback(false);
     // }
    }
  });

 

   
   socket.on('user deactivated', function(user_id){
	   console.log('deactivated');
    io.emit('user logout', {user_id: user_id});
  });


  socket.on('disconnect',function(){
	 console.log('disconnect ='+socket.userid);
   /*  if(socket.username){
      users.splice(users.indexOf(socket.username),1);
      updateUsers();
    } */
	/*if(socket.userid){
      users_id.splice(users_id.indexOf(socket.userid),1);
      updateUsers_id();
    }*/
  });
  
  
});
server.listen(8080,function(){
  console.log('server connenctedss');
});
