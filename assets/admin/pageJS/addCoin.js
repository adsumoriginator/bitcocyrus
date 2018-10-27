$(document).ready(function() {
    $("#coin-form").validate({
        rules:{
		  min_withdraw_limit:{
			required:true,
			number: true
		  },
		  max_withdraw_limit:{
			required:true,
			number: true
		  },
		  withdraw_fees:{
			required:true,
			number: true
		  },         
		  currency_name:{
			required:true
		  }, 
		  currency_code:{
			required:true
		  }, 
		  admin_address: {
			required:true
		  }
		},
		messages:{
		   min_withdraw_limit:{
			required:"Please enter minimum withdraw limit"
		   },
		   max_withdraw_limit:{
			required:"Please enter maximum withdraw limit"
		   },
		   withdraw_fees:{
			required:"Please enter withdraw fees"
		   },   
		   currency_name:{
			required:"Please enter currency name"
		   }, 
		   currency_code:{
			required:"Please enter currency code"
		   },
		   admin_address: {
			required:"Please enter admin address"
		   }
		}
    });
});