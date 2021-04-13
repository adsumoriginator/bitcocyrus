<?php
/**
 * Common Class
 * @package Osiz Technologies Pvt Ltd
 * @subpackage WCX
 * @trade Controllers
 * @author Balaji
 * @version 1.0
 * @link http://osiztechnologies.com/
 * 
 */
class Trade extends CI_Controller {
	// Constructor function 
public function __construct()
{	
	parent::__construct();		
	$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
	$this->output->set_header("Pragma: no-cache");
	$this->load->library(array('form_validation'));
	$this->load->helper(array('url', 'language','security'));
	$this->load->model('trade_model');
		$this->load->model('common_model');

		

			$this->load->model('trade_model');
	//$this->trade_model->sitevisits();
	//$this->api     = new Poloniex();
	$this->site_api     = new Tradelib();
	//$this->check_session_pair();
}
// Index function
public function index()
{
	$joins = array('currency as b'=>'a.from_symbol_id = b.id','currency as c'=>'a.to_symbol_id = c.id');
	$where = array('a.status'=>1,'b.status'=>1,'c.status'=>1);
	$orderprice = $this->trade_model->getJoinedTableData('trade_pairs as a',$joins,$where,'a.id,b.currency_symbol as fromcurrency,c.currency_symbol as tocurrency','','','','','',array('a.id','asc'))->row();
	$pair_url=$orderprice->fromcurrency.'_'.$orderprice->tocurrency;



	front_redirect('trade/'.$pair_url, 'refresh');
}
public function trade($pair_symbol='')
{
	$pair=explode('_',$pair_symbol);
	$pair_id=0;


	if(count($pair)==2)
	{
		$joins = array('currency as b'=>'a.from_symbol_id = b.id','currency as c'=>'a.to_symbol_id = c.id');
		$where = array('a.status'=>1,'b.status'=>1,'c.status'=>1,'b.currency_symbol'=>$pair[0],'c.currency_symbol'=>$pair[1]);
		$orderprice = $this->trade_model->getJoinedTableData('trade_pairs as a',$joins,$where,'a.*');
		if($orderprice->num_rows()==1)
		{
			$pair_details=$orderprice->row();

		
			$pair_id=$pair_details->id;
		}
	}


			
	if($pair_id==0)
	{
		$joins = array('currency as b'=>'a.from_symbol_id = b.id','currency as c'=>'a.to_symbol_id = c.id');
		$where = array('a.status'=>1,'b.status'=>1,'c.status'=>1);
		$orderprice = $this->trade_model->getJoinedTableData('trade_pairs as a',$joins,$where,'a.id,b.currency_symbol as fromcurrency,c.currency_symbol as tocurrency','','','','','',array('a.id','asc'))->row();
		$pair_url=$orderprice->fromcurrency.'_'.$orderprice->tocurrency;
		front_redirect('trade/'.$pair_url, 'refresh');
	}

	
	$user_id=$this->session->userdata('user_id');
	//$data=$this->trade_integration($pair_id,$user_id);


	$data['pair']=$pair;
	$data['pair_id']=$pair_id;
	$data['pairs'] = trade_pairs();
	$data['pair_details'] = $pair_details;
	$this->trade_prices($pair_id,'trade');	
		
			
	$meta = $this->trade_model->getTableData('meta_content', array('link' => 'trade'))->row();
	$data['heading'] = $meta->heading;
	$data['title'] = $meta->title;
	$data['meta_keywords'] = $meta->meta_keywords;
	$data['meta_description'] = $meta->meta_description;
	$data['js_link'] = 'trade';
	$data['pagetype'] = $this->uri->segment(1);	
			$data['main_js'] = "index";
	$data['sell_price']  = lowestaskprice($pair_id);
	$data['buy_prrice']  = highestbidprice($pair_id);
	$this->db->order_by("id","desc");
	$data["notification"] = $this->trade_model->getTableData('notification', array('status' => 'Active'));



	$this->load->view('front/trade/trade', $data);
}

function Tradingview()
{

	$config =

	'{"supports_search":true,"supports_group_request":false,"supports_marks":true,"supports_timescale_marks":true,"supports_time":true,"exchanges":[{"value":"","name":"All Exchanges","desc":""},{"value":"Bitcocyrus","name":"Bitcocyrus","desc":"Bitcocyrus"},{"value":"NYSE","name":"NYSE","desc":"NYSE"},{"value":"NCM","name":"NCM","desc":"NCM"},{"value":"NGM","name":"NGM","desc":"NGM"}],"symbols_types":[{"name":"All types","value":""},{"name":"Stock","value":"stock"},{"name":"Index","value":"index"}],"supported_resolutions":["1","5","15","30","60","D","W","M"]}';


	echo $config;

}




// margin trading
function transfer_list()
{
	$this->session->set_flashdata('success', '');
	$user_id=$this->session->userdata('user_id');
	$wallet = unserialize($this->trade_model->getTableData('wallet',array('user_id'=>$user_id),'crypto_amount')->row('crypto_amount'));
	$margin_trading_percentage = $this->trade_model->getTableData('site_settings',array('id'=>1),'margin_trading_percentage')->row('margin_trading_percentage');
	$hiswhere = array('a.lending_status'=>'1');
	$hisjoins = array('trade_pairs as b'=>'a.id = b.from_symbol_id');
	$currency = $this->trade_model->getleftJoinedTableData('currency as a',$hisjoins,$hiswhere,"a.*,b.from_symbol_id,b.buy_rate_value, (SELECT Price FROM `wcx_coin_order` WHERE `pair` = b.id AND `status` IN('filled') ORDER BY `trade_id` DESC LIMIT 1) as Price",'','','','','')->result();
	$btc_amount = 0;
	$coindetails='';
	$estimatedetails='';
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
		if(!($cur->currency_symbol=='BTC'))
		{
		  $margin_amount = $price * $wallet['Margin Trading'][$cur->id];
		  $btc_amount += to_decimal((($margin_amount*100/$margin_trading_percentage)),8); 
		}
		else
		{
		  $amount = 0;
		  $btc_amount += to_decimal((($wallet['Margin Trading'][$cur->id]*100/$margin_trading_percentage)),8);
		}
		$onclick="balanceTransferChangeCurrency(".$cur->id.",'Exchange AND Trading',".to_decimal($wallet['Exchange AND Trading'][$cur->id],8).")";
		$onclick1="balanceTransferChangeCurrency(".$cur->id.",'Margin Trading',".to_decimal($wallet['Margin Trading'][$cur->id],8).")";
		$onclick2="balanceTransferChangeCurrency(".$cur->id.",'Lending',".to_decimal($wallet['Lending'][$cur->id],8).")";
		$coindetails.='<tr><td class="cursorshow" onclick="balanceTransferChangeCurrency('.$cur->id.')">'.$cur->currency_symbol.'</td><td class="cursorshow" onclick="'.$onclick.'">'.to_decimal($wallet['Exchange AND Trading'][$cur->id],8).'</td><td class="cursorshow" onclick="'.$onclick1.'">'.to_decimal($wallet['Margin Trading'][$cur->id],8).'</td><td class="cursorshow" onclick="'.$onclick2.'">'.to_decimal($wallet['Lending'][$cur->id],8).'</td><td>'.to_decimal(($wallet['Exchange AND Trading'][$cur->id])+($wallet['Margin Trading'][$cur->id])+($wallet['Lending'][$cur->id]),8).'</td></tr>';
	}
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
		if(!($cur->currency_symbol=='BTC'))
		{
			$margin_btc_amount = $btc_amount/$price;
		}
		else
		{
			$amount = 0;
			$margin_btc_amount = $btc_amount;
		}
		$estimatedetails.='<tr><td>'.to_decimal($margin_btc_amount,8).'</td></tr>';
	}
	$senddet=new stdClass();
	$senddet->coindetails=$coindetails;
	$senddet->estimatedetails=$estimatedetails;
	$senddet->wallet=json_encode($wallet);
	echo json_encode($senddet);
}
function trade_integration($pair_id,$user_id,$type='')
{
	$data['user_id']	=	$pair_id.'_'.$user_id;
	$data['transactionhistory'] = $this->transactionhistory($pair_id,'',$type);
	$data['pairs'] = trade_pairs($type,$user_id);
	$this->trade_prices($pair_id,$type);	
	$data['mytransactionhistory'] = $this->mytransactionhistory($pair_id,$user_id);
	$data['sellResult'] = $this->gettradeopenOrders('Sell',$pair_id);
	$data['buyResult'] = $this->gettradeopenOrders('Buy',$pair_id);
	$data['current_trade'] = $this->current_trade_pair($pair_id);
	$data['total_buy'] = $this->total_buy($pair_id);
	$data['total_sell'] = $this->total_sell($pair_id);
	//echo $data['total_sell'];





	$pair_details = $this->trade_model->getTableData('trade_pairs',array('id'=>$pair_id),'from_symbol_id,to_symbol_id')->row();
	if($type!='home')
	{
		if($user_id&&$user_id!=0)
		{
			$data['open_orders']=$this->get_active_order($pair_id);
			$data['cancel_orders']=$this->get_cancel_order($pair_id);
			$data['stop_orders']=$this->get_stop_order($pair_id);
		}
		else
		{
			$data['open_orders']=0;//'<tr id="noopenorder"><td colspan="7" class="text-center">No open orders available!</td></tr>';
			$data['cancel_orders']=0;//'<tr id="nocancelorder"><td colspan="6" class="text-center">No cancel orders available!</td></tr>';
			$data['stop_orders']=0;
		}
	}

	if($this->user_balance!=0)
	{
		$balance=$this->user_balance;
		$data['all_balance']=$balance;
	    $from_currency=get_currency($pair_details->from_symbol_id);
		$to_currency=get_currency($pair_details->to_symbol_id);
		$data['from_currency']=to_decimal($balance[$from_currency],8);
		$data['to_currency']=to_decimal($balance[$to_currency],8);	
	}
	else
	{
		$data['from_currency']=0;
		$data['to_currency']=0;	
	}
	$data['wcx_userid']         = $this->user_id;
	$data['current_buy_price']  = to_decimal($this->lowestaskprice,8);
	$data['current_sell_price'] = to_decimal($this->highestbidprice,8);
	$data['lastmarketprice']    = to_decimal($this->lastmarketprice,8);
	$data['maker']              = $this->maker;
	$data['taker']              = $this->taker;

	//echo "<pre>";
	//print_r($data);
	//exit;

	echo json_encode($data);
}



function total_buy($pair_id=""){

	return   $this->trade_model->get_total_buy($pair_id);


}

function total_sell($pair_id=""){

	return $this->trade_model->get_total_sell($pair_id);

}



public function liquiditydata($pair_id)
{
	$liquidity = $this->trade_model->getTableData('site_settings',array('id'=>1),'liquidity_concept')->row('liquidity_concept');
	if($liquidity==1)
	{
		$joins 			= 	array('currency as b'=>'a.from_symbol_id = b.id','currency as c'=>'a.to_symbol_id = c.id');
		$where 			= 	array('a.id'=>$pair_id);
		$pair_details 	= 	$this->trade_model->getJoinedTableData('trade_pairs as a',$joins,$where,'b.currency_symbol as from_currency_symbol,c.currency_symbol as to_currency_symbol,a.to_symbol_id')->row();
		$pair_symbol	=	$pair_details->from_currency_symbol.'_'.$pair_details->to_currency_symbol;
		$datass=$this->api->get_order_book($pair_symbol);
		$data1=$datass;
		//print_r($data1);die;
		if(isset($data1->asks))
		{
			$asks=$data1->asks;
		}
		else if(isset($data1['asks']))
		{
			$asks=$data1['asks'];
		}
		else
		{
			$asks='';
		}
		if(isset($data1->bids))
		{
			$bids=$data1->bids;
		}
		else if(isset($data1['bids']))
		{
			$bids=$data1['bids'];
		}
		else
		{
			$bids='';
		}
		if($asks!='')
		{
			$ask_orders=array();
			foreach($asks as $ask)
			{
				$ask_orders["'".$ask[0]."'"]=$ask[1];
			}
		}
		else
		{
			$ask_orders=0;
		}
		if($bids!='')
		{
			$bids_orders=array();
			foreach($bids as $bid)
			{
				$bids_orders["'".$bid[0]."'"]=$bid[1];
			}
		}
		else
		{
			$bids_orders=0;
		}
		$orders=array();
		$orders['asks']=$ask_orders;
		$orders['bids']=$bids_orders;
	}
	else
	{
		$orders=0;
	}
	return $orders;
}
public function current_trade_pair($pair_id)
{



	$joins = array('currency as b'=>'a.from_symbol_id = b.id','currency as c'=>'a.to_symbol_id = c.id');
	$where = array('a.status'=>1);
	$orderprice = $this->trade_model->getJoinedTableData('trade_pairs as a',$joins,$where,'a.*,b.currency_name as from_currency,b.currency_symbol as from_currency_symbol,c.currency_name as to_currency,c.currency_symbol as to_currency_symbol')->result();
	$pair=$this->trade_model->getTableData('trade_pairs', array('id' => $pair_id))->row();
	$trade_prices=array();
	$volume=getTradeVolume($pair->id);
	if($volume->price!=0)
	{
		$trade_prices['price'] = to_decimal($volume->price,8);
	}
	else
	{
		// $trade_prices['price'] = to_decimal($pair->buy_rate_value,8);
		$trade_prices['price'] = lastmarketprice($pair_id);
	}
	$trade_prices['volume'] = $volume->volume;
	$trade_prices['svolume'] = $volume->svolume;	
	$trade_prices['high']   = $volume->high;
	$trade_prices['low']    = $volume->low;
	$trade_prices['change']    = $volume->change;


	return $trade_prices;
}
public function transactionhistory($pair_id,$user_id=NULL,$type="")
{


	if($type=="home"){
		$this->db->limit(5);
	}else{
		$this->db->limit(50);
	}

	$joins = array('coin_order as b'=>'a.sellorderId = b.trade_id','coin_order as c'=>'a.buyorderId = c.trade_id');
	if($user_id!=NULL)
	{
		$where = array('a.pair'=>$pair_id,'b.userId'=>$user_id);
	}
	else
	{
		$where = array('a.pair'=>$pair_id);
	}
		
	$transactionhistory = $this->trade_model->getJoinedTableData('ordertemp as a',$joins,$where,'a.*,b.orderTime as sellertime,b.trade_id as seller_trade_id,c.orderTime as buyertime,c.trade_id as buyer_trade_id,b.Price as sellaskPrice,c.Price as buyaskPrice','','','','','',array('a.tempId','desc'))->result();
	if($transactionhistory)
	{
		$historys=$transactionhistory;
	}
	else
	{
		$historys=0;
	}

	return $historys;
}
public function mytransactionhistory($pair_id,$user_id=NULL)
{

	$this->db->limit(50);
	
	$joins = array('coin_order as b'=>'a.sellorderId = b.trade_id','coin_order as c'=>'a.buyorderId = c.trade_id');
	if($user_id!=NULL)
	{
		$where = array('a.pair'=>$pair_id,'a.buyerUserid'=>$user_id);
		$or_where = array('sellerUserid'=>$user_id);

		//$this->db->order_by("b.trade_id","desc");

		$sql="SELECT a.*, b.orderTime as sellertime, b.trade_id as seller_trade_id, c.orderTime as buyertime, c.trade_id as buyer_trade_id, b.Price as sellaskPrice, c.Price as buyaskPrice FROM `bcc_ordertemp` as `a` JOIN `bcc_coin_order` as `b` ON `a`.`sellorderId` = `b`.`trade_id` JOIN `bcc_coin_order` as `c` ON `a`.`buyorderId` = `c`.`trade_id` WHERE `a`.`pair` = '$pair_id' AND (`a`.`buyerUserid` = '$user_id' OR `sellerUserid` = '$user_id') ORDER BY `a`.`tempId` DESC";
	     $transactionhistory=$this->db->query($sql)->result();





	}
	else
	{
		$where = array('a.pair'=>$pair_id);

		$this->db->order_by("b.trade_id","desc");
			$transactionhistory = $this->trade_model->getJoinedTableData('ordertemp as a',$joins,$where,'a.*,b.orderTime as sellertime,b.trade_id as seller_trade_id,c.orderTime as buyertime,c.trade_id as buyer_trade_id,b.Price as sellaskPrice,c.Price as buyaskPrice','',$or_where,'','','',array('a.tempId','desc'))->result();
	}



	if($transactionhistory)
	{
		$historys=$transactionhistory;
	}
	else
	{
		$historys=0;
	}
	return $historys;

}
public function gettradeopenOrders($type,$pair_id)
{

	/*if($type=="home"){

		$this->db->limit(20);
	}


	*/

	$selectFields='CO.Price,CO.Amount,sum(OT.filledAmount) as filledAmount';
	$names = array('active', 'partially');
	$where=array('CO.Type'=>$type,'CO.pair'=>$pair_id);
	if($type=="Sell")
	{
		$order_id='sellorderId';
		$orderBy=array('CO.Price','asc');
	}
	else
	{
		$order_id='buyorderId';
		$orderBy=array('CO.Price','desc');
	}
	$where_in = array('CO.status', $names);
	$groupBy  = array("CO.trade_id");
	$joins    = array('ordertemp as OT'=>'CO.trade_id = OT.'.$order_id);
	$q = $this->trade_model->getleftJoinedTableData('coin_order as CO',$joins,$where,$selectFields,'','','','','',$orderBy,$groupBy,$where_in);
	$result = $q->result_array();
	
	return $result;
}

/*function tradechart1($pair="")
{

	
//echo '[ [1524700800000,24.96,25.13,24.51,24.74,161504168] ]';

//exit;
/*
json_decode($data);
exit;


echo '[ [1524700800000,24.96,25.13,24.51,24.74,161504168] ]';


exit;


  $type       = "day";
        $end_date   = date("Y-m-d H:i:s");
        $start_date = date('Y-m-d H:i:s', strtotime($end_date . '- 180 days'));
        $start      = strtotime($start_date);
        $end        = strtotime($end_date);
        $interval   = 24;
        $int        = 60*60*$interval;
        for($i= $start;$i<= $end; $i += $int ) {
            $test[] = date('Y-m-d H:i:s',$i);
        }
        //echo "<pre>";
      // print_r($test);die;
        $chart="";
            foreach($test as $taken) {
                $exp            = explode(' ',$taken);
                $datetime       = strtotime($taken)*1000;
                $chartResult    = $this->trade_model->forLowHighchart_pair($taken,$int,$type,$pair); 
                $low            = $chartResult->low; 
                $high           = $chartResult->high;
                $open           = $chartResult->open;
                $close          = $chartResult->close; 
                $volume          = $chartResult->volume; 
                if($low=='') { $low = 0; } 
                if($high=='') { $high = 0; } 
                if($open=='') { $open = 0; } 
                if($close=='') { $close = 0; } 
                if($volume=='') { $volume = 0; } 
                	$format 		= 8;

              $chart.='['.$datetime.','.str_replace(',','',number_format($open,$format)).','.str_replace(',','',number_format($high,$format)).','.str_replace(',','',number_format($low,$format)).','.str_replace(',','',number_format($close,$format)).','.str_replace(',','',number_format($volume,$format)).'],';
        }

       // echo json_encode($todosPedidos);
        echo "[".trim($chart,",")."]";
        exit;


	$timestamp = strtotime('today midnight');
	$end_date = date("Y-m-d H:i:s",$timestamp);
	$start_date = date('Y-m-d H:i:s', strtotime($end_date . '- 180 days'));
	$start 	= strtotime($start_date);
	$end 	= strtotime($end_date);
	$interval = 1;
	$int = 24*60*60*$interval;
	$chart="";
	$t=1;
	for($i= $start;$i<= $end; $i += $int )
	{
		$taken = date('Y-m-d H:i:s',$i);
		//date_default_timezone_set('UTC');
		$exp 		= explode(' ',$taken);
		$curdate 	= $exp[0];
		$time 		= $exp[1];
		$tdtime 	= date("H:i",strtotime($taken));
		$datetime 	= strtotime($taken)*1000;
		//$destination = date('Y-m-d H:i:s', strtotime($taken . ' +1 hours'));
		$destination = date('Y-m-d H:i:s', strtotime($taken . ' +24 hours'));
		$names  = array('filled', 'partially');
		$where_in=array('status',$names);
		$chartResult = $this->trade_model->getTableData('coin_order',array('datetime >= '=>$taken,'datetime <= '=>$destination,'pair'=>$pair),'SUM(Amount) as volume,MIN(Price) as low,MAX(Price) as high','','','','','','','','',$where_in)->row();
		if($chartResult)
		{
			$volume 	= $chartResult->volume;
			$low 		= $chartResult->low; 
			$high	 	= $chartResult->high;
			if($volume==''){$volume = 0;} 
			if($low==''){$low = 0;} 
			if($high==''){$high = 0;} 
			$chart.='['.$datetime.','.$low.','.$high.','.$low.','.$volume.'],';
		}
	}
	echo "[".trim($chart,",")."]";
}*/


function tradechart($pair="")
{

	
//echo '[ [1524700800000,24.96,25.13,24.51,24.74,161504168] ]';

//exit;
/*
json_decode($data);
exit;


echo '[ [1524700800000,24.96,25.13,24.51,24.74,161504168] ]';


exit;
*/

  $type       = "day";
        $end_date   = date("Y-m-d H:i:s");
        $start_date = date('Y-m-d H:i:s', strtotime($end_date . '- 180 days'));
        $start      = strtotime($start_date);
        $end        = strtotime($end_date);
        $interval   = 24;
        $int        = 60*60*$interval;
        for($i= $start;$i<= $end; $i += $int ) {
            $test[] = date('Y-m-d',$i);
        }
        //echo "<pre>";
       //print_r($test);die;
        $chart="";
            foreach($test as $taken) {
                $exp            = explode(' ',$taken);
                $datetime       = $taken;
                $chartResult    = $this->trade_model->forLowHighchart_pair($taken,$int,$type,$pair); 
                $low            = $chartResult->low; 
                $high           = $chartResult->high;
                $open           = $chartResult->open;
                $close          = $chartResult->close; 
                $volume          = $chartResult->volume; 
                if($low=='') { $low = "0"; } 
                if($high=='') { $high = "0"; } 
                if($open=='') { $open = "0"; } 
                if($close=='') { $close = "0"; } 
                if($volume=='') { $volume = "0"; } 
                	$format 		= 8;

              $chart.='['.$datetime.','.str_replace(',','',number_format($open,$format)).','.str_replace(',','',number_format($high,$format)).','.str_replace(',','',number_format($low,$format)).','.str_replace(',','',number_format($close,$format)).','.str_replace(',','',number_format($volume,$format)).'],';

      

        	 $todosPedidos[] = array(
        	 	"date"		=> $datetime,
        	 	"open"      => $open,
                "low"       => $low,
                "high"  	=> $high,
                "close"   	=> $close,
                "volume"    => $volume
            );


        }

        //echo $variables;
        echo json_encode($todosPedidos);
        //echo "[".trim($chart,",")."]";
       /* echo '{
	supports_search: true,
	supports_group_request: false,
	supports_marks: true,
	exchanges: [
		{value: "", name: "All Exchanges", desc: ""},
		{value: "XETRA", name: "XETRA", desc: "XETRA"},
		{value: "NSE", name: "NSE", desc: "NSE"}
	],
	symbolsTypes: [
		{name: "All types", value: ""},
		{name: "Stock", value: "stock"},
		{name: "Index", value: "index"}
	],
	supportedResolutions: [ "1", "15", "30", "60", "D", "2D", "3D", "W", "3W", "M", "6M" ]
};';*/


        exit;


	$timestamp = strtotime('today midnight');
	$end_date = date("Y-m-d H:i:s",$timestamp);
	$start_date = date('Y-m-d H:i:s', strtotime($end_date . '- 180 days'));
	$start 	= strtotime($start_date);
	$end 	= strtotime($end_date);
	$interval = 1;
	$int = 24*60*60*$interval;
	$chart="";
	$t=1;
	for($i= $start;$i<= $end; $i += $int )
	{
		$taken = date('Y-m-d H:i:s',$i);
		//date_default_timezone_set('UTC');
		$exp 		= explode(' ',$taken);
		$curdate 	= $exp[0];
		$time 		= $exp[1];
		$tdtime 	= date("H:i",strtotime($taken));
		$datetime 	= strtotime($taken)*1000;
		//$destination = date('Y-m-d H:i:s', strtotime($taken . ' +1 hours'));
		$destination = date('Y-m-d H:i:s', strtotime($taken . ' +24 hours'));
		$names  = array('filled', 'partially');
		$where_in=array('status',$names);
		$chartResult = $this->trade_model->getTableData('coin_order',array('datetime >= '=>$taken,'datetime <= '=>$destination,'pair'=>$pair),'SUM(Amount) as volume,MIN(Price) as low,MAX(Price) as high','','','','','','','','',$where_in)->row();
		if($chartResult)
		{
			$volume 	= $chartResult->volume;
			$low 		= $chartResult->low; 
			$high	 	= $chartResult->high;
			if($volume==''){$volume = 0;} 
			if($low==''){$low = 0;} 
			if($high==''){$high = 0;} 
			$chart.='['.$datetime.','.$low.','.$high.','.$low.','.$volume.'],';
		}
	}
	echo "[".trim($chart,",")."]";
}


function add_prices($pair=""){



	for($i=1;$i<45;$i++){
		$pair=$i;
		
		
		$condition=array('id'=>$pair);
		$updata['lowestaskprice']=lowestaskprice($pair);
		$updata['highestbidprice']=highestbidprice($pair);

		$updata['lastmarketprice']=lastmarketprice($pair);
	    $updata['minimum_trade_amount']=get_min_trade_amt($pair);

	    $updata['maker']=$this->maker; 
	    $updata['taker']=$this->taker;
	  
	    $this->common_model->insertTableData("trade_amount_details",$updata,$condition); 

	    echo $this->db->last_query();
	    exit;
 }

}

function trade_prices($pair,$pagetype='')
{

 $pair_details = $this->trade_model->getTableData('trade_pairs',array('id'=>$pair),'from_symbol_id,to_symbol_id')->row();
 $to_symbol_id = get_currency($pair_details->to_symbol_id);
 $from_symbol_id = get_currency($pair_details->from_symbol_id);
 

 $this->lowestaskprice = lowestaskprice($pair);
 $this->highestbidprice = highestbidprice($pair);
 $this->lastmarketprice = lastmarketprice($pair);
 $this->minimum_trade_amount = get_min_trade_amt($pair);
 $getfeedetails= getfeedetails($pair);
 $this->maker = isset($getfeedetails->maker)?$getfeedetails->maker:0;
 $this->taker = isset($getfeedetails->taker)?$getfeedetails->taker:0;
 $user_id=$this->session->userdata('user_id');


 if($user_id)
 {


   $this->user_id = $user_id;
   $this->user_balance [$to_symbol_id]= getBalance($user_id, $to_symbol_id);
   $this->user_balance [$from_symbol_id] = getBalance($user_id,$from_symbol_id);

 }
 else
 {
  $this->user_id = 0;
  $this->user_balance = 0;
 
 }
}

/*function trade_prices($pair,$pagetype='')
{
	$this->lowestaskprice = lowestaskprice($pair);
	$this->highestbidprice = highestbidprice($pair);
	$this->lastmarketprice = lastmarketprice($pair);
	$this->minimum_trade_amount = get_min_trade_amt($pair);
	$getfeedetails= getfeedetails($pair);
	$this->maker = isset($getfeedetails->maker)?$getfeedetails->maker:0;
	$this->taker = isset($getfeedetails->taker)?$getfeedetails->taker:0;
	$user_id=$this->session->userdata('user_id');


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
}*/
function createOrder()
{



	$response=array('status'=>'','msg'=>'');
	$user_id=$this->session->userdata('user_id');
	if($user_id)
	{
		$this->form_validation->set_rules('amount', getlang('Amount'), 'trim|required|xss_clean|numeric');
		$this->form_validation->set_rules('price', getlang('Price'), 'trim|required|xss_clean|numeric');
		$this->form_validation->set_rules('total', getlang('Total'), 'trim|required|xss_clean|numeric');
		$this->form_validation->set_rules('fee', getlang('Fees'), 'trim|required|xss_clean|numeric');
		$this->form_validation->set_rules('pair', getlang('Pair'), 'trim|required|xss_clean');
		$this->form_validation->set_rules('pair_id', getlang('Pair Id'), 'trim|required|xss_clean');
		$this->form_validation->set_rules('ordertype', getlang('Order Type'), 'trim|required|xss_clean');
		$this->form_validation->set_rules('type', getlang('Type'), 'trim|required|xss_clean');
		if ($this->form_validation->run())
		{
			$amount = $this->security->xss_clean($this->input->post('amount'));
			$price 	= $this->security->xss_clean($this->input->post('price'));
			$total 	= $this->security->xss_clean($this->input->post('total'));
			$fee 	= $this->security->xss_clean($this->input->post('fee'));
			$pair 	= $this->security->xss_clean($this->input->post('pair'));
			$pair_id 	= $this->security->xss_clean($this->input->post('pair_id'));
			$ordertype 	= $this->security->xss_clean($this->input->post('ordertype'));
			$type 	= $this->security->xss_clean($this->input->post('type'));
			$loan_rate 	= $this->security->xss_clean($this->input->post('loan_rate'));
			$pagetype 	= $this->security->xss_clean($this->input->post('pagetype'));
			 $stop_limit 	= $this->security->xss_clean($this->input->post('stop_price'));
			

			$response=$this->site_api->createOrder($user_id,$amount,$price,$total,$fee,$pair_id,$ordertype,$type,$loan_rate,$pagetype,$stop_limit );
		}
		else
		{
			$response['status'] = validation_errors();
		}
	}
	else
	{
		$response['status'] = "login";
	}
	echo json_encode($response);
}
function update_remarket_order()
{
	$trades = $this->api->get_my_trade_history('ALL');
	if($trades)
	{
		$joins = array('currency as b'=>'a.from_symbol_id = b.id','currency as c'=>'a.to_symbol_id = c.id');
		$pair_details = $this->trade_model->getJoinedTableData('trade_pairs as a',$joins,'','b.currency_symbol as from_currency_symbol,c.currency_symbol as to_currency_symbol,to_symbol_id')->result();
		if($pair_details)
		{
			foreach($pair_details as $pairs)
			{
				$symbol=$pairs->from_currency_symbol.'_'.$pairs->to_currency_symbol;
				if(isset($trades[$symbol])&&count($trades[$symbol])>0)
				{
					$tradelist=$trades[$symbol];
					foreach($tradelist as $trade)
					{
						$tradeID=$trade['tradeID'];
						$orderNumber=$trade['orderNumber'];
						$order = $this->trade_model->getTableData('coin_order',array('remarket_order_id'=>$orderNumber))->row();
						$order_exist = $this->trade_model->getTableData('remarket_trades',array('order_id'=>$orderNumber,'tradeID'=>$tradeID));
						if($order&&$order_exist->num_rows()==0&&$order->status!='filled')
						{
							$trade['order_id']		=	$orderNumber;
							$trade['created_on']	=	time();
							$total	=	$trade['total'];
							$this->trade_model->insertTableData('remarket_trades', $trade);
							$insid	=	$order->trade_id;
							$Type	=	$order->Type;
							$userId         = $order->userId;
							$activeAmount	= $order->Amount;
							$Total1			= $order->Total;
							$Price          = $order->Price;
							$Fee1			= $order->Fee;
							$pair			= $order->pair;
							$datetime       = date("Y-m-d H:i:s");
							$data           = array(											
							'askAmount'         =>  $activeAmount,
							'askPrice'          =>  $Price,
							'filledAmount'      =>  $total,
							'sellerStatus'      =>  "inactive",
							'buyerStatus'       =>  "inactive",
							"pair"              =>  $pair,
							"datetime"          =>  $datetime
							);
							if($Type=='buy')
							{
								$data['buyorderId']=$insid;
								$data['buyerUserid']=$userId;
								$data['sellorderId']=0;
								$data['sellerUserid']=0;
							}
							else
							{
								$data['sellorderId']=$insid;
								$data['sellerUserid']=$userId;
								$data['buyorderId']=0;
								$data['buyerUserid']=0;
							}
							$inserted=$this->trade_model->insertTableData('ordertemp', $data);
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
								$this->ordercompletetype($insid,$Type,$inserted);
								$trans_data = array(
								'userId'=>$userId,
								'type'=>ucfirst($Type),
								'currency'=>$pairs->to_symbol_id,
								'amount'=>$Total1+$Fee1,
								'profit_amount'=>$Fee1,
								'comment'=>'Trade '.ucfirst($Type).' order #'.$insid,
								'datetime'=>date('Y-m-d h:i:s'),
								'currency_type'=>'crypto'
								);
								$update_trans = $this->trade_model->insertTableData('transaction_history',$trans_data);
							}
							else
							{
								$this->orderpartialtype($insid,$Type,$inserted);
								$this->trade_model->updateTableData('coin_order',array('trade_id'=>$insid),array('status'=>"partially",'tradetime'=>date('Y-m-d H:i:s')));
							}
						}
					}
				}
			}
		}
	}
}
function checkOrdertemp($id,$type)
{
	$query = $this->trade_model->getTableData('ordertemp',array($type=>$id),'SUM(filledAmount) as totalamount');
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
		$trade_execution_type = $this->trade_model->getTableData('site_settings',array('id'=>1),'trade_execution_type')->row('trade_execution_type');
		if($trade_execution_type==1)
		{
			$this->removeOrder($orderId,$inserted);
		}
		else
		{
			$this->partial_balanceupdate($orderId,$inserted);
		}
		$current_time = date("Y-m-d H:i:s");
		$query  =   $this->trade_model->updateTableData('coin_order',array('trade_id'=>$orderId),array('status'=>"filled",'datetime'=>$current_time));
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
		$this->trade_model->updateTableData('ordertemp',$where,$data);
		return true;
	}
	function orderpartialtype($orderId,$type,$inserted)
	{
		$trade_execution_type = $this->trade_model->getTableData('site_settings',array('id'=>1),'trade_execution_type')->row('trade_execution_type');
		if($trade_execution_type==2)
		{
			$this->partial_balanceupdate($orderId,$inserted);
		}
		return true;
	}
	function partial_balanceupdate($id,$inserted)
	{
		$trade = $this->trade_model->getTableData('coin_order',array('trade_id'=>$id),'userId,fee_per,Price,Type,pair,wallet')->row();
		$ordertemp = $this->trade_model->getTableData('ordertemp',array('tempId'=>$inserted),'filledAmount')->row();
		$tradeuserId            = $trade->userId;
		$fee_per               	= $trade->fee_per;
		$Price               	= $trade->Price;
		$tradeType              = $trade->Type;
		$tradepair			    = $trade->pair;
		$wallet 				= $trade->wallet;
		$tradeAmount			= $ordertemp->filledAmount;
		$pair_details = $this->trade_model->getTableData('trade_pairs',array('id'=>$tradepair),'from_symbol_id,to_symbol_id')->row();
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
		return true;
	}
	function removeOrder($id,$inserted)
	{
		$current_time = date("Y-m-d H:i:s");
		$query  =   $this->trade_model->updateTableData('coin_order',array('trade_id'=>$id),array('status'=>"filled",'datetime'=>$current_time));
		if($query)
		{
			$trade = $this->trade_model->getTableData('coin_order',array('trade_id'=>$id))->row();
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
			$pair_details = $this->trade_model->getTableData('trade_pairs',array('id'=>$tradepair),'from_symbol_id,to_symbol_id')->row();
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
			return true;
		}
		else
		{
			return false;
		}
	}
	function get_active_order($pair_id)
	{
		$user_id = $this->session->userdata('user_id');
		$selectFields='CO.*,sum(OT.filledAmount) as totalamount';
		$names = array('active', 'partially', 'margin');
		$where=array('CO.pair'=>$pair_id,'CO.userId'=>$user_id);
		$orderBy=array('CO.trade_id','desc');
		$where_in=array('CO.status', $names);
		$joins = array('ordertemp as OT'=>'CO.trade_id = OT.sellorderId OR CO.trade_id = OT.buyorderId');
		$query = $this->trade_model->getleftJoinedTableData('coin_order as CO',$joins,$where,$selectFields,'','','','','',$orderBy,array('CO.trade_id'),$where_in);

		
	
		if($query->num_rows() >= 1)
		{
			$open_orders = $query->result();
		}
		else
		{
			$open_orders = 0;
		}
		if($open_orders&&$open_orders!=0)
		{
			$open_orders_text=$open_orders;
			
		}
		else
		{
			$open_orders_text=0;
		
		}
		return $open_orders_text;
	}
	function get_cancel_order($pair_id)
	{
		$user_id = $this->session->userdata('user_id');
		$selectFields='CO.*,OT.filledAmount as totalamount';
		$where=array('CO.pair'=>$pair_id,'CO.userId'=>$user_id,'CO.status'=>'cancelled');
		$orderBy=array('CO.trade_id','desc');
		$joins = array('ordertemp as OT'=>'CO.trade_id = OT.sellorderId OR CO.trade_id = OT.buyorderId');
		$query = $this->trade_model->getleftJoinedTableData('coin_order as CO',$joins,$where,$selectFields,'','','','','',$orderBy);
		if($query->num_rows() >= 1)
		{
			$cancel_orders = $query->result();
		}
		else
		{
			$cancel_orders = '';
		}
		if($cancel_orders&&$cancel_orders[0]->trade_id!='')
		{
			$cancel_orders_text=$cancel_orders;
			// foreach($cancel_orders as $cancel_order)
			// {
				// $activePrice=$cancel_order->Price;
				// $activeAmount  = $cancel_order->Amount;
				// $activefilledAmount=$cancel_order->totalamount;
				// if($activefilledAmount)
				// {
					// $activefilledAmount = $activeAmount-$activefilledAmount;
				// }
				// else
				// {
					// $activefilledAmount = $activeAmount;
				// }
				// $activeCalcTotal = $activefilledAmount*$activePrice;
				// $cancel_orders_text.='<tr><td>'.ucfirst($cancel_order->Type).'</td><td>'.$cancel_order->tradetime.'</td><td>'.to_decimal($activePrice,8).'</td><td>'.to_decimal($activefilledAmount,8).'</td><td>'.to_decimal($activeCalcTotal,8).'</td><td>Cancelled</td></tr>';
			// }
			// $cancel_orders_text.='<tr style="display:none" id="nocancelorder"><td colspan="6" class="text-center">No cancel orders available!</td></tr>';
		}
		else
		{
			$cancel_orders_text=0;
			//$cancel_orders_text='<tr id="nocancelorder"><td colspan="6" class="text-center">No cancel orders available!</td></tr>';
		}
		return $cancel_orders_text;
	}
	function get_stop_order($pair_id)
	{
		$user_id = $this->session->userdata('user_id');
		$query = $this->trade_model->getTableData('coin_order',array('status'=>'stoporder','userId'=>$user_id,'pair'=>$pair_id));
		if($query->num_rows() >= 1)
		{
			$stop_orders = $query->result();
		}
		else
		{
			$stop_orders='';
		}
		if($stop_orders)
		{
			$stoporder=$stop_orders;
			// foreach($stop_orders as $stop_order)
			// {
				// $activePrice=$stop_order->Price;
				// $activeAmount  = $stop_order->Amount;
				// $activefilledAmount=$activeAmount;
				// $activeCalcTotal = $activefilledAmount*$activePrice;
				// $click="return cancel_order('".$stop_order->trade_id."')";
				// $stoporder.='<tr><td>'.ucfirst($stop_order->Type).'</td><td>'.$stop_order->datetime.'</td><td>'.to_decimal($activePrice,8).'</td><td>'.to_decimal($activefilledAmount,8).'</td><td>'.to_decimal($activeCalcTotal,8).'</td><td><a href="javascript:;" onclick="'.$click.'"><i class="fa fa-times-circle pad-rht"></i></a></td></tr>';
			// }
			// $stoporder.='<tr style="display:none" id="nostoporder"><td colspan="6" class="text-center">No stop orders available!</td></tr>';
		}
		else
		{
			$stoporder=0;
			//$stoporder='<tr id="nostoporder"><td colspan="6" class="text-center">No stop orders available!</td></tr>';
		}
		return $stoporder;
	}
	function close_active_order()
	{
		$tradeid = $this->input->post('tradeid');
		$pair_id = $this->input->post('pair_id');
		$user_id = $this->session->userdata('user_id');
		$response=$this->site_api->close_active_order($tradeid,$pair_id,$user_id);
		echo json_encode($response);
	}
	function livechartdata($pair){
		$data=file_get_contents('https://beta.wcx.io/wcx_front/poloniex_api/returnChartData/'.$pair);
		$data1=json_decode($data);
		$a=array();
		$a1=array();
		foreach($data1 as $old)
		{
			$array=array($old->date,$old->high,$old->low,$old->open,$old->close,$old->volume);
			array_push($a,$array);
			$newarr1=array($old->date,$old->volume);
			array_push($a1,$newarr1);
		}
		$x = new stdClass();
		$x->candlestick=json_encode($a);
		$x->volume=json_encode($a1);
		echo json_encode($x);	
	}
	function lastapi($pair){
		$data=file_get_contents('https://beta.wcx.io/wcx_front/poloniex_api/returnChartData/'.$pair);
		$data1=json_decode($data);
		$old=end($data1);
		//print_r($data2);die;
		$array=array($old->date,$old->high,$old->low,$old->open,$old->close,$old->volume);
		$newarr1=array($old->date,$old->volume);
		$x = new stdClass();
		$x->candlestick=json_encode($array);
		$x->volume=json_encode($newarr1);
		echo json_encode($x);	
	}
	function cron_expired()
	{
		$names    = array('partially','filled');
		$where_in = array('swap_status', $names);
		$query    = $this->trade_model->getTableData('swap_order',array('swap_type'=>'receive','expire'=>0,'expired_date <='=>date('Y-m-d H:i:s')),'','','','','','','','','',$where_in);
		if($query->num_rows()>0)
		{	
			$data1 = $query->result();
			foreach($data1 as $old)
			{
				$tradeid = $old->margin_order;
				$user_id = $old->user_id;
				$olds    = $this->trade_model->getTableData('coin_order',array('trade_id'=>$tradeid),'pair')->row();
				$pair_id = $olds->pair;
				$this->site_api->close_active_order($tradeid,$pair_id,$user_id);
			}
		}
	}


 function market_depth($pair_id=""){
	
	



 	$sellResult= $this->orderdata('sell',$pair_id);



 	$buyResult= $this->orderdata('Buy',$pair_id);





$buydata=array();

if($sellResult){
		$i=0;
		foreach($sellResult as $list){
			
			$Price = (float)$list["price"]; 


			$Amount =(float)$list["amount"] ; 
			$Type = "sell";
			array_push($buydata,array($Price,$Amount));
			$i++;
		}
	}
	else{
		$order[0][0] = 0;
		$order[0][1] = 0;
		$order[0][2] = 0;
	}


$selldata=array();
$old_price=0;

if($buyResult){
		$i=0;
		foreach($buyResult as $list){			
			$Price = (float)$list["price"]; 
			$Amount = (float)$list["amount"]; 
			$Type = "buy";
			array_push($selldata,array($Price,$Amount));
			
			$i++;

		}
	}
	else{
		$order[0][0] = 0;
		$order[0][1] = 0;
		$order[0][2] = 0;
	}


	if($buydata)
	{
		$selldata=$selldata;
	}
	else
	{
		$buydatas=0;
	}
	
	 if($selldata)
	{
		$selldatas=$selldata;
	}
	else
	{
		$selldatas=0;
	}

	$result = array('buy_data'=>$selldata,'sell_data'=>$buydata);




	die(json_encode($result));
	

	//array_merge($sell_order,$buy_order));

 }



public function orderdata($type,$pair_id)
{
	$selectFields='CO.Price as price,sum(CO.Amount) as amount,CO.Type as Type';
	$names = array('active', 'partially');
	$where=array('CO.Type'=>$type,'CO.pair'=>$pair_id);

	//$this->db->group_by("CO.Price");


	if($type=="Sell")
	{
		$order_id='sellorderId';
		$orderBy=array('CO.Price','asc');
	}
	else
	{
		$order_id='buyorderId';
		$orderBy=array('CO.Price','desc');
	}


	$where_in = array('CO.status', $names);
	$groupBy  = array("CO.Price");
	$joins    = array('ordertemp as OT'=>'CO.trade_id = OT.'.$order_id);
	$q = $this->trade_model->getleftJoinedTableData('coin_order as CO',$joins,$where,$selectFields,'','','','','',$orderBy,$groupBy,$where_in);
	$result = $q->result_array();
	
	return $result;
}





function update_theme(){

	$mode=$this->input->get("mode");
	$userdata=array("mode"=>$mode);
	$this->session->set_userdata($userdata);
	echo "success";

}


}
