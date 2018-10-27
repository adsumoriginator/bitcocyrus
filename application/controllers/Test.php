<?php
/*defined('BASEPATH') OR exit('No direct script access allowed');
require "vendor/autoload.php";
use Monero\Wallet;*/

/**
 * BoDashboard class
 * @category controller
 * @package ICO Suisse
 * @subpackage modules
 * @author Osiz Technologies Pvt Ltd 
 * @link http://osiztechnologies.com/F
 */
	require "vendor/autoload.php";
	use Monero\Wallet;
	require_once 'jsonRPCClient.php';
class Test extends CI_Controller {
public function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->library('form_validation');				
		$this->load->database();
		$this->load->model('BoLoginModel');		
		$this->load->helper('url');
	}
	public function index() {
		
		 $oldpassword="bicocyrusbtg";
			$password="BP869C3527H";
		$address="qqmk5vddsq854u3dnh6a5u3wurjdftuc6vwfmfnt68";
			$data=get_cn_data("BCH");
			$bitcoin_username 		= insep_decode($data['user']);	
			$bitcoin_password 		= insep_decode($data['password']);
			$bitcoin_ipaddress 	= insep_decode($data['ip']);	
			$bitcoin_portnumber = insep_decode($data['port']);
			$bitcoin 	= new jsonRPCClient("http://$bitcoin_username:$bitcoin_password@$bitcoin_ipaddress:$bitcoin_portnumber");
		/*	$post = array(
								'secret' => 'error',
								'method' => 'walletpassphrase',
								'params'=> array($password,5),
							);
								$url 	= "http://$bitcoin_username:$bitcoin_password@$bitcoin_ipaddress:$bitcoin_portnumber";
					$check_wallet = request_coiiinnn($post,$url);	
			$privatekey=$bitcoin->dumpprivkey($address);
				    
				    print_r($privatekey);
		/*$payment_data=shell_exec('curl -X POST http://13.126.166.226:18082/json_rpc -d \'{"jsonrpc":"2.0","id":"0","method":"getbalance"}}\' -H \'Content-Type: application/json\'');

			$payment_data=json_decode($payment_data,"TRUE");
			print_r($payment_data);	
		
				$account="0xaa3f9efd66b050f6ee7e4f3f320fc57d9f0f9a18";
				$to="0xa7492f7731f7ab1e525eea1002f1d698d2535d03";
				$contractAddr="0xa15c7ebe1f07caf6bff097d8a589fb8ac49ae5b3";
				$balance=500;
				$type="NPXS";
				$key="NP869X3527S";	
				$getEthBalance = getContents('https://api.etherscan.io/api?module=account&action=balance&address=' .$account.'&tag=latest');
								$decodeBalance = json_decode($getEthBalance,true);
								$resulteth = $decodeBalance['result'];
								$ethpendingbalance = $resulteth/1000000000000000000;
								$fees = $this->get_token_fee($account,$type);
									$fee = $fees/1000000000000000000;
									$ethamount =  $ethpendingbalance-$fee;
										$txId = $this->send_either($to,$ethamount,$key,$account);
										print_r($txId);
			//$resulttokentranfer =$this->transfer_token_admin_test($account,$to,$contractAddr,$balance,$type,$key);
			//echo $resulttokentranfer;
		
		
			
				
				$resulttokentranfer =$this->transfer_token_admin($account,$to,$contractAddr,$balance,$type,$key);
				echo $resulttokentranfer;
					$account="0xDD6455Ac6fe6176B0E7455868Dc782bB406766B0";
							$to="0x164b6fd970cc3802cb947f6cddf2179ab1ecb47e ";
							$type="IOST";
							$key="IOP869S3527T";
							$getEthBalance = getContents('https://api.etherscan.io/api?module=account&action=balance&address=' .$account.'&tag=latest');
								$decodeBalance = json_decode($getEthBalance,true);
								$resulteth = $decodeBalance['result'];
								$ethpendingbalance = $resulteth/1000000000000000000;
								$fees = $this->get_token_fee($account,$type);
									$fee = $fees/1000000000000000000;
									$ethamount =  $ethpendingbalance-$fee;
										$txId = $this->send_either($to,$ethamount,$key,$account);
										echo $txId;
		 $data=get_cn_data("ETH");
					   $bitcoin_portnumber = insep_decode($data['port']);		
		$data1 = array('key'=>'bitcocyruseth','port'=>$bitcoin_portnumber,'method'=>'createadmin','name'=>'bitcocyrus.com','keyword' => '98543423');
		$output 	   			= $this->connectomg('createadmin',$data1);
		$address=$output->result;
		
		echo $address;
			$address="1CvMQbCWJ3bBemeDrfXMnmojZirKKsDF2H";
			$data=get_cn_data("USDT");
			$bitcoin_username 		= insep_decode($data['user']);	
			$bitcoin_password 		= insep_decode($data['password']);
			$bitcoin_ipaddress 	= insep_decode($data['ip']);	
			$bitcoin_portnumber = insep_decode($data['port']);
			$bitcoin 	= new jsonRPCClient("http://$bitcoin_username:$bitcoin_password@$bitcoin_ipaddress:$bitcoin_portnumber");
			 $bal=$bitcoin->omni_getbalance($address,31);
		
		
		
		
		
		
		$this->deposit_iost();
									
				 $oldpassword="";
			$newpassword="";
			$data=get_cn_data("USDT");
			$bitcoin_username 		= insep_decode($data['user']);	
			$bitcoin_password 		= insep_decode($data['password']);
			$bitcoin_ipaddress 	= insep_decode($data['ip']);	
			$bitcoin_portnumber = insep_decode($data['port']);
			$post = array(
								'secret' => 'error',
								'method' => 'walletpassphrasechange',
								'params'=> array($oldpassword,$newpassword),
							);
								$url 	= "http://$bitcoin_username:$bitcoin_password@$bitcoin_ipaddress:$bitcoin_portnumber";
					$check_wallet = request_coiiinnn($post,$url);	
					print_r($check_wallet); echo "</br>"; 
			
			
			$email="";
			$password="";
			
			
			$bitcoin 	= new jsonRPCClient("http://$bitcoin_username:$bitcoin_password@$bitcoin_ipaddress:$bitcoin_portnumber");
			
   				   $bal=$bitcoin->getinfo();
				   $address=  $bitcoin->getaccountaddress($email);
				   print_r($address);
				   echo "</br>";
				    $bitcoin->walletlock();
					$post = array(
								'secret' => 'error',
								'method' => 'walletpassphrase',
								'params'=> array($password,5),
							);
								$url 	= "http://$bitcoin_username:$bitcoin_password@$bitcoin_ipaddress:$bitcoin_portnumber";
				$check_wallet = request_coiiinnn($post,$url);	
					print_r($check_wallet); echo "</br>";
					
					$privatekey=$bitcoin->dumpprivkey($address);
				    
				    print_r($privatekey);
					echo "</br>";
					$bal=$bitcoin->listaccounts();
					echo "</br>";
					
					print_r($bal);
		
		
		
		
	/*	$data=get_cn_data("ETH");
 	 	$bitcoin_portnumber = insep_decode($data['port']);		
		 $data1 = array('key'=>'bitcocyruseth','port'=>$bitcoin_portnumber,'method'=>'create','name'=>'bitcocyrus.com','keyword' => '98543423');
			$output = $this->connectiost('create',$data1);
			$res=$output->result;
		 print_r($res); 
		 
		 echo "</br>";
		
				$data=get_cn_data("BCH");
			$bitcoin_username 		= insep_decode($data['user']);	
			$bitcoin_password 		= insep_decode($data['password']);
			$bitcoin_ipaddress 	= insep_decode($data['ip']);	
			$bitcoin_portnumber = insep_decode($data['port']);				
			$bitcoin 	= new jsonRPCClient("http://$bitcoin_username:$bitcoin_password@$bitcoin_ipaddress:$bitcoin_portnumber");
			
   				   $bal=$bitcoin->getinfo();
				   print_r($bal);
				  echo "</br>";
				   
					
					echo "</br>";
					 $bal=$bitcoin->listaccounts();
				   print_r($bal);
				 
				  
			$payment_data=shell_exec('curl -X POST http://13.126.166.226:18084/json_rpc -d \'{"jsonrpc":"2.0","id":"0","method":"getbalance"}}\' -H \'Content-Type: application/json\'');

			$payment_data=json_decode($payment_data,"TRUE");
			print_r($payment_data);	
			 echo "</br>";*/
				
	}

   function connectomg($method,$data=array()) 
   {                 
        $url = '13.126.166.226/api_omg.php';
        $name = $_SERVER['SERVER_NAME'];
        $data_string = json_encode($data);
        $ch=curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec( $ch );
       //print_r('curl='.$response);
        curl_close($ch);
        return json_decode($response);
    }

 function connecttesttoken($method,$data=array())
   {                 
        $url = '13.126.166.226/api_test_token.php';
        $name = $_SERVER['SERVER_NAME'];
        $data_string = json_encode($data);
        $ch=curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec( $ch );
       //print_r('curl='.$response);
        curl_close($ch);
         return json_decode($response);
    }

   function connectzrx($method,$data=array())
   {                 
        $url = '13.126.166.226/api_zrx.php';
        $name = $_SERVER['SERVER_NAME'];
        $data_string = json_encode($data);
        $ch=curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec( $ch );
       //print_r('curl='.$response);
        curl_close($ch);
         return json_decode($response);
    }


	public function addressadmin($currency,$email)
	{
			$currency=$currency;
			$data=get_cn_data($currency);
			$bitcoin_username 		= insep_decode($data['user']);	
			$bitcoin_password 		= insep_decode($data['password']);
			$bitcoin_ipaddress 	= insep_decode($data['ip']);	
			$bitcoin_portnumber = insep_decode($data['port']);
			$bitcoin 	= new jsonRPCClient("http://$bitcoin_username:$bitcoin_password@$bitcoin_ipaddress:$bitcoin_portnumber");
			echo $currency;echo "</br>";
			echo $address=  $bitcoin->getaccountaddress($email);
			echo "</br>";
	}
public function deposit_iost() // cronjob for deposit
{
	$this->deposit_token('IOST','0xfa1a856cfa3409cfa145fa4e20eb270df3eb21ab','IOP869S3527T','AIOP869S3527T');
}

function get_all_address($currency){

	$condition=array("currency_symbol"=>$currency);
	$getETHAddress 		= $this->CommonModel->getTableData("address_balance",$condition)->result();
	
	return $getETHAddress; 

}

function get_admin_address($currency){

	 $condition=array("admin_id"=>1,"currency_symbol"=>$currency);
	 $address 		= $this->CommonModel->getTableData("admin_address",$condition)->row();

	 return $address->address;
}


public function deposit_token($type,$contractAddr,$key,$adminkey) // cronjob for deposit
{
	

	$addressdata = $this->get_all_address($type);
	//$addressdata=$this->CommonModel->getTableData("address")->result_array();
	foreach($addressdata as $addressrow)
	{
		$user_id   = $addressrow->user_id;			
		$account   = $addressrow->address;
		if(isset($account) && !empty($account))
		{
			$fromAddr = $key;	    			
			$output = array();
			$output1 = array();
			$return_var = -1;
			$getNtcBalance = getContents('http://api.etherscan.io/api?module=account&action=tokenbalance&contractaddress='.$contractAddr.'&address='.$account.'&tag=latest');
			$decodeECH = json_decode($getNtcBalance,true);
			$result = $decodeECH['result'];
			if($type=='TRX')
			{
				$balance = $result/1000000;
			}
			else if($type=='EOS')
			{
				$balance = $result/1000000000000000000;	
			}
			else if($type=='NPXS')
			{
				$balance = $result/1000000000000000000;	
			}
			else if($type=='IOST')
			{
				$balance = $result/1000000000000000000;	
			}
			if((float)$balance > 0) 
			{
				//echo $balance.'<br/>'.$account.'<br/>';
				$upddetail=array(
								'user_id'=>$user_id,
								'address'=>$account,
								'amount'=>0.009,
								'currency'=>"ETH",
								'trans_status'=>0
								);
				$oldtransaction = $this->CommonModel->getTableData("usdt_btc_transation",$upddetail)->row();
				if($oldtransaction)
				{
					$transhash=$oldtransaction->tax_id;
					$gettransdetails = getContents('https://api.etherscan.io/api?module=transaction&action=gettxreceiptstatus&txhash='.$transhash);
					$decodetrans = json_decode($gettransdetails,true);
					$transresult = $decodetrans['result'];
					if($transresult['status']==1)
					{
						$toadr=strtolower($type).'_address';
						$to = $this->get_admin_address($type);
						$resulttokentranfer =$this->transfer_token_admin($account,$to,$contractAddr,$balance,$type,$key);
						if($resulttokentranfer!="") 
						{		        					
							if($resulttokentranfer != "") 
							{
								$this->db->where($upddetail);
								$this->db->update('usdt_btc_transation',array('trans_status'=>1));
								$userdata = array(
								'user_id' => $user_id,
								'type'=>1,
								'currency' => $type,	          
								'total_amount' => $balance,
								'from_address' => $account,
								'to_address' => $to,
								'status' => "Completed",
								'transactionId'=>$resulttokentranfer
								); 
								$this->db->insert('tansation',$userdata);
								$wallet_balance 	= $this->fetchuserbalancebyId($user_id,$type);
								$xmr_bal =  $wallet_balance ;
								$updatebalance     = $wallet_balance+$balance;
								$this->update_user_balance($user_id,$type,$updatebalance);
								//$this->db->where('user_id',$user_id);
								//$this->db->update('wallet',array($type=>$updateBTCbalance));
								$getEthBalance = getContents('https://api.etherscan.io/api?module=account&action=balance&address=' .$account.'&tag=latest');
								$decodeBalance = json_decode($getEthBalance,true);
								$resulteth = $decodeBalance['result'];
								$ethpendingbalance = $resulteth/1000000000000000000;
								if($ethpendingbalance > 0) 
								{
									$fees = $this->get_token_fee($account,$type);
									$fee = $fees/1000000000000000000;
									if($fee<$ethpendingbalance)		
									{	
										$ethamount =  $ethpendingbalance-$fee;
										$txId = $this->send_either($to,$ethamount,$key,$account);
										if($txId!=="" )
										{
											$btc_tansation=array(
											'user_id'=>$user_id,
											'address'=>$account,
											'amount'=>$ethamount,
											'tax_id'=>$txId,
											'currency'=>"ETH"
											);
											$this->db->insert('usdt_btc_transation',$btc_tansation);  
										}
									}
								}
							}
						}
					}
				}
				else
				{
					$ethamount =  0.009;
					$toadr=strtolower($type).'_address';
					$to = $this->get_admin_address($type);
					$txId = $this->send_either($account,$ethamount,$adminkey,$to);
					if($txId != "")
					{
						$blockhash 	= '';
						$time_st 	= gmdate(time());
						if($txId!=="" )
						{
							$btc_tansation=array(
							'user_id'=>$user_id,
							'address'=>$account,
							'amount'=>$ethamount,
							'tax_id'=>$txId,
							'currency'=>"ETH"
							);
							$this->db->insert('usdt_btc_transation',$btc_tansation);  
						}
					} 
				}
			}
		}
	}
	return true;	
}	
function transfer_token_admin_test($from="",$to="",$contract="",$amount="",$type="",$key=""){



		$output     		= array();
		$currencyToFetch 	= "ETH";
		$bitcoin_row 		= get_cn_data("ETH");
		$bitcoin_portnumber = insep_decode($bitcoin_row["port"]);
		$bitcoin_ipaddress 	= insep_decode($bitcoin_row["ip"]);
		if($key=="")
			$key='bitcocyrus'.strtolower($type);
		$data1 	    = array('key'=>$key,'port'=>$bitcoin_portnumber,'method'=>'admin_tansfer','from'=>$from,'to'=>$to,'contract'=>$contract,'name'=>'bitcocyrus.com','keyword' => '98543423','amount'=>$amount);
		print_r($data1); echo "</br>";
		 $output     = $this->connecttesttoken('admin_tansfer',$data1);
		
			print_r($output); echo "</br>";
		//print_r($output);die;

		 if($output["type"]=="success"){

		if(count($output["hash"])> 0){
			if($output["hash"][0]=="success"){
			  $output["hash"][1];
			return $output["hash"][1];


		}
	}else{

		return false;

	}
	
			
			
		 //	return $output["hash"][1];
		}else{
				return FALSE;
		}

		 





	}	

function transfer_token_admin($from="",$to="",$contract="",$amount="",$type="",$key=""){



		$output     		= array();
		$currencyToFetch 	= "ETH";
		$bitcoin_row 		= get_cn_data("ETH");
		$bitcoin_portnumber = insep_decode($bitcoin_row["port"]);
		$bitcoin_ipaddress 	= insep_decode($bitcoin_row["ip"]);
		if($key=="")
			$key='bitcocyrus'.strtolower($type);
		$data1 	    = array('key'=>$key,'port'=>$bitcoin_portnumber,'method'=>strtolower($type).'_admin_tansfer','from'=>$from,'to'=>$to,'contract'=>$contract,'name'=>'bitcocyrus.com','keyword' => '98543423','amount'=>$amount);
		print_r($data1); echo "</br>";
		if($type=='TRX')
		{
		 $output     = connecttrx(strtolower($type).'_fee',$data1);
		}
		else if($type=='EOS')
		{
			$output     = connecteos(strtolower($type).'_fee',$data1);
		}
		else if($type=='NPXS')
		{
			$output     = connectnpxs(strtolower($type).'_fee',$data1);
		}
		else if($type=='IOST')
		{
			$output     = connectiost(strtolower($type).'_fee',$data1);
		}
		 		 $output= (array)$output;
			print_r($output); echo "</br>";
		//print_r($output);die;

		 if($output["type"]=="success"){

		if(count($output["hash"])> 0){
			if($output["hash"][0]=="success"){
			  $output["hash"][1];
			return $output["hash"][1];


		}
	}else{

		return false;

	}
	
			
			
		 //	return $output["hash"][1];
		}else{
				return FALSE;
		}

		 





	}	



function send_either($toaddress,$amount,$key,$adminEthAddr){


	$bitcoin_row 		= get_cn_data("ETH");
	$bitcoin_portnumber = insep_decode($bitcoin_row["port"]);
	$bitcoin_ipaddress 	= insep_decode($bitcoin_row["ip"]);	
	$sendAmount=$amount;
     $currencyToAddress=$toaddress;



			$data1 	    = array('port'=>$bitcoin_portnumber,'from'=>$adminEthAddr,'sendaddress'=>$currencyToAddress,'withdraw_amount'=>$sendAmount,'keyword' => '98543423','name'=>'bitcocyrus.com','key'=>$key,'method'=>'ethwithdraw');
		



			$output     = $this->connecttesttoken('ethwithdraw',$data1);

			print_r($data1);
		print_r($output);
		

				 // $txn_id 	= $output->result;

				return  $txn_id 	= $output->result;




}

function get_token_fee($account="",$type="") {	
		$output     		= array();
		$currencyToFetch 	= "ETH";
		$bitcoin_row 		= get_cn_data("ETH");
		$bitcoin_portnumber = insep_decode($bitcoin_row["port"]);
		 $bitcoin_ipaddress 	= insep_decode($bitcoin_row["ip"]);
		
		$data1 	    = array('key'=>'bitcocyruseth','port'=>$bitcoin_portnumber,'method'=>strtolower($type).'_fee','account'=>$account,'name'=>'bitcocyrus.com','keyword' => '98543423');
		if($type=='TRX')
		{
		 $output     = connecttrx(strtolower($type).'_fee',$data1);
		}
		else if($type=='EOS')
		{
			$output     = connecteos(strtolower($type).'_fee',$data1);
		}
		else if($type=='NPXS')
		{
			$output     = connectnpxs(strtolower($type).'_fee',$data1);
		}
		else if($type=='IOST')
		{
			$output     = connectiost(strtolower($type).'_fee',$data1);
		}
		else if($type=='ZRX')
		{
			$output     = connectzrx(strtolower($type).'_fee',$data1);
		}
		else if($type=='OMG')
		{
			$output     = connectomg(strtolower($type).'_fee',$data1);
		}
		print_r($data1);
		print_r($output);
		 if($output->type=="success"){

			$output= (array)$output;
			
		 	return $output["result"][0];
		}else{
				return FALSE;
		}


	

						
	}
	
	


	}


?>
