<?php
/**
 * BoDashboard class
 * @category controller
 * @package Bitcocyrus
 * @subpackage modules
 * @author Osiz Technologies Pvt Ltd 

 * @link http://osiztechnologies.com/
 */

class Botrade extends CI_Controller {
	public function __construct() {
		parent::__construct();
				$loggedUserId = $this->session->userdata('loggedJTEAdminUserID');
		
		if(isset($loggedUserId) && !empty($loggedUserId)) {


		}else{

			redirect('YfQa6hmtE8a3G2Z6Ssuf','refresh');
		}
	

		$this->load->model('CommonModel');
		$this->load->model('common_model');
		$this->load->database();
		$this->load->helper('url');
	}


function coin_profit()
	{
		// Is logged in
		$sessionvar=$this->session->userdata('loggeduser');
		if (!$sessionvar) {
			admin_redirect('admin', 'refresh');
		}
		$coin_profit = $this->common_model->getTableData('transaction_history')->result_array();
		


		if(isset($_GET['search_string']) && !empty($_GET['search_string'])){
			$search_string = $_GET['search_string'];	
			$like = array("b.username"=>$search_string);
			$like_or = array("a.type"=>$search_string, "a.amount"=>$search_string, "a.profit_amount"=>$search_string, "a.comment"=>$search_string, "a.datetime"=>$search_string);
			$hisjoins = array('userdetails as b'=>'a.userId = b.id');
			$data['profit'] = $this->common_model->getJoinedTableDatas('transaction_history as a',$hisjoins,array('a.profit_amount >'=>0),'a.*, b.username as username',$like,'',$like_or,'','',array('a.id', 'DESC'));
		}
		else {
		$perpage = max_records();
  		$urisegment=$this->uri->segment(4);  
   		$base="admin/coin_profit";
   		$total_rows = count($coin_profit);
   		pageconfig($total_rows,$base,$perpage);


   		$hisjoins = array('userdetails as b'=>'a.userId = b.user_id');
		$data['profit'] = $this->common_model->getJoinedTableData('transaction_history as a',$hisjoins,array('a.profit_amount >'=>0),'a.*, b.username as username','','','','','',array('a.id', 'DESC'));

		}

	
		$data['title'] = 'Coin Profit';
		$data['meta_keywords'] = 'Coin Profit';
		$data['meta_description'] = 'Coin Profit';
		$data['main_content'] = 'admin/coin_profit';
		$data['view'] = 'view_all';

		$this->load->view('admin/trade/profit', $data); 
	}





 	function buy() {
		// Is logged in
	$sessionvar=$this->session->userdata('loggeduser');
	if (!$sessionvar) {
		admin_redirect('admin', 'refresh');
	}
	// Page config
	$trade_his_array = $this->common_model->getTableData('coin_order', array('Type'=>'buy'))->result_array();
	if(isset($_GET['search_string']) && !empty($_GET['search_string'])){
		$search_string = $_GET['search_string'];
		$like = array("d.currency_symbol"=>$search_string);
		$like_or = array("c.username"=>$search_string, "e.currency_symbol"=>$search_string, "a.Amount"=>$search_string, "a.Price"=>$search_string, "a.Fee"=>$search_string, "a.Total"=>$search_string, "a.status"=>$search_string);
		$hisjoins = array('trade_pairs as b'=>'a.pair = b.id','userdetails as c'=>'a.userId = b.id', 'currency as d'=>'b.from_symbol_id = d.id', 'currency as e'=>'b.to_symbol_id = e.id');
		$hiswhere = array('Type'=>'buy');
		$data['trade_history'] = $this->common_model->getJoinedTableDatas('coin_order as a',$hisjoins,$hiswhere,'a.*,b.from_symbol_id as from_currency_id, b.to_symbol_id as to_currency_id, c.username as username, d.currency_symbol as from_currency_symbol, e.currency_symbol as to_currency_symbol',$like,'',$like_or,'','',array('a.tradetime', 'DESC'));
	}
	else {
   	$perpage =max_records();
  	$urisegment=$this->uri->segment(4);  
   	$base="trade_history/buy";
   	$total_rows = count($trade_his_array);
   	pageconfig($total_rows,$base,$perpage);
   	$hisjoins = array('trade_pairs as b'=>'a.pair = b.id','userdetails as c'=>'a.userId = c.user_id', 'currency as d'=>'b.from_symbol_id = d.id', 'currency as e'=>'b.to_symbol_id = e.id');
	$hiswhere = array('Type'=>'buy');
	$data['trade_history'] = $this->common_model->getJoinedTableData('coin_order as a',$hisjoins,$hiswhere,'a.*,b.from_symbol_id as from_currency_id, b.to_symbol_id as to_currency_id, c.username as username, d.currency_symbol as from_currency_symbol, e.currency_symbol as to_currency_symbol','','','',$urisegment,$perpage,array('a.tradetime', 'DESC'));
	}
	// echo '<pre>'; print_r($data['trade_history']); die;
	$data['view'] = 'buy';
	$data['title'] = 'Buy Trade History';
	$data['meta_keywords'] = 'Buy Trade History';
	$data['meta_description'] = 'Buy Trade History';
	$data['main_content'] = 'trade_history/trade_history';
	$this->load->view('admin/trade/trade_history', $data); 
	}

	function sell() {
		// Is logged in

	// Page config
	$trade_his_array = $this->common_model->getTableData('coin_order', array('Type'=>'sell'))->result_array();
	if(isset($_GET['search_string1']) && !empty($_GET['search_string1'])){
		$search_string = $_GET['search_string1'];
		$like = array("d.currency_symbol"=>$search_string);
		$like_or = array("c.wcx_username"=>$search_string, "e.currency_symbol"=>$search_string, "a.Amount"=>$search_string, "a.Price"=>$search_string, "a.Fee"=>$search_string, "a.Total"=>$search_string, "a.status"=>$search_string);
		$hisjoins = array('trade_pairs as b'=>'a.pair = b.id','userdetails as c'=>'a.userId = b.id', 'currency as d'=>'b.from_symbol_id = d.id', 'currency as e'=>'b.to_symbol_id = e.id');
		$hiswhere = array('Type'=>'sell');
		$data['trade_history'] = $this->common_model->getJoinedTableDatas('coin_order as a',$hisjoins,$hiswhere,'a.*,b.from_symbol_id as from_currency_id, b.to_symbol_id as to_currency_id, c.username as username, d.currency_symbol as from_currency_symbol, e.currency_symbol as to_currency_symbol',$like,'',$like_or,'','',array('a.tradetime', 'DESC'));
	}
	else {
   	$perpage =max_records();
  	$urisegment=$this->uri->segment(4);  
   	$base="trade_history/sell";
   	$total_rows = count($trade_his_array);
   	pageconfig($total_rows,$base,$perpage);
   	$hisjoins = array('trade_pairs as b'=>'a.pair = b.id','userdetails as c'=>'a.userId = c.user_id', 'currency as d'=>'b.from_symbol_id = d.id', 'currency as e'=>'b.to_symbol_id = e.id');
	$hiswhere = array('Type'=>'sell');
	$data['trade_history'] = $this->common_model->getJoinedTableData('coin_order as a',$hisjoins,$hiswhere,'a.*,b.from_symbol_id as from_currency_id, b.to_symbol_id as to_currency_id, c.username as username, d.currency_symbol as from_currency_symbol, e.currency_symbol as to_currency_symbol','','','',$urisegment,$perpage,array('a.tradetime', 'DESC'));
	}



		// echo '<pre>'; print_r($data['trade_history']); die;
	$data['view'] = 'sell';
	$data['title'] = 'Sell Trade History';
	$data['meta_keywords'] = 'Sell Trade History';
	$data['meta_description'] = 'Sell Trade History';
	$data['main_content'] = 'trade_history/trade_history';
	$this->load->view('admin/trade/trade_history', $data); 
	}





	
}
?>