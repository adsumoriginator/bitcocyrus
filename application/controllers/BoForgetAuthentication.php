<?php
/**
 * BoForgetAuthentication class
 * @category controller
 * @package Coin control
 * @subpackage modules
 * @author Osiz Technologies Pvt Ltd 
 * @link http://osiztechnologies.com/
 */

class BoForgetAuthentication extends CI_Controller {
	public function __construct() {
		parent::__construct();
		//$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->model('BoForgetAuthenticationModel');
		$this->load->model('CommonModel');
		//$this->load->model('EmailModel');
		//$this->load->database();
		//$this->load->helper('url');
	}
	public function index() {
		$data['getAdminUserInfo'] 	= $this->CommonModel->getLoggedInAdminDetails();
		$siteDetails 				= $this->CommonModel->getSiteConfigInfo();
		$data['siteName'] 			= $siteDetails['0']->site_name;
		$data['title'] 				= "Admin Forget password | ".$siteDetails['0']->site_name;
		$data['keywords'] 			= "Admin Forget password | ".$siteDetails['0']->site_name;
		$data['description'] 		= "Admin Forget password | ".$siteDetails['0']->site_name;


		$this->load->view('admin/boForgetAuthentication/boForgetAuthentication',$data);
	}
	public function forgetPasswordAuthentication() {
		if(!empty($this->input->post('userEmail'))) {
			$userEmail 			= $this->input->post('userEmail');
			$getAdminDetails 	= $this->CommonModel->AdminDetails($userEmail);

	


			$siteDetails 		= $this->CommonModel->getSiteConfigInfo();


	
			
			if($getAdminDetails['0']->bcc_email_id == $userEmail) {
				$date 								= date("Y-m-d H:i:s");
				$code 								= strtotime($date);		
				$random_code 						= $this->CommonModel->insep_encode($code);			
				$link 								= base_url().'BoForgetAuthentication/reset_password/'.$random_code;

				$updateData['forgetPasswordTime'] 	= $code;
				$updateData['forgetPasswordCode'] 	= $random_code;

				$adminID 							= $getAdminDetails[0]->id;
				$result 							= $this->BoForgetAuthenticationModel->updateForgetPasswordStatus($adminID,$updateData);

				$email_template = '1';
				/*$special_vars = array(
					//'###SITELOGO###' => getSiteLogo(),
					'###SITENAME###' => $siteDetails['0']->site_name,
					'###SITELINK###' => base_url(),
					'###USERNAME###' => $getAdminDetails['0']->adminFirstName." ".$getAdminDetails['0']->adminLastName,
					'###LINK###' 	 => $link


				);*/



				   $email_data=getEmailTeamplete(3);
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
				'###FORLINK###' 	 => $link			
			);

			
			 $message=strtr($template,$data);		
			 $result=send_mail($userEmail,$subject,$message);
			
				if($result) {		
					$this->session->set_flashdata('success', 'Reset Password Link Sent Successfully');
					redirect('BoForgetAuthentication','refresh');
				}	
	    		else {	    		
					$this->session->set_flashdata('error', 'Error Occurred While Sending Reset Password Mail');
					redirect('BoForgetAuthentication','refresh');
				}
			}
	    	else {
				$this->session->set_flashdata('error', 'Please enter correct email');
				redirect('BoForgetAuthentication','refresh');
			}
		}
	}
	public function reset_password($code='') {	
		$forgetPasswordStatus = 0;
		$details = $this->BoForgetAuthenticationModel->getForgetPasswordCodeDetails($code,$forgetPasswordStatus);

		
		if(isset($code) && !empty($code) && isset($details) && !empty($details)) {
			$date 			= date("Y-m-d H:i:s"); echo "<br>";
			$current_time 	= strtotime($date); echo "<br>";	
			$futureDate 	= $details['0']->forgetPasswordTime+(60*5); echo "<br>";
			$formatDate 	= date("Y-m-d H:i:s", $futureDate); echo "<br>";
			$future 		= strtotime($formatDate); echo "<br>";
			if($current_time>$future) {
				$this->session->set_flashdata('error', 'Reset Password Link Expired or Deactivated ');
				redirect('BoForgetAuthentication','refresh');
			}
			else {
				/*$data['getAdminUserInfo'] 	= $this->Common_Model->getTableData(AD,array('admin_id'=>1))->row();
				$siteDetails 				= $this->Common_Model->getTableData(SETTINGS,array('id'=>1))->row();
				$data['siteName'] 			= $siteDetails->site_name;
				$data['title'] 				= "Admin Reset password | ".$siteDetails->site_name;
				$data['keywords'] 			= "Admin Reset password | ".$siteDetails->site_name;
				$data['description'] 		= "Admin Reset password | ".$siteDetails->site_name; */

			$siteDetails 				= $this->CommonModel->getSiteConfigInfo();
			$data['siteName'] 			= $siteDetails['0']->site_name;
			$data['copyRight'] 			= date('Y');
			$data['copySiteTitle'] 		= $siteDetails['0']->site_name." Admin";			
			$data['title'] 				= "Admin Reset password | ".$siteDetails['0']->site_name;
			$data['keywords'] 			= "Admin Reset password | ".$siteDetails['0']->site_name;
			$data['description'] 		= "Admin Reset password | ".$siteDetails['0']->site_name;	

			$data['admin_id']=	$details['0']->id;		
				$this->load->view('admin/boForgetAuthentication/boResetPassword',$data);
			}
		}
		else {
			$this->session->set_flashdata('error', 'Reset Password Link Expired or Deactivated ');
			redirect('BoForgetAuthentication','refresh');
		}
	}

	public function update_password() {

		if($this->input->post('newpassword')!='' && $this->input->post('repassword')!=''){
			$updata['bcc_password'] 			= md5($this->input->post('newpassword'));	
			
			//$updata['forgetPasswordStatus'] = '';
			$updata['forgetPasswordCode'] 	= '';

			$adminID 						= $this->input->post("admin_id");
			$result 						= $this->BoForgetAuthenticationModel->updateForgetPasswordStatus($adminID,$updata);
		

			if($result) {
				$this->session->set_flashdata('success', ' Password  Updated Successfully ');
				redirect('YfQa6hmtE8a3G2Z6Ssuf','refresh');				
			}
			else {
				$this->session->set_flashdata('error', 'Error Occurrd While Update Your password ');
			    redirect('YfQa6hmtE8a3G2Z6Ssuf','refresh');
			}
		}
	}	
}

/**
 * Filename: BoForgetAuthentication.php
 * Location: /application/controllers/BoForgetAuthentication.php
 */
?>