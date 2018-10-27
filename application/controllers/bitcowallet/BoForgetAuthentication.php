<?php
/**
 * BoChangePassword class
 * @category controller
 * @package ICO Suisse
 * @subpackage modules
 * @author Adsum Originator LLP
 * @link http://adsumoriginator.com/
 */

class BoForgetAuthentication extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->library('form_validation');			
		$this->load->database();
		$this->load->helper('url');

	}

	

	public function index(){	

		/*echo "<pre>";
		print_r($_POST);die;*/

		if($this->input->post('useremail')!="") {

			$useremail = $this->input->post('useremail');

			$admin_email = $this->Wallet_model->getTableData(AWALLET,array('admin_id'=>1))->row();
			/*echo "<pre>";
			print_r($admin_email);die;*/

			// echo $admin_email->email_id."   ".$useremail;die;

			if($admin_email->email_id==$useremail){

			$date = date("Y-m-d H:i:s");

			$code = strtotime($date);

			$random_code = insep_encode($code);	

			$link = wallet_url().'BoForgetAuthentication/reset_password/'.$random_code;

			$udata['forget_time'] = $code;

			$udata['forget_code'] = $random_code;

			$Updatedata = $this->Wallet_model->updateTableData(AWALLET,array('admin_id'=>1),$udata);

			// $email_template = '1';

			 $email_data=getEmailTeamplete(3);
				$subject=$email_data->subject;
				$template=$email_data->template;

			$site_data=site_settings();
			$sitename=$site_data->site_name;

			$special_vars = array(
				'###LOGOIMG###'     => getSiteLogo(),
				"###EMAILIMG###"=>  base_url()."assets/frontend/images/email_send.png",
				"###FBIMG###"=> base_url()."assets/frontend/images/facebook.png",
				"###TWIMG###"=> base_url()."assets/frontend/images/twitter.png",
				"###GPIMG###"=> base_url()."assets/frontend/images/gplus.png",
				"###LEIMG###"=> base_url()."assets/frontend/images/linkedin.png",
				"###HDIMG###"=> base_url()."assets/frontend/images/email.png",
				"###FBLINK###"=> $site_data->facebooklink,				
				"###TWITLINK###"=> $site_data->twitterlink,	
				"###GPLUSLINK###"=> $site_data->googlelink,
				"###LINKEDINLINK###"=> $site_data->linkedinlink,				
				'###FORLINK###'         => $link
				);

			  // $result = $this->Email_model->sendMail($useremail, '', '', $email_template, $special_vars);

				 $message=strtr($template,$special_vars);
				 $result=send_mail($useremail,$subject,$message);			 
			
			  if($result){					
				$this->session->set_flashdata('success', 'Reset Password Link Sent Successfully');
				wallet_redirect('BoForgetAuthentication');			
			}	
	    	else{   		
				$this->session->set_flashdata('error', 'Error Occurred While Sending Reset Password Mail');
				wallet_redirect('BoForgetAuthentication');		
			}

			}		
	    	else{
				$this->session->set_flashdata('error', 'Please enter valid email address');
				wallet_redirect('BoForgetAuthentication');
			}			
		}else{

			//$data['getAdminUserInfo'] 	= $this->Wallet_model->getTableData(AD,array('admin_id'=>1))->row();
			$siteDetails 				= $this->Wallet_model->getTableData(SETTINGS,array('id'=>1))->row();
			$data['siteName'] 			= $siteDetails->site_name;
			$data['title'] 				= "Admin Forget password | ".$siteDetails->site_name;
			$data['keywords'] 			= "Admin Forget password | ".$siteDetails->site_name;
			$data['description'] 		= "Admin Forget password | ".$siteDetails->site_name;
			$this->load->view('admin_wallet/boForgetpassword/Forgetpassword',$data);			
		}

	}


	function reset_password($code=''){		
			
			$admin_det = $this->Wallet_model->getTableData(AWALLET,array('forget_code'=>$code,'forget_status'=>0))->row();

			if($code!="" && $admin_det){

			$date = date("Y-m-d H:i:s");

			$current_time = strtotime($date);						

			$futureDate = $admin_det->forget_time+(60*15);

			$formatDate = date("Y-m-d H:i:s", $futureDate);	

			$future = strtotime($formatDate);

     		if($current_time>$future){
     		   $this->session->set_flashdata('error', 'Reset Password Link Expired or Deactivated ');
				wallet_redirect('BoForgetAuthentication');
		    }
		    else{
			// $data['getAdminUserInfo'] 	= $this->Wallet_model->getTableData(AD,array('admin_id'=>1))->row();
			$siteDetails 				= $this->Wallet_model->getTableData(SETTINGS,array('id'=>1))->row();
			$data['siteName'] 			= $siteDetails->site_name;
			$data['title'] 				= "Admin Reset password | ".$siteDetails->site_name;
			$data['keywords'] 			= "Admin Reset password | ".$siteDetails->site_name;
			$data['description'] 		= "Admin Reset password | ".$siteDetails->site_name;
			$this->load->view('admin_wallet/boForgetpassword/Resetpassword',$data);
		   }
	    }
		else{
			$this->session->set_flashdata('error', 'Reset Password Link Expired or Deactivated ');
			wallet_redirect('BoForgetAuthentication');
			}	
}


        function update_password(){

			if($this->input->post('newpassword')!='' && $this->input->post('repassword')!='')
			{
				$updata['password'] = insep_encode($this->input->post('newpassword'));

				// $updata['forget_status'] = '';

				$updata['forget_code'] = '';

				$Updatedata = $this->Wallet_model->updateTableData(AWALLET,array('admin_id'=>1),$updata);
				if($Updatedata){
				$this->session->set_flashdata('success', ' Password  Updated Successfully ');
				wallet_redirect('Authentication');
				}else{
					$this->session->set_flashdata('error', 'Error Occurrd While Update Your password ');
					wallet_redirect('BoForgetAuthentication');
				}
			}
	     }



}
?>