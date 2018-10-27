<?php
	// FINAL - Trade Library - Created by Balaji

class Tradelib {
    private $ci;
function __construct()
	{
		$this->ci =& get_instance();
		//$this->api     = new Poloniex();
		//$this->lending_api     = new Lendinglib();
	}
function createOrder($user_id,$amount,$price=0,$total,$fee,$pair_id,$ordertype,$type,$loan_rate='',$pagetype='',$stoplimit=0)
	{
		$response=array('status'=>'','msg'=>'');
		$reorder=0;
		$pair_details = $this->ci->common_model->getTableData('trade_pairs',array('id'=>$pair_id),'from_symbol_id,to_symbol_id,min_trade_amount');

		$this->trade_prices($pair_id,$user_id);
		$calculate_price=$this->price_calculation($ordertype,$type,$amount,$price);
		$total=$calculate_price->tot;
		$fees=$calculate_price->fees;
		$fee=$calculate_price->fee;
		$price=$calculate_price->price;
		if($total < $pair_details->row('min_trade_amount'))
		{
			$response['status'] = "minimum_amount"; 
			return $response; exit;
		}
		if($type == "buy")
		{
			$currency = $pair_details->row('to_symbol_id');
		}
		else
		{
			$currency = $pair_details->row('from_symbol_id');
		}
		if($amount==0 || $price==0 || $amount=="" || $price=="")
		{   
			$response['status'] = "balance";
		}
		else
		{
			if($reorder==1)
			{
				if($type == "buy")
				{
					$balance = $total;
				}
				else
				{
					$balance = $amount;
				}
			}
			else
			{
				
					$balance = getBalance($user_id,$currency);
				
			}
			if(($total <= $balance && $type == "buy")||($amount <= $balance && $type == "sell"))
			{

				$current_date           =   date('Y-m-d');
				$current_time           =   date('H:i A');
				if($pagetype=='margin')
				{
					$status= "active"; 
					$wallet='Margin Trading';
				}
				else
				{

					if($ordertype=='stop_limit')
					{
						$status         = "stoplimit"; 

					}
					else
					{
						$status         = "active";
					}
					$wallet='Exchange AND Trading';
				}
				if($pagetype!='margin')
				{
					if($type == "buy")
					{
						$Balance    = $balance-$total;
					}
					else
					{
						$Balance    = $balance-$amount;
					}
					$updatequery = updateBalance($user_id,$currency,$Balance);
				}
				else
				{
					$updatequery = 1;
				}
				if($updatequery)
				{
					$micro_date = microtime();
					$date_array = explode(" ",$micro_date);
					$date = date("Y-m-d H:i:s",$date_array[1]);
					$microtime = $date."_".$date_array[0];
					$datetime   =date("Y-m-d H:i:s");
					if($ordertype=='stop_limit')
					{

						
						$data    =   array(
									'userId'		=>$user_id,
									'Amount'		=>$amount,
									'stoporderprice'=>$price,
									'ordertype'		=>'stoplimit',
									'trigger_price'=>$stoplimit,
									'Fee'			=>$fees,
									'Total'			=>$total,
									'Price'			=>$price,
									'Type'			=>$type,
									'orderDate'		=>$current_date,
									'orderTime'		=>$current_time,
									'datetime'		=>$datetime,
									'tradetime'		=>$datetime,
									'pair'			=>$pair_id,
									'status'		=>'stoporder',
									'fee_per'		=>$fee,
									'wallet'		=>$wallet
									);
					}
					else
					{
						$data   =   array(
									'userId'	=>$user_id,
									'Amount'	=>$amount,
									'ordertype'	=>$ordertype,
									'Fee'		=>$fees,
									'Total'		=>$total,
									'Price'		=>$price,
									'Type'		=>$type,
									'orderDate'	=>$current_date,
									'orderTime'	=>$current_time,
									'datetime'	=>$datetime,
									'tradetime'	=>$datetime,
									'pair'		=>$pair_id,
									'status'	=>$status,
									'fee_per'	=>$fee,
									'wallet'		=>$wallet
									); 
					}

			


					$insid=$this->ci->common_model->insertTableData('coin_order', $data);
				





				 $response['status'] = $this->mapping($insid);

				
					$x = $this->ci->common_model->getTableData('coin_order',array('trade_id'=>$insid))->row();
					if($type == "buy")
					{
						$ordertype_res = 'buyorderId';
					}
					else
					{
						$ordertype_res = 'sellorderId';
					}
					/*if($pagetype!='margin'||$reorder==1)
					{
						//$remarket=getSiteSettings('remarket_concept');
						//if($remarket==1)
						//{
							//$this->integrate_remarket($insid);
						//}
					}*/
					$Sumamount 		= $this->checkOrdertemp($insid,$ordertype_res);
					if($Sumamount)
					{
						$x->filledAmount=$Sumamount;
					}
					else
					{
						$x->filledAmount=0;
					}
					$response['msg']=$x;
				}
				else
				{
					$response['status'] = "balance";
				}
			}
			else
			{
				$response['status'] = "balance";
			}
		}
		return $response;
	}

function trade_prices($pair,$user_id='')
{
	$this->lowestaskprice = lowestaskprice($pair);
	$this->highestbidprice = highestbidprice($pair);
	$this->lastmarketprice = lastmarketprice($pair);
	$this->minimum_trade_amount = get_min_trade_amt($pair);
	$getfeedetails= getfeedetails($pair,$user_id);
	if($getfeedetails){

	$this->maker=$getfeedetails->maker;
	$this->taker=$getfeedetails->taker;
	}else{
		$this->maker=0;
		$this->taker=0;	
	}
	if($user_id)
	{
		$this->user_id = $user_id;
		$this->user_balance = getBalance($user_id);
	}
	else
	{
		$this->user_id = 0;
		$this->user_balance = 0;
	}
}
function price_calculation($order_type,$a,$amount,$price)
{
	$maker_fee=$this->maker;
	$taker_fee=$this->taker;
	if($order_type=='instant')
	{
		$liquidity = $this->ci->common_model->getTableData('site_settings',array('id'=>1),'liquidity_concept')->row('liquidity_concept');
		if($a=='buy')
		{
			if($liquidity!=1)
			{
				$price=$this->lowestaskprice;
			}
			$tot   = floatval($amount)*floatval($this->lowestaskprice);
			$fees  = floatval($amount)*floatval($this->lowestaskprice)*$maker_fee/100;
			$fee=$maker_fee;
			if($tot>0)
			{
				$tot = $tot+$fees;
			}
			else
			{
				$tot = 0;
			}
		}
		else
		{
			if($liquidity!=1)
			{
				$price=$this->highestbidprice;
			}
			$tot   = floatval($amount)*floatval($this->highestbidprice);
			$fees  = floatval($amount)*floatval($this->highestbidprice)*$taker_fee/100;
			$fee=$taker_fee;
			if($tot>0)
			{
				$tot = $tot-$fees;
			}
			else
			{
				$tot = 0;
			}
		}
	}
	else
	{
		if($a=='buy')
		{
			$tot   = floatval($amount)*floatval($price);
			$fees  = floatval($amount)*floatval($price)*$maker_fee/100;
			$fee=$maker_fee;
			if($tot>0)
			{
				$tot = $tot+$fees;
			}
			else
			{
				$tot = 0;
			}
		}
		else
		{
			$tot   = floatval($amount)*floatval($price);
			$fees  = floatval($amount)*floatval($price)*$taker_fee/100;
			$fee=$taker_fee;
			if($tot>0)
			{
				$tot = $tot-$fees;
			}
			else
			{
				$tot = 0;
			}
		}
	}
	$x = new stdClass();
	$x->tot =$tot;
	$x->fees =$fees;
	$x->fee =$fee;
	$x->price =$price;
	return $x;
}
function mapping($res)
{

	$buy = $this->ci->common_model->getTableData('coin_order',array('trade_id'=>$res))->row();
	 $pair_id=$buy->pair;
	//$this->check_stop_order($pair_id);	
	$this->check_stop_limt_order($pair_id);
	$this->initialize_mapping($res);
	//$this->check_stop_order($pair_id);
	$this->check_stop_limt_order($pair_id);		
	return "success";
}
function initialize_mapping($res)
{
	$names = array('active', 'partially');
	$where_in=array('status', $names);
	$buy = $this->ci->common_model->getTableData('coin_order',array('trade_id'=>$res),'','','','','','','','','',$where_in)->row();
	if($buy)
	{
		$pair_id=$buy->pair;
		if($buy->Type=='buy')
		{
			$final="";
			$buyorderId         = 	$buy->trade_id; 
			$buyuserId          = 	$buy->userId;
			$buyPrice           = 	$buy->Price;
			$buyOrertype        = 	$buy->ordertype;
			$buyPrice           = 	(float)$buyPrice;
			$buyAmount          = 	(float)$buy->Amount;
			$pair   			= 	$buy->pair;
			$buyWallet 			=	$buy->wallet;
			$Total				=	$buy->Total;
			$Fee				=	$buy->Fee;
			$buy_fee_per		=    $buy->fee_per;
			$buy_fee				=$buy->Fee;
			$fetchsellRecords 	= 	$this->getParticularsellorders($buyPrice,$buyuserId,$pair,$buyOrertype);
			if($fetchsellRecords)
			{
				$pair_details = $this->ci->common_model->getTableData('trade_pairs',array('id'=>$pair),'from_symbol_id,to_symbol_id')->row();
				$k=0;
				foreach($fetchsellRecords as $sell)
				{
					$k++;
					$sellorderId        = $sell->trade_id;
					$selluserId         = $sell->userId;
					$sellPrice          = $sell->Price;
					$sellOrdertype      = $sell->ordertype;
					$sellAmount         = $sell->Amount;
					$sellWallet        	= $sell->wallet;
					$pair   			= $sell->pair;
					$sellstatus  		= $sell->status;
					$Total1				= $sell->Total;
					$sell_fee_per		= $sell->fee_per;	
					$Fee1				= $sell->Fee;
					$sell_fee			=	$sell->Fee;
						$sell_fee_per	=    $sell->fee_per;




					$sellSumamount 		= $this->checkOrdertemp($sellorderId,'sellorderId');
					if($sellSumamount)
					{
						$approxiAmount = $sellAmount-$sellSumamount;
						$approxiAmount=number_format($approxiAmount,8,'.','');
					}
					else
					{
						$approxiAmount = $sellAmount;
					}
					$buySumamount      = $this->checkOrdertemp($buyorderId,'buyorderId');
					if($buySumamount)
					{
						$buySumamount = $buyAmount-$buySumamount;
						$buySumamount=number_format($buySumamount,8,'.','');
					}
					else
					{
						$buySumamount = $buyAmount;
					}
					if($approxiAmount >= $buySumamount)
					{
						$amount = $buySumamount;
					}
					else
					{
						$amount = $approxiAmount;
					}
					if($approxiAmount!=0&&$buySumamount!=0)
					{
						$date               =   date('Y-m-d');
						$time               =   date("H:i:s");
						$datetime           =   date("Y-m-d H:i:s");
						$data               =   array(
									'sellorderId'       =>  $sellorderId,
									'sellerUserid'      =>  $selluserId,
									'askAmount'         =>  $sellAmount,
									'askPrice'          =>  $sellPrice,
									'filledAmount'      =>  $amount,
									'buyorderId'        =>  $buyorderId,
									'buyerUserid'       =>  $buyuserId,
									'sellerStatus'      =>  "inactive",
									'buyerStatus'       =>  "inactive",
									"pair"              =>  $pair,
									"datetime"          =>  $datetime,

									"firstCurrency"=>$pair_details->from_symbol_id,
									"secondCurrency"=>$pair_details->to_symbol_id,
									"volume"=>$amount*$sellPrice,
								);


						$inserted=$this->ci->common_model->insertTableData('ordertemp', $data);


						//Commission Come 



						$theftprice=0;
						if($inserted)
						{
							if($buyPrice>$sellPrice)
							{
								/* $price1=$buyPrice-$sellPrice;
								$theftprice=$buyAmount*$price1; */
								// Jatin Change in trade lib 16-6-18
								//chnage by navneet 30-06-2018
								$price1=$buyPrice-$sellPrice;
								$theftprice=$amount*$price1; 
								$theftdata   = array(
										'userId'        =>  $buyuserId,
										'theftAmount'   =>  $theftprice,
										'theftCurrency' =>  $pair_details->to_symbol_id,
										'date'          =>  $date,
										'time'          =>  $time,
										'theftOrderId'  =>  $buyorderId
										);
								$this->ci->common_model->insertTableData('coin_theft', $theftdata);

								$userbalance            = getBalance($buyuserId,$pair_details->to_symbol_id);
							$updatebuyBalance       =   $userbalance+$theftprice;
							updateBalance($buyuserId,$pair_details->to_symbol_id,$updatebuyBalance);	

	
							//	echo  $this->ci->db->last_query()."----";			

							}




								


						 

						 








							if(trim($approxiAmount)==trim($amount))
							{



							//Notification
								$this->ordercompletetype($sellorderId,"sell",$inserted);
								$trans_data = array(
								'userId'=>$selluserId,
								'type'=>'Sell',
								'currency'=>$pair_details->to_symbol_id,
								'amount'=>$Total1+$Fee1,
								'profit_amount'=>$Fee1,
								'comment'=>'Trade Sell order #'.$sellorderId,
								'datetime'=>date('Y-m-d h:i:s'),
								'currency_type'=>'crypto'
								);
								$update_trans = $this->ci->common_model->insertTableData('transaction_history',$trans_data);

								//Filled
								
								$condition=array("user_id"=>$selluserId,'refer_id !='=>"");
								$userdata=$this->ci->common_model->getTableData('userdetails',$condition);
								if($userdata->num_rows() > 0 ){
									
									$userdata=$userdata->row();
						 			$user_code= $userdata->refer_id;
						 			$condition=array("user_code"=>$userdata->refer_id);
					
						 			$prouser_userdata=$this->ci->common_model->getTableData('userdetails',$condition)->row();
						 			$profit_user_id=$prouser_userdata->user_id;
						 			$commission_data = $this->ci->common_model->getTableData('site_settings')->row();

						 		$commission_per=$commission_data->referal_commission;



						 	//	$commission=$sell_fee*$commission_per/100;

						 		$comission=($amount*$sellPrice*$sell_fee_per)/100;
						 		$commission=$comission*$commission_per/100;



						 		$comm_transation['user_id']=$profit_user_id;
						 		$comm_transation['refer_user']=$userdata->user_code;
						 		$comm_transation['comission']=$commission_per;
						 		$comm_transation['trde_amount']=$Total;

						 		$comm_transation['currency']=get_currency($pair_details->to_symbol_id);;
						 		$comm_transation['type']="SELL";
						 		$comm_transation['commission_amount']=$commission;
						 		$this->ci->common_model->insertTableData('commission_history',$comm_transation);
						 		$condition=array("user_id"=>$selluserId);
						 		$updata['refer_paid_status']="Paid";;
						 		$this->ci->common_model->updateTableData('userdetails',$condition,$updata);
						 		//Balance Update
						 		$userbalance            = getBalance($profit_user_id,$pair_details->to_symbol_id);
							$updatebuyBalance       =   $userbalance+$commission;
							updateBalance($profit_user_id,$pair_details->to_symbol_id,$updatebuyBalance);	

							//echo "444444";
							//exit;
					
					 
						 }
							}
							else
							{


								$this->orderpartialtype($sellorderId,"sell",$inserted);
								$this->ci->common_model->updateTableData('coin_order',array('trade_id'=>$sellorderId),array('status'=>"partially",'tradetime'=>date('Y-m-d H:i:s')));
							}
							//$this->integrate_remarket($sellorderId);
							if((trim($approxiAmount)==trim($buySumamount))||($approxiAmount>$buySumamount))
							{
								$this->ordercompletetype($buyorderId,"buy",$inserted);
								$trans_data = array(
								'userId'=>$buyuserId,
								'type'=>'Buy',
								'currency'=>$pair_details->to_symbol_id,
								'amount'=>$Total,
								'profit_amount'=>$Fee,
								'comment'=>'Trade Buy order #'.$buyorderId,
								'datetime'=>date('Y-m-d h:i:s'),
								'currency_type'=>'crypto',
								'bonus_amount'=>$theftprice
								);
								$update_trans = $this->ci->common_model->insertTableData('transaction_history',$trans_data);
								
								$condition=array("user_id"=>$buyuserId,'refer_id !='=>"");
								$userdata=$this->ci->common_model->getTableData('userdetails',$condition);
								if($userdata->num_rows() > 0 ){

									//echo "buy111"; exit;
									$userdata=$userdata->row();
						 			$user_code= $userdata->refer_id;
						 			$condition=array("user_code"=>$userdata->refer_id);
					
						 			$prouser_userdata=$this->ci->common_model->getTableData('userdetails',$condition)->row();
						 			$profit_user_id=$prouser_userdata->user_id;
						 			$commission_data = $this->ci->common_model->getTableData('site_settings')->row();

						 		$commission_per=$commission_data->referal_commission;
						 		
								//$sell_fee_per				= $sell->Fee_per;	
						 		$comission=($amount*$buyPrice*$buy_fee_per)/100;

						 		$commission=$comission*$commission_per/100;
						 			//	echo "amount"+$amount+"buyPrice"+$buyPrice+"$buy_fee_per"+$buy_fee_per;
						 		

						 		$comm_transation['user_id']=$profit_user_id;
						 		$comm_transation['refer_user']=$userdata->user_code;
						 		$comm_transation['comission']=$commission_per;
						 		$comm_transation['trde_amount']=$Total;

						 		$comm_transation['currency']=get_currency($pair_details->to_symbol_id);;
						 		$comm_transation['type']="BUY";
						 		$comm_transation['commission_amount']=$commission;
						 		$this->ci->common_model->insertTableData('commission_history',$comm_transation);

						 		$condition=array("user_id"=>$buyuserId);
						 		//$updata['refer_paid_status']="Paid";;
						 		//$this->ci->common_model->updateTableData('userdetails',$condition,$updata);
						 		//Balance Update
						 		$userbalance            = getBalance($profit_user_id,$pair_details->to_symbol_id);
							$updatebuyBalance       =   $userbalance+$commission;
							updateBalance($profit_user_id,$pair_details->to_symbol_id,$updatebuyBalance);		

									
							//echo "333333";
							//exit;		
					 
						 }
							}
							else
							{
								$this->orderpartialtype($buyorderId,"buy",$inserted);
								$this->ci->common_model->updateTableData('coin_order',array('trade_id'=>$buyorderId),array('status'=>"partially",'tradetime'=>date('Y-m-d H:i:s')));
							}
						}
					}
					else
					{
						break;
					}
				} 
			}
		}
		else if($buy->Type=='sell')
		{
			$sell=$buy;
			$final="";
			$sellorderId         = 	$sell->trade_id; 
			$selluserId          = 	$sell->userId;
			$sellPrice           = 	$sell->Price;
			$sellOrertype        = 	$sell->ordertype;
			$sellPrice           = 	(float)$sellPrice;
			$sellAmount          = 	(float)$sell->Amount;
			$pair   			= 	$sell->pair;
			$sellWallet 			=	$sell->wallet;
			$Total1				=	$sell->Total;
			$Fee1				=	$sell->Fee;

			$sell_fee				=	$sell->Fee;
			$sell_fee_per		=    $sell->fee_per;
			$fetchbuyRecords 	= 	$this->getParticularbuyorders($sellPrice,$selluserId,$pair);
			if($fetchbuyRecords)
			{
				$pair_details = $this->ci->common_model->getTableData('trade_pairs',array('id'=>$pair),'from_symbol_id,to_symbol_id')->row();
				$k=0;
				foreach($fetchbuyRecords as $buy)
				{
					$k++;
					$buyorderId        = $buy->trade_id;
					$buyuserId         = $buy->userId;
					$buyPrice          = $buy->Price;
					$buyOrdertype      = $buy->ordertype;
					$buyAmount         = $buy->Amount;
					$buyWallet        	= $buy->wallet;
					$pair   			= $buy->pair;
					$buystatus  		= $buy->status;
					$Total				=	$buy->Total;
					$Fee				=	$buy->Fee;
					$buy_fee				=	$buy->Fee;
						$buy_fee_per		=    $buy->fee_per;
					$buySumamount 		= $this->checkOrdertemp($buyorderId,'buyorderId');
					if($buySumamount)
					{
						$approxiAmount = $buyAmount-$buySumamount;
						$approxiAmount=number_format($approxiAmount,8,'.','');
					}
					else
					{
						$approxiAmount = $buyAmount;
					}
					$sellSumamount      = $this->checkOrdertemp($sellorderId,'sellorderId');
					if($sellSumamount)
					{
						$sellSumamount = $sellAmount-$sellSumamount;
						$sellSumamount=number_format($sellSumamount,8,'.','');
					}
					else
					{
						$sellSumamount = $sellAmount;
					}
					if($approxiAmount >= $sellSumamount)
					{
						$amount = $sellSumamount;
					}
					else
					{
						$amount = $approxiAmount;
					}
					if($approxiAmount!=0&&$sellSumamount!=0)
					{
						$date               =   date('Y-m-d');
						$time               =   date("H:i:s");
						$datetime           =   date("Y-m-d H:i:s");
						$data               =   array(
												'sellorderId'       =>  $sellorderId,
												'sellerUserid'      =>  $selluserId,
												'askAmount'         =>  $sellAmount,
												'askPrice'          =>  $sellPrice,
												'filledAmount'      =>  $amount,
												'buyorderId'        =>  $buyorderId,
												'buyerUserid'       =>  $buyuserId,
												'sellerStatus'      =>  "inactive",
												'buyerStatus'       =>  "inactive",
												"pair"              =>  $pair,
												"datetime"          =>  $datetime,
												"firstCurrency"=>$pair_details->from_symbol_id,
												"secondCurrency"=>$pair_details->to_symbol_id,
												"volume"=>$amount*$sellPrice,
												);
						$inserted=$this->ci->common_model->insertTableData('ordertemp', $data);
						$theftprice=0;
						if($inserted)
						{
							if($sellPrice<$buyPrice)
							{
							//chnage by navneet 30-06-2018
								$price1=$buyPrice-$sellPrice;
								$theftprice= $amount*$price1;
								$theftdata   = array(
										'userId'        =>  $selluserId,
										'theftAmount'   =>  $theftprice,
										'theftCurrency' =>  $pair_details->to_symbol_id,
										'date'          =>  $date,
										'time'          =>  $time,
										'theftOrderId'  =>  $buyorderId
										);
								$this->ci->common_model->insertTableData('coin_theft', $theftdata);

								$userbalance            = getBalance($buyuserId,$pair_details->to_symbol_id);
							$updatebuyBalance       =   $userbalance+$theftprice;
							updateBalance($buyuserId,$pair_details->to_symbol_id,$updatebuyBalance);	
							

							}



								




						 





							if(trim($approxiAmount)==trim($amount))
							{


								



						$this->ordercompletetype($buyorderId,"buy",$inserted);
								$trans_data = array(
								'userId'=>$buyuserId,
								'type'=>'Buy',
								'currency'=>$pair_details->to_symbol_id,
								'amount'=>$Total,
								'profit_amount'=>$Fee,
								'comment'=>'Trade Buy order #'.$buyorderId,
								'datetime'=>date('Y-m-d h:i:s'),
								'currency_type'=>'crypto',
								'bonus_amount'=>$theftprice
								);
								$update_trans = $this->ci->common_model->insertTableData('transaction_history',$trans_data);
								
								$condition=array("user_id"=>$buyuserId,'refer_id !='=>"");
								$userdata=$this->ci->common_model->getTableData('userdetails',$condition);
								if($userdata->num_rows() > 0 ){
									$userdata=$userdata->row();
						 			$user_code= $userdata->refer_id;
						 			$condition=array("user_code"=>$userdata->refer_id);
					
						 			$prouser_userdata=$this->ci->common_model->getTableData('userdetails',$condition)->row();
						 			$profit_user_id=$prouser_userdata->user_id;
						 			$commission_data = $this->ci->common_model->getTableData('site_settings')->row();

						 		$commission_per=$commission_data->referal_commission;
						 		//$commission=$buy_fee*$commission_per/100;

						 			$comission=($amount*$buyPrice*$buy_fee_per)/100;

						 		//	echo "amount"+$amount+"buyPrice"+$buyPrice+"$buy_fee_per"+$buy_fee_per;
						 		$commission=$comission*$commission_per/100;
						 		$comm_transation['user_id']=$profit_user_id;
						 		$comm_transation['refer_user']=$userdata->user_code;
						 		$comm_transation['comission']=$commission_per;
						 		$comm_transation['trde_amount']=$Total;

						 		$comm_transation['currency']=get_currency($pair_details->to_symbol_id);;
						 		$comm_transation['type']="BUY";
						 		$comm_transation['commission_amount']=$commission;
						 		$this->ci->common_model->insertTableData('commission_history',$comm_transation);

						 		$condition=array("user_id"=>$buyuserId);
						 		//$updata['refer_paid_status']="Paid";;
						 		//$this->ci->common_model->updateTableData('userdetails',$condition,$updata);
						 		//Balance Update
						 		$userbalance            = getBalance($profit_user_id,$pair_details->to_symbol_id);
							$updatebuyBalance       =   $userbalance+$commission;
							updateBalance($profit_user_id,$pair_details->to_symbol_id,$updatebuyBalance);


							//echo "111111";
							///exit;
							
					 
						 }
							}
							else
							{

							
								$this->orderpartialtype($buyorderId,"buy",$inserted);
								$this->ci->common_model->updateTableData('coin_order',array('trade_id'=>$buyorderId),array('status'=>"partially",'tradetime'=>date('Y-m-d H:i:s')));



							}
							//$this->integrate_remarket($buyorderId);
							if((trim($approxiAmount)>=trim($sellSumamount)))
							{
								$this->ordercompletetype($sellorderId,"sell",$inserted);
								$trans_data = array(
								'userId'=>$selluserId,
								'type'=>'Sell',
								'currency'=>$pair_details->to_symbol_id,
								'amount'=>$Total1+$Fee1,
								'profit_amount'=>$Fee1,
								'comment'=>'Trade Sell order #'.$sellorderId,
								'datetime'=>date('Y-m-d h:i:s'),
								'currency_type'=>'crypto',
								);
								$update_trans = $this->ci->common_model->insertTableData('transaction_history',$trans_data);
								
								$condition=array("user_id"=>$selluserId,'refer_id !='=>"");
								$userdata=$this->ci->common_model->getTableData('userdetails',$condition);
								if($userdata->num_rows() > 0 ){

									//echo "sell2222"; exit;
									$userdata=$userdata->row();
						 			$user_code= $userdata->refer_id;
						 			$condition=array("user_code"=>$userdata->refer_id);
					
						 			$prouser_userdata=$this->ci->common_model->getTableData('userdetails',$condition)->row();
						 			$profit_user_id=$prouser_userdata->user_id;
						 			$commission_data = $this->ci->common_model->getTableData('site_settings')->row();

						 		$commission_per=$commission_data->referal_commission;
						 		$comission=($amount*$sellPrice*$sell_fee_per)/100;
						 		$commission=$comission*$commission_per/100;

						 	//		echo "amount"+$amount+"sellPrice"+$sellPrice+"$buy_fee_per"+$selle_fee_per;

						 		$comm_transation['user_id']=$profit_user_id;
						 		$comm_transation['refer_user']=$userdata->user_code;
						 		$comm_transation['comission']=$commission_per;
						 		$comm_transation['trde_amount']=$Total;

						 		$comm_transation['currency']=get_currency($pair_details->to_symbol_id);;
						 		$comm_transation['type']="SELL";
						 		$comm_transation['commission_amount']=$commission;
						 		$this->ci->common_model->insertTableData('commission_history',$comm_transation);
						 		$condition=array("user_id"=>$selluserId);
						 		//$updata['refer_paid_status']="Paid";;
						 		//$this->ci->common_model->updateTableData('userdetails',$condition,$updata);
						 		//Balance Update
						 		$userbalance            = getBalance($profit_user_id,$pair_details->to_symbol_id);
							$updatebuyBalance       =   $userbalance+$commission;
							updateBalance($profit_user_id,$pair_details->to_symbol_id,$updatebuyBalance);	


							//echo "222222";
							//exit;	
					
					 
						 }
								
							}
							else
							{


								//echo "exit";
								//exit;

								$this->orderpartialtype($sellorderId,"sell",$inserted);
								$this->ci->common_model->updateTableData('coin_order',array('trade_id'=>$sellorderId),array('status'=>"partially",'tradetime'=>date('Y-m-d H:i:s')));
							} 
						}
					}
					else
					{
						break;
					}
				} 
			}
		}
	}
}

function check_stop_limt_order($pair)
{

	$this->trade_prices($pair);	
	$buy_rate = $this->lowestaskprice;
	$sell_rate = $this->highestbidprice;
	$sell_rate = (float)$sell_rate;
	$buy_rate = (float)$buy_rate;

 
	$stop_orders = $this->ci->common_model->getTableData('coin_order',array('trigger_price >='=>$sell_rate,'Type'=>'sell','status'=>'stoplimit'))->result();

	if($stop_orders)
	{
		foreach($stop_orders as $sell_row)
		{
			$trade_id       = $sell_row->trade_id;
			$stoporderprice = $sell_row->stoporderprice;

			$this->ci->common_model->updateTableData('coin_order',array('trade_id'=>$trade_id),array('Price'=>$stoporderprice,'status'=>'active'));
			$this->initialize_mapping($trade_id);
		}
	}
	$buystop_orders = $this->ci->common_model->getTableData('coin_order',array('trigger_price <='=>$buy_rate,'Type'=>'buy','status'=>'stoplimit'))->result();
	if($buystop_orders)
	{
		foreach($buystop_orders as $buy_row)
		{
			$trade_id       = $buy_row->trade_id;
			$stoporderprice = $buy_row->stoporderprice;
			$this->ci->common_model->updateTableData('coin_order',array('trade_id'=>$trade_id),array('status'=>'active'));
			$this->initialize_mapping($trade_id);
		}  
	}

}





function check_stop_order($pair)
{
	$this->trade_prices($pair);
	$buy_rate = $this->lowestaskprice;
	$sell_rate = $this->highestbidprice;
	$sell_rate = (float)$sell_rate;
	$buy_rate = (float)$buy_rate;
	$stop_orders = $this->ci->common_model->getTableData('coin_order',array('stoporderprice >='=>$sell_rate,'Type'=>'sell','status'=>'stoporder'))->result();
	if($stop_orders)
	{
		foreach($stop_orders as $sell_row)
		{
			$trade_id       = $sell_row->trade_id;
			$stoporderprice = $sell_row->stoporderprice;				
			$this->ci->common_model->updateTableData('coin_order',array('trade_id'=>$trade_id),array('Price'=>$stoporderprice,'status'=>'active'));
			$this->initialize_mapping($trade_id);
		}
	}
	$buystop_orders = $this->ci->common_model->getTableData('coin_order',array('stoporderprice <='=>$buy_rate,'Type'=>'buy','status'=>'stoporder'))->result();
	if($buystop_orders)
	{
		foreach($buystop_orders as $buy_row)
		{
			$trade_id       = $buy_row->trade_id;
			$stoporderprice = $buy_row->stoporderprice;
			$this->ci->common_model->updateTableData('coin_order',array('trade_id'=>$trade_id),array('status'=>'active'));
			$this->initialize_mapping($trade_id);
		}  
	}
}
function getParticularsellorders($buyPrice,$buyuserId,$pair)
{
	$names = array('active', 'partially');
	$where_in=array('status', $names);
	$order_by = array('Price','asc');
	$query = $this->ci->common_model->getTableData('coin_order',array('pair'=>$pair,'userId !='=>$buyuserId,'Type'=>'Sell','Price <='=>$buyPrice),'','','','','','',$order_by,'','',$where_in);
	if($query->num_rows() >= 1)
	{
		return $query->result();
	}
	else
	{
		return false;
	}
} 
function getParticularbuyorders($sellPrice,$selluserId,$pair)
{
	$names = array('active', 'partially');
	$where_in=array('status', $names);
	$order_by = array('Price','desc');
	$query = $this->ci->common_model->getTableData('coin_order',array('pair'=>$pair,'userId !='=>$selluserId,'Type'=>'Buy','Price >='=>$sellPrice),'','','','','','',$order_by,'','',$where_in);
	if($query->num_rows() >= 1)
	{
		return $query->result();
	}
	else
	{
		return false;
	}
} 
function checkOrdertemp($id,$type)
{
	$query = $this->ci->common_model->getTableData('ordertemp',array($type=>$id),'SUM(filledAmount) as totalamount');
	if($query->num_rows() >= 1)
	{
		$row = $query->row();
		return $row->totalamount;
	}
	else
	{
		return false;
	}
}
function ordercompletetype($orderId,$type,$inserted)
{
	$trade_execution_type = $this->ci->common_model->getTableData('site_settings',array('id'=>1),'trade_execution_type')->row('trade_execution_type');
	if($trade_execution_type==1)
	{
		$this->removeOrder($orderId,$inserted);
	}
	else
	{
		$this->partial_balanceupdate($orderId,$inserted);
	}
	$current_time = date("Y-m-d H:i:s");
	$query  =   $this->ci->common_model->updateTableData('coin_order',array('trade_id'=>$orderId),array('status'=>"filled",'datetime'=>$current_time));
	if($type=="buy")
	{
		$data = array('buyerStatus'=>"active");
		$where = array('tempId'=>$inserted,'buyorderId'=>$orderId);
	}
	else
	{
		$data = array('sellerStatus'=>"active");
		$where = array('tempId'=>$inserted,'sellorderId'=>$orderId);
	}

	$this->ci->common_model->updateTableData('ordertemp',$where,$data);

	$condition=array("trade_id"=>$orderId);
	$orderdata=$this->ci->common_model->getTableData('coin_order',$condition)->row();
	$insertdata['user_id']=	$orderdata->userId;
	$insertdata['message']=	"Your ".$type." order  Completed "."@".date('d-m-y h:m:s');
	$this->ci->common_model->insertTableData('notificationlist',$insertdata);		


	return true;
}
function removeOrder($id,$inserted)
{
	$current_time = date("Y-m-d H:i:s");
	$query  =   $this->ci->common_model->updateTableData('coin_order',array('trade_id'=>$id),array('status'=>"filled",'datetime'=>$current_time));
	if($query)
	{
		$trade = $this->ci->common_model->getTableData('coin_order',array('trade_id'=>$id))->row();
		$tradetradeId           = $trade->trade_id;
		$tradeuserId            = $trade->userId;
		$tradePrice             = $trade->Price;
		$tradeAmount            = $trade->Amount;
		$tradeFee               = $trade->Fee;
		$tradeType              = $trade->Type;
		$tradeTotal             = $trade->Total;
		$tradepair			    = $trade->pair;
		$orderDate              = $trade->orderDate;
		$orderTime              = $trade->orderTime;
		$wallet 				= $trade->wallet;
		$pair_details = $this->ci->common_model->getTableData('trade_pairs',array('id'=>$tradepair),'from_symbol_id,to_symbol_id')->row();
		if($wallet!="Margin Trading")
		{
			if($tradeType=="buy")
			{
				$userbalance            = getBalance($tradeuserId,$pair_details->from_symbol_id);
				$updatebuyBalance       =   $userbalance+$tradeAmount;
				updateBalance($tradeuserId,$pair_details->from_symbol_id,$updatebuyBalance);
			}
			else if($tradeType=="sell")
			{
				$userbalance            = getBalance($tradeuserId,$pair_details->to_symbol_id);
				$updatebuyBalance       =   $userbalance+$tradeTotal;
				updateBalance($tradeuserId,$pair_details->to_symbol_id,$updatebuyBalance);
			}
		}
		return true;
	}
	else
	{
		return false;
	}
}
function orderpartialtype($orderId,$type,$inserted)
{
	$trade_execution_type = $this->ci->common_model->getTableData('site_settings',array('id'=>1),'trade_execution_type')->row('trade_execution_type');
	if($trade_execution_type==2)
	{
		$this->partial_balanceupdate($orderId,$inserted);
	}else{ // Jatin Change in trade lib 16-6-18
		$this->partial_balanceupdate($orderId,$inserted);
	}
	$condition=array("trade_id"=>$orderId);
	$orderdata=$this->ci->common_model->getTableData('coin_order',$condition)->row();
	$insertdata['user_id']=	$orderdata->userId;
	$insertdata['message']=	"Your ".$type." order parcially completed "."@".date('d-m-y h:m:s');
	$this->ci->common_model->insertTableData('notificationlist',$insertdata);	
	return true;
}
function partial_balanceupdate($id,$inserted)
{
	$trade = $this->ci->common_model->getTableData('coin_order',array('trade_id'=>$id),'userId,fee_per,Price,Type,pair,wallet')->row();
	$ordertemp = $this->ci->common_model->getTableData('ordertemp',array('tempId'=>$inserted),'filledAmount')->row();
	$tradeuserId            = $trade->userId;
	$fee_per               	= $trade->fee_per;
	$Price               	= $trade->Price;
	$tradeType              = $trade->Type;
	$tradepair			    = $trade->pair;
	$wallet 				= $trade->wallet;
	$tradeAmount			= $ordertemp->filledAmount;
	$pair_details = $this->ci->common_model->getTableData('trade_pairs',array('id'=>$tradepair),'from_symbol_id,to_symbol_id')->row();
	if($wallet!="Margin Trading")
	{	
		if($tradeType=="buy")
		{
			$userbalance            = getBalance($tradeuserId,$pair_details->from_symbol_id);
			$updatebuyBalance       =   $userbalance+$tradeAmount;
			updateBalance($tradeuserId,$pair_details->from_symbol_id,$updatebuyBalance);
		}
		else if($tradeType=="sell")
		{
			$filledprice	=	$tradeAmount*$Price;
			$fees = ($filledprice*$fee_per)/100;
			$tradeTotal	=	$filledprice-$fees;
			$userbalance            = getBalance($tradeuserId,$pair_details->to_symbol_id);
			$updatebuyBalance       =   $userbalance+$tradeTotal;
			updateBalance($tradeuserId,$pair_details->to_symbol_id,$updatebuyBalance);
		}
	}
	return true;
}
function integrate_remarket($insid)
{
	$order = $this->ci->common_model->getTableData('coin_order',array('trade_id'=>$insid))->row();
	$remarket_order_id	= 	$order->remarket_order_id;
	$old_remarket_id	=	$order->old_remarket_id;
	if($remarket_order_id&&$remarket_order_id!=0)
	{
		$pair			=	$order->pair;
		$joins 			= 	array('currency as b'=>'a.from_symbol_id = b.id','currency as c'=>'a.to_symbol_id = c.id');
		$where 			= 	array('a.id'=>$pair);
		$pair_details 	= 	$this->ci->common_model->getJoinedTableData('trade_pairs as a',$joins,$where,'b.currency_symbol as from_currency_symbol,c.currency_symbol as to_currency_symbol,a.to_symbol_id')->row();
		$pair_symbol	=	$pair_details->from_currency_symbol.'_'.$pair_details->to_currency_symbol;
		$cancel_order = $this->api->cancel_order($pair_symbol,$remarket_order_id);
		if($cancel_order&&isset($cancel_order['success'])&&$cancel_order['success']==1)
		{
			if($old_remarket_id!='')
			{
				$old_remarket_id=$old_remarket_id.','.$remarket_order_id;
			}
			else
			{
				$old_remarket_id=$remarket_order_id;
			}
			$this->ci->common_model->updateTableData('coin_order',array('trade_id'=>$insid),array('old_remarket_id'=>$old_remarket_id));
		}
	}
	//$remarket=getSiteSettings('remarket_concept');
	$remarket=1;
	if($remarket==1)
	{
		if($order&&$order->status!='filled')
		{
			$pair			=	$order->pair;
			$Type			=	$order->Type;
			$activePrice	=	$order->Price;
			$activeAmount	= 	$order->Amount;
			$joins 			= 	array('currency as b'=>'a.from_symbol_id = b.id','currency as c'=>'a.to_symbol_id = c.id');
			$where 			= 	array('a.id'=>$pair);
			$pair_details 	= 	$this->ci->common_model->getJoinedTableData('trade_pairs as a',$joins,$where,'b.currency_symbol as from_currency_symbol,c.currency_symbol as to_currency_symbol,a.to_symbol_id')->row();
			$pair_symbol	=	$pair_details->from_currency_symbol.'_'.$pair_details->to_currency_symbol;
			$activefilledAmount = $this->checkOrdertemp($insid,$Type.'orderId');
			if($activefilledAmount)
			{
				$activefilledAmount = $activeAmount-$activefilledAmount;
			}
			else
			{
				$activefilledAmount = $activeAmount;
			}
			$price=$activefilledAmount*$activePrice;
			if($price>=0.0001)
			{
				if($Type=='buy')
				{
					//$order_detail = $this->api->buy($pair_symbol,$activePrice,$activefilledAmount);
				}
				else
				{
					//$order_detail = $this->api->sell($pair_symbol,$activePrice,$activefilledAmount);
				}
				if($order_detail&&isset($order_detail['orderNumber'])&&$order_detail['orderNumber']!='')
				{
					$orderNumber=$order_detail['orderNumber'];
					$this->ci->common_model->updateTableData('coin_order',array('trade_id'=>$insid),array('remarket_order_id'=>$orderNumber));
					$resultingTrades=$order_detail['resultingTrades'];
					if(isset($resultingTrades)&&count($resultingTrades)>0)
					{
						foreach($resultingTrades as $trades)
						{
							$trades['order_id']		=	$orderNumber;
							$trades['created_on']	=	time();
							$total	=	$trades['total'];
							$this->ci->common_model->insertTableData('remarket_trades', $trades);
							$orderid       	= $order->trade_id;
							$userId         = $order->userId;
							$Price          = $order->Price;
							$Amount         = $order->Amount;
							$Wallet        	= $order->wallet;
							$Total1			= $order->Total;
							$Fee1			= $order->Fee;
							$datetime       = date("Y-m-d H:i:s");
							$data           = array(											
												'askAmount'         =>  $Amount,
												'askPrice'          =>  $Price,
												'filledAmount'      =>  $total,
												'sellerStatus'      =>  "inactive",
												'buyerStatus'       =>  "inactive",
												"pair"              =>  $pair,
												"datetime"          =>  $datetime,
												"firstCurrency"=>$pair_details->from_symbol_id,
												"secondCurrency"=>$pair_details->to_symbol_id,

												"volume"=>$total*$Price,
												//"volume"=>$amount->sellPrice,
												);
							if($Type=='buy')
							{
								$data['buyorderId']=$orderid;
								$data['buyerUserid']=$userId;
								$data['sellorderId']=0;
								$data['sellerUserid']=0;
							}
							else
							{
								$data['sellorderId']=$orderid;
								$data['sellerUserid']=$userId;
								$data['buyorderId']=0;
								$data['buyerUserid']=0;
							}
							$inserted=$this->ci->common_model->insertTableData('ordertemp', $data);
							if($inserted)
							{
								$activefilledAmount = $this->checkOrdertemp($insid,$Type.'orderId');
								if($activefilledAmount)
								{
									$activefilledAmount = $activeAmount-$activefilledAmount;
								}
								else
								{
									$activefilledAmount = $activeAmount;
								}
								if(trim($total)==trim($activefilledAmount))
								{
									$this->ordercompletetype($orderid,$Type,$inserted);
									$trans_data = array(
									'userId'=>$userId,
									'type'=>ucfirst($Type),
									'currency'=>$pair_details->to_symbol_id,
									'amount'=>$Total1+$Fee1,
									'profit_amount'=>$Fee1,
									'comment'=>'Trade '.ucfirst($Type).' order #'.$orderid,
									'datetime'=>date('Y-m-d h:i:s'),
									'currency_type'=>'crypto'
									);
									$update_trans = $this->ci->common_model->insertTableData('transaction_history',$trans_data);
								}
								else
								{
									$this->orderpartialtype($orderid,$Type,$inserted);
									$this->ci->common_model->updateTableData('coin_order',array('trade_id'=>$orderid),array('status'=>"partially",'tradetime'=>date('Y-m-d H:i:s')));
								}
							}
						}
					}
				}
				else
				{
					$balance_alert=getSiteSettings('balance_alert');
					if($balance_alert==1)
					{
						$dst=getSiteSettings('contactno');
						$text='Error Occured while place '.$pair_symbol.' order using api on your poloniex acount. ';
						if(isset($order_detail['error']))
						{
							$text=$text.$order_detail['error'];
						}
						else
						{
							$text=$text.'Not enough balance in your account';
						}
						send_otp_msg($dst,$text);
					}
				}
			}
		}
	}
}
function close_active_order($tradeid,$pair_id,$user_id)
{
	$where_in =array('status',array('active','partially','stoporder','margin','filled'));
	$order = $this->ci->common_model->getTableData('coin_order',array('trade_id'=>$tradeid,'userId'=>$user_id),'','','','','','','','','',$where_in)->row();
	if($order)
	{
		if($order->status=='active'||$order->status=='partially'||$order->status=='stoporder'||$order->status=='margin'||($order->status=='filled'&&$order->wallet=='Margin Trading'))
		{
			$request_time = date("Y-m-d h:i:s");
			$data_up = array('tradetime'=>$request_time);
			if($order->status!='filled')
			{
				$data_up['status']="cancelled";
			}
			$query=$this->ci->common_model->updateTableData('coin_order',array('trade_id'=>$tradeid),$data_up);
			$userId 				= $order->userId;
			$Type 					= $order->Type;
			$data['type']			= $order->Type;
			$activeAmount 			= $order->Amount;
			$activeTradeid 			= $order->trade_id;
			$Total 					= $order->Total;
			$fee                    = $order->fee_per;
			$activePrice 			= $order->Price;
			$wallet 				= $order->wallet;
			$trade_execution_type = $this->ci->common_model->getTableData('site_settings',array('id'=>1),'trade_execution_type')->row('trade_execution_type');
			$pair_details = $this->ci->common_model->getTableData('trade_pairs',array('id'=>$pair_id),'from_symbol_id,to_symbol_id')->row();
			if($wallet!='Margin Trading')
			{
				if($Type=="buy")
				{
					$ordertemp = $this->ci->common_model->getTableData('ordertemp',array('buyorderId'=>$activeTradeid),'SUM(filledAmount) as totalamount');
					if($ordertemp->num_rows() >= 1&&$ordertemp->row('totalamount')!=0)
					{
						$row = $ordertemp->row();
						$activefilledAmount = $row->totalamount;
						/*if($trade_execution_type!=2)
						{
							$userbalance            = getBalance($userId,$pair_details->from_symbol_id);
							$updatebuyBalance       =   $userbalance+$activefilledAmount;
							updateBalance($userId,$pair_details->from_symbol_id,$updatebuyBalance);
						}*/
						$activefilledAmount = $activeAmount-$activefilledAmount;
						$activeFees         = ($activefilledAmount*$activePrice)*$fee/100;
						$activeCalcTotal    = ($activefilledAmount*$activePrice)+$activeFees;
					}
					else
					{
						$activefilledAmount = $activeAmount;
						$activeCalcTotal = $Total;
					}
					$activefilledAmount;
					$currentbalance = getBalance($userId,$pair_details->to_symbol_id);
					$updatebalance  = $currentbalance+$activeCalcTotal;
					updateBalance($userId,$pair_details->to_symbol_id,$updatebalance);
				}
				else if($Type=="sell")
				{
					$ordertemp = $this->ci->common_model->getTableData('ordertemp',array('sellorderId'=>$activeTradeid),'SUM(filledAmount) as totalamount');
					if($ordertemp->num_rows() >= 1&&$ordertemp->row('totalamount')!=0)
					{
						$row = $ordertemp->row();
						$activefilledAmount = $row->totalamount;
						/*if($trade_execution_type!=2)
						{
							$userbalance       = getBalance($userId,$pair_details->to_symbol_id);
							$activeCalcTotal   = $activefilledAmount*$activePrice;
							$activeFees        = $activeCalcTotal*$fee/100;
							$updatesellBalance = $userbalance+$activeCalcTotal-$activeFees;
							updateBalance($userId,$pair_details->to_symbol_id,$updatesellBalance);
						}*/
						$activefilledAmount = $activeAmount-$activefilledAmount;
					}
					else
					{
						$activefilledAmount = $activeAmount;
					}
					$activefilledAmount;
					$currentbalance = getBalance($userId,$pair_details->from_symbol_id);
					$updatebalance  = $currentbalance+$activefilledAmount;
					updateBalance($userId,$pair_details->from_symbol_id,$updatebalance);
				}
			}
			else
			{
				if($Type=="buy")
				{
					$ordertype='buyorderId';
				}
				else
				{
					$ordertype='sellorderId';
				}
				$ordertemp = $this->ci->common_model->getTableData('ordertemp',array($ordertype=>$activeTradeid),'SUM(filledAmount) as totalamount');
				$swap_order = $this->ci->common_model->getTableData('swap_order',array('margin_order'=>$tradeid),'*,TIMESTAMPDIFF(MINUTE, created_date, NOW()) as date_diff')->row();
				if($swap_order)
				{
					if($swap_order->swap_status=='active')
					{
						$this->ci->common_model->updateTableData('swap_order',array('margin_order'=>$tradeid),array('swap_status'=>"cancelled",'expire'=>1));
					}
					else if(($swap_order->swap_status=='partially' || $swap_order->swap_status=='filled')&&($order->status=='margin'||$order->status=='active'||$order->status=='stoporder'))
					{
						$swap_id             = $swap_order->swap_id;
						$receive_swap_amount = $swap_order->swap_amount;
						$offer_currency      = $swap_order->currency;
						$range      = $swap_order->range;
						$rate      = $swap_order->rate;
								
								$match_time        = $swap_order->created_date;
								$minutes           = $range*24*60;
								$interest          = to_decimal((($receive_swap_amount*$rate)/100),8);
								$min_interest      = $interest/$minutes;
								$tot_minutes       = $swap_order->date_diff;
								$tot_interest      = to_decimal(($min_interest*$tot_minutes),8);
								$paid_money        = $tot_interest;
								$paid_interest        = $tot_interest;
								
								$trans_data = array(
								'userId'        => $userId,
								'type'          => 'Margin',
								'currency'      => $offer_currency,
								'amount'        => $receive_swap_amount,
								'profit_amount' => $paid_interest,
								'comment'       => 'Margin order #'.$swap_id,
								'datetime'      => date('Y-m-d h:i:s'),
								'currency_type' => 'crypto'
								);
								$this->ci->common_model->insertTableData('transaction_history', $trans_data);
						
							
							if($paid_money>0)
							{
								$currentbalance1            = getBalance($userId,$offer_currency,'crypto','Margin Trading');
								if($currentbalance1>=$paid_money)
								{
									// echo $paid_money;
									$updatebalance       =   $currentbalance1-$paid_money;
									// echo "fdf".$updatebalance;
									updateBalance($userId,$offer_currency,$updatebalance,'crypto','Margin Trading');
								}
								else
								{
									if($currentbalance1>0)
									{
										$updatebalance       =   0;
										$paid_money			 =	 $paid_money-$currentbalance1;
										updateBalance($userId,$offer_currency,$updatebalance,'crypto','Margin Trading');
									}
									if($paid_money>0)
									{
										$price_array=array();
										$symbol_array=array();
										$hiswhere = array('a.lending_status'=>'1');
										$hisjoins = array('trade_pairs as b'=>'a.id = b.from_symbol_id');
										$currency = $this->ci->common_model->getleftJoinedTableData('currency as a',$hisjoins,$hiswhere,"a.*,b.from_symbol_id,b.buy_rate_value, (SELECT Price FROM `wcx_coin_order` WHERE `pair` = b.id AND `status` IN('filled') ORDER BY `trade_id` DESC LIMIT 1) as Price",'','','','','')->result();
										foreach($currency as $cur)
										{
											if($cur->Price)
											{
												$price = $cur->Price;
											}
											else
											{
												$price = $cur->buy_rate_value;
											}
											if($cur->id!=$offer_currency)
											{
												if(!($cur->currency_symbol=='BTC'))
												{
													$price_array[$cur->id] = $price;
												}
												else
												{
													$price_array[$cur->id] = 1;
												}
											}
											else
											{
												if(!($cur->currency_symbol=='BTC'))
												{
													$symbol_array[$cur->id] = $price;
												}
												else
												{
													$symbol_array[$cur->id] = 1;
												}
											}
										}
										$wallets=getBalance($userId,'','crypto','Margin Trading');
										unset($wallets[$offer_currency]);
										if(isset($symbol_array[$offer_currency]))
										{
											$givenbtc=to_decimal(($paid_money*$symbol_array[$offer_currency]),8);
											if($givenbtc>0)
											{
												foreach($wallets as $key=>$wallet)
												{
													if($givenbtc>0)
													{
														if($wallet>0)
														{
															if(isset($price_array[$key]))
															{
																$btcprice=$price_array[$key];
																$haveprice=to_decimal(($btcprice*$wallet),8);
																if($haveprice>0)
																{
																	if($haveprice>$givenbtc)
																	{
																		$givenprice=$givenbtc/$btcprice;
																		$returnbalance=$wallet-$givenprice;
																		updateBalance($userId,$key,$returnbalance,'crypto','Margin Trading');
																		$givenbtc=0;
																	}
																	else
																	{
																		$givenbtc=$givenbtc-$haveprice;
																		updateBalance($userId,$key,0,'crypto','Margin Trading');
																	}
																}
															}
														}
													}
												}
											}
										}
									}
								}
							}
						
						// $this->ci->common_model->updateTableData('swap_order',array('margin_order'=>$tradeid),array('expire'=>1,'interest'=>$paid_money));
					}
					else if($order->status=='filled'||$order->status=='partially')
					{
						$Type=$order->Type;
						$activefilledAmount = $this->checkOrdertemp($order->trade_id,$Type.'orderId');
						if($activefilledAmount)
						{
							$pair=$order->pair;
							if($Type=='buy')
							{
								$response=$this->createOrder($order->userId,$activefilledAmount,0,0,0,$pair,'instant','sell','','margin',1);
								$detail=$response['msg'];
								$swappaid=$detail->Total;
							}
							else
							{
								$getfeedetails=getfeedetails($pair);
								$maker=$getfeedetails->maker;
								$this->trade_prices($pair);
								$buy_rate = $this->lowestaskprice;
								$amount=(100*$activefilledAmount)/((100*$buy_rate)+($buy_rate*$maker));
								$response=$this->createOrder($order->userId,$amount,0,0,0,$pair,'instant','buy','','margin',1);
								if(isset($detail))
								{
									$swappaid=$detail->Amount;
								}
							}
							if(isset($detail))
							{
								$trade_id_lend=$detail->trade_id;
							}
						}
						$swap_id             = $swap_order->swap_id;
						$receive_swap_amount = $swap_order->swap_amount;
						$offer_currency      = $swap_order->currency;
						$range      		 = $swap_order->range;
						$rate      		 = $swap_order->rate;
						
							$now = new DateTime();
							$lending_fees=getSiteSettings('lending_fees');
							
								$match_time        = $swap_order->created_date;
								$minutes           = $range*24*60;
								$interest          = to_decimal((($receive_swap_amount*$rate)/100),8);
								$min_interest      = $interest/$minutes;
								$tot_minutes       = $swap_order->date_diff;
								$tot_interest      = to_decimal(($min_interest*$tot_minutes),8);
								$paid_money        = $tot_interest;
								$paid_interest        = $tot_interest;
								
								$trans_data = array(
								'userId'        => $userId,
								'type'          => 'Margin',
								'currency'      => $offer_currency,
								'amount'        => $receive_swap_amount,
								'profit_amount' => $paid_interest,
								'comment'       => 'Margin order #'.$swap_id,
								'datetime'      => date('Y-m-d h:i:s'),
								'currency_type' => 'crypto'
								);
								$this->ci->common_model->insertTableData('transaction_history', $trans_data);
								
							if(isset($swappaid))
							{
								$payable=$receive_swap_amount-$swappaid;
								$payable1=$swappaid-$receive_swap_amount;
								if($payable!=0)
								{
									if($payable>0)
									{
										$paid_money=$paid_money+$payable;
										$type='Loss';
									}
									else
									{
										$type='Earn';
										if($paid_money==$payable1)
										{
											$paid_money=0;
										}
										else if($paid_money>$payable1)
										{
											$paid_money=$paid_money-$payable1;
										}
										else
										{
											$settle_money=$payable1-$paid_money;
											$currentbalance1            = getBalance($userId,$offer_currency,'crypto','Margin Trading');
											$updatebalance       =   $currentbalance1+$settle_money;
											updateBalance($userId,$offer_currency,$updatebalance,'crypto','Margin Trading');
											$paid_money=0;
										}
									}
									$lending_fees = array(
									'userId'=>$userId,
									'type'=>$type,
									'currency'=>$offer_currency,
									'amount'=>abs($payable1),
									'order_id'=>$trade_id_lend
									);
									$this->ci->common_model->insertTableData('lending_fees', $lending_fees);
								}
							}
							if($paid_money>0)
							{
								$currentbalance1            = getBalance($userId,$offer_currency,'crypto','Margin Trading');
								if($currentbalance1>=$paid_money)
								{
									$updatebalance       =   $currentbalance1-$paid_money;
									updateBalance($userId,$offer_currency,$updatebalance,'crypto','Margin Trading');
								}
								else
								{
									if($currentbalance1>0)
									{
										$updatebalance       =   0;
										$paid_money			 =	 $paid_money-$currentbalance1;
										updateBalance($userId,$offer_currency,$updatebalance,'crypto','Margin Trading');
									}
									if($paid_money>0)
									{
										$price_array=array();
										$symbol_array=array();
										$hiswhere = array('a.lending_status'=>'1');
										$hisjoins = array('trade_pairs as b'=>'a.id = b.from_symbol_id');
										$currency = $this->ci->common_model->getleftJoinedTableData('currency as a',$hisjoins,$hiswhere,"a.*,b.from_symbol_id,b.buy_rate_value, (SELECT Price FROM `wcx_coin_order` WHERE `pair` = b.id AND `status` IN('filled') ORDER BY `trade_id` DESC LIMIT 1) as Price",'','','','','')->result();
										foreach($currency as $cur)
										{
											if($cur->Price)
											{
												$price = $cur->Price;
											}
											else
											{
												$price = $cur->buy_rate_value;
											}
											if($cur->id!=$offer_currency)
											{
												if(!($cur->currency_symbol=='BTC'))
												{
													$price_array[$cur->id] = $price;
												}
												else
												{
													$price_array[$cur->id] = 1;
												}
											}
											else
											{
												if(!($cur->currency_symbol=='BTC'))
												{
													$symbol_array[$cur->id] = $price;
												}
												else
												{
													$symbol_array[$cur->id] = 1;
												}
											}
										}
										$wallets=getBalance($userId,'','crypto','Margin Trading');
										unset($wallets[$offer_currency]);
										if(isset($symbol_array[$offer_currency]))
										{
											$givenbtc=to_decimal(($paid_money*$symbol_array[$offer_currency]),8);
											if($givenbtc>0)
											{
												foreach($wallets as $key=>$wallet)
												{
													if($givenbtc>0)
													{
														if($wallet>0)
														{
															if(isset($price_array[$key]))
															{
																$btcprice=$price_array[$key];
																$haveprice=to_decimal(($btcprice*$wallet),8);
																if($haveprice>0)
																{
																	if($haveprice>$givenbtc)
																	{
																		$givenprice=$givenbtc/$btcprice;
																		$returnbalance=$wallet-$givenprice;
																		updateBalance($userId,$key,$returnbalance,'crypto','Margin Trading');
																		$givenbtc=0;
																	}
																	else
																	{
																		$givenbtc=$givenbtc-$haveprice;
																		updateBalance($userId,$key,0,'crypto','Margin Trading');
																	}
																}
															}
														}
													}
												}
											}
										}
									}
								}
							}
						
					}
						$this->ci->common_model->updateTableData('swap_order',array('margin_order'=>$tradeid),array('expire'=>1,'interest'=>$paid_money));
				}
			}
			if($ordertemp->num_rows() >= 1&&$ordertemp->row('totalamount')!=0)
			{
				$this->partial_close_order($tradeid);
				$activefilledAmount = $ordertemp->row('totalamount');
				$trade_id		= $order->trade_id;
				$userId			= $order->userId;
				$tradePrice 	= $order->Price;
				$tradeAmount 	= $order->Amount;
				$Fee 			= $order->Fee;
				$fee_per		= $order->fee_per;
				$status		= $order->status;
				$Type 			= $order->Type;
				$Total 			= $order->Total;
				$activefilledAmount=$activefilledAmount*$tradePrice;
				$activefilledAmount=($activefilledAmount*$fee_per)/100;
				$activefilledAmount=to_decimal($activefilledAmount,8);
				$trans_data = array(
									'userId'        => $userId,
									'type'          => ucfirst($Type),
									'currency'      => $pair_details->to_symbol_id,
									'amount'        => $Total,
									'profit_amount' => $activefilledAmount,
									'comment'       => 'Trade '.ucfirst($Type).' order #'.$trade_id,
									'datetime'      => date('Y-m-d h:i:s'),
									'currency_type' => 'crypto'
									);
				if($status!='filled')
				{
				 	$this->ci->common_model->insertTableData('transaction_history', $trans_data);
				}
			}
			$data['result'] = 1;
		}
	}
	else{
		$data['result'] = 0;
	}
	$this->check_stop_order($pair_id);
	return $data;
}
function partial_close_order($trade_id)
{
	$get_insert_order = $this->ci->common_model->getTableData('coin_order',array('trade_id'=>$trade_id))->row_array();
	/*if($get_insert_order['status']!='filled')
	{*/
	$filledAmount = $this->checkOrdertemp($trade_id,$get_insert_order['Type'].'orderId');
	$ori_amount   = $get_insert_order['Amount'];
	if($filledAmount!=$ori_amount)
	{
		$price  	  = $get_insert_order['Price'];
		$fee_per      = $get_insert_order['fee_per'];
		$filled_fee   = ( $filledAmount * $price ) * ( $fee_per / 100 );
		$total = ($get_insert_order['Type']=='Buy')?(($filledAmount*$price)+$filled_fee):(($filledAmount*$price)-$filled_fee);
		unset($get_insert_order['trade_id']);
		$get_insert_order['Amount']     = $filledAmount;
		$get_insert_order['Fee']        = number_format((float)$filled_fee, 8, '.', '');
		$get_insert_order['Total']      = $total;
		$get_insert_order['status']     = 'filled';
		$this->ci->common_model->updateTableData('coin_order',array('trade_id'=>$trade_id),$get_insert_order);
		$cancelled_amount = $ori_amount - $filledAmount;
		$cancel_fee   = ( $cancelled_amount * $price ) * ( $fee_per / 100 );
		$total = ($get_insert_order['Type']=='Buy')?(($cancelled_amount*$price)+$cancel_fee):(($cancelled_amount*$price)-$cancel_fee);
		$get_insert_order['Amount']     = $cancelled_amount;
		$get_insert_order['Fee']        = number_format((float)$cancel_fee, 8, '.', '');
		$get_insert_order['Total']      = $total;
		$get_insert_order['status']     = 'cancelled';
		$this->ci->common_model->insertTableData('coin_order',$get_insert_order);
	}
}
	
}
?>