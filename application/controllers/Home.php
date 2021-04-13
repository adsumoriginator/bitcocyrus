<?php
defined('BASEPATH') OR exit('No direct script access allowed');
		require "vendor/autoload.php";
	use Monero\Wallet;
class Home extends CI_Controller {


	public function __construct()
	{
		parent::__construct();	


	
	

		
	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{

				// print_r($data);die;

		$data['pairs'] = trade_pairs();
			$data['features'] 	=  $this->CommonModel->getTableData(FEATURE,array('status'=>1),array('featureid','desc'))->result();	

		$data['feature_cnt'] 	=  $this->CommonModel->getTableData('bcc_static_content',array('id'=>1))->row();

		$data['footer_cnt'] 	=  $this->CommonModel->getTableData('bcc_static_content',array('id'=>2))->row();

		$data['main_js'] = "index";

		// echo "<pre>";

	   $this->load->view('front/basic/index',$data);
	}


	function verify_robot(){


	  $userdata["robot_verify"]	=1;
	  $userdata["home_numeric_verify"]	="verified";

	  $this->session->set_userdata($userdata);
	  echo "success";		


	}
	function empty_table($table = ''){
  		$this->db->empty_table('coin_order');
  		$this->db->empty_table('ordertemp');
  		$this->db->empty_table('coin_theft');
 		 $this->db->empty_table('transaction_history');
 		 echo '1';
	 }

	function register()
	{

		if($this->session->userdata("user_id")){

			redirect();
		}

		$data['main_js'] = "register";

		// echo "<pre>";
		// print_r($data);die;

		

	   $this->load->view('front/user/registration',$data);
	}


	function check_username(){

		$username=$this->input->post("username");
		$condition=array('username'=>$username);
		$userdata=$this->CommonModel->getTableData("userdetails",$condition);
		if($userdata->num_rows() >0){
				echo 'false';
		}else{
				echo 'true';

		}

	}



	function check_email(){

		$email=$this->input->post("email");

		$email=$this->input->post("email");
       	$email_array=explode("@", $email); 
		$condition=array('key_one'=>insep_encode($email_array[0]),
			"key_two"=>insep_encode($email_array[1]));


		$userdata=$this->CommonModel->getTableData("userdetails",$condition);
		if($userdata->num_rows() >0){
				echo 'false';
		}else{
				echo 'true';

		}

	}

	function check_phone(){

		$phone_number=$this->input->post("phone_number");
		$condition=array('phone_no'=>$phone_number);
		$userdata=$this->CommonModel->getTableData("userdetails",$condition);
		if($userdata->num_rows() >0){
				echo 'false';
		}else{
				echo 'true';

		}


	}

	function check_captcha(){

		  $captcha=$this->input->post("captcha");


		  $secaptcha=$this->session->userdata("reg_captcha");

		if($captcha==$secaptcha){
			echo 'true';

		}else{
			echo "false";
		}


	}




	function get_simbolo(){ 
	echo $this->security->get_csrf_hash(); 
}

	function is_login()
	{	
		// if(!user_id())
		// redirect(base_url());
		// return;
	}

	function subscribe(){
		$subscribe_email = $this->security->xss_clean($this->input->post('subscribe_email'));

		$check = $this->CommonModel->getTableData("bcc_subscribers", array('email_id' =>$subscribe_email))->row();	
		if($check!=""){
			echo "2";	
	    }
		else{
			$idata['email_id'] = $subscribe_email;
			$idata['created_date'] = date('Y-m-d h:i:s');
			$ins = $this->CommonModel->addTableData("bcc_subscribers",$idata);
			if($ins){
				echo "1";
			}else{
				echo "0";
			}
		}
	
	}

	function subscribe_email_exist(){	



		$subscribe_email = trim($this->input->get_post('subscribe_email'));
		$check = $this->CommonModel->getTableData("bcc_subscribers", array('email_id' =>$subscribe_email))->row();
		if ($check=="")
		{ 		
			echo 'true';
			
		}					
		 else {
		 	echo 'false';			
		}	
	}


	function captcha(){

		$size = 100;	
		$img=imagecreatetruecolor(45,37);
		$back = imagecolorallocate($img, 72, 192, 239);
		imagefilledrectangle($img, 0, 0, $size - 1, $size - 1, $back);
		$numeroa = rand(1, 9);		
		$numerob = rand(1, 9);
		$numero = $numeroa + $numerob;
		$captcha_val=array("reg_captcha"=>$numero);
		$this->session->set_userdata($captcha_val);
		
		$display = $numeroa . '+' . $numerob . '=';
		imagecolortransparent($img, $back);
		$white = imagecolorallocate($img, 0, 0, 0); 
		imagestring($img, 10, 8, 3, $display, $white);
 		header ("Content-type: image/png"); imagepng($img);

	}



	function home_captcha(){
		//$img = imagecreatefrompng('home_captcha.png'); 	
	    $size = 100;	
		$img=imagecreatetruecolor(66,37);
		$back = imagecolorallocate($img, 72, 192, 239);
		imagefilledrectangle($img, 0, 0, $size - 1, $size - 1, $back);
		$numeroa = rand(1, 9);		
		$numerob = rand(1, 9);
		$numero = $numeroa + $numerob;
		$captcha_val=array("home_captcha"=>$numero);
		$this->session->set_userdata($captcha_val);
		
		$display = $numeroa . '+' . $numerob . '=';
		imagecolortransparent($img, $back);
		$white = imagecolorallocate($img, 0, 0, 0); 
		imagestring($img, 10, 8, 3, $display, $white);
 		header ("Content-type: image/png"); imagepng($img); 
	}

	function verify_home(){

		 $captcha_val=$this->input->post("captcha_response");
	
		 //$sessionval=$this->session->userdata("home_captcha");
		 
		if($captcha_val != ''){

			
	  		$userdata["robot_verify"]	=1;
	  		$userdata["home_numeric_verify"]	="verified";

	  		$this->session->set_userdata($userdata);

			echo "correct";
		}else{

			echo "invalid";
		}


	}







	function login_captcha(){
	    $size = 100;	
		$img=imagecreatetruecolor(45,37);
		$back = imagecolorallocate($img, 72, 192, 239);
		imagefilledrectangle($img, 0, 0, $size - 1, $size - 1, $back);
		$numeroa = rand(1, 9);		
		$numerob = rand(1, 9);
		$numero = $numeroa + $numerob;
		$captcha_val=array("login_captcha"=>$numero);
		$this->session->set_userdata($captcha_val);
		
		$display = $numeroa . '+' . $numerob . '=';
		imagecolortransparent($img, $back);
		$white = imagecolorallocate($img, 0, 0, 0); 
		imagestring($img, 10, 8, 3, $display, $white);
 		header ("Content-type: image/png"); imagepng($img);
	}


	function generate_otp(){

		 $captcha=$this->input->post("g-recaptcha-response");
        $secaptcha=$this->session->userdata("reg_captcha");
        echo $captcha; 
		//if($captcha!=$secaptcha){
        if($captcha ==''){
					
			echo "captcha_error";
			exit;
		} 		




		$otp = mt_rand(100000, 999999);
		//$otp=123456;
		$otp_val=array("reg_otp"=>$otp);
		$this->session->set_userdata($otp_val);
			    $email_data=getEmailTeamplete(1);
				$subject=$email_data->subject;
				$template=$email_data->template;
				$site_data=site_settings();
				$sitename=$site_data->site_name;
				$data=array(

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
				"###OTP###"=> $otp,		
			);

			$email=$this->input->post("email");
			 $message=strtr($template,$data);
			 send_mail($email,$subject,$message);

			echo "success";

	}




	function generate_login_otp($email=""){



		$otp = mt_rand(100000, 999999);
		//$otp=123456;
		$otp_val=array("login_otp"=>$otp);
		$this->session->set_userdata($otp_val);
			    $email_data=getEmailTeamplete(1);
				$subject=$email_data->subject;
				$template=$email_data->template;
				$site_data=site_settings();
				$sitename=$site_data->site_name;
				$data=array(

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
				"###OTP###"=> $otp,		
			);

			//$email=$this->input->post("email");
			 $message=strtr($template,$data);
			 send_mail($email,$subject,$message);

			return true;

	}





	function check_refer(){

		$refer_id=trim($this->input->post("refer_id"));
		$condition=array("user_code"=>$refer_id);
		$userdata=$this->CommonModel->getTableData("userdetails",$condition);


		if($userdata->num_rows() >0){
				echo 'true';
		}else{
				echo 'false';

		}

	}


	function otp_validate(){

		$this->load->helper(array('form', 'url'));
        $this->load->library('form_validation'); 
        $this->form_validation->set_rules('otp', 'Password', 'required');      
		$this->form_validation->set_rules('email', 'email', 'required');
		$this->form_validation->set_rules('password', 'password', 'required');
		$this->form_validation->set_rules('phone_number', 'Email', 'required');
        if ($this->form_validation->run() == FALSE)
         {
            	echo "value_missing";      
         }
          else
          {

	   	 	$generated_otp=$this->session->userdata("reg_otp");      		
      		

      		$receive_otp=$this->input->post("otp");
       		if($generated_otp==$receive_otp){

       			$email=$this->input->post("email");
       			$email_array=explode("@", $email); 		
       		  	$insertdata["username"]=$this->input->post("username");
       		  	$insertdata["refer_id"]=$this->input->post("refer_id");
       			$insertdata["phone_no"]=$this->input->post("phone_number");
       			$insertdata["key_three"]=insep_encode($this->input->post("password"));
       			$insertdata["key_one"]=insep_encode($email_array[0]);
       			$insertdata["key_two"]=insep_encode($email_array[1]);
       			$insertdata["user_code"]="BCS".time();
				$verify_key=insep_encode(time());
       			$insertdata["email_status"]=1;
       			$this->CommonModel->addTableData("userdetails",$insertdata);
       			$user_id=$this->db->insert_id();;
       			//$wallet_data['user_id']=$user_id;
       			//$this->CommonModel->addTableData("wallet",$wallet_data);
       			//$this->CommonModel->addTableData("user_verification",$wallet_data);

				$this->CommonModel->addDefualtUserDetail($user_id);
				//$this->CommonModel->getaddress($user_id,$email);

       			//$address_data['user_id']=$user_id;

       			//$this->CommonModel->addTableData("address",$address_data);
	       		

      
       			echo "success";
      		}else{

       			echo "invalid_otp";
      		}



               


           }

			



	}
	
	
function login_notification($email=""){

	$ip=$_SERVER['REMOTE_ADDR'];
	$user_agent =  $_SERVER['HTTP_USER_AGENT'];
	$os=$this->getOS($user_agent);
	$browser=$this->getBrowser($user_agent);	
    $email_data=getEmailTeamplete(14);
	$subject=$email_data->subject;
	$template=$email_data->template;
	$site_data=site_settings();
	$sitename=$site_data->site_name;
	$data=array(
				"###NAME###"=>$this->input->post("username"),
				"###LOGOIMG###"=>getSiteLogo(),
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



				"###IP###"=> $ip,
				"###OS###"=> $os,
				"###BROWSER###"=> $browser,
				"###TIME###"=> date("d-m-Y h:m:s"),				
			);

			
			 $message=strtr($template,$data);
			  $message;
			 send_mail($email,$subject,$message);





}


	function email_confirm($varify_id=""){
		if($varify_id!=""){
			$condition=array("email_verify_key"=>$varify_id);
			$user_row=$this->CommonModel->getTableData("userdetails",$condition);

			if($user_row->num_rows() ==1){

				$user_row=$user_row->row();
				$user_id=$user_row->user_id;
				$updateData['email_status']=1;
				$updateData['email_verify_key']="";
				$upcondition=array('user_id'=>$user_id);
				$this->CommonModel->updateTableData("userdetails",$updateData,$upcondition);

	       		$email_data=getEmailTeamplete(2);
				$subject=$email_data->subject;
				$template=$email_data->template;
				$site_data=site_settings();
				$sitename=$site_data->site_name;

					$data=array(
					"###LOGOIMG###"=>  base_url()."assets/frontend/images/mail_logo.png",
					"###FBIMG###"=> base_url()."assets/frontend/images/facebook.png",				
					"###TWIMG###"=> base_url()."assets/frontend/images/twitter.png",
					"###GPIMG###"=> base_url()."assets/frontend/images/gplus.png",
					"###LEIMG###"=> base_url()."assets/frontend/images/linkedin.png",	
					"###HDIMG###"=> base_url()."assets/frontend/images/email.png",
					"###FBLINK###"=> $site_data->facebooklink,				
					"###TWLINK###"=> $site_data->twitterlink,	
					"###GPLINK###"=> $site_data->googlelink,
					"###LELINK###"=> $site_data->linkedinlink,
					"###LOGINLINK###"=> base_url()."home/login/",		
				);

			$email=get_user_email($user_id);
			$message=strtr($template,$data);		
			send_mail($email,$subject,$message);
            $this->session->set_flashdata("success","Email address verified successfully");
            redirect("home/login");


			}else{
			$this->session->set_flashdata("error","Invalid Link");
			redirect("home/register");


			}
		}else{
			$this->session->set_flashdata("error","Invalid Link");
			redirect("home/register");
		}


	}



	function login(){

	
		if($this->session->userdata("user_id")){

			redirect();
		}
		$data['main_js'] = "register";
		$this->load->view('front/user/login',$data);

	}







	function login_check(){


		$username=$this->input->post("username");
		$this->load->helper(array('form', 'url'));
        $this->load->library('form_validation'); 
        $this->form_validation->set_rules('username', 'Username', 'required');  
		$this->form_validation->set_rules('password', 'password', 'required');
		//$this->form_validation->set_rules('g-recaptcha-response', 'g-recaptcha-response', 'required');
	
        if ($this->form_validation->run() == FALSE)
         {
            	echo "value_missing";      
         }
         else
         {


         	$ip=$_SERVER['REMOTE_ADDR'];
			$user_agent =  $_SERVER['HTTP_USER_AGENT'];
			$os=$this->getOS($user_agent);
			$browser=$this->getBrowser($user_agent);	
   	       	$captcha=$this->input->post("g-recaptcha-response");
         	$captcha_val=$this->session->userdata("login_captcha");
         	if($captcha !=''){

         		$username=$this->input->post("username");
         		$password=insep_encode($this->input->post("password"));
         		if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
  					$email_arry=explode("@",$username);
  					$key1=insep_encode($email_arry[0]);
  					$key2=insep_encode($email_arry[1]);

  					$condition=array('key_one'=>$key1,'key_two'=>$key2,'key_three'=>$password);


				} else {
 						$condition=array('username'=>$username,'key_three'=>$password);

				}

				$userdata=$this->CommonModel->getTableData("userdetails",$condition);
				


			

				if($userdata->num_rows() == 1){


						$userdata=$userdata->row();
						$user_id=$userdata->user_id;
						$username=$userdata->username;
						$userdata->tfa_status;
						if($userdata->tfa_status==0){
							if($userdata->user_status==0){
								echo "user_inactive";
								exit;
							}else if($userdata->email_status==0){
								echo "email_not_verified";
									exit;
							}
							$email=get_user_email($user_id);

							$this->generate_login_otp($email);

							echo "email_validate";
							exit;


						/*$sess_user=array('user_id'=>$user_id,'username'=>$username);
						$this->session->set_userdata($sess_user);
						$log_data['user_id']=$user_id;
						$log_data['activity']="Login";
						$log_data['ip_address']=$ip;
						$log_data['os_name']=$os;
						$log_data['browser_name']=$browser;
						$log_data['is_invalid']="Success";
						$this->CommonModel->addTableData("user_activity",$log_data);
						$email=get_user_email($user_id);
						$this->login_notification($email);

						$log_status["login_status"]=1;
						$condition=array('user_id'=>$user_id);

						$this->CommonModel->updateTableData("userdetails",$log_status,$condition);

						*/

					}else{
						echo "tfa";
						exit;

					}
					
				}else{

	
	
					echo "Invalid_user";

					exit;
				}

				


         	}else{
         		echo "invalid_captcha";
         		exit;

         	}



         }	

         	if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
  					$email_arry=explode("@",$username);
  					$key1=insep_encode($email_arry[0]);
  					$key2=insep_encode($email_arry[1]);

  					$condition=array('key_one'=>$key1,'key_two'=>$key2,);


				} else {
 						$condition=array('username'=>$username);

				}

				$userdata=$this->CommonModel->getTableData("userdetails",$condition);
				if($userdata->num_rows() >0){


					$userdata=$userdata->row();
					$user_id=$userdata->user_id;
					$username=$userdata->username;
					$sess_user=array('user_id'=>$user_id,'username'=>$username);
					$this->session->set_userdata($sess_user);
					$log_data['user_id']=$user_id;


					$log_data['activity']="Login";
					$log_data['ip_address']=$ip;
					$log_data['os_name']=$os;
					$log_data['browser_name']=$browser;
					$log_data['is_invalid']="Fail";				

					$this->CommonModel->addTableData("user_activity",$log_data);

			}

	}



	function check_tfa(){


		$username=$this->input->post("username");
		$this->load->helper(array('form', 'url'));
        $this->load->library('form_validation'); 
        $this->form_validation->set_rules('username', 'Username', 'required');  
		$this->form_validation->set_rules('password', 'password', 'required');
		$this->form_validation->set_rules('tfa_code', 'tfa_code', 'required');

        if ($this->form_validation->run() == FALSE)
         {
            	echo "value_missing";      
         }
         else
         {

         		$this->load->library('GoogleAuthenticator');
         	$ip=$_SERVER['REMOTE_ADDR'];
			$user_agent =  $_SERVER['HTTP_USER_AGENT'];
			$os=$this->getOS($user_agent);
			$browser=$this->getBrowser($user_agent);     	

          

         		$username=$this->input->post("username");
         		$password=insep_encode($this->input->post("password"));
         		if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
  					$email_arry=explode("@",$username);
  					$key1=insep_encode($email_arry[0]);
  					$key2=insep_encode($email_arry[1]);

  					$condition=array('key_one'=>$key1,'key_two'=>$key2,'key_three'=>$password);


				} else {
 						$condition=array('username'=>$username,'key_three'=>$password);

				}
				$userdata=$this->CommonModel->getTableData("userdetails",$condition);
			
				if($userdata->num_rows()==1){

					$userdata=$userdata->row();

					$secrect_key=$userdata->tfa_secrect_key;
					$code=$this->input->post("tfa_code");
					$checkResult = $this->googleauthenticator->verifyCode($secrect_key, $code, 2); // 2 = 2*30sec clock tolerance
									
					
					if ($checkResult) {
						$ip=$_SERVER['REMOTE_ADDR'];
						$user_agent =  $_SERVER['HTTP_USER_AGENT'];
						$os=$this->getOS($user_agent);
						$browser=$this->getBrowser($user_agent);	
						$user_id=$userdata->user_id;
						$sess_user=array('user_id'=>$user_id,'username'=>$userdata->username);
						$this->session->set_userdata($sess_user);
						$log_data['user_id']=$user_id;
						$log_data['activity']="Login";
						$log_data['ip_address']=$ip;
						$log_data['os_name']=$os;
						$log_data['browser_name']=$browser;
						$log_data['is_invalid']="Success";
						$this->CommonModel->addTableData("user_activity",$log_data);
						$email=get_user_email($user_id);
						$this->login_notification($email,$user_id);

						$log_status["login_status"]=1;
						$condition=array('user_id'=>$user_id);

						$this->CommonModel->updateTableData("userdetails",$log_status,$condition);

				/* New coin integration added in currency table */
				$data=array_column($this->CommonModel->getTableData("currency","","","currency_symbol")->result(),"currency_symbol");
				$data1=array_column($this->CommonModel->getTableData("address_balance",$condition,"","currency_symbol")->result(),"currency_symbol");

				if(count($data)> count($data1)) {
					$result=array_diff($data,$data1);
					if(count($result)>0) {
						foreach ($result as  $value) {
							$walletdata["currency_symbol"] = $value;
							$walletdata['user_id']=$user_id;
							$this->db->insert("address_balance",$walletdata);	
							//$this->CommonModel->updateTableData("address_balance",$log_status,$condition);
						}
					}
				}
				/* New coin integration added in currency table */

						echo "success";
						
					}else{

						echo "Invalid";
					}


				}	


	}


}





	function check_email_otp(){


		$username=$this->input->post("username");
		$this->load->helper(array('form', 'url'));
        $this->load->library('form_validation'); 
        $this->form_validation->set_rules('username', 'Username', 'required');  
		$this->form_validation->set_rules('password', 'password', 'required');
		$this->form_validation->set_rules('email_code', 'Email code', 'required');

        if ($this->form_validation->run() == FALSE)
         {
            	echo "value_missing";      
         }
         else
         {

         		
         	$ip=$_SERVER['REMOTE_ADDR'];
			$user_agent =  $_SERVER['HTTP_USER_AGENT'];
			$os=$this->getOS($user_agent);
			$browser=$this->getBrowser($user_agent);     	

          

         		$username=$this->input->post("username");
         		$password=insep_encode($this->input->post("password"));
         		if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
  					$email_arry=explode("@",$username);
  					$key1=insep_encode($email_arry[0]);
  					$key2=insep_encode($email_arry[1]);

  					$condition=array('key_one'=>$key1,'key_two'=>$key2,'key_three'=>$password);


				} else {
 						$condition=array('username'=>$username,'key_three'=>$password);

				}
				$userdata=$this->CommonModel->getTableData("userdetails",$condition);
			
				if($userdata->num_rows()==1){

					$userdata=$userdata->row();

					$code=$this->input->post("email_code");
					$sesion_otp=$this->session->userdata("login_otp");
				

					if ($code==$sesion_otp) {
						$ip=$_SERVER['REMOTE_ADDR'];
						$user_agent =  $_SERVER['HTTP_USER_AGENT'];
						$os=$this->getOS($user_agent);
						$browser=$this->getBrowser($user_agent);	
						$user_id=$userdata->user_id;
						$sess_user=array('user_id'=>$user_id,'username'=>$userdata->username);
						$this->session->set_userdata($sess_user);
						$log_data['user_id']=$user_id;
						$log_data['activity']="Login";
						$log_data['ip_address']=$ip;
						$log_data['os_name']=$os;
						$log_data['browser_name']=$browser;
						$log_data['is_invalid']="Success";
						$this->CommonModel->addTableData("user_activity",$log_data);
						$email=get_user_email($user_id);
						$this->login_notification($email,$user_id);
						$log_status["login_status"]=1;
						$condition=array('user_id'=>$user_id);
						$this->CommonModel->updateTableData("userdetails",$log_status,$condition);	

						echo "success";
						
					}else{

						echo "Invalid";
					}


				}	


	}


}






function getOS($user_agent) { 


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

function getBrowser($user_agent) {  

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

    return $browser ;
}


function forgot_password(){

	$data['main_js'] = "register";

	$this->load->view('front/user/forgot_pass',$data);
}


function forgot_pass_send(){

	$username=$this->input->post("username");

	if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
  					$email_arry=explode("@",$username);
  					$key1=insep_encode($email_arry[0]);
  					$key2=insep_encode($email_arry[1]);

  					$condition=array('key_one'=>$key1,'key_two'=>$key2);


				} else {
 						$condition=array('username'=>$username);

				}

		$userdata=$this->CommonModel->getTableData("userdetails",$condition);

		if($userdata->num_rows() >0 ){
			$userdata=$userdata->row();
			$user_id=$userdata->user_id;
			$forgot_key=insep_encode(time());
			$condition=array("user_id"=>$user_id);
			$link=$forgot_key;
			$updateData["fotgot_key"]=$link;
			$this->CommonModel->updateTableData("userdetails",$updateData,$condition);

			$email_data=getEmailTeamplete(3);
			$subject=$email_data->subject;
			$template=$email_data->template;
			$site_data=site_settings();
			$sitename=$site_data->site_name;

			$link=base_url()."home/reset_password/".$link;

					$data=array(

				"###FORLINK###"=>$link,	
				"###NAME###"=>$userdata->username,
				"###LOGOIMG###"=>getSiteLogo(),
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

			$email=get_user_email($user_id);
			$message=strtr($template,$data);		
			send_mail($email,$subject,$message);
			echo "success";



		}else{

			echo "Invalid";

		}


}


function reset_password($id=""){


if($id!=""){

	$condition=array('fotgot_key'=>$id);
	$userdata=$this->CommonModel->getTableData("userdetails",$condition);


	if($userdata->num_rows() >0 ){


		if($this->input->post("submit")){
			
			$password=$this->input->post("password");
			$updateData["key_three"]=insep_encode($password);
			$updateData["fotgot_key"]="";
			$userdata=$userdata->row();
			$user_id=$userdata->user_id;
			$this->CommonModel->updateTableData("userdetails",$updateData,$condition);

			$email_data=getEmailTeamplete(8);
			$subject=$email_data->subject;
			$template=$email_data->template;
			$site_data=site_settings();
			$sitename=$site_data->site_name;
			$link=base_url();

					$data=array(

				"###LINK###"=>$link,	
				"###NAME###"=>$userdata->username,
				"###LOGOIMG###"=>getSiteLogo(),
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

			$email=get_user_email($user_id);
			$message=strtr($template,$data);		
			send_mail($email,$subject,$message);
			echo "success";
			//$this->session->set_flashdata("success","Password reseted successfully");
		

		}else{

				$data['main_js'] = "register";
			$this->load->view('front/user/reset',$data);

		}



	}else{


		$this->session->set_flashdata("error","Invalid link");
		redirect("home/login");

	}


	

}

}

function logout(){
	if(user_id()){
		$log_status["login_status"]=0;
		$user_id=user_id();
		$condition=array('user_id'=>$user_id);
		$this->CommonModel->updateTableData("userdetails",$log_status,$condition);
	 }
	$this->session->unset_userdata('user_id');
	$this->session->unset_userdata('user_name');	
	$this->session->unset_userdata('username');	

	//$userdata["robot_verify"]	=1;
	//$userdata["home_numeric_verify"]	="verified";
	
	redirect();

}


function logout_all(){

$this->session->sess_destroy();


}


function create_code($code=""){

		$this->load->library('GoogleAuthenticator');
		$secret=$code;
		echo $oneCode = $this->googleauthenticator->getCode($secret);
	}


	function download_pdf($user_id,$type=""){
			$order_by=array('id','desc');

	if($type==1){

		$condition=array("user_id"=>$user_id,'status !='=>"requested","type"=>1);
		$data["deposit"]=$this->CommonModel->getTableData("tansation",$condition,$order_by);

	}else{
		$condition=array("user_id"=>$user_id,'status !='=>"requested","type"=>2);
		$data["withdraw"]=$this->CommonModel->getTableData("tansation",$condition,$order_by);
	}
		$data["type"]=$type;

		$this->load->view("front/transation/export",$data);


			


	}




function notification(){
	$user_id=user_id();
	$condition=array('user_id'=>$user_id,'status'=>0);
	echo $row=$this->CommonModel->getTableData("bcc_notificationlist",$condition)->num_rows();



}

function notification_list(){


	$user_id=user_id();
	$condition=array('user_id'=>$user_id,'status'=>0);
	$result=$this->CommonModel->getTableData("bcc_notificationlist",$condition);
	$m="";
	if($result->num_rows() > 0){

		$update['status']=1;

			
			foreach($result->result() as $row){

			$m.="<a class='dropdown-item'>".$row->message."</a>";
			

		
		}
		$this->CommonModel->updateTableData("bcc_notificationlist",$update,$condition);

	}else{

		$m.="<a class='dropdown-item'>Notifiication not found</a>";

	}
	echo $m;

}
function user_check(){


$user_id=$this->uri->segment(3);
	if($user_id!=""){
		$suser_id=user_id();
		if(!$suser_id){
			$condition=array("user_id"=>$user_id);
			$updata['login_status']=0;	
			$this->CommonModel->updateTableData("userdetails",$updata,$condition);
			
		}
	} 

	echo "success";


}


function volume(){

	echo getTradeVolume_main(1);

	
}
}

