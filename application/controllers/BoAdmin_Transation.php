<?php
/**
 * BoAuthentication class
 * @category controller
 * @package Bitcocyrus
 * @subpackage modules
 * @author Osiz Technologies Pvt Ltd 
 * @link http://osiztechnologies.com/
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require "vendor/autoload.php";
use Monero\Wallet;

class BoAdmin_Transation extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$loggedUserId = $this->session->userdata('loggedJTEAdminUserID');
		
		if(isset($loggedUserId) && !empty($loggedUserId)) {


		}else{

			redirect('YfQa6hmtE8a3G2Z6Ssuf','refresh');
		}



		$this->load->library('form_validation');

		//$this->load->model('CommonModel');
		$this->load->model('BoLoginModel');
		$this->load->model("Admin_transation_model");

		$this->load->database();
		$this->load->helper('url');
		$ip 				=	$_SERVER['REMOTE_ADDR'];
		$getParticularIP 	= $this->BoLoginModel->getParticularIP($ip);
		if($getParticularIP == 1) {
			//echo '<div style="text-align: center; margin-top:50px; font-family: times new roman; font-size: 25px;  color: red;">Your IP Address Block. Contact Administrator !!! </div>'; die;
		}
	}


	function deposit($where=array()){



			$admin_id = $this->session->userdata('loggedJTEAdminUserID');
		$condition=array("admin_id"=>$admin_id);
        $admindetals=$this->CommonModel->getTableData("sub_admin_permissions",$condition)->row(); 

        if($admindetals->deposit_withdraw==0){

        	$this->session->set_flashdata("error","Access denied");
        	redirect("BoDashboard");

        }

	
		$where = array('tansation.type'=>'1');
		$data['deposits'] = $this->Admin_transation_model->get_deposit($where);
		$this->load->view("admin/transation/deposit",$data);
	


	}

	function view_deposit_detail($id=""){

		$admin_id = $this->session->userdata('loggedJTEAdminUserID');
		$condition=array("admin_id"=>$admin_id);
        $admindetals=$this->CommonModel->getTableData("sub_admin_permissions",$condition)->row(); 

        if($admindetals->deposit_withdraw==0){

        	$this->session->set_flashdata("error","Access denied");
        	redirect("BoDashboard");

        }

		$id=insep_decode($id);
		$where = array('tansation.type'=>'1','tansation.id'=>$id);
		$data['deposit'] = $this->Admin_transation_model->get_deposit($where)->row();
		$this->load->view("admin/transation/deposit_details",$data);

	}




	function withdraw($where=array()){

		$admin_id = $this->session->userdata('loggedJTEAdminUserID');
		$condition=array("admin_id"=>$admin_id);
        $admindetals=$this->CommonModel->getTableData("sub_admin_permissions",$condition)->row(); 

        if($admindetals->deposit_withdraw==0){

        	$this->session->set_flashdata("error","Access denied");
        	redirect("BoDashboard");

        }

		$where = array('tansation.type'=>'2');
		$this->db->order_by("tansation.id","desc");
		$data['withdraw'] = $this->Admin_transation_model->get_deposit($where);

		

		$this->load->view("admin/transation/withdaw",$data);
	


	}

	function view_withdraw_detail($id=""){


		$admin_id = $this->session->userdata('loggedJTEAdminUserID');
		$condition=array("admin_id"=>$admin_id);
        $admindetals=$this->CommonModel->getTableData("sub_admin_permissions",$condition)->row(); 

        if($admindetals->deposit_withdraw==0){

        	$this->session->set_flashdata("error","Access denied");
        	redirect("BoDashboard");

        }

	

		$id=insep_decode($id);
		$where = array('tansation.type'=>'2','tansation.transactionId'=>$id);
		$data['withdraw'] = $this->Admin_transation_model->get_deposit($where)->row();
		$this->load->view("admin/transation/withdraw_details",$data);

	}




	function withdraw_profit($currency=""){

		$admin_id = $this->session->userdata('loggedJTEAdminUserID');
		$condition=array("admin_id"=>$admin_id);
        $admindetals=$this->CommonModel->getTableData("sub_admin_permissions",$condition)->row(); 

        if($admindetals->deposit_withdraw==0){

        	$this->session->set_flashdata("error","Access denied");
        	redirect("BoDashboard");

        }

	

		

		$where = array('tansation.type'=>'2','tansation.currency'=>$currency);
		$data['withdraw'] = $this->Admin_transation_model->get_deposit($where);
		$data['currency']=$this->CommonModel->getTableData("currency");
		$data['selected_currency']=$currency;
	
		$this->load->view("admin/transation/withdaw_profit",$data);
	


	}

	function confirm($id=""){
		/*$currency="BTC";

		$data=get_cn_data($currency);
			$bitcoin_username 		= insep_decode($data['user']);	
			$bitcoin_password 		= insep_decode($data['password']);
			$bitcoin_ipaddress 	= insep_decode($data['ip']);	
			$bitcoin_portnumber = insep_decode($data['port']);


  			require_once("jsonRPCClient.php");
			$bitcoin 	= new jsonRPCClient("http://$bitcoin_username:$bitcoin_password@$bitcoin_ipaddress:$bitcoin_portnumber");		*/
   			//$bitcoin_isvalid         =     $bitcoin->listtransactions();

   			/*$bal=$bitcoin->getbalance();*/

 

		$id=insep_decode($id);
		$condition=array("transactionId"=>$id,"status"=>"Pending");
		$transdata=$this->CommonModel->getTableData("tansation",$condition);
		if($transdata->num_rows() >0){		


        if($this->input->post("witdraw_submit")){  


       		$currecncy=$transdata->row()->currency;
       	 	$currency=$transdata->row()->currency;
       

       	if($currency=="BTC"){

       		$txn_id=$this->transfer_coin("BTC",$transdata);


       	}else if($currency=="LTC"){ 

       		$txn_id=$this->transfer_coin("LTC",$transdata);

       	}else if($currency=="DGB"){ 

       		$txn_id=$this->transfer_coin("DGB",$transdata);

       	}else if($currency=="DASH"){ 

       		$txn_id=$this->transfer_coin("DASH",$transdata);

       	}else if($currency=="ETH"){
       		$txn_id=$this->transfer_eth("ETH",$transdata);

       	}else if($currency=="XRP"){

       		$txn_id=$this->transfer_xrp($transdata);

       	} else if($currency=="BTG"){

       		$txn_id=$this->transfer_coin("BTG",$transdata);

       	}
		else if($currency=="BCH"){

       		$txn_id=$this->transfer_coin("BCH",$transdata);

       	}
		else if($currency=="ETC"){

       		$txn_id=$this->transfer_etc("ETC",$transdata);

       	}else if($currency=="XMR"){

       	 	$txn_id=$this->transfer_xmr($transdata);

       	}
		       	
       		$status="Success";

       		if($status=="Success"){

				$transdata=$transdata->row();
				$currecncy=$transdata->currency;
				$amount=$transdata->total_amount;
				$update["status"]="Completed";
				$update["transation_hash"]=$txn_id;
				$this->CommonModel->updateTableData("tansation",$update,$condition);
				$email_data=getEmailTeamplete(10);
				$subject=$email_data->subject;
				$template=$email_data->template;
				$site_data=site_settings();
				$sitename=$site_data->site_name;
				$trans_data=$transdata;
		     	 $trans_data->total_amount;					
					$data=array(
						"###TRANSID###"=>$trans_data->transactionId,			
						"###AMOUNT###"=>$trans_data->total_amount.$trans_data->currency,
						"###LOGOIMG###"=>  base_url()."assets/frontend/images/mail_logo.png",
						"###FBIMG###"=> base_url()."assets/frontend/images/facebook.png",				
						
						"###STATUS###"=> "Completed",		
					);
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
				$email=get_user_email($trans_data->user_id);
				 $message=strtr($template,$data);		
				send_mail($email,$subject,$message);
				$this->session->set_flashdata("success","Withdraw request Completed successfully");		
				redirect("BoAdmin_Transation/withdraw");

			}else{


				$this->session->set_flashdata("error","Withdraw request error, Tray again after some time");		

				redirect("BoAdmin_Transation/withdraw");

			}

		}else{

			$transdata=$transdata->row();
			$user_id=$transdata->user_id;
			$condition=array("user_id"=>$user_id);
			$userdata=$this->CommonModel->getTableData("userdetails",$condition)->row();	
			$data['withdraw']=$transdata;	

			 $data['user_name']=$userdata->username;		
			
			$this->load->view("admin/transation/withdaw_request_details",$data);	

		}


		}else{

			$this->session->set_flashdata("error","Invalid link or already used link");		
	
			redirect("BoAdmin_Transation/withdraw");

		}





	}

	function get_currancy_address($currancy){

	 $condition=array("admin_id"=>1,"currency_symbol"=>$currancy);
	 $address 		= $this->CommonModel->getTableData("admin_address",$condition)->row();

	 return $address->address;
	}




	function transfer_coin($currency="",$transdata){

		     $data=get_cn_data($currency);
			$bitcoin_username 		= insep_decode($data['user']);	
			$bitcoin_password 		= insep_decode($data['password']);
			$bitcoin_ipaddress 	= insep_decode($data['ip']);	
			$bitcoin_portnumber = insep_decode($data['port']);
  			include("jsonRPCClient.php");

  			//echo "http://$bitcoin_username:$bitcoin_password@$bitcoin_ipaddress:$bitcoin_portnumber" ;
			
   			$amountdata=$transdata->row();
   			$amountdata=$transdata->row();
       		$to_amount=$amountdata->transfer_amount;
       		$to_address=$amountdata->to_address;
   			//if($bal>$to_amount){  
	       		/*$data=get_cn_data($currency);
				$bitcoin_username 		= insep_decode($data['user']);	
				$bitcoin_password 		= insep_decode($data['password']);
				$bitcoin_ipaddress 	= insep_decode($data['ip']);	
				$bitcoin_portnumber = insep_decode($data['port']);
				*/

	       		$url 	= "http://$bitcoin_username:$bitcoin_password@$bitcoin_ipaddress:$bitcoin_portnumber";
	           $password=trim($this->input->post("password"));
				$post = array(
							'secret' => 'error',
							'method' => 'walletpassphrase',
							'params'=> array($password,12),
						);
				$check_wallet = request_coiiinnn($post,$url);			
				$status=$check_wallet['status'];
			if($status != 'error'){	

				$bitcoin 	= new jsonRPCClient("http://$bitcoin_username:$bitcoin_password@$bitcoin_ipaddress:$bitcoin_portnumber");
   				   $bal=$bitcoin->getinfo();

				
					 $txn_id       = 	$bitcoin->sendtoaddress($to_address,(float)$to_amount);
					 $bitcoin->walletlock();
					 return  $txn_id;

					
				
			}
			else
			{	
				
				$error_message=$check_wallet['message'];
				if($error_message!=null && preg_match("/Wallet is already unlocked/", $error_message))
				{
					$bitcoin 	= new jsonRPCClient("http://$bitcoin_username:$bitcoin_password@$bitcoin_ipaddress:$bitcoin_portnumber");
					$bitcoin->walletlock();
				}
				$this->session->set_flashdata("error",$error_message."Withdraw request password error, Tray again after some time");
				redirect("BoAdmin_Transation/withdraw");		


			}
		//}

	}


	// New coin added 21-Jun-18 Pratik

	function transfer_eth($currency="",$transdata){


       		$bitcoin_row 		= get_cn_data($currency);
			$bitcoin_portnumber = insep_decode($bitcoin_row["port"]);
			$bitcoin_ipaddress 	= insep_decode($bitcoin_row["ip"]);	
			 $adminEthAddr 		= $this->get_currancy_address($currency);			
		

			
   			$amountdata=$transdata->row();
       		$sendAmount=$amountdata->transfer_amount;
       		$currencyToAddress=$amountdata->to_address;
       		$key=trim($this->input->post("password"));

			$data1 	    = array('port'=>$bitcoin_portnumber,'from'=>$adminEthAddr,'sendaddress'=>$currencyToAddress,'withdraw_amount'=>$sendAmount,'keyword' => '98543423','name'=>'bitcocyrus.com','key'=>$key,'method'=>'ethwithdraw');
			$output     = connecteth('ethwithdraw',$data1);

		
				 $txn_id 	= $output->result;
					if($output->type == 'success') {
						if($txn_id != '') {
							return $txn_id;
						}else{
							$this->session->set_flashdata("error",$output);
								redirect("BoAdmin_Transation/withdraw");		

						}

					}else
					{
							$this->session->set_flashdata("error",$output);
								redirect("BoAdmin_Transation/withdraw");	

			}

	}


	function transfer_etc($currency="",$transdata){


       		$bitcoin_row 		= get_cn_data($currency);
			$bitcoin_portnumber = insep_decode($bitcoin_row["port"]);
			$bitcoin_ipaddress 	= insep_decode($bitcoin_row["ip"]);	
			 $adminEthAddr 		= $this->get_currancy_address($currency);			

			$amountdata=$transdata->row();
   			$amountdata=$transdata->row();
       		$sendAmount=$amountdata->transfer_amount;
       		$currencyToAddress=$amountdata->to_address;
       		 $key=trim($this->input->post("password"));

			$data1 	    = array('port'=>$bitcoin_portnumber,'from'=>$adminEthAddr,'sendaddress'=>$currencyToAddress,'withdraw_amount'=>$sendAmount,'keyword' => '98543423','name'=>'bitcocyrus.com','key'=>$key,'method'=>'ethwithdraw');
			$output     = connectetc('ethwithdraw',$data1);	
		
				 $txn_id 	= $output->result;
					if($output->type == 'success') {
						if($txn_id != '') {
							return $txn_id;
						}else{
							$this->session->set_flashdata("error",$output);
								redirect("BoAdmin_Transation/withdraw");		

						}

					}else
					{
							$this->session->set_flashdata("error",$output);
								redirect("BoAdmin_Transation/withdraw");	
			}

	}


	function transfer_xrp($transdata){	

		$currency="XRP";	
   		$amountdata=$transdata->row();
       	$amount=$amountdata->transfer_amount;
       	$to_address=$amountdata->to_address;
       	 $tag=$amountdata->xrp_tag;
      	 $from_address 		= $this->get_currancy_address($currency);
      	 $from_secret=trim($this->input->post("password"));
      	 $this->wallet_dir 	= FCPATH.'ripple';
		 $this->node_dir 	= '/usr/bin/node';
			$result = exec('cd '.$this->wallet_dir.'; '.$this->node_dir.' xrp_sent_withdrwal.js "'.$from_address.'" "'.$from_secret.'" "'.$to_address.'" "'.$amount.'" "'.$tag.'"',$output,$return_var);



     		 if(isset($output[2])) {
						$rem = json_decode($output[2]);					

						if($rem->resultCode == "tesSUCCESS") {
							$res = json_decode($output[1]);
							//return $res->txid;
							 return $txn_id = $res->txid;
							
							
							if($txn_id) {

								return $txn_id;
								
							}else{
								$this->session->set_flashdata("error","Transation faild,Try agin some other time".$output[2]);
								redirect("BoAdmin_Transation/withdraw");	
									
							}
						}else{

							$this->session->set_flashdata("error","Transation faild,Try agin some other time".$output[2]);
								redirect("BoAdmin_Transation/withdraw");	
						}


					}else{

						$this->session->set_flashdata("error","Transation faild,Try agin some other time".$output[2]);
								redirect("BoAdmin_Transation/withdraw");	
					}

	}




	function transfer_xmr($transdata){		
   		$amountdata=$transdata->row();
       	$amount=$amountdata->transfer_amount;
       	$to_address=$amountdata->to_address;
       	$payment_id=$amountdata->payment_id;
      
      	 $from_secret=trim($this->input->post("password"));


      	  $data=get_cn_data("XMR");
			$wallet = new Monero\Wallet();
			$hostname =insep_decode($data["ip"]);
			$port = insep_decode($data["port"]);;	
			$wallet = new Monero\Wallet($hostname, $port);


			$options = [
    		'destinations' => (object) [
       		'amount' => $amount,
        	
        	'address' => trim($to_address)
   					 ],'payment_id'=>trim($payment_id),
			];
			


			/*echo $url=$hostname.":".$port;
			
			exit;
			xmr_request("transfer",$options,$url);*/




		if($from_secret=="bitcocyrusxmr"){	

			//$condition=array("XMR"=>$to_address,'payment_id'=>$payment_id);
			//$userdata=$this->CommonModel->getTableData('address',$condition);

			$currancy ="XMR";
			$condition=array("address"=>$to_address,'payment_id'=>$payment_id);
			$userdata=$this->CommonModel->getTableData('address_balance',$condition);

			if($userdata->num_rows()==1){

			$userdata=$userdata->row();
				$user_id=$userdata->user_id;

				$condition=array("user_id"=>$user_id,"currency_symbol"=>$currancy);
				$wallet_balance=$this->CommonModel->getTableData("address_balance",$condition)->row();
			
				$updateBTCbalance     = $wallet_balance->balance + $amount;// insert data into transaction history
				 // for Update current coin balance
				$condition=array("user_id"=>$user_id,"currency_symbol"=>$currancy);
				$this->db->where($condition);
				$this->db->update('address_balance',array('balance'=>$updateBTCbalance));

				//echo $this->db->last_query();

				$tax_id=md5(time());
				$userdata = array(
					           'user_id' => $user_id,
					           'type'=>1,
					           'currency' => "XMR",	                  
					           'total_amount' => $amount,
					           'status' => "Completed",
					            'transactionId'=>$tax_id
		            		); 


							$this->db->insert('tansation',$userdata);

				return $tax_id;

			}



			$balance = $wallet->getBalance();




		$resonse = $wallet->transfer($options);			
		$res=json_decode($resonse);




	    if($res->tx_hash) {
			return $res->tx_hash;
		}else{
			$this->session->set_flashdata("error","Transation faild,Try agin some other time(".$res->message.")");
				redirect("BoAdmin_Transation/withdraw");	
		}
	}else{

		$this->session->set_flashdata("error","Invalid password");
				redirect("BoAdmin_Transation/withdraw");
	}
				


	}



	function cancel($id){
		$id=insep_decode($id);
		$condition=array("transactionId"=>$id,"status"=>"Pending");
		$transdata=$this->CommonModel->getTableData("tansation",$condition);

		if($transdata->num_rows() >0){
			$transdata=$transdata->row();
			$currecncy=$transdata->currency;
			$amount=$transdata->total_amount;
			$user_id=$transdata->user_id;
			$update["status"]="Rejected";
			$this->CommonModel->updateTableData("tansation",$update,$condition);

			$condition=array("user_id"=>$user_id,"currency_symbol"=>$currecncy);
			$walletdata=$this->CommonModel->getTableData("address_balance",$condition)->row();
			$reamount=$walletdata->balance+$amount;
			$wallet_update[balance]=$reamount;
			$this->CommonModel->updateTableData("address_balance",$wallet_update,$condition);
			$email_data=getEmailTeamplete(10);
					$subject=$email_data->subject;
					$template=$email_data->template;
					$site_data=site_settings();
					$sitename=$site_data->site_name;
					$trans_data=$transdata;
				      $trans_data->total_amount;
				
				$data=array(
					"###TRANSID###"=>$trans_data->transactionId,			
					"###AMOUNT###"=>$trans_data->total_amount.$trans_data->currency,			
					"###STATUS###"=> "Rejected",		
				);

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

			$email=get_user_email($trans_data->user_id);
			 $message=strtr($template,$data);		
			send_mail($email,$subject,$message);

			$this->session->set_flashdata("success","Withdraw rejected successfully");
		

			redirect("BoAdmin_Transation/withdraw");

		}else{

		$this->session->set_flashdata("error","Invalid link or already used link");			redirect("BoAdmin_Transation/withdraw");

		}

	}



function referal_commission(){
	
	if($this->input->post("Update")){
		$updateTableData['referal_commission']=$this->input->post("commission");

		$this->CommonModel->updateTableData("site_settings",$updateTableData,array("id"=>1));


		$insert["commission"]=$this->input->post("commission");
		$this->CommonModel->addTableData("commission_setting_history",$insert);

		$this->session->set_flashdata("success","Referal commission updated successfully");

		redirect("BoAdmin_Transation/referal_commission");


	}else{

		$site_settings=$this->CommonModel->getTableData("site_settings")->row();
		
		$this->db->order_by("id","desc");


		$data["referral_commission"]=$this->CommonModel->getTableData("commission_setting_history");

		$data['commission']=$site_settings->referal_commission;
		$this->load->view("admin/transation/referal_commission",$data);
	}	
}



function withdraw_limit(){
	
	if($this->input->post("Update")){
		$updateTableData['allowd_withdrawal']=$this->input->post("withdraw_limit");

		$this->CommonModel->updateTableData("site_settings",$updateTableData,array("id"=>1));


		

		$this->session->set_flashdata("success","Withdraw limit updated successfully");

		redirect("BoAdmin_Transation/withdraw_limit");


	}else{

		$site_settings=$this->CommonModel->getTableData("site_settings")->row();
		
		//$this->db->order_by("id","desc");


		//$data["referral_commission"]=$this->CommonModel->getTableData("commission_setting_history");

		$data['withdraw_limit']=$site_settings->allowd_withdrawal;
		$this->load->view("admin/transation/withdraw_limit",$data);
	}	
}


function referal_commission_history(){
	
		$this->load->model('common_model');
		$hisjoins = array('userdetails as u'=>'c.user_id = u.user_id');

		$this->db->join('userdetails', 'userdetails.user_id = commission_history.user_id');
		
		$data['reference_commission'] = $this->CommonModel->getTableData('commission_history');


		$this->load->view("admin/transation/referal_commission_history",$data);
	
}

}
