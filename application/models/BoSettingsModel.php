<?php
/**
 * BoSettingsModel class
 * @category model
 * @package Bitcocyrus
 * @subpackage modules
 * @author Osiz Technologies Pvt Ltd 
 * @link http://osiztechnologies.com/
 */

class BoSettingsModel extends CI_Model {
	/**
	 * To prepare for update the configuration settings
	 * @return response success or fail
	 * @author Sharavana Kumar
	 */
	function siteConfigUpdate($siteSettingID,$adminUserID,$site_logo,$site_favicon,$profile_pic) {
		$data = array(			
			'adminFirstName'		=>  $this->input->post('adminFirstName'),
			'adminLastName'			=>  $this->input->post('adminLastName'),

			'profile_pic'			=>  $profile_pic,
		);
		$this->db->where('id',$adminUserID);
		$this->db->update('bcc_admin',$data);

		if($adminUserID==1){		

		$siteData = array(		
			'site_logo'				=>	$site_logo,
			'site_favicon' 			=>  $site_favicon,
			'site_name'				=>  $this->input->post('companyName'),
			'contactno'				=>  $this->input->post('adminContactNumber'),
			'address'				=>  $this->input->post('address'),
			'city'					=>  $this->input->post('city'),
			'state'					=>  $this->input->post('state'),
			'country'				=>  $this->input->post('country'),
			'facebooklink'			=>  $this->input->post('facebookURL'),
			'twitterlink'			=>  $this->input->post('twitterURL'),
			'telegramlink'			=>  $this->input->post('telegramURL'),
			'mediumlink'			=>  $this->input->post('mediumURL'),
			'redditlink'			=>  $this->input->post('redditURL'),
			'youtubelink'			=>  $this->input->post('youtubeURL'),
			//'linkedinlink'			=>  $this->input->post('linkedinURL'),
			//'googlelink'			=>  $this->input->post('googleURL'),
			//'addCoinFee' 			=>  $this->input->post('addCoinFee'),
			'contact_email' 		=>  $this->input->post('adminContactEmail'),
			//'smtp_host'				=>  $this->input->post('smtpHost'),
			//'smtp_port'				=>  $this->input->post('smtp_port'),
			//'smtp_email'			=>  $this->input->post('smtp_username'),
			//'smtp_password'			=>  $this->input->post('smtp_password'),
		);
		$this->db->where('id',$siteSettingID);  	
		$this->db->update('bcc_site_settings',$siteData);

}

		return true;
	}

	/**
	 * To prepare for update the site pattern image
	 * @return response success or fail
	 * @author Sharavana Kumar
	 */
	function updatePattern($pattern,$userID) {
		$siteData = array(		
			'bcc_pattern_key' 	=>	$pattern,
		);
		$this->db->where('id',$userID);  	
		$this->db->update('bcc_admin',$siteData);
		
		return true;
	}	
}

/**
 * Filename: BoSettingsModel.php
 * Location: /application/models/BoSettingsModel.php
 */
?>