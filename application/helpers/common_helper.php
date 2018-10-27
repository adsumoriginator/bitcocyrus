<?php
/**
 * Common Helper
 * @package Osiz Technologies Pvt Ltd
 * @subpackage US Instant Exchagne
 * @category Helpers
 * @author Subbaiah
 * @version 1.0
 * @link http://osiztechnologies.com/
 * 
 */
 

    function send_mail($to_mail = '',$subject="",$message="")
    {

        $CI =& get_instance();
        $data=$CI->config->item("data");

       $config = Array(
        'protocol' => 'smtp',
        'smtp_host' => insep_decode($data["host"]),
        'smtp_port' => insep_decode($data["port"]),
        'smtp_user' => insep_decode($data["username"],"Bitcocyrus"),
        'smtp_pass' => insep_decode($data["password"]),
        'mailtype'  => 'html', 
        'charset'   => 'utf-8'
       );

      
       $CI->load->library('email', $config);
       $CI->email->set_newline("\r\n");
       $CI->email->from(insep_decode($data["username"]));
       $CI->email->to($to_mail);
       $CI->email->subject($subject);
       $CI->email->message($message);
       $result =  $CI->email->send();
       return true;

    } 

    function getEmailTeamplete($id=""){
         $ci =& get_instance();
         $ci->db->where(array('id'=>$id));
         $row=$ci->db->get("email_template")->row();
         return $row;




    }


     function getSiteLogo() {
    $ci =& get_instance();
    $logo = $ci->db->where('id', 1)->get("site_settings")->row()->site_logo;
    if ($logo) {
        return base_url() . 'uploads/siteLogo/'.$logo.'?123';
    } else {
        return base_url() . 'uploads/logo1.png?123';    
    }
 }



  function favicon() {
    $ci =& get_instance();
    $fav = $ci->db->where('id', 1)->get("site_settings")->row()->site_favicon;
     $logo = $ci->db->where('id', 1)->get("site_settings")->row()->site_logo;
    if ($logo) {
        return base_url() . 'uploads/siteLogo/'.$fav.'?123';
    } else {
        return  base_url() . 'uploads/siteLogo/'.$logo.'?123';    
    }
 }




  if ( ! function_exists('site_details'))
{
    function site_details()
    {
        $CI =& get_instance();
        $CI->load->model("common_model");
        $condition=array('id'=>1);
        $user_data = $CI->common_model->getTableData('site_settings',$condition)->row();      
         return  $user_data;
       
    } 
  }



  function getSiteName() {
    $ci =& get_instance();
    $name = $ci->db->where('id', 1)->get("site_settings")->row()->site_name;
    if ($name) {
        return $name;
    } else {
        return 'admin'; 
    }
 }


function site_settings(){

        $ci =& get_instance();
        $row=$ci->db->get("site_settings")->row();
        return $row;

}

function get_data($table,$where=FALSE,$select=FALSE,$limit=FALSE)
{
	$ci =& get_instance();
	if($where)
	$ci->db->where($where);
	if($select)
	$ci->db->select($select);
	if($limit)
	$ci->db->limit($limit);
	return $ci->db->get($table);
}

function user_id()
{	
    $ci =& get_instance();
    return $ci->session->userdata('user_id');
}



 function insep_encode($value){
$skey= "SuPerEncKey2010c";
if(!$value){return false;}
$text = $value;
$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
$crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $skey, $text, MCRYPT_MODE_ECB, $iv);
return trim(safe_b64encode($crypttext));
}

function insep_decode($value){
$skey= "SuPerEncKey2010c";
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


  

	function imgUrlenc($url) {
	$image="data:image/png;base64,".base64_encode(file_get_contents($url));
	return($image);
	}


  


   
	if(!function_exists('get_smtp_details'))
{
    function get_smtp_details($string=FALSE)
    {        
        $ci=& get_instance();
        $config['protocol']  = 'smtp';
        $data=$ci->config->item('data');
        $data["smtp_email"]     = isset($data['un'])?insep_decode($data['un']):'';
        $data["smtp_password"]  = isset($data['pw'])?insep_decode($data['pw']):'';
        $data["smtp_host"]      = isset($data['ho'])?insep_decode($data['ho']):'';
        $data["smtp_port"]      = isset($data['pt'])?insep_decode($data['pt']):'';
        $data["aws_ver_email"]  = isset($data['aws_ver_email'])?insep_decode($data['aws_ver_email']):'';        
         return $data;
    }
}



   
    if(!function_exists('get_user_email'))
{
    function get_user_email($id="")
    {        
        $ci=& get_instance();

        $ci->db->where(array("user_id"=>$id));
       $userdetails= $ci->db->get("userdetails")->row();
     

    

         $data=insep_decode($userdetails->key_one)."@".insep_decode($userdetails->key_two);

                
         return $data;
    }




}



   
    if(!function_exists('get_user'))
{
    function get_user($id="")
    {        
        $ci=& get_instance();

        $ci->db->where(array("user_id"=>$id));
       $userdetails= $ci->db->get("userdetails")->row();   
                    
         return $userdetails;
    }



    
}





    if(!function_exists('get_btc_details'))
{
    function get_btc_details($id="")
    {        
        $ci=& get_instance();

        $ci->db->where(array("user_id"=>$id));
       $userdetails= $ci->db->get("userdetails")->row();   
                    
         return $userdetails;
    }


    

    
}








