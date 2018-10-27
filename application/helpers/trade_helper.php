<?php
/**
 * Common Helper
 * @package Osiz Technologies Pvt Ltd
 * @subpackage WCX
 * @category Helpers
 * @author Balaji
 * @version 1.0
 * @link http://osiztechnologies.com/
 * 
 */
 // Administrator URL

 function wallet_url()
 {
  return base_url() . 'bitcowallet/';
 }

 
   function wallet_redirect($url, $refresh = 'refresh') {
  redirect('bitcowallet/'.$url, $refresh);
 } 



 function admin_url()
 {
 	return base_url() . 'FWOlanuovrThb/';
 }

  function adminwealth_url()
 {
 	return base_url() . 'WpAueDAhMlITaNhl/';
 }

  function front_url()
 {
 	//return base_url() . 'wcx_front/';
	return base_url();
 }
 // CSS URL
 function css_url()
 {
 	return base_url() . 'assets/front/css/';
 }
  //API CSS
 function api_css_url()
 {
 	return base_url() . 'assets/front/api/css/';
 }
 // JavaScript URL
 function js_url()
 {
 	return base_url() . 'assets/frontend/js/';
 }
 //Admin Source
 function admin_source()
 {
	 return base_url() . 'assets/admin/';
 }
 //Front Source
 function front_source()
 {
	 return base_url() . 'assets/front/';
 }
 // Uploads URL
 function uploads_url()
 {
 	return 'https://res.cloudinary.com/www-wcx-io/image/upload/v1505804655/uploads/';
 }
 // Admin URL redirect
 function admin_redirect($url, $refresh = 'refresh') {
 	//redirect('FWOlanuovrThb/'.$url, $refresh);
 }

  // Admin URL redirect
 function adminwealth_redirect($url, $refresh = 'refresh') {
 	//redirect('WpAueDAhMlITaNhl/'.$url, $refresh);
 }

  // User URL redirect
 function front_redirect($url, $refresh = 'refresh') {
 	//redirect('wcx_front/'.$url, $refresh);
	redirect($url, $refresh);
 }
 // Site name
 /*function getSiteName() {
 	$ci =& get_instance();
	$name = $ci->db->where('id', 1)->get('site_settings')->row()->site_name;
	if ($name) {
		return $name;
	} else {
		return 'No Company name';	
	}
 }

 
 // Site logo
 function getSiteLogo() {
 	$ci =& get_instance();
	$logo = $ci->db->where('id', 1)->get('site_settings')->row()->site_logo;
	if ($logo) {
		return $logo;
	} else {
		return false;	
	}
 }
  function getFavLogo() {
 	$ci =& get_instance();
	$logo = $ci->db->where('id', 1)->get('site_settings')->row()->fav_logo;
	if ($logo) {
		return $logo;
	} else {
		return false;	
	}
 }
  // Site name
 function getSiteSettings($key='') {
 	$ci =& get_instance();
	$name = $ci->db->where('id', 1)->get('site_settings')->row();
	if($key!='')
	{
		return $name->$key;
	}
	else
	{
		return $name;
	}
 }
 // Admin Details
 function getAdminDetails($id,$key='') {
 	$ci =& get_instance();
	$name = $ci->db->where('id',$id)->get('admin')->row();
	if ($name) {
		if($key!='')
		{
			return $name->$key;
		}
		else
		{
			return $name;
		}
	} else {
		return '';	
	}
 }


*/

  // Wallet Admin Details
 function getWalletAdminDetails($id,$key='') {
 	$ci =& get_instance();
	$name = $ci->db->where('id',$id)->get('admin_wealth')->row();
	if ($name) {
		if($key!='')
		{
			return $name->$key;
		}
		else
		{
			return $name;
		}
	} else {
		return '';	
	}
 }

  // User verification documents
 function getdocumentPicture($id = '', $type='') { 
 $image=getUserDetails($id,$type);
	 if(trim($image) != '')	
	return uploads_url() . 'user/' . $id . '/' . $image;
	else
	return uploads_url().'user/trd6.png';
 }
   // User verification documents
function getChatImage($id = '') { 
 $image=getUserDetails($id,'profile_picture');
	 if($image)	
	return $image;
	else
	return dummyuserImg();
 }
 function dummyuserImg()
 {
	 return 'https://res.cloudinary.com/www-wcx-io/image/upload/uploads/trd6.png';
 }
// User details
 function getUserDetails($id,$key='') {
 	$ci =& get_instance();
	$userDetails = $ci->db->where('user_id', $id)->get('userdetails');
	if ($userDetails->num_rows() > 0) {
		if($key=='')
		{
			return $userDetails->row();
		}
		else
		{
			return $userDetails->row($key);
		}
	} else {
		return FALSE;
	}
 }

 function getSupportCategory($id) {
 	$ci =& get_instance();
	$support = $ci->db->where('id', $id)->get('support_category');
	if ($support->num_rows() > 0) {
		return $support->row('name');
	} else {
		return FALSE;
	}
 }
// Get OS
function getOS() { 

   $user_agent = $_SERVER['HTTP_USER_AGENT'];

    $os_platform    =   "Unknown OS Platform";

    $os_array       =   array(
                            '/windows nt 10/i'     =>  'Windows 10',
                            '/windows nt 6.3/i'     =>  'Windows 8.1',
                            '/windows nt 6.2/i'     =>  'Windows 8',
                            '/windows nt 6.1/i'     =>  'Windows 7',
                            '/windows nt 6.0/i'     =>  'Windows Vista',
                            '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
                            '/windows nt 5.1/i'     =>  'Windows XP',
                            '/windows xp/i'         =>  'Windows XP',
                            '/windows nt 5.0/i'     =>  'Windows 2000',
                            '/windows me/i'         =>  'Windows ME',
                            '/win98/i'              =>  'Windows 98',
                            '/win95/i'              =>  'Windows 95',
                            '/win16/i'              =>  'Windows 3.11',
                            '/macintosh|mac os x/i' =>  'Mac OS X',
                            '/mac_powerpc/i'        =>  'Mac OS 9',
                            '/linux/i'              =>  'Linux',
                            '/ubuntu/i'             =>  'Ubuntu',
                            '/iphone/i'             =>  'iPhone',
                            '/ipod/i'               =>  'iPod',
                            '/ipad/i'               =>  'iPad',
                            '/android/i'            =>  'Android',
                            '/blackberry/i'         =>  'BlackBerry',
                            '/webos/i'              =>  'Mobile'
                        );

    foreach ($os_array as $regex => $value) { 

        if (preg_match($regex, $user_agent)) {
            $os_platform    =   $value;
        }

    }   

    return $os_platform;

}
//Get Browser
function getBrowser() {

    $user_agent = isset($_SERVER['HTTP_USER_AGENT'])?$_SERVER['HTTP_USER_AGENT']:'';
    $browser        =   "Unknown Browser";

    $browser_array  =   array(
                            '/msie/i'       =>  'Internet Explorer',
                            '/firefox/i'    =>  'Firefox',
                            '/safari/i'     =>  'Safari',
                            '/chrome/i'     =>  'Chrome',
                            '/edge/i'       =>  'Edge',
                            '/opera/i'      =>  'Opera',
                            '/netscape/i'   =>  'Netscape',
                            '/maxthon/i'    =>  'Maxthon',
                            '/konqueror/i'  =>  'Konqueror',
                            '/mobile/i'     =>  'Handheld Browser'
                        );

    foreach ($browser_array as $regex => $value) { 

        if (preg_match($regex, $user_agent)) {
            $browser    =   $value;
        }

    }

    return $browser;

}
function encryptIt( $q ) {
    $cryptKey  = 'balaji098';
    $qEncoded      = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
    return( $qEncoded );
}
function decryptIt( $q ) {
    $cryptKey  = 'balaji098';
    $qDecoded      = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $q ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
    return( $qDecoded );
}
/*
function insep_encode($value){
$skey= "X4eCXp1loRt0zwG6";
if(!$value){return false;}
$text = $value;
$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
$crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $skey, $text, MCRYPT_MODE_ECB, $iv);
return trim(safe_b64encode($crypttext));
}

function insep_decode($value){
$skey= "X4eCXp1loRt0zwG6";
if(!$value){return false;}
$crypttext = safe_b64decode($value);
$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
$decrypttext = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $skey, $crypttext, MCRYPT_MODE_ECB, $iv);
return trim($decrypttext);
}
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

*/
//format to decimal places as below
function to_decimal($value, $places=9){
	// if(trim($value)=='')
	// return 0;
	// else if((float)$value==0)
	// return 0;
	// if((float)$value==(int)$value)
	// return (int)$value;   
	// else{	
	$value = (float)$value;	
		$value = number_format($value, $places, '.','');
		// $value1 = $value;					
		// if(substr($value,-1) == '0')
		// $value = substr($value,0,strlen($value)-1);
		// if(substr($value,-1) == '0')
		// $value = substr($value,0,strlen($value)-1);
		// if(substr($value,-1) == '0')
		// $value = substr($value,0,strlen($value)-1);
		// if(substr($value,-1) == '0')
		// $value = substr($value,0,strlen($value)-1);
		// if(substr($value,-1) == '0')
		// $value = substr($value,0,strlen($value)-1);
		// if(substr($value,-1) == '0')
		// $value = substr($value,0,strlen($value)-1);		
		// if(substr($value,-1) == '0')
		// $value = substr($value,0,strlen($value)-1);			
		return $value;
	//}
}
function to_decimal_point($value, $places=9){
	if(trim($value)=='')
	return 0;
	else if((float)$value==0)
	return 0;
	if((float)$value==(int)$value)
	return (int)$value;   
	else{		
		$value = number_format($value, $places, '.','');
		$value1 = $value;					
		if(substr($value,-1) == '0')
		$value = substr($value,0,strlen($value)-1);
		if(substr($value,-1) == '0')
		$value = substr($value,0,strlen($value)-1);
		if(substr($value,-1) == '0')
		$value = substr($value,0,strlen($value)-1);
		if(substr($value,-1) == '0')
		$value = substr($value,0,strlen($value)-1);
		if(substr($value,-1) == '0')
		$value = substr($value,0,strlen($value)-1);
		if(substr($value,-1) == '0')
		$value = substr($value,0,strlen($value)-1);		
		if(substr($value,-1) == '0')
		$value = substr($value,0,strlen($value)-1);			
		return $value;
	}
}
function character_limiter($text,$limit)
{
	if(strlen($text)>$limit)
	{
		$str=substr($text,0,$limit).'...';
	}
	else
	{
		$str=$text;
	}
	return $str;
}
function getUserEmail($id='')
{
	if($id!='')
	{
		$ci =& get_instance();
		$userDetails = $ci->db->where('user_id', $id)->get('history');
		if ($userDetails->num_rows() > 0)
		{
			$user1=getUserDetails($id,'wcx_email');
			$user=$userDetails->row();
			$email=decryptIt($user->wcx_type).$user1;
		}
		else
		{
			$email='';
		}
	}
	else
	{
		$email='';
	}
	return $email;
}
function UserName($id='')
{
	if($id!='')
	{
		$ci =& get_instance();
		$prefix=get_prefix();
		$userDetails=getUserDetails($id,$prefix.'username');
		if ($userDetails)
		{
			$username=$userDetails;
		}
		else
		{
			$username='';
		}
	}
	else
	{
		$username='';
	}
	return $username;
}

function site_common()
{	
	$ci =& get_instance();
	$language_id = isset($_COOKIE['language_id'])?$_COOKIE['language_id']:'';
	$array_where=array('status'=>1,'language'=>$language_id);
	$data['cms'] =  $ci->db->where($array_where)->get('cms')->result();
	$data['static_content'] =  $ci->db->where('language', $language_id )->get('static_content')->result();
	$data['site_settings'] =  $ci->db->where('id', 1)->get('site_settings')->row();
	return $data;
}

function get_user_bank_details($id,$user_id){
	$ci =& get_instance();
	$ci->db->where('id', $id);
	$ci->db->where('user_id',$user_id);
	$ci->db->where('status',1);
	$bank = $ci->db->get('user_bank_details')->row();
	return $bank;
}

function get_countryname($id)
{
	$ci =& get_instance();
	$ci->db->where('id', $id);
	$country = $ci->db->get('countries')->row();
	return $country;
}

function getUserName($user,$type='username')
{
	$username='wcx_'.$type;
	return $user->$username;
}

function getfiatcurrency($currency)
{
	$ci =& get_instance();
	$fiat_currency = $ci->db->where('id', $currency)->get('fiat_currency')->row();
	return $fiat_currency->currency_symbol;
}
function getfiatcurrencydetail($currency)
{
	$ci =& get_instance();
	$fiat_currency = $ci->db->where('id', $currency)->get('fiat_currency')->row();
	return $fiat_currency;
}
function getcryptocurrency($currency) //currency_symbol
{
	$ci =& get_instance();
	$currency = $ci->db->where('id', $currency)->get('currency')->row();
	return $currency->currency_symbol;
}
function getcryptocurrencys($currency) // currency_name
{
	$ci =& get_instance();
	$currency = $ci->db->where('id', $currency)->get('currency')->row();
	return $currency->currency_name;
}
function getcryptocurrencydetail($currency) // full currency row
{
	$ci =& get_instance();
	$currency = $ci->db->where('id', $currency)->get('currency')->row();
	return $currency;
}

function splitEmail($email)
{
	$str=array();
	$str[0] = substr($email, 0, 4);
	$str[1] = substr($email, 4);
	return $str;
}
function get_prefix()
{
	return 'wcx_';
}
function checkSplitEmail($email,$password='')
{
	$str=splitEmail($email);
	$str1=$str[0];
	$str2=$str[1];
	$prefix=get_prefix();
	$ci =& get_instance();
	$ci->db->select('users.*,history.user_id');
	$ci->db->from('users');
	$ci->db->where('users.'.$prefix.'email',$str2);
	if($password!='')
	{
		$ci->db->where('users.'.$prefix.'password',encryptIt($password));
	}
	$ci->db->where('history.wcx_type',encryptIt($str1));
	$ci->db->join('history', 'users.id = history.user_id');
	$query = $ci->db->get();
	if($query->num_rows()==0)
	{
		return false;
	}
	else
	{
		return $query->row();
	}
}
function checkElseEmail($email,$password='')
{
	$prefix=get_prefix();
	//$where = "(".$prefix."username='".$email."' or ".$prefix."phone='".encryptIt($email)."')";
	$ci =& get_instance();
	$ci->db->from('users');
	if($password!='')
	{
		$arr=array($prefix.'password'=>encryptIt($password),$prefix.'username'=>$email);
		$arr1=array($prefix.'phone'=>encryptIt($email));
		$ci->db->where($arr);
		$ci->db->or_where($arr1);
		$ci->db->where($prefix.'password',encryptIt($password));
	}
	else
	{
		$arr=array($prefix.'username'=>$email);
		$arr1=array($prefix.'phone'=>encryptIt($email));
		$ci->db->where($arr);
		$ci->db->or_where($arr1);
	}
	$query = $ci->db->get();
	if($query->num_rows()==0)
	{
		return false;
	}
	else
	{
		return $query->row();
	}
}
function convercurr($convertfrom,$convertto,$type='buy')
{	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,"https://min-api.cryptocompare.com/data/price?fsym=".$convertfrom."&tsyms=".$convertto);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	$output = curl_exec($ch);
	curl_close($ch);
	if(isset(json_decode($output)->$convertto)){
		if(json_decode($output)->$convertto>0)
		{
			return $output;
		}
		else
		{
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,"https://min-api.cryptocompare.com/data/price?fsym=".$convertto."&tsyms=".$convertfrom);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			$output = curl_exec($ch);
			curl_close($ch);
			
			$rev = json_decode($output)->$convertfrom; 
			$revs = (1/$rev);
			$outputs = array();
			$outputs[$convertto] = $revs;
			
			$output = json_encode($outputs);
			return $output;

		}
		
	}
	else if($type=='buy')
	{
		$ci =& get_instance();
		$id = $ci->db->where('currency_symbol', $convertto)->get('currency')->row('id');
		$id2 = $ci->db->where('currency_symbol', $convertfrom)->get('fiat_currency')->row('id');
		$where = array('from_symbol_id'=>$id2, 'to_symbol_id'=>$id);
		$online_price = $ci->db->where($where)->get('pair')->row('online_price');
		$static_value = new stdClass();
		$static_value->$convertto = (1/$online_price); 
		return json_encode($static_value);
	}
	else if($type=='sell')
	{
		$ci =& get_instance();
		$id = $ci->db->where('currency_symbol', $convertfrom)->get('currency')->row('id');
		$id2 = $ci->db->where('currency_symbol', $convertto)->get('fiat_currency')->row('id');
		$where = array('to_symbol_id'=>$id, 'from_symbol_id'=>$id2);
		$online_price = $ci->db->where($where)->get('pair')->row('online_price');
		$static_value = new stdClass();
		$static_value->$convertto = $online_price; 
		return json_encode($static_value);
	}
	// return $output;
}

function get_currency($id=""){

		$ci =& get_instance();
		$currency_details = $ci->db->where('id', $id)->get('currency')->row();
		return $currency_details->currency_symbol;
}

function getBalance($id,$currency='',$type='crypto',$wallet_type='Exchange AND Trading')
{

	$balance=0;
	$ci =& get_instance();
	if(is_numeric($currency))
	{

				 $currency=get_currency($currency);
				
	}

	$condition = array('user_id' => $id,'currency_symbol' => $currency);
	$wallet = $ci->db->where($condition)->get('address_balance');


	if($wallet->num_rows() == 1)
	{
		$wallets=$wallet->row_array();
		if($currency!='')
		{

			
			$balance=$wallets[balance];
			

		}
		else
		{
			$balance=$wallets;
		}
	}


	return $balance;
}
function updateBalance($id,$currency,$balance=0,$type='crypto',$wallet_type='Exchange AND Trading')
{

	
	$ci =& get_instance();

	$currency=get_currency($currency);
	$condition = array('user_id' => $id,'currency_symbol' => $currency);
	$wallet = $ci->db->where($condition)->get('address_balance');

	if($wallet->num_rows()==1)
	{
		$upd=array();
		//if($type=='crypto')
		//{
			//$wallets=unserialize($wallet->row('crypto_amount'));
			//$wallets[$wallet_type][$currency]=to_decimal_point($balance,8);
			$upd[balance]=to_decimal_point($balance,8);
		//}
		

		$ci->db->where($condition)->update('address_balance', $upd);
	}
	return 1;
}

// Format file name
function format_filename($filename){
		$withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $filename);
		$newname = str_replace(".","_",$withoutExt);
		$extensionss = pathinfo($filename, PATHINFO_EXTENSION);
		$filename = $newname.".".$extensionss;
		$filename = preg_replace('/[^A-Za-z0-9\.\']/', '_', $filename);
		return $filename;
	} 
	/*

function getTradeVolume($pair_id)
{
	$ci =& get_instance();
	$x = new stdClass();
	$x->price=0;
	$x->volume=0;
	$x->svolume=0;
	$x->change=0;
	$x->high=0;
	$x->low=0;
	$price = $ci->db->where('pair', $pair_id)->order_by("tempId","desc")->get('ordertemp')->row();
	if($price)
	{
		$today_open=$price->askPrice;
		$x->price=$today_open;
		$yesterday = date('Y-m-d H:i:s',strtotime("-1 days"));
		$where = array('datetime >= '=>$yesterday,'pair'=>$pair_id);
		$change_price = $ci->db->select('SUM(askPrice) AS sum_price,askPrice as price,SUM(filledAmount) AS sum_amount')->where($where)->order_by("tempId","asc")->get('ordertemp')->row();
		$highprice = $ci->db->select('askPrice as price')->where($where)->order_by("askPrice","desc")->get('ordertemp');
		$lowprice = $ci->db->select('askPrice as price')->where($where)->order_by("askPrice","asc")->get('ordertemp');
		if($change_price&&$change_price->sum_price!=NULL)
		{
			// $x->volume=$change_price->sum_price;
			$x->volume=$change_price->sum_amount;
			$bitcoin_rate=$change_price->price;
			$daily_change = $today_open-$bitcoin_rate;
			if($daily_change!=0)
			{
				$per = $bitcoin_rate/$daily_change;
				//$per = 100/$temp_per;
				if($daily_change>0)
				{
					if(to_decimal($per, 2)!=0)
					{
						$per='+'.to_decimal($per, 2);
					}
					else
					{
						$per = 0;
					}
				}
			}
			else
			{
				$per = 0;
			}
			$x->change=$per;
		}
		if($highprice->num_rows()>0)
		{
			$x->high=$highprice->row('price');
		}
		if($lowprice->num_rows()>0)
		{
			$x->low=$lowprice->row('price');
		}
	}
	return $x;
}
*/

function getTradeVolume($pair_id)
{
$ci =& get_instance();
	$x = new stdClass();
	$x->price=0;
	$x->volume=0;
	$x->svolume=0;
	$x->change=0;
	$x->high=0;
	$x->low=0;
	$price = $ci->db->where('pair', $pair_id)->order_by("tempId","desc")->get('ordertemp')->row();
	if($price)
	{
		$today_open=$price->askPrice;
		$x->price=$today_open;
		$yesterday = date('Y-m-d H:i:s',strtotime("-1 days"));
		$where = array('datetime >= '=>$yesterday,'pair'=>$pair_id);
		$change_price = $ci->db->select('SUM(askPrice*filledAmount) AS sum_price,SUM(filledAmount) AS sum_amount,askPrice as price')->where($where)->group_by("tempId","asc")->get('ordertemp')->row();
		$highprice = $ci->db->select('askPrice as price')->where($where)->order_by("askPrice","desc")->get('ordertemp');
		$lowprice = $ci->db->select('askPrice as price')->where($where)->order_by("askPrice","asc")->get('ordertemp');
		if($change_price&&$change_price->sum_price!=NULL)
		{
			$x->volume=$change_price->sum_price;
			$x->svolume=$change_price->sum_amount;
			$bitcoin_rate=$change_price->price;
			$daily_change = $today_open-$bitcoin_rate;
			if($daily_change!=0)
			{
				/* $change=1-($bitcoin_rate/$daily_change);
        		$changeper=$change*100;
				$per=to_decimal($changeper, 2);
				if($per>0)
				{
					$per='+'.$per;
				}
				else
				{
					$per = 0;
				} */
				$per = $bitcoin_rate/$daily_change;
				//$per = 100/$temp_per;
				if($daily_change>0)
				{
					if(to_decimal($per, 2)!=0)
					{
						$per='+'.to_decimal($per, 2);
					}
					else
					{
						$per = 0;
					}
				}
			}
			else
			{
				$per = 0;
			}
			$x->change=$per;
		}
		if($highprice->num_rows()>0)
		{
			$x->high=$highprice->row('price');
		}
		if($lowprice->num_rows()>0)
		{
			$x->low=$lowprice->row('price');
		}
	}
	return $x;
}



function getTradeVolume_main($currency_id="")
{


	/*
	$ci =& get_instance();
	$x = new stdClass();
	$x->volume=0;
	$ci->db->join('trade_pairs', 'trade_pairs.id = pair');
	$price = $ci->db->where('trade_pairs.to_symbol_id', $currency_id)->order_by("tempId","desc")->get('ordertemp')->row();

	if($price)
	{
		$ci->db->join('trade_pairs', 'trade_pairs.id = pair');
		$yesterday = date('Y-m-d H:i:s',strtotime("-1 days"));
		$where = array('datetime >= '=>$yesterday,'trade_pairs.to_symbol_id'=> $currency_id);
		$change_price = $ci->db->select('SUM(askPrice) AS sum_price,SUM(filledAmount) AS sum_amount,askPrice as price')->where($where)->order_by("tempId","asc")->get('ordertemp')->row();

		if($change_price&&$change_price->sum_amount!=NULL)
		{
			$x->volume=$change_price->sum_amount;		
		
		}else{
			return 0;

		}

	}

	return $x->volume;


	*/


	$ci =& get_instance();
	$x = new stdClass();
	$x->price=0;
	$x->volume=0;
	$x->svolume=0;
	$x->change=0;
	$x->high=0;
	$x->low=0;
	$price = $ci->db->where('secondCurrency', $currency_id)->order_by("tempId","desc")->get('ordertemp')->row();
	if($price)
	{
		$today_open=$price->askPrice;
		$x->price=$today_open;
		$yesterday = date('Y-m-d H:i:s',strtotime("-1 days"));
		$where = array('datetime >= '=>$yesterday,'secondCurrency'=>$currency_id);
		$change_price = $ci->db->select('SUM(askPrice*filledAmount) AS volume')->where($where)->order_by("tempId","asc")->get('ordertemp')->row();
		
		if($change_price->volume!=NULL)
		{
			$x->volume=$change_price->volume;
			
		}else{

			$x->volume=0;

		}
		
	}
	return $x->volume;





}

function partially_complete_order($field_name,$trade_id)
{
	$ci =& get_instance();
	$order_temp_val  = $ci->db->select_sum('filledAmount','totalamount')->where($field_name,$trade_id)->get('ordertemp')->row('totalamount'); 
	return $order_temp_val;
}
function currency_id($id)
{
	$ci =& get_instance();
	$currency_id = $ci->db->where('currency_symbol', $id)->get('currency');
	if($currency_id->num_rows()){	
		return $currency_id->row()->id;
	}else{
		return 'Invalid Curreny';
	}

}
function currency($id)
{
	$ci =& get_instance();
	return $currency_id = $ci->db->where('id', $id)->get('currency')->row()->currency_symbol;
}
if(!function_exists('remove_spl_chars'))
{
	function remove_spl_chars($string=FALSE)
	{
		return preg_replace('/[^A-Za-z0-9\-]/', '',$string);
	}
}
function generateredeemString($length = 8) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}
function generatesecretString($length = 64) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}
function pageconfig($total_rows,$base,$perpage)
{
	$ci =& get_instance();
	$perpage = $perpage;
	$pages = (ceil($total_rows/$perpage));
	$ci->session->set_userdata('page',$pages);
	$urisegment=$ci->uri->segment(4);
	$ci->load->library('pagination');
	$config['base_url'] = admin_url().$base.'/';
	$config['total_rows'] = $total_rows;
	$config['per_page'] = $perpage;
	$config['num_links']= 3;
	$config['full_tag_open'] = '';
	$config['full_tag_close'] = '';
	$config['cur_tag_open'] = '<li class="active"><a href="">';
	$config['cur_tag_close'] = '</li></a>';
	$config['first_link'] = '<li>First</li>';
	$config['first_link'] = 'First';
	$config['first_tag_open'] = '<li>';
	$config['first_tag_close'] = '</li>';
	$config['last_link'] = 'last';
	$config['last_tag_open'] = '<li>';
	$config['last_tag_close'] = '</li>';
	$config['prev_link'] = '<i class="fa fa-arrow-left"></i> Previous ';
	$config['prev_tag_open'] = '<li>';
	$config['prev_tag_close'] = '</li>';
	$config['next_link'] = ' Next <i class="fa fa-arrow-right"></i> ';
	$config['next_tag_open'] = '<li class="next">';
	$config['next_tag_close'] = '</li>';
	$config['num_tag_open'] = '<li>';
	$config['num_tag_close'] = '</li>';
	$ci->pagination->initialize($config);
}
function time_calculator($date)
{
	$start_date = new DateTime(gmdate("Y-m-d G:i:s", $date));
	$since_start = $start_date->diff(new DateTime(gmdate("Y-m-d G:i:s", gmdate(time()))));
	$since_start->days.' days total<br>';
	$since_start->y.' years<br>';
	$since_start->m.' months<br>';
	$since_start->d.' days<br>';
	$since_start->h.' hours<br>';
	$since_start->i.' minutes<br>';
	$since_start->s.' seconds<br>';
	if($since_start->y!='0')
	{
		return $since_start->y.' years ago';
	}
	elseif($since_start->m!='0')
	{
		return $since_start->m.' months ago';
	}
	elseif($since_start->d!='0')
	{
		return $since_start->d.' days ago';
	}
	elseif($since_start->h!='0')
	{
		return $since_start->h.' hours ago';
	}
	elseif($since_start->i!='0')
	{
		return $since_start->i.' minutes ago';
	}
	else
	{
		return 'Less than a minute ago';
	}
}
function trade_pairs($type='',$user_id="")
{
	
	$pair_array=array();
	$ci =& get_instance();
	$joins = array('currency as b'=>'a.from_symbol_id = b.id','currency as c'=>'a.to_symbol_id = c.id');
	$where = array('a.status'=>1,'b.status'=>1,'c.status'=>1,'a.to_symbol_id'=>1);
	$orderprice = $ci->Common_model->getJoinedTableData('trade_pairs as a',$joins,$where,'a.*,b.currency_name as from_currency,b.currency_symbol as from_currency_symbol,c.currency_name as to_currency,c.currency_symbol as to_currency_symbol')->result();
	$i=0;


	if($user_id)
	{
		//$this->user_id = $user_id;
		//$balance= getBalance($user_id);

		//print_r($balance);

	}else{

		//$amount=0;
	}



	foreach($orderprice as $pair)
	{
		$volume=getTradeVolume($pair->id);
		if($volume->price!=0)
		{
			$orderprice[$i]->price = to_decimal($volume->price,8);
		}
		else
		{
			$first = isset($pair->to_currency_symbol)?$pair->to_currency_symbol:'';
			$second = isset($pair->from_currency_symbol)?$pair->from_currency_symbol:'';


			if(!isset($orderprice[$i]->price))
			{
				$orderprice[$i]->price = to_decimal($pair->sell_rate_value,8);
			}

		}
		$orderprice[$i]->change = $volume->change;
		$orderprice[$i]->volume = to_decimal($volume->volume,3);
		$i++;
	}

	$pair_array['BTC']=	$orderprice;
	$orderprice=array();

	$ci =& get_instance();
	$joins = array('currency as b'=>'a.from_symbol_id = b.id','currency as c'=>'a.to_symbol_id = c.id');
	$where = array('a.status'=>1,'b.status'=>1,'c.status'=>1,'a.to_symbol_id'=>2);

	$orderprice = $ci->Common_model->getJoinedTableData('trade_pairs as a',$joins,$where,'a.*,b.currency_name as from_currency,b.currency_symbol as from_currency_symbol,c.currency_name as to_currency,c.currency_symbol as to_currency_symbol')->result();
	$i=0;
	foreach($orderprice as $pair)
	{
		$volume=getTradeVolume($pair->id);
		if($volume->price!=0)
		{
			$orderprice[$i]->price = to_decimal($volume->price,8);
		}
		else
		{
			$first = isset($pair->to_currency_symbol)?$pair->to_currency_symbol:'';
			$second = isset($pair->from_currency_symbol)?$pair->from_currency_symbol:'';


			if(!isset($orderprice[$i]->price))
			{
				$orderprice[$i]->price = to_decimal($pair->buy_rate_value,8);
			}

		}
		$orderprice[$i]->change = $volume->change;
		$orderprice[$i]->volume = to_decimal($volume->volume,3);
		$i++;
	}

	

	$pair_array['ETH']=	$orderprice;
	$orderprice=array();


	$orderprice=array();

	$ci =& get_instance();
	$joins = array('currency as b'=>'a.from_symbol_id = b.id','currency as c'=>'a.to_symbol_id = c.id');
	$where = array('a.status'=>1,'b.status'=>1,'c.status'=>1,'a.to_symbol_id'=>3);

	$orderprice = $ci->Common_model->getJoinedTableData('trade_pairs as a',$joins,$where,'a.*,b.currency_name as from_currency,b.currency_symbol as from_currency_symbol,c.currency_name as to_currency,c.currency_symbol as to_currency_symbol')->result();
	$i=0;
	foreach($orderprice as $pair)
	{
		$volume=getTradeVolume($pair->id);
		if($volume->price!=0)
		{
			$orderprice[$i]->price = to_decimal($volume->price,8);
		}
		else
		{
			$first = isset($pair->to_currency_symbol)?$pair->to_currency_symbol:'';
			$second = isset($pair->from_currency_symbol)?$pair->from_currency_symbol:'';


			if(!isset($orderprice[$i]->price))
			{
				$orderprice[$i]->price = to_decimal($pair->buy_rate_value,8);
			}

		}
		$orderprice[$i]->change = $volume->change;
		$orderprice[$i]->volume = to_decimal($volume->volume,3);
		$i++;
	}

	$pair_array['BCH']=	$orderprice;
	$orderprice=array();




	$orderprice=array();

	$ci =& get_instance();
	$joins = array('currency as b'=>'a.from_symbol_id = b.id','currency as c'=>'a.to_symbol_id = c.id');
	$where = array('a.status'=>1,'b.status'=>1,'c.status'=>1,'a.to_symbol_id'=>4);

	$orderprice = $ci->Common_model->getJoinedTableData('trade_pairs as a',$joins,$where,'a.*,b.currency_name as from_currency,b.currency_symbol as from_currency_symbol,c.currency_name as to_currency,c.currency_symbol as to_currency_symbol')->result();
	$i=0;
	foreach($orderprice as $pair)
	{
		$volume=getTradeVolume($pair->id);
		if($volume->price!=0)
		{
			$orderprice[$i]->price = to_decimal($volume->price,8);
		}
		else
		{
			$first = isset($pair->to_currency_symbol)?$pair->to_currency_symbol:'';
			$second = isset($pair->from_currency_symbol)?$pair->from_currency_symbol:'';


			if(!isset($orderprice[$i]->price))
			{
				$orderprice[$i]->price = to_decimal($pair->buy_rate_value,8);
			}

		}
		$orderprice[$i]->change = $volume->change;
		$orderprice[$i]->volume = to_decimal($volume->volume,3);
		$i++;
	}

	$pair_array['USDT']=	$orderprice;


	


	//$pair_array['USDT']=	"";
	//$pair_array['ETH']=	"";
	//$pair_array['BCH']=	"";
	return $pair_array;
}
function getContents($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
        $html = curl_exec($ch);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }


function lowestaskprice_all($pair)
{
	$result1 = getContents('https://api.coinmarketcap.com/v1/ticker/');
	$result = json_decode($result1);
	$ci =& get_instance();
	$names = array('active','partially');
	$where_in=array('status', $names);
	$query = $ci->Common_model->getTableData('coin_order',array('Type'=>'sell','pair'=>$pair),'MIN(Price) as Price','','','','','','','','',$where_in);
	if($query->num_rows() >= 1&&$query->row('Price')!= NULL)
	{
		$row = $query->row();
		return $price = $row->Price;
	}
	else
	{
		$joins = array('currency as b'=>'a.from_symbol_id = b.id','currency as c'=>'a.to_symbol_id = c.id');
		$where = array('a.id'=>$pair,'b.status'=>1,'c.status'=>1);
		$orderprice = $ci->Common_model->getJoinedTableData('trade_pairs as a',$joins,$where,'a.*,b.currency_name as from_currency,b.currency_symbol as from_currency_symbol,c.currency_name as to_currency,c.currency_symbol as to_currency_symbol')->row();
		$price = '';
		$first = isset($orderprice->to_currency_symbol)?$orderprice->to_currency_symbol:'';
		$second = isset($orderprice->from_currency_symbol)?$orderprice->from_currency_symbol:'';
		if(is_array($result))
		{
			foreach ($result as $value) {
					if(isset($value->symbol))
					{
						if($value->symbol==$second)
						{
							return $price = isset($value->price_btc)?to_decimal($value->price_btc,8):to_decimal($pair->buy_rate_value,8);

						}
					}
				}
		}
			if($price=='')
			{
				$query1 = $ci->Common_model->getTableData('trade_pairs',array('id'=>$pair),'buy_rate_value');
				if($query1->num_rows()==1)
				{                   
					$price = $query1->row(); 
					return $price->buy_rate_value;           
				} 
				else
				{     
					return false;       
				}
			}
		
		
	}
}    
function lowestaskprice($pair)
{
	//$result1 = getContents('https://api.coinmarketcap.com/v1/ticker/');
	//$result = json_decode($result1);
	$result="";
	$ci =& get_instance();
	$names = array('active','partially');
	$where_in=array('status', $names);
	$query = $ci->Common_model->getTableData('coin_order',array('Type'=>'sell','pair'=>$pair),'MIN(Price) as Price','','','','','','','','',$where_in);
	if($query->num_rows() >= 1&&$query->row('Price')!= NULL)
	{
		$row = $query->row();
		return $price = $row->Price;
	}
	else
	{
		$joins = array('currency as b'=>'a.from_symbol_id = b.id','currency as c'=>'a.to_symbol_id = c.id');
		$where = array('a.id'=>$pair,'b.status'=>1,'c.status'=>1);
		$orderprice = $ci->Common_model->getJoinedTableData('trade_pairs as a',$joins,$where,'a.*,b.currency_name as from_currency,b.currency_symbol as from_currency_symbol,c.currency_name as to_currency,c.currency_symbol as to_currency_symbol')->row();
		$price = '';
		$first = isset($orderprice->to_currency_symbol)?$orderprice->to_currency_symbol:'';
		$second = isset($orderprice->from_currency_symbol)?$orderprice->from_currency_symbol:'';
		if(is_array($result))
		{
			foreach ($result as $value) {
					if(isset($value->symbol))
					{
						if($value->symbol==$second)
						{
							return $price = isset($value->price_btc)?to_decimal($value->price_btc,8):to_decimal($pair->buy_rate_value,8);

						}
					}
				}
		}
			if($price=='')
			{
				$query1 = $ci->Common_model->getTableData('trade_pairs',array('id'=>$pair),'buy_rate_value');
				if($query1->num_rows()==1)
				{                   
					$price = $query1->row(); 
					return $price->buy_rate_value;           
				} 
				else
				{     
					return false;       
				}
			}
		
		
	}
}
function highestbidprice($pair)
{
	//$result1 = getContents('https://api.coinmarketcap.com/v1/ticker/');
	//$result = json_decode($result1);
	$result="";
	$ci =& get_instance();
	$names = array('active','partially');
	$where_in=array('status', $names);
	$query = $ci->Common_model->getTableData('coin_order',array('Type'=>'buy','pair'=>$pair),'MAX(Price) as Price','','','','','','','','',$where_in);
	if($query->num_rows() >= 1&&$query->row('Price')!= NULL)
	{
		$row = $query->row();
		return $price = $row->Price;
	}
	else
	{
		$joins = array('currency as b'=>'a.from_symbol_id = b.id','currency as c'=>'a.to_symbol_id = c.id');
		$where = array('a.id'=>$pair,'b.status'=>1,'c.status'=>1);
		$orderprice = $ci->Common_model->getJoinedTableData('trade_pairs as a',$joins,$where,'a.*,b.currency_name as from_currency,b.currency_symbol as from_currency_symbol,c.currency_name as to_currency,c.currency_symbol as to_currency_symbol')->row();
		$price = '';
		$first = isset($orderprice->to_currency_symbol)?$orderprice->to_currency_symbol:'';
		$second = isset($orderprice->from_currency_symbol)?$orderprice->from_currency_symbol:'';
		$price = '';
		if(is_array($result))
		{
			foreach ($result as $value) {
					if(isset($value->symbol))
					{
						if($value->symbol==$second)
						{
							return $price =isset($value->price_btc)?to_decimal($value->price_btc,8):to_decimal($pair->sell_rate_value,8);

						}
					}
				}
		}
			if($price=='')
			{
				$query1 = $ci->Common_model->getTableData('trade_pairs',array('id'=>$pair),'sell_rate_value');
				if($query1->num_rows()==1)
				{                   
					$price = $query1->row(); 
					return $price->sell_rate_value;           
				} 
				else
				{     
					return false;       
				}
			}
	}
}
function get_min_trade_amt($pair)
{
	$ci =& get_instance();
	$query1 = $ci->Common_model->getTableData('trade_pairs',array('id'=>$pair),'min_trade_amount');
	if($query1->num_rows()==1){                   
	$price = $query1->row(); 
	return $price->min_trade_amount;           
	} 
	else{     
	return false;       
	}
}
function lastmarketprice($pair)
{
	//$result1 = getContents('https://api.coinmarketcap.com/v1/ticker/');
	//$result = json_decode($result1);


	//if(isset($result)){

		$ci =& get_instance();
		$names = array('filled');
		$where_in=array('status', $names);
		$order_by = array('trade_id','desc');
		$query = $ci->Common_model->getTableData('coin_order',array('pair'=>$pair),'','','','','',1,$order_by,'','',$where_in);
		if($query->num_rows() >= 1)
		{
			$row = $query->row();
			return $row->Price;
		}
		else
		{



				$query1 = $ci->Common_model->getTableData('trade_pairs',array('id'=>$pair),'sell_rate_value');
					if($query1->num_rows()==1)
					{ 


						$price = $query1->row(); 
						return $price->sell_rate_value;           
					} 
					else
					{     
						return false;       
					}

			/*


			$joins = array('currency as b'=>'a.from_symbol_id = b.id','currency as c'=>'a.to_symbol_id = c.id');
			$where = array('a.id'=>$pair,'b.status'=>1,'c.status'=>1);
			$orderprice = $ci->Common_model->getJoinedTableData('trade_pairs as a',$joins,$where,'a.*,b.currency_name as from_currency,b.currency_symbol as from_currency_symbol,c.currency_name as to_currency,c.currency_symbol as to_currency_symbol')->row();




			$price = '';
			$first = isset($orderprice->to_currency_symbol)?$orderprice->to_currency_symbol:'';
			$second = isset($orderprice->from_currency_symbol)?$orderprice->from_currency_symbol:'';
			foreach ($result as $value) {

									if(isset($value->symbol))
					{
						if($value->symbol==$second)
						{
							echo "<pre>";
							print_r($value);
							exit;
							echo $price; exit;
							return $price = isset($value->price_btc)?to_decimal($value->price_btc,8):to_decimal($pair->sell_rate_value,8);

						}
					}
				}
				if($price=='')
				{
					$query1 = $ci->Common_model->getTableData('trade_pairs',array('id'=>$pair),'sell_rate_value');
					if($query1->num_rows()==1)
					{                   
						$price = $query1->row(); 
						return $price->sell_rate_value;           
					} 
					else
					{     
						return false;       
					}
				}



				*/

		}
	//}

	
}
function getfeedetails($pair,$user_id='')
{
	$ci =& get_instance();
	if($user_id=='')
	{
		$user_id=$ci->session->userdata('user_id');
	}
	if($user_id)
	{
		$to_symbol_id = $ci->Common_model->getTableData('trade_pairs',array('id'=>$pair),'to_symbol_id')->row('to_symbol_id');    
		$date_limit=date('Y-m-d',strtotime("-30 days"));
		$limit = $ci->Common_model->getTableData('transaction_history',array('currency'=>$to_symbol_id,'userId'=>$user_id,'datetime >='=>$date_limit),'SUM(amount) as total')->row('total'); 
		if($limit)
		{
			$where=array('pair_id'=>$pair,'from_volume <= '=>$limit,'to_volume >= '=>$limit);
			$query = $ci->Common_model->getTableData('trade_fees',$where,'maker,taker'); 
			if($query->num_rows()==0)
			{
				$order_by = array('from_volume','desc');
				$where=array('pair_id'=>$pair,'to_volume <= '=>$limit);
				$query = $ci->Common_model->getTableData('trade_fees',$where,'maker,taker','','','','',1,$order_by);
				if($query->num_rows()==0)
				{
					$order_by = array('from_volume','asc');
					$query = $ci->Common_model->getTableData('trade_fees',array('pair_id'=>$pair),'maker,taker','','','','',1,$order_by);     
				}
			}
		}
		else
		{
			$order_by = array('from_volume','asc');
			$query = $ci->Common_model->getTableData('trade_fees',array('pair_id'=>$pair),'maker,taker','','','','',1,$order_by);    
		}
	}
	else
	{


		$order_by = array('from_volume','asc');
		$query = $ci->Common_model->getTableData('trade_fees',array('pair_id'=>$pair),'maker,taker','','','','',1,$order_by);  
	
	}
	$row = $query->row();
	return $row;
}
function db3Config()
{
   return array(
	'dsn'	=> '',
	'hostname' => '88.198.41.136',
	'username' => 'ashkharhy',
	'password' => '2J3DbCs5tGXrMBCL',
	'database' => 'mondu',
	'dbdriver' => 'mysqli',
	'dbprefix' => 'wcx_',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
	);
}
function db2Config()
{
   return array(
	'dsn'	=> '',
	'hostname' => '88.198.41.136',
	'username' => 'khomun_sunam',
	'password' => 'Vyc6QPvacu2MKHwG',
	'database' => 'thankhomun_phunthan',
	'dbdriver' => 'mysqli',
	'dbprefix' => 'wcx_',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
	);
}
function updatefiatreserveamount($balance, $cuid)
{
	$ci =& get_instance();
	$upd['reserve_Amount']=$balance;
	$ci->db->where('id',$cuid);
	$ci->db->update('fiat_currency', $upd);
	return 1;
}
function updatecryptoreserveamount($balance, $cuid)
{
	$ci =& get_instance();
	$upd['reserve_Amount']=$balance;
	$ci->db->where('id',$cuid);
	$ci->db->update('currency', $upd);
	return 1;
}
function getExtension($type)
{
	 switch (strtolower($type))
	 {        
		// case 'image/jpg':
		// 	$ext = 'jpg';
		// break;
		
		case 'image/jpeg':
			$ext = 'jpeg';
		break;

		case 'image/png':
			$ext = 'png';
		break;

		// case 'image/gif':
		// 	$ext = 'gif';
		// break;   
		
		default:
			$ext = FALSE;
		break;
	}
	return $ext;
}
function get_client_ip()
{
	$ipaddress = '';
	if (getenv('HTTP_CLIENT_IP'))
		$ipaddress = getenv('HTTP_CLIENT_IP');
	else if(getenv('HTTP_X_FORWARDED_FOR'))
		$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
	else if(getenv('HTTP_X_FORWARDED'))
		$ipaddress = getenv('HTTP_X_FORWARDED');
	else if(getenv('HTTP_FORWARDED_FOR'))
		$ipaddress = getenv('HTTP_FORWARDED_FOR');
	else if(getenv('HTTP_FORWARDED'))
		$ipaddress = getenv('HTTP_FORWARDED');
	else if(getenv('REMOTE_ADDR'))
		$ipaddress = getenv('REMOTE_ADDR');
	else
		$ipaddress = 'UNKNOWN';
	return $ipaddress;
}
if(!function_exists('cdn_file_upload'))
{
	function cdn_file_upload($filedata,$folder,$oldfile='')
	{
		ini_set('display_errors', 0);
		$cloudUpload = \Cloudinary\Uploader::upload($filedata['tmp_name'], array("folder" => $folder,'allowed_formats'=>array('png','jpeg','ico')));
		if($cloudUpload)
		{
			if($oldfile&&$oldfile!='')
			{
				$end=end(explode('/',$oldfile));
				$filetype=explode('.',$end);
				$file=$folder.'/'.$filetype[0];
				$api = new \Cloudinary\Api();
				$api->delete_resources(array($file),array("keep_original" => FALSE));
			}
		}
		return $cloudUpload;
	}
	function listFolderFiles($dir)
	{
		ini_set('display_errors', 0);
		$ffs = scandir($dir);
		unset($ffs[array_search('.', $ffs, true)]);
		unset($ffs[array_search('..', $ffs, true)]);
		if (count($ffs) < 1)
		return;
		foreach($ffs as $ff)
		{
			if(is_dir($dir.'/'.$ff))
			{
				listFolderFiles($dir.'/'.$ff);
			}
			$image_name = $dir.'/'.$ff;
			$folder_name1 = explode('.',$ff);
			$count = count($folder_name1);
			unset($folder_name1[$count-1]);
			$folder_name = $dir.'/'.implode('.',$folder_name1);
			if (is_file($image_name))
			{
				echo $image_name;
				$fol_path    = $_SERVER["DOCUMENT_ROOT"].'/wcx/'.$image_name;
				$cloudUpload = \Cloudinary\Uploader::upload($fol_path,array("public_id" => $folder_name,"resource_type"=>"auto"));
				echo "<br>";
			}
		}
	}
}
function convercurrs($convertfrom,$convertto,$type='buy')
{	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,"https://min-api.cryptocompare.com/data/price?fsym=".$convertfrom."&tsyms=".$convertto);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	$output = curl_exec($ch);
	curl_close($ch);
	return $output;
}
function send_otp_msg($dst,$text)
{
	$sitesettings=getSiteSettings();
	$AUTH_ID = $sitesettings->auth_id;
	$AUTH_TOKEN = $sitesettings->auth_token;
	$src = $sitesettings->from_number;
	$url = 'https://api.plivo.com/v1/Account/'.$AUTH_ID.'/Message/';
	$data = array("src" => "$src", "dst" => "$dst", "text" => "$text");
	$data_string = json_encode($data);
	$ch=curl_init($url);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
	curl_setopt($ch, CURLOPT_USERPWD, $AUTH_ID . ":" . $AUTH_TOKEN);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	$response = curl_exec( $ch );
	// print_r($response);
	curl_close($ch);
	return true;
}
function max_records()
{
	$max = 50;
	return $max;
}
function getAddress($id,$currency='')
{
	$balance=0;
	$ci =& get_instance();
	$wallet = $ci->db->where('user_id', $id)->get('crypto_address');
	if($wallet->num_rows()==1)
	{
			$wallets=unserialize($wallet->row('address'));
			if($currency!='')
			{
				$address=$wallets[$currency];
			}
			else
			{
				$address=$wallets;
			}
	}
	return $address;
}
function updateAddress($id,$currency,$address=0)
{
	$ci =& get_instance();
	$wallet = $ci->db->where('user_id', $id)->get('crypto_address');
	if($wallet->num_rows()==1)
	{
		$upd=array();
		$wallets=unserialize($wallet->row('address'));
		$wallets[$currency]=$address;
		$upd['address']=serialize($wallets);

		$ci->db->where('user_id',$id);
		$ci->db->update('crypto_address', $upd);
	}
	return 1;
}
function wallet_table()
{
	return 'cms_pages';
}
function address_table()
{
	return 'sample_faqs';
}
// margin trading
function getwalletjson($id)
{
	$ci =& get_instance();
	$wallet = $ci->db->where('user_id', $id)->get('wallet')->row('crypto_amount');
	return $wallet;
}
function updaterippleSecret($user_id, $coin_id, $secret)
{
	$ci =& get_instance();
	$wallet = $ci->db->where('user_id', $user_id)->get('crypto_address');
	if($wallet->num_rows()==1)
	{
		$upd=array();
		$upd['auto_gen']=$secret;
		$ci->db->where('user_id',$user_id);
		$ci->db->update('crypto_address', $upd);
	}
	return 1;
}


function updatemoneroSecret($user_id, $coin_id, $secret)
{
	$ci =& get_instance();
	$wallet = $ci->db->where('user_id', $user_id)->get('crypto_address');
	if($wallet->num_rows()==1)
	{
		$upd=array();
		$upd['auto_gen_mon']=$secret;
		$ci->db->where('user_id',$user_id);
		$ci->db->update('crypto_address', $upd);
	}
	return 1;
}


// margin trading
function getBalanceJson($id,$currency='',$type='crypto',$wallet_type='Exchange AND Trading')
{
	$balance=0;
	$ci =& get_instance();
	$wallet = $ci->db->where('user_id', $id)->get('wallet');
	if($wallet->num_rows()==1)
	{
		if($type=='crypto')
		{
			$wallets=unserialize($wallet->row('crypto_amount'));
			$balance=$wallets[$wallet_type];
			foreach ($balance as $key2 => $value2)
			{
				$curr = currency($key2);
				$array[$curr] = $value2;
				$balance = $array;
			}
		}
		else
		{
			$wallets=unserialize($wallet->row('fiat_amount'));	
			$balance=$wallets;
			foreach ($balance as $key2 => $value2)
			{
				$curr = getfiatcurrency($key2);
				$array[$curr] = $value2;
				$balance = $array;
			}
		}
	}
	return $balance;
}
function get_Pairid($id1,$id2){
	$ci =& get_instance();
	$pair_id = $ci->Common_model->getTableData('trade_pairs',array('from_symbol_id'=>$id2,'to_symbol_id'=>$id1));
	if($pair_id->num_rows()>0){
		return $pair_id->row()->id;
	}else{
		return 'Not_in';
	}

}
function check_order_type($string){
	$os = array("limit", "instant", "stop");
	if (in_array($string, $os)) {
	    return 'true';
	}else{
		return 'false';
	}
}
// margin trading
function tradable_balance($user_id,$cur_currency,$sec_currency='')
{
	$ci =& get_instance();
	$wallet = unserialize($ci->Common_model->getTableData('wallet',array('user_id'=>$user_id),'crypto_amount')->row('crypto_amount'));
	$hiswhere = array('a.lending_status'=>'1');
	$hisjoins = array('trade_pairs as b'=>'a.id = b.from_symbol_id');
	$currency = $ci->Common_model->getleftJoinedTableData('currency as a',$hisjoins,$hiswhere,"a.*,b.from_symbol_id,b.buy_rate_value, (SELECT Price FROM `wcx_coin_order` WHERE `pair` = b.id AND `status` IN('filled') ORDER BY `trade_id` DESC LIMIT 1) as Price",'','','','','')->result();
	$btc_amount = 0;
	$margin_trading_percentage=getSiteSettings('margin_trading_percentage');
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
		$price_array[$cur->id] = $price;
		$symbol_array[$cur->id] = $cur->currency_symbol;
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
	}
	if($symbol_array[$cur_currency]=='BTC')
	{
		 $tradeable_balance = $btc_amount;
	}
	else
	{
		if($btc_amount!=0)
		{
			$tradeable_balance = $btc_amount/$price_array[$cur_currency];
		}
		else
		{
			$tradeable_balance = $btc_amount;
		}
	}
	if($sec_currency!='')
	{
		if($symbol_array[$sec_currency]=='BTC')
		{
			 $tradeable_balance1 = $btc_amount;
		}
		else
		{
			if($btc_amount!=0)
			{
				$tradeable_balance1 = $btc_amount/$price_array[$sec_currency];
			}
			else
			{
				$tradeable_balance1 = $btc_amount;
			}
		}
		$tradable_balances[$cur_currency]=to_decimal($tradeable_balance,8);
		$tradable_balances[$sec_currency]=to_decimal($tradeable_balance1,8);
	}
	else
	{
		$tradable_balances=to_decimal($tradeable_balance,8);
	}
	return $tradable_balances;
}
// margin trading
function swaporderbalance($user_id,$cur_currency,$sec_currency='',$type='')
{
	$ci =& get_instance();
	$wallet = unserialize($ci->Common_model->getTableData('wallet',array('user_id'=>$user_id),'crypto_amount')->row('crypto_amount'));
	$wallets = $ci->Common_model->getTableData('swap_order',array('user_id'=>$user_id,'swap_type'=>'receive','expire'=>0),'SUM(swap_amount) as amount,currency','','','','','','',array('currency'))->result();
	$wallet_swaps=array();
	if($wallets)
	{
		foreach($wallets as $swap)
		{
			$wallet_swaps[$swap->currency]=$swap->amount;
		}
	}
	$hiswhere = array('a.lending_status'=>'1');
	$hisjoins = array('trade_pairs as b'=>'a.id = b.from_symbol_id');
	$currency = $ci->Common_model->getleftJoinedTableData('currency as a',$hisjoins,$hiswhere,"a.*,b.from_symbol_id,b.buy_rate_value, (SELECT Price FROM `wcx_coin_order` WHERE `pair` = b.id AND `status` IN('filled') ORDER BY `trade_id` DESC LIMIT 1) as Price",'','','','','')->result();
	$btc_amount = 0;
	$swap_amount = 0;
	$margin_trading_percentage=getSiteSettings('margin_trading_percentage');
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
		$price_array[$cur->id] = $price;
		$symbol_array[$cur->id] = $cur->currency_symbol;
		if(!($cur->currency_symbol=='BTC'))
		{
			$margin_amount = $price * $wallet['Margin Trading'][$cur->id];
			$btc_amount += to_decimal((($margin_amount*100/$margin_trading_percentage)),8);
			if(isset($wallet_swaps[$cur->id])&&$wallet_swaps[$cur->id]>0)
			{
				$swap_amount1 = $price * $wallet_swaps[$cur->id];
				$swap_amount += to_decimal($swap_amount1,8);
			}
		}
		else
		{
			$amount = 0;
			$btc_amount += to_decimal((($wallet['Margin Trading'][$cur->id]*100/$margin_trading_percentage)),8);
			if(isset($wallet_swaps[$cur->id])&&$wallet_swaps[$cur->id]>0)
			{
				$swap_amount += to_decimal($wallet_swaps[$cur->id],8);
			}
		}
	}
	if($symbol_array[$cur_currency]=='BTC')
	{
		 $tradeable_balance = $btc_amount;
		 $swaps_amount=$swap_amount;
	}
	else
	{
		if($btc_amount>0)
		{
			$tradeable_balance = $btc_amount/$price_array[$cur_currency];
		}
		else
		{
			$tradeable_balance = $btc_amount;
		}
		if($swap_amount>0)
		{
			$swaps_amount=$swap_amount/$price_array[$cur_currency];
		}
		else
		{
			$swaps_amount=$swap_amount;
		}
	}
	if($sec_currency!='')
	{
		if($symbol_array[$sec_currency]=='BTC')
		{
			 $tradeable_balance1 = $btc_amount;
			 $swaps_amount1=$swap_amount;
		}
		else
		{
			if($btc_amount>0)
			{
				$tradeable_balance1 = $btc_amount/$price_array[$sec_currency];
			}
			else
			{
				$tradeable_balance1 = $btc_amount;
			}
			if($swap_amount>0)
			{
				$swaps_amount1=$swap_amount/$price_array[$sec_currency];
			}
			else
			{
				$swaps_amount1=$swap_amount;
			}
		}
		if($type=='transfer')
		{
			$tradable_balances[$cur_currency]=to_decimal(((($tradeable_balance-$swaps_amount)*$margin_trading_percentage)/100),8);
			$tradable_balances[$sec_currency]=to_decimal(((($tradeable_balance1-$swaps_amount1)*$margin_trading_percentage)/100),8);
		}
		else if($type=='margin')
		{
			$tradable_balances[$cur_currency]=new stdClass();
			$tradable_balances[$sec_currency]=new stdClass();
			$tradable_balances[$cur_currency]->net_value=to_decimal(((($tradeable_balance-$swaps_amount)*$margin_trading_percentage)/100),8);
			$tradable_balances[$sec_currency]->net_value=to_decimal(((($tradeable_balance1-$swaps_amount1)*$margin_trading_percentage)/100),8);
			$tradable_balances[$cur_currency]->tradable_balance=to_decimal($tradeable_balance,8);
			$tradable_balances[$sec_currency]->tradable_balance=to_decimal($tradeable_balance1,8);
			$tradable_balances[$cur_currency]->swaps_amount=to_decimal($swaps_amount,8);
			$tradable_balances[$sec_currency]->swaps_amount=to_decimal($swaps_amount1,8);
		}
		else
		{
			$tradable_balances[$cur_currency]=to_decimal($tradeable_balance-$swaps_amount,8);
			$tradable_balances[$sec_currency]=to_decimal($tradeable_balance1-$swaps_amount1,8);
		}
	}
	else
	{
		if($type=='transfer')
		{
			$tradable_balances[$cur_currency]=to_decimal(((($tradeable_balance-$swaps_amount)*$margin_trading_percentage)/100),8);
		}
		else if($type=='margin')
		{
			$tradable_balances[$cur_currency]=new stdClass();
			$tradable_balances[$cur_currency]->net_value=to_decimal(((($tradeable_balance-$swaps_amount)*$margin_trading_percentage)/100),8);
			$tradable_balances[$cur_currency]->tradable_balance=to_decimal($tradeable_balance,8);
			$tradable_balances[$cur_currency]->swaps_amount=to_decimal($swaps_amount,8);
		}
		else
		{
			$tradable_balances[$cur_currency]=to_decimal($tradeable_balance-$swaps_amount,8);
		}
	}
	return $tradable_balances;
}

// margin trading
function margin_value($user_id)
{
	$ci =& get_instance();
	$wallet = unserialize($ci->Common_model->getTableData('wallet',array('user_id'=>$user_id),'crypto_amount')->row('crypto_amount'));
	$hiswhere = array('a.lending_status'=>'1');
	$hisjoins = array('trade_pairs as b'=>'a.id = b.from_symbol_id');
	$currency = $ci->Common_model->getleftJoinedTableData('currency as a',$hisjoins,$hiswhere,"a.*,b.from_symbol_id,b.buy_rate_value, (SELECT Price FROM `wcx_coin_order` WHERE `pair` = b.id AND `status` IN('filled') ORDER BY `trade_id` DESC LIMIT 1) as Price",'','','','','')->result();
	$btc_amount = 0;
	$margin_trading_percentage = getSiteSettings('margin_trading_percentage');
	foreach($currency as $cur) { 
		if($cur->Price)
		{
			$price = $cur->Price;
		}
		else
		{
			$price = $cur->buy_rate_value;
		}
		$price_array[$cur->id] = $price;
		$symbol_array[$cur->id] = $cur->currency_symbol;
		if(!($cur->currency_symbol=='BTC'))
		{
			$margin_amount = $price * $wallet['Margin Trading'][$cur->id];
			$btc_amount += to_decimal($margin_amount,8);

		}
		else
		{
			$amount = 0;
			$btc_amount += to_decimal(($wallet['Margin Trading'][$cur->id]),8);
		}
	}
	return $btc_amount;
}
function seoUrl($string)
{
	$string = strtolower($string);
	$string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
	$string = preg_replace("/[\s-]+/", " ", $string);
	$string = preg_replace("/[\s_]/", "-", $string);
	return $string;
}
function getlang($string='')
{
	if($string!='')
	{
		$string=trim($string,".");
		global $myVAR;
		return (isset($myVAR[$string]))?$myVAR[$string]:$string;
	}
	else
	{
		return $string;
	}
}
function getsitelanguages()
{
	$ci =& get_instance();
	$language=$ci->Common_model->getTableData('languages','','id,seo_url,name')->result();
	return $language;
}
function translate($from_lan="en", $to_lan="hi", $text="login")
{
	ini_set('display_errors', 0);
	$text=str_replace(" ","%20",$text);
	$translated_text = file_get_contents("https://translate.google.com/?sl=".$from_lan."&tl=".$to_lan."&prev=_t&hl=it&ie=UTF-8&eotf=1&text=".$text."");
	$dom = new DOMDocument(); 
	@$dom->loadHTML($translated_text); 
	$xpath = new DOMXPath($dom);
	$tags = $xpath->query('//*[@id="result_box"]'); 
	foreach ($tags as $tag)
	{
		$var = trim($tag->nodeValue); 
		if($var)
		{
			return ($var);
			break;
		}
	}
}

function getAdminAddress($id, $currency='')
{
	$balance=0;
	$ci =& get_instance();
	$wallet = $ci->db->where('id', $id)->get('sample_faqs');
	if($wallet->num_rows()==1)
	{
			$wallets=unserialize($wallet->row('faq_address'));
			if($currency!='')
			{
				$address=$wallets[$currency];
			}
			else
			{
				$address=$wallets;
			}
	}
	return $address;
}
function updateAdminAddress($id, $currency,$address=0)
{
	$ci =& get_instance();
	$wallet = $ci->db->where('id', $id)->get('sample_faqs');
	if($wallet->num_rows()==1)
	{
		$upd=array();
		$wallets=unserialize($wallet->row('faq_address'));
		$wallets[$currency]=$address;
		$upd['faq_address']=serialize($wallets);
		$ci->db->where('id',$id);
		$ci->db->update('sample_faqs', $upd);
	}
	return 1;
}


function getAdminReAddress($id)
{
	$ci =& get_instance();
	$wallet = $ci->db->where('id', $id)->get('sample_faqs');
	if($wallet->num_rows()==1)
	{
		return $wallet->row();
	}
}


function current_trad_volume($pair_id)
{

$ci =& get_instance();

	$joins = array('currency as b'=>'a.from_symbol_id = b.id','currency as c'=>'a.to_symbol_id = c.id');
	$where = array('a.status'=>1);
	$orderprice = $ci->Common_model->getJoinedTableData('trade_pairs as a',$joins,$where,'a.*,b.currency_name as from_currency,b.currency_symbol as from_currency_symbol,c.currency_name as to_currency,c.currency_symbol as to_currency_symbol')->result();
	$pair=$ci->Common_model->getTableData('trade_pairs', array('id' => $pair_id))->row();
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
