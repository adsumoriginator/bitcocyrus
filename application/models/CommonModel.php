<?php
/**
 * CommonModel class
 * @category model
 * @package Bitcocyrus
 * @subpackage modules
 * @author Adsum Originator LLP
 * @link http://adsumoriginator.com/
 */

class CommonModel extends CI_Model {
	/**
	 * Function use to get the logged in front end user details
	 * @return response success get the set of records or fail
	 */	
	function is_loggedin() {
		$user_id 		= $this->session->userdata('loginCCSiteUserId');
		$status 		= "active";
		
		$this->db->where('status',$status);
		$this->db->where('user_id',$user_id);
		$query_admin = $this->db->get('bcc_userdetails');
		if($query_admin->num_rows() >= 1) {
			$row = $query_admin->row();
			$query_admin->result();
			return 1;
		}
		else {
			/*$_SESSION["loginCCSiteUserId"] 			= "" ;
			$_SESSION["loginCCSiteUserFirstName"] 	= "" ;
			$_SESSION["loginCCSiteUserLastName"] 	= "" ;*/
			unset($_SESSION['loginCCSiteUserId']);
			unset($_SESSION['loginCCSiteUserFirstName']);
			unset($_SESSION['loginCCSiteUserLastName']);
			return 0;
		}
	}

	/**
	 * Function use to get the logged in Frontend user details
	 * @return response success get the set of records or fail
	 */	
	function getLoggedInFrontEndUserDetails($userID) {
		$this->db->where('user_id',$userID);
		$query_admin 	= $this->db->get('bcc_userdetails');
		if($query_admin->num_rows() >= 1) {
			$row = $query_admin->row();
			return $query_admin->result();
		}
		else {
			return false;		
		}
	}	

	/**
	 * Function use to get the site configuration details
	 * @return response success get the set of records or fail
	 */	
	function getSiteMetaContent($ID) {
		$this->db->where('id',$ID);   
		$query = $this->db->get('bcc_meta_content');
        if($query->num_rows() >= 1) {                  
			$row = $query->row();			
            return $query->result();			
		} 
		else {     
			return false;		
		}
	}	

	/**
	 * Function use to get the site configuration details
	 * @return response success get the set of records or fail
	 */	
	function getSiteConfigInfo() {
		$this->db->where('id','1');   
		$query = $this->db->get('bcc_site_settings');
        if($query->num_rows() >= 1) {                   
			$row = $query->row();			
            return $query->result();			
		} 
		else {     
			return false;		
		}
	}

	/**
	 * Function use to get the logged in admin details
	 * @return response success get the set of records or fail
	 */	
	function getAdminDetails() {
		$adminId 		= 1;
		$this->db->where('id',$adminId);
		$query_admin 	= $this->db->get('bcc_admin');
		if($query_admin->num_rows() >= 1) {
			$row = $query_admin->row();
			return $query_admin->result();
		}
		else {
			return false;		
		}
	}	


	function AdminDetails($email_id) {
		$adminId 		= 1;
		$this->db->where('bcc_email_id',$email_id);
		$query_admin 	= $this->db->get('bcc_admin');
		if($query_admin->num_rows() >= 1) {
			$row = $query_admin->row();
			return $query_admin->result();
		}
		else {
			return false;		
		}
	}	

	/**
	 * Function use to get the logged in admin details
	 * @return response success get the set of records or fail
	 */	
	function getLoggedInAdminDetails() {
		$adminId 		= $this->session->userdata('loggedJTEAdminUserID');
		$this->db->where('id',$adminId);
		$query_admin 	= $this->db->get('bcc_admin');
		if($query_admin->num_rows() >= 1) {
			$row = $query_admin->row();
			return $query_admin->result();
		}
		else {
			return false;		
		}
	}

	/**
	 * Function use to get the logged in admin details
	 * @return response success get the set of records or fail
	 */	
	function getLoggedInAdminWalletDetails() {
		$adminWalletId 		= $this->session->userdata('loggedAdminWalletUserID');
		$this->db->where('id',$adminWalletId);
		$query_admin 	= $this->db->get('bcc_admin_wallet');
		if($query_admin->num_rows() >= 1) {
			$row = $query_admin->row();
			return $query_admin->row();
		}
		else {
			return false;		
		}
	}	

	/**
	 * Function use to get the first active currency
	 * @return response success get the set of records or fail
	 */
	function getActiveCurrencySymbol() {
		$status = 1;
		$this->db->limit(1);
		$this->db->select("currency_symbol");
		$this->db->where('status',$status);
		$query = $this->db->get('bcc_currency');
        if($query->num_rows() >= 1) {                   
			/*$row = $query->row();			
            return $query->result();*/
            $fetchData 	= $query->row();
            return $fetchData->currency_symbol;
		} 
		else {     
			return false;		
		}		
	}	

	/**
	 * Function use to get the all country
	 * @return response success get the set of records or fail
	 */	
	function getAllCountry() {
        $query = $this->db->get('bcc_country');
        if($query->num_rows() > 0) {
			return $query->result();
        }
        else {
			return false;
        }		
	}

	function homepagesection() {
		$where=array("id"=>'5','status'=>'1');
		$this->db->where($where);
		$query = $this->db->get('bcc_cms');
		if($query->num_rows() >= 0){
			return $query->result();	
		}
		return false;
	}

	function fetchWallet1($type) {
		$this->db->where('type',$type);      
		$query=$this->db->get('bcc_coin_wallet');	 	     
		if($query->num_rows() >= 1) {
			return $row = $query->row();     
		}      
		else {
			return false;
		}
	}

	public function fetchWallet($type) {
		$this->db->where('type',$type);      
		$query=$this->db->get('bcc_coin_wallet'); 	     
		if($query->num_rows() >= 1) {
			$fetchData 		= $query->row();
			$coinUsername	= insep_decode($fetchData->username);
			$coinPassword	= insep_decode($fetchData->password); 
			$coinPortNumber	= insep_decode($fetchData->portnumber); 
			$coinIPAddress	= insep_decode($fetchData->ipaddress);
			
			$this->btc_username		=	$coinUsername;
			$this->btc_password		=	$coinPassword;
			$this->btc_portnumber 	= 	$coinPortNumber;
			$this->btc_host 		= 	$coinIPAddress;
			$this->url 				= "http://$this->btc_username:$this->btc_password@$this->btc_host:$this->btc_portnumber/";
			$this->version = '2.0'; 
			$this->id = 0;			
		}
		else {
			return false;
		}
	}	

	public function getaccountaddress($user_email) {
		return $this->curl_request('getaccountaddress',array($user_email));
	}

	private function curl_request($cmd, $postfields=null) {
		$data = array();
		$data['jsonrpc'] = $this->version;
		$data['id'] = $this->id++;
		$data['method'] = $cmd;
		$data['params'] = $postfields;

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); 
		curl_setopt($ch, CURLOPT_POST, count($postfields));
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$ret = curl_exec($ch);
		curl_close($ch);

		if($ret !== FALSE)
		{
			$formatted = $this->format_response($ret);
			
			if(isset($formatted->error))
			{
				throw new Exception($formatted->error->message, $formatted->error->code);
			}
			else
			{
				return $formatted->result;
			}
		}
		else
		{
			throw new Exception("Server did not respond");
		}
	}		


function insep_encode($value){
		$skey= "SuPerEncKey2010c";
		if(!$value){return false;}
		$text = $value;
		$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
		$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
		$crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $skey, $text, MCRYPT_MODE_ECB, $iv);
		return trim($this->safe_b64encode($crypttext));
	}

	function insep_decode($value){
		$skey= "SuPerEncKey2010c";
		if(!$value){return false;}
		$crypttext = $this->safe_b64decode($value);
		$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
		$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
		$decrypttext = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $skey, $crypttext, MCRYPT_MODE_ECB, $iv);
		return trim($decrypttext);
	}
	/* method 1 */

	/* method 2 */
   function customEncode($pure_string) {
		$encryption_key = "!!%&*^Sellbit-Buy!!%^%";
		$iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
    	$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
    	$encrypted_string = mcrypt_encrypt(MCRYPT_BLOWFISH, $encryption_key, utf8_encode($pure_string), MCRYPT_MODE_ECB, $iv);
    	return trim($this->safe_b64encode($encrypted_string));
    }

    function customDecode($encrypted_string) {
		$encryption_key = "!!%&*^Sellbit-Buy!!%^%";
		$iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
    	$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
    	$decrypted_string = mcrypt_decrypt(MCRYPT_BLOWFISH, $encryption_key,$this->safe_b64decode($encrypted_string), MCRYPT_MODE_ECB, $iv);
    	return $decrypted_string;
    }
    /* method 2 */	

	function safe_b64encode($string) {
		$data = base64_encode($string);
	    $data = str_replace(array('+','/','='),array('-','_',''),$data);
	    return $data;
	}
	function safe_b64decode($string) {
		$data = str_replace(array('-','_'),array('+','/'),$string);
		$mod4 = strlen($data) % 4;
		if ($mod4) {
		    $data .= substr('====', $mod4);
		}
		return base64_decode($data);
	}

	function to_decimal($value, $places=9){
		$value = number_format($value, $places, '.','');		
		return $value;
	}	


	

	/* method 1 */
	


	public function getTableData($tableName = '', $where = array(), $orderBy = array(),$selectFields = '', $like = array(), $where_or = array(), $like_or = array(), $offset = '', $limit = '', $groupBy = array(), $where_not = array(), $where_in = array())
	{
		// WHERE AND conditions
		if ((is_array($where)) && (count($where) > 0)) {
			$this->db->where($where);
		}
		// WHERE NOT conditions
		if ((is_array($where_not)) && (count($where_not) > 0)) {
			//echo "<pre>";
			//print_r($where_not);die;
			$this->db->where_not_in($where_not[0],$where_not[1]);
		}
		// WHERE IN conditions
		if ((is_array($where_in)) && (count($where_in) > 0)) {
			$this->db->where_in($where_in[0],$where_in[1]);
		}
		// WHERE OR conditions
		if ((is_array($where_or)) && (count($where_or) > 0)) {
			$this->db->or_where($where_or);
		}
		// $this->db->group_start();
		//LIKE AND 
		if ((is_array($like)) && (count($like) > 0)) {
			$this->db->like($like);
		}
		//LIKE OR 
		if ((is_array($like_or)) && (count($like_or) > 0)) {
			$this->db->or_like($like_or);
		}
		// $this->db->group_end();
		//SELECT fields
		if ($selectFields != '') {
			$this->db->select($selectFields);
		}
		//Group By
		if (is_array($groupBy) && (count($groupBy) > 0)) {
			$this->db->group_by($groupBy[0]);
		}
		//Order By
		if (is_array($orderBy) && (count($orderBy) > 0)) {
			if(count($orderBy) > 2)
			{
				$this->db->order_by($orderBy[0].' '.$orderBy[1].','.$orderBy[2].' '.$orderBy[3]);
			}
			else
			{
				$this->db->order_by($orderBy[0], $orderBy[1]);
			}
		}
		//OFFSET with LIMIT
		if($limit != '' && $offset != ''){
			$this->db->limit($limit, $offset);
		}
		// LIMIT
		if($limit != '' && $offset == ''){
			$this->db->limit($limit);
		}
		
		return $this->db->get($tableName);
	}

	function get_data($table,$where,$select=FALSE,$order = FALSE,$limit=FALSE,$join=FALSE,$type,$wherenot='',$field='',$wherein='',$priority='',$priority_type='')
	{
		
	    if(!empty($select))
	    {
	        $this->db->select($select,FALSE);    
	    }
	    if(!empty($join))
	    {
	        $this->db->from($join[0]);
	        $this->db->join($join[1],$join[2]);
	    }
	    if(!empty($where))
	    {
	        $this->db->where($where);
	    }
	    if(!empty($wherein))
	    {
	        $this->db->where_in($wherein);
	    }
	    if(!empty($wherenot))
	    {
	        $this->db->where_not_in($wherenot);
	    }
	    if(!empty($order) && $order != '')
	    {
			if(is_array($order)){
				if(count($order)==2)
				$this->db->order_by($order[0], $order[1]);
				else if(count($order)==1){
				if(isset($order[0]))
				$this->db->order_by($order[0]);
				else{
					foreach($order as $orderkey=>$orderval){
				      $this->db->order_by($orderkey, $orderval);
				    }
			     }
			   }
			}else
	        $this->db->order_by($order);
	    }
	    if(!empty($priority))
	    {	    
	    	if(!empty($priority_type)){
	        $this->db->order_by($priority,$priority_type);
	    	}else{
	    		$this->db->order_by($priority,'ASC');
	    	}
	    }
	    if(!empty($limit))
	    {
	        $this->db->limit($limit[0],$limit[1]);
	    }

	    $query = $this->db->get($table);
	    if($query->num_rows() >= 1)
	    {   

	        if($type == 'result')
	        {
	            return $query->result();
	        } 
	        else if($type == 'result_array')
	        {
	            return $query->result_array();
	        } 
	        else if($type == 'row_array')
	        {
	            return $query->row_array();
	        } 
	        else if($type == 'row')
	        {
	         	if($field != '')
		        {
		            $row	=	$query->row();			 
					return $row->$field;
		        }else{
	            	return $query->row();
	        	}
	        }    
	        else if($type == 'count')
	        {
	            return $query->num_rows();
	        }        
	    }  
	    else
	    {    
	        return false;        
	    }
	}


	function updateTableData($table_name="",$data=array(),$condition=array()){
		if(!empty($condition))
	    {
	        $this->db->where($condition);
	    }
	    $this->db->update($table_name,$data);

		    return false;

	}	


	function addTableData($table_name,$data){
		$this->db->insert($table_name,$data);
		return true;

	}	

	function deleteTabledata($table,$condition){
		if(!empty($condition))
	    {
	        $this->db->where($condition);
	    }
	    $this->db->delete($table);

		    return false;

		}


	function get_count($table_name="",$condition=array()){
		$this->db->select('count(*) as count');
		$this->db->from($table_name);

		if(!empty($condition)){
			$this->db->where($condition);
		}
		$query = $this->db->get()->row();

		return  $query->count;
		

	}	


	public function addDefualtUserDetail($user_id)
	{

	         $condition=array("status"=>1);
	         $data=$this->getTableData("currency",$condition);
	         foreach ($data->result() as  $row) {

		         $walletdata["currency_symbol"] = $row->currency_symbol;
		         $walletdata['user_id']=$user_id;
		         $this->db->insert("address_balance",$walletdata);	
	         }
			 $userid_data['user_id']=$user_id;
			 $this->db->insert("user_verification",$userid_data);
         return true;
	}	

	public function get_deposit_withdraw($user_id, $seg)
	{
		$this->db->select('t1.*, t2.*');
		$this->db->from('address_balance as t1, currency as t2');
		$condition = '(t1.currency_symbol= t2.currency_symbol and  t1.user_id = "'.$user_id.'" and t2.status = 1 and t1.currency_symbol = "'.$seg.'"  )';
		$this->db->where($condition);
		$query=$this->db->get();
		return $query;
	}
	
	public function get_user_dashboard_data($user_id)
	{
		$this->db->select('t1.*, t2.*');
		$this->db->from('address_balance as t1, currency as t2');
		$condition = '(t1.currency_symbol= t2.currency_symbol and  t1.user_id = "'.$user_id.'" and t2.status = 1 )';
		$this->db->where($condition);
		$query=$this->db->get();
		return $query;
	}
	
	public function get_usd_amount($user_id)
	{
		$this->db->select('SUM(usd_amount) AS total_usd_amount');
		$this->db->from('tansation');
		$date=date("Y-m-d")." "."00:00:00";
		$condition = '(requested_time >= "'.$date.'" and user_id = "'.$user_id.'" and type = 2  )';
		$this->db->where($condition);
		$query=$this->db->get();
		return $query;
	}

	public function get_admin_dashboard_data($user_id)
	{

		$this->db->select('t1.*, t2.currency_name');
		$this->db->from('admin_address as t1, currency as t2');
		$condition = '(t1.currency_symbol= t2.currency_symbol and  t1.admin_id = 1 and t2.status = 1 )';
		$this->db->where($condition);
		$query=$this->db->get();
		return $query;
	}

	/*
	 * Function used to find data using query
	 * @author Jatin
	 * @link http://adsumoriginator.com/
	 */
	public function get_userdetil_ip_data($query)
	{

		$data =$this->db->query($query);
		return $data;
	}

	public function getaddress($user_id,$currency_symbol)
	{


		$userdetail=get_user($user_id);
		
		

		$user_email = insep_decode($userdetail->key_one)."@".insep_decode($userdetail->key_two);

		

		require_once 'jsonRPCClient.php';

		
		 if ($currency_symbol == "BTC" || $currency_symbol == "USDT" || $currency_symbol == "LTC" || $currency_symbol == "DASH" || $currency_symbol == "BTG" ||$currency_symbol == "DGB" || $currency_symbol == "XVG"){


					   $data=$data=get_cn_data($currency_symbol);
		$bitcoin_username 		= insep_decode($data['user']);	
		$bitcoin_password 		= insep_decode($data['password']);
		$bitcoin_ip 	= insep_decode($data['ip']);	
		$bitcoin_portnumber = insep_decode($data['port']);		
		$bitcoin 	= new jsonRPCClient("http://$bitcoin_username:$bitcoin_password@$bitcoin_ip:$bitcoin_portnumber/");
					   $address=  $bitcoin->getaccountaddress($user_email);
		$addressdata = array("address"=>$address);
		//$walletdata['address']=$address;

	 }else if ($currency_symbol == "BCH") {

					  $data=$data=get_cn_data($currency_symbol);
		$bitcoin_username 		= insep_decode($data['user']);	
		$bitcoin_password 		= insep_decode($data['password']);
		$bitcoin_ip 	= insep_decode($data['ip']);	
		$bitcoin_portnumber = insep_decode($data['port']);
		$bitcoin 	= new jsonRPCClient("http://$bitcoin_username:$bitcoin_password@$bitcoin_ip:$bitcoin_portnumber/");
			 $address=  $bitcoin->getaccountaddress($user_email);
				  $address=str_replace('bitcoincash:', '',  $address);



		$addressdata = array("address"=>$address);
		//$walletdata["BCH"]=$address;


	 }else if ($currency_symbol == "ETH") {

						$data=get_cn_data("ETH");
		 $bitcoin_portnumber = insep_decode($data['port']);		
		 $data1 = array('key'=>'bitcocyruseth','port'=>$bitcoin_portnumber,'method'=>'create','name'=>'bitcocyrus.com','keyword' => '98543423');
			  $output 	   			= connecteth('create',$data1);
		$address=$output->result;


		$addressdata = array("address"=>$address);

	 }else if ($currency_symbol == "ETC") {
					   
						$data=get_cn_data("ETC");
						$bitcoin_portnumber = insep_decode($data['port']);		
			  $data1 = array('key'=>'bitcocyrusetc','port'=>$bitcoin_portnumber,'method'=>'create','name'=>'bitcocyrus.com','keyword' => '98543423');
			  $output 	   			= connectetc('create',$data1);	
				   $address=$output->result;

		$addressdata = array("address"=>$address);

	 }else if ($currency_symbol == "TRX") {
					   $data=get_cn_data("ETH");
			 $bitcoin_portnumber = insep_decode($data['port']);		
			  $data1 = array('key'=>'bitcocyruseth','port'=>$bitcoin_portnumber,'method'=>'create','name'=>'bitcocyrus.com','keyword' => '98543423');
		$output 	   			= connecttrx('create',$data1);


		$address=$output->result;

		$addressdata = array("address"=>$address);
	 }elseif ($currency_symbol == "EOS") {
					   
					   $data=get_cn_data("ETH");
					   $bitcoin_portnumber = insep_decode($data['port']);		
		$data1 = array('key'=>'bitcocyruseth','port'=>$bitcoin_portnumber,'method'=>'create','name'=>'bitcocyrus.com','keyword' => '98543423');
		$output 	   			= connecteos('create',$data1);
		$address=$output->result;
		$addressdata = array("address"=>$address);

	 }
	 elseif ($currency_symbol == "NPXS") {
					   
					   $data=get_cn_data("ETH");
					   $bitcoin_portnumber = insep_decode($data['port']);		
		$data1 = array('key'=>'bitcocyruseth','port'=>$bitcoin_portnumber,'method'=>'create','name'=>'bitcocyrus.com','keyword' => '98543423');
		$output 	   			= connectnpxs('create',$data1);
		$address=$output->result;
		$addressdata = array("address"=>$address);

	 }
	 elseif ($currency_symbol == "IOST") {
					   
					   $data=get_cn_data("ETH");
					   $bitcoin_portnumber = insep_decode($data['port']);		
		$data1 = array('key'=>'bitcocyruseth','port'=>$bitcoin_portnumber,'method'=>'create','name'=>'bitcocyrus.com','keyword' => '98543423');
		$output 	   			= connectiost('create',$data1);
		$address=$output->result;
		$addressdata = array("address"=>$address);

	 }
	  elseif ($currency_symbol == "ZRX") {
					   
					   $data=get_cn_data("ETH");
					   $bitcoin_portnumber = insep_decode($data['port']);		
		$data1 = array('key'=>'bitcocyruseth','port'=>$bitcoin_portnumber,'method'=>'create','name'=>'bitcocyrus.com','keyword' => '98543423');
		$output 	   			= connectzrx('create',$data1);
		$address=$output->result;
		$addressdata = array("address"=>$address);

	 }
	  elseif ($currency_symbol == "OMG") {
					   
					   $data=get_cn_data("ETH");
					   $bitcoin_portnumber = insep_decode($data['port']);		
		$data1 = array('key'=>'bitcocyruseth','port'=>$bitcoin_portnumber,'method'=>'create','name'=>'bitcocyrus.com','keyword' => '98543423');
		$output 	   			= connectomg('create',$data1);
		$address=$output->result;
		$addressdata = array("address"=>$address);

	 }
	 elseif ($currency_symbol == "XRP") {

					   $this->wallet_dir 	= FCPATH.'ripple';
		$this->node_dir 	= '/usr/bin/node';
		$result = exec('cd '.$this->wallet_dir.'; '.$this->node_dir.' ripple.js '.'', $this->output);
		$result=json_decode($result);
		$address=$result->address;
			 $secrect=$result->secret;
					   $addressdata = array("address"=>$address,'skey'=>$secrect);

	 }else if ($currency_symbol == "XMR") {

					   
				//	  $integrate_address_parameters = array('payment_id' => $payment_id);
				//	  $integrate_address_method = monero_request('make_integrated_address', $integrate_address_parameters);



						  $data=get_cn_data($currency_symbol);
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
		   
		$addressdata = array("address"=>$address,'payment_id'=>$payment_id);
		
	 }


            $condition=array("user_id"=>$user_id,"currency_symbol"=>$currency_symbol,"address"=>NULL);
            $this->db->where($condition);
            $this->db->update('address_balance',$addressdata);
			$condition=array("user_id"=>$user_id,"currency_symbol"=>$currency_symbol);
            $wallet=$this->CommonModel->getTableData("address_balance",$condition)->row();
			//print_r($wallet);	
		
            return $wallet;

	}
	function getuserAddress($user_id, $currency_symbol) {
		$condition=array("user_id"=>$user_id,"currency_symbol"=>$currency_symbol);
        $wallet=$this->CommonModel->getTableData("address_balance",$condition)->row();
		return $wallet;
	}
}
?>