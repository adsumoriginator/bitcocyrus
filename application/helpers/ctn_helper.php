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
 

    function get_cn_data($currency)
    {
        if($currency=="BTC"){
            $details=array('user'=>'0q9D-CsNeT2mIaex5J-ZG-z67BJP8tyZM3GP7_zItKU',
                'password'=>'vBdBfMkho2gdobdUPCdPJJyDdrh2oZ2OvZNXmHiEwk0',
                'ip'=>'9EGffLDkzRlKILQAfaoV5JXH0omSEhxRbjqaxRusJXk',
                'port'=>'HZnQJiwDSav90KbOa0XVZj0pqi_C6UZ9mSEBoTSFfb4',
                'wkey'=>'xwwWYu9sTM2knd0246d_EY9NQv3ezlLN6spjWHcGCqw',
           );
        }else if($currency=="ETH"){
            $details=array(
                'ip'=>'9EGffLDkzRlKILQAfaoV5JXH0omSEhxRbjqaxRusJXk',
                'port'=>'itnQJc22QUSw8eRcjhacAb4HB6yJAcIXV7WOIoQTgss',
           );
        }else if($currency=="ETC"){
            $details=array(
                'ip'=>'9EGffLDkzRlKILQAfaoV5JXH0omSEhxRbjqaxRusJXk',
                'port'=>'_rUQEAhGrHTUrCPUnt00IdC-SPiAP8QtmOr-y8FSE0M',             
           );
        }else if($currency=="BCH"){
            $details=array(
                'user'=>'QbA-cJ-JpPfxGbxS3H3F4BcAOflxY5nO6Gqob5PwSgY',
                'password'=>'b_gnBWPe_eQrzXOk9V4FC9RRUx9b87DOf_zCKsZXtoM',
                'ip'=>'9EGffLDkzRlKILQAfaoV5JXH0omSEhxRbjqaxRusJXk',
                'port'=>'0I04Z59Baot1afJ-KrswcsHPdyrzRSK9pZcXckNuk9A',
           );
        }else if($currency=="LTC"){
            $details=array(
                'user'=>'gtV5PbdHAc_oLaLrDcTKXL7s5sGCId8J752Ov3J0BXY',
                'password'=>'wMKN3QnvTo7nwsHqKZ4Ie2bR9Qe51pSUl1BvM-lFiv4',
                'ip'=>'9EGffLDkzRlKILQAfaoV5JXH0omSEhxRbjqaxRusJXk',
                'port'=>'QAFEQevCSX3WJxaK_V7HWajgEhJCGav5KinUMvxRdJc',
           );
        }else if($currency=="DASH"){
            $details=array(
                'user'=>'7W7tHXUwGuybwhFl7VXYPLFUxHY6gW5PITpVvnRcXwI',
                'password'=>'hODPtar8xHzZhkBqoyDa3m9Mu9xoEtI2-Mo87xiOeGE',
                'ip'=>'9EGffLDkzRlKILQAfaoV5JXH0omSEhxRbjqaxRusJXk',
                'port'=>'HVVx8JXdt_zFa7QzaEj3QgewU9jOcuVLRt7H_CEu9OU',
           );
        }else if($currency=="DGB"){
            //check
            $details=array(
                'user'=>'EiUuBL3ei-SMzWRJylwm8GSMPWykWqNTUxzufRsD2Ns',
                'password'=>'y22hXXSKUIuVQ6L8KSGnQRO2hZ3jUulzQg5COJE1ycU',
                'ip'=>'9EGffLDkzRlKILQAfaoV5JXH0omSEhxRbjqaxRusJXk',
                'port'=>'G4IEYNQAIH-C0iO6jG7VMt1kGL4HIb6QlkyTewt6xmg',
           );
        }else if($currency=="BTG"){
            $details=array(
                'user'=>'YJFQtikyaqtx4FlGxrGpak6s-pAAiB482D9EG79DPy0',
                'password'=>'3lwxLUskQa1qVfSZfbq-AuzBfkH6i4qfzBHP8R4hAoU',
                'ip'=>'9EGffLDkzRlKILQAfaoV5JXH0omSEhxRbjqaxRusJXk',
                'port'=>'vkDuaKyWfbbNm95vx34aggNewiuf2LmhfRufKJxUCwA',
           );
        }
        else if($currency=="USDT"){
            $details=array(                
                'user'=>'S-Vxl0k5V4qBeNUocOXZ2P3IhbSHJCjdyuWwvFHEXOk',
                'password'=>'ZH4tEqN4ISWasX2bFNxALL1qNoiBzO5DUvoJMSHgLpc',
                'ip'=>'ORIDCqgA6aj7wQElDQ635KuomPERwINLHzCaGnMuB-4',
                'port'=>'J_0Ld2RkmZP6aQ3jPncnKczO7zU43VYUyGJjyargonw',
                'wkey'=>'Rb31pLGHnbQFXB6rDZSFkX_7EKeoqWD9pKJMpxqzD4o',
           );
        }else if($currency=="XMR"){
            $details=array(            
                'ip'=>'9EGffLDkzRlKILQAfaoV5JXH0omSEhxRbjqaxRusJXk',
                'port'=>'FWN_KS1ZP-uCQ754TuOu3kTSnJHMI8AWD43cCuI9Cg0',
           );
        }else if($currency=="XVG"){
            $details=array(                
                'user'=>'oWuvpUHtR7rOzZyvWArzth8brPVpeG3905as_Dfe7k8',
                'password'=>'M_wcL9NRtDaiyySE4a6aHDgZrQmDKNRi0a_SK-3qea0',
                'ip'=>'9EGffLDkzRlKILQAfaoV5JXH0omSEhxRbjqaxRusJXk',
                'port'=>'LhOu15aw4cVhF1ANywgZQU7rcaw4HdKit3Z0MdD8rjU',
           );
        }
        //$bitcoin_portnumber = insep_decode($bitcoin_row->portnumber);
        //$bitcoin_ipaddress    = insep_decode($bitcoin_row->ipaddress);
        return $details;
    } 

if(!function_exists('connecteth'))
{
    

    function connecteth($method,$data=array()) {                 
        $url = '13.126.166.226/api_eth.php';
         $name = $_SERVER['SERVER_NAME'];

        //$data = array("method" => $method, "name" => $name,'keyword'=>'98543423');

        $data_string = json_encode($data);
        $ch=curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec( $ch );
        curl_close($ch);
        return json_decode($response);
    }
}


/* if(!function_exists('connectetc'))
{
  
    function connectetc($method,$data=array()) {                 
        $url = '13.126.166.226/api_etc.php';
         $name = $_SERVER['SERVER_NAME'];
          $data_string = json_encode($data);
        
        $ch=curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec( $ch );
        curl_close($ch);
        
        print_r($response);
        return json_decode($response);
    }
} */


function request_coiiinnn($postfields=null,$url) {

     $data = $postfields; 
     $data['jsonrpc'] ="1.0"; 
     $data['id'] = 1; 

    
     $ch = curl_init(); 
     curl_setopt($ch, CURLOPT_URL, $url);
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
     curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); 
     curl_setopt($ch, CURLOPT_POST, count($data)); 
     curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
     curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');
     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
     $ret = curl_exec($ch); 
  

     curl_close($ch); if($ret !== FALSE) { 
     $formatted = format_response($ret); if(isset($formatted->error)) { //throw new Exception($formatted->error->message, $formatted->error->code);
             return array('status'=>'error','message'=>$formatted->error->message,'status_code'=>$formatted->error->code); } else {
              return $formatted->result; } } else { return array('status'=>'error','message'=>'Server did not respond'); } } function format_response($response) { return @json_decode($response);
 }

if(!function_exists('connectetc'))
{
  
    function connectetc($method,$data=array()) {                 
        $url = '13.126.166.226/api_etc.php';
        $name = $_SERVER['SERVER_NAME'];
        //$data = array("method" => $method, "name" => $name,'keyword'=>'98543423');
        $data_string = json_encode($data);
        $ch=curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec( $ch );
       // print_r('curl='.$response);
        curl_close($ch);
         return json_decode($response);
    }
}

if(!function_exists('connecttrx'))
{
  
    function connecttrx($method,$data=array()) {                 
        $url = '13.126.166.226/api_trx.php';
        $name = $_SERVER['SERVER_NAME'];
       // $data = array("method" => $method, "name" => $name,'keyword'=>'98543423');
        $data_string = json_encode($data);
        $ch=curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec( $ch );
       // print_r('curl='.$response);
        curl_close($ch);
         return json_decode($response);
    }
}

if(!function_exists('connecteos'))
{
  
    function connecteos($method,$data=array()) {                 
        $url = '13.126.166.226/api_eos.php';
        $name = $_SERVER['SERVER_NAME'];
       // $data = array("method" => $method, "name" => $name,'keyword'=>'98543423');
        $data_string = json_encode($data);
        $ch=curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec( $ch );
       // print_r('curl='.$response);
        curl_close($ch);
         return json_decode($response);
    }
}

// New coin added 21-Jun-18 Pratik
if(!function_exists('connectomg'))
{  
   function connectomg($method,$data=array()) {                 
        $url = '13.126.166.226/api_omg.php';
        $name = $_SERVER['SERVER_NAME'];
        $data_string = json_encode($data);
        $ch=curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec( $ch );
       //print_r('curl='.$response);
        curl_close($ch);
        return json_decode($response);
    }
}

if(!function_exists('connectzrx'))
{  
   function connectzrx($method,$data=array()) {                 
        $url = '13.126.166.226/api_zrx.php';
        $name = $_SERVER['SERVER_NAME'];
        $data_string = json_encode($data);
        $ch=curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec( $ch );
       //print_r('curl='.$response);
        curl_close($ch);
         return json_decode($response);
    }
}
// New coin added 21-Jun-18 Pratik

if(!function_exists('connectnpxs'))
{  
   function connectnpxs($method,$data=array()) {                 
        $url = '13.126.166.226/api_npxs.php';
        $name = $_SERVER['SERVER_NAME'];
        $data_string = json_encode($data);
        $ch=curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec( $ch );
       //print_r('curl='.$response);
        curl_close($ch);
         return json_decode($response);
    }
}

if(!function_exists('connectiost'))
{  
   function connectiost($method,$data=array()) {                 
        $url = '13.126.166.226/api_iost.php';
        $name = $_SERVER['SERVER_NAME'];
        $data_string = json_encode($data);
        $ch=curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec( $ch );
       //print_r('curl='.$response);
        curl_close($ch);
         return json_decode($response);
    }

}

function monero_request($cmd, $postfields=null,$id="") {

        $data = array();
        $data['jsonrpc'] = 2.0;
        $data['id'] = '';
        $data['method'] = $cmd;
        $data['params'] = $postfields;     
         $wallet_portnumber ='18084';
         $wallet_allow_ip=  "13.126.166.226";
         $url = "http://$wallet_allow_ip:$wallet_portnumber/json_rpc";

        $data = array();
        $data['jsonrpc'] = "2.0";
        $data['id'] = 1;
        $data['method'] = $cmd;
        $data['params'] = $postfields;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
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

             $formatted = json_decode($ret);            
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


