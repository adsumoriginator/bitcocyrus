<?php
/*defined('BASEPATH') OR exit('No direct script access allowed');
require "vendor/autoload.php";
use Monero\Wallet;*/

/**
 * BoDashboard class
 * @category controller
 * @package ICO Suisse
 * @subpackage modules
 * @author Adsum Originator LLP
 * @link http://adsumoriginator.com/
 */
	require "vendor/autoload.php";
	use Monero\Wallet;
class BoDashboard extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->library('form_validation');				
		$this->load->database();
		$this->load->model('BoLoginModel');		
		$this->load->helper('url');
	}
	
	
	
	public function getadminbalance($currency,$address){
	
		include_once("jsonRPCClient.php");
			
			
		if($currency == 'BTC' || $currency == 'BCH' || $currency == 'LTC' || $currency == 'DASH' || $currency == 'DGB' || $currency == 'BTG' || $currency == 'XVG'){
			
			$data=get_cn_data($currency);
			$bitcoin_username 		= insep_decode($data['user']);	
			$bitcoin_password 		= insep_decode($data['password']);
			$bitcoin_ipaddress 	= insep_decode($data['ip']);	
			$bitcoin_portnumber = insep_decode($data['port']);
			$bitcoin 	= new jsonRPCClient("http://$bitcoin_username:$bitcoin_password@$bitcoin_ipaddress:$bitcoin_portnumber");
   			$bal=$bitcoin->getbalance(); 
			return $bal;
		}
		else if($currency == 'USDT'){
			$data=get_cn_data("USDT");
			$bitcoin_username 		= insep_decode($data['user']);	
			$bitcoin_password 		= insep_decode($data['password']);
			$bitcoin_ipaddress 	= insep_decode($data['ip']);	
			$bitcoin_portnumber = insep_decode($data['port']);
			$bitcoin 	= new jsonRPCClient("http://$bitcoin_username:$bitcoin_password@$bitcoin_ipaddress:$bitcoin_portnumber");
			//$bal=$bitcoin->getbalance();
			//1EJQwdS91KqH1Tnpw5X5pL8wbGCzfgR2Xa;
			//print_r($bitcoin->omni_listtransactions());
			$bal=$bitcoin->omni_getbalance($address,31);
			return $bal['balance'];
		}
		else if($currency == 'XMR'){
			$data=get_cn_data("XMR");
			$wallet = new Monero\Wallet();
			$hostname =insep_decode($data["ip"]);
			$port = insep_decode($data["port"]);;
			$wallet = new Monero\Wallet($hostname, $port);
			$xmrbalance = $wallet->getBalance();
			$xmrbalance=json_decode($xmrbalance,TRUE);
			return $xmrbalance["balance"]/1000000000000;; 
		}
		else if($currency == 'ETC'){
			$output = file_get_contents('https://api.gastracker.io/addr/'.$address);
			$eresult=json_decode($output,TRUE);
			return $eresult["balance"]["ether"]; 
		}
		else if($currency == 'EOS'){
			$checkAddress = $address;
			$contractAddr = "0x86Fa049857E0209aa7D9e616F7eb3b3B78ECfdb0";
			$getNtcBalance = getContents('http://api.etherscan.io/api?module=account&action=tokenbalance&contractaddress='.$contractAddr.'&address='.$checkAddress.'&tag=latest');
		    $decodeECH = json_decode($getNtcBalance,true);
		    $result = $decodeECH['result'];
		    return $balance = $result/1000000000000000000;    	
		}
		else if($currency == 'TRX'){
			$trx_address=$address;
			$contractAddr = "0xf230b790e05390fc8295f4d3f60332c93bed42e2";	
			$getNtcBalance = getContents('http://api.etherscan.io/api?module=account&action=tokenbalance&contractaddress='.$contractAddr.'&address='.$trx_address.'&tag=latest');
		    $decodeECH = json_decode($getNtcBalance,true);
		    $result = $decodeECH['result'];
		    return $balance = $result/1000000;
		}
		else if($currency == 'NPXS'){
 			$trx_address=$address;
			$contractAddr = "0xa15c7ebe1f07caf6bff097d8a589fb8ac49ae5b3";
		    $getNtcBalance = getContents('http://api.etherscan.io/api?module=account&action=tokenbalance&contractaddress='.$contractAddr.'&address='.$trx_address.'&tag=latest');
		    $decodeECH = json_decode($getNtcBalance,true);
		    $result = $decodeECH['result'];
		    return $balance = $result/1000000000000000000;
		}
		else if($currency == 'IOST'){
			$trx_address=$address;
			$contractAddr = "0xfa1a856cfa3409cfa145fa4e20eb270df3eb21ab";	
      		$getNtcBalance = getContents('http://api.etherscan.io/api?module=account&action=tokenbalance&contractaddress='.$contractAddr.'&address='.$trx_address.'&tag=latest');
       		$decodeECH = json_decode($getNtcBalance,true);
       		$result = $decodeECH['result'];
       		return $balance = $result/1000000000000000000;
		}
		else if($currency == 'ETH'){		
			$getETHAddress=$address;
			$output = file_get_contents('http://api.etherscan.io/api?module=account&action=balance&address='.$getETHAddress.'&tag=latest');
			$result = json_decode($output,TRUE);
			$amount = "0";
			if($result["message"]=="OK"){
				$amount=$result["result"];
				 $amount=$amount/1000000000000000000;
			}
			return $amount;
		}
		else if($currency == 'XRP'){
			$xrp_address=$address;
			$url = "https://data.ripple.com/v2/accounts/" . $xrp_address . "/balances?currency=XRP";
			$cObj = curl_init();
			curl_setopt($cObj, CURLOPT_URL, $url);
			curl_setopt($cObj, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($cObj, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($cObj, CURLOPT_RETURNTRANSFER, TRUE);
			$output = curl_exec($cObj);
			$curlinfos = curl_getinfo($cObj);
			$result = json_decode($output);
			return $xrp_balance=$result->balances[0]->value;	
		}
		// New coin added 21-Jun-18 Pratik
		else if($currency == 'OMG'){
 			$omg_address=$address;
			$contractAddr = "0xd26114cd6EE289AccF82350c8d8487fedB8A0C07";	
		    $getNtcBalance = getContents('http://api.etherscan.io/api?module=account&action=tokenbalance&contractaddress='.$contractAddr.'&address='.$omg_address.'&tag=latest');
		    $decodeECH = json_decode($getNtcBalance,true);
		    $result = $decodeECH['result'];
		    return $balance = $result/1000000000000000000;
		}

		else if($currency == 'ZRX'){
 			$zrx_address=$address;
			$contractAddr = "0xe41d2489571d322189246dafa5ebde1f4699f498";	
		    $getNtcBalance = getContents('http://api.etherscan.io/api?module=account&action=tokenbalance&contractaddress='.$contractAddr.'&address='.$zrx_address.'&tag=latest');
		    $decodeECH = json_decode($getNtcBalance,true);
		    $result = $decodeECH['result'];
		    return $balance = $result/1000000000000000000;
		}
		// New coin added 21-Jun-18 Pratik
	}
	
	public function index() {

		//$admindata		= $this->CommonModel->getTableData("admin_wallet")->row();;
		$wdata["all_currency"]=$this->CommonModel->get_admin_dashboard_data(1)->result();
		 $i=0;
		foreach ($wdata["all_currency"] as  $value) {
		  $value->balance=$this->getadminbalance( $value->currency_symbol,$value->address);

		$i++;
		}
		$loggedwalletuserid = $this->session->userdata('loggedwalletuserid');
		
		if(isset($loggedwalletuserid) && !empty($loggedwalletuserid)) {	        
			
			$siteDetails 				= $this->Wallet_model->getTableData(SETTINGS,array('id'=>1))->row_array();			
			$wdata['siteName'] 			= $siteDetails['site_name'];
			$wdata['copyRight'] 			= date('Y');
			$wdata['copySiteTitle'] 		= $siteDetails['site_name']." Admin";
			$wdata['title'] 				= "Dashboard | ".$siteDetails['site_name'];
			$wdata['keywords'] 			= "Dashboard | ".$siteDetails['site_name'];
			$wdata['description'] 		= "Dashboard | "."";	

			
				
			//$result=jeson_decode($result,TRUE);




		
			$this->load->view('admin_wallet/boDashboard/boDashboard',$wdata);
		}
		else {
			wallet_redirect('Authentication');
		}
	}
}
?>