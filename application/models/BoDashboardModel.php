<?php
/**
 * BoDashboardModel class
 * @category model
 * @package Bitcocyrus
 * @subpackage modules
 * @author Osiz Technologies Pvt Ltd 
 * @link http://osiztechnologies.com/
 */

class BoDashboardModel extends CI_Model {
	/**
	 * To get the number of users in the site
	 * @return response set of record or false
	 * @author Sharavana Kumar
	 */
	function getSiteUserCount() {
		//$this->db->order_by("created_date", "desc");
		$query = $this->db->get('bcc_userdetails');
        if($query->num_rows() >= 1) {                   
        	return $query->num_rows();			
		} 
		else {     
			return 0;
		}
	}
	/**
	 * To get the number of users in the site
	 * @return response set of record or false
	 * @author Sharavana Kumar
	 */
	function getSiteUserCoinCount() {
		//$this->db->order_by("created_date", "desc");
		$query = $this->db->get('bcc_add_coin');
        if($query->num_rows() >= 1) {                   
        	return $query->num_rows();			
		} 
		else {     
			return 0;
		}
	}	

	/**
	 * To get all avilable withdraw transaction
	 * @return response set of record or false
	 * @author Sharavana Kumar
	 */
	function getWithdrawTransactionCount() {
		$this->db->select("a.*,c.username as username,b.*");		
		$this->db->join("bcc_userdetails as c","a.user_id = c.user_id");
        $this->db->join("bcc_wallet as b","a.user_id = b.user_id");
		$this->db->order_by("a.request_date", "desc");
		$sql = $this->db->get("bcc_withdraw_request as a");
		if($sql->num_rows() > 0) {
			return $sql->num_rows();
        }
        else {
			return 0;
        }		
	}

	/**
	 * To get all avilable deposit transaction
	 * @return response set of record or false
	 * @author Sharavana Kumar
	 */
	function getDepositTransactionCount() {
		$this->db->select("a.*,c.username as username");	
		$this->db->join("bcc_userdetails as c","a.user_id = c.user_id");
        //$this->db->join("bcc_wallet as b","a.user_id = b.user_id");
		$this->db->order_by("a.request_date", "desc");
		$sql = $this->db->get("bcc_deposit_payment as a");
		if($sql->num_rows() > 0) {
			return $sql->num_rows();
        }
        else {
			return 0;
        }		
	}

	/**
	 * To get all avilable trade history in that page ( status of filled and partial )
	 * @return response set of record or false
	 * @author Sharavana Kumar
	 */
	function getTradeHistoryCount() {
		$this->db->select("a.*, c.username as username");
		$this->db->join("bcc_userdetails as c","a.userId = c.user_id");
		$this->db->order_by("a.tradetime", "desc");
		$this->db->where("a.status","filled");        
		$this->db->or_where("a.status","partially");
		$sql = $this->db->get("bcc_coin_order as a");
		if($sql->num_rows() > 0) {
			return $sql->num_rows();
        }
        else {
			return 0;
        }
	}	

	/**
	 * To get all avilable trade history in that page ( status of filled and partial )
	 * @return response set of record or false
	 * @author Sharavana Kumar
	 */
	function getOrderHistoryCount() {
		$this->db->select("a.*, c.username as username");
		$this->db->join("bcc_userdetails as c","a.userId = c.user_id");
		$this->db->order_by("a.tradetime", "desc");
		$this->db->where("a.status","active");       
		$this->db->or_where("a.status","partially");
		$sql = $this->db->get("bcc_coin_order as a");
		if($sql->num_rows() > 0) {
			return $sql->num_rows();
        }
        else {
			return 0;
        }
	}

	/**
	 * To get all avilable email templates
	 * @return response set of record or false
	 * @author Sharavana Kumar
	 */
	function getTradePairsCount() {
		$this->db->select("a.*,b.currency_name as from_currency,b.currency_symbol as from_currency_symbol,b.image,c.currency_name as to_currency,c.currency_symbol as to_currency_symbol");        
		$this->db->join("bcc_currency as b","a.from_symbol_id = b.id");
        $this->db->join("bcc_currency as c","a.to_symbol_id = c.id");
        $this->db->where("a.status","1");
		$sql = $this->db->get("bcc_trade_pairs as a");
        //return $this->db->last_query();
        if($sql->num_rows() >0) {
			return $sql->num_rows();
        }
        else {
			return 0;
        }
	}

	function chart_profit($type,$date) {
		$this->db->select_sum('amount');
	  	$this->db->where('currency',$type);  	
	  	$this->db->where("date LIKE '%$date%'");
	  	$query=$this->db->get('bcc_transaction_history');
	  	if($query->num_rows() > 0) {
			$res=$query->row();
	  		return $res->amount ? $res->amount : '0';
	  	}
	  	else {
			return 0;
	  	}
	}

	/**
	 * To get all avilable email templates
	 * @return response set of record or false
	 * @author Sharavana Kumar
	 */
	function getSiteCurrencyCount() {
		$this->db->order_by("created_date", "desc");
		$query = $this->db->get('bcc_currency');
        if($query->num_rows() > 0) {                   
			return $query->num_rows();			
		} 
		else {     
			return 0;
		}
	}									
}
?>