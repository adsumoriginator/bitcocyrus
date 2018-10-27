<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Monero_wallet_model extends CI_Model {  
	/*
	* Mainly Source From : https://en.bitcoin.it/wiki/Original_Bitcoin_client/API_calls_list
	*/
	protected $id = 0;
	public function __construct() 
	{
		parent::__construct();	
		$tables    = wallet_table();
		
		$wallet_whr 	   = array('type'=>'monero','con_type'=>'rpc','status'=>'active');
		$wallet_row        = $this->db->where($wallet_whr)->get($tables)->row();// fetch bitcoin wallet credentials
		if(!empty($wallet_row)){
			$wallet_username   = $this->encryption->decrypt($wallet_row->username);
			$wallet_password   = $this->encryption->decrypt($wallet_row->password);
			$this->wallet_port = $wallet_portnumber = $this->encryption->decrypt($wallet_row->portnumber);
			$this->wallet_ip   = $wallet_allow_ip   = $this->encryption->decrypt($wallet_row->allow_ip);
			$this->version	   = "2.0";
			$this->url = "http://$wallet_allow_ip:$wallet_portnumber/json_rpc";
			//$this->client 	   = new jsonRPCClientNew("http://$wallet_allow_ip:$wallet_portnumber/");
		}
		else
		die(json_encode(array('status'=>'error','message'=>'Security Error')));
	} 

	public function index()
	{
		die(json_encode(array('status'=>'error','message'=>'Security Error')));
	}

	/**
	 * Remote procedure call handler
	 *
	 * @param string $cmd
	 * @param string $request
	 * @param string $postfield
	 * @return stdClass Returned fields
	 */
	private function monero_request($cmd, $postfields=null) {

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

	private function _transform($amount){
		$new_amount = $amount * 100000000;
		return $new_amount;
	}

	/**
	* Print json (for api)
	* @return $json
	*/
	public function _print($json){
		$json_parsed = json_encode($json,  JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
		echo $json_parsed;
	}

	public function format_response($response)
	{
		return @json_decode($response);
	}
  
	/**
	* Print Monero Address as JSON Array
	*/
	public function getaccountaddress($user_mail = ''){
		return $this->monero_request('getaddress')->address;
	}
  
	/*
	* Print Monero Balance as JSON Array
	*/
	public function getbalance(){
		$balance = $this->monero_request('getbalance');
		return $balance;
	}
  
	/*
	* Print Monero Height as JSON Array
	*/
	public function getheight(){
		$height = $this->monero_request('getheight');
		return $height;
	}
  
    /*
    * Incoming Transfer
    * $type must be All 
    */
    public function incoming_transfer($type = 'all'){
        $incoming_parameters = array('transfer_type' => $type);
        $incoming_transfers = $this->monero_request('incoming_transfers', $incoming_parameters);
        return $incoming_transfers;
    }
  
    public function get_transfers($input_type, $input_value){
        $get_parameters = array($input_type => $input_value);
        $get_transfers = $this->monero_request('get_transfers', $get_parameters);
        return $get_transfers;
    }
     
    public function view_key(){
        $query_key = array('key_type' => 'view_key');
        $query_key_method = $this->monero_request('query_key', $query_key);
        return $query_key_method;
    }
     
    /* A payment id can be passed as a string
       A random payment id will be generatd if one is not given */
    public function make_integrated_address($payment_id = ''){
        $integrate_address_parameters = array('payment_id' => $payment_id);
        $integrate_address_method = $this->monero_request('make_integrated_address', $integrate_address_parameters);
        return $integrate_address_method;
    }
     
    public function split_integrated_address($integrated_address){
        if(!isset($integrated_address)){
            echo "Error: Integrated_Address mustn't be null";
        }
        else{
        $split_params = array('integrated_address' => $integrated_address);
        $split_methods = $this->monero_request('split_integrated_address', $split_params);
        return $split_methods;
        }
    }
  
  	public function make_uri($address, $amount, $recipient_name = null, $description = null){
        // If I pass 1, it will be 1 xmr. Then 
        $new_amount = $amount * 1000000000000;
       
         $uri_params = array('address' => $address, 'amount' => $new_amount, 'payment_id' => '', 'recipient_name' => $recipient_name, 'tx_description' => $description);
        $uri = $this->monero_request('make_uri', $uri_params);
        return $uri;
    }
     
     
    public function parse_uri($uri){
         $uri_parameters = array('uri' => $uri);
        $parsed_uri = $this->monero_request('parse_uri', $uri_parameters);
        return $parsed_uri;
    }
     
    public function transfer($amount, $address, $mixin = 4){
        $new_amount = $amount  * 1000000000000;
        $destinations = array('amount' => $new_amount, 'address' => $address);
        $transfer_parameters = array('destinations' => array($destinations), 'mixin' => $mixin, 'get_tx_key' => true, 'unlock_time' => 0, 'payment_id' => '');
        $transfer_method = $this->monero_request('transfer', $transfer_parameters);
        return $transfer_method;
    }
  
	public function get_payments($payment_id){
		$get_payments_parameters = array('payment_id' => $payment_id);
		$get_payments = $this->monero_request('get_payments', $get_payments_parameters);
		return $get_payments;
	}
  
	public function get_bulk_payments($payment_id, $min_block_height){
		$get_bulk_payments_parameters = array('payment_id' => $payment_id, 'min_block_height' => $min_block_height);
		$get_bulk_payments = $this->monero_request('get_bulk_payments', $get_bulk_payments_parameters);
		return $get_bulk_payments;
	}

} // end of class