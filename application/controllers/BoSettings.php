<?php
/**
 * BoSettings class
 * @category controller
 * @package Bitcocyrus
 * @subpackage modules
 * @author Osiz Technologies Pvt Ltd 
 * @link http://osiztechnologies.com/
 */

class BoSettings extends CI_Controller {
	/**
	* Initialize function
	* @access public
	* @return init library,model,database and helper
	* @author Sharavana Kumar
	*/	
	public function __construct() {
		parent::__construct();
				$loggedUserId = $this->session->userdata('loggedJTEAdminUserID');
		
		if(isset($loggedUserId) && !empty($loggedUserId)) {




		}else{

			redirect('YfQa6hmtE8a3G2Z6Ssuf','refresh');
		}
		$this->load->library('form_validation');
		$this->load->model('BoSettingsModel');
		$this->load->model('CommonModel');
		$this->load->database();
		$this->load->helper('url');
	}

	/**
	* Initialize function
	* @access public
	* @author Sharavana Kumar
	*/	
	public function index() {



		$loggedUserId = $this->session->userdata('loggedJTEAdminUserID');
		
		if(isset($loggedUserId) && !empty($loggedUserId)) {
			$siteConfig 						= $this->CommonModel->getSiteConfigInfo();
			$getAdminUserInfo 					= $this->CommonModel->getLoggedInAdminDetails();
			
			if(isset($getAdminUserInfo) && !empty($getAdminUserInfo)) {
				$data['adminID'] 				= $getAdminUserInfo['0']->id;
				$data['adminFirstName'] 		= $getAdminUserInfo['0']->adminFirstName;
				$data['adminLastName'] 			= $getAdminUserInfo['0']->adminLastName;
;
				$data['profile_image'] 			= $getAdminUserInfo['0']->profile_pic;
				$data['adminContactEmail'] 		= $getAdminUserInfo['0']->bcc_email_id;
			
					$data["loggedUserId"]		= $loggedUserId;
				
					$data['contact_email']		= $getAdminUserInfo['0']->bcc_email_id;




			}


			if($loggedUserId ==1){


			if(isset($siteConfig) && !empty($siteConfig)) {
				foreach($siteConfig as $value) {

				
					$data['id']					= $value->id;				
					$data['adminContactNumber'] = $value->contactno;
					$data['address'] 			= $value->address;
					$data['city'] 				= $value->city;
					$data['state'] 				= $value->state;
					$data['country'] 			= $value->country;
					$data['zip'] 				= $value->zip;
					$data['companylogo']		= $value->site_logo;
					$data['companyfavicon']		= $value->site_favicon;
					$data['companyname']		= $value->site_name;
					$data['facebook_url']		= $value->facebooklink;
					$data['google_url']			= $value->googlelink;
					$data['twitter_url']		= $value->twitterlink;
					$data['linkedin_url']		= $value->linkedinlink;
					$data['telegram_url']		= $value->telegramlink;
					$data['medium_url']			= $value->mediumlink;
					$data['reddit_url']			= $value->redditlink;
					$data['youtube_url']		= $value->youtubelink;
					$data['smtpHost']			= $value->smtp_host;
					$data['smtp_port']			= $value->smtp_port;
					$data['smtp_username']		= $value->smtp_email;
					$data['smtp_password']		= $value->smtp_password;
					$data['addCoinFee']			= $value->addCoinFee;
					$data['contact_email']		= $value->contact_email;
				}
			}
		}

			$data['siteName'] 		= $siteConfig['0']->site_name;
			$data['copyRight'] 		= date('Y');
			$data['copySiteTitle'] 	= $siteConfig['0']->site_name." Admin";			
			$data['title'] 			= "Site configuration | ".$siteConfig['0']->site_name;
			$data['keywords'] 		= "Site configuration | ".$siteConfig['0']->site_name;
			$data['description'] 	= "Site configuration | ".$siteConfig['0']->site_name;	
			$this->load->view('admin/boSettings/boSettings',$data);
		}
		else {
			redirect('YfQa6hmtE8a3G2Z6Ssuf','refresh');
		}
	}

	/**
	 * To prepare for update the configuration settings
	 * @return response success or fail
	 * @author Sharavana Kumar
	 */
	function siteConfigUpdate() {
		$loggedUserId = $this->session->userdata('loggedJTEAdminUserID');
		if(isset($loggedUserId) && !empty($loggedUserId)) {
			if($this->input->post('saveConfig')) {
				$siteSettingID 	= $this->input->post('id');
				$adminUserID 	= $this->input->post('adminID');

				/* site logo image start here */
				if(isset($_FILES['site_logo_image']['name']) && $_FILES['site_logo_image']['name']!="" ){
					
					// explode file name to two part
					$fileNameParts = explode(".", $_FILES['site_logo_image']['name']); 
		            
		            // give extension
		            $fileExtension = end($fileNameParts);

		            // convert to lower case
			        $fileExtension = strtolower($fileExtension); 

			        // current date
			        $date = date('Y-m-d_H:i:s');
					
					// generate new file name
					//$encripted_pic_name       = 'site_logo_'.$date."." . $fileExtension;  
					$encripted_pic_name       = 'site_logo_' . $fileExtension;  
			 
					$upload_config = array(
						'upload_path' 	=> 'uploads/siteLogo/', 
						'allowed_types' => 'jpg|jpeg|gif|png',
						'max_size'      =>  '3500',
						/*'min_width' 	=> '40',
						'min_height' 	=> '40',*/
						'overwrite'     => true,
						'maintain_ratio' => true,
						'file_name'     => $encripted_pic_name
					);

		    		$this->load->library('upload', $upload_config);
					$this->upload->initialize($upload_config);
					if(!$this->upload->do_upload('site_logo_image')) {
						$uploadErrors = $this->upload->display_errors();
						$this->session->set_flashdata('error',$uploadErrors);
						redirect('BoSettings','refresh');
					} 
					else  {
						$uploadData_up 	= $this->upload->data();
						$big_image 		= $uploadData_up['file_name'];
						$site_logo 		= $big_image;                	
					}
				}
				else {
					$site_logo 			= $this->input->post('old_site_logo');    
				}


				if(isset($_FILES['profile_image']['name']) && $_FILES['profile_image']['name']!="" ){
					
					// explode file name to two part
					$fileNameParts = explode(".", $_FILES['profile_image']['name']); 
		            
		            // give extension
		            $fileExtension = end($fileNameParts);

		            // convert to lower case
			        $fileExtension = strtolower($fileExtension); 

			        // current date
			        $date = date('Y-m-d_H:i:s');
					
					// generate new file name
					//$encripted_pic_name       = 'profile_image'.$date."." . $fileExtension;  
					$encripted_pic_name       = 'profile_image' . $fileExtension;  
			 
					$upload_config = array(
						'upload_path' 	=> 'uploads/siteLogo/', 
						'allowed_types' => 'jpg|jpeg|gif|png', 
						'max_size'      =>  '3500',
						/*'min_width' 	=> '40',
						'min_height' 	=> '40',*/
						'overwrite'     => true,
						'maintain_ratio' => true,
						'file_name'     => $encripted_pic_name
					);

		    		$this->load->library('upload', $upload_config);
					$this->upload->initialize($upload_config);
					if(!$this->upload->do_upload('profile_image')) {
						$uploadErrors = $this->upload->display_errors();
						$this->session->set_flashdata('error',$uploadErrors);
						redirect('BoSettings','refresh');
					} 
					else  {
						$uploadData_up 	= $this->upload->data();
						$big_image 		= $uploadData_up['file_name'];
						$profile_image 		= $big_image;                	
					}
				}
				else {
					$profile_image 			= $this->input->post('profile_image');    
				}







				/* site logo image end here */

				/* site favicon image start here */
				if(isset($_FILES['site_favicon']['name']) && $_FILES['site_favicon']['name']!="" ){
					
					// explode file name to two part
					$fileNameParts = explode(".", $_FILES['site_favicon']['name']); 
		            
		            // give extension
		            $fileExtension = end($fileNameParts);

		            // convert to lower case
			        $fileExtension = strtolower($fileExtension); 

			        // current date
			        $date = date('Y-m-d_H:i:s');
					
					// generate new file name
					//$encripted_pic_name       = 'site_favicon_'.$date."." . $fileExtension;  
					$encripted_pic_name       = 'site_favicon_' . $fileExtension;  
			 
					$upload_config = array(
						'upload_path' 	=> 'uploads/siteLogo/', 
						'allowed_types' => 'jpg|jpeg|gif|png', 
						'max_size'      =>  '3500',
						/*'min_width' 	=> '40',
						'min_height' 	=> '40',*/
						'overwrite'     => true,
						'maintain_ratio' => true,
						'file_name'     => $encripted_pic_name
					);

		    		$this->load->library('upload', $upload_config);
					$this->upload->initialize($upload_config);
					if(!$this->upload->do_upload('site_favicon')) {
						$uploadErrors = $this->upload->display_errors();
						$this->session->set_flashdata('error',$uploadErrors);
						redirect('BoSettings','refresh');
					} 
					else  {
						$uploadData_up 	= $this->upload->data();
						$big_image 		= $uploadData_up['file_name'];
						$site_favicon 		= $big_image;                	
					}
				}
				else {
					$site_favicon 			= $this->input->post('old_site_favicon');    
				}
				/* site favicon image end here */
				
				$result = $this->BoSettingsModel->siteConfigUpdate($siteSettingID,$adminUserID,$site_logo,$site_favicon,$profile_image);



				if($result) {
					$this->session->set_flashdata('success', ' Details has been updated successfully');			
					redirect('BoSettings','refresh');
				}  
				else {
					$this->session->set_flashdata('error', ' Details has not been updated.');		
					redirect('BoSettings','refresh');
				}				
			}
		}
		else {
			redirect('YfQa6hmtE8a3G2Z6Ssuf','refresh');
		}
	}	

	/**
	 * Function use to prepare for change pattern lock
	 * @access public
	 * @return response success get the set of records or fail
	 * @author Sharavana Kumar
	 */
	public function changePatternLock() {
		$loggedUserId = $this->session->userdata('loggedJTEAdminUserID');
		
		if(isset($loggedUserId) && !empty($loggedUserId)) {
			$siteDetails 			= $this->CommonModel->getSiteConfigInfo();
			$adminDetails 			= $this->CommonModel->getLoggedInAdminDetails();
			$data['userID'] 		= $adminDetails['0']->id;			

			$data['siteName'] 		= $siteDetails['0']->site_name;
			$data['title'] 			= "Change Patten Lock | ".$siteDetails['0']->site_name;
			$data['keywords']		= "Change Patten Lock | ".$siteDetails['0']->site_name;
			$data['description'] 	= "Change Patten Lock | ".$siteDetails['0']->site_name;
			
			$this->load->view('admin/boSettings/boChangePatternLock',$data);			
		}
		else {
			redirect('YfQa6hmtE8a3G2Z6Ssuf','refresh');	
		}		
	}	

	/**
	 * Function is use for update the pattern lock
	 * @access public
	 * @return response success get the set of records or fail
	 * @author Sharavana Kumar
	 */	
	public function updatePatternLock() {
		$loggedUserId = $this->session->userdata('loggedJTEAdminUserID');
		if(isset($loggedUserId) && !empty($loggedUserId)) {
			if($this->input->post('updatePatternLock')) {
				$pattern 		= $this->CommonModel->customEncode($this->input->post('patterncode'));	
				$userID 		= $this->input->post('userID');
				
				$result = $this->BoSettingsModel->updatePattern($pattern,$userID);
				if($result) {
					$this->session->set_flashdata('success', ' Patten has been updated successfully');			
					redirect('BoSettings/changePatternLock','refresh');
				}  
				else {
					$this->session->set_flashdata('error', ' Patten has not been updated.');
					redirect('BoSettings/changePatternLock','refresh');
				}				
			}
		}		
		else {
			redirect('YfQa6hmtE8a3G2Z6Ssuf','refresh');
		}		
	}	
}

/**
 * Filename: BoSettings.php
 * Location: /application/controllers/BoSettings.php
 */
?>
