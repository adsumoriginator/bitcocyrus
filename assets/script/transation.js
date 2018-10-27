$(document).ready(function() { 

	var href = document.location.href;
	
	var result = href.split("/");
	var action = result[4];
	var currency_id = result[5];

	if (action == 'deposit' && currency_id == 'BTC') {

		var symbol = currency_id;
		var id = $('#sid').val();
		rurl=base_url+"transation/create_address";
		  $.ajax({
			url: rurl,
			type: "post",
			data:{symbol:symbol,id:id},
			beforeSend:function(){       
				$('#creatAdres').html('<i class="fa fa-spinner fa-spin"></i>Please wait..');
			   $('#creatAdres').attr('disabled',true);                
			},             
			success: function(response) {

			    var designs=JSON.parse(response);
 			    var depAdr = $("#depAdr").text();
				if(designs.address != null && depAdr == ""){

					var html_adr ="<a onclick=\"copyToClipboard('#depAdr')\" class='ico_cpoy'>\
						<i class='fa fa-files-o'></i></a>\
						<span class='text_address' id='depAdr'>"+designs.address+"</span>";
					$('.address-holder').append(html_adr);
					
				}
			},	
			complete: function(){
				$('#creatAdres').hide();
				//location.reload();
			}
		});
	}

	$('#dep_select').on('change', function() {         
		//var url=base_url+"transation/deposit/"+this.value;         
		//window.location.replace(url);

		var symbol = $('#dep_select').val();
		var id = $('#sid').val();
		var material_type = $('select.sel_cur').find(':selected').attr('data-id');
		
		if(material_type == 1) {
			rurl=base_url+"transation/create_address";
			  $.ajax({
				url: rurl,
				type: "post",
				data:{symbol:symbol,id:id},
				beforeSend:function(){       
					$('#creatAdres').html('<i class="fa fa-spinner fa-spin"></i>Please wait..');
					$('#creatAdres').attr('disabled',true);                
				},             
				success: function(response) {

					//alert(response);
				   var designs=JSON.parse(response);

					if(designs.address != null){

						$('.address-holder').hide();
				
						var html_adr ="<a onclick=\"copyToClipboard('#depAdr')\" class='ico_cpoy'>\
							<i class='fa fa-files-o'></i></a>\
							<span class='text_address' id='depAdr'>"+designs.address+"</span>";
						$('.address-holder').append(html_adr);
						
					}
					if(designs.payment_id != null){
						
						var html_adr ="<p>Payment ID : <a onclick='copyToClipboard('#payid')' class='ico_cpoy'>\
							<i class='fa fa-files-o'></i></a>\
							<span class='text_address' id='payid'>"+designs.payment_id+"</span></p>";
						$('.payment-id').append(html_adr);
					}
				},	
				complete: function(){
					$('#creatAdres').hide();
					//location.reload();
					var url=base_url+"transation/deposit/"+symbol;         
					window.location.replace(url);
				}
			});
		} else {
			var url=base_url+"transation/deposit/"+symbol;         
			window.location.replace(url);
		}
	})

	$('#withdraw_select').on('change', function() {         
		var url=base_url+"transation/withdraw/withdraw/"+this.value;         
		window.location.replace(url);
	})
	
	jQuery.validator.addMethod("balancecheck", function(value, element) {
		if(value > balance){
			return false;
		}else{
		  return true;
		}
	}, "Insufficient balance");
	
	$('#creatAdres').on('click', function(){
		
	})

	$( "#withdraw_amount" ).on('input',function(e){

	  withdraw_fee=parseFloat(withdraw_fee);

	  var amount=parseFloat($(this).val());


		fee=withdraw_fee;
		$("#fee_amount").val(fee);
		total= amount-fee;
		total= total.toFixed(8);   

		$("#total_amount").val(total);

		var currency =  $("#withdraw_select option:selected").val();
		if("#withdraw_amount" > 0 ){
			$("#total_amt").html("0.00000000 " + currency);
			$("#total_amt1").val("0.00000000");
		} else {
			$("#total_amt").html(total+" "+currency);
			$("#total_amt1").val(total);
		}


		var toal_usd=amount*usd_price;
		toal_usd= toal_usd.toFixed(2)
		$("#usd_amount").val(toal_usd);

	  

	});


	$( "#usd_amount" ).on('input',function(e){
		var usd_total=parseFloat($(this).val());
		var amount=usd_total/usd_price;
		amount=amount.toFixed(8);
		$( "#withdraw_amount").val(amount);
		withdraw_fee=parseFloat(withdraw_fee);
	   fee=amount*withdraw_fee/100;
	   fee=fee.toFixed(8);
		 $("#fee_amount").val(fee);
		  total= amount-fee;
		  total=total.toFixed(8);
		   $("#total_amount").val(total);
	  });



	$('#withdraw_form').validate({

	   rules:{
		  address:{
		  required:true,

		

		   
		},
	  withdraw_amount:{
		  required:true,
		   max: max_withdraw_limit,
		   min: min_withdraw_limit,
		 
		  
		},
		xrp_tag:{
		   digits: true
		},


		usd_amount:{
		  required:true,
		  //max: usd_max_withdraw,
		 // min:1,

		  
		 /* remote: {
							url: base_url+"transation/check_daily_limit",
							type: "post",
							data: {
									usd_amount: function()
									{
										return $("#usd_amount").val();
									}
								  }
						  },
		  
		 */
		  
		},

	   
	   
	  },
	  messages:{

		  address:{

			required:"Please enter address",
		   
			
		  
		},


		 xrp_tag:{

			 digits:"Please valid tag value",
		   
			
		  
		},


		withdraw_amount:{

			required:"Please enter amount",
		   
			
		  
		},
	   desc:{

		   required:"Please enter description",
		  
	   },

	   usd_amount:{
		required: "Please enter USD amount",
		remote: "Your withdraw amount exceeding daily limit",

	   }
		
		
	   
	  },

	   submitHandler: function(form) {

		if(kyc_status!="Verified"){

		  $(".alert-success").hide();
		  $(".alert-denger").show();
		  $(".alert-denger .withdraw_error").html("KYC not verified, Please get KYC verification");  
		  return false;
		}else if(tfa_status==0){


		  $(".alert-success").hide();
		  $(".alert-denger").show();
		  $(".alert-denger .withdraw_error").html("Need to verify TFA Authendication, Please verify");
		  return false;
		}else 



		{
		   //  $('#tfa').modal('toggle');
		   // $('#tfa').modal('show'); 

	  
	  		/* withdraw deposit same */
		
		   var postdata = $("#withdraw_form").serialize();
		  rurl=base_url+"transation/check_daily_limit";
		  $.ajax({
				url: rurl,
				type: "post",
				data:postdata,
				beforeSend:function(){       
					$('.ena_btn').html('<i class="fa fa-spinner fa-spin"></i>Please wait..');
				   $('.ena_btn').attr('disabled',true);                
				  },             
				success: function(response) {
				  $('.ena_btn').attr('disabled',false); 
				  $('.ena_btn').html('WITHDRAW'); 

				  if(response=="no_balance"){

					$(".alert-success").hide();
					$(".alert-denger").show();
					$(".alert-denger .withdraw_error").html("Insufficient balance");
					return false;
				  }else if(response=="same_addresses"){
					$(".alert-success").hide();
					$(".alert-denger").show();
					$(".alert-denger .withdraw_error").html("Not use same deposit address.");
					return false;
				  }else if(response=="same_payment"){
					$(".alert-success").hide();
					$(".alert-denger").show();
					$(".alert-denger .withdraw_error").html("Not use same payment id.");
					return false;
				  }else if(response=="limit_exceed"){
					$(".alert-success").hide();
					$(".alert-denger").show();
					$(".alert-denger .withdraw_error").html("Daily limit exceeded, Please check today transation and withdraw USD amount");
					return false;
				  }else if(response=="success"){
					   $('#withdraw_div').hide()
					   $('#tfa').show();
					}  
				}
			  
			



	  });







		

			 
		  }

		}




	  });

	  

	$('#tfa_verify_form').validate({

	   rules:{

	  tfa_code:{
		  required:true,
		  maxlength:6,
		  minlength:6,
		 
		 
		  
		},

		
			 
	   
	  },
	  messages:{

		  tfa_code:{

			required:"Please TFA Code",
			maxlength:"Please enter 6 digit code",
			minlength:"Please enter 6 digit code",
		   
			
		  
		},

		
		
		
	   
	  },
	   submitHandler: function(form) { 
		  $('#withdraw_tfa_button').html('');
		  $('#withdraw_tfa_button').html('<i class="fa fa-spinner fa-spin"></i> Please Wait..');
		  $('#withdraw_tfa_form').attr('disabled',true);                
		  var postdata = $("#tfa_verify_form, #withdraw_form").serialize();
		  rurl=base_url+"transation/withdraw_check_tfa";
		  $.ajax({
				url: rurl,
				type: "post",
				data:postdata,
				beforeSend:function(){       
					$('#withdraw_tfa_button').html('<i class="fa fa-spinner fa-spin"></i>Please wait..');
				   $('#otp_button').attr('disabled',true);                
				  },             
				success: function(response) {

				  $('#withdraw_tfa_button').html('Validate');

				  if(response=="day_limit"){

					$(".alert-denger").show();

					  //  otp_error_msg

						$(".error").html("Your day limit exceed, Please check today total transation");




				  }else if(response=="Invalid_code"){
						//$('#withdraw_tfa_form').attr('disabled',false);
					  //  $('#withdraw_tfa_form').html('validate');
						  $(".alert-denger").show();

						  $(".withdraw_error").html("Invalid code")



					  //  otp_error_msg

						$(".withdraw_error").html("Invalid TFA code, Please enter valid code");

					}else if(response=="success"){
							  
						$('#tfa').modal('toggle');
						$('#tfa').modal('hide');
						location.reload();
						$(".alert-success").show();
						$(".success").html("Withdraw request send success, Please verify your email address.");
						$("#register").trigger('reset');
						$("#otp_form").trigger('reset');
					} 


					 setTimeout(function() {
			$(".alert-denger").hide()
		   }, 3000);        
					// $('#answers').html(response);
				}            
			});  



		 
		},


	  });




	$('#deposit_search').validate({

	   rules:{

	  with_from_date:{
		  required:true,
		  
		 
		  
		},


		 with_from_date:{
		  required:"Please select from date",
	   
		 
		 
		  
		},

		
			 
	   
	  },
	  messages:{

		  tfa_code:{

			required:"Please TFA Code",
			maxlength:"Please enter 6 digit code",
			minlength:"Please enter 6 digit code",
		   
			
		  
		},

		
		
		
	   
	  },

	   submitHandler: function(form) {

		/* $('#withdraw_tfa_button').html('<i class="fa fa-spinner fa-spin"></i> Please Wait..');
			$('#withdraw_tfa_button').attr('disabled',true);                
			var postdata = $("#tfa_verify_form, #withdraw_form").serialize();
		  
		   */


		
		  //$('#withdraw_tfa_form').html('');
		  //  $('#withdraw_tfa_form').html('<i class="fa fa-spinner fa-spin"></i> Please Wait..');
		   // $('#withdraw_tfa_form').attr('disabled',true);                
			var postdata = $("#deposit_search").serialize();
			 rurl=base_url+"transation/withdraw_check_tfa";
		  
		   $.ajax({
				url: rurl,
				type: "post",
				data:postdata,
				beforeSend:function(){       
					$('#otp_button').html('<i class="fa fa-spinner fa-spin"></i>Please wait..');
				   $('#otp_button').attr('disabled',true);                
				  },             
				success: function(response) {

					if(response=="Invalid_code"){
						//$('#withdraw_tfa_form').attr('disabled',false);
					  //  $('#withdraw_tfa_form').html('validate');
						$(".otp_error").show();

					  //  otp_error_msg

						$(".otp_error_msg").html("Invalid TFA code, Please enter valid code");

					}else if(response=="success"){
			   
					 
						$('#tfa').modal('toggle');
						$('#tfa').modal('hide');
						location.reload();

						$(".alert-success").show();
						$(".success").html("Registration success, Please verify your email address.");
						$("#register").trigger('reset');
						$("#otp_form").trigger('reset');
					}         
					// $('#answers').html(response);
				}            
			});  



		 
		},


	  });





	  



	});








	$('#withdraw_from').validate({

	   rules:{

	  with_from_date:{
		  required:true,
		  
		 
		  
		},

		with_to_date:{
		  required:true,
		  
		 
		  
		},


		
			 
	   
	  },
	  messages:{

		  with_from_date:{

			required:"Please select from date",
				 
		  
		},

		with_from_date:{

			required:"Please select to date",
			   
			
		  
		},

	 
	   
	  },



	  });





	$('#dep_from').validate({

	   rules:{

	  dep_from_date:{
		  required:true,
		  
		 
		  
		},

		dep_to_date:{
		  required:true,
		  
		 
		  
		},


		
			 
	   
	  },
	  messages:{

		  dep_from_date:{

			required:"Please select from date",
				 
		  
		},

		dep_to_date:{

			required:"Please select to date",
			   
			
		  
		},

	 
	   
	  },



	  });








	$('#trade_form').validate({

	   rules:{

	  trade_from_date:{
		  required:true,
		  
		 
		  
		},

		trade_to_date:{
		  required:true,
		  
		 
		  
		},


		
			 
	   
	  },
	  messages:{

		  trade_from_date:{

			required:"Please select from date",
				 
		  
		},

		trade_to_date:{

			required:"Please select to date",
			   
			
		  
		},

	 
	   
	  },
});
