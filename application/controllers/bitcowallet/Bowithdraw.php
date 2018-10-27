<?php
/**
 * Bocms class
 * @category controller
 * @package ICO Suisse
 * @subpackage modules
 * @author Osiz Technologies Pvt Ltd 
 * @link http://osiztechnologies.com/
 */
require "vendor/autoload.php";
use Monero\Wallet;

class Bowithdraw extends CI_Controller {
	/**
	* Initialize function
	* @access public
	* @return init library,model,database and helper
	* @author Osiz Technologies Pvt Ltd
	*/	
	public function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->library('form_validation');		
		$this->load->model('BoSettingsModel');

		$this->load->model('CommonModel');
		$this->load->database();
		$this->load->helper('url');
	}

	/**
	 * Function use to prepare the get the avilable cms pages of the site
	 * @access public
	 * @return response success get the set of records or fail
	 * @author Osiz Technologies Pvt Ltd
	 */	

	



	public function index() {	

		$loggedwalletuserid = $this->session->userdata('loggedwalletuserid');
		
		if(isset($loggedwalletuserid) && !empty($loggedwalletuserid)) {

			if($this->input->post()){

				$currency =  $this->input->post('currency');
				if($currency=="XRP" ){



					if($this->input->post("xr")){
						$insertdata["xrp_tag"]=$this->input->post("xr");
					}else{

						$insertdata["xrp_tag"]=123456;
					}




				}


				if($currency=="XMR" ){



					if($this->input->post("payment_id")){
						$insertdata["payment_id"]=$this->input->post("payment_id");
					}



				}



				$amount =  $this->input->post('amount');
				$address =  $this->input->post('to_address');
				$insertdata["askamount"]=$amount;
				$insertdata["to_address"]=$address;
				$insertdata["currency"]=$currency;
				$token=insep_encode(time());
				$insertdata["token"]=$token;
				$this->CommonModel->addTableData("admin_withdraw",$insertdata);
				$email_data=getEmailTeamplete(15);
				$subject= $email_data->subject;
				$message= $email_data->template;
				$admin_wallet=$this->CommonModel->getTableData("admin_wallet")->row();
				$conlink=base_url()."bitcowallet/Bowithdraw/withdraw_confirmation/".$token;
				$canlink=base_url()."bitcowallet/Bowithdraw/withdraw_cancellation/".$token;
				$site_data=site_settings();
				$sitename=$site_data->site_name;
				$data=array(
					
					"###CONFIRM###"=>$conlink,
					"###CANCEL###"=>$canlink,
					"###AMOUNT###"=>$amount,
					"###CURRENCY###"=>$currency,
					"###LOGOIMG###"=>getSiteLogo(),
					"###NAME###"=>$this->input->post("username"),
					"###EMAILIMG###"=>  base_url()."assets/frontend/images/email_send.png",
					"###FBIMG###"=> base_url()."assets/frontend/images/facebook.png",			
					"###TWIMG###"=> base_url()."assets/frontend/images/twitter.png",
					"###GPIMG###"=> base_url()."assets/frontend/images/gplus.png",
					"###LEIMG###"=> base_url()."assets/frontend/images/linkedin.png",	
					"###HDIMG###"=> base_url()."assets/frontend/images/email.png",
					"###FBLINK###"=> $site_data->facebooklink,				
					"###TWLINK###"=> $site_data->twitterlink,	
					"###GPLINK###"=> $site_data->googlelink,
					"###LELINK###"=> $site_data->linkedinlink,
					
				);


				$message=strtr($message,$data);	

				$email=$admin_wallet->email_id;			


				send_mail($email,$subject,$message);
				$this->session->set_flashdata('success', ' Success: Your request added successfully Please  confirm or cancel your email id.');
				wallet_redirect('Bowithdraw');

			}else{



				$siteDetails 				= $this->Wallet_model->getTableData(SETTINGS,array('id'=>1))->row_array();
				$data["all_currency"]=$this->CommonModel->getTableData("currency");
				$data['siteName'] 		= $siteDetails['site_name'];
				$data['copyRight'] 		= date('Y');
				$data['copySiteTitle'] 	= $siteDetails['site_name']." Admin";
				$data['title'] 			= "Withdraw Management | ".$siteDetails['site_name'];
				$data['keywords'] 		= "Withdraw Management | ".$siteDetails['site_name'];
				$data['description'] 	= "Withdraw Management | ".$siteDetails['site_name'];

				$this->load->view('admin_wallet/bowithdraw/editwithdraw',$data);
			}
			
		}
		else {
			wallet_redirect('Authentication');
		}
	}

	/**
	 * Function is used for get the particular cms page details
	 * @access public
	 * @return response success get the set of records or fail
	 * @author Osiz Technologies Pvt Ltd
	 */
	

	function withdraw_cancellation($link){		

		$loggedwalletuserid = $this->session->userdata('loggedwalletuserid');
		
		if(isset($loggedwalletuserid) && !empty($loggedwalletuserid)) {

			$siteDetails = $this->Wallet_model->getTableData(SETTINGS,array('id'=>1))->row_array();

			$token = $link;

			$row = $this->Wallet_model->getTableData(ADWITHDRAW, array('token'=>$token))->row();
			
			$Userid 	= 	$row->user_id;
			$Status 	= 	$row->status;		       

			if($Status=="cancelled" || $Status=="Completed")
			{			
				$this->session->set_flashdata('error', ' Error: Application has already been confirmed or canceled earlier');
				wallet_redirect('Bowithdraw');
			}
			else
			{		
				$updateData['status'] = "cancelled";
				$condition = array('token' => $token);
				$updated = $this->Wallet_model->updateTableData(ADWITHDRAW, $condition, $updateData);	
				if($updated)
				{
					$this->session->set_flashdata('success', ' Success: Your application successfully cancelled.');
					wallet_redirect('Bowithdraw');
				}	      			
			}

		}							
		else {
			wallet_redirect('Authentication');
		}
	}	

	function get_currancy_address($currancy){

	 $condition=array("admin_id"=>1,"currency_symbol"=>$currancy);
	 $address 		= $this->CommonModel->getTableData("admin_address",$condition)->row();

	 return $address->address;
	}


	function withdraw_confirmation($token=""){





		//error_reporting(-1);

		require_once("jsonRPCClient.php");
		


		$loggedwalletuserid = $this->session->userdata('loggedwalletuserid');
		
		if(isset($loggedwalletuserid) && !empty($loggedwalletuserid)){


			$row = $this->Wallet_model->getTableData(ADWITHDRAW, array('token'=>$token))->row();

			$data["withdraw_data"]=$row;			
			$Status 	= 	$row->status;


			if($Status=="cancelled" || $Status=="Completed")
			{			
				$this->session->set_flashdata('error', ' Error: Application has already been confirmed or canceled earlier');
				wallet_redirect("Bowithdraw/withdrawlist");
			}
			else
			{



				if($this->input->post("updatecmspage")){	
					$taken = $this->Wallet_model->getTableData(ADWITHDRAW, array('token'=>$token))->row();				

					$amount 		= 	$taken->askamount;
					$currency 		=   $taken->currency;
				//$wallet_type    =   $taken->wallet_type;
					$to_address 	=   $taken->to_address;
					require_once("jsonRPCClient.php");

					if($currency == 'BTC'){	


						$data=get_cn_data("BTC");
						$bitcoin_username 		= insep_decode($data['user']);	
						$bitcoin_password 		= insep_decode($data['password']);
						$bitcoin_ipaddress 	= insep_decode($data['ip']);	
						$bitcoin_portnumber = insep_decode($data['port']);

						$bitcoin 	= new jsonRPCClient("http://$bitcoin_username:$bitcoin_password@$bitcoin_ipaddress:$bitcoin_portnumber");
						$bal=$bitcoin->getbalance();
						if($bal>$amount){      
							$data=get_cn_data($currency);
							$bitcoin_username 		= insep_decode($data['user']);	
							$bitcoin_password 		= insep_decode($data['password']);
							$bitcoin_ipaddress 	= insep_decode($data['ip']);	
							$bitcoin_portnumber = insep_decode($data['port']);
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
								$txn_id       = 	$bitcoin->sendtoaddress($to_address,(float)$amount);			}
								else
								{
									$error_message=$check_wallet['message'];
									$this->session->set_flashdata("error",$error_message);
									wallet_redirect("Bowithdraw/withdrawlist");		


								}
							}

						}else if($currency == 'BCH'){	


							$data=get_cn_data("BCH");
							$bitcoin_username 		= insep_decode($data['user']);	
							$bitcoin_password 		= insep_decode($data['password']);
							$bitcoin_ipaddress 	= insep_decode($data['ip']);	
							$bitcoin_portnumber = insep_decode($data['port']);

							$bitcoin 	= new jsonRPCClient("http://$bitcoin_username:$bitcoin_password@$bitcoin_ipaddress:$bitcoin_portnumber");
							$bal=$bitcoin->getbalance();

							if($bal>$amount){      
								$data=get_cn_data($currency);
								$bitcoin_username 		= insep_decode($data['user']);	
								$bitcoin_password 		= insep_decode($data['password']);
								$bitcoin_ipaddress 	= insep_decode($data['ip']);	
								$bitcoin_portnumber = insep_decode($data['port']);
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
									$txn_id       = 	$bitcoin->sendtoaddress($to_address,(float)$amount);			}
									else
									{
										$error_message=$check_wallet['message'];
										$this->session->set_flashdata("error",$error_message);
										wallet_redirect("Bowithdraw/withdrawlist");		


									}
								}

							} 
							else if($currency == 'LTC'){	


								$data=get_cn_data("LTC");
								$bitcoin_username 		= insep_decode($data['user']);	
								$bitcoin_password 		= insep_decode($data['password']);
								$bitcoin_ipaddress 	= insep_decode($data['ip']);	
								$bitcoin_portnumber = insep_decode($data['port']);

								$bitcoin 	= new jsonRPCClient("http://$bitcoin_username:$bitcoin_password@$bitcoin_ipaddress:$bitcoin_portnumber");
								$bal=$bitcoin->getbalance();
								if($bal>$amount){      
									$data=get_cn_data($currency);
									$bitcoin_username 		= insep_decode($data['user']);	
									$bitcoin_password 		= insep_decode($data['password']);
									$bitcoin_ipaddress 	= insep_decode($data['ip']);	
									$bitcoin_portnumber = insep_decode($data['port']);
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
										$txn_id       = 	$bitcoin->sendtoaddress($to_address,(float)$amount);			}
										else
										{
											$error_message=$check_wallet['message'];
											$this->session->set_flashdata("error",$error_message);
											wallet_redirect("Bowithdraw/withdrawlist");		


										}
									}

								}   else if($currency == 'BTG'){	


									$data=get_cn_data("BTG");
									$bitcoin_username 		= insep_decode($data['user']);	
									$bitcoin_password 		= insep_decode($data['password']);
									$bitcoin_ipaddress 	= insep_decode($data['ip']);	
									$bitcoin_portnumber = insep_decode($data['port']);

									$bitcoin 	= new jsonRPCClient("http://$bitcoin_username:$bitcoin_password@$bitcoin_ipaddress:$bitcoin_portnumber");
									$bal=$bitcoin->getbalance();
									if($bal>$amount){      
										$data=get_cn_data($currency);
										$bitcoin_username 		= insep_decode($data['user']);	
										$bitcoin_password 		= insep_decode($data['password']);
										$bitcoin_ipaddress 	= insep_decode($data['ip']);	
										$bitcoin_portnumber = insep_decode($data['port']);
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
											$txn_id       = 	$bitcoin->sendtoaddress($to_address,(float)$amount);			}
											else
											{
												$error_message=$check_wallet['message'];
												$this->session->set_flashdata("error",$error_message);
												wallet_redirect("Bowithdraw/withdrawlist");		


											}
										}

									}else if($currency == 'DGB'){	


										$data=get_cn_data("DGB");
										$bitcoin_username 		= insep_decode($data['user']);	
										$bitcoin_password 		= insep_decode($data['password']);
										$bitcoin_ipaddress 	= insep_decode($data['ip']);	
										$bitcoin_portnumber = insep_decode($data['port']);

										$bitcoin 	= new jsonRPCClient("http://$bitcoin_username:$bitcoin_password@$bitcoin_ipaddress:$bitcoin_portnumber");
										$bal=$bitcoin->getbalance();
										if($bal>$amount){      
											$data=get_cn_data($currency);
											$bitcoin_username 		= insep_decode($data['user']);	
											$bitcoin_password 		= insep_decode($data['password']);
											$bitcoin_ipaddress 	= insep_decode($data['ip']);	
											$bitcoin_portnumber = insep_decode($data['port']);
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
												$txn_id       = 	$bitcoin->sendtoaddress($to_address,(float)$amount);			}
												else
												{
													$error_message=$check_wallet['message'];
													$this->session->set_flashdata("error",$error_message);
													wallet_redirect("Bowithdraw");		


												}
											}

										}else if($currency == 'DASH'){
											$data=get_cn_data("DASH");
											$bitcoin_username 		= insep_decode($data['user']);	
											$bitcoin_password 		= insep_decode($data['password']);
											$bitcoin_ipaddress 	= insep_decode($data['ip']);	
											$bitcoin_portnumber = insep_decode($data['port']);

											$bitcoin 	= new jsonRPCClient("http://$bitcoin_username:$bitcoin_password@$bitcoin_ipaddress:$bitcoin_portnumber");
											$bal=$bitcoin->getbalance();
											if($bal>$amount){      
												$data=get_cn_data($currency);
												$bitcoin_username 		= insep_decode($data['user']);	
												$bitcoin_password 		= insep_decode($data['password']);
												$bitcoin_ipaddress 	= insep_decode($data['ip']);	
												$bitcoin_portnumber = insep_decode($data['port']);
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
													$txn_id       = 	$bitcoin->sendtoaddress($to_address,(float)$amount);			}
													else
													{
														$error_message=$check_wallet['message'];
														$this->session->set_flashdata("error",$error_message);
														wallet_redirect("Bowithdraw");		


													}
												}

											}else  if($currency == 'ETH'){	

												$password=trim($this->input->post("password"));

												$bitcoin_row 		= get_cn_data($currency);
												$bitcoin_portnumber = insep_decode($bitcoin_row["port"]);
												$bitcoin_ipaddress 	= insep_decode($bitcoin_row["ip"]);	
												$adminEthAddr 		= $this->get_currancy_address($currency);			
												$sendAmount=$amount;
												$currencyToAddress=$to_address;
												$key=trim($this->input->post("password"));

												$data1 	    = array('port'=>$bitcoin_portnumber,'from'=>$adminEthAddr,'sendaddress'=>$currencyToAddress,'withdraw_amount'=>$sendAmount,'keyword' => '98543423','name'=>'bitcocyrus.com','key'=>$key,'method'=>'ethwithdraw');
												$output     = connecteth('ethwithdraw',$data1);		
												$txn_id 	= $output->result;
												if($txn_id==""){

													$this->session->set_flashdata("error","Withdraw failed");
													wallet_redirect("Bowithdraw/withdrawlist");	

												}
												

											}else  if($currency == 'ETC'){	

												$password=trim($this->input->post("password"));

												$bitcoin_row 		= get_cn_data($currency);
												$bitcoin_portnumber = insep_decode($bitcoin_row["port"]);
												$bitcoin_ipaddress 	= insep_decode($bitcoin_row["ip"]);	
												$adminEthAddr 		= $this->get_currancy_address($currency);			
												$sendAmount=$amount;
												$currencyToAddress=$to_address;
												$key=trim($this->input->post("password"));
												$data1 	    = array('port'=>$bitcoin_portnumber,'from'=>$adminEthAddr,'sendaddress'=>$currencyToAddress,'withdraw_amount'=>$sendAmount,'keyword' => '98543423','name'=>'bitcocyrus.com','key'=>$key,'method'=>'ethwithdraw');
												$output     = connectetc('ethwithdraw',$data1);		
												$txn_id 	= $output->result;

												if($txn_id==""){

													$this->session->set_flashdata("error","Withdraw failed");
													wallet_redirect("Bowithdraw/withdrawlist");	

												}


											}else  if($currency == 'XRP'){

												$from_address 		= $this->get_currancy_address($currency);	

												$to_address 	=   $taken->to_address;	  
												$tag 	=   $taken->xrp_tag;
												$from_secret=trim($this->input->post("password"));      	 	
												$this->wallet_dir 	= FCPATH.'ripple';
												$this->node_dir 	= '/usr/bin/node';
												$result = exec('cd '.$this->wallet_dir.'; '.$this->node_dir.' xrp_sent_withdrwal.js "'.$from_address.'" "'.$from_secret.'" "'.$to_address.'" "'.$amount.'" "'.$tag.'"',$output,$return_var);

												$txn_id="";
												if(isset($output[2])) {
													$rem = json_decode($output[2]);					

													if($rem->resultCode == "tesSUCCESS") {
														$res = json_decode($output[1]);
							//return $res->txid;
														$txn_id = $res->txid;


														if($txn_id) {

															$txn_id;
														}

													}
												}

											}
											
											else if($currency == 'XMR'){


												$to_address 	=   $taken->to_address;	  
												$payment_id 	=   $taken->payment_id;
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






					//$tx_hash = $wallet->getBalance();


			if($from_secret=="bitcocyrusxmr"){	

						$currancy ="XMR";
						$condition=array("address"=>$to_address,'payment_id'=>$payment_id);
						$userdata=$this->CommonModel->getTableData('address_balance',$condition);

							if($userdata->num_rows()==1){

								$userdata=$userdata->row();
								$user_id=$userdata->user_id;
								//$condition=array("user_id"=>$user_id);
								$condition=array("user_id"=>$user_id,"currency_symbol"=>$currancy);
								$wallet_balance=$this->CommonModel->getTableData("address_balance",$condition)->row();

								$updateBTCbalance     = $wallet_balance->balance + $amount;
										// insert data into transaction history
				 // for Update current coin balance
				$condition=array("user_id"=>$user_id,"currency_symbol"=>$currancy);
				$this->db->where($condition);
				$this->db->update('address_balance',array('balance'=>$updateBTCbalance));

				//echo $this->db->last_query();
				$time=time();
				$tax_id="internal-".md5($time);
				$userdata = array(
					'user_id' => $user_id,
					'type'=>1,
					'currency' => "XMR",	                  
					'total_amount' => $amount,
					'status' => "Completed",
					'transactionId'=>$tax_id
				); 


				$this->db->insert('tansation',$userdata);



			}else{


				$resonse = $wallet->transfer($options);			
				$res=json_decode($resonse);
				if($res->tx_hash) {
					$txn_id= $res->tx_hash;
				}else{
					$this->session->set_flashdata("error","Transation faild,Try agin some other time(".$res->message.")");
					wallet_redirect("Bowithdraw/withdrawlist");	
				}

			}
		}else{

			$this->session->set_flashdata("error","Invalid password");
			wallet_redirect("Bowithdraw/withdrawlist");
		} 	










	}	
	




		if($txn_id !='')
		{
			$updateData['txn_id'] = $txn_id;
			$updateData['status'] = "Completed";
			$condition = array('token' => $token);
			$confirmResult = $this->Wallet_model->updateTableData(ADWITHDRAW, $condition, $updateData);
			if($confirmResult)
			{
				$this->session->set_userdata('success', 'Your transaction has been success.');
				wallet_redirect("Bowithdraw/withdrawlist");
			} 
			else
			{
				$this->session->set_userdata('error', 'Error: Your transaction has been failed');   
				wallet_redirect("Bowithdraw/withdrawlist");					    
			}
		}
		else
		{
			       	  //  $this->session->set_userdata('error', 'Error: Your transaction has been failed');
						//wallet_redirect("Bowithdraw/withdrawlist");				 
		}	
}else{


	$siteDetails 				= $this->Wallet_model->getTableData(SETTINGS,array('id'=>1))->row_array();

	$data['siteName'] 		= $siteDetails['site_name'];
	$data['copyRight'] 		= date('Y');
	$data['copySiteTitle'] 	= $siteDetails['site_name']." Admin";
	$data['title'] 			= "Admin Withdrawlist | ".$siteDetails['site_name'];
	$data['keywords'] 		= "Admin Withdrawlist | ".$siteDetails['site_name'];
	$data['description'] 	= "Admin Withdrawlist | ".$siteDetails['site_name'];


	$this->load->view('admin_wallet/bowithdraw/withdraw_confirm',$data);
}

}


}
else {
	wallet_redirect('Authentication');
}
}

	function withdrawlist() {


		$loggedwalletuserid = $this->session->userdata('loggedwalletuserid');

		if(isset($loggedwalletuserid) && !empty($loggedwalletuserid)){

			$data['getcmsPages'] 	=  $this->Wallet_model->getTableData(ADWITHDRAW,'','','','','','','',array('with_id','desc'))->result();		



			$siteDetails 				= $this->Wallet_model->getTableData(SETTINGS,array('id'=>1))->row_array();

			$data['siteName'] 		= $siteDetails['site_name'];
			$data['copyRight'] 		= date('Y');
			$data['copySiteTitle'] 	= $siteDetails['site_name']." Admin";
			$data['title'] 			= "Admin Withdrawlist | ".$siteDetails['site_name'];
			$data['keywords'] 		= "Admin Withdrawlist | ".$siteDetails['site_name'];
			$data['description'] 	= "Admin Withdrawlist | ".$siteDetails['site_name'];

			$this->load->view('admin_wallet/bowithdraw/bowithdraw',$data);
		}
		else {
			admin_redirect('Authentication');
		}
	}

}

?>
