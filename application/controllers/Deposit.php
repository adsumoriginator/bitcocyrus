<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require "vendor/autoload.php";
use Monero\Wallet;

class Deposit extends CI_Controller {


	public function __construct()
	{
		parent::__construct();	
		$this->load->helper("ctn_helper");
			
	}


	function init_deposit(){

		$currenccy_array=array("BTC","LTC");
		
		$this->deposit_process("BTC");

		
			$this->deposit_process("LTC");
			
			$this->deposit_process("DGB");
	
			$this->deposit_process("DASH");
		
			$this->deposit_process("BTG");
	
			$this->deposit_process("BCH");

			$this->eth_deposit();
	
			$this->etc_deposit();

			$this->xrp_deposit();

			$this->deposit_xmr();

	}
	


  function deposit_process($currency)
 {
   require_once("jsonRPCClient.php");
	
	$cur_date = date('Y-m-d');
	$cur_time = date('H:i:s');
	$data=get_cn_data($currency);
	$bitcoin_username 		= insep_decode($data['user']);	
	$bitcoin_password 		= insep_decode($data['password']);
	$bitcoin_ipaddress 	= insep_decode($data['ip']);	
	$bitcoin_portnumber = insep_decode($data['port']);				
	$bitcoin 	= new jsonRPCClient("http://$bitcoin_username:$bitcoin_password@$bitcoin_ipaddress:$bitcoin_portnumber");	

		  $bitcoin_isvalid         =     $bitcoin->listtransactions();

	
   if($bitcoin_isvalid){
       	   for($i=0;$i<count($bitcoin_isvalid);$i++)
    		{              	
                 $account      =      $bitcoin_isvalid[$i]['address'];
		         $category     =      $bitcoin_isvalid[$i]['category'];
		         $btctxid      =      $bitcoin_isvalid[$i]['txid'];

		        if($category=="receive")
		        {		

		        	
		         	 	$isvalid = $bitcoin->gettransaction($btctxid); 
					for($j=0;$j<count($isvalid['details']);$j++)	
					{
						$det_category  =   $isvalid['details'][$j]['category'];  
						 if($det_category=="receive")
							{
								 $btcaddress         =     $isvalid['details'][$j]['address'];
								  if($currency=="BCH")
								  {  
									$account =trim(str_replace("bitcoincash:","",$btcaddress));
								  }
									$amount     =     $isvalid['details'][$j]['amount']; 
									 $confirmations     =     $isvalid['confirmations']; 
									 $btcuserId             = $this->fetchuserId($account,$currency);	
									$dep_id             = $btctxid;
									


			         
							}
					}
                      
				
	            	
					 if( $confirmations > 0)
                     {
                        $dep_already = $this->checktransaition($btcuserId,$dep_id); 
				        if(!$dep_already)
				        {	

			    	   	           
	                	    $userdata = array(
					           'user_id' => $btcuserId,
					            'type'=>1,
					            'currency' => $currency,			                  
					            'total_amount' => $amount,
					            'transactionId'=>"D".time(),		            	  
					            'transactionId' => $dep_id,
					             'status' => "pending",
					             'transactionId'=>$dep_id

					            );    
         	                 $this->db->insert('tansation',$userdata);      
				          }
				          else
				          {
			            	 if($confirmations >= 5)
				             {


				             	 
				             	 $this->db->where('user_id',$btcuserId); 
								 $this->db->where('transactionId',$dep_id); 
								 $this->db->where('status','Pending');
								 $query = $this->db->get('tansation');
								 if($query->num_rows() >= 1)
								 {
									$userdata = array( 
									    'status' => "Completed"
									);
									$this->db->where('transactionId',$dep_id);
									$this->db->update('tansation',$userdata);
									$wallet_balance     = $this->fetchuserbalancebyId($btcuserId,$currency);
									$updatebalance     = $wallet_balance+$amount;
									$this->update_user_balance($btcuserId,$currency,$updatebalance);
									
								} 
			             	}
		            }

			 } 
 


		        }

            }
        
       }

       return true;

 }




function get_btc_balance($account=""){

				        	$account="1CvMQbCWJ3bBemeDrfXMnmojZirKKsDF2H";
	
$output = file_get_contents('https://api.blockcypher.com/v1/btc/main/addrs/'.$account.'/balance');
					$result = json_decode($output);
					
				return $btc_balance=$result->balance;




}

function get_admin_address($currency){

	 $condition=array("admin_id"=>1,"currency_symbol"=>$currency);
	 $address 		= $this->CommonModel->getTableData("admin_address",$condition)->row();

	 return $address->address;
}






 function checktransaition($user_id,$txid)
{
	

	$condition=array('user_id'=>$user_id,"transactionId"=>$txid);

	$this->db->where($condition); 
	$query = $this->db->get('tansation');


	if($query->num_rows() > 0)
	{

		
		return true;
	}
	else
	{
		return false;
	}
}


function fetchuserbalancebyId($id,$currency){



	$condition=array("user_id"=>$id,"currency_symbol"=>$currency);	
	$wallet_details=$this->CommonModel->getTableData("address_balance",$condition)->row();

	
	


	return $wallet_details->balance;
	
}



function fetchuserId($address="",$currency){

		//$condition=array($currency=>$address);
		$condition=array("address"=>$address,"currency_symbol"=>$currency);
		$details=$this->CommonModel->getTableData("address_balance",$condition);
		if($details->num_rows() >0){
			$userdata=$details->row();
			return $userdata->user_id;
		}else {
			return 0;
		}

}


function get_all_address($currency){

	$condition=array("currency_symbol"=>$currency);
	$getETHAddress 		= $this->CommonModel->getTableData("address_balance",$condition)->result();
	
	return $getETHAddress; 

}

function update_user_balance($btcuserId,$currency,$updatebalance){

	$condition=array("user_id"=>$btcuserId,"currency_symbol"=>$currency);
	$this->db->where($condition);
	$this->db->update('address_balance',array("balance"=>$updatebalance));

}



	public function eth_deposit() {

		$currency = 'ETH';
		$getETHAddress 		= $this->get_all_address($currency);

	
		if(isset($getETHAddress) && !empty($getETHAddress)) {
			foreach($getETHAddress as $row) {
	       		$btcuserId 	= $row->user_id;

	       	
	       		$account 	= trim($row->address);
	       		//$account="0xA1B88a7fa30FC93EdBe3F8691B3fA62812277701";
	            if($account != "") {
			    	$result = $this->db->query('SELECT MAX(eth_blocknumber) as eth_max_blocknumber FROM bcc_tansation')->row();
	
	            	$max_blocknumber = $result ->eth_max_blocknumber;
					if($max_blocknumber == "") {
	                	//$max_blocknumber ="4085142";
	                	$max_blocknumber ="100";
	              	}
	              	//$max_blocknumber ="3531100";
					$output = file_get_contents('http://api.etherscan.io/api?module=account&action=txlist&address='.$account.'&startblock='.$max_blocknumber.'&endblock=latest');
					$result = json_decode($output);



	                if(!isset($result->error)) {
		                if($result!=''&& $result->message == 'OK') {
							$transaction=$result->result;				


							for($tr=0;$tr<count($transaction);$tr++) {


								 $block_number  		= $transaction[$tr]->blockNumber;
								$block_hash  		= $transaction[$tr]->blockHash;
								 $transactionindex  	= $transaction[$tr]->transactionIndex;
							
								$address  			= $transaction[$tr]->to; 

								$from  			= $transaction[$tr]->from;
					            
					            $txid 				= $transaction[$tr]->hash;
					            $value 				= $transaction[$tr]->value;
					            $amount 		= ($value/1000000000000000000); 
					            $confirmations 		= $transaction[$tr]->confirmations;

					            if($from !=$account){						


								if($transaction[$tr]->confirmations > 3) {
									$dep_already = $this->checktransaition($btcuserId,$txid);

									//$getAdminDetails = $this->CommonModel->getAdminDetails();	
									//$adminEthAddr 	 = $getAdminDetails['0']->adminETHAddress;	
									if(!$dep_already) {
										//if($address != $adminEthAddr) {
											// Transaction History
												

								            // insert the data for deposit details
	                	    			$userdata = array(
					          				//'user_id' => $btcuserId,
					          				'user_id' => $btcuserId,
					           				'type'=>1,
					           			 	'currency' => "ETH",	                  
					            			'total_amount' => $amount,
					            			'status' => "pending",
					             			'transactionId'=>$txid,
					             			'eth_blocknumber'=>$block_number,

					            		);    
         	                		 $this->db->insert('tansation',$userdata);

         	                		
										//}
									}
									else {
										if( $transaction[$tr]->confirmations >= 3 ) {

								
											
										 $ophash=$this->eth_confirmation($block_hash,$transactionindex);

									
									
										if($ophash[0]==$txid) {	


											

											$this->db->where('user_id',$btcuserId); 
											$this->db->where('transactionId',$txid); 
											$this->db->where('status','pending');
											$query = $this->db->get('tansation');
											if($query->num_rows() >= 1) {
												$userdata = array( 
													'status' => "Completed"
												);
												$this->db->where('transactionId',$txid);
												$this->db->update('tansation',$userdata);
												  $walletbalance     = $this->fetchuserbalancebyId($btcuserId,'ETH');
												
												$updatebalance     = $walletbalance+$amount;

												$this->update_user_balance($btcuserId,$currency,$updatebalance);
												/*$condition=array("user_id"=>$btcuserId,"currency_symbol"=>'ETH');
												$this->db->where($condition);
												$this->db->update('address_balance',array("balance"=>$updatebalance));*/




									        }





									    }
									}
									}
								}

							}
							}
						}
					}
					else {
					
					}
	            }
	        }
	    }


	   $this->admin_transfer();

	   return true;
	}

function eth_confirmation($blockhash="",$index="") {
			$output     		= array();
		$currencyToFetch 	= "ETH";
		$bitcoin_row 		= get_cn_data("ETH");
		$bitcoin_portnumber = insep_decode($bitcoin_row["port"]);
		 $bitcoin_ipaddress 	= insep_decode($bitcoin_row["ip"]);	
		$data1 	    = array('key'=>'bitcocyruseth','port'=>$bitcoin_portnumber,'blockhash'=>$blockhash,'blockindex'=>$index,'method'=>'confirmation','name'=>'bitcocyrus.com','keyword' => '98543423');	
		$output     = connecteth('confirmation',$data1);	

		return $output->hash;
	}

function admin_transfer() {

		$output     		= array();
		$currencyToFetch 	= "ETH";
		$bitcoin_row 		= get_cn_data("ETH");

		$bitcoin_portnumber = insep_decode($bitcoin_row["port"]);
		 $bitcoin_ipaddress 	= insep_decode($bitcoin_row["ip"]);	

		 $getETHAddress 		= $this->get_admin_address($currencyToFetch);
		
		$data1 	    = array('key'=>'bitcocyruseth','port'=>$bitcoin_portnumber,'method'=>'toadminwallet','name'=>'bitcocyrus.com','keyword' => '98543423','adminEthAddr'=>$getETHAddress);
		$output     = connecteth('toadminwallet',$data1);
	

				
	}	

	


	public function etc_deposit() {


		$currency = 'ETC';
		$getAddress = $this->get_all_address($currency);
	
		if(isset($getAddress) && !empty($getAddress)) {
			foreach($getAddress as $row) {
	       		$btcuserId 	= $row->user_id;
	       		//$btcuserId=1;	       		
	       		$account 	= trim($row->address);
	       		
	            if($account != "") {
			    	
					$output = file_get_contents('https://api.gastracker.io/v1/addr/'.$account.'/transactions');
					$result = json_decode($output);	

	                if(count($result->items) > 0 ) {

	                   
               	
		                //if($result!=''&& $result->message == 'OK') {
							$transaction=$result->items;
							for($tr=0;$tr<count($transaction);$tr++) {
							

								 $block_number  		= $transaction[$tr]->height;							

								$block_hash  		= $transaction[$tr]->hash;
								
								
								$address  			= $transaction[$tr]->to; 
								$from  			= $transaction[$tr]->from; 
					            
					            $txid 				= $transaction[$tr]->hash;
					            $value 				= $transaction[$tr]->value;
					             $amount 		= $value->ether; 
					             $transactionindex  	= $value->hex;           
					             $confirmations 		= $transaction[$tr]->confirmations;

					         $fd=trim(strtolower($from));
					     

					         $ad=trim(strtolower($account));

					              if($fd != $ad ){


								if($transaction[$tr]->confirmations > 3) {
									$dep_already = $this->checktransaition($btcuserId,$txid);

									
									if(!$dep_already) {
										
	                	    			$userdata = array(
					          				//'user_id' => $btcuserId,
					          				'user_id' => $btcuserId,
					           				'type'=>1,
					           			 	'currency' => "ETC",	                  
					            			'total_amount' => $amount,
					            			'status' => "pending",
					             			'transactionId'=>$txid

					            		);    
         	                		 $this->db->insert('tansation',$userdata);

         	                		
										//}
									}
									else {
										if( $transaction[$tr]->confirmations >= 3 ) {

								
											
										 $ophash=$this->etc_confirmation($block_hash,$transactionindex);

										

									
										if($ophash[0]==$txid) {	



							

											$this->db->where('user_id',$btcuserId); 
											$this->db->where('transactionId',$txid); 
											$this->db->where('status','pending');
											$query = $this->db->get('tansation');
											if($query->num_rows() >= 1) {
												$userdata = array( 
													'status' => "Completed"
												);
												$this->db->where('transactionId',$txid);
												$this->db->update('tansation',$userdata);
												  $walletbalance     = $this->fetchuserbalancebyId($btcuserId,'ETC');												
												$updatebalance     = $walletbalance+$amount;
												$this->update_user_balance($btcuserId,$currency,$updatebalance);
												/*$this->db->where('user_id',$btcuserId);
												$this->db->update('wallet',array("ETC"=>$updatebalance));*/

								        }

									    }
									}
									}
								}
							}
							}
						//}
					}
					else {
					
					}
	            }
	        }
	    }

	
  $this->etc_admin_transfer();

	   return true;
	}
function checketcrbloackcount()
{
	$currencyToFetch 	= "ETC";
		$bitcoin_row 		= get_cn_data("ETC");
		$bitcoin_portnumber = insep_decode($bitcoin_row["port"]);
		 $bitcoin_ipaddress 	= insep_decode($bitcoin_row["ip"]);
		
		$data1 	    = array('key'=>'bitcocyrusetc','port'=>$bitcoin_portnumber,'method'=>'blockcount','account'=>$account,'name'=>'bitcocyrus.com','keyword' => '98543423');
		 $output     = connectetc('blockcount',$data1);
		 print_r($output);
		 $decimal=hexdec($output->result);
		 print_r($decimal);

function etc_confirmation($blockhash="",$index="") {
		$output     		= array();
		$currencyToFetch 	= "ETC";
		$bitcoin_row 		= get_cn_data("ETC");
		$bitcoin_portnumber = insep_decode($bitcoin_row["port"]);
		 $bitcoin_ipaddress 	= insep_decode($bitcoin_row["ip"]);	
		$data1 	    = array('key'=>'bitcocyrusetc','port'=>$bitcoin_portnumber,'blockhash'=>$blockhash,'blockindex'=>$index,'method'=>'confirmation','name'=>'bitcocyrus.com','keyword' => '98543423');	
		$output     = connectetc('confirmation',$data1);
	
		
		return $output->hash;
	}





function etc_admin_transfer() {
		
		$output     		= array();
		$currencyToFetch 	= "ETC";
		$bitcoin_row 		= get_cn_data("ETC");
		$bitcoin_portnumber = insep_decode($bitcoin_row["port"]);
		$bitcoin_ipaddress 	= insep_decode($bitcoin_row["ip"]);	
		$getETHAddress 		= $this->get_admin_address($currencyToFetch);
		$data1 	    = array('key'=>'bitcocyrusetc','port'=>$bitcoin_portnumber,'method'=>'toadminwallet','name'=>'bitcocyrus.com','keyword' => '98543423','adminEthAddr'=>$getETHAddress);
		$output     = connectetc('toadminwallet',$data1);

 return true;


						
	}	


	function blockcount() {
		$output     		= array();
		$currencyToFetch 	= "ETH";
		$bitcoin_row 		= get_cn_data("ETH");
		$bitcoin_portnumber = insep_decode($bitcoin_row["port"]);
		 $bitcoin_ipaddress 	= insep_decode($bitcoin_row["ip"]);			

      //   $bitcoin_portnumber = insep_decode($data['port']);		
		  $data1 = array('key'=>'blockcount','port'=>$bitcoin_portnumber,'method'=>'blockcount','name'=>'bitcocyrus.com','keyword' => '98543423');
		  $output 	   			= connecteth('blockcount',$data1);	

		 $output=$output->result;

		return $output->hash;
	}






	public function xrp_deposit() {
			
		//$this->db->where("user_id",27);

		$currency = 'XRP';
		$getXRPAddress = $this->get_all_address($currency);
		//$getXRPAddress 		= $this->CommonModel->getTableData("address")->result();	
	if(isset($getXRPAddress) && !empty($getXRPAddress)) {
		foreach ($getXRPAddress as $value) {
			if($value->address != "") {


				$url = "https://data.ripple.com/v2/accounts/" . $value->address . "/payments?currency=XRP&type=received";
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
				$res = json_decode(curl_exec($ch));
				$curlinfos = curl_getinfo($ch);
				curl_close($ch);
			
				if ($res->result == 'success' && $res->count > 0) {
					$getresult = $res->payments;
			
					if ($getresult) {
						
						foreach ($getresult as $val) {
							$amount 	= $val->delivered_amount;
							$destaddr 	= $val->destination;
							$datestimes = $val->executed_time;
							if ($value->address == $destaddr) {
								$hash 		= $val->tx_hash;
								$btcuserId 	= $value->user_id;
								$btcaddress = $value->address;
								$xrp_secret = $value->skey;								
							$dep_already = $this->checktransaition($btcuserId,$hash);
								if(!$dep_already) {
									 $wallet_balance 	= $this->fetchuserbalancebyId($btcuserId,"XRP");
										$xrp_bal =  $wallet_balance ;
										$xrp_bal1 = $amount;
										$fetchXRPbalance     = $wallet_balance;
										$updatebalance     = $wallet_balance+$amount;
										// insert data into transaction history

										$this->update_user_balance($btcuserId,$currency,$updatebalance);
										//$this->db->where('user_id',$btcuserId);  // for Update current coin balance
										//$this->db->update('wallet',array('XRP'=>$updateBTCbalance));			

										// Transaction History				


										$userdata = array(
					          				//'user_id' => $btcuserId,
					          				'user_id' => $btcuserId,
					           				'type'=>1,
					           			 	'currency' => "XRP",	                  
					            			'total_amount' => $amount,
					            			'status' => "Completed",
					             			'transactionId'=>$hash

					            		);    
         	                		 $this->db->insert('tansation',$userdata);



							        
									//}			            					
								}
							}
						}




						$xrp_res=$this->get_xrp_balance($value->address);
								$res 		= $xrp_res->result;
									$xrp_bal1 = 0;
									if ($res == 'success') {
										$xrp_bal = $xrp_res->balances;
										$xrp_bal1 = $xrp_bal[0]->value;
									}
								if ($xrp_bal1 > 21) {
										$tramount 					= $xrp_bal1 - 21;
										$valuess['transfers_amounts'] = $tramount;
										//$valuess['transfers_amounts'] = 21;
										$valuess['address'] 			= $value->address;
										$valuess['secret'] 			= $xrp_secret;
											$hash1 = $this->transfer_ripple_xrp($valuess);
									}

						

					}
				}
			}
		}
	}	

 return true;

}
	


	function get_xrp_balance($xrp_address) {
		$url = "https://data.ripple.com/v2/accounts/" . $xrp_address . "/balances?currency=XRP";
		$cObj = curl_init();
		curl_setopt($cObj, CURLOPT_URL, $url);
		curl_setopt($cObj, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($cObj, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($cObj, CURLOPT_RETURNTRANSFER, TRUE);
		$output = curl_exec($cObj);
		$curlinfos = curl_getinfo($cObj);
		$result = json_decode($output);

			return $result;
	}





	function transfer_ripple_xrp($parmeter) {

		$output 			= array();
		$currencyToFetch    = 'XRP';
		$return_var 		= -1;
		 $from_address 		= $parmeter['address']; // address
		$from_secret 		= $parmeter['secret'];		
		 $to_address 		= $this->get_admin_address($currencyToFetch);

		$amount 			= $parmeter['transfers_amounts'];
	
		 	$this->wallet_dir 	= FCPATH.'ripple';
		 	$tag=123456;
			$this->node_dir 	= '/usr/bin/node';
			$result = exec('cd '.$this->wallet_dir.'; '.$this->node_dir.' xrp_sent_withdrwal.js "'.$from_address.'" "'.$from_secret.'" "'.$to_address.'" "'.$amount.'" "'.$tag.'"',$output,$return_var);

			
			$rem = json_decode($output[2]);
		//if($rem->resultCode == "tesSUCCESS") {
		if($rem->resultCode != "") {
			$res 	= json_decode($output[1]);
			$txn_id = $res->txid;
			return $txn_id;
		}
		else {
			return false;
		}
		
		
	}

	




function deposit_xmr(){



	//$condition=array("user_id"=>43);

	$currency = 'XMR';
	$getAddress = $this->get_all_address($currency);

	//$getAddress 		= $this->CommonModel->getTableData("address")->result();

	$data=get_cn_data("XMR");
	$wallet = new Monero\Wallet();
	$hostname =insep_decode($data["ip"]);
	$port = insep_decode($data["port"]);;	
	$wallet = new Monero\Wallet($hostname, $port);
	$data=$wallet->getBalance();
		


	if(isset($getAddress) && !empty($getAddress)) {
		foreach ($getAddress as $value) {	


			 $address=$value->address;

				
			if($address!=""){
			 $payment_id=$value->payment_id;


			 

			$user_id=$value->user_id;
		

			if($payment_id!=""){

			
			$payment_data=shell_exec('curl -X POST http://13.126.166.226:18084/json_rpc -d \'{"jsonrpc":"2.0","id":"0","method":"get_bulk_payments","params":{"payment_ids":["'.$payment_id.'"],"min_block_height":10000}}\' -H \'Content-Type: application/json\'');

			$payment_data=json_decode($payment_data,"TRUE");

		
	
				if(isset($payment_data["result"]["payments"])){

				
					$payments=$payment_data["result"]["payments"];


					foreach($payments as $row){
						$tax_id=$row['tx_hash'];
						$block=$row['block_height'];
						$dep_already = $this->checktransaition($user_id,$tax_id);
						if(!$dep_already) {
							$amount=$row['amount']/1000000000000;
							$userdata = array(
					           'user_id' => $user_id,
					           'type'=>1,
					           'currency' => "XMR",	                  
					           'total_amount' => $amount,
					           'status' => "Completed",
					            'transactionId'=>$tax_id,
					            'xmr_block'=>$block
		            		); 

							$this->db->insert('tansation',$userdata);
							$wallet_balance 	= $this->fetchuserbalancebyId($user_id,"XMR");
						   		$xmr_bal =  $wallet_balance ;
							$updatebalance     = $wallet_balance+$amount;

							$this->update_user_balance($user_id,$currency,$updatebalance);

										
							//$this->db->where('user_id',$user_id);  // for Update 
							//$this->db->update('wallet',array('XMR'=>$updateBTCbalance));	

							

						}

				}
					}

				
				}

				}else{
					

				}



		


		}

	}


}



function send_either($toaddress,$amount,$key,$adminEthAddr){


	$bitcoin_row 		= get_cn_data("ETH");
	$bitcoin_portnumber = insep_decode($bitcoin_row["port"]);
	$bitcoin_ipaddress 	= insep_decode($bitcoin_row["ip"]);	

;	


	$sendAmount=$amount;
     $currencyToAddress=$toaddress;



			$data1 	    = array('port'=>$bitcoin_portnumber,'from'=>$adminEthAddr,'sendaddress'=>$currencyToAddress,'withdraw_amount'=>$sendAmount,'keyword' => '98543423','name'=>'bitcocyrus.com','key'=>$key,'method'=>'ethwithdraw');
		



			$output     = connecteth('ethwithdraw',$data1);



		

				 // $txn_id 	= $output->result;

				return  $txn_id 	= $output->result;




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
		
		
		// New coin added 21-Jun-18 Pratik
		$output= (array)$output;
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

function checketherbloackcount()
{
	$currencyToFetch 	= "ETH";
		$bitcoin_row 		= get_cn_data("ETH");
		$bitcoin_portnumber = insep_decode($bitcoin_row["port"]);
		 $bitcoin_ipaddress 	= insep_decode($bitcoin_row["ip"]);
		
		$data1 	    = array('key'=>'bitcocyruseth','port'=>$bitcoin_portnumber,'method'=>'blockcount','account'=>$account,'name'=>'bitcocyrus.com','keyword' => '98543423');
		 $output     = connecteth('blockcount',$data1);
		 print_r($output);
		 $decimal=hexdec($output->result);
		 print_r($decimal);

}
function checketcrbloackcount()
{
	$currencyToFetch 	= "ETC";
		$bitcoin_row 		= get_cn_data("ETC");
		$bitcoin_portnumber = insep_decode($bitcoin_row["port"]);
		 $bitcoin_ipaddress 	= insep_decode($bitcoin_row["ip"]);
		
		$data1 	    = array('key'=>'bitcocyrusetc','port'=>$bitcoin_portnumber,'method'=>'blockcount','account'=>$account,'name'=>'bitcocyrus.com','keyword' => '98543423');
		 $output     = connectetc('blockcount',$data1);
		 print_r($output);
		 $decimal=hexdec($output->result);
		 print_r($decimal);

}
function address_check(){


	
       	 $data=get_cn_data("XMR");
		$wallet = new Monero\Wallet();
		$hostname =insep_decode($data["ip"]);
		$port = insep_decode($data["port"]);;	
		$wallet = new Monero\Wallet($hostname, $port);

		$address = $wallet->integratedAddress();
	$addrdata=json_decode($address,TRUE);
		$address=$addrdata["integrated_address"];
		$wallet_address = $wallet->splitIntegratedAddress($address);
		$wallet_address=json_decode( $wallet_address,TRUE);
	

		$address=$wallet_address["standard_address"];	
		$payment_id=$wallet_address["payment_id"];
        $walletdata["XMR"]=$address;       
        $walletdata["payment_id"]=$payment_id;

     

}



}
