<?php
/**
 * BoAdminWalletDeposit class
 * @category controller
 * @package Coin control
 * @subpackage modules
 * @author Adsum Originator LLP
 * @link http://adsumoriginator.com/
 */

defined('BASEPATH') OR exit('No direct script access allowed');
require "vendor/autoload.php";
use Monero\Wallet;


class BoAdminWalletDeposit extends CI_Controller {
	public function __construct() {
		// require_once 'jsonRPCClient.php';
		parent::__construct();
		$this->load->library('session');
		$this->load->library('form_validation');		
		$this->load->database();
		$this->load->helper('url');
		$this->load->model('common_model');
	}	



	
	

	public function deposit($currencySymbol="") {

	include("jsonRPCClient.php");
		
		
		
		$site=site_details();

		$condition=array("admin_id"=>1,"currency_symbol"=>$currencySymbol);
		$this->db->where($condition);
		$walletdetails=$this->common_model->getTableData("admin_address")->row();





		$loggedwalletuserid = $this->session->userdata('loggedwalletuserid');

		if(isset($loggedwalletuserid) && !empty($loggedwalletuserid)) {			
			
			$siteDetails 				= $this->Wallet_model->getTableData(SETTINGS,array('id'=>1))->row_array();			
			// BTC


		if($currencySymbol!=""){	


			if($currencySymbol == 'BTC' || $currencySymbol == 'BCH' || $currencySymbol == 'LTC' || $currencySymbol == 'DASH' || $currencySymbol == 'DGB' || $currencySymbol == 'BTG' || $currencySymbol == 'XVG'){

			$cdata=get_cn_data($currencySymbol);

			 $bitcoin_username 		= insep_decode($cdata['user']);	
			 $bitcoin_password 		= insep_decode($cdata['password']);
			 $bitcoin_ipaddress 	= insep_decode($cdata['ip']);	
			 $bitcoin_portnumber = insep_decode($cdata['port']);			
			

			$bitcoin 				= new jsonRPCClient("http://$bitcoin_username:$bitcoin_password@$bitcoin_ipaddress:$bitcoin_portnumber");
				
			$getinfo    			= $bitcoin->getinfo();
			 $data['adminBalance'] 	= $getinfo['balance'];	


		

	
			   $checkAddress = $walletdetails->address;
			   $data['currencySymbol'] = $currencySymbol;
			   $rootUrl 			= "https://chart.googleapis.com/chart?cht=qr&chs=250x250&chl=$checkAddress&choe=UTF-8&chld=L";

				$data['checkAddress'] 	= $checkAddress;
				

				// $this->load->view('admin_wallet/BoAdminWalletDeposit/viewDeposit',$data);
			

			}else if($currencySymbol == "USDT") { 	
			

				//$this->load->view('admin_wallet/BoAdminWalletDeposit/viewDeposit',$data);

			  $cdata=get_cn_data($currencySymbol);

			 $bitcoin_username 		= insep_decode($cdata['user']);	
			 $bitcoin_password 		= insep_decode($cdata['password']);
			 $bitcoin_ipaddress 	= insep_decode($cdata['ip']);	
			 $bitcoin_portnumber = insep_decode($cdata['port']);			
			

			$bitcoin 				= new jsonRPCClient("http://$bitcoin_username:$bitcoin_password@$bitcoin_ipaddress:$bitcoin_portnumber");
				
			
			 
			  $checkAddress = $walletdetails->address;

			//  $data['adminBalance']=$bitcoin->omni_getbalance($checkAddress,31);
			  $data['currencySymbol'] = $currencySymbol;
			  $rootUrl 			= "https://chart.googleapis.com/chart?cht=qr&chs=250x250&chl=$checkAddress&choe=UTF-8&chld=L";

			 $data['checkAddress'] 	= $checkAddress;


			 	// $usdt_address=$admindata->usdt_address;
			
			 $bal=$bitcoin->omni_getbalance($checkAddress,31);

						
			$data['adminBalance'] 	= $bal["balance"];;		



			}else if($currencySymbol == "XRP") { 	
			

				//$this->load->view('admin_wallet/BoAdminWalletDeposit/viewDeposit',$data);

		 	  $checkAddress = $walletdetails->address;



				$url = "https://data.ripple.com/v2/accounts/" . $checkAddress . "/balances?currency=XRP";
				$cObj = curl_init();
				curl_setopt($cObj, CURLOPT_URL, $url);
				curl_setopt($cObj, CURLOPT_SSL_VERIFYHOST, 0);
				curl_setopt($cObj, CURLOPT_SSL_VERIFYPEER, 0);
				curl_setopt($cObj, CURLOPT_RETURNTRANSFER, TRUE);
				$output = curl_exec($cObj);
				$curlinfos = curl_getinfo($cObj);
				$result = json_decode($output);
				$xrp_balance=$result->balances[0]->value;
				$data['adminBalance'] = $xrp_balance;




			}
			else if($currencySymbol == "XMR") { 	
			

				//$this->load->view('admin_wallet/BoAdminWalletDeposit/viewDeposit',$data);

				


			  $data=get_cn_data($currencySymbol);
		$wallet = new Monero\Wallet();
		$hostname =insep_decode($data["ip"]);
		$port = insep_decode($data["port"]);;
	
		$wallet = new Monero\Wallet($hostname, $port);

		$xmrbalance = $wallet->getBalance();

		$xmrbalance=json_decode($xmrbalance,TRUE);
	
		


			$data['adminBalance'] = $xmrbalance["balance"]/1000000000000;; 





			  $checkAddress = $walletdetails->address;
			 
			  $data['currencySymbol'] = $currencySymbol;
			  $rootUrl 			= "https://chart.googleapis.com/chart?cht=qr&chs=250x250&chl=$checkAddress&choe=UTF-8&chld=L";

			 $data['checkAddress'] 	= $checkAddress;	 


			 $payment_id = $walletdetails->xmr_paymentid;
			 $data['payment_id'] 	= $payment_id;
			
			



			}else if($currencySymbol == "ETC") { 	
			

				//$this->load->view('admin_wallet/BoAdminWalletDeposit/viewDeposit',$data);

			  //$data['adminBalance'] 	= 0;	
			  $checkAddress = $walletdetails->address;
			  $data['currencySymbol'] = $currencySymbol;
			  $rootUrl 			= "https://chart.googleapis.com/chart?cht=qr&chs=250x250&chl=$checkAddress&choe=UTF-8&chld=L";

			 $data['checkAddress'] 	= $checkAddress;



			 	$output = file_get_contents('https://api.gastracker.io/addr/'.$checkAddress);
			$eresult=json_decode($output,TRUE);
			$data['adminBalance'] = $eresult["balance"]["ether"];
		


			}



			else if($currencySymbol == "TRX") { 				

				
			  $data['adminBalance'] 	= 0;	
			  $checkAddress = $walletdetails->address;
			 

					$contractAddr = "0xf230b790e05390fc8295f4d3f60332c93bed42e2";	

		        		$getNtcBalance = getContents('https://api.etherscan.io/api?module=account&action=tokenbalance&contractaddress='.$contractAddr.'&address='.$checkAddress.'&tag=latest');
		        		$decodeECH = json_decode($getNtcBalance,true);



		        		$output = file_get_contents('https://api.etherscan.io/api?module=account&action=balance&address='.$checkAddress.'&tag=latest');
					$result = json_decode($output,TRUE);

					if($result["message"]=="OK"){

						$amount=$result["result"];
						 $amount=$amount/1000000000000000000;

								 $data['ethBalance'] 	= $amount;	
					}else{


					 $data['ethBalance'] 	= 0;	
					}		


		        	

		        		$result = $decodeECH['result'];
		        		$balance = $result/1000000;

		        		 $data['adminBalance']=$balance;
			 		$data['checkAddress'] 	= $checkAddress;
			
			}else if($currencySymbol == "EOS") { 				

				
			  $data['adminBalance'] 	= 0;	
			  $checkAddress = $walletdetails->address;
			 

					$contractAddr = "0x86Fa049857E0209aa7D9e616F7eb3b3B78ECfdb0";	

		        		$getNtcBalance = getContents('https://api.etherscan.io/api?module=account&action=tokenbalance&contractaddress='.$contractAddr.'&address='.$checkAddress.'&tag=latest');
		        		$decodeECH = json_decode($getNtcBalance,true);

       		

		        	

		        		$result = $decodeECH['result'];
		        		$balance = $result/1000000000000000000;

		        		 $data['adminBalance']=$balance;
			 		$data['checkAddress'] 	= $checkAddress;


			 		$output = file_get_contents('https://api.etherscan.io/api?module=account&action=balance&address='.$checkAddress.'&tag=latest');
					$result = json_decode($output,TRUE);

					if($result["message"]=="OK"){

						$amount=$result["result"];
						 $amount=$amount/1000000000000000000;

								 $data['ethBalance'] 	= $amount;	
					}else{


					 $data['ethBalance'] 	= 0;	
					}		



			
			}
			else if($currencySymbol == "NPXS") { 				

				
			  $data['adminBalance'] 	= 0;	
			  $checkAddress = $walletdetails->address;
			 

					$contractAddr = "0xa15c7ebe1f07caf6bff097d8a589fb8ac49ae5b3";	

		        		$getNtcBalance = getContents('https://api.etherscan.io/api?module=account&action=tokenbalance&contractaddress='.$contractAddr.'&address='.$checkAddress.'&tag=latest');
		        		$decodeECH = json_decode($getNtcBalance,true);

       		

		        	

		        		$result = $decodeECH['result'];
		        		$balance = $result/1000000000000000000;

		        		 $data['adminBalance']=$balance;
			 		$data['checkAddress'] 	= $checkAddress;


			 		$output = file_get_contents('https://api.etherscan.io/api?module=account&action=balance&address='.$checkAddress.'&tag=latest');
					$result = json_decode($output,TRUE);

					if($result["message"]=="OK"){

						$amount=$result["result"];
						 $amount=$amount/1000000000000000000;

								 $data['ethBalance'] 	= $amount;	
					}else{


					 $data['ethBalance'] 	= 0;	
					}		



			
			}
				else if($currencySymbol == "IOST") { 				

				
			  $data['adminBalance'] 	= 0;	
			  $checkAddress = $walletdetails->address;
			 

					$contractAddr = "0xfa1a856cfa3409cfa145fa4e20eb270df3eb21ab";	

		        		$getNtcBalance = getContents('https://api.etherscan.io/api?module=account&action=tokenbalance&contractaddress='.$contractAddr.'&address='.$checkAddress.'&tag=latest');
		        		$decodeECH = json_decode($getNtcBalance,true);

       		

		        	

		        		$result = $decodeECH['result'];
		        		$balance = $result/1000000000000000000;

		        		 $data['adminBalance']=$balance;
			 		$data['checkAddress'] 	= $checkAddress;


			 		$output = file_get_contents('https://api.etherscan.io/api?module=account&action=balance&address='.$checkAddress.'&tag=latest');
					$result = json_decode($output,TRUE);

					if($result["message"]=="OK"){

						$amount=$result["result"];
						 $amount=$amount/1000000000000000000;

								 $data['ethBalance'] 	= $amount;	
					}else{


					 $data['ethBalance'] 	= 0;	
					}		


			}
			// New coin added 21-Jun-18 Pratik
			else if($currencySymbol == "OMG") {	
			  	$data['adminBalance'] 	= 0;	
			  	$checkAddress = $walletdetails->address;
			 	$contractAddr = "0xd26114cd6EE289AccF82350c8d8487fedB8A0C07";	
        		$getNtcBalance = getContents('https://api.etherscan.io/api?module=account&action=tokenbalance&contractaddress='.$contractAddr.'&address='.$checkAddress.'&tag=latest');
        		$decodeECH = json_decode($getNtcBalance,true);
        		$result = $decodeECH['result'];
        		$balance = $result/1000000000000000000;
        		$data['adminBalance']=$balance;
		 		$data['checkAddress'] 	= $checkAddress;
		 		$output = file_get_contents('https://api.etherscan.io/api?module=account&action=balance&address='.$checkAddress.'&tag=latest');
				$result = json_decode($output,TRUE);

				if($result["message"]=="OK"){
					 $amount=$result["result"];
					 $amount=$amount/1000000000000000000;
					 $data['ethBalance'] 	= $amount;	
				}else{
					 $data['ethBalance'] 	= 0;	
				}		
			}

			else if($currencySymbol == "ZRX") {	
			  	$data['adminBalance'] 	= 0;	
			  	$checkAddress = $walletdetails->address;
			 	$contractAddr = "0xe41d2489571d322189246dafa5ebde1f4699f498";	
        		$getNtcBalance = getContents('https://api.etherscan.io/api?module=account&action=tokenbalance&contractaddress='.$contractAddr.'&address='.$checkAddress.'&tag=latest');
        		$decodeECH = json_decode($getNtcBalance,true);
        		$result = $decodeECH['result'];
        		$balance = $result/1000000000000000000;
        		 $data['adminBalance']=$balance;
		 		$data['checkAddress'] 	= $checkAddress;
		 		$output = file_get_contents('https://api.etherscan.io/api?module=account&action=balance&address='.$checkAddress.'&tag=latest');
				$result = json_decode($output,TRUE);

				if($result["message"]=="OK"){
					$amount=$result["result"];
					 $amount=$amount/1000000000000000000;
					 $data['ethBalance'] 	= $amount;	
				}else{
					 $data['ethBalance'] 	= 0;	
				}		
			}
			// New coin added 21-Jun-18 Pratik

		else if($currencySymbol == "ETH") { 				

			$data['adminBalance'] 	= 0;	
			  $checkAddress = $walletdetails->address;

				$output = file_get_contents('https://api.etherscan.io/api?module=account&action=balance&address='.$checkAddress.'&tag=latest');
					$result = json_decode($output,TRUE);

					if($result["message"]=="OK"){

						$amount=$result["result"];
						 $amount=$amount/1000000000000000000;

								 $data['adminBalance'] 	= $amount;	
					}else{


					 $data['adminBalance'] 	= 0;	
					}		

				}else{

					$data['adminBalance'] 	= 0;
				}	

	/*
			    $checkAddress_eth = $siteDetails['eth_address'];
				
	    		$url= "https://api.etherscan.io/api?module=account&action=balance&address=".$checkAddress_eth."&tag=latest";
				$arrContextOptions=array(
					"ssl"=>array(
					"verify_peer"=>false,
					"verify_peer_name"=>false,
					),
				);  
				$return = file_get_contents($url, false, stream_context_create($arrContextOptions));
				$ethd=json_decode($return,"TRUE");
				$eth=$ethd['result']/1000000000000000000;

				*/




				
			 
			  
			   $data['currencySymbol'] = $currencySymbol;
			   $rootUrl 			= "https://chart.googleapis.com/chart?cht=qr&chs=250x250&chl=$checkAddress&choe=UTF-8&chld=L";
				$data["all_currency"]=$this->CommonModel->getTableData("currency");
				$data['checkAddress'] 	= $checkAddress;
				$data['rootUrl'] 		= $rootUrl;
				$data['siteName'] 		= $siteDetails['site_name'];
				$data['copyRight'] 		= date('Y');
				$data['copySiteTitle'] 	= $siteDetails['site_name']." Admin";
				$data['title'] 			= "BTC Deposit | ".$siteDetails['site_name'];
				$data['keywords'] 		= " Deposit | ".$siteDetails['site_name'];
				$data['description'] 	= " Deposit | ".$siteDetails['site_name'];	

				
				
				
			
			$this->load->view('admin_wallet/BoAdminWalletDeposit/viewDeposit',$data);

		}





			else {
				wallet_redirect('BoDashboard','refresh');
			}
		}
		else {
			wallet_redirect('BoDashboard','refresh');
		}
	}



function eth_address(){
		
	


		 $data=get_cn_data("ETH");
  //echo  $bitcoin_ip 	= insep_decode($data['ip']) dfd;
		 $bitcoin_portnumber = insep_decode($data['port']);		
		$data1 		   			= array('key'=>'bitccocyrus','port'=>$bitcoin_portnumber);
		$output 	   			= connecteth('create',$data1);
		//$res 					= json_decode($output->result);
		//$getETHAddress 			= $res->result;
		print_r($output->result);
			exit;




	}


function etc_address(){
		
		 $data=get_cn_data("ETC");
  //echo  $bitcoin_ip 	= insep_decode($data['ip']) dfd;
		 $bitcoin_portnumber = insep_decode($data['port']);		
		$data1 		   			= array('key'=>'bitccocyrus','port'=>$bitcoin_portnumber);
		$output 	   			= connectetc('create',$data1);
		//$res 					= json_decode($output->result);
		//$getETHAddress 			= $res->result;
			print_r($output->result);
			exit;




	}



function xrp_address(){


		 $this->wallet_dir 	= FCPATH.'ripple';
		$this->node_dir 	= '/usr/bin/node';
		
		 	$result = exec('cd '.$this->wallet_dir.'; '.$this->node_dir.' ripple.js '.'', $this->output, $this->return_var);

		 	$result=json_decode($result);
			 	echo $address=$result->address;

			 	echo $result->secret;
			 	exit;


			 //$this->output[0];


			exit;




	}




}
?>
