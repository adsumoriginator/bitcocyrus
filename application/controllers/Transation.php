<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transation extends CI_Controller {


	public function __construct()
	{
		parent::__construct();	

		/*if(!$this->session->userdata("user_id")){

			redirect();
		}else{

			$userdata=get_user(user_id());
			if($userdata->user_status==0 || $userdata->email_status==0){

				redirect("home/logout");
			}
		

		}*/
		
	}

	function deposit($seg=""){

		error_reporting(0);

		if(!$this->session->userdata("user_id")){
			redirect();
		}else{
			$userdata=get_user(user_id());
			if($userdata->user_status==0 || $userdata->email_status==0){
				redirect("home/logout");
			}
		}
		$this->load->helper('form');
		$userid = user_id();
		$cur_sym = $seg;
		$address = $this->CommonModel->get_deposit_withdraw($userid, $cur_sym)->row();
		
		/* $condition=array("user_id"=>user_id(), "currency_symbol"=>$seg);
		$address=$this->CommonModel->getTableData("address_balance",$condition)->row();
		$wallet=$this->CommonModel->getTableData("address_balance",$condition)->row(); */
		
		if($seg!="withdraw"){
			$cur_condition=array("currency_symbol"=>"BTC");
			$data["user_id"]=user_id();	
			if($seg==""){	
				$data["depaddress"]=$address->address;	
				$data["balance"]=$address->balance;	
				$data["select_currency"]="BTC";	
			}else{
				$data["depaddress"]=$address->address;
				$data["balance"]=$address->balance;
				$data["select_currency"]=$seg;				
				if($seg=="XMR"){
					$data["payment_id"]=$address->payment_id;		
				}
			}
		}
			
		$data["all_currency"] = $this->CommonModel->get_user_dashboard_data($userid);
		/*$data['main_js'] = "transation";*/
		/* $data["all_currency"]=$this->CommonModel->getTableData("currency");
		$withdraw_currency=$this->CommonModel->getTableData("currency",$cur_condition)->row(); */
		$data['min_withdraw_limit']=$address->min_withdraw_limit;
		$data['max_withdraw_limit']=$address->max_withdraw_limit;
		$data['withdraw_fee']=$address->withdraw_fees;
		$user_data=get_user(user_id());
		$data["tfa_status"]=$user_data->tfa_status;
	    $data["kyc_status"]=$user_data->kyc_status;
	    $site_data=site_settings();
	    $allowd_withdrawal=$site_data->allowd_withdrawal;
	 	$data["usd_max_withdraw"]= $allowd_withdrawal;
        $url="https://api.coinmarketcap.com/v1/ticker/";			
  		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL,$url);
		$result=curl_exec($ch);
		curl_close($ch);
		$coin_price_details=json_decode($result, true);
		if($coin_price_details!=""){
			if(count($coin_price_details) > 0){
				foreach($coin_price_details as $cur_array){
					if($cur_array["symbol"]==$currency){
						$data["usd_price"]=$cur_array["price_usd"];
						 break;
					}
				}
			}else{
				//header("Refresh:0");
			}
		}else{
			//header("Refresh:0");
		}
		$this->load->view("front/transation/deposit",$data);
	}
	
	function withdraw($seg=""){

		error_reporting(0);

		if(!$this->session->userdata("user_id")){
			redirect();
		}else{
			$userdata=get_user(user_id());
			if($userdata->user_status==0 || $userdata->email_status==0){
				redirect("home/logout");
			}
		}
		$this->load->helper('form');
		$currency=$this->uri->segment(4);
		
		$data["get_usd_amount"] = $this->CommonModel->get_usd_amount($user_id);
		$userid = user_id();
		$cur_sym = $currency;
		$address = $this->CommonModel->get_deposit_withdraw($userid, $cur_sym)->row();
		//print_r($address);die();
		/* $condition=array("user_id"=>user_id(), "currency_symbol"=>$currency);
		$address=$this->CommonModel->getTableData("address_balance",$condition)->row();
		$wallet=$this->CommonModel->getTableData("address_balance",$condition)->row(); */
		
		if($currency==""){
			$currency="BTC";
			$data["depaddress"]=$address->BTC;	
			$data["select_currency"]="BTC";
			$data["balance"]=$address->BTC;
			$cur_condition=array("currency_symbol"=>"BTC");
		}else{
			$data["depaddress"]=$address->address;	
			$data["select_currency"]=$currency;
			$data["balance"]=$address->balance;
			$cur_condition=array("currency_symbol"=>$currency);
		}
			
		/*$data['main_js'] = "transation";*/
		$data["all_currency"] = $this->CommonModel->get_user_dashboard_data($userid);
		/* $data["all_currency"]=$this->CommonModel->getTableData("currency");
		$withdraw_currency=$this->CommonModel->getTableData("currency",$cur_condition)->row(); */
		$data['min_withdraw_limit']=$address->min_withdraw_limit;
		$data['max_withdraw_limit']=$address->max_withdraw_limit;
		$data['withdraw_fee']=$address->withdraw_fees;
		$user_data=get_user(user_id());
		$data["tfa_status"]=$user_data->tfa_status;
	    $data["kyc_status"]=$user_data->kyc_status;
	    $site_data=site_settings();
	    $allowd_withdrawal=$site_data->allowd_withdrawal;
	 	$data["usd_max_withdraw"]= $allowd_withdrawal;
        $url="https://min-api.cryptocompare.com/data/price?fsym=$currency&tsyms=USDT";   			
  		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL,$url);
		$result=curl_exec($ch);
		curl_close($ch);
		$coin_price_details=json_decode($result, true);
		/* if($coin_price_details!=""){
			if(count($coin_price_details) > 0){
				foreach($coin_price_details as $cur_array){
					if($cur_array["symbol"]==$currency){
						$data["usd_price"]=$cur_array["price_usd"];
						 break;
					}
				}
			}else{
				//header("Refresh:0");
			}
		}else{
			//header("Refresh:0");
		} */
		$data["usd_price"]=$coin_price_details[USDT];
		$this->load->view("front/transation/withdraw",$data);
	}

	function withdraw_check_tfa(){

		if(!$this->session->userdata("user_id")){

			redirect();
		}else{

			$userdata=get_user(user_id());
			if($userdata->user_status==0 || $userdata->email_status==0){

				redirect("home/logout");
			}
		

		}


		$this->load->library('form_validation'); 
	    $this->form_validation->set_rules('currency', 'otp', 'required');  
		$this->form_validation->set_rules('withdraw_amount', 'password', 'required');
		//$this->form_validation->set_rules('desc', 'old_password', 'required');
		$this->form_validation->set_rules('address', 'address', 'required');
		$this->form_validation->set_rules('tfa_code', 'old_password', 'required');
		
		if ($this->form_validation->run() == FALSE)
	    {
	        	echo "value_missing";      
	    }
	    else
	    {
			$userdetail=get_user(user_id());
			$currency=$this->input->post("currency");
			$address=$this->input->post("address");
			$amount=$this->input->post("withdraw_amount");
			$desc=$this->input->post("desc");
			
			$condition=array("user_id"=>user_id(), "currency_symbol"=>$currency);
			$address_dep=$this->CommonModel->getTableData("address_balance",$condition)->row();
			
			$tfa_code=$desc=$this->input->post("tfa_code");

			$usd_amount=$this->input->post("usd_amount");

    		$key=$userdetail->tfa_secrect_key;
    		$status=$userdetail->tfa_status;

    		if($userdetail->kyc_status!="Verified"){
    			echo "unverified";
    			exit;

    		}
    		$this->db->select('SUM(usd_amount) AS total_usd_amount');

    		$date=date("Y-m-d")." "."00:00:00";

    		$ckcondition=array("requested_time >"=>$date,'user_id'=>user_id(),"type"=>2);
    		$result=$this->CommonModel->getTableData("tansation",$ckcondition)->row();

    		$total_usd_amount=$result->total_usd_amount+$amount;
			$site_data=site_settings();


			$allowd_withdrawal=$site_data->allowd_withdrawal;
    		if($total_usd_amount >$allowd_withdrawal){
    			echo "day_limit";
    			exit;
    		}			
			$checkResult = $this->googleauthenticator->verifyCode($key, $tfa_code, 2); // 2 = 2*30sec clock tolerance
			
			if ($checkResult) {

					$condition=array("user_id"=>user_id(), "currency_symbol"=>$currency);
					$wallet_amount=$this->CommonModel->getTableData("address_balance",$condition)->row();

					$wallet_balance=$wallet_amount->balance;
					if($wallet_balance >= $amount){
						
					$cur_condition=array("currency_symbol"=>$currency);
					$withdraw_currency=$this->CommonModel->getTableData("currency",$cur_condition)->row();
					$fee=$withdraw_currency->withdraw_fees;
		 			//$fee=$amount*$fee/100;    
	     			$trans_amount= $amount-$fee;

	     			$fee_pecentage=$withdraw_currency->withdraw_fees;

	     			//Wallet_update
	     			$name=$userdetail->username;
	     			$balance=$wallet_balance-$amount;
					$balupdate[balance]=$balance;
	     			//$condition=array("user_id"=>user_id());
					$this->CommonModel->updateTableData("address_balance",$balupdate,$condition);
					$transid="W".time();

					if($currency=="XRP"){
						if($this->input->post("xrp_tag")){
							$trans_data["xrp_tag"]=$this->input->post("xrp_tag");
						
						}else{
							$trans_data["xrp_tag"]=123456;
						}
					}


					if($currency=="XMR"){
						if($this->input->post("payment_id")){
							$trans_data["payment_id"]=$this->input->post("payment_id");
						
						}
					}


					$trans_data["transactionId"]=$transid;
					$trans_data["type"]=2;
					$trans_data["description"]=$this->input->post("desc");
					$trans_data["user_id"]=user_id();
					$trans_data["usd_amount"]=$usd_amount;
					$trans_data["to_address"]=$address;
					$trans_data["currency"]=$currency;
					$trans_data["currency_id"]=$withdraw_currency->id;
					$trans_data["fee_percentage"]=$fee_pecentage;
					$trans_data["fee"]=$fee;
					$trans_data["total_amount"]=$amount;
					$trans_data["transfer_amount"]=$trans_amount;
					$trans_data["status"]="requested";
					$this->CommonModel->addTableData("tansation",$trans_data);
					$email_data=getEmailTeamplete(9);
					$subject=$email_data->subject;
					$template=$email_data->template;
					$site_data=site_settings();
					$sitename=$site_data->site_name;		
					$confirm_link=base_url()."transation/confirm/".insep_encode($transid);
					$cancel_link=base_url()."transation/cancel/".insep_encode($transid);


				$data=array(
					"###USERNAME###"=>$name,	
					"###FEE###"=>$fee,	
					"###TRANSAMOUNT###"=>$trans_amount,
					"###TRANSID###"=>$transid,	
					"###CONFIRM###"=>$confirm_link,
					"###CANCEL###"=>$cancel_link,
					"###AMOUNT###"=>$amount." ".$currency					
				);
				$data["###NAME###"]=$name;
				$data["###LOGOIMG###"]=getSiteLogo();
				$data["###EMAILIMG###"]=  base_url()."assets/frontend/images/email_send.png";
				$data["###FBIMG###"]= base_url()."assets/frontend/images/facebook.png";			
				$data["###TWIMG###"]= base_url()."assets/frontend/images/twitter.png";
				$data["###GPIMG###"]= base_url()."assets/frontend/images/gplus.png";
				$data["###LEIMG###"]= base_url()."assets/frontend/images/linkedin.png";	
				$data["###HDIMG###"]= base_url()."assets/frontend/images/email.png";
				$data["###FBLINK###"]= $site_data->facebooklink;				
				$data["###TWLINK###"]= $site_data->twitterlink;	
				$data["###GPLINK###"]= $site_data->googlelink;
				$data["###LELINK###"]= $site_data->linkedinlink;


			
			$email=get_user_email(user_id());
			$message=strtr($template,$data);		
			send_mail($email,$subject,$message);

			$this->session->set_flashdata("success", "Withdraw request confirm link send to your email id Please confirm");

			echo "success";


					


			}else{
					$this->session->set_flashdata("no_balance", "Your wallet balance insufficient");
					echo "no_balance";
				}

	
			}else{
				echo "Invalid_code";
				exit;
			}	

		}	

	}

	function check_daily_limit(){

		$usd_amount=$this->input->post("usd_amount");
		$currency=$this->input->post("currency");
		$address=$this->input->post("address");
		$payment_id=$this->input->post("payment_id");
		$wamount=$this->input->post("total_amt");
		$user_id=user_id();
		//$condition=array('user_id'=>$user_id);

		$condition=array("user_id"=>user_id(), "currency_symbol"=>$currency);
		$wallet=$this->CommonModel->getTableData("address_balance",$condition)->row();	
		$balance=$wallet->balance;
		$old_address=$wallet->address;
		$old_pay_id=$wallet->payment_id;
		//print_r($wamount);die();
		if($wamount>$balance){
			$this->session->set_flashdata("no_balance", "Your wallet balance insufficient");
			echo "no_balance";
			exit;
		}
		if($currency != "XMR"){
			if(trim($old_address) == trim($address)){
				echo "same_addresses";
				exit;
			}
		}
		else {
			if(trim($old_pay_id) == trim($payment_id)){
				echo "same_payment";
				exit;
			}
		}
		$this->db->select('SUM(usd_amount) AS total_usd_amount');
			$date=date("Y-m-d")." "."00:00:00";

				$ckcondition=array("requested_time >="=>$date,'user_id'=>user_id(),"type"=>2);
				$result=$this->CommonModel->getTableData("tansation",$ckcondition)->row();

				  if($result->total_usd_amount==""){

					$usd_amo=0;

				  }else{
						$usd_amo=$result->total_usd_amount;
				  }

				  $total_amount=$usd_amo+$usd_amount;
				  $site_data=site_settings();
				  $limit=$site_data->allowd_withdrawal;
				  if($limit >= $total_amount){
					echo "success";
				  }else{
					echo "limit_exceed";
				  }
	}

	function confirm($id=""){

		if(!$this->session->userdata("user_id")){

			redirect();
		}else{

			$userdata=get_user(user_id());
			if($userdata->user_status==0 || $userdata->email_status==0){

				redirect("home/logout");
			}
		

		}


		 $id=insep_decode($id);
		$condition=array("user_id"=>user_id(),"transactionId"=>$id,"status"=>"requested");
		$trans_data=$this->CommonModel->getTableData("tansation",$condition);
		if($trans_data->num_rows()==1){

			$updateData["status"]="Pending";
		$this->CommonModel->updateTableData("tansation",$updateData,$condition);			
			

				$email_data=getEmailTeamplete(10);
					$subject=$email_data->subject;
					$template=$email_data->template;
					$site_data=site_settings();
					$sitename=$site_data->site_name;
					$trans_data=$trans_data->row();
				      $trans_data->total_amount;
				
				$data=array(
					"###TRANSID###"=>$trans_data->transactionId,			
					"###AMOUNT###"=>$trans_data->total_amount.$trans_data->currency,
					"###LOGOIMG###"=>  base_url()."assets/frontend/images/mail_logo.png",
					"###FBIMG###"=> base_url()."assets/frontend/images/facebook.png",
					"###TWIMG###"=> base_url()."assets/frontend/images/twitter.png",
					"###GPIMG###"=> base_url()."assets/frontend/images/gplus.png",
					"###LEIMG###"=> base_url()."assets/frontend/images/linkedin.png",
					"###HDIMG###"=> base_url()."assets/frontend/images/email.png",
					"###FBLINK###"=> $site_data->facebooklink,				
					"###TWLINK###"=> $site_data->twitterlink,	
					"###GPLINK###"=> $site_data->googlelink,
					"###LELINK###"=> $site_data->linkedinlink,
					"###STATUS###"=> "Pending",		
				);

			$email=get_user_email(user_id());
			$message=strtr($template,$data);		
			send_mail($email,$subject,$message);



// Admin mail
//sdsd
	
	//$admin_data=$this->CommonModel->getTableData("site_settings")->row();
		//	 $admin_email=$admin_data->contact_email;

	$condition=array("id"=>1);

	$admin_data=$this->CommonModel->getTableData("admin",$condition)->row();
	 $admin_email=$admin_data->bcc_email_id;

	$fee=$trans_data->fee;
	$currency=$trans_data->currency;
		$transamount=$trans_data->transfer_amount;
		$transid=$trans_data->transactionId;
		$amount=$trans_data->total_amount;		

		$userdata=get_user($trans_data->user_id);
		$email_data=getEmailTeamplete(11);
		$subject=$email_data->subject;
		$template=$email_data->template;	
		$sitename=$site_data->site_name;		
		$confirm_link=base_url()."BoAdmin_Transation/confirm/".insep_encode($transid);
		$cancel_link=base_url()."BoAdmin_Transation/cancel/".insep_encode($transid);
		$username=$userdata->username;
		$data=array(
					"###USERNAME###"=>$username,
					"###TRANSAMOUNT###"=>$transamount.$currency,
					"###FEE###"=>$fee.$currency,
					"###TRANSID###"=>$transid,	
					"###CONFIRM###"=>$confirm_link,
					"###CANCEL###"=>$cancel_link,
					"###AMOUNT###"=>$amount.$currency,
					"###LOGOIMG###"=>  base_url()."assets/frontend/images/mail_logo.png",
					"###FBIMG###"=> base_url()."assets/frontend/images/facebook.png",				
					"###TWIMG###"=> base_url()."assets/frontend/images/twitter.png",
					"###GPIMG###"=> base_url()."assets/frontend/images/gplus.png",
					"###LEIMG###"=> base_url()."assets/frontend/images/linkedin.png",	
					"###HDIMG###"=> base_url()."assets/frontend/images/email.png",
					"###FBLINK###"=> $site_data->facebooklink,				
					"###TWLINK###"=> $site_data->twitterlink,	
					"###GPLINK###"=> $site_data->googlelink,
					"###LELINK###"=> $site_data->linkedinlink,
					"###LOGINLINK###"=> base_url()."home/login/",		
				);

			$email=get_user_email(user_id());
			 $message=strtr($template,$data);

		
			send_mail($admin_email,$subject,$message);

		$this->session->set_flashdata("success","Withdraw request order placed successfully");
			redirect("transation/history/withdraw");
			


		}else{
			$this->session->set_flashdata("success","linvalid withdraw link");
			redirect("transation/history/withdraw");

		}	



	}

	function cancel($id=""){

		if(!$this->session->userdata("user_id")){

			redirect();
		}else{

			$userdata=get_user(user_id());
			if($userdata->user_status==0 || $userdata->email_status==0){

				redirect("home/logout");
			}
		

		}


		$id=insep_decode($id);
		$condition=array("user_id"=>user_id(),"transactionId"=>$id,"status"=>"requested");
		$trans_data=$this->CommonModel->getTableData("tansation",$condition);
		if($trans_data->num_rows()==1){
			$trans_data=$trans_data->row();
			$total_amount=$trans_data->total_amount;
			$currency=$trans_data->currency;
			$condition=array("user_id"=>user_id(), "currency_symbol"=>$currency);
			//$condition=array("user_id"=>user_id());
			$wallet=$this->CommonModel->getTableData("address_balance",$condition)->row();
			$wallet_amount=$wallet->balance;
			$credit_amount=$wallet_amount+$total_amount;
			$Wallet_update[balance]=$credit_amount;
			$updateData["status"]="Cancelled";

			$condition=array("user_id"=>user_id(),"transactionId"=>$id,"status"=>"requested");
			$this->CommonModel->updateTableData("tansation",$updateData,$condition);
			$condition=array("user_id"=>user_id(), "currency_symbol"=>$currency);
			//$condition=array("user_id"=>user_id());
			$this->CommonModel->updateTableData("address_balance",$Wallet_update,$condition);
		
				$email_data=getEmailTeamplete(10);
					$subject=$email_data->subject;
					$template=$email_data->template;
					$site_data=site_settings();
					$sitename=$site_data->site_name;		


				$data=array(

					"###TRANSID###"=>$trans_data->transactionId,	
			
					"###AMOUNT###"=>$trans_data->total_amount.$currency,	
					"###LOGOIMG###"=>  base_url()."assets/frontend/images/mail_logo.png",
					"###FBIMG###"=> base_url()."assets/frontend/images/facebook.png",				
					"###TWIMG###"=> base_url()."assets/frontend/images/twitter.png",
					"###GPIMG###"=> base_url()."assets/frontend/images/gplus.png",
					"###LEIMG###"=> base_url()."assets/frontend/images/linkedin.png",	
					"###HDIMG###"=> base_url()."assets/frontend/images/email.png",
					"###FBLINK###"=> $site_data->facebooklink,				
					"###TWLINK###"=> $site_data->twitterlink,	
					"###GPLINK###"=> $site_data->googlelink,
					"###LELINK###"=> $site_data->linkedinlink,
					"###STATUS###"=> "Cancelled",		
				);

			$email=get_user_email(user_id());
			$message=strtr($template,$data);		
			send_mail($email,$subject,$message);

			$this->session->set_flashdata("success","Withdraw request order Cancelled successfully");
			redirect("transation/history/withdraw");


		}else{

			$this->session->set_flashdata("error","Withdraw reqquest link invalid ");
			redirect("transation/history/withdraw");

			redirect();

		}	





	}

	function history(){

		$select="";
	
		if(!$this->session->userdata("user_id")){

			redirect();
		}else{

			$userdata=get_user(user_id());
			if($userdata->user_status==0 || $userdata->email_status==0){

				redirect("home/logout");
			}
		

		}

		$data="";

		$order_by=array('id','desc');

		if($this->input->post("dep_search")){
		
	
			$fromdate=$this->input->post("dep_from_date");

			$data["dep_from_date"]=$fromdate;


		$fromdate_array=explode("/",$fromdate);			
     	$fromdate=$fromdate_array[2]."-".$fromdate_array[0]."-".$fromdate_array[1]." "."00:00:00";
         $todate=$this->input->post("dep_to_date");
         $data["dep_to_date"]=$todate;
	    $todate_array=explode("/",$todate);
		    	$todate=$todate_array[2]."-".$todate_array[0]."-".$todate_array[1]." "."24:59:59";
		$condition=array("user_id"=>user_id(),"type"=>1,"requested_time >="=>$fromdate,"requested_time <="=>$todate);


		



		}else{
			$condition=array("user_id"=>user_id(),"type"=>1);
			$data["dep_from_date"]="";
			$data["dep_to_date"]="";

		}

		$data=array("type"=>1);
		$data["deposit"]=$this->CommonModel->getTableData("tansation",$condition,$order_by);

		if($this->input->post("with_search")){			

			$fromdate=$this->input->post("with_from_date");
			$data["wthdraw_from_date"]=$fromdate;
		
			$fromdate_array=explode("/",$fromdate);			
     		$fromdate=$fromdate_array[2]."-".$fromdate_array[0]."-".$fromdate_array[1]." "."00:00:00";
         	$todate=$this->input->post("with_to_date");
         		$data["withdraw_to_date"]=$todate;
	    	$todate_array=explode("/",$todate);
				
        	$todate=$todate_array[2]."-".$todate_array[0]."-".$todate_array[1]." "."24:59:59";

			//$todate=$this->input->post("with_to_date")." "."24:59:59";
			$condition=array("user_id"=>user_id(),"type"=>2,"requested_time >="=>$fromdate,"requested_time <="=>$todate);
				$order_by=array('id','asc');
					
		

			
		}else{
			$condition=array("user_id"=>user_id(),"type"=>2);
			$data["wthdraw_from_date"]="";
			$data["withdraw_to_date"]="";

			$order_by=array('id','desc');

		}

		$data["withdraw"]=$this->CommonModel->getTableData("tansation",$condition,$order_by);



		$condition=array("user_id"=>user_id());
		$order_by=array('id','desc');
		$data["reference_commission"]=$this->CommonModel->getTableData("commission_history",$condition,$order_by);


		
		$user_id=user_id();		
		$this->load->model('common_model');

	$hisjoins = array('trade_pairs as b'=>'a.pair = b.id','userdetails as c'=>'a.userId = c.user_id', 'currency as d'=>'b.from_symbol_id = d.id', 'currency as e'=>'b.to_symbol_id = e.id');



if($this->input->post("trade_search")){
	$type=$this->input->post("type");

		
		$fromdate=$this->input->post("trade_from_date");
		$data["trade_from_date"]=$fromdate;
		$fromdate_array=explode("/",$fromdate);			
     	$fromdate=$fromdate_array[2]."-".$fromdate_array[0]."-".$fromdate_array[1]." "."00:00:00";
         $todate=$this->input->post("trade_to_date");
         $data["trade_to_date"]=$todate;
	    $todate_array=explode("/",$todate);
		    	$todate=$todate_array[2]."-".$todate_array[0]."-".$todate_array[1]." "."24:59:59";


		    		$order_by_trade=array('a.tradetime', 'asc');

		    
	if($type!="all"){

		$select=$type;
		$hiswhere = array('a.userId'=>user_id(),'a.Type'=>$type,"datetime >="=>$fromdate,"datetime <="=>$todate );
			$order_by_trade=array('a.tradetime', 'asc');
	}else{
		$select="";
		$hiswhere = array('a.userId'=>user_id(),"datetime >="=>$fromdate,"datetime <="=>$todate);	


		//$this->db->order_by('datetime','asc');
		$order_by_trade=array('a.tradetime', 'asc');
	
	}

	}else{ 

	$hiswhere = array('a.userId'=>user_id());
	$this->db->order_by('datetime','asc');
	$data["trade_from_date"]="";
	$data["trade_to_date"]="";

} 
	

	$data["trade_history"] = $this->common_model->getJoinedTableData('coin_order as a',$hisjoins,$hiswhere,'a.*,b.from_symbol_id as from_currency_id, b.to_symbol_id as to_currency_id, c.username as username, d.currency_symbol as from_currency_symbol, e.currency_symbol as to_currency_symbol','','','','');


	$data["select"]=$select;

	$this->load->view("front/transation/dep_withdraw_history",$data);
	}

	function export_excel($type=""){

	if($type==1){

		$condition=array("user_id"=>user_id(),"type"=>1);
		$data["deposit"]=$this->CommonModel->getTableData("tansation",$condition);

	}else{
		$condition=array("user_id"=>user_id(),"type"=>2);
		$data["withdraw"]=$this->CommonModel->getTableData("tansation",$condition);
	}

	


		$data["type"]=$type;


		$this->load->view("front/transation/export",$data);


			


	}

	function withdraw_dep($type=""){


		 $url=base_url()."transation/export_pdf/".insep_encode(2);
		  $type=insep_decode($type);

		  if($type==1){

		  	$name="deposit_data.pdf";
		  }else{
		  	$name="withdraw_data.pdf";
		  }



		  $filename="sample.pdf";
$file= $url;
$len = filesize($file); // Calculate File Size
ob_clean();
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: public"); 
header("Content-Description: File Transfer");
header("Content-Type:application/pdf"); // Send type of file
$header="Content-Disposition: attachment; filename=$filename;"; // Send File Name
header($header );
header("Content-Transfer-Encoding: binary");
header("Content-Length: ".$len); // Send File Size
@readfile($file);
exit;





		//header("Content-disposition: attachment; filename=$name");
		//header("Content-type: application/pdf");
	   // readfile($url);
        exit;

	}

	function export_pdf($type=""){

	 $type=insep_decode($type);
	
		if($type==1 || $type==2){



		}else{

			echo "Invalid link"; 
			exit;
		}


		 $this->load->library('pdfgenerator');
		 	$order_by=array('id','desc');

		 	$user_id=user_id();
		
	if($type==1){

		$condition=array("user_id"=>$user_id,"type"=>1);
		$data["deposit"]=$this->CommonModel->getTableData("tansation",$condition,$order_by);

	}else{
		$condition=array("user_id"=>$user_id,"type"=>2);
		$data["withdraw"]=$this->CommonModel->getTableData("tansation",$condition,$order_by);

	}



		$data["type"]=$type;




		$this->load->library('pdfgenerator');


		$html = $this->load->view("front/transation/withdraw_dep_pdf",$data,true);

		$filename = 'report_'.time();
		$this->pdfgenerator->generate($html, $filename, true, 'A4', 'portrait');
	




		
	



	}

	function trade_export_excel($acc_user_id="",$type=""){


	if($acc_user_id!=""){	
		$user_id=user_id();	
	}else{
		$user_id=$acc_user_id;
	}

	$this->load->model('common_model');

	$hisjoins = array('trade_pairs as b'=>'a.pair = b.id','userdetails as c'=>'a.userId = c.user_id', 'currency as d'=>'b.from_symbol_id = d.id', 'currency as e'=>'b.to_symbol_id = e.id');
	$hiswhere = array('a.userId'=>user_id());
	$data["trade_history"] = $this->common_model->getJoinedTableData('coin_order as a',$hisjoins,$hiswhere,'a.*,b.from_symbol_id as from_currency_id, b.to_symbol_id as to_currency_id, c.username as username, d.currency_symbol as from_currency_symbol, e.currency_symbol as to_currency_symbol','','','','','',array('a.tradetime', 'DESC'));

	 $data["type"]=$type;

		$this->load->view("front/transation/trde_export",$data);


			


	}

	function export_pdf_trde($user_id=""){

	   $url=base_url()."home/download_pdf_trade/".$user_id."/pdf";	
		require("phpToPDF.php"); 
		$pdf_options = array(
		  "source_type" =>  $url,
		  "source" => $url,
		  "action" => 'download',
		  //"color" => 'monochrome',
		  "page_orientation" => 'landscape');

		// CALL THE phpToPDF FUNCTION WITH THE OPTIONS SET ABOVE
		phptopdf($pdf_options);

		exit;






	}

	function download_pdf_trade(){

     $user_id=user_id();
	$this->load->model('common_model');

	$hisjoins = array('trade_pairs as b'=>'a.pair = b.id','userdetails as c'=>'a.userId = c.user_id', 'currency as d'=>'b.from_symbol_id = d.id', 'currency as e'=>'b.to_symbol_id = e.id');
	$hiswhere = array('a.userId'=>user_id());
	$data["trade_history"] = $this->common_model->getJoinedTableData('coin_order as a',$hisjoins,$hiswhere,'a.*,b.from_symbol_id as from_currency_id, b.to_symbol_id as to_currency_id, c.username as username, d.currency_symbol as from_currency_symbol, e.currency_symbol as to_currency_symbol','','','','','',array('a.tradetime', 'DESC'));

	$data["type"]="pdf";

			
			$this->load->library('pdfgenerator');
		$html = $this->load->view("front/transation/trde_export",$data,true);
;

		$filename = 'report_'.time();
		$this->pdfgenerator->generate($html, $filename, true, 'A4', 'portrait');
	

		




	}

	function reference_download($user_id="",$type=""){
		if($user_id==""){
			$user_id=user_id();

		}
			$data["type"]=1;

		$condition=array("user_id"=>$user_id);	
		$order_by=array('id','desc');
		$data["reference_commission"]=$this->CommonModel->getTableData("commission_history",$condition,$order_by);
		
		$this->load->view("front/transation/reference_export",$data);





	}

	function reference_download_pdf(){
		$user_id=user_id();
		$data["type"]=2;

		$condition=array("user_id"=>$user_id);	
		$order_by=array('id','desc');
		$data["reference_commission"]=$this->CommonModel->getTableData("commission_history",$condition,$order_by);
		
		$this->load->view("front/transation/reference_export",$data);
	}
	
	function create_address() {
		//print_r($_POST);
		$user_id =$_POST['id'];
		$currency_symbol =$_POST['symbol'];
		
		$getadres = $this->CommonModel->getuserAddress($user_id,$currency_symbol);
		//print_r($getadres);
		if($address != null || $address != ''){
			echo json_encode($getadres);
		}else {
			echo json_encode($this->CommonModel->getaddress($user_id,$currency_symbol));
			//echo json_encode('dsfhjkdshfhljg');

		}	
	}
}